<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/reset.css">
    <link rel="stylesheet" href="../CSS/core.css">
    <title>Logowanie</title>
</head>

<body class="userTheme">
    <main class="userPage">
        <div class="container">
            <section class="userForm">
                <form action="../includes/customer/login.inc.php" method="POST">
                    <h1>Logowanie do panelu klienta</h1>
                    <input type="text" name="customer_login" placeholder="Email lub numer telefonu">
                    <input type="password" name="password" placeholder="Wprowadź hasło">
                    <span class="registerLink">nie posiadzasz jeszcze konta? <a href="register.php">zarejestruj się</a></span>
                    <button type="submit" name="submit">Login</button>

                    <span class="errorMessage">
                        <?php
                        //obsługa błędów jesli zmienna superglobalna zwraca 'error' to wykonuje ifa, zaleznie od tego co ta zmienna zawiera w tablicy
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
