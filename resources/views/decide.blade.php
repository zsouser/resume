<html>
<head>
<script src="/js/jquery-1.11.3.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/css/decide.css">
<link rel="stylesheet" href="/css/jquery-ui.min.css"/>
<script src="/js/decide.js"></script>

<script>
$(document).ready(function() {
	$("#container").decide('#results');
})
</script>


</head>
<body>
	<h1>Decision Support System</h1>
	<div class="wrap">
		<div id="container" class="hidden"></div>
		<div id="results"></div>
		<div class="actions">
		</div>
	</div>
</body>
</html>
