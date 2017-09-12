//удаление пользователя
function reroute(el) {
    var name = $(el).closest('tr').find('th:first').text();
    $.ajax({
        url: './user_delete.php',
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
//удаление фото пользователя
function deleteUserPhoto(el){
    var photo = $(el).closest('tr').find('th:first').text(); //первый th
    $.ajax({
        url: './photo_delete.php',
        method: 'POST', //отправляем данные методом пост
        data: {
            photo: photo
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


    //проверка email
    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }


    if (login == 0 || passwd == 0 || passwd_again == 0) {
        alert("Заполните все поля!");
    }
    else if((!isValidEmailAddress(login)))
    {
        alert("Неверный email адрес!");

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
            url: './registration.php',
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
            else if (answer == 0) {
                alert("Вы успешно зарегистрировались, тепер нужно авторизироваться");
                $("#registr_form").trigger('reset');
            }
            else {
                alert("Произошла ошибка, свяжитесь с администратором");
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
            url: './authorization.php',
            method: 'POST', //отправляем данные методом пост
            data: {
                login: login,
                passwd: passwd
            }
        }).done(function (data) {//ответ от формы
            var answer = JSON.parse(data);
            if (answer == 1) {
                //  alert('Вы успешно авторизировались');
                $("#avtor_form").trigger('reset');
                location.reload();
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


$("form[name='uploader']").submit(function(e) {
    var formData = new FormData($(this)[0]); //все данные из формы
    var username = $('input[name=username]').val();
    var birthday = $('input[name=birthday]').val();
    var description = $('input[name=description]').val();

    if (username == 0 || birthday == 0 || description == 0) {
        alert("Заполните все поля!");
    }


    else if( document.getElementById("userfile").files.length == 0 ){ // проверяем инпут с картинкой на пустоту
        alert("Вы забыли загрузить картинку!");
    }
    else {

        $.ajax({
            url: './datasave.php',
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                // alert(msg);
                if (msg == 1 ){
                    alert ("Картинка корректна и была успешно загружена");//сделать по всем данным
                    location.reload();
                }
                if (msg == 2 ){
                    alert ("Картинка не загружена");//сделать по всем данным
                }
                if (msg == 0 ){
                    alert ("Картинка не загружена, попробуйте другой формат");//сделать по всем данным
                }
            },
            error: function (msg) {
                alert("Произошла ошибка!");
                // location.reload();
            },
            cache: false,
            contentType: false,
            processData: false
        });
        e.preventDefault();
    }



});