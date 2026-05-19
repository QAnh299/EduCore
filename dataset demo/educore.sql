-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 19, 2026 lúc 07:40 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `educore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `grading_criteria` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`grading_criteria`)),
  `max_score` decimal(3,1) NOT NULL DEFAULT 10.0,
  `deadline` datetime DEFAULT NULL,
  `types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`types`)),
  `attachment_path` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `assignments`
--

INSERT INTO `assignments` (`id`, `class_id`, `title`, `description`, `grading_criteria`, `max_score`, `deadline`, `types`, `attachment_path`, `video_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hoàn thành phiếu bài tập phép tính tự nhiên, UCLN, BCNN', 'Yêu cầu chụp lại ảnh hoàn thành phiếu và nộp bài trên hệ thống', NULL, 6.9, '2026-02-17 15:00:00', '[\"image\"]', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak257C.tmp', NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(2, 1, 'Viết lại lý thuyết bài học buổi hôm nay', 'Yêu cầu chép lại lý thuyết 2 lần', NULL, 5.0, '2026-02-17 14:04:57', '[\"image\",\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(3, 2, 'Làm các bài nâng cao 5,6,7 liên quan đến UCLN, BCNN', 'Trình bày tự luận 3 bài trên chi tiết và nộp lại minh chứng bài trên hệ thống', NULL, 9.0, '2026-02-20 14:04:57', '[\"image\",\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(4, 2, 'Bài tập hôm nay gồm bài 4 và 5 dạng toán tìm số thỏa điều kiện.', 'Các em không ghi đáp số riêng lẻ, cần trình bày rõ lập luận.\r\nNộp bài trên hệ thống sau khi hoàn thành.', NULL, 7.7, '2026-02-21 14:04:57', '[\"image\",\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(5, 2, 'Các em chọn làm ít nhất 2 trong 3 bài 6, 7, 8 (mức nâng cao).', 'Bài làm phải là bài tự luận, trình bày mạch lạc, rõ ràng.\r\nNộp bài trên hệ thống, cô sẽ chấm kỹ phần lập luận.', NULL, 7.3, '2026-02-21 14:04:57', '[\"image\",\"text\"]', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak258D.tmp', NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(6, 3, 'hoàn thành phiếu bài tập trắc nghiệm phần Số hữu tỉ', 'Chụp ảnh phiếu và nộp trên hệ thống, chọn đáp án đúng cho mỗi câu hỏi.', NULL, 8.9, '2026-02-20 14:04:57', '[\"image\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(7, 3, 'Làm phiếu bài tập gồm 10 câu trắc nghiệm và 2 câu tự luận phần Giá trị tuyệt đối.', 'Phần tự luận cần trình bày rõ cách làm.\r\nHoàn thành và nộp bài trên hệ thống dưới dạng ảnh hoặc file text', NULL, 10.0, '2026-02-05 14:04:57', '[\"image\",\"text\"]', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak258E.tmp', NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(8, 3, 'Yêu cầu học sinh hoàn thành bài 4 và 5 phần Cộng, trừ số hữu tỉ.\r\n', 'Bài làm dạng tự luận, ghi đầy đủ các bước tính.\r\nNộp bài trên hệ thống đúng hạn.', NULL, 5.8, '2026-02-20 14:04:57', '[\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(9, 3, 'Viết lại lý thuyết về phương pháp làm bài giá trị tuyệt đối và số hữu tỉ 3 lần', 'Nộp file word lên hệ thống', NULL, 5.9, '2026-02-19 14:04:57', '[\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(10, 4, 'phiếu trắc nghiệm nâng cao gồm 12 câu về so sánh và sắp xếp số hữu tỉ.\r\n', 'Lưu ý đọc kỹ đề trước khi chọn đáp án.\r\nNộp bài trên lớp sau khi hoàn thành.', NULL, 8.3, '2026-02-21 14:04:57', '[\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(11, 4, 'Các em làm phiếu bài tập số 3 gồm cả trắc nghiệm và tự luận.\r\n', 'Có câu cơ bản và câu nâng cao, khuyến khích làm hết.\r\nHoàn thành và nộp bài trên hệ thống.', NULL, 9.4, '2026-02-23 14:04:57', '[\"image\",\"text\"]', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak259F.tmp', NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(12, 4, 'Giao bài toán chứng minh các cặp góc bằng nhau.\r\n', 'Bài làm cần ghi rõ căn cứ và lập luận hình học.', NULL, 7.7, '2026-01-31 14:04:57', '[\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(13, 4, 'Luyện tập bài cộng, trừ đa thức và bài toán tổng hợp.', 'Hoàn thành bài tập theo yêu cầu trong file đính kèm. Nộp bài trước deadline.', NULL, 6.4, '2026-02-03 14:04:57', '[\"image\",\"text\"]', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25A0.tmp', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25A1.tmp', '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(14, 5, 'Giải phương trình bậc nhất trong một ẩn.', 'Luyện tập bài học và kiểm tra miệng vào buổi sau', NULL, 9.4, '2026-02-19 14:04:57', '[\"image\",\"video\",\"text\"]', NULL, 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25B1.tmp', '2026-02-08 00:04:57', '2026-01-29 00:04:57'),
(15, 5, 'Bài tập đọc hiểu văn học', 'Viết đoạn văn ngắn theo chủ đề đã cho. Sử dụng từ vựng và ngữ pháp đã học.', NULL, 7.2, '2026-02-02 14:04:57', '[\"image\",\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(16, 5, 'Giải bất phương trình bậc nhất và biểu diễn tập nghiệm trên trục số.', 'Trình bày tự luận và nộp lại trên lớp', NULL, 8.6, '2026-02-19 14:04:57', '[\"text\"]', NULL, 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25B2.tmp', '2026-02-08 00:04:57', '2026-01-29 00:04:57'),
(17, 5, 'Bài toán hình học tam giác vuông (tính độ dài cạnh và diện tích).', 'Luyện tập và ghi nhớ các công thức tính chu vi, diện tích, tính chất của các loại tam giác.', NULL, 7.8, '2026-02-17 14:04:57', '[\"text\",\"image\"]', NULL, NULL, '2026-02-09 00:04:57', '2026-01-29 00:04:57'),
(18, 6, 'Bài toán tính diện tích lăng trụ tam giác.', 'Lưu ý kỹ các tinh chất của hình tròn. Trình bày tự luận logic, rõ ràng kèm video diễn giải cách làm', NULL, 8.2, '2026-02-12 14:04:00', '[\"essay\"]', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25B3.tmp', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25B4.tmp', '2026-02-10 00:04:57', '2026-02-07 19:33:17'),
(19, 6, 'Giải phương trình có ẩn ở mẫu (chú ý điều kiện xác định).', 'Bài làm cần lập luận rõ ràng, không ghi kết quả đơn lẻ.\r\nNộp bài trên hệ thống.', NULL, 9.9, '2026-02-18 14:04:57', '[\"image\",\"video\",\"text\"]', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25B5.tmp', NULL, '2026-02-10 00:04:57', '2026-01-29 00:04:57'),
(20, 6, 'Giải bất phương trình tích.', 'Bài làm cần lập luận rõ ràng, không ghi kết quả đơn lẻ.\r\nNộp bài trên hệ thống.', NULL, 6.0, '2026-02-23 14:04:57', '[\"text\"]', 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25C6.tmp', NULL, '2026-02-02 00:04:57', '2026-01-29 00:04:57'),
(21, 6, 'Bài toán chứng minh hình học trong tam giác', 'Bài làm cần lập luận rõ ràng, không ghi kết quả đơn lẻ.\r\nNộp bài trên lớp.', NULL, 6.4, '2026-02-16 14:04:57', '[\"text\"]', NULL, NULL, '2026-02-02 00:04:57', '2026-01-29 00:04:57'),
(22, 7, 'Bài tập về hàm số bậc nhất (tính giá trị và vẽ đồ thị).', 'Hoàn thành bài tập trắc nghiệm và bài làm tự luận, trình bày sạch sẽ, rõ ràng.', NULL, 8.9, '2026-02-13 14:04:57', '[\"image\", \"text\"]', NULL, 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25C7.tmp', '2026-02-08 00:04:57', '2026-01-29 00:04:57'),
(23, 7, 'Giải phương trình bậc hai dạng cơ bản', 'Bài làm tự luận, trình bày sạch sẽ, rõ ràng.', NULL, 9.5, '2026-02-15 14:04:57', '[\"image\",\"text\"]', NULL, NULL, '2026-02-01 00:04:57', '2026-01-29 00:04:57'),
(24, 7, 'Bài toán đường tròn, hình thang (tính chu vi, diện tích).', 'Đọc hiểu kỹ và trả lời các câu hỏi. Chú ý đến công thức và đơn vị', NULL, 9.2, '2026-02-15 14:04:57', '[\"image\",\"text\"]', NULL, 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25C8.tmp', '2026-02-01 00:04:57', '2026-01-29 00:04:57'),
(25, 7, 'Các em hoàn thành toàn bộ phần bài tập cơ bản, tập trung củng cố cách giải phương trình và vẽ đồ thị hàm số.', 'Yêu cầu trình bày đúng quy trình, làm cẩn thận từng bước.\r\nNộp bài trên hệ thống đúng thời hạn.', NULL, 7.3, '0000-00-00 00:00:00', '[\"video\",\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(26, 8, 'Giải phương trình bậc hai nâng cao.', 'Lưu ý trình bày đúng ngôn ngữ toán học, ghi rõ căn cứ ở mỗi bước.', NULL, 10.0, '2026-02-13 14:04:57', '[\"image\",\"text\"]', NULL, 'C:\\Users\\Admin\\AppData\\Local\\Temp\\fak25D9.tmp', '2026-02-01 00:04:57', '2026-01-29 00:04:57'),
(27, 8, 'Bài toán hàm số bậc hai – xác định đỉnh và giá trị lớn nhất/nhỏ nhất', 'Yêu cầu: bài làm tự luận, trình bày sạch sẽ, rõ ràng.', NULL, 9.4, '2026-01-31 14:04:57', '[\"video\",\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(28, 8, 'Bài toán chứng minh hình học liên quan đến đường tròn.\r\n\r\n', 'Lưu ý trình bày đúng ngôn ngữ toán học, ghi rõ căn cứ ở mỗi bước.', NULL, 9.3, '2026-02-15 14:04:57', '[\"text\"]', NULL, NULL, '2026-01-29 00:04:57', '2026-01-29 00:04:57'),
(32, 2, 'Hoàn thành bài tập trong Bài 1: Tập hợp (SGK trang 6,7,8)', NULL, NULL, 10.0, '2026-04-12 22:30:00', '[\"essay\"]', NULL, NULL, '2026-04-10 11:28:02', '2026-04-10 11:28:02'),
(33, 2, 'Hoàn thành phiếu bài tập về nhà tuần 5', '', NULL, 10.0, '2026-05-03 22:30:00', '[\"essay\"]', NULL, NULL, '2026-04-29 11:29:54', '2026-04-29 11:29:54'),
(34, 2, 'Làm bài tập trong Luyện tập chung (SGK trang 21)', NULL, NULL, 10.0, '2026-04-22 23:00:00', '[\"essay\"]', NULL, NULL, '2026-04-21 11:32:14', '2026-04-21 11:32:14'),
(35, 2, 'Ôn tập Bài 5: Thứ tự thực hiện các phép tính', NULL, NULL, 10.0, '2026-04-10 23:00:00', '[\"essay\"]', NULL, NULL, '2026-04-15 11:34:07', '2026-04-15 11:34:07'),
(36, 2, 'Làm bài tập cuối Chương I trang 28', NULL, NULL, 10.0, '2026-04-09 23:00:00', '[\"essay\"]', NULL, NULL, '2026-04-08 11:34:58', '2026-04-08 11:34:58'),
(37, 1, 'Làm bài tập cuối Chương I trang 28 ', NULL, NULL, 10.0, '2026-05-09 22:00:00', '[\"essay\"]', NULL, NULL, '2026-05-08 12:19:31', '2026-05-08 12:19:31'),
(38, 1, 'Ôn tập Bài 5: Thứ tự thực hiện các phép tính ', NULL, NULL, 10.0, '2026-05-12 22:00:00', '[\"essay\"]', NULL, NULL, '2026-05-08 12:20:07', '2026-05-08 12:20:07'),
(39, 1, 'Làm bài tập trong Luyện tập chung (SGK trang 21) ', NULL, NULL, 10.0, '2026-05-08 22:00:00', '[\"essay\"]', NULL, NULL, '2026-05-08 12:20:46', '2026-05-08 12:20:46'),
(40, 1, 'Hoàn thành phiếu bài tập về nhà tuần 5 ', NULL, NULL, 10.0, '2026-05-10 22:00:00', '[\"essay\"]', NULL, NULL, '2026-05-08 12:21:23', '2026-05-08 12:21:23'),
(41, 1, 'Hoàn thành bài tập trong Bài 1: Tập hợp (SGK trang 6,7,8) ', NULL, NULL, 10.0, '2026-05-09 22:00:00', '[\"essay\"]', NULL, NULL, '2026-05-08 12:22:05', '2026-05-08 12:22:05'),
(50, 1, 'Bài tập phân số cơ bản', 'Hoàn thành các bài tập cộng và trừ phân số trong sách giáo khoa.', '[\"Đúng đáp án\",\"Trình bày sạch đẹp\"]', 10.0, '2026-04-12 08:00:00', '[\"text\"]', NULL, NULL, '2026-04-05 01:10:00', '2026-04-05 01:10:00'),
(51, 1, 'Luyện tập phép nhân phân số', 'Giải các bài toán liên quan đến phép nhân phân số và rút gọn kết quả.', '[\"Đầy đủ bài làm\",\"Tính toán chính xác\"]', 10.0, '2026-04-19 08:00:00', '[\"text\"]', NULL, NULL, '2026-04-12 01:10:00', '2026-04-12 01:10:00'),
(52, 1, 'Bài tập phép chia phân số', 'Thực hành phép chia phân số và giải bài toán ứng dụng.', '[\"Áp dụng đúng công thức\",\"Kết quả chính xác\"]', 10.0, '2026-04-26 08:00:00', '[\"text\"]', NULL, NULL, '2026-04-19 01:10:00', '2026-04-19 01:10:00'),
(53, 1, 'Ôn tập số thập phân', 'Hoàn thành bài tập chuyển đổi phân số sang số thập phân.', '[\"Đúng phép tính\",\"Hoàn thành đầy đủ\"]', 10.0, '2026-05-03 08:00:00', '[\"text\"]', NULL, NULL, '2026-04-26 01:10:00', '2026-04-26 01:10:00'),
(54, 1, 'Bài tập phần trăm', 'Giải các bài toán thực tế liên quan đến phần trăm.', '[\"Trình bày rõ ràng\",\"Đúng tối thiểu 80 phần trăm\"]', 10.0, '2026-05-10 08:00:00', '[\"text\"]', NULL, NULL, '2026-05-03 01:10:00', '2026-05-03 01:10:00'),
(55, 1, 'Ôn tập cuối chương', 'Tổng hợp kiến thức chương phân số và số thập phân.', '[\"Hoàn thành đầy đủ\",\"Vận dụng đúng kiến thức\"]', 10.0, '2026-05-17 08:00:00', '[\"text\"]', NULL, NULL, '2026-05-10 01:10:00', '2026-05-10 01:10:00'),
(56, 10, 'Bài tập hệ phương trình', 'Giải các hệ phương trình bằng phương pháp thế và cộng đại số.', '[\"Đúng phương pháp\",\"Trình bày rõ ràng\"]', 10.0, '2026-03-08 18:00:00', '[\"text\"]', NULL, NULL, '2026-03-02 11:10:00', '2026-03-02 11:10:00'),
(57, 10, 'Luyện tập đồ thị hàm số', 'Vẽ đồ thị hàm số y = ax + b và xác định hệ số.', '[\"Vẽ đúng đồ thị\",\"Tính toán chính xác\"]', 10.0, '2026-03-09 18:00:00', '[\"text\"]', NULL, NULL, '2026-03-08 11:10:00', '2026-03-08 11:10:00'),
(58, 10, 'Ôn tập hàm số bậc nhất', 'Hoàn thành các bài tập ứng dụng hàm số bậc nhất.', '[\"Đầy đủ bài giải\",\"Áp dụng đúng công thức\"]', 10.0, '2026-03-15 18:00:00', '[\"text\"]', NULL, NULL, '2026-03-09 11:10:00', '2026-03-09 11:10:00'),
(59, 10, 'Bài tập phương trình bậc hai', 'Giải phương trình bậc hai bằng công thức nghiệm.', '[\"Đúng nghiệm\",\"Trình bày đầy đủ\"]', 10.0, '2026-03-16 18:00:00', '[\"text\"]', NULL, NULL, '2026-03-15 11:10:00', '2026-03-15 11:10:00'),
(60, 10, 'Luyện tập định lý Vi-et', 'Áp dụng định lý Vi-et để tìm nghiệm và lập phương trình.', '[\"Sử dụng đúng định lý\",\"Tính toán chính xác\"]', 10.0, '2026-03-22 18:00:00', '[\"text\"]', NULL, NULL, '2026-03-16 11:10:00', '2026-03-16 11:10:00'),
(61, 10, 'Hệ thức lượng tam giác vuông', 'Giải bài tập hệ thức lượng trong tam giác vuông.', '[\"Vẽ hình đúng\",\"Áp dụng công thức chính xác\"]', 10.0, '2026-03-29 18:00:00', '[\"text\"]', NULL, NULL, '2026-03-22 11:10:00', '2026-03-22 11:10:00'),
(62, 10, 'Bài tập tỉ số lượng giác', 'Thực hành tính sin, cos, tan và cot của góc nhọn.', '[\"Đúng kết quả\",\"Trình bày hợp lý\"]', 10.0, '2026-04-05 18:00:00', '[\"text\"]', NULL, NULL, '2026-03-29 11:10:00', '2026-03-29 11:10:00'),
(63, 10, 'Đường tròn ngoại tiếp', 'Giải các bài tập liên quan đến đường tròn ngoại tiếp tam giác.', '[\"Lập luận logic\",\"Vẽ hình chính xác\"]', 10.0, '2026-04-06 18:00:00', '[\"text\"]', NULL, NULL, '2026-04-05 11:10:00', '2026-04-05 11:10:00'),
(64, 10, 'Luyện tập góc nội tiếp', 'Chứng minh và tính góc nội tiếp trong đường tròn.', '[\"Chứng minh đầy đủ\",\"Đúng tính chất hình học\"]', 10.0, '2026-04-12 18:00:00', '[\"text\"]', NULL, NULL, '2026-04-06 11:10:00', '2026-04-06 11:10:00'),
(65, 10, 'Ôn tập chương hàm số', 'Tổng hợp bài tập hàm số và đồ thị.', '[\"Hoàn thành đầy đủ\",\"Áp dụng đúng kiến thức\"]', 10.0, '2026-04-13 18:00:00', '[\"text\"]', NULL, NULL, '2026-04-12 11:10:00', '2026-04-12 11:10:00'),
(66, 10, 'Ôn tập phương trình bậc hai', 'Luyện tập các dạng toán phương trình bậc hai nâng cao.', '[\"Giải đúng bài toán\",\"Trình bày khoa học\"]', 10.0, '2026-04-19 18:00:00', '[\"text\"]', NULL, NULL, '2026-04-13 11:10:00', '2026-04-13 11:10:00'),
(67, 10, 'Lập phương trình giải toán', 'Giải bài toán thực tế bằng cách lập phương trình.', '[\"Đặt ẩn hợp lý\",\"Giải đúng phương trình\"]', 10.0, '2026-04-26 18:00:00', '[\"text\"]', NULL, NULL, '2026-04-19 11:10:00', '2026-04-19 11:10:00'),
(68, 10, 'Ôn tập học kì lớp 9', 'Tổng hợp kiến thức Đại số và Hình học học kì.', '[\"Làm đúng tối thiểu 80 phần trăm\",\"Trình bày sạch đẹp\"]', 10.0, '2026-05-03 18:00:00', '[\"text\"]', NULL, NULL, '2026-04-26 11:10:00', '2026-04-26 11:10:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `present` tinyint(1) NOT NULL DEFAULT 1,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attendances`
--

INSERT INTO `attendances` (`id`, `class_id`, `student_id`, `date`, `present`, `reason`, `created_at`, `updated_at`) VALUES
(19, 1, 2, '2026-04-05', 1, NULL, '2026-04-05 01:00:12', '2026-04-05 01:00:12'),
(20, 1, 3, '2026-04-05', 1, NULL, '2026-04-05 01:00:45', '2026-04-05 01:00:45'),
(21, 1, 20, '2026-04-05', 1, NULL, '2026-04-05 01:01:03', '2026-04-05 01:01:03'),
(22, 1, 21, '2026-04-05', 1, NULL, '2026-04-05 01:01:37', '2026-04-05 01:01:37'),
(23, 1, 24, '2026-04-05', 1, NULL, '2026-04-05 01:02:14', '2026-04-05 01:02:14'),
(24, 1, 27, '2026-04-05', 1, NULL, '2026-04-05 01:03:02', '2026-04-05 01:03:02'),
(25, 1, 30, '2026-04-05', 1, NULL, '2026-04-05 01:04:11', '2026-04-05 01:04:11'),
(26, 1, 31, '2026-04-05', 1, NULL, '2026-04-05 01:04:56', '2026-04-05 01:04:56'),
(27, 1, 2, '2026-04-12', 1, NULL, '2026-04-12 01:00:10', '2026-04-12 01:00:10'),
(28, 1, 3, '2026-04-12', 1, NULL, '2026-04-12 01:00:38', '2026-04-12 01:00:38'),
(29, 1, 20, '2026-04-12', 1, NULL, '2026-04-12 01:01:05', '2026-04-12 01:01:05'),
(30, 1, 21, '2026-04-12', 0, 'Nghỉ ốm', '2026-04-12 01:01:40', '2026-04-12 01:01:40'),
(31, 1, 24, '2026-04-12', 1, NULL, '2026-04-12 01:02:12', '2026-04-12 01:02:12'),
(32, 1, 27, '2026-04-12', 1, NULL, '2026-04-12 01:03:00', '2026-04-12 01:03:00'),
(33, 1, 30, '2026-04-12', 1, NULL, '2026-04-12 01:04:09', '2026-04-12 01:04:09'),
(34, 1, 31, '2026-04-12', 1, NULL, '2026-04-12 01:04:50', '2026-04-12 01:04:50'),
(35, 1, 2, '2026-04-19', 1, NULL, '2026-04-19 01:00:15', '2026-04-19 01:00:15'),
(36, 1, 3, '2026-04-19', 1, NULL, '2026-04-19 01:00:42', '2026-04-19 01:00:42'),
(37, 1, 20, '2026-04-19', 0, 'Nghỉ có phép', '2026-04-19 01:01:10', '2026-04-19 01:01:10'),
(38, 1, 21, '2026-04-19', 1, NULL, '2026-04-19 01:01:48', '2026-04-19 01:01:48'),
(39, 1, 24, '2026-04-19', 1, NULL, '2026-04-19 01:02:20', '2026-04-19 01:02:20'),
(40, 1, 27, '2026-04-19', 1, NULL, '2026-04-19 01:03:06', '2026-04-19 01:03:06'),
(41, 1, 30, '2026-04-19', 1, NULL, '2026-04-19 01:04:14', '2026-04-19 01:04:14'),
(42, 1, 31, '2026-04-19', 1, NULL, '2026-04-19 01:04:58', '2026-04-19 01:04:58'),
(43, 1, 2, '2026-04-26', 1, NULL, '2026-04-26 01:00:11', '2026-04-26 01:00:11'),
(44, 1, 3, '2026-04-26', 0, 'Nghỉ ốm', '2026-04-26 01:00:39', '2026-04-26 01:00:39'),
(45, 1, 20, '2026-04-26', 1, NULL, '2026-04-26 01:01:07', '2026-04-26 01:01:07'),
(46, 1, 21, '2026-04-26', 0, 'Có việc gia đình', '2026-04-26 01:01:42', '2026-04-26 01:01:42'),
(47, 1, 24, '2026-04-26', 1, NULL, '2026-04-26 01:02:16', '2026-04-26 01:02:16'),
(48, 1, 27, '2026-04-26', 0, 'Nghỉ có phép', '2026-04-26 01:03:04', '2026-04-26 01:03:04'),
(49, 1, 30, '2026-04-26', 1, NULL, '2026-04-26 01:04:13', '2026-04-26 01:04:13'),
(50, 1, 31, '2026-04-26', 1, NULL, '2026-04-26 01:04:57', '2026-04-26 01:04:57'),
(51, 1, 2, '2026-05-03', 1, NULL, '2026-05-03 01:00:09', '2026-05-03 01:00:09'),
(52, 1, 3, '2026-05-03', 1, NULL, '2026-05-03 01:00:36', '2026-05-03 01:00:36'),
(53, 1, 20, '2026-05-03', 1, NULL, '2026-05-03 01:01:04', '2026-05-03 01:01:04'),
(54, 1, 21, '2026-05-03', 1, NULL, '2026-05-03 01:01:41', '2026-05-03 01:01:41'),
(55, 1, 24, '2026-05-03', 0, 'Nghỉ ốm', '2026-05-03 01:02:15', '2026-05-03 01:02:15'),
(56, 1, 27, '2026-05-03', 1, NULL, '2026-05-03 01:03:01', '2026-05-03 01:03:01'),
(57, 1, 30, '2026-05-03', 1, NULL, '2026-05-03 01:04:10', '2026-05-03 01:04:10'),
(58, 1, 31, '2026-05-03', 1, NULL, '2026-05-03 01:04:53', '2026-05-03 01:04:53'),
(59, 1, 2, '2026-05-10', 1, NULL, '2026-05-10 01:00:08', '2026-05-10 01:00:08'),
(60, 1, 3, '2026-05-10', 1, NULL, '2026-05-10 01:00:35', '2026-05-10 01:00:35'),
(61, 1, 20, '2026-05-10', 1, NULL, '2026-05-10 01:01:02', '2026-05-10 01:01:02'),
(62, 1, 21, '2026-05-10', 1, NULL, '2026-05-10 01:01:39', '2026-05-10 01:01:39'),
(63, 1, 24, '2026-05-10', 1, NULL, '2026-05-10 01:02:11', '2026-05-10 01:02:11'),
(64, 1, 27, '2026-05-10', 1, NULL, '2026-05-10 01:03:00', '2026-05-10 01:03:00'),
(65, 1, 30, '2026-05-10', 1, NULL, '2026-05-10 01:04:08', '2026-05-10 01:04:08'),
(66, 1, 31, '2026-05-10', 1, NULL, '2026-05-10 01:04:51', '2026-05-10 01:04:51'),
(171, 10, 42, '2026-05-05', 1, NULL, '2026-05-05 02:21:45', '2026-05-05 02:21:45'),
(172, 10, 49, '2026-05-05', 1, NULL, '2026-05-05 02:21:45', '2026-05-05 02:21:45'),
(173, 10, 41, '2026-05-05', 1, NULL, '2026-05-05 02:21:45', '2026-05-05 02:21:45'),
(174, 10, 39, '2026-05-05', 1, NULL, '2026-05-05 02:21:45', '2026-05-05 02:21:45'),
(175, 10, 52, '2026-05-05', 0, 'ốm', '2026-05-05 02:21:45', '2026-05-05 02:21:45'),
(176, 10, 48, '2026-05-05', 1, NULL, '2026-05-05 02:21:45', '2026-05-05 02:21:45'),
(177, 10, 40, '2026-05-05', 1, NULL, '2026-05-05 02:21:45', '2026-05-05 02:21:45'),
(178, 10, 47, '2026-05-05', 1, NULL, '2026-05-05 02:21:45', '2026-05-05 02:21:45'),
(179, 8, 7, '2026-05-05', 1, NULL, '2026-05-05 02:23:40', '2026-05-05 02:23:40'),
(180, 8, 22, '2026-05-05', 1, NULL, '2026-05-05 02:23:40', '2026-05-05 02:23:40'),
(181, 8, 50, '2026-05-05', 1, NULL, '2026-05-05 02:23:40', '2026-05-05 02:23:40'),
(182, 8, 51, '2026-05-05', 1, NULL, '2026-05-05 02:23:40', '2026-05-05 02:23:40'),
(183, 8, 51, '2026-04-28', 1, NULL, '2026-04-28 02:23:40', '2026-04-28 02:23:40'),
(184, 8, 50, '2026-04-28', 1, NULL, '2026-04-28 02:23:40', '2026-04-28 02:23:40'),
(185, 8, 22, '2026-04-28', 1, NULL, '2026-04-28 02:23:40', '2026-04-28 02:23:40'),
(186, 8, 7, '2026-04-28', 1, NULL, '2026-04-28 02:23:40', '2026-04-28 02:23:40'),
(187, 10, 47, '2026-04-28', 1, NULL, '2026-04-28 02:21:45', '2026-04-28 02:21:45'),
(188, 10, 40, '2026-04-28', 1, NULL, '2026-04-28 02:21:45', '2026-04-28 02:21:45'),
(189, 10, 48, '2026-04-28', 1, NULL, '2026-04-28 02:21:45', '2026-04-28 02:21:45'),
(190, 10, 52, '2026-04-28', 1, '', '2026-04-28 02:21:45', '2026-04-28 02:21:45'),
(191, 10, 39, '2026-04-28', 0, 'Nghỉ ốm', '2026-04-28 02:21:45', '2026-04-28 02:21:45'),
(192, 10, 41, '2026-05-05', 0, 'Vắng', '2026-04-28 02:21:45', '2026-04-28 02:21:45'),
(193, 10, 49, '2026-04-28', 1, NULL, '2026-04-28 02:21:45', '2026-04-28 02:21:45'),
(194, 10, 42, '2026-04-28', 1, NULL, '2026-04-28 02:21:45', '2026-04-28 02:21:45'),
(195, 8, 7, '2026-05-09', 1, NULL, '2026-05-09 02:41:51', '2026-05-09 02:41:51'),
(196, 8, 22, '2026-05-09', 1, NULL, '2026-05-09 02:41:51', '2026-05-09 02:41:51'),
(197, 8, 50, '2026-05-09', 1, NULL, '2026-05-09 02:41:51', '2026-05-09 02:41:51'),
(198, 8, 51, '2026-05-09', 1, NULL, '2026-05-09 02:41:51', '2026-05-09 02:41:51'),
(199, 10, 42, '2026-05-09', 1, NULL, '2026-05-09 02:44:14', '2026-05-09 02:44:14'),
(200, 10, 49, '2026-05-09', 1, NULL, '2026-05-09 02:44:14', '2026-05-09 02:44:14'),
(201, 10, 41, '2026-05-09', 1, NULL, '2026-05-09 02:44:14', '2026-05-09 02:44:14'),
(202, 10, 39, '2026-05-09', 0, '', '2026-05-09 02:44:14', '2026-05-09 02:44:14'),
(203, 10, 52, '2026-05-09', 0, '', '2026-05-09 02:44:14', '2026-05-09 02:44:14'),
(204, 10, 48, '2026-05-09', 1, NULL, '2026-05-09 02:44:14', '2026-05-09 02:44:14'),
(205, 10, 40, '2026-05-09', 1, NULL, '2026-05-09 02:44:14', '2026-05-09 02:44:14'),
(206, 10, 47, '2026-05-09', 1, NULL, '2026-05-09 02:44:14', '2026-05-09 02:44:14'),
(207, 10, 47, '2026-05-02', 1, NULL, '2026-05-02 02:44:14', '2026-05-02 02:44:14'),
(208, 10, 40, '2026-05-02', 1, NULL, '2026-05-02 02:44:14', '2026-05-02 02:44:14'),
(209, 10, 48, '2026-05-02', 1, NULL, '2026-05-02 02:44:14', '2026-05-02 02:44:14'),
(210, 10, 52, '2026-05-02', 0, 'Nghỉ ốm', '2026-05-02 02:44:14', '2026-05-02 02:44:14'),
(211, 10, 39, '2026-05-02', 1, '', '2026-05-02 02:44:14', '2026-05-02 02:44:14'),
(212, 10, 41, '2026-05-02', 1, NULL, '2026-05-02 02:44:14', '2026-05-02 02:44:14'),
(213, 10, 49, '2026-05-02', 0, NULL, '2026-05-02 02:44:14', '2026-05-02 02:44:14'),
(214, 10, 42, '2026-05-02', 1, NULL, '2026-05-02 02:44:14', '2026-05-02 02:44:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('educore_cache_5b384ce32d8cdef02bc3a139d4cac0a22bb029e8', 'i:2;', 1778939588),
('educore_cache_5b384ce32d8cdef02bc3a139d4cac0a22bb029e8:timer', 'i:1778939588;', 1778939588),
('educore_cache_af3e133428b9e25c55bc59fe534248e6a0c0f17b', 'i:1;', 1779075025),
('educore_cache_af3e133428b9e25c55bc59fe534248e6a0c0f17b:timer', 'i:1779075025;', 1779075025);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `schedule` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('draft','active','inactive','completed') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classrooms`
--

INSERT INTO `classrooms` (`id`, `name`, `level`, `schedule`, `notes`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lớp 6A', 'Toán lớp 6', '{\"days\":[\"Monday\",\"Tuesday\",\"Saturday\"],\"time\":\"16:00 - 18:00\"}', 'Toán lớp 6.', 'active', '2026-01-28 21:13:15', '2026-05-18 14:14:36', NULL),
(2, 'Lớp 6B', 'Toán lớp 6', '{\"days\":[\"Sunday\"],\"time\":\"14:30 - 16:30\"}', 'Toán lớp 6', 'active', '2026-01-28 21:13:15', '2026-05-16 09:33:39', NULL),
(3, 'Lớp 7A', 'Toán lớp 7', '{\"days\":[\"Saturday\"],\"time\":\"14:30 - 16:30\"}', 'Toán lớp 7', 'active', '2026-01-28 21:13:15', '2026-05-16 09:32:34', NULL),
(4, 'Lớp 7B', 'Toán lớp 7', '{\"days\":[\"Saturday\"],\"time\":\"08:00 - 10:00\"}', 'Toán lớp 7', 'active', '2026-01-28 21:13:15', '2026-05-16 09:31:46', NULL),
(5, 'Lớp 8A', 'Toán lớp 8', '{\"days\":[\"Tuesday\",\"Friday\"],\"time\":\"18:30 - 20:30\"}', 'Toán lớp 8', 'active', '2026-01-28 21:13:15', '2026-05-16 09:30:46', NULL),
(6, 'Lớp 8B', 'Toán lớp 8', '{\"days\":[\"Monday\",\"Thursday\"],\"time\":\"18:30 - 20:30\"}', 'Toán lớp 8', 'inactive', '2026-01-28 21:13:15', '2026-05-16 12:51:48', NULL),
(7, 'Lớp 8D', 'Toán lớp 8', '{\"days\":[\"Tuesday\",\"Thursday\"],\"time\":\"18:30 - 20:30\"}', 'Toán lớp 8', 'inactive', '2026-01-28 21:13:15', '2026-05-16 12:52:00', NULL),
(8, 'Lớp 9B', 'Toán lớp 9', '{\"days\":[\"Tuesday\",\"Saturday\",\"Monday\"],\"time\":\"09:00 - 11:00\"}', 'Toán lớp 9', 'active', '2026-01-28 21:13:15', '2026-05-17 16:59:55', NULL),
(9, 'Lớp 8C', 'Lớp 8', '{\"days\":[\"Wednesday\",\"Friday\"],\"time\":\"18:30 - 20:30\"}', 'Toán lớp 8', 'active', '2026-01-28 21:13:15', '2026-05-16 09:38:00', NULL),
(10, 'Lớp 9A', 'Toán lớp 9', '{\"days\":[\"Tuesday\",\"Sunday\",\"Saturday\",\"Monday\"],\"time\":\"10:30 - 12:30\"}', 'Toán lớp 9', 'active', '2026-01-28 21:13:15', '2026-05-17 16:59:07', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classroom_message_reads`
--

CREATE TABLE `classroom_message_reads` (
  `id` varchar(2) DEFAULT NULL,
  `user_id` varchar(7) DEFAULT NULL,
  `class_id` varchar(8) DEFAULT NULL,
  `last_read_message_id` varchar(20) DEFAULT NULL,
  `last_read_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `classroom_message_reads`
--

INSERT INTO `classroom_message_reads` (`id`, `user_id`, `class_id`, `last_read_message_id`, `last_read_at`, `created_at`, `updated_at`) VALUES
('1', '2', '1', '14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2', '11', '1', '14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3', '12', '1', '14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4', '13', '1', '14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5', '14', '1', '14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6', '15', '1', '14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7', '3', '2', '16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8', '14', '2', '16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9', '15', '2', '16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('10', '16', '2', '16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('11', '17', '2', '16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('12', '18', '2', '16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('13', '37', '1', '30', '2026-05-19 12:38:47', '0000-00-00 00:00:00', '2026-05-19 12:38:47'),
(NULL, '38', '1', '30', '2026-05-18 21:22:09', '2026-05-12 13:31:27', '2026-05-18 21:22:09'),
(NULL, '47', '1', '30', '2026-05-18 21:22:09', '2026-05-13 21:24:01', '2026-05-18 21:22:09'),
(NULL, '41', '10', '29', '2026-05-18 21:22:09', '2026-05-18 09:53:38', '2026-05-18 21:22:09'),
(NULL, '38', '10', '29', '2026-05-18 21:22:09', '2026-05-18 10:44:41', '2026-05-18 21:22:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class_user`
--

CREATE TABLE `class_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('teacher','student','assistant') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `class_user`
--

INSERT INTO `class_user` (`id`, `class_id`, `user_id`, `role`, `created_at`, `updated_at`) VALUES
(68, 1, 31, 'student', '2026-03-23 07:56:49', '2026-05-18 03:14:54'),
(69, 1, 13, 'student', '2026-03-23 07:56:49', '2026-05-18 03:14:54'),
(70, 3, 19, 'student', '2026-03-23 07:59:05', '2026-05-16 10:42:31'),
(71, 3, 24, 'student', '2026-03-23 07:59:05', '2026-05-16 10:42:31'),
(72, 3, 23, 'student', '2026-03-23 07:59:05', '2026-05-16 10:42:31'),
(73, 5, 21, 'student', '2026-03-23 07:59:23', '2026-05-16 12:57:46'),
(74, 8, 32, 'student', '2026-03-23 08:00:16', '2026-05-16 12:51:09'),
(79, 8, 17, 'student', '2026-03-23 08:04:50', '2026-05-16 12:51:09'),
(80, 1, 30, 'student', '2026-03-23 08:05:20', '2026-05-18 03:14:54'),
(81, 1, 12, 'student', '2026-03-23 08:05:29', '2026-05-18 03:14:54'),
(82, 1, 34, 'student', '2026-03-23 08:06:22', '2026-05-18 03:14:54'),
(143, 1, 45, 'student', '2026-05-08 10:42:42', '2026-05-18 03:14:54'),
(144, 1, 47, 'student', '2026-05-08 10:42:42', '2026-05-18 03:14:54'),
(146, 2, 44, 'student', '2026-05-08 10:43:18', '2026-05-16 09:58:36'),
(147, 2, 46, 'student', '2026-05-08 10:43:18', '2026-05-16 09:58:36'),
(188, 5, 4, 'teacher', '2026-05-16 09:30:46', '2026-05-16 09:30:46'),
(189, 5, 48, 'assistant', '2026-05-16 09:30:46', '2026-05-16 09:30:46'),
(192, 4, 43, 'teacher', '2026-05-16 09:31:46', '2026-05-16 09:31:46'),
(193, 4, 49, 'assistant', '2026-05-16 09:31:46', '2026-05-16 09:31:46'),
(194, 3, 43, 'teacher', '2026-05-16 09:32:34', '2026-05-16 09:32:34'),
(195, 3, 49, 'assistant', '2026-05-16 09:32:34', '2026-05-16 09:32:34'),
(198, 2, 50, 'assistant', '2026-05-16 09:33:39', '2026-05-16 09:33:39'),
(199, 2, 43, 'teacher', '2026-05-16 09:33:39', '2026-05-16 09:33:39'),
(204, 8, 4, 'teacher', '2026-05-16 09:37:32', '2026-05-16 09:37:32'),
(205, 8, 41, 'assistant', '2026-05-16 09:37:32', '2026-05-16 09:37:32'),
(206, 9, 38, 'teacher', '2026-05-16 09:38:00', '2026-05-16 09:38:00'),
(207, 9, 42, 'assistant', '2026-05-16 09:38:00', '2026-05-16 09:38:00'),
(208, 10, 38, 'teacher', '2026-05-16 09:39:30', '2026-05-16 09:39:30'),
(209, 10, 41, 'assistant', '2026-05-16 09:39:30', '2026-05-16 09:39:30'),
(210, 1, 37, 'student', '2026-05-16 09:48:16', '2026-05-18 03:14:54'),
(211, 2, 51, 'student', '2026-05-16 09:58:36', '2026-05-16 09:58:36'),
(212, 3, 57, 'student', '2026-05-16 10:42:31', '2026-05-16 10:42:31'),
(213, 6, 59, 'student', '2026-05-16 11:11:11', '2026-05-16 11:11:11'),
(214, 10, 60, 'student', '2026-05-16 12:30:12', '2026-05-16 12:50:49'),
(217, 10, 63, 'student', '2026-05-16 12:43:17', '2026-05-16 12:50:49'),
(218, 10, 61, 'student', '2026-05-16 12:43:17', '2026-05-16 12:50:49'),
(219, 10, 62, 'student', '2026-05-16 12:43:28', '2026-05-16 12:50:49'),
(220, 4, 65, 'student', '2026-05-16 12:47:13', '2026-05-16 12:47:13'),
(221, 4, 66, 'student', '2026-05-16 12:47:13', '2026-05-16 12:47:13'),
(222, 4, 67, 'student', '2026-05-16 12:47:13', '2026-05-16 12:47:13'),
(223, 4, 64, 'student', '2026-05-16 12:47:13', '2026-05-16 12:47:13'),
(224, 10, 70, 'student', '2026-05-16 12:50:49', '2026-05-16 12:50:49'),
(225, 10, 73, 'student', '2026-05-16 12:50:49', '2026-05-16 12:50:49'),
(226, 10, 69, 'student', '2026-05-16 12:50:49', '2026-05-16 12:50:49'),
(227, 10, 68, 'student', '2026-05-16 12:50:49', '2026-05-16 12:50:49'),
(228, 8, 71, 'student', '2026-05-16 12:51:09', '2026-05-16 12:51:09'),
(229, 8, 72, 'student', '2026-05-16 12:51:09', '2026-05-16 12:51:09'),
(230, 6, 4, 'teacher', '2026-05-16 12:51:48', '2026-05-16 12:51:48'),
(231, 6, 48, 'assistant', '2026-05-16 12:51:48', '2026-05-16 12:51:48'),
(232, 7, 38, 'teacher', '2026-05-16 12:52:00', '2026-05-16 12:52:00'),
(233, 7, 42, 'assistant', '2026-05-16 12:52:00', '2026-05-16 12:52:00'),
(234, 9, 74, 'student', '2026-05-16 12:56:34', '2026-05-16 12:56:34'),
(235, 9, 75, 'student', '2026-05-16 12:56:34', '2026-05-16 12:56:34'),
(236, 5, 78, 'student', '2026-05-16 12:57:46', '2026-05-16 12:57:46'),
(237, 5, 58, 'student', '2026-05-16 12:57:46', '2026-05-16 12:57:46'),
(241, 1, 38, 'teacher', '2026-05-18 14:14:36', '2026-05-18 14:14:36'),
(242, 1, 50, 'assistant', '2026-05-18 14:14:36', '2026-05-18 14:14:36');

--
-- Bẫy `class_user`
--
DELIMITER $$
CREATE TRIGGER `trg_sync_class_user_role` BEFORE INSERT ON `class_user` FOR EACH ROW BEGIN

    DECLARE user_role VARCHAR(20);

    SELECT role
    INTO user_role
    FROM users
    WHERE id = NEW.user_id;

    SET NEW.role = user_role;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `evaluations`
--

CREATE TABLE `evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_ratings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`teacher_ratings`)),
  `course_ratings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`course_ratings`)),
  `personal_satisfaction` int(11) DEFAULT NULL,
  `suggestions` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `evaluation_round_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `evaluations`
--

INSERT INTO `evaluations` (`id`, `student_id`, `teacher_ratings`, `course_ratings`, `personal_satisfaction`, `suggestions`, `submitted_at`, `created_at`, `updated_at`, `evaluation_round_id`) VALUES
(2, 27, '{\"1\":\"5\",\"2\":\"4\",\"3\":\"2\",\"4\":\"3\"}', '{\"1\":\"3\",\"2\":\"3\",\"3\":\"4\",\"4\":\"5\"}', 4, 'Em không có đề xuất gì ạ', '2026-03-29 20:23:55', '2026-03-29 20:23:11', '2026-03-29 20:23:55', 3),
(3, 28, '{\"1\":\"5\",\"2\":\"5\",\"3\":\"5\",\"4\":\"5\",\"5\":\"5\",\"6\":\"5\",\"7\":\"5\"}', '{\"1\":\"4\",\"2\":\"5\",\"3\":\"4\",\"4\":\"4\"}', 5, '', '2026-04-01 12:40:40', '2026-04-01 12:39:52', '2026-04-01 12:40:40', 3),
(4, 30, '{\"1\":\"5\",\"2\":\"4\",\"3\":\"4\",\"4\":\"5\",\"5\":\"5\",\"6\":\"4\",\"7\":\"5\"}', '{\"1\":\"4\",\"2\":\"5\",\"3\":\"5\",\"4\":\"5\"}', 4, '', '2026-04-01 12:41:24', '2026-04-01 12:40:59', '2026-04-01 12:41:24', 3),
(5, 29, '{\"1\":\"5\",\"2\":\"4\",\"3\":\"5\",\"4\":\"5\",\"5\":\"5\",\"6\":\"5\",\"7\":\"5\"}', '{\"1\":\"5\",\"2\":\"5\",\"3\":\"5\",\"4\":\"5\"}', 5, '', '2026-03-30 12:42:01', '2026-03-30 12:41:34', '2026-03-30 12:42:01', 3),
(6, 31, '{\"1\":\"5\",\"2\":\"5\",\"3\":\"5\",\"4\":\"4\",\"5\":\"4\",\"6\":\"4\",\"7\":\"4\"}', '{\"1\":\"4\",\"2\":\"4\",\"3\":\"4\",\"4\":\"4\"}', 4, '', '2026-03-29 12:42:34', '2026-03-29 12:42:12', '2026-03-29 12:42:34', 3),
(7, 27, '{\"1\":\"5\",\"2\":\"4\",\"3\":\"5\",\"4\":\"4\",\"5\":\"4\",\"6\":\"5\",\"7\":\"3\"}', '{\"1\":\"3\",\"2\":\"4\",\"3\":\"3\",\"4\":\"4\"}', 5, '', '2026-05-01 12:52:32', '2026-05-01 12:52:11', '2026-05-01 12:52:32', 4),
(8, 28, '{\"1\":\"5\",\"2\":\"5\",\"3\":\"3\",\"4\":\"3\",\"5\":\"3\",\"6\":\"3\",\"7\":\"3\"}', '{\"1\":\"5\",\"2\":\"4\",\"3\":\"4\",\"4\":\"4\"}', 4, '', '2026-05-01 12:53:06', '2026-05-01 12:52:47', '2026-05-01 12:53:06', 4),
(9, 30, '{\"1\":\"5\",\"2\":\"5\",\"3\":\"5\",\"4\":\"4\",\"5\":\"5\",\"6\":\"4\",\"7\":\"5\"}', '{\"1\":\"5\",\"2\":\"2\",\"3\":\"5\",\"4\":\"2\"}', 4, '', '2026-05-03 12:53:38', '2026-05-03 12:53:16', '2026-05-03 12:53:38', 4),
(10, 29, '{\"1\":\"5\",\"2\":\"4\",\"3\":\"5\",\"4\":\"5\",\"5\":\"4\",\"6\":\"4\",\"7\":\"4\"}', '{\"1\":\"5\",\"2\":\"5\",\"3\":\"5\",\"4\":\"5\"}', 5, '', '2026-05-02 12:54:03', '2026-05-02 12:53:47', '2026-05-02 12:54:03', 4),
(11, 31, '{\"1\":\"3\",\"2\":\"4\",\"3\":\"3\",\"4\":\"4\",\"5\":\"5\",\"6\":\"3\",\"7\":\"4\"}', '{\"1\":\"4\",\"2\":\"5\",\"3\":\"5\",\"4\":\"5\"}', 4, '', '2026-05-03 12:54:29', '2026-05-03 12:54:12', '2026-05-03 12:54:29', 4),
(13, 28, '[]', '[]', NULL, '', NULL, '2026-05-11 15:41:38', '2026-05-11 15:41:38', 5),
(14, 31, '{\"1\":\"4\",\"2\":\"3\",\"3\":\"4\",\"4\":\"2\",\"5\":\"3\",\"6\":\"2\",\"7\":\"5\"}', '{\"1\":\"4\",\"2\":\"4\",\"3\":\"4\",\"4\":\"3\"}', 4, 'không ạ', '2026-05-12 04:21:50', '2026-05-12 04:21:26', '2026-05-12 04:21:50', 5),
(15, 27, '{\"1\":\"4\",\"2\":\"3\",\"3\":\"5\",\"4\":\"4\",\"5\":\"5\",\"6\":\"4\",\"7\":\"4\"}', '{\"1\":\"4\",\"2\":\"4\",\"3\":\"3\",\"4\":\"5\"}', 4, '', '2026-05-15 13:52:23', '2026-05-15 13:43:40', '2026-05-15 13:52:23', 5),
(16, 32, '[]', '[]', NULL, '', NULL, '2026-05-16 09:58:58', '2026-05-16 09:58:58', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `evaluation_questions`
--

CREATE TABLE `evaluation_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `evaluation_questions`
--

INSERT INTO `evaluation_questions` (`id`, `category`, `question`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'course', 'Em đánh giá khoá học này của trung tâm như thế nào?', 1, 1, '2026-03-23 08:15:03', '2026-05-07 20:42:48'),
(3, 'teacher', 'Cảm nhận của em về thầy/cô ở trung tâm SMASH như thế nào?', 2, 1, '2026-03-23 08:15:46', '2026-03-23 08:15:46'),
(4, 'course', 'Nội dung khóa học có phù hợp với mục tiêu học tập không?', 1, 1, '2026-05-07 20:02:02', '2026-05-07 20:02:02'),
(5, 'course', 'Tài liệu học tập có đầy đủ và chất lượng tốt không?', 2, 1, '2026-05-07 20:02:02', '2026-05-07 20:02:02'),
(6, 'course', 'Thời gian học tập có hợp lý và hiệu quả không?', 3, 1, '2026-05-07 20:02:02', '2026-05-07 20:02:02'),
(7, 'course', 'Cơ sở vật chất và trang thiết bị có đáp ứng nhu cầu học tập không?', 4, 1, '2026-05-07 20:02:02', '2026-05-07 20:02:02'),
(8, 'personal', 'Bạn có hài lòng với chất lượng học tập tại trung tâm không?', 1, 1, '2026-05-07 20:02:02', '2026-05-07 20:38:34'),
(9, 'teacher', 'Giáo viên/Trợ giảng có nhiệt tình và tạo không khí học tập tích cực không?', 1, 1, '2026-05-07 20:02:02', '2026-05-07 20:43:00'),
(10, 'teacher', 'Giáo viên/Trợ giảng có sẵn sàng giải đáp thắc mắc và hỗ trợ học viên không?', 2, 1, '2026-05-07 20:02:02', '2026-05-07 20:43:17'),
(11, 'teacher', 'Giáo viên/Trợ giảng có sử dụng phương pháp giảng dạy hiệu quả và phù hợp không?', 3, 1, '2026-05-07 20:02:02', '2026-05-07 20:43:25'),
(12, 'teacher', 'Giáo viên/Trợ giảng có đánh giá công bằng và khách quan không?', 4, 1, '2026-05-07 20:02:02', '2026-05-07 20:43:42'),
(13, 'teacher', 'Giáo viên/Trợ giảng có nhiệt tình và tạo môi trường học tích cực không?', 5, 1, '2026-05-07 20:02:02', '2026-05-07 20:44:23'),
(14, 'teacher', 'Giáo viên/Trợ giảng có giải đáp thắc mắc kịp thời và đầy đủ không?', 6, 1, '2026-05-07 20:02:02', '2026-05-07 20:44:26'),
(15, 'teacher', 'Phương pháp giảng dạy của giáo viên có phù hợp và hiệu quả không?', 7, 1, '2026-05-07 20:02:02', '2026-05-07 20:44:29'),
(16, 'teacher', 'Giáo viên/Trợ giảng đánh giá kết quả học tập công bằng và khách quan chứ?', 8, 0, '2026-05-07 20:02:02', '2026-05-07 20:44:17'),
(17, 'course', 'Tài liệu và giáo trình có đầy đủ, dễ hiểu, cập nhật không?', 5, 0, '2026-05-07 20:02:02', '2026-05-07 20:44:40'),
(18, 'course', 'Bài tập và kiểm tra có hợp lý, phản ánh đúng kiến thức không?', 6, 0, '2026-05-07 20:02:02', '2026-05-07 20:44:37'),
(19, 'course', 'Cơ sở vật chất và hạ tầng kỹ thuật có đáp ứng nhu cầu học tập không?', 7, 0, '2026-05-07 20:02:02', '2026-05-07 20:02:02'),
(20, 'course', 'Giáo trình và tài liệu học tập có rõ ràng, dễ hiểu không?', 8, 0, '2026-05-07 20:02:02', '2026-05-07 20:02:02'),
(21, 'course', 'Cấu trúc buổi học có hợp lý và dễ theo dõi không?', 9, 0, '2026-05-07 20:02:02', '2026-05-07 20:02:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `evaluation_rounds`
--

CREATE TABLE `evaluation_rounds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `evaluation_rounds`
--

INSERT INTO `evaluation_rounds` (`id`, `name`, `description`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Đợt đánh giá tháng 3/2026', '', '2026-03-29', '2026-04-02', 0, '2026-03-28 20:22:18', '2026-05-11 15:31:11'),
(4, 'Đợt đánh giá tháng 4/2026', '', '2026-04-30', '2026-05-04', 0, '2026-04-29 12:51:51', '2026-05-16 12:58:14'),
(5, 'Đợt đánh giá tháng 5/2026', '', '2026-05-18', '2026-05-30', 0, '2026-05-11 15:07:15', '2026-05-18 03:03:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'salary',
  `note` text DEFAULT NULL,
  `spent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `expenses`
--

INSERT INTO `expenses` (`id`, `staff_id`, `class_id`, `amount`, `type`, `note`, `spent_at`, `created_at`, `updated_at`) VALUES
(2, 4, NULL, 2904795.00, 'utility', 'Phí vệ sinh và dọn dẹp', '2025-10-09 18:23:34', '2026-01-29 07:04:58', '2026-01-29 07:04:58'),
(3, 4, NULL, 15447164.00, 'rent', 'Tiền thuê văn phòng', '2025-08-09 19:11:03', '2026-01-29 07:04:58', '2026-01-29 07:04:58'),
(8, 4, NULL, 1270659.00, 'marketing', 'Tham gia hội chợ giáo dục - Et voluptatem officia eaque quia et enim.', '2025-12-17 05:47:35', '2026-01-29 07:04:58', '2026-01-29 07:04:58'),
(21, 38, 8, 500000.00, 'marketing', '', '2026-03-20 17:00:00', '2026-03-21 07:20:56', '2026-03-21 07:20:56'),
(23, 4, 1, 5000000.00, 'utilities', '', '2026-05-09 17:00:00', '2026-05-10 06:57:37', '2026-05-10 06:57:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `grade_type` enum('homework','minitest','monthly_exam') NOT NULL,
  `assignment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `score` decimal(5,2) NOT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `graded_at` datetime DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `class_id`, `grade_type`, `assignment_id`, `score`, `teacher_id`, `graded_at`, `feedback`, `created_at`, `updated_at`) VALUES
(83, 30, 1, 'homework', 53, 9.00, 50, NULL, NULL, '2026-05-16 14:11:46', '2026-05-16 14:11:46'),
(84, 12, 1, 'homework', 53, 8.00, 50, NULL, NULL, '2026-05-16 14:11:46', '2026-05-16 14:11:46'),
(85, 34, 1, 'homework', 53, 6.00, 50, NULL, NULL, '2026-05-16 14:11:46', '2026-05-16 14:11:46'),
(86, 45, 1, 'homework', 53, 9.00, 50, NULL, NULL, '2026-05-16 14:11:46', '2026-05-16 14:11:46'),
(87, 47, 1, 'homework', 53, 10.00, 50, NULL, NULL, '2026-05-16 14:11:46', '2026-05-16 14:11:46'),
(88, 31, 1, 'homework', 52, 9.00, 50, NULL, NULL, '2026-05-16 14:15:40', '2026-05-16 14:15:40'),
(89, 13, 1, 'homework', 52, 9.00, 50, NULL, NULL, '2026-05-16 14:15:40', '2026-05-16 14:15:40'),
(90, 12, 1, 'homework', 52, 8.00, 50, NULL, NULL, '2026-05-16 14:15:40', '2026-05-16 14:15:40'),
(91, 34, 1, 'homework', 52, 10.00, 50, NULL, NULL, '2026-05-16 14:15:40', '2026-05-16 14:15:40'),
(92, 45, 1, 'homework', 52, 6.00, 50, NULL, NULL, '2026-05-16 14:15:40', '2026-05-16 14:15:40'),
(93, 47, 1, 'homework', 52, 7.00, 50, NULL, NULL, '2026-05-16 14:15:40', '2026-05-16 14:15:40'),
(94, 37, 1, 'homework', 52, 9.00, 50, NULL, NULL, '2026-05-16 14:15:40', '2026-05-16 14:15:40'),
(95, 13, 1, 'homework', 51, 8.00, 50, NULL, NULL, '2026-05-16 14:17:33', '2026-05-16 14:17:33'),
(96, 30, 1, 'homework', 51, 9.50, 50, NULL, NULL, '2026-05-16 14:17:33', '2026-05-16 14:17:33'),
(97, 12, 1, 'homework', 51, 8.00, 50, NULL, NULL, '2026-05-16 14:17:33', '2026-05-16 14:17:33'),
(98, 34, 1, 'homework', 51, 10.00, 50, NULL, NULL, '2026-05-16 14:17:33', '2026-05-16 14:17:33'),
(99, 45, 1, 'homework', 51, 6.00, 50, NULL, NULL, '2026-05-16 14:17:33', '2026-05-16 14:17:33'),
(100, 47, 1, 'homework', 51, 8.50, 50, NULL, NULL, '2026-05-16 14:17:33', '2026-05-16 14:17:33'),
(101, 37, 1, 'homework', 51, 7.50, 50, NULL, NULL, '2026-05-16 14:17:33', '2026-05-16 14:17:33'),
(102, 31, 1, 'homework', 50, 9.00, 50, NULL, NULL, '2026-05-16 14:19:00', '2026-05-16 14:19:00'),
(103, 13, 1, 'homework', 50, 10.00, 50, NULL, NULL, '2026-05-16 14:19:00', '2026-05-16 14:19:00'),
(104, 30, 1, 'homework', 50, 8.75, 50, NULL, NULL, '2026-05-16 14:19:00', '2026-05-16 14:19:00'),
(105, 12, 1, 'homework', 50, 8.50, 50, NULL, NULL, '2026-05-16 14:19:00', '2026-05-16 14:19:00'),
(106, 34, 1, 'homework', 50, 8.75, 50, NULL, NULL, '2026-05-16 14:19:00', '2026-05-16 14:19:00'),
(107, 45, 1, 'homework', 50, 8.00, 50, NULL, NULL, '2026-05-16 14:19:00', '2026-05-16 14:19:00'),
(108, 47, 1, 'homework', 50, 7.75, 50, NULL, NULL, '2026-05-16 14:19:00', '2026-05-16 14:19:00'),
(109, 37, 1, 'homework', 50, 10.00, 50, '2026-04-12 00:00:00', NULL, '2026-05-16 14:19:00', '2026-05-16 14:23:27'),
(110, 31, 1, 'homework', 54, 6.00, 50, NULL, NULL, '2026-05-16 14:20:28', '2026-05-16 14:20:28'),
(111, 13, 1, 'homework', 54, 9.00, 50, NULL, NULL, '2026-05-16 14:20:28', '2026-05-16 14:20:28'),
(112, 30, 1, 'homework', 54, 8.00, 50, NULL, NULL, '2026-05-16 14:20:28', '2026-05-16 14:20:28'),
(113, 12, 1, 'homework', 54, 7.75, 50, NULL, NULL, '2026-05-16 14:20:28', '2026-05-16 14:20:28'),
(114, 45, 1, 'homework', 54, 5.50, 50, NULL, NULL, '2026-05-16 14:20:28', '2026-05-16 14:20:28'),
(115, 47, 1, 'homework', 54, 9.00, 50, NULL, NULL, '2026-05-16 14:20:28', '2026-05-16 14:20:28'),
(116, 37, 1, 'homework', 54, 8.00, 50, NULL, NULL, '2026-05-16 14:20:28', '2026-05-16 14:20:28'),
(200, 12, 1, 'minitest', NULL, 8.50, 50, '2026-04-05 08:20:00', 'Làm bài tốt.', '2026-04-05 01:20:00', '2026-04-05 01:20:00'),
(201, 13, 1, 'minitest', NULL, 7.25, 50, '2026-04-05 08:21:00', 'Có cố gắng.', '2026-04-05 01:21:00', '2026-04-05 01:21:00'),
(202, 30, 1, 'minitest', NULL, 9.00, 50, '2026-04-05 08:22:00', 'Hoàn thành tốt.', '2026-04-05 01:22:00', '2026-04-05 01:22:00'),
(203, 31, 1, 'minitest', NULL, 6.50, 50, '2026-04-05 08:23:00', 'Cần chú ý trình bày.', '2026-04-05 01:23:00', '2026-04-05 01:23:00'),
(204, 34, 1, 'minitest', NULL, 8.75, 50, '2026-04-05 08:24:00', 'Bài làm khá tốt.', '2026-04-05 01:24:00', '2026-04-05 01:24:00'),
(205, 37, 1, 'minitest', NULL, 7.00, 50, '2026-04-05 08:25:00', 'Cần luyện thêm.', '2026-04-05 01:25:00', '2026-04-05 01:25:00'),
(206, 45, 1, 'minitest', NULL, 9.50, 50, '2026-04-05 08:26:00', 'Làm bài xuất sắc.', '2026-04-05 01:26:00', '2026-04-05 01:26:00'),
(207, 47, 1, 'minitest', NULL, 8.25, 50, '2026-04-05 08:27:00', 'Có tiến bộ.', '2026-04-05 01:27:00', '2026-04-05 01:27:00'),
(208, 12, 1, 'minitest', NULL, 7.50, 50, '2026-04-12 08:20:00', 'Hoàn thành ổn.', '2026-04-12 01:20:00', '2026-04-12 01:20:00'),
(209, 13, 1, 'minitest', NULL, 8.00, 50, '2026-04-12 08:21:00', 'Làm bài khá tốt.', '2026-04-12 01:21:00', '2026-04-12 01:21:00'),
(210, 30, 1, 'minitest', NULL, 9.25, 50, '2026-04-12 08:22:00', 'Nắm chắc kiến thức.', '2026-04-12 01:22:00', '2026-04-12 01:22:00'),
(211, 34, 1, 'minitest', NULL, 6.75, 50, '2026-04-12 08:23:00', 'Cần cẩn thận hơn.', '2026-04-12 01:23:00', '2026-04-12 01:23:00'),
(212, 37, 1, 'minitest', NULL, 8.50, 50, '2026-04-12 08:24:00', 'Hoàn thành đầy đủ.', '2026-04-12 01:24:00', '2026-04-12 01:24:00'),
(213, 45, 1, 'minitest', NULL, 9.75, 50, '2026-04-12 08:25:00', 'Kết quả rất tốt.', '2026-04-12 01:25:00', '2026-04-12 01:25:00'),
(214, 47, 1, 'minitest', NULL, 7.25, 50, '2026-04-12 08:26:00', 'Cần tự tin hơn.', '2026-04-12 01:26:00', '2026-04-12 01:26:00'),
(215, 12, 1, 'minitest', NULL, 8.00, 50, '2026-04-19 08:20:00', 'Làm bài tốt.', '2026-04-19 01:20:00', '2026-04-19 01:20:00'),
(216, 13, 1, 'minitest', NULL, 7.50, 50, '2026-04-19 08:21:00', 'Có tiến bộ.', '2026-04-19 01:21:00', '2026-04-19 01:21:00'),
(217, 31, 1, 'minitest', NULL, 6.75, 50, '2026-04-19 08:22:00', 'Cần ôn thêm.', '2026-04-19 01:22:00', '2026-04-19 01:22:00'),
(218, 34, 1, 'minitest', NULL, 8.50, 50, '2026-04-19 08:23:00', 'Hoàn thành khá tốt.', '2026-04-19 01:23:00', '2026-04-19 01:23:00'),
(219, 37, 1, 'minitest', NULL, 7.75, 50, '2026-04-19 08:24:00', 'Trình bày rõ ràng.', '2026-04-19 01:24:00', '2026-04-19 01:24:00'),
(220, 45, 1, 'minitest', NULL, 9.25, 50, '2026-04-19 08:25:00', 'Làm bài rất tốt.', '2026-04-19 01:25:00', '2026-04-19 01:25:00'),
(221, 47, 1, 'minitest', NULL, 8.00, 50, '2026-04-19 08:26:00', 'Có cố gắng.', '2026-04-19 01:26:00', '2026-04-19 01:26:00'),
(222, 12, 1, 'minitest', NULL, 8.25, 50, '2026-04-26 08:20:00', 'Hoàn thành tốt.', '2026-04-26 01:20:00', '2026-04-26 01:20:00'),
(223, 30, 1, 'minitest', NULL, 9.00, 50, '2026-04-26 08:21:00', 'Làm bài chính xác.', '2026-04-26 01:21:00', '2026-04-26 01:21:00'),
(224, 34, 1, 'minitest', NULL, 7.50, 50, '2026-04-26 08:22:00', 'Cần luyện thêm.', '2026-04-26 01:22:00', '2026-04-26 01:22:00'),
(225, 45, 1, 'minitest', NULL, 9.50, 50, '2026-04-26 08:23:00', 'Hoàn thành xuất sắc.', '2026-04-26 01:23:00', '2026-04-26 01:23:00'),
(226, 47, 1, 'minitest', NULL, 8.50, 50, '2026-04-26 08:24:00', 'Bài làm khá tốt.', '2026-04-26 01:24:00', '2026-04-26 01:24:00'),
(227, 12, 1, 'minitest', NULL, 8.75, 50, '2026-05-03 08:20:00', 'Có tiến bộ.', '2026-05-03 01:20:00', '2026-05-03 01:20:00'),
(228, 13, 1, 'minitest', NULL, 7.00, 50, '2026-05-03 08:21:00', 'Cần chú ý phép tính.', '2026-05-03 01:21:00', '2026-05-03 01:21:00'),
(229, 30, 1, 'minitest', NULL, 9.25, 50, '2026-05-03 08:22:00', 'Làm bài tốt.', '2026-05-03 01:22:00', '2026-05-03 01:22:00'),
(230, 31, 1, 'minitest', NULL, 6.50, 50, '2026-05-03 08:23:00', 'Cần ôn lại kiến thức.', '2026-05-03 01:23:00', '2026-05-03 01:23:00'),
(231, 37, 1, 'minitest', NULL, 8.00, 50, '2026-05-03 08:24:00', 'Hoàn thành ổn.', '2026-05-03 01:24:00', '2026-05-03 01:24:00'),
(232, 45, 1, 'minitest', NULL, 9.75, 50, '2026-05-03 08:25:00', 'Rất xuất sắc.', '2026-05-03 01:25:00', '2026-05-03 01:25:00'),
(233, 47, 1, 'minitest', NULL, 7.75, 50, '0000-00-00 00:00:00', '2026-05-03 08:26:00', '2026-05-03 01:26:00', '2026-05-03 01:26:00'),
(234, 12, 1, 'minitest', NULL, 8.50, 50, '2026-05-10 08:20:00', 'Hoàn thành tốt.', '2026-05-10 01:20:00', '2026-05-10 01:20:00'),
(235, 13, 1, 'minitest', NULL, 7.25, 50, '2026-05-10 08:21:00', 'Cần tự tin hơn.', '2026-05-10 01:21:00', '2026-05-10 01:21:00'),
(236, 30, 1, 'minitest', NULL, 8.00, 50, '2026-05-10 08:22:00', 'Làm bài xuất sắc.', '2026-05-10 01:22:00', '2026-05-17 11:53:43'),
(237, 31, 1, 'minitest', NULL, 6.75, 50, '2026-05-10 08:23:00', 'Cần luyện thêm.', '2026-05-10 01:23:00', '2026-05-10 01:23:00'),
(238, 34, 1, 'minitest', NULL, 8.25, 50, '2026-05-10 08:24:00', 'Hoàn thành khá tốt.', '2026-05-10 01:24:00', '2026-05-10 01:24:00'),
(239, 37, 1, 'minitest', NULL, 7.50, 50, '2026-05-10 08:25:00', 'Có tiến bộ.', '2026-05-10 01:25:00', '2026-05-10 01:25:00'),
(240, 45, 1, 'minitest', NULL, 9.00, 50, '2026-05-10 08:26:00', 'Kết quả tốt.', '2026-05-10 01:26:00', '2026-05-10 01:26:00'),
(241, 47, 1, 'minitest', NULL, 8.00, 50, '2026-05-10 08:27:00', 'Bài làm ổn định.', '2026-05-10 01:27:00', '2026-05-10 01:27:00'),
(242, 12, 1, 'monthly_exam', NULL, 8.75, 38, '2026-04-26 09:00:00', 'Làm bài tốt, nắm chắc kiến thức.', '2026-04-26 02:00:00', '2026-04-26 02:00:00'),
(243, 30, 1, 'monthly_exam', NULL, 9.50, 38, '2026-04-26 09:05:00', 'Hoàn thành bài thi xuất sắc.', '2026-04-26 02:05:00', '2026-04-26 02:05:00'),
(244, 34, 1, 'monthly_exam', NULL, 7.25, 38, '2026-04-26 09:10:00', 'Cần cải thiện phần trình bày.', '2026-04-26 02:10:00', '2026-04-26 02:10:00'),
(245, 45, 1, 'monthly_exam', NULL, 9.00, 38, '2026-04-26 09:15:00', 'Kết quả rất tốt.', '2026-04-26 02:15:00', '2026-04-26 02:15:00'),
(246, 47, 1, 'monthly_exam', NULL, 8.00, 38, '2026-04-26 09:20:00', 'Hoàn thành đầy đủ yêu cầu.', '2026-04-26 02:20:00', '2026-04-26 02:20:00'),
(247, 31, 1, 'homework', 41, 9.00, NULL, NULL, NULL, '2026-05-17 10:14:48', '2026-05-17 10:14:48'),
(248, 13, 1, 'homework', 41, 9.50, NULL, NULL, NULL, '2026-05-17 10:14:48', '2026-05-17 10:14:48'),
(249, 30, 1, 'homework', 41, 8.50, NULL, NULL, NULL, '2026-05-17 10:14:48', '2026-05-17 10:14:48'),
(250, 12, 1, 'homework', 41, 8.75, NULL, NULL, NULL, '2026-05-17 10:14:48', '2026-05-17 10:14:48'),
(251, 34, 1, 'homework', 41, 8.25, NULL, NULL, NULL, '2026-05-17 10:14:48', '2026-05-17 10:14:48'),
(252, 45, 1, 'homework', 41, 8.00, NULL, NULL, NULL, '2026-05-17 10:14:48', '2026-05-17 10:14:48'),
(253, 47, 1, 'homework', 41, 9.25, NULL, NULL, NULL, '2026-05-17 10:14:48', '2026-05-17 10:14:48'),
(254, 37, 1, 'homework', 41, 8.75, NULL, NULL, NULL, '2026-05-17 10:14:48', '2026-05-17 10:14:48'),
(255, 31, 1, 'homework', 40, 8.75, NULL, NULL, 'Hoàn thành tốt', '2026-05-17 10:16:32', '2026-05-17 10:16:32'),
(256, 13, 1, 'homework', 40, 9.00, NULL, NULL, 'Tiếp tục phát huy', '2026-05-17 10:16:32', '2026-05-17 10:16:32'),
(257, 30, 1, 'homework', 40, 10.00, NULL, NULL, 'Hoàn thành tốt. Tiếp tục phát huy!', '2026-05-17 10:16:32', '2026-05-17 10:16:32'),
(258, 12, 1, 'homework', 40, 8.50, NULL, NULL, 'Có cố gắng!', '2026-05-17 10:16:32', '2026-05-17 10:16:32'),
(259, 34, 1, 'homework', 40, 8.75, NULL, NULL, NULL, '2026-05-17 10:16:32', '2026-05-17 10:16:32'),
(260, 45, 1, 'homework', 40, 9.00, NULL, NULL, NULL, '2026-05-17 10:16:32', '2026-05-17 10:16:32'),
(261, 47, 1, 'homework', 40, 9.25, NULL, NULL, NULL, '2026-05-17 10:16:32', '2026-05-17 10:16:32'),
(262, 37, 1, 'homework', 40, 9.50, NULL, NULL, NULL, '2026-05-17 10:16:32', '2026-05-17 10:16:32'),
(263, 31, 1, 'homework', 39, 10.00, NULL, NULL, NULL, '2026-05-17 10:17:21', '2026-05-17 10:17:21'),
(264, 13, 1, 'homework', 39, 9.00, NULL, NULL, NULL, '2026-05-17 10:17:21', '2026-05-17 10:17:21'),
(265, 30, 1, 'homework', 39, 9.50, NULL, NULL, NULL, '2026-05-17 10:17:21', '2026-05-17 10:17:21'),
(266, 12, 1, 'homework', 39, 8.75, NULL, NULL, NULL, '2026-05-17 10:17:21', '2026-05-17 10:17:21'),
(267, 34, 1, 'homework', 39, 9.00, NULL, NULL, NULL, '2026-05-17 10:17:21', '2026-05-17 10:17:21'),
(268, 45, 1, 'homework', 39, 9.50, NULL, NULL, NULL, '2026-05-17 10:17:21', '2026-05-17 10:17:21'),
(269, 47, 1, 'homework', 39, 8.50, NULL, NULL, NULL, '2026-05-17 10:17:21', '2026-05-17 10:17:21'),
(270, 37, 1, 'homework', 39, 10.00, NULL, NULL, NULL, '2026-05-17 10:17:21', '2026-05-17 10:17:21'),
(271, 31, 1, 'homework', 55, 7.00, NULL, NULL, 'Còn cẩu thả, học sinh chú ý cách trình bày', '2026-05-17 10:18:16', '2026-05-17 10:18:16'),
(272, 13, 1, 'homework', 55, 8.00, NULL, NULL, NULL, '2026-05-17 10:18:16', '2026-05-17 10:18:16'),
(273, 30, 1, 'homework', 55, 8.50, NULL, NULL, NULL, '2026-05-17 10:18:16', '2026-05-17 10:18:16'),
(274, 12, 1, 'homework', 55, 9.00, NULL, NULL, NULL, '2026-05-17 10:18:16', '2026-05-17 10:18:16'),
(275, 34, 1, 'homework', 55, 8.25, NULL, NULL, NULL, '2026-05-17 10:18:16', '2026-05-17 10:18:16'),
(276, 45, 1, 'homework', 55, 9.00, NULL, NULL, NULL, '2026-05-17 10:18:16', '2026-05-17 10:18:16'),
(277, 47, 1, 'homework', 55, 9.25, NULL, NULL, NULL, '2026-05-17 10:18:16', '2026-05-17 10:18:16'),
(278, 37, 1, 'homework', 55, 9.50, NULL, NULL, NULL, '2026-05-17 10:18:16', '2026-05-17 10:18:16'),
(279, 60, 10, 'homework', 66, 9.00, NULL, NULL, NULL, '2026-05-17 10:19:03', '2026-05-17 10:19:03'),
(280, 63, 10, 'homework', 66, 9.00, NULL, NULL, NULL, '2026-05-17 10:19:03', '2026-05-17 10:19:03'),
(281, 61, 10, 'homework', 66, 9.50, NULL, NULL, NULL, '2026-05-17 10:19:03', '2026-05-17 10:19:03'),
(282, 62, 10, 'homework', 66, 8.00, NULL, NULL, NULL, '2026-05-17 10:19:03', '2026-05-17 10:19:03'),
(283, 70, 10, 'homework', 66, 8.50, NULL, NULL, NULL, '2026-05-17 10:19:03', '2026-05-17 10:19:03'),
(284, 73, 10, 'homework', 66, 8.80, NULL, NULL, NULL, '2026-05-17 10:19:04', '2026-05-17 10:19:04'),
(285, 69, 10, 'homework', 66, 9.60, NULL, NULL, NULL, '2026-05-17 10:19:04', '2026-05-17 10:19:04'),
(286, 68, 10, 'homework', 66, 10.00, NULL, NULL, NULL, '2026-05-17 10:19:04', '2026-05-17 10:19:04'),
(287, 37, 1, 'monthly_exam', NULL, 9.00, 38, '2026-04-26 00:00:00', 'Làm bài tốt. Nắm chắc kiến thức, vận dụng tốt. Tiếp tục phát huy!', '2026-05-17 10:24:48', '2026-05-17 10:24:48'),
(288, 13, 1, 'monthly_exam', NULL, 8.00, 38, '2026-04-26 00:00:00', 'Còn cẩu thả trong cách trình bày, học sinh cần chú ý cẩn thận hơn.', '2026-05-17 10:26:03', '2026-05-17 10:26:03'),
(289, 31, 1, 'monthly_exam', NULL, 7.50, 38, '2026-04-26 00:00:00', NULL, '2026-05-17 10:26:42', '2026-05-17 10:26:42'),
(290, 69, 10, 'minitest', NULL, 8.00, 38, '2026-05-02 00:00:00', NULL, '2026-05-17 10:27:16', '2026-05-17 10:27:16'),
(291, 69, 10, 'monthly_exam', NULL, 7.50, 38, '2026-04-29 00:00:00', '', '2026-05-17 10:28:00', '2026-05-17 10:28:00'),
(292, 69, 10, 'minitest', NULL, 8.00, 38, '2026-04-15 00:00:00', NULL, '2026-05-17 10:28:36', '2026-05-17 10:28:36'),
(293, 69, 10, 'minitest', NULL, 8.50, 38, '2026-05-05 00:00:00', 'Có tiến bộ', '2026-05-17 10:29:12', '2026-05-17 10:29:12'),
(294, 69, 10, 'minitest', NULL, 8.25, 38, '2026-04-17 00:00:00', NULL, '2026-05-17 10:29:35', '2026-05-17 10:29:35'),
(295, 61, 10, 'minitest', NULL, 8.00, 38, '2026-04-15 00:00:00', NULL, '2026-05-17 10:30:46', '2026-05-17 10:30:46'),
(296, 61, 10, 'minitest', NULL, 9.00, 38, '2026-04-17 00:00:00', 'Làm bài tốt, trình bày sạch, logic rõ ràng.', '2026-05-17 10:31:36', '2026-05-17 10:31:36'),
(297, 61, 10, 'monthly_exam', NULL, 8.75, 38, '2026-04-29 00:00:00', NULL, '2026-05-17 10:32:50', '2026-05-17 10:32:50'),
(298, 61, 10, 'minitest', NULL, 8.25, 38, '2026-05-02 00:00:00', NULL, '2026-05-17 10:33:14', '2026-05-17 10:33:14'),
(299, 61, 10, 'minitest', NULL, 8.50, 38, '2026-05-05 00:00:00', NULL, '2026-05-17 10:33:28', '2026-05-17 10:33:28'),
(300, 70, 10, 'minitest', NULL, 9.00, 38, '2026-05-18 00:00:00', NULL, '2026-05-18 14:18:07', '2026-05-18 14:18:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `classroom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lessons`
--

INSERT INTO `lessons` (`id`, `number`, `title`, `description`, `content`, `attachment`, `video`, `classroom_id`, `created_at`, `updated_at`) VALUES
(50, 'Bài 1', 'Hệ phương trình bậc nhất hai ẩn', 'Giới thiệu phương pháp giải hệ phương trình', 'Ôn tập khái niệm hệ phương trình bậc nhất hai ẩn. Hướng dẫn học sinh giải hệ bằng phương pháp thế và cộng đại số. Luyện tập các dạng bài từ cơ bản đến nâng cao và áp dụng vào bài toán thực tế.', NULL, NULL, 10, '2026-03-02 04:00:00', '2026-03-02 04:00:00'),
(51, 'Bài 2', 'Đồ thị hàm số y = ax + b', 'Tìm hiểu đồ thị hàm số bậc nhất', 'Học sinh tìm hiểu cách xác định hệ số a, b và ý nghĩa hình học của chúng. Thực hành vẽ đồ thị trên mặt phẳng tọa độ và phân tích tính đồng biến của hàm số.', NULL, NULL, 10, '2026-03-08 04:00:00', '2026-03-08 04:00:00'),
(52, 'Bài 3', 'Phương trình bậc hai', 'Giải phương trình bằng công thức nghiệm', 'Giới thiệu công thức nghiệm của phương trình bậc hai một ẩn. Học sinh luyện tập giải các bài toán với nhiều trường hợp delta khác nhau.', NULL, NULL, 10, '2026-03-15 04:00:00', '2026-03-15 04:00:00'),
(53, 'Bài 4', 'Tỉ số lượng giác của góc nhọn', 'Sin, cos, tan và cot', 'Học sinh luyện tập sử dụng các tỉ số lượng giác trong tam giác vuông để tính cạnh và góc. Kết hợp sử dụng máy tính cầm tay giải bài tập.', NULL, NULL, 10, '2026-03-29 04:00:00', '2026-03-29 04:00:00'),
(54, 'Bài 5', 'Tổng hợp kiến thức Đại số và Hình học', '<p>B&agrave;i học gi&uacute;p học sinh tổng hợp v&agrave; li&ecirc;n kết c&aacute;c kiến thức trọng t&acirc;m của phần Đại số v&agrave; H&igrave;nh học đ&atilde; học trong chương tr&igrave;nh, từ đ&oacute; n&acirc;ng cao khả năng vận dụng kiến thức v&agrave;o giải b&agrave;i tập tổng hợp.</p>\n\n<p>Nội dung b&agrave;i học bao gồm:<br />\n- &Ocirc;n tập c&aacute;c ph&eacute;p t&iacute;nh v&agrave; biểu thức Đại số cơ bản<br />\n- Củng cố kiến thức về tỉ số, phần trăm v&agrave; ph&acirc;n số<br />\n- Hệ thống lại c&aacute;c c&ocirc;ng thức H&igrave;nh học quan trọng<br />\n- Nhận biết v&agrave; vận dụng c&aacute;c dạng b&agrave;i tập h&igrave;nh học cơ bản<br />\n- Kết hợp kiến thức Đại số v&agrave; H&igrave;nh học trong b&agrave;i to&aacute;n thực tế</p>\n\n<p>Mục ti&ecirc;u b&agrave;i học:<br />\n- Nắm vững kiến thức nền tảng của Đại số v&agrave; H&igrave;nh học<br />\n- Biết vận dụng c&ocirc;ng thức v&agrave;o giải b&agrave;i tập<br />\n- Ph&aacute;t triển kỹ năng tư duy logic v&agrave; ph&acirc;n t&iacute;ch b&agrave;i to&aacute;n<br />\n- Chuẩn bị cho c&aacute;c b&agrave;i kiểm tra v&agrave; đ&aacute;nh gi&aacute; cuối k&igrave;</p>\n\n<p>Hoạt động luyện tập:<br />\n1. Giải b&agrave;i tập Đại số tổng hợp<br />\n2. T&iacute;nh chu vi, diện t&iacute;ch c&aacute;c h&igrave;nh cơ bản<br />\n3. Vận dụng phần trăm v&agrave; tỉ số v&agrave;o b&agrave;i to&aacute;n thực tế<br />\n4. Thực h&agrave;nh đề luyện tập tổng hợp</p>\n', 'Hệ thống lại toàn bộ kiến thức trọng tâm lớp 9, luyện đề tổng hợp và chữa đề chi tiết nhằm chuẩn bị cho bài kiểm tra học kì.', 'lessons/attachments/fr7m9W5icfctf4ZvIFFOc0qRJjRfKbbhZLLSauBr.docx', 'https://www.youtube.com/watch?v=mfFSDfrmNj8', 10, '2026-04-26 04:00:00', '2026-05-17 20:56:10'),
(55, 'Bài 6', 'Hệ thức lượng trong tam giác vuông', 'Tính cạnh và góc trong tam giác vuông', 'Học sinh luyện tập áp dụng hệ thức lượng để giải bài toán hình học.', NULL, NULL, 10, '2026-03-22 04:00:00', '2026-03-22 04:00:00'),
(56, 'Bài 7', 'Tỉ số lượng giác của góc nhọn', 'Sin, cos, tan và cot', 'Học sinh tìm hiểu và áp dụng các tỉ số lượng giác trong tam giác vuông.', NULL, NULL, 10, '2026-03-29 04:00:00', '2026-03-29 04:00:00'),
(57, 'Bài 8', 'Đường tròn ngoại tiếp', 'Tính chất đường tròn ngoại tiếp tam giác', 'Giới thiệu tâm đường tròn ngoại tiếp và các dạng bài tập liên quan.', NULL, NULL, 10, '2026-04-05 04:00:00', '2026-04-05 04:00:00'),
(58, 'Bài 9', 'Góc nội tiếp', '<p>B&agrave;i học gi&uacute;p học sinh hiểu kh&aacute;i niệm g&oacute;c nội tiếp trong đường tr&ograve;n, c&aacute;c t&iacute;nh chất quan trọng v&agrave; biết vận dụng v&agrave;o giải b&agrave;i tập h&igrave;nh học.</p>\n\n<p>Nội dung b&agrave;i học bao gồm:<br />\n- Kh&aacute;i niệm g&oacute;c nội tiếp<br />\n- Số đo của g&oacute;c nội tiếp<br />\n- Quan hệ giữa g&oacute;c nội tiếp v&agrave; cung chắn<br />\n- C&aacute;c trường hợp đặc biệt của g&oacute;c nội tiếp<br />\n- Ứng dụng trong b&agrave;i to&aacute;n h&igrave;nh học</p>\n\n<p>Mục ti&ecirc;u b&agrave;i học:<br />\n- Nhận biết được g&oacute;c nội tiếp trong đường tr&ograve;n<br />\n- Vận dụng được t&iacute;nh chất g&oacute;c nội tiếp<br />\n- Giải được c&aacute;c b&agrave;i to&aacute;n li&ecirc;n quan đến số đo g&oacute;c<br />\n- Ph&aacute;t triển tư duy h&igrave;nh học v&agrave; kỹ năng chứng minh</p>\n\n<p>Hoạt động luyện tập:<br />\n1. X&aacute;c định g&oacute;c nội tiếp trong h&igrave;nh vẽ<br />\n2. T&iacute;nh số đo g&oacute;c nội tiếp<br />\n3. Chứng minh c&aacute;c t&iacute;nh chất h&igrave;nh học<br />\n4. Giải b&agrave;i tập tổng hợp</p>\n', 'Học sinh luyện tập chứng minh và tính góc nội tiếp trong đường tròn.', NULL, 'https://www.youtube.com/watch?v=02tqOevybVI', 10, '2026-04-06 04:00:00', '2026-05-17 21:08:07'),
(59, 'Bài 10', 'Ôn tập chương hàm số', 'Tổng hợp kiến thức hàm số', 'Hệ thống lại kiến thức hàm số bậc nhất và luyện đề tổng hợp.', NULL, 'https://youtu.be/zSeavSZ7XRU?si=CmjKjByuu5ovHylx', 10, '2026-04-12 04:00:00', '2026-05-16 06:51:35'),
(60, 'Bài 11', 'Ôn tập phương trình bậc hai', '<p>B&agrave;i học gi&uacute;p học sinh hệ thống lại kiến thức về phương tr&igrave;nh bậc hai v&agrave; r&egrave;n luyện kỹ năng giải c&aacute;c dạng b&agrave;i tập thường gặp.</p>\n\n<p>Nội dung b&agrave;i học bao gồm:<br />\n- Dạng tổng qu&aacute;t của phương tr&igrave;nh bậc hai<br />\n- C&ocirc;ng thức t&iacute;nh delta<br />\n- Điều kiện c&oacute; nghiệm của phương tr&igrave;nh<br />\n- Giải phương tr&igrave;nh bằng c&ocirc;ng thức nghiệm<br />\n- Ph&acirc;n t&iacute;ch v&agrave; giải c&aacute;c b&agrave;i to&aacute;n li&ecirc;n quan</p>\n\n<p>Mục ti&ecirc;u b&agrave;i học:<br />\n- Nhớ v&agrave; vận dụng đ&uacute;ng c&ocirc;ng thức nghiệm<br />\n- Giải được c&aacute;c phương tr&igrave;nh bậc hai cơ bản v&agrave; n&acirc;ng cao<br />\n- Ph&acirc;n t&iacute;ch được số nghiệm của phương tr&igrave;nh<br />\n- Ph&aacute;t triển kỹ năng tư duy logic v&agrave; tr&igrave;nh b&agrave;y b&agrave;i to&aacute;n</p>\n\n<p>Hoạt động luyện tập:<br />\n1. Giải phương tr&igrave;nh bậc hai<br />\n2. T&iacute;nh delta v&agrave; biện luận nghiệm<br />\n3. Ph&acirc;n t&iacute;ch b&agrave;i to&aacute;n thực tế<br />\n4. Luyện đề &ocirc;n tập tổng hợp</p>\n', 'Học sinh luyện tập các dạng toán phương trình bậc hai thường gặp.', NULL, 'https://www.youtube.com/watch?v=n7sTwYJYEgI', 10, '2026-04-13 04:00:00', '2026-05-17 21:03:34'),
(61, 'Bài 12', 'Giải bài toán bằng cách lập phương trình', 'Ứng dụng thực tế của phương trình', 'Hướng dẫn học sinh lập phương trình giải bài toán chuyển động và năng suất.', 'lessons/attachments/BA9HB1PqmSMo21cNKGG5O8tT4a9DflPRQzeCtYPf.pptx', 'https://youtu.be/zSeavSZ7XRU?si=CmjKjByuu5ovHylx', 10, '2026-04-19 04:00:00', '2026-05-17 21:03:52'),
(62, 'Bài 13', 'Ôn tập học kì', '<p>B&agrave;i học &ocirc;n tập học k&igrave; gi&uacute;p học sinh hệ thống lại to&agrave;n bộ kiến thức trọng t&acirc;m đ&atilde; học trong học k&igrave;, đồng thời r&egrave;n luyện kỹ năng giải b&agrave;i tập tổng hợp để chuẩn bị cho b&agrave;i kiểm tra cuối k&igrave;.</p>\n\n<p>Nội dung b&agrave;i học bao gồm:<br />\n- &Ocirc;n tập c&aacute;c kh&aacute;i niệm v&agrave; c&ocirc;ng thức quan trọng<br />\n- Củng cố kiến thức về số học, ph&acirc;n số, tỉ số v&agrave; phần trăm<br />\n- Luyện tập c&aacute;c dạng b&agrave;i tập Đại số v&agrave; H&igrave;nh học cơ bản<br />\n- Hướng dẫn phương ph&aacute;p giải b&agrave;i tập tổng hợp<br />\n- R&egrave;n luyện kỹ năng tr&igrave;nh b&agrave;y b&agrave;i to&aacute;n</p>\n\n<p>Mục ti&ecirc;u b&agrave;i học:<br />\n- Hệ thống h&oacute;a kiến thức đ&atilde; học trong học k&igrave;<br />\n- N&acirc;ng cao kỹ năng t&iacute;nh to&aacute;n v&agrave; tư duy logic<br />\n- Vận dụng kiến thức để giải quyết b&agrave;i tập thực tế<br />\n- Chuẩn bị tốt cho b&agrave;i kiểm tra học k&igrave;</p>\n\n<p>Hoạt động luyện tập:<br />\n1. Giải b&agrave;i tập trắc nghiệm tổng hợp<br />\n2. Luyện c&aacute;c dạng to&aacute;n tự luận<br />\n3. &Ocirc;n tập c&ocirc;ng thức quan trọng<br />\n4. Thực h&agrave;nh đề &ocirc;n tập học k&igrave;</p>\n', 'Học sinh luyện đề tổng hợp và chữa đề chuẩn bị kiểm tra học kì.', 'lessons/attachments/LI7E0V906HM4jWNHzPfdLRkByGU1Fe3RjO3GqDMZ.pptx', 'https://youtu.be/zSeavSZ7XRU?si=CmjKjByuu5ovHylx', 10, '2026-04-26 04:00:00', '2026-05-17 20:57:15'),
(63, 'Bài 1', 'Phép cộng và phép trừ phân số', 'Ôn tập phép cộng và trừ phân số', 'Học sinh luyện tập quy đồng mẫu số, thực hiện phép cộng và phép trừ phân số. Áp dụng giải các bài toán thực tế liên quan đến phân số.', NULL, NULL, 1, '2026-04-04 18:00:00', '2026-04-04 18:00:00'),
(64, 'Bài 2', 'Phép nhân phân số', 'Tìm hiểu phép nhân phân số', 'Hướng dẫn học sinh cách nhân hai phân số, rút gọn kết quả và áp dụng vào bài toán thực tế.', NULL, NULL, 1, '2026-04-11 18:00:00', '2026-04-11 18:00:00'),
(65, 'Bài 3', 'Phép chia phân số', '<p>B&agrave;i học gi&uacute;p học sinh hiểu quy tắc chia ph&acirc;n số v&agrave; biết vận dụng v&agrave;o giải c&aacute;c b&agrave;i to&aacute;n t&iacute;nh to&aacute;n v&agrave; thực tế.</p>\n\n<p>Nội dung b&agrave;i học bao gồm:<br />\n- Kh&aacute;i niệm ph&eacute;p chia ph&acirc;n số<br />\n- Quy tắc chia hai ph&acirc;n số<br />\n- T&igrave;m ph&acirc;n số nghịch đảo<br />\n- Thực hiện ph&eacute;p chia ph&acirc;n số v&agrave; hỗn số<br />\n- Ứng dụng ph&eacute;p chia ph&acirc;n số trong b&agrave;i to&aacute;n thực tế</p>\n\n<p>Mục ti&ecirc;u b&agrave;i học:<br />\n- Nắm vững quy tắc chia ph&acirc;n số<br />\n- Thực hiện ch&iacute;nh x&aacute;c c&aacute;c ph&eacute;p chia ph&acirc;n số<br />\n- Biết r&uacute;t gọn kết quả sau ph&eacute;p t&iacute;nh<br />\n- Vận dụng v&agrave;o giải b&agrave;i tập v&agrave; b&agrave;i to&aacute;n thực tế</p>\n\n<p>Hoạt động luyện tập:<br />\n1. T&iacute;nh ph&eacute;p chia giữa c&aacute;c ph&acirc;n số<br />\n2. T&igrave;m nghịch đảo của ph&acirc;n số<br />\n3. Giải b&agrave;i to&aacute;n thực tế li&ecirc;n quan đến ph&acirc;n số<br />\n4. Thực h&agrave;nh b&agrave;i tập n&acirc;ng cao</p>\n\n<p>&nbsp;</p>\n', 'Học sinh học cách tìm nghịch đảo và thực hiện phép chia phân số. Luyện tập nhiều dạng bài từ cơ bản đến nâng cao.', 'lessons/attachments/FVyqE9iawFF4dmlNgf44MKGpFnUaXZ2hF3RJ7Ddt.pptx', 'https://www.youtube.com/watch?v=VnU1HZErcY0', 1, '2026-04-18 18:00:00', '2026-05-17 21:04:08'),
(66, 'Bài 4', 'Số thập phân', '<p>B&agrave;i học gi&uacute;p học sinh hiểu kh&aacute;i niệm số thập ph&acirc;n, c&aacute;ch đọc, viết v&agrave; thực hiện c&aacute;c ph&eacute;p t&iacute;nh với số thập ph&acirc;n, đồng thời vận dụng v&agrave;o giải quyết c&aacute;c b&agrave;i to&aacute;n thực tế.</p>\n\n<p>Nội dung b&agrave;i học bao gồm:<br />\n- Kh&aacute;i niệm số thập ph&acirc;n<br />\n- C&aacute;ch đọc v&agrave; viết số thập ph&acirc;n<br />\n- So s&aacute;nh c&aacute;c số thập ph&acirc;n<br />\n- Thực hiện c&aacute;c ph&eacute;p cộng, trừ, nh&acirc;n, chia số thập ph&acirc;n<br />\n- Chuyển đổi giữa ph&acirc;n số v&agrave; số thập ph&acirc;n<br />\n- Ứng dụng số thập ph&acirc;n trong thực tế</p>\n\n<p>Mục ti&ecirc;u b&agrave;i học:<br />\n- Nhận biết v&agrave; sử dụng đ&uacute;ng số thập ph&acirc;n<br />\n- Thực hiện ch&iacute;nh x&aacute;c c&aacute;c ph&eacute;p t&iacute;nh với số thập ph&acirc;n<br />\n- Biết chuyển đổi giữa ph&acirc;n số v&agrave; số thập ph&acirc;n<br />\n- Vận dụng số thập ph&acirc;n để giải c&aacute;c b&agrave;i to&aacute;n thực tế<br />\n- Ph&aacute;t triển kỹ năng tư duy v&agrave; t&iacute;nh to&aacute;n logic</p>\n\n<p>Hoạt động luyện tập:<br />\n1. Đọc v&agrave; viết c&aacute;c số thập ph&acirc;n<br />\n2. So s&aacute;nh c&aacute;c số thập ph&acirc;n<br />\n3. Thực hiện ph&eacute;p t&iacute;nh cộng, trừ, nh&acirc;n, chia<br />\n4. Giải b&agrave;i to&aacute;n thực tế li&ecirc;n quan đến tiền tệ v&agrave; đo lường</p>\n\n<p>&nbsp;</p>\n', 'Học sinh luyện tập chuyển đổi giữa phân số và số thập phân, thực hiện các phép tính với số thập phân.', NULL, 'https://www.youtube.com/watch?v=-d9FIi-6cc8', 1, '2026-04-25 18:00:00', '2026-05-17 20:58:34'),
(67, 'Bài 5', 'Tỉ số và phần trăm', '<p>B&agrave;i học gi&uacute;p học sinh hiểu kh&aacute;i niệm tỉ số v&agrave; phần trăm, đồng thời biết c&aacute;ch &aacute;p dụng v&agrave;o c&aacute;c b&agrave;i to&aacute;n thực tế trong học tập v&agrave; đời sống.<br />\n<br />\nNội dung b&agrave;i học bao gồm:<br />\n- Kh&aacute;i niệm tỉ số giữa hai số<br />\n- C&aacute;ch biểu diễn phần trăm<br />\n- Chuyển đổi giữa ph&acirc;n số, số thập ph&acirc;n v&agrave; phần trăm<br />\n- T&iacute;nh phần trăm của một số<br />\n- Giải b&agrave;i to&aacute;n thực tế li&ecirc;n quan đến tỉ lệ phần trăm<br />\n<br />\nMục ti&ecirc;u b&agrave;i học:<br />\n- Hiểu v&agrave; vận dụng được c&ocirc;ng thức t&iacute;nh tỉ số v&agrave; phần trăm<br />\n- Biết chuyển đổi linh hoạt giữa c&aacute;c dạng số<br />\n- Giải được c&aacute;c b&agrave;i to&aacute;n thực tế như giảm gi&aacute;, l&atilde;i suất, điểm số v&agrave; thống k&ecirc;<br />\n- Ph&aacute;t triển kỹ năng tư duy v&agrave; t&iacute;nh to&aacute;n ch&iacute;nh x&aacute;c<br />\n<br />\nHoạt động luyện tập:<br />\n1. T&iacute;nh tỉ số giữa c&aacute;c đại lượng cho trước<br />\n2. Chuyển đổi ph&acirc;n số sang phần trăm<br />\n3. Giải b&agrave;i to&aacute;n giảm gi&aacute; sản phẩm<br />\n4. T&iacute;nh tỉ lệ học sinh đạt điểm giỏi trong lớp</p>\n', 'Học sinh tìm hiểu cách tính tỉ số phần trăm và áp dụng vào các bài toán thực tế như giảm giá, thống kê và tính điểm.', 'lessons/attachments/5yKEPByYStQvnrCuJmZ2VkrwItKmgZJeh8y5qLPx.pptx', 'https://www.youtube.com/watch?v=eD1fhvgq3mA', 1, '2026-05-02 18:00:00', '2026-05-17 20:53:21'),
(68, 'Bài 6', 'Ôn tập cuối chương', '<p>B&agrave;i học gi&uacute;p học sinh hệ thống lại to&agrave;n bộ kiến thức trọng t&acirc;m của chương ph&acirc;n số, bao gồm:<br />\n- Kh&aacute;i niệm ph&acirc;n số<br />\n- Quy đồng mẫu số<br />\n- So s&aacute;nh ph&acirc;n số<br />\n- C&aacute;c ph&eacute;p t&iacute;nh cộng, trừ, nh&acirc;n, chia ph&acirc;n số<br />\n- Ứng dụng ph&acirc;n số trong b&agrave;i to&aacute;n thực tế</p>\n\n<p>Sau b&agrave;i học, học sinh c&oacute; thể vận dụng linh hoạt c&aacute;c ph&eacute;p t&iacute;nh ph&acirc;n số để giải b&agrave;i tập cơ bản v&agrave; n&acirc;ng cao, đồng thời chuẩn bị tốt cho b&agrave;i kiểm tra cuối chương.</p>\n', 'Học sinh hệ thống lại toàn bộ kiến thức đã học về phân số, số thập phân và phần trăm thông qua bài tập tổng hợp.', 'lessons/attachments/vnBEl0hvi3FkBEy7pecrIXPlDzaJRqC0ElNVd1LZ.pptx', 'https://www.youtube.com/watch?v=WlHTKRY-9TI&list=PLA33KQsrdG3iRuzHBCWhrEQSEksF27gck', 1, '2026-05-09 18:00:00', '2026-05-17 20:49:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lesson_user`
--

CREATE TABLE `lesson_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lesson_user`
--

INSERT INTO `lesson_user` (`id`, `user_id`, `lesson_id`, `completed_at`, `created_at`, `updated_at`) VALUES
(89, 47, 68, '2026-05-17 04:07:33', '2026-05-17 04:07:33', '2026-05-17 04:07:33'),
(90, 47, 67, '2026-05-17 04:07:43', '2026-05-17 04:07:43', '2026-05-17 04:07:43'),
(91, 47, 66, '2026-05-17 04:07:53', '2026-05-17 04:07:53', '2026-05-17 04:07:53'),
(92, 47, 65, '2026-05-17 04:07:57', '2026-05-17 04:07:57', '2026-05-17 04:07:57'),
(93, 47, 64, '2026-05-17 04:08:01', '2026-05-17 04:08:01', '2026-05-17 04:08:01'),
(94, 45, 68, '2026-05-17 04:09:06', '2026-05-17 04:09:06', '2026-05-17 04:09:06'),
(95, 45, 66, '2026-05-17 04:09:09', '2026-05-17 04:09:09', '2026-05-17 04:09:09'),
(96, 45, 67, '2026-05-17 04:09:13', '2026-05-17 04:09:13', '2026-05-17 04:09:13'),
(97, 45, 65, '2026-05-17 04:10:20', '2026-05-17 04:10:20', '2026-05-17 04:10:20'),
(98, 45, 63, '2026-05-17 04:10:26', '2026-05-17 04:10:26', '2026-05-17 04:10:26'),
(100, 37, 67, '2026-05-18 13:52:08', '2026-05-18 13:52:08', '2026-05-18 13:52:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `class_id`, `message`, `attachment`, `read_at`, `created_at`, `updated_at`) VALUES
(24, 40, 38, NULL, 'Chào cô, trung tâm nhờ cô cập nhật điểm danh và kết quả học tập của lớp trước cuối tuần để bộ phận quản lý tổng hợp báo cáo nhé.', NULL, '2026-05-18 03:04:28', '2026-05-18 02:00:46', '2026-05-18 03:04:28'),
(25, 40, 43, NULL, 'Trung tâm nhận được phản hồi từ phụ huynh về việc học viên còn chậm tiến độ. Nhờ cô hỗ trợ theo dõi thêm và cập nhật tình hình giúp trung tâm nhé.', NULL, NULL, '2026-05-18 02:01:01', '2026-05-18 02:01:01'),
(26, 40, 41, NULL, 'Em hỗ trợ giáo viên quản lý lớp học, kiểm tra mic và camera của học viên trước giờ vào lớp giúp chị.', NULL, '2026-05-18 13:38:09', '2026-05-18 02:01:48', '2026-05-18 13:38:09'),
(27, 38, NULL, 1, 'Chào cả lớp, hôm nay chúng ta sẽ học. Các em nhớ chuẩn bị đầy đủ sách và làm bài tập cô giao từ buổi trước nhé.', NULL, NULL, '2026-05-18 02:13:03', '2026-05-18 02:13:03'),
(28, 38, NULL, 1, 'Cô đã đăng tài liệu ôn tập lên hệ thống. Các em tải về và đọc trước nội dung trước buổi học tiếp theo.', NULL, NULL, '2026-05-18 02:13:16', '2026-05-18 02:13:16'),
(29, 38, NULL, 10, 'Chúc mừng lớp 9A tuần trước có tỉ lệ chuyên cần cao nhất 🎉 Mong các em tiếp tục phát huy nhé.', NULL, NULL, '2026-05-18 02:13:42', '2026-05-18 02:13:42'),
(30, 37, NULL, 1, 'Dạ vâng ạ', NULL, NULL, '2026-05-18 02:14:09', '2026-05-18 02:14:09'),
(31, 38, 40, NULL, 'Dạ vâng chị', NULL, NULL, '2026-05-18 03:04:55', '2026-05-18 03:04:55'),
(32, 37, 38, NULL, 'em chào cô ạ', NULL, '2026-05-18 13:39:04', '2026-05-18 13:36:46', '2026-05-18 13:39:04'),
(33, 41, 37, NULL, 'Chị chào em nhé', NULL, NULL, '2026-05-18 13:37:30', '2026-05-18 13:37:30'),
(34, 41, 40, NULL, 'Dạ vâng ạ', NULL, NULL, '2026-05-18 13:38:16', '2026-05-18 13:38:16'),
(35, 38, 37, NULL, 'cô chào em', NULL, NULL, '2026-05-18 13:39:12', '2026-05-18 13:39:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_18_081400_create_classrooms_table', 1),
(5, '2025_06_18_081410_create_class_user_table', 1),
(6, '2025_06_18_081418_create_students_table', 1),
(7, '2025_06_18_081422_create_attendances_table', 1),
(8, '2025_06_18_081426_create_assignments_table', 1),
(9, '2025_06_18_081427_create_assignment_submissions_table', 1),
(10, '2025_06_18_081431_create_quizzes_table', 1),
(11, '2025_06_18_081432_create_quiz_results_table', 1),
(12, '2025_06_18_081447_create_notifications_table', 1),
(13, '2025_06_18_081452_create_messages_table', 1),
(14, '2025_06_18_081459_add_teacher_id_to_classrooms', 1),
(15, '2025_06_18_081500_add_notes_to_classrooms', 1),
(16, '2025_06_18_081500_add_status_to_classrooms', 1),
(17, '2025_06_19_090037_add_notes_to_students_table', 1),
(18, '2025_06_19_090742_add_level_to_students_table', 1),
(19, '2025_06_19_151226_fix_attendances_student_id_foreign_key', 1),
(20, '2025_07_02_000001_add_attachment_and_video_to_assignments_table', 1),
(21, '2025_07_04_151732_add_started_at_to_quiz_results_table', 1),
(22, '2025_07_04_161000_add_duration_to_quiz_results_table', 1),
(23, '2025_07_12_105309_add_submission_type_to_assignment_submissions_table', 1),
(24, '2025_07_13_030646_create_lessons_table', 1),
(25, '2025_07_13_053743_add_number_to_lessons_table', 1),
(26, '2025_07_13_115703_create_classroom_message_reads_table', 1),
(27, '2025_07_13_115836_add_missing_columns_to_notifications_table', 1),
(28, '2025_07_18_143042_create_lesson_user_table', 1),
(29, '2025_07_30_112837_add_read_at_to_messages_table', 1),
(30, '2025_07_31_191403_remove_teacher_id_from_classrooms_table', 1),
(31, '2025_08_01_050452_add_is_urgent_to_notifications_table', 1),
(32, '2025_08_06_162231_create_evaluations_table', 1),
(33, '2025_08_06_174338_remove_semester_from_evaluations_table', 1),
(34, '2025_08_06_211019_add_assigned_date_to_quizzes_table', 1),
(35, '2025_08_07_160029_create_evaluation_questions_table', 1),
(36, '2025_08_07_173054_create_payments_table', 1),
(37, '2025_08_07_173109_create_expenses_table', 1),
(38, '2025_08_08_100356_create_evaluation_rounds_table', 1),
(39, '2025_08_08_125800_add_indexes_to_attendances_table', 1),
(40, '2025_08_08_125900_add_time_limit_to_quizzes_table', 1),
(41, '2025_08_08_132600_add_proof_path_to_payments_table', 1),
(42, '2025_08_08_141304_add_operator_to_payments_table', 1),
(43, '2025_08_08_164530_fix_evaluations_unique_constraint', 1),
(44, '2025_08_09_014939_alter_evaluations_fk_restrict_on_delete', 1),
(45, '2025_08_10_152454_add_status_and_soft_deletes_to_classrooms_table', 1),
(46, '2025_08_10_152831_update_classroom_status_enum', 1),
(47, '2025_08_10_154358_add_suspended_status_to_classrooms', 1),
(48, '2025_08_11_113029_ensure_time_limit_in_quizzes_table', 1),
(49, '2025_08_11_150816_add_ai_fields_to_assignment_submissions_table', 1),
(50, '2025_08_11_150822_add_ai_fields_to_quizzes_table', 1),
(51, '2025_08_11_150828_add_ai_fields_to_assignments_table', 1),
(52, '2025_08_11_150832_create_question_banks_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` enum('info','warning','success','danger','reminder') NOT NULL DEFAULT 'info',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `is_urgent` tinyint(1) NOT NULL DEFAULT 0,
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `class_id`, `title`, `message`, `type`, `is_read`, `is_urgent`, `scheduled_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(4, 12, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(6, 12, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(7, 13, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(8, 13, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(9, 13, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(19, 17, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(20, 17, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(21, 17, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(25, 19, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(26, 19, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(27, 19, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(31, 21, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(32, 21, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(33, 21, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(37, 23, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(38, 23, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(39, 23, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(40, 24, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(41, 24, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(42, 24, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(58, 30, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(59, 30, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(60, 30, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(61, 31, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(62, 31, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(63, 31, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(64, 32, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(65, 32, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(66, 32, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(70, 34, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(71, 34, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(72, 34, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(76, 36, NULL, 'Chào mừng bạn đến với SMASH!', 'Chúc mừng bạn đã tham gia hệ thống học tập trực tuyến. Hãy khám phá các tính năng mới và bắt đầu học tập ngay hôm nay!', 'info', 0, 0, NULL, NULL, '2026-02-11 19:35:39', '2026-02-13 19:35:39'),
(77, 36, NULL, 'Nhắc nhở: Kiểm tra bài tập', 'Bạn có bài tập mới cần hoàn thành. Vui lòng kiểm tra và nộp bài trước thời hạn.', 'reminder', 0, 0, NULL, NULL, '2026-02-12 19:35:39', '2026-02-13 19:35:39'),
(78, 36, NULL, 'Hoàn thành lớp 6', 'Chúc mừng! Bạn đã hoàn thành xuất sắc lớp 6. Tiếp tục phát huy nhé!', 'success', 1, 0, NULL, NULL, '2026-02-10 19:35:39', '2026-02-13 19:35:39'),
(79, NULL, NULL, 'Bảo trì hệ thống', 'Hệ thống sẽ được bảo trì vào ngày mai từ 2:00 - 4:00 sáng. Vui lòng lưu ý và sắp xếp thời gian học tập phù hợp.', 'warning', 1, 0, NULL, NULL, '2026-02-13 13:35:39', '2026-05-05 21:38:24'),
(90, 38, 1, 'Thông báo buổi học tiếp theo nghỉ', 'Cô có việc bận nên lớp mình được nghỉ nhé', 'info', 1, 0, '2026-05-10 15:03:00', NULL, '2026-05-10 08:02:22', '2026-05-10 08:45:51'),
(92, 38, 10, 'Thông báo tuần học 25/05 - 31/05: Kiểm tra cuối tháng', 'Chào các em học sinh,\nTrong tuần học từ ngày 25/05 đến 31/05, lớp sẽ tổ chức bài kiểm tra cuối tháng nhằm đánh giá kết quả học tập của các em trong thời gian vừa qua.\nCác em vui lòng:\n- Ôn tập đầy đủ nội dung đã học.\n- Đi học đúng giờ và chuẩn bị đầy đủ dụng cụ học tập.\n- Giữ gìn sức khỏe để tham gia kiểm tra đạt kết quả tốt nhất.\nChúc các em ôn tập hiệu quả và hoàn thành bài kiểm tra thật tốt!\nGiáo viên ', 'info', 0, 0, '2026-05-20 01:54:00', NULL, '2026-05-18 01:55:11', '2026-05-18 01:55:11'),
(93, 38, 7, 'Thông báo tuần học 25/05 - 31/05: Kiểm tra cuối tháng', 'Chào các em học sinh,\nTrong tuần học từ ngày 25/05 đến 31/05, lớp sẽ tổ chức bài kiểm tra cuối tháng nhằm đánh giá kết quả học tập của các em trong thời gian vừa qua.\nCác em vui lòng:\n- Ôn tập đầy đủ nội dung đã học.\n- Đi học đúng giờ và chuẩn bị đầy đủ dụng cụ học tập.\n- Giữ gìn sức khỏe để tham gia kiểm tra đạt kết quả tốt nhất.\nChúc các em ôn tập hiệu quả và hoàn thành bài kiểm tra thật tốt!\nGiáo viên ', 'info', 0, 0, '2026-05-20 01:54:00', NULL, '2026-05-18 01:55:11', '2026-05-18 01:55:11'),
(94, 38, 1, 'Thông báo tuần học 25/05 - 31/05: Kiểm tra cuối tháng', 'Chào các em học sinh,\nTrong tuần học từ ngày 25/05 đến 31/05, lớp sẽ tổ chức bài kiểm tra cuối tháng nhằm đánh giá kết quả học tập của các em trong thời gian vừa qua.\nCác em vui lòng:\n- Ôn tập đầy đủ nội dung đã học.\n- Đi học đúng giờ và chuẩn bị đầy đủ dụng cụ học tập.\n- Giữ gìn sức khỏe để tham gia kiểm tra đạt kết quả tốt nhất.\nChúc các em ôn tập hiệu quả và hoàn thành bài kiểm tra thật tốt!\nGiáo viên ', 'info', 0, 0, '2026-05-20 01:54:00', NULL, '2026-05-18 01:55:11', '2026-05-18 01:55:11'),
(95, 38, 9, 'Cập nhật tài liệu ôn tập mới', 'Giáo viên đã cập nhật tài liệu ôn tập mới trên hệ thống. Các em vui lòng kiểm tra và tải tài liệu trước buổi học tiếp theo để chuẩn bị bài đầy đủ.\nNếu có thắc mắc trong quá trình học, các em có thể liên hệ giáo viên để được hỗ trợ.', 'info', 1, 0, '2026-05-18 01:57:00', NULL, '2026-05-18 01:56:57', '2026-05-18 02:04:06'),
(96, 38, 10, 'Cập nhật tài liệu ôn tập mới', 'Giáo viên đã cập nhật tài liệu ôn tập mới trên hệ thống. Các em vui lòng kiểm tra và tải tài liệu trước buổi học tiếp theo để chuẩn bị bài đầy đủ.\nNếu có thắc mắc trong quá trình học, các em có thể liên hệ giáo viên để được hỗ trợ.', 'info', 1, 0, '2026-05-18 01:57:00', NULL, '2026-05-18 01:56:57', '2026-05-18 02:03:33'),
(97, 38, 7, 'Cập nhật tài liệu ôn tập mới', 'Giáo viên đã cập nhật tài liệu ôn tập mới trên hệ thống. Các em vui lòng kiểm tra và tải tài liệu trước buổi học tiếp theo để chuẩn bị bài đầy đủ.\nNếu có thắc mắc trong quá trình học, các em có thể liên hệ giáo viên để được hỗ trợ.', 'info', 1, 0, '2026-05-18 01:57:00', NULL, '2026-05-18 01:56:57', '2026-05-18 02:03:36'),
(98, 38, 1, 'Cập nhật tài liệu ôn tập mới', 'Giáo viên đã cập nhật tài liệu ôn tập mới trên hệ thống. Các em vui lòng kiểm tra và tải tài liệu trước buổi học tiếp theo để chuẩn bị bài đầy đủ.\nNếu có thắc mắc trong quá trình học, các em có thể liên hệ giáo viên để được hỗ trợ.', 'info', 1, 0, '2026-05-18 01:57:00', NULL, '2026-05-18 01:56:57', '2026-05-18 09:27:22'),
(99, 38, 1, '[KHẨN] Thay đổi lịch học hôm nay', 'Do có sự cố đột xuất, lớp học hôm nay sẽ được chuyển sang hình thức học online. Các em vui lòng kiểm tra email hoặc nhóm lớp để nhận link tham gia trước giờ học.\n\nMong các em theo dõi thông báo và tham gia đầy đủ đúng giờ.', 'reminder', 1, 0, '2026-05-18 01:57:59', NULL, '2026-05-18 01:57:59', '2026-05-18 02:03:29'),
(100, 12, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(101, 13, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(102, 17, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(103, 19, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(104, 21, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(105, 23, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(106, 24, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(107, 30, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(108, 31, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(109, 32, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(110, 34, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(111, 36, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(112, 37, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 1, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 02:04:36'),
(113, 44, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(114, 45, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(115, 46, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(116, 47, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(117, 51, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(118, 57, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(119, 58, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(120, 59, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(121, 60, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(122, 61, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(123, 62, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(124, 63, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(125, 64, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(126, 65, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(127, 66, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(128, 67, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(129, 68, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 1, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 09:41:54'),
(130, 69, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(131, 70, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(132, 71, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(133, 72, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(134, 73, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(135, 74, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(136, 75, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(137, 76, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(138, 77, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(139, 78, NULL, 'Thông báo lịch nghỉ lễ trung tâm', 'Trung tâm xin thông báo đến toàn thể học viên về lịch nghỉ lễ từ ngày 30/04 đến hết ngày 01/05. Các lớp học sẽ hoạt động trở lại bình thường vào ngày 02/05.\nChúc các em và gia đình có kỳ nghỉ vui vẻ, an toàn và ý nghĩa.', 'info', 0, 0, NULL, NULL, '2026-05-18 01:59:23', '2026-05-18 01:59:23'),
(140, 41, 8, 'Phát động cuộc thi học tập tháng 06', 'Nhằm tạo động lực học tập cho học viên, trung tâm tổ chức cuộc thi “Học tập chăm chỉ - Nhận quà hấp dẫn” trong tháng 06 với nhiều phần quà giá trị dành cho các học viên đạt thành tích tốt.', 'reminder', 0, 0, '2026-05-18 09:40:35', NULL, '2026-05-18 09:40:35', '2026-05-18 09:40:35'),
(141, 41, 10, 'Phát động cuộc thi học tập tháng 06', 'Nhằm tạo động lực học tập cho học viên, trung tâm tổ chức cuộc thi “Học tập chăm chỉ - Nhận quà hấp dẫn” trong tháng 06 với nhiều phần quà giá trị dành cho các học viên đạt thành tích tốt.', 'reminder', 0, 0, '2026-05-18 09:40:35', NULL, '2026-05-18 09:40:35', '2026-05-18 09:40:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('0356819205', '689575', '2026-05-06 06:39:22'),
('26a4041204@hvnh.edu.vn', '387802', '2026-05-11 15:53:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'tuition',
  `status` enum('unpaid','partial','paid') NOT NULL DEFAULT 'unpaid',
  `note` text DEFAULT NULL,
  `operator` varchar(255) DEFAULT NULL COMMENT 'Người thực hiện giao dịch',
  `paid_at` timestamp NULL DEFAULT NULL,
  `proof_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `class_id`, `amount`, `type`, `status`, `note`, `operator`, `paid_at`, `proof_path`, `created_at`, `updated_at`) VALUES
(36, 12, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-15 09:43:00', NULL, '2026-05-17 09:56:33', '2026-05-18 15:01:05'),
(37, 13, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-13 23:34:00', NULL, '2026-05-17 09:57:08', '2026-05-17 10:00:14'),
(38, 60, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-17 09:58:07', NULL, '2026-05-17 09:58:07', '2026-05-17 09:58:07'),
(39, 61, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-17 09:58:31', NULL, '2026-05-17 09:58:31', '2026-05-17 09:58:31'),
(40, 32, 8, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-17 09:58:49', NULL, '2026-05-17 09:58:49', '2026-05-17 09:58:49'),
(41, 32, 8, 20000.00, 'material', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-17 07:59:00', NULL, '2026-05-17 09:59:03', '2026-05-18 15:40:58'),
(42, 30, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-17 09:59:00', NULL, '2026-05-17 09:59:33', '2026-05-17 09:59:33'),
(43, 30, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-14 21:59:00', NULL, '2026-05-17 09:59:46', '2026-05-17 09:59:46'),
(44, 31, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-16 03:02:00', NULL, '2026-05-17 10:02:22', '2026-05-17 10:02:22'),
(45, 17, 8, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-11 01:02:00', NULL, '2026-05-17 10:02:47', '2026-05-17 10:02:47'),
(46, 34, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-12 22:03:00', NULL, '2026-05-17 10:03:56', '2026-05-17 10:03:56'),
(47, 71, 8, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-14 00:06:00', NULL, '2026-05-17 10:04:44', '2026-05-17 10:04:44'),
(48, 19, 3, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-12 21:09:00', NULL, '2026-05-17 10:05:26', '2026-05-17 10:05:26'),
(49, 68, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-13 02:08:00', NULL, '2026-05-17 10:06:06', '2026-05-17 10:06:06'),
(50, 21, 5, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-14 04:10:00', NULL, '2026-05-17 10:10:25', '2026-05-17 10:10:25'),
(51, 12, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-14 14:28:00', NULL, '2026-05-18 14:29:08', '2026-05-18 15:02:30'),
(53, 12, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-03-13 14:29:00', NULL, '2026-05-18 14:29:50', '2026-05-18 14:52:15'),
(54, 13, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-03-17 03:32:00', NULL, '2026-05-18 15:32:12', '2026-05-18 15:32:12'),
(55, 13, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-21 04:32:00', NULL, '2026-05-18 15:32:44', '2026-05-18 15:32:44'),
(56, 17, 8, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-18 15:33:00', NULL, '2026-05-18 15:33:11', '2026-05-18 15:33:11'),
(57, 17, 8, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-03-13 15:33:00', NULL, '2026-05-18 15:33:29', '2026-05-18 15:33:29'),
(58, 31, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-18 15:34:00', NULL, '2026-05-18 15:34:29', '2026-05-18 15:34:29'),
(59, 31, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-03-12 05:34:00', NULL, '2026-05-18 15:34:50', '2026-05-18 15:34:50'),
(60, 37, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-17 15:12:00', NULL, '2026-05-18 15:36:09', '2026-05-18 15:36:09'),
(61, 37, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-15 15:36:00', NULL, '2026-05-18 15:36:25', '2026-05-18 15:36:25'),
(62, 32, 8, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-17 15:37:00', NULL, '2026-05-18 15:37:18', '2026-05-18 15:37:18'),
(63, 34, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-18 03:45:00', NULL, '2026-05-18 15:45:17', '2026-05-18 15:45:17'),
(64, 34, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-03-16 15:45:00', NULL, '2026-05-18 15:45:39', '2026-05-18 15:45:39'),
(65, 72, 8, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-17 15:46:00', NULL, '2026-05-18 15:46:07', '2026-05-18 15:46:07'),
(66, 72, 8, 600000.00, 'tuition', 'partial', NULL, 'Thiều Thủy Ngân', '2026-05-15 15:46:00', NULL, '2026-05-18 15:46:20', '2026-05-18 15:46:20'),
(67, 45, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-17 15:46:00', NULL, '2026-05-18 15:46:42', '2026-05-18 15:46:42'),
(68, 47, 1, 600000.00, 'tuition', 'partial', NULL, 'Thiều Thủy Ngân', '2026-05-17 15:47:00', NULL, '2026-05-18 15:47:09', '2026-05-18 15:47:09'),
(69, 47, 1, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-16 03:47:00', NULL, '2026-05-18 15:47:23', '2026-05-18 15:47:23'),
(71, 60, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-16 15:48:00', NULL, '2026-05-18 15:48:51', '2026-05-18 15:48:51'),
(72, 62, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-03-18 03:49:00', NULL, '2026-05-18 15:49:20', '2026-05-18 15:49:20'),
(73, 62, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-18 07:49:00', NULL, '2026-05-18 15:49:38', '2026-05-18 15:49:38'),
(74, 62, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-16 15:49:00', NULL, '2026-05-18 15:49:48', '2026-05-18 15:49:48'),
(75, 63, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-16 15:50:00', NULL, '2026-05-18 15:50:17', '2026-05-18 15:50:17'),
(76, 69, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-03-18 15:50:00', NULL, '2026-05-18 15:50:43', '2026-05-18 15:50:43'),
(77, 69, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-16 07:55:00', NULL, '2026-05-18 15:51:01', '2026-05-18 15:51:01'),
(78, 69, 10, 600000.00, 'tuition', 'partial', NULL, 'Thiều Thủy Ngân', '2026-05-17 07:51:00', NULL, '2026-05-18 15:51:18', '2026-05-18 15:51:18'),
(79, 70, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-16 15:51:00', NULL, '2026-05-18 15:52:02', '2026-05-18 15:52:02'),
(80, 70, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-14 03:52:00', NULL, '2026-05-18 15:52:21', '2026-05-18 15:52:21'),
(81, 73, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-04-18 17:52:00', NULL, '2026-05-18 15:53:02', '2026-05-18 15:53:02'),
(82, 73, 10, 600000.00, 'tuition', 'paid', NULL, 'Thiều Thủy Ngân', '2026-05-16 04:32:00', NULL, '2026-05-18 15:53:29', '2026-05-18 15:53:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `questions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`questions`)),
  `ai_validation_errors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ai_validation_errors`)),
  `ai_suggestions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ai_suggestions`)),
  `ai_validated_at` timestamp NULL DEFAULT NULL,
  `ai_generated` tinyint(1) NOT NULL DEFAULT 0,
  `ai_generation_source` varchar(255) DEFAULT NULL,
  `ai_generation_params` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ai_generation_params`)),
  `ai_generated_at` timestamp NULL DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `time_limit` int(11) DEFAULT NULL COMMENT 'Thời gian làm bài tính bằng phút',
  `assigned_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quizzes`
--

INSERT INTO `quizzes` (`id`, `class_id`, `title`, `description`, `questions`, `ai_validation_errors`, `ai_suggestions`, `ai_validated_at`, `ai_generated`, `ai_generation_source`, `ai_generation_params`, `ai_generated_at`, `deadline`, `time_limit`, `assigned_date`, `created_at`, `updated_at`) VALUES
(22, 1, 'Bài ôn tập phân số', '', '[{\"question\":\"1\\/5+1\\/5=?\",\"type\":\"multiple_choice\",\"options\":[\"1\\/5\",\"2\\/5\",\"3\\/20\",\"4\"],\"correct_answer\":\"2\\/5\",\"score\":1,\"audio\":null}]', NULL, NULL, NULL, 0, NULL, NULL, NULL, '2026-05-12 23:59:00', 10, NULL, '2026-05-12 03:52:25', '2026-05-12 03:52:25'),
(23, 1, 'Bài ôn tập hình học tam giác', '', '[{\"question\":\"Tam gi\\u00e1c c\\u00f3 m\\u1ea5y c\\u1ea1nh?\",\"type\":\"multiple_choice\",\"options\":[\"1\",\"2\",\"3\",\"4\"],\"correct_answer\":\"3\",\"score\":1,\"audio\":null}]', NULL, NULL, NULL, 0, NULL, NULL, NULL, '2026-05-24 11:13:00', 5, NULL, '2026-05-12 04:13:29', '2026-05-12 04:13:29'),
(26, 1, 'Bài tập trắc nghiệm Toán lớp 6 - Ôn tập kiến thức cơ bản', 'Bài tập gồm 12 câu hỏi trắc nghiệm môn Toán lớp 6 với các nội dung: số học, phép tính cơ bản, phân số, hình học và số nguyên. Học sinh hoàn thành bài tập để củng cố kiến thức đã học và chuẩn bị cho các bài kiểm tra sắp tới.', '[{\"question\":\"K\\u1ebft qu\\u1ea3 c\\u1ee7a 25+17 l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"32\",\"42\",\"52\",\"41\"],\"correct_answer\":\"42\",\"score\":1,\"audio\":null},{\"question\":\"S\\u1ed1 n\\u00e0o l\\u00e0 s\\u1ed1 nguy\\u00ean t\\u1ed1?\",\"type\":\"multiple_choice\",\"options\":[\"9\",\"15\",\"17\",\"21\"],\"correct_answer\":\"17\",\"score\":1,\"audio\":null},{\"question\":\"K\\u1ebft qu\\u1ea3 c\\u1ee7a 56:7 l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"6\",\"7\",\"8\",\"9\"],\"correct_answer\":\"8\",\"score\":1,\"audio\":null},{\"question\":\"BCNN c\\u1ee7a 3 v\\u00e0 5 l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"10\",\"12\",\"15\",\"20\"],\"correct_answer\":\"15\",\"score\":1,\"audio\":null},{\"question\":\"S\\u1ed1 \\u0111\\u1ed1i c\\u1ee7a \\u22129 l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"9\",\"-9\",\"0\",\"18\"],\"correct_answer\":\"9\",\"score\":1,\"audio\":null},{\"question\":\"\\u01afCLN c\\u1ee7a 16 v\\u00e0 24 l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"4\",\"6\",\"8\",\"12\"],\"correct_answer\":\"8\",\"score\":1,\"audio\":null},{\"question\":\"S\\u1ed1 li\\u1ec1n tr\\u01b0\\u1edbc c\\u1ee7a 500 l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"498\",\"499\",\"501\",\"502\"],\"correct_answer\":\"499\",\"score\":1,\"audio\":null},{\"question\":\"Chu vi h\\u00ecnh vu\\u00f4ng c\\u1ea1nh 8 cm l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"16 cm\",\"24 cm\",\"32 cm\",\"64 cm\"],\"correct_answer\":\"32 cm\",\"score\":1,\"audio\":null},{\"question\":\"Di\\u1ec7n t\\u00edch h\\u00ecnh ch\\u1eef nh\\u1eadt d\\u00e0i 9 cm, r\\u1ed9ng 4 cm l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"13 cm\\u00b2\",\"26 cm\\u00b2\",\"36 cm\\u00b2\",\"45 cm\\u00b2\"],\"correct_answer\":\"36 cm\\u00b2\",\"score\":1,\"audio\":null},{\"question\":\"S\\u1ed1 n\\u00e0o l\\u00e0 b\\u1ed9i c\\u1ee7a 6?\",\"type\":\"multiple_choice\",\"options\":[\"25\",\"30\",\"35\",\"40\"],\"correct_answer\":\"30\",\"score\":1,\"audio\":null},{\"question\":\"S\\u1ed1 nguy\\u00ean \\u00e2m n\\u00e0o nh\\u1ecf nh\\u1ea5t?\",\"type\":\"multiple_choice\",\"options\":[\"-1\",\"-3\",\"-8\",\"-6\"],\"correct_answer\":\"-8\",\"score\":1,\"audio\":null},{\"question\":\"M\\u1ed9t g\\u00f3c b\\u1eb9t c\\u00f3 s\\u1ed1 \\u0111o:\",\"type\":\"multiple_choice\",\"options\":[\"45\\u00b0\",\"90\\u00b0\",\"120\\u00b0\",\"180\\u00b0\"],\"correct_answer\":\"180\\u00b0\",\"score\":1,\"audio\":null}]', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 15, NULL, '2026-05-18 02:24:52', '2026-05-18 02:24:52'),
(27, 1, 'Toán học thực tế trong đời sống', '', '[{\"question\":\"M\\u1ed9t c\\u1eeda h\\u00e0ng gi\\u1ea3m gi\\u00e1 20% cho chi\\u1ebfc \\u00e1o gi\\u00e1 250.000 \\u0111\\u1ed3ng. Gi\\u00e1 sau gi\\u1ea3m l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"200.000 \\u0111\\u1ed3ng\",\"210.000 \\u0111\\u1ed3ng\",\"220.000 \\u0111\\u1ed3ng\",\"230.000 \\u0111\\u1ed3ng\"],\"correct_answer\":\"200.000 \\u0111\\u1ed3ng\",\"score\":1,\"audio\":null},{\"question\":\"M\\u1ed9t xe m\\u00e1y \\u0111i v\\u1edbi v\\u1eadn t\\u1ed1c 40 km\\/h trong 3 gi\\u1edd. Qu\\u00e3ng \\u0111\\u01b0\\u1eddng \\u0111i \\u0111\\u01b0\\u1ee3c l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"80 km\",\"100 km\",\"120 km\",\"140 km\"],\"correct_answer\":\"120 km\",\"score\":1,\"audio\":null},{\"question\":\"M\\u1ed9t l\\u1edbp c\\u00f3 40 h\\u1ecdc sinh, trong \\u0111\\u00f3 c\\u00f3 10 h\\u1ecdc sinh gi\\u1ecfi. T\\u1ec9 l\\u1ec7 h\\u1ecdc sinh gi\\u1ecfi l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"20%\",\"25%\",\"30%\",\"35%\"],\"correct_answer\":\"25%\",\"score\":1,\"audio\":null},{\"question\":\"M\\u1ed9t ng\\u01b0\\u1eddi g\\u1eedi ti\\u1ebft ki\\u1ec7m 5.000.000 \\u0111\\u1ed3ng v\\u1edbi l\\u00e3i su\\u1ea5t 6%\\/n\\u0103m. Sau 1 n\\u0103m s\\u1ed1 ti\\u1ec1n l\\u00e3i l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"200.000 \\u0111\\u1ed3ng\",\"250.000 \\u0111\\u1ed3ng\",\"300.000 \\u0111\\u1ed3ng\",\"350.000 \\u0111\\u1ed3ng\"],\"correct_answer\":\"300.000 \\u0111\\u1ed3ng\",\"score\":1,\"audio\":null},{\"question\":\"M\\u1ed9t h\\u00ecnh ch\\u1eef nh\\u1eadt c\\u00f3 chi\\u1ec1u d\\u00e0i 12 m v\\u00e0 chi\\u1ec1u r\\u1ed9ng 5 m. Di\\u1ec7n t\\u00edch l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"50 m\\u00b2\",\"55 m\\u00b2\",\"60 m\\u00b2\",\"65 m\\u00b2\"],\"correct_answer\":\"60 m\\u00b2\",\"score\":1,\"audio\":null},{\"question\":\"M\\u1ed9t s\\u1ea3n ph\\u1ea9m gi\\u00e1 400.000 \\u0111\\u1ed3ng, t\\u0103ng gi\\u00e1 th\\u00eam 10%. Gi\\u00e1 m\\u1edbi l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"420.000 \\u0111\\u1ed3ng\",\"430.000 \\u0111\\u1ed3ng\",\"440.000 \\u0111\\u1ed3ng\",\"450.000 \\u0111\\u1ed3ng\"],\"correct_answer\":\"440.000 \\u0111\\u1ed3ng\",\"score\":1,\"audio\":null},{\"question\":\"M\\u1ed9t b\\u1ec3 n\\u01b0\\u1edbc ch\\u1ee9a 120 l\\u00edt n\\u01b0\\u1edbc, \\u0111\\u00e3 d\\u00f9ng h\\u1ebft 25%. S\\u1ed1 n\\u01b0\\u1edbc c\\u00f2n l\\u1ea1i l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"80 l\\u00edt\",\"85 l\\u00edt\",\"90 l\\u00edt\",\"95 l\\u00edt\"],\"correct_answer\":\"90 l\\u00edt\",\"score\":1,\"audio\":null},{\"question\":\"M\\u1ed9t ng\\u01b0\\u1eddi \\u0111i b\\u1ed9 1500 m trong 30 ph\\u00fat. V\\u1eadn t\\u1ed1c trung b\\u00ecnh l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"40 m\\/ph\\u00fat\",\"50 m\\/ph\\u00fat\",\"60 m\\/ph\\u00fat\",\"70 m\\/ph\\u00fat\"],\"correct_answer\":\"50 m\\/ph\\u00fat\",\"score\":1,\"audio\":null},{\"question\":\"M\\u1ed9t chi\\u1ebfc b\\u00e1nh pizza \\u0111\\u01b0\\u1ee3c chia th\\u00e0nh 8 ph\\u1ea7n b\\u1eb1ng nhau. \\u0102n 2 ph\\u1ea7n th\\u00ec \\u0111\\u00e3 \\u0103n:\",\"type\":\"multiple_choice\",\"options\":[\"1\\/2 chi\\u1ebfc b\\u00e1nh\",\"1\\/3 chi\\u1ebfc b\\u00e1nh\",\"1\\/4 chi\\u1ebfc b\\u00e1nh\",\"1\\/5 chi\\u1ebfc b\\u00e1nh\"],\"correct_answer\":\"1\\/4 chi\\u1ebfc b\\u00e1nh\",\"score\":1,\"audio\":null},{\"question\":\"M\\u1ed9t c\\u1eeda h\\u00e0ng b\\u00e1n \\u0111\\u01b0\\u1ee3c 45 quy\\u1ec3n v\\u1edf trong ng\\u00e0y th\\u1ee9 nh\\u1ea5t v\\u00e0 55 quy\\u1ec3n trong ng\\u00e0y th\\u1ee9 hai. T\\u1ed5ng s\\u1ed1 v\\u1edf b\\u00e1n \\u0111\\u01b0\\u1ee3c l\\u00e0:\",\"type\":\"multiple_choice\",\"options\":[\"90 quy\\u1ec3n\",\"95 quy\\u1ec3n\",\"100 quy\\u1ec3n\",\"106 quy\\u1ec3n\"],\"correct_answer\":\"100 quy\\u1ec3n\",\"score\":1,\"audio\":null}]', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 30, NULL, '2026-05-18 02:32:07', '2026-05-18 02:32:07'),
(28, 10, 'Bài tập Bất đẳng thức và tính chất ', 'Kết nối tri thức Trắc nghiệm Toán 9', '[{\"question\":\"Cho b\\u1ea5t \\u0111\\u1eb3ng th\\u1ee9c m > n Ch\\u1ecdn k\\u1ebft lu\\u1eadn \\u0111\\u00fang trong c\\u00e1c k\\u1ebft lu\\u1eadn sau:\",\"type\":\"multiple_choice\",\"options\":[\"m + 4 < n + 4.\",\"m - 4 > n - 4.\",\"m - 1 < n - 1.\",\"n + 1 > m + 1.\"],\"correct_answer\":\"m - 4 > n - 4.\",\"score\":1,\"audio\":null},{\"question\":\"Cho x\\u22122 \\u2265 y\\u22122. B\\u1ea5t \\u0111\\u1eb3ng th\\u1ee9c th\\u1ec3 hi\\u1ec7n m\\u1ed1i quan h\\u1ec7 gi\\u1eefa x v\\u00e0 y l\\u00e0\",\"type\":\"multiple_choice\",\"options\":[\"x < y.\",\" x > y\",\"x \\u2264 y\",\"y \\u2264 x\"],\"correct_answer\":\"y \\u2264 x\",\"score\":1,\"audio\":null},{\"question\":\"B\\u1ea5t \\u0111\\u1eb3ng th\\u1ee9c m\\u00f4 t\\u1ea3 ph\\u00e1t bi\\u1ec3u \\u201c x l\\u00e0 s\\u1ed1 kh\\u00f4ng \\u00e2m\\u201d l\\u00e0\",\"type\":\"multiple_choice\",\"options\":[\"x \\u2264 0\",\"x \\u2265 0\",\"x < 0\",\"x > 0\"],\"correct_answer\":\"x \\u2265 0\",\"score\":1,\"audio\":null},{\"question\":\" Gi\\u1ea3 s\\u1eed t l\\u00e0 s\\u1ed1 gi\\u1edd l\\u00e0m vi\\u1ec7c t\\u1ed1i thi\\u1ec3u c\\u1ee7a c\\u00f4ng nh\\u00e2n trong m\\u1ed9t ng\\u00e0y. D\\u00f9ng k\\u00ed hi\\u1ec7u \\u0111\\u1ec3 vi\\u1ebft b\\u1ea5t \\u0111\\u1eb3ng th\\u1ee9c trong tr\\u01b0\\u1eddng h\\u1ee3p: \\u201cS\\u1ed1 gi\\u1edd l\\u00e0m vi\\u1ec7c t\\u1ed1i thi\\u1ec3u c\\u1ee7a c\\u00f4ng nh\\u00e2n trong m\\u1ed9t ng\\u00e0y l\\u00e0 8 gi\\u1edd\\u201d ta \\u0111\\u01b0\\u1ee3c\",\"type\":\"multiple_choice\",\"options\":[\"t \\u2265 8.\",\"t > 8\",\"t = 8.\",\" t < 8\"],\"correct_answer\":\"t \\u2265 8.\",\"score\":1,\"audio\":null},{\"question\":\"N\\u1ebfu a < b th\\u00ec\",\"type\":\"multiple_choice\",\"options\":[\"2a < 2b\",\"-3a < - 3b\",\"4a > 4b\",\"3(b + 1) < 3(a +1)\"],\"correct_answer\":\"2a < 2b\",\"score\":1,\"audio\":null},{\"question\":\" V\\u1edbi hai s\\u1ed1 th\\u1ef1c a, b khi ab < 0 th\\u00ec ta n\\u00f3i:\",\"type\":\"multiple_choice\",\"options\":[\"a, b c\\u00f9ng d\\u01b0\\u01a1ng.\",\" a, b c\\u00f9ng \\u00e2m. \",\"a, b c\\u00f9ng d\\u1ea5u. \",\" a, b tr\\u00e1i d\\u1ea5u.\"],\"correct_answer\":\" a, b tr\\u00e1i d\\u1ea5u.\",\"score\":1,\"audio\":null},{\"question\":\"Bi\\u1ebft a - 3 < b, so s\\u00e1nh a + 10 v\\u00e0 b + 13 ta \\u0111\\u01b0\\u1ee3c\",\"type\":\"multiple_choice\",\"options\":[\"a + 10 > b + 13.\",\"a +10 < b +13\",\"a + 10 \\u2264 b + 13.\",\"a + 10 = b + 13.\"],\"correct_answer\":\"a +10 < b +13\",\"score\":1,\"audio\":null},{\"question\":\"Trong c\\u00e1c c\\u1eb7p b\\u1ea5t \\u0111\\u1eb3ng th\\u1ee9c sau, c\\u1eb7p b\\u1ea5t \\u0111\\u1eb3ng th\\u1ee9c n\\u00e0o c\\u00f9ng chi\\u1ec1u?\",\"type\":\"multiple_choice\",\"options\":[\"2,5 < 5, 8 v\\u00e0  2 > \\u221a 3 .  \",\"\\u2212 1 > \\u2212 2 \\u221a 5  v\\u00e0  2 > \\u221a 3 .\",\" 4,7 < 8 v\\u00e0 8 > a. \",\"2 \\u221a 7 > b  v\\u00e0   \\u2212 4 b < 6.\"],\"correct_answer\":\"\\u2212 1 > \\u2212 2 \\u221a 5  v\\u00e0  2 > \\u221a 3 .\",\"score\":1,\"audio\":null}]', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 15, NULL, '2026-05-18 02:38:03', '2026-05-18 02:38:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`answers`)),
  `score` double DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `quiz_id`, `student_id`, `answers`, `score`, `started_at`, `submitted_at`, `duration`, `created_at`, `updated_at`) VALUES
(27, 23, 31, '[\"3\"]', 100, '2026-05-12 04:21:56', '2026-05-12 11:23:31', 95, '2026-05-12 04:21:56', '2026-05-12 04:23:31'),
(29, 22, 31, '[\"2\\/5\"]', 100, '2026-05-12 06:17:27', '2026-05-12 13:23:08', 341, '2026-05-12 06:17:27', '2026-05-12 06:23:08'),
(32, 23, 30, '[\"3\"]', 100, '2026-05-17 11:06:00', '2026-05-17 18:06:06', 6, '2026-05-17 11:06:00', '2026-05-17 11:06:06'),
(34, 27, 27, '[\"200.000 \\u0111\\u1ed3ng\",\"120 km\",\"25%\",\"300.000 \\u0111\\u1ed3ng\",\"50 m\\u00b2\",\"440.000 \\u0111\\u1ed3ng\",\"80 l\\u00edt\",\"50 m\\/ph\\u00fat\",\"1\\/4 chi\\u1ebfc b\\u00e1nh\",\"90 quy\\u1ec3n\"]', 70, '2026-05-18 02:43:57', '2026-05-18 09:45:30', 94, '2026-05-18 02:43:57', '2026-05-18 02:45:30'),
(35, 26, 27, '{\"0\":\"42\",\"1\":\"15\",\"2\":\"8\",\"3\":\"15\",\"4\":\"18\",\"5\":\"4\",\"7\":\"32 cm\",\"8\":\"45 cm\\u00b2\",\"9\":\"25\",\"10\":\"-8\",\"11\":\"180\\u00b0\"}', 50, '2026-05-18 13:28:44', '2026-05-18 20:31:02', 139, '2026-05-18 13:28:44', '2026-05-18 13:31:02'),
(36, 27, 2, '[\"200.000 \\u0111\\u1ed3ng\",\"120 km\",\"20%\",\"300.000 \\u0111\\u1ed3ng\",\"55 m\\u00b2\",\"450.000 \\u0111\\u1ed3ng\",\"80 l\\u00edt\",\"70 m\\/ph\\u00fat\",\"1\\/4 chi\\u1ebfc b\\u00e1nh\",\"90 quy\\u1ec3n\"]', 40, '2026-05-18 14:05:03', '2026-05-18 21:05:37', 34, '2026-05-18 14:05:03', '2026-05-18 14:05:37'),
(37, 26, 2, '[\"42\",\"15\"]', 8, '2026-05-18 14:13:09', '2026-05-18 21:32:25', 1156, '2026-05-18 14:13:09', '2026-05-18 14:32:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Z88XnxxW6U5ArwUcrwDZcSlnKLHYQIelzHwuh9zV', 37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNzU4NTRZcUZwRFk2d3ZQYWFGMzVUa3FSMlhMVE5wV252M0pjaFo1UyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozNzt9', 1779169174);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `level` varchar(50) DEFAULT NULL,
  `joined_at` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`id`, `user_id`, `date_of_birth`, `status`, `level`, `joined_at`, `notes`, `created_at`, `updated_at`) VALUES
(2, 12, NULL, 'active', 'Lớp 6', '2025-10-09', NULL, '2026-01-29 07:04:51', '2026-03-23 07:50:28'),
(3, 13, NULL, 'active', 'Lớp 6', '2025-07-27', NULL, '2026-01-29 07:04:51', '2026-03-23 07:50:05'),
(7, 17, NULL, 'active', 'Lớp 9', '2025-05-01', NULL, '2026-01-29 07:04:52', '2026-03-23 07:54:09'),
(9, 19, '2011-07-06', 'active', 'Lớp 7', '2026-01-23', NULL, '2026-01-29 07:04:53', '2026-05-16 09:41:14'),
(11, 21, NULL, 'active', 'Lớp 8', '2025-07-27', NULL, '2026-01-29 07:04:53', '2026-03-23 07:54:00'),
(13, 23, NULL, 'active', 'Lớp 7', '2025-11-30', NULL, '2026-01-29 07:04:54', '2026-03-23 07:54:19'),
(14, 24, NULL, 'active', 'Lớp 7', '2025-07-13', NULL, '2026-01-29 07:04:54', '2026-03-23 07:53:50'),
(20, 30, NULL, 'active', 'Lớp 6', '2025-05-05', NULL, '2026-01-29 07:04:56', '2026-03-23 08:03:38'),
(21, 31, NULL, 'active', 'Lớp 6', '2025-08-21', NULL, '2026-01-29 07:04:56', '2026-03-23 07:49:31'),
(22, 32, NULL, 'active', 'Lớp 9', '2025-07-20', NULL, '2026-01-29 07:04:56', '2026-03-23 07:55:41'),
(24, 34, '2011-03-02', 'active', 'Lớp 6', '2025-02-18', NULL, '2026-01-29 07:04:57', '2026-05-16 09:43:31'),
(26, 36, NULL, 'active', 'Lớp 8', '2026-01-29', NULL, '2026-01-29 07:04:57', '2026-03-23 08:04:05'),
(27, 37, '2012-06-20', 'active', 'Lớp 6', '2026-02-01', '', '2026-02-01 08:13:12', '2026-05-08 10:43:45'),
(28, 44, NULL, 'active', 'Lớp 6', NULL, '', '2026-05-08 10:37:51', '2026-05-08 10:37:51'),
(29, 46, NULL, 'active', 'Lớp 6', NULL, '', '2026-05-08 10:38:18', '2026-05-08 10:38:18'),
(30, 45, NULL, 'active', 'Lớp 6', NULL, '', '2026-05-08 10:38:42', '2026-05-08 10:38:42'),
(31, 47, NULL, 'active', 'Lớp 6', NULL, '', '2026-05-08 10:39:00', '2026-05-08 10:39:00'),
(32, 51, NULL, 'active', 'Lớp 6', NULL, '', '2026-05-16 09:55:58', '2026-05-16 09:55:58'),
(36, 57, NULL, 'active', 'Lớp 7', NULL, '', '2026-05-16 10:39:10', '2026-05-16 12:31:16'),
(37, 58, NULL, 'active', 'Lớp 8', NULL, '', '2026-05-16 10:57:14', '2026-05-16 10:57:14'),
(38, 59, NULL, 'active', 'Lớp 8', NULL, '', '2026-05-16 11:10:22', '2026-05-16 11:10:22'),
(39, 60, NULL, 'active', 'Lớp 9', NULL, '', '2026-05-16 12:29:49', '2026-05-16 12:29:49'),
(40, 61, NULL, 'active', 'Lớp 9', NULL, '', '2026-05-16 12:41:24', '2026-05-16 12:41:24'),
(41, 62, NULL, 'active', 'Lớp 9', NULL, '', '2026-05-16 12:42:02', '2026-05-16 12:42:02'),
(42, 63, NULL, 'active', 'Lớp 9', NULL, '', '2026-05-16 12:42:35', '2026-05-16 12:42:35'),
(43, 64, NULL, 'active', 'Lớp 7', NULL, '', '2026-05-16 12:45:13', '2026-05-16 12:45:13'),
(44, 65, NULL, 'active', 'Lớp 7', NULL, '', '2026-05-16 12:45:44', '2026-05-16 12:45:44'),
(45, 66, NULL, 'active', 'Lớp 7', NULL, '', '2026-05-16 12:46:09', '2026-05-16 12:46:09'),
(46, 67, NULL, 'active', 'Lớp 7', NULL, '', '2026-05-16 12:46:40', '2026-05-16 12:46:40'),
(47, 68, NULL, 'active', 'Lớp 9', NULL, '', '2026-05-16 12:48:22', '2026-05-16 12:48:22'),
(48, 69, NULL, 'active', 'Lớp 9', NULL, '', '2026-05-16 12:48:45', '2026-05-16 12:48:45'),
(49, 70, NULL, 'active', 'Lớp 9', NULL, '', '2026-05-16 12:49:07', '2026-05-16 12:49:07'),
(50, 71, NULL, 'active', 'Lớp 9', NULL, '', '2026-05-16 12:49:28', '2026-05-16 12:49:28'),
(51, 72, NULL, 'active', 'Lớp 9', NULL, '', '2026-05-16 12:49:49', '2026-05-16 12:49:49'),
(52, 73, NULL, 'active', 'Lớp 9', NULL, '', '2026-05-16 12:50:17', '2026-05-16 12:50:17'),
(53, 74, NULL, 'active', 'Lớp 8', NULL, '', '2026-05-16 12:53:53', '2026-05-16 12:53:53'),
(54, 75, NULL, 'active', 'Lớp 8', NULL, '', '2026-05-16 12:54:22', '2026-05-16 12:54:22'),
(55, 76, NULL, 'active', 'Lớp 8', NULL, '', '2026-05-16 12:54:48', '2026-05-16 12:54:48'),
(56, 77, NULL, 'active', 'Lớp 8', NULL, '', '2026-05-16 12:55:22', '2026-05-16 12:55:22'),
(57, 78, NULL, 'active', 'Lớp 8', NULL, '', '2026-05-16 12:56:05', '2026-05-16 12:56:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','teacher','student','boss','assistant') NOT NULL DEFAULT 'student',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@educore.me', 'admin', '$2y$12$Mp6dAUynsoqbhIVqWv1aoe7tsLV53R85147ENXrIGjcgtlYI6Qrxy', 'admin', 1, 'DuUo2Cv1h2bjQHhWENAuA7550A8f4NsZLKIEjx9nTMixIt5qnr4iDmjC4B6s', '2026-01-29 07:04:48', '2026-01-29 07:04:48'),
(4, 'Trần Văn Nam', 'trầnvănnam@educore.test', '0984967439', '$2y$12$1vmiliWiH6V0ksG5ggrSI.AHQrbV/oUUJM6fwzGPKvbaohG.CAS8m', 'teacher', 1, NULL, '2026-01-29 07:04:48', '2026-03-21 09:27:38'),
(12, 'Trần Thị Bình', NULL, '0970121013', '$2y$12$sNyfEPqGAcgkxkApCRtceuWD5q/75RC22nXsz00R/s.PqhpMlsb4O', 'student', 1, NULL, '2026-01-29 07:04:51', '2026-05-18 14:04:38'),
(13, 'Lê Hoàng Cường', 'cuong@educore.test', '0929379704', '$2y$12$EGTYByRYW.hElPNrnwBMmu0VpEMJp/E8.vx.vTt.pU8eB9bqGNuHG', 'student', 1, NULL, '2026-01-29 07:04:51', '2026-05-18 14:03:44'),
(17, 'Đỗ Minh Giang', 'minhgiang@educore.test', '0966078241', '$2y$12$dUXmCFTU7v/gmwXhNT5rG.wKKBWqhPGb7MDf4uOnCVAWerk930bW6', 'student', 1, NULL, '2026-01-29 07:04:52', '2026-03-23 07:48:38'),
(19, 'Bùi Văn Hùng', 'buivanhung@educore.test', '0969851233', '$2y$12$BuoYBex5Jn/BFm7uk426AOWXJe2plRuPJ5iEb6g3xkqyTODC.oJly', 'student', 1, NULL, '2026-01-29 07:04:53', '2026-03-21 08:02:13'),
(21, 'Đinh Văn Long', 'long@educore.test', '0956721421', '$2y$12$7hd9B36kzuwxnJsDD1x7XejfWjw/i72kBlxyjMdUn2rgmoChvRwku', 'student', 1, NULL, '2026-01-29 07:04:53', '2026-03-23 07:48:26'),
(23, 'Hồ Văn Nam', 'nam@educore.test', '0952413676', '$2y$12$tOtWIG9IWjuXd7Vf7a0t1uV6JL6UQRQyVB8/rBanY6NSsoUnTIQ4W', 'student', 1, NULL, '2026-01-29 07:04:54', '2026-03-23 07:48:51'),
(24, 'Dương Thị Ngọc', 'ngoc@educore.test', '0929926056', '$2y$12$aK1PsGZZN4.QPlkXBvxmG.AL90YMktwsheYMsXwUQtlO3BR0u808K', 'student', 1, NULL, '2026-01-29 07:04:54', '2026-03-23 07:46:35'),
(30, 'Phan Thị Uyên', 'puyen@educore.test', '0920784935', '$2y$12$mzT7Ch8SLfpw6EWfHIIz8erdzJf26uuzub9jQZYiQEmcusRiTaQki', 'student', 1, NULL, '2026-01-29 07:04:56', '2026-05-18 14:04:20'),
(31, 'Hoàng Văn Việt', 'viet@educore.test', '0958383047', '$2y$12$HPPJgoF2uYcB.kGDDcSheO172iR88z2IJg.jzY/74lpaubVxvjVf.', 'student', 1, NULL, '2026-01-29 07:04:56', '2026-05-18 14:04:04'),
(32, 'Trần Thị Xuân', 'xuan@educore.test', '0955129133', '$2y$12$SSCnjPUzB0oGW8nRGwIZjOeSR0paT18pAVW4XGxzamKFaJBWi5j7O', 'student', 1, NULL, '2026-01-29 07:04:56', '2026-03-23 07:47:16'),
(34, 'Đỗ Thị Thúy', 'thuy@educore.test', '0924845177', '$2y$12$.4l5iz63DkZw78N9JbM66.gwvQ315TJg2BCiolT/6TQd.ooK1t4xq', 'student', 1, NULL, '2026-01-29 07:04:57', '2026-03-23 08:06:02'),
(36, 'Trần Thị Lan Anh', 'student@educore.test', '0900000000', '$2y$12$kL1mLfn5wgall8KBZPjdWOgu2h46OSw0naQ2UFN7.uSl4ZbCDgRxG', 'student', 1, '8SGzUQdTvARMpCUo8js8jJ1d9aQQrZPZLzsNvcWmtmgbUJMEcL9TVpa0TOes', '2026-01-29 07:04:57', '2026-03-21 09:18:54'),
(37, 'DINH THI QUYNH ANH', 'anhiu299@gmail.com', '0356819205', '$2y$12$MAASR/khhzZqOB15UShj1eeAq6EOEGBOGB64BVjRYWDQgs8tirHpu', 'student', 1, 'YYTUkeRwS24fOA9Yji6X9d0PLS8omXpbTq494vYs0448zgmRZcikgDSHtSuh', '2026-02-01 08:10:25', '2026-02-01 08:10:25'),
(38, 'Dinh Thi Quynh Anh', '26a4041204@hvnh.edu.vn', '0356819209', '$2y$12$MGYZlxjB9ZNpDgDAjS.1guMpmgGQu5uPvBjPe22xc9bxtn.JysnMK', 'teacher', 1, '6HwpXeOYwBT0LSd2LQwgV5hYt4mURZW3F0XkCbsTEtepbTEraokPSpaLyP1e', '2026-02-01 08:52:46', '2026-03-21 09:18:24'),
(40, 'Thiều Thủy Ngân', 'Ngan@gmail.com', '0966262371', '$2y$12$/X9fZKcbxgwdfRYkjlqO0OJByVSJqzBNz7RKjLuM8xJYrCpuz6pzG', 'boss', 1, 'N52BMcty9B5RtMuiBDmNz210qpb9AcO7ll7tKZTXNk9qOXYSQdMo9rO9fL9g', NULL, '2026-05-05 02:44:54'),
(41, 'Vũ Phương Anh', '26a4041213@hvnh.edu', '0357263475', '$2y$12$1Dgy8367Figlr3E.aW6GsOjPT.CRVkVeFFXu5xUT8vqHEtH6oTkIu', 'assistant', 1, 'DDA8pM7IXFLwCFP7uGQCapkTXHZty3lyPseVOsLhgCNlrmFrHTf09XSAhvIp', '2026-05-05 09:16:14', '2026-05-12 06:29:12'),
(42, 'Nguyễn Thị Hải Vân', NULL, '0352047288', '$2y$12$wzWEWInKS7OJsxsTyRAee.C7.T3Pb3aIuiTP.t83ZbQvXVB.MqPJu', 'assistant', 1, NULL, '2026-05-06 07:29:30', '2026-05-06 07:29:30'),
(43, 'Nguyễn Thị Huyền Trang', 'trangnth@gmail.com', '0397854170', '$2y$12$I40H1oBRcqT7r.DZhWxosOMTID2jrFJIMCc.EqikK6x7E5cqUifIe', 'teacher', 1, NULL, '2026-05-08 10:12:41', '2026-05-08 10:12:41'),
(44, 'Nguyễn Ngọc Hùng', 'hungnn@gmail.com', '0397854171', '$2y$12$xkEaldqCDafQrnPudZO72OX.lBMX7heMd57HdDBoubE70gyEMJKy.', 'student', 1, NULL, '2026-05-08 10:17:03', '2026-05-08 10:17:03'),
(45, 'Hoàng Gia Hân', 'hanhg@gmail.com', '0397854172', '$2y$12$7RuJ8bPcUjAAccX2gPSgY.09VxQ0awShI7Tg1BQ9S7sTDD6FZCEOa', 'student', 1, NULL, '2026-05-08 10:18:17', '2026-05-08 10:18:17'),
(46, 'Phạm Bảo Ngọc', 'ngocpb@gmail.com', '0397854173', '$2y$12$nqqqOZItgGXgGWlBW.cZNOYKF5KBlhA0uVp6JfUv2CqvpjOGUCkn2', 'student', 1, NULL, '2026-05-08 10:20:03', '2026-05-08 10:20:03'),
(47, 'Lê Nguyên Gia Bảo', 'baolng@gmail.com', '0397854174', '$2y$12$ZXMcb7rW5/VZ7vfVRwcIbOD5je2W3h3k6AxUoFYWCymOsNhsODLXy', 'student', 1, 'VTx3cApjKhNAQaOhtWTgX3INjGTL24fqgWO3rIFfPWFWVXNXIfrImOjs6AW0', '2026-05-08 10:21:26', '2026-05-08 10:21:26'),
(48, 'Trần Văn Cao', NULL, '0357263476', '$2y$12$u8OH9xBLUDqmtHXN5.8iF.q8ES5Ph0KViUNuLOxMFfI.oleP5DZ4O', 'assistant', 1, NULL, '2026-05-16 09:14:27', '2026-05-16 09:14:27'),
(49, 'Vũ Thị Ánh Nguyệt', NULL, '0357263477', '$2y$12$b4nnOhl5ea2S05016AYVkevurOyM4Zz7Ugx45JSZzy/s5kK/A4Z2y', 'assistant', 1, NULL, '2026-05-16 09:14:59', '2026-05-16 09:14:59'),
(50, 'Đinh Thị Ngọc', NULL, '0357263478', '$2y$12$xaNtIMjXMWdh0asu3mb.K.cZuaNbUAnysmjuqJfVWrecf.XnACkWm', 'assistant', 1, NULL, '2026-05-16 09:16:31', '2026-05-16 09:16:31'),
(51, 'Nguyễn Ngân', NULL, '0990291799', '$2y$12$.i04GQpi9xLBJ4hwkG/LW.qo6wEbAMhSMwh4c2dSeUPrKvx71nROC', 'student', 1, NULL, '2026-05-16 09:55:58', '2026-05-16 09:55:58'),
(57, 'Ngô Thị Cúc', NULL, '0356819291', '$2y$12$eoKsZh63lAD06RFiRuJq.eyIGvbDn2C8.Fe6ziDHlgJlrBTl9j9u2', 'student', 1, NULL, '2026-05-16 10:39:10', '2026-05-16 10:39:10'),
(58, 'Ngô Thị Mai', NULL, '0966262374', '$2y$12$XOZ.yx.NB2QibN.gfGD6Z.4jqlWCT32Dda54MSZLrndo7leDtn.cm', 'student', 1, NULL, '2026-05-16 10:57:14', '2026-05-16 10:57:14'),
(59, 'Ngô Văn Bảo', NULL, '0356812222', '$2y$12$DUluBbXPLXELZIqYBxN6W.9AfQ.UEykNQeYkKthpoM1njK.Wfuk4.', 'student', 1, NULL, '2026-05-16 11:10:22', '2026-05-16 11:10:22'),
(60, 'Hoàng Vy', 'dinhanh99@gmail.com', '0356819266', '$2y$12$/V/ZOPdTrNMy6.oBX2Ib1OiSyFwVvlXZbmKWF5tnsvqnaXS.BEcU6', 'student', 1, NULL, '2026-05-16 12:29:49', '2026-05-16 12:29:49'),
(61, 'Trần Nguyệt Anh', 'dinhanh@gmail.com', '0356719209', '$2y$12$7v.qvxa8IcuhukaHB4h0beLeivlHFg2EPLVgZ/Q8PdH/sSmYOL3we', 'student', 1, NULL, '2026-05-16 12:41:24', '2026-05-16 12:41:24'),
(62, 'Hoàng Vân', 'dinhvan99@gmail.com', '0952047233', '$2y$12$k7x4Migb1TzDqFGoYvveZeE8J2TqbP5VYQMtlQItqPvZnoL1yg/6C', 'student', 1, NULL, '2026-05-16 12:42:02', '2026-05-16 12:42:02'),
(63, 'Đinh Nam', 'hanh99@gmail.com', '0652047266', '$2y$12$.HImzWSEMv/W3o1DDRUIc.Zd4ZSqr4ZaVF33iUoFQlJtyVuGCKCs2', 'student', 1, NULL, '2026-05-16 12:42:35', '2026-05-16 12:42:35'),
(64, 'Đinh Chiến', 'dinhchien@gmail.com', '0456286199', '$2y$12$iarL6wobE5PZiGYB2Nx/SeiVADlp13aI9spidJA1ttFV46iSe2hLq', 'student', 1, NULL, '2026-05-16 12:45:13', '2026-05-16 12:45:13'),
(65, 'Đỗ Tuân', 'dint@gmail.com', '062869568', '$2y$12$DzdxYH2UXCbIJ8mwE8CIU..emlmVV5AQ5JJrb7S49/cZiapNWkmyW', 'student', 1, NULL, '2026-05-16 12:45:44', '2026-05-16 12:45:44'),
(66, 'Đỗ Tuấn', '2hanh99@gmail.com', '072529362', '$2y$12$BMiT167csWbSqO61UUDmLuXByn/n75YUvNzzwZ4sZl1ayfRXDCXoq', 'student', 1, NULL, '2026-05-16 12:46:09', '2026-05-16 12:46:09'),
(67, 'Hoàng Xuân', 'dinhanh00@gmail.com', '0725686344', '$2y$12$2by/.4asuFtWjg9v46TrIugDfjCQ6y.n2HsNdKNC6jBg6hBVyRx2e', 'student', 1, NULL, '2026-05-16 12:46:40', '2026-05-16 12:46:40'),
(68, 'Trịnh Hải Linh', 'linh88@gmail.com', '0987678678', '$2y$12$wAM3j/tGIZxwcL.yGMnRQuQspIhD2QRfzKehml1sKmUmf.4QCEOQa', 'student', 1, NULL, '2026-05-16 12:48:22', '2026-05-16 12:48:22'),
(69, 'Lê Linh', 'dinhl@gmail.com', '0934562341', '$2y$12$AsfL0CZbcUocDUW2LXcYDOKm0OqljBMGa0jTuCETR4kmupj6LnNwi', 'student', 1, NULL, '2026-05-16 12:48:45', '2026-05-16 12:48:45'),
(70, 'Hoàng Linh', 'linhanh99@gmail.com', '0563451876', '$2y$12$Ei.7N7xTN0BJAu47n7AAiOtcGb60wycYIXjgHjA6vJZvBHLzdNUGu', 'student', 1, NULL, '2026-05-16 12:49:07', '2026-05-16 12:49:07'),
(71, 'Tuệ Linh', 'dhrfh@gmail.com', '0747367425', '$2y$12$aR0WwApXQp/VtK/.plRwr.gCYcq1iLTVquhxb4tWdagqemlWiHBYW', 'student', 1, NULL, '2026-05-16 12:49:28', '2026-05-16 12:49:28'),
(72, 'Yến Linh', 'di9@gmail.com', '0653472567', '$2y$12$hJrldUND2.QEYD06zFl05.88zxmJKVbAn6geiqFjKeDhuVaBnaU3m', 'student', 1, NULL, '2026-05-16 12:49:49', '2026-05-16 12:49:49'),
(73, 'Lâm Trúc Linh', 'ditrfs99@gmail.com', '0567345125', '$2y$12$tjGhAoAMpG7StaD3vOIcPObTT7I5ybp8nj7P21SFgRTEfcxaBnV.y', 'student', 1, NULL, '2026-05-16 12:50:17', '2026-05-16 12:50:17'),
(74, 'Nguyễn Thu Trang', 'dinhtrang9@gmail.com', '0754863452', '$2y$12$1uvSO9mfLtYQzWZh1DgpcuTec2RO/NA.P6xpjAIbgYPEtNlKo08ke', 'student', 1, NULL, '2026-05-16 12:53:53', '2026-05-16 12:53:53'),
(75, 'Nguyễn Ngọc Châm', 'dinhcham@gmail.com', '065347654', '$2y$12$fT4qGhFzqtFOhWD.d/Wjpuaw6KoSOnp9U2x7424KJ0Q.eWJNZ/Mzm', 'student', 1, NULL, '2026-05-16 12:54:22', '2026-05-16 12:54:22'),
(76, 'Hoàng Nguyên', 'nguyenn@gmail.com', '0865467544', '$2y$12$JlvnhjU0uPtEMhtYUGwns.VQZLIDoEIRw9angapDkgAlnv6QxhwLi', 'student', 1, NULL, '2026-05-16 12:54:48', '2026-05-16 12:54:48'),
(77, 'Phạm Thu Hà', 'haanh99@gmail.com', '0762047655', '$2y$12$L8REa5hFGPGU7UHpMUR.N.OzLIzhjUNN6jDXfGfR9E/BLfcW.Q4C6', 'student', 1, NULL, '2026-05-16 12:55:22', '2026-05-16 12:55:22'),
(78, 'Nguyễn Ngọc Chang', 'nh99@gmail.com', '0757624566', '$2y$12$zUEcME2OE.40MLuZN/qQ2uoHjQDN08hMg0dHxF8UakjpXyMPCUtIm', 'student', 1, NULL, '2026-05-16 12:56:05', '2026-05-16 12:56:05');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignments_class_id_foreign` (`class_id`);

--
-- Chỉ mục cho bảng `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_class_id_date_index` (`class_id`,`date`),
  ADD KEY `attendances_student_id_date_index` (`student_id`,`date`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `class_user`
--
ALTER TABLE `class_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_user_class_id_foreign` (`class_id`),
  ADD KEY `class_user_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `evaluations_student_id_evaluation_round_id_unique` (`student_id`,`evaluation_round_id`),
  ADD KEY `evaluations_evaluation_round_id_foreign` (`evaluation_round_id`);

--
-- Chỉ mục cho bảng `evaluation_questions`
--
ALTER TABLE `evaluation_questions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `evaluation_rounds`
--
ALTER TABLE `evaluation_rounds`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_staff_id_foreign` (`staff_id`),
  ADD KEY `expenses_class_id_foreign` (`class_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_class` (`class_id`),
  ADD KEY `fk_student` (`student_id`),
  ADD KEY `fk_teacher` (`teacher_id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_classroom_id_foreign` (`classroom_id`);

--
-- Chỉ mục cho bảng `lesson_user`
--
ALTER TABLE `lesson_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lesson_user_user_id_lesson_id_unique` (`user_id`,`lesson_id`),
  ADD KEY `lesson_user_lesson_id_foreign` (`lesson_id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`),
  ADD KEY `messages_class_id_foreign` (`class_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_class_id_foreign` (`class_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_class_id_foreign` (`class_id`);

--
-- Chỉ mục cho bảng `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_class_id_foreign` (`class_id`);

--
-- Chỉ mục cho bảng `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_results_quiz_id_foreign` (`quiz_id`),
  ADD KEY `quiz_results_student_id_foreign` (`student_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT cho bảng `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `class_user`
--
ALTER TABLE `class_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT cho bảng `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `evaluation_questions`
--
ALTER TABLE `evaluation_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `evaluation_rounds`
--
ALTER TABLE `evaluation_rounds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `lesson_user`
--
ALTER TABLE `lesson_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `class_user`
--
ALTER TABLE `class_user`
  ADD CONSTRAINT `class_user_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_evaluation_round_id_foreign` FOREIGN KEY (`evaluation_round_id`) REFERENCES `evaluation_rounds` (`id`),
  ADD CONSTRAINT `evaluations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classrooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expenses_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `fk_class` FOREIGN KEY (`class_id`) REFERENCES `classrooms` (`id`),
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `lesson_user`
--
ALTER TABLE `lesson_user`
  ADD CONSTRAINT `lesson_user_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
