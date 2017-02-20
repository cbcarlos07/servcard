-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 19-Fev-2017 às 21:49
-- Versão do servidor: 10.0.29-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.13-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servcard`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_BAIRRO` (IN `CODIGO` INT, IN `TEXTO` VARCHAR(75), IN `CIDADE` INT, IN `ZONA` INT, IN `ACAO` CHAR(1))  BEGIN
DECLARE TEXTO_ VARCHAR(75);
SET TEXTO_ = CONCAT('%',TEXTO,'%');
CASE
   WHEN ACAO = 'I'      THEN INSERT INTO `bairro` VALUES (NULL, TEXTO, CIDADE, ZONA);
   WHEN ACAO = 'A'       THEN  UPDATE `bairro` SET `NM_BAIRRO` = TEXTO, `CD_CIDADE` = CIDADE, `CD_ZONA` = ZONA WHERE `CD_BAIRRO` = CODIGO;
   WHEN ACAO = 'E'       THEN  DELETE FROM `bairro` WHERE `CD_BAIRRO` = CODIGO;
   WHEN ACAO = 'N'       THEN SELECT * FROM `V_BAIRRO` `B` 
           WHERE `B`.`NM_BAIRRO` LIKE TEXTO_;
   WHEN ACAO = 'D'       THEN SELECT * FROM `V_BAIRRO` `B` 
           WHERE `B`.`CD_CIDADE` = CIDADE
           AND `B`.`NM_BAIRRO` = TEXTO_
           ORDER BY `B`.`NM_BAIRRO` ASC;
   WHEN ACAO = 'Z'       THEN SELECT * FROM `V_BAIRRO` `B` 
           WHERE `B`.`CD_ZONA` = ZONA
           AND `B`.`NM_BAIRRO` = TEXTO_
           ORDER BY `B`.`NM_BAIRRO` ASC;        
   WHEN ACAO = 'C'       THEN SELECT * FROM `V_BAIRRO` `B` WHERE `B`.`CD_BAIRRO` = CODIGO;
   WHEN ACAO = 'T'       THEN SELECT * FROM `V_BAIRRO` `B` ORDER BY `B`.`NM_BAIRRO` ASC;

END CASE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_CARGO` (IN `CODIGO` INT, IN `TEXTO` VARCHAR(75), IN `TEXTO2` VARCHAR(255), IN `ACAO` CHAR(1))  BEGIN
DECLARE TEXTO_ VARCHAR(75);
SET TEXTO_ = CONCAT('%',TEXTO,'%');
CASE
   WHEN ACAO = 'I'       THEN INSERT INTO `cargo` VALUES (NULL, TEXTO, TEXTO2);
   WHEN ACAO = 'A'       THEN UPDATE `cargo` SET `DS_CARGO` = TEXTO, `OBS_CARGO` = TEXTO2 WHERE `CD_CARGO` = CODIGO;
   WHEN ACAO = 'E'       THEN DELETE FROM `cargo` WHERE `CD_CARGO` = CODIGO;
   WHEN ACAO = 'N'       THEN SELECT * FROM `cargo` WHERE `DS_CARGO` LIKE TEXTO_ ORDER BY `NM_CARGO` ASC;
   WHEN ACAO = 'C'       THEN SELECT * FROM `cargo` WHERE `CD_CARGO` = CODIGO;
   WHEN ACAO = 'T'       THEN SELECT * FROM `cargo` ORDER BY `NM_CARGO` ASC;

END CASE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_CARTEIRA` (`CODIGO` INT, `CLIENTE` VARCHAR(75), `PLANO` VARCHAR(255), `VALIDADE` DATE, `ATIVO` CHAR(1), `TITULAR` VARCHAR(1), `CARTEIRA` VARCHAR(20), `ACAO` CHAR(1))  BEGIN
DECLARE TEXTO_ VARCHAR(75);
SET TEXTO_ = CONCAT('%',TEXTO,'%');
CASE
   WHEN ACAO = 'I'       THEN INSERT INTO `carteira` VALUES (NULL, CLIENTE, PLANO, VALIDADE, ATIVO, TITULAR);
   WHEN ACAO = 'A'       THEN UPDATE `carteira` SET 
                                     `CD_CLIENTE` = CLIENTE, `CD_PLANO`  = PLANO, 
                                     `DT_VALIDADE` = VALIDADE, `SN_ATIVO` = ATIVO,
                                     `SN_TITULAR` = TITULAR, `DS_NR_CARTEIRA` = CARTEIRA
                                     WHERE `CD_CARTEIRA` = CODIGO;
   WHEN ACAO = 'E'       THEN DELETE FROM `carteira` WHERE `CD_CARTEIRA` = CODIGO;
   WHEN ACAO = 'N'       THEN SELECT * FROM `V_CARTEIRA` WHERE `NM_CLIENTE` LIKE TEXTO_ ORDER BY `DT_VALIDADE` DESC;
   WHEN ACAO = 'C'       THEN SELECT * FROM `V_CARTEIRA` WHERE `CD_CARTEIRA` = CODIGO;
   WHEN ACAO = 'T'       THEN SELECT * FROM `V_CARTEIRA` ORDER BY `DT_VALIDADE` DESC;

END CASE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_PAIS` (`CODIGO` INT, `TEXTO` VARCHAR(75), `ACAO` CHAR(1))  BEGIN
DECLARE TEXTO_ VARCHAR(75);
SET TEXTO_ = CONCAT('%',TEXTO,'%');
CASE
   WHEN ACAO = 'I'      THEN INSERT INTO `pais` VALUES (NULL, TEXTO);
   WHEN ACAO = 'A'       THEN  UPDATE `pais` SET `DS_PAIS` = TEXTO WHERE `CD_PAIS` = CODIGO;
   WHEN ACAO = 'E'       THEN  DELETE FROM `pais` WHERE `CD_PAIS` = CODIGO;
   WHEN ACAO = 'N'       THEN SELECT * FROM `pais` WHERE `DS_PAIS` LIKE TEXTO_;
   WHEN ACAO = 'C'       THEN SELECT * FROM `pais` WHERE `CD_PAIS` = CODIGO;
   WHEN ACAO = 'T'       THEN SELECT * FROM `pais` ORDER BY `DS_PAIS` DESC;

END CASE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE `bairro` (
  `CD_BAIRRO` int(11) NOT NULL,
  `NM_BAIRRO` varchar(90) DEFAULT NULL,
  `CD_CIDADE` int(11) NOT NULL,
  `CD_ZONA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargo`
--

CREATE TABLE `cargo` (
  `CD_CARGO` int(11) NOT NULL,
  `DS_CARGO` varchar(90) DEFAULT NULL,
  `OBS_CARGO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carteira`
--

CREATE TABLE `carteira` (
  `CD_CARTEIRA` int(11) NOT NULL,
  `DT_VALIDADE` varchar(45) DEFAULT NULL,
  `SN_ATIVO` varchar(1) DEFAULT NULL,
  `TP_TITULAR` varchar(1) DEFAULT NULL COMMENT 'D -  DEPENDENTE\nT - TITULAR',
  `CD_CLIENTE` int(11) NOT NULL,
  `CD_PLANO` int(11) NOT NULL,
  `DS_NR_CARTEIRA` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `CD_CIDADE` int(11) NOT NULL,
  `NM_CIDADE` varchar(45) DEFAULT NULL,
  `CD_ESTADO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `CD_CLIENTE` int(11) NOT NULL,
  `NM_CLIENTE` varchar(102) NOT NULL,
  `NR_CPF` varchar(11) NOT NULL,
  `NR_RG` varchar(8) DEFAULT NULL,
  `NR_TELEFONE` varchar(11) DEFAULT NULL,
  `DS_EMAIL` varchar(45) DEFAULT NULL,
  `DT_NASCIMENTO` date DEFAULT NULL,
  `TP_SEXO` varchar(1) DEFAULT NULL,
  `CD_ESTADO_CIVIL` int(11) NOT NULL,
  `NR_CEP` varchar(8) NOT NULL,
  `DS_SENHA` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato`
--

CREATE TABLE `contrato` (
  `CD_CONTRATO` int(11) NOT NULL,
  `DH_CONTRATO` datetime DEFAULT NULL,
  `SN_QUITE` varchar(1) DEFAULT NULL,
  `NR_VALOR` decimal(10,2) DEFAULT NULL,
  `NR_PARCELA` int(11) DEFAULT NULL,
  `CD_CLIENTE` int(11) NOT NULL,
  `CD_USUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato_mensal`
--

CREATE TABLE `contrato_mensal` (
  `CD_CONTRATO` int(11) NOT NULL,
  `DT_VENCIMENTO` date DEFAULT NULL,
  `NR_VALOR` decimal(4,2) DEFAULT NULL,
  `NR_PARCELA` int(11) DEFAULT NULL,
  `TP_STATUS` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `DS_LOGRADOURO` varchar(120) DEFAULT NULL,
  `TP_LOGRADOURO` varchar(45) DEFAULT NULL,
  `NR_CEP` varchar(8) NOT NULL,
  `CD_BAIRRO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `CD_ESTADO` int(11) NOT NULL,
  `NM_ESTADO` varchar(45) DEFAULT NULL,
  `DS_UF` varchar(45) DEFAULT NULL,
  `CD_PAIS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado_civil`
--

CREATE TABLE `estado_civil` (
  `CD_ESTADO_CIVIL` int(11) NOT NULL,
  `DS_ESTADO_CIVIL` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `CD_PAGAMENTO` int(11) NOT NULL,
  `DT_PAGAMENTO` datetime DEFAULT NULL,
  `HR_PAGAMENTO` time DEFAULT NULL,
  `VL_PAGAMENTO` decimal(10,2) DEFAULT NULL,
  `DT_VENCIMENTO` date DEFAULT NULL,
  `CD_CONTRATO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `CD_PAIS` int(11) NOT NULL,
  `DS_PAIS` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`CD_PAIS`, `DS_PAIS`) VALUES
(1, 'Brasil');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parceiro`
--

CREATE TABLE `parceiro` (
  `CD_PARCEIRO` int(11) NOT NULL,
  `NM_PARCEIRO` varchar(70) DEFAULT NULL,
  `DS_RESPONSAVEL` varchar(90) DEFAULT NULL,
  `NR_CPF_RESPONSAVEL` varchar(11) DEFAULT NULL,
  `NR_CNPJ` varchar(45) DEFAULT NULL,
  `NR_CEP` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano`
--

CREATE TABLE `plano` (
  `CD_PLANO` int(11) NOT NULL,
  `DS_PLANO` varchar(45) DEFAULT NULL,
  `OBS_PLANO` varchar(45) DEFAULT NULL,
  `NR_VALOR` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `CD_USUARIO` int(11) NOT NULL,
  `NM_USUARIO` varchar(90) DEFAULT NULL,
  `DS_LOGIN` varchar(45) DEFAULT NULL,
  `DS_SENHA` varchar(45) DEFAULT NULL,
  `SN_ATIVO` int(11) DEFAULT NULL,
  `CD_CARGO` int(11) NOT NULL,
  `NR_CPF` varchar(11) DEFAULT NULL,
  `NR_RG` varchar(8) DEFAULT NULL,
  `DS_FOTO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `V_BAIRRO`
--
CREATE TABLE `V_BAIRRO` (
`CD_BAIRRO` int(11)
,`NM_BAIRRO` varchar(90)
,`CD_CIDADE` int(11)
,`NM_CIDADE` varchar(45)
,`CD_ZONA` int(11)
,`DS_ZONA` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `V_PLANO`
--
CREATE TABLE `V_PLANO` (
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `zona`
--

CREATE TABLE `zona` (
  `CD_ZONA` int(11) NOT NULL,
  `DS_ZONA` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `V_BAIRRO`
--
DROP TABLE IF EXISTS `V_BAIRRO`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `V_BAIRRO`  AS  select `B`.`CD_BAIRRO` AS `CD_BAIRRO`,`B`.`NM_BAIRRO` AS `NM_BAIRRO`,`B`.`CD_CIDADE` AS `CD_CIDADE`,`C`.`NM_CIDADE` AS `NM_CIDADE`,`B`.`CD_ZONA` AS `CD_ZONA`,`Z`.`DS_ZONA` AS `DS_ZONA` from ((`bairro` `B` join `cidade` `C` on((`C`.`CD_CIDADE` = `B`.`CD_CIDADE`))) join `zona` `Z` on((`Z`.`CD_ZONA` = `B`.`CD_ZONA`))) ;

-- --------------------------------------------------------

--
-- Structure for view `V_PLANO`
--
DROP TABLE IF EXISTS `V_PLANO`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `V_PLANO`  AS  select `R`.`CD_CARTEIRA` AS `CD_CARTEIRA`,`R`.`DT_VALIDADE` AS `DT_VALIDADE`,`R`.`SN_ATIVO` AS `SN_ATIVO`,`R`.`TP_TITULAR` AS `TP_TITULAR`,`R`.`CD_CLIENTE` AS `CD_CLIENTE`,`R`.`CD_PLANO` AS `CD_PLANO`,`C`.`NM_CLIENTE` AS `NM_CLIENTE`,`P`.`DS_PANO` AS `DS_PANO` from ((`carteira` `R` join `cliente` `C` on((`C`.`CD_CLIENTE` = `R`.`CD_CLIENTE`))) join `plano` `P` on((`P`.`CD_PLANO` = `R`.`CD_PLANO`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`CD_BAIRRO`),
  ADD KEY `fk_bairro_cidade1_idx` (`CD_CIDADE`),
  ADD KEY `fk_bairro_zona1_idx` (`CD_ZONA`);

--
-- Indexes for table `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`CD_CARGO`);

--
-- Indexes for table `carteira`
--
ALTER TABLE `carteira`
  ADD PRIMARY KEY (`CD_CARTEIRA`),
  ADD KEY `fk_carteira_cliente1_idx` (`CD_CLIENTE`),
  ADD KEY `fk_carteira_plano1_idx` (`CD_PLANO`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`CD_CIDADE`),
  ADD KEY `fk_cidade_estado1_idx` (`CD_ESTADO`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CD_CLIENTE`),
  ADD KEY `fk_cliente_estado_civil1_idx` (`CD_ESTADO_CIVIL`),
  ADD KEY `fk_cliente_endereco1_idx` (`NR_CEP`);

--
-- Indexes for table `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`CD_CONTRATO`),
  ADD KEY `fk_contrato_cliente1_idx` (`CD_CLIENTE`),
  ADD KEY `fk_contrato_usuario1_idx` (`CD_USUARIO`);

--
-- Indexes for table `contrato_mensal`
--
ALTER TABLE `contrato_mensal`
  ADD KEY `fk_contrato_mensal_contrato1_idx` (`CD_CONTRATO`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`NR_CEP`),
  ADD KEY `fk_endereco_bairro1_idx` (`CD_BAIRRO`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`CD_ESTADO`),
  ADD KEY `fk_estado_pais_idx` (`CD_PAIS`);

--
-- Indexes for table `estado_civil`
--
ALTER TABLE `estado_civil`
  ADD PRIMARY KEY (`CD_ESTADO_CIVIL`);

--
-- Indexes for table `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`CD_PAGAMENTO`),
  ADD KEY `fk_pagamento_contrato1_idx` (`CD_CONTRATO`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`CD_PAIS`);

--
-- Indexes for table `parceiro`
--
ALTER TABLE `parceiro`
  ADD PRIMARY KEY (`CD_PARCEIRO`),
  ADD KEY `fk_parceiro_endereco1_idx` (`NR_CEP`);

--
-- Indexes for table `plano`
--
ALTER TABLE `plano`
  ADD PRIMARY KEY (`CD_PLANO`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`CD_USUARIO`),
  ADD KEY `fk_usuario_cargo1_idx` (`CD_CARGO`);

--
-- Indexes for table `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`CD_ZONA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `CD_BAIRRO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cargo`
--
ALTER TABLE `cargo`
  MODIFY `CD_CARGO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `CD_CIDADE` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `CD_CLIENTE` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contrato`
--
ALTER TABLE `contrato`
  MODIFY `CD_CONTRATO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `CD_ESTADO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `estado_civil`
--
ALTER TABLE `estado_civil`
  MODIFY `CD_ESTADO_CIVIL` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `CD_PAGAMENTO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `CD_PAIS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `CD_USUARIO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zona`
--
ALTER TABLE `zona`
  MODIFY `CD_ZONA` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `fk_bairro_cidade1` FOREIGN KEY (`CD_CIDADE`) REFERENCES `cidade` (`CD_CIDADE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bairro_zona1` FOREIGN KEY (`CD_ZONA`) REFERENCES `zona` (`CD_ZONA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `carteira`
--
ALTER TABLE `carteira`
  ADD CONSTRAINT `fk_carteira_cliente1` FOREIGN KEY (`CD_CLIENTE`) REFERENCES `cliente` (`CD_CLIENTE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carteira_plano1` FOREIGN KEY (`CD_PLANO`) REFERENCES `plano` (`CD_PLANO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `fk_cidade_estado1` FOREIGN KEY (`CD_ESTADO`) REFERENCES `estado` (`CD_ESTADO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_endereco1` FOREIGN KEY (`NR_CEP`) REFERENCES `endereco` (`NR_CEP`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cliente_estado_civil1` FOREIGN KEY (`CD_ESTADO_CIVIL`) REFERENCES `estado_civil` (`CD_ESTADO_CIVIL`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `fk_contrato_cliente1` FOREIGN KEY (`CD_CLIENTE`) REFERENCES `cliente` (`CD_CLIENTE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contrato_usuario1` FOREIGN KEY (`CD_USUARIO`) REFERENCES `usuario` (`CD_USUARIO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `contrato_mensal`
--
ALTER TABLE `contrato_mensal`
  ADD CONSTRAINT `fk_contrato` FOREIGN KEY (`CD_CONTRATO`) REFERENCES `contrato` (`CD_CONTRATO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_bairro1` FOREIGN KEY (`CD_BAIRRO`) REFERENCES `bairro` (`CD_BAIRRO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `fk_estado_pais` FOREIGN KEY (`CD_PAIS`) REFERENCES `pais` (`CD_PAIS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `fk_pagamento_contrato1` FOREIGN KEY (`CD_CONTRATO`) REFERENCES `contrato` (`CD_CONTRATO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `parceiro`
--
ALTER TABLE `parceiro`
  ADD CONSTRAINT `fk_parceiro_endereco1` FOREIGN KEY (`NR_CEP`) REFERENCES `endereco` (`NR_CEP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_cargo1` FOREIGN KEY (`CD_CARGO`) REFERENCES `cargo` (`CD_CARGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
