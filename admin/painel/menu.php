<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.php"><img style="margin-top: -8px;" width="73em" src="imagens/icon.png"></a>
	</div>
	<!-- Top Menu Items -->
	<ul class="nav navbar-right top-nav">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_SESSION['nome']?><b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li>
					<a href="editar-user.php?id=<?=$_SESSION['id']?>"><i class="fa fa-fw fa-user"></i> Editar perfil</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
				</li>
			</ul>
		</li>
	</ul>
	<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav side-nav">
			<li>
				<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Painel de controle</a>
			</li>
			<li>
				<a href="javascript:;" data-toggle="collapse" data-target="#cadastro"><i class="fa fa-fw fa-edit"></i> Cadastro <i class="fa fa-fw fa-caret-down"></i></a>
				<ul id="cadastro" class="collapse">
					<li>
						<a href="cadastro.php">Adicionar novo</a>
					</li>
					<li>
						<a href="listar-cad.php">Todos cadastros</a>
					</li>
				</ul>
			</li>

			<li>
				<a href="javascript:;" data-toggle="collapse" data-target="#Usuário"><i class="fa fa-user"></i> Usuário <i class="fa fa-fw fa-caret-down"></i></a>
				<ul id="Usuário" class="collapse">
					<li>
						<a href="usuario.php">Adicionar novo</a>
					</li>
					<li>
						<a href="listar-user.php">Todos Usuários</a>
					</li>
				</ul>
			</li>
			</li>
		</ul>
	</div>
	<!-- /.navbar-collapse -->
</nav>