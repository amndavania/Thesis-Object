<?php

require 'vendor/autoload.php';

use PhpParser\ParserFactory;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;

// === AUTO-DETECT KNOWN MODELS ===
function getKnownModelsFromApp(): array {
    $modelPath = __DIR__ . '/app/Models/';
    $models = [];

    if (!is_dir($modelPath)) {
        return $models;
    }

    $files = scandir($modelPath);
    foreach ($files as $file) {
        if (preg_match('/^(.*)\.php$/', $file, $matches)) {
            $models[] = $matches[1]; // nama file == nama class
        }
    }

    return $models;
}

class AttributeCollector extends NodeVisitorAbstract {
    public $currentMethod = null;
    public $methodAttributes = [];
    private $knownModels;
    private $objectInstances = []; // menyimpan instance objek seperti $user = new User

    public function __construct(array $knownModels) {
        $this->knownModels = $knownModels;
    }

    public function enterNode(Node $node) {
        // Tangkap method
        if ($node instanceof Node\Stmt\ClassMethod) {
            $this->currentMethod = $node->name->name;
            $this->methodAttributes[$this->currentMethod] = [];
            $this->objectInstances = []; // reset saat pindah method
        }

        if (!$this->currentMethod) return;

        // Tangkap model statis: User::where(), Dpa::create(), dst
        if ($node instanceof Node\Expr\StaticCall && $node->class instanceof Node\Name) {
            $model = $node->class->toString();
            if (in_array($model, $this->knownModels)) {
                $this->addAttribute($model);
            }
        }

        // Tangkap: $user = new User();
        if ($node instanceof Node\Expr\Assign
            && $node->expr instanceof Node\Expr\New_
            && $node->expr->class instanceof Node\Name
            && $node->var instanceof Node\Expr\Variable) {

            $model = $node->expr->class->toString();
            $varName = $node->var->name;

            if (in_array($model, $this->knownModels)) {
                $this->objectInstances[$varName] = $model;
                $this->addAttribute($model);
            }
        }

        // Tangkap: $user->email, $dpa->name, dst → jika $user adalah instance dari model
        if ($node instanceof Node\Expr\PropertyFetch
            && $node->var instanceof Node\Expr\Variable) {

            $varName = $node->var->name;

            // Hanya jika $varName adalah instance dari model
            if (isset($this->objectInstances[$varName])) {
                $model = $this->objectInstances[$varName];
                $this->addAttribute($model);
            }
        }

        // Tangkap: $foo->someMethod() → jika $foo instance dari class lain
        if ($node instanceof Node\Expr\MethodCall && $node->var instanceof Node\Expr\Variable) {
            $varName = $node->var->name;

            if (isset($this->objectInstances[$varName])) {
                $model = $this->objectInstances[$varName];
                $this->addAttribute($model); // bisa dianggap sebagai dependensi
            }
        }

    }

    private function addAttribute($name) {
        if (!in_array($name, $this->methodAttributes[$this->currentMethod])) {
            $this->methodAttributes[$this->currentMethod][] = $name;
        }
    }
}

// ======== PARSE FILE ========
$code = file_get_contents('app/Http/Controllers/UktController.php');
$parser = (new ParserFactory())->createForNewestSupportedVersion();
$ast = $parser->parse($code);

$knownModels = getKnownModelsFromApp(); // ✅ ambil daftar model dari folder app/Models

$traverser = new NodeTraverser();
$collector = new AttributeCollector($knownModels); // ✅ masukkan ke dalam konstruktor
$traverser->addVisitor($collector);
$traverser->traverse($ast);

// ======== OUTPUT ========
print_r($collector->methodAttributes);
