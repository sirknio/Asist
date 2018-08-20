<?=$page['header']?>

<?php if (!$update): ?>
	<?= form_open_multipart('Integrante/insertItem/Crear'); ?>
<?php else: ?>
	<?= form_open_multipart('Integrante/updateItem/'.set_value('idPersona').'/Update'); ?>
<?php endif; ?>

<?=$page['menu']?>

<?php $item = ''; ?>

	<div class="col-lg-12">
		<h1 class="page-header">Empleado</h1>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
	</div>
	<!-- /.col-lg-12 -->
		<div class="col-lg-12">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Datos Básicos</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Foto</label>
							<input type="file" name="foto" class="form-group" capture="camera">
						</div>
						<div class="form-group">
							<label>Nombre</label>
							<input name="Nombre" class="form-control" placeholder="Nombre" value="<?= set_value('Nombre')?>" required>
						</div>
						<div class="form-group">
							<label>Apellido</label>
							<input name="Apellido" class="form-control" placeholder="Apellido" value="<?= set_value('Apellido')?>" required>
						</div>
						<div class="form-group">
							<label>Tipo Documento</label>
							<select name="DocumentoTipo" class="form-control" placeholder="Seleccione Tipo Documento" required>
								<option value=""> </option>
								<?php foreach ($DocumentoTipo as $item): ?>
									<?php if (set_value('DocumentoTipo') != $item): ?>
										<option value="<?=$item?>"><?= $item?></option>
									<?php else: ?>
										<option value="<?=$item?>" selected><?=$item?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Número Documento</label>
							<input name="DocumentoNo" class="form-control" placeholder="Documento Identidad" value="<?= set_value('DocumentoNo')?>" onkeypress="return valida(event)" required>
						</div>
						<div class="form-group">
							<label>Genero</label>
							<select name="Genero" class="form-control" placeholder="Seleccione Genero">
								<option value=""> </option>
								<?php foreach ($Genero as $item): ?>
									<?php if (set_value('Genero') != $item): ?>
										<option value="<?=$item?>"><?= $item?></option>
									<?php else: ?>
										<option value="<?=$item?>" selected><?=$item?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Fecha Nacimiento</label>
							<div class="input-group date form_birthdate" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
								<input class="form-control" name="FechaNacimiento" size="16" type="text" value="<?= set_value('FechaNacimiento')?>" placeholder="Seleccione Fecha" readonly>
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value="" /><br/>
						</div>
						<div class="form-group">
							<label>Correo Electrónico</label>
							<input name="Email" class="form-control" placeholder="Correo Electrónico" value="<?= set_value('Email')?>">
						</div>
						<div class="form-group">
							<label>Teléfono Celular</label>
							<input name="TelefonoMovil" class="form-control" placeholder="Telefono Celular" value="<?= set_value('TelefonoMovil')?>">
						</div>
					</div>
				</div>
			</div>
		</div>
</form>

<?=$page['footer']?>

