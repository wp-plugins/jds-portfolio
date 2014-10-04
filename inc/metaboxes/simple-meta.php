<div class="my_meta_control">
 
	<label>Projects URL</label>
 
	<p>
		<?php $mb->the_field('project_url'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
		<span>Enter Project Redirection URL with "Http://".</span>
	</p>

</div>