<?php
	
	include 'connect.php';
	function getProduk(){

		$conn = connectDB();
		$qr = pg_query($conn, "SELECT P.nama, P.kode_produk, P.harga, L.nominal FROM PRODUK P, PRODUK_PULSA L WHERE L.kode_produk = P.kode_produk");
		$result = pg_fetch_all($qr);
		
		echo "<thead>";
		echo "<tr><td>
			<h5><Strong>Kode Produk<Strong></h5>
			</td><td>
			<h5><Strong>Nama Produk<Strong></h5>
			</td><td>
			<h5><Strong>Harga<Strong></h5>
			</td><td>
			<h5><Strong>Deskripsi<Strong></h5>
			</td><td>
			<h5><Strong>Nominal<Strong></h5>
			</td>";
			echo "<td>
			<h5><Strong>Beli<Strong></h5>
			</td>";
			echo "</tr>";
		echo "</thead>";

	if(!empty($result)){foreach ($result as $value) {
		
		
		$name = $value['nama'];
		$inv = $value['kode_produk'];
		$prc = $value['harga'];
		$nom = $value['nominal'];

		$dtl = "<form method='POST' action=''>
			<input type='hidden' name='detail' value='$inv'/>
			<input type='hidden' name='command' value='beliin'/>
			<button type='submit' class='btn btn-warning btn-xs pull-left'>Beli </button>
		</form>";


	    echo "<tr>";
			echo "<td>
			<h5>".$inv."</h5>
			</td>";
			echo "<td>
			<h5>".$name."</h5>
			</td>";
			echo "<td>
			<h5>".$prc."</h5>
			</td>";
			echo "<td>
			<h5>-</h5>
			</td>";
			echo "<td>
			<h5>".$nom."</h5>
			</td>";
			echo "<td>
			<h5>".$dtl."</h5>
			</td>";
		echo "</tr>";		
	}
}


		pg_close($conn);
}


	

?>