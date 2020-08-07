<!DOCTYPE html>
<html>
    <head>
        <title>Вход</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>

    <body class="bg-dark" id="body">
        <div id="hidden">
            <div class="bg-danger text-white d-flex justify-content-center">
                Система заблокирована. Попробуйте еще раз через&nbsp;
                <p id="timer" ></p>
                &nbsp;секунд.
            </div>
        </div>

        <div class="container">
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-sm-6 col-md-6 col-md-offset-4">
                    <h1 class="text-white text-center">Вход</h1>
                    <div class="bg-secondary rounded-lg p-5" id="loginWindow">
                        <form id="protected" action="userPage" method="post">
                            <div class="form-group">
                                <label for="username" class="text-white">
                                    &nbsp;<b>Имя пользователя:</b>&nbsp;</label>
                                <input type="text" placeholder="Введите имя"
                                       name="username" class="form-control
                                       form-control-lg">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-white mt-2">
                                    &nbsp;<b>Пароль:</b>&nbsp;</label>
                                <input type="password" placeholder=
                                       "Введите пароль" name="password"
                                       class="form-control form-control-lg">
                            </div>
                            <input type="submit" id="submit" name="submit"
                                   class="btn btn-primary btn-lg btn-block mt-4"
                                   value="Войти"></input>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById("hidden").style.display = "none";
            document.getElementById("protected").submit.disabled = 0;

            function blockSystem() {
                document.getElementById("protected").submit.value = "Заблокировано";
                document.getElementById("protected").submit.disabled = 1;
                document.getElementById("hidden").style.display = "block";

                var t = 300;
                countdown(t);
                var stopTimer;
                function countdown(t) {
                    document.getElementById("timer").innerHTML = t;
                    t--;
                    if (t >= 0) {
                        stopTimer = setTimeout(function () {
                            countdown(t);
                        }, 1000);
                    } else {
                        clearTimeout(stopTimer);
                        document.getElementById("protected").submit.disabled = 0;
                        document.getElementById("protected").submit.value = "Войти";
                        document.getElementById("timer").innerHTML = "";
                        document.getElementById("hidden").style.display = "none";
                    }
                }
            }
        </script>
    </body>
</html>