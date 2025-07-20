CREATE DATABASE IF NOT EXISTS EventX;

USE EventX;

CREATE TABLE IF NOT EXISTS users (
    uid INT(4) PRIMARY KEY AUTO_INCREMENT,
    email TEXT NOT NULL UNIQUE,
    username varchar(16) NOT NULL,
    birthdate DATE,
    `password` varchar(18) NOT NULL
);

CREATE TABLE IF NOT EXISTS organizers (
    oid INT(3) PRIMARY KEY AUTO_INCREMENT,
    email TEXT NOT NULL UNIQUE,
    organization_name varchar(18) NOT NULL UNIQUE,
    bio TEXT,
    `password` varchar(18) NOT NULL
);

CREATE TABLE IF NOT EXISTS organizers_contacts (
    oid INT(3) PRIMARY KEY AUTO_INCREMENT,
    contact TEXT NOT NULL,
    content_type ENUM('email', 'phone', 'Unknown') AS (
        CASE
            WHEN contact LIKE '%@%' THEN 'email'
            WHEN contact LIKE '%[0-9]%' THEN 'phone'
            ELSE 'Unknown'
        END
    )
);

CREATE TABLE IF NOT EXISTS tags (
    tag_id INT(3) PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(12) NOT NULL
);

CREATE TABLE IF NOT EXISTS events (
    eid INT(5) PRIMARY KEY AUTO_INCREMENT,
    title varchar(24) NOT NULL,
    description TEXT,
    start_at DATETIME,
    end_at DATETIME,
    details TEXT NOT NULL,
    location VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS events_tags (
    eid INT(5),
    tag_id INT(3),
    PRIMARY KEY(eid, tag_id),
    FOREIGN KEY(eid) REFERENCES events(eid),
    FOREIGN KEY(tag_id) REFERENCES tags(tag_id)
);

CREATE TABLE IF NOT EXISTS tickets (
    tid INT(6) PRIMARY KEY AUTO_INCREMENT,
    uid INT(4),
    eid INT(5),
    booking_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    event_rules TEXT,
    event_date DATETIME NOT NULL,
    cost DECIMAL(8, 2) DEFAULT 0.00
);