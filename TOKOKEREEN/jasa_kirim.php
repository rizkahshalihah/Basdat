<?php
	
	session_start();
	if (isset($_SESSION['status']) && $_SESSION['status'] == 'false'){
			echo "<script> alert('Jasa kirim yang dimasukkan sudah terdaftar');</script>";
			unset($_SESSION['status']);
		} 
	function connectDB(){
		$user = "postgres";
		$pass = "RIZKAHBIEBER22";

		$conn = pg_connect("host=localhost dbname=rizkahshalihah user=postgres password=RIZKAHBIEBER22");

		
		return $conn;

	}

	function insert_jasaKirim(){
		$conn = connectDB();

		$fullname = $_POST['input_name'];


		$lama_kirim = $_POST['input_lama'];
		$tarif = $_POST['input_tarif'];
		$sql = "INSERT INTO jasa_kirim (nama,lama_kirim,tarif) values ('$fullname', '$lama_kirim', '$tarif')";

		if ($result = pg_query($conn,$sql)){
			echo "Jasa kirim berhasil dibuat";
			$_SESSION['status'] = "true";

			header("Location: admin.html");
		} else{
			$_SESSION['status'] = "false";
			header("Location: jasa_kirim.php");
		}

		pg_close($conn);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		if ($_POST['command'] === 'insert'){
			insert_jasaKirim();
		} else if ($_POST['command'] === 'input_tarif'){
			validation_tarif();
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
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +62 21 12 34 56</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> cs@tokokeren.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href=admin.html><img src="images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									ID
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Indonesia</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									IDR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Rupiah</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
								
								<li><a href="index.html"><i class="fa fa-lock"></i> Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="admin.html" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Produk<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="Kategori.html">Buat Kategori & Sub</a></li>
										<li><a href="product_details.html">Buat Jasa Kirim</a></li>
										<li><a href="promo_details.php">Buat Promo Produk</a></li>
										<li><a href="admin_tambahproduk.html">Tambahkan Produk</a></li> 
										<li><a href="index.html">Logout</a></li> 
                                    </ul>
                                </li> 
								
							
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Cari"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
			<div>
			<div class="wrapper">
			<header class="ccheader">
		
    		<h1>Form Jasa Kirim</h1>
		</header>
				
			    <form method="post" action="jasa_kirim.php" class="ccform">
			    	<h3> Full Name : </h3>
				    <div class="ccfield-prepend">
						<input class="ccformfield" type="text" id= "input_name" name="input_name" placeholder="Full Name" title="Masukkan Nama Anda" required >
						</div>
					<h3> Lama Kirim : </h3>
				<div class="ccfield-prepend">
						<input class="ccformfield" type="number" id="input_lama" name="input_lama" min="1" placeholder="Contoh: 1-2 hari" title="Masukkan lama kirim" required>
			    </div>
			    <h3> Tarif : </h3>
			   	<div class="ccfield-prepend">
				       <input class="ccformfield" type="number" id="input_tarif" name="input_tarif" min="1" title="Masukkan tarif dengan benar" placeholder="Tarif" required>
				</div>
				<br>
				<div class="ccfield-prepend">
					<input type="hidden" id="insert_jasa" name="command" value="insert">
 					<button type="submit" class="ccbtn">Submit</button>

 					<br>
			    </div>


		
		   	</form>
			</div>


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
		function myFunction() {
		    alert("Jasa kirim berhasil disimpan");
		}
	</script>

</body>
</html>