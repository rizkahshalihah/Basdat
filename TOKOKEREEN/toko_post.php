<?php

	include 'connect.php';


	function cetakLogout(){
		if(isset($_SESSION['is_loggedin'])){
			echo "<ul class='nav navbar-nav'><li><a href='logout.php'><i class='fa fa-lock'></i> Logout</a></li></ul>";
		}else{
			echo "<ul class='nav navbar-nav'><li><a href='login.php'><i class='fa fa-lock'></i> Login atau Regis</a></li></ul>";
		}
	}



	function cetakToko(){
		$conn = connectDB();
		$quer = pg_query($conn, "SELECT T.nama, T.deskripsi, T.slogan, T.lokasi, P.nilai_reputasi FROM TOKO T, PELANGGAN P WHERE T.email_penjual = P.email");
		$result = pg_fetch_all($quer);


		foreach ($result as $value) {
			$name = $value['nama'];
			$desc = $value['deskripsi'];
			$slog = $value['slogan'];
			$locs = $value['lokasi'];
			$rep = $value['nilai_reputasi'];
			$btn = "<form method='POST' action=''>
				<input type='hidden' name='detoko' value='$name'/>
				<input type='hidden' name='command' value='toko'/>
				<button type='submit' class='btn btn-warning btn-md pull-left'>Lihat Produk Dijual</button>
			</form>";

			$rept = "";
			if(is_null($rep)){
				$rept = "0";
			}else{
				$rept = $rep;
			}



			echo "<div class='col-md-4'>
                <div>
                    <img src='images/store/online-store.png' alt='Error 404' class='img-rounded img-thumbnail img-responsive' />
                    <h4>$name</h4>
                    <p style='text-align: left'>
                        <span class='fa fa-info-circle'></span>
                        $desc
                    </p>
                    <p style='text-align: left'>
                        <span class='fa fa-star'></span>
                        Reputasi : $rept
                    </p>
                    <p style='text-align: left'>
                        <span class='fa fa-edit'></span>
                        $slog
                    </p>
                    <p style='text-align: left'>
                        <span class='fa fa-map-marker'></span>
                        $locs
                    </p>
                    $btn <br>
                </div>
            </div>";	
		}
		
		pg_close($conn);
	}

	function detailTombol($id){
		$conn = connectDB();
		$_SESSION['namaToko'] = $id;
		header("location:list_produk.php");

	}

?>


