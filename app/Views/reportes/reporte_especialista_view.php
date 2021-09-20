<?php // aqui llamamos a la plantilla desde esta vista vista?>
<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>


<div id="layoutSidenav_content" style="height: 100% " >
<main>
						<div class="container-fluid">
						<div class="col-md-5">
							<h3 class="mt-4">Reporte: Resumen de Trabajo x Especialista</h3>
						</div>
						<hr>
						</div>
				    
<?php
helper('form');
echo form_open('Proyectos/prorrateo_show', 'class="" id="prorrateo_form"');
 ?>	

			<div class="row">
				
				<div class="form-group col-md-10">

                <div class="form-group">
                <label class="col-md-1 control-label" for="selectbasic">Especialiasta(s)</label>
		           <div class="col-md-8">
                        <select id="especialistas" name="especialistas" class="form-control especialistas" multiple required>
                        <option value="0">Seleccione</option>
                        <?php foreach($especialistas as $especialista ) : ?>
                        <option value="<?php echo $especialista['id_especialista'].'-'.$especialista['nombre_completo'] ;?>"><?php  echo $especialista['nombre_completo']; ?></option>
                        <?php endforeach ?>
                       </select>
					</div>
				</div>
				</div>

				
				<div class="col-md-2">
				<div class="form-group">
				<button type="submit" class="btn btn-primary" id="prorratear" name="prorratear"><i class="fas fa-share-alt fa-fw"></i>Buscar</button>
				</div>
				</div>
				
			</div>
					
<?php form_close() ?>						
<hr>

</main>

<script src="<?php echo base_url('/assets/jquery3.5.1.js');?>"></script>

<link rel="stylesheet" href="<?php echo base_url('/assets/select2/');?>/css/select2.min.css">
<script src="<?php echo base_url('/assets/sweetalert/');?>/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url('/assets/sweetalert/');?>/css/sweetalert.css" />
	
<!-- aqui va copiado el codigo de la librria jquery completa -->
<script src="<?php echo base_url('/assets/select2/');?>/js/select2.min.js"></script><!--EL PLUGIN SELECT2DEBE SER CARGADO DESPUES DE CARGAR JQUERY--> 

<script defer src="<?php echo base_url('/assets/fontawesome/');?>/all.js"></script>
<script language="javascript">
$('#especialistas').select2();
</script>


<?= $this->endSection() ?>