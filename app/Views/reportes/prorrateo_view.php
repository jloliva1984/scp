<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>

<div id="layoutSidenav_content" style="height: 100%">
 <main>
						<div class="container-fluid">
						<div class="col-md-5">
							<h1 class="mt-4">Prorrateo</h1>
						</div>
						<hr>
						</div>
				    
<?php
helper('form');
echo form_open('Proyectos/reporte_prorrateo', 'class="" id="prorrateo_form"');
 ?>	

			<div class="form-row container-fluid form-inline">
				<div class="form-group col-md-4 float-right" >
				<?php 
				$options = [
					''  => 'SELECCIONE',
					'01'  => 'Enero',
					'02'    => 'Febrero',
					'03'  => 'Marzo',
					'04' => 'Abril',
					'05' => 'Mayo',
					'06' => 'Junio',
					'07' => 'Julio',
					'08' => 'Agosto',
					'09' => 'Septiembre',
					'10' => 'Octubre',
					'11' => 'Noviembre',
					'12' => 'Diciembre',
				];
				$attrs = ['id'=> 'mes','style'=>'width:150px','required'=>true];
				echo 'Mes :'.form_dropdown('mes', $options, '00',$attrs);
				?>
				
				</div>
				<div class="form-group col-md-4">
					<?php 
							$options = [
								''=>'Seleccione',
								'2020'  => '2020',
								'2021'  => '2021',
								'2022'    => '2022',
								'2023'  => '2023',
								'2024' => '2024',
								'2025' => '2025',
								'2026' => '2026',
								'2027' => '2027',
								
							];
							$attrs = ['id'=> 'anno','class'=>'form-group','style'=>'width:150px','required'=>true];
							echo 'Año :'.form_dropdown('anno', $options, '00',$attrs);

                        ?>
					</select>
				</div>
				
				<div class="col-md-2">
				<button type="submit" class="btn btn-primary" id="prorratear" name="prorratear"><i class="fas fa-search fa-fw"></i>Buscar</button>
				</div>
				
				
			</div>
					
<?php form_close() ?>						
<hr>





<?php if(isset($resultados) && $resultados!=0){?>
<div class="container-fluid text-right">
<?php
 if(isset($mes,$anno)){?>
	<h6 class="small" >
	<strong id="indice_prorrateo" name="indice_prorrateo" class="indice_prorrateo" data-indice_prorrateo="<?= $resultados[0]->valor_indice_prorrateo ?>">ÍNDICE PRORRATEO</strong>- <?=($resultados[0]->valor_indice_prorrateo!=0) ? $resultados[0]->valor_indice_prorrateo : '' ?>||<strong id="mes" name="mes" class="mes" data-mes='<?= $mes ?>' >  Mes</strong> - <?= $mes?> || <strong id="anno" name="anno" class="anno" data-anno='<?= $anno ?>'>Año</strong> - <?= $anno ?>|| <strong id="valor731" name="valor731" class="valor731" data-valor731='<?= $resultados[0]->valor731 ?>'>Valor 731</strong> - <?= $resultados[0]->valor731 ?>  
	<!-- <button class="btn btn-success" id="confirmar" name="confirmar"><i class="fas fa-check fa-fw"></i>Confirmar</button>
	<a href="#" class="btn btn-info"><span class="fas fa-print"></span> Imprimir</a> -->
	
	</h6>
	<?php }?>
	</div>
	<hr>


<?php
$totalSaldoInicio=0;
$totalCostosDirectos=0;	
$totalCostosIndirectos=0;	
$totalProduccionProceso=0;	
	?>
<div class="table-responsive">

<table class="table table-striped table-hover table-sm small " id="resumen_prorrateo_mensual">
<thead>
<tr>
<th>Código</th>
<th>Descripcion</th>
<th>Saldo Inicial</th>
<th>Costos Directos</th><!--la seuma de los subelem de gasto-->
<th>Costos Indirec.</th>
<th>Prod. Proce.</th>
</tr>
</thead>
<tbody>
<?php foreach($resultados as $key =>$result) {?>
<tr class="resumen_proyecto" id="resumen_proyecto">
<td class="codigo"><?=$result->codigo?></td>
<td class="descripcion"><?=$result->descripcion ?></td>
<td class="saldoInicio"><?php $totalSaldoInicio+=$result->saldo_inicial; echo $result->saldo_inicial;?></td>
<td class="costosDirectos"><?php $totalCostosDirectos+=$result->costos_directos;echo $result->costos_directos;?></td>
<td class="costosIndirectos"><?php $totalCostosIndirectos+=$result->costos_indirectos ; echo $result->costos_indirectos; ?></td>
<td class="produccionProceso"><?php $totalProduccionProceso+=$result->produccion_proceso ;echo $result->produccion_proceso; ?></td>

</tr>
<?php }?>
</tbody>
<tfoot>
<tr>
<td><strong>Totales</strong></td>
<td></td>
<td> <?='<strong>'.$totalSaldoInicio.'</strong>'?></td>
<td><?= '<strong>'. $totalCostosDirectos.'</strong>' ?></td>
<td><?= '<strong>'.$totalCostosIndirectos.'</strong>'?></td>
<td><?= '<strong>'.($totalProduccionProceso).'</strong>'?></td>
</tr>
</tfoot>
</table>	
</div>
<?php }else{echo '<div class="text-center">No hay resultados que mostrar</div>';} ?>


 </main>
</div>

<script src="<?php echo base_url('/assets/jquery3.5.1.js');?>"></script>

<link rel="stylesheet" href="<?php echo base_url('/assets/select2/');?>/css/select2.min.css">
<script src="<?php echo base_url('/assets/sweetalert/');?>/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url('/assets/sweetalert/');?>/css/sweetalert.css" />
	
<!-- aqui va copiado el codigo de la librria jquery completa -->
<script src="<?php echo base_url('/assets/select2/');?>/js/select2.min.js"></script><!--EL PLUGIN SELECT2DEBE SER CARGADO DESPUES DE CARGAR JQUERY--> 

<script defer src="<?php echo base_url('/assets/fontawesome/');?>/all.js"></script>



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
<!-- //end datatables -->




<script language="javascript">
$(document).ready(function()
{
	
	crear_select2();
	crear_datatable();
	

		
})

function crear_datatable()
{
	var mes = $('.mes').attr('data-mes');
	var anno = $('.anno').attr('data-anno');
	var valor731 = $('.valor731').attr('data-valor731');
	var indice_prorrateo = $('.indice_prorrateo').attr('data-indice_prorrateo');



	

		$('#resumen_prorrateo_mensual').DataTable({
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
					// exportOptions: {
					// 	columns: [ 1, 2, 3, 4, 5, 6 ]
					// 				},
					excelStyles:{
						template:'header_blue' 
									},
					title:'Prorrateo | Mes:'+mes+' | Año :'+anno+' | Índice prorrateo = '+indice_prorrateo + '|  Valor 731= '+valor731 ,
					filename:'Prorrateo-'+mes+'-'+anno,
				 
				 },
				 
                 {
						extend:'print',
						footer:true,
						text:'<i class="fas fa-print"></i>',
						titleAttr:'Imprimir',
						className:'btn btn-warning',
						// exportOptions: {
						// 	columns: [ 1, 2, 3, 4, 5, 6 ]
						// },
						title:'Prorrateo | Mes:'+mes+' | Año :'+anno+' | Índice prorrateo = '+indice_prorrateo + '|  Valor 731= '+valor731 ,
						
						
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
									
						//columns: [ 1, 2, 3, 4, 5, 6 ],
                           }		   
                },
				
				 

		]
		
	});
}
function crear_select2()
{
$('#mes').select2();
$('#anno').select2();
}


</script>	
<?= $this->endSection() ?>