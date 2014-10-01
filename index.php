<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mobile ID</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">

    <!-- jQuery Version 1.11.0 -->
    <script type="text/javascript" src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

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
                        $('form').append('<button class="btn btn-primary" type="submit">Log In</button>');
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
    <!-- Page Content -->
    <div class="container">
        <hr>
        <!-- Page Features -->
        <div class="row">

            <div class="col-md-4 col-sm-6 hero-feature text-center">
                <div class="thumbnail">
                    <header class="caption">
                        <h2>Mobile ID</h2>
                    </header>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 hero-feature text-center">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>Verifikasi Identitas</h3>
                        <p>
                            <a href="verify.php" class="btn btn-primary">Verifikasi</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 hero-feature">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title"><strong>Log In</strong></h3></div>
                    <div class="panel-body">
                        <form role="form" class="form-signin" action="login.php" method="post">
                            <div class="form-group">
                                <label for="id-number">Nomer KTP</label>
                                <input type="text" maxlength="16" class="form-control numeric" id="id-number" name="no_ktp" placeholder="Masukkan 16 digit nomer KTP">
                            </div>
                            <!-- <a href="#" class="btn btn-primary">Log in</a> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <p class="debugger"></p>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
</body>

</html>
