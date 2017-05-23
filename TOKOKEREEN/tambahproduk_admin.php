<?php
include 'navigasi.php';
include 'connect.php';
	
session_start();


function addPulsa(){
		$conn = connectDB();
		$kode = $_POST['kodeproduk'];
		$nama =  $_POST['namaproduk'];
		$harga = $_POST['harga'];
		$nominal= $_POST['nominal'];
		
		
		
		$quer= pg_query($conn, "SELECT * FROM PRODUK WHERE kode_produk = '$kode'");
		$count = pg_num_rows($quer);

		if ($count===0) {
			
			$row = pg_fetch_assoc($quer);
				pg_query($conn, "INSERT INTO PRODUK (kode_produk, nama, harga) values ('$kode', '$nama', $harga)");
				pg_query($conn, "INSERT INTO PRODUK_PULSA(kode_produk, nominal) values ('$kode', $nominal)");
				
			
		}else{
			echo "Nama Produk sudah ada";
		}

		pg_close($conn);
			
		
		
}	

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if($_SESSION['is_admin'] == true AND $_SESSION['is_loggedin'] == true){
		//header("Location: admin.php");
		if($_POST['command']=== 'addpulsa'){
			addPulsa();	
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
		
    		<h1>Form Membuat Produk Pulsa</h1>	
		</header>
			<div class="wrapper">
			    <form method="post" action="" class="ccform">
			  
    			<h3> Kode Produk : </h3>
    				<input type="text" class="ccformfield" name="kodeproduk" placeholder="Kode Produk" required>
					    				
    			
				<h3> Nama Produk :  </h3>
    				<input type="text" class="ccformfield" name="namaproduk" placeholder="Nama Produk" required>
    				
				<h3> Harga : </h3>
    				<input type="number" min= "1000" class="ccformfield" name="harga" placeholder="Harga" required>
    				
			    					
				<h3> Deskripsi : </h3>
    				<input type="text" class="ccformfield" name="deskripsi" placeholder="Deskripsi" >
    			
					
				<h3> Nominal : </h3>
    				<input type="number" min = "1" class="ccformfield" name="nominal" placeholder="Nominal" required>
    				
					
					
					<br><br><br>
							
			    <div class="ccfield-prepend">
					<input name="command" type="hidden" value="addpulsa"/>	
			        <input class="ccbtn" type="submit" value="Submit">
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