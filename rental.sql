-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Gru 2022, 23:08
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `rental`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admins`
--

CREATE TABLE `admins` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(128) NOT NULL,
  `adminEmail` varchar(128) NOT NULL,
  `adminPassword` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `admins`
--

INSERT INTO `admins` (`adminId`, `adminName`, `adminEmail`, `adminPassword`) VALUES
(2, 'dev_kryu', 'dev.halas@gmail.com', '$2y$10$eCHRHkGiFpWjPVJPqeFpz.wPltBg/96o5K.8uN9.nIMgPgC3xTYde'),
(3, 'Norbert', 'goscinski.it@gmail.com', '$2y$10$2N4Gx17rf6JikvSJ/saQY.i4pPaHI0pN.KPtZjCuNi/ca1fm.8ZeO'),
(4, 'admin', 'admin@admin.com', '$2y$10$GQLU2uBA0ZJE2VCFgt.jzO52g9WFyU4Bca1SLA1vbD4h20HC8YgOy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `customerName` varchar(128) NOT NULL,
  `customerSurname` varchar(128) NOT NULL,
  `customerEmail` varchar(128) NOT NULL,
  `customerPhone` varchar(128) NOT NULL,
  `customerPassword` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `customers`
--

INSERT INTO `customers` (`customerID`, `customerName`, `customerSurname`, `customerEmail`, `customerPhone`, `customerPassword`) VALUES
(10, 'Krystian', 'Hałas', 'elkris2611@gmail.com', '783200222', '$2y$10$yS3mJTREemo3Ny.yf6P7u.2ompS4TiLNx0i/JYb4cj5eFQ0e9ajAK');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `type` varchar(150) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `photo_url` varchar(250) COLLATE utf8_bin NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `items`
--

INSERT INTO `items` (`id`, `name`, `type`, `price`, `photo_url`, `available`) VALUES
(1, 'Playstation 4', 'Konsola stacjonarna', 5, 'ps4.jpg', 1),
(2, 'Playstation 5', 'Konsola stacjonarna', 8, 'ps5.jpeg', 1),
(3, 'Xbox One', 'Konsola stacjonarna', 4, 'xboxo.jpg', 1),
(4, 'Xbox Series S', 'Konsola stacjonarna', 5, 'xboxxs.jpeg', 1),
(5, 'Xbox Series X', 'Konsola stacjonarna', 7, 'xboxx.jpg', 1),
(6, 'Nintendo Switch', 'Konsola przenośna', 4, 'nintendos.jpg', 1),
(7, 'Nintendo Switch OLED', 'Konsola przenośna', 5, 'nintendoo.jpeg', 1),
(8, 'Steam Deck', 'Konsola przenośna', 9, 'steamdeck.jpg', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `from_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `to_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminId`);

--
-- Indeksy dla tabeli `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indeksy dla tabeli `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`item_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admins`
--
ALTER TABLE `admins`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
