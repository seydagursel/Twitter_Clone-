-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Haz 2023, 14:44:23
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `cse348`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_followed_tweets` (IN `follower_n` VARCHAR(255))   BEGIN
    SELECT t.*
    FROM tweets t
    JOIN follows f ON f.following_n = t.username
    WHERE f.follower_n = follower_n
    ORDER BY t.date DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_tweets` (IN `username` VARCHAR(255))   BEGIN
    SELECT tweets.*
    FROM tweets
    JOIN users ON users.username = tweets.username
    WHERE users.username = username
    ORDER BY tweets.date DESC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `follows`
--

CREATE TABLE `follows` (
  `id` int(11) NOT NULL,
  `follower_n` varchar(255) NOT NULL,
  `following_n` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `follows`
--

INSERT INTO `follows` (`id`, `follower_n`, `following_n`) VALUES
(4, 'cigi', 'sigi'),
(5, 'cigi', 'digit'),
(7, 'digit', 'cigi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tweets`
--

INSERT INTO `tweets` (`id`, `text`, `date`, `username`) VALUES
(8, 'Hayat bir gun', '2023-06-04 21:20:44', 'cigi'),
(9, 'she is a gun', '2023-06-11 10:07:49', 'cigi'),
(10, 'calismak gerek', '2023-06-11 10:10:00', 'digit'),
(11, 'Mezun oluyorum', '2023-06-11 10:29:05', 'sigi'),
(12, 'Bende mezun oluyorum', '2023-06-11 10:30:06', 'cigi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `followers` int(11) NOT NULL,
  `following` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `t_c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `followers`, `following`, `date`, `t_c`) VALUES
(1, 'sigi', 'Seyda', 'seyda123', 1, 0, '2023-06-04 20:29:14', 2),
(2, 'cigi', 'Ceyda', 'ceyda123', 1, 2, '2023-06-04 20:29:57', 5),
(3, 'digit', 'Emirhan', 'em123', 1, 1, '2023-06-04 20:30:19', 2);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
