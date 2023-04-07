<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма регистрации</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Форма регистрации</h1>
    <form>
      <input id="login" name="login" placeholder="Логин" class="form-control"><br>
      <input type="password" id="password" name="password" placeholder="Пароль" class="form-control"><br>
      <button type="submit" id="register" class="btn btn-outline-success">Регистрация</button>
    </form>
    <div id="errorMess" class="text-danger"></div>
    <label>Уже зарегистрированы?</label><a href="login.php">Войти</a>
  </div>
  <script
          src="https://code.jquery.com/jquery-3.6.0.min.js"
          integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
          crossorigin="anonymous"></script>
  <script>
      $(".btn-outline-success").click(function(e) {
          e.preventDefault();
          let login = $("#login").val().trim();
          let password = $("#password").val().trim();
          if(login == ""){
              $("#errorMess").text("Введите логин");
              return false;
          } else if(password == ""){
              $("#errorMess").text("Введите пароль");
              return false;
          }

          $.ajax({
              type: 'POST',
              url: '../php/checkReg.php',
              dataType: 'json',
              data: {
                  login: login,
                  password: password,
              },
              success: function(data){
                  if(data.authorized == true){
                      $("#errorMess").text("Пользователь существует");
                  } else {
                      document.location.href = "../login.php";
                  }
              },
          });

          $("#login").removeClass("text-danger");
          $("#errorMess").text("");

      });
  </script>
</body>
</html>
