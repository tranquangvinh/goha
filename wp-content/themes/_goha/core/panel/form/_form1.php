<div id="tab1" class="tabs-wrap">
    <h2>Liên hệ</h2> <?php echo $save ?>
    <div class="tiepanel-item">
        <h3>Liên hệ</h3>
        <?php
            tie_options(array(
            "name" => "Địa chỉ",
            "id" => "dia-chi",
            "type" => "text")); 

            tie_options(array(
            "name" => "Email",
            "id" => "email",
            "type" => "text"));

            tie_options(array(
            "name" => "Phone",
            "id" => "phone",
            "type" => "text")); 

            tie_options(array(
            "name" => "Facebook",
            "id" => "facebook",
            "type" => "text")); 

            tie_options(array(
            "name" => "Twitter",
            "id" => "twitter",
            "type" => "text")); 

            tie_options(array(
            "name" => "Instagram",
            "id" => "instagram",
            "type" => "text")); 

            tie_options(array(
            "name" => "Linkedin",
            "id" => "linkedin",
            "type" => "text")); 
        ?>
    </div>
</div>