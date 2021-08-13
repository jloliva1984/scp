<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>
	<?php 
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<div id="layoutSidenav_content" style="height: 100%">
					<main>
						<div class="container-fluid">
							<h1 class="mt-4">Acciones del sistema</h1>
							<ol class="breadcrumb mb-4">
								<li class="breadcrumb-item active">Acciones del sistema</li>
							</ol>
						</div>
						
						<?= view_cell('App\Libraries\ViewComponents::getMenu') ?> 

						
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