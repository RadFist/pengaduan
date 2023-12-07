<?php
//Creating Function
function TimeAgo ($oldTime, $date) {
$tz = 'Asia/Jakarta';
$dt = new DateTime("now", new DateTimeZone($tz));
$date = $dt->format('Y-m-d G:i:s');

$timeCalc = strtotime($date) - strtotime($oldTime);
if ($timeCalc >= (60*60*24*30*12*2)){
	$timeCalc = intval($timeCalc/60/60/24/30/12) . " tahun lalu";
	}else if ($timeCalc >= (60*60*24*30*12)){
		$timeCalc = intval($timeCalc/60/60/24/30/12) . " tahun lalu";
	}else if ($timeCalc >= (60*60*24*30*2)){
		$timeCalc = intval($timeCalc/60/60/24/30) . " bulan lalu";
	}else if ($timeCalc >= (60*60*24*30)){
		$timeCalc = intval($timeCalc/60/60/24/30) . " bulan ago";
	}else if ($timeCalc >= (60*60*24*2)){
		$timeCalc = intval($timeCalc/60/60/24) . " hari ago";
	}else if ($timeCalc >= (60*60*24)){
		$timeCalc = " Yesterday";
	}else if ($timeCalc >= (60*60*2)){
		$timeCalc = intval($timeCalc/60/60) . " jam lalu";
	}else if ($timeCalc >= (60*60)){
		$timeCalc = intval($timeCalc/60/60) . " jam lalu";
	}else if ($timeCalc >= 60*2){
		$timeCalc = intval($timeCalc/60) . " menit lalu";
	}else if ($timeCalc >= 60){
		$timeCalc = intval($timeCalc/60) . " menit lalu";
	}else if ($timeCalc > 5){
		$timeCalc .= " detik lalu";
	}else if ($timeCalc < 1){
		$timeCalc .= " Just Now";
	}
return $timeCalc;
}
?>