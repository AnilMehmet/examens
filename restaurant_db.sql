-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 jan 2021 om 00:02
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `id` int(11) NOT NULL,
  `reservering_id` int(11) NOT NULL,
  `menuitem_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `geserveerd` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerechtcategorien`
--

CREATE TABLE `gerechtcategorien` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `naam` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `gerechtcategorien`
--

INSERT INTO `gerechtcategorien` (`id`, `code`, `naam`) VALUES
(1, 'dra', 'Dranken'),
(2, 'hoo', 'Hoofdgerechten');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerechtsoorten`
--

CREATE TABLE `gerechtsoorten` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `naam` varchar(20) NOT NULL,
  `gerechtcategorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `gerechtsoorten`
--

INSERT INTO `gerechtsoorten` (`id`, `code`, `naam`, `gerechtcategorie_id`) VALUES
(1, 'Kdr', 'Koude_dranken', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `id` int(11) NOT NULL,
  `naam` varchar(20) NOT NULL,
  `telefoon` varchar(11) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`id`, `naam`, `telefoon`, `email`) VALUES
(1, 'hass', '06504503', 'nansf@gmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menuitems`
--

CREATE TABLE `menuitems` (
  `id` int(11) NOT NULL,
  `code` varchar(4) NOT NULL,
  `naam` varchar(30) NOT NULL,
  `gerechtsoort_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `menuitems`
--

INSERT INTO `menuitems` (`id`, `code`, `naam`, `gerechtsoort_id`) VALUES
(1, 'Cola', 'Cola', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservering`
--

CREATE TABLE `reservering` (
  `ID` int(11) NOT NULL,
  `Tafel` int(11) NOT NULL,
  `Datum` date NOT NULL,
  `Tijd` time NOT NULL,
  `Klant_ID` int(11) NOT NULL,
  `Aantal` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `Datum_toegevoegd` timestamp NOT NULL DEFAULT current_timestamp(),
  `Aantal_k` int(11) NOT NULL DEFAULT 0,
  `Allergieen` varchar(255) NOT NULL,
  `Opmerking` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `reservering`
--

INSERT INTO `reservering` (`ID`, `Tafel`, `Datum`, `Tijd`, `Klant_ID`, `Aantal`, `Status`, `Datum_toegevoegd`, `Aantal_k`, `Allergieen`, `Opmerking`) VALUES
(37, 1, '2021-01-16', '11:11:00', 1, 2, 1, '2021-01-14 18:16:11', 2, '', ''),
(42, 249, '2021-01-16', '18:00:00', 1, 2, 1, '2021-01-14 21:52:27', 2, '', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menuitem_id` (`menuitem_id`),
  ADD KEY `reservering_id` (`reservering_id`);

--
-- Indexen voor tabel `gerechtcategorien`
--
ALTER TABLE `gerechtcategorien`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerechtcategorie_id` (`gerechtcategorie_id`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerechtsoort_id` (`gerechtsoort_id`);

--
-- Indexen voor tabel `reservering`
--
ALTER TABLE `reservering`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `datum` (`Datum`,`Tijd`),
  ADD UNIQUE KEY `datum_2` (`Datum`,`Tijd`),
  ADD KEY `reserveringen_ibfk_1` (`Klant_ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gerechtcategorien`
--
ALTER TABLE `gerechtcategorien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `reservering`
--
ALTER TABLE `reservering`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`menuitem_id`) REFERENCES `menuitems` (`id`),
  ADD CONSTRAINT `bestellingen_ibfk_2` FOREIGN KEY (`reservering_id`) REFERENCES `reservering` (`id`);

--
-- Beperkingen voor tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  ADD CONSTRAINT `gerechtsoorten_ibfk_1` FOREIGN KEY (`gerechtcategorie_id`) REFERENCES `gerechtcategorien` (`id`);

--
-- Beperkingen voor tabel `menuitems`
--
ALTER TABLE `menuitems`
  ADD CONSTRAINT `menuitems_ibfk_1` FOREIGN KEY (`gerechtsoort_id`) REFERENCES `gerechtsoorten` (`id`);

--
-- Beperkingen voor tabel `reservering`
--
ALTER TABLE `reservering`
  ADD CONSTRAINT `reservering_ibfk_1` FOREIGN KEY (`klant_id`) REFERENCES `klanten` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
