-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 07, 2022 at 05:04 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ruou`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_ddh`
--

CREATE TABLE `chi_tiet_ddh` (
  `ma_ddh` varchar(10) NOT NULL,
  `ma_dr` varchar(10) NOT NULL,
  `so_luong` int(100) NOT NULL,
  `gia` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chi_tiet_ddh`
--

INSERT INTO `chi_tiet_ddh` (`ma_ddh`, `ma_dr`, `so_luong`, `gia`) VALUES
('DDH_01', 'sp_021', 10, 100000000),
('DDH_01', 'sp_022', 100, 1200000),
('DDH_05', 'sp_017', 100, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_km`
--

CREATE TABLE `chi_tiet_km` (
  `ma_km` varchar(10) NOT NULL,
  `ma_dr` varchar(10) NOT NULL,
  `so_luong` int(100) NOT NULL,
  `phantram_km` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chi_tiet_km`
--

INSERT INTO `chi_tiet_km` (`ma_km`, `ma_dr`, `so_luong`, `phantram_km`) VALUES
('KM_001', 'sp_022', 146, 50);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_ncc`
--

CREATE TABLE `chi_tiet_ncc` (
  `ma_ncc` varchar(10) NOT NULL,
  `ma_dr` varchar(10) NOT NULL,
  `so_luong` int(100) DEFAULT NULL,
  `gia` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_pd`
--

CREATE TABLE `chi_tiet_pd` (
  `id_pd` int(11) NOT NULL,
  `ma_dr` varchar(10) NOT NULL,
  `so_luong` int(100) NOT NULL,
  `gia` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chi_tiet_pd`
--

INSERT INTO `chi_tiet_pd` (`id_pd`, `ma_dr`, `so_luong`, `gia`) VALUES
(55, 'sp_021', 5, 3950000),
(55, 'sp_022', 1, 435000);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_pn`
--

CREATE TABLE `chi_tiet_pn` (
  `ma_pn` varchar(10) NOT NULL,
  `ma_dr` varchar(10) NOT NULL,
  `so_luong` int(100) NOT NULL,
  `gia` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chi_tiet_pn`
--

INSERT INTO `chi_tiet_pn` (`ma_pn`, `ma_dr`, `so_luong`, `gia`) VALUES
('PN_01', 'sp_022', 100, 1000000),
('PN_10', 'sp_017', 100, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `dong_ruou`
--

CREATE TABLE `dong_ruou` (
  `ma_dr` varchar(10) NOT NULL,
  `ten_dr` varchar(50) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `gia` double NOT NULL,
  `mo_ta` text DEFAULT NULL COMMENT 'chi tiết sp',
  `noi_dung_dr` text NOT NULL,
  `hinh_anh` text NOT NULL,
  `sl_ton` int(100) NOT NULL,
  `check_sp_moi` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0:chưa check |\r\n1:sp mới',
  `ma_lr` varchar(10) NOT NULL,
  `ma_th` varchar(10) NOT NULL,
  `ma_ncc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dong_ruou`
--

INSERT INTO `dong_ruou` (`ma_dr`, `ten_dr`, `slug`, `gia`, `mo_ta`, `noi_dung_dr`, `hinh_anh`, `sl_ton`, `check_sp_moi`, `ma_lr`, `ma_th`, `ma_ncc`) VALUES
('sp_002', 'Glen Grant the major\'s Reserve', 'glen-grant-the-major\'s-reserve', 1500000, '<p>Tuổi của rượu phải rất trẻ. M&ugrave;i thơm hơn cả mong đợi. Vị ngọt dịu đến nao l&ograve;ng. Trong th&ugrave;ng Bourbon trẻ trung, &acirc;m sắc của hạt kem đ&atilde; xuất hiện, nhưng n&oacute; hơi cố t&igrave;nh trở n&ecirc;n gần gũi một ch&uacute;t với hương tr&aacute;i c&acirc;y. Rất nhiều tr&aacute;i c&acirc;y trắng với hương hoa dịu nhẹ, kết th&uacute;c bằng một ch&uacute;t mạch nha. Kh&ocirc;ng đơn giản nhưng dễ chịu. Được ph&aacute;t triển bởi &ocirc;ng James &ldquo;The Major&rdquo; Grant nổi tiếng của nh&agrave; l&agrave;m rượu Glen Grant, đ&acirc;y l&agrave; d&ograve;ng whisky đơn mạch dễ uống với vị h&agrave;i h&ograve;a v&agrave; nhẹ nh&agrave;ng. Vị mượt m&agrave; xen lẫn hương tr&aacute;i c&acirc;y lan tỏa khi thưởng thức với hậu vị vừa phải thoảng hương c&aacute;c loại hạt.</p>', '<p>M&agrave;u sắc: Sắc v&agrave;ng của &aacute;nh ban mai. M&ugrave;i hương: Nhẹ nh&agrave;ng, thoảng hương tr&aacute;i c&acirc;y với điểm nhấn của t&aacute;o xanh. Vị: Vị vượt m&agrave; xen lẫn hoa quả. Vị sau khi ho&agrave;n tất: Thoảng vị hạt. M&ugrave;i vị: Quả m&agrave;u trắng vẫn chiếm ưu thế, b&acirc;y giờ được nối với một số gỗ, kh&aacute; kh&ocirc; v&agrave; k&eacute;m th&uacute; vị. R&otilde; r&agrave;ng l&agrave; được tưới xuống.</p>', 'Glen Grant the major\'s Reserve0.webp', 100, 1, 'wk_002', 'th_002', 'NCC_01'),
('sp_003', 'GLENFIDDICH Grand Cru 23 years old', 'glenfiddich-grand-cru-23-years old', 100000, '<p>GLENFIDDICH Grand Cru 23YO Trải qua qu&aacute; tr&igrave;nh ng&acirc;m ủ đặc biệt trong nhiều loại th&ugrave;ng gỗ chất lượng c&ugrave;ng việc sử dụng nguồn nguy&ecirc;n liệu tốt nhất n&ecirc;n Rượu Glenfiddich Grand Cru 23 Years Old đạt đến đỉnh cao về chất lượng. D&ugrave; c&oacute; gi&aacute; th&agrave;nh kh&ocirc;ng hề rẻ nhưng chai rượu n&agrave;y vẫn l&agrave; sự lựa chọn h&agrave;ng đầu cho những bữa tiệc đẳng cấp của giới thượng lưu. Giới Thiệu Về Rượu Glenfiddich Grand Cru 23 Years Old Glenfiddich Grand Cru 23 l&agrave; chai rượu d&agrave;nh cho c&aacute;c qu&yacute; &ocirc;ng s&agrave;nh điệu. T&ecirc;n Grand Cru của chai rượu n&agrave;y xuất ph&aacute;t từ qu&aacute; tr&igrave;nh sản xuất rượu với việc trưởng th&agrave;nh một phần trong những th&ugrave;ng rượu vang Cuv&eacute;e của Ph&aacute;p. Đ&acirc;y l&agrave; một loại rượu Whisky phong ph&uacute; đặc biệt với hương vị mạnh mẽ, đầy c&aacute; t&iacute;nh. Sản phẩm được đ&aacute;nh gi&aacute; cao bởi c&aacute;c chuy&ecirc;n gia v&agrave; người s&agrave;nh rượu tr&ecirc;n to&agrave;n thế giới nhờ hương thơm quyến rũ của chanh, hoa t&aacute;o, b&aacute;nh m&igrave; mới nướng.</p>', '<p>Với nồng độ vừa phải (40 độ), Rượu th&iacute;ch hợp nhất khi uống nguy&ecirc;n chất. Tuy nhi&ecirc;n nếu bạn l&agrave; người mới l&agrave;m quen với rượu v&agrave; th&iacute;ch một ly rượu nhẹ nh&agrave;ng, tươi m&aacute;t hơn th&igrave; c&oacute; thể pha th&ecirc;m ch&uacute;t nước, đ&aacute; hoặc ướp lạnh trước khi uống.</p>', 'GLENFIDDICH Grand Cru 23 years old40.jpg', 96, 1, 'wk_002', 'th_001', 'NCC_01'),
('sp_004', 'Glenfiddich 12 years old Gift box', 'glenfiddich-12-years-old-gift-box', 1200000, '<p>Ti&ecirc;n phong trong danh mục Scotch Whisky mạch nha đơn cất uy t&iacute;n , Glenfiddich 12 năm tuổi hiện được y&ecirc;u th&iacute;ch tr&ecirc;n Thế giới hơn bất kỳ loại Whisky mạch nha đơn cất n&agrave;o kh&aacute;c . Hơn tất cả , th&agrave;nh c&ocirc;ng của Glenfiddich đ&eacute;n từ thực tế , đ&acirc;y l&agrave; d&ograve;ng Whisky mạch nha dễ tiếp cận , dễ uống , v&agrave; c&oacute; thể thưởng thức tại bất cứ thời điểm n&agrave;o trong ng&agrave;y - D&ograve;ng Scotch Whisky Mạch nha đơn cất nguy&ecirc;n thủy đặc trưng n&agrave;y được trưởng th&agrave;nh &iacute;t nhất 12 năm trong c&aacute;c th&ugrave;ng gỗ sồi Mỹ &amp; T&acirc;y Ban Nha . Chất lượng của những th&ugrave;ng gỗ n&agrave;y cũng hết sức đặc biệt , mỗi th&ugrave;ng lại c&oacute; một xu hướng hương vị ri&ecirc;ng biệt , được l&agrave;m thủ c&ocirc;ng bởi đội ngũ gi&agrave;u kinh nghiệm tại xưởng đ&oacute;ng th&ugrave;ng của nh&agrave; Glenfiddich , đảm bảo cho Whisky ph&aacute;t triển đến độ phức hợp , hương vị lịch l&atilde;m tr&ograve;n đầy với chi ch&uacute; của L&ecirc; tươi v&agrave; gỗ Sồi tinh tế - Rượu Glenfiddich thường được sử dụng l&agrave;m đồ uống trong c&aacute;c Cuộc vui sum họp bạn b&egrave; , l&agrave;m qu&agrave; biếu cho Người th&acirc;n v&agrave; Đối t&aacute;c l&agrave;m ăn</p>', '<p>Dung t&iacute;ch : 700 ml - Nồng độ : 40 % - Mầu rượu : V&agrave;ng nhạt - Quy c&aacute;ch : 06 Chai/ Th&ugrave;ng - Nguồn gốc xuất xứ : H&agrave;ng nhập khẩu Scotland - Hương : M&ugrave;i hương thơm tươi mới đặc biệt với gợi &yacute; Tr&aacute;i c&acirc;y như L&ecirc; ch&iacute;n . D&ograve;ng mạch nha đơn cất tuyệt vời với hương thơm c&acirc;n bằng tinh tế - Vị : Đặc trưng ngọt ng&agrave;o với ghi ch&uacute; Tr&aacute;i c&acirc;y . Ph&aacute;t triển với hương vị của b&aacute;nh bơ , kem , mạch nha v&agrave; hương vị gỗ sồi nhẹ nh&agrave;ng - Kết th&uacute;c : K&eacute;o d&agrave;i , &ecirc;m dịu &amp; mượt m&agrave; - Nguồn gốc xuất xứ : H&agrave;ng nhập khẩu Scotland</p>', 'Glenfiddich 12 years old Gift box47.webp', 98, 1, 'wk_002', 'th_001', 'NCC_01'),
('sp_005', 'GLENFIDDICH 30 YEAR OLD', 'glenfiddich-30-year-old', 1200000, '<p>Rượu Glenfiddich l&agrave; d&ograve;ng rượu cực kỳ hiếm n&agrave;y được ủ &iacute;t nhất 30 năm trong th&ugrave;ng Oloroso T&acirc;y Ban Nha v&agrave; gỗ sồi bourbon của Mỹ. Mỗi th&ugrave;ng được đ&aacute;nh số ri&ecirc;ng đ&atilde; th&agrave;nh lập v&agrave; được lựa chọn bởi c&aacute;c chuy&ecirc;n gia. Cho ra sự c&acirc;n bằng tốt nhất của gỗ sồi nồng nhiệt v&agrave; ấm &aacute;p ngọt ng&agrave;o.</p>', '<p>M&agrave;u sắc: Đồng phong ph&uacute;. - Mũi: mịn c&acirc;n bằng, với c&aacute;c oakiness lần xuất hiện của tr&aacute;i c&acirc;y v&agrave; ghi ch&uacute; sherry ngon. - Hương vị: phức tạp v&agrave; quyến rũ gỗ, hoa được nhấn mạnh bởi một vị ngọt. - Kết th&uacute;c: dư vị k&eacute;o d&agrave;i, ngọt ng&agrave;o v&agrave; ấm &aacute;p.</p>', 'GLENFIDDICH 30 YEAR OLD59.jpg', 100, 1, 'wk_002', 'th_001', 'NCC_01'),
('sp_006', 'Glenfiddich Reserve Cask', 'glenfiddich-reserve-cask', 1500000, '<p>The Glenfiddich Select Cask l&agrave; kết quả của việc phối trộn ho&agrave;n hảo của c&aacute;c loại rượu Whisky mạch nha đ&atilde; được ủ trong th&ugrave;ng gỗ sồi Ch&acirc;u &acirc;u , th&ugrave;ng gỗ sồi ủ rượu Bourbon v&agrave; th&ugrave;ng gỗ sồi đ&atilde; được ủ rượu vang đỏ trước đ&oacute; Tất cả 3 loại th&ugrave;ng gỗ sồi tr&ecirc;n được đ&iacute;ch th&acirc;n &ocirc;ng Brian Kinsman l&agrave; chuy&ecirc;n gia phối chế rượu của The Glenfiddich chọn từng th&ugrave;ng một theo ti&ecirc;u ch&iacute; đ&atilde; được x&acirc;y dựng trong quy trinh phối trộn rượu c&oacute; t&ecirc;n Solera Vat ( Sẽ được m&ocirc; tả ở phần sau ) Kết quả l&agrave; The Glenfiddich Select Cask c&oacute; dạng nhẹ nh&agrave;ng , uyển chuyển v&agrave; c&oacute; vị ngọt của Mạch nha ( Malt ) , m&ugrave;i Gia vị , hương thơm cay nồng của Gỗ sồi v&agrave; một &iacute;t hương vị của Tr&aacute;i c&acirc;y họ chanh.</p>', '<p>Dung t&iacute;ch : 1 L&iacute;t Nồng độ : 40 % Mầu sắc : V&agrave;ng hổ ph&aacute;ch M&ugrave;i : M&ugrave;i hương thơm nồng của Gia vị v&agrave; Gỗ sồi , M&ugrave;i b&aacute;nh mỳ nướng , hương thơm của Tr&aacute;i c&acirc;y họ Cam v&agrave; Qu&yacute;t Vị : Vị ngọt ng&agrave;o của Mạch nha ( Malt ) v&agrave; Tr&aacute;i c&acirc;y ch&iacute;n . Dư vị d&agrave;i l&acirc;u với vị ngọt nhẹ tự nhi&ecirc;n của Tr&aacute;i c&acirc;y họ Chanh Quy c&aacute;ch : 12 Chai/ Th&ugrave;ng Nguồn gốc xuất xứ : H&agrave;ng được ph&acirc;n phối tại k&ecirc;nh b&aacute;n lẻ du lịch ( Exclusive To Travellers )</p>', 'Glenfiddich Reserve Cask91.jpg', 100, 1, 'wk_002', 'th_001', 'NCC_01'),
('sp_007', 'Chivas Regal 18 years old Blue Signature Gift 2022', 'chivas-regal-18-years-old-blue-signature-gift-2022', 1700000, '<p>&quot;Chivas Regal 18 years old Blue Signature xứng đ&aacute;ng l&agrave; tuyệt t&aacute;c Whisky d&agrave;nh tặng đối t&aacute;c đ&atilde; mở ra cho bạn những cơ hội mớimới, nhờ sự hậu thuẫn của họ, th&agrave;nh c&ocirc;ng đến với bạn th&ecirc;m phần su&ocirc;n sẻ&quot; Rượu Chivas 18 Blue Signature thuộc danh mục sản phẩm mới nổi bật của Chivas Regal d&agrave;nh cho giới y&ecirc;u rượu whisky tr&ecirc;n to&agrave;n thế giới n&oacute;i chung v&agrave; Việt Nam n&oacute;i ri&ecirc;ng c&oacute; niềm đam m&ecirc; m&atilde;nh liệt với rượu mạnh cao cấp v&agrave; đang kiếm t&igrave;m kh&ocirc;ng chỉ sự đổi mới, s&aacute;ng tạo của thương hiệu m&agrave; c&ograve;n để trải nghiệm. Rượu Chivas 18 Xanh l&agrave; d&ograve;ng Chivas đỉnh cao xứng đ&aacute;ng để chia sẻ. Tuyệt phẩm mới n&agrave;y sử dụng những loại mạch nha được lựa chọn tỉ mỉ với tỷ lệ cao mạch nha Strathisla v&agrave; Longmorn để t&aacute;i tạo hương vị mềm mượt.</p>', '<p>Chivas Regal 18 Blue Signature sở hữu m&agrave;u xanh dương quyến rũ với hương thơm ngọt, mượt của tr&aacute;i c&acirc;y tươi ch&iacute;n mềm như: đ&agrave;o, l&ecirc; v&agrave; thoang thoảng hương mật ong rừng, mứt v&agrave; kẹo mềm.</p>', 'Chivas Regal 18 years old Blue Signature Gift 202234.jpg', 99, 1, 'wk_005', 'th_002', 'NCC_01'),
('sp_008', 'Rượu Chivas Regal XV Gift box 2022', 'ruou-chivas-regal-xv-gift-box-2022', 1200000, '<p>Rượu whisky c&oacute; sẵn trong hai thiết kế bao b&igrave; kh&aacute;c nhau - một chai v&agrave;ng, được thiết kế để l&agrave;m cho chai nổi bật trong &quot;khoảnh khắc của lễ kỷ niệm&quot;, v&agrave; một chai thủy tinh trong suốt chứa trong hộp m&agrave;u v&agrave;ng cho c&aacute;c dịp tặng qu&agrave;. Chivas đang l&ecirc;n hạng mục whisky Scotch với sự ra mắt của Chivas XV - một sự pha trộn whisky 15 tuổi th&aacute;ch thức c&aacute;c quy ước xung quanh c&aacute;ch thức v&agrave; thời điểm thưởng thức rượu Scotch whiskey. Được tạo ra để được thưởng thức như một phần của một khoảnh khắc năng lượng cao, Chivas XV chứng minh rằng một loại whiskey đặc biệt d&agrave;nh cho những t&iacute;n đồ của Chivas.</p>', '<p>Chivas Regal XV mang đến hương vị đậm đ&agrave; v&agrave; ngọt ng&agrave;o của mứt cam, quế v&agrave; nho kh&ocirc;, sau đ&oacute; chậm r&atilde;i biến chuyển th&agrave;nh nhiều tầng lớp hương vị kh&aacute;c nhau, nổi bật l&agrave; vị tr&aacute;i c&acirc;y dịu ngọt đi k&egrave;m với hỗn hợp kẹo bơ đường caramel. Kết th&uacute;c với điểm nhấn hương Vanila tạo n&ecirc;n sự &ecirc;m mượt đ&aacute;ng nhớ</p>', 'Rượu Chivas Regal XV Gift box 20221.jpg', 100, 1, 'wk_005', 'th_002', 'NCC_02'),
('sp_009', 'Royal Salute 21 years old World Polo Edition', 'royal-salute-21-years-old-world-polo-edition', 4200000, '<p>Rượu Royal Salute 21 Polo Edition l&agrave; phi&ecirc;n bản giới hạn t&ocirc;n vinh sự gắn kết của Chivas Royal Salute POLO Edition 21YO v&agrave; m&ocirc;n thể thao Polo (m&atilde; ngựa m&ocirc;n thể thao của ho&agrave;ng gia) , đ&acirc;y l&agrave; phi&ecirc;n bản giới hạn của rượuChivas Royal Salute POLO Edition được ra mắt với số lượng hạn chế. Được ra đời v&agrave;o năm 1953 để đ&aacute;nh dấu lễ đăng quang của Nữ Ho&agrave;ng Elizabeth II, kể từ đ&oacute; Royal Salute đ&atilde; được l&ecirc;n ng&ocirc;i như một loại Scotch Whisky thượng hạng duy nhất tr&ecirc;n thế giới, được pha trộn v&agrave; ủ trong th&ugrave;ng gỗ sồi tối thiểu 21 năm. Những người nghệ nh&acirc;n gốm sứ đ&atilde; d&ugrave;ng ch&iacute;nh đ&ocirc;i tay của họ để gia c&ocirc;ng trong s&aacute;u ng&agrave;y.</p>', '<p>ĐẶC TRƯNG CỦA SẢN PHẨM M&agrave;u sắc: hổ ph&aacute;ch v&agrave;ng s&aacute;ng. M&ugrave;i hương: tr&aacute;i c&acirc;y, hoa v&agrave; kh&oacute;i. Hương vị: một sự kết hợp th&uacute; vị trầm, ngọt, hạnh nh&acirc;n, &ecirc;m dịu v&agrave; c&oacute; nhiều chất cốt. Hậu vị: l&acirc;u d&agrave;i, ấm &aacute;p.</p>', 'Royal Salute 21 years old World Polo Edition6.webp', 99, 1, 'wk_001', 'th_002', 'NCC_01'),
('sp_010', 'Chabot Armagnac Napoleon', 'chabot-armagnac-napoleon', 1170000, '<p>Rượu Chabot Armagnac Napoleon phải trải qua qu&aacute; tr&igrave;nh sản xuất chặt chẽ, từng giai đoạn đều được kiểm tra kỹ lưỡng, v&agrave; trước ti&ecirc;n, sẽ thu hoạch tuyển chọn những ch&ugrave;m nho tươi ngon &eacute;p lấy nước v&agrave; để l&ecirc;n men tự nhi&ecirc;n. Sau đ&oacute;, rượu được chiết xuất từ những nồi chưng cất trung b&igrave;nh của người armagnac rồi được chưng cất lần nữa trước khi được ủ tiếp đến được ủ trong c&aacute;c th&ugrave;ng gỗ sồi trắng v&ugrave;ng Armagnac. Đ&acirc;y l&agrave; d&ograve;ng rượu c&oacute; thiết kế sang trọng, l&ocirc;i cuốn những người s&agrave;nh rượu, đ&acirc;y cũng c&oacute; thể l&agrave;m qu&agrave; cho những buổi gặp mặt đồng nghiệp, bạn b&egrave;, hoặc đối t&aacute;c&hellip; Qu&aacute; tr&igrave;nh sản xuất rượu cũng tu&acirc;n theo 4 c&ocirc;ng đoạn giống như Cognac Qu&aacute; tr&igrave;nh l&agrave;m rượu vang : c&aacute;c loại nho trắng được &eacute;p lấy nước &amp; để l&ecirc;n men tự nhi&ecirc;n Qu&aacute; tr&igrave;nh chưng cất : rượu được chiết xuất từ những nồi chưng cất trung b&igrave;nh của người armagnac rồi được chưng cất lần nữa trước khi được ủ Qu&aacute; tr&igrave;nh ủ : được ủ trong c&aacute;c th&ugrave;ng gỗ sồi trắng v&ugrave;ng Armagnac Qu&aacute; tr&igrave;nh tổng hợp : trộn lẫn giữa loại nước chưng cất với c&aacute;c loại armagnac kh&aacute;c</p>', '<p>Rượu Chabot Armagnac Napoleon phải trải qua qu&aacute; tr&igrave;nh sản xuất chặt chẽ, từng giai đoạn đều được kiểm tra kỹ lưỡng, v&agrave; trước ti&ecirc;n, sẽ thu hoạch tuyển chọn những ch&ugrave;m nho tươi ngon &eacute;p lấy nước v&agrave; để l&ecirc;n men tự nhi&ecirc;n. Sau đ&oacute;, rượu được chiết xuất từ những nồi chưng cất trung b&igrave;nh của người armagnac rồi được chưng cất lần nữa trước khi được ủ tiếp đến được ủ trong c&aacute;c th&ugrave;ng gỗ sồi trắng v&ugrave;ng Armagnac.</p>', 'Chabot Armagnac Napoleon98.jpg', 100, 1, 'wk_003', 'th_003', 'NCC_01'),
('sp_011', 'Bisquit XO 1 Liter', 'bisquit-xo-1-liter', 4700000, '<p>Rượu Bisquit XO c&oacute; vị đậm đ&agrave;, lan tỏa to&agrave;n th&acirc;n v&agrave; tuyệt mịn, Rượu Bisquit XO mời bạn kh&aacute;m ph&aacute; một cốt l&otilde;i của gỗ khi d&ugrave;ng k&egrave;m kh&oacute;i thuốc l&aacute; - ca cao &ndash;kẹo hương tr&aacute;i c&acirc;y v&agrave; mận. L&agrave;m miệng thơm m&ugrave;i của mận, mocha, gỗ tuyết t&ugrave;ng v&agrave; cam thảo. Kinh nghiệm mượt, Bisquit XO xa hoa n&agrave;y với một kết th&uacute;c k&eacute;o d&agrave;i tuyệt vời. - Xuất xứ: Ph&aacute;p - Dung t&iacute;ch: 1 l&iacute;t - Nồng độ: 40%</p>', '<p>Rượu Bisquit XO c&oacute; vị đậm đ&agrave;, lan tỏa to&agrave;n th&acirc;n v&agrave; tuyệt mịn, Rượu Bisquit XO mời bạn kh&aacute;m ph&aacute; một cốt l&otilde;i của gỗ khi d&ugrave;ng k&egrave;m kh&oacute;i thuốc l&aacute; - ca cao &ndash;kẹo hương tr&aacute;i c&acirc;y v&agrave; mận. L&agrave;m miệng thơm m&ugrave;i của mận, mocha, gỗ tuyết t&ugrave;ng v&agrave; cam thảo. Kinh nghiệm mượt, Bisquit XO xa hoa n&agrave;y với một kết th&uacute;c k&eacute;o d&agrave;i tuyệt vời.</p>', 'Bisquit XO 1 Liter37.jpg', 20, 1, 'wk_003', 'th_002', 'NCC_01'),
('sp_012', 'Hennessy VSOP Privilège Limited Edition UVA Pack 2', 'hennessy-vsop-privilege-limited-edition-uva-pack-2020', 1900000, '<p>Hennessy V.S.O.P Privil&egrave;ge Limited Edition UVA Pack 2020 V&agrave;o th&aacute;ng 3 năm 2020, Maison Hennessy vừa ra mắt phi&ecirc;n bản giới hạn Hennessy V.S.O.P Privil&egrave;ge Limited Edition UVA Pack 2020 cho thị trường Việt Nam, tiết lộ sự hợp t&aacute;c nghệ thuật nhập vai nhất của m&igrave;nh cho đến nay, một bản c&agrave;i đặt &aacute;nh s&aacute;ng động do United Visual Artists (UVA) tạo ra. Hennessy V.S.O.P Privil&egrave;ge v&agrave; tập thể United Visual Artists c&oacute; trụ sở tại London đ&atilde; hợp t&aacute;c trong một chương tr&igrave;nh phi&ecirc;n bản giới hạn. Lấy cảm hứng từ qu&aacute; tr&igrave;nh pha trộn của Hennessy V.S.O.P Privil&egrave;ge, sự hợp t&aacute;c n&agrave;y phản &aacute;nh sự năng động của sự phi vật chất, &aacute;nh s&aacute;ng v&agrave; thời gian. Giống như &aacute;nh sao chiếu đến ch&uacute;ng ta từ những điểm kh&aacute;c nhau trong kh&ocirc;ng gian v&agrave; thời gian, mỗi chai Hennessy V.S.O.P Privil&egrave;ge l&agrave; một biểu hiện l&yacute; tưởng của sự h&agrave;i h&ograve;a, &ldquo;Sự h&ograve;a quyện của thời gian&rdquo;. Một sự hợp t&aacute;c của nhiều lần đầu ti&ecirc;n, dự &aacute;n n&agrave;y cũng đ&aacute;nh dấu lần đầu ti&ecirc;n ra mắt UVA trong thế giới Cognac. Nh&acirc;n dịp n&agrave;y, tập thể nghệ thuật c&oacute; trụ sở tại London đ&atilde; s&aacute;ng t&aacute;c một trải nghiệm lấy cảm hứng từ qu&aacute; tr&igrave;nh s&aacute;ng tạo của Hennessy V.S.O.P Privil&egrave;ge. Rượu Cognac Hennessy VSOP l&agrave; biểu tượng cho sự trọn vẹn v&agrave; tinh tế. Sự h&agrave;i h&ograve;a v&agrave; tinh tế ấy được thể hiện nhẹ nh&agrave;ng bởi hương vị của cam thảo v&agrave; vị ngọt của mật ong - thật dịu ngọt, s&acirc;u sắc v&agrave; trọn vẹn. Th&agrave;nh phần để tạo n&ecirc;n loại rượu nổi tiếng n&agrave;y cũng rất độc đ&aacute;o. Hennessy V.S.O.P l&agrave; sự pha trộn ho&agrave;n hảo của hơn 60 loại rượu t&acirc;m (eau-de-vie) kh&aacute;c nhau được chọn lọc từ 4 khu vực trồng nho tốt nhất của Cognac. Bởi vậy, kh&ocirc;ng c&ograve;n nghi ngờ g&igrave; nữa, Hennessy VSOP nằm trong bộ sưu tập Cognac Hennessy của nh&agrave; Hennessy xứng đ&aacute;ng để biết bao t&iacute;n đồ của rượu Cognac cũng như những người am hiểu về rượu Cognac muốn sở hữu chai rượu cao cấp.</p>', '<p>Rượu Cognac Hennessy VSOP l&agrave; biểu tượng cho sự trọn vẹn v&agrave; tinh tế. Sự h&agrave;i h&ograve;a v&agrave; tinh tế ấy được thể hiện nhẹ nh&agrave;ng bởi hương vị của cam thảo v&agrave; vị ngọt của mật ong - thật dịu ngọt, s&acirc;u sắc v&agrave; trọn vẹn.</p>', 'Hennessy VSOP Privilège Limited Edition UVA Pack 215.jpg', 51, 1, 'wk_003', 'th_003', 'NCC_01'),
('sp_013', 'Hennessy XO 3000ml', 'hennessy-xo-3000ml', 20000000, '<p>Hennessy XO l&agrave; rượu Cognac XO đầu ti&ecirc;n ra đời v&agrave;o năm 1870, mạnh mẽ v&agrave; gi&agrave;u hương vị Hennessy X.O l&agrave; nguồn cảm hứng v&ocirc; tận th&ocirc;ng qua sự trải nghiệm đầy gợi cảm Hennessy XO thường được thưởng thức ở dạng nguy&ecirc;n chất để c&oacute; thể đạt tới hương vị chuẩn mực . Cho đến tận ng&agrave;y nay , d&ograve;ng rượu n&agrave;y lu&ocirc;n được coi l&agrave; biểu tượng của sự xa hoa , qu&yacute; ph&aacute;i . Sự gi&agrave;u c&aacute; t&iacute;nh được n&acirc;ng cao bởi chiếc b&igrave;nh thon cổ đặc biệt được thiết kế năm 1947 . Hennessy XO Được pha chế từ hơn 100 loại rượu cốt kh&aacute;c nhau , l&agrave; d&ograve;ng rượu Cognac &rdquo; cực kỳ l&acirc;u đời &rdquo; đầu ti&ecirc;n , với hương vị mạnh mẽ , nam t&iacute;nh , v&agrave; h&agrave;o hiệp &ndash; một hương vị thực sự tuyệt vời . C&oacute; thể n&oacute;i Hennessy XO l&agrave; nguồn cảm hứng v&ocirc; tận th&ocirc;ng qua sự trải nghiệm đầy gợi cảm.</p>', '<p>Một c&aacute;ch truyền thống, X.O được thưởng thức trong những bữa năn nhẹ. Tuy nhi&ecirc;n, ng&agrave;y c&agrave;ng c&oacute; nhiều người kh&aacute;m ph&aacute; ra những n&eacute;t độc đ&aacute;o v&agrave; th&iacute;ch thu kh&aacute;c của X.O khi thưởng thức với đ&aacute;. Đơn giản l&agrave; bỏ th&ecirc;m 1 hoặc 2 vi&ecirc;n đ&aacute;, lắc nhẹ v&agrave; c&agrave;m nhận những hương thơm tuyệt vời.</p>', 'Hennessy XO 3000ml47.jpg', 20, 1, 'wk_003', 'th_003', 'NCC_01'),
('sp_014', 'Ballantines Finest Gift Box 2022', 'ballantines-finest-gift-box-2022', 460000, '<p>Balantine&#39;s Finest Gift Box - CHẤT KH&Ocirc;NG LẪN, VỊ KH&Ocirc;NG TAN Ballantine&#39;s Finest c&oacute; một hương vị nguy&ecirc;n chất, thanh lịch. N&oacute; được xem l&agrave; loại whisky mang hương vị hiện đại, sẽ l&agrave;m h&agrave;i l&ograve;ng cho những ai thưởng thức. Ballantine&#39;s Finest l&agrave; kết quả của một qu&aacute; tr&igrave;nh pha trộn phức tạp gồm mạch nha v&agrave; ngũ cốc được lựa chọn k&yacute; lưỡng v&agrave; được ủ trong th&ugrave;ng gỗ rồi &iacute;t nhất l&agrave; 3 năm. n&ecirc;n Ballantine&#39;s Finest c&oacute; m&ugrave;i hương đặc trưng của mạch nha, hương Chocolates, T&aacute;o đỏ v&agrave; Vani.Với m&agrave;u sắc v&agrave;ng nhạt đặc trưng, hương vị huyền ảo, tạo cho người thưởng thức một cảm gi&aacute;c ng&acirc;y ngất kh&oacute; qu&ecirc;n.</p>', '<p>Đặc điểm * M&agrave;u: v&agrave;ng nhẹ. * M&ugrave;i: nhẹ nh&agrave;ng, thanh lịch với hương hoa, c&acirc;y thạch nam, mật ong, thoảng hương gia vị. * Vị: c&acirc;n bằng, phảng phất vị s&ocirc;c&ocirc;la sữa, t&aacute;o đỏ v&agrave; vani, dư vị s&acirc;u lắng phức cảm mang đến cảm gi&aacute;c tươi m&aacute;t. C&aacute;ch thưởng thức D&ugrave;ng nguy&ecirc;n chất hoặc th&ecirc;m &iacute;t đ&aacute;. Ballantine&#39;s Finest c&oacute; một hương vị nguy&ecirc;n chất, thanh lịch. N&oacute; được xem l&agrave; loại whisky mang hương vị hiện đại, sẽ l&agrave;m h&agrave;i l&ograve;ng cho những ai thưởng thức. Ballantine&#39;s Finest l&agrave; kết quả của một qu&aacute; tr&igrave;nh pha trộn phức tạp gồm mạch nha v&agrave; ngũ cốc được lựa chọn k&yacute; lưỡng v&agrave; được ủ trong th&ugrave;ng gỗ rồi &iacute;t nhất l&agrave; 3 năm. n&ecirc;n Ballantine&#39;s Finest c&oacute; m&ugrave;i hương đặc trưng của mạch nha, hương Chocolates, T&aacute;o đỏ v&agrave; Vani. Với m&agrave;u sắc v&agrave;ng nhạt đặc trưng, hương vị huyền ảo, tạo cho người thưởng thức một cảm gi&aacute;c ng&acirc;y ngất kh&oacute; qu&ecirc;n.</p>', 'Ballantines Finest Gift Box 202293.jpg', 481, 1, 'wk_004', 'th_002', 'NCC_01'),
('sp_015', 'Ballantines Finest Gift Box New', 'ballantines-finest-gift-box-new', 490000, '<p>Balantine&#39;s Finest Gift Box Ballantine&#39;s Finest c&oacute; một hương vị nguy&ecirc;n chất, thanh lịch. N&oacute; được xem l&agrave; loại whisky mang hương vị hiện đại, sẽ l&agrave;m h&agrave;i l&ograve;ng cho những ai thưởng thức. Ballantine&#39;s Finest l&agrave; kết quả của một qu&aacute; tr&igrave;nh pha trộn phức tạp gồm mạch nha v&agrave; ngũ cốc được lựa chọn k&yacute; lưỡng v&agrave; được ủ trong th&ugrave;ng gỗ rồi &iacute;t nhất l&agrave; 3 năm. n&ecirc;n Ballantine&#39;s Finest c&oacute; m&ugrave;i hương đặc trưng của mạch nha, hương Chocolates, T&aacute;o đỏ v&agrave; Vani. Với m&agrave;u sắc v&agrave;ng nhạt đặc trưng, hương vị huyền ảo, tạo cho người thưởng thức một cảm gi&aacute;c ng&acirc;y ngất kh&oacute; qu&ecirc;n. Đặc điểm * M&agrave;u: v&agrave;ng nhẹ. * M&ugrave;i: nhẹ nh&agrave;ng, thanh lịch với hương hoa, c&acirc;y thạch nam, mật ong, thoảng hương gia vị. * Vị: c&acirc;n bằng, phảng phất vị s&ocirc;c&ocirc;la sữa, t&aacute;o đỏ v&agrave; vani, dư vị s&acirc;u lắng phức cảm mang đến cảm gi&aacute;c tươi m&aacute;t. C&aacute;ch thưởng thức D&ugrave;ng nguy&ecirc;n chất hoặc th&ecirc;m &iacute;t đ&aacute;.</p>', '<p>Ballantine&#39;s Finest c&oacute; một hương vị nguy&ecirc;n chất, thanh lịch. N&oacute; được xem l&agrave; loại whisky mang hương vị hiện đại, sẽ l&agrave;m h&agrave;i l&ograve;ng cho những ai thưởng thức.</p>', 'Ballantines Finest Gift Box New14.jpg', 200, 1, 'wk_004', 'th_002', 'NCC_01'),
('sp_016', 'Glen Grant the major\'s Reserve', 'glen-grant-the-major\'s-reserve', 1050000, '<p>Glen Grant the major&#39;s Reserve ID Whiskybase: WB85258 Loại: Mạch nha đơn Nh&agrave; m&aacute;y chưng cất: Glen Grant Đ&oacute;ng chai: 2016 Nồng Độ: 40,0% khối lượng: 700 ml M&atilde; vạch: 080432402993 Tuổi của rượu phải rất trẻ. M&ugrave;i thơm hơn cả mong đợi. Vị ngọt dịu đến nao l&ograve;ng. Trong th&ugrave;ng Bourbon trẻ trung, &acirc;m sắc của hạt kem đ&atilde; xuất hiện, nhưng n&oacute; hơi cố t&igrave;nh trở n&ecirc;n gần gũi một ch&uacute;t với hương tr&aacute;i c&acirc;y. Rất nhiều tr&aacute;i c&acirc;y trắng với hương hoa dịu nhẹ, kết th&uacute;c bằng một ch&uacute;t mạch nha. Kh&ocirc;ng đơn giản nhưng dễ chịu. Được ph&aacute;t triển bởi &ocirc;ng James &ldquo;The Major&rdquo; Grant nổi tiếng của nh&agrave; l&agrave;m rượu Glen Grant, đ&acirc;y l&agrave; d&ograve;ng whisky đơn mạch dễ uống với vị h&agrave;i h&ograve;a v&agrave; nhẹ nh&agrave;ng. Vị mượt m&agrave; xen lẫn hương tr&aacute;i c&acirc;y lan tỏa khi thưởng thức với hậu vị vừa phải thoảng hương c&aacute;c loại hạt. ĐẶC TRƯNG CỦA SẢN PHẨM: M&agrave;u sắc: Sắc v&agrave;ng của &aacute;nh ban mai. M&ugrave;i hương: Nhẹ nh&agrave;ng, thoảng hương tr&aacute;i c&acirc;y với điểm nhấn của t&aacute;o xanh. Vị: Vị vượt m&agrave; xen lẫn hoa quả. Vị sau khi ho&agrave;n tất: Thoảng vị hạt. M&ugrave;i vị: Quả m&agrave;u trắng vẫn chiếm ưu thế, b&acirc;y giờ được nối với một số gỗ, kh&aacute; kh&ocirc; v&agrave; k&eacute;m th&uacute; vị. R&otilde; r&agrave;ng l&agrave; được tưới xuống. Kết th&uacute;c: Rất ngắn v&agrave; kh&ocirc;, hầu hết l&agrave; hạt.</p>', '<p>Tuổi của rượu phải rất trẻ. M&ugrave;i thơm hơn cả mong đợi. Vị ngọt dịu đến nao l&ograve;ng. Trong th&ugrave;ng Bourbon trẻ trung, &acirc;m sắc của hạt kem đ&atilde; xuất hiện, nhưng n&oacute; hơi cố t&igrave;nh trở n&ecirc;n gần gũi một ch&uacute;t với hương tr&aacute;i c&acirc;y. Rất nhiều tr&aacute;i c&acirc;y trắng với hương hoa dịu nhẹ, kết th&uacute;c bằng một ch&uacute;t mạch nha. Kh&ocirc;ng đơn giản nhưng dễ chịu.</p>', 'Glen Grant the major\'s Reserve59.webp', 99, 1, 'wk_004', 'th_001', 'NCC_01'),
('sp_017', 'Cortel XO Gift box', 'cortel-xo-gift-box', 600000, '<p>Cortel XO l&agrave; sản phẩm rượu brandy của Ph&aacute;p. D&aacute;ng chai bầu cổ cao. Ngo&agrave;i sản phẩm hộp đơn, Cortel XO c&ograve;n c&oacute; dạng hộp qu&agrave;. Hộp được thiết kế sang trọng với chữ nhũ v&agrave;ng. Nền hộp c&oacute; t&ocirc;ng m&agrave;u đỏ tươi l&agrave; m&agrave;u biểu tượng cho những lời ch&uacute;c ph&uacute;c v&agrave; vận may, l&agrave; lựa chọn th&iacute;ch hợp để l&agrave;m qu&agrave; biếu tặng trong c&aacute;c dịp lễ tết.</p>', '<p>Cortel XO l&agrave; sản phẩm rượu brandy của Ph&aacute;p. D&aacute;ng chai bầu cổ cao. Ngo&agrave;i sản phẩm hộp đơn, Cortel XO c&ograve;n c&oacute; dạng hộp qu&agrave;. Hộp được thiết kế sang trọng với chữ nhũ v&agrave;ng. Nền hộp c&oacute; t&ocirc;ng m&agrave;u đỏ tươi l&agrave; m&agrave;u biểu tượng cho những lời ch&uacute;c ph&uacute;c v&agrave; vận may, l&agrave; lựa chọn th&iacute;ch hợp để l&agrave;m qu&agrave; biếu tặng trong c&aacute;c dịp lễ tết.</p>', 'Cortel XO Gift box9.jpg', 100, 1, 'wk_004', 'th_003', 'NCC_01'),
('sp_018', 'Chivas Regal 12 years old Gift box 2022', 'chivas-regal-12-years-old-gift-box-2022', 750000, '<p>Chivas Regal l&agrave; một Scotch pha trộn nổi tiếng thế giới lần đầu ti&ecirc;n được thực hiện trong những năm đầu thế kỷ 20 bởi Anh em nh&agrave; Chivas . C&ocirc;ng ty c&oacute; thể nguồn gốc của n&oacute; lại đến 1801, với việc khai trương một cửa h&agrave;ng thực phẩm tại Số 13 King Street, Aberdeen. B&aacute;n thực phẩm sang trọng, c&agrave; ph&ecirc; v&agrave; c&aacute;c loại gia vị, n&oacute; đ&atilde; kh&ocirc;ng được biết đến cho đến nửa thế kỷ sau đ&oacute; c&ocirc;ng ty bắt đầu để l&agrave;m cho rượu whisky, v&agrave; sau đ&oacute; kh&ocirc;ng cho đến khi hậu Mỹ cấm m&agrave; Chivas Regal 12 Year Old lần đầu ti&ecirc;n được ch&iacute;nh thức ph&aacute;t h&agrave;nh. F. Paul Pacult m&ocirc; tả Chivas Regal 12 l&agrave; &quot;sự pha trộn đ&atilde; trưởng th&agrave;nh&quot;, trao cho n&oacute; một ấn tượng 9 trong số 10 Đ&oacute; l&agrave; một tuy&ecirc;n bố rất apt - đ&acirc;y l&agrave; một loại whisky pha trộn rất tinh tế, với c&aacute;c loại thảo mộc, mật ong v&agrave; tr&aacute;i c&acirc;y. Thường xuy&ecirc;n khen ngợi bởi c&aacute;c nh&agrave; ph&ecirc; b&igrave;nh, đ&acirc;y l&agrave; một sự pha trộn tuyệt vời trong thể loại gi&aacute; của n&oacute;.</p>', '<p>Rượu Chivas 12 yo - Khởi nguồn của d&ograve;ng rượu Chivas Thương hiệu Quốc tế c&oacute; d&aacute;ng chai tr&ograve;n cổ điển thu&ocirc;n tr&ograve;n từ tr&ecirc;n xuống dưới ph&igrave;nh to ra . Chivas 12 yo c&oacute; mầu v&agrave;ng rực rỡ v&agrave; l&agrave; một hỗn hợp của nhiều loại rượu Whisky c&oacute; tuổi trưởng th&agrave;nh ở trong những th&ugrave;ng gỗ Sồi kh&ocirc;ng dưới 12 năm . Rượu Chivas 12 năm c&oacute; m&ugrave;i hương thơm quyến rũ lan tỏa của Thảo mộc hoang d&atilde; , C&acirc;y thạch nam , Mật ong v&agrave; Tr&aacute;i c&acirc;y vườn thơm m&aacute;t.</p>', 'Chivas Regal 12 years old Gift box 202237.jpg', 95, 1, 'wk_005', 'th_002', 'NCC_01'),
('sp_019', 'Bushmills Single Malt 10 years old', 'bushmills-single-malt-10-years-old', 1150000, '<p>Nổi tiếng về độ s&acirc;u hương vị, Bushmills 10 năm tuổi xứng đ&aacute;ng nhận được lời khen ngợi v&agrave; những giải thưởng danh tiếng tr&ecirc;n thế giới. Rượu Bushmills Single Malt 10 Year Old l&agrave; loại rượu Whisky được trưng cất 3 lần từ 100% mạch nha đơn (l&uacute;a mạch) v&agrave; được trưởng th&agrave;nh &iacute;t nhất 10 năm trong th&ugrave;ng rượu bourbon n&oacute; đưa ra m&ugrave;i hương mật ong, Vanilla v&agrave; hương thơm của Chocolate sữa. Bạn c&oacute; thể thưởng thức n&oacute; nguy&ecirc;n chất hoặc sử dụng n&oacute; bằng c&aacute;ch th&ecirc;m ch&uacute;t đ&aacute;. Rượu Bushmills Single Malt 10 Year Old l&agrave; loại rượu Single Malt Whisky (rượu whisky mạch nha đơn chất) c&oacute; c&aacute;i t&ecirc;n tại thị trường việt nam l&agrave; &ldquo;Rượu Bushmills 10 năm tuổi&rdquo; th&iacute;ch hợp cho biếu tặng v&agrave; thưởng thức c&ugrave;ng bạn b&egrave; v&agrave; người th&acirc;n trong c&aacute;c bữa tiệc sang trọng. Bushmills l&agrave; loại Single Malt thực sự độc đ&aacute;o từ nh&agrave; m&aacute;y chưng cất rượu whisky được cấp ph&eacute;p l&acirc;u đời nhất tr&ecirc;n thế giới, được cấp ph&eacute;p lần đầu ti&ecirc;n v&agrave;o năm 1608. Nước tinh khiết được sử dụng trong Old Bushmills chảy qua đ&aacute; bazan c&oacute; thể nh&igrave;n thấy trong c&aacute;c h&igrave;nh th&agrave;nh ngoạn mục của &ldquo;Giants Causeway&rdquo; nổi tiếng thế giới. Mạch nha ho&agrave;n to&agrave;n chưa ch&iacute;n v&agrave; do đ&oacute; m&ugrave;i kh&oacute;i li&ecirc;n quan đến mạch nha Scotch ho&agrave;n to&agrave;n kh&ocirc;ng c&oacute; ở Bushmills. Ngo&agrave;i ra, mỗi giọt đều được chưng cất cẩn thận ba lần để c&oacute; độ tinh khiết v&agrave; độ mịn (hầu hết mạch nha chỉ được chưng cất hai lần). Bushmills sau đ&oacute; được để trưởng th&agrave;nh tối thiểu mười năm trong c&aacute;c th&ugrave;ng gỗ sồi bourbon chọn lọc v&agrave; th&ugrave;ng sherry Oloroso. Kết quả l&agrave; một Single Malt mượt m&agrave;, phong ph&uacute; với &acirc;m bội của vani, mật ong v&agrave; rượu sherry. C&aacute;c đ&aacute;nh gi&aacute; kh&aacute;c ... &#39;M&agrave;u hổ ph&aacute;ch đậm. Th&acirc;n h&igrave;nh trung b&igrave;nh, c&oacute; cảm gi&aacute;c miệng mượt m&agrave;. Một số hương cam qu&yacute;t, mocha v&agrave; vani ngọt ng&agrave;o với hương hoa của c&acirc;y thạch nam v&agrave; tử đinh hương. Kết th&uacute;c mềm mại, thanh lịch với một sự ấm &aacute;p mở rộng. &#39; Huy chương v&agrave;ng, Giải v&ocirc; địch c&aacute;c Tinh linh Thế giới, 1995. Hương: thoảng hương tr&aacute;i c&acirc;y v&agrave; ch&uacute;t cay của hoa. Vị: vị socola sẽ đọng lại tr&ecirc;n lưỡi trước khi kết th&uacute;c bằng ch&uacute;t vị mật ong Hậu vị: nhanh ch&oacute;ng v&agrave; gọn g&agrave;ng, tho&aacute;t đi rất nhẹ nh&agrave;ng.</p>', '<p>Rượu Bushmills Single Malt 10 Year Old l&agrave; loại rượu Whisky được trưng cất 3 lần từ 100% mạch nha đơn (l&uacute;a mạch) v&agrave; được trưởng th&agrave;nh &iacute;t nhất 10 năm trong th&ugrave;ng rượu bourbon n&oacute; đưa ra m&ugrave;i hương mật ong, Vanilla v&agrave; hương thơm của Chocolate sữa. Bạn c&oacute; thể thưởng thức n&oacute; nguy&ecirc;n chất hoặc sử dụng n&oacute; bằng c&aacute;ch th&ecirc;m ch&uacute;t đ&aacute;</p>', 'Bushmills Single Malt 10 years old36.jpg', 98, 1, 'wk_001', 'th_003', 'NCC_01'),
('sp_020', 'Bushmills Blackbush 700ml', 'bushmills-blackbush-700ml', 980000, '<p>Bushmills Black Bush l&agrave; một loại rượu whisky pha trộn của một loại kh&aacute;c nhau. Khi nh&igrave;n v&agrave;o m&agrave;u sắc, ch&uacute;ng ta sẽ thấy r&otilde; rằng đ&acirc;y kh&ocirc;ng phải l&agrave; sự pha trộn th&ocirc;ng thường. N&oacute; c&oacute; một m&agrave;u sẫm đẹp, l&agrave; kết quả của h&agrave;m lượng cao của rượu whisky mạch nha trưởng th&agrave;nh đặc biệt. Mạch nha được sử dụng ủ trong th&ugrave;ng rượu sherry Oloroso. Do đ&oacute;, n&oacute; c&oacute; m&agrave;u đậm hơn v&agrave; mang lại hương vị thơm ngon cho sự pha trộn. Tr&ecirc;n mũi Bushmills Black Bush mang đến những nốt hương tuyệt vời của vani, l&uacute;a mạch mạch nha, nho v&agrave; một ch&uacute;t chanh. Tr&ecirc;n v&ograve;m miệng, bộ dram to&agrave;n th&acirc;n n&agrave;y được c&acirc;n bằng giữa hương vị rất tr&aacute;i c&acirc;y, ngọt ng&agrave;o của sherry v&agrave; hương thơm hơi đắng v&agrave; cay từ gỗ sồi. Kết th&uacute;c tr&ograve;n của n&oacute; c&oacute; chiều d&agrave;i trung b&igrave;nh v&agrave; bao gồm vị ngọt của l&uacute;a mạch v&agrave; b&aacute;nh quy.</p>', '<p>Sản xuất rượu whisky c&oacute; lịch sử l&acirc;u đời ở Ireland. Ng&agrave;y 1608, được in tr&ecirc;n mỗi chai, đ&aacute;nh dấu năm Vua James I cấp giấy ph&eacute;p sản xuất rượu cho Ng&agrave;i Thomas Phillipps. Nh&agrave; m&aacute;y chưng cất Bushmills được đăng k&yacute; ch&iacute;nh thức v&agrave;o năm 1784 nhưng trước đ&oacute; n&oacute; c&oacute; lẽ đ&atilde; hoạt động được v&agrave;i thập kỷ. Nh&agrave; m&aacute;y chưng cất c&oacute; nh&agrave; ở Bushmills, một ng&ocirc;i l&agrave;ng nhỏ ở Bắc Ireland.</p>', 'Bushmills Blackbush 700ml18.jpg', 95, 1, 'wk_001', 'th_003', 'NCC_01'),
('sp_021', 'Jack Daniel\'s No.27 Gold Whiskey Gift box', 'jack-daniel\'s-no.27-gold-whiskey-gift-box', 3950000, '<p>Jack Daniel&#39;s No. 27 Gold Tennessee Whiskey l&agrave; biểu tượng sang trọng điển h&igrave;nh của Jack Daniel&#39;s No. 27 Tennessee Whiskey. Jack Daniel&#39;s No. 27 Gold được tạo ra để đem đến cho những t&iacute;n đồ trung th&agrave;nh v&agrave; sang trọng của Jack Daniels những trải nghiệm rất &ecirc;m &aacute;i khi thưởng thức. Trả qua hai lần ủ, hai lần lọc than, nh&acirc;n đ&ocirc;i qu&aacute; tr&igrave;nh chế t&aacute;c của Old No. 7 Whiskey v&agrave; g&oacute;p phần tạo n&ecirc;n t&ecirc;n gọi của n&oacute;, &quot;27&quot;, 2 lần ủ v&agrave; lọc than gi&uacute;p Jack Daniel&#39;s No. 27 Gold thấm đậm hương gỗ th&iacute;ch, v&ocirc; c&ugrave;ng &ecirc;m dịu v&agrave; hứa hẹn đem đến cảm gi&aacute;c v&ocirc; c&ugrave;ng sang trọng cho người thưởng thức. Jack Daniel&#39;s No. 27 Gold l&agrave; phi&ecirc;n bản v&ocirc; c&ugrave;ng cao cấp được v&iacute; như một loại ng&ocirc;n ngữ phong ph&uacute; gi&agrave;u cảm x&uacute;c trong cuốn truyện của Jack Daniel&#39;s, bạn đ&atilde; trải nghiệm thứ ng&ocirc;n ngữ đặc biệt n&agrave;y chưa?</p>', '<p>Jack Daniel&#39;s No. 27 Gold Tennessee Whiskey Gift box - Hộp qu&agrave; sang trọng k&egrave;m 2 ly thủy tinh cao cấp Xuất xứ: Mỹ - Dung t&iacute;ch: 700ml - Nồng độ: 40% Jack Daniel&#39;s No. 27 Gold Tennessee Whiskey l&agrave; biểu tượng sang trọng điển h&igrave;nh của Jack Daniel&#39;s No. 27 Tennessee Whiskey.</p>', 'download44.jpg', 91, 1, 'wk_001', 'th_003', 'NCC_01'),
('sp_022', 'Jack Daniel\'s Honey', 'jack-daniel\'s-honey', 870000, '<p>Rượu Jack Daniel&#39;s Tennessee Honey l&agrave; sự pha trộn tinh tế giữa Jack Daniel&#39;s Tennessee whiskey v&agrave; rượu m&ugrave;i mật ong độc đ&aacute;o, Jack Honey mang đến hương vị đặc trưng của Jack v&agrave; kh&ocirc;ng thể nhầm lẫn được. Với sự ngọt ng&agrave;o của mật ong v&agrave; bạn sẽ cảm nhận sự &ecirc;m dịu đến tận c&ugrave;ng. Tennessee Honey l&agrave; thực đơn thuần khiết của Jack Daniel. N&oacute; pha trộn vị ngọt của mật ong tự nhi&ecirc;n v&agrave; hương vị whiskey đậm đ&agrave; của Jack Daniel. Jack Daniel&#39;s Tennessee Honey l&agrave; sản phẩm khơi gợi sự kh&aacute;m ph&aacute; mới về cảm gi&aacute;c, với hương vị mật ong ngọt ng&agrave;o, dư vị của quả hồ đ&agrave;o c&ugrave;ng hương gỗ th&iacute;ch, ch&uacute;ng k&iacute;ch th&iacute;ch đến khứu gi&aacute;c lẫn vị gi&aacute;c của người uống. Đem lại những trải nghiệm về sự th&acirc;n thuộc v&agrave; dễ chiụ.</p>', '<p>Rượu Jack Daniel&#39;s Tennessee Honey l&agrave; sự pha trộn tinh tế giữa Jack Daniel&#39;s Tennessee whiskey v&agrave; rượu m&ugrave;i mật ong độc đ&aacute;o, Jack Honey mang đến hương vị đặc trưng của Jack v&agrave; kh&ocirc;ng thể nhầm lẫn được. Với sự ngọt ng&agrave;o của mật ong v&agrave; bạn sẽ cảm nhận sự &ecirc;m dịu đến tận c&ugrave;ng.</p>', 'jack-daniels-honey-700ml-550x5505.jpg', 548, 1, 'wk_001', 'th_003', 'NCC_01');

-- --------------------------------------------------------

--
-- Table structure for table `don_dh`
--

CREATE TABLE `don_dh` (
  `ma_ddh` varchar(10) NOT NULL,
  `ngay_dat` timestamp NOT NULL DEFAULT current_timestamp(),
  `ma_ncc` varchar(10) NOT NULL,
  `ma_nv` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `don_dh`
--

INSERT INTO `don_dh` (`ma_ddh`, `ngay_dat`, `ma_ncc`, `ma_nv`) VALUES
('DDH_01', '2022-08-16 16:07:42', 'NCC_02', 'NV001'),
('DDH_02', '2022-08-17 15:19:06', 'NCC_01', 'NV001'),
('DDH_05', '2022-08-28 17:02:34', 'NCC_03', 'NV001');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `ma_hd` varchar(10) NOT NULL,
  `ngay` timestamp NOT NULL DEFAULT current_timestamp(),
  `tong_tien` double NOT NULL,
  `id_pd` int(11) NOT NULL,
  `ma_nv` varchar(10) DEFAULT NULL,
  `trang_thai_xoa` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0:chưa xóa|\r\n1:Đã xóa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hoa_don`
--

INSERT INTO `hoa_don` (`ma_hd`, `ngay`, `tong_tien`, `id_pd`, `ma_nv`, `trang_thai_xoa`) VALUES
('e54b6', '2022-08-28 10:01:08', 20185000, 55, 'NV002', 0);

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `ma_kh` varchar(10) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `phai` tinyint(1) NOT NULL,
  `ngay_sinh` datetime NOT NULL,
  `dia_chi` varchar(250) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `ma_q` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`ma_kh`, `ho_ten`, `phai`, `ngay_sinh`, `dia_chi`, `sdt`, `email`, `password`, `ma_q`) VALUES
('kh_632', 'Bùi Duy Khoa 123', 0, '1999-06-27 00:00:00', 'Bình Liêm', '0832763921', 'buiduykhoa8@gmail.com', '$2y$10$RU2t9DnmJOH.gV42EKrCVuu7tUM1GH5iIaan3OYMF1qMNp5DmhWHq', 'KH'),
('kh_67', 'Duy Khoa', 0, '1999-05-28 00:00:00', 'Bắc Bình', '0832763921', 'duykhoaptit1@gmail.com', '$2y$10$QFaQOCdv6yI4bbNJfvYslOQsD.3PzlACPw/ril4zxW/ehDUClS/kS', 'KH');

-- --------------------------------------------------------

--
-- Table structure for table `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `ma_km` varchar(10) NOT NULL,
  `ten_km` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `ngay_bd` datetime NOT NULL,
  `ngay_kt` datetime NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `ma_nv` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`ma_km`, `ten_km`, `ngay_bd`, `ngay_kt`, `mo_ta`, `ma_nv`) VALUES
('KM_001', 'Khuyến mãi tri ân khách hàng mùa hè', '2022-08-21 23:23:17', '2022-10-31 15:47:28', 'Khuyến mãi tri ân khách hàng mùa hè', 'NV001');

-- --------------------------------------------------------

--
-- Table structure for table `loai_ruou`
--

CREATE TABLE `loai_ruou` (
  `ma_lr` varchar(10) NOT NULL,
  `ten_lr` varchar(50) NOT NULL,
  `slug` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loai_ruou`
--

INSERT INTO `loai_ruou` (`ma_lr`, `ten_lr`, `slug`) VALUES
('wk_001', 'Blended Scotch Whisky ', 'blended-scotch-whisk'),
('wk_002', 'Rượu Single Malt ', 'ruou-single-malt '),
('wk_003', 'Rượu Cognac ', 'ruou-cognac '),
('wk_004', 'Rượu Brandy ', 'ruou-brandy '),
('wk_005', 'Rượu Chivas 4', 'ruou-chivas-4');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `ma_nv` varchar(10) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `phai` tinyint(1) NOT NULL COMMENT '0:nam | 1: nữ',
  `ngay_sinh` datetime NOT NULL,
  `dia_chi` varchar(250) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `ma_q` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhan_vien`
--

INSERT INTO `nhan_vien` (`ma_nv`, `ho_ten`, `phai`, `ngay_sinh`, `dia_chi`, `sdt`, `email`, `password`, `ma_q`) VALUES
('NV001', 'admin', 0, '1999-02-19 18:51:39', 'TPHCM', '0868645964', 'admin@gmail.com', '$2y$10$RU2t9DnmJOH.gV42EKrCVuu7tUM1GH5iIaan3OYMF1qMNp5DmhWHq', 'AD'),
('NV002', 'Duy Khoa Bùi', 0, '1999-02-19 00:00:00', 'TPHCM', '0903025263', 'duykhoaptit@gmail.com', '$2y$10$RU2t9DnmJOH.gV42EKrCVuu7tUM1GH5iIaan3OYMF1qMNp5DmhWHq', 'AD'),
('NV006', 'Duy Khoa 1', 0, '1999-05-28 00:00:00', 'Bắc Bình', '0868645964', 'buiduykhoa8@gmail.com', '$2y$10$y6R9ee1XcU6xkEkgTus..e5CsE/3AjEBT189XATP98jN6Jdt0aI.q', 'AD');

-- --------------------------------------------------------

--
-- Table structure for table `nha_cc`
--

CREATE TABLE `nha_cc` (
  `ma_ncc` varchar(10) NOT NULL,
  `ten_ncc` varchar(50) NOT NULL,
  `dia_chi` text NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nha_cc`
--

INSERT INTO `nha_cc` (`ma_ncc`, `ten_ncc`, `dia_chi`, `email`) VALUES
('NCC_01', 'Cong ty Rượu Vang', '288,Phạm Văn Đồng,TPHCM', 'ctyruouvang@gmail.com'),
('NCC_02', 'Cửa hàng rượu', '234,Man Thien,TPHCM', 'ruouvang@gmail.com'),
('NCC_03', 'công ty rượu vang HN', 'HN', 'ruouvanghn@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phieu_dat`
--

CREATE TABLE `phieu_dat` (
  `id_pd` int(11) NOT NULL,
  `ngay_dat` timestamp NOT NULL DEFAULT current_timestamp(),
  `ho_ten_nn` varchar(50) NOT NULL,
  `dia_chi_nn` varchar(250) NOT NULL,
  `sdt_nn` varchar(20) DEFAULT NULL,
  `ngay_giao` datetime DEFAULT NULL,
  `ghi_chu` text DEFAULT NULL,
  `trang_thai` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0: mới | 1: Đã xác nhận | 2:Đã giao | 3:Đã nhận | 4: Đã hủy ',
  `kich_hoat` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0: mới | 1: Đã xác nhận | 2:Đã giao |\\r\\n3:Đã nhận | 4: Đã hủy',
  `hinh_thuc_thanh_toan` int(2) DEFAULT NULL COMMENT '0:tiền mặt |\\r\\n1:payment',
  `ma_kh` varchar(10) NOT NULL,
  `ma_nv` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieu_dat`
--

INSERT INTO `phieu_dat` (`id_pd`, `ngay_dat`, `ho_ten_nn`, `dia_chi_nn`, `sdt_nn`, `ngay_giao`, `ghi_chu`, `trang_thai`, `kich_hoat`, `hinh_thuc_thanh_toan`, `ma_kh`, `ma_nv`) VALUES
(55, '2022-08-28 10:01:04', 'Hà Đức Hùng', 'Bình Thuận', '0832763921', NULL, 'test', 3, 1, 0, 'kh_632', 'NV002');

-- --------------------------------------------------------

--
-- Table structure for table `phieu_nhap`
--

CREATE TABLE `phieu_nhap` (
  `ma_pn` varchar(10) NOT NULL,
  `ngay_tao_pn` timestamp NOT NULL DEFAULT current_timestamp(),
  `ma_nv` varchar(10) NOT NULL,
  `ma_ddh` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieu_nhap`
--

INSERT INTO `phieu_nhap` (`ma_pn`, `ngay_tao_pn`, `ma_nv`, `ma_ddh`) VALUES
('PN_01', '2022-08-25 15:52:19', 'NV001', 'DDH_01'),
('PN_02', '2022-08-28 01:38:53', 'NV001', 'DDH_02'),
('PN_10', '2022-08-28 10:03:18', 'NV001', 'DDH_05');

-- --------------------------------------------------------

--
-- Table structure for table `quyen`
--

CREATE TABLE `quyen` (
  `ma_q` varchar(10) NOT NULL,
  `ten_q` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quyen`
--

INSERT INTO `quyen` (`ma_q`, `ten_q`) VALUES
('AD', 'Admin'),
('KH', 'Khach hang'),
('NV', 'Nhan vien');

-- --------------------------------------------------------

--
-- Table structure for table `thuong_hieu`
--

CREATE TABLE `thuong_hieu` (
  `ma_th` varchar(10) NOT NULL,
  `ten_th` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `hinh_anh` text DEFAULT NULL,
  `mo_ta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thuong_hieu`
--

INSERT INTO `thuong_hieu` (`ma_th`, `ten_th`, `slug`, `hinh_anh`, `mo_ta`) VALUES
('th_001', 'Rượu Glenfiddich', 'ruou-glenfiddich', 'glenfiddich-logo91.png', 'Đến từ đất nước Scotland như Macallan, rượu Glenfiddich là hãng rượu ngoại nổi tiếng không thua kém gì Macallan.'),
('th_002', 'Rượu Chivas Regal', 'ruou-chivas-regal', 'download20.jpg', 'Cũng đến từ đất nước Scotland, Chivas Regal là loại rượu Whisky phổ biến trên thế giới. Đây là loại đồ uống có cồn được lên men và chưng cất. Hầu hết các loại rượu Chivas đều được ủ trong thùng gỗ sồi ít nhất 12 năm trước khi bán ra thị trường.'),
('th_003', 'Johnnie Walker', 'johnnie-walker', 'ruou-Johnnie-Walker77.png', 'Là một trong những loại rượu whisky nổi tiếng với logo ông già chống gậy. Rượu Johnnie Walker chắc chắn là loại rượu mà mỗi người sành rượu đều phải uống qua.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_sp_noibat`
-- (See below for the actual view)
--
CREATE TABLE `v_sp_noibat` (
`ma_dr` varchar(10)
,`ten_dr` varchar(50)
,`slug` varchar(255)
,`gia` double
,`mo_ta` text
,`noi_dung_dr` text
,`hinh_anh` text
,`sl_ton` int(100)
,`check_sp_moi` tinyint(2)
,`ma_lr` varchar(10)
,`ma_th` varchar(10)
,`ma_ncc` varchar(10)
);

-- --------------------------------------------------------

--
-- Structure for view `v_sp_noibat`
--
DROP TABLE IF EXISTS `v_sp_noibat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sp_noibat`  AS SELECT `dong_ruou`.`ma_dr` AS `ma_dr`, `dong_ruou`.`ten_dr` AS `ten_dr`, `dong_ruou`.`slug` AS `slug`, `dong_ruou`.`gia` AS `gia`, `dong_ruou`.`mo_ta` AS `mo_ta`, `dong_ruou`.`noi_dung_dr` AS `noi_dung_dr`, `dong_ruou`.`hinh_anh` AS `hinh_anh`, `dong_ruou`.`sl_ton` AS `sl_ton`, `dong_ruou`.`check_sp_moi` AS `check_sp_moi`, `dong_ruou`.`ma_lr` AS `ma_lr`, `dong_ruou`.`ma_th` AS `ma_th`, `dong_ruou`.`ma_ncc` AS `ma_ncc` FROM `dong_ruou` WHERE `dong_ruou`.`ma_dr` in (select `t2`.`ma_dr` from (select `t1`.`ma_dr` AS `ma_dr` from (select count(0) AS `sl_sp`,`t`.`ma_dr` AS `ma_dr` from (select `chi_tiet_pd`.`ma_dr` AS `ma_dr` from (`phieu_dat` join `chi_tiet_pd`) where `phieu_dat`.`id_pd` = `chi_tiet_pd`.`id_pd` AND to_days(`phieu_dat`.`ngay_dat`) - to_days(curdate()) < 90) `t` group by `t`.`ma_dr` order by count(0) desc) `t1` limit 6) `t2`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chi_tiet_ddh`
--
ALTER TABLE `chi_tiet_ddh`
  ADD PRIMARY KEY (`ma_ddh`,`ma_dr`),
  ADD KEY `chi_tiet_ddh_ibfk_2` (`ma_dr`);

--
-- Indexes for table `chi_tiet_km`
--
ALTER TABLE `chi_tiet_km`
  ADD PRIMARY KEY (`ma_km`,`ma_dr`),
  ADD KEY `chi_tiet_km_ibfk_2` (`ma_dr`);

--
-- Indexes for table `chi_tiet_ncc`
--
ALTER TABLE `chi_tiet_ncc`
  ADD PRIMARY KEY (`ma_ncc`,`ma_dr`),
  ADD KEY `ma_dr` (`ma_dr`);

--
-- Indexes for table `chi_tiet_pd`
--
ALTER TABLE `chi_tiet_pd`
  ADD PRIMARY KEY (`id_pd`,`ma_dr`),
  ADD KEY `chi_tiet_pd_ibfk_2` (`ma_dr`);

--
-- Indexes for table `chi_tiet_pn`
--
ALTER TABLE `chi_tiet_pn`
  ADD PRIMARY KEY (`ma_pn`,`ma_dr`),
  ADD KEY `chi_tiet_pn_ibfk_2` (`ma_dr`);

--
-- Indexes for table `dong_ruou`
--
ALTER TABLE `dong_ruou`
  ADD PRIMARY KEY (`ma_dr`),
  ADD KEY `dong_ruou_ibfk_1` (`ma_lr`),
  ADD KEY `dong_ruou_ibfk_2` (`ma_th`),
  ADD KEY `dong_ruou_ibfk_3` (`ma_ncc`);

--
-- Indexes for table `don_dh`
--
ALTER TABLE `don_dh`
  ADD PRIMARY KEY (`ma_ddh`),
  ADD KEY `don_dh_ibfk_1` (`ma_ncc`),
  ADD KEY `don_dh_ibfk_2` (`ma_nv`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`ma_hd`),
  ADD UNIQUE KEY `ma_pd` (`id_pd`),
  ADD KEY `hoa_don_ibfk_2` (`ma_nv`);

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`ma_kh`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `khach_hang_ibfk_1` (`ma_q`);

--
-- Indexes for table `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`ma_km`),
  ADD KEY `khuyen_mai_ibfk_1` (`ma_nv`);

--
-- Indexes for table `loai_ruou`
--
ALTER TABLE `loai_ruou`
  ADD PRIMARY KEY (`ma_lr`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`ma_nv`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `nhan_vien_ibfk_1` (`ma_q`);

--
-- Indexes for table `nha_cc`
--
ALTER TABLE `nha_cc`
  ADD PRIMARY KEY (`ma_ncc`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `phieu_dat`
--
ALTER TABLE `phieu_dat`
  ADD PRIMARY KEY (`id_pd`),
  ADD KEY `phieu_dat_ibfk_1` (`ma_kh`),
  ADD KEY `phieu_dat_ibfk_2` (`ma_nv`);

--
-- Indexes for table `phieu_nhap`
--
ALTER TABLE `phieu_nhap`
  ADD PRIMARY KEY (`ma_pn`),
  ADD UNIQUE KEY `ma_ddh` (`ma_ddh`),
  ADD KEY `phieu_nhap_ibfk_1` (`ma_nv`);

--
-- Indexes for table `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`ma_q`);

--
-- Indexes for table `thuong_hieu`
--
ALTER TABLE `thuong_hieu`
  ADD PRIMARY KEY (`ma_th`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `phieu_dat`
--
ALTER TABLE `phieu_dat`
  MODIFY `id_pd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_ddh`
--
ALTER TABLE `chi_tiet_ddh`
  ADD CONSTRAINT `chi_tiet_ddh_ibfk_1` FOREIGN KEY (`ma_ddh`) REFERENCES `don_dh` (`ma_ddh`),
  ADD CONSTRAINT `chi_tiet_ddh_ibfk_2` FOREIGN KEY (`ma_dr`) REFERENCES `dong_ruou` (`ma_dr`);

--
-- Constraints for table `chi_tiet_km`
--
ALTER TABLE `chi_tiet_km`
  ADD CONSTRAINT `chi_tiet_km_ibfk_1` FOREIGN KEY (`ma_km`) REFERENCES `khuyen_mai` (`ma_km`),
  ADD CONSTRAINT `chi_tiet_km_ibfk_2` FOREIGN KEY (`ma_dr`) REFERENCES `dong_ruou` (`ma_dr`);

--
-- Constraints for table `chi_tiet_ncc`
--
ALTER TABLE `chi_tiet_ncc`
  ADD CONSTRAINT `chi_tiet_ncc_ibfk_1` FOREIGN KEY (`ma_ncc`) REFERENCES `nha_cc` (`ma_ncc`),
  ADD CONSTRAINT `chi_tiet_ncc_ibfk_2` FOREIGN KEY (`ma_dr`) REFERENCES `dong_ruou` (`ma_dr`);

--
-- Constraints for table `chi_tiet_pd`
--
ALTER TABLE `chi_tiet_pd`
  ADD CONSTRAINT `chi_tiet_pd_ibfk_1` FOREIGN KEY (`id_pd`) REFERENCES `phieu_dat` (`id_pd`),
  ADD CONSTRAINT `chi_tiet_pd_ibfk_2` FOREIGN KEY (`ma_dr`) REFERENCES `dong_ruou` (`ma_dr`);

--
-- Constraints for table `chi_tiet_pn`
--
ALTER TABLE `chi_tiet_pn`
  ADD CONSTRAINT `chi_tiet_pn_ibfk_1` FOREIGN KEY (`ma_pn`) REFERENCES `phieu_nhap` (`ma_pn`),
  ADD CONSTRAINT `chi_tiet_pn_ibfk_2` FOREIGN KEY (`ma_dr`) REFERENCES `dong_ruou` (`ma_dr`);

--
-- Constraints for table `dong_ruou`
--
ALTER TABLE `dong_ruou`
  ADD CONSTRAINT `dong_ruou_ibfk_1` FOREIGN KEY (`ma_lr`) REFERENCES `loai_ruou` (`ma_lr`),
  ADD CONSTRAINT `dong_ruou_ibfk_2` FOREIGN KEY (`ma_th`) REFERENCES `thuong_hieu` (`ma_th`),
  ADD CONSTRAINT `dong_ruou_ibfk_3` FOREIGN KEY (`ma_ncc`) REFERENCES `nha_cc` (`ma_ncc`);

--
-- Constraints for table `don_dh`
--
ALTER TABLE `don_dh`
  ADD CONSTRAINT `don_dh_ibfk_1` FOREIGN KEY (`ma_ncc`) REFERENCES `nha_cc` (`ma_ncc`),
  ADD CONSTRAINT `don_dh_ibfk_2` FOREIGN KEY (`ma_nv`) REFERENCES `nhan_vien` (`ma_nv`);

--
-- Constraints for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `hoa_don_ibfk_1` FOREIGN KEY (`id_pd`) REFERENCES `phieu_dat` (`id_pd`),
  ADD CONSTRAINT `hoa_don_ibfk_2` FOREIGN KEY (`ma_nv`) REFERENCES `nhan_vien` (`ma_nv`);

--
-- Constraints for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD CONSTRAINT `khach_hang_ibfk_1` FOREIGN KEY (`ma_q`) REFERENCES `quyen` (`ma_q`);

--
-- Constraints for table `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD CONSTRAINT `khuyen_mai_ibfk_1` FOREIGN KEY (`ma_nv`) REFERENCES `nhan_vien` (`ma_nv`);

--
-- Constraints for table `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD CONSTRAINT `nhan_vien_ibfk_1` FOREIGN KEY (`ma_q`) REFERENCES `quyen` (`ma_q`);

--
-- Constraints for table `phieu_dat`
--
ALTER TABLE `phieu_dat`
  ADD CONSTRAINT `phieu_dat_ibfk_1` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`ma_kh`),
  ADD CONSTRAINT `phieu_dat_ibfk_2` FOREIGN KEY (`ma_nv`) REFERENCES `nhan_vien` (`ma_nv`);

--
-- Constraints for table `phieu_nhap`
--
ALTER TABLE `phieu_nhap`
  ADD CONSTRAINT `phieu_nhap_ibfk_1` FOREIGN KEY (`ma_nv`) REFERENCES `nhan_vien` (`ma_nv`),
  ADD CONSTRAINT `phieu_nhap_ibfk_2` FOREIGN KEY (`ma_ddh`) REFERENCES `don_dh` (`ma_ddh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
