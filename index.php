<?
	if($_GET["folder"] && (substr($_GET["folder"],0,1) == "." || preg_match("/.+\.\..+/", $_GET["folder"])))
	{
		echo "no no no.";
		return;
	}
?>
<? include 'includes/thumbnailgen.php'; ?>
<html>
<head>
	<title>Simple PHP Gallery</title>
	<link rel="stylesheet" href="includes/js/fancybox/jquery.fancybox-1.2.6.css" type="text/css" media="screen">	
	<style type='text/css' media='screen'>@import "includes/js/fancybox/jquery.fancybox-1.2.6.css";</style>
	<link rel="stylesheet" href="includes/main.css" type="text/css" media="screen">
	<style type='text/css' media='screen'>@import "includes/main.css";</style>
	<script type="text/javascript" src="http://www.google.com/jsapi"></script><script type="text/javascript">google.load("jquery", "1");</script>
	<script type="text/javascript" src="includes/js/fancybox/jquery.fancybox-1.2.6.js"></script>
	<script type="text/javascript" src="includes/js/jquery.url.min.js"></script>
	<script type="text/javascript" src="includes/js/gallery.js"></script>
	<script language="javascript">
	$(document).ready(function() {

		$("a.fancybox").fancybox({
			'hideOnContentClick': false,
			'frameWidth': 660,
			'frameHeight':480,
			'imageScale':true,
			'callbackOnClose':function()
			{
				$("#output").empty();
				$("#output").append("<p style=\"text-align:center;\"><img src=\"includes/spinner.gif\"><br/>Please Wait...</p>");
				if($.url.param("folder") != "")
				{
					$.ajax({
				   	 	type: "GET",
					    url: "includes/thumbnailgen.php?folder=" + $.url.param("folder"),
						success: function(){$("#output").empty();loadAllData();}
					});
				}
				else
				{
					$.ajax({
				   	 	type: "GET",
					    url: "includes/thumbnailgen.php",
						success: function(){$("#output").empty();loadAllData();}
					});
				}
			}
		});
	});
	</script>
</head>
<body>
	<h1><a href="upload/?iframe" class="fancybox">upload an image &raquo;</a></h1>
<?
if($_GET["folder"] != "")
{
	echo "<div id=\"folderHeader\">current folder: <span id=\"folderName\">".$_GET["folder"]."</span></div>";
}
else
{
	echo "<div id=\"folderHeader\">current folder: <span id=\"folderName\">root folder</span></div>";
}
?>
<?
if($_GET["folder"] != "" && dirname($_GET["folder"]) != ".")
{
	echo "<div class='gallery_folder'><a href='index.php?folder=" . dirname($_GET["folder"]) . "/'><img src='/includes/folder.jpg'>^up one folder</a></div>";
}
else if($_GET["folder"] != "")
{
	echo "<div class='gallery_folder'><a href='index.php'><img src='/includes/folder.jpg'>^up one folder</a></div>";
}
?>
<div id="output">
</div>
<div id="footer">Get your own: <a href="http://github.com/jimmy0x52/simple-php-gallery">GitHub: Simple PHP Gallery</a></div>
</body>
</html>
