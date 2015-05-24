$(function(){
    if(getUrlParameter('edit')=="true")
    {
        var id = getUrlParameter('id');
        $.ajax('rosters.php',
            {
                type: 'GET',
                data: {id:id},
                cache: true,
                success: function (data) {fillPage(JSON.parse(data));}, 
                error: function () {alert("Error");}
            });
    }

});

var fillPage = function(rosterInfo)
{
    console.log(rosterInfo);
    $("#name").val(rosterInfo.roster.name);
    var filtered = _.filter(campers, function(camper){return $.inArray(camper.id,rosterInfo.camperIDs) != -1; });
    buildCampers(filtered,$('#players'));
}