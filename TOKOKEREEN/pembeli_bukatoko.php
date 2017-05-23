<?php
session_start();
include 'navigasi.php';
include 'connect.php';	
	

function add(){
	//LOGIN
	
		$conn = connectDB();
		$nama = $_POST['nama'];
		$deskripsi =  $_POST['deskripsi'];
		$slogan = $_POST['slogan'];
		$lokasi =  $_POST['lokasi'];
		$email_penjual = $_SESSION['email'];//get from session
		$jasakirim = $_POST['jasa_kirim'];
		//$is_penjual = 'FALSE';
		//$nama_toko = $_POST['nama_toko'];
		
		$query = pg_query($conn, "SELECT T.nama, T.deskripsi, T.slogan, T.lokasi, T.email_penjual, TJ.jasa_kirim FROM TOKO T, TOKO_JASA_KIRIM TJ
		WHERE T.nama=TJ.nama_toko");
		
		$quer= pg_query($conn, "SELECT * FROM TOKO WHERE nama = '$nama'");
	//	$que = pg_query($conn, "SELECT email FROM PELANGGAN");
		$count = pg_num_rows($quer);

		if ($count===0) {
			
			$row = pg_fetch_assoc($query);
			
			
				pg_query($conn, "UPDATE PELANGGAN SET is_penjual= 't' WHERE email = '$email_penjual'");
				pg_query($conn, "INSERT INTO TOKO(nama, deskripsi, slogan, lokasi, email_penjual) values ('$nama', '$deskripsi', '$slogan', '$lokasi', '$email_penjual')");
						
					$sql2 = "INSERT INTO TOKO_JASA_KIRIM (nama_toko, jasa_kirim) values ('$nama', '$jasakirim')";
					pg_query($conn, $sql2);
		
				
		}else{
			echo "nama toko dah ada";
		}

		pg_close($conn);
			
		
		
}

function selectAllFromJasaKirim(){
	$conn = connectDB();
		$result = pg_query($conn,"SELECT * FROM jasa_kirim");
		pg_close($conn);
		return $result;
}	

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if($_SESSION['is_penjual'] == false AND $_SESSION['is_loggedin'] == true) {
		if($_POST['command']=== 'addstore'){
		add();	
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
    		<h1>Form Membuat Toko</h1>	
		</header>
			<div class="wrapper">
			    <form method="POST" action="" class="ccform">
			  
    				<h3> Nama : </h3>
    				
    						<input type="text" class="ccformfield"  name="nama" placeholder="Nama" required>
					 
    				
				<h3> Deskripsi :  </h3>
    				
    						<input type="text" class="ccformfield" name="deskripsi" placeholder="Deskripsi">
    				
    				
				<h3> Slogan : </h3>
    				
    						<input type="text" class="ccformfield" name="slogan" placeholder="Slogan">
    			
			    
					
				<h3> Lokasi : </h3>
    			
    						<input type="text" class="ccformfield" name="lokasi" placeholder="Lokasi" required>
    				
					
					
				<h3> Jasa Kirim 1: </h3>
				
					<div class="form-group">
								<select id="jasa-kirim" name="jasa_kirim" type="button" class="ccformfield">
									<?php
										$res = selectAllFromJasaKirim();
										$result = pg_fetch_all($res);
										
										foreach ($result as $value) {
											$code = $value['nama'];
											
											echo "<option value = '$code'>".$code."</option>";
										}
									?>
								</select>
					</div>
					
				<div class="form-row format-date"> <span class="date-display"></span>		
						<script src="/wp-includes/js/addDropDown.js" language="Javascript" type="text/javascript"></script>	
						<form method="POST">
							<div id="dynamicInput"> </div>
							<br>
						<input type="button" value="Tambah Jasa Kirim" onClick="addDropDown('dynamicInput');">
				
						</form>
    						<br>
							<br>
							<br>
					<input name="command" type="hidden" value="addstore"/>			    
			        <input class="ccbtn" type="submit" value="Submit">
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
	<script src="js/jasakirim.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>