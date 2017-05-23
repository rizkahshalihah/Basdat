<?php
	session_start();
	include 'bayar_post.php';
	include 'navigasi.php';

	if($_SERVER["REQUEST_METHOD"] == "POST") {
	      
	      if($_POST['command']==='carts'){
	      	masukCart();
	      	masukCart2();
	      	header("location:cart.php");
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
	<link href="css/transaction.css" rel="stylesheet">
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
	
<section>
				
    
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h3 class="text-center">Detail Order</h3>

                    </div>
                </div>
                <div class="panel-body">
				<br>
                    <form method="POST" action="">
                    	<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
								<label> Kuantitas Barang</label>
									<div class="input-group">
		                            	<?php
		                            		minimumOrder();
		                            	?>
		                            </div>
								</div>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
								<label> Berat Total Barang</label>
									<div class="input-group">
		                            	<input type="number" min= "1" class="form-control" placeholder="Isi Berat Total" name="brt" value="brt" required/>
		                            </div>
								</div>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
								<label> Alamat Kirim</label>
									<?php
										cetakAlamat();
										
									?>
								</div>
							</div>
							</div>
							<div class="dropdown">
								  <br>
								  <label> Jenis Pembayaran </label>
								  <span class="date-display"></span></button>
								  	<select type="credit_card">
									<option value="" disabled selected>Jenis Pembayaran</option>
				   					<option value="">Transfer Bank</option>
					 				<option value="">Kartu Kredit</option>
									</select required>
									<br>
									<br>
								</div> 
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Nomor kartu / rekening</label>
                                    <div class="input-group">
                                        <input type="tel" class="form-control" placeholder="Isi nomor kartu/rekening" />
                                        <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label>Expire Date (Credit)</label>
                                    <input type="tel" class="form-control" placeholder="MM / YY" />
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label>CV Code</label>
                                    <input type="tel" class="form-control" placeholder="Untuk kredit" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Nama Pemilik</label>
                                    <input type="text" class="form-control" placeholder="Nama pemilik kartu / rekening" />
                                </div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Kode Promo</label>
                                    <input type="text" class="form-control" placeholder="Masukkan kode promo (jika ada)" />
                                   
                                </div>
                            </div>
                      </div>
                     	
                      <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Jasa Kirim</label>
                                    	<br>
                                    	<?php
                                    		if(!isset($_SESSION['jaskir'])){
                                    			cetakKirim();	
                                    		}else{
                                    			echo $_SESSION['jaskir'];
                                    		}
                                    		
                                    	?>
                                    	<input type="hidden" value="jaskir" name="jasa">
                                   
                                   
                                </div>
                            </div>
                      </div>

						<input type='hidden' name='command' value='carts'/>
						<button type='submit' class='btn btn-warning btn-lg'>Masukkan ke Cart</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

	
	
		
</section>

<br><br>
	
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