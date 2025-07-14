-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-07-14 21:13:41
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
(14, 4, 'img/products/Black_Collection/Detail_4/3.jpg'),
(15, 5, 'img/products/Early_Summer_Collection/Detail_1/1.jpg'),
(16, 5, 'img/products/Early_Summer_Collection/Detail_1/2.jpg'),
(17, 5, 'img/products/Early_Summer_Collection/Detail_1/3.jpg'),
(18, 6, 'img/products/Early_Summer_Collection/Detail_2/1.jpg'),
(19, 6, 'img/products/Early_Summer_Collection/Detail_2/2.jpg'),
(20, 6, 'img/products/Early_Summer_Collection/Detail_2/3.jpg'),
(21, 7, 'img/products/Early_Summer_Collection/Detail_3/1.jpg'),
(22, 7, 'img/products/Early_Summer_Collection/Detail_3/2.jpg'),
(23, 7, 'img/products/Early_Summer_Collection/Detail_3/3.jpg'),
(24, 8, 'img/products/Early_Summer_Collection/Detail_4/1.jpg'),
(25, 8, 'img/products/Early_Summer_Collection/Detail_4/2.jpg'),
(26, 8, 'img/products/Early_Summer_Collection/Detail_4/3.jpg'),
(27, 9, 'img/products/Early_Summer_Collection/Detail_5/1.jpg'),
(28, 9, 'img/products/Early_Summer_Collection/Detail_5/2.jpg'),
(29, 9, 'img/products/Early_Summer_Collection/Detail_5/3.jpg'),
(30, 10, 'img/products/Early_Summer_Collection/Detail_6/2.jpg'),
(31, 10, 'img/products/Early_Summer_Collection/Detail_6/3.jpg'),
(32, 10, 'img/products/Early_Summer_Collection/Detail_6/1.jpg'),
(33, 12, 'img/products/POPPY_KEITAMARUYAMA/Detail_1/1.jpg'),
(34, 12, 'img/products/POPPY_KEITAMARUYAMA/Detail_1/2.jpg'),
(35, 12, 'img/products/POPPY_KEITAMARUYAMA/Detail_1/3.jpg'),
(36, 13, 'img/products/POPPY_KEITAMARUYAMA/Detail_2/1.jpg'),
(37, 13, 'img/products/POPPY_KEITAMARUYAMA/Detail_2/2.jpg'),
(38, 13, 'img/products/POPPY_KEITAMARUYAMA/Detail_2/3.jpg'),
(39, 14, 'img/products/POPPY_KEITAMARUYAMA/Detail_3/1.jpg'),
(40, 14, 'img/products/POPPY_KEITAMARUYAMA/Detail_3/2.jpg'),
(41, 14, 'img/products/POPPY_KEITAMARUYAMA/Detail_3/3.jpg'),
(42, 15, 'img/products/POPPY_KEITAMARUYAMA/Detail_4/1.jpg'),
(43, 15, 'img/products/POPPY_KEITAMARUYAMA/Detail_4/2.jpg'),
(44, 15, 'img/products/POPPY_KEITAMARUYAMA/Detail_4/3.jpg'),
(45, 16, 'img/products/POPPY_KEITAMARUYAMA/Detail_5/1.jpg'),
(46, 16, 'img/products/POPPY_KEITAMARUYAMA/Detail_5/2.jpg'),
(47, 16, 'img/products/POPPY_KEITAMARUYAMA/Detail_5/3.jpg'),
(48, 17, 'img/products/POPPY_KEITAMARUYAMA/Detail_6/1.jpg'),
(49, 17, 'img/products/POPPY_KEITAMARUYAMA/Detail_6/2.jpg'),
(50, 17, 'img/products/POPPY_KEITAMARUYAMA/Detail_6/3.jpg'),
(51, 18, 'img/products/Spring_Collection/Detail_1/1.jpg'),
(52, 18, 'img/products/Spring_Collection/Detail_1/2.png'),
(53, 18, 'img/products/Spring_Collection/Detail_1/3.jpg'),
(54, 19, 'img/products/Spring_Collection/Detail_2/1.jpg'),
(55, 19, 'img/products/Spring_Collection/Detail_2/2.jpg'),
(56, 19, 'img/products/Spring_Collection/Detail_2/3.jpg'),
(57, 20, 'img/products/Spring_Collection/Detail_3/1.jpg'),
(58, 20, 'img/products/Spring_Collection/Detail_3/2.jpg'),
(62, 21, 'img/products/Spring_Collection/Detail_3/3.jpg'),
(63, 21, 'img/products/Spring_Collection/Detail_4/1.jpg'),
(64, 21, 'img/products/Spring_Collection/Detail_4/2.jpg'),
(65, 21, 'img/products/Spring_Collection/Detail_4/3.jpg'),
(67, 22, 'img/products/Spring_Collection/Detail_5/1.jpg'),
(68, 22, 'img/products/Spring_Collection/Detail_5/2.jpg'),
(69, 22, 'img/products/Spring_Collection/Detail_5/3.jpg'),
(70, 23, 'img/products/Spring_Collection/Detail_6/1.jpg'),
(71, 23, 'img/products/Spring_Collection/Detail_6/2.jpg'),
(72, 23, 'img/products/Spring_Collection/Detail_6/3.jpg');

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
(4, 'Flower jacquard cap', 'A cap made of jacquard fabric with a pop floral pattern that stands out. The casual cap shape is combined with the gorgeous and decorative jacquard fabric for a contrasting design. The front features a three-dimensional \"Flower\" embroidery, and the combination of the romantic font and black background is an eye-catching accent. While the material has a distinctive feel, the black color tightens up the styling, making this an easy-to-use item. *We also have the \"Flower jacquard cami tunic\" made of the same fabric.', 233.00, 3, 'Black Collection 2025', 'img/products/Black_Collection/Item_4_Cap.jpg', 3),
(5, 'Wave gathered peplum bustier', 'The corset design gives a sophisticated impression, making it a versatile item that will enhance your style.\r\n\r\nThe mini length adds an airy feel.\r\n\r\nThe firm texture and volume create a silhouette with a three-dimensional feel that looks like it contains wind.', 781.00, 2, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_1_Tunic.webp\r\n', 6),
(6, 'Cocoon border t-shirt', 'A striped T-shirt with a pop coloring characteristic of POPPY.\r\n\r\nIt has a loose, loose fit and is easy to pick up.\r\n\r\nThe front hem is curved, and the silhouette can be freely adjusted with the drawstrings on the side.\r\n', 372.00, 4, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_3_Top.jpg\r\n', 2),
(7, 'Gold jacquard corset skirt', 'The corset design gives a sophisticated impression, making it a versatile item that will enhance your style.\r\n\r\nThe mini length adds an airy feel.\r\n\r\nThe firm texture and volume create a silhouette with a three-dimensional feel that looks like it contains wind.', 840.00, 2, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_2_Bottom.jpg\r\n', 5),
(8, 'Dot organgy tiered dress', 'A glamorous mini dress with eye-catching gold and light blue jacquard fabric.\r\n\r\nThis is a voluminous tiered design made from luxurious fabric.\r\n\r\nThe airy balloon sleeve is a 2-way design that can be worn as an off-shoulder.', 973.00, 1, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_4_Dress.jpg\r\n', 1),
(9, 'Gold jacquard puff mini dress', 'A striped T-shirt with a pop coloring characteristic of POPPY.\r\n\r\nIt has a loose, loose fit and is easy to pick up.\r\n\r\nThe front hem is curved, and the silhouette can be freely adjusted with the drawstrings on the side.\r\n', 972.00, 4, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_5_Dress.jpg\r\n', 1),
(10, 'Pleated long denim skirt', 'The corset design gives a sophisticated impression, making it a versatile item that will enhance your style.\r\n\r\nThe mini length adds an airy feel.\r\n\r\nThe firm texture and volume create a silhouette with a three-dimensional feel that looks like it contains wind.', 878.00, 1, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_6_Bottom.jpg\r\n', 5),
(12, 'Tiger art tote bag', 'A special collaboration item that combines KEITA MARUYAMA and POPPY patterns to create a piece of art. The design features a striking contrast between a dynamic tiger pattern and vibrant art that evokes the texture of paint. Collaborative embroidery on the front adds a special touch. With long handles that make it easy to carry on your shoulder and a wide gusset that can hold plenty of belongings, this highly functional tote bag is perfect for daily use, whether commuting to work, school, or outings. *Comes with a removable bottom plate', 260.00, 10, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_1_Bag.jpg\r\n', 4),
(13, 'Peach flower see-through tops (high neck)', 'A special collaboration item that combines the patterns of KEITA MARUYAMA and POPPY to create a single piece of art. The two contrasting pieces of art create an exquisite balance that draws the eye. The design is a mix of Japanese and Western styles, with a peach motif and roses. By linking the pattern placement and coloring, this piece allows you to enjoy both a unified atmosphere and the contrast between the motifs. --- The longer sleeves beautifully show off the lines of your arms, so they are less bulky when layered on top. The clean silhouette of the waistline and sleeves gives it a more stylish impression. It can be used as a layered item, or as a single piece for a casual, mode look, and can be used for a long season. It is easy to wear with excellent elasticity, has a smooth and comfortable feel, and is so light that you don\'t even feel the weight when wearing it. ', 448.00, 1, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_2.jpg\r\n\r\n', 7),
(14, 'Romantic patchwork tiered mini dress', 'A special collaboration item that combines KEITA MARUYAMA and POPPY patterns to create a work of art. The patchwork design is like a treasure chest, combining colorful patterns ranging from romantic to pop to sophisticated. Just wearing it will brighten up your mood. This mini dress features fluffy, voluminous sleeves and a gorgeous tiered design that will catch your eye. Made from organza fabric that combines a light texture with just the right amount of firmness, it creates a beautiful, three-dimensional silhouette. Perfect for special occasions or outings, it is also recommended for a casual look by pairing it with sweatshirts and denim items.', 723.00, 10, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_3.jpg\r\n', 1),
(15, 'Romantic patchwork organdy cami dress', 'A special collaboration item that combines KEITA MARUYAMA and POPPY patterns and incorporates them into a classic organza dress. The charm of this piece is the patchwork design that is like a treasure chest, combining colorful patterns from romantic to pop to sophisticated. Just wearing it will brighten up your mood. This dress has a light and fluffy silhouette that spreads out. The chest area has a switch and gathers, creating a delicate yet three-dimensional design. You can enjoy various styling such as layering it with a T-shirt or a see-through top, or wearing it as a skirt over a cut-and-sew or shirt. It is a great item that can be worn all year round. \r\n*The shoulder straps are adjustable.', 790.00, 14, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_4.jpg\r\n\r\n', 1),
(16, 'Peach flower see-through tops (round neck)', 'A special collaboration item that combines KEITA MARUYAMA and POPPY patterns to create a work of art. The patchwork design is like a treasure chest, combining colorful patterns ranging from romantic to pop to sophisticated. Just wearing it will brighten up your mood. \r\nThe longer sleeves flatter the lines of your arms, so they don\'t look bulky when layered. The sleek waistline and sleeves give a more stylish impression. It can be worn as a layered item, or as a single piece for a casual, fashionable look, making it perfect for a long season. It\'s easy to wear with excellent elasticity, has a smooth, comfortable feel, and is so light that you won\'t even notice the weight when wearing it. *The round neck has a clean, open design that makes your décolleté look even more beautiful. We also have a high-neck design in the same fabric.', 448.00, 10, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_5.jpg\r\n', 7),
(17, 'Romantic patchwork scarf', 'A special collaboration item that combines KEITA MARUYAMA and POPPY patterns to create a piece of art. The patchwork design is like a treasure chest, combining colorful patterns ranging from romantic to pop to sophisticated. Just wearing it will brighten up your mood. The delicate white collaboration embroidery adds a special touch. The compact size is attractive, and it is also recommended as a one-point accent around the neck or arm. It adds a subtle personality to your styling.', 292.00, 14, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_6.jpg\r\n\r\n', 3),
(18, 'Picnic see-through tops (round neck)', 'Photo print tops with picnic scenery reminiscent of warm seasonal visit.\r\n\r\nThe expression of the print unique to real photos is a nostalgic and artistic impression somewhere.\r\n\r\nThe long sleeve length makes the arm line beautifully fascinated, so it is difficult to bulk when stacked on top.\r\n\r\nBy making the waistline and sleeves a neat silhouette, a more stylish impression.\r\n\r\nAs a layered item, of course, it is an excellent thing that can be dressed in mode with one piece, and it plays an active part in the long season.\r\n\r\nIt is also a nice point that it has excellent elasticity and ease of wear, has a light and comfortable touch, and has a light texture that does not feel the weight when worn.\r\n\r\n', 422.00, 5, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_1.jpg\r\n\r\n', 7),
(19, 'Organdy flare mini dress', 'A mini dress with a soft volume sleeve and a gorgeous tiard switching design.\r\n\r\nUsing an organdy fabric that has a light texture and moderate firmness, it creates a beautiful silhouette with a three -dimensional feeling.\r\n\r\nWe recommend casually down coordination by combining sweatshirts and denim items as well as special plans and outings.', 584.00, 4, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_2.jpg\r\n\r\n', 1),
(20, 'Flower jacquard cap', 'A jacquard cap featuring a three -dimensional flower motif.\r\n\r\nWhile creating a sophistication with a clear white jacquard, it maintains the balance with the pop flower pattern.\r\n\r\nThe embroidery of the Poppy emblem accents.', 174.00, 20, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_3.jpg\r\n\r\n', 3),
(21, 'Lace layered round tops', 'Layered items of long sleeve tops and race tanks.\r\n\r\nThe vivid deep green colors the styling gorgeously.\r\n\r\nThe delicate lace fabric is luxuriously used, and the clean neck creates a sense of omission.\r\n\r\nA romantic accent is added to the chest of the race tank.\r\n\r\nThe stylish silhouette features a design that can be expected to improve style.\r\n\r\nSince it can be worn in separate separate, it is widely used not only as styling with tops as a leading role, but also as layered items such as dresses.\r\n\r\n', 372.00, 4, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_4.jpg\r\n\r\n', 2),
(22, 'Corset semi-wide pants', 'Design pants with a sophisticated impression that incorporates corset details.\r\n\r\nHigh waist corset design fulfills style up, and semi -wide silhouettes casually cover the body line.\r\n\r\nThe details of the tack and zipper are accented, adding individuality to cool.\r\n\r\nIt is an excellent thing that can be used in the business scene with a stylish impression.', 584.00, 10, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_5.jpg\r\n\r\n', 5),
(23, 'Sky color handkerchief hem tunic', 'A handkerchief hem tunic with an attractive flared silhouette with beautiful drapes.\r\n\r\nThe denim fabric has an uneven color that looks like the sky, creating an art-like design.\r\n\r\nThe relaxed look on the back and delicate shoulder straps express sophistication, and the romantic lace on the chest adds details that will never forget the feminine essence.\r\n\r\nThis is a great item that can be worn all year round depending on the items you layer.\r\n\r\n*The zipper will be changed to a silver hidden crucian type.', 410.00, 10, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_6.jpg\r\n\r\n', 6);

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
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'RoseWang', '$2y$10$UQUBuo9QtSMFZ4I8ioTuQeDUTOV34v7FpfFo.ti2FMCsCqhneMzvK', 'DMT2209231@xmu.edu.my'),
(2, '12', '$2y$10$bsQfvSE.XQEtehW9mWfvr.OEs04TOFgob/UAmp.FfiJv1c0UFBKeG', 'rosewuxi@gmail.com'),
(3, 'lzj', '$2y$10$3zgn9kI8TMlumykTZcCHNuwlgghLyMIgiKwdOkD1fYOmX4yrgzESi', 'lzj@xmu.edu.my');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
