-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para biblioteca
CREATE DATABASE IF NOT EXISTS `biblioteca` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `biblioteca`;

-- Copiando estrutura para tabela biblioteca.emprestimos
CREATE TABLE IF NOT EXISTS `emprestimos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `livro_id` bigint unsigned NOT NULL,
  `data_saida` date NOT NULL,
  `data_devolucao` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emprestimos_user_id_foreign` (`user_id`),
  KEY `emprestimos_livro_id_foreign` (`livro_id`),
  CONSTRAINT `emprestimos_livro_id_foreign` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`),
  CONSTRAINT `emprestimos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela biblioteca.emprestimos: ~2 rows (aproximadamente)
INSERT INTO `emprestimos` (`id`, `user_id`, `livro_id`, `data_saida`, `data_devolucao`, `created_at`, `updated_at`) VALUES
	(1, 3, 4, '2026-03-17', '2026-03-24', NULL, NULL),
	(2, 2, 2, '2026-03-17', '2026-03-24', NULL, NULL);

-- Copiando estrutura para tabela biblioteca.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela biblioteca.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela biblioteca.generos
CREATE TABLE IF NOT EXISTS `generos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela biblioteca.generos: ~16 rows (aproximadamente)
INSERT INTO `generos` (`id`, `nome`, `created_at`, `updated_at`) VALUES
	(1, 'Ficção Científica', NULL, NULL),
	(2, 'Fantasia', NULL, NULL),
	(3, 'Distopia', NULL, NULL),
	(4, 'Horror', NULL, NULL),
	(5, 'Romance', NULL, NULL),
	(6, 'Thriller', NULL, NULL),
	(7, 'Histórico', NULL, NULL),
	(8, 'Biografia', NULL, NULL),
	(9, 'Autoajuda', NULL, NULL),
	(10, 'Técnico/Académico', NULL, NULL),
	(11, 'Poesia', NULL, NULL),
	(12, 'Drama', NULL, NULL),
	(13, 'Aventura', NULL, NULL),
	(14, 'Comédia', NULL, NULL),
	(15, 'Infantil', NULL, NULL),
	(16, 'Mangá', NULL, NULL);

-- Copiando estrutura para tabela biblioteca.livros
CREATE TABLE IF NOT EXISTS `livros` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `genero_id` bigint unsigned NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `estoque` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `livros_genero_id_foreign` (`genero_id`),
  CONSTRAINT `livros_genero_id_foreign` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela biblioteca.livros: ~4 rows (aproximadamente)
INSERT INTO `livros` (`id`, `genero_id`, `titulo`, `descricao`, `autor`, `capa`, `data_publicacao`, `estoque`, `created_at`, `updated_at`) VALUES
	(1, 2, 'O Senhor dos Anéis', 'A jornada épica de Frodo Bolseiro para destruir o Um Anel e salvar a Terra Média das forças do mal.', 'J.R.R. Tolkien', 'capas/lotr.jpg', '1954-07-29', 5, '2026-03-17 05:44:32', '2026-03-17 05:44:32'),
	(2, 2, 'Harry Potter e a Pedra Filosofal', 'O jovem bruxo Harry Potter descobre que é famoso no mundo mágico e frequenta a Escola de Magia de Hogwarts, onde enfrenta desafios e faz amizades.', 'J.K. Rowling', 'capas/hp.jpg', '1997-06-26', 9, '2026-03-17 05:44:32', '2026-03-17 06:03:44'),
	(3, 2, 'O Hobbit', 'Bilbo Bolseiro vive uma vida pacata até ser arrastado por Gandalf e um grupo de anões em uma jornada épica para recuperar o Reino de Erebor do dragão Smaug.', 'J.R.R. Tolkien', 'capas/hobbit.jpg', '1937-09-21', 15, '2026-03-17 05:44:32', '2026-03-31 20:51:58'),
	(4, 16, 'Neon Genesis Evangelion', 'Em um mundo pós-apocalíptico, a organização NERV utiliza biomecas gigantes chamados Evangelions para combater seres monstruosos conhecidos como Anjos. Shinji Ikari, um adolescente traumatizado, é forçado a pilotar a Unidade-01 enquanto enfrenta dilemas existenciais e o colapso da humanidade.', 'Yoshiyuki Sadamoto / Hideaki Anno', 'capas/evangelion.jpg', '1994-12-26', 4, '2026-03-17 05:44:32', '2026-03-17 05:57:17');

-- Copiando estrutura para tabela biblioteca.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela biblioteca.migrations: ~8 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2026_02_13_212316_create_generos_table', 1),
	(6, '2026_02_13_212318_create_livros_table', 1),
	(7, '2026_02_13_212320_create_emprestimos_table', 1),
	(8, '2026_02_15_133141_add_descricao_to_livros_table', 1);

-- Copiando estrutura para tabela biblioteca.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela biblioteca.password_reset_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela biblioteca.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela biblioteca.personal_access_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela biblioteca.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela biblioteca.users: ~3 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'admin@biblioteca.com', NULL, '$2y$12$Wta1V6DxF0Eqp0qFiOFeLOdVgicjXJLP3uv4JG50rrPhRuFVKtSve', 'admin', NULL, '2026-03-17 05:44:31', '2026-03-17 05:44:31'),
	(2, 'Usuário Comum', 'user@biblioteca.com', NULL, '$2y$12$H.n08s/SWulubthnfkxgOusA3/.UVpqagtp1B2Nt3O.7DqRdLGcri', 'aluno', NULL, '2026-03-17 05:44:32', '2026-03-17 05:44:32'),
	(3, 'leo1', 'abc@abc', NULL, '$2y$12$oS3O/W1ZMOy3/CZ4pDGFLe0dLVvA97VzTgWxXppNNeZip7/oSJw6W', 'aluno', NULL, '2026-03-17 05:45:02', '2026-03-31 20:49:33');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
