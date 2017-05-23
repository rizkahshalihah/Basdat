<?php session_start();
	include 'navigasi.php';	
	include 'produk_post.php';
	
	if(!isset($_SESSION['namaToko'])){
		header("location:list_toko.php");
	}

	if(isset($_SESSION['subkat'])){
		unset($_SESSION['kategori']);
		unset($_SESSION['subkat']);
		
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
				      
	      if($_POST['command']==='detils'){
	      		$_SESSION['code'] = $_POST['detail'];
	      		header("location:shippedprod.php");
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
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

	
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
		<h1><?php echo $_SESSION['namaToko']?></h1>
	</header>
	<div class="container">
		
		<div class="row">
       		<h3 class="text-center title">Pilih Kategori</h3>
			<?php
				getKategori();
			?>
		</div>

		<div class="row">
       		<h3 class="text-center title">Pilih Sub Kategori</h3>
			<?php
				if($_SERVER["REQUEST_METHOD"] == "POST") {
				      
				      if($_POST['command']==='ktgr'){
				      		getKategoriVal($_POST['prods']);
				      }

			    }	
			?>
		</div>		
				
    </div>





		<br>
		<br>
		<br>

	<div class="container">
		<div class="row">
			
			<div>
				<h4 class="title text-center">Daftar Transaksi Shipped</h4>
			</div> 				
			
			<div class = "table-responsive" align= "center">
				<table class= "display compact" id="myTable" width = "100%" cellspacing="0">
					<?php 
						
						if($_SERVER["REQUEST_METHOD"] == "POST") {
				      
						      if($_POST['command']==='sktg'){
						      		$_SESSION['subkat']=$_POST['prodsb'];
						      }
			   			}
			   			
			   			cetakAll();	
	

					?>
				 
				</table>
			 </div>
							
		</div>

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

		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>




    <script type="text/javascript" 
    src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    //source : DataTables.net (untuk pagination)
    	$(document).ready(function(){
		    $('#myTable').DataTable();
		});
    </script>
	</body>
	</html>
