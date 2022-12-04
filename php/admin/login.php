<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/core.css">
    <title>Logowanie do panelu administracyjnego</title>
</head>

<body class="userTheme">
    <main class="userPage">
        <div class="container">
            <section class="userForm">
                <form action="../includes/admin/login.inc.php" method="POST">
                    <h1>Logowanie do panelu admina</h1>
                    <input type="text" name="admin_login" placeholder="Email lub nazwa uzytkownika">
                    <input type="password" name="password" placeholder="Wprowadź hasło" style="margin-bottom: 20px">
                    <button type="submit" name="submit">Login</button>

                    <span class="errorMessage">
                        <?php
                        if (isset($_GET["error"])) :
                            if ($_GET["error"] == "empty_fields") {
                                echo 'Podaj poprawny login i hasło aby zalogować się do konta';
                            } else if ($_GET["error"] == "invalid_credentials") {
                                echo 'Niepoprawne dane logowanie...';
                            } else if ($_GET["error"] == "statement_failed") {
                                echo 'Ups... coś poszło nie tak.';
                            }
                        endif;
                        ?>
                    </span>
                </form>
            </section>
        </div>
    </main>
</body>

</html>