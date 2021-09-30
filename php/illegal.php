<?php

$text="";
if(isset($_POST['text']) && $_POST['text']!=""){
  $text = $_POST['text'];
}

require "../private/illegal_words_list.php";

$have = false;

foreach($illegal_list as $word){
  if(strstr($text,$word) != FALSE){
      $have = true;
    break;
  }
}

if($have){
  echo (json_encode([
    'exist' => 'yes'
  ]));
}else{
  echo (json_encode([
    'exist' => 'no'
  ]));
}
