<?php
// require_once('../lib/filemanipulation.php');
require 'rb.php';
include('./addr-path.php');

session_start();
if(isset($_SESSION["no_ktp"])){
    $id_number = $_SESSION["no_ktp"];
    $nama = $_SESSION["nama"];
}
else{
    header("Location: ./");
    die();
}
// echo $nama." ".$id_number;
R::setup('sqlite:./database/'.$id_number.'.s3db');
$approval_count = R::count('approval');

if(isset($_POST["clicked"])){
    echo "CLICKED";
}

// RedbeanPHP Load example
// $approval = R::load( 'approval', 1 ); //reloads our book
// echo $approval;

// RedbeanPHP Store example
// $setor = R::dispense('approval');
// $setor->title = 'Bolos';
// $setor->content = 'Izin bolos karena males kerja';
// $setor->hash = '494874d6f13caa86f69b0a59c7dce6312ea1066b012ea1b5afd6da905843f913';
// R::store($setor);

// $approval = R::load('approval',3);
// echo $approval;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Logged In Mobile ID</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.11.0.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Simulasi Mobile ID <small><?php echo $id_number.", ".$nama;?></small></h1>
</div>

<!-- Accordion - START -->
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> Content</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <ul class="list-group">
                            <li class="list-group-item"><span class="glyphicon glyphicon-envelope text-primary"></span> <a>Daftar Approval</a>
                                <ul class="list-group approval-group-list">
                                    <?php
                                        if($approval_count > 0){
                                            $approval = array();
                                            for($id=1;$id<=$approval_count;$id++){
                                                $index = $id-1;
                                                $approval[$index] = R::load('approval',$id);
                                                echo '<li class="list-group-item approval-list"><span class="glyphicon glyphicon-minus text-primary"></span> <a href="#">'.$approval[$index]["title"].'</a></li>';
                                            }
                                        }
                                    ?>
                                   <!--  <li class="list-group-item"><span class="glyphicon glyphicon-minus text-primary"></span> <a>Edit Blog</a></li>
                                    <li class="list-group-item"><span class="glyphicon glyphicon-minus text-success"></span> <a>Publish Blog</a></li>
                                    <li class="list-group-item"><span class="glyphicon glyphicon-minus text-warning"></span> <a>Delete Blog</a></li> -->
                                </ul>
                            </li>
                            <li class="list-group-item"><span class="glyphicon glyphicon-log-out text-success"></span> <a href="session_destroyer.php">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title content-title">Menu Information</h3>
                </div>
                <div class="panel-body">                    
                    <div class="alert alert-success content-container">
                        <h3 class="content-main-title">Title Placeholder</h3>
                        <h5 class="content-main-body">Review the information supplied in this section to get to know something more about the company, blogs and contents.</h5>
                    </div>
                    <div class="btn-container">
                        <!-- <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok"></span>  Sign</button> -->
                    </div>
                    <p class="debug-container"></p>
                    <!-- <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove"></span>  Un-sign</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function dbfetch(index){
    $.ajax(
    {
        url: "fetchdbdata.php",
        type: "POST",

        data: { "clicked": index },
        success: function (result) {
            // alert(result);
            // var objResult = jQuery.parseJSON(result);
            objResult = jQuery.parseJSON(result);
            $('.content-title').html("Approval");
            $('.content-main-title').html(objResult.title);
            $('.content-main-body').html(objResult.content);
            if(!objResult.signature){
                $('.btn-container').html(signBtn);
            } else {
                $('.btn-container').html(unsignBtn);
            }
        }
    });
}

var listIndex;
var objResult;
var userid = <?php echo $id_number;?>;
var callbackpath = '<?php echo $DBWriterPath;?>';
var signBtn = '<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok"></span>  Sign</button>';
var unsignBtn = '<button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove"></span>  Un-sign</button>'; 

$('.approval-group-list .approval-list').click(function() {
    // get the contents of the link that was clicked
    // var listIndex = $(this).index();
    listIndex = $(this).index();
    
    // alert(listIndex);
    dbfetch(listIndex);
    $('.debug-container').html('');
});

$('.btn-container').click(function() {
    // get the contents of the link that was clicked
    // $('.debug-container').html(objResult.id);
    if(!objResult.signature){
        $.ajax(
        {
            url: "<?php echo $SignWebAddr;?>",
            type: "POST",

            data: {"userid": userid,"id":objResult.id,"title":objResult.title,"content":objResult.content ,"hash":objResult.hash,"callbackpath":callbackpath},
            success: function (result) {
                // result = jQuery.parseJSON(result);
                // $('.debug-container').html(result.status);
                $('.debug-container').html(result);
            }
        });
    }
});
</script>

<style>
    body {
        margin: 40px;
    }
    #accordion .glyphicon {
        margin-right: 10px;
    }
    .panel-collapse > .list-group .list-group-item:first-child {
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }
    .panel-collapse > .list-group .list-group-item {
        border-width: 1px 0;
    }
    .panel-collapse > .list-group {
        margin-bottom: 0;
    }
    .panel-collapse .list-group-item {
        border-radius: 0;
    }
    .panel-collapse .list-group .list-group {
        margin: 0;
        margin-top: 10px;
    }
    .panel-collapse .list-group-item li.list-group-item {
        margin: 0 -15px;
        border-top: 1px solid #ddd;
        border-bottom: 0;
        padding-left: 30px;
    }
    .panel-collapse .list-group-item li.list-group-item:last-child {
        padding-bottom: 0;
    }
    .panel-collapse div.list-group div.list-group {
        margin: 0;
    }
    .panel-collapse div.list-group .list-group a.list-group-item {
        border-top: 1px solid #ddd;
        border-bottom: 0;
        padding-left: 30px;
    }
</style>
<!-- Accordion - END -->

</div>

</body>
</html>