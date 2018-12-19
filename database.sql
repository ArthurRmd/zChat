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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO friend (user_asker, user_asked, friend_accept, timestamp_friend_request, timestamp_friend_ok) VALUES
(1, 2, 0, '2018-12-03 22:22:42', NULL);

CREATE TABLE message (
  id int(11) NOT NULL,
  sender int(11) NOT NULL,
  receiver int(11) NOT NULL,
  timestamp datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  content varchar(1000) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO message (id, sender, receiver, `timestamp`, content) VALUES
(1, 1, 2, '2018-11-30 15:24:08', 'bonjour0'),
(2, 1, 2, '2018-11-30 16:32:31', 'bonjour1'),
(3, 2, 1, '2018-11-30 16:32:38', 'bonjour2'),
(4, 1, 2, '2018-11-30 16:33:37', 'bonjour3'),
(5, 2, 1, '2018-11-30 16:40:51', 'bonjour4');

CREATE TABLE `user` (
  id int(11) NOT NULL,
  pseudo varchar(80) COLLATE utf8_bin NOT NULL,
  password varchar(150) COLLATE utf8_bin NOT NULL,
  is_banned tinyint(1) NOT NULL DEFAULT '0',
  timestamp_creation datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `user` (id, pseudo, `password`, is_banned, timestamp_creation) VALUES
(1, 'rigwild', 'azerty', 0, '2018-11-30 15:23:35'),
(2, 'rigwild2', 'azerty', 0, '2018-11-30 15:23:35');


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
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `user`
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE friend
  ADD CONSTRAINT friend_ibfk_1 FOREIGN KEY (user_asker) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT friend_ibfk_2 FOREIGN KEY (user_asked) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE message
  ADD CONSTRAINT message_ibfk_1 FOREIGN KEY (sender) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT message_ibfk_2 FOREIGN KEY (receiver) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
