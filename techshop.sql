-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Oca 2022, 18:39:57
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `techshop`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cart`
--

CREATE TABLE `cart` (
  `cartid` int(10) NOT NULL,
  `customerid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `cart`
--

INSERT INTO `cart` (`cartid`, `customerid`) VALUES
(4, 16),
(5, 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cartitem`
--

CREATE TABLE `cartitem` (
  `cartid` int(10) NOT NULL,
  `productid` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `company`
--

CREATE TABLE `company` (
  `companyid` int(10) NOT NULL,
  `companyname` varchar(30) NOT NULL,
  `companypassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `company`
--

INSERT INTO `company` (`companyid`, `companyname`, `companypassword`) VALUES
(1, 'samsund', '123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer`
--

CREATE TABLE `customer` (
  `customerid` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fname` varchar(10) NOT NULL,
  `lname` varchar(10) NOT NULL,
  `telephone` int(13) NOT NULL,
  `country` varchar(15) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `customer`
--

INSERT INTO `customer` (`customerid`, `email`, `password`, `fname`, `lname`, `telephone`, `country`, `adress`) VALUES
(16, 'orkuncinar9@hotmail.com', '123123', 'ORKUN', 'ÇINAR', 2147483647, NULL, NULL),
(17, 'abc@bnc.com', '12345', 'Goku', 'coku', 555123123, NULL, NULL);

--
-- Tetikleyiciler `customer`
--
DELIMITER $$
CREATE TRIGGER `customer_after_cart` AFTER INSERT ON `customer` FOR EACH ROW begin
  insert into cart (cartid, customerid) values (NULL, new.customerid);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orderitem`
--

CREATE TABLE `orderitem` (
  `orderid` int(10) NOT NULL,
  `productid` int(10) NOT NULL,
  `productname` varchar(30) NOT NULL,
  `productimage` varchar(300) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `orderitem`
--

INSERT INTO `orderitem` (`orderid`, `productid`, `productname`, `productimage`, `quantity`, `price`) VALUES
(12, 13, 'ayfon99', 'camera/61d1d607ae283.jpg', 1, 123),
(13, 13, 'ayfon99', 'camera/61d1d607ae283.jpg', 14, 123),
(13, 13, 'ayfon99', 'camera/61d1d607ae283.jpg', 1, 123),
(18, 13, 'Phone', 'phone/61d316100ee93.jpg', 1, 1000),
(18, 20, 'Game Console', 'gameconsole/61d31631c1aa5.jpg', 1, 2500),
(18, 21, 'Computer', 'computer/61d3165271c91.jpg', 2, 5000),
(19, 23, 'Phone 3', 'phone/61d31977039e3.png', 1, 2000),
(19, 28, 'Game Console 2', 'gameconsole/61d31aeac0449.jpg', 1, 4600);

--
-- Tetikleyiciler `orderitem`
--
DELIMITER $$
CREATE TRIGGER `product_quantity_update` AFTER INSERT ON `orderitem` FOR EACH ROW BEGIN

UPDATE product 
   SET soldquantity=product.soldquantity+NEW.quantity
   WHERE productid = NEW.productid;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `orderid` int(10) NOT NULL,
  `orderdate` date NOT NULL DEFAULT current_timestamp(),
  `paymenttype` varchar(15) NOT NULL,
  `shippingaddress` varchar(255) NOT NULL,
  `customerid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`orderid`, `orderdate`, `paymenttype`, `shippingaddress`, `customerid`) VALUES
(12, '2022-01-03', 'creditcard', 'Türkiye asdasdasdsadsadf asfasdasd\r\nasdsa', 16),
(13, '2022-01-03', 'creditcard', 'Türkiye asdasdasdsadsadf asfasdasd\r\nasdsa', 16),
(18, '2022-01-03', 'creditcard', 'asd asd', 17),
(19, '2022-01-03', 'creditcard', 'tr asdasdads', 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product`
--

CREATE TABLE `product` (
  `productid` int(10) NOT NULL,
  `companyid` int(10) NOT NULL,
  `productname` varchar(30) NOT NULL,
  `productdescription` varchar(300) DEFAULT NULL,
  `productprice` int(8) NOT NULL,
  `category` varchar(30) NOT NULL,
  `image` varchar(300) NOT NULL,
  `soldquantity` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `product`
--

INSERT INTO `product` (`productid`, `companyid`, `productname`, `productdescription`, `productprice`, `category`, `image`, `soldquantity`) VALUES
(13, 1, 'Phone', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 1000, 'phone', 'phone/61d316100ee93.jpg', 16),
(18, 1, 'Camera', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 500, 'camera', 'camera/61d315fc02da6.jpg', 0),
(19, 1, 'TV', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 10000, 'television', 'television/61d315e3b2ea8.jpg', 0),
(20, 1, 'Game Console', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 2500, 'gameconsole', 'gameconsole/61d31631c1aa5.jpg', 1),
(21, 1, 'Computer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 5000, 'computer', 'computer/61d3165271c91.jpg', 2),
(22, 1, 'Phone 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 3000, 'phone', 'phone/61d318c62c501.jpg', 0),
(23, 1, 'Phone 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 2000, 'phone', 'phone/61d31977039e3.png', 1),
(24, 1, 'Camera2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 6000, 'camera', 'camera/61d319c829d48.jpg', 0),
(25, 1, 'Camera 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 1500, 'camera', 'camera/61d319e724ee0.jpg', 0),
(26, 1, 'Computer 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 6000, 'computer', 'computer/61d31a60e58a2.jpg', 0),
(27, 1, 'TV 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 9000, 'television', 'television/61d31a7da7296.jpg', 0),
(28, 1, 'Game Console 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillu', 4600, 'gameconsole', 'gameconsole/61d31aeac0449.jpg', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`),
  ADD KEY `cartcustomerid` (`customerid`);

--
-- Tablo için indeksler `cartitem`
--
ALTER TABLE `cartitem`
  ADD KEY `cartitemcartid` (`cartid`),
  ADD KEY `cartitemproductid` (`productid`);

--
-- Tablo için indeksler `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyid`);

--
-- Tablo için indeksler `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Tablo için indeksler `orderitem`
--
ALTER TABLE `orderitem`
  ADD KEY `orteritemorderid` (`orderid`),
  ADD KEY `orderitemproductid` (`productid`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `orderscustomerid` (`customerid`);

--
-- Tablo için indeksler `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `productcompanyid` (`companyid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `company`
--
ALTER TABLE `company`
  MODIFY `companyid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cartcustomerid` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitemcartid` FOREIGN KEY (`cartid`) REFERENCES `cart` (`cartid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartitemproductid` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitemproductid` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orteritemorderid` FOREIGN KEY (`orderid`) REFERENCES `orders` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orderscustomerid` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `productcompanyid` FOREIGN KEY (`companyid`) REFERENCES `company` (`companyid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
