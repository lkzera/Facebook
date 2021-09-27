-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Set-2021 às 04:03
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `facebook`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_amizade`
--

CREATE TABLE `tb_amizade` (
  `id_solicitacao` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `amigo_id` int(11) DEFAULT NULL,
  `dataSolicitacao` datetime DEFAULT NULL,
  `dataAceite` datetime DEFAULT NULL,
  `dataBloqueio` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comentarios`
--

CREATE TABLE `tb_comentarios` (
  `id_comentario` int(11) NOT NULL,
  `usuario_id_env` int(11) DEFAULT NULL,
  `usuario_id_rec` int(11) DEFAULT NULL,
  `dataInclusao` datetime DEFAULT NULL,
  `texto` varchar(500) DEFAULT NULL,
  `postagem_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_imagem`
--

CREATE TABLE `tb_imagem` (
  `id_imagem` int(11) NOT NULL,
  `postagem_id` int(11) DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `imagem` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_postagem`
--

CREATE TABLE `tb_postagem` (
  `id_postagem` int(11) NOT NULL,
  `dataPostagem` datetime DEFAULT NULL,
  `texto` varchar(500) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_reacao`
--

CREATE TABLE `tb_reacao` (
  `id_recao` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `postagem_id` int(11) DEFAULT NULL,
  `dataInclusao` datetime DEFAULT NULL,
  `tipo_reacao_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_reacao`
--

CREATE TABLE `tb_tipo_reacao` (
  `id_tipo_reacao` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `dataInclusao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `login` varchar(200) DEFAULT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `senha` varchar(200) DEFAULT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  `dataAniversario` date DEFAULT NULL,
  `dataInclusao` datetime DEFAULT NULL,
  `imagem_capa_id` int(11) DEFAULT NULL,
  `imagem_perfil_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_amizade`
--
ALTER TABLE `tb_amizade`
  ADD PRIMARY KEY (`id_solicitacao`);

--
-- Índices para tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  ADD PRIMARY KEY (`id_comentario`);

--
-- Índices para tabela `tb_imagem`
--
ALTER TABLE `tb_imagem`
  ADD PRIMARY KEY (`id_imagem`);

--
-- Índices para tabela `tb_postagem`
--
ALTER TABLE `tb_postagem`
  ADD PRIMARY KEY (`id_postagem`);

--
-- Índices para tabela `tb_reacao`
--
ALTER TABLE `tb_reacao`
  ADD PRIMARY KEY (`id_recao`);

--
-- Índices para tabela `tb_tipo_reacao`
--
ALTER TABLE `tb_tipo_reacao`
  ADD PRIMARY KEY (`id_tipo_reacao`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_amizade`
--
ALTER TABLE `tb_amizade`
  MODIFY `id_solicitacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_imagem`
--
ALTER TABLE `tb_imagem`
  MODIFY `id_imagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_postagem`
--
ALTER TABLE `tb_postagem`
  MODIFY `id_postagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tb_reacao`
--
ALTER TABLE `tb_reacao`
  MODIFY `id_recao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_tipo_reacao`
--
ALTER TABLE `tb_tipo_reacao`
  MODIFY `id_tipo_reacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
