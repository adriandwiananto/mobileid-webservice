<!--<?php
// session_start();

// if (isset($_POST['SubmitCheck'])) {
//     if ($_POST['no_ktp']) {
//         //echo "login success";
//         $_SESSION['USERID'] = $_POST['no_ktp']; 
//         $_SESSION['LOGIN'] = TRUE;
//         header('Location: home.php');
//         exit;
//     }
//     else {
//         echo "login failed";
//         $page = $_SERVER['PHP_SELF'];
//         header("Refresh: 1; url=$page");
//     }
// }
// else {
    // The form has not been posted
    // Show the form
    ?>-->
<html>
  
  <head>
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link type ="text/css" rel="stylesheet" href="style.css">
    <script type="text/javascript" src="script.js"></script>
  </head>
  
  <body>
    <div class="jumbotron">
      <h1>DocSigner</h1>
      <p>Tandatangan dokumen anda via web</p>
      <p><a class="btn btn-primary btn-lg">Cara Kerja</a></p>
    </div>
    <div class="container">
      <!-- <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> -->
      <form class="form-signin" action="sending.php" method="post">
        <h2 class="form-signin-heading text-left">Untuk mulai, masukkan nomor KTP</h2>
        <input type="text" maxlength="16" class="form-control" placeholder="No.KTP" name="no_ktp">
        <!--<input type="hidden" name="SubmitCheck" value="sent">-->
        <!--<button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>-->
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