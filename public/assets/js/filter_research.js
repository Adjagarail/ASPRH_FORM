function filterColumn ( i ) {
    $('#tabe').DataTable().column( i ).search(
        $('#col'+i+'_filter').val(),
    ).draw();
}
 
$(document).ready(function() {
    $('#tabe').DataTable({
        retrieve: true,
        paging: false,
        searching: false
    });
 
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
} );