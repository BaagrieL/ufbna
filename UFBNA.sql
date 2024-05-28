-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 28/05/2024 às 09:28
-- Versão do servidor: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- Versão do PHP: 8.1.2-1ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `UFBNA`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Artigo`
--

CREATE TABLE `Artigo` (
  `ArtigoID` int(11) NOT NULL,
  `TituloArtigo` varchar(255) NOT NULL,
  `ResumoArtigo` text DEFAULT NULL,
  `TextoArtigo` text DEFAULT NULL,
  `DataRecepcao` date NOT NULL,
  `AreaConhecimento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Artigo`
--

INSERT INTO `Artigo` (`ArtigoID`, `TituloArtigo`, `ResumoArtigo`, `TextoArtigo`, `DataRecepcao`, `AreaConhecimento`) VALUES
(1, 'Avanços em Inteligência Artificial', 'Resumo sobre IA', 'Texto completo sobre IA', '2024-05-01', 'Computação'),
(2, 'Impacto das Mudanças Climáticas', 'Resumo sobre clima', 'Texto completo sobre clima', '2024-05-02', 'Meio Ambiente'),
(3, 'Arte Contemporânea', 'Resumo sobre arte', 'Texto completo sobre arte', '2024-05-03', 'Artes Visuais'),
(4, 'Educação Inclusiva', 'Resumo sobre educação', 'Texto completo sobre educação', '2024-05-04', 'Educação'),
(5, 'Saúde Mental na Pandemia', 'Resumo sobre saúde', 'Texto completo sobre saúde', '2024-05-05', 'Saúde'),
(56, 'Revolução da Nanotecnologia', 'Resumo sobre Nanotecnologia', 'Texto sobre Nanotecnologia', '2024-04-15', 'Engenharia'),
(57, 'Descobertas em Astrofísica', 'Resumo sobre Astrofísica', 'Texto sobre Astrofísica', '2024-03-20', 'Física'),
(58, 'Inovações em Biotecnologia', 'Resumo sobre Biotecnologia', 'Texto sobre Biotecnologia', '2024-05-05', 'Biologia'),
(59, 'Energia Renovável', 'Resumo sobre Energia Renovável', 'Texto sobre Energia Renovável', '2024-04-22', 'Engenharia Ambiental'),
(60, 'Terapias Genéticas', 'Resumo sobre Terapias Genéticas', 'Texto sobre Terapias Genéticas', '2024-03-30', 'Medicina'),
(61, 'Redes Neurais', 'Resumo sobre Redes Neurais', 'Texto sobre Redes Neurais', '2024-04-10', 'Computação'),
(62, 'Algoritmos Quânticos', 'Resumo sobre Algoritmos Quânticos', 'Texto sobre Algoritmos Quânticos', '2024-04-25', 'Física Quântica'),
(63, 'Mudanças Climáticas', 'Resumo sobre Mudanças Climáticas', 'Texto sobre Mudanças Climáticas', '2024-05-12', 'Ciências Ambientais'),
(64, 'Avanços na Robótica', 'Resumo sobre Robótica', 'Texto sobre Robótica', '2024-05-15', 'Engenharia de Controle'),
(65, 'Materiais Sustentáveis', 'Resumo sobre Materiais Sustentáveis', 'Texto sobre Materiais Sustentáveis', '2024-04-05', 'Ciência dos Materiais');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Artigo_Autor`
--

CREATE TABLE `Artigo_Autor` (
  `ArtigoID` int(11) DEFAULT NULL,
  `AutorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Artigo_Evento`
--

CREATE TABLE `Artigo_Evento` (
  `ArtigoID` int(11) DEFAULT NULL,
  `EventoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Autor`
--

CREATE TABLE `Autor` (
  `AutorID` int(11) NOT NULL,
  `NomeAutor` varchar(255) NOT NULL,
  `EmailAutor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Autor`
--

INSERT INTO `Autor` (`AutorID`, `NomeAutor`, `EmailAutor`) VALUES
(206, 'João Silva', 'joao.silva@example.com'),
(207, 'João Silva', 'joao.silva@example.com'),
(208, 'Maria Oliveira', 'maria.oliveira@example.com'),
(209, 'Maria Oliveira', 'maria.oliveira@example.com'),
(211, 'Carlos Pereira', 'carlos.pereira@example.com'),
(212, 'Ana Santos', 'ana.santos@example.com'),
(214, 'Pedro Costa', 'pedro.costa@example.com'),
(215, 'Pedro Costa', 'pedro.costa@example.com'),
(216, 'Lucia Almeida', 'lucia.almeida@example.com'),
(217, 'Lucia Almeida', 'lucia.almeida@example.com'),
(218, 'Marcos Souza', 'marcos.souza@example.com'),
(219, 'Marcos Souza', 'marcos.souza@example.com'),
(220, 'Fernanda Lima', 'fernanda.lima@example.com'),
(221, 'Fernanda Lima', 'fernanda.lima@example.com'),
(224, 'Juliana Rodrigues', 'juliana.rodrigues@example.com'),
(225, 'Juliana Rodrigues', 'juliana.rodrigues@example.com'),
(226, 'João Silva', 'joao.silva@example.com'),
(227, 'João Silva', 'joao.silva@example.com'),
(228, 'Maria Oliveira', 'maria.oliveira@example.com'),
(229, 'Maria Oliveira', 'maria.oliveira@example.com'),
(230, 'Carlos Pereira', 'carlos.pereira@example.com'),
(231, 'Carlos Pereira', 'carlos.pereira@example.com'),
(232, 'Ana Santos', 'ana.santos@example.com'),
(233, 'Ana Santos', 'ana.santos@example.com'),
(235, 'Pedro Costa', 'pedro.costa@example.com'),
(236, 'Lucia Almeida', 'lucia.almeida@example.com'),
(237, 'Lucia Almeida', 'lucia.almeida@example.com'),
(238, 'Marcos Souza', 'marcos.souza@example.com'),
(239, 'Marcos Souza', 'marcos.souza@example.com'),
(240, 'Fernanda Lima', 'fernanda.lima@example.com'),
(241, 'Fernanda Lima', 'fernanda.lima@example.com'),
(244, 'Juliana Rodrigues', 'juliana.rodrigues@example.com'),
(245, 'Juliana Rodrigues', 'juliana.rodrigues@example.com'),
(246, 'João Silva', 'joao.silva@example.com'),
(247, 'João Silva', 'joao.silva@example.com'),
(248, 'Maria Oliveira', 'maria.oliveira@example.com'),
(249, 'Maria Oliveira', 'maria.oliveira@example.com'),
(250, 'Carlos Pereira', 'carlos.pereira@example.com'),
(251, 'Carlos Pereira', 'carlos.pereira@example.com'),
(252, 'Ana Santos', 'ana.santos@example.com'),
(253, 'Ana Santos', 'ana.santos@example.com'),
(256, 'Lucia Almeida', 'lucia.almeida@example.com'),
(257, 'Lucia Almeida', 'lucia.almeida@example.com'),
(258, 'Marcos Souza', 'marcos.souza@example.com'),
(259, 'Marcos Souza', 'marcos.souza@example.com'),
(260, 'Fernanda Lima', 'fernanda.lima@example.com'),
(261, 'Fernanda Lima', 'fernanda.lima@example.com'),
(264, 'Juliana Rodrigues', 'juliana.rodrigues@example.com'),
(265, 'Juliana Rodrigues', 'juliana.rodrigues@example.com'),
(266, 'João Silva', 'joao.silva@example.com'),
(267, 'João Silva', 'joao.silva@example.com'),
(268, 'Maria Oliveira', 'maria.oliveira@example.com'),
(269, 'Maria Oliveira', 'maria.oliveira@example.com'),
(270, 'Carlos Pereira', 'carlos.pereira@example.com'),
(271, 'Carlos Pereira', 'carlos.pereira@example.com'),
(273, 'Ana Santos', 'ana.santos@example.com'),
(274, 'Pedro Costa', 'pedro.costa@example.com'),
(275, 'Pedro Costa', 'pedro.costa@example.com'),
(276, 'Lucia Almeida', 'lucia.almeida@example.com'),
(277, 'Lucia Almeida', 'lucia.almeida@example.com'),
(278, 'Marcos Souza', 'marcos.souza@example.com'),
(279, 'Marcos Souza', 'marcos.souza@example.com'),
(280, 'Fernanda Lima', 'fernanda.lima@example.com'),
(281, 'Fernanda Lima', 'fernanda.lima@example.com'),
(284, 'Juliana Rodrigues', 'juliana.rodrigues@example.com'),
(285, 'Juliana Rodrigues', 'juliana.rodrigues@example.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Campus`
--

CREATE TABLE `Campus` (
  `CampusID` int(11) NOT NULL,
  `NomeCampus` varchar(255) NOT NULL,
  `EnderecoCampus` varchar(255) NOT NULL,
  `TelefoneCampus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Campus`
--

INSERT INTO `Campus` (`CampusID`, `NomeCampus`, `EnderecoCampus`, `TelefoneCampus`) VALUES
(1, 'Campus A', 'Rua Principal, 123', '(11) 555-1234'),
(2, 'Campus B', 'Avenida Secundária, 456', '(22) 9876-5432'),
(3, 'Campus C', 'Praça Central, 789', '(33) 2468-1357'),
(4, 'Campus D', 'Alameda Lateral, 987', '(44) 1111-2222'),
(5, 'Campus E', 'Estrada Remota, 321', '(55) 9876-5432');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Comissao`
--

CREATE TABLE `Comissao` (
  `ComissaoID` int(11) NOT NULL,
  `EventoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Comissao`
--

INSERT INTO `Comissao` (`ComissaoID`, `EventoID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Evento`
--

CREATE TABLE `Evento` (
  `EventoID` int(11) NOT NULL,
  `NomeEvento` varchar(255) NOT NULL,
  `DataInicio` date NOT NULL,
  `DataTermino` date NOT NULL,
  `TemaEvento` varchar(255) DEFAULT NULL,
  `CampusID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Evento`
--

INSERT INTO `Evento` (`EventoID`, `NomeEvento`, `DataInicio`, `DataTermino`, `TemaEvento`, `CampusID`) VALUES
(1, 'Simpósio de Ciência', '2024-06-15', '2024-06-17', 'Avanços na Pesquisa', 1),
(2, 'Congresso de Tecnologia', '2024-08-20', '2024-08-22', 'Inovações Tecnológicas', 2),
(3, 'Encontro de Saúde', '2024-09-10', '2024-09-12', 'Bem-Estar e Prevenção', 3),
(4, 'Workshop de Arte', '2024-10-05', '2024-10-07', 'Expressão Criativa', 4),
(5, 'Conferência de Educação', '2024-11-15', '2024-11-17', 'Transformação Educacional', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Professor`
--

CREATE TABLE `Professor` (
  `ProfessorID` int(11) NOT NULL,
  `NomeProfessor` varchar(255) NOT NULL,
  `EmailProfessor` varchar(255) NOT NULL,
  `Titulacao` varchar(50) DEFAULT NULL,
  `Disciplinas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Professor`
--

INSERT INTO `Professor` (`ProfessorID`, `NomeProfessor`, `EmailProfessor`, `Titulacao`, `Disciplinas`) VALUES
(1, 'Prof. Silva', 'silva@email.com', 'Doutor', 'Matemática, Física'),
(2, 'Prof. Santos', 'santos@email.com', 'Mestre', 'Informática, Programação'),
(3, 'Prof. Lima', 'lima@email.com', 'Especialista', 'Biologia, Ecologia'),
(4, 'Prof. Costa', 'costa@email.com', 'Doutor', 'História, Sociologia'),
(5, 'Prof. Almeida', 'almeida@email.com', 'Mestre', 'Literatura, Redação'),
(8, 'Mana', 'professor@gmail.com', NULL, NULL),
(9, 'Mana', 'professor@gmail.com', NULL, NULL),
(10, 'Mana', 'professor@gmail.com', NULL, NULL),
(11, 'Nome', 'professor@gmail.com', NULL, NULL),
(12, 'Nome', 'professor@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Professor_Comissao`
--

CREATE TABLE `Professor_Comissao` (
  `ProfessorID` int(11) DEFAULT NULL,
  `ComissaoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `Artigo`
--
ALTER TABLE `Artigo`
  ADD PRIMARY KEY (`ArtigoID`);

--
-- Índices de tabela `Artigo_Autor`
--
ALTER TABLE `Artigo_Autor`
  ADD KEY `ArtigoID` (`ArtigoID`),
  ADD KEY `AutorID` (`AutorID`);

--
-- Índices de tabela `Artigo_Evento`
--
ALTER TABLE `Artigo_Evento`
  ADD KEY `ArtigoID` (`ArtigoID`),
  ADD KEY `EventoID` (`EventoID`);

--
-- Índices de tabela `Autor`
--
ALTER TABLE `Autor`
  ADD PRIMARY KEY (`AutorID`);

--
-- Índices de tabela `Campus`
--
ALTER TABLE `Campus`
  ADD PRIMARY KEY (`CampusID`);

--
-- Índices de tabela `Comissao`
--
ALTER TABLE `Comissao`
  ADD PRIMARY KEY (`ComissaoID`),
  ADD KEY `EventoID` (`EventoID`);

--
-- Índices de tabela `Evento`
--
ALTER TABLE `Evento`
  ADD PRIMARY KEY (`EventoID`),
  ADD KEY `CampusID` (`CampusID`);

--
-- Índices de tabela `Professor`
--
ALTER TABLE `Professor`
  ADD PRIMARY KEY (`ProfessorID`);

--
-- Índices de tabela `Professor_Comissao`
--
ALTER TABLE `Professor_Comissao`
  ADD KEY `ProfessorID` (`ProfessorID`),
  ADD KEY `ComissaoID` (`ComissaoID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Artigo`
--
ALTER TABLE `Artigo`
  MODIFY `ArtigoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de tabela `Autor`
--
ALTER TABLE `Autor`
  MODIFY `AutorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT de tabela `Professor`
--
ALTER TABLE `Professor`
  MODIFY `ProfessorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `Artigo_Autor`
--
ALTER TABLE `Artigo_Autor`
  ADD CONSTRAINT `Artigo_Autor_ibfk_1` FOREIGN KEY (`ArtigoID`) REFERENCES `Artigo` (`ArtigoID`),
  ADD CONSTRAINT `Artigo_Autor_ibfk_2` FOREIGN KEY (`AutorID`) REFERENCES `Autor` (`AutorID`);

--
-- Restrições para tabelas `Artigo_Evento`
--
ALTER TABLE `Artigo_Evento`
  ADD CONSTRAINT `Artigo_Evento_ibfk_1` FOREIGN KEY (`ArtigoID`) REFERENCES `Artigo` (`ArtigoID`),
  ADD CONSTRAINT `Artigo_Evento_ibfk_2` FOREIGN KEY (`EventoID`) REFERENCES `Evento` (`EventoID`);

--
-- Restrições para tabelas `Comissao`
--
ALTER TABLE `Comissao`
  ADD CONSTRAINT `Comissao_ibfk_1` FOREIGN KEY (`EventoID`) REFERENCES `Evento` (`EventoID`);

--
-- Restrições para tabelas `Evento`
--
ALTER TABLE `Evento`
  ADD CONSTRAINT `Evento_ibfk_1` FOREIGN KEY (`CampusID`) REFERENCES `Campus` (`CampusID`);

--
-- Restrições para tabelas `Professor_Comissao`
--
ALTER TABLE `Professor_Comissao`
  ADD CONSTRAINT `Professor_Comissao_ibfk_1` FOREIGN KEY (`ProfessorID`) REFERENCES `Professor` (`ProfessorID`),
  ADD CONSTRAINT `Professor_Comissao_ibfk_2` FOREIGN KEY (`ComissaoID`) REFERENCES `Comissao` (`ComissaoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
