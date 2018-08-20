<?=$page['header']?>

<?=$page['menu']?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Bienvenido <?= $userdata['Nombre'] ?></h1>
		<?php if ($print) { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $page['ingresos'] ?></div>
						<div>Ingresos Hoy</div>
					</div>
				</div>
			</div>
			<a href="<?=site_url('dashboard/exportEntrances')?>">
				<div class="panel-footer">
					<span class="pull-left">Exportar</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<?php if ($userdata['TipoUsuario'] == 'Admin'): ?>
	<div class="col-lg-3">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-tasks fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $page['retardos'] ?></div>
						<div>Retrasos Hoy</div>
					</div>
				</div>
			</div>
			<a href="<?=site_url('dashboard/exportDelays')?>">
				<div class="panel-footer">
					<span class="pull-left">Exportar</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-tasks fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?= $page['retardos'] ?></div>
						<div>Retrasos Mes</div>
					</div>
				</div>
			</div>
			<a href="<?=site_url('dashboard/exportDelays')?>">
				<div class="panel-footer">
					<span class="pull-left">Exportar</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<?php endif; ?>
</div>


		
<?=$page['footer']?>