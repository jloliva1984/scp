<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>
	<?php 
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<div id="layoutSidenav_content" style="height: 100%">
					<main>
						<div class="container-fluid">
							<h1 class="mt-4">Especialistas</h1>
							<ol class="breadcrumb mb-4">
								<li class="breadcrumb-item active">Especialistas</li>
							</ol>
						</div>
						
				    <div>
						<a href='<?php echo site_url('proyectos/proyectos_management')?>'>Proyectos</a> |
						<a href='<?php echo site_url('SubElementosGastos/SubElementosGastos_management')?>'>Subelementos de gasto</a> |
						<a href='<?php echo site_url('Especialidades/especialidades_management')?>'>Especialidades</a> |
						<a href='<?php echo site_url('Especialistas/especialistas_management')?>'>Especialistas</a> |
						<a href='<?php echo site_url('Cuentas/cuentas_management')?>'>Cuenta 731</a> |
						<a href='<?php echo site_url('Usuarios/Usuarios_management')?>'>Usuarios</a> |
						<a href='<?php echo site_url('examples/offices_management')?>'>Offices</a> | 
						<a href='<?php echo site_url('examples/employees_management')?>'>Employees</a> |		 
						<a href='<?php echo site_url('examples/film_management')?>'>Films</a>
					</div>
						<div style='height:20px;'></div>  
						<div style="padding: 10px">
							<?php echo $output; ?>
						</div>

						
						<?php foreach($js_files as $file): ?>
							<script src="<?php echo $file; ?>"></script>
						<?php endforeach; ?>  

					</main>
	</div>
<?= $this->endSection() ?>