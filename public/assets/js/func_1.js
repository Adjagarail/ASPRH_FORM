/*  Wizard */
jQuery(function($) {
    "use strict";
    
    $('form#wrapped').attr('action', 'send_email_1.php');

    $("#wizard_container").wizard({
        stepsWrapper: "#wrapped",
        submit: ".submit",
        unidirectional: false,
        beforeSelect: function(event, state) {
            if ($('input#website').val().length != 0) {
                return false;
            }
            if (!state.isMovingForward)
                return true;
            var inputs = $(this).wizard('state').step.find(':input');
            return !inputs.length || !!inputs.valid();
        }
    }).validate({
        errorPlacement: function(error, element) {
            if (element.is(':radio') || element.is(':checkbox')){
                error.insertBefore(element.next());
            } else {
                error.insertAfter(element);
            }
        }
    });
    //  progress bar
    $("#progressbar").progressbar();
    $("#wizard_container").wizard({
        afterSelect: function(event, state) {
            $("#progressbar").progressbar("value", state.percentComplete);
            $("#location").text("" + state.stepsComplete + " sur " + state.stepsPossible + " complet");
        }
    });
});

$("#wizard_container").wizard({
    transitions: {
        branchtype: function($step, action) {
            var branch = $step.find(":checked").val();
            if (!branch) {
                $("form").valid();
            }
            return branch;
        }
    }
});

// Input name and email value
function getVals(formControl, controlType) {
    switch (controlType) {

        case 'structure_Nom_field':
            // Get the value for input
            var value = $(formControl).val();
            $("#structure_Nom_field").text(value);
            break;
        
        case 'structure_PrenomNomReferent_field':
            //Get the value for input
            var value = $(formControl).val();
            $("#structure_PrenomNomReferent_field").text(value);
            break;

        case 'structure_FonctionReferent_field':
            //Get the value for input
            var value = $(formControl).val();
            $("#structure_FonctionReferent_field").text(value);
            break;

        case 'structure_Telephone_field':
            //Get the value for input
            var value = $(formControl).val();
            $("#structure_Telephone_field").text(value);
            break;

        case 'structure_Email_field':
            //Get the value for input
            var value = $(formControl).val();
            $("#structure_Email_field").text(value);
            break;



    }
}