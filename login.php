<?php

	require("../../config.php");
	require("functions.php");
	
	
	//kui on see siis suunan data lehele
	if(isset($_SESSION["userId"])){
		
		header("Location: data.php");
		
	}
	
	$signinEmailError= "";
	$signinPasswordError= "";
	$signinemail= "";
	
	
	$signupEmailError= "";
	$signupPasswordError= "";
	$reenterpasswordError= "";
	
	$signupemail = "";
	$signupGender = "";
	$signupGenderError = "";
	$signupDateOfBirth = "";
	$signupDateOfBirthError= "";
	
	if(isset($_POST["signupemail"])){
		
		if(empty($_POST["signupemail"])){
			
			$signupEmailError= "See vali on kohustuslik";
			
		}else{
			
			$signupemail = $_POST["signupemail"];
			
		}
		
		if(isset($_POST["signupGender"])) {
			
			$signupGender = $_POST["signupGender"];
			
		} else {
			
			$signupGenderError= "See valik on kohustuslik";
			
		}
		
		if(isset($_POST["signupDateOfBirth"])) {
			
			$signupDateOfBirth = $_POST["signupDateOfBirth"];
			
		} else {
			
			$signupDateOfBirthError= "See valik on kohustuslik";
			
		}
	}
	
	if(isset($_POST["signuppassword"])){
		
		if(empty($_POST["signuppassword"])){
			
			$signupPasswordError= "See vali on kohustuslik";
			
		} else {
			
			if( strlen($_POST["signuppassword"]) <8 ){
			
				$signupPasswordError = "Parool peab olema vahemalt 8 tahemarki pikk";
				
			}
		}
	}
	
	if(isset($_POST["reenterpassword"])){
		
		if($_POST["reenterpassword"] == $_POST["signuppassword"]){
			
			$reenterpasswordError= "";
			
		} else {
			
			$reenterpasswordError= "Parool ei olnud sama";
			
		}
	}
	
	//if(isset($_POST["signupGender"])){
		
		//if(!empty($_POST["signupGender"])){
			
			//$signupGender = $_POST["signupGender"];
			
		//}
		
	//}
	
	
	if(isset($_POST["signupemail"]) &&
		isset($_POST["signuppassword"]) &&
		isset($_POST["signupGender"]) &&
		isset($_POST["signupDateOfBirth"]) &&
		$signupEmailError=="" &&
		$signupPasswordError=="" &&
		$signupGenderError=="" &&
		$signupDateOfBirthError= ""
		) {
		
		echo "Salvestan... <br>";
		
		echo "email: ".$signupemail."<br>";
		echo "password: ".$_POST["signuppassword"]."<br>";
		echo "gender: ".$signupGender."<br>";
		echo "DateOfBirth: ".$signupDateOfBirth."<br>";
		
		$password = hash("sha512", $_POST["signuppassword"]);
		
		echo "password hashed: ".$password."<br>";
		
		//echo $serverUsername;
		
		signUp($signupemail, $password, $signupGender, $signupDateOfBirth);
		
	}
	
	$error="";
	if(isset($_POST["loginemail"]) && isset($_POST["loginpassword"]) &&
		!empty($_POST["loginemail"]) && !empty($_POST["loginpassword"])
		) {
		
		$error = login ($_POST["loginemail"], $_POST["loginpassword"]);
		
		
	}
	
	if(isset($_POST["loginemail"])){
		
		if(empty($_POST["loginemail"])){
			
			$signinEmailError= "See vali on kohustuslik";
			
		}else{
			
			$signinemail = $_POST["loginemail"];
			
		}
	}
	
	if(isset($_POST["loginpassword"])){
		
		if(empty($_POST["loginpassword"])){
			
			$signinPasswordError= "See vali on kohustuslik";
			
		}
	}
	
	
	
?>

<!DOCTYPE html>
<html>
<head>
<title>Logi sisse voi loo kasutaja</title>
</head>
<body>

	<h1>Logi sisse</h1>
	<form method="POST">
		<p style="color:red;"><?=$error;?></p>
		<input name="loginemail" placeholder="Kasutaja" type="text" value="<?=$signinemail;?>"> <?php echo $signinEmailError; ?>
		<br><br>
	
		<input name="loginpassword" placeholder="Parool" type="password"> <?php echo $signinPasswordError; ?>
		<br><br>
			
	
		<input type="submit" value="Logi Sisse">
		
	</form>
	
	<h1>Loo Kasutaja</h1>
	Tärniga väljad on kohustuslikud
	<form method="POST">
	
		<br>
		<b><label>*E-mail:</label></b><br>
		<input name="signupemail" placeholder="example@mail.com" type="text" value="<?=$signupemail;?>"> <?php echo $signupEmailError; ?>
		<br><br>
	
		<b><label>*Parool:</label></b><br>
		<input name="signuppassword" placeholder="********" type="password"> <?php echo $signupPasswordError; ?>
		<br><br>
		
		<b><label>*Sisesta parool uuesti:</label></b><br>
		<input name="reenterpassword" placeholder="********" type="password"> <?php echo $reenterpasswordError; ?>
		<br><br>
		
		<b><label>*Sugu:</label></b><?php echo $signupGenderError; ?><br><br>
		<?php if($signupGender == "male") { ?>
			<input name="signupGender" type="radio" value="male" checked> Male<br>
		<?php }else { ?>
			<input name="signupGender" type="radio" value="male"> Male<br>
		<?php } ?>
		
		<?php if($signupGender == "female") { ?>
			<input name="signupGender" type="radio" value="female" checked> Female<br>
		<?php }else { ?>
			<input name="signupGender" type="radio" value="female"> Female<br>
		<?php } ?>
		
		<?php if($signupGender == "other") { ?>
			<input name="signupGender" type="radio" value="other" checked> Other<br>
		<?php }else { ?>
			<input name="signupGender" type="radio" value="other"> Other<br>
		<?php } ?>
		
		<br>
		
		<b><label>*Sunnikuupaev:</label></b><?php echo $signupDateOfBirthError; ?><br>
		<input name="signupDateOfBirth" type="date" max="2016-01-01" min="1900-01-01">
		<br><br>
		
		<b><label>Riik:</label></b><br>
		<input name="country" type="text">
		<br><br>
		
		<b><label>Linn:</label></b><br>
		<input name="city" type="text">
		<br><br>
		
		<b><label>Telefoni number:</label></b><br>
		<input name="usrtel" type="tel">
		<br><br>
		
		<input name="spam" type="checkbox"> Soovin saada spammi oma meilile
		<br><br>
		
		<input type="submit" value="Loo Kasutaja">
		
		
		<br><br><br><br>
		Ma veel kindel ei ole aga voibolla midagi blogi ja treeningpaeviku laadset. Lugeda saavad ainult kasutajad.
	</form>
</body>
</html>