
--- Control Dependencies (Grouped & Ordered by Controller) ---
S6 → S7
  S6: if ($request->student_id) {
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S17 → S18
  S17: if (empty($id)) {
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S17 → S19
  S17: if (empty($id)) {
  S19  : 'students_id' => $student_id

S17 → S20
  S17: if (empty($id)) {
  S20  : 'year' => $tahunAjaran

S17 → S21
  S17: if (empty($id)) {
  S21  : 'semester' => $semester

S17 → S22
  S17: if (empty($id)) {
  S22  : 'status' => $status

S17 → S23
  S17: if (empty($id)) {
  S23  : $bimbinganStudy = BimbinganStudy::find($id);

S17 → S24
  S17: if (empty($id)) {
  S24  : $bimbinganStudy->status = $status;

S17 → S25
  S17: if (empty($id)) {
  S25  : $bimbinganStudy->save();

S27 → S28
  S27: if ($payment) {
  S28  : $uts_id = $payment->exam_uts_id;

S27 → S29
  S27: if ($payment) {
  S29  : $uas_id = $payment->exam_uas_id;

S27 → S31
  S27: if ($payment) {
  S31  : $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year);

S27 → S33
  S27: if ($payment) {
  S33  : ExamCard::destroy([$uts_id]);

S27 → S34
  S27: if ($payment) {
  S34  : $uts_id

S27 → S35
  S27: if ($payment) {
  S35  : $payment->exam_uts_id = null;

S27 → S37
  S27: if ($payment) {
  S37  : $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year);

S27 → S38
  S27: if ($payment) {
  S38  : $payment->exam_uas_id = $uktController->createExamCard($payment->students_id, "UAS", $payment->semester, $payment->year);

S27 → S40
  S27: if ($payment) {
  S40  : ExamCard::destroy([$uts_id, $uas_id]);

S27 → S41
  S27: if ($payment) {
  S41  : $uts_id

S27 → S42
  S27: if ($payment) {
  S42  : $uas_id

S27 → S43
  S27: if ($payment) {
  S43  : $payment->exam_uts_id = $payment->exam_uas_id = null;

S27 → S44
  S27: if ($payment) {
  S44  : $payment->save();

S27 → S46
  S27: if ($payment) {
  S46  : BimbinganStudy::destroy($id);

S30 → S31
  S30: if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
  S31  : $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year);

S30 → S33
  S30: if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
  S33  : ExamCard::destroy([$uts_id]);

S30 → S34
  S30: if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
  S34  : $uts_id

S30 → S35
  S30: if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {
  S35  : $payment->exam_uts_id = null;

S32 → S33
  S32: elseif ($status == "Tunda") {
  S33  : ExamCard::destroy([$uts_id]);

S32 → S34
  S32: elseif ($status == "Tunda") {
  S34  : $uts_id

S32 → S35
  S32: elseif ($status == "Tunda") {
  S35  : $payment->exam_uts_id = null;

S36 → S37
  S36: if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {
  S37  : $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year);

S36 → S38
  S36: if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {
  S38  : $payment->exam_uas_id = $uktController->createExamCard($payment->students_id, "UAS", $payment->semester, $payment->year);

S36 → S40
  S36: if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {
  S40  : ExamCard::destroy([$uts_id, $uas_id]);

S36 → S41
  S36: if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {
  S41  : $uts_id

S36 → S42
  S36: if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {
  S42  : $uas_id

S36 → S43
  S36: if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {
  S43  : $payment->exam_uts_id = $payment->exam_uas_id = null;

S39 → S40
  S39: elseif ($status == "Tunda") {
  S40  : ExamCard::destroy([$uts_id, $uas_id]);

S39 → S41
  S39: elseif ($status == "Tunda") {
  S41  : $uts_id

S39 → S42
  S39: elseif ($status == "Tunda") {
  S42  : $uas_id

S39 → S43
  S39: elseif ($status == "Tunda") {
  S43  : $payment->exam_uts_id = $payment->exam_uas_id = null;

S45 → S46
  S45: elseif ($status == "Tidak Aktif" && $id) {
  S46  : BimbinganStudy::destroy($id);

S51 → S52
  S51: if (!$wisuda || $tahunAjaran <= $wisuda->year) {
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S51 → S53
  S51: if (!$wisuda || $tahunAjaran <= $wisuda->year) {
  S53  : $data[$item->id] = ['id' => $item->id, 'nim' => $item->nim, 'name' => $item->name, 'semester' => $semesterStudent, 'lbs_id' => $bimbinganStudy->id ?? null, 'status' => $bimbinganStudy->status ?? "Tidak Aktif"];

S51 → S54
  S51: if (!$wisuda || $tahunAjaran <= $wisuda->year) {
  S54  : 'id' => $item->id

S51 → S55
  S51: if (!$wisuda || $tahunAjaran <= $wisuda->year) {
  S55  : 'nim' => $item->nim

S51 → S56
  S51: if (!$wisuda || $tahunAjaran <= $wisuda->year) {
  S56  : 'name' => $item->name

S51 → S57
  S51: if (!$wisuda || $tahunAjaran <= $wisuda->year) {
  S57  : 'semester' => $semesterStudent

S51 → S58
  S51: if (!$wisuda || $tahunAjaran <= $wisuda->year) {
  S58  : 'lbs_id' => $bimbinganStudy->id ?? null

S51 → S59
  S51: if (!$wisuda || $tahunAjaran <= $wisuda->year) {
  S59  : 'status' => $bimbinganStudy->status ?? "Tidak Aktif"

S65 → S66
  S65: if (empty($tahunAjaran) || empty($semester)) {
  S66  : $tahunAjaran = date('Y');

S65 → S67
  S65: if (empty($tahunAjaran) || empty($semester)) {
  S67  : $semester = "GASAL";

S68 → S70
  S68: if (empty($dpa_id)) {
  S70  : $user_id = Auth::user()->id;

S68 → S71
  S68: if (empty($dpa_id)) {
  S71  : $dpa = Dpa::where('user_id', $user_id)->first();

S68 → S72
  S68: if (empty($dpa_id)) {
  S72  : $dpa_id = $dpa->id;

S68 → S73
  S68: if (empty($dpa_id)) {
  S73  : $dpa = Dpa::first();

S68 → S74
  S68: if (empty($dpa_id)) {
  S74  : $dpa_id = $dpa->id;

S69 → S70
  S69: if (Auth::user()->role == "DPA") {
  S70  : $user_id = Auth::user()->id;

S69 → S71
  S69: if (Auth::user()->role == "DPA") {
  S71  : $dpa = Dpa::where('user_id', $user_id)->first();

S69 → S72
  S69: if (Auth::user()->role == "DPA") {
  S72  : $dpa_id = $dpa->id;

S69 → S73
  S69: if (Auth::user()->role == "DPA") {
  S73  : $dpa = Dpa::first();

S69 → S74
  S69: if (Auth::user()->role == "DPA") {
  S74  : $dpa_id = $dpa->id;


--- Data Dependencies (Grouped & Ordered by Definer) ---
S1 → S2 [$request]
  S1: public function getMahasiswa(Request $request): View
  S2  : $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;

S1 → S3 [$request]
  S1: public function getMahasiswa(Request $request): View
  S3  : $tahunAjaran = $request->year ?? date('Y');

S1 → S4 [$request]
  S1: public function getMahasiswa(Request $request): View
  S4  : $semester = $request->semester ?? 'GASAL';

S1 → S6 [$request]
  S1: public function getMahasiswa(Request $request): View
  S6  : if ($request->student_id) {

S1 → S7 [$request]
  S1: public function getMahasiswa(Request $request): View
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S1 → S62 [$request]
  S1: public function getMahasiswa(Request $request): View
  S62  : $dpa_id = $request->dpa_id;

S1 → S63 [$request]
  S1: public function getMahasiswa(Request $request): View
  S63  : $tahunAjaran = $request->year;

S1 → S64 [$request]
  S1: public function getMahasiswa(Request $request): View
  S64  : $semester = $request->semester;

S2 → S5 [$dpa_id]
  S2: $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
  S5  : $students = Student::where('dpa_id', $dpa_id)->get();

S2 → S9 [$dpa_id]
  S2: $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S2 → S14 [$dpa_id]
  S2: $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
  S14  : 'dpa' => Dpa::find($dpa_id)

S2 → S62 [$dpa_id]
  S2: $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
  S62  : $dpa_id = $request->dpa_id;

S2 → S68 [$dpa_id]
  S2: $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
  S68  : if (empty($dpa_id)) {

S2 → S72 [$dpa_id]
  S2: $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
  S72  : $dpa_id = $dpa->id;

S2 → S74 [$dpa_id]
  S2: $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
  S74  : $dpa_id = $dpa->id;

S2 → S75 [$dpa_id]
  S2: $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
  S75  : $dpa = Dpa::where('id', $dpa_id)->first();

S2 → S76 [$dpa_id]
  S2: $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;
  S76  : $students = Student::where('dpa_id', $dpa_id)->get();

S3 → S7 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S3 → S8 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S3 → S9 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S3 → S11 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S11  : 'tahunAjaran' => [$tahunAjaran, $semester]

S3 → S12 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S12  : $tahunAjaran

S3 → S18 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S3 → S20 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S20  : 'year' => $tahunAjaran

S3 → S50 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S50  : $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);

S3 → S51 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S51  : if (!$wisuda || $tahunAjaran <= $wisuda->year) {

S3 → S52 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S3 → S63 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S63  : $tahunAjaran = $request->year;

S3 → S65 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S65  : if (empty($tahunAjaran) || empty($semester)) {

S3 → S66 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S66  : $tahunAjaran = date('Y');

S3 → S77 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S3 → S78 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S3 → S80 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S80  : 'tahunAjaran' => [$tahunAjaran, $semester]

S3 → S81 [$tahunAjaran]
  S3: $tahunAjaran = $request->year ?? date('Y');
  S81  : $tahunAjaran

S4 → S7 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S4 → S8 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S4 → S9 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S4 → S11 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S11  : 'tahunAjaran' => [$tahunAjaran, $semester]

S4 → S13 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S13  : $semester

S4 → S18 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S4 → S21 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S21  : 'semester' => $semester

S4 → S50 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S50  : $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);

S4 → S52 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S4 → S64 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S64  : $semester = $request->semester;

S4 → S65 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S65  : if (empty($tahunAjaran) || empty($semester)) {

S4 → S67 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S67  : $semester = "GASAL";

S4 → S77 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S4 → S78 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S4 → S80 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S80  : 'tahunAjaran' => [$tahunAjaran, $semester]

S4 → S82 [$semester]
  S4: $semester = $request->semester ?? 'GASAL';
  S82  : $semester

S5 → S8 [$students]
  S5: $students = Student::where('dpa_id', $dpa_id)->get();
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S5 → S76 [$students]
  S5: $students = Student::where('dpa_id', $dpa_id)->get();
  S76  : $students = Student::where('dpa_id', $dpa_id)->get();

S5 → S77 [$students]
  S5: $students = Student::where('dpa_id', $dpa_id)->get();
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S8 → S9 [$data]
  S8: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S8 → S10 [$data]
  S8: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S10  : 'data' => $data

S8 → S48 [$data]
  S8: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S48  : $data = [];

S8 → S53 [$data]
  S8: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S53  : $data[$item->id] = ['id' => $item->id, 'nim' => $item->nim, 'name' => $item->name, 'semester' => $semesterStudent, 'lbs_id' => $bimbinganStudy->id ?? null, 'status' => $bimbinganStudy->status ?? "Tidak Aktif"];

S8 → S60 [$data]
  S8: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S60  : return $data;

S8 → S77 [$data]
  S8: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S8 → S78 [$data]
  S8: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S8 → S79 [$data]
  S8: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S79  : 'data' => $data

S15 → S3 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S3  : $tahunAjaran = $request->year ?? date('Y');

S15 → S4 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S4  : $semester = $request->semester ?? 'GASAL';

S15 → S7 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S15 → S7 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S15 → S8 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S15 → S8 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S15 → S9 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S15 → S9 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S15 → S11 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S11  : 'tahunAjaran' => [$tahunAjaran, $semester]

S15 → S11 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S11  : 'tahunAjaran' => [$tahunAjaran, $semester]

S15 → S12 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S12  : $tahunAjaran

S15 → S13 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S13  : $semester

S15 → S17 [$id]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S17  : if (empty($id)) {

S15 → S18 [$student_id]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S15 → S18 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S15 → S18 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S15 → S18 [$status]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S15 → S19 [$student_id]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S19  : 'students_id' => $student_id

S15 → S20 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S20  : 'year' => $tahunAjaran

S15 → S21 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S21  : 'semester' => $semester

S15 → S22 [$status]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S22  : 'status' => $status

S15 → S23 [$id]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S23  : $bimbinganStudy = BimbinganStudy::find($id);

S15 → S24 [$status]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S24  : $bimbinganStudy->status = $status;

S15 → S26 [$id]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S26  : $payment = Ukt::where('lbs_id', $id)->first();

S15 → S30 [$status]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S30  : if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {

S15 → S32 [$status]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S32  : elseif ($status == "Tunda") {

S15 → S36 [$status]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S36  : if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {

S15 → S39 [$status]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S39  : elseif ($status == "Tunda") {

S15 → S45 [$status]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S45  : elseif ($status == "Tidak Aktif" && $id) {

S15 → S45 [$id]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S45  : elseif ($status == "Tidak Aktif" && $id) {

S15 → S46 [$id]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S46  : BimbinganStudy::destroy($id);

S15 → S50 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S50  : $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);

S15 → S50 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S50  : $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);

S15 → S51 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S51  : if (!$wisuda || $tahunAjaran <= $wisuda->year) {

S15 → S52 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S15 → S52 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S15 → S63 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S63  : $tahunAjaran = $request->year;

S15 → S64 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S64  : $semester = $request->semester;

S15 → S65 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S65  : if (empty($tahunAjaran) || empty($semester)) {

S15 → S65 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S65  : if (empty($tahunAjaran) || empty($semester)) {

S15 → S66 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S66  : $tahunAjaran = date('Y');

S15 → S67 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S67  : $semester = "GASAL";

S15 → S77 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S15 → S77 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S15 → S78 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S15 → S78 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S15 → S80 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S80  : 'tahunAjaran' => [$tahunAjaran, $semester]

S15 → S80 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S80  : 'tahunAjaran' => [$tahunAjaran, $semester]

S15 → S81 [$tahunAjaran]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S81  : $tahunAjaran

S15 → S82 [$semester]
  S15: public function setujuKrs($id, $status, $student_id, $tahunAjaran, $semester)
  S82  : $semester

S16 → S31 [$uktController]
  S16: $uktController = new UktController();
  S31  : $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year);

S16 → S37 [$uktController]
  S16: $uktController = new UktController();
  S37  : $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year);

S16 → S38 [$uktController]
  S16: $uktController = new UktController();
  S38  : $payment->exam_uas_id = $uktController->createExamCard($payment->students_id, "UAS", $payment->semester, $payment->year);

S23 → S24 [$bimbinganStudy]
  S23: $bimbinganStudy = BimbinganStudy::find($id);
  S24  : $bimbinganStudy->status = $status;

S23 → S25 [$bimbinganStudy]
  S23: $bimbinganStudy = BimbinganStudy::find($id);
  S25  : $bimbinganStudy->save();

S23 → S52 [$bimbinganStudy]
  S23: $bimbinganStudy = BimbinganStudy::find($id);
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S23 → S53 [$bimbinganStudy]
  S23: $bimbinganStudy = BimbinganStudy::find($id);
  S53  : $data[$item->id] = ['id' => $item->id, 'nim' => $item->nim, 'name' => $item->name, 'semester' => $semesterStudent, 'lbs_id' => $bimbinganStudy->id ?? null, 'status' => $bimbinganStudy->status ?? "Tidak Aktif"];

S23 → S58 [$bimbinganStudy]
  S23: $bimbinganStudy = BimbinganStudy::find($id);
  S58  : 'lbs_id' => $bimbinganStudy->id ?? null

S23 → S59 [$bimbinganStudy]
  S23: $bimbinganStudy = BimbinganStudy::find($id);
  S59  : 'status' => $bimbinganStudy->status ?? "Tidak Aktif"

S26 → S27 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S27  : if ($payment) {

S26 → S28 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S28  : $uts_id = $payment->exam_uts_id;

S26 → S29 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S29  : $uas_id = $payment->exam_uas_id;

S26 → S30 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S30  : if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {

S26 → S31 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S31  : $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year);

S26 → S35 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S35  : $payment->exam_uts_id = null;

S26 → S36 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S36  : if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {

S26 → S37 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S37  : $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year);

S26 → S38 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S38  : $payment->exam_uas_id = $uktController->createExamCard($payment->students_id, "UAS", $payment->semester, $payment->year);

S26 → S43 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S43  : $payment->exam_uts_id = $payment->exam_uas_id = null;

S26 → S44 [$payment]
  S26: $payment = Ukt::where('lbs_id', $id)->first();
  S44  : $payment->save();

S28 → S30 [$uts_id]
  S28: $uts_id = $payment->exam_uts_id;
  S30  : if ($payment->status == "Lunas UTS" && $status == "Aktif" && !$uts_id) {

S28 → S33 [$uts_id]
  S28: $uts_id = $payment->exam_uts_id;
  S33  : ExamCard::destroy([$uts_id]);

S28 → S34 [$uts_id]
  S28: $uts_id = $payment->exam_uts_id;
  S34  : $uts_id

S28 → S36 [$uts_id]
  S28: $uts_id = $payment->exam_uts_id;
  S36  : if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {

S28 → S40 [$uts_id]
  S28: $uts_id = $payment->exam_uts_id;
  S40  : ExamCard::destroy([$uts_id, $uas_id]);

S28 → S41 [$uts_id]
  S28: $uts_id = $payment->exam_uts_id;
  S41  : $uts_id

S29 → S36 [$uas_id]
  S29: $uas_id = $payment->exam_uas_id;
  S36  : if ($payment->status == "Lunas" && $status == "Aktif" && !$uts_id && !$uas_id) {

S29 → S40 [$uas_id]
  S29: $uas_id = $payment->exam_uas_id;
  S40  : ExamCard::destroy([$uts_id, $uas_id]);

S29 → S42 [$uas_id]
  S29: $uas_id = $payment->exam_uas_id;
  S42  : $uas_id

S47 → S3 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S3  : $tahunAjaran = $request->year ?? date('Y');

S47 → S4 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S4  : $semester = $request->semester ?? 'GASAL';

S47 → S5 [$students]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S5  : $students = Student::where('dpa_id', $dpa_id)->get();

S47 → S7 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S47 → S7 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S47 → S8 [$students]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S47 → S8 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S47 → S8 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S47 → S9 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S47 → S9 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S47 → S11 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S11  : 'tahunAjaran' => [$tahunAjaran, $semester]

S47 → S11 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S11  : 'tahunAjaran' => [$tahunAjaran, $semester]

S47 → S12 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S12  : $tahunAjaran

S47 → S13 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S13  : $semester

S47 → S18 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S47 → S18 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S47 → S20 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S20  : 'year' => $tahunAjaran

S47 → S21 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S21  : 'semester' => $semester

S47 → S50 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S50  : $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);

S47 → S50 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S50  : $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);

S47 → S51 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S51  : if (!$wisuda || $tahunAjaran <= $wisuda->year) {

S47 → S52 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S47 → S52 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S47 → S63 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S63  : $tahunAjaran = $request->year;

S47 → S64 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S64  : $semester = $request->semester;

S47 → S65 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S65  : if (empty($tahunAjaran) || empty($semester)) {

S47 → S65 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S65  : if (empty($tahunAjaran) || empty($semester)) {

S47 → S66 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S66  : $tahunAjaran = date('Y');

S47 → S67 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S67  : $semester = "GASAL";

S47 → S76 [$students]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S76  : $students = Student::where('dpa_id', $dpa_id)->get();

S47 → S77 [$students]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S47 → S77 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S47 → S77 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S47 → S78 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S47 → S78 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S47 → S80 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S80  : 'tahunAjaran' => [$tahunAjaran, $semester]

S47 → S80 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S80  : 'tahunAjaran' => [$tahunAjaran, $semester]

S47 → S81 [$tahunAjaran]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S81  : $tahunAjaran

S47 → S82 [$semester]
  S47: public function getBimbinganStudi($students, $tahunAjaran, $semester)
  S82  : $semester

S48 → S8 [$data]
  S48: $data = [];
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S48 → S9 [$data]
  S48: $data = [];
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S48 → S10 [$data]
  S48: $data = [];
  S10  : 'data' => $data

S48 → S53 [$data]
  S48: $data = [];
  S53  : $data[$item->id] = ['id' => $item->id, 'nim' => $item->nim, 'name' => $item->name, 'semester' => $semesterStudent, 'lbs_id' => $bimbinganStudy->id ?? null, 'status' => $bimbinganStudy->status ?? "Tidak Aktif"];

S48 → S60 [$data]
  S48: $data = [];
  S60  : return $data;

S48 → S77 [$data]
  S48: $data = [];
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S48 → S78 [$data]
  S48: $data = [];
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S48 → S79 [$data]
  S48: $data = [];
  S79  : 'data' => $data

S49 → S51 [$wisuda]
  S49: $wisuda = Ukt::where('students_id', $item->id)->where('type', "WISUDA")->first();
  S51  : if (!$wisuda || $tahunAjaran <= $wisuda->year) {

S50 → S53 [$semesterStudent]
  S50: $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);
  S53  : $data[$item->id] = ['id' => $item->id, 'nim' => $item->nim, 'name' => $item->name, 'semester' => $semesterStudent, 'lbs_id' => $bimbinganStudy->id ?? null, 'status' => $bimbinganStudy->status ?? "Tidak Aktif"];

S50 → S57 [$semesterStudent]
  S50: $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);
  S57  : 'semester' => $semesterStudent

S52 → S23 [$bimbinganStudy]
  S52: $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
  S23  : $bimbinganStudy = BimbinganStudy::find($id);

S52 → S24 [$bimbinganStudy]
  S52: $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
  S24  : $bimbinganStudy->status = $status;

S52 → S25 [$bimbinganStudy]
  S52: $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
  S25  : $bimbinganStudy->save();

S52 → S53 [$bimbinganStudy]
  S52: $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
  S53  : $data[$item->id] = ['id' => $item->id, 'nim' => $item->nim, 'name' => $item->name, 'semester' => $semesterStudent, 'lbs_id' => $bimbinganStudy->id ?? null, 'status' => $bimbinganStudy->status ?? "Tidak Aktif"];

S52 → S58 [$bimbinganStudy]
  S52: $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
  S58  : 'lbs_id' => $bimbinganStudy->id ?? null

S52 → S59 [$bimbinganStudy]
  S52: $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
  S59  : 'status' => $bimbinganStudy->status ?? "Tidak Aktif"

S61 → S2 [$request]
  S61: public function export(Request $request)
  S2  : $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;

S61 → S3 [$request]
  S61: public function export(Request $request)
  S3  : $tahunAjaran = $request->year ?? date('Y');

S61 → S4 [$request]
  S61: public function export(Request $request)
  S4  : $semester = $request->semester ?? 'GASAL';

S61 → S6 [$request]
  S61: public function export(Request $request)
  S6  : if ($request->student_id) {

S61 → S7 [$request]
  S61: public function export(Request $request)
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S61 → S62 [$request]
  S61: public function export(Request $request)
  S62  : $dpa_id = $request->dpa_id;

S61 → S63 [$request]
  S61: public function export(Request $request)
  S63  : $tahunAjaran = $request->year;

S61 → S64 [$request]
  S61: public function export(Request $request)
  S64  : $semester = $request->semester;

S62 → S2 [$dpa_id]
  S62: $dpa_id = $request->dpa_id;
  S2  : $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;

S62 → S5 [$dpa_id]
  S62: $dpa_id = $request->dpa_id;
  S5  : $students = Student::where('dpa_id', $dpa_id)->get();

S62 → S9 [$dpa_id]
  S62: $dpa_id = $request->dpa_id;
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S62 → S14 [$dpa_id]
  S62: $dpa_id = $request->dpa_id;
  S14  : 'dpa' => Dpa::find($dpa_id)

S62 → S68 [$dpa_id]
  S62: $dpa_id = $request->dpa_id;
  S68  : if (empty($dpa_id)) {

S62 → S72 [$dpa_id]
  S62: $dpa_id = $request->dpa_id;
  S72  : $dpa_id = $dpa->id;

S62 → S74 [$dpa_id]
  S62: $dpa_id = $request->dpa_id;
  S74  : $dpa_id = $dpa->id;

S62 → S75 [$dpa_id]
  S62: $dpa_id = $request->dpa_id;
  S75  : $dpa = Dpa::where('id', $dpa_id)->first();

S62 → S76 [$dpa_id]
  S62: $dpa_id = $request->dpa_id;
  S76  : $students = Student::where('dpa_id', $dpa_id)->get();

S63 → S3 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S3  : $tahunAjaran = $request->year ?? date('Y');

S63 → S7 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S63 → S8 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S63 → S9 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S63 → S11 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S11  : 'tahunAjaran' => [$tahunAjaran, $semester]

S63 → S12 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S12  : $tahunAjaran

S63 → S18 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S63 → S20 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S20  : 'year' => $tahunAjaran

S63 → S50 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S50  : $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);

S63 → S51 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S51  : if (!$wisuda || $tahunAjaran <= $wisuda->year) {

S63 → S52 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S63 → S65 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S65  : if (empty($tahunAjaran) || empty($semester)) {

S63 → S66 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S66  : $tahunAjaran = date('Y');

S63 → S77 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S63 → S78 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S63 → S80 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S80  : 'tahunAjaran' => [$tahunAjaran, $semester]

S63 → S81 [$tahunAjaran]
  S63: $tahunAjaran = $request->year;
  S81  : $tahunAjaran

S64 → S4 [$semester]
  S64: $semester = $request->semester;
  S4  : $semester = $request->semester ?? 'GASAL';

S64 → S7 [$semester]
  S64: $semester = $request->semester;
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S64 → S8 [$semester]
  S64: $semester = $request->semester;
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S64 → S9 [$semester]
  S64: $semester = $request->semester;
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S64 → S11 [$semester]
  S64: $semester = $request->semester;
  S11  : 'tahunAjaran' => [$tahunAjaran, $semester]

S64 → S13 [$semester]
  S64: $semester = $request->semester;
  S13  : $semester

S64 → S18 [$semester]
  S64: $semester = $request->semester;
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S64 → S21 [$semester]
  S64: $semester = $request->semester;
  S21  : 'semester' => $semester

S64 → S50 [$semester]
  S64: $semester = $request->semester;
  S50  : $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);

S64 → S52 [$semester]
  S64: $semester = $request->semester;
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S64 → S65 [$semester]
  S64: $semester = $request->semester;
  S65  : if (empty($tahunAjaran) || empty($semester)) {

S64 → S67 [$semester]
  S64: $semester = $request->semester;
  S67  : $semester = "GASAL";

S64 → S77 [$semester]
  S64: $semester = $request->semester;
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S64 → S78 [$semester]
  S64: $semester = $request->semester;
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S64 → S80 [$semester]
  S64: $semester = $request->semester;
  S80  : 'tahunAjaran' => [$tahunAjaran, $semester]

S64 → S82 [$semester]
  S64: $semester = $request->semester;
  S82  : $semester

S66 → S3 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S3  : $tahunAjaran = $request->year ?? date('Y');

S66 → S7 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S66 → S8 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S66 → S9 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S66 → S11 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S11  : 'tahunAjaran' => [$tahunAjaran, $semester]

S66 → S12 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S12  : $tahunAjaran

S66 → S18 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S66 → S20 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S20  : 'year' => $tahunAjaran

S66 → S50 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S50  : $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);

S66 → S51 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S51  : if (!$wisuda || $tahunAjaran <= $wisuda->year) {

S66 → S52 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S66 → S63 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S63  : $tahunAjaran = $request->year;

S66 → S65 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S65  : if (empty($tahunAjaran) || empty($semester)) {

S66 → S77 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S66 → S78 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S66 → S80 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S80  : 'tahunAjaran' => [$tahunAjaran, $semester]

S66 → S81 [$tahunAjaran]
  S66: $tahunAjaran = date('Y');
  S81  : $tahunAjaran

S67 → S4 [$semester]
  S67: $semester = "GASAL";
  S4  : $semester = $request->semester ?? 'GASAL';

S67 → S7 [$semester]
  S67: $semester = "GASAL";
  S7  : $this->setujuKrs($request->lbs_id, $request->status, $request->student_id, $tahunAjaran, $semester);

S67 → S8 [$semester]
  S67: $semester = "GASAL";
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S67 → S9 [$semester]
  S67: $semester = "GASAL";
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S67 → S11 [$semester]
  S67: $semester = "GASAL";
  S11  : 'tahunAjaran' => [$tahunAjaran, $semester]

S67 → S13 [$semester]
  S67: $semester = "GASAL";
  S13  : $semester

S67 → S18 [$semester]
  S67: $semester = "GASAL";
  S18  : BimbinganStudy::create(['students_id' => $student_id, 'year' => $tahunAjaran, 'semester' => $semester, 'status' => $status]);

S67 → S21 [$semester]
  S67: $semester = "GASAL";
  S21  : 'semester' => $semester

S67 → S50 [$semester]
  S67: $semester = "GASAL";
  S50  : $semesterStudent = ($tahunAjaran - $item->force) * 2 + ($semester === "GASAL" ? 1 : 2);

S67 → S52 [$semester]
  S67: $semester = "GASAL";
  S52  : $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();

S67 → S64 [$semester]
  S67: $semester = "GASAL";
  S64  : $semester = $request->semester;

S67 → S65 [$semester]
  S67: $semester = "GASAL";
  S65  : if (empty($tahunAjaran) || empty($semester)) {

S67 → S77 [$semester]
  S67: $semester = "GASAL";
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S67 → S78 [$semester]
  S67: $semester = "GASAL";
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S67 → S80 [$semester]
  S67: $semester = "GASAL";
  S80  : 'tahunAjaran' => [$tahunAjaran, $semester]

S67 → S82 [$semester]
  S67: $semester = "GASAL";
  S82  : $semester

S70 → S71 [$user_id]
  S70: $user_id = Auth::user()->id;
  S71  : $dpa = Dpa::where('user_id', $user_id)->first();

S71 → S72 [$dpa]
  S71: $dpa = Dpa::where('user_id', $user_id)->first();
  S72  : $dpa_id = $dpa->id;

S71 → S73 [$dpa]
  S71: $dpa = Dpa::where('user_id', $user_id)->first();
  S73  : $dpa = Dpa::first();

S71 → S74 [$dpa]
  S71: $dpa = Dpa::where('user_id', $user_id)->first();
  S74  : $dpa_id = $dpa->id;

S71 → S75 [$dpa]
  S71: $dpa = Dpa::where('user_id', $user_id)->first();
  S75  : $dpa = Dpa::where('id', $dpa_id)->first();

S71 → S78 [$dpa]
  S71: $dpa = Dpa::where('user_id', $user_id)->first();
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S71 → S83 [$dpa]
  S71: $dpa = Dpa::where('user_id', $user_id)->first();
  S83  : 'dpa' => $dpa

S72 → S2 [$dpa_id]
  S72: $dpa_id = $dpa->id;
  S2  : $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;

S72 → S5 [$dpa_id]
  S72: $dpa_id = $dpa->id;
  S5  : $students = Student::where('dpa_id', $dpa_id)->get();

S72 → S9 [$dpa_id]
  S72: $dpa_id = $dpa->id;
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S72 → S14 [$dpa_id]
  S72: $dpa_id = $dpa->id;
  S14  : 'dpa' => Dpa::find($dpa_id)

S72 → S62 [$dpa_id]
  S72: $dpa_id = $dpa->id;
  S62  : $dpa_id = $request->dpa_id;

S72 → S68 [$dpa_id]
  S72: $dpa_id = $dpa->id;
  S68  : if (empty($dpa_id)) {

S72 → S74 [$dpa_id]
  S72: $dpa_id = $dpa->id;
  S74  : $dpa_id = $dpa->id;

S72 → S75 [$dpa_id]
  S72: $dpa_id = $dpa->id;
  S75  : $dpa = Dpa::where('id', $dpa_id)->first();

S72 → S76 [$dpa_id]
  S72: $dpa_id = $dpa->id;
  S76  : $students = Student::where('dpa_id', $dpa_id)->get();

S73 → S71 [$dpa]
  S73: $dpa = Dpa::first();
  S71  : $dpa = Dpa::where('user_id', $user_id)->first();

S73 → S72 [$dpa]
  S73: $dpa = Dpa::first();
  S72  : $dpa_id = $dpa->id;

S73 → S74 [$dpa]
  S73: $dpa = Dpa::first();
  S74  : $dpa_id = $dpa->id;

S73 → S75 [$dpa]
  S73: $dpa = Dpa::first();
  S75  : $dpa = Dpa::where('id', $dpa_id)->first();

S73 → S78 [$dpa]
  S73: $dpa = Dpa::first();
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S73 → S83 [$dpa]
  S73: $dpa = Dpa::first();
  S83  : 'dpa' => $dpa

S74 → S2 [$dpa_id]
  S74: $dpa_id = $dpa->id;
  S2  : $dpa_id = $request->dpa_id ?? Auth::user()->dpa->id ?? Dpa::first()->id;

S74 → S5 [$dpa_id]
  S74: $dpa_id = $dpa->id;
  S5  : $students = Student::where('dpa_id', $dpa_id)->get();

S74 → S9 [$dpa_id]
  S74: $dpa_id = $dpa->id;
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S74 → S14 [$dpa_id]
  S74: $dpa_id = $dpa->id;
  S14  : 'dpa' => Dpa::find($dpa_id)

S74 → S62 [$dpa_id]
  S74: $dpa_id = $dpa->id;
  S62  : $dpa_id = $request->dpa_id;

S74 → S68 [$dpa_id]
  S74: $dpa_id = $dpa->id;
  S68  : if (empty($dpa_id)) {

S74 → S72 [$dpa_id]
  S74: $dpa_id = $dpa->id;
  S72  : $dpa_id = $dpa->id;

S74 → S75 [$dpa_id]
  S74: $dpa_id = $dpa->id;
  S75  : $dpa = Dpa::where('id', $dpa_id)->first();

S74 → S76 [$dpa_id]
  S74: $dpa_id = $dpa->id;
  S76  : $students = Student::where('dpa_id', $dpa_id)->get();

S75 → S71 [$dpa]
  S75: $dpa = Dpa::where('id', $dpa_id)->first();
  S71  : $dpa = Dpa::where('user_id', $user_id)->first();

S75 → S72 [$dpa]
  S75: $dpa = Dpa::where('id', $dpa_id)->first();
  S72  : $dpa_id = $dpa->id;

S75 → S73 [$dpa]
  S75: $dpa = Dpa::where('id', $dpa_id)->first();
  S73  : $dpa = Dpa::first();

S75 → S74 [$dpa]
  S75: $dpa = Dpa::where('id', $dpa_id)->first();
  S74  : $dpa_id = $dpa->id;

S75 → S78 [$dpa]
  S75: $dpa = Dpa::where('id', $dpa_id)->first();
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S75 → S83 [$dpa]
  S75: $dpa = Dpa::where('id', $dpa_id)->first();
  S83  : 'dpa' => $dpa

S76 → S5 [$students]
  S76: $students = Student::where('dpa_id', $dpa_id)->get();
  S5  : $students = Student::where('dpa_id', $dpa_id)->get();

S76 → S8 [$students]
  S76: $students = Student::where('dpa_id', $dpa_id)->get();
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S76 → S77 [$students]
  S76: $students = Student::where('dpa_id', $dpa_id)->get();
  S77  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S77 → S8 [$data]
  S77: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S8  : $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

S77 → S9 [$data]
  S77: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S9  : return view('dpa.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => Dpa::find($dpa_id)]);

S77 → S10 [$data]
  S77: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S10  : 'data' => $data

S77 → S48 [$data]
  S77: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S48  : $data = [];

S77 → S53 [$data]
  S77: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S53  : $data[$item->id] = ['id' => $item->id, 'nim' => $item->nim, 'name' => $item->name, 'semester' => $semesterStudent, 'lbs_id' => $bimbinganStudy->id ?? null, 'status' => $bimbinganStudy->status ?? "Tidak Aktif"];

S77 → S60 [$data]
  S77: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S60  : return $data;

S77 → S78 [$data]
  S77: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S78  : return view('report.printformat.daftarmahasiswa')->with(['data' => $data, 'tahunAjaran' => [$tahunAjaran, $semester], 'dpa' => $dpa, 'title' => "Lembar Bimbingan Studi", 'today' => date('d F Y', strtotime(date('Y-m-d')))]);

S77 → S79 [$data]
  S77: $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);
  S79  : 'data' => $data

