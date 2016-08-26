<div id="tab2" class="tabs-wrap">
    <h2>Sidebar</h2> <?php echo $save ?>
    <div class="tiepanel-item">
        <h3>Sidebar Top</h3>
        <?php
            tie_options(array(
            "name" => "imgSidebar",
            "id" => "imgSidebar",
            "type" => "upload"));

            tie_options(array(
            "name" => "Title Sidebar",
            "id" => "titleSidebar",
            "type" => "text")); 

            tie_options(array(
            "name" => "Content Sidebar ",
            "id" => "contentSidebar",
            "type" => "textarea")); 

            tie_options(array(
            "name" => "Text link Sidebar ",
            "id" => "txlSidebar",
            "type" => "textarea"));   
        ?>
        <h3>Sidebar bottom</h3>
        <?php
            tie_options(array(
            "name" => "Img Banner Sidebar",
            "id" => "imgbnSidebar",
            "type" => "upload"));
        ?>
    </div>
</div>