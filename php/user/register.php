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
                <form action="../includes/customer/register.inc.php" method="POST">
                    <h1>Zarejestruj konto</h1>
                    <input type="text" name="name" placeholder="Imię" required>
                    <input type="text" name="surname" placeholder="Nazwisko" required>
                    <input type="tel" name="phone" placeholder="Numer telefonu" required>
                    <input type="email" name="email" placeholder="Podaj adres email" required>
                    <input type="password" name="password" placeholder="hasło" required>
                    <input type="password" name="password_repeat" placeholder="powtórz hasło" required>
                    <span class="registerLink">masz juz konto? <a href="login.php">zaloguj się</a></span>
                    <button type="submit" name="submit">Zarejetruj</button>

                    <span class="errorMessage">
                        <?php   //obsługa błędów jesli zmienna superglobalna zwraca 'error' to wykonuje ifa, zaleznie od tego co ta zmienna zawiera w tablicy
                        if (isset($_GET["error"])) :
                            if ($_GET["error"] == "empty_fields") {
                                echo 'Podaj poprawny login i hasło aby zalogować się do konta';
                            } else if ($_GET["error"] == "invalid_phoneNumber") {
                                echo 'Wpisz poprawny numer telefonu';
                            } else if ($_GET["error"] == "invalid_email") {
                                echo 'Wpisz poprawny adres email';
                            } else if ($_GET["error"] == "passwords_are_different") {
                                echo 'Hasła muszą być identyczne';
                            } else if ($_GET["error"] == "account_already_exist") {
                                echo 'Konto z tym emailem lub numerem telfonu juz istnieje';
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
