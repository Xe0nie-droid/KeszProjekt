-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Jan 11. 22:11
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `report`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `report`
--

CREATE TABLE `report` (
  `targy_neve` varchar(40) DEFAULT NULL,
  `tanar_neve` varchar(30) DEFAULT NULL,
  `hiba` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `report`
--

INSERT INTO `report` (`targy_neve`, `tanar_neve`, `hiba`, `id`) VALUES
('Laptop', 'Stella', 'Trojai virus', 1),
('Printer', 'Richard', 'Kigyulladt', 2),
('Switch', 'Kreisz-RG', 'Felrobbant', 3),
('asd', 'asd', 'asd', 4),
('Projektor', 'Stella_S', 'Leejtette', 5);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
