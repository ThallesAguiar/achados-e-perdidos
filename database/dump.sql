-- --------------------------------------------------------
-- Servidor:                     192.168.2.100
-- Versão do servidor:           5.5.62-0+deb8u1 - (Debian)
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para achados_e_perdidos
CREATE DATABASE IF NOT EXISTS `achados_e_perdidos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `achados_e_perdidos`;

-- Copiando estrutura para tabela achados_e_perdidos.perdido
CREATE TABLE IF NOT EXISTS `perdido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_achado` varchar(150) NOT NULL,
  `data_achado` datetime NOT NULL,
  `nome_pessoa` varchar(100) NOT NULL,
  `local` varchar(50) NOT NULL,
  `devolvido` tinyint(4) DEFAULT NULL,
  `entregado_para` varchar(100) DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela achados_e_perdidos.perdido: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `perdido` DISABLE KEYS */;
/*!40000 ALTER TABLE `perdido` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
