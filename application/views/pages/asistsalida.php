<?=$page['header']?>

<?=$page['menu']?>

	<?= form_open_multipart('Asistencia/checkExit'); ?>
		<div class="col-lg-12"><h4>&nbsp;</h4></div>
		<div class="col-lg-12"><h4>&nbsp;</h4></div>
		<?php if ($print <> '') { echo "<pre>";print_r($print);echo "</pre>"; } ?>
		<div class="col-lg-3">
			<div class="row">
				<input name="Ingreso" type="hidden" value="0">
				<input name="idGrupo" type="hidden" value="<?= set_value('idGrupo')?>">
				<div class="form-group">
					<label>Ingrese No. de Identificación</label>
					<input name="DocumentoNo" class="form-control" type="number" placeholder="Número de Cédula" autofocus required autocomplete="off">
				</div>
				<div class="form-group">
					<center>
						<button type="submit" class="btn btn-warning">
							Registrar Salida
						</button>
					</center>
				</div>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<?php if (isset($success)): ?> 
					<div class="alert alert-success"><?= $success ?></div>
				<?php endif; ?>
				<?php if (isset($warning)): ?> 
					<div class="alert alert-warning"><?= $warning ?></div>
				<?php endif; ?>
				<?php if (isset($error)): ?>
					<div class="alert alert-danger"><?= $error ?></div>
				<?php endif; ?>
			</div>
		</div>
		<!-- /.col-lg-4 -->
	</form>

<?=$page['footer']?>

