<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

</head>
<body>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">
					Concurso Master
				</a>

				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<ul class="nav navbar-nav">
				<li><a href="{{ url('question') }}">Questões</a></li>
				<li><a href="{{ url('category') }}">Categorias</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Listagem</a></li>
						<li><a href="#"></a></li>
						<li><a href="#">Something else here</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Separated link</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container">
		@yield('content')
	</div>

	<script type="text/javascript">
		var BASE_URL = '{{ url('/') }}';
	</script>
	<script type="text/javascript" src="{{ asset('js/all.js') }}"></script>

</body>
</html>