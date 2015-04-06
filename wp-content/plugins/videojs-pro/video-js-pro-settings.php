<?php
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
?>

<div class="wrap">
<h2>VideoJS Pro Settings</h2>

<form method="post" action="options.php" name="vjs_config">
    <?php settings_fields( 'vjspro-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Player Default Dimensions</th>

        <td>Height <input type="text" onkeypress="return numbersOnly(this, event)" onChange=updateDimensions("height") name="vjs_height" id="dimHeight" maxlength="4" size="4" value="<?php echo get_option('vjs_height'); ?>" />px &nbsp
        Width <input type="text" onkeypress="return numbersOnly(this, event)" onChange=updateDimensions("width") name="vjs_width" id="dimWidth" maxlength="4" size="4" value="<?php echo get_option('vjs_width'); ?>" />px<br />
        Player Aspect Ratio <input type="radio" name="vjs_frameaspect" value="16:9" onClick="document.getElementById('theFrameAspect').value='16:9'" <?php echo (get_option('vjs_frameaspect') == '16:9' ? 'checked' : ''); ?>/> 16:9
		<input type="radio" name="vjs_frameaspect" value="4:3" onClick="document.getElementById('theFrameAspect').value='4:3'" <?php echo (get_option('vjs_frameaspect') == '4:3' ? 'checked' : ''); ?>/> 4:3
		<input type="radio" name="vjs_frameaspect" value="custom" onClick="document.getElementById('theFrameAspect').value='custom'" <?php echo (get_option('vjs_frameaspect') == 'custom' ? 'checked' : ''); ?>/> Custom<br />
		<input type="hidden" id="theFrameAspect" value = "<?php echo get_option('vjs_frameaspect'); ?>">
        </td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Custom Skin</th>
        <td><select name="vjs_skin">
		 <?php
		 	$dir = "../wp-content/plugins/videojs-pro/video-js/skins";
		    $skin_list=glob("$dir/*.*");
			echo ("<option value = \"none\"". ('none' == $curmenuskin ? " selected":"") . ">none</option>\n");
			foreach($skin_list as $skin_name) {
				$curmenuskin = get_option('vjs_skin');
				$path_length = strlen ($dir) + 1;
				$skin_file_name = substr ($skin_name, $path_length);
				echo ("<option value = \"$skin_file_name\"". ($skin_file_name == $curmenuskin ? " selected":"") . ">$skin_file_name</option>\n");
		    	}
		    ?>			
		    </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Default Behaviors</th>
        <td><input type="checkbox" name="vjs_preload" value="true" <?php echo (get_option('vjs_preload') == 'true' ? 'checked' : ''); ?>/> Preload Videos<br />
        <input type="checkbox" name="vjs_autoplay" value="true" <?php echo (get_option('vjs_autoplay') == 'true' ? 'checked' : ''); ?>/> Autoplay Videos<br />
        <input type="checkbox" name="vjs_download" value="true" <?php echo (get_option('vjs_download') == 'true' ? 'checked' : ''); ?>/> Download Links Provided<br />
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Google Analytics</th>
        <td>
        <input type="text" name="vjs_googleaccount" size="13" value="<?php echo get_option('vjs_googleaccount'); ?>" /> Account Number<br />        
        <input type="checkbox" name="vjs_googlehead" value="true" <?php echo (get_option('vjs_googlehead') == 'true' ? 'checked' : ''); ?>/> Insert Analytics Header Code<br />
        <input type="checkbox" name="vjs_googleevents" value="true" <?php echo (get_option('vjs_googleevents') == 'true' ? 'checked' : ''); ?>/> Track Player Events<br />
        </td>
        </tr>


    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>