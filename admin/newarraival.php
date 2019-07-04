<?php
define('INDEX_AUTH', '1');
require '../sysconfig.inc.php';
require LIB . 'phpmailer/class.phpmailer.php';
require LIB . 'fpdf/fpdf.php';
global $dbs, $sysconf;

$_mail = new PHPMailer(false);
$_mail->IsSMTP();

// get message template
$_msg_tpl = @file_get_contents(SB . 'template/new-arrival-mail-tpl.html');

// date
$_curr_date = date('Y-m-d H:i:s');

// query
$_biblio_q = $dbs->query("SELECT biblio_id, title FROM biblio");
// compile reservation data
$_data = '<table width="100%" border="1">' . "\n";
$_data .= '<tr><th>Titles to reserve</th></tr>' . "\n";
while ($_title_d = $_biblio_q->fetch_assoc()) {
    $_data .= '<tr>';
    $_data .= '<td>' . $_title_d['title'] . '</td>' . "\n";
    $_data .= '</tr>';
}
$_data .= '</table>';

$pdf = new FPDF();

$mid = 135;

$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Issue No: 231/2019', 0, 0, 'R');
$pdf->Ln(20);
$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10,'Akhter Hameed Khan Library',0,0,'C');
// Line break
$pdf->Ln(7);
$pdf->Cell(0,10,'Bangladesh Academy for Rural Development (BARD)',0,0,'C');
// Line break
$pdf->Ln(7);
$pdf->Cell(0,10,'Kotbari, Cumilla',0,0,'C');
// Line break
$pdf->Ln(7);
$pdf->Cell(0,10,'List of New Arrivals',0,0,'C');
// Line break
$pdf->Ln(7);
$pdf->Cell(0,10,'Date: 01 - 30 June 2019',0,0,'C');
// Line break
$pdf->Ln(15);
$pdf->Image('books.png', 95, null, 20, 15);
//$pdf->Cell(20);
// Title
$pdf->Cell(0,5,'Section A: Book',0,0, 'C');

//$attachment= $pdf->Output('attachment.pdf', 'S');
$attachment= $pdf->Output();

// message
$_message = $_msg_tpl;

// e-mail setting
// $_mail->SMTPDebug = 2;
$_mail->SMTPAuth = $sysconf['mail']['auth_enable'];
$_mail->Host = $sysconf['mail']['server'];
$_mail->Port = $sysconf['mail']['server_port'];
$_mail->Username = $sysconf['mail']['auth_username'];
$_mail->Password = $sysconf['mail']['auth_password'];
$_mail->SetFrom('brainstation23.test@gmail.com', 'Dr. Akhter Hameed Khan Library BARD');
//$_mail->SetFrom($sysconf['mail']['from'], $sysconf['mail']['from_name']);
$_mail->AddReplyTo($sysconf['mail']['reply_to'], $sysconf['mail']['reply_to_name']);
// send carbon copy off reserve e-mail to member/requester
$_mail->AddCC('jahangiralamdiu@gmail.com');
// send reservation e-mail to librarian
$_mail->AddAddress('jahangir.alam@bs-23.com');
//$_mail->AddAddress($sysconf['mail']['libhead']);
// additional recipient
//if (isset($sysconf['mail']['add_recipients'])) {
//    foreach ($sysconf['mail']['add_recipients'] as $_recps) {
//        $_mail->AddAddress($_recps['from'], $_recps['from_name']);
//    }
//}

$_mail->Subject = 'New arrival month of '.  date('F Y');
$_mail->AltBody = strip_tags($_message);
$_mail->MsgHTML($_message);
//$path = "Walter Lernt Invoice.pdf";

$_mail->AddStringAttachment($attachment, 'attachment.pdf');

//$_mail->AddAttachment('./June 2019.pdf', 'New Arrival June 2019', $encoding = 'base64', $type = 'application/pdf');

//$_sent = $_mail->Send();
//if (!$_sent) {
//    return array('status' => 'ERROR', 'message' => $_mail->ErrorInfo);
//    utility::writeLogs($this->obj_db, 'member', 'll', 'membership', 'FAILED to send reservation e-mail to ');
//} else {
//    return array('status' => 'SENT', 'message' => 'Overdue notification E-Mail have been sent to ');
//    utility::writeLogs($this->obj_db, 'member', '0', 'membership', 'Reservation notification e-mail sent to ');
//}
echo 'send';