-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-07-13 22:43:22
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `shopping_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Dresses'),
(2, 'Tops'),
(3, 'Accessories'),
(4, 'Bag'),
(5, 'Bottoms'),
(6, 'Tunic'),
(7, 'See-throughs');

-- --------------------------------------------------------

--
-- 表的结构 `image_list`
--

CREATE TABLE `image_list` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `image_list`
--

INSERT INTO `image_list` (`id`, `product_id`, `image_url`) VALUES
(1, 3, 'img/products/Black_Collection/Detail_3/1.jpg'),
(3, 1, 'img/products/Black_Collection/Detail_1/1.jpg'),
(5, 1, 'img/products/Black_Collection/Detail_1/3.jpg'),
(6, 1, 'img/products/Black_Collection/Detail_1/4.jpg'),
(7, 3, 'img/products/Black_Collection/Detail_3/3.webp'),
(8, 3, 'img/products/Black_Collection/Detail_3/4.webp'),
(9, 2, 'img/products/Black_Collection/Detail_2/1.jpg'),
(10, 2, 'img/products/Black_Collection/Detail_2/2.jpg'),
(11, 2, 'img/products/Black_Collection/Detail_2/3.jpg'),
(12, 4, 'img/products/Black_Collection/Detail_4/1.jpg'),
(13, 4, 'img/products/Black_Collection/Detail_4/2.jpg'),
(14, 4, 'img/products/Black_Collection/Detail_4/3.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `collection` varchar(25) NOT NULL,
  `main_image_url` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `collection`, `main_image_url`, `category_id`) VALUES
(1, 'Tulle ballon tunic', 'Balloon velinic featuring a luxurious use of three -dimensional tulle fabric.\r\n\r\nBy tailoring with tulle fabric, lightness is expressed, and for a moving design.\r\n\r\nThe chest is compact, and the shoulder straps are made of spaghetti code, giving a sophisticated and delicate impression.\r\n\r\nIt is an excellent thing that can be widely used, such as casual down styling and dressy items combined with street -like denim items.\r\n\r\n* Regarding the size, the measurement is performed by hand one by one, so some gaps may occur.\r\n* An error may occur depending on the characteristics of the fabric.', 677.00, 15, 'Black Collection 2025', 'img/products/Black_Collection/Item_1_Tunic.webp', 6),
(2, 'Balloon sleeve cocoon dress', 'A gorgeous cocoon dress with a rounded, three-dimensional silhouette. The large tucks at the neck and the fluffy balloon sleeves create a romantic mood. Made from a firm jacquard fabric, it exudes a luxurious and sophisticated atmosphere. It is a carefully crafted piece that accentuates the beautiful shape. It is perfect for special occasions, but can also be worn casually with a cap and sneakers for everyday wear.', 810.00, 2, 'Black Collection 2025', 'img/products/Black_Collection/Item_2_Dress.webp\r\n', 1),
(3, 'Pointe Backpack ', '\"Let\'s travel lightly\"\r\n\r\nI want to bring it to the future, and I hope I can travel lightly with all my memories and amulets that protect me.\r\n\r\nTo you who want to go lightly with a lot of luggage but can\'t find the perfect backpack\r\n\r\n“Pointe” is a backpack with a fleeting, delicate and dignified gloss inspired by the elegance of the ballerina.\r\n\r\nUse the original quilting fabric on the entire surface. The floral pattern and the design of the wafeline express the gorgeousness and kindness.\r\n\r\nIn addition, the scalap part of the flap is embroidered with a small floral pattern, giving a delicate impression.\r\n\r\nThe shoulder string is made of glossy material so that it does not give too much sporty impression, making it a light design that is easy to match with feminine and girly style.\r\n\r\nThe size of the A4 size is perfect, and it is a size that is easy to use for both daily/business.\r\n\r\n* Body weight: 500g\r\n\r\n* Regarding the size, the measurement is performed by hand one by one, so some gaps may occur.\r\n\r\n* An error may occur depending on the characteristics of the fabric.', 648.00, 3, 'Black Collection 2025', 'img/products/Black_Collection/Item_3_Bag.jpg', 4),
(4, 'Flower jacquard cap', 'A cap made of jacquard fabric with a pop floral pattern that stands out. The casual cap shape is combined with the gorgeous and decorative jacquard fabric for a contrasting design. The front features a three-dimensional \"Flower\" embroidery, and the combination of the romantic font and black background is an eye-catching accent. While the material has a distinctive feel, the black color tightens up the styling, making this an easy-to-use item. *We also have the \"Flower jacquard cami tunic\" made of the same fabric.', 233.00, 3, 'Black Collection 2025', 'img/products/Black_Collection/Item_4_Cap.jpg', 3);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转储表的索引
--

--
-- 表的索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 表的索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `image_list`
--
ALTER TABLE `image_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- 表的索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- 表的索引 `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- 表的索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `image_list`
--
ALTER TABLE `image_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 限制导出的表
--

--
-- 限制表 `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 限制表 `image_list`
--
ALTER TABLE `image_list`
  ADD CONSTRAINT `image_list_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- 限制表 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- 限制表 `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- 限制表 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
