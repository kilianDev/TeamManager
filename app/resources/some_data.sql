INSERT INTO team VALUES
  (1, 'team1', 'First Team', NULL),
  (2, 'team2', 'Second Team', NULL),
  (3, 'team3', 'Third Team', NULL),
  (4, 'team4', 'Fourth Team', NULL);

INSERT INTO teammate VALUES
  (1, 'John', 'Doe', 'john.doe@me.fr', NULL, NULL),
  (2, 'Jane', 'Doe', 'jane.doe@me.fr', '+33 987654321', NULL),
  (3, 'John', 'Connor', NULL, '911', NULL),
  (4, 'Sarah', 'Connor', 'sarah.connor@me.fr', NULL, NULL);

INSERT INTO team_has_teammate VALUES
  (1,1),
  (1,2),
  (1,3),
  (2,3),
  (2,4),
  (3,1),
  (3,2),
  (3,3),
  (3,4);
