function refreshNotes(idOrder)
{
    $.ajax({
        url: '../notes/' + idOrder + '/getAll',
        method: 'GET',
        success: function(returnData) {
            $('#note_container').html(returnData);
        }
    });
}

function openNoteWindow(idOrder)
{
    refreshNotes(idOrder);
    $('#idOrder').val(idOrder);
    $('#noteWindow').modal('show');
}

function addNote()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let  noteText = $('#noteText').val();
    $.ajax({
        url: '../notes/' + idOrder + '/addNote',
        method: 'POST',
        data: {
            noteText: noteText,
            idOrder: $('#idOrder').val()
        },
        success: function() {
            $('#noteText').val('');
            refreshNotes($('#idOrder').val());
        }
    });
}
