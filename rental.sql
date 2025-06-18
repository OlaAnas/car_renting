CREATE TABLE `account` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int DEFAULT NULL
);

INSERT INTO `account` (`id`, `email`, `password`, `role`) VALUES
(9, 'kelvin@kelvin.nl', '$2y$12$w2fuXiPg1m2jC.C9BCCB5ebeEPNUcwxVp2StqdFJa9y62xwwmfKWK', NULL),
(10, 'cassandra@cassandra.nl', '$2y$12$pVGqaOKe9t0QZZozeub4ueghtgx09JEKWb/ohSPhh6VCucC8Zpplm', NULL);

ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
  
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

CREATE TABLE `car` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
);

-- Example data
INSERT INTO `car` (`name`, `brand`, `image`, `price_per_day`, `description`) VALUES
('Model S', 'Tesla', 'assets/images/products/car (0).svg', 120.00, 'A premium electric sedan.'),
('Mustang', 'Ford', 'assets/images/products/car (1).svg', 90.00, 'A classic American muscle car.'),
('Civic', 'Honda', 'assets/images/products/car (2).svg', 60.00, 'A reliable and efficient compact car.');