-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 22-03-27 09:58
-- 서버 버전: 10.4.22-MariaDB
-- PHP 버전: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `2022_2`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `event`
--

CREATE TABLE `event` (
  `name` text NOT NULL,
  `tel` text NOT NULL,
  `date` text NOT NULL,
  `conDate` text NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `event`
--

INSERT INTO `event` (`name`, `tel`, `date`, `conDate`, `score`) VALUES
('wnsdn', '000-0000-0000', '2022-03-23', '1', 8),
('wnsdn', '000-0000-0000', '2022-03-24', '2', 8),
('wnsdnn', '000-0000-0001', '2022-03-24', '1', 8);

-- --------------------------------------------------------

--
-- 테이블 구조 `review`
--

CREATE TABLE `review` (
  `sn` int(11) NOT NULL,
  `name` text NOT NULL,
  `product` text NOT NULL,
  `shop` text NOT NULL,
  `purchase_date` text NOT NULL,
  `contents` text NOT NULL,
  `score` text NOT NULL,
  `photo` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `specialty`
--

CREATE TABLE `specialty` (
  `area` text NOT NULL,
  `img` text NOT NULL,
  `specialty` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `specialty`
--

INSERT INTO `specialty` (`area`, `img`, `specialty`) VALUES
('창원시', '창원시_풋고추.jpg', '445'),
('진주시', '', 'ㅂㅂ'),
('통영시', '통영시_굴.jpg', '굴'),
('사천시', '사천시_멸치.jpg', '멸치'),
('김해시', '김해시_단감.jpg', '단감'),
('밀양시', '밀양시_대추.jpg', '대추'),
('거제시', '거제시_유자.jpg', '유자'),
('양산시', '양산시_매실.jpg', '매실'),
('의령군', '의령군_수박.jpg', '수박'),
('함안군', '함안군_곶감.jpg', '곶감'),
('창녕군', '창녕군_양파.jpg', '양파'),
('고성군', '고성군_방울토마토.jpg', '방울토마토'),
('남해군', '남해군_마늘.jpg', '마늘'),
('하동군', '하동군_녹차.jpg', '녹차'),
('산청군', '산청군_약초.jpg', '약초'),
('함양군', '함양군_밤.jpg', '밤'),
('거창군', '거창군_사과.jpg', '사과'),
('합천군', '합천군_돼지고기.jpg', '돼지고기');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
