--DROP's
DROP TYPE IF EXISTS admin_type CASCADE;
DROP TYPE IF EXISTS order_state_type CASCADE;
DROP TYPE IF EXISTS notification_type CASCADE;
DROP TYPE IF EXISTS report_type CASCADE;
DROP TABLE IF EXISTS image CASCADE;
DROP TABLE IF EXISTS authenticated_user CASCADE;
DROP TABLE IF EXISTS admin CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS admin_notification CASCADE;
DROP TABLE IF EXISTS user_notification CASCADE;
DROP TABLE IF EXISTS card CASCADE;
DROP TABLE IF EXISTS country CASCADE;
DROP TABLE IF EXISTS address CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS product CASCADE;
DROP TABLE IF EXISTS product_image CASCADE;
DROP TABLE IF EXISTS wishlist CASCADE;
DROP TABLE IF EXISTS review CASCADE;
DROP TABLE IF EXISTS report CASCADE;
DROP TABLE IF EXISTS promotion CASCADE;
DROP TABLE IF EXISTS promotion_product CASCADE;
DROP TABLE IF EXISTS size CASCADE;
DROP TABLE IF EXISTS color CASCADE;
DROP TABLE IF EXISTS stock CASCADE;
DROP TABLE IF EXISTS details CASCADE;
DROP TABLE IF EXISTS user_order CASCADE;
DROP TABLE IF EXISTS order_details CASCADE;
DROP TABLE IF EXISTS user_like CASCADE;
DROP FUNCTION IF EXISTS check_stock CASCADE;
DROP FUNCTION IF EXISTS add_product_to_cart CASCADE;
DROP FUNCTION IF EXISTS remove_product_from_cart CASCADE;
DROP FUNCTION IF EXISTS product_price_with_promotion CASCADE;
DROP FUNCTION IF EXISTS delete_user_information CASCADE;
DROP FUNCTION IF EXISTS product_search_update CASCADE;
DROP TRIGGER IF EXISTS delete_user_account on authenticated_user CASCADE;
DROP FUNCTION IF EXISTS check_review_privileges CASCADE;
DROP TRIGGER IF EXISTS before_review_insert on review CASCADE;
DROP FUNCTION IF EXISTS check_like_privileges CASCADE;
DROP TRIGGER IF EXISTS before_like_insert on user_like CASCADE;
DROP FUNCTION IF EXISTS check_report_privileges CASCADE;
DROP TRIGGER IF EXISTS before_report_insert on report CASCADE;
DROP FUNCTION IF EXISTS order_parameters CASCADE;
DROP TRIGGER IF EXISTS check_order_parameters on user_order CASCADE;
DROP TRIGGER IF EXISTS product_search_update on product CASCADE;
DROP INDEX IF EXISTS user_order_idx  CASCADE;
DROP INDEX IF EXISTS product_stock_idx  CASCADE;
DROP INDEX IF EXISTS final_date_promo_idx  CASCADE;
DROP INDEX IF EXISTS search_idx  CASCADE;


--TYPE's
CREATE TYPE admin_type AS ENUM ('Collaborator', 'Technician');
CREATE TYPE order_state_type AS ENUM (
    'Shopping Cart',
    'Pending',
    'In Progress',
    'Completed',
    'Cancelled'
);
CREATE TYPE notification_type AS ENUM (
    'New Promotion',
    'New Collection',
    'Recommended Product',
    'Change in Order State',
    'Payment accept',
    'Product in Wishlist Available',
    'Price Change of Item in Shopping Cart',
    'Order',
    'Report',
    'Other'
);

--CREATE's
CREATE TABLE image (
    id SERIAL PRIMARY KEY,
    file TEXT NOT NULL CONSTRAINT image_unique UNIQUE
);
CREATE TABLE authenticated_user (
    id SERIAL PRIMARY KEY,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    birth_date DATE,
    gender TEXT,
    blocked BOOLEAN NOT NULL DEFAULT FALSE,
    id_image INTEGER REFERENCES image(id) ON UPDATE CASCADE --VER TRIGGER
);
CREATE TABLE admin(
    id SERIAL PRIMARY KEY,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    birth_date DATE,
    gender TEXT,
    id_image INTEGER REFERENCES image(id) ON UPDATE CASCADE,
    --VER TRIGGER
    role admin_type NOT NULL
);
CREATE TABLE notification(
    id SERIAL PRIMARY KEY,
    type_notification notification_type NOT NULL,
    message TEXT NOT NULL,
    date TIMESTAMP NOT NULL
);
CREATE TABLE admin_notification(
    id_admin INTEGER NOT NULL REFERENCES admin(id) ON UPDATE CASCADE,
    id_notification INTEGER NOT NULL REFERENCES notification(id) ON UPDATE CASCADE,
    PRIMARY KEY (id_admin, id_notification)
);
CREATE TABLE user_notification(
    id_user INTEGER NOT NULL REFERENCES authenticated_user(id) ON UPDATE CASCADE,
    id_notification INTEGER NOT NULL REFERENCES notification(id) ON UPDATE CASCADE,
    PRIMARY KEY (id_user, id_notification)
);
CREATE TABLE card(
    id SERIAL PRIMARY KEY,
    nickname TEXT,
    name TEXT NOT NULL,
    number TEXT NOT NULL CONSTRAINT cart_unique UNIQUE,
    month SMALLINT NOT NULL,
    year SMALLINT NOT NULL,
    code SMALLINT NOT NULL,
    id_user INTEGER NOT NULL REFERENCES authenticated_user(id) ON UPDATE CASCADE
);
CREATE TABLE country(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL CONSTRAINT country_unique UNIQUE
);
CREATE TABLE address(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    company TEXT,
    nif TEXT,
    street TEXT NOT NULL,
    number SMALLINT NOT NULL,
    apartment TEXT,
    note TEXT,
    id_country INTEGER NOT NULL REFERENCES country(id) ON UPDATE CASCADE,
    id_user INTEGER NOT NULL REFERENCES authenticated_user(id) ON UPDATE CASCADE
);
CREATE TABLE category(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    id_super_category INTEGER REFERENCES category(id) ON UPDATE CASCADE
);
CREATE TABLE product(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL CONSTRAINT product_unique UNIQUE,
    description TEXT NOT NULL,
    price NUMERIC NOT NULL,
    id_category INTEGER NOT NULL REFERENCES category(id) ON UPDATE CASCADE
);
CREATE TABLE product_image(
    id_product INTEGER NOT NULL REFERENCES product(id) ON UPDATE CASCADE,
    id_image INTEGER NOT NULL REFERENCES image(id) ON UPDATE CASCADE,
    PRIMARY KEY (id_product, id_image)
);
CREATE TABLE wishlist(
    id_user INTEGER NOT NULL REFERENCES authenticated_user(id) ON UPDATE CASCADE,
    id_product INTEGER NOT NULL REFERENCES product(id) ON UPDATE CASCADE
);
CREATE TABLE review(
    id SERIAL PRIMARY KEY,
    evaluation SMALLINT NOT NULL CHECK (
        evaluation > 0
        AND evaluation <= 5
    ),
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    date TIMESTAMP NOT NULL,
    id_user INTEGER REFERENCES authenticated_user(id) ON UPDATE CASCADE,
    id_product INTEGER NOT NULL REFERENCES product(id) ON UPDATE CASCADE
);
CREATE TABLE user_like(
    id_user INTEGER REFERENCES authenticated_user(id) ON UPDATE CASCADE,
    id_review INTEGER NOT NULL REFERENCES review(id) ON UPDATE CASCADE,
    PRIMARY KEY (id_user, id_review)
);
CREATE TABLE report(
    id SERIAL PRIMARY KEY,
    description TEXT NOT NULL,
    resolved boolean NOT NULL DEFAULT FALSE,
    report_date TIMESTAMP NOT NULL,
    id_review INTEGER REFERENCES review(id) ON UPDATE CASCADE,
    id_user INTEGER REFERENCES authenticated_user(id) ON UPDATE CASCADE
);
CREATE TABLE promotion(
    id SERIAL PRIMARY KEY,
    discount NUMERIC NOT NULL CHECK (
        discount > 0
        AND discount < 100
    ),
    start_date  TIMESTAMP NOT NULL,
    final_date TIMESTAMP NOT NULL CHECK (final_date > start_date)
);
CREATE TABLE promotion_product(
    id_promotion INTEGER NOT NULL REFERENCES promotion(id) ON UPDATE CASCADE,
    id_product INTEGER NOT NULL REFERENCES product(id) ON UPDATE CASCADE,
    PRIMARY KEY (id_promotion, id_product)
);
CREATE TABLE size(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL CONSTRAINT size_unique UNIQUE
);
CREATE TABLE color(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL CONSTRAINT color_unique UNIQUE
);
CREATE TABLE stock(
    stock SMALLINT NOT NULL CHECK (stock >= 0),
    id_product INTEGER NOT NULL REFERENCES product(id) ON UPDATE CASCADE,
    id_size INTEGER NOT NULL REFERENCES size(id) ON UPDATE CASCADE,
    id_color INTEGER NOT NULL REFERENCES color(id) ON UPDATE CASCADE
);
CREATE TABLE details(
    id SERIAL PRIMARY KEY,
    quantity SMALLINT NOT NULL CHECK (quantity > 0),
    id_product INTEGER NOT NULL REFERENCES product(id) ON UPDATE CASCADE,
    id_size INTEGER NOT NULL REFERENCES size(id) ON UPDATE CASCADE,
    id_color INTEGER NOT NULL REFERENCES color(id) ON UPDATE CASCADE
);
CREATE TABLE user_order(
    id SERIAL PRIMARY KEY,
    status order_state_type NOT NULL DEFAULT 'Shopping Cart',
    date TIMESTAMP NOT NULL,
    id_user INTEGER REFERENCES authenticated_user(id) ON UPDATE CASCADE,
    id_address INTEGER REFERENCES address(id) ON UPDATE CASCADE,
    id_card INTEGER REFERENCES card(id) ON UPDATE CASCADE
);
CREATE TABLE order_details(
    id_order INTEGER NOT NULL REFERENCES user_order(id) ON UPDATE CASCADE,
    id_details INTEGER NOT NULL REFERENCES details(id) ON UPDATE CASCADE,
    PRIMARY KEY (id_order, id_details)
);
-----------------------------------------------------------------------------------------------

--INDICES

-- Index na tabela user_order do parametro id_user

CREATE INDEX user_order_idx ON user_order USING btree (id_user);
CLUSTER user_order USING user_order_idx;

-- Index na tabela stock do parametro id_product

CREATE INDEX product_stock_idx ON stock USING hash (id_product);

-- Index na tabela promotion do parametro final_date

CREATE INDEX final_date_promo_idx ON promotion USING btree (final_date);

--FULL-TEXT SEARCH INDICES 

-- Full-text search indice na tabela product dos parametros name e description

ALTER TABLE product
ADD COLUMN tsvectors TSVECTOR;
    
CREATE FUNCTION product_search_update() RETURNS TRIGGER AS $$
BEGIN
  IF TG_OP = 'INSERT' THEN
    NEW.tsvectors = (
      setweight(to_tsvector('english', NEW.name), 'A') ||
      setweight(to_tsvector('english', NEW.description), 'B')
    );
  END IF;
  IF TG_OP = 'UPDATE' THEN
      IF (NEW.name <> OLD.name OR NEW.description <> OLD.description) THEN
        NEW.tsvectors = (
          setweight(to_tsvector('english', NEW.name), 'A') ||
          setweight(to_tsvector('english', NEW.description), 'B')
        );
      END IF;
  END IF;
  RETURN NEW;
END $$
LANGUAGE plpgsql;
    
CREATE TRIGGER product_search_update
  BEFORE INSERT OR UPDATE ON product
  FOR EACH ROW
  EXECUTE PROCEDURE product_search_update();
     
CREATE INDEX search_idx ON product USING GIN (tsvectors);


--TRIGGERS and User Defined Functions

-- Verificar o stock dos produtos no momento da adição ao carrinho

CREATE FUNCTION check_stock(Product details)
RETURNS INTEGER AS
$$ BEGIN
    IF Product.quantity = 0 THEN
        RAISE EXCEPTION 'Product out of stock';
    END IF;
    RETURN 1;
END; $$
LANGUAGE plpgsql;

-- Adicionar um artigo ao carrinho

CREATE FUNCTION add_product_to_cart(Cart user_order, Product details)
RETURNS user_order AS
$$ BEGIN
    IF Cart.state = 'Shopping Cart' THEN
        IF check_stock(Product) = 1
        THEN
            INSERT INTO order_details VALUES (Cart.id, Product.id);
            UPDATE details SET quantity = quantity - 1 WHERE id = Product.id;
        RETURN Cart;
    ELSE
        RAISE EXCEPTION 'Error adding product to cart';
    END IF;
END; $$
LANGUAGE plpgsql;

-- Remover um artigo ao carrinho

CREATE FUNCTION remove_product_from_cart(Cart user_order, Product details)
RETURNS user_order AS
$$ BEGIN
    IF Cart.state = 'Shopping Cart' THEN
        DELETE FROM order_details WHERE id_order = Cart.id AND id_details = Product.id;
        UPDATE details SET quantity = quantity + 1 WHERE id = Product.id;
        RETURN Cart;
    ELSE
        RAISE EXCEPTION 'Error removing product from cart';
    END IF;
END; $$
LANGUAGE plpgsql;

-- Retornar o preço de uma order já com as promoções aplicadas

CREATE FUNCTION product_price_with_promotion(Product product, Promotion promotion)
RETURNS NUMERIC AS
$$ BEGIN
    RETURN Product.price * (1 - Promotion.discount);
END; $$
LANGUAGE plpgsql;

-- Ao apagar a conta de um utilizador toda a informação partilhada (encomendas, gostos, reviews) é mantida

CREATE FUNCTION delete_user_information()
RETURNS TRIGGER AS
$$ BEGIN
    UPDATE report SET id_user = NULL WHERE id_user = OLD.id_user;
    UPDATE review SET id_user = NULL WHERE id_user = OLD.id_user;
    UPDATE user_like SET id_user = NULL WHERE id_user = OLD.id_user;
    DELETE FROM wishlist WHERE id_user = OLD.id_user;
    UPDATE user_order SET id_user = NULL, 
                          id_address = NULL, 
                          id_card = NULL 
                          WHERE id_user = OLD.id_user;
    RETURN OLD;
END; $$
LANGUAGE plpgsql;

CREATE TRIGGER delete_user_account 
AFTER DELETE ON authenticated_user
FOR EACH ROW
EXECUTE PROCEDURE delete_user_information();

-- Verificar se um utilizador já comprou o produto antes de fazer uma review

CREATE FUNCTION check_review_privileges() 
RETURNS TRIGGER AS
$$ BEGIN
    IF NOT EXISTS (SELECT * 
                   FROM (SELECT DISTINCT id_user, id_product, id_size, id_color
                        FROM user_order, order_details, details 
                        WHERE user_order.id = order_details.id_order AND order_details.id_details = details.id
                        ORDER BY id_user, id_product, id_size, id_color) AS user_purchases
                   WHERE NEW.id_user = user_purchases.id_user AND NEW.id_product = user_purchases.id_product) 
                   -- se quisermos especificar o tamanho e cor podemos adicionar aqui
    THEN
        RAISE EXCEPTION 'An item can only be reviewed if it has been purchased';
    END IF;
    RETURN NEW;
END; $$
LANGUAGE plpgsql;

CREATE TRIGGER before_review_insert
BEFORE INSERT ON review
FOR EACH ROW
EXECUTE PROCEDURE check_review_privileges();

-- O utilizador não pode meter um like na própia review

CREATE FUNCTION check_like_privileges()
RETURNS TRIGGER AS
$$ BEGIN
    IF EXISTS (SELECT id_user 
               FROM review 
               WHERE id_review = NEW.id_review AND id_user = NEW.id_user) 
    THEN
        RAISE EXCEPTION 'A user cannot like his own review';
    END IF;
    RETURN NEW;
END; $$
LANGUAGE plpgsql;

CREATE TRIGGER before_like_insert
BEFORE INSERT ON user_like
FOR EACH ROW
EXECUTE PROCEDURE check_like_privileges();

-- Um utilizador não pode reportar a sua review 

CREATE FUNCTION check_report_privileges()
RETURNS TRIGGER AS
$$ BEGIN
    IF EXISTS (SELECT id_user 
               FROM review 
               WHERE id_review = NEW.id_review AND id_user = NEW.id_user) 
    THEN
        RAISE EXCEPTION 'A user cannot report his own review';
    END IF;
    RETURN NEW;
END; $$
LANGUAGE plpgsql;

CREATE TRIGGER before_report_insert
BEFORE INSERT ON report
FOR EACH ROW 
EXECUTE PROCEDURE check_report_privileges();

-- verificar se uma order com estado diferente de "Shopping Cart" tem todos os parametros preenchidos

CREATE FUNCTION order_parameters()
RETURNS TRIGGER AS
$$ BEGIN
    IF (OLD.state = 'Shopping Cart' AND NEW.state <> 'Shopping Cart')
    THEN
        IF NEW.id_user IS NULL OR NEW.id_address IS NULL OR NEW.id_card IS NULL 
        THEN
            RAISE EXCEPTION 'Order must have an user, an address and a card';
        END IF;
    END IF;
    RETURN NEW;    
END; $$
LANGUAGE plpgsql;

CREATE TRIGGER check_order_parameters
BEFORE UPDATE ON user_order
FOR EACH ROW 
EXECUTE PROCEDURE order_parameters();

---------------------------------------------------------------------------------------------------------------------
--User-Defined Functions:
-- Adicionar um artigo ao carrinho: FEITO
-- Remover um artigo do carrinho: FEITO
-- Retornar o preço de uma order já com as promoções aplicadas FEITO
---------------------------------------------------------------------------------------------------------------------
--Triggers:
-- Ao apagar a conta de um utilizador toda a informação partilhada (encomendas, gostos, reviews) é mantida FEITO
-- Verificar se um utilizador já comprou o produto antes de fazer uma review FEITO
-- O utilizador não pode meter um like na própia review FEITO
-- Verificar o stock dos produtos no momento da adição ao carrinho FEITO
-- Um utilizador não pode reportar a sua review FEITO
-- verificar se uma order com estado diferente de "Shopping Cart" tem todos os parametros preenchidos FEITO
