<?
	if($_GET["folder"] && (substr($_GET["folder"],0,1) == "." || preg_match("/.+\.\..+/", $_GET["folder"])))
	{
		echo "no no no.";
		return;
	}
	
	function handleError() {
	    trigger_error('ERROR CREATING FOLDER');
	}
	
	if($_GET["cmd"] && $_GET["cmd"] == "add")
	{
		if($_GET["folder"])
		{
			$dirToAdd = $_SERVER["DOCUMENT_ROOT"]."/images/".$_GET["folder"];
			$rs = @mkdir( $dirToAdd, '0777' );
			@handleError();
			if( $rs )
			{
				echo "%%SUCCESS%% " . $dirToAdd;
			}
			else
			{
				echo "Problem creating " . $_GET["folder"];
			}
		}
		else
		{
			echo "Sorry - Folder name cannot be blank.";
		}
		return;
	}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>Simple PHP Gallery - Upload</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.swfupload {
		position: absolute;
		z-index: 1;
	}
</style>

<link rel="stylesheet" href="/includes/main.css" type="text/css" media="screen">
<style type='text/css' media='screen'>@import "/includes/main.css";</style>
<script type="text/javascript" src="http://www.google.com/jsapi"></script><script type="text/javascript">google.load("jquery", "1");</script>
<script type="text/javascript" src="/includes/js/jquery.url.min.js"></script>

<script type="text/javascript" src="includes/js/swfupload.js"></script>
<script type="text/javascript" src="includes/plugins/swfupload.swfobject.js"></script>
<script type="text/javascript" src="includes/plugins/swfupload.queue.js"></script>
<script type="text/javascript" src="includes/js/fileprogress.js"></script>
<script type="text/javascript" src="includes/js/handlers.js"></script>
<script type="text/javascript" src="../includes/js/folders.js"></script>
<script type="text/javascript">
var swfu;

SWFUpload.onload = function () {
	var settings = {
		flash_url : "includes/Flash/swfupload.swf",
		upload_url: "upload.php",
		file_size_limit : "100 MB",
		file_types : "*.*",
		file_types_description : "All Files",
		file_upload_limit : 100,
		file_queue_limit : 0,
		custom_settings : {
			progressTarget : "fsUploadProgress",
			cancelButtonId : "btnCancel"
		},
		debug: false,

		// Button Settings
		button_placeholder_id : "spanButtonPlaceholder",
		button_width: 61,
		button_height: 22,
		button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		button_cursor: SWFUpload.CURSOR.HAND,

		// The event handler functions are defined in handlers.js
		swfupload_loaded_handler : swfUploadLoaded,
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,
		queue_complete_handler : queueComplete,	// Queue plugin event
		
		// SWFObject settings
		minimum_flash_version : "9.0.28",
		swfupload_pre_load_handler : swfUploadPreLoad,
		swfupload_load_failed_handler : swfUploadLoadFailed
	};

	swfu = new SWFUpload(settings);
}
function showAddFolder()
{
	$("#newFolder").empty();
	$("#newFolder").css('opacity',0.0);
	$("#newFolder").append("Folder Name:&nbsp;<input type=\"text\" id=\"newFolderName\">&nbsp;<input type=\"submit\" value=\"Add\" onclick=\"addNewFolder($('#newFolderName').val());return false;\"><input type=\"submit\" value=\"Cancel\" onclick=\"resetAddFolder();return false;\"><span style=\"display:block;clear:both;\" id=\"errorText\"></span>")
	$("#newFolder").animate({opacity:1.0},500);
	$("#errorText").css('opacity',0.0);
}
function resetAddFolder()
{
	$("#newFolder").animate({opacity:0.0},200,function(){
		$("#newFolder").empty();
		$("#newFolder").append("<a href=\"javascript:void(0);\" onClick=\"javascript:showAddFolder();\">add new folder &raquo;</a>");
		$("#newFolder").animate({opacity:1.0},200);
	});
}
function addNewFolder(folderName)
{
  	$.ajax({
	    type: "GET",
	    url: "index.php?cmd=add&folder=" + escape($.url.param("folder") + folderName),
	    dataType: "text",
	    success: function (text){
			if(text.indexOf("%%SUCCESS%%") != -1)
			{
				$("#output").empty();
				loadAllData();
				$("#newFolder").animate({opacity:0.0},200,function(){
					$("#newFolder").empty();
					$("#newFolder").append("<a href=\"javascript:void(0);\" onClick=\"javascript:showAddFolder();\">add new folder &raquo;</a>");
					$("#newFolder").animate({opacity:1.0},200);
				});
			}
			else
			{
				$("#errorText").animate({opacity:0.0},100);
				$("#errorText").empty();
				$("#errorText").append(text);
				$("#errorText").animate({opacity:1.0},500);
			}
		}
	  });
}
</script>
</head>
<body>
<div id="content">

	<h1>Simple Gallery - Upload</h1>
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
	<div id="output"></div>
	<div id="newFolder"><a href="javascript:void(0);" onClick="javascript:showAddFolder();">add new folder &raquo;</a></div>
	<form id="form1" action="index.php" method="post" enctype="multipart/form-data">

		<div id="divSWFUploadUI">
			<div class="fieldset flash" id="fsUploadProgress">
			<span class="legend">Upload Queue</span>
			</div>
			<p id="divStatus">0 Files Uploaded</p>
			<p>
				<span id="spanButtonPlaceholder"></span>
				<input id="btnUpload" type="button" value="Select Files" style="width: 91px; height: 22px; font-size: 8pt;" />
				<input id="btnCancel" type="button" value="Cancel All Uploads" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
			</p>
			<br style="clear: both;" />
		</div>
		<noscript style="background-color: #FFFF66; border-top: solid 4px #FF9966; border-bottom: solid 4px #FF9966; margin: 10px 25px; padding: 10px 15px;">
			We're sorry.  SWFUpload could not load.  You must have JavaScript enabled to enjoy SWFUpload.
		</noscript>
		<div id="divLoadingContent" class="content" style="background-color: #FFFF66; border-top: solid 4px #FF9966; border-bottom: solid 4px #FF9966; margin: 10px 25px; padding: 10px 15px; display: none;">
			SWFUpload is loading. Please wait a moment...
		</div>
		<div id="divLongLoading" class="content" style="background-color: #FFFF66; border-top: solid 4px #FF9966; border-bottom: solid 4px #FF9966; margin: 10px 25px; padding: 10px 15px; display: none;">
			SWFUpload is taking a long time to load or the load has failed.  Please make sure that the Flash Plugin is enabled and that a working version of the Adobe Flash Player is installed.
		</div>
		<div id="divAlternateContent" class="content" style="background-color: #FFFF66; border-top: solid 4px #FF9966; border-bottom: solid 4px #FF9966; margin: 10px 25px; padding: 10px 15px; display: none;">
			We're sorry.  SWFUpload could not load.  You may need to install or upgrade Flash Player.
			Visit the <a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash">Adobe website</a> to get the Flash Player.
		</div>
	</form>
</div>
</body>
</html>
