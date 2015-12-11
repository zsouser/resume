<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="/css/master.css">
	<script src="/js/jquery-1.11.3.min.js"></script>
	
	@yield('scripts')

	<style>
		@yield('css')
	</style>

	@yield('styles')
</head>
<body>
	@if (session()->has('error'))
		<i>{{ session('error') }}</i>
	@endif
	<div class="content">
		@yield('content')
	</div>
<footer>
	<a href="https://www.github.com/zsouser"><img height="75" width="75" src="/images/github.png"/></a>
	<img src="/images/zend.gif" height="75" width="75"></img>
	<a href="https://www.linkedin.com/pub/zach-souser/57/797/593"><img height="75" width="85" src="/images/linkedin.png"/></a>
</footer>
<script>
	@yield('js')
</script>
</body>
</html>