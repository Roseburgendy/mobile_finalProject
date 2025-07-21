-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-07-21 21:57:30
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

--
-- 转存表中的数据 `cart`
--

INSERT INTO `cart` (`id`, `quantity`, `product_id`, `size`, `user_id`) VALUES
(162, 1, 2, 'M', 6);

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
(72, 23, 'img/products/Spring_Collection/Detail_6/3.jpg'),
(73, 24, 'img/products/General_Collection/1.png'),
(74, 24, 'img/products/General_Collection/2.png'),
(75, 24, 'img/products/General_Collection/3.png'),
(76, 25, 'img/products/General_Collection/Detail_2/1.png'),
(77, 25, 'img/products/General_Collection/Detail_2/2.png'),
(78, 26, 'img/products/General_Collection/Detail_3/1.png'),
(79, 26, 'img/products/General_Collection/Detail_3/2.png'),
(80, 27, 'img/products/General_Collection/Detail_4/1.png'),
(81, 27, 'img/products/General_Collection/Detail_4/2.png'),
(82, 27, 'img/products/General_Collection/Detail_4/3.png'),
(83, 27, 'img/products/General_Collection/Detail_4/4.png'),
(84, 28, 'img/products/General_Collection/D_5.png'),
(85, 29, 'img/products/General_Collection/D_6.png'),
(86, 30, 'img/products/General_Collection/D_7.png'),
(87, 31, 'img/products/General_Collection/D_8.png'),
(88, 32, 'img/products/General_Collection/D_9.png'),
(89, 33, 'img/products/General_Collection/D_10.png'),
(90, 34, 'img/products/General_Collection/D_11.png'),
(91, 35, 'img/products/General_Collection/D_12.png'),
(92, 36, 'img/products/General_Collection/D_13.png'),
(93, 37, 'img/products/General_Collection/D_14.png'),
(94, 38, 'img/products/General_Collection/D_15.png'),
(95, 39, 'img/products/General_Collection/D_16.png'),
(96, 40, 'img/products/General_Collection/D_17.png'),
(97, 41, 'img/products/General_Collection/D_18.png');

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
  `collection` varchar(25) NOT NULL,
  `main_image_url` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `has_size` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `collection`, `main_image_url`, `category_id`, `has_size`) VALUES
(1, 'Tulle ballon tunic', 'Balloon velinic featuring a luxurious use of three -dimensional tulle fabric.\r\n\r\nBy tailoring with tulle fabric, lightness is expressed, and for a moving design.\r\n\r\nThe chest is compact, and the shoulder straps are made of spaghetti code, giving a sophisticated and delicate impression.\r\n\r\nIt is an excellent thing that can be widely used, such as casual down styling and dressy items combined with street -like denim items.\r\n\r\n* Regarding the size, the measurement is performed by hand one by one, so some gaps may occur.\r\n* An error may occur depending on the characteristics of the fabric.', 677.00, 'Black Collection 2025', 'img/products/Black_Collection/Item_1_Tunic.webp', 6, 1),
(2, 'Balloon sleeve cocoon dress', 'A gorgeous cocoon dress with a rounded, three-dimensional silhouette. The large tucks at the neck and the fluffy balloon sleeves create a romantic mood. Made from a firm jacquard fabric, it exudes a luxurious and sophisticated atmosphere. It is a carefully crafted piece that accentuates the beautiful shape. It is perfect for special occasions, but can also be worn casually with a cap and sneakers for everyday wear.', 810.00, 'Black Collection 2025', 'img/products/Black_Collection/Item_2_Dress.webp\r\n', 1, 1),
(3, 'Pointe Backpack ', '\"Let\'s travel lightly\"\r\n\r\nI want to bring it to the future, and I hope I can travel lightly with all my memories and amulets that protect me.\r\n\r\nTo you who want to go lightly with a lot of luggage but can\'t find the perfect backpack\r\n\r\n“Pointe” is a backpack with a fleeting, delicate and dignified gloss inspired by the elegance of the ballerina.\r\n\r\nUse the original quilting fabric on the entire surface. The floral pattern and the design of the wafeline express the gorgeousness and kindness.\r\n\r\nIn addition, the scalap part of the flap is embroidered with a small floral pattern, giving a delicate impression.\r\n\r\nThe shoulder string is made of glossy material so that it does not give too much sporty impression, making it a light design that is easy to match with feminine and girly style.\r\n\r\nThe size of the A4 size is perfect, and it is a size that is easy to use for both daily/business.\r\n\r\n* Body weight: 500g\r\n\r\n* Regarding the size, the measurement is performed by hand one by one, so some gaps may occur.\r\n\r\n* An error may occur depending on the characteristics of the fabric.', 648.00, 'Black Collection 2025', 'img/products/Black_Collection/Item_3_Bag.jpg', 4, 1),
(4, 'Flower jacquard cap', 'A cap made of jacquard fabric with a pop floral pattern that stands out. The casual cap shape is combined with the gorgeous and decorative jacquard fabric for a contrasting design. The front features a three-dimensional \"Flower\" embroidery, and the combination of the romantic font and black background is an eye-catching accent. While the material has a distinctive feel, the black color tightens up the styling, making this an easy-to-use item. *We also have the \"Flower jacquard cami tunic\" made of the same fabric.', 233.00, 'Black Collection 2025', 'img/products/Black_Collection/Item_4_Cap.jpg', 3, 0),
(5, 'Wave gathered peplum bustier', 'The corset design gives a sophisticated impression, making it a versatile item that will enhance your style.\r\n\r\nThe mini length adds an airy feel.\r\n\r\nThe firm texture and volume create a silhouette with a three-dimensional feel that looks like it contains wind.', 781.00, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_1_Tunic.webp\r\n', 6, 1),
(6, 'Cocoon border t-shirt', 'A striped T-shirt with a pop coloring characteristic of POPPY.\r\n\r\nIt has a loose, loose fit and is easy to pick up.\r\n\r\nThe front hem is curved, and the silhouette can be freely adjusted with the drawstrings on the side.\r\n', 372.00, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_3_Top.jpg\r\n', 2, 1),
(7, 'Gold jacquard corset skirt', 'The corset design gives a sophisticated impression, making it a versatile item that will enhance your style.\r\n\r\nThe mini length adds an airy feel.\r\n\r\nThe firm texture and volume create a silhouette with a three-dimensional feel that looks like it contains wind.', 840.00, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_2_Bottom.jpg\r\n', 5, 1),
(8, 'Dot organgy tiered dress', 'A glamorous mini dress with eye-catching gold and light blue jacquard fabric.\r\n\r\nThis is a voluminous tiered design made from luxurious fabric.\r\n\r\nThe airy balloon sleeve is a 2-way design that can be worn as an off-shoulder.', 973.00, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_4_Dress.jpg\r\n', 1, 1),
(9, 'Gold jacquard puff mini dress', 'A striped T-shirt with a pop coloring characteristic of POPPY.\r\n\r\nIt has a loose, loose fit and is easy to pick up.\r\n\r\nThe front hem is curved, and the silhouette can be freely adjusted with the drawstrings on the side.\r\n', 972.00, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_5_Dress.jpg\r\n', 1, 1),
(10, 'Pleated long denim skirt', 'The corset design gives a sophisticated impression, making it a versatile item that will enhance your style.\r\n\r\nThe mini length adds an airy feel.\r\n\r\nThe firm texture and volume create a silhouette with a three-dimensional feel that looks like it contains wind.', 878.00, 'Early Summer Collection', 'img/products/Early_Summer_Collection/Item_6_Bottom.jpg\r\n', 5, 1),
(12, 'Tiger art tote bag', 'A special collaboration item that combines KEITA MARUYAMA and POPPY patterns to create a piece of art. The design features a striking contrast between a dynamic tiger pattern and vibrant art that evokes the texture of paint. Collaborative embroidery on the front adds a special touch. With long handles that make it easy to carry on your shoulder and a wide gusset that can hold plenty of belongings, this highly functional tote bag is perfect for daily use, whether commuting to work, school, or outings. *Comes with a removable bottom plate', 260.00, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_1_Bag.jpg\r\n', 4, 0),
(13, 'Peach flower see-through tops (high neck)', 'A special collaboration item that combines the patterns of KEITA MARUYAMA and POPPY to create a single piece of art. The two contrasting pieces of art create an exquisite balance that draws the eye. The design is a mix of Japanese and Western styles, with a peach motif and roses. By linking the pattern placement and coloring, this piece allows you to enjoy both a unified atmosphere and the contrast between the motifs. --- The longer sleeves beautifully show off the lines of your arms, so they are less bulky when layered on top. The clean silhouette of the waistline and sleeves gives it a more stylish impression. It can be used as a layered item, or as a single piece for a casual, mode look, and can be used for a long season. It is easy to wear with excellent elasticity, has a smooth and comfortable feel, and is so light that you don\'t even feel the weight when wearing it. ', 448.00, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_2.jpg\r\n\r\n', 7, 1),
(14, 'Romantic patchwork tiered mini dress', 'A special collaboration item that combines KEITA MARUYAMA and POPPY patterns to create a work of art. The patchwork design is like a treasure chest, combining colorful patterns ranging from romantic to pop to sophisticated. Just wearing it will brighten up your mood. This mini dress features fluffy, voluminous sleeves and a gorgeous tiered design that will catch your eye. Made from organza fabric that combines a light texture with just the right amount of firmness, it creates a beautiful, three-dimensional silhouette. Perfect for special occasions or outings, it is also recommended for a casual look by pairing it with sweatshirts and denim items.', 723.00, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_3.jpg\r\n', 1, 1),
(15, 'Romantic patchwork organdy cami dress', 'A special collaboration item that combines KEITA MARUYAMA and POPPY patterns and incorporates them into a classic organza dress. The charm of this piece is the patchwork design that is like a treasure chest, combining colorful patterns from romantic to pop to sophisticated. Just wearing it will brighten up your mood. This dress has a light and fluffy silhouette that spreads out. The chest area has a switch and gathers, creating a delicate yet three-dimensional design. You can enjoy various styling such as layering it with a T-shirt or a see-through top, or wearing it as a skirt over a cut-and-sew or shirt. It is a great item that can be worn all year round. \r\n*The shoulder straps are adjustable.', 790.00, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_4.jpg\r\n\r\n', 1, 1),
(16, 'Peach flower see-through tops (round neck)', 'A special collaboration item that combines KEITA MARUYAMA and POPPY patterns to create a work of art. The patchwork design is like a treasure chest, combining colorful patterns ranging from romantic to pop to sophisticated. Just wearing it will brighten up your mood. \r\nThe longer sleeves flatter the lines of your arms, so they don\'t look bulky when layered. The sleek waistline and sleeves give a more stylish impression. It can be worn as a layered item, or as a single piece for a casual, fashionable look, making it perfect for a long season. It\'s easy to wear with excellent elasticity, has a smooth, comfortable feel, and is so light that you won\'t even notice the weight when wearing it. *The round neck has a clean, open design that makes your décolleté look even more beautiful. We also have a high-neck design in the same fabric.', 448.00, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_5.jpg\r\n', 7, 1),
(17, 'Romantic patchwork scarf', 'A special collaboration item that combines KEITA MARUYAMA and POPPY patterns to create a piece of art. The patchwork design is like a treasure chest, combining colorful patterns ranging from romantic to pop to sophisticated. Just wearing it will brighten up your mood. The delicate white collaboration embroidery adds a special touch. The compact size is attractive, and it is also recommended as a one-point accent around the neck or arm. It adds a subtle personality to your styling.', 292.00, 'POPPY X KEITAMARUYAMA', 'img/products/POPPY_KEITAMARUYAMA/Item_6.jpg\r\n\r\n', 3, 0),
(18, 'Picnic see-through tops (round neck)', 'Photo print tops with picnic scenery reminiscent of warm seasonal visit.\r\n\r\nThe expression of the print unique to real photos is a nostalgic and artistic impression somewhere.\r\n\r\nThe long sleeve length makes the arm line beautifully fascinated, so it is difficult to bulk when stacked on top.\r\n\r\nBy making the waistline and sleeves a neat silhouette, a more stylish impression.\r\n\r\nAs a layered item, of course, it is an excellent thing that can be dressed in mode with one piece, and it plays an active part in the long season.\r\n\r\nIt is also a nice point that it has excellent elasticity and ease of wear, has a light and comfortable touch, and has a light texture that does not feel the weight when worn.\r\n\r\n', 422.00, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_1.jpg\r\n\r\n', 7, 1),
(19, 'Organdy flare mini dress', 'A mini dress with a soft volume sleeve and a gorgeous tiard switching design.\r\n\r\nUsing an organdy fabric that has a light texture and moderate firmness, it creates a beautiful silhouette with a three -dimensional feeling.\r\n\r\nWe recommend casually down coordination by combining sweatshirts and denim items as well as special plans and outings.', 584.00, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_2.jpg\r\n\r\n', 1, 1),
(20, 'Flower jacquard cap', 'A jacquard cap featuring a three -dimensional flower motif.\r\n\r\nWhile creating a sophistication with a clear white jacquard, it maintains the balance with the pop flower pattern.\r\n\r\nThe embroidery of the Poppy emblem accents.', 174.00, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_3.jpg\r\n\r\n', 3, 0),
(21, 'Lace layered round tops', 'Layered items of long sleeve tops and race tanks.\r\n\r\nThe vivid deep green colors the styling gorgeously.\r\n\r\nThe delicate lace fabric is luxuriously used, and the clean neck creates a sense of omission.\r\n\r\nA romantic accent is added to the chest of the race tank.\r\n\r\nThe stylish silhouette features a design that can be expected to improve style.\r\n\r\nSince it can be worn in separate separate, it is widely used not only as styling with tops as a leading role, but also as layered items such as dresses.\r\n\r\n', 372.00, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_4.jpg\r\n\r\n', 2, 1),
(22, 'Corset semi-wide pants', 'Design pants with a sophisticated impression that incorporates corset details.\r\n\r\nHigh waist corset design fulfills style up, and semi -wide silhouettes casually cover the body line.\r\n\r\nThe details of the tack and zipper are accented, adding individuality to cool.\r\n\r\nIt is an excellent thing that can be used in the business scene with a stylish impression.', 584.00, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_5.jpg\r\n\r\n', 5, 1),
(23, 'Sky color handkerchief hem tunic', 'A handkerchief hem tunic with an attractive flared silhouette with beautiful drapes.\r\n\r\nThe denim fabric has an uneven color that looks like the sky, creating an art-like design.\r\n\r\nThe relaxed look on the back and delicate shoulder straps express sophistication, and the romantic lace on the chest adds details that will never forget the feminine essence.\r\n\r\nThis is a great item that can be worn all year round depending on the items you layer.\r\n\r\n*The zipper will be changed to a silver hidden crucian type.', 410.00, 'Spring Collection 2025', 'img/products/Spring_Collection/Item_6.jpg\r\n\r\n', 6, 0),
(24, 'Half-moon gathered bag (Toile de Jouy)', 'A half -moon -type shoulder bag with a rounded and catchy form.\r\n\r\nUsing a fabric that is firm and glossy, the random tack sent throughout creates a romantic atmosphere.\r\n\r\nThe outside is a lace -up detail using eyelets, and the sweetness is also designed with an edge.\r\n\r\nIncorporate gathers into the shoulder strap to accent the coordination.\r\n\r\nThree colors of girly light pink, vivid light green with a trendy feeling, and romantic Toward juice pattern.\r\n\r\nIt is a fashionable item that matches feminine style and cool style.\r\n\r\n[Size]\r\nHeight: 20cm /Central part height: 17cm\r\nWidth: 35cm\r\n\r\n* Regarding the size, the measurement is performed by hand one by one, so some gaps may occur.\r\n\r\n* An error may occur depending on the characteristics of the fabric.', 728.00, 'General Collection', 'img/products/General_Collection/Detail_3/Item_1_Bag.png', 4, 1),
(25, 'Toile de Jouy cap', 'A typical poppy hat that strikes a balance between romance and casualness.\r\n\r\nThe design features subtle touches such as swans and ribbons that give an elegant impression while being easy to blend in casually.\r\n\r\nThe three-dimensional embroidery of the \"P\" is an accent, and the overall look is a highlight.\r\n\r\nThis item is full of the unique charm of poppies and matches feminine and casual clothing.', 199.00, 'General Collection', 'img/General_Collection/Item_2_Hat.png', 3, 0),
(26, '\"P\" embroidered denim bucket hat', '\"Candy Series\"\r\n\r\nKunika, a candy artist living in London, collaborated with Poppy to produce original cookies.\r\n\r\nA new series that incorporates the original cookie design into this project has appeared.\r\n\r\nThe charm of Kunika\'s original cookies with a delicate and beautiful design\r\nPlease enjoy the sweet and romantic world together.\r\n\r\n[Viewpoint]\r\n\r\nStreet - Bucket hat-like made with denim material\r\n\r\nThe balance between the embroidery design and the romantic impression, the \"p\" of the poppy and the denim material give a casual impression', 193.00, '', 'img/products/General_Collection/Item_3_Hat.png', 3, 1),
(27, 'Strawberry printed T-shirts (Navy border)', 'I drew a cute strawberry attractive print T in an artistic style. A versatile item that can be combined with street, girly, sporty and wide tastes.\r\nThe key is that the \"poppy\" logo is drawn casually.\r\nIt is a thick and light texture that is easy to use.\r\n\r\nTwo sizes: M size, which can be worn in a clean casual style and L size, which can be worn loose and loose.', 290.00, 'General Collection', 'img/products/General_Collection/Item_4.png', 2, 1),
(28, 'Blue flower see-through tops', 'Through the art-printed top, the world view of \"Day Dream\" (Fantasy), which is the theme of this semester\'s collection, is expressed.\r\nA wonderful design that attracts the eye.\r\nThe center of the body has been switched and accentuated with a mellow stitch.\r\nDespite the slim and fashionable silhouette, it is a moderate and comfortable size that does not pick up the body line too much. The long sleeve length makes the arm line very fascinating, and it is difficult to bulk when stacked on the top.\r\nOf course, as a layering item, it is a great thing to dress up with a one-piece pattern, and it plays an active role in the long season. It is also a good point that it has excellent elasticity and easy to wear, has a light and comfortable touch, and has a light texture that does not feel heavy when worn.', 368.00, 'General Collection', 'img/products/General_Collection/Item_5.png', 7, NULL),
(29, 'Nostalgic patchwork see-through tops (round neck)', 'The design is fantastic, as if you are flying in the air and heading towards the clouds.\r\n\r\nThe vibrant pink flowers and blue background create a romantic and pop contrast.\r\n\r\n----\r\n\r\nThe longer sleeves make the lines of your arms look beautiful, making them less bulky when layered on top.\r\n\r\nThe waistline and sleeves create a clean silhouette, giving it a more stylish impression.\r\n\r\nIt is a great item that can be worn as a layered item, or can be worn casually in a single piece, making it a great item for a long season.\r\n\r\nIt has excellent elasticity, is easy to wear, and has a smooth and comfortable feel, and is light enough to make you feel the weight when wearing it.\r\n\r\n*A round neck with a clean design that opens the neck, making your décolleté even more beautiful.\r\nWe also have a high neck design made of the same fabric.\r\n\r\n\r\n \r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 418.00, 'General Collection', 'img/products/General_Collection/Item_6.png', 7, NULL),
(30, 'Corset balloon mini skirt (gray)', 'The corset design gives a sophisticated impression, making it a versatile item that will enhance your style.\r\n\r\nThe mini length adds an airy feel.\r\n\r\nThe firm texture and volume create a silhouette with a three-dimensional feel that looks like it contains wind.\r\n\r\n*We also have a long version of the \"corset long balloon skirt\" made from the same fabric.', 406.00, 'General Collection', 'img/products/General_Collection/Item_7.png', 5, 1),
(31, 'Organdy tiered cami dress (Blue message)', '\"\" Truth \"is always in your heart. Now, let\'s gently bloom the\" truth \"wrapped in petals.\"\r\n\r\nThe concept of Poppy \"Bloom Collection\" is drawn with various typography. A warm and gentle message phrase that snuggles up every day.\r\n\r\n--\r\nOne piece of dressy with a soft and light silhouette. The chest is switched to the chest and gathered to make a delicate but three -dimensional feel. You can enjoy a variety of styling, such as layering T -shirts and sea -through tops, using cut -and -sews and shirts as a skirt. It is an excellent one that can be worn all season.\r\n\r\n\r\n* The shoulder straps can be adjusted with an adjuster.\r\n(This is two sizes of S/M, three colors of navy flower/blue message/navy).', 634.00, 'General Collection', 'img/products/General_Collection/Item_8.png', 1, 1),
(32, 'Organdy tiered cami dress (Memory collage)', 'The first place is a landscape filled with many memories.\r\n\r\nThe depth of the collage design woven with photos and art will bring you a nostalgic and nostalgic mood.\r\n\r\n--\r\n\r\nA dress with a soft and gentle silhouette. The chest is switched to the chest and gathered, giving you a subtle but three-dimensional feeling. You can enjoy a variety of shapes, such as using a cut-out and a shirt and a blouse as a skirt, and matching a T-shirt and a layered top and a sea. It is a great choice that can be worn all season long.', 643.00, 'General Collection', 'img/products/General_Collection/Item_9.png', 1, 1),
(33, 'Pearl flower half pants\r\n', 'Romantic shorts with pearls embellished with floral prints.\r\n\r\nThe gray body adds a sophisticated vibe and aligns the balance with romanticism.\r\n\r\nIt is also perfect for layering with sheer dresses and outerwear.\r\n\r\n* The hip pockets are fake.\r\n\r\n* Regarding the stitching of the hem, the stitching specifications of the product are no longer available.', 643.00, 'General Collection', 'img/products/General_Collection/Item_10.png', 5, 1),
(34, 'Ditsy Daisy Off Shoulders Midi Dress', 'Jacquard-style midi dress with a small floral pattern.\r\nLined, the puffed body is treated with spaced puff sleeves.\r\n\r\nThe sleeves are dropped - exposed sleeves. With adjustable straps\r\nWith a bubble hem skirt.\r\n\r\nDaisy world in a mesmerizing midi dress.\r\n\r\nA unique puffy nature adds a romantic impression to the bold blue shade and small floral jacard.\r\n\r\n==\r\n\r\nCami style midi dress in a dittsy floral jacquard fabric.\r\nFully lined, detailed with a puffed body, with comfortable puff sleeves.\r\n\r\nFinished with adjustable straps and a bubble hem skirt.', 668.00, 'POPPY x sister jane', 'img/products/General_Collection/Item_11.png', 1, 1),
(35, 'Satin cargo pants (green)', 'Feminine with cargo pants designed with work.\r\n\r\nThe piping on the center enhances the design, highlighting the vertical lines to create a design that gives it a stylish look.\r\n\r\nThe satin fabric has a sheen and drape, giving a soft impression and adding a little bit of sophistication.\r\n\r\nThe hem is a zipper design, so you can adjust it to your preference.', 643.00, 'General Collection', 'img/products/General_Collection/Item_12.png', 5, 0),
(36, 'Floral Hood Bubble Hem Mini Dress', 'Floral jacquard loose dress.\r\n\r\nLined, adjustable drawstring neckline\r\nApplied bubble hem skirt details.\r\n\r\nFood dress that combines street and feminine elements.\r\n\r\nRoomy design with soft green and blue floral jacquard.\r\n\r\nFun bubble hem and adjustable drawstring hood create a cool and cool vibe.\r\n\r\nPerfect for those who want to mix details and edgy twists.\r\n\r\n==\r\n\r\nLoose design in floral jacquard fabric.\r\n\r\nFully lined and detailed with adjustable drawstring neckline, side slit pockets and bubble hem skirt.', 765.00, 'POPPY x sister jane', 'img/products/General_Collection/Item_13.png', 1, 1),
(37, 'pointe backpack (khaki)', 'I want to carry a lot of luggage easily\r\nFor those who can\'t find the perfect backpack\r\n\r\n\"Pointe\" is\r\nInspired by the elegance of ballerinas\r\nA backpack with shortness, delicacy, dignity and luster\r\n\r\nUsing original quilted fabric on the entire surface.\r\nThe floral pattern and the design of the Wafeline express gorgeousness and friendliness.\r\nIn addition, a small floral pattern is embroidered on the scale part of the flap, giving a subtle impression.\r\n\r\nA smooth material is used for the shoulder rope so as not to become too sporty.\r\nWith a light design that is easy to match with feminine and girly styles.\r\n\r\nThe size of the A4 size is perfect, and the size is easy for daily life/business.\r\n\r\n*Original plate with poppy on the back\r\n*Base plate is used (not removable)', 643.00, 'General Collection', 'img/products/General_Collection/Item_14.png', 4, 0),
(38, 'Tulle Frill Bag (blue)', 'It is a loose dress with floral jacquard with metallic thread details.\r\n\r\nPut seam pockets on the side of the lining.\r\n\r\nA small dress that combines romantic floral patterns with a relaxed style.\r\n\r\nA loose matching design woven with metallic yarn, a cool and moderate edge on an impressive rose pattern.\r\n\r\nIt is a long-lasting specification that can be worn even on a cold day, and it is the best way to add a romantic essence to the outfit.\r\n\r\n==\r\n\r\nLoose dress with floral jacquard fabric with metallic thread details.\r\n\r\nFully lined with side seam pockets.', 199.00, 'General Collection', 'img/products/General_Collection/Item_15.png', 4, 0),
(39, 'FLOWER LACE SILVER CAP', 'A romantic hat item.\r\nThe key is the contrast between the three-dimensional lace and the edgy silver.\r\n\r\nJust add one to the style to change the impression and give an accent.\r\nA versatile hat that matches a variety of tastes from girly to sporty and cool styling.\r\n\r\n(This is a free size and one color development.)', 199.00, 'General Collection', 'img/products/General_Collection/Item_16.png', 4, 0),
(40, 'Wide boston bag', 'A wide Boston bag made of shiny and textured silver/catchy gingham check PU fabric that will add an accent to any outfit.\r\n\r\nThe brand\'s message \"possibilities of imagination\" is embroidered on the front, giving it a pop and sharp design.\r\n\r\nThe length of the handle makes it easy to carry on the shoulder, making it a practical item that is also easy to use.\r\n\r\n*Silver: Comes with POPPY original carabiner\r\n\r\n*Gingham check: Comes with ribbon charm\r\n\r\nBottom gusset 8 cm\r\nHeight 15 cm\r\nBottom width 31.5 cm', 578.00, 'General Collection', 'img/products/General_Collection/Item_17.png', 4, 0),
(41, 'POPPY shopper tote bag', 'An item that reproduces a new shopping poppy shopper with a tote bag.\r\nThe key is the plump print and casual embroidery on the side.\r\nThe handle is made long so that it can be easily hung on the shoulder with a large amount of luggage, and it has a wide burr.\r\nThere are two pockets inside, and the storage of small items is perfect.\r\n\r\n* For sample photography, the appearance of color/specification/design/print may differ from the published photo.\r\n\r\n* The color of the product is as close to the naked eye as possible, but depending on the light when shooting and the light when viewing the browser, the color may differ slightly from the real substance. Thank you for your understanding and understanding.\r\n\r\n* Due to the production of the fabric, this product may not end. Please note in advance.\r\n\r\n<< Precautions when washing >>\r\n\r\n・ Please handle according to the washing symbol.', 203.00, 'General Collection', 'img/products/General_Collection/Item_18.png', 4, 0);

-- --------------------------------------------------------

--
-- 表的结构 `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `size`, `stock`) VALUES
(196, 1, 'S', 1),
(197, 1, 'M', 13),
(198, 1, 'L', 12),
(199, 2, 'S', 4),
(200, 2, 'M', 20),
(201, 2, 'L', 16),
(205, 5, 'S', 18),
(206, 5, 'M', 9),
(207, 5, 'L', 8),
(208, 6, 'S', 3),
(209, 6, 'M', 4),
(210, 6, 'L', 15),
(211, 7, 'S', 15),
(212, 7, 'M', 4),
(213, 7, 'L', 9),
(214, 8, 'S', 4),
(215, 8, 'M', 8),
(216, 8, 'L', 12),
(217, 9, 'S', 3),
(218, 9, 'M', 19),
(219, 9, 'L', 14),
(220, 10, 'S', 20),
(221, 10, 'M', 3),
(222, 10, 'L', 5),
(287, 13, 'S', 9),
(288, 13, 'M', 17),
(289, 13, 'L', 1),
(290, 14, 'S', 16),
(291, 14, 'M', 16),
(292, 14, 'L', 8),
(293, 15, 'S', 7),
(294, 15, 'M', 13),
(295, 15, 'L', 5),
(296, 16, 'S', 6),
(297, 16, 'M', 14),
(298, 16, 'L', 0),
(322, 18, 'S', 19),
(323, 18, 'M', 0),
(324, 18, 'L', 12),
(325, 19, 'S', 12),
(326, 19, 'M', 16),
(327, 19, 'L', 13),
(345, 21, 'S', 16),
(346, 21, 'M', 8),
(347, 21, 'L', 20),
(348, 22, 'S', 15),
(349, 22, 'M', 12),
(350, 22, 'L', 20),
(371, 4, NULL, 20),
(372, 12, NULL, 14),
(373, 17, NULL, 20),
(374, 20, NULL, 9),
(375, 23, NULL, 13),
(376, 24, '', 17),
(377, 25, 'Free Size', 11),
(382, 26, NULL, 3),
(383, 25, '', 11),
(384, 28, 'M', 12),
(385, 28, 'L', 7),
(386, 29, 'M', 6),
(387, 29, 'L', 2),
(390, 30, 'S', 15),
(391, 30, 'M', 10),
(392, 30, 'L', 12),
(393, 31, 'S', 10),
(394, 31, 'M', 3),
(395, 31, 'L', 8),
(396, 32, 'S', 7),
(397, 32, 'M', 14),
(398, 32, 'L', 19),
(399, 33, 'S', 6),
(400, 33, 'M', 20),
(401, 33, 'L', 17),
(402, 34, 'XS', 20),
(403, 34, 'S', 17),
(404, 36, 'XS', 13),
(405, 36, 'S', 21),
(406, 3, NULL, 14);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` enum('Male','Female','Prefer not to state') DEFAULT 'Prefer not to state',
  `birthday` date DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Malaysia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `phone`, `gender`, `birthday`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`) VALUES
(6, 'rosewuxi@gmail.com', '$2y$10$40JR85pCXFmpvKYuDfMDtO/nFDHVwmskimWWMkBy8TWDezKdswke2', 'Wang', 'Ye', '0176571431', 'Female', '2004-07-15', 'Xiamen University Malaysia', 'Kota Warison', 'Sepang', 'Selangor', '43900', 'Malaysia'),
(7, 'DMT2209231@xmu.edu.my', '$2y$10$YkV9Bb8OG5tvWtESTRhS/.IfbmE0/clcYqSHROuLtFTAHRMGfnbT2', 'Fujii', 'Kaze', '0176571431', 'Male', '1997-06-17', 'Xiamen University Malaysia', 'Kota Warison', 'Sepang', 'Selangor', '43900', 'Malaysia');

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
-- 表的索引 `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`size`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `image_list`
--
ALTER TABLE `image_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- 使用表AUTO_INCREMENT `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=407;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

--
-- 限制表 `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
