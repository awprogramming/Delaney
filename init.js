var campers;
var gender;
var division;
var bunk;

$(function(){
    
    $( "#campers, #players" ).sortable().disableSelection();

	$.ajax('campers.php',
	{
		type: 'GET',
		data: {all:true},
		cache: true,
		success: function (data) {campers = JSON.parse(data); console.log(campers);}, 
		error: function () {alert("Grab failed");}
	});

	var divisionButtons = $('<button class="division">freshmen</button><button class="division">cadet</button><button class="division">sophomore</button><button class="division">junior</button><button class="division">senior</button><button class="division">super</button><button class="division">teen</button><button class="division">CITS</button>');
	var bunkButtons = $('<div></div>');

	for(var i = 1; i < 25; i++)
	{
		bunkButtons.append($('<button class="bunk">'+i+'</button>'));
	}
	$('#m').click(function(){
		gender = _.groupBy(campers,'gender').male;
		$('#divisions').html(divisionButtons);
		$('#bunks').html(bunkButtons);
		registerClicks();
	});

	$('#f').click(function(){
		gender = _.groupBy(campers,'gender').female;
		$('#divisions').html(divisionButtons);
		$('#bunks').html(bunkButtons);
		registerClicks();
	});
});

var registerClicks = function(){
	$('.division').click(function(){
		divisionName = $(this).html();
		division = _.groupBy(gender,'division')[divisionName];
		console.log(division);
		$('#campers').html("");
		buildCampers(division,$('#campers'));
	});
	$('.bunk').click(function(){
		bunkNum = $(this).html();
		bunk = _.groupBy(gender,'bunk')[bunkNum];
		console.log(bunk);
		$('#campers').html("");
		buildCampers(bunk,$('#campers'));
	});
}
