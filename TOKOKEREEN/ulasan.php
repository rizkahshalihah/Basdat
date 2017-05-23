<?php

	session_start();
	
	include 'invoice_post.php';
	include 'navigasi.php';

	function buat_ulasan(){
		
		$conn = connectDB();

		$kode = $_SESSION['nomerProd'];
		$rating = $_POST['options'];
		$ulasan = $_POST['insert_ulasan'];
		$mail = $_SESSION['email'];

		$date_array = getdate();
		   $formated_date  = $date_array['year'] . "-";
		   $formated_date .= $date_array['mon'] . "-";
		   $formated_date .= $date_array['mday'];

		$sql = "INSERT INTO ulasan (email_pembeli, kode_produk, tanggal, rating, komentar) values ('$mail', '$kode', '$formated_date','$rating', '$ulasan')";

		if ($result = pg_query($conn,$sql)){
			echo "Ulasan berhasil dibuat";
			header("Location: index.php");
		} else{
			die("Error:$sql");
		}

		pg_close($conn);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		buat_ulasan();
		
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
    		<h1>Berikan Ulasan</h1>	
		</header>
			<div class="wrapper">
			    <form method="post" action="" class="ccform">
			    <h3> Kode Produk: </h3>
				<div class="ccfield-prepend">
			        <h2><?php echo $_SESSION['nomerProd'] ?></h2>
			    </div>
			    <h3> Rating : </h3>
			   	<select name="options" required>
			   		<option value=""></option>
				    <option value="1">1</option>
				    <option value="2">2</option>
				    <option value="3">3</option>
				    <option value="4">4</option>
				    <option value="5">5</option>
				</select>
			    <h3> Ulasan : </h3>
			    <div class="ccfield-prepend">
        			<input type="text" class="ccformfield" name="insert_ulasan" placeholder="Berikan Ulasan" required="" oninvalid="this.setCustomValidity('Harap masukkan ulasan anda')"></input>
    			</div>
    			<br>
				<div class="ccfield-prepend">
 					<input type="hidden" id="insert_jasa" name="command" value="insert">
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
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>