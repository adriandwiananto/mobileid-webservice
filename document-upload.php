<?php
include('./addr-path.php');

session_start();
if($_SESSION["userclass"]==2){
    $id_number = $_SESSION["no_ktp"];
    $nama = $_SESSION["nama"];
    $userclass = $_SESSION["userclass"];
    $textuserclass = $_SESSION["textuserclass"];
    
}
else{
    header("Location: ./");
    die();
}
$pnum = $_POST["number_ofsigner"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Logged In Mobile ID</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Simulasi Mobile ID <small><?php echo $id_number.", ".$nama.", ".$textuserclass;?></small></h1>
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
                            <li class="list-group-item"><span class="glyphicon glyphicon-envelope text-primary"></span> <a href="loggedin.php">Daftar Approval</a></li>
                            <li class="list-group-item"><span class="glyphicon glyphicon-envelope text-primary"></span> <a href="document-list.php">Daftar Dokumen</a></li>
                            <?php if ($userclass == 2) echo '<li class="list-group-item"><span class="glyphicon glyphicon-envelope text-primary"></span> <a href="document-verify-list.php">Daftar Verifikasi Dokumen</a></li>
                            ';?>
                            <li class="list-group-item"><span class="glyphicon glyphicon-log-out text-success"></span> <a href="session_destroyer.php">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-md-9">
            <span class="label label-primary">Tandatangan Dokumen</span>
            
            
<form class="form-horizontal" role="form" name="BuatDokumen" action="document-upload.1.php" method="post" enctype="multipart/form-data">

    <input type="hidden" id="signercount" name="signercount" value="<?php echo $pnum; ?>">
    <p class="text-center">Buat dokumen baru</p>

    <div class="form-group">
    <label for="content" class="col-sm-2 control-label">Berita</label>
    <div class="col-xs-10">
    <input type="text" class="form-control" id="content" name="doccontent" placeholder="Berita">
    </div></div>
    
    <script>
    var CAaskphrase = "tanyainisial";
    </script>
    
    
    <?php 
    for ($i=1;$i<=$pnum;$i++) {
    echo '
    <div class="form-group">
        <label for="signer'.$i.'" class="col-sm-2 control-label">Nomor Pemilik Identitas</label>
        <div class="col-xs-4">
        <input type="text" class="form-control" id="signer'.$i.'" name="docsigner'.$i.'" placeholder="Pemilik identitas ke '.$i.'">
        </div>
        <div class="btn-container"><button type="button" class="btn btn-primary verifyuser'.$i.'-btn" ><span class="glyphicon glyphicon-ok"></span>Cek Identitas</button></div>
    </div>
    ';
    echo '
        <script>
        
        $(document).on("click",".verifyuser'.$i.'-btn",function(){
            $.ajax(
            {
                url: "'.$CAaskuserinitial.'",
                type: "POST",
    
                data: {"askphrase":CAaskphrase,"userid": document.forms["BuatDokumen"]["docsigner'.$i.'"].value},
                success: function (result) {
    			    alert(result);
                }
            });
        });
        </script>
    ';
    }
    ?>
    
    <ol class="breadcrumb">Please choose a file: <input type="file" name="uploadFile"><br><input type="submit" value="Upload File"></ol>
</form>

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

 