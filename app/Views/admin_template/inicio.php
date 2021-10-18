<?php // aqui llamamos a la plantilla desde esta vista vista?>
<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>



<div id="layoutSidenav_content">
                <main>
                     <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                       
                        <div class="row">
                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Proyectos Abiertos</h6>
                                        <h2 class="text-right"><i class="fa fa-folder-open f-left"></i><span><?= $cantProyectosActivos?></span></h2>
                                        <p class="m-b-0">Proyectos Cerrados<span class="f-right"><?= $cantProyectosCerrados?></span></p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Proyectos cerca a Fecha fin</h6>
                                        <h2 class="text-right"><i class="fa fa-clock f-left"></i><span><?= $cantProyectosProximosVencimiento?></span></h2>
                                        <p class="m-b-0">Proyectos Vencidos<span class="f-right"><?= $cantProyectosVencidos?></span></p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-yellow order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Proyectos fuera de presupuesto</h6>
                                        <h2 class="text-right"><i class="fa fa-donate f-left"></i><span>486</span></h2>
                                        <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-pink order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Orders Received</h6>
                                        <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span>486</span></h2>
                                        <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
	                    </div>





                       
                        <!-- <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">7 Proyectos Activos en ejecución</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">3 Proyectos próximos a su fecha fin</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">3 Proyectos cerrados satisfactoriamente</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">2 proyectos activo sin registros de costos</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Plan vs Real
                                    </div>
                                    <div class="card-body">
                                    
<figure class="highcharts-figure">
    <div id="graficos"></div>
   
</figure>


                                   </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Indices Prorrateo
                                    </div>
                                    <div class="card-body">
                                            <figure class="highcharts-figure">
                                               <div id="indices_prorrateo"></div>
                                            </figure>    

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Caesar Vance</td>
                                                <td>Pre-Sales Support</td>
                                                <td>New York</td>
                                                <td>21</td>
                                                <td>2011/12/12</td>
                                                <td>$106,450</td>
                                            </tr>
                                            <tr>
                                                <td>Doris Wilder</td>
                                                <td>Sales Assistant</td>
                                                <td>Sidney</td>
                                                <td>23</td>
                                                <td>2010/09/20</td>
                                                <td>$85,600</td>
                                            </tr>
                                            <tr>
                                                <td>Angelica Ramos</td>
                                                <td>Chief Executive Officer (CEO)</td>
                                                <td>London</td>
                                                <td>47</td>
                                                <td>2009/10/09</td>
                                                <td>$1,200,000</td>
                                            </tr>
                                           
                                            <tr>
                                                <td>Jonas Alexander</td>
                                                <td>Developer</td>
                                                <td>San Francisco</td>
                                                <td>30</td>
                                                <td>2010/07/14</td>
                                                <td>$86,500</td>
                                            </tr>
                                            <tr>
                                                <td>Shad Decker</td>
                                                <td>Regional Director</td>
                                                <td>Edinburgh</td>
                                                <td>51</td>
                                                <td>2008/11/13</td>
                                                <td>$183,000</td>
                                            </tr>
                                            <tr>
                                                <td>Michael Bruce</td>
                                                <td>Javascript Developer</td>
                                                <td>Singapore</td>
                                                <td>29</td>
                                                <td>2011/06/27</td>
                                                <td>$183,000</td>
                                            </tr>
                                            <tr>
                                                <td>Donna Snider</td>
                                                <td>Customer Support</td>
                                                <td>New York</td>
                                                <td>27</td>
                                                <td>2011/01/25</td>
                                                <td>$112,000</td>
                                            </tr>
                                        </tbody>
                                    </table> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>



                <script src="<?php echo base_url('/assets/admin_template/')?>/js/jquery-3.5.1.slim.min.js"></script> 
  

<script src="<?php echo base_url('/assets/highcharts/')?>/highcharts.js"></script> 
<script src="<?php echo base_url('/assets/highcharts/')?>/exporting.js"></script> 
<script src="<?php echo base_url('/assets/highcharts/')?>/export-data.js"></script> 
<script src="<?php echo base_url('/assets/highcharts/')?>/accessibility.js"></script> 
 

<script type="text/javascript">
 Highcharts.chart('graficos', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Plan vs Real'
    },
    subtitle: {
        text: 'Comparación entre el gasto real y lo planificado en proyectos activos'
    },
    xAxis: {
        categories: ['IPU-03-20210312 ', 'IPU-03-2015487', 'IPU-03-2145 ', 'IPU-09-252 ', 'IPU-2521-21 '],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Gastos ($)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' $'
       
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Plan',
        data: [25480, 15210, 14000, 21213, 65456]
    }, {
        name: 'Real',
        data: [24010, 16525, 14521, 20145, 45121]
    }]
}); 
Highcharts.chart('indices_prorrateo', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Indices Prorrateo'
    },
    subtitle: {
        text: 'Indices de Prorrateo por Mes/Año'
    },
    xAxis: {
       //  categories: ['01/2021 ', '02/2021', '03/2021 ', '04/2021 ', '005/2021 ',],
        categories: [
            <?php foreach($indicesProrrateo as $ip)
            {
               echo $ip->mes.$ip->anno.','; 
             
          } ?>
        ],
        title: {
            text: 'Mes/Año'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'IP',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' '
       
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Indices Prorrateo',
        data: [
            <?php 
            foreach ($indicesProrrateo as $ip)
            {?>
            ["<?php echo $ip->mes.'/'.$ip->anno ?>",<?php echo $ip->valor_indice_prorrateo ?>],

            <?php } ?>
//            ['Firefox',   45.0],
//            ['IE',       26.8],

          ]
    }]
}); 
</script>
                <script language="javascript">
                (document).ready(function{
                 ('#dataTable').DataTable();
                 
                    

                    
                });


                </script>
                <?= $this->endSection() ?>