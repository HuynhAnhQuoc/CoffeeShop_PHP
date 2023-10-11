-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th6 21, 2022 lúc 03:25 AM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `user` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `fullname` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `sdt` int(11) NOT NULL,
  `level` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`user`, `pass`, `fullname`, `sdt`, `level`) VALUES
('admin1', '123456', 'Nguyễn Văn Lương', 989012897, 'Nhân viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `user` varchar(30) NOT NULL,
  `id_prod` text NOT NULL,
  `sum` int(11) NOT NULL DEFAULT '1',
  `checked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`user`, `id_prod`, `sum`, `checked`) VALUES
('luong212', 'cookies_cream', 5, 1),
('luong212', 'phin_den_da', 5, 1),
('an321', 'bac_xiu_da', 2, 1),
('an321', 'phin_den_da', 1, 1),
('an321', 'phin_den_nong', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `user` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `fullname` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `sdt` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`user`, `pass`, `fullname`, `sdt`) VALUES
('luong212', '12345', 'Nguyễn Văn Lương', '978216824'),
('linhkja091', '12345', 'Nguyễn Phan Hoài Linh', '989012897'),
('quocindo231', '12345', 'Nguyễn Thành Quốc', '912398792'),
('an123', '123456', 'Phạm Quốc An', '113'),
('an321', '123', 'Phạm Quốc An', '02131231231'),
('andeptrai', '111', 'an321', '111'),
('an111', '1111', 'An', '1111'),
('an456', '456', 'asdasd', '456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `id_discount` text NOT NULL,
  `moneymin` int(11) NOT NULL,
  `moneyreduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `discount`
--

INSERT INTO `discount` (`id_discount`, `moneymin`, `moneyreduct`) VALUES
('MGT001', 250000, 20000),
('MGT002', 100000, 10000),
('ZNA001', 300000, 30000),
('MGT000', 60000, 5000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oder`
--

DROP TABLE IF EXISTS `oder`;
CREATE TABLE IF NOT EXISTS `oder` (
  `id_oder` text NOT NULL,
  `user` text NOT NULL,
  `sum_prod` int(11) NOT NULL,
  `sum_price` int(11) NOT NULL,
  `day_book` date NOT NULL,
  `status` text NOT NULL,
  `receiver` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` int(11) NOT NULL,
  `method` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `discount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `oder`
--

INSERT INTO `oder` (`id_oder`, `user`, `sum_prod`, `sum_price`, `day_book`, `status`, `receiver`, `address`, `phone_number`, `method`, `discount`) VALUES
('1', 'an321', 2, 93000, '2022-06-16', 'hoàn thành', 'An Pham', 'VN', 123456789, 'Thanh toán bằng thẻ tín dụng Quốc Tế', 'MGT000'),
('2', 'an321', 3, 157000, '2022-06-16', 'hủy', 'An Phạm', 'asdasd', 123456789, 'Thu tiền tận nơi', ''),
('3', 'an321', 4, 186000, '2022-06-16', 'hoàn thành', 'Phạm Quốc An', 'VN', 123456789, 'Thu tiền tận nơi', ''),
('4', 'an321', 3, 157000, '2022-06-16', 'hủy', 'Phạm Quốc An', 'VN', 123456789, 'Thanh toán bằng thẻ tín dụng Quốc Tế', ''),
('5', 'an321', 4, 206000, '2022-06-21', 'hoàn thành', 'Phạm Quốc An', 'VN', 123456789, 'Thanh toán bằng thẻ tín dụng Quốc Tế', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id_order` text NOT NULL,
  `id_prod` text NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id_order`, `id_prod`, `number`) VALUES
('1', 'bac_xiu_da', 1),
('1', 'tra_sen_vang', 1),
('2', 'phin_sua_nong', 1),
('2', 'mousse_cacao', 1),
('2', 'ca_phe_sua', 1),
('3', 'cookies_cream', 1),
('3', 'freeze_tra_xanh', 1),
('3', 'banh_socola_highlands', 1),
('3', 'mousse_dao', 1),
('4', 'phindi_choco', 1),
('4', 'phindi_hanhnhan', 1),
('4', 'caramel_phin_freeze', 1),
('5', 'caramel_macchiato', 1),
('5', 'phindi_choco', 1),
('5', 'phindi_hanhnhan', 1),
('5', 'phindi_kemsua', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` text NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `price` int(11) NOT NULL,
  `sum_number` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `hot` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `type`, `price`, `sum_number`, `discount`, `hot`) VALUES
('americano', 'Americano', 'espresso', 44000, 100, 0, 1),
('cappuccino', 'Cappuccino', 'espresso', 54000, 100, 0, 0),
('caramel_macchiato', 'Caramel Macchiato', 'espresso', 59000, 100, 0, 1),
('espresso', 'Espresso', 'espresso', 44000, 100, 0, 0),
('latte', 'Latte', 'espresso', 54000, 100, 0, 0),
('mocha_macchiato', 'Mocha Macchiato', 'espresso', 59000, 100, 0, 0),
('phindi_choco', 'Phindi Choco', 'phindi', 39000, 100, 0, 0),
('phindi_hanhnhan', 'Phindi Hạnh Nhân', 'phindi', 39000, 100, 0, 0),
('phindi_kemsua', 'Phindi Kem Sữa', 'phindi', 39000, 100, 0, 0),
('bac_xiu_da', 'Bạc Xỉu Đá', 'phin', 29000, 100, 0, 0),
('phin_den_da', 'Phin Đen Đá', 'phin', 29000, 100, 0, 1),
('phin_den_nong', 'Phin Đen Nóng', 'phin', 29000, 100, 0, 0),
('phin_sua_da', 'Phin Sữa Đá', 'phin', 29000, 100, 0, 0),
('phin_sua_nong', 'Phin Sữa Nóng', 'phin', 29000, 100, 0, 0),
('cookies_cream', 'Cookies & Cream', 'freeze', 49000, 100, 0, 1),
('freeze_socola', 'Freeze Sô-cô-la', 'freeze', 49000, 100, 0, 1),
('freeze_tra_xanh', 'Freeze Trà Xanh', 'freeze', 49000, 100, 0, 0),
('caramel_phin_freeze', 'Caramel Phin Freeze', 'freeze_phin', 49000, 100, 0, 0),
('classic_phin_freeze', 'Classic Phin Freeze', 'freeze_phin', 49000, 100, 0, 1),
('tra_sen_vang', 'Trà Sen Vàng', 'tea', 39000, 100, 0, 0),
('tra_thach_dao', 'Trà Thạch Đào', 'tea', 39000, 100, 0, 0),
('tra_thach_vai', 'Trà Thạch Vải', 'tea', 39000, 100, 0, 0),
('tra_thanh_dao', 'Trà Thanh Đào', 'tea', 39000, 100, 0, 0),
('tra_xanh_dau_do', 'Trà Xanh Đậu Đỏ', 'tea', 39000, 100, 0, 0),
('banh_socola_highlands', 'Bánh Sô-cô-la Highlands', 'cake', 29000, 100, 0, 0),
('ca_phe_den', 'Cà Phê Đen 185ML/Lon(Lốc 6)', 'packaged_coffee', 66000, 100, 0, 0),
('ca_phe_hoa_tan_20', 'Cà Phê Hòa Tan 3 Trong 1(20 Gói)', 'packaged_coffee', 58000, 100, 0, 0),
('ca_phe_sua', 'Cà Phê Sữa Lon 185ML/Lon(Lốc 6)', 'packaged_coffee', 69000, 100, 0, 0),
('culi_200gr', 'Culi 200gr', 'packaged_coffee', 75000, 100, 0, 0),
('di_san_200gr', 'Di Sản 200gr', 'packaged_coffee', 42000, 100, 0, 0),
('moka_200gr', 'Moka 200gr', 'packaged_coffee', 85000, 100, 0, 0),
('sanh_dieu_200gr', 'Sành Điệu 200gr', 'packaged_coffee', 55000, 100, 0, 0),
('truyen_thong_1kg', 'Truyền Thống 1kg', 'packaged_coffee', 275000, 100, 0, 0),
('truyen_thong_200gr', 'Truyền Thống 200gr', 'packaged_coffee', 59000, 100, 0, 0),
('mousse_dao', 'Bánh Mousse Đào', 'cake', 29000, 100, 0, 0),
('mousse_cacao', 'Bánh Mousse Cacao', 'cake', 29000, 100, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
