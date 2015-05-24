var buildCampers = function(camperList,whichDiv)
{
	for(var x = 0; x < camperList.length; x++)
	{
		singleBuild(camperList[x],whichDiv);
	}
}

var singleBuild = function(camperInfo,whichDiv)
{
	var camperDiv = whichDiv;
	var camper = $('<li class="item"></li>');
	camper.data("id",camperInfo.id);
	camper.click(function(){
    	if($(this).hasClass("selected"))
    	{
    		$(this).removeClass("selected");
    	}
    	else
    	{
    		$(this).addClass("selected");
    	}
    });
	camper.append($('<p>'+camperInfo.last+',</p>'));
	camper.append($('<p>'+camperInfo.first+'</p>'));
	camper.append($('<p>'+camperInfo.division+'</p>'));
	camper.append($('<p>'+camperInfo.bunk+'</p>'));
	camperDiv.append(camper);
}