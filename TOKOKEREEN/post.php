<?php
include 'connect.php';


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   post();
}

function post(){
	//LOGIN
	if($_POST['command'] === 'login') {
		$conn = connectDB();
		$query = pg_query($conn, "SELECT PN.email, PN.password AS password, PL.is_penjual AS is_penjual FROM PENGGUNA PN JOIN PELANGGAN PL ON PN.email = PL.email WHERE PN.email='".$_POST['email']."'");


		if (pg_num_rows($query) > 0) {
			// has result; user is either buyer or seller (not admin, because join produces result)
			$row = pg_fetch_assoc($query);
			if ($row['is_penjual'] == 't' && $row['password'] == $_POST['password']) {
			// is seller
				$_SESSION['is_penjual'] = true;
				$_SESSION['is_loggedin'] = true;
				$_SESSION['email'] = $_POST['email'];
				header("Location: penjual.php");
			}
			elseif ($row['is_penjual'] == 'f' && $row['password'] == $_POST['password']) {
			// is buyer
				$_SESSION['is_penjual'] = false;
				$_SESSION['is_loggedin'] = true;
				$_SESSION['email'] = $_POST['email'];
				header("Location: pembeli.php");
			}
			else{
				$messages = htmlspecialchars('Password tidak sesuai dengan E-mail');
				header("Location: login.php?messages=".$messages);
			}
		}
		else {
			$adminq = pg_query("SELECT PN.email, PN.password AS password FROM PENGGUNA PN LEFT JOIN PELANGGAN PL ON PN.email = PL.email WHERE PL.email IS NULL AND PN.email IS NOT NULL AND PN.email='".$_POST['email']."'");

			if (pg_num_rows($adminq) > 0) {
				$row = pg_fetch_assoc($adminq);
				if ($row['password'] == $_POST['password']){
					// there exists a row in Pengguna which doesn't exist in Pelanggan;
					// user is admin
					$_SESSION['is_admin'] = true;
					$_SESSION['is_loggedin'] = true;
					$_SESSION['email'] = $_POST['email'];
					header("Location: admin.php"); 
				}
				else{
					$messages = htmlspecialchars('Password tidak sesuai dengan E-mail');
					header("Location: login.php?messages=".$messages);
				}
			}
			else {
				// there isn't any result, user doesn't exist. Redirect to login page?
				$messages = htmlspecialchars('E-mail tidak ada');
				header("Location: login.php?messages=".$messages);
			}
		}
	}

	//REGISTER
	else if ($_POST['command'] === 'register') {
		$conn = connectDB();

		$email = $_POST["email"];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$tgl_lahir = $_POST['tgl_lahir'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$message = Array();

		if (!isset($_POST['email']) || $_POST['email'] == '') {
			$message['nemail'] = 'Email belum diisi';
		}
		if (!isset($_POST['password']) || $_POST['password'] == '') {
			$message['npassword'] = 'Password belum diisi';
		}
		if ($_POST['password'] != $_POST['checkpassword']) {
			$message['npassword'] = 'Password tidak sesuai';
		}
		if (!isset($_POST['name']) || $_POST['name'] == '') {
			$message['nname'] = 'Nama belum diisi';
		}
		if (!isset($_POST['gender']) || $_POST['gender'] == '') {
			$message['ngender'] = 'Jenis Kelamin belum dipilih';
		}
		if (!isset($_POST['tgl_lahir']) || $_POST['tgl_lahir'] == '') {
			$message['ntgl_lahir'] = 'Tanggal lahir belum diisi';
		}
		if (!isset($_POST['phone']) || $_POST['phone'] == '') {
			$message['nphone'] = 'No telepon belum diisi';
		}
		if (!isset($_POST['address']) || $_POST['address'] == '') {
			$message['naddress'] = 'Alamat belum diisi';
		}

		

		$query = pg_query($conn, "SELECT email FROM PENGGUNA WHERE email='$email'");
		echo 'select';
		if (pg_num_rows($query)) {
			$message['nemail'] = 'E-mail sudah teregister';
		}

		if (strlen($_POST['password']) < 6 OR strlen($_POST['password']) > 20) {
			
			/*
			if (array_key_exists('npassword', $message) {
			$message['npassword'] = $message['npassword'] . '<br>Message';
			} else {
			$message['npassword'] = 'Message';
			}*/

			$message['npassword'] = (array_key_exists('npassword', $message)) ? $message['npassword'] . '<br/>Password kurang dari 6 karakter atau lebih dari 20 karakter' : 'Password kurang dari 6 karakter atau lebih dari 20 karakter';
			
			// the passwords don't match
		}

		if (strlen($_POST['phone']) > 20) {
			$message['nphone'] = 'No telepon lebih dari 20 karakter';
		}

		if (!is_numeric($_POST['phone'])) { 
			// not numeric 
			$message['nphone'] = (array_key_exists('nphone', $message)) ? $message['nphone'] . '<br/>No telepon harus sesuai format' : 'No telepon harus sesuai format';
		}

		if (sizeof($message) > 0) {
			$error = http_build_query($message);
			$content = http_build_query($_POST);
			header("Location: login.php?".$error."&".$content);
			die();
		}

		else {
			$q = pg_query($conn, "INSERT INTO PENGGUNA VALUES ('$email','$password','$name','$gender','$tgl_lahir','$phone','$address')");
			$q = pg_query($conn, "INSERT INTO PELANGGAN VALUES ('$email',false,0,0)");
			$_SESSION['is_penjual'] = false;
			$_SESSION['is_loggedin'] = true;
			$_SESSION['email'] = $_POST['email'];
			header("Location: pembeli.php");
		}



		pg_close($conn);
	}


	/*
	//KATEGORI
	if ($_POST['addkategori']) {
		$conn = connectDB();

		$subcats = "";
		for($i=0; $i<sizeof($_POST['sk_kode']); $i++){
			$subcats += $_POST['sk_kode'][$i];
			if ($i+1 != sizeof($_POST['sk_kode'])) {
				$subcats += ',';
			}
		}

		$query = pg_query($conn, "SELECT KU.kode, KU.nama, SK.kode, SK.kode_kategori, FROM KATEGORI_UTAMA KU, SUB_KATEGORI SK WHERE ku.kode =".$_POST['ku_kode']." OR SK.kode IN $subcat");
		if (pg_num_rows($query)) {
			// this kode for KATEGORI_UTAMA is already exist
			echo("<br>Kode kategori tidak unik");

			for($i=0; $i<sizeof($_POST['sk_kode']); $i++){
				if(pg_query($conn, "SELECT SK.kode FROM SUB_KATEGORI WHERE SK.kode == ".$_POST['sk_kode']." AND SK.kode == ".$_POST['sk_kode'][$i])){
					// this kode for SUB_KATEGORI is already exist
					echo("<br>Kode sub kategori tidak unik");
				}
			}
		}
		else{
			// the categoty & sub category are successfully added
			$q = pg_query($conn, "INSERT INTO KATEGORI_UTAMA (".$_POST['ku_kode'].",".$_POST['ku_nama'].")");

			for($i=0; $i<sizeof($_POST['sk_kode']); $i++){
				$q = pg_query($conn, "INSERT INTO SUB_KATEGORI (".$_POST['sk_kode'][$i].",".$_POST['ku_kode'].",".$_POST['sk_nama'][$i].")");
				echo("<br>Kategori dan Sub Kategori berhasil dibuat");
			}
			
		}
		pg_close($conn);

	}*/
}



?>