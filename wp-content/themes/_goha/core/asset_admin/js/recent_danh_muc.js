jQuery(document).ready(function($){
    $('.open-list-sub').on('click', function(){
        $(this).next('.children').slideToggle();
    })
})
