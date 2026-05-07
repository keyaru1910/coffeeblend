-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2026 at 10:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee_blend`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `commenter_name` varchar(100) DEFAULT NULL,
  `commenter_email` varchar(100) DEFAULT NULL,
  `comment_content` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','spam') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`comment_id`, `post_id`, `user_id`, `commenter_name`, `commenter_email`, `comment_content`, `parent_id`, `status`, `created_at`) VALUES
(1, 1, NULL, 'Nguyễn Minh Thư', 'thu@email.com', 'Bài viết rất hay và hữu ích. Cảm ơn bạn đã chia sẻ!', NULL, 'approved', '2026-03-27 12:03:05'),
(2, 1, NULL, 'Trần Hoàng Nam', 'nam@email.com', 'Tôi đã thử áp dụng và kết quả thật tuyệt vời!', NULL, 'approved', '2026-03-27 12:03:05'),
(3, 2, NULL, 'Lê Khánh Linh', 'linh@email.com', 'Bài viết rất chi tiết, giúp mình hiểu rõ hơn về các loại hạt.', NULL, 'approved', '2026-03-27 12:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `excerpt` text DEFAULT NULL COMMENT 'Tóm tắt',
  `content` longtext DEFAULT NULL COMMENT 'Nội dung chi tiết',
  `featured_image` varchar(255) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `comments_count` int(11) DEFAULT 0,
  `status` enum('draft','published','archived') DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`post_id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `author_id`, `views`, `comments_count`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Bí quyết pha Cà phê Phin chuẩn vị Việt', 'bi-quyet-pha-ca-phe-phin-chuan-vi-viet', 'Khám phá nghệ thuật pha cà phê phin truyền thống để có một ly cà phê đậm đà, chuẩn vị ngay tại nhà.', '<p>Cà phê phin không đơn thuần là một thức uống, nó là một nét văn hóa...</p>', 'images/blog/image_1.jpg', 1, 125, 5, 'published', '2026-03-27 19:03:04', '2026-03-27 12:03:04', '2026-03-29 02:02:01'),
(2, 'Top 5 loại hạt Cà phê phổ biến nhất', 'top-5-loai-hat-ca-phe-pho-bien-nhat', 'Tìm hiểu sự khác biệt giữa Arabica, Robusta và các dòng hạt Specialty đang làm mưa làm gió hiện nay.', '<p>Cà phê Arabica và Robusta là hai loại phổ biến nhất...</p>', 'images/blog/image_2.jpg', 1, 98, 8, 'published', '2026-03-27 19:03:04', '2026-03-27 12:03:04', '2026-03-29 02:02:01'),
(3, 'Lợi ích bất ngờ của Cà phê', 'loi-ich-bat-ngo-cua-ca-phe', 'Cà phê không chỉ giúp tỉnh táo mà còn mang lại nhiều lợi ích sức khỏe tích cực mà bạn có thể chưa biết.', '<p>Cà phê chứa nhiều chất chống oxy hóa...</p>', 'images/blog/image_3.jpg', 1, 256, 12, 'published', '2026-03-27 19:03:04', '2026-03-27 12:03:04', '2026-03-29 02:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_tags`
--

INSERT INTO `blog_tags` (`post_id`, `tag_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `booking_code` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `guests` int(11) DEFAULT 2,
  `message` text DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booking_code`, `user_id`, `customer_name`, `customer_phone`, `customer_email`, `booking_date`, `booking_time`, `guests`, `message`, `status`, `created_at`) VALUES
(1, 'BK001', NULL, 'Phạm Văn C', '0923456789', NULL, '2026-03-27', '19:00:00', 4, NULL, 'confirmed', '2026-03-27 12:03:05'),
(2, 'BK002', NULL, 'Lê Thị D', '0934567890', NULL, '2026-03-28', '18:30:00', 2, NULL, 'pending', '2026-03-27 12:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `size` varchar(20) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `size`, `added_at`) VALUES
(1, 1, 1, 2, 'Medium', '2026-03-27 12:03:05'),
(2, 1, 3, 1, 'Large', '2026-03-27 12:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `slug`, `description`, `parent_id`, `image`, `display_order`, `status`, `created_at`) VALUES
(1, 'Cà Phê Truyền Thống', 'ca-phe-truyen-thong', 'Cà phê pha phin, espresso, latte...', NULL, NULL, 1, 1, '2026-03-27 12:03:04'),
(2, 'Trà', 'tra', 'Trà trái cây, trà sữa, trà xanh...', NULL, NULL, 2, 1, '2026-03-27 12:03:04'),
(3, 'Đồ Uống Đặc Biệt', 'do-uong-dac-biet', 'Cà phê trứng, cà phê kem muối...', NULL, NULL, 3, 1, '2026-03-27 12:03:04'),
(4, 'Bánh Ngọt', 'banh-ngot', 'Croissant, tiramisu, red velvet...', NULL, NULL, 4, 1, '2026-03-27 12:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','replied') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `name`, `email`, `subject`, `message`, `status`, `created_at`) VALUES
(1, 'Nguyễn Văn A', 'a@email.com', 'Hỏi về dịch vụ', 'Cho tôi hỏi quán có dịch vụ tổ chức tiệc sinh nhật không?', 'unread', '2026-03-27 12:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(20) NOT NULL COMMENT 'Mã đơn hàng',
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_address` text NOT NULL,
  `note` text DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL COMMENT 'Tạm tính',
  `shipping_fee` decimal(10,2) DEFAULT 0.00,
  `discount` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL COMMENT 'Tổng thanh toán',
  `payment_method` varchar(50) DEFAULT 'cod' COMMENT 'cod, bank, momo, vnpay',
  `payment_status` enum('pending','paid','failed','refunded') DEFAULT 'pending',
  `order_status` enum('pending','confirmed','preparing','shipping','delivered','cancelled') DEFAULT 'pending',
  `order_date` datetime DEFAULT current_timestamp(),
  `delivery_date` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_code`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `note`, `subtotal`, `shipping_fee`, `discount`, `total`, `payment_method`, `payment_status`, `order_status`, `order_date`, `delivery_date`, `completed_at`) VALUES
(1, 'ORD001', NULL, 'Nguyễn Văn A', NULL, '0901234567', '123 Đường Láng, Đống Đa, Hà Nội', NULL, 35000.00, 0.00, 0.00, 35000.00, 'cod', 'pending', 'pending', '2026-03-27 19:03:05', NULL, NULL),
(2, 'ORD002', NULL, 'Trần Thị B', NULL, '0912345678', '456 Nguyễn Trãi, Thanh Xuân, Hà Nội', NULL, 50000.00, 15000.00, 5000.00, 60000.00, 'bank', 'paid', 'shipping', '2026-03-27 19:03:05', NULL, NULL),
(3, 'ORD37DE50', NULL, 'mộ bikini', 'tlam8641@gmail.com', '0796470522', 'thanh trì hà nội', 'cho ít đá', 35000.00, 0.00, 0.00, 35000.00, 'COD', 'pending', 'pending', '2026-03-29 09:07:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `size` varchar(20) DEFAULT NULL COMMENT 'Small, Medium, Large'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `product_id`, `product_name`, `product_image`, `quantity`, `unit_price`, `subtotal`, `size`) VALUES
(1, 1, 1, 'Cà Phê Sữa Nóng', NULL, 1, 35000.00, 35000.00, NULL),
(2, 2, 4, 'Cappuccino', NULL, 1, 50000.00, 50000.00, NULL),
(3, 3, 1, 'Cà Phê Sữa Đá', NULL, 1, 35000.00, 35000.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` varchar(500) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_main` varchar(255) DEFAULT NULL,
  `images` text DEFAULT NULL COMMENT 'JSON array of image paths',
  `stock` int(11) DEFAULT 0,
  `sold` int(11) DEFAULT 0,
  `featured` tinyint(4) DEFAULT 0 COMMENT '1: nổi bật',
  `best_seller` tinyint(4) DEFAULT 0 COMMENT '1: bán chạy',
  `status` tinyint(4) DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `slug`, `description`, `short_description`, `price`, `sale_price`, `size`, `category_id`, `image_main`, `images`, `stock`, `sold`, `featured`, `best_seller`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cà Phê Sữa Đá', 'ca-phe-sua-da', NULL, 'Hương vị Việt truyền thống đậm đà.', 35000.00, NULL, NULL, 1, 'images/drink/vietnamese_coffee.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(2, 'Espresso', 'espresso', NULL, 'Đậm đặc, tinh chất từ hạt Robusta.', 35000.00, NULL, NULL, 1, 'images/drink/epressso.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(3, 'Latte Macchiato', 'latte-macchiato', NULL, 'Sự kết hợp hoàn hảo giữa sữa và cafe.', 45000.00, NULL, NULL, 1, 'images/drink/latte.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(4, 'Cappuccino', 'cappuccino', NULL, 'Lớp bọt sữa mịn màng nghệ thuật.', 50000.00, NULL, NULL, 1, 'images/drink/cappuchino.jpg', NULL, 0, 0, 0, 1, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(5, 'Americano', 'americano', NULL, 'Cafe đen truyền thống pha loãng kiểu Mỹ.', 40000.00, NULL, NULL, 1, 'images/drink/americano.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(6, 'Mocha Coffee', 'mocha-coffee', NULL, 'Sự hòa quyện giữa Cafe và Chocolate.', 55000.00, NULL, NULL, 1, 'images/drink/mocha_coffee.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(7, 'Trà Đào Cam Sả', 'tra-dao-cam-sa', NULL, 'Thanh mát, giải nhiệt cực tốt.', 55000.00, NULL, NULL, 2, 'images/drink/cam_xả.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(8, 'Trà Vải Hoa Hồng', 'tra-vai-hoa-hong', NULL, 'Hương vị hoa hồng dịu nhẹ bí truyền.', 55000.00, NULL, NULL, 2, 'images/drink/rose_tea.jpg', NULL, 0, 0, 0, 1, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(9, 'Matcha Latte', 'matcha-latte', NULL, 'Trà xanh Nhật Bản thượng hạng.', 60000.00, NULL, NULL, 2, 'images/drink/Matcha_Latte.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(10, 'Trà Sữa Bá Tước', 'earl-grey-milk-tea', NULL, 'Hương vị Earl Grey đặc trưng.', 55000.00, NULL, NULL, 2, 'images/drink/Earl_Grey_Milk_Tea.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(11, 'Trà Dâu Tây Tươi', 'strawberry-fruit-tea', NULL, 'Trái dâu tươi mọng, vị chua ngọt.', 55000.00, NULL, NULL, 2, 'images/drink/Strawberry_Fruit_Tea.jpg', NULL, 0, 0, 0, 1, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(12, 'Trà Sữa Ô Long', 'oolong-milk-tea', NULL, 'Trà Ô Long thơm lừng kết hợp sữa.', 50000.00, NULL, NULL, 2, 'images/drink/Oolong_Milk_Tea.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(13, 'Cà Phê Trứng', 'ca-phe-trung', NULL, 'Đặc sản Hà Nội béo ngậy, thơm lừng.', 65000.00, NULL, NULL, 3, 'images/drink/Egg_Coffee.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(14, 'Cà Phê Kem Muối', 'ca-phe-kem-muoi', NULL, 'Vị mặn nhẹ của kem quyện cùng cafe.', 65000.00, NULL, NULL, 3, 'images/drink/Salted_Coffee.jpg', NULL, 0, 0, 0, 1, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(15, 'Tropical Fruit Punch', 'tropical-fruit-punch', NULL, 'Hỗn hợp trái cây nhiệt đới tươi.', 70000.00, NULL, NULL, 3, 'images/drink/Tropical_Fruit_Punch.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(16, 'Cà Phê Cốt Dừa', 'ca-phe-cot-dua', NULL, 'Béo ngậy hương dừa, mát lạnh.', 60000.00, NULL, NULL, 3, 'images/drink/Coconut_Coffee.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(17, 'Bạc Xỉu Cream', 'bac-xiu-cream', NULL, 'Nhiều sữa, ít cafe kết hợp lớp kem mịn.', 45000.00, NULL, NULL, 3, 'images/drink/Bac_Xiu_Cream.jpg', NULL, 0, 0, 0, 1, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(18, 'Cà Phê Bơ', 'avocado-coffee', NULL, 'Sự kết hợp độc đáo giữa bơ sáp và cafe.', 65000.00, NULL, NULL, 3, 'images/drink/Avocado_Coffee.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(19, 'Bánh Sừng Bò', 'croissant', NULL, 'Bánh sừng bò Pháp giòn tan thơm bơ.', 45000.00, NULL, NULL, 4, 'images/food/Croissant.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(20, 'Tiramisu Ý', 'tiramisu', NULL, 'Bánh phô mai cà phê trứ danh.', 65000.00, NULL, NULL, 4, 'images/food/Tiramisu.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(21, 'Bánh Nhung Đỏ', 'red-velvet', NULL, 'Vẻ ngoài quý phái, vị ngọt dịu.', 60000.00, NULL, NULL, 4, 'images/food/Red Velvet.jpg', NULL, 0, 0, 0, 1, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(22, 'Cheesecake Berry', 'cheesecake-berry', NULL, 'Phô mai béo ngậy và mứt quả mọng.', 60000.00, NULL, NULL, 4, 'images/food/Cheesecake_Berry.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(23, 'Bộ 3 Macarons', 'macarons-set', NULL, 'Bánh Macaron nhiều màu sắc ngọt ngào.', 55000.00, NULL, NULL, 4, 'images/food/Macarons_Set.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47'),
(24, 'Chocolate Brownie', 'chocolate-brownie', NULL, 'Bánh socola đậm đà, ít ngọt.', 50000.00, NULL, NULL, 4, 'images/food/Chocolate_Brownie.jpg', NULL, 0, 0, 0, 0, 1, '2026-03-30 12:13:47', '2026-03-30 12:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `setting_type` enum('text','textarea','image','number','json') DEFAULT 'text',
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_type`, `description`) VALUES
('opening_hours', '{\"monday_friday\":\"6:00am - 11:00pm\",\"saturday_sunday\":\"7:00am - 10:00pm\"}', 'json', 'Giờ mở cửa'),
('shipping_fee', '15000', 'number', 'Phí giao hàng mặc định'),
('site_address', '60 QL1A, Văn Binh, Thường Tín, Hà Nội', 'text', 'Địa chỉ'),
('site_email', 'tlam8641@gmail.com', 'text', 'Email liên hệ'),
('site_name', 'Coffee Blend', 'text', 'Tên website'),
('site_phone', '0796470522', 'text', 'Số điện thoại');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`, `slug`) VALUES
(1, 'Cà Phê', 'ca-phe'),
(2, 'Cẩm Nang', 'cam-nang'),
(3, 'Truyền Thống', 'truyen-thong'),
(4, 'Hương Vị', 'huong-vi'),
(5, 'Kiến Thức', 'kien-thuc');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('admin','staff','customer') DEFAULT 'customer',
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1: active, 0: inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `full_name`, `phone`, `address`, `role`, `avatar`, `created_at`, `updated_at`, `last_login`, `status`) VALUES
(1, 'admin', 'admin@coffeeblend.com', '$2y$10$KEI9i1Z/KvxlImyM1dWWBeCKDhFPCtezuoXopQ0VDnzWfPKSho6eq', 'Administrator', '0123456789', NULL, 'admin', NULL, '2026-03-27 12:03:03', '2026-05-07 06:46:52', '2026-05-07 13:46:52', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `idx_post` (`post_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_published` (`published_at`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `booking_code` (`booking_code`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_booking_date` (`booking_date`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `unique_cart` (`user_id`,`product_id`,`size`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_user_product` (`user_id`,`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_parent` (`parent_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_status` (`order_status`),
  ADD KEY `idx_order_code` (`order_code`),
  ADD KEY `idx_order_date` (`order_date`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `idx_order` (`order_id`),
  ADD KEY `idx_product` (`product_id`),
  ADD KEY `idx_order_product` (`order_id`,`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_category` (`category_id`),
  ADD KEY `idx_price` (`price`),
  ADD KEY `idx_featured` (`featured`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_key`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `blog_comments_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `blog_comments` (`comment_id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD CONSTRAINT `blog_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
