<?php session_start();
	
	if($_SESSION['is_admin'] == true AND $_SESSION['is_loggedin'] == true){
		//header("Location: admin.php");
	}
	else{
		header("Location: index.php");
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
								<li><a href="#"><i class="fa fa-phone"></i> +62 21 12 34 560.0007</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> cs@tokokeren.com</a></li>
								<li><a href="#"><i class="fa fa-user"></i> Halo, <? echo $_SESSION['email']?></a></li>
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
							<a href="admin.php"><img src="images/home/logo.png" alt="" /></a>
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
								
								<li><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>
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
								<li><a href="admin.php" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Produk<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="kategori.php">Buat Kategori & Sub</a></li>
										<li><a href="jasa_kirim.php">Buat Jasa Kirim</a></li>
										<li><a href="promo_details.php">Buat Promo Produk</a></li>
										<li><a href="admin_tambahproduk.php">Tambahkan Produk</a></li> 
										<li><a href="logout.php">Logout</a></li> 
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
		
    		<h1>Form Membuat Produk Pulsa</h1>	
		</header>
			<div class="wrapper">
			    <form method="post" action="" class="ccform">
			  
    				<h3> Kode Produk : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Kode Produk" required>
					 
    				</div>
    			
				<h3> Nama Produk :  </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Nama Produk" required>
    				</div>
    				
				<h3> Harga : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Harga" required>
    				</div>	
			    
					
				<h3> Deskripsi : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Deskripsi" required>
    				</div>	
					
				<h3> Nominal : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Nominal" required>
    				</div>	
					
					
				
    						<br>
							<br>
							<br>
							
			    <div class="ccfield-prepend">
			        <input class="ccbtn" type="submit" value="Submit">
			    </div>
			    </form>
			</div>
	
	
	
		<header class="ccheader">	
			<h1>Form Membuat Shipped Produk</h1>	
		</header>
			<div class="wrapper">
			    <form method="post" action="" class="ccform">
			  
    				<h3> Kode Produk : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Kode Produk" required>
					 
    				</div>
    			
				<h3> Nama Produk :  </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Nama Produk" required>
    				</div>
    				
				<h3> Harga : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Harga" required>
    				</div>	
			    
					
				<h3> Deskripsi : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Deskripsi" required>
    				</div>	
					
				<h3> Sub Kategori : </h3>
    				<div class="btn-group">
								<button type="button" class="ccformfield dropdown-toggle usa" data-toggle="dropdown">
									1-80
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">6</a></li>
									<li><a href="#">7</a></li>
									<li><a href="#">8</a></li>
									<li><a href="#">9</a></li>
									<li><a href="#">10</a></li>
									<li><a href="#">80</a></li>
																									
								</ul> 
					</div>	
					
				<h3> Barang Asuransi : </h3>
    				<div class="btn-group">
								<button type="button" class="ccformfield dropdown-toggle usa" data-toggle="dropdown">
									YES/NO
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">YES</a></li>
									<li><a href="#">NO</a></li>
																									
								</ul> 
					
					</div>	
			
				<h3> Stok : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Stok" required>
    				</div>		
					
				<h3> Barang Baru : </h3>
    				<div class="btn-group">
								<button type="button" class="ccformfield dropdown-toggle usa" data-toggle="dropdown">
									YES/NO
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">YES</a></li>
									<li><a href="#">NO</a></li>
																									
								</ul> 
					
					</div>	
					
				<h3> Minimal Order : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Minimal Order" required>
    				</div>		
				
				<h3> Minimal Grosir : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Minimal Grosir" required>
    				</div>				
					
				<h3> Maksimal Grosir : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    						<input type="text" class="ccformfield" placeholder="Maksimal Grosir" required>
    				</div>			
				
				<h3> Foto : </h3>
    				<div class="form-row format-date"> <span class="date-display"></span>
    					<form action="/action_page.php">
								<input type="file" name="pic" accept="image/*">
						</form>

						<br>
						<br>

			    <div class="ccfield-prepend" >
			        <input class="ccbtn" type="submit" value="Submit">
			    </div>
    				</div>					
			    </form>
			</div>
		
			
			<br>
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
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>