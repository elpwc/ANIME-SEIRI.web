<?php
require './private/dbcfg.php';




function get_animes($page, $amount_per_page, $type_, $year_, $lang_, $season_, $epi_, $stat_, 
$userstat_, $len_){
  
  $link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
  mysqli_set_charset($link, 'utf8');

  $type = "";
  $year = "";
  $lang = "";
  $season = "";
  $epi = "";
  $stat = "";
  $userstat = "";
  $len = "";

  if($type_ != ""){
    $type = "type = '".$type_."'";
  }
  if($type_ != ""){
    $type = $type_;
  }

  $sql = "SELECT * FROM animes WHERE ;";
  $result = mysqli_query($link, $sql);
}

function to_dbtype(){

}