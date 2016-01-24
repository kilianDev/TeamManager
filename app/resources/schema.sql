CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255),
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `teammate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `team_has_teammate` (
  `team_id` int(11) NOT NULL,
  `teammate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `team_has_teammate`
  ADD PRIMARY KEY (`team_id`,`teammate_id`),
  ADD KEY `fk_team_has_teammate_team_idx` (`team_id`),
  ADD KEY `fk_team_has_teammate_teammate_idx` (`teammate_id`);

ALTER TABLE `team_has_teammate`
  ADD CONSTRAINT `fk_team_has_teammate_team_idx` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_team_has_teammate_teammate_idx` FOREIGN KEY (`teammate_id`) REFERENCES `teammate` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

