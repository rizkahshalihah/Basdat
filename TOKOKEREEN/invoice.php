<?php
	session_start();
	include 'invoice_post.php';
	include 'navigasi.php';
	if(isset($_SESSION['nomerProd'])){
		unset($_SESSION['nomerProd']);
	}


	if(isset($_SESSION['namaToko'])){
		unset($_SESSION['namaToko']);
	}

	if(isset($_SESSION['jaskir'])){
		unset($_SESSION['jaskir']);
	}

	if(isset($_SESSION['adr'])){
		unset($_SESSION['adr']);
	}

	if(isset($_SESSION['inv'])){
		unset($_SESSION['inv']);
	}

	if(isset($_SESSION['betot'])){
		unset($_SESSION['betot']);
	}

	if(isset($_SESSION['dahBeli'])){
		unset($_SESSION['dahBeli']);
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
	      
	      if($_POST['command']==='detil'){
	      	detailTombol($_POST['debar']);
	      }else if($_POST['command']==='pay'){
	      	payConfirm();
	      }else if($_POST['command']==='sent'){
	      	insertResi();
	      	payConfirm();
	      }else if($_POST['command']==='accept'){
	      	payConfirm();
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
    <title>Detail Pembayaran | Toko Keren</title>
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
	<style>
	.height {
		min-height: 200px;
	}
	.icon {
		font-size: 47px;
		color: #5CB85C;
	}
	.iconbig {
		font-size: 77px;
		color: #5CB85C;
	}
	.table > tbody > tr > .emptyrow {
		border-top: none;
	}
	.table > thead > tr > .emptyrow {
		border-bottom: none;
	}
	.table > tbody > tr > .highrow {
		border-top: 3px solid;
	}
	</style>
	
</head><body>
	<header id="header"><!--header-->
		<?php
			cetakNavigasi();
		?>
	</header><!--/header-->	
	<section>
	
		
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="text-center">
						<h2>
							<?php
								echo "Invoice ".$_SESSION['nomerINV'];
							?>
						</h2>
					</div>
					<hr>
					<div class="row">
						<div class="col-xs-12 col-md-3 col-lg-3 pull-left">
							<div class="panel panel-default height">
								<div class="panel-heading">Tujuan Pembayaran</div>
								<div class="panel-body">
									<strong>Bank/Akun:</strong><br>
									Tokokeren<br>
									Bank BNI<br>
									80604003900<br>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-3 col-lg-3">
							<div class="panel panel-default height">
								<div class="panel-heading">Informasi Pembayaran</div>
								<div class="panel-body">
									<strong>Jenis pembayaran:</strong> Transfer/Kredit<br>
									<strong>Nomor kartu/rekening:</strong> ***** 332<br>
									<?php
										cetakOrang();
									?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-3 col-lg-3">
							<div class="panel panel-default height">
								<div class="panel-heading">Detail Order</div>
								<div class="panel-body">
									<?php
										cetakDetails();
									?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-3 col-lg-3 pull-right">
							<div class="panel panel-default height">
								<div class="panel-heading">Alamat Kirim</div>
								<div class="panel-body">
									<?php
										cetakDetail();
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="text-center"><strong>Order summary</strong></h3>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-condensed">
									<?php
										doInvoice();
									?>	
								</table>
							</div>
						</div>
					</div>
				</div>	
			</div>
			<div class="row">
				<div class="col-sm-3">
					<?php
						invButton();
					?>		
				</div>	
			</div>


		</div>

				
				
				
				
		
		
		
		
		
		
		
	</section>
	
	<br>
	<br>
	
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
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>