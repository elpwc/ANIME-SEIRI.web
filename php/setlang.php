<?php

$crt_lang = 'zh-cn';

if(isset($_POST['lang']) && $_POST['lang'] != ""){
  $crt_lang = $_POST['lang'];
}

session_start();

$_SESSION['lang'] = $crt_lang;