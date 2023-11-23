function like(auth, comment, user) {
    if (auth) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/enviar-like',
            method: 'POST',
            data: 'comentario=' + comment + '&user=' + user,
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                alert(response);
            }
        });
    } else {
        window.location.href = "/login/github";
    }
}

function dislike() {
    //
}