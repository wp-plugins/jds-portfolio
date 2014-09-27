<?php
if( isset($_POST['JDs_save']) ) {

	$JDs_Portfolio_set_db['JDs_columns']    = $_POST['JDs_portfolio_column'];
	$JDs_Portfolio_set_db['JDs_animation'] = $_POST['JDs_portfolio_animation']; 
	$JDs_Portfolio_set_db['JDs_overlay_bg'] = $_POST['JDs_overlay_bg']; ;
	$JDs_Portfolio_set_db['JDs_img_width'] = $_POST['JDs_img_width']; ;
	$JDs_Portfolio_set_db['JDs_img_height'] = $_POST['JDs_img_height']; ;
		
	update_option('JDs_portfolio_option',serialize($JDs_Portfolio_set_db));
}

if( $JDs_Portfolio_get_db = unserialize( get_option( 'JDs_portfolio_option' ) ) ) {
	$JDs_columns = $JDs_Portfolio_get_db['JDs_columns'];
	$JDs_animation = $JDs_Portfolio_get_db['JDs_animation'];
	$JDs_overlay_bg = $JDs_Portfolio_get_db['JDs_overlay_bg'];
	$JDs_img_width = $JDs_Portfolio_get_db['JDs_img_width'];
	$JDs_img_height = $JDs_Portfolio_get_db['JDs_img_height'];
}

?>
<div>
	<h3><i class="fa fa-gears"></i> JDs Portfolio Settings.</h3>
</div>

<div>
<form method="post" enctype="multipart/form-data">
	
    <table class="JDs_admin_setting">
		<tr>
    		<th>Portfolio Columns :</th>
            <td>
            <select name="JDs_portfolio_column">
                <option <?php if( "col-md-6" == $JDs_columns ){ echo "selected"; } ?> value="col-md-6">
                	2 Columns</option>
                <option <?php if( "col-md-4" == $JDs_columns ){ echo "selected"; } ?> value="col-md-4">
                	3 Columns</option>
                <option <?php if( "col-md-3" == $JDs_columns ){ echo "selected"; } ?> value="col-md-3">
                	4 Columns</option>
            </select>
            </td>
    	</tr>
        
        <tr>
    		<th>Image Height/Width :</th>
            <td>
            <input type="text" id="JDs_img_width" name="JDs_img_width" value="<?php echo $JDs_img_width;?>" /> 
            X
           <input type="text" id="JDs_img_height" name="JDs_img_height" value="<?php echo $JDs_img_height;?>"/>
           <small class="JDs_info">(w x h) in px.</small>
            </td>
    	</tr>
        
        <tr>
    		<th>Portfolio Animatiom :</th>
            <td>
            <select name="JDs_portfolio_animation">
            	<option <?php if( "JDs_fade" == $JDs_animation ){ echo "selected"; } ?> value="JDs_fade">
                	Fade</option>
                <option <?php if( "JDs_slide" == $JDs_animation ){ echo "selected"; } ?> value="JDs_slide">
                	Slide</option>
            </select>
            </td>
    	</tr>
        
        <tr>
    		<th>Overlay Background Color :</th>
            <td>
            <select name="JDs_overlay_bg">
            	<option <?php if( "grey" == $JDs_overlay_bg ){ echo "selected"; } ?> value="grey">
                	Grey</option>
                <option <?php if( "blue" == $JDs_overlay_bg ){ echo "selected"; } ?> value="blue">
                	Blue</option>
                <option <?php if( "green" == $JDs_overlay_bg ){ echo "selected"; } ?> value="green">
                	Green</option>
                <option <?php if( "red" == $JDs_overlay_bg ){ echo "selected"; } ?> value="red">
                	Red</option>
                <option <?php if( "purple" == $JDs_overlay_bg ){ echo "selected"; } ?> value="purple">
                	Purple</option>
            </select>
            </td>
    	</tr>
        
	</table>
    <div class="insidebutton">
        <input type="submit" value="Save Changes" class="button-primary" name="JDs_save" id="JDs_save" />
    </div>
</form>
</div>