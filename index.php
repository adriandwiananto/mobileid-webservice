<html>
<head>
<title>Mobile ID WebService</title>

<?PHP
	$idNumber = $_GET['idNumber'];
	if(is_numeric($idNumber)){
		echo "input valid (numeric)";
	}
	else {
		echo "input is not numeric";
	}
?>

</head>
<body>

<FORM NAME ="idNumber" METHOD ="post" ACTION = "">

<INPUT TYPE = "TEXT" VALUE ="ID Number">
<INPUT TYPE = "Submit" Name = "Submit1" VALUE = "Proceed">

</FORM>
</body>
</html>


