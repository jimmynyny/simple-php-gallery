$(document).ready(function()
{
	if($.url.param("folder") != "")
	{
  $.ajax({
    type: "GET",
    url: "/includes/filelist.php?folder=" + $.url.param("folder"),
    dataType: "xml",
    success: parseXml
  });
	}
	else
	{
  $.ajax({
    type: "GET",
    url: "/includes/filelist.php",
    dataType: "xml",
    success: parseXml
  });
	}
});
function parseXml(xml)
{
	folder = "";
	if($.url.param("folder") != "")
	{
		folder = $.url.param("folder");
	}
  $(xml).find("dir").each(function(fn)
  {
    $("#output").append("<div class='gallery_folder'><a href='/index.php?folder=" + $.url.param("folder") + $(this).find("filename").text() + "/'><img src='/includes/folder.jpg'>" + $(this).find("filename").text() + "</a></div>");
  });
	$("#output").append("<div style=\"clear:both;\"></div>");
  $(xml).find("file").each(function(fn)
  {
    $("#output").append("<div class='gallery_image'><a class='image_group' rel='image_group' title='" + $(this).find("filename").text() + "' href='/images/"+folder + $(this).find("filename").text() + "' target='_blank'><img src='/thumbs/"+folder+"tn_" + $(this).find("filename").text() + "'>" + $(this).find("filename").text() + "</a>&nbsp;<a href='/images/" +folder+ $(this).find("filename").text() + "' target='_blank'><img src='/includes/newwin.gif'></a></div>");
  });

	$("a.image_group").fancybox();
}