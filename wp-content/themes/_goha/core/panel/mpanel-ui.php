<?php
function panel_options() {

	$categories_obj = get_categories('hide_empty=0');
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}

	$sliders = array();
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$sliders[get_the_ID()] = get_the_title();
	}

    $menus = get_terms('nav_menu', array());
    $listMenu = array();
    foreach($menus as $menu){
      $listMenu[$menu->term_id] = $menu->name;
    }

$save='
	<div class="mpanel-submit">
		<input type="hidden" name="action" value="test_theme_data_save" />
        <input type="hidden" name="security" value="'. wp_create_nonce("test-theme-data").'" />
		<input name="save" class="mpanel-save" type="submit" value="Save Changes" />
	</div>';
?>


<div id="save-alert"></div>

<div class="mo-panel">

	<div class="mo-panel-tabs">
		<div class="logo"></div>
		<ul>
            <li class="tie-tabs general"><a href="#tab0"><span></span>Footer</a></li> 
            <li class="tie-tabs general"><a href="#tab1"><span></span>Liên hệ</a></li> 
            <li class="tie-tabs general"><a href="#tab2"><span></span>Sidebar</a></li> 
            <li class="tie-tabs general"><a href="#tab3"><span></span>Trang liên hệ</a></li> 
		</ul>
		<div class="clear"></div>
	</div> <!-- .mo-panel-tabs -->


	<div class="mo-panel-content">
        <form action="/" name="tie_form" id="tie_form">
            <?php include 'form/_form0.php'; ?>
            <?php include 'form/_form1.php'; ?>
            <?php include 'form/_form2.php'; ?>
            <?php include 'form/_form3.php'; ?>
            <div class="mo-footer"><?php echo $save; ?></div>
        </form>

        <form method="post">
            <div class="mpanel-reset">
                <input type="hidden" name="resetnonce" value="<?php echo wp_create_nonce('reset-action-code'); ?>" />
                <input name="reset" class="mpanel-reset-button" type="submit" onClick="if(confirm('All settings will be rest .. Are you sure ?')) return true ; else return false; " value="Reset All Settings" />
                <input type="hidden" name="action" value="reset" />
            </div>
        </form>

	</div><!-- .mo-panel-content -->
	<div class="clear"></div>
</div><!-- .mo-panel -->
<?php
}
?>
