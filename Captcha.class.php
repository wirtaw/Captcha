<?php
class Captcha{
		var $angle;
		var $angles;
      var $color;
      var $font;
      var $height;
      var $number;
      var $size;
      var $style;
      var $styleclass;
      var $tekst;
      var $type;
      var $width;
      function my_random($min,$max){
		$a=$min;
		$b=$max;
		$x=$max-$min;
		$sum=0;
		$dif=0;
		for($i=$a;$i<$b;$i++){
			$sum*=rand(0,$i);
			$dif+=rand(0,$i);
		}
		return $number=floor(round($sum/$x)+round($dif%$x)); 
      }
      function GenerateImg()
      {
	    $bibl_ext = dirname ($_SERVER['SCRIPT_FILENAME']).'/extensions/php_gd.dll';
	    if (! extension_loaded ('gd') and @is_file ($bibl_ext)){ dl ("extensions/php_gd.dll");}
	    if (! extension_loaded ('gd')){ print "Not find $bibl_ext";}
	    putenv('GDFONTPATH=' . realpath('.'));
	    //$font = $this->font;
	    $id=$this->number;
	    
	    $im = imagecreate ($this->width,$this->height) or die("Bad try to create image");
	    if($this->color[0]==0){
	    	$r=128;
	    }else{
	    	$r=$this->color[0];
	    }
	    if($this->color[1]==255){
	    	$g=127;
	    }else{
	    	$g=$this->color[1];
	    }
	    if($this->color[2]==0){
	    	$b=128;
	    }else{
	    	$b=$this->color[2];
	    }
	    $bg=ImageColorAllocate($im,$this->my_random(0,$r), $this->my_random($g,255), $this->my_random(0,$b));
	    $color        =   imageColorAllocate($im, $this->color[0], $this->color[1], $this->color[2]);
	    $colorRed    =    imageColorAllocate($im, 0, 0, 255);
	    $colorBlue    =   imageColorAllocate($im, 255, 0, 0);
	    $colorGreen =     imageColorAllocate($im, 0, 255, 0);
	    switch($this->type){
	    	case 1:
	    		ImageFill($im, 0, 0, $bg);
	   	 	if($this->angle==0){$d=-1;}else{$d=1;}
	    		//imagestring($im, 10, 5, 5,  $this->tekst, $color);
	    		if(function_exists('imagettftext')&&$this->font!=NULL){
	    			if(isset($this->angles)){
	    				$a=$this->angles[0];
	    				$b=$this->angles[1];
	    			}else{
	    				$a=15;
	    				$b=45;
	    			}
		  			imagettftext($im, $this->size,$d*$this->my_random($a,$b), 5, 25, $color,$this->font,$this->tekst);
	    		}else{
		  			imagestring($im, 10, 5, 5,  $this->tekst, $color);
	    		}
	    		Imagecolortransparent($im,$bg);
	    	break;
	    	case  2:
	    		
	    		ImageRectangle($im,0,0,$this->width-1,$this->height-1,$color);
	    		
   	 		$colorline=ImageColorAllocate($im,rand(0,255), rand(0,255), rand(0,255));
   	 		imagestring($im, $this->size, 5, 5,  $this->tekst, $colorline);
   	 		Imagecolortransparent($im,$colorline);
   	 		//imagestring($im, 10, 5, 5,  $this->tekst, $color);
   	 		$colorline=ImageColorAllocate($im,rand(0,255), rand(0,255), rand(0,255));
	    		imageline($im, 0, $this->height/2, $this->width, $this->height/2, $colorline); 
	    		$colorline=ImageColorAllocate($im,rand(0,255), rand(0,255), rand(0,255));
   	 		imageline($im, $this->width/2, 0, $this->width/2, $this->height, $colorline);
	    	break;
	    }
	    //ImageRectangle($im,0,0,$this->width-1,$this->height-1,$color);
	    
	    header ("Content-type: image/png");
	    ImagePng ($im);
	    ImageDestroy ($im);	
	    
      }
      function ShowImg()
      {
	    	return '<img src="img.php?img='.$this->number.'" style="'.$this->style.'" class="'.$this->styleclass.'"> ';
      }
      function __autoload( $className ) {
  			$className = str_replace ( "..","", $className );
  			require_once( "classes/$className.php" );
		}
      function Captcha($number,$angle,$color,$font,$style,$size,$width,$height,$edges,$angles,$styleclass,$type=1){
	    $this->type=$type;
	    if(file_exists($font)){
	    	$this->font=$font;
	    }else{
	    	$this->font=NULL;
	    }
	    $this->angle=$angle;
	    if(isset($angles)&&is_array($angles)&&count($angles)==2){
		  $this->angles=$angles;
	    }
	    if(isset($color)&&is_array($color)&&count($color)==3){
		  $this->color=$color;
	    }
	    $this->number=$number;
	    $this->size=$size;
	    $this->style=$style;
	    $this->styleclass=$styleclass;   
	    switch($this->type){
		  case 1:
		  		$width=intval($width);
	    		$height=intval($height);
	    		if($width>=$height){
		  			$this->width=$width;
		  			$this->height=$width;
	    		}else{
		  			$this->width=$height;
		  			$this->height=$height;
	    		}
		  		if(isset($edges)&&is_array($edges)&&count($edges)==2){	  
					if($edges[0]>$edges[1]){
			      	$this->tekst=$this->my_random($edges[1],$edges[0]);
					}elseif($edges[0]<$edges[1]){
			    	  $this->tekst=$this->my_random($edges[0],$edges[1]);
					}else{
			      	$this->tekst=$this->my_random(1,100);
					}
		  		}else{
					$this->tekst=$this->my_random(1,100);
		  		}
		  		$this->tekst=intval($this->tekst);
		  break;
		  case 2:
			 	//Let's generate a totally random string using md5
				$md5_hash = md5(rand(0,999)); 
				//We don't need a 32 character long string so we trim it down to 5 
				$this->tekst = substr($md5_hash, 15, 5);
				if($this->font==NULL){
					$this->width=$width;
		  			$this->height=$height;
				}else{
					//$fw=imagefontwidth($this->font);
					//$fh=imagefontheight($this->font);
					$this->width= strlen($this->tekst)*10;
		  			$this->height=$height;
				} 
		  break;
	    }
	    
      }
}
?>
