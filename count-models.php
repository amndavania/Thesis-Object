<?php

$controllerDir = __DIR__ . '/app/Http/Controllers/Report';

// rekursif ambil semua file php di Controllers
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($controllerDir));
$files = [];
foreach ($rii as $file) {
    if (!$file->isDir() && pathinfo($file->getPathname(), PATHINFO_EXTENSION) === 'php') {
        $files[] = $file->getPathname();
    }
}

$modelCounts = [];

foreach ($files as $file) {
    $content = file_get_contents($file);

    // cari semua "use App\Models\..."
    if (preg_match_all('/use\s+App\\\\Models\\\\([A-Za-z0-9_]+)/', $content, $matches)) {
        foreach ($matches[1] as $model) {
            if (!isset($modelCounts[$model])) {
                $modelCounts[$model] = 0;
            }
            $modelCounts[$model]++;
        }
    }
}

// urutkan berdasarkan jumlah terbesar
arsort($modelCounts);

// tampilkan hasil
foreach ($modelCounts as $model => $count) {
    echo str_pad($count, 3, ' ', STR_PAD_LEFT) . " use App\\Models\\$model\n";
}
