<!DOCTYPE html>
<?php
require "./private/dbcfg.php";
?>

<html>

<head>
  <meta charset="utf-8" />
  <title>ANIME SEIRI.web</title>
  <link rel="icon" href="./src/favicon.ico" sizes="32x32" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./lib/user.js"></script>
  <link rel="stylesheet" href="./lib/user.css" />
</head>


<body style="background-color:azure;">
<?php
  $current_li = 3;
  require 'topbar.php';

  $user_id_user = "0";
  if(isset($_SESSION['uid']) && $_SESSION['uid'] != ""){
    $user_id = $_SESSION['uid'];
  }

  ?>

  <div class="container shadow-lg" style="background-color: white;">
    <div class="row" >
        <div class="shadow avatar" style="position:relative;">
          <img src="./users/avatar/default.jpg" width="200" hight="200" />
          <div class="hide" style="position:absolute; bottom : 0px;width:fit-content;height:fit-content;background-color:rgba(255, 255, 255, 0.8); border-radius:3px;">
          <span><a href="">修改头像</a></span>
        </div>
        </div>
        <div class="row" >
          <h3><?php echo($username); ?></h3><a href="./user.php?page=3&edit=1"><span><small>修改资料</small></span></a>
        </div>

    </div>

    <div>

    </div>

  </div>
  
  <div class="container shadow-lg mt-3" style="background-color: white; ">
<div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./user.php?page=1">
        <span style="color: hotpink;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
</svg></span>&nbsp;我想看的</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./user.php?page=2">
        <span style="color:palegreen;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
  <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
</svg></span>&nbsp;我的消息
<span style="color:crimson;"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="20" fill="currentColor" class="bi bi-dot" viewBox="0 0 10 20">
  <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
</svg></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./user.php?page=3">
        <span style="color:deepskyblue;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg></span>&nbsp;个人信息</a>
      </li>
    </ul>

  </div>
</nav>
</div>

<div>
  <?php
  $edit = 0;
    if(isset($_GET['page']) && (int)$_GET['page'] > 0){
      switch($_GET['page']){
        case 1:
          require "./useranilist.php";
          break;
        case 2:
          require "./messagewin.php";
          break;
        case 3:
          if (isset($_GET['edit']) && (int)$_GET['edit'] == 1) {
            $edit = 1;
          }
          require "./userinfo.php";
          break;
        default:
        require "./useranilist.php";
          break;

      }
    }
  ?>
</div>


  </div>

<?php
require "./kanban.php";
?>


</body></html>