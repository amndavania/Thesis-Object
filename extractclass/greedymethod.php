<?php

// ====== Konfigurasi Threshold Kategori ======
function getKategoriKopling($nilai) {
    if ($nilai >= 0.61) return 'Tinggi';
    if ($nilai >= 0.31) return 'Sedang';
    return 'Rendah';
}

// ====== Load Data Awal dari File (hasil attribute analysis manual) ======
$methodAttributes = include 'method_attributes.php';

$classGroups = [];
foreach ($methodAttributes as $method => $attrs) {
    $classGroups[$method] = [
        'methods' => [$method],
        'attributes' => array_unique($attrs)
    ];
}

function calculateCouplingMatrix(array $classGroups): array {
    $pairs = [];
    $keys = array_keys($classGroups);

    for ($i = 0; $i < count($keys); $i++) {
        for ($j = $i + 1; $j < count($keys); $j++) {
            $a = $keys[$i];
            $b = $keys[$j];

            $attrA = $classGroups[$a]['attributes'];
            $attrB = $classGroups[$b]['attributes'];

            $shared = array_intersect($attrA, $attrB);
            $union = array_unique(array_merge($attrA, $attrB));

            $score = count($union) === 0 ? 0 : count($shared) / count($union);

            $pairs[] = [
                'pair' => [$a, $b],
                'shared' => count($shared),
                'total' => count($union),
                'score' => round($score, 2),
                'kategori' => getKategoriKopling($score)
            ];
        }
    }

    usort($pairs, fn($a, $b) => $b['score'] <=> $a['score']);
    return $pairs;
}

function mergeBestCoupling(array &$classGroups): bool {
    $pairs = calculateCouplingMatrix($classGroups);
    if (empty($pairs)) return false;

    $top = $pairs[0];
    if ($top['score'] == 0) return false; // tidak ada pasangan yang bisa digabung lagi

    [$a, $b] = $top['pair'];
    $newKey = $a . '+' . $b;

    $newMethods = array_merge($classGroups[$a]['methods'], $classGroups[$b]['methods']);
    $newAttributes = array_unique(array_merge($classGroups[$a]['attributes'], $classGroups[$b]['attributes']));

    unset($classGroups[$a], $classGroups[$b]);
    $classGroups[$newKey] = [
        'methods' => $newMethods,
        'attributes' => $newAttributes
    ];

    echo "\n>> Menggabungkan: $a + $b\n";
    echo "   Atribut Gabungan: [" . implode(', ', $newAttributes) . "]\n";

    return true;
}

$iterasi = 1;
while (count($classGroups) > 2) {
    echo "\n=== Iterasi $iterasi ===\n";
    $matrix = calculateCouplingMatrix($classGroups);

    echo str_repeat("=", 90) . "\n";
    echo str_pad("Pasangan", 85);
    echo str_pad("Atribut Sama", 15);
    echo str_pad("Total Gabungan", 18);
    echo str_pad("Nilai Kopling", 16);
    echo "Kategori\n";
    echo str_repeat("-", 90) . "\n";

    foreach ($matrix as $row) {
        echo str_pad("{$row['pair'][0]} - {$row['pair'][1]}", 85);
        echo str_pad($row['shared'], 15);
        echo str_pad($row['total'], 18);
        echo str_pad(number_format($row['score'], 2), 16);
        echo $row['kategori'] . "\n";
    }

    echo str_repeat("-", 90) . "\n";

    if (!mergeBestCoupling($classGroups)) break;
    $iterasi++;
}

// ======= Final Output =======
echo "\n==== HASIL AKHIR (CLASS TERBENTUK) ====\n";
foreach ($classGroups as $className => $data) {
    echo "\nClass: $className\n";
    echo "Methods: " . implode(', ', $data['methods']) . "\n";
    echo "Attributes: " . implode(', ', $data['attributes']) . "\n";
}
