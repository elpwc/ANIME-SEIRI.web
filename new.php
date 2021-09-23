<?php
require "./private/dbcfg.php";

$name_zh_cn = $_POST['comment-name'];
$name_jp = $_POST['anime_name_jp'];
$name_en = $_POST['anime_name_en'];
$ = $_POST['anime_'];
$ = $_POST['anime_'];
$ = $_POST['anime_'];
$ = $_POST['anime_'];
$ = $_POST['anime_'];

$link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
//mysqli_select_db($link, DBNAME);
mysqli_set_charset($link, 'utf8');

$sql = "INSERT INTO messages (name, text) VALUES ('".$comment_name."','".$comment_text."');";

$result = mysqli_query($link, $sql);
