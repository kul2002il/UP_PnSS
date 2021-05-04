
CREATE DATABASE up_pnss DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

USE up_pnss;

CREATE TABLE portfolio(
	id INT AUTO_INCREMENT PRIMARY KEY,
	year INT,
	site VARCHAR(300) NOT NULL,
	description TEXT
);

INSERT INTO portfolio (year, site, description) VALUES
(2012, 'http://DunkelBeer.ru', 'Промо-сайт темного пива Dunkel от немецкого производителя Löwenbraü выпускаемого в России пивоваренной компанией "CАН ИнБев".'),
(2012, 'http://ZopoMobile.ru', 'Русскоязычный каталог китайских телефонов компании Zopo на базе Android OS и аксессуаров к ним.'),
(2021, 'http://ZopoMobileNew.ru', 'Переехаший сайт ZopoMobile.ru.');


