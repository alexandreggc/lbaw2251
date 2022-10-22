--DROP's
DROP TYPE IF EXISTS admin_type;
DROP TYPE IF EXISTS order_state_type;
DROP TYPE IF EXISTS notification_type;
DROP TYPE IF EXISTS report_type;

DROP TABLE IF EXISTS image;
DROP TABLE IF EXISTS authenticated_user;
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS notification;
DROP TABLE IF EXISTS admin_notification;
DROP TABLE IF EXISTS user_notification;
DROP TABLE IF EXISTS card;
DROP TABLE IF EXISTS country;
DROP TABLE IF EXISTS address;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS product_image;
DROP TABLE IF EXISTS wishlist;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS report;
DROP TABLE IF EXISTS promotion;
DROP TABLE IF EXISTS promotion_product;
DROP TABLE IF EXISTS size;
DROP TABLE IF EXISTS color;
DROP TABLE IF EXISTS stock;
DROP TABLE IF EXISTS details;
DROP TABLE IF EXISTS user_order;
DROP TABLE IF EXISTS order_details;

--TYPE's
CREATE TYPE admin_type AS ENUM ('Collaborator', 'Technician');
CREATE TYPE order_state_type AS ENUM ('Shopping Cart',
                                      'Pending',
                                      'In Progress',
                                      'Completed',
                                      'Cancelled');
CREATE TYPE notification_type AS ENUM ('New Promotion',
                                       'New Collection',
                                       'Recommended Product', 
                                       'Change in Order State', 
                                       'Payment accept', 
                                       'Product in Wishlist Available', 
                                       'Price Change of Item in Shopping Cart');
CREATE TYPE report_type AS ENUM ('Technical', 'Review');

--CREATE's
CREATE TABLE image (
    id SERIAL PRIMARY KEY,
    file TEXT NOT NULL CONSTRAINT image_unique UNIQUE
);

CREATE TABLE authenticated_user (
    id SERIAL PRIMARY KEY,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    email TEXT NOT NULL CONSTRAINT email_unique UNIQUE,
    password TEXT NOT NULL,
    birth_date DATE,
    gender TEXT,
    id_image INTEGER REFERENCES image(id) ON UPDATE CASCADE --VER TRIGGER
);

CREATE TABLE admin(
    id SERIAL PRIMARY KEY,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    email TEXT NOT NULL CONSTRAINT email_unique UNIQUE,
    password TEXT NOT NULL,
    birth_date DATE,
    gender TEXT,
    id_image INTEGER REFERENCES image(id) ON UPDATE CASCADE, --VER TRIGGER
    TYPE admin_type NOT NULL
);

CREATE TABLE notification(
    id SERIAL PRIMARY KEY,
    type TEXT NOT NULL,
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
    nickname TEXT CONSTRAINT payment_method_unique UNIQUE,
    name TEXT NOT NULL,
    number TEXT NOT NULL CONSTRAINT cart_unique UNIQUE,
    month SMALLINT NOT NULL,
    year SMALLINT NOT NULL,
    code SMALLINT NOT NULL CONSTRAINT code_unique UNIQUE,
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
    evaluation SMALLINT NOT NULL CHECK (evaluation > 0 AND evaluation <= 5),
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    date TIMESTAMP NOT NULL,
    id_user INTEGER NOT NULL REFERENCES authenticated_user(id) ON UPDATE CASCADE,
    id_product INTEGER NOT NULL REFERENCES product(id) ON UPDATE CASCADE
);

CREATE TABLE report(
    id SERIAL PRIMARY KEY,
    description TEXT NOT NULL,
    resolved boolean NOT NULL DEFAULT FALSE,
    report_date TIMESTAMP NOT NULL,
    TYPE report_type NOT NULL, 
    id_review INTEGER REFERENCES review(id) ON UPDATE CASCADE,
    id_user INTEGER REFERENCES authenticated_user(id) ON UPDATE CASCADE
);

CREATE TABLE promotion(
    id SERIAL PRIMARY KEY,
    discount NUMERIC NOT NULL CHECK (discount > 0 AND discount < 100),
    start_date TIMESTAMP NOT NULL,
    final_date TIMESTAMP NOT NULL CHECK (final_date > start_date)
);

CREATE TABLE promotion_product(
    id_promo INTEGER NOT NULL REFERENCES promotion(id) ON UPDATE CASCADE,
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
    quantity SMALLINT NOT NULL CHECK (quantity > 0),
    id_product INTEGER NOT NULL REFERENCES product(id) ON UPDATE CASCADE,
    id_size INTEGER NOT NULL REFERENCES size(id) ON UPDATE CASCADE,
    id_color INTEGER NOT NULL REFERENCES color(id) ON UPDATE CASCADE
);

CREATE TABLE user_order(
    id SERIAL PRIMARY KEY,
    TYPE order_state NOT NULL DEFAULT 'Shopping Cart',
    date TIMESTAMP NOT NULL,
    id_user INTEGER NOT NULL REFERENCES authenticated_user(id) ON UPDATE CASCADE,
    id_address INTEGER REFERENCES address(id) ON UPDATE CASCADE,
    id_card INTEGER REFERENCES card(id) ON UPDATE CASCADE
);

CREATE TABLE order_details(
    id_order INTEGER NOT NULL REFERENCES user_order(id) ON UPDATE CASCADE,
    id_details INTEGER NOT NULL REFERENCES details(id) ON UPDATE CASCADE,
    PRIMARY KEY (id_order, id_details)
);


--verificar se password não é palavra reservada