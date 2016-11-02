<div class="container-fluid">
	<h1><?php echo _("<%= description %>")?></h1>
	<h2><?php echo $subhead?></h2>
	<div class = "display full-border">
		<div class="row">
			<div class="col-sm-9">
				<div class="fpbx-container">
					<div class="display full-border">
						<?php echo $content ?>
					</div>
				</div>
			</div>
			<div class="col-sm-3 hidden-xs bootnav">
				<div class="list-group">
					<?php echo load_view(__DIR__.'/bootnav.php')?>
				</div>
			</div>
		</div>
	</div>
</div>