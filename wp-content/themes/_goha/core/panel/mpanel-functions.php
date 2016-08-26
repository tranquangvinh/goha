<?php
function tie_admin_register() {
    global $pagenow;

    wp_register_script( 'tie-admin-slider', get_template_directory_uri() . '/core/panel/js/jquery.ui.slider.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-sortable' ) , false , false );
    wp_register_script( 'tie-admin-main', get_template_directory_uri() . '/core/panel/js/tie.js', array( 'jquery' ) , false , false );


	wp_register_style( 'tie-style', get_template_directory_uri().'/core/panel/style.css', array(), '20120208', 'all' );
	wp_register_style( 'tie-fonts', get_template_directory_uri().'/core/panel/fonts.css', array(), '20120208', 'all' );

	if ( (isset( $_GET['page'] ) && $_GET['page'] == 'panel') || (  $pagenow == 'post-new.php' ) || (  $pagenow == 'post.php' )|| (  $pagenow == 'edit-tags.php' ) ) {
		wp_enqueue_script( 'tie-admin-colorpicker');
		wp_enqueue_script( 'tie-admin-slider' );
	}
	wp_enqueue_script( 'tie-admin-main' );
	wp_enqueue_style( 'tie-style' );
	wp_enqueue_style( 'tie-fonts' );

}
add_action( 'admin_enqueue_scripts', 'tie_admin_register' );


/*-----------------------------------------------------------------------------------*/
# To change Insert into Post Text
/*-----------------------------------------------------------------------------------*/
function tie_options_setup() {
    global $pagenow;

    if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow )
        add_filter( 'gettext', 'tie_replace_thickbox_text'  , 1, 3 );
}
add_action( 'admin_init', 'tie_options_setup' );

function tie_replace_thickbox_text($translated_text, $text, $domain) {
    if ('Insert into Post' == $text) {

        $referer = strpos( wp_get_referer(), 'tie-settings' );
        if ( $referer != '' )
            return __('Use this image', 'tie' );
    }
    return $translated_text;
}

/*-----------------------------------------------------------------------------------*/
# Clean options before store it in DB
/*-----------------------------------------------------------------------------------*/
function tie_clean_options(&$value) {
  $value = htmlspecialchars(stripslashes($value));
}

/*-----------------------------------------------------------------------------------*/
/* ADD EDITOR */
/*-----------------------------------------------------------------------------------*/
function add_aditor() {
     register_setting( 'codex-settings-group', 'intro_home' );
     register_setting( 'codex-settings-group', 'info_content' );
     register_setting( 'codex-settings-group', 'info_footer_mobile' );
     register_setting( 'codex-settings-group', 'session1_content' );
     register_setting( 'codex-settings-group', 'address-footer' );
}
add_action( 'admin_init', 'add_aditor' );

/*-----------------------------------------------------------------------------------*/
# Options Array
/*-----------------------------------------------------------------------------------*/
$array_options =
	array(
		"tie_home_cats",
		"tie_options"
	);


/*-----------------------------------------------------------------------------------*/
# Save Theme Settings
/*-----------------------------------------------------------------------------------*/
function tie_save_settings ( $data , $refresh = 0 ) {
	global $array_options ;

	foreach( $array_options as $option ){
		if( isset( $data[$option] )){
			array_walk_recursive( $data[$option] , 'tie_clean_options');
			update_option( $option ,  $data[$option] );

			if(  function_exists('icl_register_string') && $option == 'tie_home_cats'){
				foreach( $data[$option] as $item ){
					if( !empty($item['boxid']) )
						icl_register_string( theme_name , $item['boxid'], $item['title'] );

					if( !empty($item['type']) && $item['type'] == 'ads' && !empty($item['boxid']) )
						icl_register_string( theme_name , $item['boxid'], $item['text'] );
				}
			}
		}
		elseif( !isset( $data[$option] ) && $option != 'tie_options' ){
			delete_option($option);
		}
	}
	delete_transient('list_tweets');
	delete_transient('twitter_count');
	delete_option('tie_TwitterToken');

	if( $refresh == 2 )  die('2');
	elseif( $refresh == 1 )	die('1');
}


/*-----------------------------------------------------------------------------------*/
# Save Options
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_test_theme_data_save', 'tie_save_ajax');
function tie_save_ajax() {

	check_ajax_referer('test-theme-data', 'security');
	$data = $_POST;
	$refresh = 1;

	if( !empty( $data['tie_import'] ) ){
		$refresh = 2;
		$data = unserialize(base64_decode( $data['tie_import'] ));
	}

	tie_save_settings ($data , $refresh );

}


/*-----------------------------------------------------------------------------------*/
# Add Panel Page
/*-----------------------------------------------------------------------------------*/
function tie_add_admin() {

	$current_page = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : '';

	$icon = get_template_directory_uri().'/core/panel/images/general.png';
	add_menu_page(theme_name.' Settings', theme_name ,'switch_themes', 'panel' , 'panel_options', $icon  );
	$theme_page = add_submenu_page('panel',theme_name.' Settings', theme_name.' Settings','switch_themes', 'panel' , 'panel_options');
    add_submenu_page('panel', "Option Editor" , "Option Editor" ,'switch_themes', 'minh_settings_page' , 'minh_settings_page');


	add_action( 'admin_head-'. $theme_page, 'tie_admin_head' );
	function tie_admin_head(){

	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {

		  jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/core/panel/images/empty.png'});

		  jQuery('form#tie_form').submit(function() {

		  	//Disable Empty options
			  jQuery('form#tie_form input, form#tie_form textarea, form#tie_form select').each(function() {
					if (!jQuery(this).val()) jQuery(this).attr("disabled", true );
			  });
			   jQuery('#typography_test-item input, #typography_test-item select').attr("disabled", true );

			  var data = jQuery(this).serialize();

			//Enable Empty options
			  jQuery('form#tie_form input:disabled, form#tie_form textarea:disabled, form#tie_form select:disabled').attr("disabled", false );

			  jQuery.post(ajaxurl, data, function(response) {
				  if(response == 1) {
					  jQuery('#save-alert').addClass('save-done');
					  t = setTimeout('fade_message()', 1000);
				  }
				else if( response == 2 ){
					location.reload();
				}
				else {
					 jQuery('#save-alert').addClass('save-error');
					  t = setTimeout('fade_message()', 1000);
				  }
			  });
			  return false;
		  });

		});

		function fade_message() {
			jQuery('#save-alert').fadeOut(function() {
				jQuery('#save-alert').removeClass('save-done');
			});
			clearTimeout(t);
		}

		jQuery(function() {
			jQuery( "#cat_sortable" ).sortable({placeholder: "ui-state-highlight"});
			jQuery( "#customList" ).sortable({placeholder: "ui-state-highlight"});
			jQuery( "#tabs_cats" ).sortable({placeholder: "ui-state-highlight"});
		});
	</script>
	<?php
		wp_print_scripts('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		do_action('admin_print_styles');
	}
	if( isset( $_REQUEST['action'] ) ){
		if( 'reset' == $_REQUEST['action']  && $current_page == 'panel' && check_admin_referer('reset-action-code' , 'resetnonce') ) {
			global $default_data;
			tie_save_settings( $default_data );
			header("Location: admin.php?page=panel&reset=true");
			die;
		}
	}
}


/*-----------------------------------------------------------------------------------*/
# Add Options
/*-----------------------------------------------------------------------------------*/
function tie_options($value){
	global $options_fonts;
?>
	<div class="option-item" id="<?php echo $value['id'] ?>-item">
		<span class="label"><?php  echo $value['name']; ?></span>
	<?php
	switch ( $value['type'] ) {

		case 'text': ?>
			<input  name="tie_options[<?php echo $value['id']; ?>]" id="<?php  echo $value['id']; ?>" type="text" value="<?php echo tie_get_option( $value['id'] ); ?>" />
			<?php
				if( $value['id']=="slider_tag" || $value['id']=="breaking_tag"){
				$tags = get_tags('orderby=count&order=desc&number=50'); ?>
				<a style="cursor:pointer" title="Choose from the most used tags" onclick="toggleVisibility('<?php echo $value['id']; ?>_tags');"><img src="<?php echo get_template_directory_uri(); ?>/core/panel/images/expand.png" alt="" /></a>
				<span class="tags-list" id="<?php echo $value['id']; ?>_tags">
					<?php foreach ($tags as $tag){?>
						<a style="cursor:pointer" onclick="if(<?php echo $value['id'] ?>.value != ''){ var sep = ' , '}else{var sep = ''} <?php echo $value['id'] ?>.value=<?php echo $value['id'] ?>.value+sep+(this.rel);" rel="<?php echo $tag->name ?>"><?php echo $tag->name ?></a>
					<?php } ?>
				</span>
			<?php } ?>
		<?php
		break;

		case 'arrayText':  $currentValue = tie_get_option( $value['id'] );?>
			<input  name="tie_options[<?php echo $value['id']; ?>][<?php echo $value['key']; ?>]" id="<?php  echo $value['id']; ?>[<?php echo $value['key']; ?>]" type="text" value="<?php echo $currentValue[$value['key']] ?>" />
		<?php
		break;

		case 'short-text': ?>
			<input style="width:50px" name="tie_options[<?php echo $value['id']; ?>]" id="<?php  echo $value['id']; ?>" type="text" value="<?php echo tie_get_option( $value['id'] ); ?>" />
		<?php
		break;

        case 'checkbox':
            if(tie_get_option($value['id'])){$checked = "checked=\"checked\"";  } else{$checked = "";} ?>
                <input class="on-of" type="checkbox" name="tie_options[<?php echo $value['id'] ?>]" id="<?php echo $value['id'] ?>" value="true" <?php echo $checked; ?> />
        <?php
        break;

		case 'radio':
		?>
			<div style="float:left; width: 295px;">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<label style="display:block; margin-bottom:8px;"><input name="tie_options[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>" type="radio" value="<?php echo $key ?>" <?php if ( tie_get_option( $value['id'] ) == $key) { echo ' checked="checked"' ; } ?>> <?php echo $option; ?></label>
				<?php } ?>
			</div>
		<?php
		break;

		case 'select':
		?>
			<select name="tie_options[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if ( tie_get_option( $value['id'] ) == $key) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		<?php
		break;

		case 'textarea':
		?>
			<textarea style="direction:ltr; text-align:left" name="tie_options[<?php echo $value['id']; ?>]" id="<?php echo $value['id']; ?>" type="textarea" cols="100%" rows="3" tabindex="4"><?php echo tie_get_option( $value['id'] );  ?></textarea>
		<?php
		break;

		case 'upload':
		?>
				<input id="<?php echo $value['id']; ?>" class="img-path" type="text" size="56" style="direction:ltr; text-laign:left" name="tie_options[<?php echo $value['id']; ?>]" value="<?php echo tie_get_option($value['id']); ?>" />
				<input id="upload_<?php echo $value['id']; ?>_button" type="button" class="small_button" value="Upload" />
				<?php if( isset( $value['extra_text'] ) ) : ?><span class="extra-text"><?php echo $value['extra_text'] ?></span><?php endif; ?>

				<div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if(!tie_get_option( $value['id'] )) echo 'style="display:none;"' ?>>
					<img src="<?php if(tie_get_option( $value['id'] )) echo tie_get_option( $value['id'] ); else echo get_template_directory_uri().'/core/panel/images/spacer.png'; ?>" alt="" />
					<a class="del-img" title="Delete"></a>
				</div>
		<?php
		break;

		case 'slider':
		?>
				<div id="<?php echo $value['id']; ?>-slider"></div>
				<input type="text" id="<?php echo $value['id']; ?>" value="<?php echo tie_get_option($value['id']); ?>" name="tie_options[<?php echo $value['id']; ?>]" style="width:50px;" /> <?php echo $value['unit']; ?>
				<script>
				  jQuery(document).ready(function() {
					jQuery("#<?php echo $value['id']; ?>-slider").slider({
						range: "min",
						min: <?php echo $value['min']; ?>,
						max: <?php echo $value['max']; ?>,
						value: <?php if( tie_get_option($value['id']) ) echo tie_get_option($value['id']); else echo 0; ?>,

						slide: function(event, ui) {
						jQuery('#<?php echo $value['id']; ?>').attr('value', ui.value );
						}
					});
				  });
				</script>
		<?php
		break;
	}

	?>
	<?php if( isset( $value['extra_text'] ) && $value['type'] != 'upload' ) : ?><span class="extra-text"><?php echo $value['extra_text'] ?></span><?php endif; ?>
	<?php if( isset( $value['help'] ) ) : ?>
		<a class="mo-help tooltip"  title="<?php echo $value['help'] ?>"></a>
		<?php endif; ?>
	</div>

<?php
}
add_action('admin_menu', 'tie_add_admin');

?>
