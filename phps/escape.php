<?php
function escape_characters_if_sql_injection($text){
  $res=$text;

  $chars = "&()[]{}/\\`^*-=+,?|;:'\" ";

  for($i=0; $i<strlen($chars); $i++){
    $res=str_replace(substr($chars, $i, 1),"&".str_pad((string)$i,2,'0',STR_PAD_LEFT),$res);
  }
  
  return $res;
}

function re_escape_characters_if_sql_injection($text){
  $res=$text;

  $chars = "&()[]{}/\\`^*-=+,?|;:'\" ";

  for($i=strlen($chars)-1; $i>=0; $i--){
    $res=str_replace("&".str_pad((string)$i,2,'0',STR_PAD_LEFT),substr($chars, $i, 1),$res);
  }
  
  return $res;
}

?>