

$('#registration_button').on('click', function (e) {

    var login = $('input[name=inputEmail3]').val();
   var passwd = $('input[name=inputPassword3]').val();
   var passwd_again = $('input[name=inputPassword4]').val();

    if (login==0 || passwd==0 || passwd_again==0){
        alert("Заполните все поля!");
    }

    else if (login.length<5){
        alert("Логин слишком короткий!");
    }
    else if (passwd.length<8){
        alert("Пароль слишком короткий!");
    }
    else if (passwd!=passwd_again){
        alert("Пароли не совпадают!");
    }


    else {
        $.ajax({
            url: '/starter-template/form-handler.php',
            method: 'POST', //отправляем данные методом пост
            data: {
                login: login,
                passwd : passwd
            }
        }).done(function (data) {
            $("#registr_form").trigger('reset');
        });

        //очистили форму

    }

});