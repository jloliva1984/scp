<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>
	<?php 
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<div id="layoutSidenav_content" style="height: 100%">
					<main>
						<div class="container-fluid">
							<h1 class="mt-4">Sistemas</h1>
							<ol class="breadcrumb mb-4">
								<li class="breadcrumb-item active">Sistemas</li>
							</ol>
						</div>
						
					<div>
						<a href='<?php echo site_url('examples/customers_management')?>'>Customers</a> |
						<a href='<?php echo site_url('examples/orders_management')?>'>Orders</a> |
						<a href='<?php echo site_url('examples/products_management')?>'>Products</a> |
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