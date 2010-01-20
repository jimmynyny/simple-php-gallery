<?php
header ("content-type: text/xml");
$dir = $_SERVER["DOCUMENT_ROOT"]."/images/".$_GET["folder"];
$checkFileRegex = "/.+\.((jpg)|(gif)|(jpeg)|(png))/";
$checkFileRegexThumb = "/tn_.+\.((jpg)|(gif)|(jpeg)|(png))/";

// Open a known directory, and proceed to read its contents
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
	echo utf8_encode("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n<filelist>");
        while (($file = readdir($dh)) !== false) {
			if(filetype($dir.$file) == 'dir' && $file != "." && $file != "..")
			{
				echo utf8_encode("<dir><filename>$file</filename><filetype>".filetype($dir.$file)."</filetype></dir>");
			}
			else
			{
				if (preg_match($checkFileRegex, strtolower($file)) && !preg_match($checkFileRegexThumb, strtolower($file))) 
		            echo utf8_encode("<file><filename>$file</filename><filetype>".filetype($dir.$file)."</filetype></file>");
	        }
		}
        closedir($dh);
    }
	echo utf8_encode("</filelist>");
}
?>