<?php

class UserDB {
	
    public function __construct()
	{
        require_once('../rb.php');
	}
	
	public function prepareDB($dbpath) {
		if(file_exists($dbpath)) {
			R::setup('sqlite:'.$dbpath);
		}
		else
		{
			throw new exception("Could not locate file '$dbpath'");
		}
	}
	
	public function loadDB($table,$index) {
		return $this->data = R::load($table,$index);
	}
}

class DocsignDB extends UserDB {

	public static $tablename = 'docsigning';

	public function getUserDocsignDB($index) {
	    return $this->loadDB(self::$tablename,$index); 
	}
	
	public function updateUserDocsignDB($index,$data) {
		$doc = R::load(self::$tablename,$index);
		$doc=$data;
		$id = R::store( $doc );
	}
	
	public function newentryUserDocsignDB($index,$data) {
		$doc = R::dispense(self::$tablename);
		$doc=$data;
		$id = R::store( $doc );
	}
}

class UserClassDB extends UserDB {
	// Kelas untuk mengakses dan memanipulasi database User Class (permission)
	// Kategori kelas = 1:legal; 2:pemilik identitas/penandatangan.
	// Contoh penggunaan

	// $id_number="1231230509890001";
	// $dbpath = '../database/'.$id_number.'.s3db';
	// $user = new UserClassDB;
	// $user->prepareDB($dbpath);
	// $user->setUserclass($id_number,1);
	// $data = $user->getUserclass();
	// var_dump($data);
	
	public static $tablename = 'userclass';
	//parameter kelas user hanya boleh 1.
	public static $index = '1';
	
	public function setUserclass($user_id,$status) {
		//selalu menimpa entry 1
		$this->class = R::load(self::$tablename,self::$index);
		
		//untuk mengecek, apakah tabel ada
		//if (!$this->class->id) echo "kelas belum ada";
		//else echo "kelas sudah ada dengan status ".$this->class->classtype;

		$this->class->userid = $user_id;
		$this->class->classtype = $status;
		$id = R::store( $this->class );
	}
	
	public function getUserclass() {
	    return $this->loadDB(self::$tablename,self::$index);
	}
}

function translateuserclass($userclass) {
	switch ($userclass) {
	    case 1:
	        return "Pihak Pemilik Identitas";
	        break;
	    case 2:
	        return "Pihak Legal";
	        break;        
	    default:
	        return "Visitor";
	        break;
	}
}

$id_number="1231230509890005";
$dbpath = '../database/'.$id_number.'.s3db';

$user = new UserClassDB;
$user->prepareDB($dbpath);
$user->setUserclass($id_number,2);
$data = $user->getUserclass();
echo translateuserclass($data->classtype);
//var_dump($data);

?>