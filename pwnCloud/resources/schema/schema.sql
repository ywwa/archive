-- CREATE TABLE `customers` (
--  `id` int(11) NOT NULL AUTO_INCREMENT,
--  `number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--  `country` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--  PRIMARY KEY (`id`),
--  UNIQUE KEY `number` (`number`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci


CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `firstname` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `lastname` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `access_token` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `date_joined` timestamp COLLATE utf8mb4_unicode_ci DEFAULT NOW(),
    `date_updated` timestamp COLLATE utf8mb4_unicode_ci DEFAULT NOW() ON UPDATE NOW(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` ( `username` ),
    UNIQUE KEY `email` ( `email` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

