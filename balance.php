<?php

require('config/db.php');




$transferReceived = "SELECT SUM(amount) FROM transfers where to_user = '$email'";
$resultTransferReceived = mysqli_query($db,$transferReceived);
$transferReceivedAmount= mysqli_fetch_all($resultTransferReceived, MYSQLI_ASSOC);
$transferReceivedTotal=$transferReceivedAmount[0]['SUM(amount)'];


$transferSent = "SELECT SUM(amount) FROM transfers where from_user = '$email'";
$resultTransferSent = mysqli_query($db,$transferSent);
$transferSentAmount= mysqli_fetch_all($resultTransferSent, MYSQLI_ASSOC);
$transferSentTotal= $transferSentAmount[0]['SUM(amount)'];


$deposits = "SELECT SUM(amount) FROM deposits  where user_id = '$id'";
$resultDeposits = mysqli_query($db,$deposits);
$deposit= mysqli_fetch_all($resultDeposits, MYSQLI_ASSOC);
$totalDeposit = $deposit[0]['SUM(amount)'];


$withdraws= "SELECT SUM(amount) FROM withdraws  where user_id = '$id'";
$resultWithdraws = mysqli_query($db,$withdraws);
$withdraw= mysqli_fetch_all($resultWithdraws, MYSQLI_ASSOC);
$totalWithdraw = $withdraw[0]['SUM(amount)'];


$balance = ( $totalDeposit + $transferReceivedTotal ) -  ( $totalWithdraw + $transferSentTotal );





?>
