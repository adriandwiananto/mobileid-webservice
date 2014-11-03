<html>
  
  <head>
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link type ="text/css" rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.numeric.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".numeric").numeric();
        $('.form-signin').bind("keyup keypress", function(e) {
          var code = e.keyCode || e.which;
          //disable enter key form
          if (code  == 13) {
            // $('.debugger').html("Enter pressed").show().fadeOut("slow");
            e.preventDefault();
            //return false;
          }

          var digit = $('.form-control').val().length;
          // $(".debugger").html("char len:"+digit).show();
          if($('button').length == 0){
            if(digit == 16){
              $('form').append('<button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>');
            }
          }else{
            if(digit != 16){
              $('button').remove();
            }
          }
        });
      });
    </script>
  </head>
  
  <body>
    <div class="jumbotron">
      <h1>DocSigner</h1>
      <p>Tandatangan dokumen anda via web</p>
      <p><a href="index.php" class="btn btn-primary btn-lg">Back</a></p>
    </div>
    <div class="container">
      <form class="form-signin" action="sending.php" method="post">
        <h2 class="form-signin-heading text-left">Untuk mulai, masukkan nomor KTP</h2>
        <input type="text" maxlength="16" class="form-control numeric" placeholder="Masukkan 16 digit nomer KTP" name="no_ktp">
      </form>
      <p class="debugger"></p>
    </div>
    <!-- /container -->
    <hr>
    <hr>
  </body>

</html>
<?php
// }
?>