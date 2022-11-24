-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Nov-2022 às 02:39
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdetecapi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbadm`
--

CREATE TABLE `tbadm` (
  `idAdm` int(11) NOT NULL,
  `userAdm` varchar(64) NOT NULL,
  `nomeAdm` varchar(250) NOT NULL,
  `senhaAdm` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbadm`
--

INSERT INTO `tbadm` (`idAdm`, `userAdm`, `nomeAdm`, `senhaAdm`) VALUES
(8, 'gabriel01', 'Gabriel Antonio', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbaluno`
--

CREATE TABLE `tbaluno` (
  `idAluno` int(11) NOT NULL,
  `nomeAluno` varchar(90) NOT NULL,
  `rmAluno` varchar(16) NOT NULL,
  `turmaAluno` varchar(30) NOT NULL,
  `periodoAluno` varchar(10) NOT NULL,
  `userAluno` varchar(32) NOT NULL,
  `senhaAluno` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblab`
--

CREATE TABLE `tblab` (
  `idLab` int(11) NOT NULL,
  `nomeLab` varchar(25) NOT NULL,
  `qntdComputador` int(11) DEFAULT NULL,
  `obsLab` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tblab`
--

INSERT INTO `tblab` (`idLab`, `nomeLab`, `qntdComputador`, `obsLab`) VALUES
(7, 'Laboratório 6', 17, 'Sem observações');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpedido`
--

CREATE TABLE `tbpedido` (
  `idPedido` int(11) NOT NULL,
  `periodo` varchar(15) DEFAULT NULL,
  `curso` varchar(50) NOT NULL,
  `lab` varchar(5) NOT NULL,
  `computador` varchar(50) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `descPedido` text NOT NULL,
  `nomeProf` text DEFAULT NULL,
  `cpfProf` varchar(100) DEFAULT NULL,
  `nomeAluno` text DEFAULT NULL,
  `dataPedido` datetime DEFAULT NULL,
  `horaPedido` time DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `novo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbpedido`
--

INSERT INTO `tbpedido` (`idPedido`, `periodo`, `curso`, `lab`, `computador`, `titulo`, `descPedido`, `nomeProf`, `cpfProf`, `nomeAluno`, `dataPedido`, `horaPedido`, `status`, `novo`) VALUES
(51, 'Manhã', 'DS', 'Lab 1', 'PC 1', 'Roubo', 'PC roubado', NULL, NULL, 'Gabriel', '2022-11-22 00:00:00', '07:33:27', 'Resolvido', 'false'),
(53, 'Manhã', 'DS', 'Lab 6', 'Pc 10', 'Tela riscada', 'O Monitor está com a tela riscada', NULL, NULL, 'Gabriel', '2022-11-22 00:00:00', '09:25:57', 'Resolvido', 'false');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpedmnt`
--

CREATE TABLE `tbpedmnt` (
  `idPedMnt` int(11) NOT NULL,
  `idAluno` int(11) DEFAULT NULL,
  `idProf` int(11) DEFAULT NULL,
  `idLab` int(11) DEFAULT NULL,
  `pcPedMnt` varchar(50) NOT NULL,
  `descPedMnt` varchar(80) NOT NULL,
  `nomePedMnt` varchar(40) NOT NULL,
  `dataPedMnt` datetime NOT NULL,
  `concluido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprof`
--

CREATE TABLE `tbprof` (
  `idProf` int(11) NOT NULL,
  `nomeProf` varchar(90) NOT NULL,
  `cpfProf` varchar(14) NOT NULL,
  `userProf` varchar(32) NOT NULL,
  `senhaProf` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbrespmnt`
--

CREATE TABLE `tbrespmnt` (
  `idRespMnt` int(11) NOT NULL,
  `idPedMnt` int(11) DEFAULT NULL,
  `nomeResp` varchar(40) NOT NULL,
  `obsRespMnt` varchar(120) NOT NULL,
  `pcRespMnt` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbadm`
--
ALTER TABLE `tbadm`
  ADD PRIMARY KEY (`idAdm`);

--
-- Índices para tabela `tbaluno`
--
ALTER TABLE `tbaluno`
  ADD PRIMARY KEY (`idAluno`);

--
-- Índices para tabela `tblab`
--
ALTER TABLE `tblab`
  ADD PRIMARY KEY (`idLab`);

--
-- Índices para tabela `tbpedido`
--
ALTER TABLE `tbpedido`
  ADD PRIMARY KEY (`idPedido`);

--
-- Índices para tabela `tbpedmnt`
--
ALTER TABLE `tbpedmnt`
  ADD PRIMARY KEY (`idPedMnt`),
  ADD KEY `idAluno` (`idAluno`),
  ADD KEY `idProf` (`idProf`),
  ADD KEY `idLab` (`idLab`);

--
-- Índices para tabela `tbprof`
--
ALTER TABLE `tbprof`
  ADD PRIMARY KEY (`idProf`);

--
-- Índices para tabela `tbrespmnt`
--
ALTER TABLE `tbrespmnt`
  ADD PRIMARY KEY (`idRespMnt`),
  ADD KEY `idPedMnt` (`idPedMnt`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbadm`
--
ALTER TABLE `tbadm`
  MODIFY `idAdm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tbaluno`
--
ALTER TABLE `tbaluno`
  MODIFY `idAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tblab`
--
ALTER TABLE `tblab`
  MODIFY `idLab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbpedido`
--
ALTER TABLE `tbpedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `tbpedmnt`
--
ALTER TABLE `tbpedmnt`
  MODIFY `idPedMnt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbprof`
--
ALTER TABLE `tbprof`
  MODIFY `idProf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbrespmnt`
--
ALTER TABLE `tbrespmnt`
  MODIFY `idRespMnt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbpedmnt`
--
ALTER TABLE `tbpedmnt`
  ADD CONSTRAINT `tbpedmnt_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `tbaluno` (`idAluno`),
  ADD CONSTRAINT `tbpedmnt_ibfk_2` FOREIGN KEY (`idProf`) REFERENCES `tbprof` (`idProf`),
  ADD CONSTRAINT `tbpedmnt_ibfk_3` FOREIGN KEY (`idLab`) REFERENCES `tblab` (`idLab`);

--
-- Limitadores para a tabela `tbrespmnt`
--
ALTER TABLE `tbrespmnt`
  ADD CONSTRAINT `tbrespmnt_ibfk_1` FOREIGN KEY (`idPedMnt`) REFERENCES `tbpedmnt` (`idPedMnt`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
