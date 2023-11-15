CREATE TABLE IF NOT EXISTS products (
    product_id int(11) NOT NULL AUTO_INCREMENT,
    product_name varchar(100) NOT NULL,
    product_category varchar(100) NOT NULL,
    product_description varchar(255) NOT NULL,
    product_image varchar(255) NOT NULL,
    product_image2 varchar(255) NOT NULL,
    product_image3 varchar(255) NOT NULL,
    product_images varchar(255) NOT NULL,
    product_price decimal(6,2) NOT NULL,
    product_special_offer int(2) NOT NULL,
    product_color varchar(100) NOT NULL,
    PRIMARY KEY (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;



INSERT INTO products (product_name, product_category, product_description, product_image, product_image2, product_image3, product_images, product_price, product_special_offer, product_color)
VALUES ('Molinete Maruri by Nakamura Kazan 2000', 'Molinete', 'produto bom', '1.png', '1.png', '1.png', 'imagens_como_texto_separado_por_vírgulas', 302.00, 1, 'Vermelho'),
('Molinete Saint Netuno Ocean 4000 / Pesca De Praia', 'Molinete', 'produto bom', '2.png', '2.png', '2.png', 'imagens_como_texto_separado_por_vírgulas', 290.00, 1, 'Vermelho'),
('Molinete Saint Saturno Duo 3000', 'Molinete', 'produto bom', '3.png', '3.png', '3.png', 'imagens_como_texto_separado_por_vírgulas', 165.00, 1, 'Vermelho'),
('Vara Lumis Invokada 631 (1,89m) 5-14lb p/ Carretilha Inteiriça', 'Vara', 'produto bom', '4.png', '4.png', '4.png', 'imagens_como_texto_separado_por_vírgulas', 420.00, 1, 'Vermelho'),
('Vara Saint Hammer 581 1,73m 4-12LB p/ Molinete Inteiriça', 'Vara', 'produto bom', '5.png', '5.png', '5.png', 'imagens_como_texto_separado_por_vírgulas', 375.00, 1, 'Vermelho'),
('Vara Marine Versus 601 (1,83m) 12-25lb Para Carretilha Inteiriça', 'Vara', 'produto bom', '6.png', '6.png', '6.png', 'imagens_como_texto_separado_por_vírgulas', 255.00, 1, 'Vermelho'),
('Linha Monofilamento Maruri Max Soft 0.33mm 15,1lb 300m', 'Linha', 'produto bom', '7.png', '7.png', '7.png', 'imagens_como_texto_separado_por_vírgulas', 45.00, 1, 'Vermelho'),
('Linha Monofilamento Crown Fiber Soft 0.37mm 27lb 500m', 'Linha', 'produto bom', '8.png', '8.png', '8.png', 'imagens_como_texto_separado_por_vírgulas', 75.00, 1, 'Vermelho'),
('Linha Monofilamento Crown Fiber Soft 0.40mm 32lb 250m', 'Linha', 'produto bom', '9.png', '9.png', '9.png', 'imagens_como_texto_separado_por_vírgulas', 55.00, 1, 'Vermelho'),
('Kit Girador Snap Marine BSS - 20 unidades', 'Anzol', 'produto bom', '10.png', '10.png', '10.png', 'imagens_como_texto_separado_por_vírgulas', 20.00, 1, 'Vermelho'),
('Kit Anzol Marine Super Strong 4330 - 20 unidades', 'Anzol', 'produto bom', '11.png', '11.png', '11.png', 'imagens_como_texto_separado_por_vírgulas', 15.00, 1, 'Vermelho'),
('Kit Girador Marine BBS Gold 20 unidades', 'Anzol', 'produto bom', '12.png', '12.png', '12.png', 'imagens_como_texto_separado_por_vírgulas', 20.00, 1, 'Vermelho'),
('Carretilha Maruri Black Tamba Pro Rec. 7.1:1 Drag 8kg', 'Carretilha', 'produto bom', '13.png', '13.png', '13.png', 'imagens_como_texto_separado_por_vírgulas', 360.00, 1, 'Vermelho'),
('Carretilha Saint Purus Rec. 7.1:1 Drag 15kg', 'Carretilha', 'produto bom', '14.png', '14.png', '14.png', 'imagens_como_texto_separado_por_vírgulas', 900.00, 1, 'Vermelho'),
('Isca Artificial OCL Baca Popper 10cm 19gr', 'Isca', 'produto bom', '15.png', '15.png', '15.png', 'imagens_como_texto_separado_por_vírgulas', 65.00, 1, 'Vermelho'),
('Isca Artificial Rapala Super Shad Rap 14cm 45g', 'Isca', 'produto bom', '16.png', '16.png', '16.png', 'imagens_como_texto_separado_por_vírgulas', 140.00, 1, 'Vermelho');



CREATE TABLE IF NOT EXISTS orders (
    order_id int(11) NOT NULL AUTO_INCREMENT,
    order_cost decimal(6,2) NOT NULL,
    order_status varchar(100) NOT NULL DEFAULT 'on_hold',
    user_id int(11) NOT NULL,
    user_phone int(11) NOT NULL,
    user_city varchar(255) NOT NULL,
    user_address varchar(255) NOT NULL,
    order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (order_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS order_items (
    item_id int(11) NOT NULL AUTO_INCREMENT,
    order_id int(11) NOT NULL,
    product_id int(11) NOT NULL,
    product_name varchar(255) NOT NULL,
    product_image varchar(255) NOT NULL,
    product_price decimal(6,2) NOT NULL,
    product_quantity int(11) NOT NULL,
    user_id int(11) NOT NULL,
    order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (item_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS users (
    user_id int(11) NOT NULL AUTO_INCREMENT,
    user_name varchar(100) NOT NULL,
    user_email varchar(100) NOT NULL,
    user_password varchar(100) NOT NULL,
    PRIMARY KEY (user_id),
    UNIQUE KEY UX_Constraint (user_email)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS payments (
    payment_id int(11) NOT NULL AUTO_INCREMENT,
    order_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    transaction_id varchar(250) NOT NULL,
    PRIMARY KEY (payment_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
