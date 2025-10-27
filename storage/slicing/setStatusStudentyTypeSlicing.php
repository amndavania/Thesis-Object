
🔥 Kandidat Extract Method: S2 (jumlah dependency: 14)
=== POTONGAN KODE (TERMINAL) ===
if ($payment_type == 'UKT') {
$totalKRS = floatval($student_type->krs);
$totalUTS = $totalKRS + $student_type->uts;
$totalUAS = $totalUTS + $student_type->uas;
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
        if ($payment_type == 'UKT') { //S2 //ini untuk yang ukt
            $totalKRS = floatval($student_type->krs); //s3
            $totalUTS = $totalKRS + $student_type->uts; //s4
            $totalUAS = $totalUTS + $student_type->uas; //s5
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S6 (jumlah dependency: 5)
=== POTONGAN KODE (TERMINAL) ===
if ($amount > $totalUAS) {
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';

=== DARI FILE SEBENARNYA ===
            if ($amount > $totalUAS) { //s6
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14

---------------------------

🔥 Kandidat Extract Method: S1 (jumlah dependency: 22)
=== POTONGAN KODE (TERMINAL) ===
public function setStatus($amount, $payment_type, $student_type)
if ($payment_type == 'UKT') {
$totalKRS = floatval($student_type->krs);
$totalUTS = $totalKRS + $student_type->uts;
$totalUAS = $totalUTS + $student_type->uas;
if ($amount > $totalUAS) {
elseif ($amount == $totalUAS) {
elseif ($amount >= $totalUTS) {
elseif ($amount >= $totalKRS) {
elseif ($payment_type == 'DPP') {
if ($amount < $student_type->dpp) {
elseif ($amount == $student_type->dpp) {
elseif ($amount > $student_type->dpp) {
elseif ($payment_type == 'WISUDA') {
if ($amount < $student_type->wisuda) {
elseif ($amount == $student_type->wisuda) {
elseif ($amount > $student_type->wisuda) {

=== DARI FILE SEBENARNYA ===
    public function setStatus($amount, $payment_type, $student_type) //this, the student_type parameter's declared in the getStudentData line 184 S1
        if ($payment_type == 'UKT') { //S2 //ini untuk yang ukt
            $totalKRS = floatval($student_type->krs); //s3
            $totalUTS = $totalKRS + $student_type->uts; //s4
            $totalUAS = $totalUTS + $student_type->uas; //s5
            if ($amount > $totalUAS) { //s6
            } elseif ($amount == $totalUAS) { //s8
            } elseif ($amount >= $totalUTS) { //s10
            } elseif ($amount >= $totalKRS) { //s12
        } elseif ($payment_type == 'DPP') { //s15 //ini untuk dpp
            if ($amount < $student_type->dpp) { //s16
            }elseif ($amount == $student_type->dpp) { //s18
            }elseif ($amount > $student_type->dpp) { //s20
        } elseif ($payment_type == 'WISUDA') { //s22 //ini untuk wisuda
            if ($amount < $student_type->wisuda) { //s23
            }elseif ($amount == $student_type->wisuda) { //s25
            }elseif ($amount > $student_type->wisuda) { //s27

---------------------------

🔥 Kandidat Extract Method: S7 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S9 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S11 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S13 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S14 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S17 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S19 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S21 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S24 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S26 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🔥 Kandidat Extract Method: S28 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$status = 'Lebih';
$status = 'Lunas';
$status = 'Lunas UTS';
$status = 'Lunas KRS';
$status = 'Belum Lunas';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';
$status = 'Belum Lunas';
$status = 'Lunas';
$status = 'Lebih';

=== DARI FILE SEBENARNYA ===
                $status = 'Lebih'; //s7
                $status = 'Lunas'; //s9
                $status = 'Lunas UTS'; //s11
                $status = 'Lunas KRS'; //s13
                $status = 'Belum Lunas'; //s14
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7
                $status = 'Belum Lunas'; //s14
                $status = 'Lunas'; //s9
                $status = 'Lebih'; //s7

---------------------------

🏁 Ranking Kandidat Extract Method Berdasarkan Jumlah Dependency:
1. S1 (Jumlah Dependency: 22)
2. S2 (Jumlah Dependency: 14)
3. S7 (Jumlah Dependency: 11)
4. S9 (Jumlah Dependency: 11)
5. S11 (Jumlah Dependency: 11)
6. S13 (Jumlah Dependency: 11)
7. S14 (Jumlah Dependency: 11)
8. S17 (Jumlah Dependency: 11)
9. S19 (Jumlah Dependency: 11)
10. S21 (Jumlah Dependency: 11)
11. S24 (Jumlah Dependency: 11)
12. S26 (Jumlah Dependency: 11)
13. S28 (Jumlah Dependency: 11)
14. S6 (Jumlah Dependency: 5)
