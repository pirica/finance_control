-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 21-Abr-2023 às 17:34
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0


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

-
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



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
