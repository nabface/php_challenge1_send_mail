<?php

require('verification.php');
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
	$_SESSION['captcha'] = $mot;
	return $mot;
}

/*
function image($mot)
{
	$size = 32;
	$marge = 15;
	$font = './angelina.ttf';
		
	$box = imagettfbbox($size, 0, $font, $mot);
	$largeur = $box[2] - $box[0];
	$hauteur = $box[1] - $box[7];
	$largeur_lettre = round($largeur/strlen($mot));
	
	$img = imagecreate($largeur+$marge, $hauteur+$marge);
	$blanc = imagecolorallocate($img, 255, 255, 255); 
	$noir = imagecolorallocate($img, 0, 0, 0);
	
	for($i = 0; $i < strlen($mot);++$i)
	{
		$l = $mot[$i];
		$angle = mt_rand(-35,35);
		imagettftext($img,$size,$angle,($i*$largeur_lettre)+$marge, $hauteur+mt_rand(0,$marge/2),$noir, $font, $l);	
	}
	
	imagepng($img);
	imagedestroy($img);
}
*/



?>