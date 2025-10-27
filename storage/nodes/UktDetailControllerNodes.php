
--- Control Dependencies (Grouped & Ordered by Controller) ---
S6 → S7
  S6: if ($filter == "student") {
  S7  : $student_id = $request->input('students_id');

S6 → S8
  S6: if ($filter == "student") {
  S8  : $payment_id = $request->input('id');

S6 → S9
  S6: if ($filter == "student") {
  S9  : $dispensasi = $request->input('dispensasi');

S6 → S11
  S6: if ($filter == "student") {
  S11  : $payment = Ukt::where('id', $payment_id)->first();

S6 → S12
  S6: if ($filter == "student") {
  S12  : $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();

S6 → S14
  S6: if ($filter == "student") {
  S14  : $payment->keterangan = "Dispen UTS";

S6 → S15
  S6: if ($filter == "student") {
  S15  : $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);

S6 → S17
  S6: if ($filter == "student") {
  S17  : $payment->keterangan = "Dispen UAS";

S6 → S18
  S6: if ($filter == "student") {
  S18  : $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);

S6 → S20
  S6: if ($filter == "student") {
  S20  : $payment->keterangan = "Dispen KRS";

S6 → S21
  S6: if ($filter == "student") {
  S21  : $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester);

S6 → S22
  S6: if ($filter == "student") {
  S22  : $payment->save();

S6 → S25
  S6: if ($filter == "student") {
  S25  : $student_id = Student::first()->id;

S6 → S26
  S6: if ($filter == "student") {
  S26  : $student_id = null;

S6 → S27
  S6: if ($filter == "student") {
  S27  : $student = Student::where('id', $student_id)->first();

S6 → S29
  S6: if ($filter == "student") {
  S29  : $ukt = Ukt::where('students_id', $student->id)->latest()->get();

S6 → S30
  S6: if ($filter == "student") {
  S30  : $totalUkt = $ukt->sum('amount');

S6 → S31
  S6: if ($filter == "student") {
  S31  : $ukt = null;

S6 → S32
  S6: if ($filter == "student") {
  S32  : $totalUkt = 0;

S6 → S33
  S6: if ($filter == "student") {
  S33  : return view('detail_payment.ukt')->with([

S6 → S34
  S6: if ($filter == "student") {
  S34  : 'ukt' => $ukt

S6 → S35
  S6: if ($filter == "student") {
  S35  : 'students' => $selectStudent

S6 → S36
  S6: if ($filter == "student") {
  S36  : 'choice' => $student

S6 → S37
  S6: if ($filter == "student") {
  S37  : 'faculty' => $selectFaculty

S6 → S38
  S6: if ($filter == "student") {
  S38  : 'totalUkt' => $totalUkt

S6 → S39
  S6: if ($filter == "student") {
  S39  : 'filter' => $filter

S6 → S41
  S6: if ($filter == "student") {
  S41  : $faculty_id = $request->faculty_id;

S6 → S42
  S6: if ($filter == "student") {
  S42  : $datepicker = $request->datepicker;

S6 → S43
  S6: if ($filter == "student") {
  S43  : $getDate = $this->getDate($datepicker);

S6 → S46
  S6: if ($filter == "student") {
  S46  : $faculty_id = Faculty::first()->id;

S6 → S47
  S6: if ($filter == "student") {
  S47  : $faculty_id = null;

S6 → S48
  S6: if ($filter == "student") {
  S48  : $faculty = Faculty::where('id', $faculty_id)->first();

S6 → S50
  S6: if ($filter == "student") {
  S50  : $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

S6 → S51
  S6: if ($filter == "student") {
  S51  : $query->select('id')->from('students')->whereIn('study_program_id', function ($query) use ($faculty_id) {

S6 → S52
  S6: if ($filter == "student") {
  S52  : $query->select('id')->from('study_programs')->where('faculty_id', $faculty_id);

S6 → S53
  S6: if ($filter == "student") {
  S53  : $getDate[0]

S6 → S54
  S6: if ($filter == "student") {
  S54  : $query->where('type', 'UKT')->orWhere('type', 'DPP');

S6 → S55
  S6: if ($filter == "student") {
  S55  : $totalUkt = $ukt->sum('amount');

S6 → S56
  S6: if ($filter == "student") {
  S56  : $ukt = null;

S6 → S57
  S6: if ($filter == "student") {
  S57  : $totalUkt = 0;

S6 → S58
  S6: if ($filter == "student") {
  S58  : return view('detail_payment.ukt')->with([

S6 → S59
  S6: if ($filter == "student") {
  S59  : 'ukt' => $ukt

S6 → S60
  S6: if ($filter == "student") {
  S60  : 'students' => $selectStudent

S6 → S61
  S6: if ($filter == "student") {
  S61  : 'choice' => $faculty

S6 → S62
  S6: if ($filter == "student") {
  S62  : 'faculty' => $selectFaculty

S6 → S63
  S6: if ($filter == "student") {
  S63  : 'totalUkt' => $totalUkt

S6 → S64
  S6: if ($filter == "student") {
  S64  : 'filter' => $filter

S6 → S65
  S6: if ($filter == "student") {
  S65  : 'datepicker' => $getDate[1]

S10 → S11
  S10: if (!empty($payment_id) && !empty($dispensasi)) {
  S11  : $payment = Ukt::where('id', $payment_id)->first();

S10 → S12
  S10: if (!empty($payment_id) && !empty($dispensasi)) {
  S12  : $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();

S10 → S14
  S10: if (!empty($payment_id) && !empty($dispensasi)) {
  S14  : $payment->keterangan = "Dispen UTS";

S10 → S15
  S10: if (!empty($payment_id) && !empty($dispensasi)) {
  S15  : $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);

S10 → S17
  S10: if (!empty($payment_id) && !empty($dispensasi)) {
  S17  : $payment->keterangan = "Dispen UAS";

S10 → S18
  S10: if (!empty($payment_id) && !empty($dispensasi)) {
  S18  : $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);

S10 → S20
  S10: if (!empty($payment_id) && !empty($dispensasi)) {
  S20  : $payment->keterangan = "Dispen KRS";

S10 → S21
  S10: if (!empty($payment_id) && !empty($dispensasi)) {
  S21  : $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester);

S10 → S22
  S10: if (!empty($payment_id) && !empty($dispensasi)) {
  S22  : $payment->save();

S13 → S14
  S13: if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {
  S14  : $payment->keterangan = "Dispen UTS";

S13 → S15
  S13: if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {
  S15  : $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);

S13 → S17
  S13: if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {
  S17  : $payment->keterangan = "Dispen UAS";

S13 → S18
  S13: if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {
  S18  : $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);

S13 → S20
  S13: if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {
  S20  : $payment->keterangan = "Dispen KRS";

S13 → S21
  S13: if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {
  S21  : $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester);

S16 → S17
  S16: elseif ($dispensasi == "Menunggu Dispensasi UAS" && $bimbinganStudy->status == "Aktif") {
  S17  : $payment->keterangan = "Dispen UAS";

S16 → S18
  S16: elseif ($dispensasi == "Menunggu Dispensasi UAS" && $bimbinganStudy->status == "Aktif") {
  S18  : $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);

S19 → S20
  S19: elseif ($dispensasi == "Menunggu Dispensasi KRS") {
  S20  : $payment->keterangan = "Dispen KRS";

S19 → S21
  S19: elseif ($dispensasi == "Menunggu Dispensasi KRS") {
  S21  : $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester);

S23 → S25
  S23: if (empty($student_id)) {
  S25  : $student_id = Student::first()->id;

S23 → S26
  S23: if (empty($student_id)) {
  S26  : $student_id = null;

S24 → S25
  S24: if (Student::first()) {
  S25  : $student_id = Student::first()->id;

S24 → S26
  S24: if (Student::first()) {
  S26  : $student_id = null;

S28 → S29
  S28: if (!empty($student)) {
  S29  : $ukt = Ukt::where('students_id', $student->id)->latest()->get();

S28 → S30
  S28: if (!empty($student)) {
  S30  : $totalUkt = $ukt->sum('amount');

S28 → S31
  S28: if (!empty($student)) {
  S31  : $ukt = null;

S28 → S32
  S28: if (!empty($student)) {
  S32  : $totalUkt = 0;

S40 → S41
  S40: elseif ($filter == "faculty") {
  S41  : $faculty_id = $request->faculty_id;

S40 → S42
  S40: elseif ($filter == "faculty") {
  S42  : $datepicker = $request->datepicker;

S40 → S43
  S40: elseif ($filter == "faculty") {
  S43  : $getDate = $this->getDate($datepicker);

S40 → S46
  S40: elseif ($filter == "faculty") {
  S46  : $faculty_id = Faculty::first()->id;

S40 → S47
  S40: elseif ($filter == "faculty") {
  S47  : $faculty_id = null;

S40 → S48
  S40: elseif ($filter == "faculty") {
  S48  : $faculty = Faculty::where('id', $faculty_id)->first();

S40 → S50
  S40: elseif ($filter == "faculty") {
  S50  : $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

S40 → S51
  S40: elseif ($filter == "faculty") {
  S51  : $query->select('id')->from('students')->whereIn('study_program_id', function ($query) use ($faculty_id) {

S40 → S52
  S40: elseif ($filter == "faculty") {
  S52  : $query->select('id')->from('study_programs')->where('faculty_id', $faculty_id);

S40 → S53
  S40: elseif ($filter == "faculty") {
  S53  : $getDate[0]

S40 → S54
  S40: elseif ($filter == "faculty") {
  S54  : $query->where('type', 'UKT')->orWhere('type', 'DPP');

S40 → S55
  S40: elseif ($filter == "faculty") {
  S55  : $totalUkt = $ukt->sum('amount');

S40 → S56
  S40: elseif ($filter == "faculty") {
  S56  : $ukt = null;

S40 → S57
  S40: elseif ($filter == "faculty") {
  S57  : $totalUkt = 0;

S40 → S58
  S40: elseif ($filter == "faculty") {
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S40 → S59
  S40: elseif ($filter == "faculty") {
  S59  : 'ukt' => $ukt

S40 → S60
  S40: elseif ($filter == "faculty") {
  S60  : 'students' => $selectStudent

S40 → S61
  S40: elseif ($filter == "faculty") {
  S61  : 'choice' => $faculty

S40 → S62
  S40: elseif ($filter == "faculty") {
  S62  : 'faculty' => $selectFaculty

S40 → S63
  S40: elseif ($filter == "faculty") {
  S63  : 'totalUkt' => $totalUkt

S40 → S64
  S40: elseif ($filter == "faculty") {
  S64  : 'filter' => $filter

S40 → S65
  S40: elseif ($filter == "faculty") {
  S65  : 'datepicker' => $getDate[1]

S44 → S46
  S44: if (empty($faculty_id)) {
  S46  : $faculty_id = Faculty::first()->id;

S44 → S47
  S44: if (empty($faculty_id)) {
  S47  : $faculty_id = null;

S45 → S46
  S45: if (Faculty::first()) {
  S46  : $faculty_id = Faculty::first()->id;

S45 → S47
  S45: if (Faculty::first()) {
  S47  : $faculty_id = null;

S49 → S50
  S49: if (!empty($faculty)) {
  S50  : $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

S49 → S51
  S49: if (!empty($faculty)) {
  S51  : $query->select('id')->from('students')->whereIn('study_program_id', function ($query) use ($faculty_id) {

S49 → S52
  S49: if (!empty($faculty)) {
  S52  : $query->select('id')->from('study_programs')->where('faculty_id', $faculty_id);

S49 → S53
  S49: if (!empty($faculty)) {
  S53  : $getDate[0]

S49 → S54
  S49: if (!empty($faculty)) {
  S54  : $query->where('type', 'UKT')->orWhere('type', 'DPP');

S49 → S55
  S49: if (!empty($faculty)) {
  S55  : $totalUkt = $ukt->sum('amount');

S49 → S56
  S49: if (!empty($faculty)) {
  S56  : $ukt = null;

S49 → S57
  S49: if (!empty($faculty)) {
  S57  : $totalUkt = 0;


--- Data Dependencies (Grouped & Ordered by Definer) ---
S1 → S5 [$request]
  S1: public function index(Request $request)
  S5  : $filter = empty($request->filterUkt) ? "student" : $request->filterUkt;

S1 → S7 [$request]
  S1: public function index(Request $request)
  S7  : $student_id = $request->input('students_id');

S1 → S8 [$request]
  S1: public function index(Request $request)
  S8  : $payment_id = $request->input('id');

S1 → S9 [$request]
  S1: public function index(Request $request)
  S9  : $dispensasi = $request->input('dispensasi');

S1 → S41 [$request]
  S1: public function index(Request $request)
  S41  : $faculty_id = $request->faculty_id;

S1 → S42 [$request]
  S1: public function index(Request $request)
  S42  : $datepicker = $request->datepicker;

S2 → S15 [$uktController]
  S2: $uktController = new UktController();
  S15  : $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);

S2 → S18 [$uktController]
  S2: $uktController = new UktController();
  S18  : $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);

S2 → S21 [$uktController]
  S2: $uktController = new UktController();
  S21  : $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester);

S3 → S33 [$selectStudent]
  S3: $selectStudent = Student::select('name', 'id', 'nim')->get();
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S3 → S35 [$selectStudent]
  S3: $selectStudent = Student::select('name', 'id', 'nim')->get();
  S35  : 'students' => $selectStudent

S3 → S58 [$selectStudent]
  S3: $selectStudent = Student::select('name', 'id', 'nim')->get();
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S3 → S60 [$selectStudent]
  S3: $selectStudent = Student::select('name', 'id', 'nim')->get();
  S60  : 'students' => $selectStudent

S4 → S33 [$selectFaculty]
  S4: $selectFaculty = Faculty::select('id', 'name')->get();
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S4 → S37 [$selectFaculty]
  S4: $selectFaculty = Faculty::select('id', 'name')->get();
  S37  : 'faculty' => $selectFaculty

S4 → S58 [$selectFaculty]
  S4: $selectFaculty = Faculty::select('id', 'name')->get();
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S4 → S62 [$selectFaculty]
  S4: $selectFaculty = Faculty::select('id', 'name')->get();
  S62  : 'faculty' => $selectFaculty

S5 → S6 [$filter]
  S5: $filter = empty($request->filterUkt) ? "student" : $request->filterUkt;
  S6  : if ($filter == "student") {

S5 → S33 [$filter]
  S5: $filter = empty($request->filterUkt) ? "student" : $request->filterUkt;
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S5 → S39 [$filter]
  S5: $filter = empty($request->filterUkt) ? "student" : $request->filterUkt;
  S39  : 'filter' => $filter

S5 → S40 [$filter]
  S5: $filter = empty($request->filterUkt) ? "student" : $request->filterUkt;
  S40  : elseif ($filter == "faculty") {

S5 → S58 [$filter]
  S5: $filter = empty($request->filterUkt) ? "student" : $request->filterUkt;
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S5 → S64 [$filter]
  S5: $filter = empty($request->filterUkt) ? "student" : $request->filterUkt;
  S64  : 'filter' => $filter

S7 → S12 [$student_id]
  S7: $student_id = $request->input('students_id');
  S12  : $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();

S7 → S15 [$student_id]
  S7: $student_id = $request->input('students_id');
  S15  : $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);

S7 → S18 [$student_id]
  S7: $student_id = $request->input('students_id');
  S18  : $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);

S7 → S21 [$student_id]
  S7: $student_id = $request->input('students_id');
  S21  : $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester);

S7 → S23 [$student_id]
  S7: $student_id = $request->input('students_id');
  S23  : if (empty($student_id)) {

S7 → S25 [$student_id]
  S7: $student_id = $request->input('students_id');
  S25  : $student_id = Student::first()->id;

S7 → S26 [$student_id]
  S7: $student_id = $request->input('students_id');
  S26  : $student_id = null;

S7 → S27 [$student_id]
  S7: $student_id = $request->input('students_id');
  S27  : $student = Student::where('id', $student_id)->first();

S8 → S10 [$payment_id]
  S8: $payment_id = $request->input('id');
  S10  : if (!empty($payment_id) && !empty($dispensasi)) {

S8 → S11 [$payment_id]
  S8: $payment_id = $request->input('id');
  S11  : $payment = Ukt::where('id', $payment_id)->first();

S9 → S10 [$dispensasi]
  S9: $dispensasi = $request->input('dispensasi');
  S10  : if (!empty($payment_id) && !empty($dispensasi)) {

S9 → S13 [$dispensasi]
  S9: $dispensasi = $request->input('dispensasi');
  S13  : if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {

S9 → S16 [$dispensasi]
  S9: $dispensasi = $request->input('dispensasi');
  S16  : elseif ($dispensasi == "Menunggu Dispensasi UAS" && $bimbinganStudy->status == "Aktif") {

S9 → S19 [$dispensasi]
  S9: $dispensasi = $request->input('dispensasi');
  S19  : elseif ($dispensasi == "Menunggu Dispensasi KRS") {

S11 → S12 [$payment]
  S11: $payment = Ukt::where('id', $payment_id)->first();
  S12  : $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();

S11 → S14 [$payment]
  S11: $payment = Ukt::where('id', $payment_id)->first();
  S14  : $payment->keterangan = "Dispen UTS";

S11 → S15 [$payment]
  S11: $payment = Ukt::where('id', $payment_id)->first();
  S15  : $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);

S11 → S17 [$payment]
  S11: $payment = Ukt::where('id', $payment_id)->first();
  S17  : $payment->keterangan = "Dispen UAS";

S11 → S18 [$payment]
  S11: $payment = Ukt::where('id', $payment_id)->first();
  S18  : $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);

S11 → S20 [$payment]
  S11: $payment = Ukt::where('id', $payment_id)->first();
  S20  : $payment->keterangan = "Dispen KRS";

S11 → S21 [$payment]
  S11: $payment = Ukt::where('id', $payment_id)->first();
  S21  : $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester);

S11 → S22 [$payment]
  S11: $payment = Ukt::where('id', $payment_id)->first();
  S22  : $payment->save();

S12 → S13 [$bimbinganStudy]
  S12: $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();
  S13  : if ($dispensasi == "Menunggu Dispensasi UTS" && $bimbinganStudy->status == "Aktif") {

S12 → S16 [$bimbinganStudy]
  S12: $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();
  S16  : elseif ($dispensasi == "Menunggu Dispensasi UAS" && $bimbinganStudy->status == "Aktif") {

S25 → S7 [$student_id]
  S25: $student_id = Student::first()->id;
  S7  : $student_id = $request->input('students_id');

S25 → S12 [$student_id]
  S25: $student_id = Student::first()->id;
  S12  : $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();

S25 → S15 [$student_id]
  S25: $student_id = Student::first()->id;
  S15  : $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);

S25 → S18 [$student_id]
  S25: $student_id = Student::first()->id;
  S18  : $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);

S25 → S21 [$student_id]
  S25: $student_id = Student::first()->id;
  S21  : $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester);

S25 → S23 [$student_id]
  S25: $student_id = Student::first()->id;
  S23  : if (empty($student_id)) {

S25 → S26 [$student_id]
  S25: $student_id = Student::first()->id;
  S26  : $student_id = null;

S25 → S27 [$student_id]
  S25: $student_id = Student::first()->id;
  S27  : $student = Student::where('id', $student_id)->first();

S26 → S7 [$student_id]
  S26: $student_id = null;
  S7  : $student_id = $request->input('students_id');

S26 → S12 [$student_id]
  S26: $student_id = null;
  S12  : $bimbinganStudy = BimbinganStudy::where('students_id', $student_id)->where('year', $payment->year)->where('semester', $payment->semester)->first();

S26 → S15 [$student_id]
  S26: $student_id = null;
  S15  : $payment->exam_uts_id = $uktController->createExamCard($student_id, "UTS", $payment->semester, $payment->year);

S26 → S18 [$student_id]
  S26: $student_id = null;
  S18  : $payment->exam_uas_id = $uktController->createExamCard($student_id, "UAS", $payment->semester, $payment->year);

S26 → S21 [$student_id]
  S26: $student_id = null;
  S21  : $payment->lbs_id = $uktController->createBimbinganStudy($student_id, $payment->year, $payment->semester);

S26 → S23 [$student_id]
  S26: $student_id = null;
  S23  : if (empty($student_id)) {

S26 → S25 [$student_id]
  S26: $student_id = null;
  S25  : $student_id = Student::first()->id;

S26 → S27 [$student_id]
  S26: $student_id = null;
  S27  : $student = Student::where('id', $student_id)->first();

S27 → S28 [$student]
  S27: $student = Student::where('id', $student_id)->first();
  S28  : if (!empty($student)) {

S27 → S29 [$student]
  S27: $student = Student::where('id', $student_id)->first();
  S29  : $ukt = Ukt::where('students_id', $student->id)->latest()->get();

S27 → S33 [$student]
  S27: $student = Student::where('id', $student_id)->first();
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S27 → S36 [$student]
  S27: $student = Student::where('id', $student_id)->first();
  S36  : 'choice' => $student

S29 → S30 [$ukt]
  S29: $ukt = Ukt::where('students_id', $student->id)->latest()->get();
  S30  : $totalUkt = $ukt->sum('amount');

S29 → S31 [$ukt]
  S29: $ukt = Ukt::where('students_id', $student->id)->latest()->get();
  S31  : $ukt = null;

S29 → S33 [$ukt]
  S29: $ukt = Ukt::where('students_id', $student->id)->latest()->get();
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S29 → S34 [$ukt]
  S29: $ukt = Ukt::where('students_id', $student->id)->latest()->get();
  S34  : 'ukt' => $ukt

S29 → S50 [$ukt]
  S29: $ukt = Ukt::where('students_id', $student->id)->latest()->get();
  S50  : $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

S29 → S55 [$ukt]
  S29: $ukt = Ukt::where('students_id', $student->id)->latest()->get();
  S55  : $totalUkt = $ukt->sum('amount');

S29 → S56 [$ukt]
  S29: $ukt = Ukt::where('students_id', $student->id)->latest()->get();
  S56  : $ukt = null;

S29 → S58 [$ukt]
  S29: $ukt = Ukt::where('students_id', $student->id)->latest()->get();
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S29 → S59 [$ukt]
  S29: $ukt = Ukt::where('students_id', $student->id)->latest()->get();
  S59  : 'ukt' => $ukt

S30 → S32 [$totalUkt]
  S30: $totalUkt = $ukt->sum('amount');
  S32  : $totalUkt = 0;

S30 → S33 [$totalUkt]
  S30: $totalUkt = $ukt->sum('amount');
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S30 → S38 [$totalUkt]
  S30: $totalUkt = $ukt->sum('amount');
  S38  : 'totalUkt' => $totalUkt

S30 → S55 [$totalUkt]
  S30: $totalUkt = $ukt->sum('amount');
  S55  : $totalUkt = $ukt->sum('amount');

S30 → S57 [$totalUkt]
  S30: $totalUkt = $ukt->sum('amount');
  S57  : $totalUkt = 0;

S30 → S58 [$totalUkt]
  S30: $totalUkt = $ukt->sum('amount');
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S30 → S63 [$totalUkt]
  S30: $totalUkt = $ukt->sum('amount');
  S63  : 'totalUkt' => $totalUkt

S31 → S29 [$ukt]
  S31: $ukt = null;
  S29  : $ukt = Ukt::where('students_id', $student->id)->latest()->get();

S31 → S30 [$ukt]
  S31: $ukt = null;
  S30  : $totalUkt = $ukt->sum('amount');

S31 → S33 [$ukt]
  S31: $ukt = null;
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S31 → S34 [$ukt]
  S31: $ukt = null;
  S34  : 'ukt' => $ukt

S31 → S50 [$ukt]
  S31: $ukt = null;
  S50  : $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

S31 → S55 [$ukt]
  S31: $ukt = null;
  S55  : $totalUkt = $ukt->sum('amount');

S31 → S56 [$ukt]
  S31: $ukt = null;
  S56  : $ukt = null;

S31 → S58 [$ukt]
  S31: $ukt = null;
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S31 → S59 [$ukt]
  S31: $ukt = null;
  S59  : 'ukt' => $ukt

S32 → S30 [$totalUkt]
  S32: $totalUkt = 0;
  S30  : $totalUkt = $ukt->sum('amount');

S32 → S33 [$totalUkt]
  S32: $totalUkt = 0;
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S32 → S38 [$totalUkt]
  S32: $totalUkt = 0;
  S38  : 'totalUkt' => $totalUkt

S32 → S55 [$totalUkt]
  S32: $totalUkt = 0;
  S55  : $totalUkt = $ukt->sum('amount');

S32 → S57 [$totalUkt]
  S32: $totalUkt = 0;
  S57  : $totalUkt = 0;

S32 → S58 [$totalUkt]
  S32: $totalUkt = 0;
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S32 → S63 [$totalUkt]
  S32: $totalUkt = 0;
  S63  : 'totalUkt' => $totalUkt

S41 → S44 [$faculty_id]
  S41: $faculty_id = $request->faculty_id;
  S44  : if (empty($faculty_id)) {

S41 → S46 [$faculty_id]
  S41: $faculty_id = $request->faculty_id;
  S46  : $faculty_id = Faculty::first()->id;

S41 → S47 [$faculty_id]
  S41: $faculty_id = $request->faculty_id;
  S47  : $faculty_id = null;

S41 → S48 [$faculty_id]
  S41: $faculty_id = $request->faculty_id;
  S48  : $faculty = Faculty::where('id', $faculty_id)->first();

S41 → S50 [$faculty_id]
  S41: $faculty_id = $request->faculty_id;
  S50  : $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

S41 → S51 [$faculty_id]
  S41: $faculty_id = $request->faculty_id;
  S51  : $query->select('id')->from('students')->whereIn('study_program_id', function ($query) use ($faculty_id) {

S41 → S52 [$faculty_id]
  S41: $faculty_id = $request->faculty_id;
  S52  : $query->select('id')->from('study_programs')->where('faculty_id', $faculty_id);

S42 → S43 [$datepicker]
  S42: $datepicker = $request->datepicker;
  S43  : $getDate = $this->getDate($datepicker);

S43 → S50 [$getDate]
  S43: $getDate = $this->getDate($datepicker);
  S50  : $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

S43 → S53 [$getDate]
  S43: $getDate = $this->getDate($datepicker);
  S53  : $getDate[0]

S43 → S58 [$getDate]
  S43: $getDate = $this->getDate($datepicker);
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S43 → S65 [$getDate]
  S43: $getDate = $this->getDate($datepicker);
  S65  : 'datepicker' => $getDate[1]

S46 → S41 [$faculty_id]
  S46: $faculty_id = Faculty::first()->id;
  S41  : $faculty_id = $request->faculty_id;

S46 → S44 [$faculty_id]
  S46: $faculty_id = Faculty::first()->id;
  S44  : if (empty($faculty_id)) {

S46 → S47 [$faculty_id]
  S46: $faculty_id = Faculty::first()->id;
  S47  : $faculty_id = null;

S46 → S48 [$faculty_id]
  S46: $faculty_id = Faculty::first()->id;
  S48  : $faculty = Faculty::where('id', $faculty_id)->first();

S46 → S50 [$faculty_id]
  S46: $faculty_id = Faculty::first()->id;
  S50  : $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

S46 → S51 [$faculty_id]
  S46: $faculty_id = Faculty::first()->id;
  S51  : $query->select('id')->from('students')->whereIn('study_program_id', function ($query) use ($faculty_id) {

S46 → S52 [$faculty_id]
  S46: $faculty_id = Faculty::first()->id;
  S52  : $query->select('id')->from('study_programs')->where('faculty_id', $faculty_id);

S47 → S41 [$faculty_id]
  S47: $faculty_id = null;
  S41  : $faculty_id = $request->faculty_id;

S47 → S44 [$faculty_id]
  S47: $faculty_id = null;
  S44  : if (empty($faculty_id)) {

S47 → S46 [$faculty_id]
  S47: $faculty_id = null;
  S46  : $faculty_id = Faculty::first()->id;

S47 → S48 [$faculty_id]
  S47: $faculty_id = null;
  S48  : $faculty = Faculty::where('id', $faculty_id)->first();

S47 → S50 [$faculty_id]
  S47: $faculty_id = null;
  S50  : $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

S47 → S51 [$faculty_id]
  S47: $faculty_id = null;
  S51  : $query->select('id')->from('students')->whereIn('study_program_id', function ($query) use ($faculty_id) {

S47 → S52 [$faculty_id]
  S47: $faculty_id = null;
  S52  : $query->select('id')->from('study_programs')->where('faculty_id', $faculty_id);

S48 → S49 [$faculty]
  S48: $faculty = Faculty::where('id', $faculty_id)->first();
  S49  : if (!empty($faculty)) {

S48 → S58 [$faculty]
  S48: $faculty = Faculty::where('id', $faculty_id)->first();
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S48 → S61 [$faculty]
  S48: $faculty = Faculty::where('id', $faculty_id)->first();
  S61  : 'choice' => $faculty

S50 → S29 [$ukt]
  S50: $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
  S29  : $ukt = Ukt::where('students_id', $student->id)->latest()->get();

S50 → S30 [$ukt]
  S50: $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
  S30  : $totalUkt = $ukt->sum('amount');

S50 → S31 [$ukt]
  S50: $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
  S31  : $ukt = null;

S50 → S33 [$ukt]
  S50: $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S50 → S34 [$ukt]
  S50: $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
  S34  : 'ukt' => $ukt

S50 → S55 [$ukt]
  S50: $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
  S55  : $totalUkt = $ukt->sum('amount');

S50 → S56 [$ukt]
  S50: $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
  S56  : $ukt = null;

S50 → S58 [$ukt]
  S50: $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S50 → S59 [$ukt]
  S50: $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {
  S59  : 'ukt' => $ukt

S55 → S30 [$totalUkt]
  S55: $totalUkt = $ukt->sum('amount');
  S30  : $totalUkt = $ukt->sum('amount');

S55 → S32 [$totalUkt]
  S55: $totalUkt = $ukt->sum('amount');
  S32  : $totalUkt = 0;

S55 → S33 [$totalUkt]
  S55: $totalUkt = $ukt->sum('amount');
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S55 → S38 [$totalUkt]
  S55: $totalUkt = $ukt->sum('amount');
  S38  : 'totalUkt' => $totalUkt

S55 → S57 [$totalUkt]
  S55: $totalUkt = $ukt->sum('amount');
  S57  : $totalUkt = 0;

S55 → S58 [$totalUkt]
  S55: $totalUkt = $ukt->sum('amount');
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S55 → S63 [$totalUkt]
  S55: $totalUkt = $ukt->sum('amount');
  S63  : 'totalUkt' => $totalUkt

S56 → S29 [$ukt]
  S56: $ukt = null;
  S29  : $ukt = Ukt::where('students_id', $student->id)->latest()->get();

S56 → S30 [$ukt]
  S56: $ukt = null;
  S30  : $totalUkt = $ukt->sum('amount');

S56 → S31 [$ukt]
  S56: $ukt = null;
  S31  : $ukt = null;

S56 → S33 [$ukt]
  S56: $ukt = null;
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S56 → S34 [$ukt]
  S56: $ukt = null;
  S34  : 'ukt' => $ukt

S56 → S50 [$ukt]
  S56: $ukt = null;
  S50  : $ukt = Ukt::whereIn('students_id', function ($query) use ($faculty_id) {

S56 → S55 [$ukt]
  S56: $ukt = null;
  S55  : $totalUkt = $ukt->sum('amount');

S56 → S58 [$ukt]
  S56: $ukt = null;
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S56 → S59 [$ukt]
  S56: $ukt = null;
  S59  : 'ukt' => $ukt

S57 → S30 [$totalUkt]
  S57: $totalUkt = 0;
  S30  : $totalUkt = $ukt->sum('amount');

S57 → S32 [$totalUkt]
  S57: $totalUkt = 0;
  S32  : $totalUkt = 0;

S57 → S33 [$totalUkt]
  S57: $totalUkt = 0;
  S33  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $student, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter]);

S57 → S38 [$totalUkt]
  S57: $totalUkt = 0;
  S38  : 'totalUkt' => $totalUkt

S57 → S55 [$totalUkt]
  S57: $totalUkt = 0;
  S55  : $totalUkt = $ukt->sum('amount');

S57 → S58 [$totalUkt]
  S57: $totalUkt = 0;
  S58  : return view('detail_payment.ukt')->with(['ukt' => $ukt, 'students' => $selectStudent, 'choice' => $faculty, 'faculty' => $selectFaculty, 'totalUkt' => $totalUkt, 'filter' => $filter, 'datepicker' => $getDate[1]]);

S57 → S63 [$totalUkt]
  S57: $totalUkt = 0;
  S63  : 'totalUkt' => $totalUkt

