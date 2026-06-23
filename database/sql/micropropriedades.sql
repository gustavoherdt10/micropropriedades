-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/06/2026 às 18:51
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `micropropriedades`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'Produto unitário', '2026-06-23 16:07:34', '2026-06-23 16:07:34'),
(2, 'Produto em caixa', '2026-06-23 16:07:34', '2026-06-23 16:07:34'),
(3, 'Produto por kg', '2026-06-23 16:07:34', '2026-06-23 16:07:34'),
(4, 'Produto colonial', '2026-06-23 16:07:34', '2026-06-23 16:07:34'),
(5, 'Artesanato', '2026-06-23 16:07:34', '2026-06-23 16:07:34'),
(6, 'Kit / cesta', '2026-06-23 16:07:34', '2026-06-23 16:07:34'),
(7, 'Serviço de passeio', '2026-06-23 16:07:34', '2026-06-23 16:07:34'),
(8, 'Serviço de hospedagem', '2026-06-23 16:07:34', '2026-06-23 16:07:34'),
(9, 'Serviço de alimentação', '2026-06-23 16:07:34', '2026-06-23 16:07:34'),
(10, 'Experiência rural', '2026-06-23 16:07:34', '2026-06-23 16:07:34'),
(11, 'Outro', '2026-06-23 16:07:34', '2026-06-23 16:07:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
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
-- Estrutura para tabela `jobs`
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
-- Estrutura para tabela `job_batches`
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
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_22_124405_create_categorias_table', 1),
(5, '2026_06_22_124405_create_propriedades_table', 1),
(6, '2026_06_22_124406_create_produto_servicos_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos_servicos`
--

CREATE TABLE `produtos_servicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `propriedade_id` bigint(20) UNSIGNED NOT NULL,
  `categoria_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo` enum('produto','servico') NOT NULL DEFAULT 'produto',
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco_estimado` decimal(10,2) DEFAULT NULL,
  `unidade` varchar(50) DEFAULT NULL,
  `disponibilidade` varchar(120) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos_servicos`
--

INSERT INTO `produtos_servicos` (`id`, `propriedade_id`, `categoria_id`, `tipo`, `nome`, `descricao`, `preco_estimado`, `unidade`, `disponibilidade`, `imagem`, `ativo`, `created_at`, `updated_at`) VALUES
(4, 6, 2, 'produto', 'Caixa de Pêssegos', 'Caixa de Pêssegos Frescos!', 60.00, 'kg', 'Por safra', 'produtos/1c0EpMrWeZ8h5jItWxAJpTPMt8N0wkbUww0F1Q5t.jpg', 1, '2026-06-23 15:13:38', '2026-06-23 16:32:11'),
(5, 6, 4, 'produto', 'Compota de Pêssego Esmeralda', 'A Chácara Esmeralda tem o prazer de anunciar o lançamento das nossas compotas, feitas com frutas selecionadas e muito carinho! Cada potinho é preparado com cuidado, seguindo uma receita tradicional de família, garantindo assim um sabor irresistível e único.', 12.00, 'unidade', 'diaria', 'produtos/UcfVsKzLyfC8tkxStDSwMBe64PZ4xGFBAjtCyybp.jpg', 1, '2026-06-23 15:14:46', '2026-06-23 16:32:40'),
(6, 6, 10, 'servico', 'Passeio de Trator', 'Venha conhecer nossa chácara!', 25.00, 'visita', 'sob agendamento', 'produtos/UZ5sPpjNQxTwiHuziu3b1JeOAYg733LOjLl1q31g.jpg', 1, '2026-06-23 15:16:38', '2026-06-23 16:34:46'),
(8, 7, 4, 'produto', 'Queijo Azul Perimbo', 'Benefícios e CaracterísticasNutrição: Rico em proteínas, cálcio e vitaminas A, B e E.Digestão: Possui ácidos graxos de cadeia curta que facilitam a digestão.Intolerância: Frequentemente melhor tolerado por quem tem sensibilidade ao leite de vaca.Sabor: Perfil que varia do suave e adocicado ao picante e robusto.', 50.00, 'kg', 'semanal', 'produtos/yhrmIkKtz85p225jNPeCgOjzQ5xXTEXf3dQ8QexQ.jpg', 1, '2026-06-23 16:18:45', '2026-06-23 16:18:45'),
(9, 8, 2, 'produto', 'Cerveja Longneck', 'Cervejas Longenck Caixa 12 unidades', 60.00, 'unidade / cx 12unid', 'semanal', 'produtos/DAWNA2ZQIDrtuQe8tfKPg5p16rYkIISrKdkaiQ4b.jpg', 1, '2026-06-23 19:30:45', '2026-06-23 19:31:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `propriedades`
--

CREATE TABLE `propriedades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(150) NOT NULL,
  `responsavel` varchar(150) NOT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `whatsapp` varchar(30) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `cidade` varchar(100) NOT NULL DEFAULT 'Ituporanga',
  `bairro` varchar(120) DEFAULT NULL,
  `endereco` varchar(180) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `propriedades`
--

INSERT INTO `propriedades` (`id`, `user_id`, `nome`, `responsavel`, `telefone`, `whatsapp`, `email`, `cidade`, `bairro`, `endereco`, `descricao`, `imagem`, `ativo`, `created_at`, `updated_at`) VALUES
(6, 1, 'Chácara Esmeralda', 'Marcos', '(47) 99125-7193', '(47) 99125-7193', 'chacara.esmeralda@hotmail.com', 'Petrolandia', 'Rio Antinhas', 'Rua Antônio Loffi Estrada Geral, Petrolandia', 'Chácara Esmeralda é um agro negócio de frutas e que faz parte de um círculo de Turismo Rural! Venha nos conhecer!', 'propriedades/dTzb790x5umGlDT6cOkdTtF2mHVO15eUr1QxS6UL.jpg', 1, '2026-06-23 15:07:11', '2026-06-23 15:07:11'),
(7, 1, 'Queijos Rouwstik', 'Kaue / Rosangela', '(47) 98857-7070', '(47) 98857-7070', NULL, 'Petrolandia', 'Rio Antinhas', 'Estrada Geral Indaiá', 'O nosso queijo é um produto totalmente artesanal, feito com leite de ovelha da própria propriedade!', 'propriedades/47aNzYWKT3Vxp1uhrwjsV4OyNaB76rra6CeEzawk.jpg', 1, '2026-06-23 15:22:17', '2026-06-23 15:23:47'),
(8, 1, 'Cervejaria Herdt Bier', 'Gustavo', NULL, NULL, 'contato@herdtbier.com.br', 'Ituporanga', NULL, NULL, 'Cervejaria', 'propriedades/Wy0cxMo2UIVdk4KFqIvpOeBYaLj1UwCL3XzQIfJS.jpg', 1, '2026-06-23 19:29:15', '2026-06-23 19:29:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Cervejaria Herdt Bier', 'contato@herdtbier.com.br', NULL, '$2y$12$vYPWFnpZIT5BdTIPqrnIHuOd2ICQJQmjS/OnXA2pStOrkAzLabB0i', 'S5NL6Hoi3Cb4FBPaJk7vebKKIH1yGSe55KUOdcBOw3HbnQ2Zq0JmTiWqemlm', '2026-06-22 16:41:37', '2026-06-22 16:41:37');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Índices de tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices de tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `produtos_servicos`
--
ALTER TABLE `produtos_servicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_servicos_propriedade_id_foreign` (`propriedade_id`),
  ADD KEY `produtos_servicos_categoria_id_foreign` (`categoria_id`);

--
-- Índices de tabela `propriedades`
--
ALTER TABLE `propriedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propriedades_user_id_foreign` (`user_id`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `produtos_servicos`
--
ALTER TABLE `produtos_servicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `propriedades`
--
ALTER TABLE `propriedades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produtos_servicos`
--
ALTER TABLE `produtos_servicos`
  ADD CONSTRAINT `produtos_servicos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `produtos_servicos_propriedade_id_foreign` FOREIGN KEY (`propriedade_id`) REFERENCES `propriedades` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `propriedades`
--
ALTER TABLE `propriedades`
  ADD CONSTRAINT `propriedades_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
