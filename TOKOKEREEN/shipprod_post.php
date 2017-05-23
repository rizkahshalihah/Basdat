<?php
	
	include 'connect.php';
	function getProduk(){
		$conn=connectDB();
		$cd = $_SESSION['code'];
		$foto = pg_query($conn,"SELECT S.foto, S.stok, P.harga, P.nama, S.nama_toko, L.nilai_reputasi, P.deskripsi FROM SHIPPED_PRODUK S, TOKO T, PRODUK P, PELANGGAN L WHERE S.kode_produk = '$cd' AND P.kode_produk= '$cd' AND S.nama_toko = T.nama AND T.email_penjual = L.email");
		return $foto;
	}

	function cetakGambar(){
		$conn=connectDB();
		$cd = $_SESSION['code'];
		$foto = getProduk();
		$result = pg_fetch_assoc($foto);
		$img = $result['foto'];
		echo "<img src='images/product-details/$img' class='girl img-responsive' alt='image not found'/>";
	}

	function cetakNama(){
		$conn=connectDB();
		$cd = $_SESSION['code'];
		$foto = getProduk();
		$result = pg_fetch_assoc($foto);
		$name= $result['nama'];
		$stok = "";
		if($result['stok']>0){
			$stok = "ready";
		}else{
			$stok = "not ready";
		}

		echo "<h1>$name</h1><h5><small>Status : $stok</small></h5>";
	}

	function cetakDeskripsi(){
		$conn=connectDB();
		$cd = $_SESSION['code'];
		$foto = getProduk();
		$result = pg_fetch_assoc($foto);
		$name= $result['deskripsi'];
		
		echo $name;
	}

	function cetakHarga(){
		$conn=connectDB();
		$cd = $_SESSION['code'];
		$foto = getProduk();
		$result = pg_fetch_assoc($foto);
		$price= $result['harga'];
		$beli = "<form method='POST' action=''>
				<input type='hidden' name='beli' value='$cd'/>
				<input type='hidden' name='command' value='beliin'/>
				<button type='submit' class='btn btn-warning pull-left btn-lg'><i class='fa fa-shopping-cart'></i>Beli</button>
			</form>";
		$toko = $result['nama_toko'];
		$rep = $result['nilai_reputasi'];
		$rept = "";
		
		if(is_null($rep)){
			$rept = "0";
		}else{
			$rept = $rep;
		}

		echo '<h3>Rp'.$price.'</h3>
		

		<div class = "col-sm-5 pull-left">
			<div class= "row">'.
			$beli.'</div><br>
			<div class="row">
			<img src="images/store/online-store.png" class = "img-responsive" alt="" />	
			<h5>'.$toko.'</h5>
			<h5><small>Reputasi: '.$rept.'</small></h5>
			</div>
		</div>';
}

	function cetakUlasan(){

		$conn=connectDB();
		$cd = $_SESSION['code'];
		$foto = pg_query($conn,"SELECT U.*, P.nama FROM ULASAN U, PENGGUNA P WHERE kode_produk = '$cd' AND U.email_pembeli = P.email");
		$result = pg_fetch_all($foto);

		if(!empty($result)){
			foreach ($result as $value) {
				$reviewer = $value['nama'];
				$dates = $value['tanggal'];
				$rate = $value['rating'];
				$cmt = $value['komentar'];
				echo "<tr>";
					echo "<td>
					<h4><Strong>Review by ".$reviewer." on ".$dates."<Strong></h4>
					<h4>Rate: ".$rate."</h4>
					<p style='font-size:12px'>".$cmt."</p>
					</td>";
				echo "</tr>";
			}
			
	
		}else{
			echo '<h4><Strong>Belum ada ulasan<Strong></h4>';
		}
		
	}	


	function cetakKomentar(){

		$conn=connectDB();
		$cd = $_SESSION['code'];
		$foto = pg_query($conn,"SELECT K.*, P.nama FROM ULASAN U, PENGGUNA P WHERE kode_produk = '$cd' AND U.email_pembeli = P.email");
		$result = pg_fetch_all($foto);

		if(!empty($result)){
			foreach ($result as $value) {
				$reviewer = $value['nama'];
				$dates = $value['tanggal'];
				$rate = $value['rating'];
				$cmt = $value['komentar'];
				echo "<tr>";
					echo "<td>
					<h4><Strong>Review by ".$reviewer." on ".$dates."<Strong></h4>
					<h4>Rate: ".$rate."</h4>
					<p style='font-size:12px'>".$cmt."</p>
					</td>";
				echo "</tr>";
			}
			
	
		}else{
			echo '<h4><Strong>Belum ada ulasan<Strong></h4>';
		}
		
	}	

	function cekItem(){
		$conn = connectDB();

		if(isset($_SESSION['inv'])&&isset($_SESSION['code'])){
			$inv = $_SESSION['inv'];
			$cd = $_SESSION['code'];

			$qr = pg_query($conn, "SELECT * FROM LIST_ITEM WHERE no_invoice");
			$count = pg_num_rows($qr);
			if($count>0){
				echo "<script language='javascript'>";
				echo "alert('Anda sudah membeli item ini')";
				echo "</script>";	
			}else{
				header("location:methodbayar.php");	
			}
		}else{
			header("location:methodbayar.php");
		}
		

	}

?>