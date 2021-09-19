<?php
require "../private/dbcfg.php";

$name = $_POST['name'];
$type = $_POST['type'];
$year = $_POST['year'];
$month = $_POST['month'];
$episode_count = $_POST['episode_count'];
$housou_stat = $_POST['housou_stat'];
$link = $_POST['link'];
$image = $_POST['image'];
$ova = $_POST['ova'];


$sqllink = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
//mysqli_select_db($link, DBNAME);
mysqli_set_charset($sqklink, 'utf8');

$sql = "INSERT INTO anime (housou_stat, email, password_md5) VALUES ('".$username."','".$email."','".$password_encrypted."');";

$result = mysqli_query($link, $sql);

?>