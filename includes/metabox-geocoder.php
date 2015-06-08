<div id="YMapsID" data-geo='<?php echo $this->add_json_geo(get_post_meta($post->ID, 'center', true),get_post_meta($post->ID, 'mapzoom', true),get_post_meta($post->ID, 'placemarct', true));?>'></div>
<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span4"></div>
			<div class="span4">
				<div class="form-horizontal">
					<div  class="control-group">
						<label class="control-label" for="markerPosition">Координаты метки</label>
						<div class="controls">

							<input name="vpyamaps[placemarct]" type="text" id="markerPosition" value="<?php echo get_post_meta($post->ID, 'placemarct', true); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mapZoom" >Масштаб карты</label>
						<div class="controls">
							<input type="text" id="mapZoom" name="vpyamaps[mapzoom]" value="<?php echo get_post_meta($post->ID, 'mapzoom', true); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mapCenter">Центр карты</label>
						<div class="controls">
							<input type="text" id="mapCenter" name="vpyamaps[center]" value="<?php echo get_post_meta($post->ID, 'center', true); ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="span4"></div>
		</div>
	</div>
</div>