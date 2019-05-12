<?php
// key to authenticate
define('INDEX_AUTH', '1');
require '../../sysconfig.inc.php';
require LIB.'member_session.inc.php';
session_start();
require 'Extend.php';

// return and extend process
if (isset($_POST['process']) AND isset($_POST['loanID'])) {
    global $dbs;
    $loanID = intval($_POST['loanID']);
    // get loan data
    $loan_q = $dbs->query('SELECT item_code FROM loan WHERE loan_id=' . $loanID);
    $loan_d = $loan_q->fetch_row();
    // create circulation object
    $circulation = new Extend($dbs, $dbs->escape_string($_SESSION['mid']));
    $circulation->ignore_holidays_fine_calc = $sysconf['ignore_holidays_fine_calc'];

    // set holiday settings
    $circulation->holiday_dayname = $_SESSION['holiday_dayname'];
    $circulation->holiday_date = $_SESSION['holiday_date'];
    $extend_status = $circulation->extendItemLoan($loanID);
    if ($extend_status === ITEM_RESERVED) {
        echo '<script type="text/javascript">';
        echo 'alert(\'' . __('Item CANNOT BE Extended! This Item is being reserved by other member') . '\');';
        echo 'location.href = \'/index.php?p=member\';';
        echo '</script>';
    } else {
        // write log
        utility::writeLogs($dbs, 'member', $dbs->escape_string($_SESSION['mid']), 'circulation', $dbs->escape_string($_SESSION['realname']) . ' extend loan for item ' . $loan_d[0] . ' for member (' . $dbs->escape_string($_SESSION['mid']) . ')');
        echo '<script type="text/javascript">';
        echo 'alert(\'' . __('Loan Extended') . '\');';
        if ($circulation->loan_have_overdue) {
            echo "\n" . 'alert(\'' . __('Overdue fines inserted to fines database') . '\');' . "\n";
        }
        echo 'location.href = \'/index.php?p=member\';';
        echo '</script>';
    }

    exit();
}