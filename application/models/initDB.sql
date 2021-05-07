
#DROP DATABASE up_pnss;
CREATE DATABASE up_pnss DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

USE up_pnss;

CREATE TABLE users(
	id INT AUTO_INCREMENT PRIMARY KEY,
	login VARCHAR(300) NOT NULL,
	password VARCHAR(255) NOT NULL
);

CREATE TABLE roles(
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(300) NOT NULL
);

CREATE TABLE includes_role(
	id INT AUTO_INCREMENT PRIMARY KEY,
	role INT NOT NULL,
	user INT NOT NULL,

	FOREIGN KEY (role) REFERENCES roles (id) ON DELETE CASCADE,
	FOREIGN KEY (user) REFERENCES users (id) ON DELETE CASCADE
);

CREATE TABLE portfolio(
	id INT AUTO_INCREMENT PRIMARY KEY,
	year INT,
	site VARCHAR(300) NOT NULL,
	description TEXT
);

INSERT INTO users (login, password) VALUES
('sudo', '75ig//eBR04HY'),
('admin', '757va0lgB4kpM'),
('user', '75bUXAuHldJ82');

INSERT INTO roles (name) VALUES
('superuser'),
('admin');

INSERT INTO includes_role (role, user) VALUES
(1, 1),
(2, 2);

INSERT INTO portfolio (year, site, description) VALUES
(2012, 'http://DunkelBeer.ru', 'Промо-сайт темного пива Dunkel от немецкого производителя Löwenbraü выпускаемого в России пивоваренной компанией "CАН ИнБев".'),
(2012, 'http://ZopoMobile.ru', 'Русскоязычный каталог китайских телефонов компании Zopo на базе Android OS и аксессуаров к ним.'),
(2021, 'http://ZopoMobileNew.ru', 'Переехаший сайт ZopoMobile.ru.');


