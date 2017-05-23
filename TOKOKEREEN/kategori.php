<?php session_start();
include 'navigasi.php';
include 'connect.php';
if($_SESSION['is_admin'] == true AND $_SESSION['is_loggedin'] == true){
	//header("Location: admin.php");

	//KATEGORI

	// if error in a subcategory, the error message goes into this array
	$message = Array();
	// This is the counter for subcategories. See below
	$counter = 1;
	if (isset($_POST['addkategori'])) {
			
		$conn = connectDB();

		// if error in a category, the error messages go into this array
		$katerror = Array();
		
		
		

		if(!isset($_POST['ku_kode']) || $_POST['ku_kode']==""){
			$katerror['nku_kode'] = "Kode untuk kategori utama harus diisi";
		}
		else {
			// I query over here because apparently a kode is entered (it isset)
			$query = pg_query($conn, "SELECT KU.kode FROM KATEGORI_UTAMA KU WHERE KU.kode='".$_POST['ku_kode']."'");
			if (pg_num_rows($query)) {
				// there's a result (pg_num_rows > 0); this kode already exists
				// so we're going to throw an error because kodes must be unique
				$katerror['nku_kode'] = "Kode untuk kategori utama harus unik";
			}
		}
		if(!isset($_POST['ku_nama']) || $_POST['ku_nama']==""){
			$katerror['nku_nama'] = "Nama untuk kategori utama harus diisi";
		}

		$sk_kodes = Array();
		for($i=0; $i<sizeof($_POST['sk_kode']) && $i<sizeof($_POST['sk_nama']); $i++){
				// check if sk_kode is empty; if so, throw error
			if(!isset($_POST['sk_kode'][$i]) || $_POST['sk_kode'][$i]==""){
				$message[$i]['nsk_kode'] = "Kode untuk sub kategori harus diisi";
			}
			else if (in_array($_POST['sk_kode'][$i], $sk_kodes)) {
				# code...
				$message[$i]['nsk_kode'] = "Kode untuk sub kategori harus unik";
			}
			else {
				// I query over here because apparently a kode is entered (it isset)
				$query = pg_query($conn, "SELECT SK.kode FROM SUB_KATEGORI SK WHERE SK.kode='".$_POST['sk_kode'][$i]."'");
				if (pg_num_rows($query)) {
					// there's a result (pg_num_rows > 0); this kode already exists
					// so we're going to throw an error because kodes must be unique
					$message[$i]['nsk_kode'] = "Kode untuk sub kategori harus unik";
				}
			}
			// to input the value from post into the array to check for unique values
			array_push($sk_kodes, $_POST['sk_kode'][$i]);

			// check if sk_nama is empty; if so, throw error
			if(!isset($_POST['sk_nama'][$i]) || $_POST['sk_nama'][$i]==""){
				$message[$i]['nsk_nama'] = "Nama untuk sub kategori harus diisi";
			}
		}

		// check if the array size of $katerror or $message is bigger than 0;
		// if that is true, apparently an error has occurred (the array has been filled
		// with a message). So don't continue adding the category and show the error messages
		if (sizeof($katerror) > 0 || sizeof($message) > 0) {
			$katerror['error'] = '<center>An error occurred in one or more of the fields<br><br></center>';
		}
		else {
			// create a variable that checks if everything is inserted correctly
			// that means all queries are executed
			$inserted = true;
			// No errors are thrown; continue adding the category and subcategories to the database
			// the categoty & sub category are successfully added
			$kq = pg_query($conn, "INSERT INTO KATEGORI_UTAMA VALUES ('".$_POST['ku_kode']."','".$_POST['ku_nama']."')");

			if (!$kq) {
				// an error occurred with inserting the category
				$inserted = false;
			}

			// loop for the size of sk_kode or until an error occurres
			for($i=0; $i<sizeof($_POST['sk_kode']) && $inserted; $i++){
				$sq = pg_query($conn, "INSERT INTO SUB_KATEGORI VALUES ('".$_POST['sk_kode'][$i]."','".$_POST['ku_kode']."','".$_POST['sk_nama'][$i]."')");
				if (!$sq) {
					// something went wrong with inserting
					$inserted = false;
				}
			}

			if ($inserted) {
				// Successfully inserted! 
				$success = 'Inserting succeeded: Kategori Utama dan Subkategori berhasil disimpan!';

				// Optional: show message that inserting succeeded without going to other page
				// (delete line 99 if you want to use this)
				header('Location: kategori.php?success='.htmlspecialchars($success));
			}
			else {
				// Error; display that the new things aren't inserted in the database
				// and the form is automatically recreated with post data
				$katerror['error'] = 'Inserting error: Kategori Utama dan Subkategori tidak berhasil disimpan!';
			}

		}
		pg_close($conn);

	}
}
else{
	header("Location: index.php");
	die(); // this prevents the page from loading when the user is not an admin
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
		<?php
			cetakNavigasi();
		?>
	</header><!--/header-->

	<header class="ccheader">

		<h1>Form Kategori Utama</h1>
	</header>
	<div class="wrapper">
		<form method="POST" action="kategori.php" class="ccform">
			<?php
				// check if there's an error
				if(isset($katerror['error'])){
					echo '<span style="color: red">'.$katerror['error'].'</span>';
				}
				// no error; maybe inserting succeeded?
				else if (isset($_GET['success'])) {
					echo '<span style="color: green">'.htmlspecialchars_decode($_GET['success']).'</span>';
				}
			?>

			<?php
				// check if there's an error with this kode
				if(isset($katerror['nku_kode'])){
					echo '<span style="color: red">'.$katerror['nku_kode'].'</span>';
				}
			?>
			<h3> Kode Kategori : </h3>
			<div class="form-row format-date">
				<input type="text" name="ku_kode" <?php echo (isset($_POST['ku_kode'])) ? 'value="'.$_POST['ku_kode'].'"' : ''; ?> class="ccformfield" placeholder="Kode Kategori">

			</div>

			<?php
				// check if there's an error with this nama
				if(isset($katerror['nku_nama'])){
					echo '<span style="color: red">'.$katerror['nku_nama'].'</span>';
				}
			?>
			<h3> Nama Kategori :  </h3>
			<div class="form-row format-date">
				<input type="text" name="ku_nama" <?php echo (isset($_POST['ku_nama'])) ? 'value="'.$_POST['ku_nama'].'"' : ''; ?> class="ccformfield" placeholder="Nama Kategori">
			</div>
			<br>
			<header class='ccheader'>
			<h1>Form Sub Kategori</h1>
			</header>

			<!-- The first subcategory field should always be shown -->
			<h3> Sub Kategori 1 : </h3>
			<div class="form-row format-date">
				<?php
					// check if there's an error with this kode
					if(isset($message[0]['nsk_kode'])){
						echo '<span style="color: red">'.$message[0]['nsk_kode'].'</span>';
					}
				?>
				<input type="text" name="sk_kode[0]" <?php echo (isset($_POST['sk_kode'][0])) ? 'value="'.$_POST['sk_kode'][0].'"' : ''; ?> class="ccformfield" placeholder="Sub Kategori">
			</div>

			<h3> Nama Sub Kategori : </h3>
			<div class="form-row format-date">
				<?php
					// check if there's an error with this name (empty)
					if(isset($message[0]['nsk_nama'])){
						echo '<span style="color: red">'.$message[0]['nsk_nama'].'</span>';
					}
				?>
				<input type="text" name="sk_nama[0]" <?php echo (isset($_POST['sk_nama'][0])) ? 'value="'.$_POST['sk_nama'][0].'"' : ''; ?> class="ccformfield" placeholder="Nama Subkategori">
			</div>

			<?php
			// Here's a tricky part; an error has been thrown so no categories or
			// subcategories are created. What we're doing over here is creating the
			// form for subcategories and filling it with the previously entered information,
			// plus showing any error messages that we set on top of this file

			// The array of message has been filled (is larger than zero);
			// an error occurred in one of the subcategories
			if (sizeof($message) > 0) {
				// Loop all subcategories and recreate the form for them
				for($i=1; $i<sizeof($_POST['sk_kode']) && $i<sizeof($_POST['sk_nama']); $i++){
					?>
					<h3> Sub Kategori <?php echo $i+1; ?> : </h3>
					<div class="form-row format-date">
						<?php
							// check if there's an error with this kode
							if(isset($message[$i]['nsk_kode'])){
								echo '<span style="color: red">'.$message[$i]['nsk_kode'].'</span>';
							}
						?>
						<input type="text" name="sk_kode[<?php echo $i; ?>]" <?php echo (isset($_POST['sk_kode'][$i])) ? 'value="'.$_POST['sk_kode'][$i].'"' : ''; ?> class="ccformfield" placeholder="Sub Kategori" >
					</div>

					<h3> Nama Sub Kategori : </h3>
					<div class="form-row format-date">
						<?php
							// check if there's an error with this name (empty)
							if(isset($message[$i]['nsk_nama'])){
								echo '<span style="color: red">'.$message[$i]['nsk_nama'].'</span>';
							}
						?>
						<input type="text" name="sk_nama[<?php echo $i; ?>]" <?php echo (isset($_POST['sk_nama'][$i])) ? 'value="'.$_POST['sk_nama'][$i].'"' : ''; ?> class="ccformfield" placeholder="Nama Subkategori" >
					</div>
					<?php
					// We're increasing the counter so you can add more subcategories
					// with javascript, even if we already made some with php
					// see bottom of page
					$counter++;
				} // close the for loop
			} // close the if
			?>

			<div class="form-row format-date"> <span class="date-display"></span>
				<br>

				<div id="dynamicInput">
				</div>
				<input type="button" value="Tambah Sub Kategori" onClick="addInput('dynamicInput');">

				<br>
				<br>

				<div class="ccfield-prepend">
					<input class="ccbtn" type="submit" value="Submit">
					<input name="addkategori" type="hidden" value="addkategori"/>
				</div>
			</form>
		</div>
		<br>
		<br>

		<br><br><br><br>



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
		<?php
		if ($counter > 1) {
			echo '<script type="text/javascript">var subCounter = '.$counter.';</script>';
		}
		?>
		<script src="js/subkategori.js"></script>
		<script src="js/price-range.js"></script>
		<script src="js/jquery.scrollUp.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.prettyPhoto.js"></script>
		<script src="js/main.js"></script>
	</body>
	</html>
