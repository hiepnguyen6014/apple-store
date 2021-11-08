-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 19, 2021 lúc 08:46 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `database`
--
CREATE DATABASE IF NOT EXISTS `database` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `database`;

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(255) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phonenumber` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `avartar` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'avatar.png', -- anh mac dinh
  `money` float NOT NULL DEFAULT 0,
  `level` int(11) NOT NULL DEFAULT 1 -- Type 1 guest , type 0 admin 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--


-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `comment_product`
--

CREATE TABLE `tbl_comment_product` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `text` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `photo_product`
--

-- Hinh anh lien quan toi dien thoai,laptop,...
CREATE TABLE `tbl_photo_product` (
  `id` int(255) NOT NULL,
  `id_product` int(11) NOT NULL,
  `photo1` varchar(100) COLLATE utf8_unicode_ci NOT NULL
  `photo2` varchar(100) COLLATE utf8_unicode_ci NOT NULL
  `photo3` varchar(100) COLLATE utf8_unicode_ci NOT NULL
  `photo4` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

-- Dang xuat ra vao lai khong con product trong cart
CREATE TABLE `tbl_cart` (
  `id` int(255) NOT NULL,
  `id_product` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `save_cart`
--


-- Dang xuat ra vao lai van con product trong cart
CREATE TABLE `tbl_save_cart` (
  `id` int(255) NOT NULL,
  `id_product` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- --------------------------------------------------------
-- -------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `tbl_product`
--
CREATE TABLE `tbl_product` (
  `id_product` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `newprice` float NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0,
  `rate` float NOT NULL DEFAULT 5,
  `hotSale` bit(1) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_register` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `percent_sale`
--
CREATE TABLE `percent_sale` (
  `id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `id_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percent` float COLLATE utf8_unicode_ci NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `reset_token`
--

-- Xac nhan Email 
CREATE TABLE `reset_token` (
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expire_on` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--
-- Đang đổ dữ liệu cho bảng `reset_token`
--
INSERT INTO `reset_token` (`email`, `token`, `expire_on`) VALUES
('nhanle.lx@gmail.com', '96bc2cee62b6a9addda739239c4f3765', 0),
-- -------------------------------------------------------



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type product`
--
CREATE TABLE `tbl_type_product` (
  `id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `id_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `producer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Chỉ mục cho các bảng đã đổ 
--

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);
  ADD UNIQUE KEY `email` (`email`);
  --
-- Chỉ mục cho bảng `reset_token`
--
ALTER TABLE `reset_token`
  ADD PRIMARY KEY (`email`);

--
--
-- Chỉ mục cho bảng `developer`
--
ALTER TABLE `tbl_comment_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hinhanh_ungdung`
--
ALTER TABLE `tbl_photo_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lichsu_napthe`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `napthe`
--
ALTER TABLE `tbl_save_cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reset_token`
--

-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id_product`);
  

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `percent_sale`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ungdung`
--
ALTER TABLE `tbl_type_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_comment_product`
--
ALTER TABLE `tbl_comment_product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `tbl_photo_product`
--
ALTER TABLE `tbl_photo_product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `tbl_save_cart`
--
ALTER TABLE `tbl_save_cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id_product` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `percent_sale`
--
ALTER TABLE `percent_sale`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `tbl_type_product`
--
ALTER TABLE `tbl_type_product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;






/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
