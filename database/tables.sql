-- Usuarios
CREATE TABLE `users` 
(
    `user_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador de usuario',
    `email` VARCHAR(64) NOT NULL UNIQUE COMMENT 'Correo electrónico del usuario',
    `username` VARCHAR(32) NOT NULL UNIQUE COMMENT 'Nombre de usuario para la aplicación',
    `user_password` VARCHAR(64) NOT NULL COMMENT 'Contraseña para el ingreso a la aplicación',
    `user_role` INT NOT NULL COMMENT 'Identificador del rol de usuario',
    `first_name` VARCHAR(64) NOT NULL COMMENT 'Primer nombre real del usuario',
    `last_name` VARCHAR(64) NOT NULL COMMENT 'Apellido real del usuario',
    `gender` INT NOT NULL COMMENT 'Género del usuario',
    `birth_date` DATE NOT NULL COMMENT 'Fecha de nacimiento del usuario',
    `visibility` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Visibilidad del perfil del usuario',
    `active` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Bandera de usuario activo',
    `last_login_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'fecha del último ingreso al portal',
    `profile_image` BLOB COMMENT 'Imagen del perfil del usuario'  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Categorias
CREATE TABLE `categories`
(
    `category_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador de categoria',
    `title` VARCHAR(64) NOT NULL COMMENT 'Titulo de la categoria',
    `description` VARCHAR(160) NOT NULL COMMENT 'Descripción de la categoría',
    `creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha de creación de la categoría',
    `created_by` INT NOT NULL COMMENT 'Usuario creador de la categoria',
    `active` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Bandera de categoria activa',
    CONSTRAINT `fk_category_created_by_users`
        FOREIGN KEY (`created_by`)
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Productos
CREATE TABLE `products`
(
    `product_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador de producto',
    `product_name` VARCHAR(64) NOT NULL COMMENT 'Nombre del producto',
    `description` VARCHAR(160) NOT NULL COMMENT 'Descripción del producto',
    `quotable` TINYINT(1) NOT NULL COMMENT 'Bandera de producto cotizable',
    `price` DECIMAL(10,2) COMMENT 'Precio del producto',
    `quantity` INT NOT NULL COMMENT 'Cantidad del producto',
    `active` TINYINT(1) COMMENT 'Bandera de producto activado',
    `approved_by` INT COMMENT 'Identificador del usuario administrador quien aprovó el producto',
    CONSTRAINT `fk_products_approved_by_users`
        FOREIGN KEY (`approved_by`)
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Categorias del producto
CREATE TABLE `product_categories`
(
    `product_id` INT NOT NULL COMMENT 'Identificador del producto',
    `category_id` INT NOT NULL COMMENT 'Identificador de la categoria', 
    CONSTRAINT `fk_product_categories_product_id_products`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`product_id`),
    CONSTRAINT `fk_product_categories_category_id_categories`
        FOREIGN KEY (`category_id`)
        REFERENCES `categories` (`category_id`),
    PRIMARY KEY (`product_id`, `category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Carrito de compras REVISAR
CREATE TABLE `shopping_carts`
(
    `shoppingCart_id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador del producto en el carrito',
    `quantity` INT COMMENT 'Cantidad en el carrito',
    `product_id` INT NOT NULL COMMENT 'Identificador del producto relacionado con el carrito',
    `user_id` INT NOT NULL COMMENT 'Identificador del u0suario dueño del carrito',
    CONSTRAINT `fk_shopping_carts_product_id_products`
        FOREIGN KEY (`product_id`) 
        REFERENCES `products` (`product_id`),
    CONSTRAINT `fK_shopping_carts_user_id_users`
        FOREIGN KEY (`user_id`) 
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- chats
CREATE TABLE `chats` 
(
    `chat_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador de la sala de chat',
    `seller_id` INT NOT NULL COMMENT 'Identificador del usuario vendedor',
    `client_id` INT NOT NULL COMMENT 'Identificador del usuario comprador',
    `active` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Bandera de chat activo',
    `product_id` INT NOT NULL COMMENT 'Identificador del producto del cual se desprende el chat',
    CONSTRAINT `fk_chats_seller_id_users`
        FOREIGN KEY (`seller_id`)
        REFERENCES `users` (`user_id`),
    CONSTRAINT `fk_chats_client_id_users`
        FOREIGN KEY (`client_id`)
        REFERENCES `users` (`user_id`),
    CONSTRAINT `fk_chats_product_id_products`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- mensajes
CREATE TABLE `messages` 
(
    `message_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del mensaje',
    `chat_id` INT NOT NULL COMMENT 'Identificador del chat al que pertenece el mensaje',
    `user_id` INT NOT NULL COMMENT 'Identificador del usuario autor del mensaje',
    `message` VARCHAR(180) NOT NULL COMMENT 'Cuerpo del mensaje',
    `sent_at` DATETIME NOT NULL COMMENT 'Fecha y hora del envío del mensaje',
    CONSTRAINT `fk_messages_chat_id_chats`
        FOREIGN KEY (`chat_id`)
        REFERENCES `chats` (`chat_id`),
    CONSTRAINT `fk_messages_user_id_users`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--Reviews
CREATE TABLE `reviews`
(
    `review_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador de la reseña',
    `user_id` INT NOT NULL COMMENT 'Identificador del usuario creador de la reseña',
    `title` VARCHAR(32) NOT NULL COMMENT 'Titulo de la reseña',
    `review_body` VARCHAR(180) NOT NULL COMMENT 'Cuerpo de la reseña',
    `active` TINYINT(1) NOT NULL COMMENT 'Bandera de reseña activa',
    `created_at` DATETIME NOT NULL COMMENT 'Fecha y hora del envío del mensaje',
    CONSTRAINT `fk_reviews_user_id_users`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--Listas
CREATE TABLE `lists`
(
    `list_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador de la lista de productos',
    `user_id` INT NOT NULL COMMENT 'Identificador del comprador',
    `title` VARCHAR(32) NOT NULL COMMENT 'Titulo de la lista',
    `description` VARCHAR(180) COMMENT 'Descripción de la lista',
    `visibility` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'Bandera de visibilidad de la lista',
    `list_image` BLOB NULL COMMENT 'Imagen de la lista',
    CONSTRAINT `fk_lists_user_id_users`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--ObjetosLista
CREATE TABLE `list_items`
(
    `list_item_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del producto en la lista',
    `list_id` INT NOT NULL COMMENT 'Identificador de la lista a la que pertenecen los productos',
    `product_id` INT NOT NULL COMMENT 'Identificador del producto en la lista',
    CONSTRAINT `fk_list_items_list_id_lists`
        FOREIGN KEY (`list_id`)
        REFERENCES `lists` (`list_id`),
    CONSTRAINT `fk_list_items_product_id_products`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Metodo de pago
CREATE TABLE `paid_methods`
(
    `paid_method_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador del método de pago',
    `method_name` VARCHAR(32) NOT NULL COMMENT 'Nombre del método de pago'
);

--Ventas
CREATE TABLE `sales`
(
    `sale_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador de la venta',
    `buyer_id` INT NOT NULL COMMENT 'Identificador del comprador',
    `sale_datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'Fecha y hora en la que se realizó la venta',
    `amount_paid_total` DECIMAL(10,2) NOT NULL COMMENT 'Cantidad pagada en la compra',
    `discount` DECIMAL(10,2) DEFAULT 0 NOT NULL COMMENT 'Cantidad descontada a la compra',
    `paid_method` VARHCAR(32) NOT NULL COMMENT 'Nombre del método de pago',
    CONSTRAINT `fk_sales_buyer_id_users`
        FOREIGN KEY (`buyer_id`),
        REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--Ventas detalle 
CREATE TABLE `sale_details`
(
    `sale_details_id` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador del articulo de la venta',
    `sale_id` INT NOT NULL COMMENT 'Identificador de la venta',
    `product_id` INT NOT NULL COMMENT 'Idenfiticador del producto comprado',
    `quantity` INT NOT NULL COMMENT 'Cantidad del producto comprado',
    `individual_price` DECIMAL(10,2) NOT NULL COMMENT 'Precio del producto al momento de la compra',
    `discount` DECIMAL(10,2) NOT NULL COMMENT 'Cantidad descontada del precio del producto',
    `amount_paid` DECIMAL(10,2) NOT NULL COMMENT 'Cantidad pagada por este producto',
    CONSTRAINT `fk_sale_details_sale_id_sales`
        FOREIGN KEY (`sale_id`)
        REFERENCES `sales` (`sale_id`),
    CONSTRAINT `fk_sale_details_product_id_products`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`product_id`),
);