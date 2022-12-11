<?php

session_start();
//sprawdzenie czy metoda POST zwraca dane (nie jest pusta)
if (!empty($_POST)) {
    $customerID = $_SESSION["customerID"]; //przypisywanie id klienta ze zmiennej globalnej $_SESSION, czyli przypisuje aktualnie zalogowaną osobę
    //pobranie danych z formularza i przypisanie do zmiennej
    $item_id = $_POST['item']; 
    $termin = $_POST['date'];
    $days = $_POST['days'];
    $hours = $_POST['hours'];

    echo $_SESSION["customerID"];
    //sprawdzenie czy wybrane daty przy skladaniu zamowienia nie sa starsze niz teraz i okres wypozyczenia jest wiekszy niz 14 dni
    $today = date('Y-m-d');
    $end_date = date('Y-m-d', strtotime($today . '+ 13 days'));
    if ($termin < $today || $termin > $end_date) {
        die('Niepoprawna data!');
    }
    if ($days < 1 || $days > 13) {
        die('Niepoprawna liczba dni!');
    }
    if ($hours < 0 || $hours > 23) {
        die('niepoprawna liczba godzin!');
    }

    require('functions.php'); 
    reservation($customerID, $item_id, $termin, $days, $hours);
}
