<?=$page['header']?>

<?= form_open_multipart('Aplicacion/updateItem'); ?>
<?=$page['menu']?>

<div class="col-lg-12">
	<h1 class="page-header">Configuración</h1>
	<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
</div>
<!-- /.col-lg-12 -->
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Horario Personal (Plantas)</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label>Hora Entrada (Lunes - Viernes)</label>
					<input name="LVHoraEntrada" class="form-control" placeholder="LHora Entrada (Lunes - Viernes)" value="<?= set_value('LVHoraEntrada')?>" required>
				</div>
				<div class="form-group">
					<label>Hora Salida (Lunes - Viernes)</label>
					<input name="LVHoraSalida" class="form-control" placeholder="Hora Salida (Lunes - Viernes)" value="<?= set_value('LVHoraSalida')?>" required>
				</div>
				<div class="form-group">
					<label>Horas Almuerzo (Lunes - Viernes)</label>
					<input name="LVHorasAlmuerzo" class="form-control" placeholder="Horas Almuerzo (Lunes - Viernes)" value="<?= set_value('LVHorasAlmuerzo')?>" required>
				</div>
				<div class="form-group">
					<label>Hora Entrada (S&aacute;bado)</label>
					<input name="SHoraEntrada" class="form-control" placeholder="Hora Entrada (S&aacute;bado)" value="<?= set_value('SHoraEntrada')?>" required>
				</div>
				<div class="form-group">
					<label>Hora Salida (S&aacute;bado)</label>
					<input name="SHoraSalida" class="form-control" placeholder="Hora Salida (S&aacute;bado)" value="<?= set_value('SHoraSalida')?>" required>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<h3 class="panel-title">Horario Personal (Administración)</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label>Hora Entrada (Lunes - Viernes)</label>
					<input name="LVHoraEntradaAdmin" class="form-control" placeholder="LHora Entrada (Lunes - Viernes)" value="<?= set_value('LVHoraEntradaAdmin')?>" required>
				</div>
				<div class="form-group">
					<label>Hora Salida (Lunes - Viernes)</label>
					<input name="LVHoraSalidaAdmin" class="form-control" placeholder="Hora Salida (Lunes - Viernes)" value="<?= set_value('LVHoraSalidaAdmin')?>" required>
				</div>
				<div class="form-group">
					<label>Horas Almuerzo (Lunes - Viernes)</label>
					<input name="LVHorasAlmuerzoAdmin" class="form-control" placeholder="Horas Almuerzo (Lunes - Viernes)" value="<?= set_value('LVHorasAlmuerzoAdmin')?>" required>
				</div>
				<div class="form-group">
					<label>Hora Entrada (S&aacute;bado)</label>
					<input name="SHoraEntradaAdmin" class="form-control" placeholder="Hora Entrada (S&aacute;bado)" value="<?= set_value('SHoraEntradaAdmin')?>" required>
				</div>
				<div class="form-group">
					<label>Hora Salida (S&aacute;bado)</label>
					<input name="SHoraSalidaAdmin" class="form-control" placeholder="Hora Salida (S&aacute;bado)" value="<?= set_value('SHoraSalidaAdmin')?>" required>
				</div>
			</div>
		</div>
	</div>
</div>
<!--
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<h3 class="panel-title">Configuración Dashboard</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label>Cantidad Eventos Dashboard</label>
					<input name="LimiteEventosDashboard" class="form-control" placeholder="Limite Eventos Dashboard" value="<?= set_value('LimiteEventosDashboard')?>" required>
				</div>
			</div>
		</div>
	</div>
</div>
	<div class="form-group">
		<label>Aplicar filtro de asistencia</label>
		<select name="Filtro" class="form-control" placeholder="Seleccione filtro">
			<?php foreach ($filtro as $item): ?>
				<?php if (set_value('Filtro') != $item): ?>
					<option value="<?=$item?>"><?= $item?></option>
				<?php else: ?>
					<option value="<?=$item?>" selected><?=$item?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
	</div>
	-->
</div>
	
</form>
<?=$page['footer']?>

