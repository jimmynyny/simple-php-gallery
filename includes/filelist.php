<?php
header ("content-type: text/xml");
$dir = $_SERVER["DOCUMENT_ROOT"]."/images/";
$checkFileRegex = "/.+\.((jpg)|(gif)|(jpeg)|(png))/";
$checkFileRegexThumb = "/tn_.+\.((jpg)|(gif)|(jpeg)|(png))/";

// Open a known directory, and proceed to read its contents
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
	echo utf8_encode("<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n<filelist>");
        while (($file = readdir($dh)) !== false) {
		if (preg_match($checkFileRegex, $file) && !preg_match($checkFileRegexThumb, $file)) 
            echo utf8_encode("<file>\n<filename>$file</filename>\n</file>\n");
        }
        closedir($dh);
    }
	echo utf8_encode("</filelist>");
}
?>