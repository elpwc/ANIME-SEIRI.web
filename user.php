<!DOCTYPE html>
<html>
  <head>
    <title>user</title>
    <meta charset="utf-8"/>
    <script src="http://www.recaptcha.net/recaptcha/api.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!--script src="./lib/jquery-3.3.1.min.js"></script-->
  <script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
  <script src="./lib/user_main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
    crossorigin="anonymous"></script>
  </head>
  <body>

    <iframe>

    </iframe>
    <div>
      <form action="user.php" method="post">
        <input type="text" class="form-control" name="email"><br/>
        <input type="password" class="form-control" name="password"><br/>
        <input type="password" class="form-control" name="password2"><br/>

        <div class="g-recaptcha" data-sitekey="6Ld7BHQcAAAAAIXgLrclWJIj5S2BErHyC_wLUHTK"></div>
        
        <button id="register" type="submit" class="btn btn-primary">注册</button>
        <?php//验证表单
          function send_post($url, $post_data)  
          {  
              $postdata = http_build_query($post_data);  
              $options = array(  
                  'http' => array(  
                      'method' => 'POST',  
                      'header' => 'Content-type:application/x-www-form-urlencoded',  
                      'content' => $postdata,  
                      'timeout' => 15 * 60 // 超时时间（单位:s）  
                  )  
              );  
              $context = stream_context_create($options);  
              $result = file_get_contents($url, false, $context);  
              return $result;  
          }  
                        
          $post_data = array(          
          'secret' => 'yoursecretkey',          
          'response' => $_POST["g-recaptcha-response"]    );  
              $recaptcha_json_result = send_post('https://www.google.com/recaptcha/api/siteverify', $post_data);     
           $recaptcha_result = json_decode($recaptcha_json_result);     
          //在这里处理返回的值   
          //var_dump($recaptcha_result);    
        ?>

      </form>


    </div>

    
  </body>
</html>