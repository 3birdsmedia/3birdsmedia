-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host: 184.168.228.89
-- Generation Time: May 19, 2011 at 03:06 PM
-- Server version: 5.0.91
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pinkyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutText`
--

CREATE TABLE `aboutText` (
  `about_id` int(100) unsigned NOT NULL auto_increment,
  `aboutText` varchar(25000) NOT NULL,
  PRIMARY KEY  (`about_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `aboutText`
--

INSERT INTO `aboutText` VALUES(1, 'I have been making "things" for as long as I can remember. I started making jewelry in college and became addicted to the art. I am now a mother to two wonderful girls, Harley 7 and Sofia 3, and they bring me the most inspiration to create beautiful things.  I LOVE nature, color, and texture, and incorporate all of these when designing jewelry.  \r\n\r\nSince becoming a mommy, I am often amazed by other women and their stories. This has moved me to mostly focus on creating personalized custom jewelry.  Names, dates, phrases and birthstones can be used to create the  perfect piece that is personal to you or a loved one.\r\n\r\nA great amount of time and care is always used. Each piece of custom jewelry is carefully hand stamped, fired and polished. My favorite materials are precious metal clay, silver and natural stones. No two pieces are exactly alike. There is variation and character  found in every piece.  This only adds charm and makes it uniquely yours.\r\n\r\nThere is always something new being created here at Pinky''s Workbench, so visit often.');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) unsigned NOT NULL auto_increment,
  `cat_name` varchar(100) NOT NULL,
  `cat_desc` varchar(25000) NOT NULL,
  PRIMARY KEY  (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` VALUES(1, 'Necklaces', 'Custom Necklaces');
INSERT INTO `categories` VALUES(2, 'Pinky Potpourri', 'Pinky Potpourri');
INSERT INTO `categories` VALUES(4, 'Earrings', 'Children');
INSERT INTO `categories` VALUES(5, 'Mens', 'Mens');
INSERT INTO `categories` VALUES(6, 'Bracelets', 'Bracelets');

-- --------------------------------------------------------

--
-- Table structure for table `chains`
--

CREATE TABLE `chains` (
  `chain_id` int(20) unsigned NOT NULL auto_increment,
  `length` int(20) unsigned NOT NULL,
  `addit_price` int(20) unsigned NOT NULL,
  PRIMARY KEY  (`chain_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `chains`
--

INSERT INTO `chains` VALUES(1, 16, 0);
INSERT INTO `chains` VALUES(2, 18, 0);
INSERT INTO `chains` VALUES(3, 20, 0);
INSERT INTO `chains` VALUES(4, 24, 5);
INSERT INTO `chains` VALUES(5, 26, 8);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(100) NOT NULL auto_increment,
  `faq_name` varchar(100) NOT NULL,
  `faq_desc` varchar(1000) NOT NULL,
  PRIMARY KEY  (`faq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` VALUES(1, 'PAYMENT OPTIONS', 'I accept Visa, Master card, American express and Paypal.');
INSERT INTO `faqs` VALUES(2, 'SHIPPING', 'Items are shipped through USPS first class mail.  Insurance can be added for an additional price.  Numerous items are combined for shipping at a flat rate of $5.00.');
INSERT INTO `faqs` VALUES(3, 'REFUNDS', 'Refunds, exchanges or store credit will be given if items are returned in their original condition and received within 14 days of shipment. Damaged or missing pieces must be reported within 48 hours of receipt.  Custom orders are not refundable. If you are unhappy with your custom order, please call me and we''ll try to work something out');
INSERT INTO `faqs` VALUES(4, 'TIME FRAME FOR COMPLETION OF ORDER', 'Please allow 2-3 weeks for your custom orders.  If you need your order sooner for a special event, please let me know and I''ll see if I can accommodate your order.   ');
INSERT INTO `faqs` VALUES(5, 'CONTACT INFO', 'Phone number: 714-916-7430  email: <a href="mailto:adela@pinkysworkbench.com">adela@pinkysworkbench.com</a>');

-- --------------------------------------------------------

--
-- Table structure for table `homeText`
--

CREATE TABLE `homeText` (
  `homeText` varchar(400) NOT NULL,
  `home_id` int(100) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`home_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `homeText`
--

INSERT INTO `homeText` VALUES('Welcome to my shop! Everything you''ll find here is lovingly handcrafted by me. Only the best materials are used, and each piece is carefully hand stamped, fired or soldered, filed and tumbled . Names, dates or phrases can be used to create the perfect piece that is personal to you or a loved one. Take a look around, and you''ll surely find something special. ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `img_id` int(100) unsigned NOT NULL auto_increment,
  `img_name` varchar(100) NOT NULL,
  `img_url` varchar(100) NOT NULL,
  PRIMARY KEY  (`img_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=373 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` VALUES(348, 'DSC03406.JPG', 'DSC03406.JPG');
INSERT INTO `images` VALUES(307, 'DSC03090.JPG', 'DSC03090.JPG');
INSERT INTO `images` VALUES(299, 'DSC03633.JPG', 'DSC03633.JPG');
INSERT INTO `images` VALUES(104, 's2.jpg', 's2.jpg');
INSERT INTO `images` VALUES(297, 'DSC03626.JPG', 'DSC03626.JPG');
INSERT INTO `images` VALUES(107, 's5.jpg', 's5.jpg');
INSERT INTO `images` VALUES(108, 's6.jpg', 's6.jpg');
INSERT INTO `images` VALUES(312, 'DSC03047.JPG', 'DSC03047.JPG');
INSERT INTO `images` VALUES(110, 's8.jpg', 's8.jpg');
INSERT INTO `images` VALUES(317, 'DSC03158.JPG', 'DSC03158.JPG');
INSERT INTO `images` VALUES(316, 'DSC03347.JPG', 'DSC03347.JPG');
INSERT INTO `images` VALUES(311, 'DSC03064.JPG', 'DSC03064.JPG');
INSERT INTO `images` VALUES(117, 'm1.jpg', 'm1.jpg');
INSERT INTO `images` VALUES(118, 'm2.jpg', 'm2.jpg');
INSERT INTO `images` VALUES(313, 'DSC03330.JPG', 'DSC03330.JPG');
INSERT INTO `images` VALUES(89, '5.jpg', '5.jpg');
INSERT INTO `images` VALUES(228, '7.jpg', '7.jpg');
INSERT INTO `images` VALUES(283, 'DSC01953.JPG', 'DSC01953.JPG');
INSERT INTO `images` VALUES(1, 'DSC011.JPG', 'DSC011.JPG');
INSERT INTO `images` VALUES(3, 'DSC03064.JPG', 'DSC03064.JPG');
INSERT INTO `images` VALUES(4, 'DSC03655.JPG', 'DSC03655.JPG');
INSERT INTO `images` VALUES(5, 'DSC03457.JPG', 'DSC03457.JPG');
INSERT INTO `images` VALUES(252, '012.jpg', '012.jpg');
INSERT INTO `images` VALUES(335, '2DSC02939.JPG', '2DSC02939.JPG');
INSERT INTO `images` VALUES(298, 'DSC03585.JPG', 'DSC03585.JPG');
INSERT INTO `images` VALUES(95, '11.jpg', '11.jpg');
INSERT INTO `images` VALUES(304, '01012.jpg', '01012.jpg');
INSERT INTO `images` VALUES(2, 'DSC03721.JPG', 'DSC03721.JPG');
INSERT INTO `images` VALUES(314, 'DSC03331.JPG', 'DSC03331.JPG');
INSERT INTO `images` VALUES(127, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(129, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(131, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(133, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(202, 'angular2.jpg', 'angular2.jpg');
INSERT INTO `images` VALUES(135, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(205, 'lolcatz.jpg', 'lolcatz.jpg');
INSERT INTO `images` VALUES(137, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(194, 'angular.jpg', 'angular.jpg');
INSERT INTO `images` VALUES(139, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(196, 'angular2.jpg', 'angular2.jpg');
INSERT INTO `images` VALUES(141, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(207, 'lolcat9.jpg', 'lolcat9.jpg');
INSERT INTO `images` VALUES(143, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(188, '9.jpg', '9.jpg');
INSERT INTO `images` VALUES(145, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(147, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(149, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(151, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(153, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(204, 'lolcat9.jpg', 'lolcat9.jpg');
INSERT INTO `images` VALUES(155, '5.jpg', '5.jpg');
INSERT INTO `images` VALUES(192, 'angular.jpg', 'angular.jpg');
INSERT INTO `images` VALUES(157, '8.jpg', '8.jpg');
INSERT INTO `images` VALUES(159, '8.jpg', '8.jpg');
INSERT INTO `images` VALUES(161, '8.jpg', '8.jpg');
INSERT INTO `images` VALUES(163, '8.jpg', '8.jpg');
INSERT INTO `images` VALUES(165, '8.jpg', '8.jpg');
INSERT INTO `images` VALUES(167, '6.jpg', '6.jpg');
INSERT INTO `images` VALUES(168, '6.jpg', '6.jpg');
INSERT INTO `images` VALUES(169, '9.jpg', '9.jpg');
INSERT INTO `images` VALUES(171, '17.jpg', '17.jpg');
INSERT INTO `images` VALUES(172, '19.jpg', '19.jpg');
INSERT INTO `images` VALUES(209, '2533089145_69d58bfbcb.jpg', '2533089145_69d58bfbcb.jpg');
INSERT INTO `images` VALUES(175, '8.jpg', '8.jpg');
INSERT INTO `images` VALUES(176, '16.jpg', '16.jpg');
INSERT INTO `images` VALUES(200, 'angular2.jpg', 'angular2.jpg');
INSERT INTO `images` VALUES(178, '8.jpg', '8.jpg');
INSERT INTO `images` VALUES(179, '16.jpg', '16.jpg');
INSERT INTO `images` VALUES(182, '2.jpg', '2.jpg');
INSERT INTO `images` VALUES(183, '5.jpg', '5.jpg');
INSERT INTO `images` VALUES(185, '9.jpg', '9.jpg');
INSERT INTO `images` VALUES(186, '3.jpg', '3.jpg');
INSERT INTO `images` VALUES(208, 'lolcatz.jpg', 'lolcatz.jpg');
INSERT INTO `images` VALUES(235, '12b.jpg', '12b.jpg');
INSERT INTO `images` VALUES(213, 'lolcat9.jpg', 'lolcat9.jpg');
INSERT INTO `images` VALUES(214, 'lolcatz.jpg', 'lolcatz.jpg');
INSERT INTO `images` VALUES(215, 'angular.jpg', 'angular.jpg');
INSERT INTO `images` VALUES(229, 'cn7.jpg', 'cn7.jpg');
INSERT INTO `images` VALUES(295, 'DSC03690.JPG', 'DSC03690.JPG');
INSERT INTO `images` VALUES(232, 'cn7.jpg', 'cn7.jpg');
INSERT INTO `images` VALUES(227, '7.jpg', '7.jpg');
INSERT INTO `images` VALUES(226, '5.jpg', '5.jpg');
INSERT INTO `images` VALUES(233, 'cn7.jpg', '');
INSERT INTO `images` VALUES(234, '09.jpg', '09.jpg');
INSERT INTO `images` VALUES(236, 'lolcat9.jpg', 'lolcat9.jpg');
INSERT INTO `images` VALUES(237, '2533089145_69d58bfbcb.jpg', '2533089145_69d58bfbcb.jpg');
INSERT INTO `images` VALUES(238, 'lolcatz.jpg', 'lolcatz.jpg');
INSERT INTO `images` VALUES(239, 'Picture 1.png', 'Picture 1.png');
INSERT INTO `images` VALUES(240, 'Picture+1.png', '');
INSERT INTO `images` VALUES(241, 'Picture 1.png', 'Picture 1.png');
INSERT INTO `images` VALUES(242, 'DRIBBLE-PRO_Colladeral.jpg', 'DRIBBLE-PRO_Colladeral.jpg');
INSERT INTO `images` VALUES(243, 'DSC_6526.JPG', 'DSC_6526.JPG');
INSERT INTO `images` VALUES(244, 'DRIBBLE PRO_Colladeral.tif', 'DRIBBLE PRO_Colladeral.tif');
INSERT INTO `images` VALUES(245, 'DRIBBLE-PRO_Colladeral.jpg', 'DRIBBLE-PRO_Colladeral.jpg');
INSERT INTO `images` VALUES(253, '012b.jpg', '012b.jpg');
INSERT INTO `images` VALUES(248, '009.jpg', '009.jpg');
INSERT INTO `images` VALUES(255, '0113.jpg', '0113.jpg');
INSERT INTO `images` VALUES(294, 'DSC03721.JPG', 'DSC03721.JPG');
INSERT INTO `images` VALUES(281, '00lolcatz.jpg', '00lolcatz.jpg');
INSERT INTO `images` VALUES(282, '02533089145_69d58bfbcb.jpg', '02533089145_69d58bfbcb.jpg');
INSERT INTO `images` VALUES(303, '12.jpg', '12.jpg');
INSERT INTO `images` VALUES(337, 'DSC03054.JPG', 'DSC03054.JPG');
INSERT INTO `images` VALUES(289, 'DSC02728.JPG', 'DSC02728.JPG');
INSERT INTO `images` VALUES(290, 'DSC02730.JPG', 'DSC02730.JPG');
INSERT INTO `images` VALUES(291, 'DSC03140.JPG', 'DSC03140.JPG');
INSERT INTO `images` VALUES(292, 'DSC03138.JPG', 'DSC03138.JPG');
INSERT INTO `images` VALUES(276, '00lolcatz.jpg', '00lolcatz.jpg');
INSERT INTO `images` VALUES(278, '00lolcatz.jpg', '00lolcatz.jpg');
INSERT INTO `images` VALUES(279, '02533089145_69d58bfbcb.jpg', '02533089145_69d58bfbcb.jpg');
INSERT INTO `images` VALUES(296, 'DSC03698.JPG', 'DSC03698.JPG');
INSERT INTO `images` VALUES(300, 'DSC03655.JPG', 'DSC03655.JPG');
INSERT INTO `images` VALUES(301, 'DSC03641.JPG', 'DSC03641.JPG');
INSERT INTO `images` VALUES(334, '1DSC02937.JPG', '1DSC02937.JPG');
INSERT INTO `images` VALUES(339, 'DSC03672.JPG', 'DSC03672.JPG');
INSERT INTO `images` VALUES(308, 'DSC03092.JPG', 'DSC03092.JPG');
INSERT INTO `images` VALUES(309, 'DSC01930.JPG', 'DSC01930.JPG');
INSERT INTO `images` VALUES(318, 'DSC03155.JPG', 'DSC03155.JPG');
INSERT INTO `images` VALUES(319, 'DSC03439.JPG', 'DSC03439.JPG');
INSERT INTO `images` VALUES(355, 'DSC03030.JPG', 'DSC03030.JPG');
INSERT INTO `images` VALUES(356, 'DSC03029.JPG', 'DSC03029.JPG');
INSERT INTO `images` VALUES(322, 'DSC03457.JPG', 'DSC03457.JPG');
INSERT INTO `images` VALUES(323, 'DSC03463.JPG', 'DSC03463.JPG');
INSERT INTO `images` VALUES(324, 'DSC03459.JPG', 'DSC03459.JPG');
INSERT INTO `images` VALUES(325, 'DSC03482.JPG', 'DSC03482.JPG');
INSERT INTO `images` VALUES(326, 'DSC03478.JPG', 'DSC03478.JPG');
INSERT INTO `images` VALUES(327, 'DSC03483.JPG', 'DSC03483.JPG');
INSERT INTO `images` VALUES(328, 'DSC03489.JPG', 'DSC03489.JPG');
INSERT INTO `images` VALUES(329, 'DSC03492.JPG', 'DSC03492.JPG');
INSERT INTO `images` VALUES(330, 'DSC03490.JPG', 'DSC03490.JPG');
INSERT INTO `images` VALUES(331, 'DSC03180.JPG', 'DSC03180.JPG');
INSERT INTO `images` VALUES(332, 'DSC03179.JPG', 'DSC03179.JPG');
INSERT INTO `images` VALUES(333, 'DSC03176.JPG', 'DSC03176.JPG');
INSERT INTO `images` VALUES(340, 'DSC03670.JPG', 'DSC03670.JPG');
INSERT INTO `images` VALUES(341, 'DSC03668.JPG', 'DSC03668.JPG');
INSERT INTO `images` VALUES(342, 'DSC03672.JPG', 'DSC03672.JPG');
INSERT INTO `images` VALUES(343, 'DSC03670.JPG', 'DSC03670.JPG');
INSERT INTO `images` VALUES(344, 'DSC03675.JPG', 'DSC03675.JPG');
INSERT INTO `images` VALUES(345, 'DSC03678.JPG', 'DSC03678.JPG');
INSERT INTO `images` VALUES(347, 'DSC03676.JPG', 'DSC03676.JPG');
INSERT INTO `images` VALUES(349, 'DSC03404.JPG', 'DSC03404.JPG');
INSERT INTO `images` VALUES(350, 'DSC03408.JPG', 'DSC03408.JPG');
INSERT INTO `images` VALUES(351, 'DSC03209.JPG', 'DSC03209.JPG');
INSERT INTO `images` VALUES(352, 'DSC03215.JPG', 'DSC03215.JPG');
INSERT INTO `images` VALUES(353, 'DSC03217.JPG', 'DSC03217.JPG');
INSERT INTO `images` VALUES(357, 'DSC03028.JPG', 'DSC03028.JPG');
INSERT INTO `images` VALUES(358, 'DSC03026.JPG', 'DSC03026.JPG');
INSERT INTO `images` VALUES(359, 'DSC03026.JPG', '');
INSERT INTO `images` VALUES(360, 'DSC03600.JPG', 'DSC03600.JPG');
INSERT INTO `images` VALUES(361, 'DSC03618.JPG', 'DSC03618.JPG');
INSERT INTO `images` VALUES(362, 'DSC03623.JPG', 'DSC03623.JPG');
INSERT INTO `images` VALUES(363, 'DSC03599.JPG', 'DSC03599.JPG');
INSERT INTO `images` VALUES(364, 'DSC03612.JPG', 'DSC03612.JPG');
INSERT INTO `images` VALUES(365, 'DSC03658.JPG', 'DSC03658.JPG');
INSERT INTO `images` VALUES(366, 'DSC03644.JPG', 'DSC03644.JPG');
INSERT INTO `images` VALUES(367, 'DSC03656.JPG', 'DSC03656.JPG');
INSERT INTO `images` VALUES(368, 'DSC03749.JPG', 'DSC03749.JPG');
INSERT INTO `images` VALUES(369, 'DSC03751.JPG', 'DSC03751.JPG');
INSERT INTO `images` VALUES(370, 'DSC03772.JPG', 'DSC03772.JPG');
INSERT INTO `images` VALUES(371, 'DSC03756.JPG', 'DSC03756.JPG');
INSERT INTO `images` VALUES(372, 'DSC03769.JPG', 'DSC03769.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(100) unsigned NOT NULL auto_increment,
  `prod_name` varchar(100) NOT NULL,
  `prod_desc` varchar(25000) NOT NULL,
  `price` int(20) NOT NULL,
  `disks` int(20) NOT NULL,
  PRIMARY KEY  (`prod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=212 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` VALUES(98, 'Sweet Initial Necklace', 'A silver disk (1/2") is hand stamped with initial of your choice and strung on a silver bead chain. Add an additional disk for $18.00.', 38, 0);
INSERT INTO `products` VALUES(205, 'Tranquility Earrings', 'These earrings are so pretty and tranquil. Delicate, pink amethyst gracefully adorn elegant blue chalcedony gemstones. They''re finished on oxidized sterling silver and measure about 2 1/2" in length. Clear backs are included to protect you from ever losing these beauties. ', 59, 0);
INSERT INTO `products` VALUES(95, 'Bestest Friend Ever Necklace', 'A silver oval about 1" is adorned with hand sculpted flowers, and clear crystals. It''s symbolic of best friends and is finished on a pretty silver chain. Names can be hand stamped on the back of oval with up to 20 characters.', 62, 0);
INSERT INTO `products` VALUES(200, 'Bling', '\r\n    An eye catching bracelet filled to the max with hot pink AB swarovski crystals, and finished on a darling sterling silver heart toggle. It measures 7 1/2" and is ready to ship ', 98, 0);
INSERT INTO `products` VALUES(202, 'Pretty Posie Hair Clips', 'These pretty little felt posies are soooo cute, and great for an adult or child. They include three fantastic colors and are ready to ship. ', 12, 0);
INSERT INTO `products` VALUES(203, 'Large Pretty Posie Hair Clips', 'Vibrant and beautiful, these hair pins will look lovely in your hair. The flowers are handmade out of felt and are attached to a sturdy bobby pin.They Measure about 1 1/2" in width and length.\r\n\r\n', 8, 0);
INSERT INTO `products` VALUES(101, 'Large Silver Disk Necklace', 'One of my best sellers! A large disk (1 1/4") is hand stamped with the names of your loved ones. I can fit up to 34 letters. Necklace is accented with a fresh water pearl and strung on a silver bead chain.', 62, 0);
INSERT INTO `products` VALUES(102, 'The Original Necklace', 'This necklace is how it all started and is still a best seller. A small silver disk (1/2") is hand stamped with the name of your loved one. Up to 7 letters can fit. Necklace is accented with a fresh water pearl and strung on a silver bead chain. Add a disk for $18.00.', 42, 0);
INSERT INTO `products` VALUES(104, 'I', 'For the bride to be, or simply a girl in love. One Medium size disk is hand stamped with a heart, and two smaller disks are hand stamped with the initials of the couple. Necklace is finished on a silver bead chain.', 62, 0);
INSERT INTO `products` VALUES(105, 'Rustic Silver Heart Necklace', 'This necklace is so pretty! A large silver heart is hammered, polished and finished on a sturdy silver chain', 48, 0);
INSERT INTO `products` VALUES(106, 'Funky Family Necklace', 'I love this necklace! Different shapes make this really fun. Price includes two tags. Add an additional tag for $22.00.', 59, 0);
INSERT INTO `products` VALUES(108, 'Oh My Heart Necklace', 'A silver oval about 1" is adorned with a heart and hand stamped with names of your choice. I can fit up to 7 characters across or 16 along the perimeter.', 58, 0);
INSERT INTO `products` VALUES(204, 'Drops of Silver', 'These hand forged,sterling silver earring are so versatile and perfect for everyday wear. They measure approximately 2" and are ready to ship. ', 29, 0);
INSERT INTO `products` VALUES(110, 'Oh So Simple Family Initial Necklace', '1"silver disks are hand stamped with the initials of your choice using a simple font. Disks are strung on a silver bead chain. Price includes two disks. Add a disk for $16.00', 44, 0);
INSERT INTO `products` VALUES(192, 'Golden Love Necklace', '   Perfectly imperfect vermeil disks are hammered and hand stamped with the names of your choice. They''re unique but classic and are sure to catch attention. They measure about 1/2 inch across and 1/2 inch in length. They are embellished with a lovely heart charm and finished on a gold filled bead chain.\r\n \r\n\r\n*Price includes one disk. Add additonal disks for $18.00', 46, 0);
INSERT INTO `products` VALUES(111, 'My Sweethearts', '1/2" silver heart charms are hand stamped with initials of your choice and accented with a hand forged silver circle. Charms are strung from a silver bead chain and embellished with a pearl. Price includes two hearts. Add a heart for $14.00', 46, 0);
INSERT INTO `products` VALUES(113, 'Charms', 'Add a silver charm to your order for $5.00', 5, 0);
INSERT INTO `products` VALUES(199, 'Mama''s Love Bracelet', 'This is a classic bracelet that will be worn for a lifetime. Pretty sterling silver hearts are hand stamped with the names of your precious loved ones. The bracelet measures approximately 7 1/2 " and the hearts measure approximately 3/4 " The entire bracelet is made of sterling silver and is very high quality.\r\n\r\n****Under notes to seller, please indicate the names desired.\r\n\r\n', 120, 1);
INSERT INTO `products` VALUES(116, 'Rustic Heart Earrings', 'I love these earrings and they put me in better spirits whenever I put them on. They are silver, hand forged and measure about 2" in length. ', 39, 0);
INSERT INTO `products` VALUES(117, 'Cleaning Cloth', 'Cleaning Cloth', 5, 0);
INSERT INTO `products` VALUES(119, 'Simple Fresh Water Pearl Earrings', 'Fresh water pearls are wrapped in silver and finished on silver lever backs.', 22, 0);
INSERT INTO `products` VALUES(198, 'Le Petite Bracelet', 'This sterling silver bracelet is made especially for the little lady in your life. The bangle measure approximately 6 1/2 inches and should fit children from the ages 6-11 years old. It''s embellished with a pretty sterling silver heart that can be stamped with a name, word or initial of your choice.\r\n', 52, 1);
INSERT INTO `products` VALUES(196, 'Rustic Blue Opal Earrings', 'These earrings are very versatile. Pretty blue opal gemstones are wire wrapped around oxidized sterling silver. They measure about 1 1/2" in length.', 22, 0);
INSERT INTO `products` VALUES(197, 'The Courtney Bracelet', 'This is a simple yet beautiful bracelet. A perfect gift for a friend, daughter or any loved one. A heavy sterling silver pendent is finished on a beautiful, thick sterling silver chain and measures approximately 7 1/2 inches. The pendent can be stamped with a name or word of your choice.\r\n \r\n', 110, 0);
INSERT INTO `products` VALUES(126, 'Dog Tag Necklace', 'Silver tag about 1 1/4â€, is hand stamped with names of choice and finished on a sturdy silver bead chain.\r\n	', 72, 0);
INSERT INTO `products` VALUES(127, 'Rustic ID Bracelet', 'Silver ID is hand stamped with your name or word of choice and finished on a sturdy double silver chain.', 78, 0);
INSERT INTO `products` VALUES(128, 'Chunk-of-luv Mom''s Bracelet', 'This adorable chunky bracelet is accented with a silver square and copper heart. Names of children are hand stamped and bracelet is finished on an attractive and sturdy chain.', 99, 0);
INSERT INTO `products` VALUES(129, 'Copper Bangle Bracelet', 'Hand forged and hammered bangles are accented with a rustic heart tag.', 45, 0);
INSERT INTO `products` VALUES(130, 'Rustic Heart Child''s Bracelet', 'This adorable silver bracelet is hammered and accented with a copper heart. It is finished on a sturdy silver chain and embellished with a fresh water pearl. Please indicate age of child below.', 45, 0);
INSERT INTO `products` VALUES(195, 'The Fanily Love Bracelet', 'This bracelet is absolutely beautiful and can be worn for a lifetime. Fine pure silver is hand stamped with the names of your precious family members , and hang from a luxurious, Tiffany style sterling silver chain. A faceted rose quartz gem enhance the bracelet. The back is also stamped with a pretty floral pattern so you always have something beautiful to look at.\r\n The price includes one 3/4" disk and one 1/2" disk. Add an additional disk for $18.00. The bracelet measures 7 1/2".\r\n\r\nPlease indicate the names desired below\r\n\r\n', 220, 1);
INSERT INTO `products` VALUES(194, 'Love Toggle', 'This is a classic Tiffany inspired necklace. A thick sterling silver Tiffany style heart is hand stamped with the names of your precious loved ones. It is finished on a sturdy sterling silver chain and measures approximately 21 inches. The heart is 1 inch in length and width.\r\n\r\n', 149, 0);
INSERT INTO `products` VALUES(186, 'Love Bar Necklace', 'One of my best sellers! A silver bar ( 1 1/4â€) is hand stamped with the name of your loved one. I can fit up to 8 letters. Necklace is accented with a fresh water pearl and strung on a silver bead chain. Add a bar for $18.00', 42, 0);
INSERT INTO `products` VALUES(206, 'Pink Quartz Earrings', 'These earrings are so pretty and feminine. Large crystal pink quartz, embellish oxidized sterling silver. They''re finished on sterling silver lever backs and measure about 1 1/2" in length.', 39, 1);
INSERT INTO `products` VALUES(207, 'Simple Chalcedony Earrings', 'These earrings are simple and clean. Beautiful chalcedony gem stones are wire wrapped around sterling silver circles. The chalcedony is AB coated which adds a beautiful iridescent sheen . They measure slightly over 1" in length. ', 22, 0);
INSERT INTO `products` VALUES(208, 'Bella Earrings', 'Pretty pink amethyst is wire wrapped around sterling silver and oxidized which adds a rustic appeal.\r\nThey measure about 2 1/2" in length and about 1" across. ', 29, 0);
INSERT INTO `products` VALUES(209, 'Framed Love Necklace', 'I''m in love with this new necklace. It has a antique and romantic look to it. A raised edge vermeil pendant is hand stamped with the name or word of your choice. The pendant measures about 1/2" and is embellished with a pretty charm that reads amore on one side and love on the other . It''s finished on a gold filled chain.  \r\n', 46, 1);
INSERT INTO `products` VALUES(210, 'Yes, That', 'Silver wire is wrapped and twisted to create this cute necklace. It measure about 16 1/2" in length and is super fun to wear! ', 39, 0);
INSERT INTO `products` VALUES(211, 'You''ve Got MeTwisted Necklace', 'Sterling silver wire is wrapped and twisted to create this cute and funky little necklace.  It Measures about 16 1/2" in length.', 39, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prod_cat_lookup`
--

CREATE TABLE `prod_cat_lookup` (
  `prod_id` int(100) NOT NULL,
  `cat_id` int(100) NOT NULL,
  PRIMARY KEY  (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_cat_lookup`
--

INSERT INTO `prod_cat_lookup` VALUES(95, 1);
INSERT INTO `prod_cat_lookup` VALUES(98, 1);
INSERT INTO `prod_cat_lookup` VALUES(101, 1);
INSERT INTO `prod_cat_lookup` VALUES(102, 1);
INSERT INTO `prod_cat_lookup` VALUES(103, 1);
INSERT INTO `prod_cat_lookup` VALUES(104, 1);
INSERT INTO `prod_cat_lookup` VALUES(105, 1);
INSERT INTO `prod_cat_lookup` VALUES(106, 1);
INSERT INTO `prod_cat_lookup` VALUES(108, 1);
INSERT INTO `prod_cat_lookup` VALUES(110, 1);
INSERT INTO `prod_cat_lookup` VALUES(111, 1);
INSERT INTO `prod_cat_lookup` VALUES(113, 2);
INSERT INTO `prod_cat_lookup` VALUES(114, 2);
INSERT INTO `prod_cat_lookup` VALUES(115, 2);
INSERT INTO `prod_cat_lookup` VALUES(116, 4);
INSERT INTO `prod_cat_lookup` VALUES(117, 2);
INSERT INTO `prod_cat_lookup` VALUES(119, 4);
INSERT INTO `prod_cat_lookup` VALUES(126, 5);
INSERT INTO `prod_cat_lookup` VALUES(127, 5);
INSERT INTO `prod_cat_lookup` VALUES(128, 6);
INSERT INTO `prod_cat_lookup` VALUES(129, 6);
INSERT INTO `prod_cat_lookup` VALUES(130, 6);
INSERT INTO `prod_cat_lookup` VALUES(175, 0);
INSERT INTO `prod_cat_lookup` VALUES(186, 1);
INSERT INTO `prod_cat_lookup` VALUES(192, 1);
INSERT INTO `prod_cat_lookup` VALUES(194, 1);
INSERT INTO `prod_cat_lookup` VALUES(195, 6);
INSERT INTO `prod_cat_lookup` VALUES(196, 4);
INSERT INTO `prod_cat_lookup` VALUES(197, 6);
INSERT INTO `prod_cat_lookup` VALUES(198, 6);
INSERT INTO `prod_cat_lookup` VALUES(199, 6);
INSERT INTO `prod_cat_lookup` VALUES(200, 6);
INSERT INTO `prod_cat_lookup` VALUES(202, 2);
INSERT INTO `prod_cat_lookup` VALUES(203, 2);
INSERT INTO `prod_cat_lookup` VALUES(204, 4);
INSERT INTO `prod_cat_lookup` VALUES(205, 4);
INSERT INTO `prod_cat_lookup` VALUES(206, 4);
INSERT INTO `prod_cat_lookup` VALUES(207, 4);
INSERT INTO `prod_cat_lookup` VALUES(208, 4);
INSERT INTO `prod_cat_lookup` VALUES(209, 1);
INSERT INTO `prod_cat_lookup` VALUES(210, 1);
INSERT INTO `prod_cat_lookup` VALUES(211, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prod_chain_lookup`
--

CREATE TABLE `prod_chain_lookup` (
  `prod_id` varchar(20) NOT NULL,
  `chain_id` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_chain_lookup`
--

INSERT INTO `prod_chain_lookup` VALUES('185', '1');
INSERT INTO `prod_chain_lookup` VALUES('185', '3');
INSERT INTO `prod_chain_lookup` VALUES('185', '5');
INSERT INTO `prod_chain_lookup` VALUES('176', '1');
INSERT INTO `prod_chain_lookup` VALUES('176', '3');
INSERT INTO `prod_chain_lookup` VALUES('176', '5');
INSERT INTO `prod_chain_lookup` VALUES('187', '1');
INSERT INTO `prod_chain_lookup` VALUES('192', '4');
INSERT INTO `prod_chain_lookup` VALUES('186', '3');
INSERT INTO `prod_chain_lookup` VALUES('186', '2');
INSERT INTO `prod_chain_lookup` VALUES('186', '1');
INSERT INTO `prod_chain_lookup` VALUES('188', '1');
INSERT INTO `prod_chain_lookup` VALUES('188', '2');
INSERT INTO `prod_chain_lookup` VALUES('188', '3');
INSERT INTO `prod_chain_lookup` VALUES('189', '1');
INSERT INTO `prod_chain_lookup` VALUES('189', '2');
INSERT INTO `prod_chain_lookup` VALUES('189', '3');
INSERT INTO `prod_chain_lookup` VALUES('190', '1');
INSERT INTO `prod_chain_lookup` VALUES('190', '2');
INSERT INTO `prod_chain_lookup` VALUES('190', '3');
INSERT INTO `prod_chain_lookup` VALUES('192', '3');
INSERT INTO `prod_chain_lookup` VALUES('192', '2');
INSERT INTO `prod_chain_lookup` VALUES('192', '1');
INSERT INTO `prod_chain_lookup` VALUES('101', '3');
INSERT INTO `prod_chain_lookup` VALUES('101', '2');
INSERT INTO `prod_chain_lookup` VALUES('101', '1');
INSERT INTO `prod_chain_lookup` VALUES('193', '2');
INSERT INTO `prod_chain_lookup` VALUES('193', '3');
INSERT INTO `prod_chain_lookup` VALUES('193', '4');
INSERT INTO `prod_chain_lookup` VALUES('104', '3');
INSERT INTO `prod_chain_lookup` VALUES('104', '2');
INSERT INTO `prod_chain_lookup` VALUES('104', '1');
INSERT INTO `prod_chain_lookup` VALUES('104', '4');
INSERT INTO `prod_chain_lookup` VALUES('104', '5');
INSERT INTO `prod_chain_lookup` VALUES('209', '4');
INSERT INTO `prod_chain_lookup` VALUES('209', '3');
INSERT INTO `prod_chain_lookup` VALUES('209', '2');
INSERT INTO `prod_chain_lookup` VALUES('209', '1');
INSERT INTO `prod_chain_lookup` VALUES('98', '1');
INSERT INTO `prod_chain_lookup` VALUES('98', '2');
INSERT INTO `prod_chain_lookup` VALUES('98', '3');
INSERT INTO `prod_chain_lookup` VALUES('102', '1');
INSERT INTO `prod_chain_lookup` VALUES('102', '2');
INSERT INTO `prod_chain_lookup` VALUES('102', '3');
INSERT INTO `prod_chain_lookup` VALUES('106', '1');
INSERT INTO `prod_chain_lookup` VALUES('106', '2');
INSERT INTO `prod_chain_lookup` VALUES('106', '3');
INSERT INTO `prod_chain_lookup` VALUES('108', '1');
INSERT INTO `prod_chain_lookup` VALUES('108', '2');
INSERT INTO `prod_chain_lookup` VALUES('108', '3');
INSERT INTO `prod_chain_lookup` VALUES('110', '1');
INSERT INTO `prod_chain_lookup` VALUES('110', '2');
INSERT INTO `prod_chain_lookup` VALUES('110', '3');
INSERT INTO `prod_chain_lookup` VALUES('111', '1');
INSERT INTO `prod_chain_lookup` VALUES('111', '2');
INSERT INTO `prod_chain_lookup` VALUES('111', '3');

-- --------------------------------------------------------

--
-- Table structure for table `prod_img_lookup`
--

CREATE TABLE `prod_img_lookup` (
  `prod_id` int(100) NOT NULL,
  `img_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_img_lookup`
--

INSERT INTO `prod_img_lookup` VALUES(98, 89);
INSERT INTO `prod_img_lookup` VALUES(104, 95);
INSERT INTO `prod_img_lookup` VALUES(113, 104);
INSERT INTO `prod_img_lookup` VALUES(116, 107);
INSERT INTO `prod_img_lookup` VALUES(117, 108);
INSERT INTO `prod_img_lookup` VALUES(119, 110);
INSERT INTO `prod_img_lookup` VALUES(126, 117);
INSERT INTO `prod_img_lookup` VALUES(127, 118);
INSERT INTO `prod_img_lookup` VALUES(175, 209);
INSERT INTO `prod_img_lookup` VALUES(186, 229);
INSERT INTO `prod_img_lookup` VALUES(102, 248);
INSERT INTO `prod_img_lookup` VALUES(105, 252);
INSERT INTO `prod_img_lookup` VALUES(105, 253);
INSERT INTO `prod_img_lookup` VALUES(106, 255);
INSERT INTO `prod_img_lookup` VALUES(95, 283);
INSERT INTO `prod_img_lookup` VALUES(102, 289);
INSERT INTO `prod_img_lookup` VALUES(102, 290);
INSERT INTO `prod_img_lookup` VALUES(106, 291);
INSERT INTO `prod_img_lookup` VALUES(106, 292);
INSERT INTO `prod_img_lookup` VALUES(111, 294);
INSERT INTO `prod_img_lookup` VALUES(111, 295);
INSERT INTO `prod_img_lookup` VALUES(111, 296);
INSERT INTO `prod_img_lookup` VALUES(116, 297);
INSERT INTO `prod_img_lookup` VALUES(116, 298);
INSERT INTO `prod_img_lookup` VALUES(192, 299);
INSERT INTO `prod_img_lookup` VALUES(192, 300);
INSERT INTO `prod_img_lookup` VALUES(192, 301);
INSERT INTO `prod_img_lookup` VALUES(95, 304);
INSERT INTO `prod_img_lookup` VALUES(110, 307);
INSERT INTO `prod_img_lookup` VALUES(110, 308);
INSERT INTO `prod_img_lookup` VALUES(110, 309);
INSERT INTO `prod_img_lookup` VALUES(101, 311);
INSERT INTO `prod_img_lookup` VALUES(101, 312);
INSERT INTO `prod_img_lookup` VALUES(194, 313);
INSERT INTO `prod_img_lookup` VALUES(194, 314);
INSERT INTO `prod_img_lookup` VALUES(194, 316);
INSERT INTO `prod_img_lookup` VALUES(195, 317);
INSERT INTO `prod_img_lookup` VALUES(195, 318);
INSERT INTO `prod_img_lookup` VALUES(195, 319);
INSERT INTO `prod_img_lookup` VALUES(197, 322);
INSERT INTO `prod_img_lookup` VALUES(197, 323);
INSERT INTO `prod_img_lookup` VALUES(197, 324);
INSERT INTO `prod_img_lookup` VALUES(198, 325);
INSERT INTO `prod_img_lookup` VALUES(198, 326);
INSERT INTO `prod_img_lookup` VALUES(198, 327);
INSERT INTO `prod_img_lookup` VALUES(199, 328);
INSERT INTO `prod_img_lookup` VALUES(199, 329);
INSERT INTO `prod_img_lookup` VALUES(199, 330);
INSERT INTO `prod_img_lookup` VALUES(200, 331);
INSERT INTO `prod_img_lookup` VALUES(200, 332);
INSERT INTO `prod_img_lookup` VALUES(200, 333);
INSERT INTO `prod_img_lookup` VALUES(108, 334);
INSERT INTO `prod_img_lookup` VALUES(108, 335);
INSERT INTO `prod_img_lookup` VALUES(101, 337);
INSERT INTO `prod_img_lookup` VALUES(202, 341);
INSERT INTO `prod_img_lookup` VALUES(202, 342);
INSERT INTO `prod_img_lookup` VALUES(202, 343);
INSERT INTO `prod_img_lookup` VALUES(203, 344);
INSERT INTO `prod_img_lookup` VALUES(203, 345);
INSERT INTO `prod_img_lookup` VALUES(203, 347);
INSERT INTO `prod_img_lookup` VALUES(204, 348);
INSERT INTO `prod_img_lookup` VALUES(204, 349);
INSERT INTO `prod_img_lookup` VALUES(204, 350);
INSERT INTO `prod_img_lookup` VALUES(205, 351);
INSERT INTO `prod_img_lookup` VALUES(205, 352);
INSERT INTO `prod_img_lookup` VALUES(205, 353);
INSERT INTO `prod_img_lookup` VALUES(196, 355);
INSERT INTO `prod_img_lookup` VALUES(196, 356);
INSERT INTO `prod_img_lookup` VALUES(206, 357);
INSERT INTO `prod_img_lookup` VALUES(206, 358);
INSERT INTO `prod_img_lookup` VALUES(206, 359);
INSERT INTO `prod_img_lookup` VALUES(207, 360);
INSERT INTO `prod_img_lookup` VALUES(207, 361);
INSERT INTO `prod_img_lookup` VALUES(207, 362);
INSERT INTO `prod_img_lookup` VALUES(208, 363);
INSERT INTO `prod_img_lookup` VALUES(208, 364);
INSERT INTO `prod_img_lookup` VALUES(209, 365);
INSERT INTO `prod_img_lookup` VALUES(209, 366);
INSERT INTO `prod_img_lookup` VALUES(209, 367);
INSERT INTO `prod_img_lookup` VALUES(210, 368);
INSERT INTO `prod_img_lookup` VALUES(210, 369);
INSERT INTO `prod_img_lookup` VALUES(211, 370);
INSERT INTO `prod_img_lookup` VALUES(211, 371);
INSERT INTO `prod_img_lookup` VALUES(211, 372);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL auto_increment,
  `user_name` varchar(100) NOT NULL,
  `saved_password` varchar(32) NOT NULL,
  `salt` varchar(25) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'pwbAdmin', '93a0c75be16de6d97d92650d0435708a', 'Pink is Cool');
