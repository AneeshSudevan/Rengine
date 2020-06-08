
<?php
//Writen by Aneesh Sudevan
//contact aneesh.sudevan@onmobile.com

//Devoloped For Revenue Engine
// including the database connection
include_once 'db.php';
include("Common.php");
include("reportingdb.php");
session_start();
include("functions.php");
if(isset($_SESSION["user_id"])) {
        if(isLoginSessionExpired()) {
                header("Location:logout.php?session_expired=1");
        }
}else
{
header('Location: index.php');
    exit();
}


logEvent('User '.$_SESSION["user_name"].' Now in Main Page.');













$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$daten = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$ydate = date('Y-m-d', strtotime($date .' -1 day'));
$next_date = date('Y-m-d', strtotime($date .' +1 day'));
$onm = date('Y-m-d', strtotime($date .' -7 day'));
$Hourn = isset($_GET['time']) ? $_GET['time'] : date('H');
//$Hourn = date('H', strtotime('+1 hour'));

$H = isset($_GET['time']) ? $_GET['time'] : date('H');

$dateh = date('H', strtotime('+1 hour'));


$query_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// First day of the month.
$sdate = date('Y-m-01', strtotime($query_date));









$mon=date("M'y");


$prev = mysqli_query($rep, "select sum(revenue) total from (select revenue from p2aplaysmsconversionreport where PROCESSDATE>='$sdate' union all select revenue from p2adxsmsconversionreport  where PROCESSDATE>='$sdate' union all select revenue from p2aobdconversionreport  where PROCESSDATE>='$sdate') t;");


while ($row = $prev->fetch_assoc()) {
$on = $row['total'];
}



setlocale(LC_MONETARY,"en_IN");
$msg=money_format('&#x20b9;%!n', $on);




$trev = mysqli_query($rep, "select sum(revenue) ttotal from (select revenue from p2aplaysmsconversionreport where PROCESSDATE='$date' union all select revenue from p2adxsmsconversionreport where PROCESSDATE='$date' union all select revenue from p2aobdconversionreport where PROCESSDATE='$date') t;");

while ($row = $trev->fetch_assoc()) {
$ton = $row['ttotal'];
}



setlocale(LC_MONETARY,"en_IN");
$tmsg=money_format('&#x20b9;%!n', $ton);









$actt = mysqli_query($rep, "select sum(ACTIVATION) as act  from cyddxsmsconversionreport where PROCESSDATE>='$sdate'");


while ($row = $actt->fetch_assoc()) {
$totalact = $row['act'];
}

$actmsg=number_format($totalact);

$Tactt = mysqli_query($rep, "select sum(ACTIVATION) as dact  from cyddxsmsconversionreport where  PROCESSDATE='$date'");

while ($row = $Tactt->fetch_assoc()) {
$dtotalact = $row['dact'];
}

$tactmsg=number_format($dtotalact);

$ctact = mysqli_query($rep, "select sum(ACTIVATION) as cact  from cricdxsmsconversionreport where PROCESSDATE>='2020-01-01'");
while ($row = $ctact->fetch_assoc()) {
$ctotalact = $row['cact'];
}






// Inserting data into the database if submit button is clicked

 ?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <title>Revenue Engine SMS Editor</title>
    <!-- Bootstrap Core CSS -->


<link href="css/font-awesome.min.css" rel="stylesheet">

<link href="css/engine.css" rel="stylesheet">

    <!-- Custom CSS -->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootbox.min.js"></script>


<style>

.bg-img {

 width: 100%;
    border: none;
  height: 100%;






  /* The image used */
  background-image: url("global-leader.jpg");


  /* Center and scale the image nicely */
  background-position: center;
 /*  background-repeat: no-repeat;*/
 background-size: cover;
  position: absolute;
}






</style>
</head>
<body>
<div class="bg-img">
<div class="navbar">

  <div class="dropdown" style="margin-right: 2px;">
    <button class="dropbtn"><p class=""  style="color: white;  letter-spacing: 1px; font-size: 15px;">Recharge Base</p>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">

<p class=""  style="font-size: 1em; color: white;  letter-spacing: 0.5px;">

    <a href="RCB/SearchSmsRCBaseRule.php">SMS Base Criteria</a>
<a href="RCB/SearchObdRCBaseRule.php">OBD Base Criteria</a>
    <a href="RCB/SearchRCBSmsText.php">SMS Text Register</a>

    <a href="RCB/SearchRCBaseShedule.php">Promotion Sheduler</a>
    <a href="RCB/RevenueTracker.php">Revenue Tracker</a>

 <a href="RCB/ReportSheduleP2a.php">Trend-Reports-Tools</a></p>
    </div>
  </div>

 <div class="dropdown"  style="margin-right: -10px;">
    <button class="dropbtn"><p class=""  style="color: white;  letter-spacing: 1px; font-size: 15px;">Other Base</p>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content"><p style="font-size: 5px; color: white;  letter-spacing: 0.1px;">
     <a href="OTHB/SearchOthBaseCategory.php">Base Categories</a>
<a href="OTHB/SearchOthBaseRule.php">Base Promo Rules</a>
    <a href="OTHB/SearchOthSmsText.php">SMS Text Register</a>
    <a href="OTHB/SearchOthBaseShedule.php">Promotion Sheduler</a>
    <a href="OTHB/RevenueTracker.php">Conversion</a>
<a href="OTHB/ReportShedule.php">Trend-Reports-Tools</a>
            <a href="new.html">JENKINS</a></p>
    </div>
  </div>




<div class="dropdownd">
<a href="logout.php" tite="logout"><p style="color: white; padding-top: 10px; letter-spacing: 1px; font-size: 12px;">Welcome <?php echo $_SESSION["user_name"]; ?>. Click here to logout</p></a>
 </div>
</div>
 </div>


   <div class="container">

<br>
<br>
<br>
<br>
       <center>
           <p class="" style="color: white; font-size: 25px;"><span class="blinking">
                    REVENUE ENGINE
                    <br>
                    <small>Campaign Automation -<?php echo $OPCO; ?></small></span></p


           </center>

<div>


<br>
<br>
<br>

<div class="footer">
<br>
<br>
<br>
 <p class="" style="color: white; font-size: 22px;"><marquee scrollamount="10"><span class="blinking"><?php  echo "Revenue Generated For P2A in $mon :"; echo  $msg; echo "         ::::    Total Activation For CYD in $mon  :"; echo number_format($totalact, 2, '.', ','); echo "         ::::    Total Activation For Cricket in $mon :"; echo number_format($ctotalact, 2, '.', ','); echo " :::::     P2A Revenue Generated Today "; echo $tmsg;  echo "         ::::    Today's CYD Activation :"; echo number_format($dtotalact, 2, '.', ',');     ?></span></marquee></p>
</div>
</div>

</div>
</body>
</html>

