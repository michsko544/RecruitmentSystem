-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Sty 2020, 17:45
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `recruitment`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `applicants`
--

CREATE TABLE `applicants` (
  `id_applicants` int(11) NOT NULL,
  `phone` varchar(9) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `id_cv` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_certificate` int(11) NOT NULL,
  `id_country` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `applicants`
--

INSERT INTO `applicants` (`id_applicants`, `phone`, `email`, `id_cv`, `id_city`, `id_user`, `id_certificate`, `id_country`) VALUES
(1, '000000000', 'jakis@.com', 1, 1, 1, 1, 1),
(2, '123456789', 'rob@mail.com', 2, 3, 3, 2, 22);

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

--
-- Zrzut danych tabeli `applications`
--

INSERT INTO `applications` (`id_application`, `id_applicants`, `id_decision`, `id_position`, `id_status`, `id_cl`) VALUES
(1, 1, 2, 1, 1, 1),
(2, 2, 2, 3, 3, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `certifications`
--

CREATE TABLE `certifications` (
  `id_certificate` int(11) NOT NULL,
  `descriptions` varchar(150) NOT NULL,
  `id_applicants` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `certifications`
--

INSERT INTO `certifications` (`id_certificate`, `descriptions`, `id_applicants`) VALUES
(1, 'certyfikacik.pdf', 1),
(2, 'cert.pdf', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cities`
--

CREATE TABLE `cities` (
  `id_city` int(11) NOT NULL,
  `locality` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `cities`
--

INSERT INTO `cities` (`id_city`, `locality`) VALUES
(1, 'miko'),
(2, 'kato'),
(3, 'szczecin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cl`
--

CREATE TABLE `cl` (
  `id_cl` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `id_application` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `cl`
--

INSERT INTO `cl` (`id_cl`, `description`, `id_application`) VALUES
(1, 'liscikmot.pdf', 1),
(2, 'cl.pdf', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conv`
--

CREATE TABLE `conv` (
  `id_conv` int(11) NOT NULL,
  `topic` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `conv`
--

INSERT INTO `conv` (`id_conv`, `topic`) VALUES
(1, 'welcome'),
(2, 'very IMPORTANT'),
(3, 'dO NoT rEaD tHiS mEsSaGe'),
(4, 'welcome'),
(5, 'mess without position');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conv_part`
--

CREATE TABLE `conv_part` (
  `id_conv_part` int(11) NOT NULL,
  `id_conv` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `conv_part`
--

INSERT INTO `conv_part` (`id_conv_part`, `id_conv`, `id_user`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 3),
(4, 4, 1),
(5, 1, 2),
(6, 5, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `countries`
--

CREATE TABLE `countries` (
  `id_country` int(11) NOT NULL,
  `country` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `countries`
--

INSERT INTO `countries` (`id_country`, `country`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American Samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antarctica'),
(9, 'Antigua and Barbuda'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Aruba'),
(13, 'Australia'),
(14, 'Austria'),
(15, 'Azerbaijan'),
(16, 'Bahamas'),
(17, 'Bahrain'),
(18, 'Bangladesh'),
(19, 'Barbados'),
(20, 'Belarus'),
(21, 'Belgium'),
(22, 'Belize'),
(23, 'Benin'),
(24, 'Bermuda'),
(25, 'Bhutan'),
(26, 'Bolivia'),
(27, 'Bosnia and Herzegovi'),
(28, 'Botswana'),
(29, 'Bouvet Island'),
(30, 'Brazil'),
(31, 'British Indian Ocean'),
(32, 'Brunei Darussalam'),
(33, 'Bulgaria'),
(34, 'Burkina Faso'),
(35, 'Burundi'),
(36, 'Cambodia'),
(37, 'Cameroon'),
(38, 'Canada'),
(39, 'Cape Verde'),
(40, 'Cayman Islands'),
(41, 'Central African Repu'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'Christmas Island'),
(46, 'Cocos (Keeling) Isla'),
(47, 'Colombia'),
(48, 'Comoros'),
(49, 'Democratic Republic '),
(50, 'Republic of Congo'),
(51, 'Cook Islands'),
(52, 'Costa Rica'),
(53, 'Croatia (Hrvatska)'),
(54, 'Cuba'),
(55, 'Cyprus'),
(56, 'Czech Republic'),
(57, 'Denmark'),
(58, 'Djibouti'),
(59, 'Dominica'),
(60, 'Dominican Republic'),
(61, 'East Timor'),
(62, 'Ecuador'),
(63, 'Egypt'),
(64, 'El Salvador'),
(65, 'Equatorial Guinea'),
(66, 'Eritrea'),
(67, 'Estonia'),
(68, 'Ethiopia'),
(69, 'Falkland Islands (Ma'),
(70, 'Faroe Islands'),
(71, 'Fiji'),
(72, 'Finland'),
(73, 'France'),
(74, 'France, Metropolitan'),
(75, 'French Guiana'),
(76, 'French Polynesia'),
(77, 'French Southern Terr'),
(78, 'Gabon'),
(79, 'Gambia'),
(80, 'Georgia'),
(81, 'Germany'),
(82, 'Ghana'),
(83, 'Gibraltar'),
(84, 'Guernsey'),
(85, 'Greece'),
(86, 'Greenland'),
(87, 'Grenada'),
(88, 'Guadeloupe'),
(89, 'Guam'),
(90, 'Guatemala'),
(91, 'Guinea'),
(92, 'Guinea-Bissau'),
(93, 'Guyana'),
(94, 'Haiti'),
(95, 'Heard and Mc Donald '),
(96, 'Honduras'),
(97, 'Hong Kong'),
(98, 'Hungary'),
(99, 'Iceland'),
(100, 'India'),
(101, 'Isle of Man'),
(102, 'Indonesia'),
(103, 'Iran (Islamic Republ'),
(104, 'Iraq'),
(105, 'Ireland'),
(106, 'Israel'),
(107, 'Italy'),
(108, 'Ivory Coast'),
(109, 'Jersey'),
(110, 'Jamaica'),
(111, 'Japan'),
(112, 'Jordan'),
(113, 'Kazakhstan'),
(114, 'Kenya'),
(115, 'Kiribati'),
(116, 'Korea, Democratic Pe'),
(117, 'Korea, Republic of'),
(118, 'Kosovo'),
(119, 'Kuwait'),
(120, 'Kyrgyzstan'),
(121, 'Lao People\'s Democra'),
(122, 'Latvia'),
(123, 'Lebanon'),
(124, 'Lesotho'),
(125, 'Liberia'),
(126, 'Libyan Arab Jamahiri'),
(127, 'Liechtenstein'),
(128, 'Lithuania'),
(129, 'Luxembourg'),
(130, 'Macau'),
(131, 'North Macedonia'),
(132, 'Madagascar'),
(133, 'Malawi'),
(134, 'Malaysia'),
(135, 'Maldives'),
(136, 'Mali'),
(137, 'Malta'),
(138, 'Marshall Islands'),
(139, 'Martinique'),
(140, 'Mauritania'),
(141, 'Mauritius'),
(142, 'Mayotte'),
(143, 'Mexico'),
(144, 'Micronesia, Federate'),
(145, 'Moldova, Republic of'),
(146, 'Monaco'),
(147, 'Mongolia'),
(148, 'Montenegro'),
(149, 'Montserrat'),
(150, 'Morocco'),
(151, 'Mozambique'),
(152, 'Myanmar'),
(153, 'Namibia'),
(154, 'Nauru'),
(155, 'Nepal'),
(156, 'Netherlands'),
(157, 'Netherlands Antilles'),
(158, 'New Caledonia'),
(159, 'New Zealand'),
(160, 'Nicaragua'),
(161, 'Niger'),
(162, 'Nigeria'),
(163, 'Niue'),
(164, 'Norfolk Island'),
(165, 'Northern Mariana Isl'),
(166, 'Norway'),
(167, 'Oman'),
(168, 'Pakistan'),
(169, 'Palau'),
(170, 'Palestine'),
(171, 'Panama'),
(172, 'Papua New Guinea'),
(173, 'Paraguay'),
(174, 'Peru'),
(175, 'Philippines'),
(176, 'Pitcairn'),
(177, 'Poland'),
(178, 'Portugal'),
(179, 'Puerto Rico'),
(180, 'Qatar'),
(181, 'Reunion'),
(182, 'Romania'),
(183, 'Russian Federation'),
(184, 'Rwanda'),
(185, 'Saint Kitts and Nevi'),
(186, 'Saint Lucia'),
(187, 'Saint Vincent and th'),
(188, 'Samoa'),
(189, 'San Marino'),
(190, 'Sao Tome and Princip'),
(191, 'Saudi Arabia'),
(192, 'Senegal'),
(193, 'Serbia'),
(194, 'Seychelles'),
(195, 'Sierra Leone'),
(196, 'Singapore'),
(197, 'Slovakia'),
(198, 'Slovenia'),
(199, 'Solomon Islands'),
(200, 'Somalia'),
(201, 'South Africa'),
(202, 'South Georgia South '),
(203, 'South Sudan'),
(204, 'Spain'),
(205, 'Sri Lanka'),
(206, 'St. Helena'),
(207, 'St. Pierre and Mique'),
(208, 'Sudan'),
(209, 'Suriname'),
(210, 'Svalbard and Jan May'),
(211, 'Swaziland'),
(212, 'Sweden'),
(213, 'Switzerland'),
(214, 'Syrian Arab Republic'),
(215, 'Taiwan'),
(216, 'Tajikistan'),
(217, 'Tanzania, United Rep'),
(218, 'Thailand'),
(219, 'Togo'),
(220, 'Tokelau'),
(221, 'Tonga'),
(222, 'Trinidad and Tobago'),
(223, 'Tunisia'),
(224, 'Turkey'),
(225, 'Turkmenistan'),
(226, 'Turks and Caicos Isl'),
(227, 'Tuvalu'),
(228, 'Uganda'),
(229, 'Ukraine'),
(230, 'United Arab Emirates'),
(231, 'United Kingdom'),
(232, 'United States'),
(233, 'United States minor '),
(234, 'Uruguay'),
(235, 'Uzbekistan'),
(236, 'Vanuatu'),
(237, 'Vatican City State'),
(238, 'Venezuela'),
(239, 'Vietnam'),
(240, 'Virgin Islands (Brit'),
(241, 'Virgin Islands (U.S.'),
(242, 'Wallis and Futuna Is'),
(243, 'Western Sahara'),
(244, 'Yemen'),
(245, 'Zambia'),
(246, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cv`
--

CREATE TABLE `cv` (
  `id_cv` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `id_applicants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `cv`
--

INSERT INTO `cv` (`id_cv`, `description`, `id_applicants`) VALUES
(1, 'ciwi.pdf', 1),
(2, 'cv.pdf', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `decisions`
--

CREATE TABLE `decisions` (
  `id_decision` int(11) NOT NULL,
  `name_decision` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `decisions`
--

INSERT INTO `decisions` (`id_decision`, `name_decision`) VALUES
(1, 'rejected'),
(2, 'accepted');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `experiences`
--

CREATE TABLE `experiences` (
  `id_experience` int(11) NOT NULL,
  `job` varchar(30) NOT NULL,
  `employer` varchar(30) NOT NULL,
  `start_job` varchar(10) NOT NULL,
  `end_job` varchar(10) NOT NULL,
  `description` varchar(150) NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_applicants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `experiences`
--

INSERT INTO `experiences` (`id_experience`, `job`, `employer`, `start_job`, `end_job`, `description`, `id_city`, `id_applicants`) VALUES
(1, 'devOps', 'google', '2019-12-11', '2019-12-13', 'very good i was', 3, 1),
(2, 'flight attendant', 'british airlines', '2019-12-01', '2019-12-09', 'made best drinks midair', 2, 1);

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

--
-- Zrzut danych tabeli `holders`
--

INSERT INTO `holders` (`id_holder`, `id_level`, `id_applicants`, `id_skill`) VALUES
(1, 2, 1, 1),
(2, 3, 1, 2),
(3, 2, 1, 3),
(4, 1, 2, 1);

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

--
-- Zrzut danych tabeli `knowledge`
--

INSERT INTO `knowledge` (`id_knowledge`, `id_level`, `id_applicants`, `id_language`) VALUES
(1, 2, 1, 2),
(2, 1, 1, 3),
(3, 5, 2, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `languages`
--

CREATE TABLE `languages` (
  `id_language` int(11) NOT NULL,
  `language` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `languages`
--

INSERT INTO `languages` (`id_language`, `language`) VALUES
(1, 'pl'),
(2, 'eng'),
(3, 'czeski');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `levels`
--

CREATE TABLE `levels` (
  `id_level` int(11) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `levels`
--

INSERT INTO `levels` (`id_level`, `level`) VALUES
(1, 'get gud'),
(2, 'weak boi'),
(3, 'mid'),
(4, 'almostGood'),
(5, 'pro');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `message` varchar(150) DEFAULT NULL,
  `time` date NOT NULL,
  `id_conv` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id_message`, `id_sender`, `message`, `time`, `id_conv`, `id_user`) VALUES
(1, 2, 'hello there', '2019-12-16', 1, 1),
(2, 4, 'hi how u doin', '2019-12-03', 2, 3),
(3, 4, 'idk', '2019-12-31', 3, 3),
(4, 5, 'welcome to myCompany system', '2019-12-11', 4, 1),
(5, 1, 'i have an offer', '2020-01-02', 1, 2),
(6, 1, 'hm', '2020-01-01', 1, 2),
(7, 2, 'good day', '2020-01-02', 1, 1),
(8, 1, 'my third message', '2019-12-27', 1, 2),
(9, 4, 'there is no position', '2020-01-03', 5, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `positions`
--

CREATE TABLE `positions` (
  `id_position` int(11) NOT NULL,
  `position` varchar(20) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `positions`
--

INSERT INTO `positions` (`id_position`, `position`, `description`) VALUES
(1, 'front-end', 'front-end developer'),
(2, 'full-stack', 'full-stack developer'),
(3, 'junior C#', 'junior C# developer ');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name_role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `roles`
--

INSERT INTO `roles` (`id_role`, `name_role`) VALUES
(1, 'admin'),
(2, 'applicant'),
(3, 'recruiter'),
(4, 'manager'),
(5, 'assistant');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `schools`
--

CREATE TABLE `schools` (
  `id_school` int(11) NOT NULL,
  `name_school` varchar(20) NOT NULL,
  `specialization` varchar(25) NOT NULL,
  `start_learning` varchar(10) NOT NULL,
  `end_learning` varchar(10) NOT NULL,
  `description` varchar(150) NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_applicants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `schools`
--

INSERT INTO `schools` (`id_school`, `name_school`, `specialization`, `start_learning`, `end_learning`, `description`, `id_city`, `id_applicants`) VALUES
(1, 'polsl', 'ICT', '2019-12-10', '2019-12-31', 'master\'s degree', 2, 1),
(2, 'oxford', 'philosophy', '2019-12-03', '2019-12-26', 'bachelor\'s degree', 3, 1),
(3, 'stanford', 'butcher', '2017-12-12', '2019-01-29', 'PhD', 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skills`
--

CREATE TABLE `skills` (
  `id_skill` int(11) NOT NULL,
  `sience` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `skills`
--

INSERT INTO `skills` (`id_skill`, `sience`) VALUES
(1, 'version control'),
(2, 'soft skills'),
(3, 'dancing');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sor`
--

CREATE TABLE `sor` (
  `id_stage` int(11) NOT NULL,
  `name_stage` varchar(15) NOT NULL,
  `description` varchar(150) NOT NULL,
  `id_application` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `sor`
--

INSERT INTO `sor` (`id_stage`, `name_stage`, `description`, `id_application`) VALUES
(1, 'interview', 'ask about applicant\'s university', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statuses`
--

CREATE TABLE `statuses` (
  `id_status` int(11) NOT NULL,
  `name_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `statuses`
--

INSERT INTO `statuses` (`id_status`, `name_status`) VALUES
(1, 'sent'),
(2, 'opened'),
(3, 'chat');

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

--
-- Zrzut danych tabeli `training`
--

INSERT INTO `training` (`id_training`, `training`, `description`, `id_applicants`) VALUES
(1, 'RESTful API in nutshell', 'creating state of the art REST API', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `login`, `name`, `surname`, `pass`, `id_role`) VALUES
(1, 'bob', 'Bob', 'Thebuilder', '$2y$10$9HJ5bdPQELb3XWV7gPJHueOVEUyBLdxZzOPrWZMRyJx/zDm3VP5zy', 2),
(2, 'jerry', 'Jerry', 'Snow', '$2y$10$B2yosZmaSdLv.RcTTvnIg.dNBr6UTkvsSIgo5TzXNDSzbRd0k9wv.', 4),
(3, 'rob', 'Robert', 'Barszcz', '$2y$10$URdbJa9Ha2zAO8YfFj0mguwUwhCEeGU4o.xUK4YLmv8WLLd5/Y6Gm', 2),
(4, 'kate', 'Katrina', 'Novowolska', '$2y$10$MLhaUSCJTgpvqx4YRN64tucmJhCQ8lEu9tLo9OKixxHhpZFrLNi12', 5),
(5, 'jack', 'Jack', 'Theripper', '$2y$10$4C/OeoDIIpVMchjEsggxSOR3u4.idHM9oHD5NwxQajEG8BYP9ib52', 3);

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
  ADD KEY `id_certificate` (`id_certificate`),
  ADD KEY `id_country` (`id_country`);

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
  ADD PRIMARY KEY (`id_certificate`),
  ADD KEY `id_applicants` (`id_applicants`);

--
-- Indeksy dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id_city`);

--
-- Indeksy dla tabeli `cl`
--
ALTER TABLE `cl`
  ADD PRIMARY KEY (`id_cl`),
  ADD KEY `id_application` (`id_application`);

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
-- Indeksy dla tabeli `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id_country`);

--
-- Indeksy dla tabeli `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id_cv`),
  ADD KEY `id_applicants` (`id_applicants`);

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
  ADD KEY `id_conv` (`id_conv`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_sender` (`id_sender`);

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
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id_applicants` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `applications`
--
ALTER TABLE `applications`
  MODIFY `id_application` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id_certificate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `cities`
--
ALTER TABLE `cities`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `cl`
--
ALTER TABLE `cl`
  MODIFY `id_cl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `conv`
--
ALTER TABLE `conv`
  MODIFY `id_conv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `conv_part`
--
ALTER TABLE `conv_part`
  MODIFY `id_conv_part` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `countries`
--
ALTER TABLE `countries`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT dla tabeli `cv`
--
ALTER TABLE `cv`
  MODIFY `id_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `decisions`
--
ALTER TABLE `decisions`
  MODIFY `id_decision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id_experience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `holders`
--
ALTER TABLE `holders`
  MODIFY `id_holder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `knowledge`
--
ALTER TABLE `knowledge`
  MODIFY `id_knowledge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `languages`
--
ALTER TABLE `languages`
  MODIFY `id_language` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `levels`
--
ALTER TABLE `levels`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `positions`
--
ALTER TABLE `positions`
  MODIFY `id_position` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `schools`
--
ALTER TABLE `schools`
  MODIFY `id_school` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `skills`
--
ALTER TABLE `skills`
  MODIFY `id_skill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `sor`
--
ALTER TABLE `sor`
  MODIFY `id_stage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `training`
--
ALTER TABLE `training`
  MODIFY `id_training` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_ibfk_2` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id_city`),
  ADD CONSTRAINT `applicants_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `applicants_ibfk_4` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id_country`);

--
-- Ograniczenia dla tabeli `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`id_applicants`) REFERENCES `applicants` (`id_applicants`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`id_decision`) REFERENCES `decisions` (`id_decision`),
  ADD CONSTRAINT `applications_ibfk_3` FOREIGN KEY (`id_position`) REFERENCES `positions` (`id_position`),
  ADD CONSTRAINT `applications_ibfk_4` FOREIGN KEY (`id_status`) REFERENCES `statuses` (`id_status`);

--
-- Ograniczenia dla tabeli `certifications`
--
ALTER TABLE `certifications`
  ADD CONSTRAINT `certifications_ibfk_1` FOREIGN KEY (`id_applicants`) REFERENCES `applicants` (`id_applicants`);

--
-- Ograniczenia dla tabeli `cl`
--
ALTER TABLE `cl`
  ADD CONSTRAINT `cl_ibfk_1` FOREIGN KEY (`id_application`) REFERENCES `applications` (`id_application`);

--
-- Ograniczenia dla tabeli `conv_part`
--
ALTER TABLE `conv_part`
  ADD CONSTRAINT `conv_part_ibfk_1` FOREIGN KEY (`id_conv`) REFERENCES `conv` (`id_conv`),
  ADD CONSTRAINT `conv_part_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ograniczenia dla tabeli `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `cv_ibfk_1` FOREIGN KEY (`id_applicants`) REFERENCES `applicants` (`id_applicants`);

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
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_conv`) REFERENCES `conv` (`id_conv`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`id_sender`) REFERENCES `users` (`id_user`);

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
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
