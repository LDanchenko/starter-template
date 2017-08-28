<?php
require_once ("config.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.html">Авторизация</a></li>
            <li><a href="reg.html">Регистрация</a></li>
            <li><a href="list.php">Список пользователей</a></li>
            <li><a href="filelist.php">Список файлов</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
    <h1>Запретная зона, доступ только авторизированному пользователю</h1>
        <?php

        if(isset($_SESSION['userid'])) {
            $stmt = $mysqli->stmt_init(); //начало подготовки запроса
            $stmt->prepare('SELECT users.login, users.username, users.age, users.description, users.photo
 FROM users'); //подготовка запроса
            $stmt->execute();//выполняем
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC); //для получения асоциативного массива
            echo "пользователь авторизован";
        }
        ?>
      <h2>Информация выводится из базы данных</h2>
      <table class="table table-bordered" id = "2">
        <tr>
          <th>Пользователь(логин)</th>
          <th>Имя</th>
          <th>возраст</th>
          <th>описание</th>
          <th>Фотография</th>
          <th>Действия</th>
        </tr>
          <?php
          if(isset($_SESSION['userid'])) {
              foreach ($data as $arr => $massiv) {
                  echo '<tr>';
                  foreach ($massiv as $inner_key => $value) {

                      echo '<th>' . $value . '</th>';
                  }
                  echo '<th>';
                  echo '<button class="btn btn-default" onclick="reroute(this)">Удалить пользователя</button>';
                  echo ' </th>';
                  echo '</tr>';
              }
          }

          ?>


      </table>
<?php

if(isset($_SESSION['userid'])) {
    echo '


        <div class="col-sm-offset-2 col-sm-10">

            <br>
            Расскажите о себе
            <br><br>
        </div>

    <form class="form-horizontal" action="" id="information_form" action="" onsubmit="return false;">
        <div class="form-group">
            <label  class="col-sm-2 control-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="username" >
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">День рождения</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="birthday" id="birthday" >
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">Описание</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="description" id="description" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="save" class="btn btn-default">Сохранить</button>

            </div>
        </div>
    </form>';
}
    ?>
    </div><!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/main4.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
    <script>
        webshims.setOptions('forms-ext', {types: 'date'});
        webshims.polyfill('forms forms-ext');
    </script>
  </body>
</html>
