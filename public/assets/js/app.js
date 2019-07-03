

/* hide error messages */
$('#error-message').delay(2000).fadeOut('slow');

// generate random password
$('#btn-password').click(
    function(){
        
        let chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let pass = '';
        let num_chars = 12;

        for(let i=0; i < num_chars; i++){
            pass += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        $('input[name=text_password]').val(pass);
        $('input[name=text_password_repetir]').val(pass);
    }
);

$('#btn-limpar').click(
    function(){
        $('input[name=text_password]').val('');
        $('input[name=text_password_repetir]').val('');
    }
);