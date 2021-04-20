// $( function() {
//     $( "#car_modal" ).dialog();
//   } );
function showModal(carTitle, carPlate) {
    //////
    $('#car_details').removeAttr('hidden');
    $("#car_modal").dialog({
        title: carTitle,
        width : 850,
        height: 500,
        resizable: "false",
        modal: "true",
        hide: "fold",
        show: "fold",
        buttons : {
            Update: function() {
                        window.location.href = 'index.php?page=controller_user&op=update&id=' + carPlate;
                    },
            Delete: function() {
                        window.location.href = 'index.php?page=controller_user&op=delete&id=' + carPlate;
                    }
        }// end_Buttons
    }); // end_Dialog
}// end_showModal
function loadmodal() {
    $('#carTable tbody').on('click', 'span', function () {
        var id = this.getAttribute('id');
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: 'module/cars/controller/controller_user.php?op=read&id=' + id,
        }).done(function(jsonCar) {
            $('#car_details').empty();
            $('<table></table>').attr({'id':'car_details_table','class':'table table-hover'}).appendTo('#car_details');
            $('#car_details_table').html(function() {
                for (row in jsonCar) {
                    $('<tr></tr>').attr({'id':row}).appendTo('#car_details_table');
                    $('<td></td>').attr({'id':`${row}index`}).append(document.createTextNode(row)).appendTo('#'+row);
                    $('<td></td>').attr({'id':`${row}content`}).append(document.createTextNode(jsonCar[row])).appendTo('#'+row);
                }

             });
                showModal(carTitle = jsonCar.brand + " " + jsonCar.model, jsonCar.registration);
        }).fail(function( jqXHR, textStatus, errorThrown ) {
            if ( console && console.log ) {
                console.log( "Error name/code: " +  textStatus);
            }
            //window.location.href = 'index.php?page=error503';
        });
    });
};

$(document).ready(function() {
    $('#carTable').DataTable();
    loadmodal();
});