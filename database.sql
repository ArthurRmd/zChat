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
(1, 3, 1, '2019-01-13 19:56:29', NULL),
(2, 1, 1, '2019-01-13 19:18:06', NULL),
(4, 1, 1, '2019-01-13 19:18:33', NULL),
(5, 1, 0, '2019-01-13 19:57:12', NULL);

CREATE TABLE message (
  id int(11) NOT NULL,
  sender int(11) NOT NULL,
  receiver int(11) NOT NULL,
  timestamp datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  content varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO message (id, sender, receiver, `timestamp`, content) VALUES
(1, 1, 2, '2019-01-13 19:57:49', 'Hey ! Comment vas-tu ?'),
(2, 2, 1, '2019-01-13 19:58:05', 'Bien et toi ?'),
(3, 1, 2, '2019-01-13 19:58:43', 'Super, je test zChat. Voici un emoji (: airplane:) : ✈'),
(4, 1, 2, '2019-01-13 19:59:13', 'Allez un autre. : basketball: -> 🏀'),
(5, 1, 2, '2019-01-13 20:07:16', '.'),
(6, 1, 2, '2019-01-13 20:07:16', '.'),
(7, 1, 2, '2019-01-13 20:07:16', '.'),
(8, 1, 2, '2019-01-13 20:07:17', '.');

CREATE TABLE `user` (
  id int(11) NOT NULL,
  pseudo varchar(80) NOT NULL,
  password varchar(150) NOT NULL,
  is_banned tinyint(1) NOT NULL DEFAULT '0',
  timestamp_creation datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (id, pseudo, `password`, is_banned, timestamp_creation) VALUES
(1, 'Antoine', '$2y$10$3xQ8e2W1M7LF3d1SZr6eseWYQiyvFmBB0Zm2rjuR6Zhuo2cPt2DYO', 0, '2019-01-13 19:16:01'),
(2, 'Arthur', '$2y$10$3Mb.GqBkjncMgd5KR/iF3eHqNBI7GilnhFWiyPKhOf6W0aD6wI8yK', 0, '2019-01-13 19:16:08'),
(3, 'Thomas', '$2y$10$TsEuDZGmEgpfoDMfdh9gReMJ4123SClNH117nt62JNlufE6s9Kige', 1, '2019-01-13 19:16:23'),
(4, 'Océan', '$2y$10$ufNAOSDvbd0ChJC7xY87Yelyv5aJ3kT0EchZ99wL2UajJfeyyOvFW', 0, '2019-01-13 19:16:32'),
(5, 'Benoit', '$2y$10$IvAOOuYL99D87FODyQA3D.NP3S6C9D5Ql5hKhSuOyDSGo4VjL8Day', 0, '2019-01-13 19:17:06');


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
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
ALTER TABLE `user`
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE friend
  ADD CONSTRAINT friend_ibfk_1 FOREIGN KEY (user_asker) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT friend_ibfk_2 FOREIGN KEY (user_asked) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE message
  ADD CONSTRAINT message_ibfk_1 FOREIGN KEY (sender) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT message_ibfk_2 FOREIGN KEY (receiver) REFERENCES `user` (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
