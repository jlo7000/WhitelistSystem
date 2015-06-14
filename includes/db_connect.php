<?php
/**
 * Created by Smashedbotatos | iCarey.net
 * https://www.icarey.net/minecraft
 */
$config = parse_ini_file('config.ini.php', 1, true);
session_start();

$host=$config['mysql']['host'];
$user=$config['mysql']['user'];
$pass=$config['mysql']['password'];
$db=$config['mysql']['database'];


$connect = mysql_connect($host,$user,$pass)or die("Could not connect to MySQL host.");
$select = mysql_selectdb($db) or die("Could not select database..");
?>
