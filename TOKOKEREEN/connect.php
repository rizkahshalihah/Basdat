<?php

	function connectDB() {
		
		$conn = pg_connect("host=dbpg.cs.ui.ac.id dbname=b208 user=b208 password=bdb0822016");
		pg_query($conn, "set search_path to 'tokokerenb08';");
		return $conn;
	}	

?>