<?php
include 'connect.php';
$conn = connectDB();

		$hasil = $_GET['q'];
		$query = "SELECT SK.nama FROM kategori_utama KU, sub_kategori SK WHERE KU.kode =  SK.kode_kategori AND KU.nama = '$hasil'";
		$return = pg_query($query);
		while (($row = pg_fetch_assoc($return)))
		{
		    echo "<option>".$row['nama']."</option>";
		}
						
?>