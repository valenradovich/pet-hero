create database if not exists testdbpets;

use testdbpets;

CREATE TABLE IF NOT EXISTS userTypes
(
    id_userTypes INT NOT NULL AUTO_INCREMENT,
    types varchar(50) NOT NULL,

    CONSTRAINT pk_usertypes PRIMARY KEY (id_userTypes),
    CONSTRAINT unq_types UNIQUE(types)

);

create table if not exists datesRange
(
    id_dateRange int  not null auto_increment,
    start_date   date not null,
    end_date     date not null,
    constraint pk_datesrange primary key (id_dateRange)
);

create table if not exists petTypes (
    id_petType int not null  auto_increment,
    type varchar(50) not null,
    constraint pk_petType primary key (id_petType),
    constraint unq_types_pet unique (type)
);

create table if not exists sizes (
    id_size int not null auto_increment,
    description varchar(50) not null,
    constraint pk_size primary key (id_size),
    constraint unq_size unique (description)
);

CREATE TABLE IF NOT EXISTS provinces (
  id_province int NOT NULL AUTO_INCREMENT,
  province_name varchar(255) NOT NULL,
  constraint pk_provincia primary key(id_province),
  constraint unq_province unique(province_name)
);

CREATE TABLE IF NOT EXISTS cities (
  id_city int NOT NULL AUTO_INCREMENT,
  id_province int NOT NULL,
  city_name varchar(255) NOT NULL,
  constraint pk_city primary key(id_city),
  constraint fk_city foreign key(id_province) references provinces(id_province)
);

CREATE TABLE IF NOT EXISTS users
(
    id_user      int          NOT NULL AUTO_INCREMENT,
    first_name   varchar(100) not null,
    last_name    varchar(100) not null,
    password     varchar(50)  not null,
    dni          varchar(10)  not null,
    email        varchar(200) not null,
    phone        varchar(10)  not null,
    photo        varchar(100),
    id_province  int          not null,
    id_city      int          not null,
    id_user_type int          not null,
    constraint pk_user primary key (id_user),
    constraint unq_dni_user unique (dni),
    constraint unq_email_user unique (email),
    constraint fk_user_province foreign key (id_province) references provinces (id_province),
    constraint fk_user_city foreign key (id_city) references cities (id_city),
    constraint fk_user_type foreign key (id_user_type) references userTypes (id_userTypes)
);


CREATE TABLE IF NOT EXISTS owners (
  id_owner int NOT NULL AUTO_INCREMENT,
  id_user int NOT NULL,
  constraint pk_id_owners primary key (id_owner),
  constraint fk_id_user foreign key (id_user) references users(id_user)
);

  CREATE TABLE IF NOT EXISTS keepers (
  id_keeper int NOT NULL AUTO_INCREMENT,
  id_user int NOT NULL,
  id_date_work int not null,
  daily_pay float not null,
  constraint pk_id_keeper primary key (id_keeper),
  constraint fk_id_user_keeper foreign key (id_user) references users(id_user),
  constraint fk_id_date foreign key (id_date_work) references datesRange(id_dateRange)
  );

 CREATE TABLE IF NOT EXISTS breeds (
    id_breed int not null auto_increment,
    name_breed varchar(30) not null,
    constraint pk_breed primary key (id_breed),
    constraint unq_breed_name unique (name_breed)
);

CREATE TABLE IF NOT EXISTS pets (
    id_pet int not null auto_increment,
    name_pet varchar(30) not null,
    photo varchar(100) not null,
    id_breed int not null,
    id_size int not null,
    id_pet_type int not null,
    vaccines varchar(100) not null,
    video varchar(100),
    description text not null,
    constraint pk_id_pet primary key (id_pet),
    constraint fk_breed_pet foreign key(id_breed) references breeds(id_breed),
    constraint fk_size_pet foreign key(id_size) references sizes(id_size),
    constraint fk_id_pet_type foreign key(id_pet_type) references petTypes(id_petType)
);

 CREATE TABLE IF NOT EXISTS pet_x_owners (
    id_pet_x_owner int not null auto_increment,
    id_owner int not null,
    id_pet int not null,
    constraint pk_pet_x_owner primary key (id_pet_x_owner),
    constraint fk_id_owner foreign key(id_owner) references owners(id_owner),
    constraint fk_id_pet foreign key(id_pet) references pets(id_pet)
);

CREATE TABLE IF NOT EXISTS sizes_x_keepers (
    id_sizes_x_keeper int not null auto_increment,
    id_keeper int not null,
    id_size int not null,
    constraint pk_sizes_x_keeper primary key (id_sizes_x_keeper),
    constraint fk_id_keeper foreign key(id_keeper) references keepers(id_keeper),
    constraint fk_id_size foreign key(id_size) references sizes(id_size)
);

CREATE TABLE IF NOT EXISTS breeds_x_keepers (
    id_breed_x_keeper int not null auto_increment,
    id_keeper int not null,
    id_breed int not null,
    constraint pk_sizes_x_keeper primary key (id_breed_x_keeper),
    constraint fk_id_keeper_breed foreign key(id_keeper) references keepers(id_keeper),
    constraint fk_id_breed foreign key(id_breed) references breeds(id_breed)
);

CREATE TABLE IF NOT EXISTS reservations (
    id_reservation int not null auto_increment,
    id_owner int not null,
    id_pet int not null,
    id_keeper int not null,
    price float not null,
    id_date int not null,
    status varchar(20) not null,
    order_date datetime default now(),
    constraint pk_id_reservation primary key(id_reservation),
    constraint fk_id_owner_reserv foreign key(id_owner) references owners(id_owner),
    constraint fk_id_keeper_reserv foreign key(id_keeper) references keepers(id_keeper),
    constraint fk_id_pet_reserv foreign key(id_pet) references pets(id_pet),
    constraint fk_id_date_reserv foreign key(id_date) references datesRange(id_dateRange)
);


CREATE TABLE IF NOT EXISTS paymentCoupons (
    id_payment_coupon int not null auto_increment,
    id_reservation int not null,
    status varchar(20) not null,
    payment_date datetime default now(),
    constraint pk_id_payment_coupon primary key(id_payment_coupon),
    constraint fk_id_reservation foreign key(id_reservation) references reservations(id_reservation)
);

DROP procedure IF EXISTS `users_add`;

DELIMITER $$

CREATE PROCEDURE users_add (IN first_name varchar(100), IN last_name VARCHAR(100), IN password VARCHAR(50), IN dni varchar(10),
                            IN email varchar(200), IN phone varchar(10), IN photo varchar(100), IN id_province int, 
                            IN id_city int, IN id_user_type int, IN address varchar(20))
BEGIN
	INSERT INTO users
        (users.first_name, users.last_name, users.password, users.dni, users.email, users.phone, users.photo, 
        users.id_province, users.id_city, users.id_user_type, users.address)
    VALUES
        (first_name, last_name, password, dni, email, phone, photo, id_province, id_city, id_user_type, address);
END $$

DELIMITER ;


DROP procedure IF EXISTS `users_get_all`;

DELIMITER $$

CREATE PROCEDURE users_get_all ()
BEGIN
	SELECT id_user, first_name, last_name, password, dni, email, phone, photo, id_province, id_city, id_user_type, address
    FROM users;
END$$

DELIMITER ;

DROP procedure IF EXISTS `users_get_all_owners`;

DELIMITER $$

CREATE PROCEDURE users_get_all_owners ()
BEGIN
	SELECT id_user, first_name, last_name, password, dni, email, phone, photo, id_province, id_city, id_user_type, address
    FROM users
    WHERE id_user_type = 1;
END$$

DELIMITER ;


DROP procedure IF EXISTS `user_remove`;

DELIMITER $$

CREATE PROCEDURE user_remove (IN id INT)
BEGIN
	DELETE 
    FROM users
    WHERE (users.id_user = id);
END$$

DELIMITER ;


DROP procedure IF EXISTS `users_get_by_email`;

DELIMITER $$

CREATE PROCEDURE users_get_by_email (IN email VARCHAR(200))
BEGIN
	SELECT users.email, users.password
    FROM users
    WHERE (users.email = email);
END$$

DELIMITER ;

DROP procedure IF EXISTS `province_get_all`;

DELIMITER $$

CREATE PROCEDURE province_get_all ()
BEGIN
	SELECT provinces.id_province, provinces.province_name
    FROM provinces;
END$$

DELIMITER ;

DROP procedure IF EXISTS `city_get_all`;

DELIMITER $$

CREATE PROCEDURE city_get_all ()
BEGIN
    SELECT cities.id_city, cities.city_name, cities.id_province
    FROM cities;
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `pets_add`;

DELIMITER $$

CREATE PROCEDURE pets_add (IN name_pet VARCHAR(30), IN photo VARCHAR(100), IN id_breed int, IN id_size int, 
                            IN id_pet_type int, IN vaccines VARCHAR(100), IN video VARCHAR(100), 
                            IN description VARCHAR(100), IN id_owner int)
BEGIN
    INSERT INTO pets 
        (pets.name_pet, pets.photo, pets.id_breed, pets.id_size, pets.id_pet_type, pets.vaccines, pets.video, 
         pets.description, pets.id_owner)
    VALUES 
        (name_pet, photo, id_breed, id_size, id_pet_type, vaccines, video, description, id_owner);
    
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `pets_get_all`;

DELIMITER $$

CREATE PROCEDURE pets_get_all ()
BEGIN
    SELECT pets.id_pet, pets.name_pet, pets.photo, pets.id_breed, pets.id_size, pets.id_pet_type, pets.vaccines, pets.video, 
           pets.description, pets.id_owner
    FROM pets;
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `pet_remove`;

DELIMITER $$

CREATE PROCEDURE pet_remove (IN id INT)
BEGIN
    DELETE 
    FROM pets
    WHERE (pets.id_pet = id);
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `pet_get_by_id`;

DELIMITER $$

CREATE PROCEDURE pet_get_by_id (IN id INT)
BEGIN
    SELECT pets.id_pet, pets.name_pet, pets.photo, pets.id_breed, pets.id_size, pets.id_pet_type, pets.vaccines, pets.video, 
           pets.description, pets.id_owner
    FROM pets
    WHERE (pets.id_pet = id);
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `get_province_and_city_by_ids`;

DELIMITER $$

CREATE PROCEDURE get_province_and_city_by_ids (IN id_province INT, IN id_city INT)
BEGIN
    SELECT provinces.province_name, cities.city_name
    FROM provinces, cities
    WHERE (provinces.id_province = id_province) AND (cities.id_city = id_city);
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS 'dates_add';

DELIMITER $$

CREATE PROCEDURE dates_add (IN start_date DATE, IN end_date DATE, IN id_keeper INT, IN status INT)
BEGIN
    INSERT INTO datesrange
        (datesrange.start_date, datesrange.end_date, datesrange.id_keeper, datesrange.status)
    VALUES
        (start_date, end_date, id_keeper, status);
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `dates_get_all`;

DELIMITER $$

CREATE PROCEDURE dates_get_all ()
BEGIN
    SELECT datesrange.id_daterange, datesrange.start_date, datesrange.end_date, datesrange.id_keeper, datesrange.status
    FROM dates;
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `dates_get_by_id`;

DELIMITER $$

CREATE PROCEDURE dates_get_by_id (IN id INT)
BEGIN
    SELECT datesrange.id_daterange, datesrange.start_date, datesrange.end_date, datesrange.id_keeper, datesrange.status
    FROM datesrange
    WHERE (datesrange.id_daterange = id);
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `dates_remove`;

DELIMITER $$

CREATE PROCEDURE dates_remove (IN id INT)
BEGIN
    DELETE 
    FROM datesrange
    WHERE (datesrange.id_daterange = id);
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `dates_get_by_id_user`;

DELIMITER $$

CREATE PROCEDURE dates_get_by_id_user (IN id INT)
BEGIN
    SELECT datesrange.id_daterange, datesrange.start_date, datesrange.end_date, datesrange.id_keeper, datesrange.status
    FROM datesrange
    WHERE (datesrange.id_keeper = id);
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `dates_get_keepers_between_dates`;

DELIMITER $$

CREATE PROCEDURE dates_get_keepers_between_dates (IN start_date DATE, IN end_date DATE)
BEGIN
    SELECT datesrange.id_daterange, datesrange.start_date, datesrange.end_date, datesrange.id_user, datesrange.status
    FROM datesrange
    WHERE (datesrange.start_date <= start_date) AND (datesrange.end_date >= start_date);
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `reservation_add`;

DELIMITER $$

CREATE PROCEDURE reservation_add (IN id_owner INT, IN id_pet INT, IN id_keeper INT, IN price FLOAT, 
                                  IN id_date INT)
BEGIN
    INSERT INTO reservations
        (reservations.id_owner, reservations.id_pet, reservations.id_keeper, reservations.price, 
         reservations.id_date)
    VALUES
        (id_owner, id_pet, id_keeper, price, id_date);
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `reservation_get_all`;

DELIMITER $$

CREATE PROCEDURE reservation_get_all ()
BEGIN
    SELECT reservations.id_reservation, reservations.id_owner, reservations.id_pet, reservations.id_keeper, 
           reservations.price, reservations.id_date
    FROM reservations;
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `reservation_get_by_id`;

DELIMITER $$

CREATE PROCEDURE reservation_get_by_id (IN id INT)
BEGIN
    SELECT reservations.id_reservation, reservations.id_owner, reservations.id_pet, reservations.id_keeper, 
           reservations.price, reservations.id_date
    FROM reservations
    WHERE (reservations.id_reservation = id);
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS `reservation_remove`;

DELIMITER $$

CREATE PROCEDURE reservation_remove (IN id INT)
BEGIN
    DELETE 
    FROM reservations
    WHERE (reservations.id_reservation = id);
END$$

DELIMITER ;



