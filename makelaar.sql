-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 08 dec 2020 om 11:09
-- Serverversie: 10.1.40-MariaDB
-- PHP-versie: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makelaar`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

CREATE TABLE `gebruiker` (
  `naam` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `email` varchar(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `straatnaam` varchar(255) NOT NULL,
  `huisnummer` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `telefoonnummer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`email`, `naam`, `straatnaam`, `huisnummer`, `postcode`, `telefoonnummer`) VALUES
('hdjhdjdj', 'fsffsf', 'oooo', 'jjdfdf', 'dffd', 'dfdfdf'),
('renevankeulen@me.com', 'René v Keulen', 'Testy van teststraat', '20', '5248DO', '062394944');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pand`
--

CREATE TABLE `pand` (
  `straatnaam` varchar(255) NOT NULL,
  `huisnummer` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `gemeente` varchar(255) NOT NULL,
  `vierkantemeters` varchar(255) NOT NULL,
  `Nkamers` varchar(255) NOT NULL,
  `Nbadkamers` varchar(255) NOT NULL,
  `waarde_euros` varchar(255) NOT NULL,
  `eigenaar_email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `pand`
--

INSERT INTO `pand` (`straatnaam`, `huisnummer`, `postcode`, `gemeente`, `vierkantemeters`, `Nkamers`, `Nbadkamers`, `waarde_euros`, `eigenaar_email`, `status`) VALUES
('Euterpelaan', '100', '5394POddddd', 'OSS', '2', '2', '1', '350.000', 'hdjhdjdj', 'Verkocht');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`naam`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`email`);

--
-- Indexen voor tabel `pand`
--
ALTER TABLE `pand`
  ADD PRIMARY KEY (`straatnaam`,`huisnummer`),
  ADD KEY `eigenaar_email` (`eigenaar_email`);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `pand`
--
ALTER TABLE `pand`
  ADD CONSTRAINT `pand_ibfk_1` FOREIGN KEY (`eigenaar_email`) REFERENCES `klant` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
