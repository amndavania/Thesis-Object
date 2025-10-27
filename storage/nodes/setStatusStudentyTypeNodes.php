
--- Control Dependencies (Grouped & Ordered by Controller) ---
S2 → S3
  S2: if ($payment_type == 'UKT') {
  S3  : $totalKRS = floatval($student_type->krs);

S2 → S4
  S2: if ($payment_type == 'UKT') {
  S4  : $totalUTS = $totalKRS + $student_type->uts;

S2 → S5
  S2: if ($payment_type == 'UKT') {
  S5  : $totalUAS = $totalUTS + $student_type->uas;

S2 → S7
  S2: if ($payment_type == 'UKT') {
  S7  : $status = 'Lebih';

S2 → S9
  S2: if ($payment_type == 'UKT') {
  S9  : $status = 'Lunas';

S2 → S11
  S2: if ($payment_type == 'UKT') {
  S11  : $status = 'Lunas UTS';

S2 → S13
  S2: if ($payment_type == 'UKT') {
  S13  : $status = 'Lunas KRS';

S2 → S14
  S2: if ($payment_type == 'UKT') {
  S14  : $status = 'Belum Lunas';

S2 → S17
  S2: if ($payment_type == 'UKT') {
  S17  : $status = 'Belum Lunas';

S2 → S19
  S2: if ($payment_type == 'UKT') {
  S19  : $status = 'Lunas';

S2 → S21
  S2: if ($payment_type == 'UKT') {
  S21  : $status = 'Lebih';

S2 → S24
  S2: if ($payment_type == 'UKT') {
  S24  : $status = 'Belum Lunas';

S2 → S26
  S2: if ($payment_type == 'UKT') {
  S26  : $status = 'Lunas';

S2 → S28
  S2: if ($payment_type == 'UKT') {
  S28  : $status = 'Lebih';

S6 → S7
  S6: if ($amount > $totalUAS) {
  S7  : $status = 'Lebih';

S6 → S9
  S6: if ($amount > $totalUAS) {
  S9  : $status = 'Lunas';

S6 → S11
  S6: if ($amount > $totalUAS) {
  S11  : $status = 'Lunas UTS';

S6 → S13
  S6: if ($amount > $totalUAS) {
  S13  : $status = 'Lunas KRS';

S6 → S14
  S6: if ($amount > $totalUAS) {
  S14  : $status = 'Belum Lunas';

S8 → S9
  S8: elseif ($amount == $totalUAS) {
  S9  : $status = 'Lunas';

S10 → S11
  S10: elseif ($amount >= $totalUTS) {
  S11  : $status = 'Lunas UTS';

S12 → S13
  S12: elseif ($amount >= $totalKRS) {
  S13  : $status = 'Lunas KRS';

S15 → S17
  S15: elseif ($payment_type == 'DPP') {
  S17  : $status = 'Belum Lunas';

S15 → S19
  S15: elseif ($payment_type == 'DPP') {
  S19  : $status = 'Lunas';

S15 → S21
  S15: elseif ($payment_type == 'DPP') {
  S21  : $status = 'Lebih';

S16 → S17
  S16: if ($amount < $student_type->dpp) {
  S17  : $status = 'Belum Lunas';

S16 → S19
  S16: if ($amount < $student_type->dpp) {
  S19  : $status = 'Lunas';

S16 → S21
  S16: if ($amount < $student_type->dpp) {
  S21  : $status = 'Lebih';

S18 → S19
  S18: elseif ($amount == $student_type->dpp) {
  S19  : $status = 'Lunas';

S20 → S21
  S20: elseif ($amount > $student_type->dpp) {
  S21  : $status = 'Lebih';

S22 → S24
  S22: elseif ($payment_type == 'WISUDA') {
  S24  : $status = 'Belum Lunas';

S22 → S26
  S22: elseif ($payment_type == 'WISUDA') {
  S26  : $status = 'Lunas';

S22 → S28
  S22: elseif ($payment_type == 'WISUDA') {
  S28  : $status = 'Lebih';

S23 → S24
  S23: if ($amount < $student_type->wisuda) {
  S24  : $status = 'Belum Lunas';

S23 → S26
  S23: if ($amount < $student_type->wisuda) {
  S26  : $status = 'Lunas';

S23 → S28
  S23: if ($amount < $student_type->wisuda) {
  S28  : $status = 'Lebih';

S25 → S26
  S25: elseif ($amount == $student_type->wisuda) {
  S26  : $status = 'Lunas';

S27 → S28
  S27: elseif ($amount > $student_type->wisuda) {
  S28  : $status = 'Lebih';


--- Data Dependencies (Grouped & Ordered by Definer) ---
S1 → S2 [$payment_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S2  : if ($payment_type == 'UKT') {

S1 → S3 [$student_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S3  : $totalKRS = floatval($student_type->krs);

S1 → S4 [$student_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S4  : $totalUTS = $totalKRS + $student_type->uts;

S1 → S5 [$student_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S5  : $totalUAS = $totalUTS + $student_type->uas;

S1 → S6 [$amount]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S6  : if ($amount > $totalUAS) {

S1 → S8 [$amount]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S8  : elseif ($amount == $totalUAS) {

S1 → S10 [$amount]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S10  : elseif ($amount >= $totalUTS) {

S1 → S12 [$amount]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S12  : elseif ($amount >= $totalKRS) {

S1 → S15 [$payment_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S15  : elseif ($payment_type == 'DPP') {

S1 → S16 [$amount]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S16  : if ($amount < $student_type->dpp) {

S1 → S16 [$student_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S16  : if ($amount < $student_type->dpp) {

S1 → S18 [$amount]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S18  : elseif ($amount == $student_type->dpp) {

S1 → S18 [$student_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S18  : elseif ($amount == $student_type->dpp) {

S1 → S20 [$amount]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S20  : elseif ($amount > $student_type->dpp) {

S1 → S20 [$student_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S20  : elseif ($amount > $student_type->dpp) {

S1 → S22 [$payment_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S22  : elseif ($payment_type == 'WISUDA') {

S1 → S23 [$amount]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S23  : if ($amount < $student_type->wisuda) {

S1 → S23 [$student_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S23  : if ($amount < $student_type->wisuda) {

S1 → S25 [$amount]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S25  : elseif ($amount == $student_type->wisuda) {

S1 → S25 [$student_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S25  : elseif ($amount == $student_type->wisuda) {

S1 → S27 [$amount]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S27  : elseif ($amount > $student_type->wisuda) {

S1 → S27 [$student_type]
  S1: public function setStatus($amount, $payment_type, $student_type)
  S27  : elseif ($amount > $student_type->wisuda) {

S3 → S4 [$totalKRS]
  S3: $totalKRS = floatval($student_type->krs);
  S4  : $totalUTS = $totalKRS + $student_type->uts;

S3 → S12 [$totalKRS]
  S3: $totalKRS = floatval($student_type->krs);
  S12  : elseif ($amount >= $totalKRS) {

S4 → S5 [$totalUTS]
  S4: $totalUTS = $totalKRS + $student_type->uts;
  S5  : $totalUAS = $totalUTS + $student_type->uas;

S4 → S10 [$totalUTS]
  S4: $totalUTS = $totalKRS + $student_type->uts;
  S10  : elseif ($amount >= $totalUTS) {

S5 → S6 [$totalUAS]
  S5: $totalUAS = $totalUTS + $student_type->uas;
  S6  : if ($amount > $totalUAS) {

S5 → S8 [$totalUAS]
  S5: $totalUAS = $totalUTS + $student_type->uas;
  S8  : elseif ($amount == $totalUAS) {

S7 → S9 [$status]
  S7: $status = 'Lebih';
  S9  : $status = 'Lunas';

S7 → S11 [$status]
  S7: $status = 'Lebih';
  S11  : $status = 'Lunas UTS';

S7 → S13 [$status]
  S7: $status = 'Lebih';
  S13  : $status = 'Lunas KRS';

S7 → S14 [$status]
  S7: $status = 'Lebih';
  S14  : $status = 'Belum Lunas';

S7 → S17 [$status]
  S7: $status = 'Lebih';
  S17  : $status = 'Belum Lunas';

S7 → S19 [$status]
  S7: $status = 'Lebih';
  S19  : $status = 'Lunas';

S7 → S21 [$status]
  S7: $status = 'Lebih';
  S21  : $status = 'Lebih';

S7 → S24 [$status]
  S7: $status = 'Lebih';
  S24  : $status = 'Belum Lunas';

S7 → S26 [$status]
  S7: $status = 'Lebih';
  S26  : $status = 'Lunas';

S7 → S28 [$status]
  S7: $status = 'Lebih';
  S28  : $status = 'Lebih';

S7 → S29 [$status]
  S7: $status = 'Lebih';
  S29  : return $status;

S9 → S7 [$status]
  S9: $status = 'Lunas';
  S7  : $status = 'Lebih';

S9 → S11 [$status]
  S9: $status = 'Lunas';
  S11  : $status = 'Lunas UTS';

S9 → S13 [$status]
  S9: $status = 'Lunas';
  S13  : $status = 'Lunas KRS';

S9 → S14 [$status]
  S9: $status = 'Lunas';
  S14  : $status = 'Belum Lunas';

S9 → S17 [$status]
  S9: $status = 'Lunas';
  S17  : $status = 'Belum Lunas';

S9 → S19 [$status]
  S9: $status = 'Lunas';
  S19  : $status = 'Lunas';

S9 → S21 [$status]
  S9: $status = 'Lunas';
  S21  : $status = 'Lebih';

S9 → S24 [$status]
  S9: $status = 'Lunas';
  S24  : $status = 'Belum Lunas';

S9 → S26 [$status]
  S9: $status = 'Lunas';
  S26  : $status = 'Lunas';

S9 → S28 [$status]
  S9: $status = 'Lunas';
  S28  : $status = 'Lebih';

S9 → S29 [$status]
  S9: $status = 'Lunas';
  S29  : return $status;

S11 → S7 [$status]
  S11: $status = 'Lunas UTS';
  S7  : $status = 'Lebih';

S11 → S9 [$status]
  S11: $status = 'Lunas UTS';
  S9  : $status = 'Lunas';

S11 → S13 [$status]
  S11: $status = 'Lunas UTS';
  S13  : $status = 'Lunas KRS';

S11 → S14 [$status]
  S11: $status = 'Lunas UTS';
  S14  : $status = 'Belum Lunas';

S11 → S17 [$status]
  S11: $status = 'Lunas UTS';
  S17  : $status = 'Belum Lunas';

S11 → S19 [$status]
  S11: $status = 'Lunas UTS';
  S19  : $status = 'Lunas';

S11 → S21 [$status]
  S11: $status = 'Lunas UTS';
  S21  : $status = 'Lebih';

S11 → S24 [$status]
  S11: $status = 'Lunas UTS';
  S24  : $status = 'Belum Lunas';

S11 → S26 [$status]
  S11: $status = 'Lunas UTS';
  S26  : $status = 'Lunas';

S11 → S28 [$status]
  S11: $status = 'Lunas UTS';
  S28  : $status = 'Lebih';

S11 → S29 [$status]
  S11: $status = 'Lunas UTS';
  S29  : return $status;

S13 → S7 [$status]
  S13: $status = 'Lunas KRS';
  S7  : $status = 'Lebih';

S13 → S9 [$status]
  S13: $status = 'Lunas KRS';
  S9  : $status = 'Lunas';

S13 → S11 [$status]
  S13: $status = 'Lunas KRS';
  S11  : $status = 'Lunas UTS';

S13 → S14 [$status]
  S13: $status = 'Lunas KRS';
  S14  : $status = 'Belum Lunas';

S13 → S17 [$status]
  S13: $status = 'Lunas KRS';
  S17  : $status = 'Belum Lunas';

S13 → S19 [$status]
  S13: $status = 'Lunas KRS';
  S19  : $status = 'Lunas';

S13 → S21 [$status]
  S13: $status = 'Lunas KRS';
  S21  : $status = 'Lebih';

S13 → S24 [$status]
  S13: $status = 'Lunas KRS';
  S24  : $status = 'Belum Lunas';

S13 → S26 [$status]
  S13: $status = 'Lunas KRS';
  S26  : $status = 'Lunas';

S13 → S28 [$status]
  S13: $status = 'Lunas KRS';
  S28  : $status = 'Lebih';

S13 → S29 [$status]
  S13: $status = 'Lunas KRS';
  S29  : return $status;

S14 → S7 [$status]
  S14: $status = 'Belum Lunas';
  S7  : $status = 'Lebih';

S14 → S9 [$status]
  S14: $status = 'Belum Lunas';
  S9  : $status = 'Lunas';

S14 → S11 [$status]
  S14: $status = 'Belum Lunas';
  S11  : $status = 'Lunas UTS';

S14 → S13 [$status]
  S14: $status = 'Belum Lunas';
  S13  : $status = 'Lunas KRS';

S14 → S17 [$status]
  S14: $status = 'Belum Lunas';
  S17  : $status = 'Belum Lunas';

S14 → S19 [$status]
  S14: $status = 'Belum Lunas';
  S19  : $status = 'Lunas';

S14 → S21 [$status]
  S14: $status = 'Belum Lunas';
  S21  : $status = 'Lebih';

S14 → S24 [$status]
  S14: $status = 'Belum Lunas';
  S24  : $status = 'Belum Lunas';

S14 → S26 [$status]
  S14: $status = 'Belum Lunas';
  S26  : $status = 'Lunas';

S14 → S28 [$status]
  S14: $status = 'Belum Lunas';
  S28  : $status = 'Lebih';

S14 → S29 [$status]
  S14: $status = 'Belum Lunas';
  S29  : return $status;

S17 → S7 [$status]
  S17: $status = 'Belum Lunas';
  S7  : $status = 'Lebih';

S17 → S9 [$status]
  S17: $status = 'Belum Lunas';
  S9  : $status = 'Lunas';

S17 → S11 [$status]
  S17: $status = 'Belum Lunas';
  S11  : $status = 'Lunas UTS';

S17 → S13 [$status]
  S17: $status = 'Belum Lunas';
  S13  : $status = 'Lunas KRS';

S17 → S14 [$status]
  S17: $status = 'Belum Lunas';
  S14  : $status = 'Belum Lunas';

S17 → S19 [$status]
  S17: $status = 'Belum Lunas';
  S19  : $status = 'Lunas';

S17 → S21 [$status]
  S17: $status = 'Belum Lunas';
  S21  : $status = 'Lebih';

S17 → S24 [$status]
  S17: $status = 'Belum Lunas';
  S24  : $status = 'Belum Lunas';

S17 → S26 [$status]
  S17: $status = 'Belum Lunas';
  S26  : $status = 'Lunas';

S17 → S28 [$status]
  S17: $status = 'Belum Lunas';
  S28  : $status = 'Lebih';

S17 → S29 [$status]
  S17: $status = 'Belum Lunas';
  S29  : return $status;

S19 → S7 [$status]
  S19: $status = 'Lunas';
  S7  : $status = 'Lebih';

S19 → S9 [$status]
  S19: $status = 'Lunas';
  S9  : $status = 'Lunas';

S19 → S11 [$status]
  S19: $status = 'Lunas';
  S11  : $status = 'Lunas UTS';

S19 → S13 [$status]
  S19: $status = 'Lunas';
  S13  : $status = 'Lunas KRS';

S19 → S14 [$status]
  S19: $status = 'Lunas';
  S14  : $status = 'Belum Lunas';

S19 → S17 [$status]
  S19: $status = 'Lunas';
  S17  : $status = 'Belum Lunas';

S19 → S21 [$status]
  S19: $status = 'Lunas';
  S21  : $status = 'Lebih';

S19 → S24 [$status]
  S19: $status = 'Lunas';
  S24  : $status = 'Belum Lunas';

S19 → S26 [$status]
  S19: $status = 'Lunas';
  S26  : $status = 'Lunas';

S19 → S28 [$status]
  S19: $status = 'Lunas';
  S28  : $status = 'Lebih';

S19 → S29 [$status]
  S19: $status = 'Lunas';
  S29  : return $status;

S21 → S7 [$status]
  S21: $status = 'Lebih';
  S7  : $status = 'Lebih';

S21 → S9 [$status]
  S21: $status = 'Lebih';
  S9  : $status = 'Lunas';

S21 → S11 [$status]
  S21: $status = 'Lebih';
  S11  : $status = 'Lunas UTS';

S21 → S13 [$status]
  S21: $status = 'Lebih';
  S13  : $status = 'Lunas KRS';

S21 → S14 [$status]
  S21: $status = 'Lebih';
  S14  : $status = 'Belum Lunas';

S21 → S17 [$status]
  S21: $status = 'Lebih';
  S17  : $status = 'Belum Lunas';

S21 → S19 [$status]
  S21: $status = 'Lebih';
  S19  : $status = 'Lunas';

S21 → S24 [$status]
  S21: $status = 'Lebih';
  S24  : $status = 'Belum Lunas';

S21 → S26 [$status]
  S21: $status = 'Lebih';
  S26  : $status = 'Lunas';

S21 → S28 [$status]
  S21: $status = 'Lebih';
  S28  : $status = 'Lebih';

S21 → S29 [$status]
  S21: $status = 'Lebih';
  S29  : return $status;

S24 → S7 [$status]
  S24: $status = 'Belum Lunas';
  S7  : $status = 'Lebih';

S24 → S9 [$status]
  S24: $status = 'Belum Lunas';
  S9  : $status = 'Lunas';

S24 → S11 [$status]
  S24: $status = 'Belum Lunas';
  S11  : $status = 'Lunas UTS';

S24 → S13 [$status]
  S24: $status = 'Belum Lunas';
  S13  : $status = 'Lunas KRS';

S24 → S14 [$status]
  S24: $status = 'Belum Lunas';
  S14  : $status = 'Belum Lunas';

S24 → S17 [$status]
  S24: $status = 'Belum Lunas';
  S17  : $status = 'Belum Lunas';

S24 → S19 [$status]
  S24: $status = 'Belum Lunas';
  S19  : $status = 'Lunas';

S24 → S21 [$status]
  S24: $status = 'Belum Lunas';
  S21  : $status = 'Lebih';

S24 → S26 [$status]
  S24: $status = 'Belum Lunas';
  S26  : $status = 'Lunas';

S24 → S28 [$status]
  S24: $status = 'Belum Lunas';
  S28  : $status = 'Lebih';

S24 → S29 [$status]
  S24: $status = 'Belum Lunas';
  S29  : return $status;

S26 → S7 [$status]
  S26: $status = 'Lunas';
  S7  : $status = 'Lebih';

S26 → S9 [$status]
  S26: $status = 'Lunas';
  S9  : $status = 'Lunas';

S26 → S11 [$status]
  S26: $status = 'Lunas';
  S11  : $status = 'Lunas UTS';

S26 → S13 [$status]
  S26: $status = 'Lunas';
  S13  : $status = 'Lunas KRS';

S26 → S14 [$status]
  S26: $status = 'Lunas';
  S14  : $status = 'Belum Lunas';

S26 → S17 [$status]
  S26: $status = 'Lunas';
  S17  : $status = 'Belum Lunas';

S26 → S19 [$status]
  S26: $status = 'Lunas';
  S19  : $status = 'Lunas';

S26 → S21 [$status]
  S26: $status = 'Lunas';
  S21  : $status = 'Lebih';

S26 → S24 [$status]
  S26: $status = 'Lunas';
  S24  : $status = 'Belum Lunas';

S26 → S28 [$status]
  S26: $status = 'Lunas';
  S28  : $status = 'Lebih';

S26 → S29 [$status]
  S26: $status = 'Lunas';
  S29  : return $status;

S28 → S7 [$status]
  S28: $status = 'Lebih';
  S7  : $status = 'Lebih';

S28 → S9 [$status]
  S28: $status = 'Lebih';
  S9  : $status = 'Lunas';

S28 → S11 [$status]
  S28: $status = 'Lebih';
  S11  : $status = 'Lunas UTS';

S28 → S13 [$status]
  S28: $status = 'Lebih';
  S13  : $status = 'Lunas KRS';

S28 → S14 [$status]
  S28: $status = 'Lebih';
  S14  : $status = 'Belum Lunas';

S28 → S17 [$status]
  S28: $status = 'Lebih';
  S17  : $status = 'Belum Lunas';

S28 → S19 [$status]
  S28: $status = 'Lebih';
  S19  : $status = 'Lunas';

S28 → S21 [$status]
  S28: $status = 'Lebih';
  S21  : $status = 'Lebih';

S28 → S24 [$status]
  S28: $status = 'Lebih';
  S24  : $status = 'Belum Lunas';

S28 → S26 [$status]
  S28: $status = 'Lebih';
  S26  : $status = 'Lunas';

S28 → S29 [$status]
  S28: $status = 'Lebih';
  S29  : return $status;

