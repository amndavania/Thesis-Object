<?php

// ====== Fungsi untuk Menentukan Kategori ======
function getKategoriKopling($nilai) {
    if ($nilai >= 0.61) return 'Tinggi';
    if ($nilai >= 0.31) return 'Sedang';
    return 'Rendah';
}

// ====== Load Input ======
$methodTarget = include 'method_target.php';
$classCandidates = include 'class_candidates.php';
$sourceClass = include 'source_class.php';

// ====== Masukkan Class Asal ke Daftar Kandidat (dengan penanda) ======
$classCandidatesWithSource = $classCandidates;
$classCandidatesWithSource["{$sourceClass['name']} (asal)"] = $sourceClass['attributes'];

// ====== Perhitungan Jaccard untuk Semua Kandidat ======
echo "=== PERHITUNGAN JACCARD UNTUK MOVE METHOD ===\n";
echo "Method Target: {$methodTarget['method']}\n";
echo "Attributes: [" . implode(', ', $methodTarget['attributes']) . "]\n";
echo str_repeat('=', 90) . "\n";
echo str_pad("Class", 30) . str_pad("Shared", 10) . str_pad("Union", 10) . str_pad("Score", 10) . "Kategori\n";
echo str_repeat('-', 90) . "\n";

$results = [];
foreach ($classCandidatesWithSource as $className => $classAttrs) {
    $shared = array_intersect($methodTarget['attributes'], $classAttrs);
    $union = array_unique(array_merge($methodTarget['attributes'], $classAttrs));
    $score = count($union) === 0 ? 0 : count($shared) / count($union);
    $kategori = getKategoriKopling($score);

    $results[] = [
        'class' => $className,
        'score' => $score,
        'shared' => count($shared),
        'union' => count($union),
        'kategori' => $kategori
    ];

    echo str_pad($className, 30);
    echo str_pad(count($shared), 10);
    echo str_pad(count($union), 10);
    echo str_pad(number_format($score, 2), 10);
    echo $kategori . "\n";
}
echo str_repeat('=', 90) . "\n";

// ====== Rekomendasi Kelas Terbaik ======
usort($results, fn($a, $b) => $b['score'] <=> $a['score']);
$best = $results[0];

echo "\n>> Rekomendasi:\n";
if (strpos($best['class'], '(asal)') !== false) {
    echo "- Method **lebih cocok tetap di class asal**: {$sourceClass['name']}\n";
} else {
    echo "- Method **lebih cocok dipindahkan ke** class: {$best['class']}\n";
}
echo "- Skor Jaccard Tertinggi: " . number_format($best['score'], 2) . " ({$best['kategori']})\n";
