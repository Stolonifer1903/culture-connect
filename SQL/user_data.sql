/*default user data*/
INSERT INTO user (userFirstName, userLastName, userEmail, userPassword, userTitle, userRole, roleId) VALUES
('admin', 'admin', 'admin@admin.com', '1234', '', 4, 0), /*admin user*/
('ResidentUserFirstName', 'resident', 'user@user.com', '1234', '', 1, 3), /*resident user */
('BusinessUserFirstName', 'business', 'bus@bus.com', '1234', 'Mrs', 2, 1), /* business user */
('CouncilUserFirstName', 'council', 'counc@counc.com', '1234', '', 3, 10); /* council user */

/*resident user additional data*/

/*resident user data*/
INSERT INTO resident (residentIdPk, residentGender, residentBirthYear, locationIdPk, userIdPk) VALUES
(3, 'Male', 1998, 2, 4);

/*interests */
INSERT INTO residentinterests (residentIdPk, interestAreaIdPk) VALUES
(3, 2),
(3, 3),
(3, 6),
(3, 14),
(3, 15);