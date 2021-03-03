var $ = jQuery;

$(document).ready(function(){
    $('.nl-link').click(function(){ 
        $('#listmodal').arcticmodal() 
      })
    // $('.sel2').select2({
    //     minimumResultsForSearch: Infinity,
    // });
    if($(".checkbox").length > 0 || $(".radio").length > 0){
        checks();
        $(".checkbox input[type='checkbox'], .radio input[type='radio']").change(function(){
            checks();
        });
    }

});
function checks(){
    $(".checkbox input[type='checkbox'], .radio input[type='radio']").each(function(){
        if($(this).is(':checked')){
            $(this).closest('label').addClass('checked');
        }
        else {
            $(this).closest('label').removeClass('checked');
        }
    });
}


