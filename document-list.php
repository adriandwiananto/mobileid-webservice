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

$caridocstatus > 0;
switch($userclass) {
    case 1:
        $doclist = carisigner($id_number);
        break;
    case 2:
        $doclist = carilegaldanverifieddoc($id_number);
        break;
}
$document_count = count($doclist);

if(isset($_POST["clicked"])){
    echo "CLICKED";
}

/*
//tambah database dokumen
$id_number_legal="3271231008950005";
$id_number="1231230509890001";
$doc = R::dispense('docsigning');
$doc->legal = $id_number_legal;
$doc->title = '1.txt';
$doc->content = 'ucapan selamat lebaran dari aaa';
$doc->hash = '4e70af661ee8500a050293a12aea4ee3ad5d3976c80fbd392780dee9a9663ce1';
$doc->signature = '';
$doc->signer = '1231230509890001';
$doc->modified = R::isoDateTime();

$id = R::store( $doc );
*/
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
            <span class="label label-primary">Daftar dokumen</span>
            <?php if ($userclass == 2) echo '
            <div class="form-group">
            
            <form class="navbar-form navbar-left" role="createform" action="document-upload.php" method="post">
            <p>Buat dokumen baru</p>
            <input type="text" maxlength="1" class="form-control numeric" id="numberofsigner" name="number_ofsigner" placeholder="Jumlah pemilik identitas">
            <button type="submit" class="btn btn-default">Buat Form</button>
            </div></form>';
            ?>
			<table class="table" table-hover>
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							File
						</th>
						<th>
							Legal
						</th>
						<th>
							Tanggal dan Jam Modifikasi
						</th>
						<th>
							Status
						</th>
						<th>
						</th>
						<th>
						</th>
					</tr>
				</thead>
				<tbody>                                    
                    <?php
                    $index = 1;
                    
                    foreach ($doclist as $doc) {
                        if ($userclass == 1) {
                            //translate tabel signer ke doclist
                            $indexdoc = caridocindex($doc->pid);
                            $docdb = loaddocdb($indexdoc);
                            $doc->title = $docdb->title;
                            $doc->legal = $docdb->legal;
                            $doc->docstatus = $docdb->docstatus;
                            $doc->modified = $docdb->modified;
                        }
                        
                        $status = $doc->docstatus;
                        $id = $doc->pid;
                        //buat warna baris
                            if ($status == 2) {
                                echo '<tr class="success">';
                            }
                            else echo '<tr class="warning">';
                            //buat tabel
                            echo "<td>".$index."</td>";
                            echo "<td>".$doc->title."</td>";
                            echo "<td>".$doc->legal."</td>";
                            echo "<td>".$doc->modified."</td>";
                            if ($status == 2) {
                                echo '<td>Sudah Ditandatangan</td>';
                            }
                            else echo '<td>Belum Ditandatangan</td>';
                            //buka dokumen
                            echo '<td><button type="button" onclick="proceed('.$id.');">Lihat</button> </td>';
                            //echo '<td><a href="document-view.php?docindex='.$id.'" type="submit">Lihat</a></td>';
                            //akhir tabel
                            if ($userclass == 2) {
                                $button = '<button type="button" onclick="deleteentry('.$id.');">Hapus</button>';
                            }
                            else $button = "";
                            echo '<td>'.$button.'</td>';
                            echo "</tr>";
                            $index++;
                    }
                    ?>							
				</tbody>
			</table>
        </div>
    </div>
</div>

<script>
function proceed (id) {
   var form = document.createElement("form");
   document.body.appendChild(form);
   form.method = "POST";
   form.action = "document-view.php";
   var element1 = document.createElement("INPUT");         
    element1.name="pid"
    element1.value = id;
    element1.type = 'hidden'
    form.appendChild(element1);
    form.submit();
}

function deleteentry (id) {
   var form = document.createElement("form");
   document.body.appendChild(form);
   form.method = "POST";
   form.action = "document-deleteentry.php";
   var element1 = document.createElement("INPUT");         
    element1.name="pid"
    element1.value = id;
    element1.type = 'hidden'
    form.appendChild(element1);
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

 