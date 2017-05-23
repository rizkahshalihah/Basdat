<?php session_start();
	include 'navigasi.php';
	if(isset($_SESSION['is_loggedin'])){
		if($_SESSION['is_admin'] == true AND $_SESSION['is_loggedin'] == true){
			header("Location: admin.php");
		}
		else if($_SESSION['is_penjual'] == false AND $_SESSION['is_loggedin'] == true){
			header("Location: pembeli.php");
		}
		else if($_SESSION['is_penjual'] == true AND $_SESSION['is_loggedin'] == true){
			header("Location: penjual.php");
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

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login ke Akun Anda</h2>
						<?php
							if(isset($_GET['messages'])){
								echo '<span style="color: red">' . htmlspecialchars_decode($_GET['messages']). '</span>';
							}
						?>
						<form method="POST" action="post.php">
							<input name="email" type="text" placeholder="Email" />
							<input name="password" type="password" placeholder="Password" />
							<input name="command" type="hidden" value="login"/>
							<button type="submit" class="btn btn-de1fault">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">ATAU</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Register Pengguna Baru</h2>
						<form method="POST" action="post.php">
						<?php
							if(isset($_GET['nemail'])){
								echo '<span style="color: red">' . htmlspecialchars_decode($_GET['nemail']). '</span>';
							}
						?>
							<input name="email" <?php echo (isset($_GET['email'])) ? 'value="'.$_GET['email'].'"' : ''; ?> type="email" placeholder="Email Address"/ >

						<?php
							if(isset($_GET['npassword'])){
								echo '<span style="color: red">' . htmlspecialchars_decode($_GET['npassword']). '</span>';
							}
						?>
							<input name="password" <?php echo (isset($_GET['password'])) ? 'value="'.$_GET['password'].'"' : ''; ?> type="password" placeholder="password"/ >

						<?php
							if(isset($_GET['ncheckpassword'])){
								echo '<span style="color: red">' . htmlspecialchars_decode($_GET['ncheckpassword']). '</span>';
							}
						?>
							<input name="checkpassword" <?php echo (isset($_GET['checkpassword'])) ? 'value="'.$_GET['checkpassword'].'"' : ''; ?> type="password" placeholder="Ulangi Password"/ >
							<br><br>

						<?php
							if(isset($_GET['nname'])){
								echo '<span style="color: red">' . htmlspecialchars_decode($_GET['nname']). '</span>';
							}
						?>
							<input name="name" <?php echo (isset($_GET['name'])) ? 'value="'.$_GET['name'].'"' : ''; ?> type="text" placeholder="Nama Lengkap"/>

						<?php
							if(isset($_GET['ngender'])){
								echo '<span style="color: red">' . htmlspecialchars_decode($_GET['ngender']). '</span>';
							}
						?>
							<select name="gender">
							<option value="" disabled selected>Jenis Kelamin</option>
   							<option value="L">Laki-Laki</option>
	 						<option value="P">Perempuan</option>
							</select required>
							<br>
							<br>

						<?php
							if(isset($_GET['ntgl_lahir'])){
								echo '<span style="color: red">' . htmlspecialchars_decode($_GET['ntgl_lahir']). '</span>';
							}
						?>
							<input name="tgl_lahir" <?php echo (isset($_GET['tgl_lahir'])) ? 'value="'.$_GET['tgl_lahir'].'"' : ''; ?> type="date" placeholder="Tanggal Lahir"/ >

						<?php
							if(isset($_GET['nphone'])){
								echo '<span style="color: red">' . htmlspecialchars_decode($_GET['nphone']). '</span>';
							}
						?>
							<input name="phone" <?php echo (isset($_GET['phone'])) ? 'value="'.$_GET['phone'].'"' : ''; ?> type="text" placeholder="Nomor Telepon"/ >

						<?php
							if(isset($_GET['naddress'])){
								echo '<span style="color: red">' . htmlspecialchars_decode($_GET['naddress']). '</span>';
							}
						?>
							<input name="address" <?php echo (isset($_GET['address'])) ? 'value="'.$_GET['address'].'"' : ''; ?> type="text" placeholder="Alamat"/ >
							<input name="command" type="hidden" value="register"/>
							<button type="submit" class="btn btn-default">Register </button>

						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
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
    <script src="post.php"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>