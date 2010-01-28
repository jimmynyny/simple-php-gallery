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
	<link rel="stylesheet" href="/includes/js/fancybox/jquery.fancybox-1.2.6.css" type="text/css" media="screen">	
		<style type='text/css' media='screen'>@import "/includes/js/fancybox/jquery.fancybox-1.2.6.css";</style>
		<link rel="stylesheet" href="/includes/main.css" type="text/css" media="screen">
		<style type='text/css' media='screen'>@import "/includes/main.css";</style>
	<script type="text/javascript" src="http://www.google.com/jsapi"></script><script type="text/javascript">google.load("jquery", "1");</script>
	<script type="text/javascript" src="/includes/js/fancybox/jquery.fancybox-1.2.6.js"></script>
	<script type="text/javascript" src="/includes/js/jquery.url.min.js"></script>
	<script type="text/javascript" src="/includes/js/gallery.js"></script>
	<style> 
		
	</style> 
</head>
<body>
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
<div id="output">
	<?
	if($_GET["folder"] != "" && dirname($_GET["folder"]) != ".")
	{
		echo "<div class='gallery_folder'><a href='/index.php?folder=" . dirname($_GET["folder"]) . "/'><img src='/includes/folder.jpg'>^up one folder</a></div>";
	}
	else if($_GET["folder"] != "")
	{
		echo "<div class='gallery_folder'><a href='/'><img src='/includes/folder.jpg'>^up one folder</a></div>";
	}
	?>
</div>
<div id="footer">Get your own: <a href="http://github.com/jimmy0x52/simple-php-gallery">GitHub: Simple PHP Gallery</a></div>
</body>
</html>
