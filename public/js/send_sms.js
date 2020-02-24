function sendSms(idOrder) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if (confirm("Czy wysłać sms'a?"))
    $.ajax({
        url: '../sms/send',
        method: 'POST',
        data: {
            idOrder: idOrder,
        },
        success: function(data) {
            response = JSON.parse(data);
            if (response.count > 0) { alert("Sms został wysłany"); }
            else { alert("Błąd numer " + response.error + ". " + response.message); }
        }
    });
}
