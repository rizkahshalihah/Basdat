<?php
	session_start();
	include 'navigasi.php';
	include 'connect.php';

	function selectAllFromPromo($table){
		$conn = connectDB();

		$result = "SELECT * FROM kategori_utama";

		if (!$hasil = pg_query($conn, $result)){
			die("Error: $sql");
		}

		pg_close($conn);
		return $hasil;
	}


	function generate_id(){
		$conn = connectDB();
		$query = "SELECT * FROM PROMO";
		$num_data = pg_num_rows(pg_query($query))+1;
		
		

		if ($num_data > 9999){
			$new_id = "R".$num_data."";
		} else if ($num_data > 999){
			$new_id = "R0".$num_data."";
		} else if ($num_data > 99){
			$new_id = "R00".$num_data."";
		} else if ($num_data > 9){
			$new_id = "R000".$num_data."";
		} else {
			$new_id = "R0000".$num_data."";	
		}
		
		return $new_id;
	}

	function insert_promo(){
		$conn = connectDB();

		$id = generate_id();
		$deskripsi = $_POST['input_deskripsi'];
		$periode_awal = $_POST['awal'];
		$periode_akhir = $_POST['akhir'];
		$kode_promo = $_POST['kode'];
		$kategori = $_POST['promo'];
		$sub_kategori = $_POST['promoSub'];

		if ($periode_awal > $periode_akhir){
			echo "<script> alert('Periode akhir harus lebih besar daripada periode awal');</script>";
		} else {
			$sql = "INSERT INTO promo (id,deskripsi,periode_awal,periode_akhir,kode) values ('$id', '$deskripsi', '$periode_awal', '$periode_akhir', '$kode_promo')";

			if ($result = pg_query($conn,$sql)){
				insert_promo_produk($id);
			} else{
				die("Error:$sql");
			}

			pg_close($conn);	
		}	
	}

	function insert_promo_produk($id){
		$conn = connectDB();

		$hasil = $_POST['promoSub'];

		$sql = "SELECT kode_produk FROM SHIPPED_PRODUK S, SUB_KATEGORI SK WHERE SK.kode = S.kategori AND SK.nama = '".$hasil."'";
		$exec = pg_query($sql);
		if(!$exec){
			die('Errror Cuk!');
		}else{	
			while($row = pg_fetch_assoc($exec)){
				$query = "INSERT INTO promo_produk (id_promo,kode_produk) values ('".$id."', '".$row['kode_produk']."')";
				$masukin = pg_query($query);
				if ($masukin){
					header("Location: promo_details.php");
				} else{
					die("Error:$sql");
				}
			}	
		}

		

		pg_close($conn);

	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		insert_promo();
		
	}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Page | Toko Keren</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<?php
			cetakNavigasi();
		?>
	</header><!--/header-->
		<header class="ccheader">
		
    		<h1>Form Membuat Promo</h1>	
		</header>
			<div class="wrapper">
			    <form method="post" action="promo_details.php" class="ccform">
			  
    				<h3> Deskripsi Promo : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" name="input_deskripsi" placeholder="Deskripsi" required="" oninvalid="this.setCustomValidity('Harap masukkan deskripsi promo')"></input>
					 
    				</div>
    			
					<h3> Periode Awal :  </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
        				<input type="date" class="hide-replaced ccformfield" name="awal" required="" oninvalid="this.setCustomValidity('Harap masukkan periode awal promo')"></input>
    				</div>
    				
					<h3> Periode Akhir : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
        				<input type="date" class="hide-replaced ccformfield" name="akhir" required="" oninvalid="this.setCustomValidity('Harap masukkan periode akhir promo')"></input>
    				</div>
			    
					
					<h3> Kode Promo : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input class="ccformfield" type="text" name="kode" placeholder="Kode Promo" required="" oninvalid="this.setCustomValidity('Harap masukkan kode promo')">
    				</div>	
					
				<h3> Kategori : </h3>
					<div class="form-row format-date"> <span class="date-display"></span>
					<select name="promo" id="promo" placeholder="Kategori" onchange='showSubCategory(this.value)' required>
					<option disable selected value>Kategori</option>
					<?php
						$res = selectAllFromPromo("kategori_utama");
						
							while (($row = pg_fetch_row($res)))
							{
							    echo "<option>".$row[1]."</option>";
							}
						
						?>
					</select>
				</div>

				<h3> Sub Kategori : </h3>
					<div class="form-row format-date"> <span class="date-display"></span>
					<select name="promoSub" id="sub" required>
					<option disable selected value>Sub Kategori</option>	
					</select>
					</div>

					<br>
					<br>

				<div class="ccfield-prepend">
					<input type="hidden" id="insert_promo" name="command" value="insert">
 					<button type="submit" class="ccbtn">Submit</button>
			    </div>
			    </form>
			</div>		
			
		
		
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>TOKO</span>KEREN</h2>
							<p>Merupakan bentuk dari tugas akhir basis data yang dikerjakan oleh:<br><br>
							Ervina -1506689414,<br>
							Hera - 1506689420<br>
							Ratu - 1506689351, dan<br>
							Rizkah - 1506689641 <br><br>
							Kelas Basdat B | Asdos D
							</p>
						</div>
					</div>
					<br><br>
					
						<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Mailinglist TOKOKEREN</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Email Anda" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Dapatkan info-info menarik mengenai<br />produk terbaik dan promo dari<br>TOKO KEREN</p>
							</form>
						</div>
	
						
						
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>Kampus UI Depok, Pd. Cina, Beji, Kota Depok, Jawa Barat 16424</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2017 TOKOKEREN Inc. All rights reserved.</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>

    <script>
		function showSubCategory(str) {
  	
  	if (window.XMLHttpRequest) {
    	// code for IE7+, Firefox, Chrome, Opera, Safari
    	xmlhttp=new XMLHttpRequest();
  	} else { // code for IE6, IE5
    	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
  		xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    	document.getElementById("sub").innerHTML=this.responseText;
    }
  	}
		xmlhttp.open("GET","getSubKategori.php?q="+str,true);
		xmlhttp.send();
	}
	</script>
</body>
</html>