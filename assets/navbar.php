<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">✔o✘</a>
		</div>
		<div class="nav navbar-nav pesquisa-rapida">
			<form class="form-inline" action="/pesquisar_pauta" method="POST">
				<div class="form-group">
				    <input type="text" class="form-control" id="query_parcial" name="query_parcial" placeholder="Título parcial ou integral">
			  	</div>
				  <button type="submit" class="btn btn-secondary">Buscar pauta</button>
			</form>
		</div>
		<div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/pauta">Nova pauta</a></li>
				<li><a href="/pesquisar">Pesquisa Complexa</a></li>
				<li><a href="/logoff">Sair</a></li>
			</ul>
		</div>
	</div>
</nav>