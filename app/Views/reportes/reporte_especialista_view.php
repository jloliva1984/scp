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
echo form_open('/Proyectos/reporte_especialista_show', 'class="" id="reporte_resumen_especialista_form"');
 ?>	

			<div class="row">
				
				<div class="form-group col-md-10">

                <div class="form-group">
                <label class="col-md-1 control-label" for="selectbasic">Especialiasta(s)</label>
		           <div class="col-md-8">
                        <select id="especialistas" name="especialistas[]" class="form-control especialistas" multiple required>
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
<?php if(isset($resultados) && $resultados!=''){
$totales=0;	
	?>
			<div class="table-responsive">
<table class="table table-striped table-hover table-sm small " id="resumen_especialistas">
<thead>
<!-- <th style="display:none;"></th> -->
<th>Especialista</th>
<th>Proyecto</th>
<th>Subelemento Gasto</th>
<th>Valor</th>
<th>Fecha</th><!--la seuma de los subelem de gasto-->


</thead>
<tbody>

<?php foreach($resultados as $key =>$result) {?>
<tr class="" id="resumen_royecto">

<td class=""><?=$result->nombre_completo?></td>
<td class=""><?=$result->codigo.' - '.$result->descripcion?></td>
<td class=""><?=$result->nombre?></td>
<td class=""><?=$result->valor ;$totales+=$result->valor?></td>
<td class=""><?=$result->fecha?></td>

</tr>
<?php }?>
</tbody>
<tfoot>
<tr>

<td><strong>Totales</strong></td>
<td></td>
<td></td>
<td class="totales"><?php if(isset($totales)){echo $totales;}else {echo 0;} ?></td>
<td></td>

</tr>
</tfoot>
</table>	
</div>
<?php }?>
	


					


<div class="reporte_resumen_especialista" id="reporte_resumen_especialista"></div>

</main>

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
$('#especialistas').select2();
crear_datatable();
})


function crear_datatable()
{
	jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
    return this.flatten().reduce( function ( a, b ) {
      if ( typeof a === 'string' ) {
        a = a.replace(/[^\d.-]/g, '') * 1;
      }
      if ( typeof b === 'string' ) {
        b = b.replace(/[^\d.-]/g, '') * 1;
      }
      var a = parseFloat(a) || 0;
      var b = parseFloat(b) || 0;
      return a + b;
    }, 0);
  });

	$('#resumen_especialistas').DataTable({
		responsive:"true",

		drawCallback: function () {
        var api = this.api();
        var total = api.column( 3, {"filter":"applied"}).data().sum();
        $('.totales').html('$ '+total);
        },

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
					title:'Reporte de trabajos por especialistas' ,
					filename:'Reporte de trabajos por especialistas',
				 
				 },
				 
                 {
						extend:'print',
						footer:true,
						text:'<i class="fas fa-print"></i>',
						titleAttr:'Imprimir',
						className:'btn btn-warning',
						exportOptions: {
							//columns: [ 1, 2, 3, 4, 5, 6 ]
						},
						title:'Reporte de trabajos por especialistas' ,
						
						
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
						title:'Reporte de trabajos por especialistas' ,
						filename:'Reporte de trabajos por especialistas',
						customize: function(doc) {
											doc.defaultStyle.fontSize = 8; 
											doc.defaultStyle.alignment= 'center';
											doc.styles.tableHeader.fontSize = 8; 
											doc.styles.tableFooter.fontSize = 8; 
											doc.styles.title.fontSize = 10; 
											doc.styles.title.alignment = 'center'; 

											doc.content[1].margin = [ 20, 20, 20, 0 ] //left, top, right, bottom

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
}


// $('#reporte_resumen_especialista_form').on('submit',function(event){
// 	   event.preventDefault();
// 		var error='';
		
// 	    if($('.especialistas').val()=='')
// 		{
// 					error+="<p>Debe seleccionar al menos un especialista </p>";
// 					return false;
// 		}

				
// 		var form_data=$(this).serialize();
// 		var especialistas=$('#especialistas').val();
// 		var base_url='<?php echo base_url() ?>'+'/';
// 		//alert(base_url);exit;
// 		//alert(base_url+'/Proyectos/reporte_resumen_especialista/');exit;
// 		if(error=='')
// 			{
// 			//$('#trabajadores_hidden').val(trabajadores);	
// 			 $.ajax({
// 				url: base_url+'/Proyectos/reporte_resumen_especialista',
// 				method:"POST",
// 				data:{especialistas:especialistas},
// 				 success:function(data)
// 				 {  
// 					$('#reporte_resumen_especialista').html(data);
// 					// $('#print').removeAttr('disabled');
// 					// $('#pay').removeAttr('disabled');
					

// 				 }
// 			 })	;
// 			}
// 		else
// 			{
//             alert(error);
// 			}
		
		
// 	});	
</script>


<?= $this->endSection() ?>