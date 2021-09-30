<?php

$text="";
if (isset($_POST['text']) && $_POST['text']!="") {
    $text = $_POST['text'];
}

require "../private/illegal_words_list.php";

$have = false;
//echo($text);
foreach ($illegal_list as $word) {
  //echo($word);
    if (strstr($text, $word) != false) {
        $have = true;
        break;
    }
}

header('Content-Type:application/json');

if ($have == true) {
    echo(json_encode([
    'exist' => 'yes'
  ]));
} else {
    echo(json_encode([
    'exist' => 'no'
  ]));
}

