<html>
    <head>
        <title>User page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>
    <body class="bg-dark">
        <div class="container d-flex justify-content-center">

            <div class="d-inline-flex flex-column justify-content-center bg-secondary
                 rounded-lg mt-5 p-5">
                <h1 class="text-center text-white font-weight-bold">Добрый день,
                    <?php echo $userName; ?>!<br></h1>
                <form action="logout" method="post">
                    <button type="submit" class="btn btn-primary
                            btn-lg btn-block mt-5">Выйти</button>
                </form>
            </div>
        </div>
    </body>
</html>

