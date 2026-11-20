CREATE TABLE pratos(
idPrato INT AUTO_INCREMENT PRIMARY KEY,
nomePrato VARCHAR(100) NOT NULL UNIQUE,
descricao VARCHAR(255),
preco DECIMAL(6,2) NOT NULL
);

SELECT * FROM pratos

INSERT INTO pratos
(nomePrato, descricao, preco)
VALUES
('Strogonoff de Frango', 
'Frango em pedaços com molho de strogonoff acompanhado por deliciosos champignos',34.99),
('Lasanha á Bolonhesa', 
'Deliciosas folhas de massa produzida na casa com queijo, presunto e molho de tomate com carne moída',46.99),
('Frango á Milanesa', 'Delisioso peito de frango á milanesa.
Acompanhada arroz, feijão e batatas fritas',37.99),
('Filé Mignon ao Molho Madeira', 'Filé mignon ao molho madeira.
Acompanha arroz e batata rústica',87.99),
('Costela ao Molho Barbecue','Costela ao molho barbecue. 
Acompanha arroz e cebola à milanesa', 59.99);

CREATE TABLE bebida(
idBebida INT AUTO_INCREMENT PRIMARY KEY,
nomeBebida VARCHAR(100) NOT NULL UNIQUE,
volume VARCHAR(50),
alcoolico TINYINT(1) NOT NULL,
preco DECIMAL(6,2) NOT NULL
);

SELECT * FROM bebida

INSERT INTO bebida
(nomeBebida, volume, alcoolico, preco)
VALUES
('Coca-Cola Lata', '350 ml', 0, 6.50),
('Suco Natural de Laranja', '500 ml', 0, 9.90),
('Cerveja Heineken Long Neck', '330 ml', 1, 11.00),
('Água Mineral com Gás', '500 ml', 0, 4.50),
('Vinho Tinto Seco Taça', '200 ml', 1, 18.90);

CREATE TABLE sobremesa(
idSobremesa INT AUTO_INCREMENT PRIMARY KEY,
nomeSobremesa VARCHAR(100) NOT NULL UNIQUE,
descricao VARCHAR(255),
preco DECIMAL(6,2) NOT NULL
);

SELECT * FROM sobremesa

INSERT INTO sobremesa
(nomeSobremesa, descricao, preco)
VALUES
('Pudim de Leite Condensado', 'Tradicional pudim cremoso com calda de caramelo artesanal', 14.90),
('Petit Gâteau', 'Bolinho de chocolate com recheio cremoso, acompanhado de sorvete de baunilha', 22.50),
('Mousse de Maracujá', 'Mousse leve e aerado com cobertura de calda de maracujá fresca', 12.00),
('Torta Holandesa', 'Fatia de torta com creme belga, biscoitos e cobertura de ganache de chocolate', 16.90),
('Cheesecake de Frutas Vermelhas', 'Fatia de cheesecake estilo Nova York com calda de amoras e morangos', 18.50);

CREATE TABLE marmita (
idMarmita INT AUTO_INCREMENT PRIMARY KEY,
pratoMarmita VARCHAR(100) NOT NULL UNIQUE,
precoMarmita DECIMAL(6,2) NOT NULL,
validadeMarmita DATE NOT NULL
);

SELECT * FROM marmita

INSERT INTO marmita
(pratoMarmita, precoMarmita, validadeMarmita)
VALUES
('Frango Grelhado com Arroz, Feijão e Fritas', 23.90, '2026-11-25'),
('Bife Acebolado com Purê de Batata e Salada', 25.50, '2026-11-24'),
('Strogonoff de Frango com Arroz e Batata Palha', 24.90, '2026-11-26');