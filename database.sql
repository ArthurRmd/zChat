SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE friend (
  user_asker int(11) NOT NULL,
  user_asked int(11) NOT NULL,
  friend_accept tinyint(1) NOT NULL DEFAULT '0',
  timestamp_friend_request datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  timestamp_friend_ok datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO friend (user_asker, user_asked, friend_accept, timestamp_friend_request, timestamp_friend_ok) VALUES
(1, 2, 0, '2018-12-03 22:22:42', NULL),
(1, 3, 1, '2018-12-03 22:22:42', '2018-12-22 11:30:55'),
(1, 4, 1, '2018-12-03 22:22:42', '2018-12-23 11:30:55');

CREATE TABLE message (
  id int(11) NOT NULL,
  sender int(11) NOT NULL,
  receiver int(11) NOT NULL,
  timestamp datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  content varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO message (id, sender, receiver, `timestamp`, content) VALUES
(1, 1, 2, '2018-11-30 15:24:08', 'bonjour0'),
(2, 1, 2, '2018-11-30 16:32:31', 'bonjour1'),
(3, 2, 1, '2018-11-30 16:32:38', 'bonjour2'),
(4, 1, 2, '2018-11-30 16:33:37', 'bonjour3'),
(5, 2, 1, '2018-11-30 16:40:51', 'bonjour4'),
(9, 1, 1, '2018-12-19 19:49:02', 'bonjour mdr ✈ comment vas-tu ? ⭐ test ✈'),
(10, 1, 1, '2018-12-19 19:49:04', 'bonjour mdr ✈ comment vas-tu ? ⭐ test ✈'),
(14, 1, 1, '2018-12-19 19:50:34', 'bonjour mdr ✈ comment vas-tu ? ⭐ test ✈'),
(15, 3, 2, '2018-12-19 21:22:09', 'bonjour mdr ✈ comment vas-tu ? ⭐ test ✈'),
(16, 3, 2, '2018-12-19 21:22:26', 'bonjour mdr ✈ comment vas-tu ? ⭐ test ✈'),
(17, 1, 2, '2018-12-19 19:49:02', 'bonjour mdr ✈ comment vas-tu ? ⭐ test ✈'),
(18, 1, 2, '2018-12-19 19:49:02', 'bonjour mdr ✈ comment vas-tu ? ⭐ test ✈'),
(19, 2, 1, '2018-12-19 19:49:02', 'bonjourerferg mdr ✈ comment vas-tu ? ⭐ test ✈'),
(20, 2, 1, '2018-12-19 19:49:02', 'bonjourerferg mdr ✈ comment vas-tu ? ⭐ test ✈'),
(21, 1, 2, '2018-12-19 19:49:02', 'bonjour mdr ✈ comment vas-tu ? ⭐ test ✈'),
(22, 1, 2, '2018-12-19 19:49:02', 'bonjour mdr ✈ comment vas-tu ? ⭐ test ✈'),
(23, 2, 1, '2018-12-19 19:49:02', 'bonjourerferg mdr ✈ comment vas-tu ? ⭐ test ✈'),
(24, 2, 1, '2018-12-19 19:49:02', 'bonjourerferg mdr ✈ comment vas-tu ? ⭐ test ✈'),
(25, 1, 2, '2018-12-29 12:56:57', 'egrtgtr'),
(26, 1, 2, '2018-12-29 13:00:08', 'tnytrn'),
(27, 1, 2, '2018-12-29 13:08:20', 'hdfgh'),
(28, 1, 2, '2018-12-29 13:08:50', 'regzergze'),
(29, 1, 2, '2018-12-29 13:09:02', 'regzerg'),
(30, 1, 2, '2018-12-29 13:10:21', 'terhgrth\n'),
(31, 1, 2, '2018-12-29 13:10:25', ':plane:\n'),
(32, 1, 2, '2018-12-29 13:10:26', '\n'),
(33, 1, 2, '2018-12-29 13:11:17', 'zergzeg\n'),
(34, 1, 2, '2018-12-29 13:11:27', '\nezrgzreg\n'),
(35, 1, 2, '2018-12-29 13:11:52', 'zergze'),
(36, 1, 2, '2018-12-29 13:11:56', 'sdfg'),
(37, 1, 2, '2018-12-29 13:28:07', 'fdbvsdfgb'),
(38, 1, 2, '2018-12-29 13:29:14', 'gzerg'),
(39, 1, 2, '2018-12-29 13:43:22', 'mdr'),
(40, 1, 2, '2018-12-29 13:48:40', '✈'),
(41, 1, 2, '2018-12-29 13:53:36', '\\xF0\\x9F\\x8F\\x80'),
(42, 1, 2, '2018-12-29 13:54:01', '🏀'),
(43, 1, 2, '2018-12-29 13:54:01', 'zefze🏀loool');

CREATE TABLE `user` (
  id int(11) NOT NULL,
  pseudo varchar(80) NOT NULL,
  password varchar(150) NOT NULL,
  is_banned tinyint(1) NOT NULL DEFAULT '0',
  timestamp_creation datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (id, pseudo, `password`, is_banned, timestamp_creation) VALUES
(1, 'rigwild', 'azerty', 0, '2018-11-30 15:23:35'),
(2, 'rigwild2', 'azerty', 0, '2018-11-30 15:23:35'),
(3, 'rigwild111', '$2y$10$Om75UPK/bZKgRkl0kj0P5uwMPYe8YLVkcAgfd16K6yFI8egcRietG', 0, '2018-12-19 20:35:03'),
(4, 'rigwild1112', '$2y$10$Om75UPK/bZKgRkl0kj0P5uwMPYe8YLVkcAgfd16K6yFI8egcRietG', 0, '2018-12-19 20:35:03');


ALTER TABLE friend
  ADD PRIMARY KEY (user_asker,user_asked),
  ADD KEY user1 (user_asker),
  ADD KEY user2 (user_asked);

ALTER TABLE message
  ADD PRIMARY KEY (id),
  ADD KEY author (sender),
  ADD KEY receiver (receiver);

ALTER TABLE `user`
  ADD PRIMARY KEY (id);


ALTER TABLE message
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
ALTER TABLE `user`
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE friend
  ADD CONSTRAINT friend_ibfk_1 FOREIGN KEY (user_asker) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT friend_ibfk_2 FOREIGN KEY (user_asked) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE message
  ADD CONSTRAINT message_ibfk_1 FOREIGN KEY (sender) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT message_ibfk_2 FOREIGN KEY (receiver) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
