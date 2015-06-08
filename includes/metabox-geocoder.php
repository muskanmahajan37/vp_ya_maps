<div id="YMapsID" data-geo='<?php echo $this->add_json_geo(get_post_meta($post->ID, '_vpyamaps_center', true),get_post_meta($post->ID, '_vpyamaps_mapzoom', true),get_post_meta($post->ID, '_vpyamaps_placemarct', true));?>'>

</div>
<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span4"></div>
			<div class="span4">
				<div class="form-horizontal">
					<div  class="control-group">
						<label class="control-label" for="markerPosition"><?php _e('Coordinates tags', 'vp_yandex_maps');?></label>
						<div class="controls">

							<input name="vpyamaps[_vpyamaps_placemarct]" type="text" id="markerPosition" value="<?php echo get_post_meta($post->ID, '_vpyamaps_placemarct', true); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mapZoom" ><?php _e('Map zoom', 'vp_yandex_maps');?></label>
						<div class="controls">
							<input type="text" id="mapZoom" name="vpyamaps[_vpyamaps_mapzoom]" value="<?php echo get_post_meta($post->ID, '_vpyamaps_mapzoom', true); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mapCenter"><?php _e('Map center', 'vp_yandex_maps');?></label>
						<div class="controls">
							<input type="text" id="mapCenter" name="vpyamaps[_vpyamaps_center]" value="<?php echo get_post_meta($post->ID, '_vpyamaps_center', true); ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="span4"></div>
		</div>
	</div>
</div>