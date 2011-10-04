<?php
session_start();
include('Captcha.class.php');
/*if(isset($_SESSION['draw'])){
      if($_SESSION['draw']==1){
      $_SESSION['num']=$_SESSION['n1']->tekst;
      $_SESSION['conf']=array($_SESSION['n1']->width,$_SESSION['n1']->height,$_SESSION['n1']->color,$_SESSION['n1']->size,$_SESSION['n1']->font);
      }elseif($_SESSION['draw']==2){
      $_SESSION['num']=$_SESSION['n2']->tekst;
      $_SESSION['conf']=array($_SESSION['n2']->width,$_SESSION['n2']->height,$_SESSION['n2']->color,$_SESSION['n2']->size,$_SESSION['n2']->font);
      }
      unset($_SESSION['draw']);
}*/
//var_dump($_SESSION);
if(!isset($_SESSION['s'])){
   if(!isset($_SESSION['s2'])){
      exit();
	}else{
      $number=$_SESSION['s2'];
      $conf=$_SESSION['conf2'];
      unset($_SESSION['s2']);
      create_image2();
	}
}else{
  	if(!isset($_SESSION['s2'])){
      $number=$_SESSION['s'];
      $conf=$_SESSION['conf'];
      unset($_SESSION['s']);
      create_image2();
	}else{
		$number1=$_SESSION['s'];
		$conf1=$_SESSION['conf'];
      $number2=$_SESSION['s2'];
      $conf2=$_SESSION['conf2'];
      unset($_SESSION['s']);
      unset($_SESSION['s2']);
      create_image3();
	}
}

      

//var_dump($_SESSION);
//var_dump($obj);

exit();
function create_image()
{
    //Set the image width and height
    $width2 = $_SESSION['conf'][0];
    $height2 = $_SESSION['conf'][1]; 
    $width = 250;
    $height = 25; 


    //Create the image resource 
    $image = ImageCreate($width2, $height2);  

    //We are making three colors, white, black and gray
    $white = ImageColorAllocate($image, 255, 255, 255);
    $black = ImageColorAllocate($image, 0, 0, 0);
    $grey = ImageColorAllocate($image, 201, 201, 201);
    $color=  ImageColorAllocate($image, $_SESSION['conf'][2][0], $_SESSION['conf'][2][1], $_SESSION['conf'][2][2]);
    //Make the background black 
    ImageFill($image, 0, 0, $grey); 
    /*if(isset($id)&&($id==1||$id==2)&&isset($_SESSION['n'.$id])){
      //Add randomly generated string in white to the image
      ImageString($image, 3, 4, 3, $_SESSION['n1']->number." + ".$_SESSION['n2']->number, $color); 
    }elseif(is_object($obj)){
      ImageString($image, 3, 4, 3, " ".$obj->number, $color);
    }else{
      ImageString($image, 3, 4, 3, " ".$id, $color);
    }*/
    ImageString($image, 3, 3, 3, " ".strval(round($_SESSION['s'])), $color);
    //Throw in some lines to make it a little bit harder for any bots to break 
    ImageRectangle($image,0,0,$width-1,$height-1,$grey); 
    imageline($image, 0, $height/2, $width, $height/2, $grey); 
    imageline($image, $width/2, 0, $width/2, $height, $grey); 
 
    //Tell the browser what kind of file is come in 
    header ("Content-type: image/png");

    //Output the newly created image in jpeg format 
    Imagecolortransparent($image,$grey);
	    
    ImagePng($image);
   
    //Free up resources
    ImageDestroy($image);
}
function create_image3()
{
    global $number1;
    global $number2;
    global $conf1;
    global $conf2;
    //Set the image width and height
    //$width2 = $_SESSION['n1']->width;
    //$height2 = $_SESSION['n1']->height; 
    	$width = 65;
    	$height = 20;
		$font=$conf1[4];
    //Create the image resource 
    	$image = ImageCreate($width, $height);  
	//$fw = imagefontwidth ( $font );
	//$fh = imagefontheight ( $font );
    //We are making three colors, white, black and gray
    	$white = ImageColorAllocate($image, 255, 255, 255);
    	$black = ImageColorAllocate($image, 0, 0, 0);
    	$grey = ImageColorAllocate($image, 201, 201, 201);
    	$color1=  ImageColorAllocate($image,$conf1[2][0], $conf1[2][1], $conf1[2][2]);
    	$color2=  ImageColorAllocate($image,$conf2[2][0], $conf2[2][1], $conf2[2][2]);
    	$colorline=ImageColorAllocate($image,rand(0,255), rand(0,255), rand(0,255));
    //Make the background black 
    ImageFill($image, 0, 0, $grey); 
    /*if(isset($id)&&($id==1||$id==2)&&isset($_SESSION['n'.$id])){
      //Add randomly generated string in white to the image
      ImageString($image, 3, 4, 3, $_SESSION['n1']->number." + ".$_SESSION['n2']->number, $color); 
    }elseif(is_object($obj)){
      ImageString($image, 3, 4, 3, " ".$obj->number, $color);
    }else{
      ImageString($image, 3, 4, 3, " ".$id, $color);
    }*/
    $str1=" ".strval($number1);
    $str2="".strval($number2)." ";
    //$x = ($width - strlen($str) * $fw )/2;
	//	$y = ($height - $fh) / 2; // middle of the code string will be in middle of the background image
    ImageString($image, 10, 0, 0, $str1, $color1);
    ImageString($image, 10, $conf1[0], 4, " + ", $black);
    ImageString($image, 10, $conf1[0]+20,4, $str2, $color2);
    //Throw in some lines to make it a little bit harder for any bots to break 
    ImageRectangle($image,0,0,$width-1,$height-1,$black); 
    	imageline($image, 0, $height/2, $width, $height/2, $colorline); 
   	 imageline($image, $width/2, 0, $width/2, $height, $colorline); 
 
    //Tell the browser what kind of file is come in 
    header ("Content-type: image/png");

    //Output the newly created image in jpeg format 
    Imagecolortransparent($image,$grey);
	    
    ImagePng($image);
   
    //Free up resources
    ImageDestroy($image);
} 	    
function create_image2()
{
    global $number;
    //Set the image width and height
    //$width2 = $_SESSION['n1']->width;
    //$height2 = $_SESSION['n1']->height; 
    $width = 25;
    $height = 25; 

	$font="arial.ttf";
    //Create the image resource 
    $image = ImageCreate($width, $height);  
	//$fw = imagefontwidth ( $font );
	//$fh = imagefontheight ( $font );
    //We are making three colors, white, black and gray
    $white = ImageColorAllocate($image, 255, 255, 255);
    $black = ImageColorAllocate($image, 0, 0, 0);
    $grey = ImageColorAllocate($image, 201, 201, 201);
    //$color=  ImageColorAllocate($image,$_SESSION['n1']->color[0], $_SESSION['n1']->color[1], $_SESSION['n1']->color[2]);
    //Make the background black 
    ImageFill($image, 0, 0, $grey); 
    /*if(isset($id)&&($id==1||$id==2)&&isset($_SESSION['n'.$id])){
      //Add randomly generated string in white to the image
      ImageString($image, 3, 4, 3, $_SESSION['n1']->number." + ".$_SESSION['n2']->number, $color); 
    }elseif(is_object($obj)){
      ImageString($image, 3, 4, 3, " ".$obj->number, $color);
    }else{
      ImageString($image, 3, 4, 3, " ".$id, $color);
    }*/
    $str=" ".strval($number);
    //$x = ($width - strlen($str) * $fw )/2;
	//	$y = ($height - $fh) / 2; // middle of the code string will be in middle of the background image
    ImageString($image, 14, 2, 2, $str, $black);
    //Throw in some lines to make it a little bit harder for any bots to break 
    ImageRectangle($image,0,0,$width-1,$height-1,$grey); 
    imageline($image, 0, $height/2, $width, $height/2, $grey); 
    imageline($image, $width/2, 0, $width/2, $height, $grey); 
 
    //Tell the browser what kind of file is come in 
    header ("Content-type: image/png");

    //Output the newly created image in jpeg format 
    Imagecolortransparent($image,$grey);
	    
    ImagePng($image);
   
    //Free up resources
    ImageDestroy($image);
}  
?>
