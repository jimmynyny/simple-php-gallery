var perPage = 10;

$(document).ready(function()
{
	loadAllData();
});
function loadAllData()
{
	$("#output").empty();
	$("#output").append("<p style=\"text-align:center;\"><img src=\"../includes/spinner.gif\"><br/>Please Wait...</p>");
	if($.url.param("folder") != "")
	{
  $.ajax({
    type: "GET",
    url: "../includes/filelist.php?folder=" + $.url.param("folder"),
    dataType: "xml",
    success: parseXml
  });
	}
	else
	{
  $.ajax({
    type: "GET",
    url: "../includes/filelist.php",
    dataType: "xml",
    success: parseXml
  });
	}
}

function parseXml(xml)
{
	$("#output").empty();
	folder = "";
	if($.url.param("folder") != "")
	{
		folder = $.url.param("folder");
	}
 	$(xml).find("dir").each(function(fn)
	{
	   $("#output").append("<div class='gallery_folder'><a href='index.php?folder=" + $.url.param("folder") + $(this).find("filename").text() + "/'><img src='../includes/folder.jpg'>" + $(this).find("filename").text() + "</a></div>");
	});
	$("#output").append("<div style=\"clear:both;\"></div>");
}