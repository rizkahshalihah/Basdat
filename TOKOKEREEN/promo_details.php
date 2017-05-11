<?php
	
	session_start();
		if(array_key_exists('blah',$_SESSION) && !empty($_SESSION['blah'])) {
		    echo ('Set and not empty, and no undefined index error!');
}

	function connectDB(){
		$user = "postgres";
		$pass = "RIZKAHBIEBER22";

		$conn = pg_connect("host=localhost dbname=rizkahshalihah user=postgres password=RIZKAHBIEBER22");

		if (!$conn) {
			die("Connection failed: " + pg_connection_status());
		} else {
			echo "connected";
		}

		return $conn;
	}

	function selectAllFromPromo($table){
		$conn = connectDB();

		$result = "SELECT * FROM kategori_utama";

		if (!$hasil = pg_query($conn, $result)){
			die("Error: $sql");
		}

		pg_close($conn);
		return $hasil;
	}

	function selectAllFromSub($table){
		$conn = connectDB();
		$kodePromo = $_SESSION['kode'];
		echo $_SESSION['kode'];

		$result = "SELECT nama FROM kategori_utama KU, sub_kategori SK WHERE SK.kode_kategori = '$kodePromo'";
		echo $result;
		if (!$hasil = pg_query($conn, $result)){
			die("Error: $sql");
		}

		pg_close($conn);
		return $hasil;	
	}
	// function insert_promo(){
	// 	$conn = connectDB();

	// 	$fullname = $_POST['input_name'];
	// 	$lama_kirim = $_POST['input_lama'];
	// 	$tarif = $_POST['input_tarif'];
	// 	$sql = "INSERT INTO jasa_kirim (nama,lama_kirim,tarif) values ('$fullname', '$lama_kirim', '$tarif')";

	// 	if ($result = pg_query($conn,$sql)){
	// 		echo "Jasa kirim berhasil dibuat";
	// 		header("Location: admin.html");
	// 	} else{
	// 		die("Error:$sql");
	// 	}

	// 	mysql_close($conn);
	// }

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
										<li><a href="promo_details.html">Buat Promo Produk</a></li>
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
		<header class="ccheader">
		
    		<h1>Form Membuat Promo</h1>	
		</header>
			<div class="wrapper">
			    <form method="post" action="" class="ccform">
			  
    				<h3> Deskripsi Produk : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" name="input_deskripsi" placeholder="Deskripsi" required>
					 
    				</div>
    			
					<h3> Periode Awal :  </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
        				<input type="date" class="hide-replaced ccformfield" name="awal" required>
    				</div>
    				
					<h3> Periode Akhir : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
        				<input type="date" class="hide-replaced ccformfield" name="akhir" required>
    				</div>
			    
					
					<h3> Kode Promo : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input class="ccformfield" type="text" name="kode" placeholder="Kode Promo" required>
    				</div>	
					
				<h3> Kategori : </h3>
					<div class="form-row format-date"> <span class="date-display"></span>
					<select name="promo" id="promo" placeholder="Kategori" onchange=showSubCategory(this.value)>
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
					<select name="promo" id="sub">
						
					</select>
					</div>

				<div class="ccfield-prepend">
			    	<input type="submit" class="ccbtn" value="Submit"/>
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