
🔥 Kandidat Extract Method: S17 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
if (empty($id)) {
$bimbinganStudy = BimbinganStudy::find($id);

=== DARI FILE SEBENARNYA ===
        if (empty($id)) {
            $bimbinganStudy = BimbinganStudy::find($id);

---------------------------

🔥 Kandidat Extract Method: S27 (jumlah dependency: 14)
=== POTONGAN KODE (TERMINAL) ===
if ($payment) {
$uts_id = $payment->exam_uts_id;
$uas_id = $payment->exam_uas_id;

=== DARI FILE SEBENARNYA ===
        if ($payment) {
            $uts_id = $payment->exam_uts_id;
            $uas_id = $payment->exam_uas_id;

---------------------------

🔥 Kandidat Extract Method: S30 (jumlah dependency: 4)
=== POTONGAN KODE (TERMINAL) ===
if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {

=== DARI FILE SEBENARNYA ===
            if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {

---------------------------

🔥 Kandidat Extract Method: S36 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {

=== DARI FILE SEBENARNYA ===
            if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {

---------------------------

🔥 Kandidat Extract Method: S39 (jumlah dependency: 4)
=== POTONGAN KODE (TERMINAL) ===
elseif ($status == "Tunda") {

=== DARI FILE SEBENARNYA ===
            } elseif ($status == "Tunda") {

---------------------------

🔥 Kandidat Extract Method: S51 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
if (!$wisuda || $tahunAjaran <= $wisuda->year) {
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

=== DARI FILE SEBENARNYA ===
            if (!$wisuda || $tahunAjaran <= $wisuda->year) {

---------------------------

🔥 Kandidat Extract Method: S68 (jumlah dependency: 5)
=== POTONGAN KODE (TERMINAL) ===
if (empty($dpa_id)) {
$user_id = Auth::user()->id;
$dpa = Dpa::where('user_id', $user_id)->first();
$dpa_id = $dpa->id;
$dpa = Dpa::first();
$dpa_id = $dpa->id;

=== DARI FILE SEBENARNYA ===
        if (empty($dpa_id)) {
                $user_id = Auth::user()->id;
                $dpa = Dpa::where('user_id', $user_id)->first();
                $dpa_id = $dpa->id;
                $dpa = Dpa::first();
                $dpa_id = $dpa->id;

---------------------------

🔥 Kandidat Extract Method: S69 (jumlah dependency: 5)
=== POTONGAN KODE (TERMINAL) ===
if (Auth::user()->role == "DPA") {
$user_id = Auth::user()->id;
$dpa = Dpa::where('user_id', $user_id)->first();
$dpa_id = $dpa->id;
$dpa = Dpa::first();
$dpa_id = $dpa->id;

=== DARI FILE SEBENARNYA ===
            if (Auth::user()->role == "DPA") {
                $user_id = Auth::user()->id;
                $dpa = Dpa::where('user_id', $user_id)->first();
                $dpa_id = $dpa->id;
                $dpa = Dpa::first();
                $dpa_id = $dpa->id;

---------------------------

🔥 Kandidat Extract Method: S1 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
public function getMahasiswa(Request $request): View
$dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
$tahunAjaran = $request->year ?? date('Y');
$semester = $request->semester ?? 'GASAL';
if ($request->student_id) {
$dpa_id = $request->dpa_id;
$tahunAjaran = $request->year;
$semester = $request->semester;

=== DARI FILE SEBENARNYA ===
    public function getMahasiswa(Request $request): View
        $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
        $tahunAjaran = $request->year ?? date('Y');
        $semester = $request->semester ?? 'GASAL';
        if ($request->student_id) {
        $dpa_id = $request->dpa_id;
        $tahunAjaran = $request->year;
        $semester = $request->semester;

---------------------------

🔥 Kandidat Extract Method: S2 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
$students = Student::where('dpa_id', $dpa_id)->get();
$dpa_id = $request->dpa_id;
if (empty($dpa_id)) {
$dpa_id = $dpa->id;
$dpa_id = $dpa->id;
$dpa = Dpa::where('id', $dpa_id)->first();
$students = Student::where('dpa_id', $dpa_id)->get();

=== DARI FILE SEBENARNYA ===
        $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
        $students = Student::where('dpa_id', $dpa_id)->get();
        $dpa_id = $request->dpa_id;
        if (empty($dpa_id)) {
                $dpa_id = $dpa->id;
                $dpa_id = $dpa->id;
        $dpa = Dpa::where('id', $dpa_id)->first();
        $students = Student::where('dpa_id', $dpa_id)->get();

---------------------------

🔥 Kandidat Extract Method: S3 (jumlah dependency: 17)
=== POTONGAN KODE (TERMINAL) ===
$tahunAjaran = $request->year ?? date('Y');
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
$semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);
if (!$wisuda || $tahunAjaran <= $wisuda->year) {
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
$tahunAjaran = $request->year;
if (empty($tahunAjaran) || empty($semester)) {
$tahunAjaran = date('Y');
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $tahunAjaran = $request->year ?? date('Y');
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
            if (!$wisuda || $tahunAjaran <= $wisuda->year) {
        $tahunAjaran = $request->year;
        if (empty($tahunAjaran) || empty($semester)) {
            $tahunAjaran = date('Y');
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🔥 Kandidat Extract Method: S4 (jumlah dependency: 16)
=== POTONGAN KODE (TERMINAL) ===
$semester = $request->semester ?? 'GASAL';
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
$semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
$semester = $request->semester;
if (empty($tahunAjaran) || empty($semester)) {
$semester = "GASAL";
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $semester = $request->semester ?? 'GASAL';
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
        $semester = $request->semester;
        if (empty($tahunAjaran) || empty($semester)) {
            $semester = "GASAL";
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🔥 Kandidat Extract Method: S8 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
$data = [];
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
        $data = [];
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🔥 Kandidat Extract Method: S15 (jumlah dependency: 50)
=== POTONGAN KODE (TERMINAL) ===
$tahunAjaran = $request->year ?? date('Y');
$semester = $request->semester ?? 'GASAL';
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
if (empty($id)) {
$bimbinganStudy = BimbinganStudy::find($id);
$payment = Ukt::where('lbs_id', $id)->first();
if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
elseif ($status == "Tunda") {
if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {
elseif ($status == "Tunda") {
elseif ($status == "Tidak Aktif" && $id) {
$semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);
if (!$wisuda || $tahunAjaran <= $wisuda->year) {
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
$tahunAjaran = $request->year;
$semester = $request->semester;
if (empty($tahunAjaran) || empty($semester)) {
$tahunAjaran = date('Y');
$semester = "GASAL";
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $tahunAjaran = $request->year ?? date('Y');
        $semester = $request->semester ?? 'GASAL';
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
    public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
        if (empty($id)) {
            $bimbinganStudy = BimbinganStudy::find($id);
        $payment = Ukt::where('lbs_id', $id)->first();
            if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
            } elseif ($status == "Tunda") {
            if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {
            } elseif ($status == "Tunda") {
        } elseif ($status == "Tidak Aktif" && $id) {
            if (!$wisuda || $tahunAjaran <= $wisuda->year) {
        $tahunAjaran = $request->year;
        $semester = $request->semester;
        if (empty($tahunAjaran) || empty($semester)) {
            $tahunAjaran = date('Y');
            $semester = "GASAL";
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🔥 Kandidat Extract Method: S23 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
$bimbinganStudy = BimbinganStudy::find($id);
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

=== DARI FILE SEBENARNYA ===
            $bimbinganStudy = BimbinganStudy::find($id);

---------------------------

🔥 Kandidat Extract Method: S26 (jumlah dependency: 11)
=== POTONGAN KODE (TERMINAL) ===
$payment = Ukt::where('lbs_id', $id)->first();
if ($payment) {
$uts_id = $payment->exam_uts_id;
$uas_id = $payment->exam_uas_id;
if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {

=== DARI FILE SEBENARNYA ===
        $payment = Ukt::where('lbs_id', $id)->first();
        if ($payment) {
            $uts_id = $payment->exam_uts_id;
            $uas_id = $payment->exam_uas_id;
            if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
            if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {

---------------------------

🔥 Kandidat Extract Method: S28 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
$uts_id = $payment->exam_uts_id;
if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {

=== DARI FILE SEBENARNYA ===
            $uts_id = $payment->exam_uts_id;
            if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
            if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {

---------------------------

🔥 Kandidat Extract Method: S47 (jumlah dependency: 39)
=== POTONGAN KODE (TERMINAL) ===
$tahunAjaran = $request->year ?? date('Y');
$semester = $request->semester ?? 'GASAL';
$students = Student::where('dpa_id', $dpa_id)->get();
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
public function getBimbinganStudi($students, $tahunAjaran, $semester)
$semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);
if (!$wisuda || $tahunAjaran <= $wisuda->year) {
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
$tahunAjaran = $request->year;
$semester = $request->semester;
if (empty($tahunAjaran) || empty($semester)) {
$tahunAjaran = date('Y');
$semester = "GASAL";
$students = Student::where('dpa_id', $dpa_id)->get();
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $tahunAjaran = $request->year ?? date('Y');
        $semester = $request->semester ?? 'GASAL';
        $students = Student::where('dpa_id', $dpa_id)->get();
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
    public function getBimbinganStudi($students, $tahunAjaran, $semester)
            if (!$wisuda || $tahunAjaran <= $wisuda->year) {
        $tahunAjaran = $request->year;
        $semester = $request->semester;
        if (empty($tahunAjaran) || empty($semester)) {
            $tahunAjaran = date('Y');
            $semester = "GASAL";
        $students = Student::where('dpa_id', $dpa_id)->get();
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🔥 Kandidat Extract Method: S48 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
$data = [];
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
        $data = [];
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🔥 Kandidat Extract Method: S52 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
$bimbinganStudy = BimbinganStudy::find($id);
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

=== DARI FILE SEBENARNYA ===
            $bimbinganStudy = BimbinganStudy::find($id);

---------------------------

🔥 Kandidat Extract Method: S61 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
$dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
$tahunAjaran = $request->year ?? date('Y');
$semester = $request->semester ?? 'GASAL';
if ($request->student_id) {
public function export(Request $request)
$dpa_id = $request->dpa_id;
$tahunAjaran = $request->year;
$semester = $request->semester;

=== DARI FILE SEBENARNYA ===
        $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
        $tahunAjaran = $request->year ?? date('Y');
        $semester = $request->semester ?? 'GASAL';
        if ($request->student_id) {
    public function export(Request $request)
        $dpa_id = $request->dpa_id;
        $tahunAjaran = $request->year;
        $semester = $request->semester;

---------------------------

🔥 Kandidat Extract Method: S62 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
$students = Student::where('dpa_id', $dpa_id)->get();
$dpa_id = $request->dpa_id;
if (empty($dpa_id)) {
$dpa_id = $dpa->id;
$dpa_id = $dpa->id;
$dpa = Dpa::where('id', $dpa_id)->first();
$students = Student::where('dpa_id', $dpa_id)->get();

=== DARI FILE SEBENARNYA ===
        $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
        $students = Student::where('dpa_id', $dpa_id)->get();
        $dpa_id = $request->dpa_id;
        if (empty($dpa_id)) {
                $dpa_id = $dpa->id;
                $dpa_id = $dpa->id;
        $dpa = Dpa::where('id', $dpa_id)->first();
        $students = Student::where('dpa_id', $dpa_id)->get();

---------------------------

🔥 Kandidat Extract Method: S63 (jumlah dependency: 17)
=== POTONGAN KODE (TERMINAL) ===
$tahunAjaran = $request->year ?? date('Y');
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
$semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);
if (!$wisuda || $tahunAjaran <= $wisuda->year) {
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
$tahunAjaran = $request->year;
if (empty($tahunAjaran) || empty($semester)) {
$tahunAjaran = date('Y');
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $tahunAjaran = $request->year ?? date('Y');
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
            if (!$wisuda || $tahunAjaran <= $wisuda->year) {
        $tahunAjaran = $request->year;
        if (empty($tahunAjaran) || empty($semester)) {
            $tahunAjaran = date('Y');
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🔥 Kandidat Extract Method: S64 (jumlah dependency: 16)
=== POTONGAN KODE (TERMINAL) ===
$semester = $request->semester ?? 'GASAL';
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
$semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
$semester = $request->semester;
if (empty($tahunAjaran) || empty($semester)) {
$semester = "GASAL";
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $semester = $request->semester ?? 'GASAL';
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
        $semester = $request->semester;
        if (empty($tahunAjaran) || empty($semester)) {
            $semester = "GASAL";
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🔥 Kandidat Extract Method: S66 (jumlah dependency: 17)
=== POTONGAN KODE (TERMINAL) ===
$tahunAjaran = $request->year ?? date('Y');
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
$semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);
if (!$wisuda || $tahunAjaran <= $wisuda->year) {
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
$tahunAjaran = $request->year;
if (empty($tahunAjaran) || empty($semester)) {
$tahunAjaran = date('Y');
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $tahunAjaran = $request->year ?? date('Y');
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
            if (!$wisuda || $tahunAjaran <= $wisuda->year) {
        $tahunAjaran = $request->year;
        if (empty($tahunAjaran) || empty($semester)) {
            $tahunAjaran = date('Y');
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🔥 Kandidat Extract Method: S67 (jumlah dependency: 16)
=== POTONGAN KODE (TERMINAL) ===
$semester = $request->semester ?? 'GASAL';
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
$semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);
$bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
$semester = $request->semester;
if (empty($tahunAjaran) || empty($semester)) {
$semester = "GASAL";
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $semester = $request->semester ?? 'GASAL';
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
        $semester = $request->semester;
        if (empty($tahunAjaran) || empty($semester)) {
            $semester = "GASAL";
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🔥 Kandidat Extract Method: S71 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
$dpa = Dpa::where('user_id', $user_id)->first();
$dpa_id = $dpa->id;
$dpa = Dpa::first();
$dpa_id = $dpa->id;
$dpa = Dpa::where('id', $dpa_id)->first();

=== DARI FILE SEBENARNYA ===
                $dpa = Dpa::where('user_id', $user_id)->first();
                $dpa_id = $dpa->id;
                $dpa = Dpa::first();
                $dpa_id = $dpa->id;
        $dpa = Dpa::where('id', $dpa_id)->first();

---------------------------

🔥 Kandidat Extract Method: S72 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
$students = Student::where('dpa_id', $dpa_id)->get();
$dpa_id = $request->dpa_id;
if (empty($dpa_id)) {
$dpa_id = $dpa->id;
$dpa_id = $dpa->id;
$dpa = Dpa::where('id', $dpa_id)->first();
$students = Student::where('dpa_id', $dpa_id)->get();

=== DARI FILE SEBENARNYA ===
        $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
        $students = Student::where('dpa_id', $dpa_id)->get();
        $dpa_id = $request->dpa_id;
        if (empty($dpa_id)) {
                $dpa_id = $dpa->id;
                $dpa_id = $dpa->id;
        $dpa = Dpa::where('id', $dpa_id)->first();
        $students = Student::where('dpa_id', $dpa_id)->get();

---------------------------

🔥 Kandidat Extract Method: S73 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
$dpa = Dpa::where('user_id', $user_id)->first();
$dpa_id = $dpa->id;
$dpa = Dpa::first();
$dpa_id = $dpa->id;
$dpa = Dpa::where('id', $dpa_id)->first();

=== DARI FILE SEBENARNYA ===
                $dpa = Dpa::where('user_id', $user_id)->first();
                $dpa_id = $dpa->id;
                $dpa = Dpa::first();
                $dpa_id = $dpa->id;
        $dpa = Dpa::where('id', $dpa_id)->first();

---------------------------

🔥 Kandidat Extract Method: S74 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
$students = Student::where('dpa_id', $dpa_id)->get();
$dpa_id = $request->dpa_id;
if (empty($dpa_id)) {
$dpa_id = $dpa->id;
$dpa_id = $dpa->id;
$dpa = Dpa::where('id', $dpa_id)->first();
$students = Student::where('dpa_id', $dpa_id)->get();

=== DARI FILE SEBENARNYA ===
        $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
        $students = Student::where('dpa_id', $dpa_id)->get();
        $dpa_id = $request->dpa_id;
        if (empty($dpa_id)) {
                $dpa_id = $dpa->id;
                $dpa_id = $dpa->id;
        $dpa = Dpa::where('id', $dpa_id)->first();
        $students = Student::where('dpa_id', $dpa_id)->get();

---------------------------

🔥 Kandidat Extract Method: S75 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
$dpa = Dpa::where('user_id', $user_id)->first();
$dpa_id = $dpa->id;
$dpa = Dpa::first();
$dpa_id = $dpa->id;
$dpa = Dpa::where('id', $dpa_id)->first();

=== DARI FILE SEBENARNYA ===
                $dpa = Dpa::where('user_id', $user_id)->first();
                $dpa_id = $dpa->id;
                $dpa = Dpa::first();
                $dpa_id = $dpa->id;
        $dpa = Dpa::where('id', $dpa_id)->first();

---------------------------

🔥 Kandidat Extract Method: S77 (jumlah dependency: 8)
=== POTONGAN KODE (TERMINAL) ===
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
$data = [];
$data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

=== DARI FILE SEBENARNYA ===
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
        $data = [];
        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

---------------------------

🏁 Ranking Kandidat Extract Method Berdasarkan Jumlah Dependency:
1. S15 (Jumlah Dependency: 50)
2. S47 (Jumlah Dependency: 39)
3. S3 (Jumlah Dependency: 17)
4. S63 (Jumlah Dependency: 17)
5. S66 (Jumlah Dependency: 17)
6. S4 (Jumlah Dependency: 16)
7. S64 (Jumlah Dependency: 16)
8. S67 (Jumlah Dependency: 16)
9. S27 (Jumlah Dependency: 14)
10. S26 (Jumlah Dependency: 11)
11. S2 (Jumlah Dependency: 9)
12. S62 (Jumlah Dependency: 9)
13. S72 (Jumlah Dependency: 9)
14. S74 (Jumlah Dependency: 9)
15. S17 (Jumlah Dependency: 8)
16. S51 (Jumlah Dependency: 8)
17. S1 (Jumlah Dependency: 8)
18. S8 (Jumlah Dependency: 8)
19. S48 (Jumlah Dependency: 8)
20. S61 (Jumlah Dependency: 8)
21. S77 (Jumlah Dependency: 8)
22. S36 (Jumlah Dependency: 6)
23. S23 (Jumlah Dependency: 6)
24. S28 (Jumlah Dependency: 6)
25. S52 (Jumlah Dependency: 6)
26. S71 (Jumlah Dependency: 6)
27. S73 (Jumlah Dependency: 6)
28. S75 (Jumlah Dependency: 6)
29. S68 (Jumlah Dependency: 5)
30. S69 (Jumlah Dependency: 5)
31. S30 (Jumlah Dependency: 4)
32. S39 (Jumlah Dependency: 4)
