<?php 
session_start();
include 'navigasi.php';
include 'connect.php';

function addShippedProduk(){
	//INSERT
	
		$conn = connectDB();
		$kode = $_POST['kodeproduk'];
		$nama =  $_POST['namaproduk'];
		$harga = $_POST['harga'];
		$deskripsi =  $_POST['deskripsi'];
		$kategori = $_POST['subkategori'];
		$isAsuransi =  $_POST['isAsuransi'];
		$stok = $_POST['stok'];
		$isBaru =  $_POST['isBaru'];
		$minorder = $_POST['minorder'];
		$mingrosir =  $_POST['mingrosir'];
		$maksgrosir = $_POST['maksgrosir'];
		$hargagrosir = $_POST['hargagrosir'];
		$picture =  $_POST['pic'];
		$emailpenjual = $_SESSION['email'];	
		$nama_toko = pg_query($conn, "SELECT nama FROM TOKO WHERE email_penjual = '$emailpenjual'");
		$hasiltoko = pg_fetch_assoc($nama_toko);
		$tk = $hasiltoko['nama'];

		$query = pg_query($conn, "SELECT SP.kode_produk, SP.kategori, SP.nama_toko, SP.is_asuransi, SP.stok, SP.is_baru, SP.min_order, SP.min_grosir, SP.max_grosir, SP.harga_grosir, SP.foto FROM TOKO T, SHIPPED_PRODUK SP, PRODUK P
			WHERE T.nama = '$tk'"); 
			
		//KATEGORI_UTAMA, SUB_KATEGORI, SHIPPED_PRODUK
		$quer= pg_query($conn, "SELECT * FROM PRODUK WHERE kode_produk = '$kode'");
		$count = pg_num_rows($quer);

		if ($count===0) {
			
			$row = pg_fetch_assoc($query);
				pg_query($conn, "INSERT INTO PRODUK (kode_produk, nama, harga, deskripsi) values ('$kode', '$nama', $harga, '$deskripsi')");

				pg_query($conn, "INSERT INTO SHIPPED_PRODUK (kode_produk, kategori, nama_toko, is_asuransi, stok, is_baru, min_order, min_grosir, max_grosir, harga_grosir, foto) values 
				('$kode', '$kategori','$tk','$isAsuransi','$stok','$isBaru',$minorder,$mingrosir,$maksgrosir,$hargagrosir,'$picture')");
								
				
		}else{
			echo "Nama Produk sudah ada";
		}

		pg_close($conn);
			
		
		
}	


function selectAllFromSubKategori(){
		$conn = connectDB();
		$result = pg_query($conn,"SELECT * FROM sub_kategori");
		pg_close($conn);
		return $result;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if($_SESSION['is_penjual'] == true AND $_SESSION['is_loggedin'] == true){
		//header("Location: penjual.php");
		if($_POST['command']=== 'addProduk'){
			addShippedProduk();	
		}
	}
}	


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Toko Keren</title>
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
			<h1>Form Membuat Shipped Produk</h1>	
		</header>
			<div class="wrapper">
			    <form method="post" action="" class="ccform">
			  
    			<h3> Kode Produk : </h3>
    				<input type="text" class="ccformfield" name="kodeproduk" placeholder="Kode Produk" required>
					 
    			<h3> Nama Produk :  </h3>
    				<input type="text" class="ccformfield" name="namaproduk" placeholder="Nama Produk" required>
    				
    			<h3> Harga : </h3>
    				<input type="number" min = "1" class="ccformfield" name="harga" placeholder="Harga" required>
    						    
				<h3> Deskripsi : </h3>
    				<input type="text" class="ccformfield" name="deskripsi" placeholder="Deskripsi" >
    				
				<h3> Sub Kategori : </h3>
    				<div class="form-group">
								<select id="subKategori" name="subkategori" class="ccformfield">
								<option value = 'def' disable selected value>Sub Kategori</option>
									<?php
										
										$res = selectAllFromSubKategori();
										$result = pg_fetch_all($res);
										
										foreach ($result as $value) {
											$code = $value['nama'];
											$prods = $value['kode'];
											echo "<option value = '$prods'>".$code."</option>";
										}
									
									?>
								</select> 
					</div>	
				
					
				<h3> Barang Asuransi : </h3>
    				<select id="isBarangAsuransi" type="button" name="isAsuransi" class="ccformfield dropdown-toggle usa" required >
						<option value="true">YES</option>
						<option value="false">NO</option>
					</select> 
					
					
			
				<h3> Stok : </h3>
    				<input type="number" min = "1" class="ccformfield" name="stok" placeholder="Stok" required>
    									
				<h3> Barang Baru : </h3>
    				<select id="isBarangBaru" type="button" name="isBaru" class="ccformfield dropdown-toggle usa" required >
						<option value="true">YES</option>
						<option value="false">NO</option>
																									
					</select> 
				
					
				<h3> Minimal Order : </h3>
    				<input type="number" min = "1" class="ccformfield" name="minorder" placeholder="Minimal Order" required>
    						
				
				<h3> Minimal Grosir : </h3>
    				<input type="number" min = "1" max = "12" class="ccformfield" name="mingrosir" placeholder="Minimal Grosir" required>
    								
					
				<h3> Maksimal Grosir : </h3>
    				<input type="number" min="12" class="ccformfield" name="maksgrosir" placeholder="Maksimal Grosir" required>
					
				<h3> Harga Grosir : </h3>
    				<input type="number" min = "1000" class="ccformfield" name="hargagrosir" placeholder="Harga" required>
    				
					
											
				<h3> Foto : </h3>
    				<div class="form-row format-date" required> 
    					<form action="/action_page.php">
								<input type="file" name="pic" accept="image/*">
						</form>

						<br>
						<br>
					
			    <div class="ccfield-prepend" >
					<input name="command" type="hidden" value="addProduk"/>	
			        <input class="ccbtn" type="submit" value="Submit">
			    </div>
    			</div>						
			    </form>
			</div>
		
			
			<br><br><br>
			
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
	

	<script src="js/subkat.js"></script>
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