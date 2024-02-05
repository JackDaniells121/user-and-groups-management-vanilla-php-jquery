INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `birth_date`) VALUES(2, 'JohnH', 'pass111', 'John', 'Hammond', '2024-01-01');
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `birth_date`) VALUES(3, 'NickM', 'nick123', 'Nick', 'Mara', '2024-02-07');
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `birth_date`) VALUES(4, 'BumBumChris', 'Bumsted', 'Chris', 'Bumstead', '2024-02-26');
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `birth_date`) VALUES(5, 'AndyW', 'dasda1', 'Andy', 'Weir', '2024-02-27');
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `birth_date`) VALUES(6, 'JasonBr0320', 'Brown123', 'Jason', 'Brown', '2024-02-07');

INSERT INTO `user_groups` (`id`, `group_name`) VALUES(17, 'Admin');
INSERT INTO `user_groups` (`id`, `group_name`) VALUES(20, 'Admin3');
INSERT INTO `user_groups` (`id`, `group_name`) VALUES(23, 'Editors Group');
INSERT INTO `user_groups` (`id`, `group_name`) VALUES(22, 'Mederators');
INSERT INTO `user_groups` (`id`, `group_name`) VALUES(15, 'Regular Users');

INSERT INTO `group_user_assignment` (`user_id`, `group_id`) VALUES(2, 20);
INSERT INTO `group_user_assignment` (`user_id`, `group_id`) VALUES(3, 23);
INSERT INTO `group_user_assignment` (`user_id`, `group_id`) VALUES(4, 20);
INSERT INTO `group_user_assignment` (`user_id`, `group_id`) VALUES(4, 22);
INSERT INTO `group_user_assignment` (`user_id`, `group_id`) VALUES(2, 22);
INSERT INTO `group_user_assignment` (`user_id`, `group_id`) VALUES(5, 23);
INSERT INTO `group_user_assignment` (`user_id`, `group_id`) VALUES(6, 15);
INSERT INTO `group_user_assignment` (`user_id`, `group_id`) VALUES(2, 15);
INSERT INTO `group_user_assignment` (`user_id`, `group_id`) VALUES(2, 17);