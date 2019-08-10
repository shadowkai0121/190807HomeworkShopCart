-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019 年 08 月 10 日 10:34
-- 伺服器版本： 10.3.16-MariaDB
-- PHP 版本： 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `homework`
--
DROP DATABASE IF EXISTS homework;
CREATE DATABASE homework;
-- --------------------------------------------------------

--
-- 資料表結構 `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `isPaid` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `orderdetails`
--

INSERT INTO `orderdetails` (`orderID`, `userID`, `productID`, `quantity`, `isPaid`) VALUES
(NULL, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `orderDate` datetime DEFAULT NULL,
  `totalPrice` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(60) DEFAULT NULL,
  `unitPrice` int(11) DEFAULT NULL,
  `productPhotoS` varchar(200) DEFAULT NULL,
  `productPhotoL` varchar(200) DEFAULT NULL,
  `productIntroduction` varchar(500) DEFAULT NULL,
  `productDescription` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`productID`, `productName`, `unitPrice`, `productPhotoS`, `productPhotoL`, `productIntroduction`, `productDescription`) VALUES
(1, '凱薩沙拉', 60, '/img/Appectizer/165x163/Appectizer_02.jpg', '/img/Appectizer/800X600/Appectizer_02.jpg', '炎熱時就該吃生菜輕飲食清爽一夏！', '凱薩生菜棒的內容物有紅蘿蔔、豆薯、小黃瓜，一口咬下時有著清爽鮮甜的滋味，一旁還有主廚調製的蜂蜜芥末醬可沾取，口感別於一般的生菜沙拉，吃起來創意又特別。'),
(2, '黃金薯條', 35, '/img/Appectizer/165x163/Appectizer_06.jpg', '/img/Appectizer/800X600/Appectizer_06.jpg', '金黃酥脆的薯條口感讓人大呼過癮。', '薯條炸得金黃酥脆，咬一口外酥內軟的口感讓人大呼過癮。'),
(3, '焗烤肉醬薯條', 100, '/img/Appectizer/165x163/Appectizer_10.jpg', '/img/Appectizer/800X600/Appectizer_10.jpg', '將起司薯條夾起，濃郁的起司讓我欲罷不能。', '焗烤肉醬薯條淋上肉醬汁，再鋪上一層濃厚的焗烤起司，上桌時起司香撲鼻而來，令人垂涎三尺。薯條一口咬下，炸的金黃酥脆，融合著肉醬和起司的香氣，吃完不覺得膩口，就連小朋友也愛不釋手。'),
(4, '墨西哥香辣菲力牛肉披薩', 358, '/img/Main/165x163/Main_01.jpg', '/img/Main/800X600/Main_01.jpg', '採窯烤披薩做法餅皮酥脆可口讓人愛不釋手。', '採用南義拿坡里手工窯烤披薩作法，藉由窯內高溫，將水分及甜味鎖在麵糰裡， 讓餅皮口感外酥內軟。 番茄紅醬鋪底，與墨西哥辣椒的微辣鹹香，鮮嫩多汁的牛菲力， 在莫札瑞拉起士的襯托下更顯甜味！'),
(5, '炭烤沙朗心牛排與脆皮雞腿排', 360, '/img/Main/165x163/Main_02.jpg', '/img/Main/800X600/Main_02.jpg', '上選牛排與雞腿排配上鮮甜大干貝，大滿足！', '散發肉汁香氣還同時呈現明亮色澤的牛排與雞腿排， 鮮甜的大干貝和馬鈴薯、什錦鮮菇也不遜色 牛排與雞腿排使用先烤後煎更增添了風味香氣外 還保留了豐富肉汁讓人真的會一口接一口！無一處不美味啊！'),
(6, '紹興酒奶油雞腿排', 229, '/img/Main/165x163/Main_04.jpg', '/img/Main/800X600/Main_04.jpg', '紹興酒的香氣撲鼻而來，濃郁滋味誰能抵抗！', '有別於一般義大利麵的白醬口味，選用紹興酒醃製入味的去骨雞腿排，大口咬下時濃郁的紹興酒香直衝腦波，肉質吃起來微甜嫩口，再配上奶油白醬，麵條吃起來軟中帶Q讓人無法控制！'),
(7, '軟殼蟹蛤蜊花義大利麵佐香檸奶汁', 359, '/img/Main/165x163/Main_07.jpg', '/img/Main/800X600/Main_07.jpg', '軟殼蟹炸後，香酥不油膩還有卡滋卡滋的聲響。', '義大利麵佐香檸奶汁，還有蛤仔的鮮味，麵條彈牙吃起來鹹香帶鮮的滋味，口味算好吃。滿滿一盤的蛤蜊鋪，每顆蛤蜊好新鮮，令人越吃越過癮。'),
(8, '紅醬蕃茄綜合海鮮麵', 178, '/img/Main/165x163/Main_05.jpg', '/img/Main/800X600/Main_07.jpg', '選用天使紅蝦、花枝、蛤仔、蔬菜，料多味美！', '紅醬選用蕃茄整顆搗碎製作成蕃茄湖，最後再加入鹽巴調味製作而成。麵條拌入紅醬，吃進嘴裡鹹香帶酸甜，麵條咬起來軟硬適中，有彈性且入味!'),
(9, '夏多內花蜜醋', 240, '/img/Beverage/165x163/Beverage_03.jpg', '/img/Beverage/800X600/Beverage_03.jpg', '在夏多內海邊，浪花般的氛圍與酸甜一起縈繞！', '由少見光臘樹花蜜與夏多內白酒醋的調配，一上桌時以RONA極薄酒杯讓花香氣在震盪搖晃時，將上面泡沫跟花蜜醋一起入口，味蕾上呈現著酸酸甜甜的口感，喝起來滿是淡淡花香在口中縈繞，忍不住想獨自佔有！ '),
(10, '蜜桃初戀泡泡', 110, '/img/Beverage/165x163/Beverage_05.jpg', '/img/Beverage/800X600/Beverage_05.jpg', '沁涼透心的初戀泡泡是嚴選蜜桃口味', '沁涼透心的初戀滋味泡泡是嚴選蜜桃口味，蜜桃香甜與氣泡水的結合，再加上清香檸檬片，一喝下去清涼爽口，口中的氣泡，更增添另一種口感。'),
(11, '蜜釀鳳梨冰茶', 160, '/img/Beverage/165x163/Beverage_08.jpg', '/img/Beverage/800X600/Beverage_08.jpg', '蜜釀鳳梨冰茶，微酸香甜口感，帶有清爽的滋味。', '蜜釀鳳梨冰茶，微酸香甜口感，帶有清爽的滋味，喝完有一種解油膩的感覺。'),
(12, '季節水果茶', 130, '/img/Beverage/165x163/Beverage_10.jpg', '/img/Beverage/800X600/Beverage_10.jpg', '清甜略帶微酸的口感，讓人想一接著一口。', '這一季的繽紛水果茶運用冬季限定洛神醬與鳳梨醬為基底茶，自家手工熬煮鳳梨醬，再搭配新鮮檸檬汁、百香果、蘋果的融合，喝一口清甜而略帶微酸的口感，讓嘴裡有著豐富韻味，讓人想一接著一口。'),
(13, '橙花君度檸檬塔', 160, '/img/Dessert/165x163/Dessert_01.jpg', '/img/Dessert/800X600/Dessert_01.jpg', '檸檬塔溫潤滑順口感,讓時間停留在這美好的記憶！', '這道檸檬塔選用皮飽滿柑橘香的黃檸檬與黃檸檬汁，加入香氣清新的橙花，再使用日本伊娜寒天，最後再以極薄的杏仁餡鋪底，烤時保留了水份，像是馬卡龍口感微帶黏牙，一口咬下酥脆鬆鬆的塔皮結合爽口溫潤的檸檬餡，整體口感清新甜酸，卻略帶淘氣的初春滋味。'),
(14, '巧克力慕斯', 135, '/img/Dessert/165x163/Dessert_07.jpg', '/img/Dessert/800X600/Dessert_07.jpg', '頂級法芙娜巧克力佐樹梅粒點綴，少女的最愛！', '巧克力慕斯選用70%的巧克力來製作，再加入樹梅粒點綴一些增加口感，蛋糕體本身口感較微濕潤，配上高濃度70%巧克力，一入口有著苦甜滋味，口感並不會太甜，多重層次口感是許多少女們的最愛！'),
(15, '玫瑰生乳酪蛋糕', 150, '/img/Dessert/165x163/Dessert_08.jpg', '/img/Dessert/800X600/Dessert_08.jpg', '夢幻繽紛的玫瑰與馬斯卡彭起司的結合', '手工製作的玫瑰生乳酪蛋糕，特別選用法國進口原料與美國品牌的奶油起司製作而成，吃起來帶有玫瑰的甜馨香氣，口感柔細滑順又輕盈，一旁還有劃上浪漫的愛心，讓人好捨不得吃啊！'),
(16, '冰淇淋QQ鬆餅', 150, '/img/Dessert/165x163/Dessert_10.jpg', '/img/Dessert/800X600/Dessert_10.jpg', '酥脆餅皮配上ＱＱ麻糬，交織出驚喜滋味。', '法式手工鮮奶油與冰淇淋完美合體，讓鬆餅看起來更是霸氣有風味，鬆餅外層吃起來微微的酥脆，內餡蛋糕體配上ＱＱ麻糬，吃起來是扎實的口感且很厚實，一口吃下交織出驚喜滋味。'),
(17, '蛋糕三重奏', 150, '/img/Dessert/165x163/Dessert_15.jpg', '/img/Dessert/800X600/Dessert_15.jpg', '超高CP值，一次吃到三種口味的蛋糕', '檸檬磅蛋糕使用檸檬與白糖製成，在嘴裡散發檸檬迷人香氣，口味上清香卻不會甜膩。 起司蛋糕嚴選濃郁起司配上酥脆餅皮，大口咬下層層堆疊的起司味，吃起來清爽、柔滑，咬起來著入口即化有著絕妙口感，蜂蜜蛋糕獨特的厚實口感，大口咬下舌尖上散發濃郁的蜂蜜及蛋香，香氣十足直得細細品味！'),
(18, '核桃燕麥鬆餅', 180, '/img/Dessert/165x163/Dessert_16.jpg', '/img/Dessert/800X600/Dessert_16.jpg', '嚴選燕麥片、原味核桃，綿密紮實又彈牙的口感！', '桃燕麥鬆餅嚴選燕麥片、原味核桃，自己調配製作，再擺上鮮奶油與水果。一口咬下嘴裡滿滿的核桃香，吃起來有核桃爽口的堅果香，沾著一旁鮮奶油口感綿密還能享受紮實又彈牙的口感。'),
(19, '香料蔬菜湯', 250, '/img/Soup/165x163/Soup_05.jpg', '/img/Soup/800x600/Soup_05.jpg', '香料蔬菜湯以蕃茄和香草為基底，具有療癒效果的熱湯!', '香料蔬菜湯以蕃茄和香草為基底不需任何調味，嚐來滋味鮮甜自然，彷彿走進一片種滿有機蔬果的田園，喝來溫暖滿足！'),
(20, '特調玉米濃湯', 180, '/img/Soup/165x163/Soup_01.jpg', '/img/Soup/800x600/Soup_01.jpg', '滿滿的玉米、洋蔥香甜滋味，自然鮮濃。', '特調玉米濃湯加入新鮮玉米、鮮奶、洋蔥、奶油等食材是喝得到食材原味的湯，吃得到食物原形讓口感好滿足、同時感受得到自然香濃。'),
(21, '意大利番茄湯', 180, '/img/Soup/165x163/Soup_02.jpg', '/img/Soup/800x600/Soup_02.jpg', '新鮮成熟和美味的西紅柿，自然健康。', '意大利番茄湯需要新鮮成熟和美味的西紅柿。搭配上橄欖油，青蔥，大蒜，白葡萄酒。與意大利草藥等香料均勻混合慢火煮成的番茄醬，美味又好吃。'),
(22, '意大利婚禮湯', 280, '/img/Soup/165x163/Soup_03.jpg', '/img/Soup/800x600/Soup_03.jpg', '與婚禮無關，儘管常在意大利婚禮上作為開胃菜。', '豐盛的綠色和豐富的鹹味肉類的幸福婚姻，通過肉類的濃郁的口感加上香濃口的雞湯以及多又兼康的蔬菜，融合在一個輕盈而令人滿意美味佳餚！'),
(23, '原味白豆湯', 220, '/img/Soup/165x163/Soup_04.jpg', '/img/Soup/800x600/Soup_04.jpg', '白豆湯配方都是用新鮮的原料製成，使其真正新鮮。', '簡單好吃的素食白豆湯為主廚使用新鮮的食材製成，從頭開始製慢火熬煮作蔬菜湯使其真正新鮮甘甜。自製的蔬菜湯底使其他單純的素食更加純樸好吃。'),
(24, '香料蔬菜湯', 250, '/img/Soup/165x163/Soup_05.jpg', '/img/Soup/800x600/Soup_05.jpg', '香料蔬菜湯以蕃茄和香草為基底，具有療癒效果的熱湯!', '香料蔬菜湯以蕃茄和香草為基底不需任何調味，嚐來滋味鮮甜自然，彷彿走進一片種滿有機蔬果的田園，喝來溫暖滿足！');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(20) DEFAULT NULL,
  `userPwd` varchar(20) DEFAULT NULL,
  `userEmail` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPwd`, `userEmail`) VALUES
(1, 'admin', 'admin', NULL);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `vw_shopcart`
-- (請參考以下實際畫面)
--
CREATE TABLE `vw_shopcart` (
`productID` int(11)
,`userID` int(11)
,`productName` varchar(60)
,`unitPrice` int(11)
,`quantity` int(11)
,`sum` bigint(21)
,`productPhotoS` varchar(200)
);

-- --------------------------------------------------------

--
-- 檢視表結構 `vw_shopcart`
--
DROP TABLE IF EXISTS `vw_shopcart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_shopcart`  AS  select `products`.`productID` AS `productID`,`orderdetails`.`userID` AS `userID`,`products`.`productName` AS `productName`,`products`.`unitPrice` AS `unitPrice`,`orderdetails`.`quantity` AS `quantity`,`products`.`unitPrice` * `orderdetails`.`quantity` AS `sum`,`products`.`productPhotoS` AS `productPhotoS` from (`products` join `orderdetails` on(`products`.`productID` = `orderdetails`.`productID`)) where `orderdetails`.`isPaid` = 0 ;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
