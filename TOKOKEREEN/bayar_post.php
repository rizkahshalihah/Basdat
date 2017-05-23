<?php

	include 'connect.php';

	function minimumOrder(){

		$conn = connectDB();
		$cd = $_SESSION['code'];
		$qr = pg_query($conn, "SELECT min_order, max_grosir FROM SHIPPED_PRODUK WHERE kode_produk = '$cd'");
		$result= pg_fetch_assoc($qr);
		$min = $result['min_order'];
		$max = $result['max_grosir'];
		echo '<input type="number" min= "'.$min.'" max="'.$max.'"class="form-control" name="qtt" value="qtt" placeholder="Isi Kuantitas Barang" required />';
	}

	function cetakKirim(){
		$conn = connectDB();
		$toko = $_SESSION['namaToko'];
		$qr = pg_query($conn, "SELECT * FROM TOKO_JASA_KIRIM WHERE nama_toko = '$toko'");
		$result = pg_fetch_all($qr);

		if(!empty($result)){
			foreach ($result as $value) {
				$nama = $value['nama_toko'];
				$kurir = $value['jasa_kirim'];
				echo '<input type="radio" name="JasKir" value="'.$kurir.'">'.$kurir.'<br>';
			}
		}
	}


function generateInvoice(){
	$my_array = array("V","A","C","D","B","J","S","P","T","I","M");
	shuffle($my_array);
	$nums1 = rand(100,999);
	$nums2 = rand(100,999);
	$nums3 = rand(100,999);
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
		header("location:methodbayar.php");		
		
	}

	return $inv;
	pg_close($conn);

}

function masukTransaksi($ttl, $adr, $trf, $jsk){
	$conn = connectDB();


	if(isset($_SESSION['inv'])){
		$invoice = $_SESSION['inv'];
		$qr = pg_query($conn, "SELECT no_invoice FROM TRANSAKSI_SHIPPED WHERE no_invoice = '$invoice'");
		$count = pg_num_rows($qr);
		if($count===0){
			pg_query($conn, "INSERT INTO TRANSAKSI_SHIPPED(no_invoice, tanggal, waktu_bayar, status, total_bayar, email_pembeli, nama_toko, alamat_kirim, biaya_kirim, no_resi, nama_jasa_kirim) VALUES ('".$_SESSION['inv']."','".date('Y-m-d')."', NULL, 1, $ttl, '".$_SESSION['email']."', '".$_SESSION['namaToko']."', '$adr', $trf, NULL, '$jsk')");
		}
	}
}


function masukCart(){
		$conn = connectDB();
		$cd = $_SESSION['code'];
		$quantity = $_POST['qtt'];
		
		if(!isset($_SESSION['inv'])){
			$_SESSION['inv'] = cekInvoice();
		}

		

		if(!isset($_SESSION['adr'])&&!isset($_SESSION['JasKir'])){
			$_SESSION['jaskir'] = $_POST['JasKir'];
			$_SESSION['adr'] = $_POST['ads'];	
		}


		$wgt = $_POST['brt'];

		$harga = 0;
		$mail = $_SESSION['email'];

		$js = pg_query($conn, "SELECT tarif FROM JASA_KIRIM WHERE nama = '".$_SESSION['jaskir']."'");
		$qr = pg_query($conn, "SELECT S.*, P.harga FROM SHIPPED_PRODUK S, PRODUK P WHERE S.kode_produk = '$cd' AND S.kode_produk=P.kode_produk");
		$result = pg_fetch_assoc($qr);
		$fee = pg_fetch_assoc($js);
		$tarif = $fee['tarif'];

		if($quantity>=$result['min_grosir']){
			$harga = $result['harga_grosir'];
		}else{
			$harga = $result['harga'];
		}

		$sub = $harga * $quantity;
		
		masukTransaksi($sub, $_SESSION['adr'], $tarif, $_SESSION['jaskir']);

	}

	function masukCart2(){
		$conn = connectDB();
		$cd = $_SESSION['code'];
		$quantity = $_POST['qtt'];
		
		if(!isset($_SESSION['inv'])){
			$_SESSION['inv'] = cekInvoice();
		}

		

		if(!isset($_SESSION['adr'])&&!isset($_SESSION['JasKir'])){
			$_SESSION['jaskir'] = $_POST['JasKir'];
			$_SESSION['adr'] = $_POST['ads'];	
		}


		$wgt = $_POST['brt'];	
		
		

		$harga = 0;
		$mail = $_SESSION['email'];

		$js = pg_query($conn, "SELECT no_invoice, kode_produk FROM LIST_ITEM WHERE no_invoice = '".$_SESSION['inv']."' AND kode_produk = '".$_SESSION['code']."'");



		$qr = pg_query($conn, "SELECT S.*, P.harga FROM SHIPPED_PRODUK S, PRODUK P WHERE S.kode_produk = '$cd' AND S.kode_produk=P.kode_produk");
		$result = pg_fetch_assoc($qr);
		$fee = pg_num_rows($js);
		

		if($quantity>=$result['min_grosir']){
			$harga = $result['harga_grosir'];
		}else{
			$harga = $result['harga'];
		}

		$sub = $harga * $quantity;

		if($fee===0){
			pg_query($conn, "INSERT INTO KERANJANG_BELANJA(pembeli, kode_produk, berat, kuantitas, harga, sub_total) VALUES ('$mail','$cd', $wgt, $quantity, $harga, $sub)");
		

		pg_query($conn, "INSERT INTO LIST_ITEM(no_invoice, kode_produk, berat, kuantitas, harga, sub_total) VALUES ('".$_SESSION['inv']."','$cd', $wgt, $quantity, $harga, $sub)");	
		}else{

			echo "<script language='javascript'>";
			echo "alert('Anda sudah beli barang ini')";
			echo "</script>";
		}

		
	}

	function cetakAlamat(){
		if(isset($_SESSION['adr'])){
			echo $_SESSION['adr'];
		}else{
			echo '<div class="input-group"><input type="text" class="form-control" placeholder="Isi Alamat Kirim" name="ads" required/></div>';
		}
	}

?>