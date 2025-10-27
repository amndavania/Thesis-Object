<?php

$phpFile = 'TargetController.php'; // File PHP asli
$phpLines = file($phpFile);

// Ambil isi file dependencies.txt
$rawInput = file_get_contents('dependencies.txt');

// =========================
// Parsing fungsi
// =========================

function parseDependencies($raw) {
    $deps = [];
    $lines = explode("\n", $raw);
    foreach ($lines as $line) {
        if (preg_match('/^(S\d+)\s+→\s+(S\d+)/', trim($line), $m)) {
            $deps[$m[1]][] = $m[2];
        }
    }
    return $deps;
}

function parseStatements($raw) {
    $lines = explode("\n", $raw);
    $statements = [];
    foreach ($lines as $line) {
        if (preg_match('/^(S\d+):\s+(.*)$/', trim($line), $m)) {
            $statements[$m[1]] = $m[2];
        }
    }
    return $statements;
}

function findCombinedCandidates($controlDeps, $dataDeps, $threshold = 4) {
    $combined = [];

    foreach ([$controlDeps, $dataDeps] as $deps) {
        foreach ($deps as $parent => $children) {
            if (!isset($combined[$parent])) $combined[$parent] = 0;
            $combined[$parent] += count($children);
        }
    }

    $candidates = [];
    foreach ($combined as $node => $count) {
        if ($count >= $threshold) {
            $candidates[$node] = $count;
        }
    }
    return $candidates;
}

function getCodeFromFile($fileLines, $statementLines) {
    $result = [];
    foreach ($statementLines as $stmt) {
        foreach ($fileLines as $line) {
            if (strpos($line, $stmt) !== false) {
                $result[] = $line;
                break;
            }
        }
    }
    return $result;
}

// =========================
// Jalankan parsing
// =========================

function splitRawInput($raw) {
    $controlPart = '';
    $dataPart = '';
    $inControl = false;
    $inData = false;
    $lines = explode("\n", $raw);
    foreach ($lines as $line) {
        if (stripos($line, 'control dependencies') !== false) {
            $inControl = true;
            $inData = false;
            continue;
        }
        if (stripos($line, 'data dependencies') !== false) {
            $inData = true;
            $inControl = false;
            continue;
        }
        if ($inControl) {
            $controlPart .= $line . "\n";
        } elseif ($inData) {
            $dataPart .= $line . "\n";
        }
    }
    return [$controlPart, $dataPart];
}

list($controlRaw, $dataRaw) = splitRawInput($rawInput);

$controlDeps = parseDependencies($controlRaw);
$dataDeps = parseDependencies($dataRaw);
$statements = parseStatements($rawInput);

$candidates = findCombinedCandidates($controlDeps, $dataDeps);

$output = "";
$ranking = []; // untuk top 3

if (empty($candidates)) {
    $output .= "✅ Tidak ada node dengan dependency tinggi. Tidak perlu extract method.\n";
    file_put_contents('extracted_methods.txt', $output);
    echo "✔ Hasil ditulis ke extracted_methods.txt\n";
    exit;
}

foreach ($candidates as $start => $depCount) {
    $output .= "\n🔥 Kandidat Extract Method: $start (jumlah dependency: $depCount)\n";
    $ranking[] = ['id' => $start, 'total' => $depCount];

    // Ambil semua anak langsung dari control + data dependencies
    $children = [];
    if (isset($controlDeps[$start])) $children = array_merge($children, $controlDeps[$start]);
    if (isset($dataDeps[$start])) $children = array_merge($children, $dataDeps[$start]);

    $linesToExtract = array_unique(array_merge([$start], $children));
    sort($linesToExtract, SORT_NATURAL);

    // Ambil potongan kode dari terminal (parsed)
    $linesCode = [];
    foreach ($linesToExtract as $s) {
        if (isset($statements[$s])) {
            $linesCode[] = $statements[$s];
        }
    }

    // Tampilkan hasil potongan
    $output .= "=== POTONGAN KODE (TERMINAL) ===\n";
    foreach ($linesCode as $line) {
        $output .= $line . "\n";
    }

    // Ambil versi asli dari file
    $output .= "\n=== DARI FILE SEBENARNYA ===\n";
    $fileCode = getCodeFromFile($phpLines, $linesCode);
    $output .= implode("", $fileCode);
    $output .= "\n---------------------------\n";
}

// ==========================
// Tambahkan Kesimpulan Akhir
// ==========================
usort($ranking, fn($a, $b) => $b['total'] <=> $a['total']);
$output .= "\n🏁 Ranking Kandidat Extract Method Berdasarkan Jumlah Dependency:\n";
foreach ($ranking as $i => $rank) {
    $output .= ($i + 1) . ". {$rank['id']} (Jumlah Dependency: {$rank['total']})\n";
}

file_put_contents('extracted_methods.txt', $output);
echo "✔ Hasil ditulis ke extracted_methods.txt\n";
