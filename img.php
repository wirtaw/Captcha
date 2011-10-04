<?php
	include('Captcha.class.php');
	session_start();
	if(isset($_SESSION['n1'])&&isset($_SESSION['n2'])&&isset($_SESSION['n3'])){
		if(isset($_GET['img'])){
			$img=intval($_GET['img']);
			switch($img){
				case 1:
					$_SESSION['n1']->GenerateImg();
				break;
				case 2:
					$_SESSION['n2']->GenerateImg();
				break;
				case 3:
					$_SESSION['n3']->GenerateImg();
				break;
			}
		}else{
			exit();
		}
	}else{
		exit();
	}
?>
