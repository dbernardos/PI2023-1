
-- Base de Dados: `myfinder`

CREATE DATABASE myfinder;
USE myfinder;

-------------------------------------------------------

-- Estrutura da tabela `cliente`

CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(100) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(200) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- Inserindo dados da tabela `cliente`

INSERT INTO `cliente` (`id_cliente`, `nome`, `email`, `senha`) VALUES
(6, 'Admin', 'Admin@gmail.com', '80177534a0c99a7e3645b52f2027a48b'),
(7, 'kelcia', 'kel@gmail.com', '202cb962ac59075b964b07152d234b70');

-------------------------------------------------------

-- Estrutura da tabela `produtos`

CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produtos` int(100) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `link` varchar(500) NOT NULL,
  `imagem` varchar(250) DEFAULT NULL,
  `preco` varchar(100) DEFAULT NULL,
  `fk_cliente` INT NOT NULL,
  PRIMARY KEY (`id_produtos`),
  CONSTRAINT `fk_id_cliente` FOREIGN KEY (`fk_cliente`) REFERENCES `cliente` (`id_cliente`);
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- Inserindo dados da tabela `produtos`
INSERT INTO `produtos` (`id_produtos`, `nome`, `descricao`, `link`, `imagem`, `fk_cliente`, `preco`) VALUES
(32, 'Frigobar Brastemp 76 Litros BRA08', 'Com visual retrÃ´, o frigobar Brastemp 76 litros parece uma mini geladeira dos anos 50, um eletrodomÃ©stico super charmoso para armazenar menores quantidades de comida ou bebida em qualquer espaÃ§o da casa.  A parte interna do frigobar Brastemp tem compartimentos modulares, que podem ser posicionados como vocÃª achar melhor para a organizaÃ§Ã£o interna, compartimento extra frio, porta latas, gavetÃ£o e prateleira na porta para garrafas.  O modelo conta tambÃ©m com um congelador e recipiente para', 'https://www.zoom.com.br/frigobar/frigobar-bra08a-brastemp-retro-76-litros#lista-de-ofertas', 'imagensProduto/20230612215314-465884715.jpg', 7, '1.599,53'),
(36, 'Cadeira Eames Eiffel ', 'A Cadeira Eames Eiffel Base Madeira - Preto Ã© um produto Ãºnico que alinha design e sofisticaÃ§Ã£o. Ela se adapta em ambientes modernos com uma decoraÃ§Ã£o arrojada e inovadora, podendo ser utilizada na sala de estar ou em ambientes externos. Com pÃ©s de madeira, Ã© uma Ã³tima opÃ§Ã£o para a decoraÃ§Ã£o da sua casa.  CaracterÃ­sticas principais: â€¢Moderna; â€¢Combina com diversos ambientes; â€¢Design Ãºnico; â€¢Encosto arredondado; â€¢Assento em polipropileno; â€¢PÃ©s em madeira; â€¢Peso supor', 'https://www.abracasa.com.br/cadeira-eames-eiffel-base-madeira-preta/p', 'imagensProduto/20230613164400cadeira.jpg', 6, '188,88');


-- Estrutura da tabela `historicoprodutos`

CREATE TABLE IF NOT EXISTS `historicoprodutos` (
  `nome` varchar(100) NOT NULL,
  `preco` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `id_produtos` int(10) DEFAULT NULL,
  `id_historico` int(100) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_historico`),
  ADD CONSTRAINT `fk_id_produtos` FOREIGN KEY (`id_produtos`) REFERENCES `produtos` (`id_produtos`);
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=40 ;

--
-- Inserindo dados na tabela `historicoprodutos`
--

INSERT INTO `historicoprodutos` (`nome`, `preco`, `data`, `id_produtos`, `id_historico`) VALUES
('Frigobar Brastemp 76 Litros BRA08', '1.599,53', '2023-06-12', 32, 31),
('Cadeira Eames Eiffel ', '188,88', '2023-06-13', 36, 39);



