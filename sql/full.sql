
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ci_admins`
--

CREATE TABLE IF NOT EXISTS `ci_admins` (
`id` int(100) NOT NULL,
  `username` varchar(200) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'the user name',
  `pass` varchar(200) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'hashed password, ideally in md5 and salt and pepper',
  `email` varchar(200) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'the admin email address',
  `last_here` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'last login date',
  `crdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'creation time of user',
  `other` varchar(200) COLLATE utf8_hungarian_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=2 ;

--
-- A tábla adatainak kiíratása `ci_admins`
--

INSERT INTO `ci_admins` (`id`, `username`, `pass`, `email`, `last_here`, `crdate`, `other`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '0000-00-00 00:00:00', '2014-07-09 19:40:29', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ci_clients`
--

CREATE TABLE IF NOT EXISTS `ci_clients` (
`id` int(100) NOT NULL,
  `name` varchar(200) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'name',
  `phone` varchar(30) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'phone number',
  `email` varchar(200) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'email address',
  `photo_url` varchar(250) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'photo url on server',
  `birth` date NOT NULL DEFAULT '0000-00-00' COMMENT 'year-month-day in format YYYY-MM-DD',
  `crdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'creation / register date & time',
  `other` varchar(200) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'other stuff'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=16 ;

--
-- A tábla adatainak kiíratása `ci_clients`
--

INSERT INTO `ci_clients` (`id`, `name`, `phone`, `email`, `photo_url`, `birth`, `crdate`, `other`) VALUES
(1, 'Kis tihamér', '+33-33-33-33-33333', 'email@email.em', 'nophotohere', '2010-07-15', '2014-07-10 22:39:09', 'no other info'),
(5, 'aaaaa aaaaa aaaa', '2222222-22-22-2-22', 'afafasf@adfadfasf.adfa', '', '2014-01-14', '2014-07-02 00:00:00', 'dfafdaf'),
(3, 'Winch Eszter', '1111111-111-11-11-', 'alékfjaséf@asdfasfa@sfaf.aa', '', '1998-03-12', '2014-07-09 07:10:39', ''),
(6, 'bbbbb bbbbb', '4444-444-44-444', 'faaaaaa@aaaaa.kk', '', '2014-07-01', '2014-07-10 23:21:30', 'bbbb'),
(14, 'uuuu', '', 'uuuu@uu.uuuu', '', '2014-07-11', '2014-07-11 12:11:08', ''),
(15, 'ttttt2', '2222222222', 'ttttttt2@tt.tt', 'assets/10325405_831080330237902_8747561245343320990_n.jpg', '0000-00-00', '2014-07-11 12:12:08', '22222other22222222'),
(11, 'sssssss', '2343242342', 'sssss@sss.ss', 'assets/10393886_10152584449338856_8964666097570584177_n.jpg', '0000-00-00', '2014-07-11 11:55:43', 'other'),
(13, 'xyz', '23423432423', 'aaa@bb.cc', 'assets/hungry-yet-19.jpg', '0000-00-00', '2014-07-11 11:57:12', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ci_cookies`
--

CREATE TABLE IF NOT EXISTS `ci_cookies` (
`id` int(11) NOT NULL,
  `cookie_id` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `netid` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `orig_page_requested` varchar(120) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `php_session_id` varchar(40) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ci_letters`
--

CREATE TABLE IF NOT EXISTS `ci_letters` (
`id` int(100) NOT NULL,
  `crdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'creation date & time',
  `send_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'send time',
  `sended` int(1) NOT NULL DEFAULT '0' COMMENT 'this email sented (1) or not(0)',
  `title` varchar(100) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'the email title & subject',
  `message` text COLLATE utf8_hungarian_ci NOT NULL COMMENT 'the email body, probably in html',
  `other` varchar(200) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'other stuff'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_hungarian_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('ada97f57a8c8b5a80cba3bba09ce8d5b', '188.6.132.191', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', 1405083955, 'a:3:{s:9:"user_data";s:0:"";s:8:"userdata";s:12:"is_logged_in";s:8:"username";s:5:"admin";}'),
('84cd44699b2c29b86bb529b1a8231ad2', '188.6.132.191', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', 1405069962, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_admins`
--
ALTER TABLE `ci_admins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_clients`
--
ALTER TABLE `ci_clients`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_cookies`
--
ALTER TABLE `ci_cookies`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_letters`
--
ALTER TABLE `ci_letters`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_admins`
--
ALTER TABLE `ci_admins`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ci_clients`
--
ALTER TABLE `ci_clients`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `ci_cookies`
--
ALTER TABLE `ci_cookies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ci_letters`
--
ALTER TABLE `ci_letters`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
