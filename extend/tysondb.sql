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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 正在导出表  tysondb.ts_message 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `ts_message` DISABLE KEYS */;
INSERT INTO `ts_message` (`id`, `mcontent`, `addtime`, `maddby`, `bgimg`) VALUES
	(1, 'aaa', 1521104134, 'ccc', ''),
	(2, '一帆风顺', 1521104233, '山子哥', '');
/*!40000 ALTER TABLE `ts_message` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
