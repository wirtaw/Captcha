<?php
define('ROOT_DIR', '');
include('Captcha.class.php');
session_start();
//require_once(ROOT_DIR . 'Captcha.class.php');

if(isset($_POST['suma'])){
	$suma=intval($_POST['suma']);
	if($suma==($_SESSION['n1']->tekst+$_SESSION['n2']->tekst))
	{
		echo "completed !!!<br/> You are human!!! <br/>";
	}else{
		echo "uncompleted !!!<br/>Maybe, you are a bot?! <br/>";
	}
}
if(isset($_POST['suma2'])){
	$suma=intval($_POST['suma2']);
	if($suma==($_SESSION['n1']->tekst+$_SESSION['n2']->tekst))
	{
		echo "completed !!!<br/> You are human!!! <br/>";
	}else{
		echo "uncompleted !!!<br/>Maybe, you are a bot?! <br/>";
	}
}
if(isset($_POST['suma3'])){
	$suma=intval($_POST['suma3']);
	if($suma==($_SESSION['n1']->tekst+$_SESSION['n2']->tekst))
	{
		echo "completed !!!<br/> You are human!!! <br/>";
	}else{
		echo "uncompleted !!!<br/>Maybe, you are a bot?! <br/>";
	}
}
if(isset($_POST['suma4'])){
	$suma=intval($_POST['suma4']);
	if($suma==($_SESSION['n1']->tekst+$_SESSION['n2']->tekst))
	{
		echo "completed !!!<br/> You are human!!! <br/>";
	}else{
		echo "uncompleted !!!<br/>Maybe, you are a bot?! <br/>";
	}
}
if(isset($_POST['captcha'])){
	$captcha=trim($_POST['captcha']);
	$captcha = stripslashes($captcha);
	$captcha = htmlentities($captcha,ENT_NOQUOTES,'UTF-8');
	$captcha = strip_tags($captcha);
	if(strcmp($captcha,$_SESSION['n3']->tekst)===0)
	{
		echo "completed !!!<br/> You are human!!! <br/>";
	}else{
		echo "uncompleted !!!<br/>Maybe, you are a bot?! <br/>";
	}
}
$_SESSION['n1'] = new Captcha(1,1,array(255,0,0),"arial.ttf",'border:none;vertical-align:middle;text-align:center;',11,25,25,array(1,100),array(45,55),'captchas');
$_SESSION['s']=$_SESSION['n1']->tekst;
$_SESSION['conf']=array($_SESSION['n1']->width,$_SESSION['n1']->height,$_SESSION['n1']->color,$_SESSION['n1']->size,$_SESSION['n1']->font);
$_SESSION['n2'] = new Captcha(2,0,array(0,0,255),'verdana.ttf','border:none;vertical-align:middle;text-align:center;',11,25,25,array(1,100),array(45,55),'captchas');

$_SESSION['s2']=$_SESSION['n2']->tekst;
$_SESSION['conf2']=array($_SESSION['n2']->width,$_SESSION['n2']->height,$_SESSION['n2']->color,$_SESSION['n2']->size,$_SESSION['n2']->font);
/*$_SESSION['num']=$_SESSION['n1']->tekst;
$_SESSION['conf']=array($_SESSION['n1']->width,$_SESSION['n1']->height,$_SESSION['n1']->color,$_SESSION['n1']->size,$_SESSION['n1']->font);
var_dump($_SESSION['num']);*/
/*
var_dump($_SESSION['s']);
var_dump($_SESSION['conf']);
echo '<div style="border:solid thin black;">
obrazek 1 '.$_SESSION['n1']->tekst.'  <br/>'.$_SESSION['n1']->width.'<br/>'.$_SESSION['n1']->height.'<br/>';


var_dump($_SESSION['s2']);
var_dump($_SESSION['conf2']);
/*$_SESSION['num']=$_SESSION['n2']->tekst;
$_SESSION['conf']=array($_SESSION['n2']->width,$_SESSION['n2']->height,$_SESSION['n2']->color,$_SESSION['n2']->size,$_SESSION['n2']->font);*/
/*echo 'obrazek 2 '.$_SESSION['n2']->tekst.' <br/>
'.$_SESSION['n2']->width.'<br/>'.$_SESSION['n2']->height.'<br/>
';*/
echo '<form action="test.php" method="post"><img src="imgcaptcha.php" style="border:none;"><input type="text" name="suma" size="3" maxlength="3"><input type="submit" value="input"></form>';

echo '<form action="test.php" method="post"><img src="img1.php" style="'.$_SESSION['n1']->style.'">+<img src="img2.php" style="'.$_SESSION['n2']->style.'"><input type="text" name="suma2" size="3" maxlength="3"><input type="submit" value="input"></form>';

echo '<form action="test.php" method="post"><img src="img.php?img=1" style="'.$_SESSION['n1']->style.'">+<img src="img.php?img=2" style="'.$_SESSION['n2']->style.'"><input type="text" name="suma3" size="3" maxlength="3"><input type="submit" value="input"></form>';

echo '<form action="test.php" method="post">'.$_SESSION['n1']->ShowImg().'+'.$_SESSION['n2']->ShowImg().'<input type="text" name="suma4" size="3" maxlength="3"><input type="submit" value="input"></form>';
//var_dump($_SESSION['num']);
$_SESSION['n3'] = new Captcha(3,0,array(0,0,255),'verdana.ttf','border:none;vertical-align:middle;text-align:center;',8,25,25,array(1,100),array(45,55),'captchas',2);
/*echo 'obrazek 3 '.$_SESSION['n3']->tekst.' <br/>
'.$_SESSION['n3']->width.'<br/>'.$_SESSION['n3']->height.'<br/>
';*/
echo '<form action="test.php" method="post">'.$_SESSION['n3']->ShowImg().'<input type="text" name="captcha" size="'.strlen($_SESSION['n3']->tekst).'" maxlength="'.strlen($_SESSION['n3']->tekst).'"><input type="submit" value="input"></form>';
?>
