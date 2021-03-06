<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>
	<?php 
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<div id="layoutSidenav_content" style="height: 100%" class="small">
					<main>
						<div class="container-fluid">
							<h1 class="mt-4">Proyectos</h1>
							<ol class="breadcrumb mb-4">
								<li class="breadcrumb-item active">Proyectos</li>
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
							<?php echo $file.'<br>';?>
							<script src="<?php echo $file; ?>"></script>
						<?php endforeach; ?>  

<button type="button" class="btn btn-success openBtn" onclick="prueba(1)">Open Modal</button>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Modal with Dynamic Content</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
					</main>
	</div>


	
<!-- MODALS -->
<!-- Trigger the modal with a button -->




<script language="javascript">
$(document).ready(function()
{
//	alert('ducumento listo');
// 	function prueba(param)
// 	{
// 		alert (param);
// 	}
	$('.openBtn').live('click',function(){
    $('.modal-body').html('content.html',function(){
        $('#myModal').modal({show:true});
    });
 });

})
</script>

	
<?= $this->endSection() ?>
