-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 12, 2023 at 04:29 AM
-- Server version: 5.7.43
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlmjcoders_shkalah`
--

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_account_type`
--

CREATE TABLE `shkalah_account_type` (
  `type_id` int(11) NOT NULL,
  `type_name` text NOT NULL,
  `type_name_ar` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type_category` enum('Individual','Company','Both') NOT NULL DEFAULT 'Both',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_account_type`
--

INSERT INTO `shkalah_account_type` (`type_id`, `type_name`, `type_name_ar`, `image`, `type_category`, `status`) VALUES
(1, 'Admission', '', 'uploads/imgs/admission.jpeg', 'Both', 'Active'),
(2, 'Sponsership', '', 'uploads/imgs/sponsorship.jpeg', 'Both', 'Active'),
(3, 'Delivery', '', 'uploads/imgs/delivery.jpeg', 'Both', 'Active'),
(4, 'Temporary worker', '', 'uploads/imgs/temporary_worker.jpeg', 'Both', 'Active'),
(5, 'Security', '', 'uploads/imgs/security.jpeg', 'Company', 'Active'),
(6, 'Cleaning', '', 'uploads/imgs/cleaning.png', 'Company', 'Active'),
(7, 'Hospitality', '', 'uploads/imgs/hospitality.jpeg', 'Company', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_company`
--

CREATE TABLE `shkalah_company` (
  `company_id` int(11) NOT NULL,
  `en_name` varchar(256) NOT NULL,
  `ar_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_complains`
--

CREATE TABLE `shkalah_complains` (
  `complain_id` int(11) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `type` enum('Complain','Suggestion') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_complains`
--

INSERT INTO `shkalah_complains` (`complain_id`, `message`, `dept_id`, `type`, `status`, `user_id`) VALUES
(13, 'test', 1, 'Suggestion', 'Active', 2147483647),
(12, 'test test test', 2, 'Complain', 'Active', 20),
(11, 'test test test', 1, 'Complain', 'Active', 20),
(14, 'complain 1\nالشكوى الا ولي للتجريب من قبل مستخدم اول شركة بالتطبيق', 1, 'Complain', 'Active', 52),
(15, 'kindly help me to find washing and cleaning maid it\'s urgent ????', 1, 'Complain', 'Active', 51),
(16, 'cfdhff\nhfghjjj\njgfgh', 2, 'Suggestion', 'Active', 20);

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_countries`
--

CREATE TABLE `shkalah_countries` (
  `country_id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shkalah_countries`
--

INSERT INTO `shkalah_countries` (`country_id`, `sortname`, `name`, `phonecode`, `status`) VALUES
(1, 'AF', 'Afghanistan', 93, 'Active'),
(2, 'AL', 'Albania', 355, 'Active'),
(3, 'DZ', 'Algeria', 213, 'Active'),
(4, 'AS', 'American Samoa', 1684, 'Active'),
(5, 'AD', 'Andorra', 376, 'Active'),
(6, 'AO', 'Angola', 244, 'Active'),
(7, 'AI', 'Anguilla', 1264, 'Active'),
(8, 'AQ', 'Antarctica', 0, 'Active'),
(9, 'AG', 'Antigua And Barbuda', 1268, 'Active'),
(10, 'AR', 'Argentina', 54, 'Active'),
(11, 'AM', 'Armenia', 374, 'Active'),
(12, 'AW', 'Aruba', 297, 'Active'),
(13, 'AU', 'Australia', 61, 'Active'),
(14, 'AT', 'Austria', 43, 'Active'),
(15, 'AZ', 'Azerbaijan', 994, 'Active'),
(16, 'BS', 'Bahamas The', 1242, 'Active'),
(17, 'BH', 'Bahrain', 973, 'Active'),
(18, 'BD', 'Bangladesh', 880, 'Active'),
(19, 'BB', 'Barbados', 1246, 'Active'),
(20, 'BY', 'Belarus', 375, 'Active'),
(21, 'BE', 'Belgium', 32, 'Active'),
(22, 'BZ', 'Belize', 501, 'Active'),
(23, 'BJ', 'Benin', 229, 'Active'),
(24, 'BM', 'Bermuda', 1441, 'Active'),
(25, 'BT', 'Bhutan', 975, 'Active'),
(26, 'BO', 'Bolivia', 591, 'Active'),
(27, 'BA', 'Bosnia and Herzegovina', 387, 'Active'),
(28, 'BW', 'Botswana', 267, 'Active'),
(29, 'BV', 'Bouvet Island', 0, 'Active'),
(30, 'BR', 'Brazil', 55, 'Active'),
(31, 'IO', 'British Indian Ocean Territory', 246, 'Active'),
(32, 'BN', 'Brunei', 673, 'Active'),
(33, 'BG', 'Bulgaria', 359, 'Active'),
(34, 'BF', 'Burkina Faso', 226, 'Active'),
(35, 'BI', 'Burundi', 257, 'Active'),
(36, 'KH', 'Cambodia', 855, 'Active'),
(37, 'CM', 'Cameroon', 237, 'Active'),
(38, 'CA', 'Canada', 1, 'Active'),
(39, 'CV', 'Cape Verde', 238, 'Active'),
(40, 'KY', 'Cayman Islands', 1345, 'Active'),
(41, 'CF', 'Central African Republic', 236, 'Active'),
(42, 'TD', 'Chad', 235, 'Active'),
(43, 'CL', 'Chile', 56, 'Active'),
(44, 'CN', 'China', 86, 'Active'),
(45, 'CX', 'Christmas Island', 61, 'Active'),
(46, 'CC', 'Cocos (Keeling) Islands', 672, 'Active'),
(47, 'CO', 'Colombia', 57, 'Active'),
(48, 'KM', 'Comoros', 269, 'Active'),
(49, 'CG', 'Republic Of The Congo', 242, 'Active'),
(50, 'CD', 'Democratic Republic Of The Congo', 242, 'Active'),
(51, 'CK', 'Cook Islands', 682, 'Active'),
(52, 'CR', 'Costa Rica', 506, 'Active'),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225, 'Active'),
(54, 'HR', 'Croatia (Hrvatska)', 385, 'Active'),
(55, 'CU', 'Cuba', 53, 'Active'),
(56, 'CY', 'Cyprus', 357, 'Active'),
(57, 'CZ', 'Czech Republic', 420, 'Active'),
(58, 'DK', 'Denmark', 45, 'Active'),
(59, 'DJ', 'Djibouti', 253, 'Active'),
(60, 'DM', 'Dominica', 1767, 'Active'),
(61, 'DO', 'Dominican Republic', 1809, 'Active'),
(62, 'TP', 'East Timor', 670, 'Active'),
(63, 'EC', 'Ecuador', 593, 'Active'),
(64, 'EG', 'Egypt', 20, 'Active'),
(65, 'SV', 'El Salvador', 503, 'Active'),
(66, 'GQ', 'Equatorial Guinea', 240, 'Active'),
(67, 'ER', 'Eritrea', 291, 'Active'),
(68, 'EE', 'Estonia', 372, 'Active'),
(69, 'ET', 'Ethiopia', 251, 'Active'),
(70, 'XA', 'External Territories of Australia', 61, 'Active'),
(71, 'FK', 'Falkland Islands', 500, 'Active'),
(72, 'FO', 'Faroe Islands', 298, 'Active'),
(73, 'FJ', 'Fiji Islands', 679, 'Active'),
(74, 'FI', 'Finland', 358, 'Active'),
(75, 'FR', 'France', 33, 'Active'),
(76, 'GF', 'French Guiana', 594, 'Active'),
(77, 'PF', 'French Polynesia', 689, 'Active'),
(78, 'TF', 'French Southern Territories', 0, 'Active'),
(79, 'GA', 'Gabon', 241, 'Active'),
(80, 'GM', 'Gambia The', 220, 'Active'),
(81, 'GE', 'Georgia', 995, 'Active'),
(82, 'DE', 'Germany', 49, 'Active'),
(83, 'GH', 'Ghana', 233, 'Active'),
(84, 'GI', 'Gibraltar', 350, 'Active'),
(85, 'GR', 'Greece', 30, 'Active'),
(86, 'GL', 'Greenland', 299, 'Active'),
(87, 'GD', 'Grenada', 1473, 'Active'),
(88, 'GP', 'Guadeloupe', 590, 'Active'),
(89, 'GU', 'Guam', 1671, 'Active'),
(90, 'GT', 'Guatemala', 502, 'Active'),
(91, 'XU', 'Guernsey and Alderney', 44, 'Active'),
(92, 'GN', 'Guinea', 224, 'Active'),
(93, 'GW', 'Guinea-Bissau', 245, 'Active'),
(94, 'GY', 'Guyana', 592, 'Active'),
(95, 'HT', 'Haiti', 509, 'Active'),
(96, 'HM', 'Heard and McDonald Islands', 0, 'Active'),
(97, 'HN', 'Honduras', 504, 'Active'),
(98, 'HK', 'Hong Kong S.A.R.', 852, 'Active'),
(99, 'HU', 'Hungary', 36, 'Active'),
(100, 'IS', 'Iceland', 354, 'Active'),
(101, 'IN', 'India', 91, 'Active'),
(102, 'ID', 'Indonesia', 62, 'Active'),
(103, 'IR', 'Iran', 98, 'Active'),
(104, 'IQ', 'Iraq', 964, 'Active'),
(105, 'IE', 'Ireland', 353, 'Active'),
(106, 'IL', 'Israel', 972, 'Active'),
(107, 'IT', 'Italy', 39, 'Active'),
(108, 'JM', 'Jamaica', 1876, 'Active'),
(109, 'JP', 'Japan', 81, 'Active'),
(110, 'XJ', 'Jersey', 44, 'Active'),
(111, 'JO', 'Jordan', 962, 'Active'),
(112, 'KZ', 'Kazakhstan', 7, 'Active'),
(113, 'KE', 'Kenya', 254, 'Active'),
(114, 'KI', 'Kiribati', 686, 'Active'),
(115, 'KP', 'Korea North', 850, 'Active'),
(116, 'KR', 'Korea South', 82, 'Active'),
(117, 'KW', 'Kuwait', 965, 'Active'),
(118, 'KG', 'Kyrgyzstan', 996, 'Active'),
(119, 'LA', 'Laos', 856, 'Active'),
(120, 'LV', 'Latvia', 371, 'Active'),
(121, 'LB', 'Lebanon', 961, 'Active'),
(122, 'LS', 'Lesotho', 266, 'Active'),
(123, 'LR', 'Liberia', 231, 'Active'),
(124, 'LY', 'Libya', 218, 'Active'),
(125, 'LI', 'Liechtenstein', 423, 'Active'),
(126, 'LT', 'Lithuania', 370, 'Active'),
(127, 'LU', 'Luxembourg', 352, 'Active'),
(128, 'MO', 'Macau S.A.R.', 853, 'Active'),
(129, 'MK', 'Macedonia', 389, 'Active'),
(130, 'MG', 'Madagascar', 261, 'Active'),
(131, 'MW', 'Malawi', 265, 'Active'),
(132, 'MY', 'Malaysia', 60, 'Active'),
(133, 'MV', 'Maldives', 960, 'Active'),
(134, 'ML', 'Mali', 223, 'Active'),
(135, 'MT', 'Malta', 356, 'Active'),
(136, 'XM', 'Man (Isle of)', 44, 'Active'),
(137, 'MH', 'Marshall Islands', 692, 'Active'),
(138, 'MQ', 'Martinique', 596, 'Active'),
(139, 'MR', 'Mauritania', 222, 'Active'),
(140, 'MU', 'Mauritius', 230, 'Active'),
(141, 'YT', 'Mayotte', 269, 'Active'),
(142, 'MX', 'Mexico', 52, 'Active'),
(143, 'FM', 'Micronesia', 691, 'Active'),
(144, 'MD', 'Moldova', 373, 'Active'),
(145, 'MC', 'Monaco', 377, 'Active'),
(146, 'MN', 'Mongolia', 976, 'Active'),
(147, 'MS', 'Montserrat', 1664, 'Active'),
(148, 'MA', 'Morocco', 212, 'Active'),
(149, 'MZ', 'Mozambique', 258, 'Active'),
(150, 'MM', 'Myanmar', 95, 'Active'),
(151, 'NA', 'Namibia', 264, 'Active'),
(152, 'NR', 'Nauru', 674, 'Active'),
(153, 'NP', 'Nepal', 977, 'Active'),
(154, 'AN', 'Netherlands Antilles', 599, 'Active'),
(155, 'NL', 'Netherlands The', 31, 'Active'),
(156, 'NC', 'New Caledonia', 687, 'Active'),
(157, 'NZ', 'New Zealand', 64, 'Active'),
(158, 'NI', 'Nicaragua', 505, 'Active'),
(159, 'NE', 'Niger', 227, 'Active'),
(160, 'NG', 'Nigeria', 234, 'Active'),
(161, 'NU', 'Niue', 683, 'Active'),
(162, 'NF', 'Norfolk Island', 672, 'Active'),
(163, 'MP', 'Northern Mariana Islands', 1670, 'Active'),
(164, 'NO', 'Norway', 47, 'Active'),
(165, 'OM', 'Oman', 968, 'Active'),
(166, 'PK', 'Pakistan', 92, 'Active'),
(167, 'PW', 'Palau', 680, 'Active'),
(168, 'PS', 'Palestinian Territory Occupied', 970, 'Active'),
(169, 'PA', 'Panama', 507, 'Active'),
(170, 'PG', 'Papua new Guinea', 675, 'Active'),
(171, 'PY', 'Paraguay', 595, 'Active'),
(172, 'PE', 'Peru', 51, 'Active'),
(173, 'PH', 'Philippines', 63, 'Active'),
(174, 'PN', 'Pitcairn Island', 0, 'Active'),
(175, 'PL', 'Poland', 48, 'Active'),
(176, 'PT', 'Portugal', 351, 'Active'),
(177, 'PR', 'Puerto Rico', 1787, 'Active'),
(178, 'QA', 'Qatar', 974, 'Active'),
(179, 'RE', 'Reunion', 262, 'Active'),
(180, 'RO', 'Romania', 40, 'Active'),
(181, 'RU', 'Russia', 70, 'Active'),
(182, 'RW', 'Rwanda', 250, 'Active'),
(183, 'SH', 'Saint Helena', 290, 'Active'),
(184, 'KN', 'Saint Kitts And Nevis', 1869, 'Active'),
(185, 'LC', 'Saint Lucia', 1758, 'Active'),
(186, 'PM', 'Saint Pierre and Miquelon', 508, 'Active'),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784, 'Active'),
(188, 'WS', 'Samoa', 684, 'Active'),
(189, 'SM', 'San Marino', 378, 'Active'),
(190, 'ST', 'Sao Tome and Principe', 239, 'Active'),
(191, 'SA', 'Saudi Arabia', 966, 'Active'),
(192, 'SN', 'Senegal', 221, 'Active'),
(193, 'RS', 'Serbia', 381, 'Active'),
(194, 'SC', 'Seychelles', 248, 'Active'),
(195, 'SL', 'Sierra Leone', 232, 'Active'),
(196, 'SG', 'Singapore', 65, 'Active'),
(197, 'SK', 'Slovakia', 421, 'Active'),
(198, 'SI', 'Slovenia', 386, 'Active'),
(199, 'XG', 'Smaller Territories of the UK', 44, 'Active'),
(200, 'SB', 'Solomon Islands', 677, 'Active'),
(201, 'SO', 'Somalia', 252, 'Active'),
(202, 'ZA', 'South Africa', 27, 'Active'),
(203, 'GS', 'South Georgia', 0, 'Active'),
(204, 'SS', 'South Sudan', 211, 'Active'),
(205, 'ES', 'Spain', 34, 'Active'),
(206, 'LK', 'Sri Lanka', 94, 'Active'),
(207, 'SD', 'Sudan', 249, 'Active'),
(208, 'SR', 'Suriname', 597, 'Active'),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47, 'Active'),
(210, 'SZ', 'Swaziland', 268, 'Active'),
(211, 'SE', 'Sweden', 46, 'Active'),
(212, 'CH', 'Switzerland', 41, 'Active'),
(213, 'SY', 'Syria', 963, 'Active'),
(214, 'TW', 'Taiwan', 886, 'Active'),
(215, 'TJ', 'Tajikistan', 992, 'Active'),
(216, 'TZ', 'Tanzania', 255, 'Active'),
(217, 'TH', 'Thailand', 66, 'Active'),
(218, 'TG', 'Togo', 228, 'Active'),
(219, 'TK', 'Tokelau', 690, 'Active'),
(220, 'TO', 'Tonga', 676, 'Active'),
(221, 'TT', 'Trinidad And Tobago', 1868, 'Active'),
(222, 'TN', 'Tunisia', 216, 'Active'),
(223, 'TR', 'Turkey', 90, 'Active'),
(224, 'TM', 'Turkmenistan', 7370, 'Active'),
(225, 'TC', 'Turks And Caicos Islands', 1649, 'Active'),
(226, 'TV', 'Tuvalu', 688, 'Active'),
(227, 'UG', 'Uganda', 256, 'Active'),
(228, 'UA', 'Ukraine', 380, 'Active'),
(229, 'AE', 'United Arab Emirates', 971, 'Active'),
(230, 'GB', 'United Kingdom', 44, 'Active'),
(231, 'US', 'United States', 1, 'Active'),
(232, 'UM', 'United States Minor Outlying Islands', 1, 'Active'),
(233, 'UY', 'Uruguay', 598, 'Active'),
(234, 'UZ', 'Uzbekistan', 998, 'Active'),
(235, 'VU', 'Vanuatu', 678, 'Active'),
(236, 'VA', 'Vatican City State (Holy See)', 39, 'Active'),
(237, 'VE', 'Venezuela', 58, 'Active'),
(238, 'VN', 'Vietnam', 84, 'Active'),
(239, 'VG', 'Virgin Islands (British)', 1284, 'Active'),
(240, 'VI', 'Virgin Islands (US)', 1340, 'Active'),
(241, 'WF', 'Wallis And Futuna Islands', 681, 'Active'),
(242, 'EH', 'Western Sahara', 212, 'Active'),
(243, 'YE', 'Yemen', 967, 'Active'),
(244, 'YU', 'Yugoslavia', 38, 'Active'),
(245, 'ZM', 'Zambia', 260, 'Active'),
(246, 'ZW', 'Zimbabwe', 263, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_department`
--

CREATE TABLE `shkalah_department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(256) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_department`
--

INSERT INTO `shkalah_department` (`dept_id`, `dept_name`, `status`) VALUES
(1, 'washing', 'Active'),
(2, 'cleaning', 'Active'),
(3, 'Mobile App', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_education`
--

CREATE TABLE `shkalah_education` (
  `edu_id` int(11) NOT NULL,
  `en_degree` text NOT NULL,
  `ar_degree` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_education`
--

INSERT INTO `shkalah_education` (`edu_id`, `en_degree`, `ar_degree`, `status`) VALUES
(1, 'Masters', 'ماجستير', 'Active'),
(2, 'Bachlors', 'بكالوريوس', 'Active'),
(5, 'llll', 'ليسانس', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_favourite`
--

CREATE TABLE `shkalah_favourite` (
  `favourite_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `reference` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_favourite`
--

INSERT INTO `shkalah_favourite` (`favourite_id`, `worker_id`, `reference`) VALUES
(52, 13, '19'),
(53, 12, '19'),
(54, 15, '18'),
(55, 16, '18'),
(61, 20, '237d53c809c36118'),
(68, 19, '8864707192fd3884'),
(73, 19, '24'),
(75, 22, '097a9175ca114071'),
(76, 22, 'e40e595d-601f-47e6-8132-f37627149d00'),
(77, 22, '8864707192fd3884'),
(78, 22, '51'),
(80, 23, '8864707192fd3884'),
(97, 27, '20'),
(98, 27, '22'),
(100, 29, 'e5ac7903e1afad58'),
(110, 28, 'c58185bd-ed4b-4cd9-b443-41c2ff3cf44a'),
(120, 29, 'c938ab9a3df2d353');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_language`
--

CREATE TABLE `shkalah_language` (
  `phrase_id` int(11) NOT NULL,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL,
  `arb` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shkalah_language`
--

INSERT INTO `shkalah_language` (`phrase_id`, `phrase`, `english`, `arb`) VALUES
(1, 'edit_language', '', 'تحرير اللغة'),
(2, 'visitor', '', 'زائر'),
(3, 'bartender', '', 'عامل البار'),
(4, 'bar_admin', '', ''),
(5, 'wholesaler', '', ''),
(6, 'documents', '', 'مستندات'),
(7, 'brands', '', 'العلامات التجارية'),
(8, 'sub_brands', '', ''),
(9, 'category', '', 'الفئة'),
(10, 'sub_category', '', ''),
(11, 'origin', '', ''),
(12, 'sub_origin', '', ''),
(13, 'products', '', ''),
(14, 'events_category', '', ''),
(15, 'events', '', ''),
(16, 'bars_category', '', ''),
(17, 'job_category', '', ''),
(18, 'job', '', ''),
(19, 'apply_jobs', '', ''),
(20, 'banners', '', 'لافتات'),
(21, 'settings', '', 'الإعدادات'),
(22, 'customers', '', 'عملاء'),
(23, 'through_our_brands_internationally_renowned_for_their_quality,_consistency,_and_most_importantly_their_uniqueness,_\r\nwe_work_with_on_and_off_trade_leaders_to_inspire_creativity_and_sophistication.', '', 'من خلال علاماتنا التجارية المشهورة عالميًا بجودتها واتساقها ، والأهم من ذلك تفردها ، نعمل مع قادة التجارة داخل وخارج الشركات لإلهام الإبداع والرقي.'),
(24, 'translation', '', 'ترجمة'),
(25, 'phrase', '', 'العبارة'),
(26, 'action', '', 'عمل'),
(27, 'save', '', 'حفظ'),
(28, 'text', '', 'نص'),
(29, 'option', '', 'اختيار'),
(30, 'title', '', 'لقب'),
(31, 'english', '', 'إنجليزي'),
(32, 'input_type', '', 'نوع الإدخال'),
(33, 'are_you_sure_to_take_this_action', '', 'هل أنت متأكد من اتخاذ هذا الإجراء'),
(34, 'Yes', '', 'نعم'),
(35, 'No', '', 'رقم'),
(36, 'en_degree', '', 'درجة اللغة الإنجليزية'),
(37, 'arb_degree', '', 'عربي في الدرجة'),
(38, 'status', '', 'الحالة'),
(39, 'system_settings', '', 'اعدادات النظام'),
(40, 'info!', '', 'معلومة'),
(41, 'this_page_allows_you_to_edit_system_information', '', 'تتيح لك هذه الصفحة تحرير معلومات النظام'),
(42, 'general_settings', '', 'الاعدادات العامة'),
(43, 'company_name', '', 'اسم الشركة'),
(44, 'home_page_SEO_title', '', 'عنوان SEO للصفحة الرئيسية'),
(45, 'home_page_SEO_description', '', 'وصف SEO للصفحة الرئيسية'),
(46, 'contact_settings', '', 'إعدادات الاتصال'),
(47, 'email', '', 'البريد الإلكتروني'),
(48, 'phone', '', 'هاتف'),
(49, 'address', '', 'عنوان'),
(50, 'en_description', '', 'بدون وصف'),
(51, 'ch_description', '', 'وصف ch_'),
(52, 'terms_and_conditions', '', 'الأحكام والشروط'),
(53, 'linkdin', '', 'ينكدين'),
(54, 'wechat', '', ''),
(55, 'youtube', '', 'موقع يوتيوب'),
(56, 'tiktok', '', 'تيك توك'),
(57, 'instagram', '', 'انستغرام'),
(58, 'twitter', '', 'تويتر'),
(59, 'youku', '', ''),
(60, 'update_system', '', 'نظام التحديث'),
(61, 'name', '', 'اسم'),
(62, 'mobile', '', 'التليفون المحمول'),
(63, 'city', '', 'مدينة'),
(64, 'picture', '', 'صورة'),
(65, 'type', '', 'اكتب'),
(66, 'manage_language', '', 'إدارة اللغة'),
(67, 'language', '', 'لغة'),
(68, 'your_username', '', 'اسم المستخدم الخاص بك'),
(69, 'password', '', 'كلمه السر'),
(70, 'en_name', '', 'الاسم الانجليزي'),
(71, 'arb_name', '', 'اسم عربي'),
(72, 'image', '', 'صورة'),
(73, 'arabic_level', '', 'المستوى العربي'),
(74, 'salary', '', 'راتب'),
(75, 'advs_type', '', 'نوع الإعلان'),
(76, 'admin_status', '', 'حالة المسؤول'),
(77, 'actions', '', 'أجراءات'),
(78, 'update', '', 'تحديث'),
(79, 'user_name', '', 'اسم االمستخدم'),
(80, 'worker_details', '', 'تفاصيل_العمل'),
(81, 'Shakhala website to bring home workers with the best skills.It aims to facilitate the procedures for the recruitment of domestic workers and increase the level of protection of rights', '', 'موقع شكالة لاستقدام العمالة المنزلية بأفضل المهارات ويهدف إلى تسهيل إجراءات استقدام العمالة المنزلية ورفع مستوى حماية الحقوق'),
(82, 'it_aims_to_facilitate_the_procedures_for_the_recruitment_of_domestic_workers_and_increase_the_level_of_protection_of_rights.', '', 'هل أنت متأكد من اتخاذ هذا الإجراء فهو يهدف إلى تسهيل إجراءات استقدام العمالة المنزلية وزيادة مستوى حماية الحقوق.'),
(83, 'status:', '', 'الحالة'),
(84, 'profile', '', 'الملف الشخصي'),
(85, 'this_page_allows_you_to_edit_personal_information', '', 'تسمح لك هذه الصفحة بتعديل المعلومات الشخصية'),
(86, 'full_name', '', 'الاسم الكامل'),
(87, 'update_profile', '', 'تحديث الملف'),
(88, 'Dashboard', '', 'لوحة القيادة'),
(89, 'shakhala_website_to_bring_home_workers_with_the_best_skills.it_aims_to_facilitate_the_procedures_for_the_recruitment_of_domestic_workers_and_increase_the_level_of_protection_of_rights.', '', 'موقع شكالة لاستقدام العمالة المنزلية بأفضل المهارات ويهدف إلى تسهيل إجراءات استقدام العمالة المنزلية ورفع مست'),
(90, 'Deleted?', '', 'تم الحذف؟'),
(91, 'deleted?', '', 'تم الحذف؟'),
(92, 'deleted?', '', 'تم الحذف؟'),
(93, 'deleted?', '', 'تم الحذف؟'),
(94, 'deleted?', '', 'تم الحذف؟'),
(95, 'manage_complain', '', 'إدارة_متطلبات'),
(96, 'Manage Complain', '', 'إدارة الشكاوي'),
(97, 'message', '', 'رسالة'),
(98, 'department', '', ' قسم، أقسام'),
(99, 'user', '', 'المستعمل'),
(100, 'complain_no', '', 'شكوى_لا'),
(101, 'dashboard', '', 'لوحة القيادة'),
(102, 'slider', '', 'الشرائح'),
(103, 'profile_slider', '', 'شرائح الملف الشخصي'),
(104, 'education', '', 'التعليم'),
(105, 'workes_can_do', '', 'يمكن للعمال القيام به'),
(106, 'users', '', 'المستخدمين'),
(107, 'workers', '', 'عمال'),
(108, 'complains', '', 'يشكو'),
(115, 'total_workers', '', 'إجمالي العمال'),
(114, 'all_time', '', 'كل الوقت'),
(113, 'department_name', '', 'اسم القسم'),
(116, 'active_workers', '', 'النشطاء'),
(117, 'total_active_workers', '', 'إجمالي العمال النشطين'),
(118, 'subscriptions', '', 'الاشتراكات'),
(119, 'type_wise_workers', '', 'عمال الآلة الكاتبة'),
(120, 'line_chart', '', 'خط الرسم البياني'),
(121, 'bar_chart', '', 'شريط الرسم البياني'),
(122, 'advertisement_type', '', 'نوع الإعلان'),
(123, 'country_wise_workers', '', 'عمال البلد الحكيم'),
(124, 'pending_signup_requests', '', 'طلبات التسجيل المعلقة'),
(125, 'pending_worker_post_requests', '', 'طلبات مشاركة العامل المعلقة'),
(126, 'age', '', 'سن'),
(127, 'years', '', 'سنوات'),
(128, 'skin_color', '', 'لون البشرة'),
(129, 'height', '', 'ارتفاع'),
(130, 'weight', '', 'وزن'),
(131, 'futher_details', '', 'تفاصيل أكثر'),
(132, 'contact_number', '', 'رقم الاتصال'),
(133, 'religion', '', 'دين'),
(134, 'is_married', '', 'متزوج'),
(135, 'no_of_childrens', '', 'لا اطفال'),
(136, 'experience', '', 'خبرة'),
(137, 'qualification', '', 'المؤهل'),
(138, 'place_of_birth', '', 'مكان الميلاد'),
(139, 'place_of_living', '', 'مكان المعيشة'),
(140, 'works_can_do', '', 'يمكن أن تفعل الأعمال'),
(141, 'is_featured', '', 'هي واردة'),
(142, 'posted_by', '', 'منشور من طرف'),
(143, 'click_here_to_see_cv', '', 'انقر هنا لمشاهدة السيرة الذاتية'),
(144, 'remarks', '', 'ملاحظات'),
(145, 'further_details', '', 'تفاصيل أكثر'),
(146, 'contact_no', '', 'رقم الاتصال'),
(147, 'is_subscribed', '', 'مشترك'),
(148, 'verified', '', 'تم التحقق'),
(149, 'account_type', '', 'نوع الحساب'),
(150, 'posted_workers', '', 'نشر العمال'),
(151, 'live_workers', '', 'الحية'),
(152, 'created_at', '', 'أنشئت في'),
(153, 'transaction_history', '', 'تاريخ المعاملة'),
(154, 'id', '', 'هوية شخصية'),
(155, 'description', '', 'وصف'),
(156, 'amount', '', 'مقدار'),
(157, 'token', '', 'رمز'),
(158, 'tr_id', '', 'رقم المعاملة'),
(159, 'date', '', 'تاريخ'),
(160, 'Edit Language', '', 'تحرير اللغة'),
(161, 'تحرير اللغة', '', ''),
(162, 'total_users', '', 'إجمالي المستخدمين'),
(163, 'languages', '', 'اللغات'),
(164, 'Education', '', ''),
(165, 'Education', '', ''),
(166, 'إدارة_متطلبات', '', ''),
(167, 'skills', '', 'مهارات'),
(168, 'add_slider', '', 'أضف شريط التمرير'),
(169, 'manage_slider', '', 'إدارة المنزلق'),
(170, 'slider_title', '', 'عنوان شريط التمرير'),
(171, 'manage_department', '', 'إدارة القسم'),
(172, 'worker', '', 'عامل'),
(173, 'user_detail', '', 'تفاصيل المستخدم'),
(174, 'manage_worker', '', 'إدارة العامل'),
(175, 'total_subscriptions', '', 'إجمالي الاشتراكات'),
(176, 'ar_description', '', 'وصف عربي'),
(177, 'stripe_secret_key', '', ''),
(178, 'stripe_publish_key', '', ''),
(179, 'subscription_amount', '', 'مبلغ الاشتراك'),
(180, 'manage_education', '', ''),
(181, 'edit_slider', '', ''),
(182, 'facebook', '', ''),
(183, 'worker_ads', '', ''),
(184, 'company_ads', '', ''),
(185, 'hyperlink', '', ''),
(186, 'individual_amount', '', ''),
(187, 'individual_reservation_amount', '', ''),
(188, 'notification', '', ''),
(189, 'read_status', '', ''),
(190, 'manage_notification', '', ''),
(191, 'send', '', ''),
(192, 'notifications', '', ''),
(193, 'reservation', '', ''),
(194, 'User', '', ''),
(195, 'Worker', '', ''),
(196, 'reserve_exp_date', '', ''),
(197, 'User', '', ''),
(198, 'Worker', '', ''),
(199, 'User', '', ''),
(200, 'Worker', '', ''),
(201, 'User', '', ''),
(202, 'Worker', '', ''),
(203, 'User', '', ''),
(204, 'Worker', '', ''),
(205, 'days', '', ''),
(206, 'click_here_to_see_document', '', ''),
(207, 'admin_verified', '', ''),
(208, 'email_verified', '', ''),
(209, 'phone_verified', '', ''),
(210, 'manage_skills', '', ''),
(211, 'sami_subscription_amount', '', ''),
(212, 'sami_individual_amount', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_notification`
--

CREATE TABLE `shkalah_notification` (
  `notification_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL DEFAULT '0',
  `notification_title` text NOT NULL,
  `description` text NOT NULL,
  `image` text,
  `click` varchar(255) NOT NULL,
  `read_status` enum('Read','Unread') NOT NULL DEFAULT 'Unread',
  `data` text,
  `type` enum('Single','Group','All','Admin') NOT NULL DEFAULT 'Single',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_notification`
--

INSERT INTO `shkalah_notification` (`notification_id`, `receiver_id`, `notification_title`, `description`, `image`, `click`, `read_status`, `data`, `type`, `created_at`, `updated_at`) VALUES
(1, 27, 'User Verify', 'worker remarks', NULL, '', 'Read', NULL, 'Single', '2022-04-26 12:09:58', '2022-04-26 12:09:58'),
(2, 27, 'User Verify', 'worker remarks', NULL, '', 'Read', NULL, 'Single', '2022-04-26 12:10:45', '2022-04-26 12:10:45'),
(3, 27, 'User Verify', 'worker remarks', NULL, '', 'Read', NULL, 'Single', '2022-04-26 12:11:09', '2022-04-26 12:11:09'),
(4, 27, 'User Verify', 'worker remarks', NULL, '', 'Read', NULL, 'Single', '2022-04-26 12:11:38', '2022-04-26 12:11:38'),
(5, 27, 'User Verify', 'worker remarks', NULL, '', 'Read', NULL, 'Single', '2022-04-26 12:12:33', '2022-04-26 12:12:33'),
(6, 27, 'User Verify', 'worker remarks', NULL, '', 'Read', NULL, 'Single', '2022-04-26 12:13:02', '2022-04-26 12:13:02'),
(7, 27, 'User Verify', 'here aer ethe ', NULL, '', 'Read', NULL, 'Single', '2022-04-26 12:21:40', '2022-04-26 12:21:40'),
(8, 16, 'User Verify', 'here are the opxa support remarks', NULL, '', 'Read', NULL, 'Single', '2022-04-26 12:25:22', '2022-04-26 12:25:22'),
(9, 2, 'custom notification', 'description', 'https://www.drupal.org/files/project-images/font_awesome_logo.png', '', 'Read', NULL, 'Single', '2022-04-27 09:00:45', '2022-04-27 09:00:45'),
(10, 28, 'User Verify', 'Every thing is fine\n', NULL, '', 'Read', NULL, 'Single', '2022-04-28 21:55:52', '2022-04-28 21:55:52'),
(11, 2, 'Reservation Made Successfully', 'Your reservation for Junaid has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-04-28 21:56:51', '2022-04-28 21:56:51'),
(12, 7, 'Reservation Made', 'Your CV reservation for Junaid has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-04-28 21:56:53', '2022-04-28 21:56:53'),
(13, 2, 'Successfully payment', 'Your transaction have been made successfully tr_id is 22', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-04-29 10:35:56', '2022-04-29 10:35:56'),
(14, 18, 'User Verify', '', NULL, '', 'Unread', NULL, 'Single', '2022-05-08 07:16:51', '2022-05-08 07:16:51'),
(15, 18, 'TEST', 'test notification', '', '', 'Unread', NULL, 'Single', '2022-05-08 07:17:22', '2022-05-08 07:17:22'),
(16, 18, 'Test2', 'test notification', '', '', 'Unread', NULL, 'Single', '2022-05-08 07:19:46', '2022-05-08 07:19:46'),
(17, 19, 'User Verify', '', NULL, '', 'Unread', NULL, 'Single', '2022-05-08 07:49:18', '2022-05-08 07:49:18'),
(18, 20, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-08 08:01:03', '2022-05-08 08:01:03'),
(19, 20, 'test', 'test', '', '', 'Read', NULL, 'Single', '2022-05-08 08:28:16', '2022-05-08 08:28:16'),
(20, 20, 'Test worker1', 'Test worker Message', 'https://thumbs.dreamstime.com/b/notification-bell-icon-red-mark-vector-symbol-outline-style-eps-173584177.jpg', '', 'Read', NULL, 'Single', '2022-05-08 08:34:47', '2022-05-08 08:34:47'),
(21, 21, 'User Verify', '', NULL, '', 'Unread', NULL, 'Single', '2022-05-08 18:28:47', '2022-05-08 18:28:47'),
(22, 20, '?????? ????? ?????', 'test notification\\\r\n?????? ????? ?????', 'https://thumbs.dreamstime.com/b/notification-bell-icon-red-mark-vector-symbol-outline-style-eps-173584177.jpg', '', 'Read', NULL, 'Single', '2022-05-08 19:56:52', '2022-05-08 19:56:52'),
(23, 22, 'User Verify', 'jhuyb', NULL, '', 'Read', NULL, 'Single', '2022-05-09 11:55:23', '2022-05-09 11:55:23'),
(24, 22, 'Reservation Made Successfully', 'Your reservation for Junaid has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Unread', '[]', 'Single', '2022-05-09 13:45:40', '2022-05-09 13:45:40'),
(25, 7, 'Reservation Made', 'Your CV reservation for Junaid has been made mode by Ali Haider', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-09 13:45:42', '2022-05-09 13:45:42'),
(26, 22, 'Successfully payment', 'Your transaction have been made successfully tr_id is 24', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Unread', '[]', 'Single', '2022-05-09 13:47:33', '2022-05-09 13:47:33'),
(27, 2, 'Reservation Made Successfully', 'Your reservation for Junaid Ali has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-11 22:09:18', '2022-05-11 22:09:18'),
(28, 7, 'Reservation Made', 'Your CV reservation for Junaid Ali has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-11 22:09:19', '2022-05-11 22:09:19'),
(29, 2, 'Reservation Made Successfully', 'Your reservation for Junaid Ali has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-11 22:14:37', '2022-05-11 22:14:37'),
(30, 7, 'Reservation Made', 'Your CV reservation for Junaid Ali has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-11 22:14:37', '2022-05-11 22:14:37'),
(31, 2, 'Reservation Made Successfully', 'Your reservation for Junaid Ali has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-11 22:18:38', '2022-05-11 22:18:38'),
(32, 7, 'Reservation Made', 'Your CV reservation for Junaid Ali has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-11 22:18:39', '2022-05-11 22:18:39'),
(33, 2, 'Reservation Made Successfully', 'Your reservation for Junaid Ali has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-11 22:20:01', '2022-05-11 22:20:01'),
(34, 7, 'Reservation Made', 'Your CV reservation for Junaid Ali has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-11 22:20:02', '2022-05-11 22:20:02'),
(35, 2, 'Reservation Made Successfully', 'Your reservation for Junaid Ali has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-11 22:23:19', '2022-05-11 22:23:19'),
(36, 7, 'Reservation Made', 'Your CV reservation for Junaid Ali has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-11 22:23:20', '2022-05-11 22:23:20'),
(37, 2, 'Reservation Made Successfully', 'Your reservation for Junaid Ali has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-11 22:26:06', '2022-05-11 22:26:06'),
(38, 7, 'Reservation Made', 'Your CV reservation for Junaid Ali has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-11 22:26:07', '2022-05-11 22:26:07'),
(39, 2, 'Reservation Made Successfully', 'Your reservation for Junaid Ali has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-11 22:32:53', '2022-05-11 22:32:53'),
(40, 7, 'Reservation Made', 'Your CV reservation for Junaid Ali has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-11 22:32:54', '2022-05-11 22:32:54'),
(41, 2, 'Reservation Made Successfully', 'Your reservation for Junaid Ali has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-11 22:39:23', '2022-05-11 22:39:23'),
(42, 7, 'Reservation Made', 'Your CV reservation for Junaid Ali has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-11 22:39:24', '2022-05-11 22:39:24'),
(43, 2, 'Reservation Made Successfully', 'Your reservation for Junaid Ali has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-11 22:42:00', '2022-05-11 22:42:00'),
(44, 7, 'Reservation Made', 'Your CV reservation for Junaid Ali has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-11 22:42:01', '2022-05-11 22:42:01'),
(45, 2, 'Reservation Made Successfully', 'Your reservation for Junaid Ali has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-11 22:44:39', '2022-05-11 22:44:39'),
(46, 7, 'Reservation Made', 'Your CV reservation for Junaid Ali has been made mode by Junaid Ali', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-11 22:44:40', '2022-05-11 22:44:40'),
(47, 20, 'Successfully payment', 'Your transaction have been made successfully tr_id is 35', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-13 12:37:26', '2022-05-13 12:37:26'),
(48, 20, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-13 12:53:47', '2022-05-13 12:53:47'),
(49, 20, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-13 12:53:57', '2022-05-13 12:53:57'),
(50, 20, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-13 12:55:58', '2022-05-13 12:55:58'),
(51, 20, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-13 12:56:01', '2022-05-13 12:56:01'),
(52, 20, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-13 12:56:03', '2022-05-13 12:56:03'),
(53, 20, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-13 12:56:54', '2022-05-13 12:56:54'),
(54, 20, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-13 12:56:57', '2022-05-13 12:56:57'),
(55, 20, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-13 12:56:57', '2022-05-13 12:56:57'),
(56, 20, 'Reservation Made Successfully', 'Your reservation for Junaid has been made successfully', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-13 13:03:18', '2022-05-13 13:03:18'),
(57, 7, 'Reservation Made', 'Your CV reservation for Junaid has been made mode by worker1', 'https://shkalah.mjcoders.com/uploads/imgs/info.png', '', 'Unread', '[]', 'Single', '2022-05-13 13:03:19', '2022-05-13 13:03:19'),
(58, 23, 'Successfully payment', 'Your transaction have been made successfully tr_id is 37', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-13 14:10:44', '2022-05-13 14:10:44'),
(59, 23, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-13 14:11:22', '2022-05-13 14:11:22'),
(60, 23, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-13 14:28:28', '2022-05-13 14:28:28'),
(61, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:41:31', '2022-05-14 12:41:31'),
(62, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:42:10', '2022-05-14 12:42:10'),
(63, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:44:19', '2022-05-14 12:44:19'),
(64, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:47:51', '2022-05-14 12:47:51'),
(65, 28, 'User Verify', 'Hello appr', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:48:22', '2022-05-14 12:48:22'),
(66, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:49:07', '2022-05-14 12:49:07'),
(67, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:51:04', '2022-05-14 12:51:04'),
(68, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:52:32', '2022-05-14 12:52:32'),
(69, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:53:38', '2022-05-14 12:53:38'),
(70, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:54:18', '2022-05-14 12:54:18'),
(71, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:55:52', '2022-05-14 12:55:52'),
(72, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:56:01', '2022-05-14 12:56:01'),
(73, 2, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:57:12', '2022-05-14 12:57:12'),
(74, 28, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 12:58:16', '2022-05-14 12:58:16'),
(75, 28, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 13:00:10', '2022-05-14 13:00:10'),
(76, 28, 'User Verify', '', NULL, '', 'Read', NULL, 'Single', '2022-05-14 13:03:29', '2022-05-14 13:03:29'),
(77, 28, 'User Verify', 'You worker request has been verified thanks', NULL, '', 'Read', NULL, 'Single', '2022-05-14 13:09:45', '2022-05-14 13:09:45'),
(78, 15, 'User Verify', 'User has been verified', NULL, '', 'Unread', NULL, 'Single', '2022-05-14 13:11:26', '2022-05-14 13:11:26'),
(79, 24, 'test', 'test notifactiomn', 'https://thumbs.dreamstime.com/b/notification-bell-icon-red-mark-vector-symbol-outline-style-eps-173584177.jpg', '', 'Read', NULL, 'Single', '2022-05-14 17:00:42', '2022-05-14 17:00:42'),
(80, 31, 'User Verify', '', NULL, '', 'Unread', NULL, 'Single', '2022-05-17 17:27:06', '2022-05-17 17:27:06'),
(81, 31, 'User Verify', '', NULL, '', 'Unread', NULL, 'Single', '2022-05-17 17:27:13', '2022-05-17 17:27:13'),
(82, 24, 'Successfully payment', 'Your transaction have been made successfully tr_id is 38', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-05-17 17:37:07', '2022-05-17 17:37:07'),
(83, 32, 'User Verify', '', NULL, '', 'Unread', NULL, 'Single', '2022-05-17 17:39:54', '2022-05-17 17:39:54'),
(84, 27, 'Successfully payment', 'Your transaction have been made successfully tr_id is 39', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-07-20 13:37:07', '2022-07-20 13:37:07'),
(85, 28, 'Successfully payment', 'Your transaction have been made successfully tr_id is 40', 'https://shkalah.mjcoders.com/uploads/imgs/check.png', '', 'Read', '[]', 'Single', '2022-07-20 13:47:47', '2022-07-20 13:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_profile_slider`
--

CREATE TABLE `shkalah_profile_slider` (
  `slider_profile_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `image` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_profile_slider`
--

INSERT INTO `shkalah_profile_slider` (`slider_profile_id`, `title`, `image`, `status`) VALUES
(1, 'asds', 'uploads/slider/1646049767_mimage.jpg', 'Active'),
(2, 'asdfffvf', 'uploads/slider/banner1.jpg', 'Active'),
(5, 'jiocjoipw', 'uploads/slider/1646143213_mimage.jpg', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_reservation`
--

CREATE TABLE `shkalah_reservation` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `referance_id` int(11) NOT NULL COMMENT 'company/individual_id',
  `transaction_id` int(11) NOT NULL,
  `type` enum('Company','Individual') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `days` int(11) NOT NULL DEFAULT '0',
  `reserve_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reserve_exp_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_reservation`
--

INSERT INTO `shkalah_reservation` (`reservation_id`, `user_id`, `worker_id`, `referance_id`, `transaction_id`, `type`, `status`, `days`, `reserve_data`, `reserve_exp_date`) VALUES
(15, 2, 26, 7, 32, 'Company', 'Active', 3, '2022-05-14 17:01:39', '2022-05-14 08:39:23'),
(16, 2, 26, 7, 33, 'Company', 'Active', 3, '2022-05-11 08:42:00', '2022-05-14 08:42:00'),
(7, 22, 27, 7, 23, 'Company', 'Active', 3, '2022-05-08 23:45:40', '2022-05-11 23:45:40'),
(17, 2, 26, 7, 34, 'Company', 'Active', 3, '2022-05-11 08:44:39', '2022-05-14 08:44:39'),
(14, 2, 26, 7, 31, 'Company', 'Active', 3, '2022-05-11 08:32:53', '2022-05-14 08:32:53'),
(13, 2, 26, 7, 30, 'Company', 'Active', 3, '2022-05-11 08:26:06', '2022-05-14 08:26:06'),
(18, 20, 27, 7, 36, 'Company', 'Active', 3, '2022-05-12 23:03:18', '2022-05-15 23:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_skill`
--

CREATE TABLE `shkalah_skill` (
  `skill_id` int(11) NOT NULL,
  `en_name` text NOT NULL,
  `ar_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_skill`
--

INSERT INTO `shkalah_skill` (`skill_id`, `en_name`, `ar_name`, `status`) VALUES
(1, 'Driver', 'سائق', 'Active'),
(2, 'Accounting', 'محاسبة', 'Active'),
(4, 'Mechanic', 'ميكانيكي', 'Active'),
(5, 'Cleaning', 'الغسيل', 'Active'),
(6, 'Kids Care', 'رعاية الأطفال', 'Active'),
(7, 'Iron', 'كي الملابس', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_slider`
--

CREATE TABLE `shkalah_slider` (
  `slider_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `hyperlink` text,
  `image` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_slider`
--

INSERT INTO `shkalah_slider` (`slider_id`, `title`, `hyperlink`, `image`, `status`) VALUES
(1, 'def', 'https://google.com', 'uploads/slider/banner2.jpg', 'Active'),
(6, 'frrf', 'https://shkalah.com', 'uploads/slider/1645706235_mimage.jpg', 'Active'),
(8, 'hjhilgilg', NULL, 'uploads/slider/1646142916_mimage.jpg', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_system_settings`
--

CREATE TABLE `shkalah_system_settings` (
  `system_settings_id` int(11) NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shkalah_system_settings`
--

INSERT INTO `shkalah_system_settings` (`system_settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'شغالـة'),
(2, 'email', 'info@shkalah.com'),
(3, 'phone', '+97466657496'),
(4, 'language', 'english'),
(5, 'address', 'Qatar'),
(53, 'stripe_secret_key', 'sk_test_51JGiMjSJDwx14nOSzChGOF6Bf0UqtjEVZG1whQppIm4eEcYpQV8MGpKRFw5kS9FhVB4Zw8H7TSvWTANoQhd3Bkd600SJ61abO9'),
(6, 'system_image', '1644395961_system_image.jpg'),
(7, 'smtp_host', 'localhost'),
(8, 'smtp_port', '587'),
(9, 'smtp_username', ''),
(10, 'smtp_password', '(n8gVjk?A6&n'),
(11, 'geo_api_key', 'AIzaSyC4HqZf-zANxtQqW0riYOrRKdrXvzMqCqM'),
(25, 'state', ''),
(24, 'city', ''),
(23, 'storage_deposit_charges', ''),
(18, 'storage_rent_charges', ''),
(19, 'system_currency', ''),
(20, 'home-page-seo-title', 'شغالة'),
(21, 'home-page-seo-description', 'شغالة'),
(26, 'paypal_business_email', ''),
(27, 'stripe_live_key', ''),
(28, 'stripe_secret_key1', ''),
(29, 'url_facebook', '#'),
(30, 'url_pinterest', '#'),
(31, 'url_vimeo', '#'),
(32, 'url_twitter', '#'),
(33, 'per_order_points', ''),
(34, 'per_product_points', ''),
(35, 'system_currency', ''),
(36, 'system_currency_symbol', '$'),
(37, 'one_point', ''),
(38, 'privacy_en_description', 'Shaghala application\r\nis a platform to connect users with companies that provide labours, servants, and some other services.'),
(59, 'individual_amount', '10'),
(60, 'individual_reservation_amount', '1'),
(61, 'reservation_days', '3'),
(62, 'sami_sub_amount', '50'),
(63, 'sami_individual_amount', '5'),
(39, 'privacy_ch_description', 'تطبيق شغالة\r\nهو منصة لربط المستخدمين بالشركات التي تقدم العمالة والخدم بالاضافة الى بعض الخدمات الأخرى.'),
(40, 'terms_en_description', 'Terms and Conditions in English'),
(56, 'android_app_url', 'https://www.google.com'),
(57, 'ios_app_url', 'https://www.apple.com'),
(58, 'share_text', 'Install the app'),
(41, 'terms_ch_description', 'Terms and Conditions in Arabic'),
(42, 'linkdin', 'https://www.linkedin.com/'),
(43, 'wechat', ''),
(44, 'youtube', ''),
(45, 'tiktok', 'https://tiktok.com'),
(46, 'instagram', 'https://www.instagram.com/shaghala_application/'),
(47, 'twitter', 'https://twitter.com'),
(48, 'youku', ''),
(49, 'goal', 'We work towards fueling companies across the world with the power of technology and software. Our tailored IT solutions and services are helping enterprises leverage technology to maximise their business potential.\r\n                Mjcoders  have a simple goal to turn your great ideas into reality.  Our pool of certified developers helps companies looking to build, grow or mature their technology implementations. Our remote developers strive hard to achieve clients satisfaction and exceed their expectations by delivering robust, scalable and highly flexible software solutions.'),
(50, 'grow', 'Get started right away with Mjcoders. Engage with us about your particular requirements and we assist you in every way possible. From IT consulting and complete solutions to managed delivery and remote software developers; we are there to help. With 5 years of experience in the market, we have become better at solving problems and delivering highly intuitive solutions.'),
(51, 'footer_text', '\"Experienced Team with Professionalism is awaiting for your business to make your online store more attractive and more searches are waiting for your E Commerce '),
(52, 'facebook', 'https://facebook.com/'),
(54, 'stripe_publish_key', 'pk_test_51JGiMjSJDwx14nOS8E1z0uJf4g7fbE3zRJzfJV4QdathgMVmEIOTuB4Ffd1PTtvKeVrvqDxLjpjmpdmWHkzF0w7l00nGDM4sQ0'),
(55, 'sub_amount', '100');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_transaction`
--

CREATE TABLE `shkalah_transaction` (
  `transaction_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` double NOT NULL,
  `token` text NOT NULL,
  `tr_id` text NOT NULL,
  `reference` text,
  `type` enum('Stripe','Paypal','Fatora') NOT NULL,
  `sub_type` enum('annual','sami_annual') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_transaction`
--

INSERT INTO `shkalah_transaction` (`transaction_id`, `description`, `amount`, `token`, `tr_id`, `reference`, `type`, `sub_type`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Successfull annual subscription', 100, 'src_1KapmOSJDwx14nOSlkuZiCuo', 'ch_3KapmSSJDwx14nOS1SBamsPe', NULL, 'Stripe', NULL, '2022-03-07 23:15:57', '2022-03-07 23:15:57', 24),
(2, 'Successful annual subscription', 100, 'src_1KazZ2SJDwx14nOSbUwvUEbG', 'ch_3KazZ6SJDwx14nOS0ZJ5mXc2', NULL, 'Stripe', NULL, '2022-03-08 09:42:50', '2022-03-08 09:42:50', 24),
(3, 'Successful annual subscription', 100, 'W69ZCKCSYFGVA', '81V007657E4572512', NULL, 'Paypal', NULL, '2022-03-08 20:23:19', '2022-03-08 20:23:19', 25),
(4, 'Successful annual subscription', 100, '3UERXUXY2R24Y', '98S303989U665010K', NULL, 'Paypal', NULL, '2022-03-08 20:28:54', '2022-03-08 20:28:54', 25),
(5, 'Successful annual subscription', 100, 'src_1KbVmuSJDwx14nOSeIeGx2gq', 'ch_3KbVmxSJDwx14nOS0jU7WXWz', NULL, 'Stripe', NULL, '2022-03-09 20:07:17', '2022-03-09 20:07:17', 43),
(6, 'Successful annual subscription', 100, 'src_1KbVttSJDwx14nOSN1gml2of', 'ch_3KbVtySJDwx14nOS1xlEPJPX', NULL, 'Stripe', NULL, '2022-03-09 20:14:31', '2022-03-09 20:14:31', 43),
(7, 'Successful annual subscription', 100, 'src_1KbVwHSJDwx14nOSgPmeYH06', 'ch_3KbVwKSJDwx14nOS1UxCZ6dw', NULL, 'Stripe', NULL, '2022-03-09 20:16:58', '2022-03-09 20:16:58', 43),
(8, 'Successful annual subscription', 100, 'src_1KbVxoSJDwx14nOSGpyfz2TH', 'ch_3KbVxrSJDwx14nOS1I1Phyxr', NULL, 'Stripe', NULL, '2022-03-09 20:18:33', '2022-03-09 20:18:33', 43),
(9, 'Successful annual subscription', 100, 'src_1KbW4ASJDwx14nOS0m4aXZwH', 'ch_3KbW4FSJDwx14nOS17C0btmC', NULL, 'Stripe', NULL, '2022-03-09 20:25:09', '2022-03-09 20:25:09', 44),
(10, 'Successful annual subscription', 100, '3UERXUXY2R24Y', '5K2671440V507011H', NULL, 'Paypal', NULL, '2022-03-17 12:37:02', '2022-03-17 12:37:02', 50),
(11, 'Successful annual subscription', 100, '3UERXUXY2R24Y', '43H764749U6580847', NULL, 'Paypal', NULL, '2022-03-17 12:41:03', '2022-03-17 12:41:03', 50),
(12, 'Successful annual subscription', 100, '123456', 'Test123456585291', NULL, 'Fatora', NULL, '2022-03-22 10:38:13', '2022-03-22 10:38:13', 24),
(13, 'Successful annual subscription', 1, 'O-219029', '462114785274586', NULL, 'Fatora', NULL, '2022-04-24 21:48:56', '2022-04-24 21:48:56', 53),
(14, 'Reservation Made By Junaid Ali', 1, '7DZZ84YKXELUJ', '5AD95607N7977051T', NULL, 'Paypal', NULL, '2022-04-27 21:25:19', '2022-04-27 21:25:19', 2),
(15, 'Reservation Made By Junaid Ali', 1, 'T765E7P2GPGLL', '1AJ5830325094014H', NULL, 'Paypal', NULL, '2022-04-27 21:28:00', '2022-04-27 21:28:00', 2),
(16, 'Reservation Made By Junaid Ali', 1, 'NED8U9T77388J', '2CK21753WG455943T', NULL, 'Paypal', NULL, '2022-04-27 21:38:31', '2022-04-27 21:38:31', 2),
(17, 'Reservation Made By Junaid Ali', 1, 'FHRL7KLKFXTPJ', '8VR82363GV474824J', NULL, 'Paypal', NULL, '2022-04-27 21:40:30', '2022-04-27 21:40:30', 2),
(18, 'Reservation Made By Junaid Ali', 1, '5VDA3PA827VEN', '4LW51131K2634580M', NULL, 'Paypal', NULL, '2022-04-28 12:37:01', '2022-04-28 12:37:01', 2),
(19, 'Successful individual subscription', 1, 'WBGG99PRT88WE', '27Y68044C7880904X', NULL, 'Paypal', NULL, '2022-04-28 21:16:32', '2022-04-28 21:16:32', 2),
(20, 'Successful individual subscription', 1, '83B6KJTCRVG28', '8YE156382C6555901', NULL, 'Paypal', NULL, '2022-04-28 21:18:56', '2022-04-28 21:18:56', 2),
(21, 'Reservation Made By Junaid Ali', 1, '5X78EXJESJMQW', '03S109574T0557947', NULL, 'Paypal', NULL, '2022-04-28 21:56:51', '2022-04-28 21:56:51', 2),
(22, 'Successful individual subscription', 1, 'UHFY26SYZV53G', '35D6649633479190N', NULL, 'Paypal', NULL, '2022-04-29 10:35:56', '2022-04-29 10:35:56', 2),
(23, 'Reservation Made By Ali Haider', 1, '1652103909908', 'Test1652103909908606345', NULL, 'Fatora', NULL, '2022-05-09 13:45:40', '2022-05-09 13:45:40', 22),
(24, 'Successful individual subscription', 10, '1652104027963', 'Test1652104027963606346', NULL, 'Fatora', NULL, '2022-05-09 13:47:33', '2022-05-09 13:47:33', 22),
(25, 'Reservation Made By Junaid Ali', 1, '3KUER5FAD78KJ', '4AT73562WU9571627', NULL, 'Paypal', NULL, '2022-05-11 22:09:18', '2022-05-11 22:09:18', 2),
(26, 'Reservation Made By Junaid Ali', 1, 'M448VKF7EVN3S', '5N8699317A0732722', NULL, 'Paypal', NULL, '2022-05-11 22:14:37', '2022-05-11 22:14:37', 2),
(27, 'Reservation Made By Junaid Ali', 1, '7M29D5RE2ZRWW', '8G510472JJ4620106', NULL, 'Paypal', NULL, '2022-05-11 22:18:38', '2022-05-11 22:18:38', 2),
(28, 'Reservation Made By Junaid Ali', 1, 'KG6JKMLMPW5TJ', '7AW516936G467132N', NULL, 'Paypal', NULL, '2022-05-11 22:20:01', '2022-05-11 22:20:01', 2),
(29, 'Reservation Made By Junaid Ali', 1, 'HEXAPVEKXW8TN', '1YW09886XJ9146449', NULL, 'Paypal', NULL, '2022-05-11 22:23:19', '2022-05-11 22:23:19', 2),
(30, 'Reservation Made By Junaid Ali', 1, 'AEE3YV4MU9PN8', '1GJ31129RA5386721', NULL, 'Paypal', NULL, '2022-05-11 22:26:06', '2022-05-11 22:26:06', 2),
(31, 'Reservation Made By Junaid Ali', 1, 'CJKERZ92VEAU2', '44F75092E5984861L', NULL, 'Paypal', NULL, '2022-05-11 22:32:53', '2022-05-11 22:32:53', 2),
(32, 'Reservation Made By Junaid Ali', 1, 'UEHUPJUQY77BE', '6PH84044117834932', NULL, 'Paypal', NULL, '2022-05-11 22:39:23', '2022-05-11 22:39:23', 2),
(33, 'Reservation Made By Junaid Ali', 1, 'DR6DNHHMX6VW2', '4GH71370GV773370H', NULL, 'Paypal', NULL, '2022-05-11 22:42:00', '2022-05-11 22:42:00', 2),
(34, 'Reservation Made By Junaid Ali', 1, 'Q6DYD3G4R7NY8', '3SC62893TP743482A', NULL, 'Paypal', NULL, '2022-05-11 22:44:39', '2022-05-11 22:44:39', 2),
(35, 'Successful individual subscription', 1, '1652445290048', '582133454360081', NULL, 'Fatora', NULL, '2022-05-13 12:37:26', '2022-05-13 12:37:26', 20),
(36, 'Reservation Made By worker1', 1, '1652446877837', '462133469897714', NULL, 'Fatora', NULL, '2022-05-13 13:03:18', '2022-05-13 13:03:18', 20),
(37, 'Successful annual subscription', 1, '1652450926457', '582133510351455', NULL, 'Fatora', NULL, '2022-05-13 14:10:44', '2022-05-13 14:10:44', 23),
(38, 'Successful individual subscription', 1, '1652808917929', '302137634179959', NULL, 'Fatora', NULL, '2022-05-17 17:37:07', '2022-05-17 17:37:07', 24),
(39, 'Successful annual subscription', 100, '1658324211411', 'Test1658324211411639368', NULL, 'Fatora', 'annual', '2022-07-20 13:37:07', '2022-07-20 13:37:07', 27),
(40, 'Successful individual subscription', 10, '1658324840005', 'Test1658324840005639374', NULL, 'Fatora', 'sami_annual', '2022-07-20 13:47:47', '2022-07-20 13:47:47', 28);

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_unique_visit`
--

CREATE TABLE `shkalah_unique_visit` (
  `unique_visit_id` int(11) NOT NULL,
  `user_ip` text NOT NULL,
  `date` date NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_unique_visit`
--

INSERT INTO `shkalah_unique_visit` (`unique_visit_id`, `user_ip`, `date`, `count`) VALUES
(1, '39.37.101.196', '2020-12-27', 23),
(2, '52.114.6.38', '2020-12-27', 3),
(3, '139.162.67.56', '2020-12-27', 10),
(4, '139.162.123.197', '2020-12-28', 8),
(5, '172.105.218.73', '2020-12-28', 7),
(6, '124.29.212.142', '2020-12-29', 1),
(7, '182.186.126.98', '2020-12-29', 44),
(8, '182.186.93.194', '2020-12-31', 19),
(9, '138.246.253.24', '2020-12-31', 6),
(10, '182.186.2.199', '2021-01-02', 3),
(11, '202.47.56.31', '2021-01-02', 2),
(12, '182.186.84.247', '2021-01-03', 2),
(13, '182.186.1.193', '2021-01-05', 1),
(14, '182.186.114.117', '2021-01-05', 1),
(15, '182.186.99.115', '2021-01-06', 4),
(16, '52.114.14.102', '2021-01-06', 2),
(17, '182.186.104.188', '2021-01-08', 12),
(18, '18.185.47.251', '2021-01-08', 1),
(19, '66.220.149.21', '2021-01-08', 1),
(20, '66.220.149.15', '2021-01-08', 1),
(21, '66.220.149.8', '2021-01-08', 1),
(22, '66.220.149.33', '2021-01-08', 1),
(23, '66.220.149.7', '2021-01-08', 1),
(24, '66.220.149.4', '2021-01-08', 1),
(25, '66.220.149.22', '2021-01-08', 1),
(26, '66.220.149.11', '2021-01-08', 1),
(27, '108.174.5.113', '2021-01-08', 2),
(28, '108.174.5.112', '2021-01-08', 4),
(29, '51.15.205.3', '2021-01-09', 1),
(30, '51.158.66.83', '2021-01-10', 1),
(31, '51.158.108.61', '2021-01-12', 1),
(32, '163.172.148.199', '2021-01-12', 1),
(33, '51.158.108.77', '2021-01-14', 1),
(34, '39.37.66.1', '2021-01-17', 3),
(35, '173.252.127.11', '2021-01-18', 1),
(36, '173.252.87.10', '2021-01-19', 1),
(37, '111.88.68.185', '2021-01-20', 1),
(38, '111.119.187.17', '2021-01-31', 4),
(39, '111.119.187.33', '2021-02-01', 2),
(40, '182.186.12.238', '2021-02-01', 15),
(41, '182.186.113.128', '2021-02-02', 14),
(42, '45.32.26.54', '2021-02-05', 5),
(43, '108.174.8.23', '2021-02-05', 1),
(44, '182.186.100.76', '2021-02-05', 7),
(45, '39.37.68.101', '2021-02-06', 2),
(46, '39.37.92.133', '2021-02-07', 3),
(47, '39.37.36.90', '2021-02-07', 7),
(48, '198.13.61.162', '2021-02-10', 3),
(49, '66.42.40.229', '2021-02-10', 4),
(50, '173.252.83.8', '2021-02-10', 1),
(51, '173.252.83.11', '2021-02-10', 1),
(52, '173.252.83.17', '2021-02-10', 1),
(53, '39.37.110.169', '2021-02-10', 2),
(54, '182.186.23.80', '2021-02-17', 3),
(55, '182.186.59.154', '2021-02-18', 7),
(56, '182.186.108.174', '2021-02-21', 12),
(57, '182.186.112.155', '2021-02-23', 6),
(58, '45.32.55.14', '2021-02-23', 1),
(59, '39.37.73.240', '2021-02-28', 1),
(60, '59.103.108.137', '2021-04-05', 3);

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_user`
--

CREATE TABLE `shkalah_user` (
  `user_id` int(11) NOT NULL,
  `users_roles_id` int(11) NOT NULL,
  `email` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(44) COLLATE utf8_unicode_ci NOT NULL,
  `city` text CHARACTER SET latin1 NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `user_image` varchar(111) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `type` enum('Company','Individual') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Individual',
  `type_id` int(11) NOT NULL DEFAULT '1',
  `session_id` text COLLATE utf8_unicode_ci,
  `token_id` text COLLATE utf8_unicode_ci,
  `user_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `verification_code` text COLLATE utf8_unicode_ci,
  `is_phone_verified` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `is_email_verified` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `is_fb_verified` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `google_id` text COLLATE utf8_unicode_ci,
  `facebook_id` text COLLATE utf8_unicode_ci,
  `apple_id` text COLLATE utf8_unicode_ci,
  `country_id` int(11) NOT NULL,
  `is_blocked` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `comments` text COLLATE utf8_unicode_ci,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `login_type` enum('Normal','Gmail','Facebook','Apple') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Normal',
  `admin_status` enum('Active','Inactive','Reject') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `admin_remarks` text COLLATE utf8_unicode_ci,
  `company_doc_url` text COLLATE utf8_unicode_ci,
  `is_subscribed` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `sub_date` timestamp NULL DEFAULT NULL,
  `sub_exp_date` timestamp NULL DEFAULT NULL,
  `ind_post_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shkalah_user`
--

INSERT INTO `shkalah_user` (`user_id`, `users_roles_id`, `email`, `password`, `name`, `phone`, `city`, `address`, `user_image`, `is_deleted`, `type`, `type_id`, `session_id`, `token_id`, `user_created_at`, `user_updated_at`, `verification_code`, `is_phone_verified`, `is_email_verified`, `is_fb_verified`, `google_id`, `facebook_id`, `apple_id`, `country_id`, `is_blocked`, `comments`, `status`, `login_type`, `admin_status`, `admin_remarks`, `company_doc_url`, `is_subscribed`, `sub_date`, `sub_exp_date`, `ind_post_count`) VALUES
(1, 1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '03043372285', 'Multan', '', 'users_16509257491.jpg', 'No', 'Individual', 1, NULL, NULL, '2022-04-25 22:28:30', '2022-04-25 22:29:09', NULL, 'No', 'No', 'No', NULL, NULL, NULL, 1, 'No', NULL, 'Active', 'Normal', 'Active', NULL, NULL, 'No', NULL, NULL, 0),
(2, 0, 'junaidaliansareee@gmail.com', '', 'Junaid Ali', '92-3336110967', '', '', '', 'No', 'Individual', 1, 'c68909816dad0c6eff2272e381d418b0', NULL, '2022-04-25 22:45:12', '2022-07-20 11:18:46', NULL, 'No', 'Yes', 'Yes', 'UXLdqPVPadVrsfOgRXk6TqVUnTl2', '1327109884437597', NULL, 178, 'No', 'Need Company Documentation', 'Active', 'Normal', 'Active', NULL, NULL, 'No', NULL, NULL, 1),
(16, 0, 'opxa.community@gmail.com', '', 'OPXA Support', '', '', '', '', 'No', 'Company', 1, 'bfcc5ff66bb37e58e115367fddcbb1c6', NULL, '2022-04-26 11:50:58', '2022-04-26 12:25:22', NULL, 'No', 'Yes', 'No', 'gHjVSw2f2CVhBQZBVRUnCvzbdCX2', NULL, NULL, 178, 'No', 'here are the opxa support remarks', 'Active', 'Normal', 'Active', NULL, NULL, 'No', NULL, NULL, 0),
(7, 0, 'softizers.corp@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Light Soft', '92-3043372286', '', '', 'uploads/users/6267d4d598ebd.png', 'No', 'Company', 1, 'f0a3617efe84cafc7a905ce07002a499', NULL, '2022-04-26 04:02:55', '2022-07-20 11:20:02', NULL, 'No', 'Yes', 'No', 'iEfHFOQ89gQmIh9qJrbIhqQKQvf1', NULL, NULL, 178, 'No', NULL, 'Active', 'Normal', 'Active', NULL, 'uploads/documents/62677089562a0Assignment2.pdf', 'No', '2022-04-01 14:18:57', '2023-07-07 14:19:03', 0),
(15, 0, 'taimooralam41@gmail.com', '11a0215510f8b6320a457dcc38ecc7c3', 'Taimoor Alam Shah', '974-23456789', '', '', '', 'No', 'Individual', 1, '3f422bd79e5e05233369e1a5926646fc', NULL, '2022-04-26 08:57:11', '2022-05-14 13:11:26', '499187', 'No', 'No', 'No', NULL, NULL, NULL, 178, 'No', 'User has been verified', 'Active', 'Normal', 'Active', NULL, NULL, 'No', NULL, NULL, 0),
(18, 0, 'company1@gmsil.com', '25d55ad283aa400af464c76d713c07ad', 'company1', '974-66657496', '', '', '', 'No', 'Company', 1, '7e5c286bcc23e9c35adaeb508303a383', NULL, '2022-05-07 20:32:47', '2022-05-08 07:16:51', NULL, 'No', 'No', 'No', NULL, NULL, NULL, 178, 'No', NULL, 'Active', 'Normal', 'Active', NULL, NULL, 'No', NULL, NULL, 0),
(19, 0, 'company2@gmai.com', '25d55ad283aa400af464c76d713c07ad', 'company2', '974-666657496', '', '', '', 'No', 'Company', 1, '64faea2e5641d6adbb4bdac29767b2c7', NULL, '2022-05-08 07:44:43', '2022-05-08 07:49:47', '224894', 'No', 'No', 'No', NULL, NULL, NULL, 178, 'No', NULL, 'Active', 'Normal', 'Active', NULL, 'uploads/documents/6277752db64011.pdf', 'No', NULL, NULL, 0),
(20, 0, 'tamermm2001@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'worker1', '974-70395571', '', 'doha qatar', 'uploads/users/627779fb74052.png', 'No', 'Individual', 1, 'fd59cd7432e7b5288f74b397e970e2ec', NULL, '2022-05-08 07:59:05', '2022-07-28 09:03:56', '718503', 'Yes', 'Yes', 'No', '106249138280857581188', NULL, NULL, 178, 'No', NULL, 'Active', 'Normal', 'Active', NULL, NULL, 'No', NULL, NULL, 1),
(21, 0, 'raselny.net@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Raselny Net', '20-1011904405', '', 'doha', 'uploads/users/62780c348769a.png', 'No', 'Company', 1, '5dd91d5a9f75cc2429434e09b013afc5', NULL, '2022-05-08 18:25:43', '2022-07-28 09:02:26', NULL, 'Yes', 'Yes', 'No', '108394806762635134850', NULL, NULL, 64, 'No', NULL, 'Active', 'Normal', 'Active', NULL, 'uploads/documents/62780bf34c2e213.pdf', 'No', NULL, NULL, 0),
(22, 0, 'alihaiderbalouch000@gmail.com', '', 'Ali Haider', '', '', '', '', 'No', 'Individual', 1, '01b687041d4fcb30d8818ea1a9e41e4f', NULL, '2022-05-09 11:55:04', '2022-05-09 13:47:33', NULL, 'No', 'Yes', 'No', '102511272973755265001', NULL, NULL, 178, 'No', 'jhuyb', 'Active', 'Normal', 'Active', NULL, NULL, 'No', NULL, NULL, 1),
(23, 0, 'tamer_mm2001@yahoo.com', '25d55ad283aa400af464c76d713c07ad', 'company3', '974-77864963', '', 'doha', '', 'No', 'Company', 1, '32278cd703d3b446c68bb1cd94b44f1d', NULL, '2022-05-13 13:55:51', '2022-05-17 18:03:14', '833766', 'Yes', 'Yes', 'No', NULL, NULL, NULL, 178, 'No', NULL, 'Active', 'Normal', 'Active', NULL, NULL, 'No', '2022-05-13 00:10:44', '2023-05-13 00:10:44', 0),
(24, 0, 'walidsharif@hotmail.com', '25d55ad283aa400af464c76d713c07ad', 'walid', '974-66090813', '', 'doha', 'uploads/users/627fdb098ff90.png', 'No', 'Individual', 1, '71f59b77f8ae4af8374d72195b8d173c', NULL, '2022-05-14 16:36:50', '2022-05-17 17:37:07', '592493', 'Yes', 'Yes', 'No', NULL, NULL, NULL, 178, 'No', NULL, 'Active', 'Normal', 'Active', NULL, NULL, 'No', NULL, NULL, 1),
(27, 0, 'muhamad.khizr@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Muhammad', '92-3056860156', '', 'abc street, abc town, abc pakistan', '', 'No', 'Company', 2, '23a6eddcdb1706a63f41e74a172d8d50', NULL, '2022-07-20 13:20:10', '2022-07-20 13:37:07', '947611', 'Yes', 'Yes', 'No', NULL, NULL, NULL, 166, 'No', NULL, 'Active', 'Normal', 'Active', NULL, NULL, 'No', '2022-07-19 23:37:07', '2023-07-19 23:37:07', 0),
(28, 0, 'junaidaliansaree@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Junaid Ali', '92-3043372285', '', 'address', '', 'No', 'Individual', 3, '60860472c8c1249c4e5f5ad4acb417ae', NULL, '2022-07-20 13:21:22', '2023-01-10 08:13:13', NULL, 'Yes', 'Yes', 'No', 'UXLdqPVPadVrsfOgRXk6TqVUnTl2', NULL, NULL, 178, 'No', NULL, 'Active', 'Normal', 'Active', NULL, NULL, 'No', '2022-07-19 23:47:47', '2023-01-20 00:47:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_users_roles`
--

CREATE TABLE `shkalah_users_roles` (
  `users_roles_id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `directory` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_users_roles`
--

INSERT INTO `shkalah_users_roles` (`users_roles_id`, `name`, `directory`, `status`) VALUES
(1, 'Admin', 'admin', 'Active'),
(2, 'Employee', 'employee', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_user_ips`
--

CREATE TABLE `shkalah_user_ips` (
  `user_ips_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `email` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_user_ips`
--

INSERT INTO `shkalah_user_ips` (`user_ips_id`, `ip`, `email`, `date`, `time`) VALUES
(1, '182.186.99.124', '', '2020-11-26', '02:41:39'),
(2, '182.186.99.124', '', '2020-11-26', '02:43:15'),
(3, '182.186.99.124', '', '2020-11-26', '02:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `shkalah_worker`
--

CREATE TABLE `shkalah_worker` (
  `worker_id` int(11) NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `en_name` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ar_name` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` text NOT NULL,
  `en_religion` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ar_religion` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `arabic_level` enum('Excellent','Moderate','No') NOT NULL,
  `age` int(11) NOT NULL,
  `is_married` enum('Yes','No') NOT NULL DEFAULT 'No',
  `have_childs` enum('Yes','No') NOT NULL DEFAULT 'No',
  `no_of_childs` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `edu_id` int(11) NOT NULL,
  `skin_color` text NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `salary` text NOT NULL,
  `place_of_birth_id` int(11) NOT NULL,
  `place_of_living_id` int(11) NOT NULL,
  `skill_id` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remarks` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `advs_type` text NOT NULL,
  `cv` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `comments` text,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `user_id` int(11) NOT NULL,
  `admin_status` enum('Active','Inactive','Reject') NOT NULL DEFAULT 'Inactive',
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `worker_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shkalah_worker`
--

INSERT INTO `shkalah_worker` (`worker_id`, `image`, `en_name`, `ar_name`, `phone`, `en_religion`, `ar_religion`, `arabic_level`, `age`, `is_married`, `have_childs`, `no_of_childs`, `experience`, `edu_id`, `skin_color`, `height`, `weight`, `salary`, `place_of_birth_id`, `place_of_living_id`, `skill_id`, `remarks`, `advs_type`, `cv`, `position`, `is_featured`, `comments`, `status`, `user_id`, `admin_status`, `is_deleted`, `worker_created_at`) VALUES
(26, 'uploads/worker/626750d2d4c4f.png', 'Junaid Ali', 'Junaid Ali Arabic', '923043372285', 'Muslim', '', 'Excellent', 20, 'Yes', 'No', 10, 20, 1, 'Fair', 12, 20, '12000', 2, 2, '[{\"skill_id\":\"1\",\"en_name\":\"Driver\",\"ar_name\":\"سائق\",\"status\":\"Active\"},{\"skill_id\":\"4\",\"en_name\":\"Mechanic\",\"ar_name\":\"ميكانيكي\",\"status\":\"Active\"},{\"skill_id\":\"5\",\"en_name\":\"Cleaning\",\"ar_name\":\"الغسيل\",\"status\":\"Active\"},{\"skill_id\":\"6\",\"en_name\":\"Kids Care\",\"ar_name\":\"رعاية الأطفال\",\"status\":\"Active\"}]', 'Multan, Pakistan', 'admission', 'uploads/cv/626750d7ef230KotlinNotesForProfessionals.pdf', 1, 'No', NULL, 'Active', 7, 'Active', 0, '2022-04-26 01:54:27'),
(27, 'uploads/worker/626751b01cc32.png', 'Junaid', 'Jn', '923043372285', 'Muslim', '', 'Excellent', 20, 'No', 'No', 0, 20, 1, 'fair', 156, 75, '20000', 5, 5, '[{\"skill_id\":\"1\",\"en_name\":\"Driver\",\"ar_name\":\"سائق\",\"status\":\"Active\"},{\"skill_id\":\"2\",\"en_name\":\"Accounting\",\"ar_name\":\"محاسبة\",\"status\":\"Active\"},{\"skill_id\":\"4\",\"en_name\":\"Mechanic\",\"ar_name\":\"ميكانيكي\",\"status\":\"Active\"},{\"skill_id\":\"5\",\"en_name\":\"Cleaning\",\"ar_name\":\"الغسيل\",\"status\":\"Active\"},{\"skill_id\":\"6\",\"en_name\":\"Kids Care\",\"ar_name\":\"رعاية الأطفال\",\"status\":\"Active\"}]', 'some remarks', 'admission', 'uploads/cv/626751b3256e4KotlinNotesForProfessionals.pdf', 1, 'No', 'here aer ethe ', 'Active', 7, 'Active', 0, '2022-04-26 01:58:08'),
(28, 'uploads/worker/626b055af0948.png', 'Kashif Khan', 'Kashif khan', '923043372285', 'Muslim', '', 'Excellent', 28, 'No', 'No', 0, 12, 1, 'Fair', 150, 130, '10000', 1, 1, '[{\"skill_id\":\"1\",\"en_name\":\"Driver\",\"ar_name\":\"سائق\",\"status\":\"Active\"},{\"skill_id\":\"4\",\"en_name\":\"Mechanic\",\"ar_name\":\"ميكانيكي\",\"status\":\"Active\"},{\"skill_id\":\"6\",\"en_name\":\"Kids Care\",\"ar_name\":\"رعاية الأطفال\",\"status\":\"Active\"}]', 'I am ready to work', 'sponsored', 'uploads/cv/626b055deae73KotlinNotesForProfessionals.pdf', 1, 'No', 'You worker request has been verified thanks', 'Active', 2, 'Active', 0, '2022-04-28 21:21:31'),
(29, 'uploads/worker/627e5204efab1.png', 'tamer Test', 'تامر-Test', '97470395571', 'Muslim', '', 'Excellent', 22, 'Yes', 'No', 2, 15, 1, 'wh', 150, 66, '1000', 3, 5, '[{\"skill_id\":\"2\",\"en_name\":\"Accounting\",\"ar_name\":\"محاسبة\",\"status\":\"Active\"},{\"skill_id\":\"4\",\"en_name\":\"Mechanic\",\"ar_name\":\"ميكانيكي\",\"status\":\"Active\"},{\"skill_id\":\"5\",\"en_name\":\"Cleaning\",\"ar_name\":\"الغسيل\",\"status\":\"Active\"},{\"skill_id\":\"6\",\"en_name\":\"Kids Care\",\"ar_name\":\"رعاية الأطفال\",\"status\":\"Active\"}]', 'ttttttt\nhhhhh\ngggg\nddd', 'admission', 'uploads/cv/627e52084f56cالتقييم السنوى.pdf', 1, 'No', NULL, 'Active', 20, 'Active', 0, '2022-05-13 12:41:40'),
(30, 'uploads/worker/627e6ae831933.png', 'company three first add', 'اعلان ١ للشركة ٣', '97466657496', 'Other', '', 'No', 25, 'No', 'No', 0, 2, 2, 'white', 150, 150, '1000', 5, 3, '[{\"skill_id\":\"1\",\"en_name\":\"Driver\",\"ar_name\":\"سائق\",\"status\":\"Active\"},{\"skill_id\":\"2\",\"en_name\":\"Accounting\",\"ar_name\":\"محاسبة\",\"status\":\"Active\"}]', 'nothing', 'sponsored', 'uploads/cv/627e6aea9bae9التقييم السنوى.pdf', 1, 'No', NULL, 'Active', 23, 'Active', 0, '2022-05-13 14:27:52'),
(31, 'uploads/worker/6283dad2767c7.png', 'test department', 'اختبار اضافة للقيم الصحيح', '556888888888', 'Hindu', '', 'Moderate', 22, 'Yes', 'No', 0, 25, 5, '????', 180, 150, '252', 6, 4, '[{\"skill_id\":\"2\",\"en_name\":\"Accounting\",\"ar_name\":\"محاسبة\",\"status\":\"Active\"},{\"skill_id\":\"4\",\"en_name\":\"Mechanic\",\"ar_name\":\"ميكانيكي\",\"status\":\"Active\"},{\"skill_id\":\"6\",\"en_name\":\"Kids Care\",\"ar_name\":\"رعاية الأطفال\",\"status\":\"Active\"}]', 'تهغغ', 'admission', 'uploads/cv/6283dad342633تعهد السرية الخاص لمنسق المدرسة  لاختبار بيزا التجريبي 2021 موقعا.pdf', 1, 'No', NULL, 'Active', 23, 'Active', 0, '2022-05-17 17:26:42'),
(32, 'uploads/worker/6283ddd3db812.png', 'walid test dept', 'اختبار اضافة لقسم', '3332586555', 'Jew', '', 'Moderate', 22, 'No', 'No', 2, 55, 2, '????', 222, 222, '1000', 5, 5, '[{\"skill_id\":\"2\",\"en_name\":\"Accounting\",\"ar_name\":\"محاسبة\",\"status\":\"Active\"},{\"skill_id\":\"6\",\"en_name\":\"Kids Care\",\"ar_name\":\"رعاية الأطفال\",\"status\":\"Active\"}]', 'اللل', 'admission', 'uploads/cv/6283ddd4e5b16تعهد السرية الخاص لمنسق المدرسة  لاختبار بيزا التجريبي 2021 موقعا.pdf', 1, 'No', NULL, 'Active', 24, 'Active', 0, '2022-05-17 17:39:31'),
(33, 'uploads/worker/62d806ebb724a.png', 'Muhammad', 'خضر', '3056860156', 'Muslim', '', 'Moderate', 22, 'Yes', 'No', 2, 10, 1, 'Black', 180, 65, '100000', 166, 166, '[{\"skill_id\":\"1\",\"en_name\":\"Driver\",\"ar_name\":\"سائق\",\"status\":\"Active\"},{\"skill_id\":\"2\",\"en_name\":\"Accounting\",\"ar_name\":\"محاسبة\",\"status\":\"Active\"}]', 'I can work more passionately ', 'admission', 'uploads/cv/62d806ec7840fMuhammad_Khizer_Resume.pdf', 1, 'No', NULL, 'Active', 27, 'Inactive', 0, '2022-07-20 13:45:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shkalah_account_type`
--
ALTER TABLE `shkalah_account_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `shkalah_company`
--
ALTER TABLE `shkalah_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `shkalah_complains`
--
ALTER TABLE `shkalah_complains`
  ADD PRIMARY KEY (`complain_id`);

--
-- Indexes for table `shkalah_countries`
--
ALTER TABLE `shkalah_countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `shkalah_department`
--
ALTER TABLE `shkalah_department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `shkalah_education`
--
ALTER TABLE `shkalah_education`
  ADD PRIMARY KEY (`edu_id`);

--
-- Indexes for table `shkalah_favourite`
--
ALTER TABLE `shkalah_favourite`
  ADD PRIMARY KEY (`favourite_id`);

--
-- Indexes for table `shkalah_language`
--
ALTER TABLE `shkalah_language`
  ADD PRIMARY KEY (`phrase_id`);

--
-- Indexes for table `shkalah_notification`
--
ALTER TABLE `shkalah_notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `shkalah_profile_slider`
--
ALTER TABLE `shkalah_profile_slider`
  ADD PRIMARY KEY (`slider_profile_id`);

--
-- Indexes for table `shkalah_reservation`
--
ALTER TABLE `shkalah_reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `shkalah_skill`
--
ALTER TABLE `shkalah_skill`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `shkalah_slider`
--
ALTER TABLE `shkalah_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `shkalah_system_settings`
--
ALTER TABLE `shkalah_system_settings`
  ADD PRIMARY KEY (`system_settings_id`);

--
-- Indexes for table `shkalah_transaction`
--
ALTER TABLE `shkalah_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `shkalah_unique_visit`
--
ALTER TABLE `shkalah_unique_visit`
  ADD PRIMARY KEY (`unique_visit_id`);

--
-- Indexes for table `shkalah_user`
--
ALTER TABLE `shkalah_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `shkalah_users_roles`
--
ALTER TABLE `shkalah_users_roles`
  ADD PRIMARY KEY (`users_roles_id`);

--
-- Indexes for table `shkalah_user_ips`
--
ALTER TABLE `shkalah_user_ips`
  ADD PRIMARY KEY (`user_ips_id`);

--
-- Indexes for table `shkalah_worker`
--
ALTER TABLE `shkalah_worker`
  ADD PRIMARY KEY (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shkalah_account_type`
--
ALTER TABLE `shkalah_account_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shkalah_company`
--
ALTER TABLE `shkalah_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shkalah_complains`
--
ALTER TABLE `shkalah_complains`
  MODIFY `complain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shkalah_countries`
--
ALTER TABLE `shkalah_countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `shkalah_department`
--
ALTER TABLE `shkalah_department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shkalah_education`
--
ALTER TABLE `shkalah_education`
  MODIFY `edu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shkalah_favourite`
--
ALTER TABLE `shkalah_favourite`
  MODIFY `favourite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `shkalah_language`
--
ALTER TABLE `shkalah_language`
  MODIFY `phrase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `shkalah_notification`
--
ALTER TABLE `shkalah_notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `shkalah_profile_slider`
--
ALTER TABLE `shkalah_profile_slider`
  MODIFY `slider_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shkalah_reservation`
--
ALTER TABLE `shkalah_reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shkalah_skill`
--
ALTER TABLE `shkalah_skill`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shkalah_slider`
--
ALTER TABLE `shkalah_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shkalah_system_settings`
--
ALTER TABLE `shkalah_system_settings`
  MODIFY `system_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `shkalah_transaction`
--
ALTER TABLE `shkalah_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `shkalah_unique_visit`
--
ALTER TABLE `shkalah_unique_visit`
  MODIFY `unique_visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `shkalah_user`
--
ALTER TABLE `shkalah_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `shkalah_users_roles`
--
ALTER TABLE `shkalah_users_roles`
  MODIFY `users_roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shkalah_user_ips`
--
ALTER TABLE `shkalah_user_ips`
  MODIFY `user_ips_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shkalah_worker`
--
ALTER TABLE `shkalah_worker`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
