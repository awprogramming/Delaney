<html>
<head>
<link href="delaney.css" rel="stylesheet">
<link href="roster.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="underscore.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/masonry/3.1.5/masonry.pkgd.min.js"></script>
<script src='masonryInit.js'></script>
<script src='init.js'></script>
<script src='buildCampers.js'></script>
<script src='editRoster.js'></script>
<script src='rosterFunctions.js'></script>
</head>
<body>
	<div id="roster">
		<label>Roster Title<input id="name">
		<ul id="players">
		</ul>
		<button id="remove">Remove From Roster</button>
		<button id="save">Save Roster</button>
	</div>
	<div id="gender">
	<button id="m">male</button>
	<button id="f">female</button>
	</div>
	<div id="divisions"></div>
	<div id="bunks"></div>
	<div id="campers_outer">
		<ul id="campers"></ul>
	</div>
	<button id="add">Add To Roster</button>
</body>
</html>