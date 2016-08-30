<?php 
//echo'é salut !';
// captcha
function motHasard($n){
	$lettres = array_merge(range('a','z'),range('A','Z'),range('0','9'));
    $nl = count($lettres)-1;
    $mot = '';
    for($i = 0; $i < $n; ++$i)
        $mot .= $lettres[mt_rand(0,$nl)];
    return $mot;
}
function captcha() {
	$mot = motHasard(6);
	return $mot;
}

$motCaptcha = captcha();

if(!empty($_POST)){
	extract($_POST);
	$valid = true;

	if (empty($nom)) {
		$valid = false;
		$erreurNom="Nom est un champs bligatoire!";
	}

	if (!preg_match("/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i", $email)) {
		$valid = false;
		$erreurEmail="Email non valide!";
	}

	if (empty($email)) {
		$valid = false;
		$erreurEmail="Email est un champs bligatoire!";
	}
	if (empty($message)) {
		$valid = false;
		$erreurMessage="Votre message est un champs bligatoire!";
	}

	if (empty($captcha)) {
		$valid = false;
		$erreurMot="Le captcha est obligatoire!";
	}

	if (!empty($captcha)) {
		if ($captcha != $motCaptcha) {
			$valid = false;
			$erreurMot="Le captcha n'est pas valide!";
		}
		
	}

	



	if ($valid) {
		$to = "yampolos@gmail.com";
		$sujet = $nom." vous a envoyé un message.";
		$entete = "From: $nom <$email>";
		$message = stripcslashes($message);
		$nom = stripcslashes($nom);
		$pictures = $pictures;

		if (mail($to,$sujet,$message,$entete)) {
			$notification = "Message envoyé";
			unset($nom);
			unset($email);
			unset($message);
			unset($pictures);
		}
		else{
			$notification = "Message non envoyé!";
		}
	}


}


?><!DOCTYPE HTML>
<html>

<head>
    <title>Ma page de contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- styles css -->
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/style.css" />
    <!-- scripts javascript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
</head>

<body>

	<div class="container-fluid">
	<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">

		<h1>Contact</h1>
		<p>Ceci est un formulaire de contact!</p>
		<br/>

		<?php if (isset($notification)) { echo "<p>$notification</p>"; } ?>

		<hr/>
		<br/>

		<form method="post" action="contact.php">
			<div class="form-group">
				<label class="control-label" for="nom">Nom :</label>
				<input class="form-control" type="text" name="nom" id="nom" value="<?php if (isset($nom)) { echo $nom; } ?>"></input>
				<span class="errorMsg text-danger"><?php if (isset($erreurNom)) { echo $erreurNom; } ?></span>
			</div>

			<div class="form-group">
				<label class="control-label requiredField" for="email">Email :</label>
				<input class="form-control" type="text" name="email" id="email" value="<?php if (isset($email)) { echo $email; } ?>"></input>
				<span class="errorMsg text-danger"><?php if (isset($erreurEmail)) { echo $erreurEmail; } ?></span>
			</div>

			<br/>

			<div class="form-group">
				<label class="control-label " for="message">Votre message :</label>
				<textarea class="form-control" name="message" id="message"><?php if (isset($message)) { echo $message; } ?></textarea>
				<span class="errorMsg text-danger"><?php if (isset($erreurMessage)) { echo $erreurMessage; } ?></span>
			<br/>
			</div>

			<div class="form-group" method="post" enctype="multipart/form-data">
				<h3>Mes images:</h3>
				<input type="file" name="pictures" />
			</div>

			<div class="form-group">
			<label for="captcha">Recopiez le mot : "<?php echo $motCaptcha; ?>"</label>
			<input type="text" name="captcha" id="captcha" value="" /><br />
			<span class="errorMsg text-danger"><?php if (isset($erreurMot)) { echo $erreurMot; } ?></span>
			</div>

			<div class="form-group">
			<input class="btn btn-primary " name="Envoyer" type="submit" value="Envoyer" ></input>
			</div>

		</form>					

	</div>
	</div>

</body>
</html>