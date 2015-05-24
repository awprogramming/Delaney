var inRoster=[];
$(function(){

    $("#add").click(function(){
    	
    	var selected = $("#campers .selected");
    	//console.log(selected);
    	var players = $("#players");
		//$("#campers .selected").clone().appendTo(players);
		//players.append();
    	var notAdded = 0;
    	for(var i=0;i<selected.length;i++)
    	{
    		if(inRoster.indexOf($(selected[i]).data("id"))>-1)
    		{
    			notAdded++;
    		}
    		else{
	    		var cloned = $(selected[i]).clone();
                cloned.data("id",$(selected[i]).data("id"));
	    		cloned.click(function(){
			    	if($(this).hasClass("selected"))
			    	{
			    		$(this).removeClass("selected");
			    	}
			    	else
			    	{
			    		$(this).addClass("selected");
			    	}
			    });
	    		cloned.appendTo(players);
	    		inRoster.push($(selected[i]).data("id"));
    		}
    	}
    	console.log(notAdded);
    	$(".selected").removeClass("selected");
    });

    $("#remove").click(function(){
    	
        var toRemove = $("#players .selected");

        for(var i = 0; i<toRemove.length; i++)
        {
            inRoster = _.without(inRoster,$(toRemove[i]).data("id"));
        }
        toRemove.remove();
    });

    $("#save").click(function(){
        
        var name = $("#name").val();
        var players = $("#players .item");
        if(name=="")
        {
            alert("put in name");
        }
        else if(players.length<1)
        {
            alert("add players to roster");
        }
        else{
            var ids = [];

            for(var i = 0; i< players.length; i++)
            {
                ids.push($(players[i]).data("id"));
            }
            
            
            if(getUrlParameter('edit')=="true")
            {
                var rid = getUrlParameter('id')
                $.ajax('rosters.php',
                {
                    type: 'POST',
                    data: {update:true, name:name, id:rid, ids:ids},
                    cache: true,
                    success: function (data) {window.location.href = "rosters.html"}, 
                    error: function (e) {alert(e);}
                });
            }

            else
            {
                $.ajax('rosters.php',
                {
                    type: 'POST',
                    data: {create:true, name:name, ids:ids},
                    cache: true,
                    success: function (data) {window.location.href = "rosters.html"}, 
                    error: function () {alert("Add failed");}
                });
            }
        }
    });

});


var removeRoster = function(rid)
{
    $.ajax('rosters.php',
                {
                    type: 'POST',
                    data: {remove:true, id:rid},
                    cache: true,
                    success: function (data) {console.log(rid)}, 
                    error: function () {alert("Remove failed");}
    });
}

var getUrlParameter = function(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
} 