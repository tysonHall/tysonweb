-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.7.17-log - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出  表 tysondb.ts_message 结构
CREATE TABLE IF NOT EXISTS `ts_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mcontent` text NOT NULL,
  `addtime` int(11) NOT NULL DEFAULT '0',
  `maddby` varchar(50) DEFAULT NULL,
  `bgimg` varchar(100) DEFAULT NULL,
  `likecount` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- 正在导出表  tysondb.ts_message 的数据：~3 rows (大约)
/*!40000 ALTER TABLE `ts_message` DISABLE KEYS */;
INSERT INTO `ts_message` (`id`, `mcontent`, `addtime`, `maddby`, `bgimg`, `likecount`) VALUES
	(1, 'aaa', 1521104134, 'ccc', '', 0),
	(2, '一帆风顺', 1521104233, '山子哥', '', 1),
	(3, '再见', 1521180117, '匿名', '', 0);
/*!40000 ALTER TABLE `ts_message` ENABLE KEYS */;


-- 导出  表 tysondb.ts_mimg 结构
CREATE TABLE IF NOT EXISTS `ts_mimg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) DEFAULT NULL,
  `width` int(11) DEFAULT '0',
  `height` int(11) DEFAULT '0',
  `size` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  `addtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- 正在导出表  tysondb.ts_mimg 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `ts_mimg` DISABLE KEYS */;
INSERT INTO `ts_mimg` (`id`, `url`, `width`, `height`, `size`, `state`, `addtime`) VALUES
	(1, '/uploads/images/20180316/052442822520b7c274e626a2d7f23b0c.JPG', 600, 400, 6186759, 0, 1521190524),
	(2, '/uploads/images/20180316/2541b98227899702d2f7c74301807666.jpg', 600, 450, 1619466, 0, 1521190525),
	(3, '/uploads/images/20180316/62a68cc10bb8fa044dae86c147b90030.jpg', 600, 800, 1841061, 0, 1521190526),
	(4, '/uploads/images/20180316/1b6b61249cea0dba919ac554c8ea748a.jpg', 600, 800, 843423, 0, 1521190527),
	(5, '/uploads/images/20180316/0a65ba6b5989af09393c16c54cc47608.jpg', 600, 800, 2200330, 0, 1521190527),
	(6, '/uploads/images/20180316/01e2b13d9fe008b7fdc7dc5cb1c7112a.jpg', 600, 450, 2592050, 0, 1521190528),
	(7, '/uploads/images/20180316/985dea14970514c2293f84cf5a776f78.jpg', 600, 800, 1999555, 0, 1521190529),
	(8, '/uploads/images/20180316/5d8eda88086a276133906a114702a0b2.jpg', 600, 800, 1469766, 0, 1521190529);
/*!40000 ALTER TABLE `ts_mimg` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
