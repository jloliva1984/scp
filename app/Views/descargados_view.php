<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>
	<?php //var_dump($data['totalDescargado'][0]['totalDescargado']);die;?>

		<!-- aqui cargaba los css de grocery -->
	<div id="layoutSidenav_content" style="height: 100% " >
					<main>
						<div class="container-fluid" style="padding: 10px">
							<div class="card">
							                           <div class="card-header text-right" >
                               							
										   <h6 id="id_proyecto" class="proyecto" data-nombre_proyecto="<?= $resumenDescargardosPorProyecto[0]['descripcion']?>" data-codigo_proyecto="<?= $resumenDescargardosPorProyecto[0]['codigo']?>">    
										   <strong>Gastos Descargados - Proyecto</strong> - <?= $resumenDescargardosPorProyecto[0]['descripcion']?> || <strong>Código</strong> - <?=  $resumenDescargardosPorProyecto[0]['codigo']?>
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
                                                   
                                                    
                     <!-- <a href="">
                     <button type="button" name="descarga_real" id="descarga_real" class="btn btn-info  btn-sm descarga_real ">
                       
                         <strong><i class="fas fa-arrow-left"></i>Atrás</strong>
                     </button>
                     </a> -->
                     </div>

						<!-- <div style='height:20px;'></div>  
						<div style="padding: 10px">
							<?php //echo $output; ?>
						</div> -->

						
						
						
                            
                           
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-condensed table-striped table-hover table-sm small" id="resumenDescargados" name="resumenDescargados" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Subelemento Gasto</th>
                                                <th>Especialista</th>
                                                <th>Valor</th>
                                                <th>Indice prorrateo</th>
                                                <th>Valor Descargado</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
									   <?php 
										$totalvalorSubelementoGasto=0;
										$totalvalorSubelementoGastoDescargado=0;
									if(isset($resumenDescargardosPorProyecto)&& $resumenDescargardosPorProyecto!=0){	  
									   foreach($resumenDescargardosPorProyecto as $resumen){ ?>
									   <tr>
									   <td><?=$resumen['nombre'] ?></td>
									   <td><?=$resumen['nombre_completo'] ?></td>
									   <td><?php $totalvalorSubelementoGasto+=$resumen['valorSubelementoGasto'];echo $resumen['valorSubelementoGasto']; ?></td>
									   <td><?=$resumen['valor_indice_prorrateo'] ?></td>
									   <td><?php $totalvalorSubelementoGastoDescargado+=$resumen['valorSubelementoGastoDescargado'];echo $resumen['valorSubelementoGastoDescargado'] ?></td>
									   </tr> 
									   <?php } ?> 
                                                                                                                       
                                           
                                        </tbody>

										<tfoot>
                                            <tr>
											   
                                                <th>Totales</th>
                                                <th> </th>
                                                <th><?=$totalvalorSubelementoGasto ?></th>
                                                <th><?=$resumenDescargardosPorProyecto[0]['valor_indice_prorrateo'] ?></th>
                                                <th><?=$totalvalorSubelementoGastoDescargado ?></th>
                                            </tr>
                                        </tfoot>
										<?php } ?>
                                    </table>
                                </div>
                            
                        

						



						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
						</div>
						</div>
						
						<!-- aqui cargaba los js de grocery -->

					</main>
	</div>

	<script src="<?php echo base_url('/assets/jquery3.5.1.js');?>"></script>	
<script defer src="<?php echo base_url('/assets/fontawesome/');?>/all.js"></script>

<script src="<?php echo base_url('/assets/select2/');?>/js/select2.min.js"></script><!--EL PLUGIN SELECT2 DEBE SER CARGADO DESPUES DE CARGAR JQUERY-->

<!-- <script src="<?php echo base_url('/assets/')?>/datatables/datatables.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url('/assets/')?>/datatables/DataTables-1.10.25/js/datatables.bootstrap4.min.js" crossorigin="anonymous"></script> -->

<!-- datatables -->
<link rel="stylesheet" href="<?php echo base_url('/assets/datatables/');?>/DataTables-1.10.25/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?php echo base_url('/assets/datatables/');?>/DataTables-1.10.25/css/buttons.dataTables.min.css"/>

<script src="<?php echo base_url('/assets/datatables/');?>/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/DataTables-1.10.25/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/Buttons-1.7.1/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/Buttons-1.7.1/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('/assets/datatables/');?>/Buttons-1.7.1/js/buttons.print.min.js"></script>	

<script type="text/javascript">
$(document).ready(function(){
	var proyecto = $('.proyecto').attr('data-nombre_proyecto');
    var codigo_proyecto = $('.proyecto').attr('data-codigo_proyecto');
	$('#resumenDescargados').DataTable({
		responsive:"true",
		language: {
			"decimal": "",
			"emptyTable": "No hay información",
			"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
			"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
			"infoFiltered": "(Filtrado de _MAX_ total entradas)",
			"infoPostFix": "",
			"thousands": ",",
			"lengthMenu": "Mostrar _MENU_ Entradas",
			"loadingRecords": "Cargando...",
			"processing": "Procesando...",
			"search": "Buscar:",
			"zeroRecords": "Sin resultados encontrados",
			"paginate": {
				"first": "Primero",
				"last": "Ultimo",
				"next": "Siguiente",
				"previous": "Anterior"
			            }
         },
		dom:"Bfrtilp",
		buttons:[
			{
            text: '<i class="fas fa-arrow-left"></i>',
            titleAttr:'Atras',
             action: function ( e, dt, node, config )
            {
              history.go(-1);
            }
          },
                 {
					extend:'excelHtml5',
					footer:true,//para que imprima el foot
					text:'<i class="fas fa-file-excel"></i>',
					titleAttr:'Exportar a Excel',
					className:'btn btn-success',
					exportOptions: {
						//columns: [ 1, 2, 3, 4, 5, 6 ]
									},
					excelStyles:{
						template:'header_blue' 
									},
					title:'Gastos descargados || '+ codigo_proyecto + ' || ' + proyecto ,
					filename:'Gastos descargados || '+ codigo_proyecto + ' || ' + proyecto ,
				 
				 } ,
				 
                 {
						extend:'print',
						footer:true,
						text:'<i class="fas fa-print"></i>',
						titleAttr:'Imprimir',
						className:'btn btn-warning',
						exportOptions: {
							//columns: [ 1, 2, 3, 4, 5, 6 ]
						},
						title:'Gastos descargados || '+ codigo_proyecto + ' || ' + proyecto ,
						
						
						customize: function ( win ) {
							$(win.document.body)
								.css( 'font-size', '10pt' );
							
		
							$(win.document.body).find( 'table' )
								.addClass( 'compact' ).css( 'font-size', 'inherit' );

							$(win.document.body).find( 'h1' ) .css( 'font-size', '10pt' ).css('text-align','center');
							
						}	


				 },
				 {
					extend: 'pdfHtml5',
						title:'Gastos descargados || '+ codigo_proyecto + ' || ' + proyecto ,
						filename:'Gastos descargados || '+ codigo_proyecto + ' || ' + proyecto ,
						customize: function(doc) {
											doc.defaultStyle.fontSize = 8; 
											doc.defaultStyle.alignment= 'center';
											doc.styles.tableHeader.fontSize = 8; 
											doc.styles.tableFooter.fontSize = 8; 
											doc.styles.title.fontSize = 10; 
											doc.styles.title.alignment = 'center'; 

											doc.content[1].margin = [ 40, 20, 40, 0 ] //left, top, right, bottom

											//doc.pageMargins = [10, 10, 10,10 ];
											//  doc.content[0].alignment= 'center';
											console.log( doc);
												} ,
						footer:true,
						text: '<i class="fas fa-file-pdf"></i>',
						className:'btn btn-primary',
						exportOptions: {
						modifier: {
							page: 'current'
									},
									
						//columns: [ 1, 2, 3, 4, 5, 6 ],
                           }		   
				 }
				 

		]

	});
	function crear_datatable()
{
	$('#resumenDescargados').DataTable({
		responsive:"true",
		language: {
			"decimal": "",
			"emptyTable": "No hay información",
			"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
			"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
			"infoFiltered": "(Filtrado de _MAX_ total entradas)",
			"infoPostFix": "",
			"thousands": ",",
			"lengthMenu": "Mostrar _MENU_ Entradas",
			"loadingRecords": "Cargando...",
			"processing": "Procesando...",
			"search": "Buscar:",
			"zeroRecords": "Sin resultados encontrados",
			"paginate": {
				"first": "Primero",
				"last": "Ultimo",
				"next": "Siguiente",
				"previous": "Anterior"
			            }
         },
		dom:"Bfrtilp",
		"order": [[ 1, "asc" ]],
		
		buttons:[
                 {
					extend:'excelHtml5',
					footer:true,//para que imprima el foot
					text:'<i class="fas fa-file-excel"></i>',
					titleAttr:'Exportar a Excel',
					className:'btn btn-success',
					exportOptions: {
						//columns: [ 1, 2, 3, 4, 5, 6 ]
									},
					excelStyles:{
						template:'header_blue' 
									},
					title:'Prorrateo | Mes:'+'mes'+' | Año :'+'anno'+' | Índice prorrateo = '+'indice_prorrateo' + '|  Valor 731= '+'valor731' ,
					filename:'Prorrateo-'+'mes'+'-'+'anno',
				 
				 },
				 {
					extend: 'pdfHtml5',
						title:'Prorrateo | Mes:'+mes+' | Año :'+anno+' | Índice prorrateo = '+indice_prorrateo + '|  Valor 731= '+valor731 ,
						filename:'Prorrateo-'+mes+'-'+anno,
						customize: function(doc) {
											doc.defaultStyle.fontSize = 8; 
											doc.defaultStyle.alignment= 'center';
											doc.styles.tableHeader.fontSize = 8; 
											doc.styles.tableFooter.fontSize = 8; 
											doc.styles.title.fontSize = 10; 
											doc.styles.title.alignment = 'center'; 

											doc.content[1].margin = [ 40, 20, 40, 0 ] //left, top, right, bottom

											//doc.pageMargins = [10, 10, 10,10 ];
											//  doc.content[0].alignment= 'center';
											console.log( doc);
												} ,
						footer:true,
						text: '<i class="fas fa-file-pdf"></i>',
						className:'btn btn-primary',
						exportOptions: {
						modifier: {
							page: 'current'
									},
									
						columns: [ 1, 2, 3, 4, 5, 6 ],
                           }		   
				 }
				 
				 

		]
		
	});
}

})
</script>
<?= $this->endSection() ?>