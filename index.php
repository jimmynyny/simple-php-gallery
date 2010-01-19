<? include 'includes/thumbnailgen.php'; ?>
<html>
<head>
	<link rel="stylesheet" href="/includes/js/fancybox/jquery.fancybox-1.2.6.css" type="text/css" media="screen">
	<style type='text/css' media='screen'>@import "/includes/js/fancybox/jquery.fancybox-1.2.6.css";</style>
	<script type="text/javascript" src="http://www.google.com/jsapi"></script><script type="text/javascript">google.load("jquery", "1");</script>
	<script type="text/javascript" src="/includes/js/fancybox/jquery.fancybox-1.2.6.js"></script>
	<script type="text/javascript" src="/includes/js/gallery.js"></script> 
	<style> 
		body {
			font-size: 12px;
			font-family: Helvetica, Arial, Sans-Serif; /* choose overall font - go to www.typetester.org to test sizes and see the list of safe fonts - If the user doesnt have the first one, it try the second, and goes along the list until it finds a font that the computer has installed */
		}
		div.flickaday_image { 
			width:165px; 
			height:145px; 
			float:left; 
			margin: 0 10px 30px 10px; 
			text-align:center; 
		} 
	</style> 
</head>
<body>
<div id="output"></div>
</body>
</html>