var perPage = 10;

$(document).ready(function()
{
	loadAllData();
});
function loadAllData()
{
	$("#output").empty();
	$("#output").append("<p style=\"text-align:center;\"><img src=\"includes/spinner.gif\"><br/>Please Wait...</p>");
	if($.url.param("folder") != "")
	{
  $.ajax({
    type: "GET",
    url: "includes/filelist.php?folder=" + $.url.param("folder"),
    dataType: "xml",
    success: parseXml
  });
	}
	else
	{
  $.ajax({
    type: "GET",
    url: "includes/filelist.php",
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
	   $("#output").append("<div class='gallery_folder'><a href='index.php?folder=" + $.url.param("folder") + $(this).find("filename").text() + "/'><img src='includes/folder.jpg'>" + $(this).find("filename").text() + "</a></div>");
	});
	$("#output").append("<div style=\"clear:both;\"></div>");
	count = 0;
	startCount = 0;
	if($.url.param("page") != "" && parseInt($.url.param("page")))
	{
		startCount = perPage * parseInt($.url.param("page"));
	}
	picHtml = "";
	$(xml).find("file").each(function(fn)
	{
		if(count >= startCount && count < (startCount + perPage))
		{
			picHtml = picHtml + "<div class='gallery_image'><a class='image_group' rel='image_group' title='" + $(this).find("filename").text() + "' href='/images/"+folder + $(this).find("filename").text() + "' target='_blank'><img src='/thumbs/"+folder+"tn_" + $(this).find("filename").text() + "'>" + $(this).find("filename").text() + "</a>&nbsp;<a href='/images/" +folder+ $(this).find("filename").text() + "' target='_blank'><img src='/includes/newwin.gif'></a></div>";
		}
		count++;
	});
	pagingControlsHtml = "";
	if((count / perPage) > 0)
	{
		for(i = 0; i < (count / perPage); i++)
		{
			pagingControlsHtml = pagingControlsHtml + "<a class=\"pagingControlsNums";
			if(i == $.url.param("page"))
			{
				pagingControlsHtml = pagingControlsHtml + " active";
			}
			pagingControlsHtml = pagingControlsHtml + "\" href=\"?page="+i;
			if(folder != "")
			{
				pagingControlsHtml = pagingControlsHtml + "&folder=" + folder;
			}
			pagingControlsHtml = pagingControlsHtml + "\">" + (i+1) + "</a>";
		}
		if(pagingControlsHtml != "")
		{
			pagingControlsHtml = "<div class=\"pagingControls\"><span class=\"pagingControlsPerPage\">(" + perPage + " per page) </span>" + pagingControlsHtml + "</div>";
		}
	}	
	$("#output").append(pagingControlsHtml);
	$("#output").append(picHtml);	
	$("#output").append("<div style=\"clear:both;\"></div>");
	$("#output").append(pagingControlsHtml);

	$("a.image_group").fancybox();
}