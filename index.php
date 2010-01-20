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
	<link rel="stylesheet" href="/includes/js/fancybox/jquery.fancybox-1.2.6.css" type="text/css" media="screen">
	<style type='text/css' media='screen'>@import "/includes/js/fancybox/jquery.fancybox-1.2.6.css";</style>
	<script type="text/javascript" src="http://www.google.com/jsapi"></script><script type="text/javascript">google.load("jquery", "1");</script>
	<script type="text/javascript" src="/includes/js/fancybox/jquery.fancybox-1.2.6.js"></script>
	<script type="text/javascript" src="/includes/js/jquery.url.min.js"></script>
	<script type="text/javascript" src="/includes/js/gallery.js"></script>
	<style> 
		body {
			font-size: 12px;
			font-family: Helvetica, Arial, Sans-Serif; /* choose overall font - go to www.typetester.org to test sizes and see the list of safe fonts - If the user doesnt have the first one, it try the second, and goes along the list until it finds a font that the computer has installed */
		}
		div.gallery_folder { 
			width:165px; 
			height:155px; 
			float:left; 
			margin: 0 10px 30px 10px; 
			text-align:center; 
		}
		div.gallery_image { 
			width:165px; 
			height:155px; 
			float:left; 
			margin: 0 10px 30px 10px; 
			text-align:center; 
		}
	</style> 
</head>
<body>
<?
if($_GET["folder"] != "")
{
	echo "<h1>folder: ".$_GET["folder"]."</h1>";
}
else
{
	echo "<h1>folder: root folder</h1>";
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
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-584240-9");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
