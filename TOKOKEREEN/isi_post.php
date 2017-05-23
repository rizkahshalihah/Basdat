<?php

	include 'connect.php';

function generateInvoice(){
	$my_array = array("V","A","C","D","B","J","S","P","T","I","M");
	shuffle($my_array);
	$nums1 = rand(100,999);
	$nums2 = rand(100,999);
	$nums3 = rand(10,99);
	$res = $my_array[1].''.$nums1.''.$nums2.''.$nums3;
	return $res;

}

function cekInvoice(){

	$conn = connectDB();
	$resi = generateInvoice(); 
	$cek = pg_query($conn, "SELECT no_invoice FROM TRANSAKSI_SHIPPED WHERE no_invoice = '$resi'");
	$counter = pg_num_rows($cek);
	$inv = "";
	if($counter===0){
		$inv = $resi;
	}else{
		cekInvoice();
		header("location:isipulsa.php");		
		
	}

	return $inv;
	pg_close($conn);

}

	
	function cekToken($nom){
		$conn =connectDB();

		$inv = cekInvoice();
		$qr = pg_query($conn, "SELECT P.*, L.nominal FROM PRODUK P, PRODUK_PULSA L WHERE P.kode_produk = L.kode_produk");
		$result = pg_fetch_assoc($qr);
		if(preg_match("/^[0-9]{1,20}$/", $nom)) {
  			pg_query($conn, "INSERT INTO TRANSAKSI_PULSA (no_invoice, tanggal, waktu_bayar, status, total_bayar, email_pembeli,nominal,nomor,kode_produk) VALUES ('$inv','".date('Y-m-d')."','".date('Y-m-d')." ".date('H:i:s')."', 2, ".$result['harga'].", '".$_SESSION['email']."', '".$result['nominal']."', '$nom', '".$result['kode_produk']."')");

  			
		}else{
			echo "<script language='javascript'>";
			echo "alert('Isi nomor salah')";
			echo "</script>";
			
		}

		header("location:index.php");
	}

	
?>