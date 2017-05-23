<?php 




include 'connect.php';
    
function showShipped(){
	$conn = connectDB();
	
 	$mail = $_SESSION['email'];
	    $sql = "SELECT * FROM TRANSAKSI_SHIPPED WHERE email_pembeli = '$mail' AND status = 4";
		$ships = pg_query($conn, $sql);
		return $ships;		

	pg_close($conn);

}

function printShip(){
	
	$conn = connectDB();
	$result = pg_fetch_all(showShipped());

		echo "<thead>";
		echo "<tr><td>
			<h5><Strong>Nomor Invoice<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Nama Toko<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Tanggal<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Status<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Total Bayar<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Alamat Kirim<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Biaya Kirim<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Nomor Resi<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Jasa Kirim<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Ulas<Strong></h5>
			</td>";
			echo "</tr>";
		echo "</thead>";
	
	if(!empty($result)){foreach ($result as $value) {
		
		$inv = $value['no_invoice'];
		$tok = $value['nama_toko'];
		$tgl = $value['tanggal'];
		$stat = $value['status'];
		$ttl = $value['total_bayar'];
		$adr = $value['alamat_kirim'];
		$bkr = $value['biaya_kirim'];
		$nrs = $value['no_resi'];
		$jkr = $value['nama_jasa_kirim'];
		
		$ress = pg_query($conn, "SELECT U.email_pembeli FROM ULASAN U, LIST_ITEM L WHERE U.kode_produk = L.kode_produk AND L.no_invoice = '$inv'");
		$counts = pg_num_rows($ress);


		$nrs1 = "";
		
		if($nrs === NULL){
			$nrs1 = "KOSONG";
		}else{
			$nrs1 = $nrs;
		}

		$stt = "Barang sudah diterima";
		
		$ulas = "<form method='POST' action=''>
			<input type='hidden' name='debar' value='$inv'/>
			<input type='hidden' name='command' value='detil'/>
			<button type='submit' class='btn btn-warning btn-xs pull-left'>Detail Barang </button>
		</form>";


	    echo "<tr>";
			echo "<td>
			<h5>".$inv."</h5>
			</td>";
			echo "<td>
			<h5>".$tok."</h5>
			</td>";
			echo "<td>
			<h5>".$tgl."</h5>
			</td>";
			echo "<td>
			<h5>".$stt."</h5>
			</td>";
			echo "<td>
			<h5>".$ttl."</h5>
			</td>";
			echo "<td>
			<h5>".$adr."</h5>
			</td>";
			echo "<td>
			<h5>".$bkr."</h5>
			</td>";
			echo "<td>
			<h5>".$nrs1."</h5>
			</td>";
			echo "<td>
			<h5>".$jkr."</h5>
			</td>";
			echo "<td>
			<h5>".$ulas."</h5>
			</td>";
		echo "</tr>";		
	}
}
	pg_close($conn);
	
}


function showPulsa(){
	$conn = connectDB();
	
 		$mail = $_SESSION['email'];
	    $sql = "SELECT TP.no_invoice, PP.nama, TP.tanggal, TP.status, TP.total_bayar, TP.nominal, TP.nomor FROM TRANSAKSI_PULSA TP, PRODUK PP WHERE TP.email_pembeli = '$mail' AND TP.kode_produk=PP.kode_produk";
		$puls = pg_query($conn, $sql);
		return $puls;		

	pg_close($conn);

}

function printPulsa(){
	
	$conn = connectDB();
	$result = pg_fetch_all(showPulsa());

		echo "<thead>";
		echo "<tr><td>
			<h5><Strong>Nomor Invoice<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Nama Produk<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Tanggal<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Status<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Total Bayar<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Nominal<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Nomor<Strong></h5>
			</td>";
			echo "</tr>";
		echo "</thead>";
	
	if(!empty($result)){foreach ($result as $value) {
		
		$inv = $value['no_invoice'];
		$tok = $value['nama'];
		$tgl = $value['tanggal'];
		$stat = $value['status'];
		$ttl = $value['total_bayar'];
		$adr = $value['nominal'];
		$bkr = $value['nomor'];
		
		
		$nrs1 = "";
		
		if($stat === 1){
			$nrs1 = "Transaksi dilakukan";
		}else{
			$nrs1 = "Sudah dibayar";
		}

		
	    echo "<tr>";
			echo "<td>
			<h5>".$inv."</h5>
			</td>";
			echo "<td>
			<h5>".$tok."</h5>
			</td>";
			echo "<td>
			<h5>".$tgl."</h5>
			</td>";
			echo "<td>
			<h5>".$nrs1."</h5>
			</td>";
			echo "<td>
			<h5>".$ttl."</h5>
			</td>";
			echo "<td>
			<h5>".$adr."</h5>
			</td>";
			echo "<td>
			<h5>".$bkr."</h5>
			</td>";
		echo "</tr>";		
	}
}
	pg_close($conn);
	
}


function showNotFin(){
	$conn = connectDB();
	
 	$mail = $_SESSION['email'];
	    $sql = "SELECT * FROM TRANSAKSI_SHIPPED WHERE email_pembeli = '$mail' AND status != 4";
		$ships = pg_query($conn, $sql);
		return $ships;		

	pg_close($conn);

}

function printNotFin(){
	
	$conn = connectDB();
	$result = pg_fetch_all(showNotFin());

		echo "<thead>";
		echo "<tr><td>
			<h5><Strong>Nomor Invoice<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Nama Toko<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Tanggal<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Status<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Total Bayar<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Alamat Kirim<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Biaya Kirim<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Nomor Resi<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Jasa Kirim<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Ulas<Strong></h5>
			</td>";
			echo "</tr>";
		echo "</thead>";
	
	if(!empty($result)){foreach ($result as $value) {
		
		$inv = $value['no_invoice'];
		$tok = $value['nama_toko'];
		$tgl = $value['tanggal'];
		$stat = $value['status'];
		$ttl = $value['total_bayar'];
		$adr = $value['alamat_kirim'];
		$bkr = $value['biaya_kirim'];
		$nrs = "KOSONG";
		$jkr = $value['nama_jasa_kirim'];
		
		$nrs1 = "";
		if($stat === '1'){
			$nrs1 = "Transaksi Dilakukan";
		}else if($stat === '2'){
			$nrs1 = "Barang Sudah Dibayar";
		}else{
			$nrs1 = "Barang Sudah Dikirim";
		}

		
		$ulas = "<form method='POST' action=''>
			<input type='hidden' name='debar' value='$inv'/>
			<input type='hidden' name='command' value='detil'/>
			<button type='submit' class='btn btn-warning btn-xs pull-left'>Detail Invoice </button>
		</form>";


	    echo "<tr>";
			echo "<td>
			<h5>".$inv."</h5>
			</td>";
			echo "<td>
			<h5>".$tok."</h5>
			</td>";
			echo "<td>
			<h5>".$tgl."</h5>
			</td>";
			echo "<td>
			<h5>".$nrs1."</h5>
			</td>";
			echo "<td>
			<h5>".$ttl."</h5>
			</td>";
			echo "<td>
			<h5>".$adr."</h5>
			</td>";
			echo "<td>
			<h5>".$bkr."</h5>
			</td>";
			echo "<td>
			<h5>".$nrs."</h5>
			</td>";
			echo "<td>
			<h5>".$jkr."</h5>
			</td>";
			echo "<td>
			<h5>".$ulas."</h5>
			</td>";
		echo "</tr>";		
	}
}
	pg_close($conn);
	
}

function cetakNama(){
	$conn = connectDB();
	
 	$mail = $_SESSION['email'];
	    $sql = "SELECT nama FROM PENGGUNA WHERE email = '$mail'";
		$name = pg_query($conn, $sql);
		$nama = pg_fetch_assoc($name);
		echo $nama['nama'];

	pg_close($conn);	
}

function cetakPoin(){
	$conn = connectDB();
	
 	$mail = $_SESSION['email'];
	    $sql = "SELECT poin FROM PELANGGAN WHERE email = '$mail'";
		$name = pg_query($conn, $sql);
		$nama = pg_fetch_assoc($name);
		echo "Poin: ".$nama['poin'];

	pg_close($conn);	
}


function detailButton($id){
	$conn = connectDB();
	$_SESSION['nomerINV'] = $id;
	header("location:invoice.php");

}


	
	
	
?>