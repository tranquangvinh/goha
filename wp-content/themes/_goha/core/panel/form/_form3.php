<div id="tab3" class="tabs-wrap">
    <h2>Trang liên hệ</h2> <?php echo $save ?>
    <div class="tiepanel-item">
        <h3>bản đồ</h3>
        <?php
            tie_options(array(
            "name" => "Bản đồ",
            "id" => "ban-do",
            "type" => "textarea"));

            tie_options(array(
            "name" => "Sub Title",
            "id" => "subTitle",
            "type" => "textarea"));

            tie_options(array(
            "name" => "Title",
            "id" => "map-title",
            "type" => "textarea"));

            tie_options(array(
            "name" => "Link liên hệ",
            "id" => "link-lien-he",
            "type" => "textarea"));

            tie_options(array(
            "name" => "Text link liên hệ",
            "id" => "text-link-lien-he",
            "type" => "textarea"));
        ?>
    </div>
</div>