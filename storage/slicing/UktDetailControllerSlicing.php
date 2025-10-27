
🔥 Kandidat Extract Method: S6 (jumlah dependency: 48)
=== POTONGAN KODE (TERMINAL) ===
if ($filter == "student") {
$student_id = $request->input('students_id');
$payment_id = $request->input('id');
$dispensasi = $request->input('dispensasi');
$payment = Ukt::where('id', $payment_id)->first();
$bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();
$student_id = Student::first()->id;
$student_id = null;
$student = Student::where('id', $student_id)->first();
$ukt = Ukt::where('students_id', $student->id)->latest()->get();
$totalUkt = $ukt->sum('amount');
$ukt = null;
$totalUkt = 0;
$faculty_id = $request->faculty_id;
$datepicker = $request->datepicker;
$getDate = $this->getDate($datepicker);
$faculty_id = Faculty::first()->id;
$faculty_id = null;
$faculty = Faculty::where('id', $faculty_id)->first();
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
$totalUkt = $ukt->sum('amount');
$ukt = null;
$totalUkt = 0;

=== DARI FILE SEBENARNYA ===
        if ($filter == "student") { //S6
            $student_id = $request->input('students_id'); //S7
            $payment_id = $request->input('id'); //S8
            $dispensasi = $request->input('dispensasi'); //S9
                $payment = Ukt::where('id', $payment_id)->first(); //S11
                $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first(); //S12
                    $student_id = Student::first()->id; //S25
                    $student_id = null; //S26
            $student = Student::where('id', $student_id)->first(); //S27
                $ukt = Ukt::where('students_id', $student->id)->latest()->get(); //S29
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31
                $totalUkt = 0; //S32
            $faculty_id = $request->faculty_id; //S41
            $datepicker = $request->datepicker; //S42
            $getDate = $this->getDate($datepicker); //S43
                    $faculty_id = Faculty::first()->id; //S46
                    $faculty_id = null; //S47
            $faculty = Faculty::where('id', $faculty_id)->first(); //S48
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31
                $totalUkt = 0; //S32

---------------------------

🔥 Kandidat Extract Method: S10 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
if (!empty($payment_id) && !empty($dispensasi)) {
$payment = Ukt::where('id', $payment_id)->first();
$bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();

=== DARI FILE SEBENARNYA ===
            if (!empty($payment_id) && !empty($dispensasi)) { //S10
                $payment = Ukt::where('id', $payment_id)->first(); //S11
                $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first(); //S12

---------------------------

🔥 Kandidat Extract Method: S13 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {

=== DARI FILE SEBENARNYA ===
                if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") { //S13

---------------------------

🔥 Kandidat Extract Method: S28 (jumlah dependency: 4)
=== POTONGAN KODE (TERMINAL) ===
if (!empty($student)) {
$ukt = Ukt::where('students_id', $student->id)->latest()->get();
$totalUkt = $ukt->sum('amount');
$ukt = null;
$totalUkt = 0;

=== DARI FILE SEBENARNYA ===
            if (!empty($student)) { //S28
                $ukt = Ukt::where('students_id', $student->id)->latest()->get(); //S29
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31
                $totalUkt = 0; //S32

---------------------------

🔥 Kandidat Extract Method: S40 (jumlah dependency: 22)
=== POTONGAN KODE (TERMINAL) ===
elseif ($filter == "faculty") {
$faculty_id = $request->faculty_id;
$datepicker = $request->datepicker;
$getDate = $this->getDate($datepicker);
$faculty_id = Faculty::first()->id;
$faculty_id = null;
$faculty = Faculty::where('id', $faculty_id)->first();
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
$totalUkt = $ukt->sum('amount');
$ukt = null;
$totalUkt = 0;

=== DARI FILE SEBENARNYA ===
        } elseif ($filter == "faculty") { //S40
            $faculty_id = $request->faculty_id; //S41
            $datepicker = $request->datepicker; //S42
            $getDate = $this->getDate($datepicker); //S43
                    $faculty_id = Faculty::first()->id; //S46
                    $faculty_id = null; //S47
            $faculty = Faculty::where('id', $faculty_id)->first(); //S48
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31
                $totalUkt = 0; //S32

---------------------------

🔥 Kandidat Extract Method: S49 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
if (!empty($faculty)) {
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
$totalUkt = $ukt->sum('amount');
$ukt = null;
$totalUkt = 0;

=== DARI FILE SEBENARNYA ===
            if (!empty($faculty)) { //S49
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31
                $totalUkt = 0; //S32

---------------------------

🔥 Kandidat Extract Method: S1 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
public function index(Request $request)
$filter = empty($request->filterUkt) ? "student" : $request->filterUkt;
$student_id = $request->input('students_id');
$payment_id = $request->input('id');
$dispensasi = $request->input('dispensasi');
$faculty_id = $request->faculty_id;
$datepicker = $request->datepicker;

=== DARI FILE SEBENARNYA ===
    public function index(Request $request) //S1
        $filter = empty($request->filterUkt) ? "student" : $request->filterUkt; //S5
            $student_id = $request->input('students_id'); //S7
            $payment_id = $request->input('id'); //S8
            $dispensasi = $request->input('dispensasi'); //S9
            $faculty_id = $request->faculty_id; //S41
            $datepicker = $request->datepicker; //S42

---------------------------

🔥 Kandidat Extract Method: S3 (jumlah dependency: 4)
=== POTONGAN KODE (TERMINAL) ===
$selectStudent = Student::select('name', 'id', 'nim')->get();

=== DARI FILE SEBENARNYA ===
        $selectStudent = Student::select('name', 'id', 'nim')->get(); //S3

---------------------------

🔥 Kandidat Extract Method: S4 (jumlah dependency: 4)
=== POTONGAN KODE (TERMINAL) ===
$selectFaculty = Faculty::select('id', 'name')->get();

=== DARI FILE SEBENARNYA ===
        $selectFaculty = Faculty::select('id', 'name')->get(); //S4

---------------------------

🔥 Kandidat Extract Method: S5 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
$filter = empty($request->filterUkt) ? "student" : $request->filterUkt;
if ($filter == "student") {
elseif ($filter == "faculty") {

=== DARI FILE SEBENARNYA ===
        $filter = empty($request->filterUkt) ? "student" : $request->filterUkt; //S5
        if ($filter == "student") { //S6
        } elseif ($filter == "faculty") { //S40

---------------------------

🔥 Kandidat Extract Method: S7 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
$student_id = $request->input('students_id');
$bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();
if (empty($student_id)) {
$student_id = Student::first()->id;
$student_id = null;
$student = Student::where('id', $student_id)->first();

=== DARI FILE SEBENARNYA ===
            $student_id = $request->input('students_id'); //S7
                $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first(); //S12
            if (empty($student_id)) { //S23
                    $student_id = Student::first()->id; //S25
                    $student_id = null; //S26
            $student = Student::where('id', $student_id)->first(); //S27

---------------------------

🔥 Kandidat Extract Method: S9 (jumlah dependency: 4)
=== POTONGAN KODE (TERMINAL) ===
$dispensasi = $request->input('dispensasi');
if (!empty($payment_id) && !empty($dispensasi)) {
if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {
elseif ($dispensasi == "Menunggu Dispensasi UAS" && $bimbinganStudy->status == "Aktif") {
elseif ($dispensasi == "Menunggu Dispensasi KRS") {

=== DARI FILE SEBENARNYA ===
            $dispensasi = $request->input('dispensasi'); //S9
            if (!empty($payment_id) && !empty($dispensasi)) { //S10
                if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") { //S13
                } elseif ($dispensasi == "Menunggu Dispensasi UAS" && $bimbinganStudy->status == "Aktif") { //S16
                } elseif ($dispensasi == "Menunggu Dispensasi KRS") { //S19

---------------------------

🔥 Kandidat Extract Method: S11 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
$payment = Ukt::where('id', $payment_id)->first();
$bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();

=== DARI FILE SEBENARNYA ===
                $payment = Ukt::where('id', $payment_id)->first(); //S11
                $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first(); //S12

---------------------------

🔥 Kandidat Extract Method: S25 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
$student_id = $request->input('students_id');
$bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();
if (empty($student_id)) {
$student_id = Student::first()->id;
$student_id = null;
$student = Student::where('id', $student_id)->first();

=== DARI FILE SEBENARNYA ===
            $student_id = $request->input('students_id'); //S7
                $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first(); //S12
            if (empty($student_id)) { //S23
                    $student_id = Student::first()->id; //S25
                    $student_id = null; //S26
            $student = Student::where('id', $student_id)->first(); //S27

---------------------------

🔥 Kandidat Extract Method: S26 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
$student_id = $request->input('students_id');
$bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();
if (empty($student_id)) {
$student_id = Student::first()->id;
$student_id = null;
$student = Student::where('id', $student_id)->first();

=== DARI FILE SEBENARNYA ===
            $student_id = $request->input('students_id'); //S7
                $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first(); //S12
            if (empty($student_id)) { //S23
                    $student_id = Student::first()->id; //S25
                    $student_id = null; //S26
            $student = Student::where('id', $student_id)->first(); //S27

---------------------------

🔥 Kandidat Extract Method: S27 (jumlah dependency: 4)
=== POTONGAN KODE (TERMINAL) ===
$student = Student::where('id', $student_id)->first();
if (!empty($student)) {
$ukt = Ukt::where('students_id', $student->id)->latest()->get();

=== DARI FILE SEBENARNYA ===
            $student = Student::where('id', $student_id)->first(); //S27
            if (!empty($student)) { //S28
                $ukt = Ukt::where('students_id', $student->id)->latest()->get(); //S29

---------------------------

🔥 Kandidat Extract Method: S29 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$ukt = Ukt::where('students_id', $student->id)->latest()->get();
$totalUkt = $ukt->sum('amount');
$ukt = null;
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
$totalUkt = $ukt->sum('amount');
$ukt = null;

=== DARI FILE SEBENARNYA ===
                $ukt = Ukt::where('students_id', $student->id)->latest()->get(); //S29
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31

---------------------------

🔥 Kandidat Extract Method: S30 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$totalUkt = $ukt->sum('amount');
$totalUkt = 0;
$totalUkt = $ukt->sum('amount');
$totalUkt = 0;

=== DARI FILE SEBENARNYA ===
                $totalUkt = $ukt->sum('amount'); //S30
                $totalUkt = 0; //S32
                $totalUkt = $ukt->sum('amount'); //S30
                $totalUkt = 0; //S32

---------------------------

🔥 Kandidat Extract Method: S31 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$ukt = Ukt::where('students_id', $student->id)->latest()->get();
$totalUkt = $ukt->sum('amount');
$ukt = null;
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
$totalUkt = $ukt->sum('amount');
$ukt = null;

=== DARI FILE SEBENARNYA ===
                $ukt = Ukt::where('students_id', $student->id)->latest()->get(); //S29
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31

---------------------------

🔥 Kandidat Extract Method: S32 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$totalUkt = $ukt->sum('amount');
$totalUkt = 0;
$totalUkt = $ukt->sum('amount');
$totalUkt = 0;

=== DARI FILE SEBENARNYA ===
                $totalUkt = $ukt->sum('amount'); //S30
                $totalUkt = 0; //S32
                $totalUkt = $ukt->sum('amount'); //S30
                $totalUkt = 0; //S32

---------------------------

🔥 Kandidat Extract Method: S41 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$faculty_id = $request->faculty_id;
if (empty($faculty_id)) {
$faculty_id = Faculty::first()->id;
$faculty_id = null;
$faculty = Faculty::where('id', $faculty_id)->first();
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

=== DARI FILE SEBENARNYA ===
            $faculty_id = $request->faculty_id; //S41
            if (empty($faculty_id)) { //S44
                    $faculty_id = Faculty::first()->id; //S46
                    $faculty_id = null; //S47
            $faculty = Faculty::where('id', $faculty_id)->first(); //S48
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50

---------------------------

🔥 Kandidat Extract Method: S43 (jumlah dependency: 4)
=== POTONGAN KODE (TERMINAL) ===
$getDate = $this->getDate($datepicker);
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

=== DARI FILE SEBENARNYA ===
            $getDate = $this->getDate($datepicker); //S43
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50

---------------------------

🔥 Kandidat Extract Method: S46 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$faculty_id = $request->faculty_id;
if (empty($faculty_id)) {
$faculty_id = Faculty::first()->id;
$faculty_id = null;
$faculty = Faculty::where('id', $faculty_id)->first();
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

=== DARI FILE SEBENARNYA ===
            $faculty_id = $request->faculty_id; //S41
            if (empty($faculty_id)) { //S44
                    $faculty_id = Faculty::first()->id; //S46
                    $faculty_id = null; //S47
            $faculty = Faculty::where('id', $faculty_id)->first(); //S48
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50

---------------------------

🔥 Kandidat Extract Method: S47 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$faculty_id = $request->faculty_id;
if (empty($faculty_id)) {
$faculty_id = Faculty::first()->id;
$faculty_id = null;
$faculty = Faculty::where('id', $faculty_id)->first();
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

=== DARI FILE SEBENARNYA ===
            $faculty_id = $request->faculty_id; //S41
            if (empty($faculty_id)) { //S44
                    $faculty_id = Faculty::first()->id; //S46
                    $faculty_id = null; //S47
            $faculty = Faculty::where('id', $faculty_id)->first(); //S48
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50

---------------------------

🔥 Kandidat Extract Method: S50 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$ukt = Ukt::where('students_id', $student->id)->latest()->get();
$totalUkt = $ukt->sum('amount');
$ukt = null;
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
$totalUkt = $ukt->sum('amount');
$ukt = null;

=== DARI FILE SEBENARNYA ===
                $ukt = Ukt::where('students_id', $student->id)->latest()->get(); //S29
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31

---------------------------

🔥 Kandidat Extract Method: S55 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$totalUkt = $ukt->sum('amount');
$totalUkt = 0;
$totalUkt = $ukt->sum('amount');
$totalUkt = 0;

=== DARI FILE SEBENARNYA ===
                $totalUkt = $ukt->sum('amount'); //S30
                $totalUkt = 0; //S32
                $totalUkt = $ukt->sum('amount'); //S30
                $totalUkt = 0; //S32

---------------------------

🔥 Kandidat Extract Method: S56 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$ukt = Ukt::where('students_id', $student->id)->latest()->get();
$totalUkt = $ukt->sum('amount');
$ukt = null;
$ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
$totalUkt = $ukt->sum('amount');
$ukt = null;

=== DARI FILE SEBENARNYA ===
                $ukt = Ukt::where('students_id', $student->id)->latest()->get(); //S29
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31
                $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) { //S50
                $totalUkt = $ukt->sum('amount'); //S30
                $ukt = null; //S31

---------------------------

🔥 Kandidat Extract Method: S57 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$totalUkt = $ukt->sum('amount');
$totalUkt = 0;
$totalUkt = $ukt->sum('amount');
$totalUkt = 0;

=== DARI FILE SEBENARNYA ===
                $totalUkt = $ukt->sum('amount'); //S30
                $totalUkt = 0; //S32
                $totalUkt = $ukt->sum('amount'); //S30
                $totalUkt = 0; //S32

---------------------------

🏁 Ranking Kandidat Extract Method Berdasarkan Jumlah Dependency:
1. S6 (Jumlah Dependency: 48)
2. S40 (Jumlah Dependency: 22)
3. S10 (Jumlah Dependency: 9)
4. S29 (Jumlah Dependency: 9)
5. S31 (Jumlah Dependency: 9)
6. S50 (Jumlah Dependency: 9)
7. S56 (Jumlah Dependency: 9)
8. S49 (Jumlah Dependency: 8)
9. S7 (Jumlah Dependency: 8)
10. S11 (Jumlah Dependency: 8)
11. S25 (Jumlah Dependency: 8)
12. S26 (Jumlah Dependency: 8)
13. S30 (Jumlah Dependency: 7)
14. S32 (Jumlah Dependency: 7)
15. S41 (Jumlah Dependency: 7)
16. S46 (Jumlah Dependency: 7)
17. S47 (Jumlah Dependency: 7)
18. S55 (Jumlah Dependency: 7)
19. S57 (Jumlah Dependency: 7)
20. S13 (Jumlah Dependency: 6)
21. S1 (Jumlah Dependency: 6)
22. S5 (Jumlah Dependency: 6)
23. S28 (Jumlah Dependency: 4)
24. S3 (Jumlah Dependency: 4)
25. S4 (Jumlah Dependency: 4)
26. S9 (Jumlah Dependency: 4)
27. S27 (Jumlah Dependency: 4)
28. S43 (Jumlah Dependency: 4)
