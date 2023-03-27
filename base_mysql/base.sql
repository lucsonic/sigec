-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dbsigec
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adiantamento`
--

DROP TABLE IF EXISTS `adiantamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adiantamento` (
  `idadiantamento` int NOT NULL AUTO_INCREMENT,
  `idfuncionario` int DEFAULT NULL,
  `data_adt` date DEFAULT NULL,
  `nparcela` int DEFAULT NULL,
  `situacao` varchar(10) DEFAULT NULL,
  `data_pag` date DEFAULT NULL,
  `parcelas` int DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idadiantamento`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adiantamento`
--

LOCK TABLES `adiantamento` WRITE;
/*!40000 ALTER TABLE `adiantamento` DISABLE KEYS */;
INSERT INTO `adiantamento` VALUES (1,2,'2021-05-01',1,'Em aberto','2021-06-01',1,250.00),(27,3,'2021-03-01',1,'Em aberto','2021-04-01',3,233.33),(28,3,'2021-03-01',2,'Em aberto','2021-05-01',3,233.33),(29,3,'2021-03-01',3,'Em aberto','2021-05-31',3,233.33);
/*!40000 ALTER TABLE `adiantamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agenda` (
  `idagenda` int NOT NULL AUTO_INCREMENT,
  `data_comp` date DEFAULT NULL,
  `compromisso` varchar(150) DEFAULT NULL,
  `horario` varchar(5) DEFAULT NULL,
  `local` varchar(60) DEFAULT NULL,
  `nome_contato` varchar(50) DEFAULT NULL,
  `telefones` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idagenda`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda`
--

LOCK TABLES `agenda` WRITE;
/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
INSERT INTO `agenda` VALUES (1,'2021-03-10','Reunião com administrador','10:30','Administração regional','Rupináculo','98520-4630'),(2,'2021-04-21','Atendimento com a gerência do banco','14:00','Banco Bradesco','Jumentino','99540-4533');
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `idcliente` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `tipopessoa` varchar(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `telefones` varchar(40) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `orgaorg` varchar(20) DEFAULT NULL,
  `indicacao` varchar(45) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `nomefantasia` varchar(150) DEFAULT NULL,
  `razaosocial` varchar(250) DEFAULT NULL,
  `nomecontato` varchar(45) DEFAULT NULL,
  `datacadastro` datetime DEFAULT NULL,
  `ativo` int unsigned NOT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (8,'JACSON MEDINA ','Física','Quadra 12, Conjunto N, Lote 30/B','ARAPOANGA','PLANALTINA','DF','79361749153','','73369-17','(61) 9 8627-9245','1.640.539','SSP/DF','Outros','1975-05-01','jacsonmedinajessica@gmail.com','','','','2020-09-11 11:18:47',1,'Masculino'),(36,NULL,'Jurídica','Av. W3 Ed. Torre 3º andar Sala 3003','Asa Sul','Brasília','DF',NULL,'01237621000152','73300000','6132100115 99888-1222',NULL,NULL,'Amigos',NULL,'romaoctis@gmail.com','CTIS INFORMÁTICA','CENTRO TECNOLÓGICO LTDA','ROMÃO GAY','2021-02-08 00:00:00',1,NULL),(37,'JOEL SANTANA','Física','Av. Vazia Casa sem número','Fantasma','Nenhuma','DF','11111111111',NULL,'73300000','6132455400','2352002','SSP/DF','Panfleto','1978-01-01','joelsantana@gmail.com',NULL,NULL,NULL,'2021-02-08 00:00:00',1,'Masculino'),(38,NULL,'Jurídica','Rua sem saída, casa sem número','Arapoangas','Planaltina','DF',NULL,'01231552000154','73330000','6132457855',NULL,NULL,'Redes Sociais',NULL,'massa@gmail.com','MASSA INFORMÁTICA','REDE MASSA DE TECNOLOGIA','JOÃO GAY','2021-02-09 00:00:00',1,NULL),(40,NULL,'Jurídica','Rua 1 Lote 3','Centro','Rio de Janeiro','RJ',NULL,'22222222222222','78000000','954221001',NULL,NULL,'Redes Sociais',NULL,'globolixo@gmail.com','GLOGO LIXO','Rede globo lixo','Xincomblentions','0000-00-00 00:00:00',1,NULL),(41,'RUBENILSON FLORES','Física','Qd. 32 Casa 34','Sul','Sobradinho','DF','33333333333',NULL,'73000000','903429342','20394','SSP/DF','Propaganda em carro de som','2003-03-03','rubenilson@gmail.com',NULL,NULL,NULL,'2021-05-17 17:35:55',1,'Masculino');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despesa`
--

DROP TABLE IF EXISTS `despesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `despesa` (
  `iddespesa` int NOT NULL AUTO_INCREMENT,
  `descricao_desp` varchar(250) DEFAULT NULL,
  `data_desp` date DEFAULT NULL,
  `valor_desp` decimal(10,2) DEFAULT NULL,
  `idtipo` int DEFAULT NULL,
  PRIMARY KEY (`iddespesa`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesa`
--

LOCK TABLES `despesa` WRITE;
/*!40000 ALTER TABLE `despesa` DISABLE KEYS */;
INSERT INTO `despesa` VALUES (1,'PAGAMENTO DE CONTA DE AGUA','2021-03-10',233.80,11),(2,'ABASTECIMENTO','2021-04-14',185.37,5),(3,'PAGAMENTO DE ALUGUÉL','2021-04-30',650.00,7),(4,'PAGAMENTO DO CONTADOR','2021-04-30',350.00,4);
/*!40000 ALTER TABLE `despesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feriado`
--

DROP TABLE IF EXISTS `feriado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feriado` (
  `idferiado` int NOT NULL AUTO_INCREMENT,
  `dia` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `descricao` varchar(80) DEFAULT NULL,
  `mes` int DEFAULT NULL,
  PRIMARY KEY (`idferiado`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feriado`
--

LOCK TABLES `feriado` WRITE;
/*!40000 ALTER TABLE `feriado` DISABLE KEYS */;
INSERT INTO `feriado` VALUES (9,1,2016,'Confraternização universal ',1),(10,9,2016,'Carnaval ',2),(11,25,2016,'Paixão de Cristo',3),(12,21,2016,'Tiradentes ',4),(13,26,2016,'Corpus Christi ',5),(14,7,2016,'Dia da Pátria ',9),(15,12,2016,'Nossa Senhora Aparecida ',10),(16,2,2016,'Finados ',11),(17,15,2016,'Proclamação da República',11),(18,25,2016,'Natal do Senhor',12),(19,1,2017,'Confraternização universal ',1),(20,28,2017,'Carnaval',2),(21,14,2017,'Paixão de Cristo',4),(22,21,2017,'Tiradentes',4),(23,1,2017,'Dia do trabalho',5),(24,15,2017,'Corpus Christi',6),(25,7,2017,'Independência do Brasil',9),(26,12,2017,'Nossa Senhora Aparecida',10),(27,2,2017,'Finados',11),(28,15,2017,'Proclamação da República',11),(29,25,2017,'Natal do Senhor',12),(30,1,2016,'Dia do trabalho',5),(31,30,2017,'Feriado - Dia do Evangélico',11),(32,1,2018,'Confraternização universal',1),(33,13,2018,'Carnaval',2),(34,30,2018,'Paixão de Cristo',3),(35,21,2018,'Tiradentes',4),(36,31,2018,'Corpus Christi',5),(37,7,2018,'Independência do Brasil',9),(38,12,2018,'Nossa Senhora Aparecida',10),(39,2,2018,'Finados',11),(40,15,2018,'Proclamação da Recpública',11),(41,30,2018,'Dia do Evangélico',11),(42,25,2018,'Natal do Senhor',12),(43,1,2019,'Confraternização universal.',1),(44,5,2019,'Carnaval',3),(45,19,2019,'Sexta-feira da Paixão de Cristo',4),(46,1,2019,'Dia do trabalhador',5),(47,20,2019,'Corpus Christi',6),(48,7,2019,'Independência do Brasil',9),(49,12,2019,'Nossa Senhora Aparecida - Padroeira do Brasil',10),(50,15,2019,'Dia do Professor',10),(51,2,2019,'Finados',11),(52,15,2019,'Proclamação da República',11),(53,30,2019,'Dia do Evangélico - Lei nº 893, de 27/07/1995',11),(54,25,2019,'Natal do Senhor',12),(55,1,2021,'Confraternização universal.',1),(56,16,2021,'Carnaval',2),(57,2,2021,'Sexta-feira da Paixão de Cristo',4),(58,1,2021,'Dia do trabalhador',5),(59,3,2021,'Corpus Christi',6),(60,7,2021,'Independência do Brasil',9),(61,12,2021,'Nossa Senhora Aparecida - Padroeira do Brasil',10),(62,15,2021,'Dia do Professor',10),(63,2,2021,'Finados',11),(64,15,2021,'Proclamação da República',11),(65,30,2021,'Dia do Evangélico - Lei nº 893, de 27/07/1995',11),(66,25,2021,'Natal do Senhor',12),(67,21,2021,'Tiradentes/Aniversário de Brasília',4);
/*!40000 ALTER TABLE `feriado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fornecedores` (
  `idfornecedor` int NOT NULL AUTO_INCREMENT,
  `nomefantasia` varchar(200) DEFAULT NULL,
  `razaosocial` varchar(200) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cidade` varchar(60) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `nomecontato` varchar(60) DEFAULT NULL,
  `telefones` varchar(45) DEFAULT NULL,
  `ativo` int DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  `datacadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`idfornecedor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (1,'RABELO ATACADISTA','RR Atacadista','44444444444444','Av. Palmeiras Rua 16 Lotes 34/35','Centro','São Paulo','SC','Ronaldo','1130258890',1,'Nenhuma','rabelo@gmail.com','81200350','www.rabeloatacadista.com.br','2021-05-19 10:04:23'),(2,'IRMÃOS MATHIAS','Irmãos Mathias LTDA','77777777777777','Qd. 32 Casa 34','Centro','Sobradinho','DF','Juão','903429342',1,'Sem restrições','imathias@gmail.com','73000000','www.imathias.com.br','2021-05-19 13:54:54');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcao`
--

DROP TABLE IF EXISTS `funcao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcao` (
  `idfuncao` int NOT NULL AUTO_INCREMENT,
  `nomefuncao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idfuncao`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcao`
--

LOCK TABLES `funcao` WRITE;
/*!40000 ALTER TABLE `funcao` DISABLE KEYS */;
INSERT INTO `funcao` VALUES (1,'Pessoa Jurídica'),(2,'Auxiliar de Escritório'),(3,'Assistente Administrativo'),(4,'Operador de Máquinas'),(5,'Digitador'),(6,'Assistente de Supote Técnico'),(7,'Desenvolvedor Júnior'),(8,'Desenvolvedor Pleno'),(9,'Desenvolvedor Sênior'),(10,'Analista de Sistemas'),(11,'Analista de Suporte'),(13,'Chefe de Seção'),(14,'Analista de Mardeting'),(15,'Contador');
/*!40000 ALTER TABLE `funcao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `idfuncionario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cidade` varchar(60) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `orgaorg` varchar(20) DEFAULT NULL,
  `idsetor` int DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `formacao` varchar(45) DEFAULT NULL,
  `estadocivil` varchar(45) DEFAULT NULL,
  `ativo` int DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `datacadastro` date DEFAULT NULL,
  `observacao` text,
  `email` varchar(160) DEFAULT NULL,
  `tipopessoa` varchar(10) DEFAULT NULL,
  `nomefantasia` varchar(250) DEFAULT NULL,
  `razaosocial` varchar(250) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `nomecontato` varchar(80) DEFAULT NULL,
  `telefones` varchar(45) DEFAULT NULL,
  `idfuncao` int DEFAULT NULL,
  `entrada` varchar(5) DEFAULT NULL,
  `saida` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idfuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'LUCIANO ANTONIO DA SILVA','Quadra 11 Conjunto M','Arapoangas','Brasília','DF','73369114','56421192149','1292284','SSP/DF',6,'Masculino','Pós-Graduação','Divorciado',1,'1971-11-17','2021-05-22','Nenhuma','lucsonic@gmail.com','Física',NULL,NULL,NULL,NULL,'61992350766',8,'09:00','18:00'),(2,'SAMUEL RODRIGUES ROSA','Rua 1 Lote 3','Centro','Rio de Janeiro','RJ','78000000','11111111111','213546','SSP/DF',8,'Masculino','Ensino Médio','Solteiro',1,'2001-05-13','2021-05-22','Nenhuma','globolixo@gmail.com','Física',NULL,NULL,NULL,NULL,'954221001',5,'08:00','17:00'),(3,NULL,'Rua sem saída, casa sem número','Fantasma','Planaltina','DF','73330000',NULL,NULL,NULL,1,NULL,NULL,NULL,1,NULL,'2021-05-22','Pessoa jurídica','massa@gmail.com','Jurídica','BARZINHO DA ESQUINA','Bar do Cirilo','33333333333333','Cirilo ou João','6132457855',1,'08:00','17:00');
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos` (
  `idgrupo` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idgrupo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (1,'Farinácios'),(2,'Vidros'),(3,'Eletrodomésticos');
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_acoes`
--

DROP TABLE IF EXISTS `log_acoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_acoes` (
  `idlog_acoes` int NOT NULL AUTO_INCREMENT,
  `idusuario` int DEFAULT NULL,
  `data_acao` datetime DEFAULT NULL,
  `acao` text,
  PRIMARY KEY (`idlog_acoes`)
) ENGINE=InnoDB AUTO_INCREMENT=431 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_acoes`
--

LOCK TABLES `log_acoes` WRITE;
/*!40000 ALTER TABLE `log_acoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_acoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marcas` (
  `idmarca` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (2,'Eletrolux'),(4,'Philco');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissoes` (
  `idPermissao` int NOT NULL AUTO_INCREMENT,
  `idUsuario` int NOT NULL,
  `usuarios` tinyint(1) NOT NULL DEFAULT '0',
  `relatorios_adm` tinyint(1) NOT NULL DEFAULT '0',
  `relatorios_fin` tinyint(1) NOT NULL DEFAULT '0',
  `log_acoes` tinyint(1) NOT NULL DEFAULT '0',
  `clientes` tinyint(1) DEFAULT NULL,
  `fornecedores` tinyint(1) DEFAULT NULL,
  `produtos` tinyint(1) DEFAULT NULL,
  `funcionarios` tinyint(1) DEFAULT NULL,
  `agenda` tinyint(1) DEFAULT NULL,
  `receitas` tinyint(1) DEFAULT NULL,
  `despesas` tinyint(1) DEFAULT NULL,
  `balancetes` tinyint(1) DEFAULT NULL,
  `vendas` tinyint(1) DEFAULT NULL,
  `adiantamentos` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idPermissao`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

LOCK TABLES `permissoes` WRITE;
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` VALUES (1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `idproduto` int NOT NULL AUTO_INCREMENT,
  `idgrupo` int DEFAULT NULL,
  `idmarca` int DEFAULT NULL,
  `dsc_produto` varchar(250) DEFAULT NULL,
  `modelo` varchar(60) DEFAULT NULL,
  `qtd_atual` int DEFAULT NULL,
  `qtd_minima` int DEFAULT NULL,
  `qtd_critica` int DEFAULT NULL,
  `idfornecedor` int DEFAULT NULL,
  `vlr_compra` decimal(10,2) DEFAULT NULL,
  `vlr_venda` decimal(10,2) DEFAULT NULL,
  `cbarras` varchar(13) DEFAULT NULL,
  `ativo` int DEFAULT NULL,
  PRIMARY KEY (`idproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,3,4,'SMART TV 40 POLEGADAS','SLIM',15,7,10,2,800.00,2000.00,'1359402854613',1),(2,2,2,'JOGO DE COPOS COM SEIS UNIDADES','Vidrex',20,6,9,1,11.28,26.35,'3465281549873',1),(3,3,4,'LIQUIDIFICADOR PRETO','Batetudo',10,5,8,2,41.13,98.50,'3545121564645',1);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receita`
--

DROP TABLE IF EXISTS `receita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receita` (
  `idreceita` int NOT NULL AUTO_INCREMENT,
  `descricao_rec` varchar(250) DEFAULT NULL,
  `data_rec` date DEFAULT NULL,
  `idtipo` int DEFAULT NULL,
  `valor_rec` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idreceita`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receita`
--

LOCK TABLES `receita` WRITE;
/*!40000 ALTER TABLE `receita` DISABLE KEYS */;
INSERT INTO `receita` VALUES (1,'VENDA EFETUADA NA LOJA','2021-05-10',10,49.18),(2,'VENDA EFETUADA NA LOJA','2021-05-15',10,159.35),(3,'COMPENSAÇÃO DE CHEQUE','2021-05-11',12,206.83);
/*!40000 ALTER TABLE `receita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setor`
--

DROP TABLE IF EXISTS `setor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setor` (
  `idsetor` int NOT NULL AUTO_INCREMENT,
  `nomesetor` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idsetor`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setor`
--

LOCK TABLES `setor` WRITE;
/*!40000 ALTER TABLE `setor` DISABLE KEYS */;
INSERT INTO `setor` VALUES (1,'Pessoa Jurídica'),(2,'Contabilidade'),(3,'Pagamento'),(4,'Compras'),(5,'Limpeza'),(6,'Tecnologia'),(7,'Marketing'),(8,'Administrativo'),(9,'Almoxarifado'),(10,'Devolução');
/*!40000 ALTER TABLE `setor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_despesa`
--

DROP TABLE IF EXISTS `tipo_despesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_despesa` (
  `idtipodespesa` int NOT NULL AUTO_INCREMENT,
  `desctipodespesa` varchar(50) NOT NULL,
  PRIMARY KEY (`idtipodespesa`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_despesa`
--

LOCK TABLES `tipo_despesa` WRITE;
/*!40000 ALTER TABLE `tipo_despesa` DISABLE KEYS */;
INSERT INTO `tipo_despesa` VALUES (4,'Impostos'),(5,'Combustível'),(6,'Funcionários'),(7,'Aluguél'),(8,'Materiais de escritório'),(9,'Outros'),(10,'Internet'),(11,'Agua'),(12,'Energia');
/*!40000 ALTER TABLE `tipo_despesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_receita`
--

DROP TABLE IF EXISTS `tipo_receita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_receita` (
  `idtiporeceita` int NOT NULL AUTO_INCREMENT,
  `desctiporeceita` varchar(50) NOT NULL,
  PRIMARY KEY (`idtiporeceita`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_receita`
--

LOCK TABLES `tipo_receita` WRITE;
/*!40000 ALTER TABLE `tipo_receita` DISABLE KEYS */;
INSERT INTO `tipo_receita` VALUES (10,'Vendas'),(11,'Outros'),(12,'Cheque pré-datado');
/*!40000 ALTER TABLE `tipo_receita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(15) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'luciano.silva','$2y$10$WANVoPIpF7sqQxZMRZjh6OHVu.33LvbW.Ec9/TKiKupYNr9S96VJ6','Luciano Antonio da Silva','lucsonic@gmail.com','1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-27 12:08:51
