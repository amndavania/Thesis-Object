
--- Control Dependencies (Grouped & Ordered by Controller) ---
S20 → S21
  S20: if (!empty($datepicker)) {
  S21  : $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);

S20 → S22
  S20: if (!empty($datepicker)) {
  S22  : $date = $parsedDate->format('Y-m');

S20 → S23
  S20: if (!empty($datepicker)) {
  S23  : $formattedDate = $parsedDate->format('F Y');

S20 → S24
  S20: if (!empty($datepicker)) {
  S24  : $datepicker = $currentMonthYear;

S20 → S25
  S20: if (!empty($datepicker)) {
  S25  : $date = date('Y-m');

S20 → S26
  S20: if (!empty($datepicker)) {
  S26  : $formattedDate = date('F Y');

S32 → S33
  S32: if ($datepicker == $currentMonthYear) {
  S33  : $data = [];

S32 → S34
  S32: if ($datepicker == $currentMonthYear) {
  S34  : $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');

S32 → S35
  S32: if ($datepicker == $currentMonthYear) {
  S35  : $balanceHistory = empty($history->saldo) ? 0 : $history->saldo;

S32 → S36
  S32: if ($datepicker == $currentMonthYear) {
  S36  : $currentDebit = $item->debit;

S32 → S37
  S32: if ($datepicker == $currentMonthYear) {
  S37  : $currentKredit = $item->kredit;

S32 → S39
  S32: if ($datepicker == $currentMonthYear) {
  S39  : $balance = $balanceHistory + ($currentKredit - $currentDebit);

S32 → S40
  S32: if ($datepicker == $currentMonthYear) {
  S40  : $balance = $balanceHistory + ($currentDebit - $currentKredit);

S32 → S42
  S32: if ($datepicker == $currentMonthYear) {
  S42  : $debit = $balance;

S32 → S43
  S32: if ($datepicker == $currentMonthYear) {
  S43  : $kredit = 0;

S32 → S45
  S32: if ($datepicker == $currentMonthYear) {
  S45  : $debit = 0;

S32 → S46
  S32: if ($datepicker == $currentMonthYear) {
  S46  : $kredit = $balance;

S32 → S47
  S32: if ($datepicker == $currentMonthYear) {
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S32 → S48
  S32: if ($datepicker == $currentMonthYear) {
  S48  : 'id' => $item->id

S32 → S49
  S32: if ($datepicker == $currentMonthYear) {
  S49  : 'name' => $item->name

S32 → S50
  S32: if ($datepicker == $currentMonthYear) {
  S50  : 'description' => $item->description

S32 → S51
  S32: if ($datepicker == $currentMonthYear) {
  S51  : 'lajurSaldo' => $item->lajurSaldo

S32 → S52
  S32: if ($datepicker == $currentMonthYear) {
  S52  : 'lajurLaporan' => $item->lajurLaporan

S32 → S53
  S32: if ($datepicker == $currentMonthYear) {
  S53  : 'kredit' => $kredit

S32 → S54
  S32: if ($datepicker == $currentMonthYear) {
  S54  : 'debit' => $debit

S32 → S55
  S32: if ($datepicker == $currentMonthYear) {
  S55  : $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

S32 → S56
  S32: if ($datepicker == $currentMonthYear) {
  S56  : $data = [];

S32 → S57
  S32: if ($datepicker == $currentMonthYear) {
  S57  : $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $monthAfter)->first('saldo');

S32 → S58
  S32: if ($datepicker == $currentMonthYear) {
  S58  : $balance = empty($history->saldo) ? 0 : $history->saldo;

S32 → S60
  S32: if ($datepicker == $currentMonthYear) {
  S60  : $balance = -$balance;

S32 → S62
  S32: if ($datepicker == $currentMonthYear) {
  S62  : $debit = $balance;

S32 → S63
  S32: if ($datepicker == $currentMonthYear) {
  S63  : $kredit = 0;

S32 → S65
  S32: if ($datepicker == $currentMonthYear) {
  S65  : $debit = 0;

S32 → S66
  S32: if ($datepicker == $currentMonthYear) {
  S66  : $kredit = $balance;

S32 → S67
  S32: if ($datepicker == $currentMonthYear) {
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S32 → S68
  S32: if ($datepicker == $currentMonthYear) {
  S68  : 'id' => $item->id

S32 → S69
  S32: if ($datepicker == $currentMonthYear) {
  S69  : 'name' => $item->name

S32 → S70
  S32: if ($datepicker == $currentMonthYear) {
  S70  : 'description' => $item->description

S32 → S71
  S32: if ($datepicker == $currentMonthYear) {
  S71  : 'lajurSaldo' => $item->lajurSaldo

S32 → S72
  S32: if ($datepicker == $currentMonthYear) {
  S72  : 'lajurLaporan' => $item->lajurLaporan

S32 → S73
  S32: if ($datepicker == $currentMonthYear) {
  S73  : 'kredit' => $kredit

S32 → S74
  S32: if ($datepicker == $currentMonthYear) {
  S74  : 'debit' => $debit

S38 → S39
  S38: if ($item->lajurLaporan == 'labaRugi') {
  S39  : $balance = $balanceHistory + ($currentKredit - $currentDebit);

S38 → S40
  S38: if ($item->lajurLaporan == 'labaRugi') {
  S40  : $balance = $balanceHistory + ($currentDebit - $currentKredit);

S41 → S42
  S41: if ($item->lajurSaldo == 'debit') {
  S42  : $debit = $balance;

S41 → S43
  S41: if ($item->lajurSaldo == 'debit') {
  S43  : $kredit = 0;

S41 → S45
  S41: if ($item->lajurSaldo == 'debit') {
  S45  : $debit = 0;

S41 → S46
  S41: if ($item->lajurSaldo == 'debit') {
  S46  : $kredit = $balance;

S44 → S45
  S44: elseif ($item->lajurSaldo == 'kredit') {
  S45  : $debit = 0;

S44 → S46
  S44: elseif ($item->lajurSaldo == 'kredit') {
  S46  : $kredit = $balance;

S59 → S60
  S59: if ($item->lajurLaporan == 'labaRugi') {
  S60  : $balance = -$balance;

S61 → S62
  S61: if ($item->lajurSaldo == 'debit') {
  S62  : $debit = $balance;

S61 → S63
  S61: if ($item->lajurSaldo == 'debit') {
  S63  : $kredit = 0;

S61 → S65
  S61: if ($item->lajurSaldo == 'debit') {
  S65  : $debit = 0;

S61 → S66
  S61: if ($item->lajurSaldo == 'debit') {
  S66  : $kredit = $balance;

S64 → S65
  S64: elseif ($item->lajurSaldo == 'kredit') {
  S65  : $debit = 0;

S64 → S66
  S64: elseif ($item->lajurSaldo == 'kredit') {
  S66  : $kredit = $balance;


--- Data Dependencies (Grouped & Ordered by Definer) ---
S1 → S3 [$request]
  S1: public function index(Request $request)
  S3  : $datepicker = $request->input('datepicker');

S1 → S10 [$request]
  S1: public function index(Request $request)
  S10  : $datepicker = $request->input('datepicker');

S2 → S4 [$currentMonthYear]
  S2: $currentMonthYear = date('Y-m');
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S2 → S5 [$currentMonthYear]
  S2: $currentMonthYear = date('Y-m');
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S2 → S11 [$currentMonthYear]
  S2: $currentMonthYear = date('Y-m');
  S11  : $currentMonthYear = date('Y-m');

S2 → S14 [$currentMonthYear]
  S2: $currentMonthYear = date('Y-m');
  S14  : $date = $this->getDate($date, $currentMonthYear);

S2 → S15 [$currentMonthYear]
  S2: $currentMonthYear = date('Y-m');
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S2 → S24 [$currentMonthYear]
  S2: $currentMonthYear = date('Y-m');
  S24  : $datepicker = $currentMonthYear;

S2 → S32 [$currentMonthYear]
  S2: $currentMonthYear = date('Y-m');
  S32  : if ($datepicker == $currentMonthYear) {

S3 → S4 [$datepicker]
  S3: $datepicker = $request->input('datepicker');
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S3 → S10 [$datepicker]
  S3: $datepicker = $request->input('datepicker');
  S10  : $datepicker = $request->input('datepicker');

S3 → S12 [$datepicker]
  S3: $datepicker = $request->input('datepicker');
  S12  : $dateTime = DateTime::createFromFormat('F Y', $datepicker);

S3 → S20 [$datepicker]
  S3: $datepicker = $request->input('datepicker');
  S20  : if (!empty($datepicker)) {

S3 → S21 [$datepicker]
  S3: $datepicker = $request->input('datepicker');
  S21  : $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);

S3 → S24 [$datepicker]
  S3: $datepicker = $request->input('datepicker');
  S24  : $datepicker = $currentMonthYear;

S3 → S32 [$datepicker]
  S3: $datepicker = $request->input('datepicker');
  S32  : if ($datepicker == $currentMonthYear) {

S3 → S34 [$datepicker]
  S3: $datepicker = $request->input('datepicker');
  S34  : $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');

S3 → S55 [$datepicker]
  S3: $datepicker = $request->input('datepicker');
  S55  : $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

S4 → S5 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S4 → S6 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S6  : return view('report.bukubesarrekap')->with([

S4 → S8 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S8  : 'datepicker' => $date[1]

S4 → S13 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S13  : $date = $dateTime->format('m-Y');

S4 → S14 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S14  : $date = $this->getDate($date, $currentMonthYear);

S4 → S15 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S4 → S16 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S16  : return view('report.printformat.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1], 'today' => date('d F Y', strtotime(date('Y-m-d'))), 'title' => "Laporan Buku Besar"]);

S4 → S18 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S18  : 'datepicker' => $date[1]

S4 → S22 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S22  : $date = $parsedDate->format('Y-m');

S4 → S25 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S25  : $date = date('Y-m');

S4 → S27 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S27  : return [$date, $formattedDate];

S4 → S28 [$date]
  S4: $date = $this->getDate($datepicker, $currentMonthYear);
  S28  : $date

S5 → S6 [$data]
  S5: $data = $this->getData($date[0], $currentMonthYear);
  S6  : return view('report.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1]]);

S5 → S7 [$data]
  S5: $data = $this->getData($date[0], $currentMonthYear);
  S7  : 'data' => $data

S5 → S15 [$data]
  S5: $data = $this->getData($date[0], $currentMonthYear);
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S5 → S16 [$data]
  S5: $data = $this->getData($date[0], $currentMonthYear);
  S16  : return view('report.printformat.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1], 'today' => date('d F Y', strtotime(date('Y-m-d'))), 'title' => "Laporan Buku Besar"]);

S5 → S17 [$data]
  S5: $data = $this->getData($date[0], $currentMonthYear);
  S17  : 'data' => $data

S5 → S33 [$data]
  S5: $data = $this->getData($date[0], $currentMonthYear);
  S33  : $data = [];

S5 → S47 [$data]
  S5: $data = $this->getData($date[0], $currentMonthYear);
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S5 → S56 [$data]
  S5: $data = $this->getData($date[0], $currentMonthYear);
  S56  : $data = [];

S5 → S67 [$data]
  S5: $data = $this->getData($date[0], $currentMonthYear);
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S5 → S75 [$data]
  S5: $data = $this->getData($date[0], $currentMonthYear);
  S75  : return $data;

S9 → S3 [$request]
  S9: public function export(Request $request)
  S3  : $datepicker = $request->input('datepicker');

S9 → S10 [$request]
  S9: public function export(Request $request)
  S10  : $datepicker = $request->input('datepicker');

S10 → S3 [$datepicker]
  S10: $datepicker = $request->input('datepicker');
  S3  : $datepicker = $request->input('datepicker');

S10 → S4 [$datepicker]
  S10: $datepicker = $request->input('datepicker');
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S10 → S12 [$datepicker]
  S10: $datepicker = $request->input('datepicker');
  S12  : $dateTime = DateTime::createFromFormat('F Y', $datepicker);

S10 → S20 [$datepicker]
  S10: $datepicker = $request->input('datepicker');
  S20  : if (!empty($datepicker)) {

S10 → S21 [$datepicker]
  S10: $datepicker = $request->input('datepicker');
  S21  : $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);

S10 → S24 [$datepicker]
  S10: $datepicker = $request->input('datepicker');
  S24  : $datepicker = $currentMonthYear;

S10 → S32 [$datepicker]
  S10: $datepicker = $request->input('datepicker');
  S32  : if ($datepicker == $currentMonthYear) {

S10 → S34 [$datepicker]
  S10: $datepicker = $request->input('datepicker');
  S34  : $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');

S10 → S55 [$datepicker]
  S10: $datepicker = $request->input('datepicker');
  S55  : $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

S11 → S2 [$currentMonthYear]
  S11: $currentMonthYear = date('Y-m');
  S2  : $currentMonthYear = date('Y-m');

S11 → S4 [$currentMonthYear]
  S11: $currentMonthYear = date('Y-m');
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S11 → S5 [$currentMonthYear]
  S11: $currentMonthYear = date('Y-m');
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S11 → S14 [$currentMonthYear]
  S11: $currentMonthYear = date('Y-m');
  S14  : $date = $this->getDate($date, $currentMonthYear);

S11 → S15 [$currentMonthYear]
  S11: $currentMonthYear = date('Y-m');
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S11 → S24 [$currentMonthYear]
  S11: $currentMonthYear = date('Y-m');
  S24  : $datepicker = $currentMonthYear;

S11 → S32 [$currentMonthYear]
  S11: $currentMonthYear = date('Y-m');
  S32  : if ($datepicker == $currentMonthYear) {

S12 → S13 [$dateTime]
  S12: $dateTime = DateTime::createFromFormat('F Y', $datepicker);
  S13  : $date = $dateTime->format('m-Y');

S13 → S4 [$date]
  S13: $date = $dateTime->format('m-Y');
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S13 → S5 [$date]
  S13: $date = $dateTime->format('m-Y');
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S13 → S6 [$date]
  S13: $date = $dateTime->format('m-Y');
  S6  : return view('report.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1]]);

S13 → S8 [$date]
  S13: $date = $dateTime->format('m-Y');
  S8  : 'datepicker' => $date[1]

S13 → S14 [$date]
  S13: $date = $dateTime->format('m-Y');
  S14  : $date = $this->getDate($date, $currentMonthYear);

S13 → S15 [$date]
  S13: $date = $dateTime->format('m-Y');
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S13 → S16 [$date]
  S13: $date = $dateTime->format('m-Y');
  S16  : return view('report.printformat.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1], 'today' => date('d F Y', strtotime(date('Y-m-d'))), 'title' => "Laporan Buku Besar"]);

S13 → S18 [$date]
  S13: $date = $dateTime->format('m-Y');
  S18  : 'datepicker' => $date[1]

S13 → S22 [$date]
  S13: $date = $dateTime->format('m-Y');
  S22  : $date = $parsedDate->format('Y-m');

S13 → S25 [$date]
  S13: $date = $dateTime->format('m-Y');
  S25  : $date = date('Y-m');

S13 → S27 [$date]
  S13: $date = $dateTime->format('m-Y');
  S27  : return [$date, $formattedDate];

S13 → S28 [$date]
  S13: $date = $dateTime->format('m-Y');
  S28  : $date

S14 → S4 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S14 → S5 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S14 → S6 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S6  : return view('report.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1]]);

S14 → S8 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S8  : 'datepicker' => $date[1]

S14 → S13 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S13  : $date = $dateTime->format('m-Y');

S14 → S15 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S14 → S16 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S16  : return view('report.printformat.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1], 'today' => date('d F Y', strtotime(date('Y-m-d'))), 'title' => "Laporan Buku Besar"]);

S14 → S18 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S18  : 'datepicker' => $date[1]

S14 → S22 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S22  : $date = $parsedDate->format('Y-m');

S14 → S25 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S25  : $date = date('Y-m');

S14 → S27 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S27  : return [$date, $formattedDate];

S14 → S28 [$date]
  S14: $date = $this->getDate($date, $currentMonthYear);
  S28  : $date

S15 → S5 [$data]
  S15: $data = $this->getData($date[0], $currentMonthYear);
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S15 → S6 [$data]
  S15: $data = $this->getData($date[0], $currentMonthYear);
  S6  : return view('report.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1]]);

S15 → S7 [$data]
  S15: $data = $this->getData($date[0], $currentMonthYear);
  S7  : 'data' => $data

S15 → S16 [$data]
  S15: $data = $this->getData($date[0], $currentMonthYear);
  S16  : return view('report.printformat.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1], 'today' => date('d F Y', strtotime(date('Y-m-d'))), 'title' => "Laporan Buku Besar"]);

S15 → S17 [$data]
  S15: $data = $this->getData($date[0], $currentMonthYear);
  S17  : 'data' => $data

S15 → S33 [$data]
  S15: $data = $this->getData($date[0], $currentMonthYear);
  S33  : $data = [];

S15 → S47 [$data]
  S15: $data = $this->getData($date[0], $currentMonthYear);
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S15 → S56 [$data]
  S15: $data = $this->getData($date[0], $currentMonthYear);
  S56  : $data = [];

S15 → S67 [$data]
  S15: $data = $this->getData($date[0], $currentMonthYear);
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S15 → S75 [$data]
  S15: $data = $this->getData($date[0], $currentMonthYear);
  S75  : return $data;

S19 → S2 [$currentMonthYear]
  S19: public function getDate($datepicker, $currentMonthYear)
  S2  : $currentMonthYear = date('Y-m');

S19 → S3 [$datepicker]
  S19: public function getDate($datepicker, $currentMonthYear)
  S3  : $datepicker = $request->input('datepicker');

S19 → S4 [$datepicker]
  S19: public function getDate($datepicker, $currentMonthYear)
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S19 → S4 [$currentMonthYear]
  S19: public function getDate($datepicker, $currentMonthYear)
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S19 → S5 [$currentMonthYear]
  S19: public function getDate($datepicker, $currentMonthYear)
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S19 → S10 [$datepicker]
  S19: public function getDate($datepicker, $currentMonthYear)
  S10  : $datepicker = $request->input('datepicker');

S19 → S11 [$currentMonthYear]
  S19: public function getDate($datepicker, $currentMonthYear)
  S11  : $currentMonthYear = date('Y-m');

S19 → S12 [$datepicker]
  S19: public function getDate($datepicker, $currentMonthYear)
  S12  : $dateTime = DateTime::createFromFormat('F Y', $datepicker);

S19 → S14 [$currentMonthYear]
  S19: public function getDate($datepicker, $currentMonthYear)
  S14  : $date = $this->getDate($date, $currentMonthYear);

S19 → S15 [$currentMonthYear]
  S19: public function getDate($datepicker, $currentMonthYear)
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S19 → S20 [$datepicker]
  S19: public function getDate($datepicker, $currentMonthYear)
  S20  : if (!empty($datepicker)) {

S19 → S21 [$datepicker]
  S19: public function getDate($datepicker, $currentMonthYear)
  S21  : $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);

S19 → S24 [$datepicker]
  S19: public function getDate($datepicker, $currentMonthYear)
  S24  : $datepicker = $currentMonthYear;

S19 → S24 [$currentMonthYear]
  S19: public function getDate($datepicker, $currentMonthYear)
  S24  : $datepicker = $currentMonthYear;

S19 → S32 [$datepicker]
  S19: public function getDate($datepicker, $currentMonthYear)
  S32  : if ($datepicker == $currentMonthYear) {

S19 → S32 [$currentMonthYear]
  S19: public function getDate($datepicker, $currentMonthYear)
  S32  : if ($datepicker == $currentMonthYear) {

S19 → S34 [$datepicker]
  S19: public function getDate($datepicker, $currentMonthYear)
  S34  : $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');

S19 → S55 [$datepicker]
  S19: public function getDate($datepicker, $currentMonthYear)
  S55  : $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

S21 → S22 [$parsedDate]
  S21: $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
  S22  : $date = $parsedDate->format('Y-m');

S21 → S23 [$parsedDate]
  S21: $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
  S23  : $formattedDate = $parsedDate->format('F Y');

S22 → S4 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S22 → S5 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S22 → S6 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S6  : return view('report.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1]]);

S22 → S8 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S8  : 'datepicker' => $date[1]

S22 → S13 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S13  : $date = $dateTime->format('m-Y');

S22 → S14 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S14  : $date = $this->getDate($date, $currentMonthYear);

S22 → S15 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S22 → S16 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S16  : return view('report.printformat.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1], 'today' => date('d F Y', strtotime(date('Y-m-d'))), 'title' => "Laporan Buku Besar"]);

S22 → S18 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S18  : 'datepicker' => $date[1]

S22 → S25 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S25  : $date = date('Y-m');

S22 → S27 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S27  : return [$date, $formattedDate];

S22 → S28 [$date]
  S22: $date = $parsedDate->format('Y-m');
  S28  : $date

S23 → S26 [$formattedDate]
  S23: $formattedDate = $parsedDate->format('F Y');
  S26  : $formattedDate = date('F Y');

S23 → S27 [$formattedDate]
  S23: $formattedDate = $parsedDate->format('F Y');
  S27  : return [$date, $formattedDate];

S23 → S29 [$formattedDate]
  S23: $formattedDate = $parsedDate->format('F Y');
  S29  : $formattedDate

S24 → S3 [$datepicker]
  S24: $datepicker = $currentMonthYear;
  S3  : $datepicker = $request->input('datepicker');

S24 → S4 [$datepicker]
  S24: $datepicker = $currentMonthYear;
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S24 → S10 [$datepicker]
  S24: $datepicker = $currentMonthYear;
  S10  : $datepicker = $request->input('datepicker');

S24 → S12 [$datepicker]
  S24: $datepicker = $currentMonthYear;
  S12  : $dateTime = DateTime::createFromFormat('F Y', $datepicker);

S24 → S20 [$datepicker]
  S24: $datepicker = $currentMonthYear;
  S20  : if (!empty($datepicker)) {

S24 → S21 [$datepicker]
  S24: $datepicker = $currentMonthYear;
  S21  : $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);

S24 → S32 [$datepicker]
  S24: $datepicker = $currentMonthYear;
  S32  : if ($datepicker == $currentMonthYear) {

S24 → S34 [$datepicker]
  S24: $datepicker = $currentMonthYear;
  S34  : $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');

S24 → S55 [$datepicker]
  S24: $datepicker = $currentMonthYear;
  S55  : $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

S25 → S4 [$date]
  S25: $date = date('Y-m');
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S25 → S5 [$date]
  S25: $date = date('Y-m');
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S25 → S6 [$date]
  S25: $date = date('Y-m');
  S6  : return view('report.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1]]);

S25 → S8 [$date]
  S25: $date = date('Y-m');
  S8  : 'datepicker' => $date[1]

S25 → S13 [$date]
  S25: $date = date('Y-m');
  S13  : $date = $dateTime->format('m-Y');

S25 → S14 [$date]
  S25: $date = date('Y-m');
  S14  : $date = $this->getDate($date, $currentMonthYear);

S25 → S15 [$date]
  S25: $date = date('Y-m');
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S25 → S16 [$date]
  S25: $date = date('Y-m');
  S16  : return view('report.printformat.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1], 'today' => date('d F Y', strtotime(date('Y-m-d'))), 'title' => "Laporan Buku Besar"]);

S25 → S18 [$date]
  S25: $date = date('Y-m');
  S18  : 'datepicker' => $date[1]

S25 → S22 [$date]
  S25: $date = date('Y-m');
  S22  : $date = $parsedDate->format('Y-m');

S25 → S27 [$date]
  S25: $date = date('Y-m');
  S27  : return [$date, $formattedDate];

S25 → S28 [$date]
  S25: $date = date('Y-m');
  S28  : $date

S26 → S23 [$formattedDate]
  S26: $formattedDate = date('F Y');
  S23  : $formattedDate = $parsedDate->format('F Y');

S26 → S27 [$formattedDate]
  S26: $formattedDate = date('F Y');
  S27  : return [$date, $formattedDate];

S26 → S29 [$formattedDate]
  S26: $formattedDate = date('F Y');
  S29  : $formattedDate

S30 → S2 [$currentMonthYear]
  S30: public function getData($datepicker, $currentMonthYear)
  S2  : $currentMonthYear = date('Y-m');

S30 → S3 [$datepicker]
  S30: public function getData($datepicker, $currentMonthYear)
  S3  : $datepicker = $request->input('datepicker');

S30 → S4 [$datepicker]
  S30: public function getData($datepicker, $currentMonthYear)
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S30 → S4 [$currentMonthYear]
  S30: public function getData($datepicker, $currentMonthYear)
  S4  : $date = $this->getDate($datepicker, $currentMonthYear);

S30 → S5 [$currentMonthYear]
  S30: public function getData($datepicker, $currentMonthYear)
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S30 → S10 [$datepicker]
  S30: public function getData($datepicker, $currentMonthYear)
  S10  : $datepicker = $request->input('datepicker');

S30 → S11 [$currentMonthYear]
  S30: public function getData($datepicker, $currentMonthYear)
  S11  : $currentMonthYear = date('Y-m');

S30 → S12 [$datepicker]
  S30: public function getData($datepicker, $currentMonthYear)
  S12  : $dateTime = DateTime::createFromFormat('F Y', $datepicker);

S30 → S14 [$currentMonthYear]
  S30: public function getData($datepicker, $currentMonthYear)
  S14  : $date = $this->getDate($date, $currentMonthYear);

S30 → S15 [$currentMonthYear]
  S30: public function getData($datepicker, $currentMonthYear)
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S30 → S20 [$datepicker]
  S30: public function getData($datepicker, $currentMonthYear)
  S20  : if (!empty($datepicker)) {

S30 → S21 [$datepicker]
  S30: public function getData($datepicker, $currentMonthYear)
  S21  : $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);

S30 → S24 [$datepicker]
  S30: public function getData($datepicker, $currentMonthYear)
  S24  : $datepicker = $currentMonthYear;

S30 → S24 [$currentMonthYear]
  S30: public function getData($datepicker, $currentMonthYear)
  S24  : $datepicker = $currentMonthYear;

S30 → S32 [$datepicker]
  S30: public function getData($datepicker, $currentMonthYear)
  S32  : if ($datepicker == $currentMonthYear) {

S30 → S32 [$currentMonthYear]
  S30: public function getData($datepicker, $currentMonthYear)
  S32  : if ($datepicker == $currentMonthYear) {

S30 → S34 [$datepicker]
  S30: public function getData($datepicker, $currentMonthYear)
  S34  : $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');

S30 → S55 [$datepicker]
  S30: public function getData($datepicker, $currentMonthYear)
  S55  : $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

S33 → S5 [$data]
  S33: $data = [];
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S33 → S6 [$data]
  S33: $data = [];
  S6  : return view('report.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1]]);

S33 → S7 [$data]
  S33: $data = [];
  S7  : 'data' => $data

S33 → S15 [$data]
  S33: $data = [];
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S33 → S16 [$data]
  S33: $data = [];
  S16  : return view('report.printformat.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1], 'today' => date('d F Y', strtotime(date('Y-m-d'))), 'title' => "Laporan Buku Besar"]);

S33 → S17 [$data]
  S33: $data = [];
  S17  : 'data' => $data

S33 → S47 [$data]
  S33: $data = [];
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S33 → S56 [$data]
  S33: $data = [];
  S56  : $data = [];

S33 → S67 [$data]
  S33: $data = [];
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S33 → S75 [$data]
  S33: $data = [];
  S75  : return $data;

S34 → S35 [$history]
  S34: $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
  S35  : $balanceHistory = empty($history->saldo) ? 0 : $history->saldo;

S34 → S57 [$history]
  S34: $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
  S57  : $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $monthAfter)->first('saldo');

S34 → S58 [$history]
  S34: $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
  S58  : $balance = empty($history->saldo) ? 0 : $history->saldo;

S35 → S39 [$balanceHistory]
  S35: $balanceHistory = empty($history->saldo) ? 0 : $history->saldo;
  S39  : $balance = $balanceHistory + ($currentKredit - $currentDebit);

S35 → S40 [$balanceHistory]
  S35: $balanceHistory = empty($history->saldo) ? 0 : $history->saldo;
  S40  : $balance = $balanceHistory + ($currentDebit - $currentKredit);

S36 → S39 [$currentDebit]
  S36: $currentDebit = $item->debit;
  S39  : $balance = $balanceHistory + ($currentKredit - $currentDebit);

S36 → S40 [$currentDebit]
  S36: $currentDebit = $item->debit;
  S40  : $balance = $balanceHistory + ($currentDebit - $currentKredit);

S37 → S39 [$currentKredit]
  S37: $currentKredit = $item->kredit;
  S39  : $balance = $balanceHistory + ($currentKredit - $currentDebit);

S37 → S40 [$currentKredit]
  S37: $currentKredit = $item->kredit;
  S40  : $balance = $balanceHistory + ($currentDebit - $currentKredit);

S39 → S40 [$balance]
  S39: $balance = $balanceHistory + ($currentKredit - $currentDebit);
  S40  : $balance = $balanceHistory + ($currentDebit - $currentKredit);

S39 → S42 [$balance]
  S39: $balance = $balanceHistory + ($currentKredit - $currentDebit);
  S42  : $debit = $balance;

S39 → S46 [$balance]
  S39: $balance = $balanceHistory + ($currentKredit - $currentDebit);
  S46  : $kredit = $balance;

S39 → S58 [$balance]
  S39: $balance = $balanceHistory + ($currentKredit - $currentDebit);
  S58  : $balance = empty($history->saldo) ? 0 : $history->saldo;

S39 → S60 [$balance]
  S39: $balance = $balanceHistory + ($currentKredit - $currentDebit);
  S60  : $balance = -$balance;

S39 → S62 [$balance]
  S39: $balance = $balanceHistory + ($currentKredit - $currentDebit);
  S62  : $debit = $balance;

S39 → S66 [$balance]
  S39: $balance = $balanceHistory + ($currentKredit - $currentDebit);
  S66  : $kredit = $balance;

S40 → S39 [$balance]
  S40: $balance = $balanceHistory + ($currentDebit - $currentKredit);
  S39  : $balance = $balanceHistory + ($currentKredit - $currentDebit);

S40 → S42 [$balance]
  S40: $balance = $balanceHistory + ($currentDebit - $currentKredit);
  S42  : $debit = $balance;

S40 → S46 [$balance]
  S40: $balance = $balanceHistory + ($currentDebit - $currentKredit);
  S46  : $kredit = $balance;

S40 → S58 [$balance]
  S40: $balance = $balanceHistory + ($currentDebit - $currentKredit);
  S58  : $balance = empty($history->saldo) ? 0 : $history->saldo;

S40 → S60 [$balance]
  S40: $balance = $balanceHistory + ($currentDebit - $currentKredit);
  S60  : $balance = -$balance;

S40 → S62 [$balance]
  S40: $balance = $balanceHistory + ($currentDebit - $currentKredit);
  S62  : $debit = $balance;

S40 → S66 [$balance]
  S40: $balance = $balanceHistory + ($currentDebit - $currentKredit);
  S66  : $kredit = $balance;

S42 → S45 [$debit]
  S42: $debit = $balance;
  S45  : $debit = 0;

S42 → S47 [$debit]
  S42: $debit = $balance;
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S42 → S54 [$debit]
  S42: $debit = $balance;
  S54  : 'debit' => $debit

S42 → S62 [$debit]
  S42: $debit = $balance;
  S62  : $debit = $balance;

S42 → S65 [$debit]
  S42: $debit = $balance;
  S65  : $debit = 0;

S42 → S67 [$debit]
  S42: $debit = $balance;
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S42 → S74 [$debit]
  S42: $debit = $balance;
  S74  : 'debit' => $debit

S43 → S46 [$kredit]
  S43: $kredit = 0;
  S46  : $kredit = $balance;

S43 → S47 [$kredit]
  S43: $kredit = 0;
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S43 → S53 [$kredit]
  S43: $kredit = 0;
  S53  : 'kredit' => $kredit

S43 → S63 [$kredit]
  S43: $kredit = 0;
  S63  : $kredit = 0;

S43 → S66 [$kredit]
  S43: $kredit = 0;
  S66  : $kredit = $balance;

S43 → S67 [$kredit]
  S43: $kredit = 0;
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S43 → S73 [$kredit]
  S43: $kredit = 0;
  S73  : 'kredit' => $kredit

S45 → S42 [$debit]
  S45: $debit = 0;
  S42  : $debit = $balance;

S45 → S47 [$debit]
  S45: $debit = 0;
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S45 → S54 [$debit]
  S45: $debit = 0;
  S54  : 'debit' => $debit

S45 → S62 [$debit]
  S45: $debit = 0;
  S62  : $debit = $balance;

S45 → S65 [$debit]
  S45: $debit = 0;
  S65  : $debit = 0;

S45 → S67 [$debit]
  S45: $debit = 0;
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S45 → S74 [$debit]
  S45: $debit = 0;
  S74  : 'debit' => $debit

S46 → S43 [$kredit]
  S46: $kredit = $balance;
  S43  : $kredit = 0;

S46 → S47 [$kredit]
  S46: $kredit = $balance;
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S46 → S53 [$kredit]
  S46: $kredit = $balance;
  S53  : 'kredit' => $kredit

S46 → S63 [$kredit]
  S46: $kredit = $balance;
  S63  : $kredit = 0;

S46 → S66 [$kredit]
  S46: $kredit = $balance;
  S66  : $kredit = $balance;

S46 → S67 [$kredit]
  S46: $kredit = $balance;
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S46 → S73 [$kredit]
  S46: $kredit = $balance;
  S73  : 'kredit' => $kredit

S55 → S57 [$monthAfter]
  S55: $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));
  S57  : $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $monthAfter)->first('saldo');

S56 → S5 [$data]
  S56: $data = [];
  S5  : $data = $this->getData($date[0], $currentMonthYear);

S56 → S6 [$data]
  S56: $data = [];
  S6  : return view('report.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1]]);

S56 → S7 [$data]
  S56: $data = [];
  S7  : 'data' => $data

S56 → S15 [$data]
  S56: $data = [];
  S15  : $data = $this->getData($date[0], $currentMonthYear);

S56 → S16 [$data]
  S56: $data = [];
  S16  : return view('report.printformat.bukubesarrekap')->with(['data' => $data, 'datepicker' => $date[1], 'today' => date('d F Y', strtotime(date('Y-m-d'))), 'title' => "Laporan Buku Besar"]);

S56 → S17 [$data]
  S56: $data = [];
  S17  : 'data' => $data

S56 → S33 [$data]
  S56: $data = [];
  S33  : $data = [];

S56 → S47 [$data]
  S56: $data = [];
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S56 → S67 [$data]
  S56: $data = [];
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S56 → S75 [$data]
  S56: $data = [];
  S75  : return $data;

S57 → S34 [$history]
  S57: $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $monthAfter)->first('saldo');
  S34  : $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');

S57 → S35 [$history]
  S57: $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $monthAfter)->first('saldo');
  S35  : $balanceHistory = empty($history->saldo) ? 0 : $history->saldo;

S57 → S58 [$history]
  S57: $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $monthAfter)->first('saldo');
  S58  : $balance = empty($history->saldo) ? 0 : $history->saldo;

S58 → S39 [$balance]
  S58: $balance = empty($history->saldo) ? 0 : $history->saldo;
  S39  : $balance = $balanceHistory + ($currentKredit - $currentDebit);

S58 → S40 [$balance]
  S58: $balance = empty($history->saldo) ? 0 : $history->saldo;
  S40  : $balance = $balanceHistory + ($currentDebit - $currentKredit);

S58 → S42 [$balance]
  S58: $balance = empty($history->saldo) ? 0 : $history->saldo;
  S42  : $debit = $balance;

S58 → S46 [$balance]
  S58: $balance = empty($history->saldo) ? 0 : $history->saldo;
  S46  : $kredit = $balance;

S58 → S60 [$balance]
  S58: $balance = empty($history->saldo) ? 0 : $history->saldo;
  S60  : $balance = -$balance;

S58 → S62 [$balance]
  S58: $balance = empty($history->saldo) ? 0 : $history->saldo;
  S62  : $debit = $balance;

S58 → S66 [$balance]
  S58: $balance = empty($history->saldo) ? 0 : $history->saldo;
  S66  : $kredit = $balance;

S60 → S39 [$balance]
  S60: $balance = -$balance;
  S39  : $balance = $balanceHistory + ($currentKredit - $currentDebit);

S60 → S40 [$balance]
  S60: $balance = -$balance;
  S40  : $balance = $balanceHistory + ($currentDebit - $currentKredit);

S60 → S42 [$balance]
  S60: $balance = -$balance;
  S42  : $debit = $balance;

S60 → S46 [$balance]
  S60: $balance = -$balance;
  S46  : $kredit = $balance;

S60 → S58 [$balance]
  S60: $balance = -$balance;
  S58  : $balance = empty($history->saldo) ? 0 : $history->saldo;

S60 → S62 [$balance]
  S60: $balance = -$balance;
  S62  : $debit = $balance;

S60 → S66 [$balance]
  S60: $balance = -$balance;
  S66  : $kredit = $balance;

S62 → S42 [$debit]
  S62: $debit = $balance;
  S42  : $debit = $balance;

S62 → S45 [$debit]
  S62: $debit = $balance;
  S45  : $debit = 0;

S62 → S47 [$debit]
  S62: $debit = $balance;
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S62 → S54 [$debit]
  S62: $debit = $balance;
  S54  : 'debit' => $debit

S62 → S65 [$debit]
  S62: $debit = $balance;
  S65  : $debit = 0;

S62 → S67 [$debit]
  S62: $debit = $balance;
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S62 → S74 [$debit]
  S62: $debit = $balance;
  S74  : 'debit' => $debit

S63 → S43 [$kredit]
  S63: $kredit = 0;
  S43  : $kredit = 0;

S63 → S46 [$kredit]
  S63: $kredit = 0;
  S46  : $kredit = $balance;

S63 → S47 [$kredit]
  S63: $kredit = 0;
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S63 → S53 [$kredit]
  S63: $kredit = 0;
  S53  : 'kredit' => $kredit

S63 → S66 [$kredit]
  S63: $kredit = 0;
  S66  : $kredit = $balance;

S63 → S67 [$kredit]
  S63: $kredit = 0;
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S63 → S73 [$kredit]
  S63: $kredit = 0;
  S73  : 'kredit' => $kredit

S65 → S42 [$debit]
  S65: $debit = 0;
  S42  : $debit = $balance;

S65 → S45 [$debit]
  S65: $debit = 0;
  S45  : $debit = 0;

S65 → S47 [$debit]
  S65: $debit = 0;
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S65 → S54 [$debit]
  S65: $debit = 0;
  S54  : 'debit' => $debit

S65 → S62 [$debit]
  S65: $debit = 0;
  S62  : $debit = $balance;

S65 → S67 [$debit]
  S65: $debit = 0;
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S65 → S74 [$debit]
  S65: $debit = 0;
  S74  : 'debit' => $debit

S66 → S43 [$kredit]
  S66: $kredit = $balance;
  S43  : $kredit = 0;

S66 → S46 [$kredit]
  S66: $kredit = $balance;
  S46  : $kredit = $balance;

S66 → S47 [$kredit]
  S66: $kredit = $balance;
  S47  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S66 → S53 [$kredit]
  S66: $kredit = $balance;
  S53  : 'kredit' => $kredit

S66 → S63 [$kredit]
  S66: $kredit = $balance;
  S63  : $kredit = 0;

S66 → S67 [$kredit]
  S66: $kredit = $balance;
  S67  : $data[$item->id] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'lajurSaldo' => $item->lajurSaldo, 'lajurLaporan' => $item->lajurLaporan, 'kredit' => $kredit, 'debit' => $debit];

S66 → S73 [$kredit]
  S66: $kredit = $balance;
  S73  : 'kredit' => $kredit

