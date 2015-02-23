<?php
ob_start();
session_start();
ini_set("memory_limit","2048M");
//define("GMTTOSERVERDIFF","-7200");
define("MAILID","donotreply@tickerfriends.com");
//echo "\n GMT = ".strtotime(gmdate("Y-m-d H:i:s")); //1293811447
//echo "\n SERVER = ".strtotime(date("Y-m-d H:i:s")); // 1293786247
//echo "\n ".(strtotime(gmdate("Y-m-d H:i:s")) - strtotime(date("Y-m-d H:i:s"))); //25200
$gmtToServerDiff=(strtotime(gmdate("Y-m-d H:i:s")) - strtotime(date("Y-m-d H:i:s"))); //25200
define("GMTTOSERVERDIFF",$gmtToServerDiff);
define('SITE_HOST','localhost');
define('SITE_FOLDER',  '/icmd/');
define('SITE_URL',  'http://'.SITE_HOST.SITE_FOLDER);
define('ADMIN_URL', SITE_URL . 'admin/');
define('CRON_TIME', (14*24*60*60));//14 Days


define('DEFAULT_LANGUAGE','en');

define('PDF_URL', ADMIN_URL . 'images/katalog/');

function secToDays($s)
{
	$d = intval($s/86400);
	$s -= $d*86400;
	
	$h = intval($s/3600);
	$s -= $h*3600;
	
	$m = intval($s/60);
	$s -= $m*60;
	
	$str = abs($d);
	
	return $str;
}

function gmtdate($date)
{
    $date = date_parse($date);
    return (gmmktime(0, 0, 0, $date['month'], $date['day'], $date['year']));
}

function convert_date_timestamp($date)
{
    return (strtotime($date));
}

function convert_datetime($date,$time)
{
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);
	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	return $timestamp;
}

function ConvertMinutes2Hours($Minutes)
{
    if ($Minutes < 0)
    {
        $Min = Abs($Minutes);
    }
    else
    {
        $Min = $Minutes;
    }
    $iHours = Floor($Min / 60);
    $Minutes = ($Min - ($iHours * 60)) / 100;
    $tHours = $iHours + $Minutes;
    if ($Minutes < 0)
    {
        $tHours = $tHours * (-1);
    }
    $aHours = explode(".", $tHours);
    $iHours = $aHours[0];
    if (empty($aHours[1]))
    {
        $aHours[1] = "00";
    }
    $Minutes = $aHours[1];
    if (strlen($Minutes) < 2)
    {
        $Minutes = $Minutes ."0";
    }
    $tHours = $iHours .":". $Minutes;
    return $tHours;
}
   
function d($arr)
{
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

function convertTimeZone($gmt_timestamp='',$server_timestamp='')
{
	if($gmt_timestamp)
	{
		return $server_timestamp = ($gmt_timestamp - GMTTOSERVERDIFF);
		echo "\n server time = ".date('Y-m-d H:i:s',$temp_timestamp);
	}
	else
	{
		return $gmt_timestamp = ($server_timestamp + GMTTOSERVERDIFF);
		echo "\n server time = ".date('Y-m-d H:i:s',$temp_timestamp);
	}
}
?>