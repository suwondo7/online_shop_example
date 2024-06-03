<?php  
session_start();
include "../includes/config.php";
include "../includes/functions.php";
$db = new Database();
$func = new Functions();

switch(@$_POST['proc']){
	case 'add' :
		$id			= uniqid("BAJU");
		$nama		= @$_POST['txtnama'];
		$kategori	= @$_POST['cbkategori'];
		$merk		= @$_POST['cbmerk'];
		$warna		= @$_POST['txtwarna'];
		$ukuran		= @$_POST['txtukuran'];
		$harga		= @$_POST['txtharga'];
		$keterangan	= @$_POST['txtketerangan'];
		$stok		= @$_POST['txtstok'];

		//Cek apakah foto di pilih
		if($_FILES['ffoto']['name'] != ""){
			//buat folder baru jika belum ada
			if(!file_exists("../resources")){
				mkdir("../resources");
				chmod("../resources", 0777);
			}
			//Uploading foto...
			$asal 	= @$_FILES['ffoto']['tmp_name'];
			$tujuan = "../resources/".uniqid("res")."-".$_FILES['ffoto']['name'];
			move_uploaded_file($asal, $tujuan);
		}else{
			$tujuan = "";
		}
		
		$qData = "INSERT INTO _baju VALUES ('$id', '$nama', '$kategori', '$merk', '$warna', '$ukuran', '$harga', '$tujuan', '$keterangan', '$stok', NOW())";
		$hqData = $db->sql($qData);
		
		if($hqData==true) $_SESSION['s_message'] = "Tambah data berhasil";
		else $_SESSION['s_message'] = "Tambah data gagal";
		echo "<script language='javascript'>window.parent.sendRequest('baju_list.php', 'ajax=true', 'list', 'div', '../images/loader.gif');</script>";
		echo "<meta http-equiv='refresh' content='0;url=baju_add.php' />";
		break;
	
	case 'upload_data' :
		//Upload data CSV
		$asal 	= @$_FILES['ffile']['tmp_name'];
		$tujuan	= @$_FILES['ffile']['name'];
		move_uploaded_file($asal, $tujuan);
		//baca CSV
		$handle = fopen($tujuan, "r");
		while (($data = fgetcsv($handle, 1000, ",")) !== false){
			if($data[0] == "") $id = uniqid("BAJU");
			else $id = $data[0];
			//Insert into database
			$db->sql("INSERT INTO _baju VALUES ('$id', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '', '$data[8]', '$data[9]', NOW())");
		}
		fclose($handle);
		//Hapus file CSV
		if(file_exists($tujuan)){
			unlink($tujuan);
		}
		
		echo "<script language='javascript'>window.parent.sendRequest('baju_list.php', 'ajax=true', 'list','div', '../images/loader.gif');</script>";
		echo "<meta http-equiv='refresh' content='0;url=baju_addcsv.php' />";
		break;
	
	case 'update' :
		$id			= @$_POST['txtid'];
		$nama		= @$_POST['txtnama'];
		$kategori	= @$_POST['cbkategori'];
		$merk		= @$_POST['cbmerk'];
		$warna		= @$_POST['txtwarna'];
		$ukuran		= @$_POST['txtukuran'];
		$harga		= @$_POST['txtharga'];
		$keterangan	= @$_POST['txtketerangan'];
		$stok		= @$_POST['txtstok'];
		
		//Cek apakah foto di pilih
		if($_FILES['ffoto']['name'] != ""){
			//buat folder baru jika belum ada
			if(!file_exists("../resources")){
				mkdir("../resources");
				chmod("../resources", 0777);
			}
			//Hapus foto lama
			list($foto) = $db->result_row("SELECT foto FROM _baju WHERE id_baju = '$id'");
			if(file_exists($foto)){
				unlink($foto);
			}
			//Uploading foto...
			$asal 	= $_FILES['ffoto']['tmp_name'];
			$tujuan = "../resources/".uniqid("res")."-".$_FILES['ffoto']['name'];
			move_uploaded_file($asal, $tujuan);
		}
		
		$qData = "	
		UPDATE _baju 
		SET nama 			= '$nama', 
			id_baju_kategori= '$kategori', 
			id_baju_merk 	= '$merk', 
			warna		 	= '$warna', 
			ukuran 			= '$ukuran', 
		";
		if($_FILES['ffoto']['name'] != ""){ 
			$qData .= " foto = '$tujuan', "; 
		}
		$qData .= "	
			harga			= '$harga',
			keterangan		= '$keterangan',
			stok			= '$stok',
			tanggal			= NOW()
		WHERE id_baju = '$id'
		";
		//echo $qData;
		$hqData = $db->sql($qData);
		if($hqData==true) $_SESSION['s_message'] = "Update data berhasil";
		else $_SESSION['s_message'] = "Update data gagal";
		echo "<script language='javascript'>window.parent.sendRequest('baju_list.php', 'ajax=true', 'list', 'div', '../images/loader.gif');</script>";
		echo "<meta http-equiv='refresh' content='0;url=baju_add.php' />"; 
		break;
	
	case 'delete' :
		//Hapus foto lama
		list($foto) = $db->result_row("SELECT foto FROM _baju WHERE id_baju = '".@$_POST['id']."'");
		if(file_exists($foto)){
			unlink($foto);
		}
		$qData = "DELETE FROM _baju WHERE id_baju = '".@$_POST['id']."'";
		$hqData = $db->sql($qData);
		
		if($hqData==true) $_SESSION['s_message'] = "Hapus data berhasil";
		else $_SESSION['s_message'] = "Hapus data gagal";
		header("location:baju_list.php?ajax=true");
		break;
	
	case 'delete_multiple' :
		$idx = explode(",", @$_POST['id']);
		foreach($idx as $ida){
			if($ida != ""){
				//Hapus foto lama
				list($foto) = $db->result_row("SELECT foto FROM _baju WHERE id_baju = '$ida'");
				if(file_exists($foto)){
					unlink($foto);
				}
				$hqData = $db->sql("DELETE FROM _baju WHERE id_baju = '$ida'");
			}
		}
		
		if($hqData==true) @$_SESSION['s_message'] = "Hapus data terpilih berhasil";
		else $_SESSION['s_message'] = "Hapus data terpilih gagal";
		header("location:baju_list.php?ajax=true");
		break;
	
	case 'export_multiple' :
		$idx = explode(",", @$_POST['id']);
		$handle = fopen('file-baju.csv', 'w');
		foreach($idx as $ida){
			if($ida != ""){
				list($idBaju, $nama, $idBajuKategori, $idBajuMerk, $warna, $ukuran, $harga, $foto, $keterangan, $stok, $tanggal) = $db->result_row("SELECT * FROM _baju WHERE id_baju = '$ida'");
				$hqData = fputcsv($handle, array($idBaju, $nama, $idBajuKategori, $idBajuMerk, $warna, $ukuran, $harga, $foto, $keterangan, $stok, $tanggal));
			}
		}
		fclose($handle);
		
		if($hqData==true) @$_SESSION['s_message'] = "Export data terpilih berhasil";
		else $_SESSION['s_message'] = "Export data terpilih gagal";
		//header("location:baju_list.php?ajax=true");
		echo "<script language='javascript'>window.open('file-baju.csv', '_blank'); sendRequest('baju_list.php', 'ajax=true', 'list', 'div', '../images/loader.gif');</script>";
		break;
}

?>