<?php
include 'connect.php';
		
	function cetakCart(){

		$conn=connectDB();
		if(isset($_SESSION['inv'])){
			$ivc = $_SESSION['inv'];
			$qr = pg_query($conn, "SELECT P.nama, L.berat, L.harga, L.kuantitas, L.sub_total FROM LIST_ITEM L, PRODUK P WHERE L.no_invoice = '$ivc' AND L.kode_produk = P.kode_produk");
			$result = pg_fetch_all($qr);

			if(!empty($result)){
				foreach ($result as $value) {
					$name = $value['nama'];
					$wgt = $value['berat'];
					$prc = $value['harga'];
					$qtt = $value['kuantitas'];
					$sub = $value['sub_total'];
					echo '<tr><td>'.$name.'</td><td class="text-center">'.$prc.'</td>
					<td class="text-center">'.$qtt.'</td>
					<td class="text-center">'.$wgt.'</td>
					<td class="text-right">'.$sub.'</td>
					</tr>';
				}
			}

			
									
		}

	}



?>

