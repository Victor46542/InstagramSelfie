<?php
function php_image($imagefolder,$thumbfolder)
    {
    //Get image and thumbnail folder from function
    $images = "portfolio/" . $imagefolder; //The folder that contains your images. This folder must contain ONLY ".jpg files"!
    $thumbnails = "portfolio/" . $thumbfolder; // the folder that contains all created thumbnails.
    //Load Images
	//load images into an array and sort them alphabeticall:
	$files = array();
	if ($handle = opendir($images))
		{
		while (false !== ($file = readdir($handle)))
			{
			//only do JPG's
			if(eregi("((.jpeg|.jpg|.png)$)", $file))

				{
				$files[] = array("name" => $file);
				}
			}
		closedir($handle);
		}
	//Obtain a list of columns

	foreach ($files as $key => $row)
		{

		$name[$key]  = $row['name'];
		}
	//Put images in order:
	if ($order == "reverse")
		{
		array_multisort($name, SORT_DESC, $files);
		}
	else
		{
		array_multisort($name, SORT_ASC, $files);
		}
	//set the GET variable name
	$pic = $imagefolder;
	// if term PIC is defined in the URL (=image is loaded):
	if(isset($_GET[$pic]))
		{
		$addy = $_GET[$pic];
		$imgsrc = $images . "/" . $addy;

		//does image exist:

		if (file_exists($imgsrc))

			{

			//Get image size:
			$size = getimagesize( $imgsrc );
			$width = $size[0];
			$height = $size[1];
			
			// define the link to the next picture
			$lastpicarray = end($files);
			$lastpic = $lastpicarray['name'];
			reset($files);
			$firstpicarray = current($files);
			$firstpic = $firstpicarray['name'];
			while ($pointer = current($files))
				{				
				if ($pointer['name'] == $addy && $pointer['name'] != $firstpic) {
					$prevpicarray = prev($files);
					$prevpic = $prevpicarray['name'];
					next($files);
					}
				else if ($pointer['name'] == $addy && $pointer['name'] == $firstpic) {
					$prevpicarray = end($files);
					$prevpic = $prevpicarray['name'];
					reset($files);
					}
				if ($pointer['name'] == $addy && $pointer['name'] != $lastpic) {
					$nextpicarray = next($files);
					$nextpic = $nextpicarray['name'];
					break;
					}
				else if ($pointer['name'] == $addy && $pointer['name'] == $lastpic) {
					reset($files);
					$nextpicarray = current($files);
					$nextpic = $nextpicarray['name'];
					break;
					}
				next($files);
				}
			//Include the opened photo to the document.
			echo "<div class=\"image_container\" style=\"width: " . $width . "px; height: " . $height . "px; background-image: url(" . $imgsrc . ")\">\n";
			echo "<a class=\"prev\" href=\"?" . $pic . "=" . $prevpic . "\" style=\"height: " . $height . "px; width: " . $width*0.49 . "px;\">";
			$name = $prevpic;
			$splitname = explode (".", $name);
			echo "<div class=\"prev_thumb\"  style=\"height: " . $height . "px; width: 100px; background-image: url(" . $thumbnails . "/$splitname[0]_thumb.jpg); background-repeat: no-repeat;
	background-position: center left;\"></div></a>\n";	
			echo "<a class=\"next\" href=\"?" . $pic . "=" . $nextpic . "\" style=\"height: " . $height . "px; width: " . $width*0.49 . "px;\">";
			$name = $nextpic;
			$splitname = explode (".", $name);
			echo "<div class=\"next_thumb\" style=\"height: " . $height . "px; width: 100px; background-image: url(" . $thumbnails . "/$splitname[0]_thumb.jpg); background-repeat: no-repeat;
	background-position: center right;\"></div></a>\n";	
			echo "</div>\n";

			}	
		else 

			{
			//do nothing

			echo "File does not exist";
			}
		}
	else
		{	
		$addy1 = current($files);
		$addy = $addy1['name'];
		$imgsrc = $images . "/" . $addy;
		//Get image size:
		$size = getimagesize( $imgsrc );
		$width = $size[0];
		$height = $size[1];
		// define the link to the next picture
		$lastpicarray = end($files);
		$lastpic = $lastpicarray['name'];
		reset($files);
		$prevpic = $lastpic;
		while ($pointer = current($files)) 

			{
			if ($pointer['name'] == $addy && $pointer['name'] != $lastpic)

				{
				$nextpicarray = next($files);
				$nextpic = $nextpicarray['name'];
				break;
				}
			else if ($pointer['name'] == $addy && $pointer['name'] == $lastpic)

				{
				reset($files);
				$nextpicarray = current($files);
				$nextpic = $nextpicarray['name'];
				break;
				}
			next($files);
			}
		//Include the first photo in the foder to the document.
			//Include the opened photo to the document.
			echo "<div class=\"image_container\" style=\"width: " . $width . "px; height: " . $height . "px; background-image: url(" . $imgsrc . ")\">\n";
			echo "<a class=\"prev\" href=\"?" . $pic . "=" . $prevpic . "\" style=\"height: " . $height . "px; width: " . $width*0.49 . "px;\">";
			$name = $prevpic;
			$splitname = explode (".", $name);
			echo "<div class=\"prev_thumb\"  style=\"height: " . $height . "px; width: 100px; background-image: url(" . $thumbnails . "/$splitname[0]_thumb.jpg); background-repeat: no-repeat;
	background-position: center left;\"></div></a>\n";	
			echo "<a class=\"next\" href=\"?" . $pic . "=" . $nextpic . "\" style=\"height: " . $height . "px; width: " . $width*0.49 . "px;\">";
			$name = $nextpic;
			$splitname = explode (".", $name);
			echo "<div class=\"next_thumb\" style=\"height: " . $height . "px; width: 100px; background-image: url(" . $thumbnails . "/$splitname[0]_thumb.jpg); background-repeat: no-repeat;
	background-position: center right;\"></div></a>\n";	
			echo "</div>\n";

		}
	reset($files);
	}
?>