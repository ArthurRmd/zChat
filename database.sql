SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `friend` (
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `timestamp_friend` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender` int(11) DEFAULT NULL,
  `receiver` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(1000) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


ALTER TABLE `friend`
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`);

ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`sender`),
  ADD KEY `receiver` (`receiver`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
