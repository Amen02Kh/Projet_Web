-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2024 at 04:20 PM
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
-- Database: `cruciweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `crossword_grids`
--

CREATE TABLE `crossword_grids` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dimensions` varchar(10) NOT NULL,
  `difficulty` enum('beginner','intermediate','expert') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crossword_grids`
--

INSERT INTO `crossword_grids` (`id`, `name`, `dimensions`, `difficulty`, `created_by`, `created_at`) VALUES
(8, 'PROJET', '10x10', 'beginner', 6, '2024-12-23 20:08:19'),
(18, 'PRO88', '10x10', 'beginner', 4, '2024-12-25 03:08:15'),
(19, 'teettet', '10x10', 'beginner', 4, '2024-12-25 03:10:16'),
(20, 'PRO88', '10x10', 'beginner', 4, '2024-12-25 16:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `definitions`
--

CREATE TABLE `definitions` (
  `id` int(11) NOT NULL,
  `grid_id` int(11) NOT NULL,
  `orientation` enum('horizontal','vertical') NOT NULL,
  `row_or_col` int(11) NOT NULL,
  `definition` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `definitions`
--

INSERT INTO `definitions` (`id`, `grid_id`, `orientation`, `row_or_col`, `definition`) VALUES
(28, 8, 'horizontal', 1, '1'),
(29, 8, 'vertical', 1, '1'),
(48, 18, 'horizontal', 1, 'g'),
(49, 18, 'vertical', 1, 'g'),
(50, 19, 'horizontal', 1, 'd'),
(51, 19, 'vertical', 1, 'd'),
(52, 20, 'horizontal', 1, 'f'),
(53, 20, 'vertical', 1, 'f');

-- --------------------------------------------------------

--
-- Table structure for table `grid_cells`
--

CREATE TABLE `grid_cells` (
  `id` int(11) NOT NULL,
  `grid_id` int(11) NOT NULL,
  `row_num` int(11) NOT NULL,
  `col_num` int(11) NOT NULL,
  `is_black` tinyint(1) DEFAULT 0,
  `solution` char(1) DEFAULT NULL,
  `current_value` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grid_cells`
--

INSERT INTO `grid_cells` (`id`, `grid_id`, `row_num`, `col_num`, `is_black`, `solution`, `current_value`) VALUES
(901, 8, 1, 1, 0, 'P', NULL),
(902, 8, 1, 2, 0, 'R', NULL),
(903, 8, 1, 3, 0, 'O', NULL),
(904, 8, 1, 4, 0, 'J', NULL),
(905, 8, 1, 5, 0, 'E', NULL),
(906, 8, 1, 6, 0, 'T', NULL),
(907, 8, 1, 7, 1, NULL, NULL),
(908, 8, 1, 8, 1, NULL, NULL),
(909, 8, 1, 9, 1, NULL, NULL),
(910, 8, 1, 10, 0, NULL, NULL),
(911, 8, 2, 1, 0, NULL, NULL),
(912, 8, 2, 2, 0, NULL, NULL),
(913, 8, 2, 3, 0, NULL, NULL),
(914, 8, 2, 4, 0, NULL, NULL),
(915, 8, 2, 5, 0, NULL, NULL),
(916, 8, 2, 6, 0, NULL, NULL),
(917, 8, 2, 7, 1, NULL, NULL),
(918, 8, 2, 8, 1, NULL, NULL),
(919, 8, 2, 9, 1, NULL, NULL),
(920, 8, 2, 10, 0, NULL, NULL),
(921, 8, 3, 1, 0, NULL, NULL),
(922, 8, 3, 2, 0, NULL, NULL),
(923, 8, 3, 3, 0, NULL, NULL),
(924, 8, 3, 4, 0, NULL, NULL),
(925, 8, 3, 5, 1, NULL, NULL),
(926, 8, 3, 6, 0, NULL, NULL),
(927, 8, 3, 7, 1, NULL, NULL),
(928, 8, 3, 8, 1, NULL, NULL),
(929, 8, 3, 9, 1, NULL, NULL),
(930, 8, 3, 10, 0, NULL, NULL),
(931, 8, 4, 1, 0, NULL, NULL),
(932, 8, 4, 2, 0, NULL, NULL),
(933, 8, 4, 3, 0, NULL, NULL),
(934, 8, 4, 4, 0, NULL, NULL),
(935, 8, 4, 5, 0, NULL, NULL),
(936, 8, 4, 6, 0, NULL, NULL),
(937, 8, 4, 7, 1, NULL, NULL),
(938, 8, 4, 8, 1, NULL, NULL),
(939, 8, 4, 9, 0, NULL, NULL),
(940, 8, 4, 10, 0, NULL, NULL),
(941, 8, 5, 1, 0, NULL, NULL),
(942, 8, 5, 2, 0, NULL, NULL),
(943, 8, 5, 3, 0, NULL, NULL),
(944, 8, 5, 4, 0, NULL, NULL),
(945, 8, 5, 5, 0, NULL, NULL),
(946, 8, 5, 6, 0, NULL, NULL),
(947, 8, 5, 7, 1, NULL, NULL),
(948, 8, 5, 8, 1, NULL, NULL),
(949, 8, 5, 9, 1, NULL, NULL),
(950, 8, 5, 10, 0, NULL, NULL),
(951, 8, 6, 1, 0, NULL, NULL),
(952, 8, 6, 2, 0, NULL, NULL),
(953, 8, 6, 3, 0, NULL, NULL),
(954, 8, 6, 4, 0, NULL, NULL),
(955, 8, 6, 5, 0, NULL, NULL),
(956, 8, 6, 6, 0, NULL, NULL),
(957, 8, 6, 7, 1, NULL, NULL),
(958, 8, 6, 8, 1, NULL, NULL),
(959, 8, 6, 9, 0, NULL, NULL),
(960, 8, 6, 10, 0, NULL, NULL),
(961, 8, 7, 1, 0, NULL, NULL),
(962, 8, 7, 2, 0, NULL, NULL),
(963, 8, 7, 3, 0, NULL, NULL),
(964, 8, 7, 4, 0, NULL, NULL),
(965, 8, 7, 5, 0, NULL, NULL),
(966, 8, 7, 6, 0, NULL, NULL),
(967, 8, 7, 7, 1, NULL, NULL),
(968, 8, 7, 8, 1, NULL, NULL),
(969, 8, 7, 9, 0, NULL, NULL),
(970, 8, 7, 10, 0, NULL, NULL),
(971, 8, 8, 1, 0, NULL, NULL),
(972, 8, 8, 2, 0, NULL, NULL),
(973, 8, 8, 3, 0, NULL, NULL),
(974, 8, 8, 4, 0, NULL, NULL),
(975, 8, 8, 5, 0, NULL, NULL),
(976, 8, 8, 6, 0, NULL, NULL),
(977, 8, 8, 7, 1, NULL, NULL),
(978, 8, 8, 8, 1, NULL, NULL),
(979, 8, 8, 9, 0, NULL, NULL),
(980, 8, 8, 10, 0, NULL, NULL),
(981, 8, 9, 1, 0, NULL, NULL),
(982, 8, 9, 2, 0, NULL, NULL),
(983, 8, 9, 3, 0, NULL, NULL),
(984, 8, 9, 4, 0, NULL, NULL),
(985, 8, 9, 5, 0, NULL, NULL),
(986, 8, 9, 6, 0, NULL, NULL),
(987, 8, 9, 7, 1, NULL, NULL),
(988, 8, 9, 8, 1, NULL, NULL),
(989, 8, 9, 9, 0, NULL, NULL),
(990, 8, 9, 10, 0, NULL, NULL),
(991, 8, 10, 1, 0, NULL, NULL),
(992, 8, 10, 2, 0, NULL, NULL),
(993, 8, 10, 3, 0, NULL, NULL),
(994, 8, 10, 4, 0, NULL, NULL),
(995, 8, 10, 5, 0, NULL, NULL),
(996, 8, 10, 6, 0, NULL, NULL),
(997, 8, 10, 7, 1, NULL, NULL),
(998, 8, 10, 8, 1, NULL, NULL),
(999, 8, 10, 9, 0, NULL, NULL),
(1000, 8, 10, 10, 0, NULL, NULL),
(1666, 18, 1, 1, 0, NULL, NULL),
(1667, 18, 1, 2, 0, NULL, NULL),
(1668, 18, 1, 3, 0, NULL, NULL),
(1669, 18, 1, 4, 0, NULL, NULL),
(1670, 18, 1, 5, 0, NULL, NULL),
(1671, 18, 1, 6, 0, NULL, NULL),
(1672, 18, 1, 7, 0, NULL, NULL),
(1673, 18, 1, 8, 0, NULL, NULL),
(1674, 18, 1, 9, 0, NULL, NULL),
(1675, 18, 1, 10, 0, NULL, NULL),
(1676, 18, 2, 1, 0, NULL, NULL),
(1677, 18, 2, 2, 0, NULL, NULL),
(1678, 18, 2, 3, 0, NULL, NULL),
(1679, 18, 2, 4, 0, NULL, NULL),
(1680, 18, 2, 5, 0, NULL, NULL),
(1681, 18, 2, 6, 0, NULL, NULL),
(1682, 18, 2, 7, 0, NULL, NULL),
(1683, 18, 2, 8, 0, NULL, NULL),
(1684, 18, 2, 9, 0, NULL, NULL),
(1685, 18, 2, 10, 0, NULL, NULL),
(1686, 18, 3, 1, 0, NULL, NULL),
(1687, 18, 3, 2, 0, NULL, NULL),
(1688, 18, 3, 3, 0, NULL, NULL),
(1689, 18, 3, 4, 0, NULL, NULL),
(1690, 18, 3, 5, 0, NULL, NULL),
(1691, 18, 3, 6, 0, NULL, NULL),
(1692, 18, 3, 7, 1, NULL, NULL),
(1693, 18, 3, 8, 0, NULL, NULL),
(1694, 18, 3, 9, 0, NULL, NULL),
(1695, 18, 3, 10, 0, NULL, NULL),
(1696, 18, 4, 1, 0, NULL, NULL),
(1697, 18, 4, 2, 0, NULL, NULL),
(1698, 18, 4, 3, 0, NULL, NULL),
(1699, 18, 4, 4, 0, NULL, NULL),
(1700, 18, 4, 5, 0, NULL, NULL),
(1701, 18, 4, 6, 0, NULL, NULL),
(1702, 18, 4, 7, 1, NULL, NULL),
(1703, 18, 4, 8, 0, NULL, NULL),
(1704, 18, 4, 9, 0, NULL, NULL),
(1705, 18, 4, 10, 0, NULL, NULL),
(1706, 18, 5, 1, 0, NULL, NULL),
(1707, 18, 5, 2, 0, NULL, NULL),
(1708, 18, 5, 3, 0, NULL, NULL),
(1709, 18, 5, 4, 0, NULL, NULL),
(1710, 18, 5, 5, 0, NULL, NULL),
(1711, 18, 5, 6, 0, NULL, NULL),
(1712, 18, 5, 7, 1, NULL, NULL),
(1713, 18, 5, 8, 0, NULL, NULL),
(1714, 18, 5, 9, 0, NULL, NULL),
(1715, 18, 5, 10, 0, NULL, NULL),
(1716, 18, 6, 1, 0, NULL, NULL),
(1717, 18, 6, 2, 0, NULL, NULL),
(1718, 18, 6, 3, 0, NULL, NULL),
(1719, 18, 6, 4, 0, NULL, NULL),
(1720, 18, 6, 5, 0, NULL, NULL),
(1721, 18, 6, 6, 0, NULL, NULL),
(1722, 18, 6, 7, 0, NULL, NULL),
(1723, 18, 6, 8, 0, NULL, NULL),
(1724, 18, 6, 9, 0, NULL, NULL),
(1725, 18, 6, 10, 0, NULL, NULL),
(1726, 18, 7, 1, 0, NULL, NULL),
(1727, 18, 7, 2, 0, NULL, NULL),
(1728, 18, 7, 3, 0, NULL, NULL),
(1729, 18, 7, 4, 0, NULL, NULL),
(1730, 18, 7, 5, 0, NULL, NULL),
(1731, 18, 7, 6, 0, NULL, NULL),
(1732, 18, 7, 7, 0, 'g', NULL),
(1733, 18, 7, 8, 0, NULL, NULL),
(1734, 18, 7, 9, 0, NULL, NULL),
(1735, 18, 7, 10, 0, NULL, NULL),
(1736, 18, 8, 1, 0, NULL, NULL),
(1737, 18, 8, 2, 0, NULL, NULL),
(1738, 18, 8, 3, 0, NULL, NULL),
(1739, 18, 8, 4, 0, NULL, NULL),
(1740, 18, 8, 5, 0, NULL, NULL),
(1741, 18, 8, 6, 0, NULL, NULL),
(1742, 18, 8, 7, 0, NULL, NULL),
(1743, 18, 8, 8, 0, NULL, NULL),
(1744, 18, 8, 9, 0, NULL, NULL),
(1745, 18, 8, 10, 0, NULL, NULL),
(1746, 18, 9, 1, 0, NULL, NULL),
(1747, 18, 9, 2, 0, NULL, NULL),
(1748, 18, 9, 3, 0, NULL, NULL),
(1749, 18, 9, 4, 0, NULL, NULL),
(1750, 18, 9, 5, 0, NULL, NULL),
(1751, 18, 9, 6, 0, NULL, NULL),
(1752, 18, 9, 7, 0, NULL, NULL),
(1753, 18, 9, 8, 0, NULL, NULL),
(1754, 18, 9, 9, 0, NULL, NULL),
(1755, 18, 9, 10, 0, NULL, NULL),
(1756, 18, 10, 1, 0, NULL, NULL),
(1757, 18, 10, 2, 0, NULL, NULL),
(1758, 18, 10, 3, 0, NULL, NULL),
(1759, 18, 10, 4, 0, NULL, NULL),
(1760, 18, 10, 5, 0, NULL, NULL),
(1761, 18, 10, 6, 0, NULL, NULL),
(1762, 18, 10, 7, 0, NULL, NULL),
(1763, 18, 10, 8, 0, NULL, NULL),
(1764, 18, 10, 9, 0, NULL, NULL),
(1765, 18, 10, 10, 0, NULL, NULL),
(1766, 19, 1, 1, 0, NULL, NULL),
(1767, 19, 1, 2, 0, NULL, NULL),
(1768, 19, 1, 3, 0, NULL, NULL),
(1769, 19, 1, 4, 0, NULL, NULL),
(1770, 19, 1, 5, 0, NULL, NULL),
(1771, 19, 1, 6, 0, NULL, NULL),
(1772, 19, 1, 7, 0, NULL, NULL),
(1773, 19, 1, 8, 0, NULL, NULL),
(1774, 19, 1, 9, 0, NULL, NULL),
(1775, 19, 1, 10, 0, NULL, NULL),
(1776, 19, 2, 1, 0, 'd', NULL),
(1777, 19, 2, 2, 0, NULL, NULL),
(1778, 19, 2, 3, 0, NULL, NULL),
(1779, 19, 2, 4, 0, NULL, NULL),
(1780, 19, 2, 5, 0, NULL, NULL),
(1781, 19, 2, 6, 1, NULL, NULL),
(1782, 19, 2, 7, 0, NULL, NULL),
(1783, 19, 2, 8, 0, NULL, NULL),
(1784, 19, 2, 9, 0, NULL, NULL),
(1785, 19, 2, 10, 0, NULL, NULL),
(1786, 19, 3, 1, 0, NULL, NULL),
(1787, 19, 3, 2, 0, NULL, NULL),
(1788, 19, 3, 3, 0, NULL, NULL),
(1789, 19, 3, 4, 1, NULL, NULL),
(1790, 19, 3, 5, 1, NULL, NULL),
(1791, 19, 3, 6, 0, NULL, NULL),
(1792, 19, 3, 7, 0, NULL, NULL),
(1793, 19, 3, 8, 0, NULL, NULL),
(1794, 19, 3, 9, 0, NULL, NULL),
(1795, 19, 3, 10, 0, NULL, NULL),
(1796, 19, 4, 1, 0, NULL, NULL),
(1797, 19, 4, 2, 0, NULL, NULL),
(1798, 19, 4, 3, 0, 'g', NULL),
(1799, 19, 4, 4, 1, NULL, NULL),
(1800, 19, 4, 5, 0, NULL, NULL),
(1801, 19, 4, 6, 0, NULL, NULL),
(1802, 19, 4, 7, 0, NULL, NULL),
(1803, 19, 4, 8, 0, NULL, NULL),
(1804, 19, 4, 9, 0, NULL, NULL),
(1805, 19, 4, 10, 0, NULL, NULL),
(1806, 19, 5, 1, 0, NULL, NULL),
(1807, 19, 5, 2, 0, NULL, NULL),
(1808, 19, 5, 3, 0, NULL, NULL),
(1809, 19, 5, 4, 0, NULL, NULL),
(1810, 19, 5, 5, 0, NULL, NULL),
(1811, 19, 5, 6, 0, NULL, NULL),
(1812, 19, 5, 7, 0, NULL, NULL),
(1813, 19, 5, 8, 0, NULL, NULL),
(1814, 19, 5, 9, 0, NULL, NULL),
(1815, 19, 5, 10, 0, NULL, NULL),
(1816, 19, 6, 1, 0, NULL, NULL),
(1817, 19, 6, 2, 0, NULL, NULL),
(1818, 19, 6, 3, 0, NULL, NULL),
(1819, 19, 6, 4, 0, NULL, NULL),
(1820, 19, 6, 5, 0, NULL, NULL),
(1821, 19, 6, 6, 0, NULL, NULL),
(1822, 19, 6, 7, 0, NULL, NULL),
(1823, 19, 6, 8, 0, NULL, NULL),
(1824, 19, 6, 9, 0, NULL, NULL),
(1825, 19, 6, 10, 0, NULL, NULL),
(1826, 19, 7, 1, 0, NULL, NULL),
(1827, 19, 7, 2, 0, NULL, NULL),
(1828, 19, 7, 3, 0, NULL, NULL),
(1829, 19, 7, 4, 0, NULL, NULL),
(1830, 19, 7, 5, 0, NULL, NULL),
(1831, 19, 7, 6, 0, NULL, NULL),
(1832, 19, 7, 7, 0, NULL, NULL),
(1833, 19, 7, 8, 0, NULL, NULL),
(1834, 19, 7, 9, 0, NULL, NULL),
(1835, 19, 7, 10, 0, NULL, NULL),
(1836, 19, 8, 1, 0, NULL, NULL),
(1837, 19, 8, 2, 0, NULL, NULL),
(1838, 19, 8, 3, 0, NULL, NULL),
(1839, 19, 8, 4, 0, NULL, NULL),
(1840, 19, 8, 5, 0, NULL, NULL),
(1841, 19, 8, 6, 0, NULL, NULL),
(1842, 19, 8, 7, 0, NULL, NULL),
(1843, 19, 8, 8, 0, NULL, NULL),
(1844, 19, 8, 9, 0, NULL, NULL),
(1845, 19, 8, 10, 0, NULL, NULL),
(1846, 19, 9, 1, 0, NULL, NULL),
(1847, 19, 9, 2, 0, NULL, NULL),
(1848, 19, 9, 3, 0, NULL, NULL),
(1849, 19, 9, 4, 0, NULL, NULL),
(1850, 19, 9, 5, 0, NULL, NULL),
(1851, 19, 9, 6, 0, NULL, NULL),
(1852, 19, 9, 7, 0, NULL, NULL),
(1853, 19, 9, 8, 0, NULL, NULL),
(1854, 19, 9, 9, 0, NULL, NULL),
(1855, 19, 9, 10, 0, NULL, NULL),
(1856, 19, 10, 1, 0, NULL, NULL),
(1857, 19, 10, 2, 0, NULL, NULL),
(1858, 19, 10, 3, 0, NULL, NULL),
(1859, 19, 10, 4, 0, NULL, NULL),
(1860, 19, 10, 5, 0, NULL, NULL),
(1861, 19, 10, 6, 0, NULL, NULL),
(1862, 19, 10, 7, 0, NULL, NULL),
(1863, 19, 10, 8, 0, NULL, NULL),
(1864, 19, 10, 9, 0, NULL, NULL),
(1865, 19, 10, 10, 0, NULL, NULL),
(1866, 20, 1, 1, 0, NULL, NULL),
(1867, 20, 1, 2, 0, NULL, NULL),
(1868, 20, 1, 3, 0, NULL, NULL),
(1869, 20, 1, 4, 0, NULL, NULL),
(1870, 20, 1, 5, 0, NULL, NULL),
(1871, 20, 1, 6, 0, NULL, NULL),
(1872, 20, 1, 7, 0, NULL, NULL),
(1873, 20, 1, 8, 0, NULL, NULL),
(1874, 20, 1, 9, 0, NULL, NULL),
(1875, 20, 1, 10, 0, NULL, NULL),
(1876, 20, 2, 1, 0, NULL, NULL),
(1877, 20, 2, 2, 0, NULL, NULL),
(1878, 20, 2, 3, 0, NULL, NULL),
(1879, 20, 2, 4, 0, NULL, NULL),
(1880, 20, 2, 5, 0, NULL, NULL),
(1881, 20, 2, 6, 0, NULL, NULL),
(1882, 20, 2, 7, 0, NULL, NULL),
(1883, 20, 2, 8, 0, NULL, NULL),
(1884, 20, 2, 9, 0, NULL, NULL),
(1885, 20, 2, 10, 0, NULL, NULL),
(1886, 20, 3, 1, 0, NULL, NULL),
(1887, 20, 3, 2, 0, NULL, NULL),
(1888, 20, 3, 3, 0, NULL, NULL),
(1889, 20, 3, 4, 0, NULL, NULL),
(1890, 20, 3, 5, 0, NULL, NULL),
(1891, 20, 3, 6, 0, NULL, NULL),
(1892, 20, 3, 7, 0, NULL, NULL),
(1893, 20, 3, 8, 0, NULL, NULL),
(1894, 20, 3, 9, 0, NULL, NULL),
(1895, 20, 3, 10, 0, NULL, NULL),
(1896, 20, 4, 1, 0, NULL, NULL),
(1897, 20, 4, 2, 0, NULL, NULL),
(1898, 20, 4, 3, 0, NULL, NULL),
(1899, 20, 4, 4, 0, NULL, NULL),
(1900, 20, 4, 5, 0, NULL, NULL),
(1901, 20, 4, 6, 0, NULL, NULL),
(1902, 20, 4, 7, 0, NULL, NULL),
(1903, 20, 4, 8, 0, NULL, NULL),
(1904, 20, 4, 9, 0, NULL, NULL),
(1905, 20, 4, 10, 0, NULL, NULL),
(1906, 20, 5, 1, 0, NULL, NULL),
(1907, 20, 5, 2, 0, NULL, NULL),
(1908, 20, 5, 3, 0, NULL, NULL),
(1909, 20, 5, 4, 0, NULL, NULL),
(1910, 20, 5, 5, 0, NULL, NULL),
(1911, 20, 5, 6, 0, NULL, NULL),
(1912, 20, 5, 7, 0, NULL, NULL),
(1913, 20, 5, 8, 0, NULL, NULL),
(1914, 20, 5, 9, 0, NULL, NULL),
(1915, 20, 5, 10, 0, NULL, NULL),
(1916, 20, 6, 1, 0, NULL, NULL),
(1917, 20, 6, 2, 0, NULL, NULL),
(1918, 20, 6, 3, 0, NULL, NULL),
(1919, 20, 6, 4, 0, NULL, NULL),
(1920, 20, 6, 5, 0, NULL, NULL),
(1921, 20, 6, 6, 0, NULL, NULL),
(1922, 20, 6, 7, 0, NULL, NULL),
(1923, 20, 6, 8, 1, NULL, NULL),
(1924, 20, 6, 9, 0, NULL, NULL),
(1925, 20, 6, 10, 0, NULL, NULL),
(1926, 20, 7, 1, 0, NULL, NULL),
(1927, 20, 7, 2, 0, NULL, NULL),
(1928, 20, 7, 3, 0, NULL, NULL),
(1929, 20, 7, 4, 0, NULL, NULL),
(1930, 20, 7, 5, 0, NULL, NULL),
(1931, 20, 7, 6, 0, NULL, NULL),
(1932, 20, 7, 7, 1, NULL, NULL),
(1933, 20, 7, 8, 0, NULL, NULL),
(1934, 20, 7, 9, 0, NULL, NULL),
(1935, 20, 7, 10, 0, NULL, NULL),
(1936, 20, 8, 1, 0, NULL, NULL),
(1937, 20, 8, 2, 0, NULL, NULL),
(1938, 20, 8, 3, 0, NULL, NULL),
(1939, 20, 8, 4, 1, NULL, NULL),
(1940, 20, 8, 5, 1, NULL, NULL),
(1941, 20, 8, 6, 1, NULL, NULL),
(1942, 20, 8, 7, 0, NULL, NULL),
(1943, 20, 8, 8, 0, NULL, NULL),
(1944, 20, 8, 9, 0, NULL, NULL),
(1945, 20, 8, 10, 0, NULL, NULL),
(1946, 20, 9, 1, 0, NULL, NULL),
(1947, 20, 9, 2, 0, NULL, NULL),
(1948, 20, 9, 3, 0, NULL, NULL),
(1949, 20, 9, 4, 0, NULL, NULL),
(1950, 20, 9, 5, 0, NULL, NULL),
(1951, 20, 9, 6, 0, NULL, NULL),
(1952, 20, 9, 7, 0, NULL, NULL),
(1953, 20, 9, 8, 0, NULL, NULL),
(1954, 20, 9, 9, 0, NULL, NULL),
(1955, 20, 9, 10, 0, NULL, NULL),
(1956, 20, 10, 1, 0, NULL, NULL),
(1957, 20, 10, 2, 0, NULL, NULL),
(1958, 20, 10, 3, 0, NULL, NULL),
(1959, 20, 10, 4, 0, NULL, NULL),
(1960, 20, 10, 5, 0, NULL, NULL),
(1961, 20, 10, 6, 0, NULL, NULL),
(1962, 20, 10, 7, 0, NULL, NULL),
(1963, 20, 10, 8, 0, NULL, NULL),
(1964, 20, 10, 9, 0, NULL, NULL),
(1965, 20, 10, 10, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('anonymous','registered','admin') DEFAULT 'anonymous'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(4, 'test', 'test@test.com', '$2y$10$MVvttVOJK8Uq67OZCfTP7uC84p8FqiUJ49BExxKThu19n5k4e4dkW', 'registered'),
(6, 'admin', 'admin@admin.com', '$2y$10$Bx7vLrWU5qTpIodzRsrCD.B4Q7THSE8rg5P7F0tKAQ3DTWjILUSea', 'admin'),
(10, 'khalfame', 'sdsd@gmail.ghjg', '$2y$10$6bW9rld1DNn1ens97JQuEOTwBYC0sAFnxa/OPEPK8dTGf4MSvG/Ha', 'registered');

-- --------------------------------------------------------

--
-- Table structure for table `user_grids`
--

CREATE TABLE `user_grids` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `grid_id` int(11) NOT NULL,
  `grid_name` varchar(255) DEFAULT NULL,
  `state` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_grids`
--

INSERT INTO `user_grids` (`id`, `user_id`, `grid_id`, `grid_name`, `state`, `created_at`, `updated_at`) VALUES
(1, 6, 8, NULL, '{\"1\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"10\":\"\"},\"2\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"10\":\"\"},\"3\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"10\":\"\"},\"4\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"},\"5\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"10\":\"\"},\"6\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"},\"7\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"},\"8\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"},\"9\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"},\"10\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"}}', '2024-12-23 19:29:12', '2024-12-23 19:29:12'),
(2, 6, 8, NULL, '{\"1\":{\"1\":\"p\",\"2\":\"p\",\"3\":\"p\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"10\":\"\"},\"2\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"10\":\"\"},\"3\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"6\":\"\",\"10\":\"\"},\"4\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"},\"5\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"10\":\"\"},\"6\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"},\"7\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"},\"8\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"},\"9\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"},\"10\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"9\":\"\",\"10\":\"\"}}', '2024-12-23 19:29:22', '2024-12-23 19:29:22'),
(26, 4, 20, NULL, '{\"1\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"7\":\"\",\"8\":\"\",\"9\":\"\",\"10\":\"\"},\"2\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"7\":\"\",\"8\":\"\",\"9\":\"\",\"10\":\"\"},\"3\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"7\":\"\",\"8\":\"\",\"9\":\"\",\"10\":\"\"},\"4\":{\"1\":\"\",\"2\":\"g\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"7\":\"\",\"8\":\"\",\"9\":\"\",\"10\":\"\"},\"5\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"7\":\"\",\"8\":\"\",\"9\":\"\",\"10\":\"\"},\"6\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"7\":\"\",\"9\":\"\",\"10\":\"\"},\"7\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"8\":\"\",\"9\":\"\",\"10\":\"\"},\"8\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"7\":\"\",\"8\":\"\",\"9\":\"\",\"10\":\"\"},\"9\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"7\":\"\",\"8\":\"\",\"9\":\"\",\"10\":\"\"},\"10\":{\"1\":\"\",\"2\":\"\",\"3\":\"\",\"4\":\"\",\"5\":\"\",\"6\":\"\",\"7\":\"\",\"8\":\"\",\"9\":\"\",\"10\":\"\"}}', '2024-12-25 15:10:18', '2024-12-25 15:10:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crossword_grids`
--
ALTER TABLE `crossword_grids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `definitions`
--
ALTER TABLE `definitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grid_id` (`grid_id`);

--
-- Indexes for table `grid_cells`
--
ALTER TABLE `grid_cells`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grid_id` (`grid_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_grids`
--
ALTER TABLE `user_grids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `grid_id` (`grid_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crossword_grids`
--
ALTER TABLE `crossword_grids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `definitions`
--
ALTER TABLE `definitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `grid_cells`
--
ALTER TABLE `grid_cells`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1966;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_grids`
--
ALTER TABLE `user_grids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crossword_grids`
--
ALTER TABLE `crossword_grids`
  ADD CONSTRAINT `crossword_grids_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `definitions`
--
ALTER TABLE `definitions`
  ADD CONSTRAINT `definitions_ibfk_1` FOREIGN KEY (`grid_id`) REFERENCES `crossword_grids` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grid_cells`
--
ALTER TABLE `grid_cells`
  ADD CONSTRAINT `grid_cells_ibfk_1` FOREIGN KEY (`grid_id`) REFERENCES `crossword_grids` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_grids`
--
ALTER TABLE `user_grids`
  ADD CONSTRAINT `user_grids_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_grids_ibfk_2` FOREIGN KEY (`grid_id`) REFERENCES `crossword_grids` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
