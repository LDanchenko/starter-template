//удаление пользователя
function reroute(el) {
    var name = $(el).closest('tr').find('th:first').text();
    $.ajax({
        url: '/starter-template/user_delete.php',
        method: 'POST', //отправляем данные методом пост
        data: {
            login: name
        }
    }).done(function (data) {//ответ от формы
      //  var answer = JSON.parse(data);
       // console.log(answer);
        location.reload();
    });
}
//регистрация

$('#registration_button').on('click', function (e) {

    var login = $('input[name=inputEmail3]').val();
    var passwd = $('input[name=inputPassword3]').val();
    var passwd_again = $('input[name=inputPassword4]').val();

    if (login == 0 || passwd == 0 || passwd_again == 0) {
        alert("Заполните все поля!");
    }

    else if (login.length < 5) {
        alert("Логин слишком короткий!");
    }
    else if (passwd.length < 8) {
        alert("Пароль слишком короткий!");
    }
    else if (passwd != passwd_again) {
        alert("Пароли не совпадают!");
    }


    else {
        $.ajax({
            url: '/starter-template/registration.php',
            method: 'POST', //отправляем данные методом пост
            data: {
                login: login,
                passwd: passwd
            }
        }).done(function (data) {//ответ от формы
            var answer = JSON.parse(data);
            if (answer == 1) {
                alert('Такой пользователь уже есть, пожалуйста, выберите другой логин');
                $("#registr_form").trigger('reset');
            }
            else {
                alert("Вы успешно зарегистрировались, тепер нужно авторизироваться");
                $("#registr_form").trigger('reset');
            }
        });
    }
});
//авторизация
$('#avtorization_button').on('click', function (e) {

    var login = $('input[name=inputEmail3]').val();
    var passwd = $('input[name=inputPassword3]').val();

    if (login == 0 || passwd == 0) {
        alert("Заполните все поля!");
    }

    else if (login.length < 5) {
        alert("Логин слишком короткий!");
    }
    else if (passwd.length < 8) {
        alert("Пароль слишком короткий!");
    }

    else {
        $.ajax({
            url: '/starter-template/authorization.php',
            method: 'POST', //отправляем данные методом пост
            data: {
                login: login,
                passwd: passwd
            }
        }).done(function (data) {//ответ от формы
            var answer = JSON.parse(data);
            if (answer == 1) {
                alert('Вы успешно авторизировались');
                $("#avtor_form").trigger('reset');
            }
            else if (answer == 0) {
                alert("Такого пользователя нет!");
                $("#avtor_form").trigger('reset');
            }
            else {
                alert("Пароль неверный!");
            }
        });
    }
});


//сохранение данных о себе

$('#save').on('click', function (e) {
    var username = $('input[name=username]').val();
    var birthday = $('input[name=birthday]').val();
    var description = $('input[name=description]').val();

    if ( username == 0 || birthday == 0 || description == 0) {
        alert("Заполните все поля!");
    }

//проверки данных

    else {
        $.ajax({
            url: '/starter-template/datasave.php',
            method: 'POST', //отправляем данные методом пост
            data: {
                username: username,
                birthday: birthday,
                description: description
            }
        }).done(function (data) {//ответ от формы
                //проверки
            location.reload()

        });
    }
});
