

$(function(){

	$('#add').click(function(){
		var first = $('#first').val();
		var last = $('#last').val();
		var gender = $('input[name="sex"]:checked').val()
		var division = $('#division').val();
		var bunk = $('#bunk').val();
		//validate event entry form
		if(first=="")
		{
			alert("Please enter a first name");
		}
		else if(last=="")
		{
			alert("Please enter a last name");
		}
		else if(gender==undefined)
		{
			alert("Please select a gender");
		}
		else if(division=="division")
		{
			alert("Please select a division")
		}
		else if(bunk > 25 || bunk < 1 || !$.isNumeric(bunk))
		{
			alert("Please enter a valid bunk number");
		}

		$.ajax('campers.php',
		{
			type: 'POST',
			data: {create:true, first:first, last:last, gender:gender, division:division, bunk:bunk},
			cache: true,
			success: function (data) {}, //dismiss modal
			error: function () {alert("Add failed");}
 		});
	});
});
