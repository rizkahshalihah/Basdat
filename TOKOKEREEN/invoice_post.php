<?php
include 'connect.php';

	function cetakOrang(){
		$conn = connectDB();
		
		$inv = $_SESSION['nomerINV'];
 		$mail = $_SESSION['email'];
	    $sql = "SELECT P.nama, TS.status FROM PENGGUNA P, TRANSAKSI_SHIPPED TS WHERE P.email = '$mail' AND P.email = TS.email_pembeli AND TS.no_invoice = '$inv'";
		$ships = pg_query($conn, $sql);
		$res = pg_fetch_assoc($ships);
		$stats = "";

		if($res['status']!= '1'){
			$stats = "Sudah Dibayar";
		}else{
			$stats = "Belum dibayar";
		}

		echo "<strong>Pemilik kartu/rekening:</strong>".$res['nama']."<br><strong>Status bayar:</strong>".$stats."<br>";		

		pg_close($conn);

	}

	function cetakDetail(){
		$conn = connectDB();
	
 		$mail = $_SESSION['email'];
	    $sql = "SELECT * FROM PENGGUNA WHERE email = '$mail'";
		$ships = pg_query($conn, $sql);
		$res = pg_fetch_assoc($ships);

		echo "<strong>".$res['nama']."</strong><br>".$_SESSION['alamat'];		

		pg_close($conn);

	}
	
	function cetakDetails(){
		$conn = connectDB();
	
 		$mail = $_SESSION['nomerINV'];
	    $sql = "SELECT TS.nama_jasa_kirim, PP.is_asuransi, TS.no_resi FROM TRANSAKSI_SHIPPED TS, SHIPPED_PRODUK PP, LIST_ITEM L WHERE TS.no_invoice = '$mail' AND TS.no_invoice=L.no_invoice AND L.kode_produk=PP.kode_produk";
		$ships = pg_query($conn, $sql);
		$res = pg_num_rows($ships);
		$result = pg_fetch_all($ships);
		$dtl = pg_fetch_assoc($ships);
		$asur = "Tidak";

		if($res>1){
			if(!empty($result)){foreach ($result as $value) {
					$isr = $value['is_asuransi'];
					if($isr === 't'){
						$asur = "Ya";
					}
				}
			}
		}


		echo "<strong>Jasa Kirim:</strong>".$dtl['nama_jasa_kirim']."<br><strong>Asuransi:</strong>".$asur."<br><strong>No resi:</strong>".$dtl['no_resi']."<br>";		

		pg_close($conn);

	}

function showShipped(){
		$conn = connectDB();
		$mail = $_SESSION['nomerINV'];
	    $sql = "SELECT P.kode_produk,P.nama, LI.berat, LI.kuantitas, P.harga FROM PRODUK P, LIST_ITEM LI WHERE LI.no_invoice = '$mail' AND P.kode_produk = LI.kode_produk";
		$ships = pg_query($conn, $sql);
		return $ships;		
		pg_close($conn);

}

function printShip(){
	
	$conn = connectDB();
	$result = pg_fetch_all(showShipped());
	$mail = $_SESSION['nomerINV'];
	$sql = "SELECT biaya_kirim FROM TRANSAKSI_SHIPPED WHERE no_invoice = '$mail'";
	$ships = pg_query($conn, $sql);
	$hasil = pg_fetch_assoc($ships);
		echo "<thead>
			<tr>
				<td><strong>Nama Produk</strong></td>
				<td class='text-center'><strong>Berat</strong></td>
				<td class='text-center'><strong>Kuantitas</strong></td>
				<td class='text-center'><strong>Harga</strong></td>
				<td class='text-right'><strong>Subtotal</strong></td>
				<td class='text-right'><strong>Ulasan</strong></td>
			</tr>
		</thead>";
									
	$subs = 0;
	if(!empty($result)){	foreach ($result as $value) {
		
		$inv = $value['nama'];
		$tok = $value['berat'];
		$tgl = $value['kuantitas'];
		$stat = $value['harga'];
		$ttl = $value['harga'] * $value['kuantitas'];
		$tr = $_SESSION['nomerINV'];

		$subs = $subs + $ttl;
		
		$ress = pg_query($conn, "SELECT U.email_pembeli FROM ULASAN U, LIST_ITEM L, TRANSAKSI_SHIPPED TS WHERE U.kode_produk = L.kode_produk AND L.no_invoice = '$tr' AND TS.no_invoice = L.no_invoice AND U.email_pembeli = TS.email_pembeli");
		$results = pg_fetch_all($ress);
		$counts = pg_num_rows($ress);

		if(!isset($_SESSION['betot'])){
			$_SESSION['betot'] = $tok + 0;
		}else{
			$_SESSION['betot'] = $tok + $_SESSION['betot'];
		}
		

		$ulas = "";
		$stts = $results['status'];
		$ids = $value['kode_produk'];
		if($counts===0){
			$ulas = "<form method='POST' action=''>
				<input type='hidden' name='debar' value='$ids'/>
				<input type='hidden' name='command' value='detil'/>
				<button type='submit' class='btn btn-warning btn-xs pull-left'>Ulasan</button>
			</form>";
		}else{
			$ulas = "<form method='POST' action=''>
				<input type='hidden' name='debar' value='$ids'/>
				<input type='hidden' name='command' value='detil'/>
				<button type='submit' class='btn btn-warning btn-xs pull-left' disabled>Ulasan</button>
			</form>";
		}

	    echo "<tbody>
			<tr>
				<td>".$inv."</td>
				<td class='text-center'>".$tok."</td>
				<td class='text-center'>".$tgl."</td>
				<td class='text-center'>".$stat."</td>
				<td class='text-right'>".$ttl.".00</td>
				<td class='text-right pull-right'>".$ulas."</td>
			</tr>";		
	}
}
	$tarif = $_SESSION['betot'] * $hasil['biaya_kirim'];
	$totl = $tarif + $subs;
	echo "<tr>
				<td class='emptyrow'></td>
				<td class='emptyrow'></td>
				<td class='emptyrow'></td>
				<td class='emptyrow text-center'><strong>Subtotal</strong></td>
				<td class='emptyrow text-right'>".$subs.".00</td>
			</tr>

			<tr>
				<td class='emptyrow'></td>
				<td class='emptyrow'></td>
				<td class='emptyrow'></td>
				<td class='emptyrow text-center'><strong>Shipping</strong></td>
				<td class='emptyrow text-right'>".$tarif.".00</td>
			</tr>
			<tr>
				<td class='emptyrow'><i class='fa fa-barcode iconbig'></i></td>
				<td class='emptyrow'></td>
				<td class='emptyrow'></td>
				<td class='emptyrow text-center'><strong>Total</strong></td>
				<td class='emptyrow text-right'>".$totl.".00</td>
			</tr>
		</tbody>";
	pg_close($conn);
	
}


function printNotShip(){
	
	$conn = connectDB();
	$result = pg_fetch_all(showShipped());
	$mail = $_SESSION['nomerINV'];
	$sql = "SELECT biaya_kirim FROM TRANSAKSI_SHIPPED WHERE no_invoice = '$mail'";
	$ships = pg_query($conn, $sql);
	$hasil = pg_fetch_assoc($ships);
		echo "<thead>
			<tr>
				<td><strong>Nama Produk</strong></td>
				<td class='text-center'><strong>Berat</strong></td>
				<td class='text-center'><strong>Kuantitas</strong></td>
				<td class='text-center'><strong>Harga</strong></td>
				<td class='text-right'><strong>Subtotal</strong></td>
				<td class='text-right'><strong>Ulasan</strong></td>
			</tr>
		</thead>";
									
	$subs = 0;
	if(!empty($result)){	foreach ($result as $value) {
		
		$inv = $value['nama'];
		$tok = $value['berat'];
		$tgl = $value['kuantitas'];
		$stat = $value['harga'];
		$ttl = $value['harga'] * $value['kuantitas'];
		$tr = $_SESSION['nomerINV'];

		$subs = $subs + $ttl;
		
		$ress = pg_query($conn, "SELECT U.email_pembeli FROM ULASAN U, LIST_ITEM L, TRANSAKSI_SHIPPED TS WHERE U.kode_produk = L.kode_produk AND L.no_invoice = '$tr' AND TS.no_invoice = L.no_invoice AND U.email_pembeli = TS.email_pembeli");
		$results = pg_fetch_all($ress);
		$counts = pg_num_rows($ress);

		if(!isset($_SESSION['betot'])){
			$_SESSION['betot'] = $tok + 0;
		}else{
			$_SESSION['betot'] = $tok + $_SESSION['betot'];
		}

		$ulas = "";
		$stts = $results['status'];
		$ids = $value['kode_produk'];
			$ulas = "<form method='POST' action=''>
				<input type='hidden' name='debar' value='$ids'/>
				<input type='hidden' name='command' value='detil'/>
				<button type='submit' class='btn btn-warning btn-xs pull-left' disabled>Ulasan</button>
			</form>";
		

	    echo "<tbody>
			<tr>
				<td>".$inv."</td>
				<td class='text-center'>".$tok."</td>
				<td class='text-center'>".$tgl."</td>
				<td class='text-center'>".$stat."</td>
				<td class='text-right'>".$ttl.".00</td>
				<td class='text-right pull-right'>".$ulas."</td>
			</tr>";		
	}
}
	$tarif = $_SESSION['betot'] * $hasil['biaya_kirim'];
	$totl = $tarif + $subs;
	echo "<tr>
				<td class='emptyrow'></td>
				<td class='emptyrow'></td>
				<td class='emptyrow'></td>
				<td class='emptyrow text-center'><strong>Subtotal</strong></td>
				<td class='emptyrow text-right'>".$subs.".00</td>
			</tr>

			<tr>
				<td class='emptyrow'></td>
				<td class='emptyrow'></td>
				<td class='emptyrow'></td>
				<td class='emptyrow text-center'><strong>Shipping</strong></td>
				<td class='emptyrow text-right'>".$tarif.".00</td>
			</tr>
			<tr>
				<td class='emptyrow'><i class='fa fa-barcode iconbig'></i></td>
				<td class='emptyrow'></td>
				<td class='emptyrow'></td>
				<td class='emptyrow text-center'><strong>Total</strong></td>
				<td class='emptyrow text-right'>".$totl.".00</td>
			</tr>
		</tbody>";
	pg_close($conn);
	
}


function checkStats(){
	$conn = connectDB();
	$mail = $_SESSION['email'];
	$inv = $_SESSION['nomerINV'];
	$result = pg_query($conn, "SELECT status FROM TRANSAKSI_SHIPPED WHERE no_invoice= '$inv' AND email_pembeli='$mail'");
	
	return $result;
}


function doInvoice(){
	$conn = connectDB();
	$stt = checkStats();
	$result1 = pg_fetch_assoc($stt);
	$stts = $result1['status'];

	if($stts==='4'){
		printShip();
	}else{
		printNotShip();
	}


}

function invButton(){
	$conn = connectDB();
	$stt = checkStats();
	$result1 = pg_fetch_assoc($stt);
	$stts = $result1['status'];

	if($stts==='1'){
		echo "<form method='POST' action=''>
				<input type='hidden' name='command' value='pay'/>
				<button type='submit' class='btn btn-warning btn-xs pull-right'>Konfirmasi Bayar</button>
			</form>";

	}else if($stts==='2'){
		echo "<form method='POST' action=''>
				<input type='hidden' name='command' value='sent'/>
				<button type='submit' class='btn btn-warning btn-xs pull-right'>Konfirmasi Terima Resi</button>
			</form>";
	}else if($stts==='3'){
		echo "<form method='POST' action=''>
				<input type='hidden' name='command' value='accept'/>
				<button type='submit' class='btn btn-warning btn-xs pull-right'>Konfirmasi Penerimaan</button>
			</form>";

	}	

	pg_close($conn);
}

function payConfirm(){
	$conn = connectDB();
	$mail = $_SESSION['email'];
	$inv = $_SESSION['nomerINV'];
	$stt = checkStats();
	$result1 = pg_fetch_assoc($stt);
	$stts = $result1['status']+1;

	pg_query($conn, "UPDATE TRANSAKSI_SHIPPED SET status= $stts WHERE email_pembeli = '$mail' AND no_invoice = '$inv'");

	header("location:invoice.php");
	pg_close($conn);
}


function generateResi(){
	$my_array = array("JKT","BGR","CKR","DPK","BKS","JOG","SRB","PDG","TGR","BDG","BLI","MDR","MKS","PTK");
	shuffle($my_array);
	$nums1 = rand(10000,99999);
	$nums2 = rand(10000,99999);
	$nums3 = rand(100,999);
	$res = $my_array[1].''.$nums1.''.$nums2.''.$nums3;
	return $res;

}

function insertResi(){

	$conn = connectDB();
	$resi = generateResi(); 
	$inv = $_SESSION['nomerINV'];
	$cek = pg_query($conn, "SELECT no_resi FROM TRANSAKSI_SHIPPED WHERE no_resi = '$resi'");
	$counter = pg_num_rows($cek);

	if($counter===0){
		pg_query($conn, "UPDATE TRANSAKSI_SHIPPED SET no_resi= '$resi' WHERE no_invoice = '$inv'");
		
	}else{

		insertResi();
		header("location:invoice.php");		
		
	}

	pg_close($conn);

}


function detailTombol($id){
	$conn = connectDB();
	$_SESSION['nomerProd'] = $id;
	header("location:ulasan.php");

}



?>