<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>
	<?php //var_dump($data['totalDescargado'][0]['totalDescargado']);die;
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<div id="layoutSidenav_content" style="height: 100% " >
					<main>
						<div class="container-fluid" style="padding: 10px">
							<div class="card">
							                           <div class="card-header text-right" >
                               							
														   <h6 id="id_proyecto" data-id_proyecto='<?= $data['proyectos']['id_proyecto'] ?>'>    
														   <strong>Gastos Descargados - Proyecto</strong> - <?= $data['proyectos']['descripcion']?> || <strong>Código</strong> - <?= $data['proyectos']['codigo']?>
														   </h6>
													   </div>
						
						
					    <div class="card-body">
					    <div>
						<a href='<?php echo site_url('proyectos/proyectos_management')?>'>Proyectos</a> |
						<a href='<?php echo site_url('SubElementosGastos/SubElementosGastos_management')?>'>Subelementos de gasto</a> |
						<a href='<?php echo site_url('Especialidades/especialidades_management')?>'>Especialidades</a> |
						<a href='<?php echo site_url('Especialistas/especialistas_management')?>'>Especialistas</a> |
						<a href='<?php echo site_url('Cuentas/cuentas_management')?>'>Cuenta 731</a> |
						<a href='<?php echo site_url('Usuarios/Usuarios_management')?>'>Usuarios</a> | 
						<a href='<?php echo site_url('examples/employees_management')?>'>Employees</a> |		 
						<a href='<?php echo site_url('examples/film_management')?>'>Films</a>
					</div>

					<div class="container-fluid text-right">
                                                   
                                                    
                     <a href="<?php echo base_url().'/Proyectos/descarga_show/'.$data['proyectos']['id_proyecto'] ?>
                     s<button type="button" name="descarga_real" id="descarga_real" class="btn btn-info  btn-sm descarga_real ">
                       
                         <strong><i class="fas fa-arrow-left"></i>Atrás</strong>
                     </button>
                     </a>
                     </div>

						<div style='height:20px;'></div>  
						<div style="padding: 10px">
							<?php echo $output; ?>
						</div>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
						</div>
						</div>
						
						<?php foreach($js_files as $file): ?>
							<script src="<?php echo $file; ?>"></script>
						<?php endforeach; ?>  

					</main>
	</div>
<?= $this->endSection() ?>