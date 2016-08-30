<?php


if(!empty($_POST['captcha']) && !empty($_POST['nom']))
{
    if($_POST['captcha'] == $_SESSION['captcha'])
       
    else
        echo 'Le captcha n\'est pas bon.';
    	
}
else
    echo 'Il faut remplir tous les champs.';
	
?>