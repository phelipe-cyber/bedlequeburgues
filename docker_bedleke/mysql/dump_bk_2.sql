-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 21/04/2022 às 18:10
-- Versão do servidor: 10.5.12-MariaDB-cll-lve
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u841971040_pdv`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividade`
--

CREATE TABLE `atividade` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `atividade` varchar(255) NOT NULL,
  `ordem` int(11) NOT NULL,
  `condicao` int(11) NOT NULL,
  `start` datetime DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cardapio`
--

CREATE TABLE `cardapio` (
  `id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `categoria` char(50) NOT NULL,
  `nome` char(255) NOT NULL,
  `detalhes` longtext NOT NULL,
  `preco_venda` char(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `usuario` char(50) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `cardapio`
--

INSERT INTO `cardapio` (`id`, `image`, `categoria`, `nome`, `detalhes`, `preco_venda`, `status`, `usuario`, `data`) VALUES
(1, '', 'Lanche', 'DUPLO CHEDDAR', '(Pão de hamburguer, hamburguer artesanal e duas fatias de queijo cheddar)', '10.00', 1, 'phelipe.silveira', '2022-03-02 12:12:03'),
(2, '', 'Lanche', 'KISABOR', '(Pão de hamburguer, hamburguer artesanal, duas fatias de queijo cheddar, bancon, alface picado, cebolas caramelisadas, tomate e maionese da casa)', '10.00', 1, 'phelipe.silveira', '2022-03-02 12:12:03'),
(3, '', 'Lanche', 'KISABOR', '(Pão de hamburguer, hamburguer artesanal, duas fatias de queijo cheddar, bancon, alface picado, cebolas caramelisadas, tomate e maionese da casa)', '10.00', 1, 'phelipe.silveira', '2022-03-02 12:12:03'),
(4, '', 'Lanche', 'KISABOR', '(Pão de hamburguer, hamburguer artesanal, duas fatias de queijo cheddar, bancon, alface picado, cebolas caramelisadas, tomate e maionese da casa)', '10.00', 1, 'phelipe.silveira', '2022-03-02 12:12:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(100) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `endereco` varchar(255) COLLATE utf8_bin NOT NULL,
  `bairro` varchar(255) COLLATE utf8_bin NOT NULL,
  `cidade` varchar(255) COLLATE utf8_bin NOT NULL,
  `estado` varchar(255) COLLATE utf8_bin NOT NULL,
  `complemento` varchar(255) COLLATE utf8_bin NOT NULL,
  `cep` varchar(255) COLLATE utf8_bin NOT NULL,
  `ponto_referecia` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel1` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel2` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `cpf_cnpj` varchar(255) COLLATE utf8_bin NOT NULL,
  `rg` varchar(255) COLLATE utf8_bin NOT NULL,
  `condominio` varchar(255) COLLATE utf8_bin NOT NULL,
  `bloco` varchar(255) COLLATE utf8_bin NOT NULL,
  `apartamento` varchar(255) COLLATE utf8_bin NOT NULL,
  `local_entrega` varchar(255) COLLATE utf8_bin NOT NULL,
  `observacoes` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `endereco`, `bairro`, `cidade`, `estado`, `complemento`, `cep`, `ponto_referecia`, `tel1`, `tel2`, `email`, `cpf_cnpj`, `rg`, `condominio`, `bloco`, `apartamento`, `local_entrega`, `observacoes`) VALUES
(1, 'Eduardo Duda', 'Rua Arthur Eloy, 150', 'Vila Yara', 'Osasco', 'SP', '', '06026170', '', '1197309-0803', '', '', '', '', '', '', '', '', ''),
(2, 'Susy', 'Rua Doutor Adonai, 112', 'Vila Engenho Novo', 'Barueri', 'SP', '', '06415090', '', '1195058-2360', '', '', '', '', '', '', '', '', ''),
(3, 'Leandro', 'Rua Delfim, 199', 'Jardim Paraíso', 'Barueri', 'SP', '', '06412-240', '', '119919-14082', '', '', '', '', '', '', '', '', ''),
(4, 'Karina ', 'Rua Manoel Alves Garcia', 'Jardim São Luiz', 'Jandira', 'SP', '', '06618010', 'Proximo a prefeitura', '11 95465-2910', '', '', '', '', 'Praça estação Jandira', '9', '22', '', ''),
(5, 'Stephanie Machado', 'Rua Mar Vermelho, 1243', 'Jardim Regina Alice', 'Barueri', 'SP', '', '06412-140', '', '11 93774-3308', '', '', '', '', '', '', '', '', ''),
(6, 'Rejane', 'Rua Aracaju, 242', 'Núcleo Residencial Célia Mota', 'Barueri', 'SP', '', '06413-700', '', '11 98562-7638', '', '', '', '', '', '', '', '', ''),
(7, 'Alexandre', 'Avenida Sebastião Davino dos Reis, 99', 'Jardim Tupanci', 'Barueri', 'SP', '', '06414-007', '', '11 98595-9405', '', '', '', '', '', 'B', '104', '', ''),
(8, 'Cristiane', 'Rua Doutor Fausto Dias Ferraz, 103', 'Vila Morellato', 'Barueri', 'SP', '', '06408-200', '', '11 96360-0239', '', '', '', '', '', '', '', '', ''),
(9, 'Luzia Cristina Madaschi', 'Rua Canal do Panamá, 288', 'Jardim Regina Alice', 'Barueri', 'SP', '', '06412-160', '', '11 99568-8768', '', '', '', '', '', '', '', '', ''),
(10, 'Jefferson', 'Rua Vinte e Cinco de Janeiro, 116', 'Jardim Belval', 'Barueri', 'SP', '', '06420460', '', '11 98890-1148', '', '', '', '', '', '', '', '', ''),
(11, 'Alex', 'Rua Ibitinga, 240', 'Vila Morellato', 'Barueri', 'SP', '', '06408-130', '', '11 96015-4447', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cor`
--

CREATE TABLE `cor` (
  `id` int(100) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `cor`
--

INSERT INTO `cor` (`id`, `cor`, `id_user`) VALUES
(1, 'success', 1),
(2, 'success', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `despesas`
--

CREATE TABLE `despesas` (
  `id` int(100) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `despesa` varchar(255) NOT NULL,
  `data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mesas`
--

CREATE TABLE `mesas` (
  `id` int(100) NOT NULL,
  `id_mesa` varchar(255) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `mesas`
--

INSERT INTO `mesas` (`id`, `id_mesa`, `id_pedido`, `nome`, `status`) VALUES
(1, '1', 0, '', '1'),
(2, '2', 0, '', '1'),
(3, '3', 0, '', '1'),
(4, '4', 0, '', '1'),
(5, '5', 0, '', '1'),
(6, '6', 0, '', '1'),
(7, '7', 0, '', '1'),
(8, '8', 0, '', '1'),
(9, '9', 0, '', '1'),
(10, '10', 0, '', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL,
  `numeropedido` varchar(50) NOT NULL,
  `delivery` varchar(100) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `idmesa` varchar(100) NOT NULL,
  `produto` varchar(255) NOT NULL,
  `quantidade` varchar(100) NOT NULL,
  `hora_pedido` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  `pgto` varchar(20) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `gorjeta` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`idpedido`, `numeropedido`, `delivery`, `cliente`, `idmesa`, `produto`, `quantidade`, `hora_pedido`, `valor`, `observacao`, `pgto`, `usuario`, `data`, `gorjeta`, `status`) VALUES
(28, '1001', '', 'Mesa', '', 'Costela Com Cheddar', '1', '23:48', '10.00', '', '', 'Phelipe', '2022-03-10 02:48:13', '', 4),
(29, '1001', '', 'Mesa', '', 'Chocolate com Morango', '1', '23:48', '9.00', '', '', 'Phelipe', '2022-03-10 02:48:13', '', 4),
(30, '1001', '', 'Mesa', '', 'Coca-Cola 2ltrs ', '1', '23:48', '12.00', '', '', 'Phelipe', '2022-03-10 02:48:13', '', 4),
(31, '1002', '', 'Mesa', '', '3 Queijos', '1', '00:01', '9.00', '', '', 'Phelipe', '2022-03-10 03:01:01', '', 4),
(32, '1003', '', 'Mesa', '', 'Carne com Queijo', '1', '00:09', '9.00', '', '', 'Phelipe', '2022-03-10 03:09:21', '', 4),
(33, '1003', '', 'Mesa', '', 'Nutella com Morango', '1', '00:09', '9.00', '', '', 'Phelipe', '2022-03-10 03:09:21', '', 4),
(74, '1004', '', 'Balcão', '', 'Coca-Cola 200ml ', '2', '20:04', '3.00', '', '', 'Phelipe', '2022-03-12 23:04:46', '', 4),
(76, '1006', '', 'João Carlos', '', 'Carne Seca com Queijo', '1', '20:35', '12.00', '', '', 'Phelipe', '2022-03-12 23:35:41', '', 4),
(77, '1007', '', 'Sonia', '', 'Carne Seca com Queijo', '1', '21:01', '12.00', '', '', 'Phelipe', '2022-03-13 00:01:37', '', 4),
(78, '1008', '', 'Balcão', '', 'Frango com Catupiry', '2', '21:25', '10.00', '', '', 'Phelipe', '2022-03-13 00:25:41', '', 4),
(79, '1009', '', 'Balcão', '', 'Guaraná 350 ml ', '1', '21:27', '5.00', '', '', 'Phelipe', '2022-03-13 00:27:49', '', 4),
(80, '1009', '', '', '', 'Costela Com Queijo', '1', '21:28', '12.00', '', '', 'Phelipe', '2022-03-13 00:28:45', '', 4),
(81, '1009', '', '', '', 'Nutella com Morango', '1', '21:28', '12.00', '', '', 'Phelipe', '2022-03-13 00:28:45', '', 4),
(82, '1010', '', 'Phelipe', '', 'Brahma Duplo Malte ', '2', '21:42', '7.00', '', '', 'Phelipe', '2022-03-13 00:42:19', '', 4),
(83, '1010', '', 'Phelipe', '', 'Heineken 330 ml ', '1', '21:42', '10.00', '', '', 'Phelipe', '2022-03-13 00:42:19', '', 4),
(86, '1012', '', 'Phelipe', '', 'Guaraná 350 ml ', '1', '23:57', '5.00', '', '', 'Phelipe', '2022-03-13 02:57:55', '', 4),
(87, '1012', '', 'Phelipe', '', 'X-Coleguinhas', '1', '23:57', '26.00', '', '', 'Phelipe', '2022-03-13 02:57:55', '', 4),
(88, '1013', '', 'Leandro', '', 'Calabresa com Catupity', '1', '18:50', '10.00', '', '', 'Phelipe', '2022-03-13 21:50:02', '', 4),
(89, '1013', '', 'Leandro', '', 'Calabresa com Queijo', '1', '18:50', '10.00', '', '', 'Phelipe', '2022-03-13 21:50:02', '', 4),
(90, '1013', '', 'Leandro', '', 'Carne', '1', '18:50', '9.00', '', '', 'Phelipe', '2022-03-13 21:50:02', '', 4),
(91, '1013', '', 'Leandro', '', 'Queijo', '1', '18:50', '9.00', '', '', 'Phelipe', '2022-03-13 21:50:02', '', 4),
(97, '1015', '', 'Jefferson', '', 'Calabresa', '1', '20:42', '9.00', '', '', 'Phelipe', '2022-03-13 23:42:59', '', 4),
(98, '1015', '', 'Jefferson', '', 'Carne', '1', '20:42', '9.00', '', '', 'Phelipe', '2022-03-13 23:42:59', '', 4),
(99, '1015', '', 'Jefferson', '', 'Carne com Queijo', '1', '20:42', '10.00', '', '', 'Phelipe', '2022-03-13 23:42:59', '', 4),
(100, '1015', '', 'Jefferson', '', 'Carne, Ovo, Cebola e Azeitona', '1', '20:42', '12.00', '', '', 'Phelipe', '2022-03-13 23:42:59', '', 4),
(101, '1015', '', 'Jefferson', '', 'Queijo', '1', '20:43', '9.00', '', '', 'Phelipe', '2022-03-13 23:43:47', '', 4),
(102, '1016', '', 'Balcão', '', 'Queijo', '2', '20:48', '9.00', '', '', 'Phelipe', '2022-03-13 23:48:19', '', 4),
(103, '1017', '', 'Ricardo', '', 'Carne, Ovo, Cebola e Azeitona', '1', '21:04', '12.00', '', '', 'Phelipe', '2022-03-14 00:04:45', '', 4),
(104, '1017', '', 'Ricardo', '', 'Heineken 330 ml ', '1', '21:04', '10.00', '', '', 'Phelipe', '2022-03-14 00:04:45', '', 4),
(110, '1019', '', 'Jady', '', 'X-Bacon', '1', '21:42', '16.00', '', '', 'Phelipe', '2022-03-14 00:42:42', '', 4),
(111, '1020', '', 'Rogerio', '', 'X-Burguer', '1', '21:49', '10.00', '', '', 'Phelipe', '2022-03-14 00:49:07', '', 4),
(112, '1021', '', 'Rogerio', '', 'X-Burguer', '1', '22:06', '10.00', '', '', 'Phelipe', '2022-03-14 01:06:42', '', 4),
(113, '1021', '', 'Rogerio', '', 'X-Salada', '1', '22:07', '10.00', '', '', 'Phelipe', '2022-03-14 01:07:11', '', 4),
(114, '1022', '', 'Rafael', '', 'X-Bacon', '1', '22:17', '16.00', '', '', 'Phelipe', '2022-03-14 01:17:40', '', 4),
(115, '1022', '', 'Rafael', '', 'Fanta Laraja 310 ml', '1', '22:20', '4', '', '', 'Phelipe', '2022-03-14 01:20:30', '', 4),
(116, '1023', '', 'MESA', '2', 'Skol ', '3', '00:12', '5.00', '', '', '', '2022-03-14 03:12:01', '', 4),
(118, '1025', '', 'Robson', '', 'Especial das Coleguinhas', '1', '20:41', '20.00', '', 'PIX', 'Phelipe', '2022-03-15 23:41:33', '', 4),
(121, '1026', '', 'vizinha ', '', 'Sufresh Maracujá', '1', '21:18', '5.50', '', 'Debito', 'Raphael', '2022-03-15 00:18:43', '', 4),
(122, '1026', '', 'vizinha ', '', 'Sukita uva', '2', '21:18', '3.00', '', 'Debito', 'Raphael', '2022-03-15 00:18:43', '', 4),
(130, '1027', '', 'vizinha ', '', 'Caipira', '1', '21:48', '10.00', '', 'Dinheiro', 'Raphael', '2022-03-15 00:48:58', '', 4),
(134, '1028', '', 'Gabriel', '', 'Carne', '1', '22:08', '9.00', '', 'Cartão Credito', 'Phelipe', '2022-03-15 01:08:41', '', 4),
(135, '1028', '', 'Gabriel', '', 'Carne com Queijo', '1', '22:08', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-03-15 01:08:41', '', 4),
(136, '1028', '', 'Gabriel', '', 'Carne, Ovo, Cebola e Azeitona', '1', '22:08', '12.00', '', 'Cartão Credito', 'Phelipe', '2022-03-15 01:08:41', '', 4),
(137, '1029', '', 'Veronica', '', 'Calabresa com Queijo', '2', '22:11', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-03-15 01:11:40', '', 4),
(138, '1029', '', 'Veronica', '', 'Portuguesa', '2', '22:11', '12.00', '', 'Cartão Credito', 'Phelipe', '2022-03-15 01:11:40', '', 4),
(141, '1030', '', 'Andre', '', 'Fanta laranja 350 ml ', '1', '23:33', '5.00', 'Açai do Andre', 'Dinheiro', 'Phelipe', '2022-03-16 02:33:53', '', 4),
(142, '1030', '', 'Andre', '', 'Guaraná 350 ml ', '1', '23:33', '5.00', 'Açai do Andre', 'Dinheiro', 'Phelipe', '2022-03-16 02:33:53', '', 4),
(143, '1031', '', 'Raphael', '', 'Carne, Ovo, Cebola e Azeitona', '1', '23:37', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-03-16 02:37:25', '', 4),
(144, '1031', '', 'Raphael', '', 'Frango com Queijo', '1', '23:37', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-16 02:37:25', '', 4),
(145, '1032', '', 'Vizinha', '', 'X-Burguer', '2', '23:50', '10.00', '', 'Dinheiro', 'Raphael', '2022-03-16 02:50:26', '', 4),
(146, '1033', '', 'Vizinha', '', 'Chocolate com Morango', '1', '00:12', '10.00', '', 'Dinheiro', 'Phelipe', '2022-03-16 03:12:32', '', 4),
(147, '1033', '', 'Vizinha', '', 'Coca-Cola 600 ml  ', '1', '00:12', '7.00', '', 'Dinheiro', 'Phelipe', '2022-03-16 03:12:32', '', 4),
(148, '1034', '', 'Irmão Andre', '', 'Coca-Cola 600 ml  ', '1', '19:32', '9.00', '', 'Dinheiro', 'Phelipe', '2022-03-16 22:32:52', '', 4),
(149, '1034', '', 'Irmão Andre', '', 'X-Burguer', '1', '19:32', '10.00', '', 'Dinheiro', 'Phelipe', '2022-03-16 22:32:52', '', 4),
(150, '1034', '', 'Irmão Andre', '', 'Batata no Cone', '1', '19:32', '15.00', '', 'Dinheiro', 'Phelipe', '2022-03-16 22:32:52', '', 4),
(151, '1035', '', 'Vizinha Raphael', '', 'Bauru', '1', '19:36', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-16 22:36:17', '', 4),
(152, '1035', '', 'Vizinha Raphael', '', 'Calabresa com Cheddar', '1', '19:36', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-16 22:36:17', '', 4),
(153, '1035', '', 'Vizinha Raphael', '', 'Nutella com Morango', '1', '19:36', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-03-16 22:36:17', '', 4),
(154, '1036', '', 'Phelipe', '', 'Especial de Frango', '1', '19:39', '18.00', '', 'Cartão Credito', 'Phelipe', '2022-03-16 22:39:29', '', 4),
(155, '1036', '', 'Phelipe', '', 'Fanta uva 350ml ', '1', '19:39', '6.00', '', 'Cartão Credito', 'Phelipe', '2022-03-16 22:39:29', '', 4),
(156, '1037', '', 'Thiago', '', 'Carne', '1', '20:26', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-03-16 23:26:08', '', 4),
(157, '1037', '', 'Thiago', '', 'Carne, Ovo, Cebola e Azeitona', '1', '20:26', '12.00', 'Sem cebola', 'Cartão Debito', 'Phelipe', '2022-03-16 23:26:08', '', 4),
(158, '1037', '', 'Thiago', '', 'Queijo', '1', '20:26', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-03-16 23:26:08', '', 4),
(159, '1038', '', 'Caroline', '', 'Calabresa com Queijo', '1', '21:04', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-03-16 00:04:54', '', 4),
(160, '1038', '', 'Caroline', '', 'Costela Com Queijo', '2', '21:04', '12.00', '', 'Cartão Credito', 'Phelipe', '2022-03-16 00:04:54', '', 4),
(161, '1039', '', 'Rogerio', '', 'X-Burguer', '2', '22:04', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-16 00:04:54', '', 4),
(162, '1039', '', 'Rogerio', '', 'X-Bacon', '2', '22:04', '16.00', 'Bem passado', 'Cartão Debito', 'Phelipe', '2022-03-16 00:04:54', '', 4),
(163, '1040', '', 'Vizinho', '', 'Guaraná 200 ml ', '2', '22:24', '3.00', '', 'Dinheiro', 'Phelipe', '2022-03-16 00:04:54', '', 4),
(164, '1041', '', 'Cliente', '', 'Portuguesa', '1', '22:25', '12.00', '', 'Cartão Credito', 'Phelipe', '2022-03-16 00:04:54', '', 4),
(165, '1042', '', 'Cliente', '', 'Costela burguer', '1', '22:28', '30.00', '', 'Cartão Debito', 'Phelipe', '2022-03-16 00:04:54', '', 4),
(166, '1042', '', 'Cliente', '', 'Sufresh Maracujá', '1', '22:28', '5.50', 'Foi cobrado 5 reais', 'Cartão Debito', 'Phelipe', '2022-03-16 00:04:54', '', 4),
(167, '1043', '', 'Luiz', '', 'Heineken 330 ml ', '2', '23:07', '10.00', '', 'Cartão Credito', 'Phelipe', '0000-00-00 00:00:00', '', 4),
(172, '1044', '', 'Silmara', '', 'Carne com Queijo', '2', '19:46', '10.00', '', 'Pix', 'Phelipe', '2022-03-17 19:03:28', '', 4),
(173, '1045', '', 'Vizinha', '', 'Nutella com Morango', '1', '21:51', '12.00', '', '', 'Phelipe', '2022-03-17 21:03:08', '', 4),
(174, '1045', '', 'Vizinha', '', 'X-Salada', '1', '21:51', '10.00', '', '', 'Phelipe', '2022-03-17 21:03:08', '', 4),
(175, '1046', '', 'Tatiana', '', 'X-Bacon', '1', '22:32', '16.00', '', 'Cartão Debito', 'Phelipe', '2022-03-17 22:03:33', '', 4),
(176, '1046', '', 'Tatiana', '', 'X-Frango', '1', '22:32', '15.00', '', 'Cartão Debito', 'Phelipe', '2022-03-17 22:03:33', '', 4),
(177, '1047', '', 'Vizinha', '', 'X-Salada', '1', '22:32', '10.00', '', '', 'Phelipe', '2022-03-17 22:03:52', '', 4),
(178, '1048', '', 'Anderson', '', 'Calabresa com Queijo', '1', '21:41', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-03-18 21:03:04', '', 4),
(179, '1048', '', 'Anderson', '', 'Carne, Ovo, Cebola e Azeitona', '1', '21:41', '12.00', '', 'Cartão Credito', 'Phelipe', '2022-03-18 21:03:04', '', 4),
(180, '1048', '', 'Anderson', '', 'Pizza', '1', '21:41', '10.00', 'Foi cobrado 10 reais', 'Cartão Credito', 'Phelipe', '2022-03-18 21:03:04', '', 4),
(181, '1048', '', 'Anderson', '', 'Coca-Cola 600 ml  ', '1', '21:41', '9.00', 'Foi cobrado 08 reais', 'Cartão Credito', 'Phelipe', '2022-03-18 21:03:04', '', 4),
(182, '1049', '', 'Cliente', '', 'Carne', '1', '21:45', '9.00', '', 'Dinheiro', 'Phelipe', '2022-03-18 21:03:36', '', 4),
(183, '1050', '', 'Cliente', '', 'Carne com Queijo', '1', '21:46', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-18 21:03:02', '', 4),
(184, '1051', '', 'Cliente', '', 'Calabresa com Queijo', '1', '21:46', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-18 21:03:38', '', 4),
(185, '1051', '', 'Cliente', '', 'Chocolate com Morango', '1', '21:46', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-18 21:03:38', '', 4),
(188, '1052', '', 'Mesa Cliente', '', 'Calabresa com Queijo', '1', '22:10', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-18 22:03:55', '', 4),
(189, '1052', '', 'Mesa Cliente', '', 'Pizza', '2', '22:10', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-18 22:03:55', '', 4),
(190, '1052', '', 'Mesa Cliente', '', 'Guaraná 2 litros ', '1', '22:10', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-18 22:03:55', '', 4),
(191, '1053', '', 'Cliente', '', 'Heineken 330 ml ', '1', '22:12', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-03-18 22:03:36', '', 4),
(192, '1053', '', 'Cliente', '', 'Mini Especial', '1', '22:12', '15.00', '', 'Cartão Debito', 'Phelipe', '2022-03-18 22:03:36', '', 4),
(198, '1054', '', 'Alexandre', '', 'Calabresa com Queijo', '1', '22:50', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-03-18 22:03:06', '', 4),
(199, '1054', '', 'Alexandre', '', 'Pizza', '1', '22:50', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-03-18 22:03:06', '', 4),
(200, '1054', '', 'Alexandre', '', 'Coca-Cola 600 ml  ', '1', '22:50', '8.00', '', 'Cartão Credito', 'Phelipe', '2022-03-18 22:03:06', '', 4),
(201, '1054', '', 'Alexandre', '', 'Carne com Ovo', '1', '22:50', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-03-18 22:03:06', '', 4),
(208, '1055', '', 'Caio', '3', 'Frango com Catupiry', '1', '18:35', '10.00', '', '', 'Phelipe', '2022-03-20 18:03:56', '', 4),
(209, '1055', '', 'Caio', '3', 'Pizza', '1', '18:35', '10.00', '', '', 'Phelipe', '2022-03-20 18:03:56', '', 4),
(210, '1055', '', 'Caio', '3', 'Coca-Cola 350 ml ', '1', '18:45', '6.00', '', '', 'Phelipe', '2022-03-20 18:03:56', '', 4),
(211, '1056', '', 'Jhonatan', '', 'Costela Com Cheddar', '1', '18:54', '12.00', '', 'Pix', 'Phelipe', '2022-03-20 18:03:59', '', 4),
(212, '1056', '', 'Jhonatan', '', 'Fanta uva 350ml ', '1', '18:54', '6.00', '', 'Pix', 'Phelipe', '2022-03-20 18:03:59', '', 4),
(213, '1056', '', 'Jhonatan', '', 'Costela Com Cheddar', '1', '18:59', '12.00', '', 'Pix', 'Phelipe', '2022-03-20 18:03:44', '', 4),
(214, '1057', '', 'Caroline', '', 'Costela Com Queijo', '1', '19:02', '12.00', '', 'Pix', 'Phelipe', '2022-03-20 19:03:02', '', 4),
(215, '1057', '', 'Caroline', '', 'Coca-Cola 350 ml ', '1', '19:02', '6.00', '', 'Pix', 'Phelipe', '2022-03-20 19:03:02', '', 4),
(216, '1058', '', 'Jhonatan', '', 'Sukita uva', '1', '19:15', '3.00', '', 'Pix', 'Phelipe', '2022-03-20 19:03:42', '', 4),
(217, '1059', '', 'Susi', '', 'Carne Seca com Catupiry', '1', '19:16', '12.00', '', 'Dinheiro', 'Phelipe', '2022-03-20 19:03:20', '', 4),
(218, '1059', '', 'Susi', '', 'Batata no Cone', '1', '19:16', '15.00', '', 'Dinheiro', 'Phelipe', '2022-03-20 19:03:20', '', 4),
(219, '1060', '', 'Angelica', '', 'Bauru', '2', '19:28', '10.00', '', 'Dinheiro', 'Phelipe', '2022-03-20 19:03:03', '', 4),
(220, '1060', '', 'Angelica', '', 'Carne com Catupiry', '1', '19:28', '10.00', '', 'Dinheiro', 'Phelipe', '2022-03-20 19:03:03', '', 4),
(221, '1059', '', 'Susi', '', 'Frete', '1', '19:51', '3.00', '', 'Dinheiro', 'Phelipe', '2022-03-20 19:03:13', '', 4),
(222, '1061', '', 'Lorrany', '', 'Costela Com Queijo', '1', '19:53', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-03-20 19:03:45', '', 4),
(223, '1061', '', 'Lorrany', '', 'Coca-Cola 200ml ', '1', '19:53', '3.00', '', 'Cartão Debito', 'Phelipe', '2022-03-20 19:03:45', '', 4),
(224, '1062', '', 'Marciliana', '', 'Calabresa com Queijo', '1', '19:58', '10.00', '', 'Pix', 'Phelipe', '2022-03-20 19:03:41', '', 4),
(225, '1062', '', 'Marciliana', '', 'Carne com Queijo', '1', '19:58', '10.00', '', 'Pix', 'Phelipe', '2022-03-20 19:03:41', '', 4),
(226, '1062', '', 'Marciliana', '', 'Carne Seca com Queijo', '1', '19:58', '12.00', '', 'Pix', 'Phelipe', '2022-03-20 19:03:41', '', 4),
(227, '1062', '', 'Marciliana', '', 'Carne Seca com Catupiry', '1', '19:58', '12.00', '', 'Pix', 'Phelipe', '2022-03-20 19:03:41', '', 4),
(228, '1063', '', 'Carol', '', 'Calabresa com Catupity', '1', '20:38', '10.00', '', '', 'Phelipe', '2022-03-20 20:03:31', '', 4),
(229, '1063', '', 'Carol', '', 'Nutella com Morango', '1', '20:38', '12.00', '', '', 'Phelipe', '2022-03-20 20:03:31', '', 4),
(230, '1063', '', 'Carol', '', 'Duplo Cheddar', '1', '20:38', '12.00', '', '', 'Phelipe', '2022-03-20 20:03:31', '', 4),
(231, '1063', '', 'Carol', '', 'Kisabor', '1', '20:38', '18.00', '', '', 'Phelipe', '2022-03-20 20:03:31', '', 4),
(232, '1063', '', 'Carol', '', 'Coca-Cola 1 LT ', '1', '20:38', '9.00', '', '', 'Phelipe', '2022-03-20 20:03:31', '', 4),
(233, '1063', '', 'Carol', '', 'Coca-Cola 200ml ', '2', '20:38', '3.00', '', '', 'Phelipe', '2022-03-20 20:03:31', '', 4),
(234, '1064', '', 'Big Amarildo', '', 'Duplo Cheddar', '1', '22:11', '12.00', '', 'Dinheiro', 'Phelipe', '2022-03-20 22:03:31', '', 4),
(241, '1066', '', 'Daniel', '', 'Caipira', '1', '19:45', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-03-29 19:03:01', '', 4),
(242, '1066', '', 'Daniel', '', 'Carne com Queijo', '1', '19:45', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-03-29 19:03:01', '', 4),
(243, '1066', '', 'Daniel', '', 'Queijo', '1', '19:45', '9.00', '', 'Cartão Credito', 'Phelipe', '2022-03-29 19:03:01', '', 4),
(244, '1066', '', 'Daniel', '', 'Especial de Frango', '1', '19:45', '18.00', '', 'Cartão Credito', 'Phelipe', '2022-03-29 19:03:01', '', 4),
(245, '1067', '', 'Cliente', '', 'Atum, Azeitona e Cebola', '1', '19:17', '10.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 19:03:28', '', 4),
(247, '1068', '', 'Miguel', '', 'Frango com Catupiry', '2', '20:09', '10.00', '', '', 'Phelipe', '2022-03-31 20:03:12', '', 4),
(249, '1069', '', 'David', '', 'Especial das Coleguinhas', '1', '20:36', '24.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 20:03:54', '', 4),
(250, '1069', '', 'David', '', 'Especial de Carne Seca', '1', '20:36', '24.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 20:03:54', '', 4),
(251, '1069', '', 'David', '', 'Especial de Costela', '1', '20:36', '22.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 20:03:54', '', 4),
(254, '1070', '', 'Mesa', '', 'Carne', '3', '20:51', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-03-31 20:03:29', '', 4),
(257, '1069', '', 'David', '', 'Carne', '1', '21:01', '9.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 21:03:53', '', 4),
(258, '1069', '', 'David', '', 'Carne com Queijo', '1', '21:01', '10.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 21:03:53', '', 4),
(259, '1069', '', 'David', '', 'Queijo', '1', '21:01', '9.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 21:03:53', '', 4),
(260, '1069', '', 'David', '', 'Especial de Costela', '1', '21:01', '22.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 21:03:53', '', 4),
(261, '1071', '', 'Izabela', '', 'Calabresa', '1', '21:08', '9.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 21:03:22', '', 4),
(262, '1071', '', 'Izabela', '', 'Costela Com Queijo', '1', '21:08', '12.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 21:03:22', '', 4),
(263, '1071', '', 'Izabela', '', 'Coca-Cola Zero', '1', '21:08', '4.00', '', 'Dinheiro', 'Phelipe', '2022-03-31 21:03:22', '', 4),
(264, '1069', '', 'David', '', 'Fanta Laranja 2L', '2', '21:28', '10', '', 'Dinheiro', 'Phelipe', '2022-03-31 21:03:40', '', 4),
(268, '1072', '', 'Marinete', '', 'Carne', '2', '19:12', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-04-01 19:12:00', '', 4),
(269, '1072', '', 'Marinete', '', 'Queijo', '1', '19:12', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-04-01 19:12:00', '', 4),
(270, '1072', '', 'Marinete', '', 'Coca-Cola 200ml ', '1', '19:20', '3.00', '', 'Cartão Debito', 'Phelipe', '2022-04-01 19:20:00', '', 4),
(271, '1072', '', 'Marinete', '', 'Brahma Duplo Malte ', '1', '19:20', '7.00', '', 'Cartão Debito', 'Phelipe', '2022-04-01 19:20:00', '', 4),
(272, '1073', '', 'Cliente', '', 'Água', '1', '19:22', '3.00', '', 'Dinheiro', 'Phelipe', '2022-04-01 19:22:00', '', 4),
(273, '1074', '', 'Karina', '', 'Carne', '1', '19:57', '9.00', '', '', 'Phelipe', '2022-04-02 19:57:00', '', 4),
(275, '1075', '', 'Jaqueline', '', 'Carne', '2', '19:58', '9.00', '', '', 'Phelipe', '2022-04-02 19:58:00', '', 4),
(276, '1075', '', 'Jaqueline', '', 'Costela, Azeitona, Cebola, Queijo', '1', '19:58', '13.00', '', '', 'Phelipe', '2022-04-02 19:58:00', '', 4),
(277, '1074', '', 'Karina', '', 'X-Bacon', '2', '19:59', '16.00', '', '', 'Phelipe', '2022-04-02 19:59:00', '', 4),
(278, '1076', '', 'Isaque', '', 'Bauru', '1', '21:41', '10.00', '', '', 'Phelipe', '2022-04-02 21:41:00', '', 4),
(279, '1076', '', 'Isaque', '', 'Carne Seca com Queijo', '2', '21:41', '12.00', '', '', 'Phelipe', '2022-04-02 21:41:00', '', 4),
(280, '1077', '', 'Cristiane', '', 'Carne, Ovo, Cebola e Azeitona', '1', '21:43', '12.00', '', '', 'Phelipe', '2022-04-02 21:43:00', '', 4),
(281, '1077', '', 'Cristiane', '', 'Guaraná 350 ml ', '1', '21:43', '5.00', '', '', 'Phelipe', '2022-04-02 21:43:00', '', 4),
(282, '1078', '', 'cliente', '', 'Carne', '1', '22:28', '9.00', '', '', 'Phelipe', '2022-04-02 22:28:00', '', 4),
(283, '1078', '', 'cliente', '', 'Pizza', '1', '22:28', '10.00', '', '', 'Phelipe', '2022-04-02 22:28:00', '', 4),
(284, '1078', '', 'cliente', '', 'Carne', '2', '22:33', '9.00', '', '', 'Phelipe', '2022-04-02 22:33:00', '', 4),
(285, '1078', '', 'cliente', '', 'Carne', '1', '22:41', '9.00', '', '', 'Phelipe', '2022-04-02 22:41:00', '', 4),
(286, '1079', '', 'Mesa', '', 'Açai 500 ml', '3', '23:27', '23.00', '', '', 'Phelipe', '2022-04-02 23:27:00', '', 4),
(287, '1080', '', 'Phelipe', '1', 'Coca-Cola 200ml ', '1', '19:42', '3.00', '', '', 'Phelipe', '2022-04-03 19:42:00', '', 4),
(288, '1081', '', 'Mesa', '2', 'Costela Com Queijo', '1', '20:45', '12.00', '', '', 'Phelipe', '2022-04-03 20:45:00', '', 4),
(289, '1081', '', 'Mesa', '2', 'Frango com Queijo', '1', '20:45', '10.00', '', '', 'Phelipe', '2022-04-03 20:45:00', '', 4),
(290, '1081', '', 'Mesa', '', 'Açai 300 ml', '1', '20:47', '18.00', '', '', 'Phelipe', '2022-04-03 20:47:00', '', 4),
(291, '1082', '', 'Mesa', '', 'Costela Com Catupiry', '1', '22:05', '12.00', '', '', 'Phelipe', '2022-04-03 22:05:00', '', 4),
(292, '1082', '', 'Mesa', '', 'Costela Com Queijo', '1', '22:05', '12.00', '', '', 'Phelipe', '2022-04-03 22:05:00', '', 4),
(293, '1083', '', 'Susy', '', 'Batata 250g', '1', '20:01', '17.00', '', 'Cartão Debito', 'Phelipe', '2022-04-05 20:01:00', '', 4),
(294, '1083', '', 'Susy', '', 'Kisabor', '1', '20:01', '18.00', '', 'Cartão Debito', 'Phelipe', '2022-04-05 20:01:00', '', 4),
(295, '1084', '', 'Rafael', '', 'Caipira', '1', '20:04', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-05 20:04:00', '', 4),
(296, '1085', '', 'Felipe', '', '3 Queijos', '1', '20:06', '15.00', 'Com bacon', 'Cartão Debito', 'Phelipe', '2022-04-05 20:06:00', '', 4),
(297, '1085', '', 'Felipe', '', 'Carne Seca com Queijo', '3', '20:06', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-05 20:06:00', '', 4),
(298, '1085', '', 'Felipe', '', 'Coca-Cola 2ltrs ', '1', '20:06', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-05 20:06:00', '', 4),
(299, '1085', '', 'Felipe', '', 'Costela, Azeitona, Cebola, Queijo', '1', '20:06', '15.00', 'Com Bacon', 'Cartão Debito', 'Phelipe', '2022-04-05 20:06:00', '', 4),
(300, '1084', '', 'Rafael', '', 'Schweppes 350ml ', '1', '20:06', '5.00', '', 'Dinheiro', 'Phelipe', '2022-04-05 20:06:00', '', 4),
(301, '1086', '', 'Cliente', '', 'Calabresa', '1', '22:19', '9.00', '', 'Dinheiro', 'Phelipe', '2022-04-05 22:19:00', '', 4),
(302, '1086', '', 'Cliente', '', 'Heineken 330 ml ', '1', '22:19', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-05 22:19:00', '', 4),
(303, '1086', '', 'Cliente', '', 'Nutella com Morango', '1', '22:19', '12.00', '', 'Dinheiro', 'Phelipe', '2022-04-05 22:19:00', '', 4),
(304, '1086', '', 'Cliente', '', 'Carne Seca com Cheddar', '1', '22:25', '12.00', '', 'Dinheiro', 'Phelipe', '2022-04-05 22:25:00', '', 4),
(305, '1087', '', 'Max', '', 'Frango com Catupiry', '1', '22:31', '10.00', '', '', 'Phelipe', '2022-04-05 22:31:00', '', 4),
(306, '1086', '', 'Cliente', '', 'Skol ', '1', '22:35', '5.00', '', 'Dinheiro', 'Phelipe', '2022-04-05 22:35:00', '', 4),
(307, '1088', '', 'Phelipe', '', 'Brahma Duplo Malte ', '2', '22:39', '7.00', '', 'Cartão Debito', 'Phelipe', '2022-04-05 22:39:00', '', 4),
(308, '1088', '', 'Phelipe', '', 'Itaipava ', '11', '22:39', '4.00', '', 'Cartão Debito', 'Phelipe', '2022-04-05 22:39:00', '', 4),
(309, '1089', '', 'Stephanie', '', 'Carne, Ovo, Cebola e Azeitona', '2', '20:30', '12.00', 'Sem Cebola', 'Pix', 'Phelipe', '2022-04-06 20:30:00', '', 4),
(310, '1090', '', 'Cliente', '', 'Guaraná 1ltr ', '1', '22:09', '8.00', '', 'Dinheiro', 'Phelipe', '2022-04-06 22:09:00', '', 4),
(311, '1091', '', 'Mesa', '', 'Frango com Queijo', '1', '22:22', '10.00', '', '', 'Phelipe', '2022-04-06 22:22:00', '', 4),
(312, '1092', '', 'Mesa', '', 'Bauru', '1', '22:25', '10.00', '', '', 'Phelipe', '2022-04-06 22:25:00', '', 4),
(313, '1092', '', 'Mesa', '', 'Carne Seca com Queijo', '1', '22:25', '12.00', '', '', 'Phelipe', '2022-04-06 22:25:00', '', 4),
(314, '1092', '', 'Mesa', '', 'Coca-Cola 350 ml ', '1', '22:25', '6.00', '', '', 'Phelipe', '2022-04-06 22:25:00', '', 4),
(315, '1092', '', 'Mesa', '', 'Sufresh Guaraná', '1', '22:25', '5.50', '', '', 'Phelipe', '2022-04-06 22:25:00', '', 4),
(316, '1093', '', 'Cliente', '', 'Caipira', '1', '19:59', '10.00', '', '', 'Phelipe', '2022-04-06 23:59:00', '', 4),
(317, '1094', '', 'Joaquim', '', 'Açai 300 ml', '1', '20:29', '18.00', '', 'Cartão Debito', 'Phelipe', '2022-04-07 20:29:00', '', 4),
(318, '1094', '', 'Joaquim', '', 'Carne com Queijo', '1', '20:29', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-07 20:29:00', '', 4),
(319, '1094', '', 'Joaquim', '', 'Portuguesa', '1', '20:29', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-07 20:29:00', '', 4),
(320, '1095', '', 'Stephanie', '', 'Carne com Cheddar', '1', '21:12', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-07 21:12:00', '', 4),
(321, '1096', '', 'Robson', '', 'Carne, Ovo, Cebola e Azeitona', '1', '22:50', '12.00', '', '', 'Phelipe', '2022-04-07 22:50:00', '', 4),
(322, '1096', '', 'Robson', '', 'Coca-Cola 600 ml  ', '1', '22:50', '8.00', '', '', 'Phelipe', '2022-04-07 22:50:00', '', 4),
(324, '1097', '', 'Entrega', '1', 'Especial de Costela', '1', '19:06', '22.00', '', '', 'Phelipe', '2022-04-08 19:06:00', '', 4),
(325, '1097', '', 'Entrega', '', 'Especial de Carne', '1', '19:08', '18.00', '', '', 'Phelipe', '2022-04-08 19:08:00', '', 4),
(328, '1098', '', 'Entega', '', 'Especial de Carne', '1', '19:13', '18.00', '', '', 'Phelipe', '2022-04-08 19:13:00', '', 4),
(329, '1098', '', 'Entega', '', 'Especial de Costela', '1', '19:13', '22.00', '', '', 'Phelipe', '2022-04-08 19:13:00', '', 4),
(332, '1099', '', 'Marcio', '', 'Carne', '4', '19:18', '9.00', '', '', 'Phelipe', '2022-04-08 19:18:00', '', 4),
(333, '1099', '', 'Marcio', '', 'Pizza', '1', '19:18', '10.00', '', '', 'Phelipe', '2022-04-08 19:18:00', '', 4),
(334, '1099', '', 'Marcio', '', 'Queijo', '1', '19:19', '9.00', '', '', 'Phelipe', '2022-04-08 19:19:00', '', 4),
(335, '1099', '', 'Marcio', '', 'Coca-Cola 1 LT ', '1', '19:19', '10.00', '', '', 'Phelipe', '2022-04-08 19:19:00', '', 4),
(336, '1099', '', 'Marcio', '', 'Guaraná 2 litros ', '1', '19:20', '10.00', '', '', 'Phelipe', '2022-04-08 19:20:00', '', 4),
(337, '1100', '', 'Erika', '', 'Adicional', '1', '20:17', '3.00', '', '', 'Phelipe', '2022-04-08 20:17:00', '', 4),
(338, '1100', '', 'Erika', '', 'Carne, Ovo, Cebola e Azeitona', '2', '20:17', '12.00', 'Adicional Bacon\r\nTirar Cebola', '', 'Phelipe', '2022-04-08 20:17:00', '', 4),
(339, '1101', '', 'Eduardo', '', 'Duplo Cheddar', '1', '20:17', '12.00', '', '', 'Phelipe', '2022-04-08 20:17:00', '', 4),
(340, '1102', '', 'Sandra', '', 'Schweppes 350ml ', '1', '20:17', '5.00', '', '', 'Phelipe', '2022-04-08 20:17:00', '', 4),
(341, '1101', '', 'Eduardo', '', 'Skol ', '1', '20:18', '5.00', '', '', 'Phelipe', '2022-04-08 20:18:00', '', 4),
(342, '1103', '', 'Seli', '', 'Queijo', '1', '20:19', '9.00', '', '', 'Phelipe', '2022-04-08 20:19:00', '', 4),
(343, '1103', '', 'Seli', '', 'X-Salada', '1', '20:19', '10.00', '', '', 'Phelipe', '2022-04-08 20:19:00', '', 4),
(346, '1105', '', 'Vitoria', '', 'Nutella com Morango', '1', '20:25', '12.00', 'Metade Frango com Cheddar\r\nMetade Nutella com Morango', '', 'Phelipe', '2022-04-08 20:25:00', '', 4),
(347, '1106', '', 'Jenifer', '', 'Beijinho', '1', '20:26', '9.00', '', '', 'Phelipe', '2022-04-08 20:26:00', '', 4),
(348, '1106', '', 'Jenifer', '', 'Frango com Cheddar', '1', '20:26', '10.00', '', '', 'Phelipe', '2022-04-08 20:26:00', '', 4),
(349, '1104', '', 'Sid', '', 'Skol ', '1', '20:27', '5.00', '', '', 'Phelipe', '2022-04-08 20:27:00', '', 4),
(350, '1107', '', 'Carol', '', 'Adicional', '1', '20:35', '3.00', '', '', 'Phelipe', '2022-04-08 20:35:00', '', 4),
(351, '1107', '', 'Carol', '', 'Carne Seca', '1', '20:35', '12.00', 'Mini especial ', '', 'Phelipe', '2022-04-08 20:35:00', '', 4),
(352, '1101', '', 'Eduardo', '', 'Coca-Cola 2ltrs ', '1', '20:36', '12.00', '', '', 'Phelipe', '2022-04-08 20:36:00', '', 4),
(353, '1108', '', 'Cliente', '', 'Adicional', '1', '20:48', '3.00', '', 'Pix', 'Phelipe', '2022-04-08 20:48:00', '', 4),
(354, '1108', '', 'Cliente', '', 'Carne Seca', '1', '20:48', '12.00', 'Mini', 'Pix', 'Phelipe', '2022-04-08 20:48:00', '', 4),
(355, '1108', '', 'Cliente', '', 'Fanta laranja 350 ml ', '1', '20:48', '5.00', '', 'Pix', 'Phelipe', '2022-04-08 20:48:00', '', 4),
(356, '1109', '', 'Erika', '', 'Queijo', '1', '20:52', '9.00', '', 'Dinheiro', 'Phelipe', '2022-04-08 20:52:00', '', 4),
(357, '1106', '', 'Jenifer', '', 'Prestigio', '1', '21:02', '9.00', '', '', 'Phelipe', '2022-04-08 21:02:00', '', 4),
(359, '1104', '', 'Sid', '', 'Costela, Azeitona, Cebola, Queijo', '1', '21:11', '12.00', '', '', 'Phelipe', '2022-04-08 21:11:00', '', 4),
(360, '1102', '', 'Sandra', '', 'Costela, Azeitona, Cebola, Queijo', '1', '21:12', '12.00', '', '', 'Phelipe', '2022-04-08 21:12:00', '', 4),
(361, '1101', '', 'Eduardo', '', 'Mini Chocolate com Banana', '1', '21:15', '5.00', '', '', 'Phelipe', '2022-04-08 21:15:00', '', 4),
(362, '1105', '', 'Vitoria', '', 'Mini Calabresa com Cheddar', '1', '21:18', '5.00', '', '', 'Phelipe', '2022-04-08 21:18:00', '', 4),
(363, '1107', '', 'Carol', '', 'Queijo', '1', '21:57', '9.00', '', '', 'Phelipe', '2022-04-08 21:57:00', '', 4),
(364, '1110', '', 'Cliente', '', 'Chocolate', '1', '22:13', '9.00', '', '', 'Phelipe', '2022-04-08 22:13:00', '', 4),
(365, '1110', '', 'Cliente', '', 'Especial de Carne', '1', '22:13', '18.00', '', '', 'Phelipe', '2022-04-08 22:13:00', '', 4),
(366, '1110', '', 'Cliente', '', 'Especial de Frango', '1', '22:13', '18.00', '', '', 'Phelipe', '2022-04-08 22:13:00', '', 4),
(367, '1111', '', 'Marcelo', '', 'Brahma Duplo Malte ', '1', '20:05', '7.00', '', 'Dinheiro', 'Phelipe', '2022-04-09 20:05:00', '', 4),
(368, '1111', '', 'Marcelo', '', 'Carne Parmegiana', '1', '20:05', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-09 20:05:00', '', 4),
(369, '1111', '', 'Marcelo', '', 'Carne, Ovo, Cebola e Azeitona', '1', '20:05', '12.00', '', 'Dinheiro', 'Phelipe', '2022-04-09 20:05:00', '', 4),
(370, '1111', '', 'Marcelo', '', 'Sukita uva', '1', '20:05', '3.00', '', 'Dinheiro', 'Phelipe', '2022-04-09 20:05:00', '', 4),
(371, '1112', '', 'Jade', '', 'X-Bacon', '2', '20:27', '16.00', '', 'Dinheiro', 'Phelipe', '2022-04-09 20:27:00', '', 4),
(372, '1112', '', 'Jade', '', 'X-Burguer', '1', '20:27', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-09 20:27:00', '', 4),
(373, '1113', '', 'Erika', '', 'Adicional', '2', '20:49', '3.00', '', 'Dinheiro', 'Phelipe', '2022-04-09 20:49:00', '', 4),
(374, '1113', '', 'Erika', '', 'Carne, Ovo, Cebola e Azeitona', '2', '20:49', '12.00', '', 'Dinheiro', 'Phelipe', '2022-04-09 20:49:00', '', 4),
(375, '1114', '', 'Durvalino', '', 'Frango com Catupiry', '1', '21:46', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-09 21:46:00', '', 4),
(376, '1115', '', 'Rogerio', '', 'Coca-Cola 2ltrs ', '1', '22:03', '12.00', '', '', 'Phelipe', '2022-04-09 22:03:00', '', 4),
(377, '1115', '', 'Rogerio', '', 'X-Burguer', '2', '22:03', '10.00', '', '', 'Phelipe', '2022-04-09 22:03:00', '', 4),
(378, '1116', '', 'Talita', '', 'Costela Com Queijo', '1', '22:05', '12.00', '', '', 'Phelipe', '2022-04-09 22:05:00', '', 4),
(379, '1116', '', 'Talita', '', 'Pizza', '1', '22:05', '10.00', '', '', 'Phelipe', '2022-04-09 22:05:00', '', 4),
(380, '1116', '', 'Talita', '', 'Água', '1', '22:05', '3.00', '', '', 'Phelipe', '2022-04-09 22:05:00', '', 4),
(381, '1117', '', 'Mesa', '', 'Brahma Duplo Malte ', '1', '22:12', '7.00', '', '', 'Phelipe', '2022-04-09 22:12:00', '', 4),
(382, '1117', '', 'Mesa', '', 'Costela Com Queijo', '1', '22:14', '12.00', '', '', 'Phelipe', '2022-04-09 22:14:00', '', 4),
(383, '1118', '', 'Damiao', '', 'Carne com Queijo', '1', '23:58', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-09 23:58:00', '', 4),
(384, '1118', '', 'Damiao', '', 'Guaraná 350 ml ', '1', '23:58', '5.00', '', 'Dinheiro', 'Phelipe', '2022-04-09 23:58:00', '', 4),
(385, '1119', '', 'Cliente ', '', 'Coca-Cola 200ml ', '1', '20:16', '3.00', '', 'Dinheiro', 'Phelipe', '2022-04-10 20:16:00', '', 4),
(386, '1120', '', 'Rafael', '', 'Açai 300 ml', '1', '20:18', '18.00', '', 'Cartão Credito', 'Phelipe', '2022-04-10 20:18:00', '', 4),
(387, '1120', '', 'Rafael', '', 'Frango com Catupiry', '1', '20:18', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-10 20:18:00', '', 4),
(388, '1121', '', 'Vinicius', '', 'Calabresa com Cheddar', '1', '20:20', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-10 20:20:00', '', 4),
(389, '1121', '', 'Vinicius', '', 'Coca-Cola 200ml ', '1', '20:20', '3.00', '', 'Cartão Credito', 'Phelipe', '2022-04-10 20:20:00', '', 4),
(390, '1122', '', 'Cliente', '', 'Especial de Frango', '1', '20:29', '18.00', 'Sem Azeitona', 'Dinheiro', 'Phelipe', '2022-04-10 20:29:00', '', 4),
(391, '1123', '', 'Gika', '', 'Costela Com Queijo', '2', '20:47', '12.00', '', 'Dinheiro', 'Phelipe', '2022-04-10 20:47:00', '', 4),
(392, '1123', '', 'Gika', '', 'Especial de Costela', '1', '20:47', '22.00', '', 'Dinheiro', 'Phelipe', '2022-04-10 20:47:00', '', 4),
(393, '1123', '', 'Gika', '', 'Fanta Laranja 2L', '1', '20:47', '10', '', 'Dinheiro', 'Phelipe', '2022-04-10 20:47:00', '', 4),
(394, '1123', '', 'Gika', '', 'Fanta uva 350ml ', '1', '20:47', '6.00', '', 'Dinheiro', 'Phelipe', '2022-04-10 20:47:00', '', 4),
(395, '1123', '', 'Gika', '', 'X-Bacon', '1', '20:47', '16.00', '', 'Dinheiro', 'Phelipe', '2022-04-10 20:47:00', '', 4),
(396, '1123', '', 'Gika', '', 'Mini Queijo', '1', '20:49', '4.50', '', 'Dinheiro', 'Phelipe', '2022-04-10 20:49:00', '', 4),
(397, '1123', '', 'Gika', '', 'Mini Chocolate', '1', '20:49', '4.50', '', 'Dinheiro', 'Phelipe', '2022-04-10 20:49:00', '', 4),
(398, '1124', '', 'Daniela', '', 'Bauru', '1', '21:04', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-10 21:04:00', '', 4),
(399, '1124', '', 'Daniela', '', 'Carne com Queijo', '1', '21:04', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-10 21:04:00', '', 4),
(400, '1124', '', 'Daniela', '', 'Carne Parmegiana', '2', '21:04', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-10 21:04:00', '', 4),
(401, '1124', '', 'Daniela', '', 'Coca-Cola 2ltrs ', '1', '21:04', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-10 21:04:00', '', 4),
(402, '1125', '', 'Rejane', '', 'Açai 300 ml', '1', '21:17', '18.00', 'Fruta Morango\r\nTirar paçoca', 'Dinheiro', 'Phelipe', '2022-04-10 21:17:00', '', 4),
(403, '1125', '', 'Rejane', '', 'Carne com Queijo', '1', '21:17', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-10 21:17:00', '', 4),
(404, '1126', '', 'Katia', '', 'Adicional', '1', '22:03', '3.00', '', 'Pix', 'Phelipe', '2022-04-10 22:03:00', '', 4),
(405, '1126', '', 'Katia', '', 'Carne, Ovo, Cebola e Azeitona', '1', '22:03', '12.00', 'Adicionar Muçarela', 'Pix', 'Phelipe', '2022-04-10 22:03:00', '', 4),
(406, '1126', '', 'Katia', '', 'Kisabor', '1', '22:03', '18.00', '', 'Pix', 'Phelipe', '2022-04-10 22:03:00', '', 4),
(407, '1127', '', 'Cliente', '', 'Skol ', '1', '22:07', '5.00', '', 'Cartão Debito', 'Phelipe', '2022-04-10 22:07:00', '', 4),
(409, '1128', '', 'Guilherme', '', 'Calabresa com Cheddar', '1', '18:57', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-12 18:57:00', '', 4),
(410, '1129', '', 'Beatriz', '', 'Carne, Ovo, Cebola e Azeitona', '1', '20:23', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-12 20:23:00', '', 4),
(411, '1129', '', 'Beatriz', '', 'Costela, Azeitona, Cebola, Queijo', '1', '20:23', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-12 20:23:00', '', 4),
(412, '1129', '', 'Beatriz', '', 'Frango com Catupiry', '1', '20:23', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-12 20:23:00', '', 4),
(413, '1129', '', 'Beatriz', '', 'Frango com Cheddar', '1', '20:23', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-12 20:23:00', '', 4),
(414, '1129', '', 'Beatriz', '', 'Portuguesa', '1', '20:23', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-12 20:23:00', '', 4),
(415, '1129', '', 'Beatriz', '', 'Caipira', '1', '20:23', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-12 20:23:00', '', 4),
(416, '1130', '', 'Andre', '', 'Carne', '2', '20:24', '9.00', '', 'Cartão Credito', 'Phelipe', '2022-04-12 20:24:00', '', 4),
(417, '1130', '', 'Andre', '', 'Pizza', '1', '20:24', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-12 20:24:00', '', 4),
(418, '1130', '', 'Andre', '', 'Coca-Cola 600 ml  ', '1', '20:26', '8.00', '', 'Cartão Credito', 'Phelipe', '2022-04-12 20:26:00', '', 4),
(419, '1131', '', 'Joana', '', 'Carne', '1', '21:28', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-04-12 21:28:00', '', 4),
(420, '1132', '', 'Jhonata', '', 'Especial de Frango', '1', '21:29', '18.00', 'Viajem', 'Cartão Debito', 'Phelipe', '2022-04-12 21:29:00', '', 4),
(421, '1132', '', 'Jhonata', '', 'Coca-Cola 350 ml ', '1', '21:29', '6.00', '', 'Cartão Debito', 'Phelipe', '2022-04-12 21:29:00', '', 4),
(422, '1133', '', 'Phelipe', '1', '3 Queijos', '1', '21:53', '12.00', '', 'Pix', 'Phelipe', '2022-04-12 21:53:00', '', 4),
(423, '1133', '', 'Phelipe', '1', 'Açai 300 ml', '2', '21:53', '18.00', '', 'Pix', 'Phelipe', '2022-04-12 21:53:00', '', 4),
(424, '1133', '', 'Phelipe', '1', 'Carne com Queijo', '1', '21:53', '10.00', '', 'Pix', 'Phelipe', '2022-04-12 21:53:00', '', 4),
(425, '1134', '', 'Rafael', '', 'Fanta Uva 600 ml', '1', '22:06', '7.00', '', 'Cartão Credito', 'Phelipe', '2022-04-12 22:06:00', '', 4),
(426, '1134', '', 'Rafael', '', 'X-Salada', '1', '22:06', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-12 22:06:00', '', 4),
(427, '1135', '', 'Alexandre', '', 'Calabresa com Queijo', '1', '18:19', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-13 18:19:00', '', 4),
(428, '1135', '', 'Alexandre', '', 'Carne com Queijo', '1', '18:19', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-13 18:19:00', '', 4),
(429, '1135', '', 'Alexandre', '', 'Pizza', '1', '18:19', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-13 18:19:00', '', 4),
(430, '1136', '', 'Taylon', '', 'Costela Com Catupiry', '1', '19:36', '12.00', '', '', 'Phelipe', '2022-04-13 19:36:00', '', 4),
(431, '1136', '', 'Taylon', '', 'Costela, Azeitona, Cebola, Queijo', '1', '19:36', '12.00', '', '', 'Phelipe', '2022-04-13 19:36:00', '', 4),
(432, '1136', '', 'Taylon', '', 'Coca-Cola 600 ml  ', '1', '19:40', '8.00', '', '', 'Phelipe', '2022-04-13 19:40:00', '', 4),
(433, '1137', '', 'Joaquim', '', 'Guaraná 200 ml ', '1', '22:55', '3.00', '', 'Cartão Debito', 'Phelipe', '2022-04-13 22:55:00', '', 4),
(434, '1137', '', 'Joaquim', '', 'Pizza', '1', '22:55', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-13 22:55:00', '', 4),
(435, '1137', '', 'Joaquim', '', 'Schweppes 350ml ', '1', '22:55', '5.00', '', 'Cartão Debito', 'Phelipe', '2022-04-13 22:55:00', '', 4),
(436, '1137', '', 'Joaquim', '', 'X-Bacon', '1', '22:55', '16.00', '', 'Cartão Debito', 'Phelipe', '2022-04-13 22:55:00', '', 4),
(437, '1138', '', 'Vizinho', '', 'Caipira', '1', '23:01', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-13 23:01:00', '', 4),
(438, '1138', '', 'Vizinho', '', 'Costela Com Queijo', '1', '23:01', '12.00', '', 'Dinheiro', 'Phelipe', '2022-04-13 23:01:00', '', 4),
(439, '1138', '', 'Vizinho', '', 'Pizza', '1', '23:01', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-13 23:01:00', '', 4),
(440, '1139', '', 'Cliente', '', 'Água', '2', '23:36', '3.00', '', 'Dinheiro', 'Phelipe', '2022-04-13 23:36:00', '', 4),
(441, '1139', '', 'Cliente', '', 'Kisabor', '1', '23:36', '18.00', '', 'Dinheiro', 'Phelipe', '2022-04-13 23:36:00', '', 4),
(442, '1140', '', 'Manoel', '', 'Carne', '1', '19:33', '9.00', '', 'Cartão Credito', 'Phelipe', '2022-04-14 19:33:00', '', 4),
(443, '1140', '', 'Manoel', '', 'Fanta Uva 600 ml', '1', '19:33', '7.00', '', 'Cartão Credito', 'Phelipe', '2022-04-14 19:33:00', '', 4),
(445, '1140', '', 'Manoel', '', 'Queijo', '2', '19:44', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-14 19:44:00', '', 4),
(446, '1141', '', 'Robson', '', 'Carne, Ovo, Cebola e Azeitona', '1', '20:10', '12.00', '', 'Pix', 'Phelipe', '2022-04-14 20:10:00', '', 4),
(447, '1141', '', 'Robson', '', 'Heineken 330 ml ', '1', '20:10', '10.00', '', 'Pix', 'Phelipe', '2022-04-14 20:10:00', '', 4),
(448, '1142', '', 'Cristiane', '', 'Carne', '1', '21:02', '9.00', '', 'Dinheiro', 'Phelipe', '2022-04-14 21:02:00', '', 4),
(449, '1143', '', 'Big', '', 'Kisabor', '1', '21:07', '18.00', '', 'Dinheiro', 'Phelipe', '2022-04-14 21:07:00', '', 4),
(450, '1143', '', 'Big', '', 'Skol ', '1', '21:09', '5.00', '', 'Dinheiro', 'Phelipe', '2022-04-14 21:09:00', '', 4),
(452, '1144', '', 'Phelipe', '', 'Carne, Ovo, Cebola e Azeitona', '3', '22:43', '12.00', '', 'Cartão Credito', 'Phelipe', '2022-04-14 22:43:00', '', 4),
(453, '1144', '', 'Phelipe', '', 'Queijo', '1', '22:43', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-14 22:43:00', '', 4),
(454, '1145', '', 'Luzia', '', 'Batata 250g', '1', '23:11', '17.00', '', 'Cartão Debito', 'Phelipe', '2022-04-14 23:11:00', '', 4),
(455, '1145', '', 'Luzia', '', 'Gourmet Bacon', '1', '23:11', '24.00', '', 'Cartão Debito', 'Phelipe', '2022-04-14 23:11:00', '', 4),
(456, '1145', '', 'Luzia', '', 'X-Calabresa', '1', '23:11', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-14 23:11:00', '', 4),
(457, '1146', '', 'Cliente', '', 'Brahma Duplo Malte ', '2', '23:22', '7.00', '', 'Cartão Debito', 'Phelipe', '2022-04-14 23:22:00', '', 4),
(458, '1147', '', 'Cliente 2', '', 'Brahma Duplo Malte ', '2', '23:22', '7.00', '', 'Cartão Debito', 'Phelipe', '2022-04-14 23:22:00', '', 4),
(459, '1147', '', 'Cliente 2', '', 'Coca-Cola 2ltrs ', '1', '23:22', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-14 23:22:00', '', 4),
(460, '1144', '', 'Phelipe', '', 'Fanta uva 350ml ', '1', '23:55', '6.00', '', 'Cartão Credito', 'Phelipe', '2022-04-14 23:55:00', '', 4),
(461, '1148', '', 'Vizinha ', '', 'Especial de Frango', '2', '19:00', '18.00', '', 'Cartão Credito', 'Phelipe', '2022-04-15 19:00:00', '', 4),
(462, '1148', '', 'Vizinha ', '', 'Especial de Carne', '1', '19:01', '18.00', '', 'Cartão Credito', 'Phelipe', '2022-04-15 19:01:00', '', 4),
(463, '1149', '', 'Erika', '', 'Bauru', '1', '20:06', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-15 20:06:00', '', 4),
(464, '1149', '', 'Erika', '', 'Carne, Ovo, Cebola e Azeitona', '1', '20:06', '12.00', 'Sem Azeitona, Cebola\r\nAcrescentar Queijo', 'Dinheiro', 'Phelipe', '2022-04-15 20:06:00', '', 4),
(466, '1150', '', 'Jady', '', 'Bauru', '1', '20:12', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-15 20:12:00', '', 4),
(467, '1150', '', 'Jady', '', 'Portuguesa', '1', '20:12', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-15 20:12:00', '', 4),
(468, '1150', '', 'Jady', '', 'X-Burguer', '1', '20:12', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-15 20:12:00', '', 4),
(469, '1151', '', 'Jady', '', 'Pizza', '1', '21:12', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-15 21:12:00', '', 4),
(470, '1152', '', 'Aline', '', 'Brahma Duplo Malte ', '1', '22:04', '6.00', '', 'Dinheiro', 'Phelipe', '2022-04-15 22:04:00', '', 4),
(472, '1153', '', 'Josimar', '1', 'Especial de Carne', '1', '22:12', '18.00', '', 'Cartão Debito', 'Phelipe', '2022-04-15 22:12:00', '', 4),
(473, '1153', '', 'Josimar', '', 'Avalanche', '1', '22:12', '28.00', '', 'Cartão Debito', 'Phelipe', '2022-04-15 22:12:00', '', 4),
(474, '1153', '', 'Josimar', '', 'X-Salada', '1', '22:12', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-15 22:12:00', '', 4),
(475, '1153', '', 'Josimar', '', 'Guaraná 1ltr ', '1', '22:14', '8.00', '', 'Cartão Debito', 'Phelipe', '2022-04-15 22:14:00', '', 4),
(476, '1152', '', 'Aline', '', 'Carne com Queijo', '1', '22:20', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-15 22:20:00', '', 4),
(477, '1154', '', 'Jeferson', '2', 'Pizza', '1', '22:29', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-15 22:29:00', '', 4),
(479, '1154', '', 'Jeferson', '', 'Coca-Cola 350 ml ', '1', '22:29', '6.00', '', 'Dinheiro', 'Phelipe', '2022-04-15 22:29:00', '', 4),
(480, '1144', '', 'Phelipe', '', '3 Queijos', '1', '23:56', '12.00', '', 'Cartão Credito', 'Phelipe', '2022-04-15 23:56:00', '', 4),
(481, '1144', '', 'Phelipe', '', 'Fanta uva 350ml ', '1', '23:56', '6.00', '', 'Cartão Credito', 'Phelipe', '2022-04-15 23:56:00', '', 4),
(482, '1144', '', 'Phelipe', '', 'Calabresa', '1', '00:04', '9.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 00:04:00', '', 4),
(483, '1144', '', 'Phelipe', '', 'Carne com Queijo', '2', '00:04', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 00:04:00', '', 4),
(484, '1144', '', 'Phelipe', '', 'Coca-Cola 350 ml ', '1', '00:04', '6.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 00:04:00', '', 4),
(485, '1144', '', 'Phelipe', '', 'Sukita uva', '1', '00:04', '3.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 00:04:00', '', 4),
(490, '1144', '', 'Phelipe', '', 'Coca-Cola 350 ml ', '1', '00:07', '6.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 00:07:00', '', 4),
(491, '1155', '', 'Adriana', '', 'Fanta laranja 350 ml ', '1', '00:13', '5.00', '', 'Pix', 'Phelipe', '2022-04-16 00:13:00', '', 4),
(492, '1155', '', 'Adriana', '', 'Frango com Queijo', '1', '00:13', '10.00', '', 'Pix', 'Phelipe', '2022-04-16 00:13:00', '', 4),
(494, '1155', '', 'Adriana', '', 'Sufresh Guaraná', '2', '00:14', '5.50', '', 'Pix', 'Phelipe', '2022-04-16 00:14:00', '', 4),
(495, '1156', '', 'Leticia', '', 'Bauru', '1', '19:18', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-16 19:18:00', '', 4),
(497, '1156', '', 'Leticia', '', 'Pizza', '1', '19:18', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-16 19:18:00', '', 4),
(498, '1156', '', 'Leticia', '', 'Queijo com Milho', '1', '19:19', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-16 19:19:00', '', 4),
(500, '1157', '', 'Camila', '', 'Queijo com Milho', '1', '19:22', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 19:22:00', '', 4),
(501, '1158', '', 'Marcio', '', 'Calabresa', '1', '19:33', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 19:33:00', '', 4),
(502, '1158', '', 'Marcio', '', 'Pizza', '2', '19:33', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 19:33:00', '', 4),
(503, '1158', '', 'Marcio', '', 'Mini especial Carne', '1', '19:33', '15.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 19:33:00', '', 4),
(504, '1157', '', 'Camila', '', 'Mini especial Costela ', '1', '19:38', '15.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 19:38:00', '', 4),
(505, '1159', '', 'Tomaz', '', 'Carne com Queijo', '1', '20:23', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-16 20:23:00', '', 4),
(506, '1157', '', 'Camila', '', 'Churruinhos', '2', '20:24', '4.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 20:24:00', '', 4),
(507, '1160', '', 'Dario', '', 'Calabresa', '1', '20:29', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 20:29:00', '', 4),
(508, '1160', '', 'Dario', '', 'Carne com Queijo', '1', '20:29', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 20:29:00', '', 4),
(509, '1160', '', 'Dario', '', 'Carne Parmegiana', '1', '20:29', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 20:29:00', '', 4),
(510, '1161', '', 'Andre', '', 'Carne', '1', '20:48', '9.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 20:48:00', '', 4),
(511, '1161', '', 'Andre', '', 'Carne com Queijo', '1', '20:48', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 20:48:00', '', 4),
(512, '1161', '', 'Andre', '', 'Heineken 330 ml ', '1', '20:48', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 20:48:00', '', 4),
(513, '1161', '', 'Andre', '', 'Pizza', '1', '20:48', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 20:48:00', '', 4),
(514, '1162', '', 'Thiago', '', 'Carne com Queijo', '2', '21:02', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:02:00', '', 4),
(515, '1162', '', 'Thiago', '', 'Pizza', '1', '21:02', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:02:00', '', 4),
(516, '1162', '', 'Thiago', '', 'Mini especial Carne com Queijo', '1', '21:07', '15.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:07:00', '', 4),
(517, '1162', '', 'Thiago', '', 'Água com gás ', '1', '21:08', '4.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:08:00', '', 4),
(518, '1163', '', 'Ricardo', '', 'Bauru', '2', '21:21', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:21:00', '', 4),
(519, '1163', '', 'Ricardo', '', 'Churruinhos', '1', '21:21', '4.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:21:00', '', 4),
(520, '1163', '', 'Ricardo', '', 'Coca-Cola 600 ml  ', '1', '21:21', '8.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:21:00', '', 4),
(521, '1163', '', 'Ricardo', '', 'Especial de Frango', '1', '21:21', '18.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:21:00', '', 4),
(522, '1164', '', 'Joaquim', '', 'X-Bacon', '1', '21:26', '16.00', '', 'Dinheiro', 'Phelipe', '2022-04-16 21:26:00', '', 4),
(523, '1165', '', 'Eduardo', '', 'Mini especial Carne, Ovo, Cebola e Azeitona', '1', '21:31', '15.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:31:00', '', 4),
(526, '1166', '', 'Sandra', '', 'Mini Queijo com Milho', '1', '21:33', '5.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 21:33:00', '', 4),
(529, '1168', '', 'Vitoria', '', 'Mini Frango com Cheddar', '1', '21:37', '5.00', '', 'Dinheiro', 'Phelipe', '2022-04-16 21:37:00', '', 4),
(530, '1168', '', 'Vitoria', '', 'Mini Nutella com Morango', '1', '21:37', '6.00', '', 'Dinheiro', 'Phelipe', '2022-04-16 21:37:00', '', 4),
(531, '1166', '', 'Sandra', '', 'Coca-Cola 200ml ', '1', '21:39', '3.00', '', 'Cartão Credito', 'Phelipe', '2022-04-16 21:39:00', '', 4),
(532, '1169', '', 'Carol ', '', 'X-Burguer', '1', '21:40', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:40:00', '', 4),
(533, '1165', '', 'Eduardo', '', 'Coca-Cola 2ltrs ', '1', '21:45', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 21:45:00', '', 4),
(536, '1164', '', 'Joaquim', '', 'Schweppes 350ml ', '1', '22:32', '5.00', '', 'Dinheiro', 'Phelipe', '2022-04-16 22:32:00', '', 4),
(537, '1170', '', 'Seli', '', 'Carne', '1', '22:43', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 22:43:00', '', 4),
(538, '1170', '', 'Seli', '', 'Especial de Carne', '1', '22:43', '18.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 22:43:00', '', 4),
(539, '1170', '', 'Seli', '', 'Queijo', '1', '22:43', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 22:43:00', '', 4);
INSERT INTO `pedido` (`idpedido`, `numeropedido`, `delivery`, `cliente`, `idmesa`, `produto`, `quantidade`, `hora_pedido`, `valor`, `observacao`, `pgto`, `usuario`, `data`, `gorjeta`, `status`) VALUES
(540, '1170', '', 'Seli', '', 'Guaraná 1ltr ', '1', '22:44', '8.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 22:44:00', '', 4),
(541, '1169', '', 'Carol ', '', 'Prestigio', '1', '22:47', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 22:47:00', '', 4),
(542, '1169', '', 'Carol ', '', 'Mini Frango com Queijo', '1', '22:47', '5.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 22:47:00', '', 4),
(543, '1169', '', 'Carol ', '', 'Duplo Cheddar', '1', '22:48', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-16 22:48:00', '', 4),
(545, '1172', '', 'Cliente', '', 'Água', '2', '23:09', '3.00', '', 'Dinheiro', 'Phelipe', '2022-04-16 23:09:00', '', 4),
(546, '1173', '', 'Robson', '', 'Especial de Carne', '1', '20:15', '18.00', '', 'Pix', 'Phelipe', '2022-04-19 20:15:00', '', 4),
(547, '1174', '', 'Joana', '', 'Coca-Cola 220 ml', '1', '20:19', '4.00', '', '', 'Phelipe', '2022-04-19 20:19:00', '', 4),
(548, '1174', '', 'Joana', '', 'Frango com Queijo', '1', '20:19', '10.00', '', '', 'Phelipe', '2022-04-19 20:19:00', '', 4),
(549, '1175', '', 'Lorane', '', 'Coca-Cola 200ml ', '1', '20:20', '3.00', '', 'Cartão Debito', 'Phelipe', '2022-04-19 20:20:00', '', 4),
(550, '1175', '', 'Lorane', '', 'Costela Com Queijo', '1', '20:20', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-19 20:20:00', '', 4),
(551, '1173', '', 'Robson', '', 'Carne com Queijo', '1', '20:33', '10.00', '', 'Pix', 'Phelipe', '2022-04-19 20:33:00', '', 4),
(552, '1173', '', 'Robson', '', 'Coca-Cola 2ltrs ', '1', '21:01', '12.00', '', 'Pix', 'Phelipe', '2022-04-19 21:01:00', '', 4),
(553, '1176', '', 'Jonatan', '', 'Avalanche', '1', '21:09', '28.00', '', 'Cartão Debito', 'Phelipe', '2022-04-19 21:09:00', '', 4),
(554, '1176', '', 'Jonatan', '', 'Carne com Catupiry', '1', '21:09', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-19 21:09:00', '', 4),
(555, '1176', '', 'Jonatan', '', 'Costela Com Cheddar', '1', '21:10', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-19 21:10:00', '', 4),
(556, '1176', '', 'Jonatan', '', 'Guaraná 2 litros ', '1', '21:10', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-19 21:10:00', '', 4),
(557, '1177', '', 'Sthefanie', '', 'Carne com Cheddar', '1', '21:17', '10.00', '', 'Pix', 'Phelipe', '2022-04-19 21:17:00', '', 4),
(558, '1177', '', 'Sthefanie', '', 'X-Bacon', '1', '21:17', '16.00', '', 'Pix', 'Phelipe', '2022-04-19 21:17:00', '', 4),
(559, '1177', '', 'Sthefanie', '', 'X-Salada', '1', '21:17', '10.00', '', 'Pix', 'Phelipe', '2022-04-19 21:17:00', '', 4),
(560, '1173', '', 'Robson', '', 'Carne com Queijo', '1', '21:57', '10.00', '', 'Pix', 'Phelipe', '2022-04-19 21:57:00', '', 4),
(561, '1178', '', 'Patricia', '', 'Brocólis com Queijo', '1', '22:45', '9.00', '', 'Cartão Debito', 'Phelipe', '2022-04-19 22:45:00', '', 4),
(562, '1178', '', 'Patricia', '', 'Carne Parmegiana', '1', '22:45', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-19 22:45:00', '', 4),
(563, '1178', '', 'Patricia', '', 'Costela Com Queijo', '1', '22:45', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-19 22:45:00', '', 4),
(564, '1179', '', 'Patricia', '', 'Coca-Cola 1 LT ', '1', '22:56', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-19 22:56:00', '', 4),
(565, '1180', '', 'Andre', '', 'Guaraná 350 ml ', '1', '23:07', '5.00', '', 'Dinheiro', 'Phelipe', '2022-04-19 23:07:00', '', 4),
(567, '1181', '', 'Cliente', '', 'Coca-Cola 600 ml  ', '1', '19:03', '8.00', '', 'Cartão Credito', 'Phelipe', '2022-04-20 19:03:00', '', 4),
(568, '1181', '', 'Cliente', '', 'Costela Com Catupiry', '1', '19:03', '12.00', '', 'Cartão Credito', 'Phelipe', '2022-04-20 19:03:00', '', 4),
(569, '1181', '', 'Cliente', '', 'Especial Vegetariano', '1', '19:03', '18.00', '', 'Cartão Credito', 'Phelipe', '2022-04-20 19:03:00', '', 4),
(570, '1181', '', 'Cliente', '', 'Adicional', '1', '19:08', '2.00', '', 'Cartão Credito', 'Phelipe', '2022-04-20 19:08:00', '', 4),
(571, '1182', '', 'Claiton', '', 'Costela Com Queijo', '1', '20:25', '12.00', '', 'Cartão Credito', 'Phelipe', '2022-04-20 20:25:00', '', 4),
(572, '1182', '', 'Claiton', '', 'Salame com Queijo', '1', '20:25', '10.00', '', 'Cartão Credito', 'Phelipe', '2022-04-20 20:25:00', '', 4),
(573, '1183', '', 'Jeferson', '', 'Carne', '2', '21:00', '9.00', '', 'Cartão Credito', 'Phelipe', '2022-04-20 21:00:00', '', 4),
(574, '1184', '', 'cliente santana ', '', 'Costela Com Queijo', '2', '21:29', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-20 21:29:00', '', 4),
(575, '1184', '', 'cliente santana ', '', 'Carne com Cheddar', '1', '21:30', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-20 21:30:00', '', 4),
(576, '1184', '', 'cliente santana ', '', 'Carne com Queijo', '1', '21:30', '10.00', '', 'Cartão Debito', 'Phelipe', '2022-04-20 21:30:00', '', 4),
(577, '1184', '', 'cliente santana ', '', 'Coca-Cola 2ltrs ', '1', '21:36', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-20 21:36:00', '', 4),
(578, '1185', '', 'Alex', '', 'Costela Com Cheddar', '3', '22:15', '12.00', '', 'Cartão Debito', 'Phelipe', '2022-04-20 22:15:00', '', 4),
(579, '1185', '', 'Alex', '', 'Frete', '1', '22:15', '3.00', '', 'Cartão Debito', 'Phelipe', '2022-04-20 22:15:00', '', 4),
(580, '1186', '', 'Anderson ', '', 'Água com gás ', '1', '23:17', '4.00', '', 'Dinheiro', 'Phelipe', '2022-04-20 23:17:00', '', 4),
(581, '1187', '', 'Felipe', '1', 'Atum, Azeitona e Cebola', '1', '23:19', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-20 23:19:00', '', 4),
(582, '1187', '', 'Felipe', '1', 'Frango com Catupiry', '1', '23:19', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-20 23:19:00', '', 4),
(583, '1187', '', 'Felipe', '1', 'Frango com Queijo', '1', '23:19', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-20 23:19:00', '', 4),
(584, '1187', '', 'Felipe', '1', 'Guaraná 2 litros ', '1', '23:19', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-20 23:19:00', '', 4),
(585, '1187', '', 'Felipe', '1', 'Pizza', '1', '23:19', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-20 23:19:00', '', 4),
(586, '1188', '', 'Gustavo', '', 'Costela, Azeitona, Cebola, Queijo', '1', '23:53', '12.00', 'Pouca Azeitona', 'Dinheiro', 'Phelipe', '2022-04-20 23:53:00', '', 4),
(587, '1188', '', 'Gustavo', '', 'Caipira', '1', '23:58', '10.00', '', 'Dinheiro', 'Phelipe', '2022-04-20 23:58:00', '', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `detalhes` varchar(255) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `preco_custo` varchar(100) NOT NULL DEFAULT '0.00',
  `preco_venda` varchar(100) NOT NULL DEFAULT '0.00',
  `estoque_atual` char(100) NOT NULL,
  `estoque_minimo` char(100) NOT NULL,
  `data_compra` varchar(100) NOT NULL,
  `data_validade` varchar(100) NOT NULL,
  `unidade` varchar(100) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `fornecedor` varchar(255) NOT NULL,
  `observacoes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria`, `detalhes`, `codigo`, `preco_custo`, `preco_venda`, `estoque_atual`, `estoque_minimo`, `data_compra`, `data_validade`, `unidade`, `marca`, `fornecedor`, `observacoes`) VALUES
(1, '3 Queijos', 'PASTEL', '3 Queijos', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(2, 'Atum, Azeitona e Cebola', 'PASTEL', 'Atum', '', '0.00', '10.00', '', '', '', '', '', '', '', NULL),
(3, 'Bauru', 'PASTEL', 'Bauru', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(4, 'Brocólis', 'PASTEL', 'Brocólis', '', '0.00', '9.00', '', '', '', '', '', '', '', ''),
(5, 'Brocólis com Catupity', 'PASTEL', 'Brocólis', '', '0.00', '9.00', '', '', '', '', '', '', '', NULL),
(6, 'Brocólis com Queijo', 'PASTEL', 'Brocólis', '', '0.00', '9.00', '', '', '', '', '', '', '', NULL),
(7, 'Caipira', 'PASTEL', 'Caipira', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(8, 'Calabresa', 'PASTEL', 'Calabresa', '', '0.00', '9.00', '', '', '', '', '', '', '', ''),
(9, 'Calabresa com Cheddar', 'PASTEL', 'Calabresa com Cheddar', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(10, 'Calabresa com Catupity', 'PASTEL', 'Calabresa', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(11, 'Calabresa com Queijo', 'PASTEL', 'Calabresa', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(12, 'Carne', 'PASTEL', 'Carne', '', '0.00', '9.00', '', '', '', '', '', '', '', ''),
(13, 'Carne com Catupiry', 'PASTEL', 'Carne', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(14, 'Carne com Cheddar', 'PASTEL', 'Carne', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(15, 'Carne com Queijo', 'PASTEL', 'Carne', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(16, 'Carne Parmegiana', 'PASTEL', 'Carne', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(17, 'Carne Seca com Queijo', 'PASTEL', 'Carne Seca', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(18, 'Carne Seca com Catupiry', 'PASTEL', 'Carne Seca', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(19, 'Carne Seca com Cheddar', 'PASTEL', 'Carne Seca', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(21, 'Carne, Ovo, Cebola e Azeitona', 'PASTEL', 'Carne', '', '0.00', '12.00', '', '', '', '', '', '', '', NULL),
(22, 'Costela', 'PASTEL', 'Costela', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(23, 'Costela Com Catupiry', 'PASTEL', 'Costela', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(24, 'Costela Com Cheddar', 'PASTEL', 'Costela', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(25, 'Costela Com Queijo', 'PASTEL', 'Costela', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(26, 'Costela, Azeitona, Cebola, Queijo', 'PASTEL', 'Costela', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(27, 'Escarola', 'PASTEL', 'Escarola', '', '0.00', '9.00', '', '', '', '', '', '', '', ''),
(28, 'Escarola com Catupiry', 'PASTEL', 'Escarola', '', '0.00', '9.00', '', '', '', '', '', '', '', NULL),
(29, 'Escarola com Queijo', 'PASTEL', 'Escarola', '', '0.00', '9.00', '', '', '', '', '', '', '', NULL),
(30, 'Frango', 'PASTEL', 'Frango', '', '0.00', '9.00', '', '', '', '', '', '', '', ''),
(31, 'Frango com Catupiry', 'PASTEL', 'Frango', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(32, 'Frango com Cheddar', 'PASTEL', 'Frango', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(33, 'Frango com Queijo', 'PASTEL', 'Frango', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(34, 'Palmito', 'PASTEL', 'Palmito', '', '0.00', '9.00', '', '', '', '', '', '', '', ''),
(35, 'Palmito com Catupity', 'PASTEL', 'Palmito', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(36, 'Palmito com Queijo', 'PASTEL', 'Palmito', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(37, 'Pizza', 'PASTEL', 'Pizza', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(38, 'Portuguesa', 'PASTEL', 'Portuguesa', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(39, 'Queijo', 'PASTEL', 'Queijo', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(40, 'Queijo com Milho', 'PASTEL', 'Queijo', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(41, 'Salame com Queijo', 'PASTEL', 'Salame', '', '0.00', '10.00', '', '', '', '', '', '', '', NULL),
(42, 'Vegetariano', 'PASTEL', 'Vegetariano', '', '0.00', '10.00', '', '', '', '', '', '', '', NULL),
(43, 'Banana com Canela', 'PASTEL DOCE', 'Banana', '', '0.00', '9.00', '', '', '', '', '', '', '', ''),
(44, 'Beijinho', 'PASTEL DOCE', 'Doce de leite', '', '0.00', '9.00', '', '', '', '', '', '', '', NULL),
(45, 'Chocolate', 'PASTEL DOCE', 'Chocolate', '', '0.00', '9.00', '', '', '', '', '', '', '', ''),
(46, 'Chocolate com Banana', 'PASTEL DOCE', 'Chocolate', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(47, 'Chocolate com Morango', 'PASTEL DOCE', 'Chocolate', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(48, 'Chocolate, Morango e Banana', 'PASTEL DOCE', 'Chocolate', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(49, 'Doce de leite', 'PASTEL DOCE', 'Doce de leite', '', '0.00', '9.00', '', '', '', '', '', '', '', ''),
(50, 'Doce de leite com Banana', 'PASTEL DOCE', 'Doce de leite', '', '0.00', '9.00', '', '', '', '', '', '', '', NULL),
(51, 'Doce de leite com Banana e paçoca', 'PASTEL DOCE', 'Doce de leite', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(52, 'Nutella com Morango', 'PASTEL DOCE', 'Doce de leite', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(53, 'Prestigio', 'PASTEL DOCE', 'Doce de leite', '', '0.00', '9.00', '', '', '', '', '', '', '', NULL),
(54, 'Romeu e Julieta', 'PASTEL DOCE', 'Doce de leite', '', '0.00', '9.00', '', '', '', '', '', '', '', NULL),
(55, 'Especial das Coleguinhas', 'PASTEL ESPECIAL', 'Especial das Coleguinhas', '', '0.00', '24.00', '', '', '', '', '', '', '', ''),
(56, 'Especial de Carne', 'PASTEL ESPECIAL', 'Especial de Carne', '', '0.00', '18.00', '', '', '', '', '', '', '', NULL),
(57, 'Especial de Carne Seca', 'PASTEL ESPECIAL', 'Especial de Carne Seca', '', '0.00', '24.00', '', '', '', '', '', '', '', NULL),
(58, 'Especial de Costela', 'PASTEL ESPECIAL', 'Especial de Costela', '', '0.00', '22.00', '', '', '', '', '', '', '', NULL),
(59, 'Especial de Frango', 'PASTEL ESPECIAL', 'Especial de Frango', '', '0.00', '18.00', '', '', '', '', '', '', '', NULL),
(60, 'Especial de Pizza', 'PASTEL ESPECIAL', 'Especial de Pizza', '', '0.00', '18.00', '', '', '', '', '', '', '', NULL),
(61, 'Especial Vegetariano', 'PASTEL ESPECIAL', 'Especial Vegetariano', '', '0.00', '18.00', '', '', '', '', '', '', '', NULL),
(62, 'Avalanche', 'LANCHE', 'Pão de hamburguer, hamburguer artesanal, queijo, presunto, molho especial, alface, tomate, maiose da casa', '', '0.00', '28.00', '', '', '', '', '', '', '', NULL),
(63, 'Burguer picante', 'LANCHE', 'Pão de hamburguer, hamburguer artesanal, duas fatias de queijo cheddar, molho picante, alfaçe, cebola, tomate e maionese da casa', '', '0.00', '22.00', '', '', '', '', '', '', '', NULL),
(64, 'Burguer up', 'LANCHE', 'Pão de hamburguer, hamburguer artesanal, duas fatias de queijo prato, alfaçe, tomate, cebola, caramelizada, molho especial, e maionese da casa', '', '0.00', '20.00', '', '', '', '', '', '', '', NULL),
(65, 'Costela burguer', 'LANCHE', 'Pão de hamburguer, costela desfiada, cebola caramelizada, queijo cheddar, molho especial, bacon, alface, tomate e maionese da casa', '', '0.00', '30.00', '', '', '', '', '', '', '', NULL),
(66, 'Duplo Cheddar', 'LANCHE', 'Pão de hamburguer, hamburguer artesanal e duas fatias de queijo cheddar', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(67, 'Gourmet Bacon', 'LANCHE', 'Pão de hamburguer, hamburguer artesanal, duas fatias de queijo prato, bacon, alfaçe, tomate e moionese da casa', '', '0.00', '24.00', '', '', '', '', '', '', '', NULL),
(68, 'Kisabor', 'LANCHE', 'Pão de hamburguer, hamburguer artesanal, duas fatias de queijo cheddar, bacon, alfaçe, cebola caramelisadas, tomate e maionese da casa', '', '0.00', '18.00', '', '', '', '', '', '', '', NULL),
(69, 'X-Salada', 'LANCHE', 'Pão de hamburguer, hamburguer artesanal, maione da casa, queijo, alface e tomate', '', '0.00', '10.00', '', '', '', '', '', '', '', NULL),
(70, 'Água', 'REFRIGERANTES', '', '', '0.00', '3.00', '1', '5', '', '', '', '', '', ''),
(71, 'Água com gás ', 'REFRIGERANTES', '', '', '0.00', '4.00', '0', '3', '', '', '', '', '', ''),
(72, 'Coca-Cola 1 LT ', 'REFRIGERANTES', '', '', '0.00', '10.00', '-3', '4', '', '', '', '', '', ''),
(73, 'Coca-Cola 200ml ', 'REFRIGERANTES', '', '', '0.00', '3.00', '', '', '', '', '', '', '', NULL),
(74, 'Coca-Cola 2ltrs ', 'REFRIGERANTES', '', '', '0.00', '12.00', '-8', '4', '', '', '', '', '', ''),
(75, 'Coca-Cola 350 ml ', 'REFRIGERANTES', '', '', '0.00', '6.00', '3', '6', '', '', '', '', '', ''),
(76, 'Coca-Cola 600 ml  ', 'REFRIGERANTES', '', '', '0.00', '8.00', '-6', '4', '', '', '', '', '', ''),
(77, 'Fanta laranja 1.5 ltrs ', 'REFRIGERANTES', '', '', '0.00', '8.50', '2', '3', '', '', '', '', '', ''),
(78, 'Fanta laranja 350 ml ', 'REFRIGERANTES', '', '', '0.00', '5.00', '7', '6', '', '', '', '', '', ''),
(79, 'Fanta uva 350ml ', 'REFRIGERANTES', '', '', '0.00', '6.00', '0', '6', '', '', '', '', '', ''),
(80, 'Guaraná 1ltr ', 'REFRIGERANTES', '', '', '0.00', '8.00', '1', '3', '', '', '', '', '', ''),
(81, 'Guaraná 2 litros ', 'REFRIGERANTES', '', '', '0.00', '10.00', '-4', '4', '', '', '', '', '', ''),
(82, 'Guaraná 200 ml ', 'REFRIGERANTES', '', '', '0.00', '3.00', '', '', '', '', '', '', '', NULL),
(83, 'Guaraná 350 ml ', 'REFRIGERANTES', '', '', '0.00', '5.00', '5', '6', '', '', '', '', '', ''),
(84, 'Schweppes 350ml ', 'REFRIGERANTES', '', '', '0.00', '5.00', '2', '3', '', '', '', '', '', ''),
(85, 'Tônica 350 ml ', 'REFRIGERANTES', '', '', '0.00', '5.00', '4', '3', '', '', '', '', '', ''),
(86, 'Brahma Duplo Malte ', 'CERVEJAS ', '', '', '0.00', '7.00', '-2', '5', '', '', '', '', '', ''),
(87, 'Budweiser ', 'CERVEJAS ', '', '', '0.00', '5.50', '2', '3', '', '', '', '', '', ''),
(88, 'Heineken 330 ml ', 'CERVEJAS ', '', '', '0.00', '10.00', '-6', '6', '', '', '', '', '', ''),
(89, 'Itaipava ', 'CERVEJAS ', '', '', '0.00', '4.00', '4', '6', '', '', '', '', '', ''),
(90, 'Skol ', 'CERVEJAS ', '', '', '0.00', '5.00', '-1', '5', '', '', '', '', '', ''),
(91, 'Carne Seca', 'PASTEL', 'Carne Seca', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(92, 'X-Burguer', 'LANCHE', 'Pão de hamburguer, hamburguer artesanal e queijo', '', '0.00', '10.00', '', '', '', '', '', '', '', ''),
(93, 'X-Bacon', 'LANCHE', 'Pão de hamburguer, hamburguer artesanal, queijo cheddar, molho especial, alface, tomate, bacon, ovo, e maionese da casa', '', '0.00', '16.00', '', '', '', '', '', '', '', NULL),
(94, 'X-Calabresa', 'LANCHE', 'Pão Frances, calabresa fatiada, maionese da casa, cebola caramelizada, queijo, ovo, tomate e alface', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(95, 'X-Frango', 'LANCHE', 'Pão Frances, maionese da casa, frango desfiado, queijo, alface e tomate', '', '0.00', '12.00', '', '', '', '', '', '', '', ''),
(96, 'X-Coleguinhas', 'LANCHE', 'Pão de hamburgue, maionese da casa, dois hamburguer artesanal, queijo cheddar, cebola caramelizada, batata palha, molho especial, alface e tomate', '', '0.00', '26.00', '', '', '', '', '', '', '', NULL),
(97, 'Açai 300 ml', 'AÇAI', 'Duas frutas, leite condençado, leite ninho, granola e paçoca', '', '0.00', '18.00', '', '', '', '', '', '', '', ''),
(98, 'Açai 500 ml', 'AÇAI', 'Duas frutas, leite condençado, leite ninho, granola e paçoca', '', '0.00', '23.00', '', '', '', '', '', '', '', ''),
(99, 'Sufresh Guaraná', 'SUCO', 'Sufresh Guaraná', '', '0.00', '5.50', '1', '6', '', '', '', '', '', ''),
(100, 'Fanta Uva 600 ml', 'REFRIGERANTES', '', '', '', '8.00', '-1', '4', '', '', '', '', '', ''),
(101, 'Batata no Cone', 'BATATA', 'Batata no Cone', '', '', '15.00', '', '', '', '', '', '', '', 'Com cheddar e bacon'),
(102, 'Batata 250g', 'BATATA', 'Batata 250g', '', '', '17.00', '', '', '', '', '', '', '', 'Com cheddar e bacon'),
(103, 'Batata 500g', 'BATATA', 'Batata 500g', '', '', '23.00', '', '', '', '', '', '', '', 'Cheddar e bacon'),
(104, 'Coca-Cola Zero', 'REFRIGERANTES', 'Coca-Cola Zero', '', '', '4.00', '', '', '', '', '', '', '', ''),
(105, 'Sufresh Maracujá', 'SUCO', 'Sufresh Maracujá', '', '', '5.50', '', '', '', '', '', '', '', ''),
(106, 'Fanta Laraja 310 ml', 'REFRIGETANTE', 'Fanta Laraja 310 ml', '', '', '4', '', '', '', '', '', '', '', ''),
(107, 'Sukita uva', 'REFRIGERANTES', '', '', '', '3.00', '', '', '', '', '', '', '', ''),
(108, 'Mini Especial', 'ESPECIAL', 'Mini Especial', '', '', '15.00', '', '', '', '', '', '', '', ''),
(109, 'Carne com Ovo', 'PASTEL', 'Carne com Ovo', '', '', '10.00', '', '', '', '', '', '', '', ''),
(110, 'Frete', '', 'Frete', '', '', '3.00', '', '', '', '', '', '', '', ''),
(111, 'Fanta Laranja 2L', 'REFRIGERANTE', '', '', '', '10', '', '', '', '', '', '', '', ''),
(112, 'Adicional', '', 'Adicional', '', '', '2.00', '', '', '', '', '', '', '', ''),
(113, 'Mini Chocolate com Banana', '', 'Mini Chocolate com Banana', '', '', '5.00', '', '', '', '', '', '', '', ''),
(114, 'Mini Calabresa com Cheddar', '', 'Mini Calabresa com Cheddar', '', '', '5.00', '', '', '', '', '', '', '', ''),
(115, 'Mini Queijo', '', 'Mini Queijo', '', '', '4.50', '', '', '', '', '', '', '', ''),
(116, 'Mini Chocolate', '', 'Mini Chocolate', '', '', '4.50', '', '', '', '', '', '', '', ''),
(117, 'Mini especial Costela ', '', 'Mini especial Costela ', '', '', '15.00', '', '', '', '', '', '', '', ''),
(118, 'Mini especial Carne', '', 'Mini especial Carne', '', '', '15.00', '', '', '', '', '', '', '', ''),
(119, 'Churruinhos', '', 'Churruinhos', '', '', '4.00', '', '', '', '', '', '', '', ''),
(120, 'Mini especial Carne com Queijo', '', 'Mini especial Carne com Queijo', '', '', '15.00', '', '', '', '', '', '', '', ''),
(121, 'Mini especial Carne, Ovo, Cebola e Azeitona', '', 'Mini especial Carne, Ovo, Cebola e Azeitona', '', '', '15.00', '', '', '', '', '', '', '', ''),
(122, 'Mini Queijo com Milho', '', 'Mini Queijo com Milho', '', '', '5.00', '', '', '', '', '', '', '', ''),
(123, 'Mini Frango com Queijo', '', 'Mini Frango com Queijo', '', '', '5.00', '', '', '', '', '', '', '', ''),
(124, 'Mini Frango com Cheddar', '', 'Mini Frango com Cheddar', '', '', '5.00', '', '', '', '', '', '', '', ''),
(125, 'Mini Nutella com Morango', '', 'Mini Nutella com Morango', '', '', '6.00', '', '', '', '', '', '', '', ''),
(126, 'Coca-Cola 220 ml', '', 'Coca-Cola 220 ml', '', '', '4.00', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(100) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` int(100) NOT NULL,
  `pergunta` varchar(255) NOT NULL,
  `resposta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `nivel`, `pergunta`, `resposta`) VALUES
(1, 'Phelipe', 'ph', 1, 'ph', 'ph'),
(3, 'Raphael', 'Raphael', 2, 'Nome', 'Meu'),
(4, 'Adriana', 'Adriana', 2, '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(100) NOT NULL,
  `id_pedido` char(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `rendimento` varchar(255) NOT NULL,
  `pgto` char(50) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `id_pedido`, `valor`, `cliente`, `rendimento`, `pgto`, `data`) VALUES
(2, '', '28', 'Marcio', 'Mesa', '', '05/03/2022'),
(3, '', '20', 'Sueli', 'Mesa', '', '05/03/2022'),
(5, '', '27', 'Paula', 'Mesa', '', '05/03/2022'),
(6, '', '18', '', 'Mesa', '', '05/03/2022'),
(7, '', '24', '', 'Mesa', '', '05/03/2022'),
(8, '', '35', '', 'Mesa', '', '05/03/2022'),
(9, '', '50', '', 'Mesa', '', '05/03/2022'),
(10, '', '80', '', 'Mesa', '', '05/03/2022'),
(11, '', '68', '', 'Mesa', '', '05/03/2022'),
(12, '', '24', '', 'Mesa', '', '05/03/2022'),
(13, '', '38', '', 'Mesa', '', '05/03/2022'),
(14, '', '6', '', 'Mesa', '', '05/03/2022'),
(19, '', '42.5', '', 'Mesa', 'Cartão Credito', '06/03/2022'),
(20, '', '55', '', 'Mesa', 'Cartão Credito', '06/03/2022'),
(21, '', '29', '', 'Mesa', 'Pix', '06/03/2022'),
(22, '', '19', '', 'Mesa', 'Dinheiro', '06/03/2022'),
(23, '', '29', '', 'Mesa', 'Pix', '06/03/2022'),
(24, '', '9', '', 'Mesa', 'Pix', '06/03/2022'),
(25, '', '9', '', 'Mesa', 'Cartão Debito', '06/03/2022'),
(26, '', '17', '', 'Mesa', 'Cartão Debito', '06/03/2022'),
(27, '', '10', '', 'Mesa', 'Dinheiro', '07/03/2022'),
(28, '', '10', '', 'Mesa', 'Dinheiro', '07/03/2022'),
(29, '', '10', '', 'Mesa', 'Dinheiro', '07/03/2022'),
(30, '', '10', '', 'Mesa', 'Dinheiro', '07/03/2022'),
(33, '', '34', 'Mesa', 'Mesa', 'Dinheiro', '08/03/2022'),
(34, '', '57', 'Susy', 'Mesa', 'Dinheiro', '08/03/2022'),
(35, '', '37', 'Chrys', 'Mesa', 'Cartão Debito', '08/03/2022'),
(36, '', '30', 'Mesa', 'Mesa', 'Cartão Credito', '08/03/2022'),
(37, '', '26', '', 'Mesa', 'Dinheiro', '09/03/2022'),
(38, '', '37', 'Rogerio', 'Mesa', 'Cartão Debito', '09/03/2022'),
(39, '', '31', 'Mesa', 'Mesa', 'Dinheiro', '09/03/2022'),
(40, '', '9', 'Mesa', 'Mesa', 'Dinheiro', '10/03/2022'),
(41, '', '18', 'Mesa', 'Mesa', 'Cartão Debito', '10/03/2022'),
(48, '', '12', 'João Carlos', 'Mesa', 'Dinheiro', '12/03/2022'),
(49, '', '6', 'Balcão', 'Mesa', 'Dinheiro', '12/03/2022'),
(50, '', '12', 'Sonia', 'Mesa', 'Dinheiro', '12/03/2022'),
(51, '', '20', 'Balcão', 'Mesa', 'Pix', '12/03/2022'),
(52, '', '29', '', 'Mesa', 'Cartão Debito', '12/03/2022'),
(53, '', '24', 'Phelipe', 'Mesa', 'Cartão Credito', '12/03/2022'),
(54, '', '31', 'Phelipe', 'Mesa', 'Cartão Credito', '12/03/2022'),
(56, '', '40', 'Leandro', 'Mesa', 'Dinheiro', '13/03/2022'),
(57, '', '59', '', 'Mesa', 'Cartão Credito', '13/03/2022'),
(58, '', '18', 'Balcão', 'Mesa', 'Dinheiro', '13/03/2022'),
(59, '', '22', 'Ricardo', 'Mesa', 'Cartão Debito', '13/03/2022'),
(60, '', '22', 'Ricardo', 'Mesa', 'Cartão Debito', '13/03/2022'),
(62, '', '16', 'Jady', 'Mesa', 'Cartão Debito', '13/03/2022'),
(64, '', '10', 'Rogerio', 'Mesa', 'Cartão Debito', '13/03/2022'),
(65, '', '20', 'Rafael', 'Mesa', 'Cartão Credito', '13/03/2022'),
(66, '', '20', 'Rogerio', 'Mesa', 'Cartão Debito', '13/03/2022'),
(68, '', '15', 'MESA', 'Mesa', 'Cartão Debito', '14/03/2022'),
(69, '', '29', 'Tiuzinho', 'Mesa', 'Cartão Credito', '15/03/2022'),
(70, '', '11.5', 'vizinha ', 'Mesa', 'Cartão Debito', '15/03/2022'),
(71, '', '20', 'Robson', 'Mesa', 'Pix', '15/03/2022'),
(72, '', '10', 'vizinha ', 'Mesa', 'Dinheiro', '15/03/2022'),
(73, '', '31', 'Gabriel', 'Mesa', 'Cartão Credito', '15/03/2022'),
(74, '1029', '44', 'Veronica', 'Mesa', 'Dinheiro', '15/03/2022'),
(75, '1030', '10', 'Andre', 'Mesa', 'Dinheiro', '15/03/2022'),
(76, '1031', '22', 'Raphael', 'Mesa', 'Dinheiro', '15/03/2022'),
(78, '1032', '20', 'Vizinha', 'Mesa', 'Dinheiro', '15/03/2022'),
(79, '1033', '17', 'Vizinha', 'Mesa', 'Dinheiro', '15/03/2022'),
(80, '1034', '34', 'Irmão Andre', 'Mesa', 'Dinheiro', '16/03/2022'),
(81, '1035', '32', 'Vizinha Raphael', 'Mesa', 'Dinheiro', '16/03/2022'),
(82, '1036', '24', 'Phelipe', 'Mesa', 'Dinheiro', '16/03/2022'),
(83, '1037', '30', 'Thiago', 'Mesa', 'Dinheiro', '16/03/2022'),
(84, '1038', '34', 'Caroline', 'Mesa', 'Dinheiro', '16/03/2022'),
(85, '1040', '6', 'Vizinho', 'Mesa', 'Dinheiro', '16/03/2022'),
(86, '1041', '12', 'Cliente', 'Mesa', 'Dinheiro', '16/03/2022'),
(87, '1042', '35.5', 'Cliente', 'Mesa', 'Dinheiro', '16/03/2022'),
(88, '1043', '20', 'Luiz', 'Mesa', 'Dinheiro', '16/03/2022'),
(89, '1039', '52', 'Rogerio', 'Mesa', 'Dinheiro', '16/03/2022'),
(90, '1044', '20', 'Silmara', 'Mesa', 'Dinheiro', '17/03/2022'),
(91, '1045', '22', 'Vizinha', 'Mesa', 'Dinheiro', '17/03/2022'),
(92, '1047', '10', 'Vizinha', 'Mesa', 'Dinheiro', '17/03/2022'),
(93, '1046', '31', 'Tatiana', 'Mesa', 'Dinheiro', '17/03/2022'),
(94, '1048', '44', 'Anderson', 'Mesa', 'Dinheiro', '18/03/2022'),
(95, '1049', '9', 'Cliente', 'Mesa', 'Dinheiro', '18/03/2022'),
(96, '1050', '10', 'Cliente', 'Mesa', 'Dinheiro', '18/03/2022'),
(97, '1053', '25', 'Cliente', 'Mesa', 'Dinheiro', '18/03/2022'),
(98, '1051', '20', 'Cliente', 'Mesa', 'Dinheiro', '18/03/2022'),
(99, '1052', '40', 'Mesa Cliente', 'Mesa', 'Dinheiro', '18/03/2022'),
(100, '1054', '41', 'Alexandre', 'Mesa', 'Dinheiro', '18/03/2022'),
(101, '1055', '26', 'Caio', 'Mesa', 'Dinheiro', '20/03/2022'),
(102, '1056', '30', 'Jhonatan', 'Mesa', 'Dinheiro', '20/03/2022'),
(103, '1057', '18', 'Caroline', 'Mesa', 'Dinheiro', '20/03/2022'),
(104, '1058', '3', 'Jhonatan', 'Mesa', 'Dinheiro', '20/03/2022'),
(105, '1059', '30', 'Susi', 'Mesa', 'Dinheiro', '20/03/2022'),
(106, '1061', '15', 'Lorrany', 'Mesa', 'Dinheiro', '20/03/2022'),
(107, '1060', '30', 'Angelica', 'Mesa', 'Dinheiro', '20/03/2022'),
(108, '1062', '44', 'Marciliana', 'Mesa', 'Dinheiro', '20/03/2022'),
(109, '1063', '67', 'Carol', 'Mesa', 'Dinheiro', '20/03/2022'),
(110, '1064', '12', 'Big Amarildo', 'Mesa', 'Dinheiro', '20/03/2022'),
(111, '1066', '47', 'Daniel', 'Mesa', 'Dinheiro', '29/03/2022'),
(112, '1067', '10', 'Cliente', 'Mesa', 'Dinheiro', '31/03/2022'),
(113, '1070', '27', 'Mesa', 'Mesa', 'Dinheiro', '31/03/2022'),
(114, '1071', '25', 'Izabela', 'Mesa', 'Dinheiro', '31/03/2022'),
(115, '1068', '20', 'Miguel', 'Mesa', 'Dinheiro', '31/03/2022'),
(116, '1069', '140', 'David', 'Mesa', 'Dinheiro', '31/03/2022'),
(117, '1072', '37', 'Marinete', 'Mesa', 'Dinheiro', '01/04/2022'),
(118, '1073', '3', 'Cliente', 'Mesa', 'Dinheiro', '01/04/2022'),
(119, '1074', '41', 'Karina', 'Mesa', 'Dinheiro', '03/04/2022'),
(120, '1075', '31', 'Jaqueline', 'Mesa', 'Dinheiro', '03/04/2022'),
(121, '1076', '34', 'Isaque', 'Mesa', 'Dinheiro', '03/04/2022'),
(122, '1077', '17', 'Cristiane', 'Mesa', 'Dinheiro', '03/04/2022'),
(123, '1078', '46', 'cliente', 'Mesa', 'Dinheiro', '03/04/2022'),
(124, '1079', '69', 'Mesa', 'Mesa', 'Dinheiro', '03/04/2022'),
(125, '1081', '40', 'Mesa', 'Mesa', 'Dinheiro', '04/04/2022'),
(126, '1080', '3', 'Phelipe', 'Mesa', 'Dinheiro', '04/04/2022'),
(127, '1082', '24', 'Mesa', 'Mesa', 'Dinheiro', '05/04/2022'),
(128, '1083', '35', 'Susy', 'Mesa', 'Dinheiro', '06/04/2022'),
(129, '1085', '78', 'Felipe', 'Mesa', 'Dinheiro', '06/04/2022'),
(130, '1084', '15', 'Rafael', 'Mesa', 'Dinheiro', '06/04/2022'),
(131, '1087', '10', 'Max', 'Mesa', 'Dinheiro', '06/04/2022'),
(132, '1086', '48', 'Cliente', 'Mesa', 'Dinheiro', '06/04/2022'),
(133, '1088', '58', 'Phelipe', 'Mesa', 'Dinheiro', '06/04/2022'),
(134, '1089', '24', 'Stephanie', 'Mesa', 'Dinheiro', '06/04/2022'),
(135, '1090', '8', 'Cliente', 'Mesa', 'Dinheiro', '07/04/2022'),
(136, '1091', '10', 'Mesa', 'Mesa', 'Dinheiro', '07/04/2022'),
(137, '1092', '33.5', 'Mesa', 'Mesa', 'Dinheiro', '07/04/2022'),
(138, '1093', '10', 'Cliente', 'Mesa', 'Dinheiro', '07/04/2022'),
(139, '1094', '40', 'Joaquim', 'Mesa', 'Dinheiro', '07/04/2022'),
(140, '1095', '10', 'Stephanie', 'Mesa', 'Dinheiro', '08/04/2022'),
(141, '1096', '20', 'Robson', 'Mesa', 'Dinheiro', '08/04/2022'),
(142, '1097', '40', 'Entrega', 'Mesa', 'Dinheiro', '08/04/2022'),
(143, '1099', '75', 'Marcio', 'Mesa', 'Dinheiro', '08/04/2022'),
(144, '1098', '45', 'Entega', 'Mesa', 'Dinheiro', '08/04/2022'),
(145, '1103', '19', 'Seli', 'Mesa', 'Dinheiro', '08/04/2022'),
(146, '1108', '20', 'Cliente', 'Mesa', 'Dinheiro', '08/04/2022'),
(147, '1100', '27', 'Erika', 'Mesa', 'Dinheiro', '08/04/2022'),
(148, '1109', '9', 'Erika', 'Mesa', 'Dinheiro', '08/04/2022'),
(149, '1105', '17', 'Vitoria', 'Mesa', 'Dinheiro', '09/04/2022'),
(150, '1106', '28', 'Jenifer', 'Mesa', 'Dinheiro', '09/04/2022'),
(151, '1101', '34', 'Eduardo', 'Mesa', 'Dinheiro', '09/04/2022'),
(152, '1104', '17', 'Sid', 'Mesa', 'Dinheiro', '09/04/2022'),
(153, '1102', '17', 'Sandra', 'Mesa', 'Dinheiro', '09/04/2022'),
(154, '1107', '24', 'Carol', 'Mesa', 'Dinheiro', '09/04/2022'),
(155, '1110', '45', 'Cliente', 'Mesa', 'Cartão Credito', '09/04/2022'),
(156, '1111', '32', 'Marcelo', 'Mesa', 'Dinheiro', '09/04/2022'),
(157, '1112', '42', 'Jade', 'Mesa', 'Dinheiro', '10/04/2022'),
(158, '1113', '30', 'Erika', 'Mesa', 'Dinheiro', '09/04/2022'),
(159, '1114', '10', 'Durvalino', 'Mesa', 'Cartão Credito', '09/04/2022'),
(160, '1118', '15', 'Damiao', 'Mesa', 'Dinheiro', '09/04/2022'),
(161, '1117', '19', 'Mesa', 'Mesa', '', '09/04/2022'),
(162, '1116', '25', 'Talita', 'Mesa', '', '10/04/2022'),
(163, '1115', '32', 'Rogerio', 'Mesa', '', '10/04/2022'),
(164, '1121', '13', 'Vinicius', 'Mesa', 'Cartão Credito', '10/04/2022'),
(165, '1119', '3', 'Cliente ', 'Mesa', 'Dinheiro', '10/04/2022'),
(166, '1120', '28', 'Rafael', 'Mesa', 'Cartão Credito', '10/04/2022'),
(167, '1122', '18', 'Cliente', 'Mesa', 'Dinheiro', '10/04/2022'),
(168, '1123', '87', 'Gika', 'Mesa', 'Dinheiro', '10/04/2022'),
(169, '1124', '52', 'Daniela', 'Mesa', 'Cartão Debito', '10/04/2022'),
(170, '1127', '5', 'Cliente', 'Mesa', 'Cartão Debito', '10/04/2022'),
(171, '1125', '28', 'Rejane', 'Mesa', 'Dinheiro', '10/04/2022'),
(172, '1126', '33', 'Katia', 'Mesa', 'Pix', '10/04/2022'),
(173, '1128', '10', 'Guilherme', 'Mesa', 'Dinheiro', '12/04/2022'),
(174, '1130', '36', 'Andre', 'Mesa', 'Cartão Credito', '12/04/2022'),
(175, '1129', '66', 'Beatriz', 'Mesa', 'Cartão Debito', '12/04/2022'),
(176, '1134', '17', 'Rafael', 'Mesa', 'Cartão Credito', '12/04/2022'),
(177, '1131', '9', 'Joana', 'Mesa', 'Cartão Debito', '12/04/2022'),
(178, '1132', '24', 'Jhonata', 'Mesa', 'Cartão Debito', '12/04/2022'),
(179, '1133', '58', 'Phelipe', 'Mesa', 'Pix', '13/04/2022'),
(180, '1135', '30', 'Alexandre', 'Mesa', 'Cartão Credito', '13/04/2022'),
(181, '1136', '32', 'Taylon', 'Mesa', '', '13/04/2022'),
(182, '1137', '34', 'Joaquim', 'Mesa', 'Cartão Debito', '13/04/2022'),
(183, '1138', '32', 'Vizinho', 'Mesa', 'Dinheiro', '13/04/2022'),
(184, '1139', '24', 'Cliente', 'Mesa', 'Dinheiro', '13/04/2022'),
(185, '1140', '36', 'Manoel', 'Mesa', 'Cartão Credito', '14/04/2022'),
(186, '1141', '22', 'Robson', 'Mesa', 'Pix', '14/04/2022'),
(187, '1147', '26', 'Cliente 2', 'Mesa', 'Cartão Debito', '14/04/2022'),
(188, '1146', '14', 'Cliente', 'Mesa', 'Cartão Debito', '14/04/2022'),
(189, '1143', '23', 'Big', 'Mesa', 'Dinheiro', '14/04/2022'),
(190, '1142', '9', 'Cristiane', 'Mesa', 'Dinheiro', '14/04/2022'),
(191, '1145', '53', 'Luzia', 'Mesa', 'Cartão Debito', '14/04/2022'),
(192, '1148', '54', 'Vizinha ', 'Mesa', 'Cartão Credito', '15/04/2022'),
(193, '1149', '22', 'Erika', 'Mesa', 'Dinheiro', '15/04/2022'),
(194, '1150', '32', 'Jady', 'Mesa', 'Cartão Debito', '15/04/2022'),
(195, '1151', '10', 'Jady', 'Mesa', 'Cartão Debito', '15/04/2022'),
(196, '1152', '16', 'Aline', 'Mesa', 'Dinheiro', '15/04/2022'),
(197, '1154', '16', 'Jeferson', 'Mesa', 'Dinheiro', '15/04/2022'),
(198, '1153', '64', 'Josimar', 'Mesa', 'Cartão Debito', '15/04/2022'),
(199, '1144', '114', 'Phelipe', 'Mesa', 'Cartão Credito', '16/04/2022'),
(200, '1155', '26', 'Adriana', 'Mesa', 'Pix', '16/04/2022'),
(201, '1156', '30', 'Leticia', 'Mesa', 'Dinheiro', '16/04/2022'),
(202, '1158', '44', 'Marcio', 'Mesa', 'Cartão Debito', '16/04/2022'),
(203, '1161', '39', 'Andre', 'Mesa', 'Cartão Credito', '16/04/2022'),
(204, '1160', '29', 'Dario', 'Mesa', 'Cartão Debito', '16/04/2022'),
(205, '1159', '10', 'Tomaz', 'Mesa', 'Dinheiro', '16/04/2022'),
(206, '1157', '33', 'Camila', 'Mesa', 'Cartão Credito', '16/04/2022'),
(207, '1162', '49', 'Thiago', 'Mesa', 'Cartão Debito', '16/04/2022'),
(208, '1163', '50', 'Ricardo', 'Mesa', 'Cartão Debito', '16/04/2022'),
(209, '1165', '27', 'Eduardo', 'Mesa', 'Cartão Debito', '16/04/2022'),
(210, '1168', '11', 'Vitoria', 'Mesa', 'Dinheiro', '16/04/2022'),
(211, '1164', '21', 'Joaquim', 'Mesa', 'Dinheiro', '16/04/2022'),
(212, '1166', '8', 'Sandra', 'Mesa', 'Cartão Credito', '16/04/2022'),
(213, '1170', '45', 'Seli', 'Mesa', 'Cartão Debito', '16/04/2022'),
(214, '1169', '34', 'Carol ', 'Mesa', 'Cartão Debito', '16/04/2022'),
(215, '1172', '6', 'Cliente', 'Mesa', 'Dinheiro', '16/04/2022'),
(216, '1174', '14', 'Joana', 'Mesa', '', '19/04/2022'),
(217, '1175', '15', 'Lorane', 'Mesa', 'Cartão Debito', '19/04/2022'),
(218, '1173', '50', 'Robson', 'Mesa', 'Pix', '19/04/2022'),
(219, '1176', '60', 'Jonatan', 'Mesa', 'Cartão Debito', '19/04/2022'),
(220, '1177', '36', 'Sthefanie', 'Mesa', 'Pix', '19/04/2022'),
(221, '1178', '31', 'Patricia', 'Mesa', 'Cartão Debito', '19/04/2022'),
(222, '1179', '10', 'Patricia', 'Mesa', 'Dinheiro', '19/04/2022'),
(223, '1180', '5', 'Andre', 'Mesa', 'Dinheiro', '19/04/2022'),
(224, '1181', '40', 'Cliente', 'Mesa', 'Cartão Credito', '20/04/2022'),
(225, '1182', '22', 'Claiton', 'Mesa', 'Cartão Credito', '20/04/2022'),
(226, '1183', '21', 'Jeferson', 'Mesa', 'Cartão Credito', '20/04/2022'),
(227, '1184', '56', 'cliente santana ', 'Mesa', 'Cartão Debito', '20/04/2022'),
(228, '1185', '39', 'Alex', 'Mesa', 'Cartão Debito', '20/04/2022'),
(229, '1186', '4', 'Anderson ', 'Mesa', 'Dinheiro', '20/04/2022'),
(230, '1187', '50', 'Felipe', 'Mesa', 'Dinheiro', '20/04/2022'),
(231, '1188', '22', 'Gustavo', 'Mesa', 'Dinheiro', '21/04/2022');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cor`
--
ALTER TABLE `cor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `cor`
--
ALTER TABLE `cor`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=588;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
