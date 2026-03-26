CREATE DATABASE IF NOT EXISTS cultureconnect;
USE cultureconnect;

CREATE TABLE council (
  counc_id_pk INT AUTO_INCREMENT PRIMARY KEY,
  counc_name VARCHAR(100) NOT NULL,
  counc_url VARCHAR(100),
  counc_email VARCHAR(100)
);

CREATE TABLE location (
  loc_id_pk INT AUTO_INCREMENT PRIMARY KEY,
  loc_name VARCHAR(100) NOT NULL,
  counc_id_pk INT,
  FOREIGN KEY (counc_id_pk) REFERENCES council(counc_id_pk)
);

CREATE TABLE user (
  user_id_pk INT AUTO_INCREMENT PRIMARY KEY,
  user_email VARCHAR(150) NOT NULL UNIQUE,
  user_title VARCHAR(20),
  user_first_name VARCHAR(50) NOT NULL,
  user_last_name VARCHAR(50) NOT NULL,
  user_password VARCHAR(255) NOT NULL,
  user_role INT NOT NULL,
  role_id INT NOT NULL
);

CREATE TABLE resident (
  res_id_pk INT AUTO_INCREMENT PRIMARY KEY,
  user_id_pk INT NOT NULL,
  loc_id_pk INT NOT NULL,
  res_yob INT NOT NULL,
  res_gender VARCHAR(10) NOT NULL,
  FOREIGN KEY (user_id_pk) REFERENCES user(user_id_pk),
  FOREIGN KEY (loc_id_pk) REFERENCES location(loc_id_pk)
);

CREATE TABLE business (
  bus_id_pk INT AUTO_INCREMENT PRIMARY KEY,
  bus_name VARCHAR(100) NOT NULL,
  counc_id_pk INT NOT NULL,
  bus_phone VARCHAR(20),
  bus_email VARCHAR(50),
  bus_url VARCHAR(100),
  bus_bio VARCHAR(200),
  FOREIGN KEY (counc_id_pk) REFERENCES council(counc_id_pk)
);

CREATE TABLE interests (
  int_id_pk INT AUTO_INCREMENT PRIMARY KEY,
  int_name VARCHAR(100) NOT NULL,
  int_product_or_service INT NOT NULL
);

CREATE TABLE resident_interests (
  ri_id_pk INT AUTO_INCREMENT PRIMARY KEY,
  res_id_pk INT NOT NULL,
  int_id_pk INT NOT NULL,
  FOREIGN KEY (res_id_pk) REFERENCES resident(res_id_pk),
  FOREIGN KEY (int_id_pk) REFERENCES interests(int_id_pk)
);

CREATE TABLE offering_prices (
  of_price_range INT AUTO_INCREMENT PRIMARY KEY,
  of_price_details VARCHAR(100)
);

CREATE TABLE offering (
  of_id_pk INT AUTO_INCREMENT PRIMARY KEY,
  bus_id_pk INT NOT NULL,
  loc_id_pk INT NOT NULL,
  of_name VARCHAR(150) NOT NULL,
  of_category INT NOT NULL,
  of_description VARCHAR(100),
  of_details VARCHAR(100),
  of_cultural_benefits VARCHAR(100),
  of_price_range INT NOT NULL,
  FOREIGN KEY (bus_id_pk) REFERENCES business(bus_id_pk),
  FOREIGN KEY (loc_id_pk) REFERENCES location(loc_id_pk),
  FOREIGN KEY (of_category) REFERENCES interests(int_id_pk),
  FOREIGN KEY (of_price_range) REFERENCES offering_prices(of_price_range)
);

