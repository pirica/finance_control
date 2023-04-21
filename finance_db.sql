-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 21-Abr-2023 às 17:34
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `finance_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cards`
--

CREATE TABLE `cards` (
  `id` int(11) UNSIGNED NOT NULL,
  `card_holder` varchar(100) DEFAULT NULL,
  `card_number` varchar(19) DEFAULT NULL,
  `flag_card` varchar(50) DEFAULT NULL,
  `flag_icon` varchar(100) DEFAULT NULL,
  `dt_expired` datetime DEFAULT NULL,
  `limit_value` int(11) DEFAULT NULL,
  `available_limit` float DEFAULT NULL,
  `users_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `cards`
--

INSERT INTO `cards` (`id`, `card_holder`, `card_number`, `flag_card`, `flag_icon`, `dt_expired`, `limit_value`, `available_limit`, `users_id`) VALUES
(20, 'William Silva Sebastiao', '4628 9472 8974 2893', 'visa', 'visa-icon', '2023-10-10 23:59:59', 3000, NULL, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `finance_categorys`
--

CREATE TABLE `finance_categorys` (
  `id` int(11) NOT NULL,
  `category_type` int(1) NOT NULL DEFAULT 0,
  `category_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `finance_categorys`
--

INSERT INTO `finance_categorys` (`id`, `category_type`, `category_name`) VALUES
(1, 2, 'Educação'),
(2, 2, 'Alimentação'),
(3, 2, 'Transporte'),
(4, 2, 'Lazer'),
(5, 2, 'Saúde'),
(6, 2, 'Moradia'),
(7, 2, 'Pessoal'),
(8, 2, 'Outros'),
(9, 1, 'Venda Produto|Serviço'),
(10, 1, 'Salário'),
(11, 1, 'Aluguel'),
(12, 1, 'Devolução de Empréstimo'),
(13, 1, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `menu`
--

CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL,
  `class_icon` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `sub_menu` char(1) DEFAULT NULL,
  `menu_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `show_item` char(1) NOT NULL,
  `id_submenu` int(11) DEFAULT NULL,
  `main_menu_id` int(11) DEFAULT NULL,
  `class_icon_submenu` varchar(50) DEFAULT NULL,
  `url_submenu` varchar(50) DEFAULT NULL,
  `submenu_name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `menu`
--

INSERT INTO `menu` (`idmenu`, `class_icon`, `url`, `sub_menu`, `menu_name`, `show_item`, `id_submenu`, `main_menu_id`, `class_icon_submenu`, `url_submenu`, `submenu_name`) VALUES
(1, 'fa-solid fa-gauge', 'dashboard-main.php', NULL, 'Dashboard', 'S', NULL, NULL, NULL, NULL, NULL),
(2, 'fa-solid fa-square-poll-vertical', '#relatorios', 'S', 'Relatórios', 'S', NULL, NULL, NULL, NULL, NULL),
(4, 'fa-solid fa-calendar-days', '#agendamento', 'S', 'Agendamento', '', NULL, NULL, NULL, NULL, NULL),
(5, 'fa-solid fa-money-bill-trend-up', 'investments.php', NULL, 'Investimentos', '', NULL, NULL, NULL, NULL, NULL),
(6, 'fa-solid fa-credit-card', '#cartaos', 'S', 'Cartões', 'S', NULL, NULL, NULL, NULL, NULL),
(7, 'fa-solid fa-bullseye', 'goals.php', NULL, 'Metas', '', NULL, NULL, NULL, NULL, NULL),
(8, 'fa-solid fa-user-pen', 'edit_profile.php', NULL, 'Editar Perfil', 'S', NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL, '', 1, 2, '', 'financial_entry_report.php', 'Entradas'),
(10, NULL, NULL, NULL, NULL, '', 2, 2, '', 'financial_exit_report.php', 'Saídas'),
(11, NULL, NULL, NULL, NULL, '', 3, 6, NULL, 'add_card.php', 'Adicionar Cartão'),
(12, NULL, NULL, NULL, NULL, '', 4, 6, NULL, 'cards_list.php', 'Todos os Cartões'),
(13, 'fa-solid fa-circle-info', 'info.php', NULL, 'Informações', 'S', NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL, '', 5, 4, 'fa-regular fa-calendar-plus', 'schedule_revenue.php', 'Agendar Receita'),
(17, NULL, NULL, NULL, NULL, '', 6, 4, 'fa-regular fa-calendar-minus', 'schedule_expense.php', 'Agendar Despesa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `popup`
--

CREATE TABLE `popup` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `popup`
--

INSERT INTO `popup` (`id`, `title`, `description`, `image`, `created_at`, `date_expired`) VALUES
(1, 'Teste Popup', 'ask jahskj ahsa sakjsh kjahs akjhs kj', NULL, '2023-04-12 19:02:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `popup_users`
--

CREATE TABLE `popup_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_welcome_popup` int(11) DEFAULT NULL,
  `show_welcome_popup` char(1) DEFAULT NULL,
  `welcome_status` char(1) DEFAULT NULL,
  `id_info_popup` int(11) DEFAULT NULL,
  `show_info_popup` char(1) DEFAULT NULL,
  `info_status` char(1) DEFAULT NULL,
  `users_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `popup_users`
--

INSERT INTO `popup_users` (`id`, `id_welcome_popup`, `show_welcome_popup`, `welcome_status`, `id_info_popup`, `show_info_popup`, `info_status`, `users_id`) VALUES
(1, 1, 'S', NULL, NULL, NULL, NULL, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_finances`
--

CREATE TABLE `tb_finances` (
  `id` int(11) UNSIGNED NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `obs` longtext DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `expense` char(1) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `users_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_finances`
--

INSERT INTO `tb_finances` (`id`, `description`, `obs`, `value`, `type`, `expense`, `category`, `create_at`, `update_at`, `users_id`) VALUES
(48, 'Venda de memória', '', 130, 1, NULL, 9, '2023-03-17 17:14:22', '2023-03-30 16:09:59', 13),
(50, 'nada 2', NULL, 100, 1, NULL, NULL, '2023-02-18 19:39:10', NULL, 13),
(52, 'saida 1', NULL, 0, NULL, NULL, NULL, '2023-01-18 20:44:28', NULL, 13),
(53, 'saida 2', NULL, 300, 2, NULL, NULL, '2023-02-18 20:44:28', NULL, 13),
(62, 'entrada de dinheiro', 'adslkdhakljdhasjkd hasdhas dhaskjdh asdh askhaskjd haskjd ha', 132, 1, NULL, 12, '2023-03-20 12:30:35', '2023-03-30 17:46:36', 13),
(82, 'conta de agua janeiro', NULL, 65, 2, 'F', 6, '2023-03-20 21:15:01', '2023-03-26 10:45:05', 13),
(143, 'N?o houve registros nesse m?s', NULL, 1, 1, NULL, NULL, '2023-02-10 10:00:10', NULL, 16),
(144, 'N?o houve registros nesse m?s', NULL, 1, 2, NULL, NULL, '2023-02-10 10:00:10', NULL, 16),
(145, 'N?o houve registros nesse m?s', NULL, 1, 1, NULL, NULL, '2023-01-10 10:00:10', NULL, 16),
(146, 'N?o houve registros nesse m?s', NULL, 1, 2, NULL, NULL, '2023-01-10 10:00:10', NULL, 16),
(147, 'entrada de dinheiro', NULL, 1200, 1, NULL, 10, '2023-03-20 22:02:10', NULL, 16),
(148, 'Saida de dinheiro', NULL, 600, 2, 'V', 7, '2023-03-20 22:02:39', NULL, 16),
(149, 'N?o houve registros nesse m?s', NULL, 1, 1, NULL, NULL, '2023-01-10 10:00:10', NULL, 13),
(150, 'N?o houve registros nesse m?s', NULL, 1, 2, NULL, NULL, '2023-01-10 10:00:10', NULL, 13),
(162, 'Saida de dinheiro', '', 400, 2, 'V', 7, '2023-03-23 18:02:56', '2023-04-02 19:59:13', 13),
(165, 'Saida de dinheiro teste', NULL, 200, 2, 'V', 7, '2023-02-23 18:02:56', NULL, 13),
(166, 'N?o houve registros nesse m?s', NULL, 1, 1, NULL, NULL, '2023-02-10 10:00:10', NULL, 18),
(167, 'N?o houve registros nesse m?s', NULL, 1, 2, NULL, NULL, '2023-02-10 10:00:10', NULL, 18),
(168, 'N?o houve registros nesse m?s', NULL, 1, 1, NULL, NULL, '2023-01-10 10:00:10', NULL, 18),
(169, 'N?o houve registros nesse m?s', NULL, 1, 2, NULL, NULL, '2023-01-10 10:00:10', NULL, 18),
(170, 'entrada de dinheiro', NULL, 1200, 1, NULL, 13, '2023-03-27 19:58:46', NULL, 18),
(171, 'Saida de dinheiro', NULL, 500, 2, 'V', 7, '2023-03-27 19:58:59', NULL, 18),
(172, 'entrada de dinheiro', NULL, 132, 1, NULL, 9, '2023-03-27 20:00:57', NULL, 18),
(173, 'Placa de video', NULL, 400, 2, 'V', 7, '2023-03-27 20:01:13', NULL, 18),
(174, 'Saida de dinheiro', NULL, 200, 2, 'F', 6, '2023-03-27 20:02:14', NULL, 18),
(196, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-02-10 10:00:10', NULL, 21),
(197, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-02-10 10:00:10', NULL, 21),
(198, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-01-10 10:00:10', NULL, 21),
(182, 'salario dev', 'teste 2', 1200, 1, NULL, 10, '2023-03-29 16:12:39', '2023-03-31 10:16:34', 13),
(209, 'Fatura cartão de crédito', NULL, 1100000, 2, 'V', 2, '2023-04-01 22:11:55', NULL, 21),
(208, 'Renda extra', NULL, 400000, 1, NULL, 13, '2023-04-01 22:10:59', NULL, 21),
(206, 'salário', NULL, 2400000, 1, NULL, 10, '2023-04-01 22:09:59', NULL, 21),
(203, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-03-10 10:00:10', NULL, 21),
(189, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-02-10 10:00:10', NULL, 20),
(190, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-02-10 10:00:10', NULL, 20),
(191, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-01-10 10:00:10', NULL, 20),
(192, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-01-10 10:00:10', NULL, 20),
(202, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-03-10 10:00:10', NULL, 21),
(194, 'bico Xsolutions', 'Bico na Xsolutions', 1000, 1, NULL, 13, '2023-03-30 16:41:30', '2023-03-30 16:43:03', 20),
(195, 'Pagamento mensal Series X', NULL, 450, 2, 'F', 4, '2023-03-30 16:43:52', NULL, 20),
(199, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-01-10 10:00:10', NULL, 21),
(200, 'teste ', NULL, 132, 1, NULL, 13, '2023-04-01 09:18:18', NULL, 13),
(201, 'doacao', NULL, 80, 1, NULL, 9, '2023-04-01 09:18:42', NULL, 13),
(210, 'Fatura cartão de crédito', NULL, 530000, 2, 'V', 7, '2023-04-01 22:21:25', NULL, 21),
(211, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-03-10 10:00:10', NULL, 22),
(212, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-03-10 10:00:10', NULL, 22),
(213, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-02-10 10:00:10', NULL, 22),
(214, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-02-10 10:00:10', NULL, 22),
(215, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-01-10 10:00:10', NULL, 22),
(216, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-01-10 10:00:10', NULL, 22),
(217, 'Impacta', NULL, 640, 2, 'F', 1, '2023-04-02 14:03:18', NULL, 22),
(218, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-03-10 10:00:10', NULL, 23),
(219, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-03-10 10:00:10', NULL, 23),
(220, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-02-10 10:00:10', NULL, 23),
(221, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-02-10 10:00:10', NULL, 23),
(222, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-01-10 10:00:10', NULL, 23),
(223, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-01-10 10:00:10', NULL, 23),
(225, 'Internet', NULL, 100, 2, 'F', 8, '2023-04-02 16:36:55', NULL, 23),
(226, 'Mei ', NULL, 72, 2, 'F', 8, '2023-04-02 16:39:29', NULL, 23),
(227, 'Net Celular ', NULL, 71, 2, 'F', 7, '2023-04-02 16:46:15', NULL, 23),
(228, 'Salário', NULL, 1500, 1, NULL, 9, '2023-04-02 16:47:22', NULL, 23),
(229, 'Cartão de Crédito Nubank', NULL, 220, 2, 'V', 8, '2023-04-02 16:55:26', NULL, 23),
(231, 'Cartâo De Crédito Santander', NULL, 1276520, 2, 'V', 8, '2023-04-02 16:59:56', NULL, 23),
(232, 'Nubank Reh ', NULL, 850, 2, 'V', 8, '2023-04-02 17:11:46', NULL, 23),
(234, 'saida', '', 300, 2, 'V', 7, '2023-04-02 17:27:42', '2023-04-02 19:54:45', 13),
(235, 'teste', NULL, 10, 1, NULL, 9, '2023-04-02 20:00:17', NULL, 13),
(238, 'teste 4', NULL, 40, 2, 'F', 6, '2023-04-02 20:00:54', NULL, 13),
(239, 'teste 4', NULL, 50, 1, NULL, 9, '2023-04-02 20:01:18', NULL, 13),
(240, 'teste 5', NULL, 65, 2, 'F', 6, '2023-04-02 20:01:35', NULL, 13),
(242, 'teste', NULL, 1250, 1, NULL, 13, '2023-04-02 20:10:53', NULL, 13),
(244, 'dentista', NULL, 3078, 2, 'F', 5, '2023-04-02 21:20:24', NULL, 22),
(245, 'Internet', NULL, 50, 2, 'F', 4, '2023-04-02 21:22:47', NULL, 22),
(246, 'Plano de Saúde', NULL, 120, 2, 'F', 5, '2023-04-02 21:23:29', NULL, 22),
(247, 'Plano odontologico', NULL, 30, 2, 'F', 5, '2023-04-02 21:24:29', NULL, 22),
(248, 'Academia', NULL, 59, 2, 'F', 7, '2023-04-02 21:25:27', NULL, 22),
(249, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-03-10 10:00:10', NULL, 24),
(250, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-03-10 10:00:10', NULL, 24),
(251, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-02-10 10:00:10', NULL, 24),
(252, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-02-10 10:00:10', NULL, 24),
(253, 'Não houve registros nesse mês', NULL, 1, 1, NULL, NULL, '2023-01-10 10:00:10', NULL, 24),
(254, 'Não houve registros nesse mês', NULL, 1, 2, NULL, NULL, '2023-01-10 10:00:10', NULL, 24),
(255, 'entrada', NULL, 2000, 1, NULL, 10, '2023-04-05 11:00:23', NULL, 24),
(256, 'nubank', NULL, 2100, 1, NULL, 13, '2023-04-17 10:15:20', NULL, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `lastname` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `image` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `token` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `bio` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `register_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `image`, `token`, `bio`, `register_date`) VALUES
(13, 'William', 'Silva', 'willian.seu@gmail.com', '$2y$10$V2Vn/GPRcp7Ypqp8.J3tiOxa.mEvJDZ44Epl4JStoAj.sKxASOqMG', '641c82030b79ae8b55fa2cc57d79efae5dfc8d9cd08f2fd5d0bac82db3c07f8c8a4a547c2ed059dcc99f4f977cf67d3926db09d3d127be48b1569556.jpg', '997c741fa5dff50749c98ad52812221fb8cf2e48a3ff9832d4ec79aa7cb5edf7b7753fc79c2b6e4dfd3e681412da5994893e', 'Sou paulista, Dev front-end, apaixonado por técnologia, games, séries e astronomia.', NULL),
(16, 'Roboto', 'ChatGPT4', 'roboto@teste.com.br', '$2y$10$ZPlsmYazC6btbNEEI/X4L.tqn7owEek2yUajStfpo1/t/DH1h1.PS', '4b09a019b3aacf43e59f0446b5fa29ab9a7750afc0b1d2150a2de047377e2a441b1aa9809bf8c38ce0d1f85eb97a6f0c72b1cdd5d475dd5e26637069.jpg', '355cc07f9b8162b0f56292a2ef2f627a6717b770707513f57ee9593384c318230f86fa55574ab86b09d0e2ba6bb793b92941', '', NULL),
(18, 'Kyorazo', 'Kyo', 'wpaulista_sp@hotmail.com', '$2y$10$XCqM6PqWuK8dc419r/IreeOPxWFdSKBsHxYFAAYI2lZY5RQ2X/wtC', '528e6179b3d12be97fdbb68f795d0c8a03cf87ce32df4da68d0abac7c29b622b1f01c81677b4b1d00d167220a04dcb3b6a117ce33713f85a13a90c28.jpg', '5fe9f27b98962ed2eaf235f1ea80c9c3c770c09a4a117fa074e95dbdd60d60229c58b8d0d0fc3646847e9e16193c538ac9ba', '', NULL),
(20, 'Vini', 'Dante', 'vinicius.inzaurralde@yahoo.com.br', '$2y$10$HbnqojPt/h5Ye61IiZZ9Guss871gAt2cUeanSLm0u5bvrmkwdeMfS', 'cab41dc4f0056e213500e2617ec2f2c1214b3cd725f773d971badb69acc44f43e3ffed40dfefcd179bcfcaabcae435c490584b822f485c33b654b2c7.jpg', '428e49516590b8beca19bdd4e0bfdece547d5ff75d6c7b8fb92d4f555a57110b56bac06d61e6361fd2f8d6107a995120143b', 'Gosto de tecnologia e games..', NULL),
(21, 'Albejane', 'Sousa', 'albejanesousa@hotmail.com', '$2y$10$t3WpU1RY0QL.IrInFTQOXeG7nSXUzq3Cr5BKmj4fAfnB6r/Ei1mvy', '28444a31a9f9963139d936117f9db04d03963b7fd608a77b1c7923c468477475e014c97a1a09c00499fc0e40ae202310b3a48361329ad251c48f8816.jpg', 'ff83ea67998dc26e165e658481056270783dcafb752bbb00759aa3f865124d72030b2b6c1276f87daf03635fa3495ac27e86', '', NULL),
(22, 'FRANCINALDO', 'E S Souza', 'sanfisher@msn.com', '$2y$10$kxBBFwMwymfsOUOESPhmWucELp9ESigvuu.hlQ6Ih/c2N4xs4r8Wa', NULL, 'f580a3fa1150c68fb23d337671fb6f19f207aa1f1935bccb27a2df4a1ae2352e447814f6a74f1c8196b5d7eab1ddf7025324', NULL, NULL),
(23, 'Bruna', 'Eduarda ', 'bruninhaebianca@hotmail.com', '$2y$10$4gppwuyL4QKeC9Jx4mhrzO9iv3WTfyQHKEho4CjSiJ3vfEu/iY/Su', NULL, 'c8f347b145588ae8468ed0f08c1f0bdb949e95fb45efefe7e3091ca764fcbbe58a68adb10090ab91480fb2bb6bacc20a0b47', NULL, NULL),
(24, 'Testanildo', 'Gomes', 'teste@teste.com.br', '$2y$10$JJJksxgYE94d0eLWgIvfc.wy3UePzKdHNYIRnvrmQm5V8VwuGdwzq', NULL, '3f88dbaf1dfcdec3ab586a3111617b2d33ee746022c2bd5bfc4726b1b60ad2f25749b0fe0730e002cb328e819dae473f32bf', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices para tabela `finance_categorys`
--
ALTER TABLE `finance_categorys`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Índices para tabela `popup`
--
ALTER TABLE `popup`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `popup_users`
--
ALTER TABLE `popup_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices para tabela `tb_finances`
--
ALTER TABLE `tb_finances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `finance_categorys`
--
ALTER TABLE `finance_categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `popup`
--
ALTER TABLE `popup`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `popup_users`
--
ALTER TABLE `popup_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_finances`
--
ALTER TABLE `tb_finances`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `popup_users`
--
ALTER TABLE `popup_users`
  ADD CONSTRAINT `popup_users_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
