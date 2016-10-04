<?php

	require("functions.php");

	//kui ei ole kasutaja id'd
	if(!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		
	}



	if(isset($_GET["logout"])){
		
		session_destroy();
		header("Location:login.php");
		
	}

	
	if(isset($_POST["plate"]) && isset($_POST["color"]) &&
		!empty($_POST["plate"]) && !empty($_POST["color"])
		) {
		
		savecar($_POST["plate"], $_POST["color"]);
		
		
	}



?>
<h1>Data</h1>

<p>
	Tere tulemast <?=$_SESSION["userEmail"];?>
	<a href="?logout=1">Logi valja</a>

</p>

	<form method="POST">

		<h1>Salvesta auto</h1><br>
	
		<label>Auto number</label><br>
		<input name="plate" type="text" placeholder="123 ABC"><br><br>
	
		<label>Auto varv</label><br>
		<input name="color" type="color">

		<br><br>
		<input type="submit" value="Salvesta">



	</form>










