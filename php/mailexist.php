<?php
 require "../private/dbcfg.php";

$mail = $_POST['email'];


$link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
//mysqli_select_db($link, DBNAME);
mysqli_set_charset($link, 'utf8');

$sql = "SELECT COUNT(*) FROM users WHERE email=\"".$mail."\";";

$result = mysqli_query($link, $sql);


//获取个数
$count = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $count = (int)$row["COUNT(*)"];
    }
}

header('Content-Type:application/json');

//判断！
//echo $count;

if ($count == 0) {
    echo json_encode([
    'exist' => 'no'
  ]);
} else {
    echo json_encode([
    'exist' => 'yes'
  ]);
}
