<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>
	
<div id="layoutSidenav_content" style="height: 100%">
 <main>
						<div class="container-fluid">
						<div class="col-md-5">
							<h1 class="mt-4">Prorrateo</h1>
						</div>
						</div>
				    
						
<hr>

<?php if(isset($resultados) && $resultados!=0){?>
<div class="container-fluid text-right">
<?php
 if(isset($mes,$anno,$valor731,$totalProduccionProceso)){?>
	<h6 class="small" >
	<strong id="indice_prorrateo" name="indice_prorrateo" class="indice_prorrateo" data-indice_prorrateo='<?=($totalProduccionProceso!=0) ? $valor731/$totalProduccionProceso : '' ?>'>ÍNDICE PRORRATEO</strong>- <?=($totalProduccionProceso!=0) ? $valor731/$totalProduccionProceso : '' ?>||<strong id="mes" name="mes" class="mes" data-mes='<?= $mes ?>' >  Mes</strong> - <?= $mes?> || <strong id="anno" name="anno" class="anno" data-anno='<?= $anno ?>'>Año</strong> - <?= $anno ?>|| <strong id="valor731" name="valor731" class="valor731" data-valor731='<?= $valor731 ?>'>Valor 731</strong> - <?= $valor731 ?>  <button class="btn btn-success" id="confirmar" name="confirmar"><i class="fas fa-check fa-fw"></i>Confirmar</button>
	<a href="#" class="btn btn-info"><span class="fas fa-print"></span> Imprimir</a>
	<input type="button" value="Imprimir" onclick="javascript:window.print()" />
	</h6>
	<?php }?>
	</div>
	<hr>


<?php
$totalProduccioProceso=0;
$totalCostosIndirectos=0;	
	?>
<div class="container"><div class="row"><div class="col-lg-12">
<table class="table table-striped table-hover table-sm small" id="resumenProrrateo" name="resumenProrrateo">
<thead>
<th>Código</th>
<th>Descripcion</th>
<th>Saldo Inicial</th>
<th>Costos Directos</th><!--la seuma de los subelem de gasto-->
<th>Costos Indirec.</th>
<th>Prod. Proce.</th>
<th></th>
</thead>
<tbody>
<?php foreach($resultados as $key =>$result) {?>
<tr class="resumen_proyecto">
<td class="id_proyecto" style="display:none;"><?=$result['id_proyecto']?></td>
<td class="codigo"><?=$result['codigo']?></td>
<td class="descripcion"><?=$result['descripcion']?></td>
<td class="saldoInicio"><?=$saldosInicio[$key]?></td>
<td class="costosDirectos">
<?=$result['produccionProceso'];$totalProduccioProceso+=$result['produccionProceso'];?></td>
<td class="costosIndirectos"><?php $totalCostosIndirectos+=($result['produccionProceso']*($valor731/$totalProduccionProceso));echo round($result['produccionProceso']*($valor731/$totalProduccionProceso),2);  ?></td>
<td class="produccionProceso"><?php echo $result['produccionProceso'] + round($result['produccionProceso']*($valor731/$totalProduccionProceso),2)  ?></td>

</tr>
<?php }?>
<tr><td><strong>Totales</strong></td><td></td><td><td><?= '<strong>'. $totalProduccioProceso.'</strong>' ?></td><td><?= '<strong>'.$totalCostosIndirectos.'</strong>'?></td><td><?= '<strong>'.($totalProduccioProceso+$totalCostosIndirectos).'</strong>'?></td><td></td></tr>
</tbody>
</table>	
</div>
</div>
</div>
<?php }else{echo '<div class="text-center">No hay resultados que mostrar</div>';} ?>
<div class="card-body">
 <div class="table-responsive">


 <table class="table table-striped table-bordered table-condensed" id="data1Table" name="data1Table">
<thead>
<th>Código</th>
<th>Descripcion</th>
<th>Saldo Inicial</th>
</thead>
<tbody>


<?php foreach($resultados as $key =>$result) {?>
<tr class="resumen_proyecto">

<td class="codigo"><?=$result['codigo']?></td>
<td class="descripcion"><?=$result['descripcion']?></td>
<td class="saldoInicio"><?=$saldosInicio[$key]?></td>

</tr>
<?php }?>
<tr><td><strong>Totales</strong></td><td></td><?= '<strong>'. $totalProduccioProceso.'</strong>' ?></td><td><?= '<strong>'.$totalCostosIndirectos.'</strong>'?></td><td><?= '<strong>'.($totalProduccioProceso+$totalCostosIndirectos).'</strong>'?></td><td></td></tr>



</tbody>
</table>


 </div>
</div>

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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<!-- //end datatables -->




<script language="javascript">
$(document).ready(function()
{
	// $('#resumen_prorrateo_mensual').DataTable({
	// 	responsive:"true",
	// 	dom:"Bfrtilp",
	// 	buttons:[
    //              {
	// 			extend:'excelHtml5',
	// 			text:'<i class="fas fa print"></i>',
	// 			titleAttr:'Exportar a Excel',
	// 			className:'btn btn-success'
	// 			 },

	// 	]
		
	// });

	
	// $('#mitabla').DataTable({
	// 	responsive:"true",
	// 	dom:"Bfrtilp",
	// 	buttons:[
    //              {
	// 			extend:'excelHtml5',
	// 			text:'<i class="fas fa-print"></i>',
	// 			titleAttr:'Exportar a Excel',
	// 			className:'btn btn-success'
	// 			 },

	// 	]
		
	// });

	// $('#prorrateo_table').dataTable({
	// 	"order":[],
	// 	"serverSide":true,
	// 	"ajax":{
	// 		url:"<?php // echo base_url('/proyectos/prorrateo_show')?>",
	// 		type:"POST",
	// 	}
	// });
	
	crear_select2();
	crear_datatable();
	confirmar_prorrateo();
	verificar_prorrateo();
		
})

function crear_datatable()
{
$('#resumenProrrateo').DataTable({
		responsive:"true",
		dom:"Bfrtilp",
		buttons:[
                 {
				extend:'excelHtml5',
				text:'<i class="fas fa-print"></i>',
				titleAttr:'Exportar a Excel',
				className:'btn btn-success'
				 },

		]
		
	});


}
function crear_select2()
{
$('#mes').select2();
$('#anno').select2();
}
function verificar_prorrateo()
{
$('#valor731').on('focus',function(){

	//$("#valor731").prop('disabled', false);   
	$("#prorratear").prop('disabled', false);  
	$("#prorratear").text('Prorratear');
	

  var mes = $('#mes').val();
  var anno = $('#anno').val();
  if(mes=='')
  {
	  alert('Debe seleccionar el mes');
	  return ;
  }
  if(anno=='')
  {
	  alert('Debe seleccionar el año');
	  return ;
  }


  $.ajax({
                type: "POST",
                dataType: 'json',

                data: {'mes': mes,'anno':anno},
                url: "<?php echo base_url();?>/Proyectos/verificar_prorrateo",
                success : function(data) {
                  if(data==1)
                  {
					$('#valor731').blur(); //para que suelte el foco y no muestre mas el cartel
					
					$("#prorratear").prop('disabled', true);  
										
                    swal("Alerta!", "El índice de prorrateo para el mes y año seleccionado ya existe.", "warning");
                    //window.location.assign("<?php //echo base_url();?>/scp/public/Proyectos/proyectos_management/");
                  }

                }
            });
 })
}
function confirmar_prorrateo()
{
  $('#confirmar').on('click',function()
  {

	var resultRow = new Array();
	 var generalResult = new Array();
	//var generalResult[];
	var idProyecto='';
	//recorriendo la tabla
				$("#resumen_prorrateo_mensual tbody tr[class='resumen_proyecto']").each(function(idx,fila) {
					resultRow.push(fila.children[0].innerHTML);
					resultRow.push(fila.children[1].innerHTML);
					resultRow.push(fila.children[3].innerHTML);
					resultRow.push(fila.children[4].innerHTML);
					resultRow.push(fila.children[5].innerHTML);
					resultRow.push(fila.children[6].innerHTML);
										
                    Array.prototype.push.apply(generalResult,resultRow);
										 
					 resultRow.length=0;//vaciando arreglo
					
				});

	var mes = $('.mes').attr('data-mes');
	var anno = $('.anno').attr('data-anno');
	var valor731 = $('.valor731').attr('data-valor731');
	var indice_prorrateo = $('.indice_prorrateo').attr('data-indice_prorrateo');
		
    swal({

            title: "Confirmación",
			text: "Se almacenará el indice de prorrateo para el mes seleccionado ,desea continuar?",
            type: "info",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sí",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
          },
function(isConfirm) {
        if (isConfirm) {
          $.ajax({
                type: "POST",
                dataType: 'json',
				
           data: {'mes': mes,'anno':anno,'valor731':valor731,'indice_prorrateo':indice_prorrateo,'generalResult':JSON.stringify(generalResult)},
                url: "<?php echo base_url();?>/Proyectos/guardar_prorrateo",
                success : function(data) {
                  if(data>0)
                  {
                    swal("Confirmación!", "El índice de prorrateo para el mes y año seleccionado fue almacenado correctamente ,ahora puede efectuar la descarga para los registros de ese mes.", "success");
					window.location.assign("<?php echo base_url();?>/scp/public/Proyectos/proyectos_management/");
                  }
				  if(data==-1)
                  {
                    swal("Error!", "Ocurrió un error al insertar los datos.", "error");
                    
                  }


                }
            });

        }
         else {
          swal("Cancelado", "Se ha cancelado la descarga de los elementos seleccionados :)", "error");
              }

});








  })
}
</script>	
<?= $this->endSection() ?>