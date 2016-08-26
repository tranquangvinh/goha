<div id="tab0" class="tabs-wrap">
    <h2>Footer</h2> <?php echo $save ?>
    <div class="tiepanel-item">
    	<h3>Footer Top</h3>
        <?php
        tie_options(array(
            "name" => "footerImg",
            "id" => "footerImg",
            "type" => "upload"));

         
        tie_options(array(
        	'name' => 'Title',
        	'id' => 'title',
        	'type' => 'text',
        ));
         
        tie_options(array(
        	'name' => 'FooterLink',
        	'id' => 'footerLink',
        	'type' => 'text',
        ));
        
        tie_options(array(
        	'name' => 'FooterTextLink',
        	'id' => 'footerTextLink',
        	'type' => 'text',
        ));
        ?>

        <h3>Footer Bottom</h3>

        <?php 
        tie_options(array(
        	'name' => 'Content',
        	'id' => 'content',
        	'type' => 'textarea',
        ));

        tie_options(array(
        	'name' => 'Title bottom',
        	'id' => 'title-bottom',
        	'type' => 'text',
        ));

        tie_options(array(
        	'name' => 'mô tả',
        	'id' => 'mo-ta',
        	'type' => 'textarea',
        ));
        ?>
    </div>
</div>