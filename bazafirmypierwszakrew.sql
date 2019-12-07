-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Gru 2019, 01:40
-- Wersja serwera: 10.1.38-MariaDB
-- Wersja PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bazafirmy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `applicants`
--

CREATE TABLE `applicants` (
  `id_applicants` int(11) NOT NULL,
  `phone` int(9) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `id_cv` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_certificate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `applications`
--

CREATE TABLE `applications` (
  `id_application` int(11) NOT NULL,
  `id_applicants` int(11) NOT NULL,
  `id_decision` int(11) NOT NULL,
  `id_position` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_cl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `certifications`
--

CREATE TABLE `certifications` (
  `id_certificate` int(11) NOT NULL,
  `descriptions` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cities`
--

CREATE TABLE `cities` (
  `id_city` int(11) NOT NULL,
  `locality` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cl`
--

CREATE TABLE `cl` (
  `id_cl` int(11) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conv`
--

CREATE TABLE `conv` (
  `id_conv` int(11) NOT NULL,
  `topic` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conv_part`
--

CREATE TABLE `conv_part` (
  `id_conv_part` int(11) NOT NULL,
  `id_conv` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cv`
--

CREATE TABLE `cv` (
  `id_cv` int(11) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `decisions`
--

CREATE TABLE `decisions` (
  `id_decision` int(11) NOT NULL,
  `name_decision` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `experiences`
--

CREATE TABLE `experiences` (
  `id_experience` int(11) NOT NULL,
  `job` varchar(30) NOT NULL,
  `employer` varchar(30) NOT NULL,
  `start_job` date NOT NULL,
  `end_job` date NOT NULL,
  `description` varchar(150) NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_applicants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `holders`
--

CREATE TABLE `holders` (
  `id_holder` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_applicants` int(11) NOT NULL,
  `id_skill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `knowledge`
--

CREATE TABLE `knowledge` (
  `id_knowledge` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_applicants` int(11) DEFAULT NULL,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `languages`
--

CREATE TABLE `languages` (
  `id_language` int(11) NOT NULL,
  `language` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `levels`
--

CREATE TABLE `levels` (
  `id_level` int(11) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `message` varchar(150) DEFAULT NULL,
  `time` date NOT NULL,
  `id_conv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `positions`
--

CREATE TABLE `positions` (
  `id_position` int(11) NOT NULL,
  `postion` varchar(20) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name_role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `schools`
--

CREATE TABLE `schools` (
  `id_school` int(11) NOT NULL,
  `name_school` varchar(20) NOT NULL,
  `specialization` varchar(25) NOT NULL,
  `start_learning` date NOT NULL,
  `end_learning` date NOT NULL,
  `description` varchar(150) NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_applicants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skills`
--

CREATE TABLE `skills` (
  `id_skill` int(11) NOT NULL,
  `sience` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sor`
--

CREATE TABLE `sor` (
  `id_stage` int(11) NOT NULL,
  `name_stage` varchar(15) NOT NULL,
  `description` varchar(150) NOT NULL,
  `id_application` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statuses`
--

CREATE TABLE `statuses` (
  `id_status` int(11) NOT NULL,
  `name_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `training`
--

CREATE TABLE `training` (
  `id_training` int(11) NOT NULL,
  `training` varchar(40) NOT NULL,
  `description` varchar(150) NOT NULL,
  `id_applicants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_conv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id_applicants`),
  ADD KEY `id_cv` (`id_cv`),
  ADD KEY `id_city` (`id_city`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_certificate` (`id_certificate`);

--
-- Indeksy dla tabeli `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id_application`),
  ADD KEY `id_applicants` (`id_applicants`),
  ADD KEY `id_decision` (`id_decision`),
  ADD KEY `id_position` (`id_position`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_cl` (`id_cl`);

--
-- Indeksy dla tabeli `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id_certificate`);

--
-- Indeksy dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id_city`);

--
-- Indeksy dla tabeli `cl`
--
ALTER TABLE `cl`
  ADD PRIMARY KEY (`id_cl`);

--
-- Indeksy dla tabeli `conv`
--
ALTER TABLE `conv`
  ADD PRIMARY KEY (`id_conv`);

--
-- Indeksy dla tabeli `conv_part`
--
ALTER TABLE `conv_part`
  ADD PRIMARY KEY (`id_conv_part`),
  ADD KEY `id_conv` (`id_conv`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id_cv`);

--
-- Indeksy dla tabeli `decisions`
--
ALTER TABLE `decisions`
  ADD PRIMARY KEY (`id_decision`);

--
-- Indeksy dla tabeli `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id_experience`),
  ADD KEY `id_city` (`id_city`),
  ADD KEY `id_applicants` (`id_applicants`);

--
-- Indeksy dla tabeli `holders`
--
ALTER TABLE `holders`
  ADD PRIMARY KEY (`id_holder`),
  ADD KEY `id_applicants` (`id_applicants`),
  ADD KEY `id_skill` (`id_skill`),
  ADD KEY `id_level` (`id_level`);

--
-- Indeksy dla tabeli `knowledge`
--
ALTER TABLE `knowledge`
  ADD PRIMARY KEY (`id_knowledge`),
  ADD KEY `id_applicants` (`id_applicants`),
  ADD KEY `id_language` (`id_language`),
  ADD KEY `id_level` (`id_level`);

--
-- Indeksy dla tabeli `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id_language`);

--
-- Indeksy dla tabeli `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `id_conv` (`id_conv`);

--
-- Indeksy dla tabeli `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id_position`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeksy dla tabeli `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id_school`),
  ADD KEY `id_city` (`id_city`),
  ADD KEY `id_applicants` (`id_applicants`);

--
-- Indeksy dla tabeli `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id_skill`);

--
-- Indeksy dla tabeli `sor`
--
ALTER TABLE `sor`
  ADD PRIMARY KEY (`id_stage`),
  ADD KEY `id_application` (`id_application`);

--
-- Indeksy dla tabeli `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeksy dla tabeli `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id_training`),
  ADD KEY `id_applicants` (`id_applicants`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_conv` (`id_conv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id_applicants` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `applications`
--
ALTER TABLE `applications`
  MODIFY `id_application` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id_certificate` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `cities`
--
ALTER TABLE `cities`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `cl`
--
ALTER TABLE `cl`
  MODIFY `id_cl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `conv`
--
ALTER TABLE `conv`
  MODIFY `id_conv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `conv_part`
--
ALTER TABLE `conv_part`
  MODIFY `id_conv_part` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `cv`
--
ALTER TABLE `cv`
  MODIFY `id_cv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `decisions`
--
ALTER TABLE `decisions`
  MODIFY `id_decision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `holders`
--
ALTER TABLE `holders`
  MODIFY `id_holder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `knowledge`
--
ALTER TABLE `knowledge`
  MODIFY `id_knowledge` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `languages`
--
ALTER TABLE `languages`
  MODIFY `id_language` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `levels`
--
ALTER TABLE `levels`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `positions`
--
ALTER TABLE `positions`
  MODIFY `id_position` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `schools`
--
ALTER TABLE `schools`
  MODIFY `id_school` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `skills`
--
ALTER TABLE `skills`
  MODIFY `id_skill` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `sor`
--
ALTER TABLE `sor`
  MODIFY `id_stage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `training`
--
ALTER TABLE `training`
  MODIFY `id_training` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_ibfk_1` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id_cv`),
  ADD CONSTRAINT `applicants_ibfk_2` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id_city`),
  ADD CONSTRAINT `applicants_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `applicants_ibfk_4` FOREIGN KEY (`id_certificate`) REFERENCES `certifications` (`id_certificate`);

--
-- Ograniczenia dla tabeli `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`id_applicants`) REFERENCES `applicants` (`id_applicants`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`id_decision`) REFERENCES `decisions` (`id_decision`),
  ADD CONSTRAINT `applications_ibfk_3` FOREIGN KEY (`id_position`) REFERENCES `positions` (`id_position`),
  ADD CONSTRAINT `applications_ibfk_4` FOREIGN KEY (`id_status`) REFERENCES `statuses` (`id_status`),
  ADD CONSTRAINT `applications_ibfk_5` FOREIGN KEY (`id_cl`) REFERENCES `cl` (`id_cl`);

--
-- Ograniczenia dla tabeli `conv_part`
--
ALTER TABLE `conv_part`
  ADD CONSTRAINT `conv_part_ibfk_1` FOREIGN KEY (`id_conv`) REFERENCES `conv` (`id_conv`),
  ADD CONSTRAINT `conv_part_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ograniczenia dla tabeli `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id_city`),
  ADD CONSTRAINT `experiences_ibfk_2` FOREIGN KEY (`id_applicants`) REFERENCES `applicants` (`id_applicants`);

--
-- Ograniczenia dla tabeli `holders`
--
ALTER TABLE `holders`
  ADD CONSTRAINT `holders_ibfk_1` FOREIGN KEY (`id_applicants`) REFERENCES `applicants` (`id_applicants`),
  ADD CONSTRAINT `holders_ibfk_2` FOREIGN KEY (`id_skill`) REFERENCES `skills` (`id_skill`),
  ADD CONSTRAINT `holders_ibfk_3` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id_level`);

--
-- Ograniczenia dla tabeli `knowledge`
--
ALTER TABLE `knowledge`
  ADD CONSTRAINT `knowledge_ibfk_1` FOREIGN KEY (`id_applicants`) REFERENCES `applicants` (`id_applicants`),
  ADD CONSTRAINT `knowledge_ibfk_2` FOREIGN KEY (`id_applicants`) REFERENCES `applicants` (`id_applicants`),
  ADD CONSTRAINT `knowledge_ibfk_3` FOREIGN KEY (`id_language`) REFERENCES `languages` (`id_language`),
  ADD CONSTRAINT `knowledge_ibfk_4` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id_level`);

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_conv`) REFERENCES `conv` (`id_conv`);

--
-- Ograniczenia dla tabeli `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_ibfk_1` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id_city`),
  ADD CONSTRAINT `schools_ibfk_2` FOREIGN KEY (`id_applicants`) REFERENCES `applicants` (`id_applicants`);

--
-- Ograniczenia dla tabeli `sor`
--
ALTER TABLE `sor`
  ADD CONSTRAINT `sor_ibfk_1` FOREIGN KEY (`id_application`) REFERENCES `applications` (`id_application`);

--
-- Ograniczenia dla tabeli `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `training_ibfk_1` FOREIGN KEY (`id_applicants`) REFERENCES `applicants` (`id_applicants`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_conv`) REFERENCES `conv` (`id_conv`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
