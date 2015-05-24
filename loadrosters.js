var rosters;
$(function(){
	$.ajax('rosters.php',
	{
		type: 'GET',
		data: {all:true},
		cache: true,
		success: function (data) {rosters = JSON.parse(data); buildrosters();}, 
		error: function () {alert("Grab failed");}
	});

});

var buildrosters = function(){
	for(var i=0; i<rosters.length;i++)
	{
		var container = $("#rosters");
		var roster_div = $("<div class='rdiv'></div>")
		roster_div.append($("<span>"+rosters[i].name+"</span>"));
		roster_div.append($("<span class='print'>print</span>"));
		roster_div.append($("<span class='edit'>edit</span>"));
		roster_div.append($("<span class='delete'>delete</span>"));
		roster_div.data("id",rosters[i].id);
		roster_div.data("name",rosters[i].name);
		container.append(roster_div);
	}
	
	$(".edit").click(function(){
		window.location = "newroster.php?edit=true&id=" + $(this).parent().data("id");
	});

	$(".delete").click(function(){
		var r = confirm("Are you sure you want to delete this roster?");
		if (r == true) {
		    removeRoster($(this).parent().data("id"));
		    $(this).parent().remove();
		} 
		
	});

	$(".print").click(function(){
		window.location = "printRoster.php?id=" + $(this).parent().data("id");
	});




}