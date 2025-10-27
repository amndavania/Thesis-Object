<?php
require 'vendor/autoload.php';

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\NodeVisitor\ParentConnectingVisitor;

class VariableAnalysisVisitor extends NodeVisitorAbstract {
    public $statements = [];            // Semua statement, key = ID (S1, S2, ...)
    public $definedVars = [];           // [statementID => array variabel yg didefinisikan]
    public $usedVars = [];              // [statementID => array variabel yg digunakan]
    public $dataDependencies = [];     // [ [Sdef, Suse, var], ... ]
    public $controlDependencies = [];  // [ [Sctrl, Sbody], ... ]

    private $controlStack = [];         // Stack statement kontrol yang aktif (ID)
    private $stmtCounter = 0;           // Hitung statement unik untuk ID

    public function enterNode(Node $node) {
        // Handle method parameters sebagai statement baru
        if ($node instanceof Node\Stmt\ClassMethod) {
            $this->stmtCounter++;
            $id = "S" . $this->stmtCounter;

            $this->statements[$id] = $node;
            $this->definedVars[$id] = [];
            $this->usedVars[$id] = [];

            foreach ($node->params as $param) {
                if ($param->var instanceof Node\Expr\Variable) {
                    $this->definedVars[$id][] = $param->var->name;
                }
                if ($param->default !== null) {
                    $this->usedVars[$id] = array_merge(
                        $this->usedVars[$id],
                        $this->extractUsedVars($param->default)
                    );
                }
            }

            // Control dependencies dari stack kontrol yang aktif
            foreach ($this->controlStack as $ctrlId) {
                $this->addControlDependency($ctrlId, $id);
            }
            // return; // supaya tidak diproses ulang
        }

        // Statement kontrol: if, elseif, while, for
        if ($node instanceof Node\Stmt\If_ ||
            $node instanceof Node\Stmt\ElseIf_ ||
            $node instanceof Node\Stmt\While_ ||
            $node instanceof Node\Stmt\For_) 
        {
            $this->stmtCounter++;
            $id = "S" . $this->stmtCounter;

            $this->statements[$id] = $node;
            $this->definedVars[$id] = []; // biasanya kontrol tidak define var baru
            $this->usedVars[$id] = $this->extractUsedVars($node->cond ?? null);

            $this->controlStack[] = $id; // push ke stack kontrol

            return;
        }

        // Expression statement (assignment, function call, dll)
        if ($node instanceof Node\Stmt\Expression) {
            $this->stmtCounter++;
            $id = "S" . $this->stmtCounter;

            $this->statements[$id] = $node;
            $this->definedVars[$id] = $this->extractDefinedVars($node->expr);
            $this->usedVars[$id] = $this->extractUsedVars($node->expr);

            foreach ($this->controlStack as $ctrlId) {
                $this->addControlDependency($ctrlId, $id);
            }
            return;
        }

        // Return statement
        if ($node instanceof Node\Stmt\Return_) {
            $this->stmtCounter++;
            $id = "S" . $this->stmtCounter;

            $this->statements[$id] = $node;
            $this->definedVars[$id] = []; // return tidak define variabel baru
            $this->usedVars[$id] = $this->extractUsedVars($node->expr);

            foreach ($this->controlStack as $ctrlId) {
                $this->addControlDependency($ctrlId, $id);
            }
            return;
        }

        // Array item (misal parameter with(['a' => $var]))
        if ($node instanceof Node\Expr\ArrayItem) {
            if ($node->value) {
                $used = $this->extractUsedVars($node->value);
                if (!empty($used)) {
                    $this->stmtCounter++;
                    $id = "S" . $this->stmtCounter;

                    $this->statements[$id] = $node;
                    $this->definedVars[$id] = [];
                    $this->usedVars[$id] = $used;

                    foreach ($this->controlStack as $ctrlId) {
                        $this->addControlDependency($ctrlId, $id);
                    }
                }
            }
            return;
        }
    }

    public function leaveNode(Node $node) {
        // Jika keluar dari kontrol, pop dari stack kontrol
        if ($node instanceof Node\Stmt\If_ ||
            $node instanceof Node\Stmt\ElseIf_ ||
            $node instanceof Node\Stmt\While_ ||
            $node instanceof Node\Stmt\For_)
        {
            array_pop($this->controlStack);
        }
    }

    public function afterTraverse(array $nodes) {
        // Buat data dependency: cek semua penggunaan var apakah sudah didefinisikan sebelumnya
        foreach ($this->usedVars as $useStmt => $vars) {
            foreach ($vars as $v) {
                foreach ($this->definedVars as $defStmt => $defVars) {
                    if ($useStmt !== $defStmt && in_array($v, $defVars)) {
                        $this->addDataDependency($defStmt, $useStmt, $v);
                    }
                }
            }
        }
    }

    private function addControlDependency(string $from, string $to) {
        // Hindari duplikasi
        $dep = [$from, $to];
        if (!in_array($dep, $this->controlDependencies, true)) {
            $this->controlDependencies[] = $dep;
        }
    }

    private function addDataDependency(string $from, string $to, string $var) {
        // Hindari duplikasi
        foreach ($this->dataDependencies as $dep) {
            if ($dep[0] === $from && $dep[1] === $to && $dep[2] === $var) {
                return; // sudah ada
            }
        }
        $this->dataDependencies[] = [$from, $to, $var];
    }

    private function extractDefinedVars($expr): array {
        $vars = [];

        if ($expr instanceof Node\Expr\Assign) {
            $var = $expr->var;

            if ($var instanceof Node\Expr\Variable) {
                $vars[] = $var->name;
            } elseif ($var instanceof Node\Expr\PropertyFetch &&
                      $var->var instanceof Node\Expr\Variable &&
                      $var->var->name === 'this') 
            {
                $vars[] = 'this->' . (string)$var->name;
            } elseif ($var instanceof Node\Expr\ArrayDimFetch) {
                $baseVar = $var->var;
                if ($baseVar instanceof Node\Expr\Variable) {
                    $vars[] = $baseVar->name . '[...]';
                }
            }
        }
        return $vars;
    }

    private function extractUsedVars($expr): array {
        $vars = [];

        if ($expr instanceof Node\Expr\Variable) {
            $vars[] = $expr->name;
        } elseif ($expr instanceof Node\Expr\Array_) {
            foreach ($expr->items as $item) {
                if ($item instanceof Node\Expr\ArrayItem && $item->value !== null) {
                    $vars = array_merge($vars, $this->extractUsedVars($item->value));
                }
            }
        } elseif ($expr instanceof Node\Arg) {
            $vars = array_merge($vars, $this->extractUsedVars($expr->value));
        } elseif ($expr instanceof Node) {
            foreach ($expr->getSubNodeNames() as $subNode) {
                $child = $expr->$subNode;
                if (is_array($child)) {
                    foreach ($child as $c) {
                        if ($c instanceof Node) {
                            $vars = array_merge($vars, $this->extractUsedVars($c));
                        }
                    }
                } elseif ($child instanceof Node) {
                    $vars = array_merge($vars, $this->extractUsedVars($child));
                }
            }
        }
        return $vars;
    }

    public function getShortCode(Node $node): string {
        if (!$node) return '';
        $node->setAttribute('comments', []);
        $prettyPrinter = new PhpParser\PrettyPrinter\Standard();
        $code = $prettyPrinter->prettyPrint([$node]);
        $lines = explode("\n", $code);
        return trim($lines[0]);
    }
}

// --- Main Execution ---

$code = file_get_contents('TargetController.php'); // Ganti dengan file target kamu
$parser = (new ParserFactory())->createForNewestSupportedVersion();

try {
    $ast = $parser->parse($code);
} catch (PhpParser\Error $e) {
    echo "Parse error: ", $e->getMessage();
    exit(1);
}

$traverser = new NodeTraverser();
$visitor = new VariableAnalysisVisitor();
$traverser->addVisitor(new ParentConnectingVisitor());
$traverser->addVisitor($visitor);
$traverser->traverse($ast);

$output = "";

$output .= "\n--- Control Dependencies (Grouped & Ordered by Controller) ---\n";

$groupedCtrl = [];
foreach ($visitor->controlDependencies as [$from, $to]) {
    $groupedCtrl[$from][] = $to;
}

// Urut berdasarkan angka Sx
uksort($groupedCtrl, function($a, $b) {
    return intval(substr($a, 1)) <=> intval(substr($b, 1));
});

foreach ($groupedCtrl as $from => $toList) {
    $fromCode = $visitor->getShortCode($visitor->statements[$from]);
    foreach ($toList as $to) {
        $toCode = $visitor->getShortCode($visitor->statements[$to]);
        $output .= "$from → $to\n";
        $output .= "  $from: $fromCode\n";
        $output .= "  $to  : $toCode\n\n";
    }
}

$output .= "\n--- Data Dependencies (Grouped & Ordered by Definer) ---\n";

$groupedData = [];
foreach ($visitor->dataDependencies as [$from, $to, $var]) {
    $groupedData[$from][] = [$to, $var];
}

// Urut berdasarkan angka Sx
uksort($groupedData, function($a, $b) {
    return intval(substr($a, 1)) <=> intval(substr($b, 1));
});

foreach ($groupedData as $from => $items) {
    $fromCode = $visitor->getShortCode($visitor->statements[$from]);
    foreach ($items as [$to, $var]) {
        $toCode = $visitor->getShortCode($visitor->statements[$to]);
        $output .= "$from → $to [\$$var]\n";
        $output .= "  $from: $fromCode\n";
        $output .= "  $to  : $toCode\n\n";
    }
}


// Tulis ke file
file_put_contents('analysis_output.txt', $output);
echo "Hasil analisis telah disimpan di 'analysis_output.txt'\n";
