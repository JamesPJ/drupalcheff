<div class="row">
	<div class="col-md-6">
		<?php print render($form['name']); ?>
	</div>
	<div class="col-md-6">
		<?php print render($form['phone']); ?>
	</div>
	<!-- Be sure to render the remaining form items. -->
	<?php print drupal_render_children($form); ?>
</div>