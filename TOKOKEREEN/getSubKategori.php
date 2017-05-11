<?php
		$user = "postgres";
		$pass = "RIZKAHBIEBER22";

		$conn = pg_connect("host=localhost dbname=rizkahshalihah user=postgres password=RIZKAHBIEBER22");

		if (!$conn) {
			die("Connection failed: " + pg_connection_status());
		} else {
			echo "connected";
		}

		$hasil = $_GET['q'];
		$query = "SELECT SK.nama FROM kategori_utama KU, sub_kategori SK WHERE KU.kode =  SK.kode_kategori AND KU.nama = '$hasil'";
		$return = pg_query($query);
		while (($row = pg_fetch_assoc($return)))
		{
		    echo "<option>".$row['nama']."</option>";
		}
						
?>