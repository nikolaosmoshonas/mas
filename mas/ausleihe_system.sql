-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Mai 2020 um 10:44
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ausleihe_system`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '$2y$12$rXz96g6WWqwrbZC9eL/1NeBPW862C01GgQ1W0oSuDR/q9wsZQN5xy');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ausleihe`
--

CREATE TABLE `ausleihe` (
  `ausleihe_id` int(11) NOT NULL,
  `lehrer_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `geliehen_am` date DEFAULT NULL,
  `zurueckgebracht_am` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `benutzer_id` int(11) NOT NULL,
  `vorname` varchar(255) DEFAULT NULL,
  `nachname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passwort` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien`
--

CREATE TABLE `kategorien` (
  `kat_id` int(11) NOT NULL,
  `kategorie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lehrer`
--

CREATE TABLE `lehrer` (
  `lehrer_id` int(11) NOT NULL,
  `vorname` varchar(255) DEFAULT NULL,
  `nachname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephon` varchar(255) DEFAULT NULL,
  `erstellt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `material`
--

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `buchtitel` varchar(255) DEFAULT NULL,
  `sprache` varchar(255) DEFAULT NULL,
  `kategorie` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `jahr` varchar(255) DEFAULT NULL,
  `erstellt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indizes für die Tabelle `ausleihe`
--
ALTER TABLE `ausleihe`
  ADD PRIMARY KEY (`ausleihe_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `lehrer_id` (`lehrer_id`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`benutzer_id`);

--
-- Indizes für die Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  ADD PRIMARY KEY (`kat_id`);

--
-- Indizes für die Tabelle `lehrer`
--
ALTER TABLE `lehrer`
  ADD PRIMARY KEY (`lehrer_id`);

--
-- Indizes für die Tabelle `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `ausleihe`
--
ALTER TABLE `ausleihe`
  MODIFY `ausleihe_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `benutzer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  MODIFY `kat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `lehrer`
--
ALTER TABLE `lehrer`
  MODIFY `lehrer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `ausleihe`
--
ALTER TABLE `ausleihe`
  ADD CONSTRAINT `ausleihe_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`),
  ADD CONSTRAINT `ausleihe_ibfk_2` FOREIGN KEY (`lehrer_id`) REFERENCES `lehrer` (`lehrer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
