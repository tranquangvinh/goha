<?php
function minh_settings_page() {
	$save = '<div class="mpanel-submit">
		<input name="save" class="mpanel-save" type="submit" value="Save Changes" />
	</div>';
	?>
	<div class="mo-panel">

		<div class="mo-panel-tabs">
			<div class="logo"></div>
			<ul>
				<li class="tie-tabs info"><a href="#info"><span></span>Footer desktop</a></li>
			</ul>
			<div class="clear"></div>
		</div> <!-- .mo-panel-tabs -->
		<div class="mo-panel-content">
			<form method="post" action="options.php">
			    <?php settings_fields( 'codex-settings-group' ); ?>

			   <div id="info" class="tabs-wrap">
			        <h2>Nội dung Footer</h2>
                    <div class="tiepanel-item">
   						<h3>Nội dung </h3>
   						<div class="option-item">
   							<?php if ( function_exists( 'wp_editor' ) ): ?>
   					    		<?php wp_editor( get_option('info_footer'), 'info_footer' ) ?>
   					        	<?php else: ?>
   					        		<textarea rows="10" cols="60" id="info_footer" name="info_footer"><?php echo get_option('info_footer'); ?></textarea>
   					        	<?php endif; ?>
   							<?php echo $save; ?>
   						</div>
   					</div><!-- end one item -->

                    <h2>Thông tin chi tiết</h2>
                    <div class="tiepanel-item">
                        <h3>Nội dung </h3>
                        <div class="option-item">
                            <?php if ( function_exists( 'wp_editor' ) ): ?>
                                <?php wp_editor( get_option('info_content'), 'info_content' ) ?>
                                <?php else: ?>
                                    <textarea rows="10" cols="60" id="info_content" name="info_content">
                                        <?php echo get_option('info_content'); ?>
                                    </textarea>
                                <?php endif; ?>
                            <?php echo $save; ?>
                        </div>
                    </div><!-- end one item -->

                    <h2>ND Footer Mobile</h2>
                    <div class="tiepanel-item">
                        <h3>Nội dung </h3>
                        <div class="option-item">
                            <?php if ( function_exists( 'wp_editor' ) ): ?>
                                <?php wp_editor( get_option('info_footer_mobile'), 'info_footer_mobile' ) ?>
                                <?php else: ?>
                                    <textarea rows="10" cols="60" id="info_footer_mobile" name="info_footer_mobile"><?php echo get_option('info_footer_mobile'); ?></textarea>
                                <?php endif; ?>
                            <?php echo $save; ?>
                        </div>
                    </div><!-- end one item -->
                </div>

			</form>
		</div><!-- .mo-panel-tabs -->
</div>
<?php }
?>
