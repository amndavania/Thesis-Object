
🔥 Kandidat Extract Method: S20 (jumlah dependency: 6)
=== POTONGAN KODE (TERMINAL) ===
if (!empty($datepicker)) {
$parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
$date = $parsedDate->format('Y-m');
$formattedDate = $parsedDate->format('F Y');
$datepicker = $currentMonthYear;
$date = date('Y-m');
$formattedDate = date('F Y');

=== DARI FILE SEBENARNYA ===
        if (!empty($datepicker)) {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $date = $parsedDate->format('Y-m');
            $formattedDate = $parsedDate->format('F Y');
            $datepicker = $currentMonthYear;
            $date = date('Y-m');
            $formattedDate = date('F Y');

---------------------------

🔥 Kandidat Extract Method: S32 (jumlah dependency: 36)
=== POTONGAN KODE (TERMINAL) ===
if ($datepicker == $currentMonthYear) {
$data = [];
$history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
$balanceHistory = empty($history->saldo) ? 0 : $history->saldo;
$currentDebit = $item->debit;
$currentKredit = $item->kredit;
$balance = $balanceHistory + ($currentKredit - $currentDebit);
$balance = $balanceHistory + ($currentDebit - $currentKredit);
$debit = $balance;
$kredit = 0;
$debit = 0;
$kredit = $balance;
$monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));
$data = [];
$history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $monthAfter)->first('saldo');
$balance = empty($history->saldo) ? 0 : $history->saldo;
$balance = -$balance;
$debit = $balance;
$kredit = 0;
$debit = 0;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
        if ($datepicker == $currentMonthYear) {
            $data = [];
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
                $balanceHistory = empty($history->saldo) ? 0 : $history->saldo;
                $currentDebit = $item->debit;
                $currentKredit = $item->kredit;
                    $balance = $balanceHistory + ($currentKredit - $currentDebit);
                    $balance = $balanceHistory + ($currentDebit - $currentKredit);
                    $debit = $balance;
                    $kredit = 0;
                    $debit = 0;
                    $kredit = $balance;
            $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));
            $data = [];
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $monthAfter)->first('saldo');
                $balance = empty($history->saldo) ? 0 : $history->saldo;
                    $balance = -$balance;
                    $debit = $balance;
                    $kredit = 0;
                    $debit = 0;
                    $kredit = $balance;

---------------------------

🔥 Kandidat Extract Method: S41 (jumlah dependency: 4)
=== POTONGAN KODE (TERMINAL) ===
if ($item->lajurSaldo == 'debit') {
$debit = $balance;
$kredit = 0;
$debit = 0;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
                if ($item->lajurSaldo == 'debit') {
                    $debit = $balance;
                    $kredit = 0;
                    $debit = 0;
                    $kredit = $balance;

---------------------------

🔥 Kandidat Extract Method: S61 (jumlah dependency: 4)
=== POTONGAN KODE (TERMINAL) ===
if ($item->lajurSaldo == 'debit') {
$debit = $balance;
$kredit = 0;
$debit = 0;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
                if ($item->lajurSaldo == 'debit') {
                    $debit = $balance;
                    $kredit = 0;
                    $debit = 0;
                    $kredit = $balance;

---------------------------

🔥 Kandidat Extract Method: S2 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$currentMonthYear = date('Y-m');
$date = $this->getDate($datepicker, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$currentMonthYear = date('Y-m');
$date = $this->getDate($date, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$datepicker = $currentMonthYear;
if ($datepicker == $currentMonthYear) {

=== DARI FILE SEBENARNYA ===
        $currentMonthYear = date('Y-m');
        $date = $this->getDate($datepicker, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
        $currentMonthYear = date('Y-m');
        $date = $this->getDate($date, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $datepicker = $currentMonthYear;
        if ($datepicker == $currentMonthYear) {

---------------------------

🔥 Kandidat Extract Method: S3 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$datepicker = $request->input('datepicker');
$date = $this->getDate($datepicker, $currentMonthYear);
$datepicker = $request->input('datepicker');
$dateTime = DateTime::createFromFormat('F Y', $datepicker);
if (!empty($datepicker)) {
$parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
$datepicker = $currentMonthYear;
if ($datepicker == $currentMonthYear) {
$history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
$monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

=== DARI FILE SEBENARNYA ===
        $datepicker = $request->input('datepicker');
        $date = $this->getDate($datepicker, $currentMonthYear);
        $datepicker = $request->input('datepicker');
        $dateTime = DateTime::createFromFormat('F Y', $datepicker);
        if (!empty($datepicker)) {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $datepicker = $currentMonthYear;
        if ($datepicker == $currentMonthYear) {
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
            $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

---------------------------

🔥 Kandidat Extract Method: S4 (jumlah dependency: 12)
=== POTONGAN KODE (TERMINAL) ===
$date = $this->getDate($datepicker, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$date = $dateTime->format('m-Y');
$date = $this->getDate($date, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$date = $parsedDate->format('Y-m');
$date = date('Y-m');

=== DARI FILE SEBENARNYA ===
        $date = $this->getDate($datepicker, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
        $date = $dateTime->format('m-Y');
        $date = $this->getDate($date, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $date = $parsedDate->format('Y-m');
            $date = date('Y-m');

---------------------------

🔥 Kandidat Extract Method: S5 (jumlah dependency: 10)
=== POTONGAN KODE (TERMINAL) ===
$data = $this->getData($date[0], $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$data = [];
$data = [];

=== DARI FILE SEBENARNYA ===
        $data = $this->getData($date[0], $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $data = [];
            $data = [];

---------------------------

🔥 Kandidat Extract Method: S10 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$datepicker = $request->input('datepicker');
$date = $this->getDate($datepicker, $currentMonthYear);
$datepicker = $request->input('datepicker');
$dateTime = DateTime::createFromFormat('F Y', $datepicker);
if (!empty($datepicker)) {
$parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
$datepicker = $currentMonthYear;
if ($datepicker == $currentMonthYear) {
$history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
$monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

=== DARI FILE SEBENARNYA ===
        $datepicker = $request->input('datepicker');
        $date = $this->getDate($datepicker, $currentMonthYear);
        $datepicker = $request->input('datepicker');
        $dateTime = DateTime::createFromFormat('F Y', $datepicker);
        if (!empty($datepicker)) {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $datepicker = $currentMonthYear;
        if ($datepicker == $currentMonthYear) {
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
            $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

---------------------------

🔥 Kandidat Extract Method: S11 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$currentMonthYear = date('Y-m');
$date = $this->getDate($datepicker, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$currentMonthYear = date('Y-m');
$date = $this->getDate($date, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$datepicker = $currentMonthYear;
if ($datepicker == $currentMonthYear) {

=== DARI FILE SEBENARNYA ===
        $currentMonthYear = date('Y-m');
        $date = $this->getDate($datepicker, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
        $currentMonthYear = date('Y-m');
        $date = $this->getDate($date, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $datepicker = $currentMonthYear;
        if ($datepicker == $currentMonthYear) {

---------------------------

🔥 Kandidat Extract Method: S13 (jumlah dependency: 12)
=== POTONGAN KODE (TERMINAL) ===
$date = $this->getDate($datepicker, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$date = $dateTime->format('m-Y');
$date = $this->getDate($date, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$date = $parsedDate->format('Y-m');
$date = date('Y-m');

=== DARI FILE SEBENARNYA ===
        $date = $this->getDate($datepicker, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
        $date = $dateTime->format('m-Y');
        $date = $this->getDate($date, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $date = $parsedDate->format('Y-m');
            $date = date('Y-m');

---------------------------

🔥 Kandidat Extract Method: S14 (jumlah dependency: 12)
=== POTONGAN KODE (TERMINAL) ===
$date = $this->getDate($datepicker, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$date = $dateTime->format('m-Y');
$date = $this->getDate($date, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$date = $parsedDate->format('Y-m');
$date = date('Y-m');

=== DARI FILE SEBENARNYA ===
        $date = $this->getDate($datepicker, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
        $date = $dateTime->format('m-Y');
        $date = $this->getDate($date, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $date = $parsedDate->format('Y-m');
            $date = date('Y-m');

---------------------------

🔥 Kandidat Extract Method: S15 (jumlah dependency: 10)
=== POTONGAN KODE (TERMINAL) ===
$data = $this->getData($date[0], $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$data = [];
$data = [];

=== DARI FILE SEBENARNYA ===
        $data = $this->getData($date[0], $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $data = [];
            $data = [];

---------------------------

🔥 Kandidat Extract Method: S19 (jumlah dependency: 18)
=== POTONGAN KODE (TERMINAL) ===
$currentMonthYear = date('Y-m');
$datepicker = $request->input('datepicker');
$date = $this->getDate($datepicker, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$datepicker = $request->input('datepicker');
$currentMonthYear = date('Y-m');
$dateTime = DateTime::createFromFormat('F Y', $datepicker);
$date = $this->getDate($date, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
public function getDate($datepicker, $currentMonthYear)
if (!empty($datepicker)) {
$parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
$datepicker = $currentMonthYear;
if ($datepicker == $currentMonthYear) {
$history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
$monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

=== DARI FILE SEBENARNYA ===
        $currentMonthYear = date('Y-m');
        $datepicker = $request->input('datepicker');
        $date = $this->getDate($datepicker, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
        $datepicker = $request->input('datepicker');
        $currentMonthYear = date('Y-m');
        $dateTime = DateTime::createFromFormat('F Y', $datepicker);
        $date = $this->getDate($date, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
    public function getDate($datepicker, $currentMonthYear)
        if (!empty($datepicker)) {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $datepicker = $currentMonthYear;
        if ($datepicker == $currentMonthYear) {
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
            $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

---------------------------

🔥 Kandidat Extract Method: S22 (jumlah dependency: 12)
=== POTONGAN KODE (TERMINAL) ===
$date = $this->getDate($datepicker, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$date = $dateTime->format('m-Y');
$date = $this->getDate($date, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$date = $parsedDate->format('Y-m');
$date = date('Y-m');

=== DARI FILE SEBENARNYA ===
        $date = $this->getDate($datepicker, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
        $date = $dateTime->format('m-Y');
        $date = $this->getDate($date, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $date = $parsedDate->format('Y-m');
            $date = date('Y-m');

---------------------------

🔥 Kandidat Extract Method: S24 (jumlah dependency: 9)
=== POTONGAN KODE (TERMINAL) ===
$datepicker = $request->input('datepicker');
$date = $this->getDate($datepicker, $currentMonthYear);
$datepicker = $request->input('datepicker');
$dateTime = DateTime::createFromFormat('F Y', $datepicker);
if (!empty($datepicker)) {
$parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
$datepicker = $currentMonthYear;
if ($datepicker == $currentMonthYear) {
$history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
$monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

=== DARI FILE SEBENARNYA ===
        $datepicker = $request->input('datepicker');
        $date = $this->getDate($datepicker, $currentMonthYear);
        $datepicker = $request->input('datepicker');
        $dateTime = DateTime::createFromFormat('F Y', $datepicker);
        if (!empty($datepicker)) {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $datepicker = $currentMonthYear;
        if ($datepicker == $currentMonthYear) {
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
            $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

---------------------------

🔥 Kandidat Extract Method: S25 (jumlah dependency: 12)
=== POTONGAN KODE (TERMINAL) ===
$date = $this->getDate($datepicker, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$date = $dateTime->format('m-Y');
$date = $this->getDate($date, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$date = $parsedDate->format('Y-m');
$date = date('Y-m');

=== DARI FILE SEBENARNYA ===
        $date = $this->getDate($datepicker, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
        $date = $dateTime->format('m-Y');
        $date = $this->getDate($date, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $date = $parsedDate->format('Y-m');
            $date = date('Y-m');

---------------------------

🔥 Kandidat Extract Method: S30 (jumlah dependency: 18)
=== POTONGAN KODE (TERMINAL) ===
$currentMonthYear = date('Y-m');
$datepicker = $request->input('datepicker');
$date = $this->getDate($datepicker, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$datepicker = $request->input('datepicker');
$currentMonthYear = date('Y-m');
$dateTime = DateTime::createFromFormat('F Y', $datepicker);
$date = $this->getDate($date, $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
if (!empty($datepicker)) {
$parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
$datepicker = $currentMonthYear;
public function getData($datepicker, $currentMonthYear)
if ($datepicker == $currentMonthYear) {
$history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
$monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

=== DARI FILE SEBENARNYA ===
        $currentMonthYear = date('Y-m');
        $datepicker = $request->input('datepicker');
        $date = $this->getDate($datepicker, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
        $datepicker = $request->input('datepicker');
        $currentMonthYear = date('Y-m');
        $dateTime = DateTime::createFromFormat('F Y', $datepicker);
        $date = $this->getDate($date, $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
        if (!empty($datepicker)) {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $datepicker = $currentMonthYear;
    public function getData($datepicker, $currentMonthYear)
        if ($datepicker == $currentMonthYear) {
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');
            $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));

---------------------------

🔥 Kandidat Extract Method: S33 (jumlah dependency: 10)
=== POTONGAN KODE (TERMINAL) ===
$data = $this->getData($date[0], $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$data = [];
$data = [];

=== DARI FILE SEBENARNYA ===
        $data = $this->getData($date[0], $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $data = [];
            $data = [];

---------------------------

🔥 Kandidat Extract Method: S39 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$balance = $balanceHistory + ($currentKredit - $currentDebit);
$balance = $balanceHistory + ($currentDebit - $currentKredit);
$debit = $balance;
$kredit = $balance;
$balance = empty($history->saldo) ? 0 : $history->saldo;
$balance = -$balance;
$debit = $balance;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
                    $balance = $balanceHistory + ($currentKredit - $currentDebit);
                    $balance = $balanceHistory + ($currentDebit - $currentKredit);
                    $debit = $balance;
                    $kredit = $balance;
                $balance = empty($history->saldo) ? 0 : $history->saldo;
                    $balance = -$balance;
                    $debit = $balance;
                    $kredit = $balance;

---------------------------

🔥 Kandidat Extract Method: S40 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$balance = $balanceHistory + ($currentKredit - $currentDebit);
$balance = $balanceHistory + ($currentDebit - $currentKredit);
$debit = $balance;
$kredit = $balance;
$balance = empty($history->saldo) ? 0 : $history->saldo;
$balance = -$balance;
$debit = $balance;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
                    $balance = $balanceHistory + ($currentKredit - $currentDebit);
                    $balance = $balanceHistory + ($currentDebit - $currentKredit);
                    $debit = $balance;
                    $kredit = $balance;
                $balance = empty($history->saldo) ? 0 : $history->saldo;
                    $balance = -$balance;
                    $debit = $balance;
                    $kredit = $balance;

---------------------------

🔥 Kandidat Extract Method: S42 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$debit = $balance;
$debit = 0;
$debit = $balance;
$debit = 0;

=== DARI FILE SEBENARNYA ===
                    $debit = $balance;
                    $debit = 0;
                    $debit = $balance;
                    $debit = 0;

---------------------------

🔥 Kandidat Extract Method: S43 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$kredit = 0;
$kredit = $balance;
$kredit = 0;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
                    $kredit = 0;
                    $kredit = $balance;
                    $kredit = 0;
                    $kredit = $balance;

---------------------------

🔥 Kandidat Extract Method: S45 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$debit = $balance;
$debit = 0;
$debit = $balance;
$debit = 0;

=== DARI FILE SEBENARNYA ===
                    $debit = $balance;
                    $debit = 0;
                    $debit = $balance;
                    $debit = 0;

---------------------------

🔥 Kandidat Extract Method: S46 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$kredit = 0;
$kredit = $balance;
$kredit = 0;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
                    $kredit = 0;
                    $kredit = $balance;
                    $kredit = 0;
                    $kredit = $balance;

---------------------------

🔥 Kandidat Extract Method: S56 (jumlah dependency: 10)
=== POTONGAN KODE (TERMINAL) ===
$data = $this->getData($date[0], $currentMonthYear);
$data = $this->getData($date[0], $currentMonthYear);
$data = [];
$data = [];

=== DARI FILE SEBENARNYA ===
        $data = $this->getData($date[0], $currentMonthYear);
        $data = $this->getData($date[0], $currentMonthYear);
            $data = [];
            $data = [];

---------------------------

🔥 Kandidat Extract Method: S58 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$balance = $balanceHistory + ($currentKredit - $currentDebit);
$balance = $balanceHistory + ($currentDebit - $currentKredit);
$debit = $balance;
$kredit = $balance;
$balance = empty($history->saldo) ? 0 : $history->saldo;
$balance = -$balance;
$debit = $balance;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
                    $balance = $balanceHistory + ($currentKredit - $currentDebit);
                    $balance = $balanceHistory + ($currentDebit - $currentKredit);
                    $debit = $balance;
                    $kredit = $balance;
                $balance = empty($history->saldo) ? 0 : $history->saldo;
                    $balance = -$balance;
                    $debit = $balance;
                    $kredit = $balance;

---------------------------

🔥 Kandidat Extract Method: S60 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$balance = $balanceHistory + ($currentKredit - $currentDebit);
$balance = $balanceHistory + ($currentDebit - $currentKredit);
$debit = $balance;
$kredit = $balance;
$balance = empty($history->saldo) ? 0 : $history->saldo;
$balance = -$balance;
$debit = $balance;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
                    $balance = $balanceHistory + ($currentKredit - $currentDebit);
                    $balance = $balanceHistory + ($currentDebit - $currentKredit);
                    $debit = $balance;
                    $kredit = $balance;
                $balance = empty($history->saldo) ? 0 : $history->saldo;
                    $balance = -$balance;
                    $debit = $balance;
                    $kredit = $balance;

---------------------------

🔥 Kandidat Extract Method: S62 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$debit = $balance;
$debit = 0;
$debit = $balance;
$debit = 0;

=== DARI FILE SEBENARNYA ===
                    $debit = $balance;
                    $debit = 0;
                    $debit = $balance;
                    $debit = 0;

---------------------------

🔥 Kandidat Extract Method: S63 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$kredit = 0;
$kredit = $balance;
$kredit = 0;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
                    $kredit = 0;
                    $kredit = $balance;
                    $kredit = 0;
                    $kredit = $balance;

---------------------------

🔥 Kandidat Extract Method: S65 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$debit = $balance;
$debit = 0;
$debit = $balance;
$debit = 0;

=== DARI FILE SEBENARNYA ===
                    $debit = $balance;
                    $debit = 0;
                    $debit = $balance;
                    $debit = 0;

---------------------------

🔥 Kandidat Extract Method: S66 (jumlah dependency: 7)
=== POTONGAN KODE (TERMINAL) ===
$kredit = 0;
$kredit = $balance;
$kredit = 0;
$kredit = $balance;

=== DARI FILE SEBENARNYA ===
                    $kredit = 0;
                    $kredit = $balance;
                    $kredit = 0;
                    $kredit = $balance;

---------------------------

🏁 Ranking Kandidat Extract Method Berdasarkan Jumlah Dependency:
1. S32 (Jumlah Dependency: 36)
2. S19 (Jumlah Dependency: 18)
3. S30 (Jumlah Dependency: 18)
4. S4 (Jumlah Dependency: 12)
5. S13 (Jumlah Dependency: 12)
6. S14 (Jumlah Dependency: 12)
7. S22 (Jumlah Dependency: 12)
8. S25 (Jumlah Dependency: 12)
9. S5 (Jumlah Dependency: 10)
10. S15 (Jumlah Dependency: 10)
11. S33 (Jumlah Dependency: 10)
12. S56 (Jumlah Dependency: 10)
13. S3 (Jumlah Dependency: 9)
14. S10 (Jumlah Dependency: 9)
15. S24 (Jumlah Dependency: 9)
16. S2 (Jumlah Dependency: 7)
17. S11 (Jumlah Dependency: 7)
18. S39 (Jumlah Dependency: 7)
19. S40 (Jumlah Dependency: 7)
20. S42 (Jumlah Dependency: 7)
21. S43 (Jumlah Dependency: 7)
22. S45 (Jumlah Dependency: 7)
23. S46 (Jumlah Dependency: 7)
24. S58 (Jumlah Dependency: 7)
25. S60 (Jumlah Dependency: 7)
26. S62 (Jumlah Dependency: 7)
27. S63 (Jumlah Dependency: 7)
28. S65 (Jumlah Dependency: 7)
29. S66 (Jumlah Dependency: 7)
30. S20 (Jumlah Dependency: 6)
31. S41 (Jumlah Dependency: 4)
32. S61 (Jumlah Dependency: 4)
