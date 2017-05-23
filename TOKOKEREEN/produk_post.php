<?php
include 'connect.php';

	function getKategori(){

		$conn = connectDB();
		$qr = pg_query($conn, "SELECT nama, kode FROM KATEGORI_UTAMA");
		$result = pg_fetch_all($qr);
		
		foreach ($result as $value) {
			$name = $value['nama'];
			$code = $value['kode'];
			$btn = "<form method='POST' action=''>
				<input type='hidden' name='prods' value='$code'/>
				<input type='hidden' name='command' value='ktgr'/>
				<button type='submit' class='btn btn-warning btn-md pull-left'>$name</button>
			</form>";

			echo "<div class='col-md-2'>
                <div>
                 	$btn <br>
                </div>
            </div>";	
		}

		pg_close($conn);

	}


	function getSubKategori(){

		$conn = connectDB();
		$ktg = $_SESSION['kategori'];

		
		$qr = pg_query($conn, "SELECT nama, kode FROM SUB_KATEGORI WHERE kode_kategori = '$ktg'");
		$result = pg_fetch_all($qr);

		if(!empty($result)){foreach ($result as $value) {
			$name = $value['nama'];
			$cd = $value['kode'];
			$btn = "<form method='POST' action=''>
				<input type='hidden' name='prodsb' value='$cd'/>
				<input type='hidden' name='command' value='sktg'/>
				<button type='submit' class='btn btn-warning btn-md pull-left'>$name</button>
			</form>";

			echo "<div class='col-md-2'>
                <div>
                 	$btn <br>
                </div>
            </div>";	
		}
	}
		
		
		pg_close($conn);

	}




	function getKategoriVal($id){
		$conn = connectDB();
		$_SESSION['kategori'] = $id;
		
		getSubKategori();

	}

	
	function cetakProduk1(){

		$conn = connectDB();
		$toko = $_SESSION['namaToko'];
		$qr = pg_query($conn, "SELECT P.nama, P.kode_produk FROM PRODUK P, SHIPPED_PRODUK S WHERE P.kode_produk = S.kode_produk AND S.nama_toko = '$toko'");

		$result = pg_fetch_all($qr);

		echo "<thead>";
		echo "<tr><td>
			<h5><Strong>Nama Produk<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Lihat Detail<Strong></h5>
			</td>";
			echo "</tr>";
		echo "</thead>";

	if(!empty($result)){foreach ($result as $value) {
		
		
		$name = $value['nama'];
		$inv = $value['kode_produk'];

		$dtl = "<form method='POST' action=''>
			<input type='hidden' name='detail' value='$inv'/>
			<input type='hidden' name='command' value='detils'/>
			<button type='submit' class='btn btn-warning btn-xs pull-left'>Detail Barang </button>
		</form>";


	    echo "<tr>";
			echo "<td>
			<h5>".$name."</h5>
			</td>";
			echo "<td>
			<h5>".$dtl."</h5>
			</td>";
		echo "</tr>";		
	}
}
pg_close($conn);


}



function cetakProduk2(){

		$conn = connectDB();
		$toko = $_SESSION['namaToko'];
		$katg = $_SESSION['subkat'];

		$qr = pg_query($conn, "SELECT P.nama, P.kode_produk FROM PRODUK P, SHIPPED_PRODUK S WHERE P.kode_produk = S.kode_produk AND S.nama_toko = '$toko' AND S.kategori = '$katg'");

		$result = pg_fetch_all($qr);

		echo "<thead>";
		echo "<tr><td>
			<h5><Strong>Nama Produk<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Lihat Detail<Strong></h5>
			</td>";
			echo "</tr>";
		echo "</thead>";

	if(!empty($result)){foreach ($result as $value) {
		
		
		$name = $value['nama'];
		$inv = $value['kode_produk'];

		$dtl = "<form method='POST' action=''>
			<input type='hidden' name='detail' value='$inv'/>
			<input type='hidden' name='command' value='detils'/>
			<button type='submit' class='btn btn-warning btn-xs pull-left'>Detail Barang </button>
		</form>";


	    echo "<tr>";
			echo "<td>
			<h5>".$name."</h5>
			</td>";
			echo "<td>
			<h5>".$dtl."</h5>
			</td>";
		echo "</tr>";		
	}
}
pg_close($conn);


}

function cetakAll(){

	$conn = connectDB();
	if(isset($_SESSION['subkat'])){
		cetakProduk2();
	}else{
		cetakProduk1();
	}
}

?>