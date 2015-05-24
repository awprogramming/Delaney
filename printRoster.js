$(function(){
        var id = getUrlParameter('id');
        $.ajax('rosters.php',
            {
                type: 'GET',
                data: {id:id},
                cache: true,
                success: function (data) {getCamperNames(JSON.parse(data))}, 
                error: function () {alert("Error");}
            });
});

var getCamperNames = function(resultJSON)
{
    cids = resultJSON.camperIDs;
    $.ajax('campers.php',
            {
                type: 'GET',
                data: {some:cids},
                cache: true,
                success: function (data) {createPrintout(resultJSON.roster.name,JSON.parse(data));}, 
                error: function () {alert("Error");}
            });
}

var createPrintout = function(name,players)
{
    $('#pRoster_Name').html(name);
    console.log(players);
    for(var i = 0; i<players.length; i++)
    {
        console.log(players[i]);
        var li = $('<li class="player">'+players[i][1]+' '+players[i][2]+'</li>');
        $('#pRoster_Players').append(li);
    }
    //window.print();
}