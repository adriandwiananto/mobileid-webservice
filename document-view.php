<?php

require_once('rb.php');
require_once('addr-path.php');
require_once('lib/docsigningdb-lib.php');

session_start();
if(isset($_SESSION["no_ktp"])){
    $id_number = $_SESSION["no_ktp"];
    $nama = $_SESSION["nama"];
    $userclass = $_SESSION["userclass"];
    $textuserclass = $_SESSION["textuserclass"];
}
else{
    header("Location: ./");
    die();
}

R::setup('sqlite:database/docsigning.s3db');

if(isset($_POST["clicked"])){
    echo "CLICKED";
}

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
    <h1>Mobile ID <small><?php echo $id_number.", ".$nama.", ".$textuserclass;?></small></h1>
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
            <?php
            echo '<ol class="breadcrumb">';
            $pid = $_POST["pid"];
            $doc = caridocdgnpid($pid);
            
            if (isset($doc->id)) {
                $doc = caridocdgnpid($pid);

                $status = $doc->docstatus;
                
                //jika masih dalam verifikasi, hanya boleh dilihat oleh legal
                if (($status > 0) || ($id_number == $doc->legal)) {
                    if ($status == 2) {
                        $label = 'label-success';
                    } else $label = 'label-primary';
                    
                    echo '<span class="label '.$label.'">Tandatangan Dokumen</span>';
                    echo "<h3>Nama File: ".$doc->title."</h3>";
                    echo "<h4>Legal: ".$doc->legal."</h4>";
                    echo "<h4>Berita: ".$doc->content."</h4>";
                    echo "<h4>Hash: ".$doc->hash."</h4>";
     
                    $filename = $doc->title.".".$doc->pid;
                    $docrequest = "Permintaan tandatangan dokumen ".$doc->title." dengan berita ".$doc->content." dan legal ".$doc->legal;
                    
                    $filepath = './documents/'.$id_number.'/'.$filename;
                    //$signedpath = './documents/'.$id_number.'/signed/signed.'.$filename;
    
                    echo '<a href="'.$filepath.'" target="_blank" class="btn btn-info btn-sm">Download Dokumen</a></p>';
                    if ($status == 0) {
                        $intendedstatus = $status+1;
                        echo '<td><button type="button" class="btn btn-info btn-sm" onclick="docverified('.$intendedstatus.');">Ubah Status</button> </td>';
                    }

                    echo '</ol>';
                    $statussigner = reset(ceksigner($doc->pid,$id_number)); //bernilai ada, jika id number adalah signer dari dokumen ini
                    //var_dump($statussigner);
                    //syarat tombol sign ditampilkan: id ini belum tandatangan
                    if ((!isset($statussigner->signature)) && ($id_number == $statussigner->signer_id)) {
                        echo '<div class="confirmation column"><form>';
                        echo '<label><input id="confirm" name="confirm" type="checkbox" onclick="validate()" />Saya setuju untuk menandatangani dokumen diatas</label>';
                        echo '</form></div>';
                    }
                    echo '<div class="btn-container"></div>';
                    
                    echo '
                    <h4>Daftar Pemilik Identitas</h4>
                    <div class=signer>
                    <table class="table" table-hover>
                    <thead>
    					<tr>
    					    <th>
    						</th>
    						<th>
    							#
    						</th>
    						<th>
    							Pemilik Identitas
    						</th>
    						<th>
    							Hash Dokumen Setelah Tandatangan
    						</th>
    						<th>
    							Signature
    						</th>
    						<th>
    						</th>
    					</tr>
				    </thead>
				    <tbody>
				    
			        <script>
                    var CAaskphrase = "tanyaidentitas";
                    </script>
                    ';
				    
				    $listsigner = carisignerdaripid($pid);
				    $signerindex = 1;
				    foreach ($listsigner as $signer) {
				        $signature = $signer->signature;
                        if (isset($signature)) {
                            echo '<tr class="success">';
                            $finalfile = './documents/'.$signer->signer_id.'/signed/signed.'.$filename; 
                            if (($id_number == $doc->legal) || ($id_number == $signer->signer_id))
                                echo    '<td><a href="'.$finalfile.'" target="_blank" class="btn btn-info btn-sm">Dokumen Akhir</a>
                                        <button type="button" class="btn btn-success btn-sm verifysig'.$signerindex.'-btn" ></span>Cek Signature</button>';
                            else echo '<td></td>';
                        }
				        else echo '<tr class="warning"><td></td>';
				        echo "<td>". $signerindex."</td>";
				        echo "<td>". $signer->signer_id."</td>";
                        echo "<td>". $signer->signed_hash."</td>";
                        echo "<td>". $signature."</td>";
                        echo '<td><button type="button" class="btn btn-primary verifyuser'.$signerindex.'-btn" ><span class="glyphicon glyphicon-ok"></span>Cek Identitas</button>';
                        echo '
                        <script>
                        
                        $(document).on("click",".verifyuser'.$signerindex.'-btn",function(){
                            $.ajax(
                            {
                                url: "'.$CAaskuserinitial.'",
                                type: "POST",
                    
                                data: {"askphrase":CAaskphrase,"userid": "'.$signer->signer_id.'","pid": "'.$signer->ca_id.'"},
                                success: function (result) {
                    			    alert(result);
                                }
                            });
                        });

                        $(document).on("click",".verifysig'.$signerindex.'-btn",function(){
                            $.ajax(
                            {
                                url: "'.$CAdocsignaddr.'",
                                type: "POST",
                    
                                data: {"hash":"'.$signer->signed_hash.'","docsign":"'.$signer->signature.'","signer":"'.$signer->signer_id.'"},
                                success: function (result) {
                                    alert(result);
                                }
                            });
                        });

                        </script>
                    ';
				        $signerindex++;
				    }
				    echo '</tbody></div>';
                } else echo "<h3>Dokumen dalam tahap verifikasi oleh legal</h3>";
            }
            ?>
            </p>
        </div>
    </div>
</div>
  
<script type="text/javascript">
var objResult;
var userid = <?php echo $id_number;?>;
var callbackpath = '<?php echo $DocSenderPath;?>';
var docsignBtn = '<button class="btn btn-primary docsign-btn" type="submit"><span class="glyphicon glyphicon-ok"></span>  Sign</button>';
var docverifyBtn = '<button class="btn btn-success docverify-btn" type="submit"><span class="glyphicon glyphicon-thumbs-up"></span>  Verify</button>'; 
var index = <?php echo $pid; ?>;
var signature = <?php echo $status; ?>;

$(document).ready(function() {
    var $cbs = $('input[name="confirm"]').click(function() {
                     $('.btn-container').html('');
                     $('.btn-container').html(docsignBtn);
                    // $('.btn-verify-container').html('');
                    $('.debug-container')
    });
});

$(document).on('click','.docsign-btn',function(){
    $.ajax(
    {
        url: '<?php echo $CAdocsignaddr;?>',
        type: "POST",

        data: {"userid": userid,"id":index,"title":'<?php echo $doc->title; ?>',"content":'<?php echo $docrequest; ?>',"hash":'<?php echo $doc->hash; ?>',"callbackpath":callbackpath},
        success: function (result) {
			 alert(result);
            // result = jQuery.parseJSON(result);
            // $('.debug-container').html(result.status);
            $('.debug-container').html("click kembali daftar approval setelah konfirmasi melalui perangkat");
        }
    });
});

$(document).on('click','.docverify-btn',function(){
    $.ajax(
    {
        url: '<?php echo $CAdocsignaddr;?>',
        type: "POST",

        data: {"hash":'<?php echo $statussigner->signed_hash;?>',"docsign":'<?php echo $statussigner->signature;?>',"signer":'<?php echo $signer->signer_id;?>'},
        success: function (result) {
            // $('.debug-container').html("click kembali daftar approval setelah konfirmasi melalui perangkat");
            alert(result);
        }
    });
});

function docverified(status) {
   var form = document.createElement("form");
   document.body.appendChild(form);
   form.method = "POST";
   form.action = "document-doclistdb.php";
   var element1 = document.createElement("INPUT");
   var element2 = document.createElement("INPUT");   
   var element3 = document.createElement("INPUT");   
    element1.name="pid";
    element1.value = index;
    element1.type = 'hidden';
    element2.name="status";
    element2.value = status;
    element2.type = 'hidden';
    element3.name="intend";
    element3.value = "changestatus";
    element3.type = 'hidden';
    form.appendChild(element1);
    form.appendChild(element2);
    form.appendChild(element3);
    form.submit();
}

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