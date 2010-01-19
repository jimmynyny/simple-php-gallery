$(document).ready(function()
{
  $.ajax({
    type: "GET",
    url: "/includes/filelist.php",
    dataType: "xml",
    success: parseXml
  });
});
function parseXml(xml)
{
  //find every Tutorial and print the author
  $(xml).find("file").each(function(fn)
  {
    $("#output").append("<div class='flickaday_image'><a class='image_group' rel='image_group' title='" + $(this).find("filename").text() + "' href='/images/" + $(this).find("filename").text() + "' target='_blank'><img src='/thumbs/tn_" + $(this).find("filename").text() + "'>" + $(this).find("filename").text() + "</a>&nbsp;<a href='/images/" + $(this).find("filename").text() + "' target='_blank'><img src='/includes/newwin.gif'></a></div>");
  });

	$("a.image_group").fancybox();
}