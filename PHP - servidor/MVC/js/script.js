function submitForm() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;

    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: {
            action: 'insertData',
            name: name,
            email: email
        },
        success: function (response) {
            $('#result').html(response);
        }
    });
}





