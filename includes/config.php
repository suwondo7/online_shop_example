<?php
ini_set("display_errors", "On"); 
error_reporting(E_ALL);
date_default_timezone_set("Asia/Jakarta");

//Setting
define("_limit_", 10); 						//--> Limit data per halaman
define("_file_size_foto_", 50000); 			//--> Maksimal ukuran file foto

//Administrator
define("_admin_", "admin"); 				//--> Folder Administrator
define("_header_", "Cloting Store"); 		//--> Header Administrator
define("_footer_left_",	"Cloting Store");
define("_footer_right_", "Clothing Store");

//Users
define("_user_", "user"); 					//--> Folder User
$footer	= "Clothing Store";

//Biaya pengiriman
define("_biayaDalam_", 10000);
define("_biayaLuar_", 15000);

//Info Contact
//$email	= "admin@suwondo.net";
define("_email_", "suwondo.7@gmail.com");
define("_messenger_", "rpl.suwondo");
define("_facebook_", "http://www.facebook.com/suwondo.7");
define("_twitter_", "http://www.twitter.com/soewondosp");

class Database{
	private $conn;

	private $host = "localhost";			//--> Host Database
	private $user = "coba";					//--> User Database
	private $pass = "#2019HarusSukses";		//--> Password Database
	private $dbx  = "coba_xyz_baju";		//--> Nama Database
	
	/* 	-- Function private untuk koneksi ke database dengan PDO -- */
	private function connect(){
		try{
			$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbx.';charset=utf8mb4', $this->user, $this->pass);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
			return $this->conn;
		}catch(PDOException $ex){
			return NULL;
		}
	}
	
	/* 	Function (Method) public untuk query SQL dengan parameter :	
		1.	$string : string SQL
		2.	$print	: true -> tampilkan view SQL nya
					  false -> hidden view SQL nya.
	*/
	public function query($string, $print=false){
		$this->connect();
		if($print === true) echo $string;
		return $this->conn->prepare($string);
	}
	
	/* 	Function public untuk bind data dengan parameter :	
		1.	$param : string SQL
		2.	$print	: true -> tampilkan view SQL nya
					  false -> hidden view SQL nya.
	*/
	public function bind($prepare, $param, $content, $type='str'){
		switch(strtolower($type)){
			case 'str' : $tipe = PDO::PARAM_STR; break;
			case 'int' : $tipe = PDO::PARAM_INT; break;
			default : $tipe = PDO::PARAM_STR; break;
		}
		$prepare->bindParam($param, $content, $tipe);
	}
	
	public function exec($prepare){
		$prepare->execute();
	}
	
	public function sql($string, $print=false){
		$this->connect();
		$sql = $this->conn->prepare($string);
		
		if($print === true){
			echo $string;
		}
		
		$sql->execute();
		return $sql;
	}
	
	public function beginTransaction(){
		$this->connect();
		return $this->conn->beginTransaction();
	}
	
	public function commit(){
		$this->connect();
		return $this->conn->commit();
	}
	
	public function select($table, $field, $wc=null, $wo='OR', $print=false){
		$this->connect();
		if($field=='*'){
			$fx = "*";
		}else{
			$fx=""; $x=count($field); $i=1;
			foreach($field as $f){
				$fx .= "`".$f."`";
				if($x > $i) $fx .= ", ";
				$i++;
			}
		}
		
		if($wc!=null){
			$where_cont=""; $x=count($wc); $i=1; $n=1;
			foreach(array_keys($wc) as $key){
				$where_cont .= "`".$key."` = :param".$n."x";
				if($x > $i) $where_cont .= " ".$wo." ";
				$i++; $n++;
			}
		}else $where_cont = "true";
		$sql = "SELECT ".$fx." FROM `".$table."` WHERE ".$where_cont;
		$select = $this->conn->prepare($sql);
		
		if($wc!=null){
			$sqlx = array(); $sqly = array(); $n=1;
			foreach(array_keys($wc) as $key){
				$select->bindParam(':param'.$n.'x', $wc[$key], PDO::PARAM_STR);
				$sqlx[] = ':param'.$n.'x';		$sqly[] = "'".$wc[$key]."'";
				$n++;
			}
		}
		
		if($print === true){
			$sqlp = str_ireplace($sqlx, $sqly, $sql);
			echo $sqlp;
		}
		
		$select->execute();
		return $select;
	}
	
	public function insert($table, $content, $print=false){
		$this->connect();
		$field=""; $value=""; $x=count($content); $i=1; $n=1;
		foreach(array_keys($content) as $key){
			$field .= "`".$key."`";
			$value .= ":param".$n."x";
			if($x > $i){ $field .= ", "; $value .= ", "; }
			$i++; $n++;
		}
		$sql = "INSERT INTO `".$table."` (".$field.") VALUES (".$value.") ";
		$insert = $this->conn->prepare($sql);
		$sqlx = array(); $sqly = array(); $n=1;
		foreach(array_keys($content) as $key){
			$insert->bindValue(':param'.$n.'x', $content[$key], PDO::PARAM_STR);
			$sqlx[] = ':param'.$n.'x';		$sqly[] = "'".$content[$key]."'";
			$n++;
		}
		
		if($print === true){
			$sqlp = str_ireplace($sqlx, $sqly, $sql);
			echo $sqlp;
		}
		
		$insert->execute();
		return $insert;
	}
	
	public function update($table, $content, $wc=null, $wo='OR', $print=false){
		$this->connect();
		$conts=""; $x=count($content); $i=1; $n=1;
		foreach(array_keys($content) as $key){
			$conts .= "`".$key."` = :param".$n."x";
			if($x > $i) $conts .= ", ";
			$i++; $n++;
		}
		
		if($wc!=null){
			$where_cont=""; $x=count($wc); $i=1; $n=1;
			foreach(array_keys($wc) as $key){
				$where_cont .= "`".$key."` = :paramw".$n."x";
				if($x > $i) $where_cont .= " ".$wo." ";
				$i++; $n++;
			}
		}else $where_cont = "true";
		$sql = "UPDATE `".$table."` SET ".$conts." WHERE ".$where_cont;
		$update = $this->conn->prepare($sql);
		
		$sqlx = array(); $sqly = array(); $n=1;
		foreach(array_keys($content) as $key){
			$update->bindParam(':param'.$n.'x', $content[$key], PDO::PARAM_STR);
			$sqlx[] = ":param".$n."x"; 	$sqly[] = "'".$content[$key]."'";
			$n++;
		}
		if($wc!=null){
			$n=1;
			foreach(array_keys($wc) as $key){
				$update->bindParam(':paramw'.$n.'x', $wc[$key], PDO::PARAM_STR);
				$sqlx[] = ":paramw".$n."x";		$sqly[] = "'".$wc[$key]."'";
				$n++;
			}
		}
		
		if($print === true){
			$sqlp = str_ireplace($sqlx, $sqly, $sql);
			echo $sqlp;
		}
			
		$update->execute();
		return $update;
	}
	
	public function delete($table, $wc=null, $wo='OR', $print=false){
		$this->connect();
				
		if($wc!=null){
			$where_cont=""; $x=count($wc); $i=1; $n=1;
			foreach(array_keys($wc) as $key){
				$where_cont .= "`".$key."` = :param".$n."x";
				if($x > $i) $where_cont .= " ".$wo." ";
				$i++; $n++;
			}
		}else $where_cont = "true";
		$sql = "DELETE FROM `".$table."` WHERE ".$where_cont;
		$delete = $this->conn->prepare($sql);
		
		if($wc!=null){
			$sqlx = array();	$sqly = array();  $n=1;
			foreach(array_keys($wc) as $key){
				$delete->bindParam(':param'.$n.'x', $wc[$key], PDO::PARAM_STR);
				$sqlx[] = ':param'.$n.'x';		$sqly[] = "'".$wc[$key]."'";
				$n++;
			}
		}
		
		if($print === true){
			$sqlp = str_ireplace($sqlx, $sqly, $sql);
			echo $sqlp;
		}
		
		$delete->execute();
		return $delete;
	}
	
	public function num_rows($arr){
		return $arr->rowCount();
	}
	
	public function fetch_assoc($arr){
		return $arr->fetch(PDO::FETCH_ASSOC);
	}
	
	public function fetch_row($row){
		return $row->fetch(PDO::FETCH_NUM);
	}
	
	public function result_row($sql){
		$res = $this->sql($sql);
		return $this->fetch_row($res);
	}
	
	public function result_assoc($sql){
		$res = $this->sql($sql);
		return $this->fetch_assoc($res);
	}
	
	public function result_count($table, $wc=null, $wo='OR'){
		$res = $this->select($table, '*', $wc, $wo);
		return $this->num_rows($res);
	}
	
	public function insert_check($table, $content, $wc=null, $wo='OR', $print=false){
		$check = $this->result_count($table, $wc, $wo);
		if($check==0){
			return $this->insert($table, $content, $print);
		}else{
			$del = $this->delete($table, $wc, $wo, $print);
			if($del==true){
				return $this->insert($table, $content, $print);
			}else{
				return null;
			}
		}
	}
	
	public function close($stmt){
		return $stmt->closeCursor();
	}
}
?>