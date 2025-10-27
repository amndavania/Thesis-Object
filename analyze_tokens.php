<?php

//this file's for counting the MI score for whole class, you can use it with this command : php analyze_tokens.php
//then you can input the file or folder.

$content = null;
$tokens = null;

function analyzeFolder($folderPath){ //fungsi utama yang akan menganalisis seluruh file PHP yang ada di dalam folder yang diinputkan oleh pengguna.
    $phpFiles = glob("$folderPath/*.php"); //Fungsi glob() akan mencari semua file PHP (*.php) di dalam folder yang diberikan dan membagi filenya dalam bentuk array
    if(!$phpFiles){
        echo "Tidak ada file PHP di folder tersebut.\n";
        return;
    }

    $totalVolume = 0;
    $totalCC = 0;
    $totalLOC = 0;
    $totalMI = 0;
    $totalPerCM = 0;
    $fileCount = 0;

    echo "\n=== HASIL ANALISIS SELURUH FILE DI FOLDER: $folderPath ===\n";
    foreach($phpFiles as $file) //disini kumpulan filenya dianalisa satu persatu dengan var file
    {
        $content = file_get_contents($file); //Ambil isi file PHP yang dipilih user, simpan ke variabel $content
        $tokens = token_get_all($content); //token_get_all() itu fungsi built-in PHP buat memecah file PHP jadi potongan kecil (disebut token).
    

// ========== HALSTEAD METRICS ==========
        $operators = []; //menampung semua token yang dianggap operator.
        $operands = []; //akan menampung semua token yang dianggap operand.

        foreach ($tokens as $token) { //Ambil satu per satu token dari $tokens.
            if (is_array($token)) { //Periksa apakah token ini array atau bukan.
                $tokenName = token_name($token[0]);
                $tokenValue = $token[1]; // isi tulisan token yang akan dicek dan dimasukkan ke operator atau operand. karena token adalah sebuah array, dengan total 3 index = index 0 itu kodenya kek T_FUNCTION dan index ke 1 adalah isi teksnya kek 'function'

                // Keyword, operator simbol, visibility keywords = OPERATOR
                if (in_array($tokenName, [
                    'T_FUNCTION', 'T_PUBLIC', 'T_PROTECTED', 'T_PRIVATE', 'T_STATIC', 'T_CLASS',
                    'T_INTERFACE', 'T_TRAIT', 'T_NAMESPACE', 'T_USE', 'T_RETURN', 'T_EXTENDS',
                    'T_IMPLEMENTS', 'T_NEW', 'T_CONST', 'T_VAR'
                ])) {
                    $operators[] = trim($tokenValue);
                }
                // Periksa untuk operator T_OBJECT_OPERATOR (->)
                elseif ($tokenName == 'T_OBJECT_OPERATOR') {
                    $operators[] = '->';
                } 
                // Periksa untuk operator T_DOUBLE_COLON (::)
                elseif ($tokenName == 'T_DOUBLE_COLON') {
                    $operators[] = '::';
                }
                // Kalau nama variabel, nama class, nama method, nama table → OPERAND
                elseif (in_array($tokenName, ['T_STRING', 'T_VARIABLE'])) {
                    $operands[] = trim($tokenValue);
                }
                // Comment, whitespace, punctuations bisa dilewat
            } else {
                // Single character tokens seperti ; ( ) { } [ ] = + - * / dst → operator
                if (trim($token)) {
                    $operators[] = $token;
                }
            }
        }

        // Menghitung n1, n2, N1, N2
        $n1 = count(array_unique($operators));  // Jumlah unik operator
        $n2 = count(array_unique($operands));   // Jumlah unik operand
        $N1 = count($operators);                // Jumlah total operator
        $N2 = count($operands);                 // Jumlah total operand

        // Menghitung Halstead Metrics
        $programLength = $N1 + $N2;
        $vocabularySize = $n1 + $n2;
        $volume = $programLength * log($vocabularySize, 2);

    // ========== CYCLOMATIC COMPLEXITY ==========
        $decisionPoints = 0;
        foreach ($tokens as $token) {
            if (is_array($token)) {
                $tokenName = token_name($token[0]);
                // Semua decision point yang meningkatkan cyclomatic complexity
                if (in_array($tokenName, ['T_IF', 'T_ELSEIF', 'T_FOR', 'T_FOREACH', 'T_WHILE', 'T_CASE', 'T_CATCH'])) {
                    $decisionPoints++;
                }
            }
        }

        $cc = $decisionPoints + 1; //penjelasan kenapa diubah ke rumus ini ada di notepad

    // MAINTAINABILITY INDEX

        // Hitung LOC hanya baris kode (exclude full-line comment & kosong)
        $lines = explode("\n", $content);
        $loc = 0;
        $commentLines = 0;
        $inBlockComment = false;

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if ($trimmed === "") {
                continue; // skip baris kosong
            }

            if ($inBlockComment) {
                $commentLines++;
                if (strpos($trimmed, '*/') !== false) {
                    $inBlockComment = false;
                }
                continue; //exclude comment
            }

            if (strpos($trimmed, '/*') === 0) {
                $commentLines++;
                if (strpos($trimmed, '*/') === false) {
                    $inBlockComment = true;
                }
                continue; //exclude comment
            }

            if (strpos($trimmed, '//') === 0 || strpos($trimmed, '#') === 0) {
                $commentLines++;
                continue; //exclude comment
            }

            // inline comment → dihitung sebagai LOC + komentar
            if (strpos($trimmed, '//') !== false || strpos($trimmed, '#') !== false) {
                $commentLines++;
                $loc++;
                continue; 
            }

            // baris kode biasa
            $loc++;
        }

        $perCM = ($loc > 0) ? ($commentLines / $loc) * 100 : 0;


        // Rumus Maintainability Index (MI)
        $mi = 171 - (5.2 * log($volume)) - (0.23 * $cc) - (16.2 * log($loc)) + (50 * sin(sqrt(2.46 * $perCM)));

        echo "\n-- File: $file --\n"; //ini untuk menampilkan nama file yang sedang dianalisa
        echo "Volume: $volume\nCC: $cc\nLOC: $loc\nperCM: $perCM\nMI: $mi\n"; //ini akan menampilkan hasil dari file yang diperiksa

        $totalVolume += $volume; //ini semua akan menambahkan hasil dari masing" file yang sudah dihitung
        $totalCC += $cc;
        $totalLOC += $loc;
        $totalMI += $mi;
        $totalPerCM += $perCM;
        $fileCount++; //Ini menambah hitungan file yang sudah dianalisis.
    }
echo "\n == TOTAL HASIL SELURUH FILE ($fileCount file) ==\n";
echo "Total Volume : $totalVolume\n";
echo "Total CC : $totalCC\n";
echo "Total LOC : $totalLOC\n";
echo "Rata-rata perCM : " . ($fileCount ? ($totalPerCM / $fileCount) : 0) . "\n";
echo "Rata-rata MI :" . ($fileCount ?($totalMI / $fileCount) : 0) . "\n"; //ini untuk apa? bukannya mi nya uda dihitung satu per satu tadi? kenapa harus dihitung lagi?
}

echo "Masukkan path folder yang ingin dianalisis: "; //ini untuk inputan folder yang dimasukkan
$folderPath = trim(fgets(STDIN)); //fgets(STDIN) = Membaca input dari keyboard (terminal).
analyzeFolder($folderPath); //Ini memanggil fungsi analyzeFolder tadi dan menjalankan proses analisis terhadap folder yang sudah diketik user.




