/*
 -- Fake data for 'events' table (20 entries)
 INSERT INTO
 `events` (
 `title`,
 `description`,
 `start_at`,
 `end_at`,
 `details`,
 `location`,
 `event_state`
 )
 VALUES
 (
 'Event 1',
 'Description for Event 1',
 '2024-03-08 10:00:00',
 '2024-03-08 12:00:00',
 'Additional details for Event 1',
 'Venue 1',
 'upcoming'
 ),
 (
 'Event 2',
 'Description for Event 2',
 '2024-03-15 14:00:00',
 '2024-03-15 16:00:00',
 'Additional details for Event 2',
 'Venue 2',
 'upcoming'
 ),
 (
 'Event 3',
 'Description for Event 3',
 '2024-03-22 18:00:00',
 '2024-03-22 20:00:00',
 'Additional details for Event 3',
 'Venue 3',
 'upcoming'
 ),
 (
 'Event 4',
 'Description for Event 4',
 '2024-03-29 10:00:00',
 '2024-03-29 12:00:00',
 'Additional details for Event 4',
 'Venue 4',
 'upcoming'
 ),
 (
 'Event 5',
 'Description for Event 5',
 '2024-04-05 14:00:00',
 '2024-04-05 16:00:00',
 'Additional details for Event 5',
 'Venue 5',
 'upcoming'
 ),
 (
 'Event 6',
 'Description for Event 6',
 '2024-04-12 18:00:00',
 '2024-04-12 20:00:00',
 'Additional details for Event 6',
 'Venue 6',
 'upcoming'
 ),
 (
 'Event 7',
 'Description for Event 7',
 '2024-04-19 10:00:00',
 '2024-04-19 12:00:00',
 'Additional details for Event 7',
 'Venue 7',
 'upcoming'
 ),
 (
 'Event 8',
 'Description for Event 8',
 '2024-04-26 14:00:00',
 '2024-04-26 16:00:00',
 'Additional details for Event 8',
 'Venue 8',
 'upcoming'
 ),
 (
 'Event 9',
 'Description for Event 9',
 '2024-05-03 18:00:00',
 '2024-05-03 20:00:00',
 'Additional details for Event 9',
 'Venue 9',
 'upcoming'
 ),
 (
 'Event 10',
 'Description for Event 10',
 '2024-05-10 10:00:00',
 '2024-05-10 12:00:00',
 'Additional details for Event 10',
 'Venue 10',
 'upcoming'
 ),
 (
 'Event 11',
 'Description for Event 11',
 '2024-05-17 14:00:00',
 '2024-05-17 16:00:00',
 'Additional details for Event 11',
 'Venue 11',
 'upcoming'
 ),
 (
 'Event 12',
 'Description for Event 12',
 '2024-05-24 18:00:00',
 '2024-05-24 20:00:00',
 'Additional details for Event 12',
 'Venue 12',
 'upcoming'
 ),
 (
 'Event 13',
 'Description for Event 13',
 '2024-05-31 10:00:00',
 '2024-05-31 12:00:00',
 'Additional details for Event 13',
 'Venue 13',
 'upcoming'
 ),
 (
 'Event 14',
 'Description for Event 14',
 '2024-06-07 14:00:00',
 (
 'Event 15',
 'Description for Event 15',
 '2024-06-14 18:00:00',
 '2024-06-14 20:00:00',
 'Additional details for Event 15',
 'Venue 15',
 'upcoming'
 ),
 (
 'Event 16',
 'Description for Event 16',
 '2024-06-21 10:00:00',
 '2024-06-21 12:00:00',
 'Additional details for Event 16',
 'Venue 16',
 'upcoming'
 ),
 (
 'Event 17',
 'Description for Event 17',
 '2024-06-28 14:00:00',
 '2024-06-28 16:00:00',
 'Additional details for Event 17',
 'Venue 17',
 'upcoming'
 ),
 (
 'Event 18',
 'Description for Event 18',
 '2024-07-05 18:00:00',
 '2024-07-05 20:00:00',
 'Additional details for Event 18',
 'Venue 18',
 'upcoming'
 ),
 (
 'Event 19',
 'Description for Event 19',
 '2024-07-12 10:00:00',
 '2024-07-12 12:00:00',
 'Additional details for Event 19',
 'Venue 19',
 'upcoming'
 ),
 (
 'Event 20',
 'Description for Event 20',
 '2024-07-19 14:00:00',
 '2024-07-19 16:00:00',
 'Additional details for Event 20',
 'Venue 20',
 'upcoming'
 );
 
 -- Fake data for 'events_tags' table (at least 10 entries)
 INSERT INTO
 `events_tags` (`eid`, `tag_id`)
 VALUES
 (1, 1),
 (1, 2),
 (2, 3),
 (2, 4),
 (3, 5),
 (3, 6),
 (4, 7),
 (4, 8),
 (5, 9),
 (5, 10),
 (6, 11),
 (6, 12),
 (7, 13),
 (7, 14),
 (8, 15),
 (8, 16),
 (9, 17),
 (9, 18),
 (10, 19),
 (10, 20);
 
 -- Fake data for 'organizers' table (at least 10 entries)
 INSERT INTO
 `organizers` (`email`, `organization_name`, `bio`, `password`)
 VALUES
 (
 'organizer1@example.com',
 'Organization 1',
 'About Organization 1',
 'password1'
 ),
 (
 'organizer2@example.com',
 'Organization 2',
 'About Organization 2',
 'password2'
 ),
 (
 'organizer3@example.com',
 'Organization 3',
 'About Organization 3',
 'password3'
 ),
 (
 'organizer4@example.com',
 'Organization 4',
 'About Organization 4',
 'password4'
 ),
 (
 'organizer5@example.com',
 'Organization 5',
 'About Organization 5',
 'password5'
 ),
 (
 'organizer6@example.com',
 'Organization 6',
 'About Organization 6',
 'password6'
 ),
 (
 'organizer7@example.com',
 'Organization 7',
 'About Organization 7',
 'password7'
 ),
 (
 'organizer8@example.com',
 'Organization 8',
 'About Organization 8',
 'password8'
 ),
 (
 'organizer9@example.com',
 'Organization 9',
 'About Organization 9',
 'password9'
 ),
 (
 'organizer10@example.com',
 'Organization 10',
 'About Organization 10',
 'password10'
 );
 
 -- Fake data for 'organizers_contacts' table (at least 10 entries)
 INSERT INTO
 `organizers_contacts` (`oid`, `contact`, `content_type`)
 
 VALUES
 (1, '0123456789', 'phone'),
 (1, 'username@example.com', 'email'),
 (2, '0123456789', 'phone'),
 (3,'username@example.com , email),
 (4, '0123456789', 'phone'),
 (4, 'username@example.com', 'email'),
 (5, '0123456789', 'phone'),
 (5, 'username@example.com', 'email'),
 (6, '0123456789', 'phone'),
 (6, 'username@example.com', 'email'),
 (7, '0123456789', 'phone'),
 (7, 'username@example.com', 'email'),
 (8, '0123456789', 'phone'),
 (8, 'username@example.com', 'email'),
 (9, '0123456789', 'phone'),
 (9, 'username@example.com', 'email'),
 (10, '0123456789', 'phone'),
 (10, 'username@example.com', 'email');
 
 -- Fake data for 'tags' table (at least 10 entries)
 INSERT INTO
 `tags` (`name`)
 VALUES
 ('Tag 1'),
 ('Tag 2'),
 ('Tag 3'),
 ('Tag 4'),
 ('Tag 5'),
 ('Tag 6'),
 ('Tag 7'),
 ('Tag 8'),
 ('Tag 9'),
 ('Tag 10');
 
 -- Fake data for 'users' table (at least 10 entries)
 INSERT INTO
 `users` (`email`, `username`, `birthdate`, `password`)
 VALUES
 (
 'user1@example.com',
 'User 1',
 '2000-01-01',
 'password1'
 ),
 (
 'user2@example.com',
 'User 2',
 '2000-02-01',
 'password2'
 ),
 (
 'user3@example.com',
 'User 3',
 '2000-03-01',
 'password3'
 ),
 (
 'user4@example.com',
 'User 4',
 '2000-04-01',
 'password4'
 ),
 (
 'user5@example.com',
 'User 5',
 '2000-05-01',
 'password5'
 ),
 (
 'user6@example.com',
 'User 6',
 '2000-06-01',
 'password6'
 ),
 (
 'user7@example.com',
 'User 7',
 '2000-07-01',
 'password7'
 ),
 (
 'user8@example.com',
 'User 8',
 '2000-08-01',
 'password8'
 ),
 (
 'user9@example.com',
 'User 9',
 '2000-09-01',
 'password9'
 ),
 (
 'user10@example.com',
 'User 10',
 '2000-10-01',
 'password10'
 );
 
 -- Fake data for 'tickets' table (at least 10 entries)
 INSERT INTO
 `tickets` (
 `uid`,
 `eid`,
 `booking_date`,
 `event_rules`,
 `event_date`,
 `cost`
 )
 VALUES
 (
 1,
 1,
 '2024-03-01 10:00:00',
 'Event rules for Ticket 1',
 '2024-03-08 10:00:00',
 10.00
 ),
 (
 2,
 2,
 '2024-03-02 10:00:00',
 'Event rules for Ticket 2',
 '2024-03-15 14:00:00',
 15.00
 ),
 (
 3,
 3,
 '2024-03-03 10:00:00',
 'Event rules for Ticket 3',
 '2024-03-22 18:00:00',
 20.00
 ),
 (
 4,
 4,
 '2024-03-04 10:00:00',
 'Event rules for Ticket 4',
 '2024-03-29 10:00:00',
 25.00
 ),
 (
 5,
 5,
 '2024-03-05 10:00:00',
 'Event rules for Ticket 5',
 '2024-04-05 14:00:00',
 30.00
 ),
 (
 6,
 6,
 '2024-03-06 10:00:00',
 'Event rules for Ticket 6',
 '2024-04-12 18:00:00',
 35.00
 ),
 (
 7,
 7,
 '2024-03-07 10:00:00',
 'Event rules for Ticket 7',
 '2024-04-19 10:00:00',
 40.00
 ),
 (
 8,
 8,
 '2024-03-08 10:00:00',
 'Event rules for Ticket 8',
 '2024-04-26 14:00:00',
 45.00
 ),
 (
 9,
 9,
 '2024-03-09 10:00:00',
 'Event rules for Ticket 9',
 '2024-05-03 18:00:00',
 50.00
 ),
 (
 10,
 10,
 '2024-03-10 10:00:00',
 'Event rules for Ticket 10',
 '2024-05-10 10:00:00',
 55.00
 );
 */