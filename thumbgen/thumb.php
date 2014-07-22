<?php
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 
{
  $dir = opendir( $pathToImages );
  while (false !== ($fname = readdir( $dir ))) {
  $info = pathinfo($pathToImages . $fname);
  print_r($info);
   if ( strtolower($info['extension']) == 'jpg' ) 
    {
      echo "Creating thumbnail for {$fname} <br />";
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
	else if(strtolower($info['extension']) == 'gif'){
	  echo "Creating thumbnail for {$fname} <br />";
      $img = imagecreatefromgif( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );
      system("convert ". "{$pathToImages}{$fname}"." -coalesce coalesce.gif");
	  system("convert -size ".$width.'x'.$height." coalesce.gif -resize ".$new_width.'x'.$new_height."{$pathToThumbs}{$fname}");
	}
	else if(strtolower($info['extension']) == 'png'){
	  echo "Creating thumbnail for {$fname} <br />";
      $img = imagecreatefrompng( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );  
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
      imagepng( $tmp_img, "{$pathToThumbs}{$fname}" );

	 }
	else {
		echo strtolower($info['extension']);
			echo "<br>";
			echo "Not an Image file<br>";	
	}	
  }  
  closedir( $dir );
}
createThumbs("./img/","./th/",1200);

?>
