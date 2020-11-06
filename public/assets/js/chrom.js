$(function(){
    $('#condi').show(); 
    $('#condi').hide(); 

$(document).ready(function(){
    $('#activite').change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr('value');
            if(optionValue == "autre"){
                $('#condi').show(); 
                $('#condi').hide(); 
            }else{
                $('#condi').hide();
                $('#condi').show();  
            }
        })
    })
})
})