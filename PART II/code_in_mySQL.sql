USE WDS_schema;

CREATE TABLE a_invoice (
    a_inv_id        INT NOT NULL COMMENT 'Auto insurance''s invoice number',
    a_inv_date      DATETIME NOT NULL COMMENT 'Auto insurance''s invoice date',
    a_inv_due_date  DATETIME NOT NULL COMMENT 'Auto insurance''s payment due date',
    a_inv_amount    DECIMAL(7, 2) NOT NULL COMMENT 'Auto insurance''s invoice amount',
    c_id            INT NOT NULL
);



ALTER TABLE a_invoice ADD CONSTRAINT a_invoice_pk PRIMARY KEY ( a_inv_id );

CREATE TABLE a_payment (
    a_payment_id  INT NOT NULL COMMENT 'Auto insurance''s payment number',
    a_pay_date    DATETIME NOT NULL COMMENT 'Auto insurance''s payment date',
    a_pay_method  VARCHAR(6) NOT NULL COMMENT 'Auto insurance''s method of payment. The pamyment method shoud be one of the following:“PayPal”, “Credit”, “Debit”, “Check”.',
    a_pay_amount  INT NOT NULL COMMENT 'Auto insurance''s payment amount',
    a_inv_id      INT NOT NULL
);



ALTER TABLE a_payment ADD CONSTRAINT a_payment_pk PRIMARY KEY ( a_payment_id );

CREATE TABLE auto_insurance (
    c_id          INT NOT NULL COMMENT 'Customer''s ID',
    a_start_date  DATETIME NOT NULL COMMENT 'Auto insurance''s start date',
    a_end_date    DATETIME NOT NULL COMMENT 'Auto insurance''s end date',
    a_premium     DECIMAL(10, 2) NOT NULL COMMENT 'Auto insurance''s premium amount',
    a_status      VARCHAR(1) NOT NULL COMMENT 'Auto policy insurance status. "C" for current and "P" for expired.'
);



ALTER TABLE auto_insurance ADD CONSTRAINT auto_insurance_pk PRIMARY KEY ( c_id );

CREATE TABLE customer (
    c_id         INT NOT NULL COMMENT 'Customer''s ID',
    username     VARCHAR(20) NOT NULL COMMENT 'The username in database associate with the customer',
    password     VARCHAR(60) NOT NULL COMMENT 'The hashed password', 
    c_fname      VARCHAR(30) NOT NULL COMMENT 'Customer''s first name',
    c_lname      VARCHAR(30) NOT NULL COMMENT 'Customer''s last name',
    gender       VARCHAR(1) COMMENT 'Customer''s gender. “M”, or “F” representing “Male” or “Female” respectively.',
    martial_sta  VARCHAR(1) NOT NULL COMMENT 'Customer''s martial status. “M”, “S”, or “W”, representing “Married”, “Single”, and “Widow/Widower” respectively. ',
    c_type       VARCHAR(2)  COMMENT 'Customer type',
    c_street_ad  VARCHAR(30) NOT NULL COMMENT 'Customer''s street  address',
    c_city       VARCHAR(30) NOT NULL COMMENT 'The city of the customer''s address',
    c_state      VARCHAR(2) NOT NULL COMMENT 'The state abbr of the customer''s address',
    c_zipcode    VARCHAR(5) NOT NULL COMMENT ' The 5-digit zip code of the customer''s address'
);



ALTER TABLE customer ADD CONSTRAINT customer_pk PRIMARY KEY ( c_id );

CREATE TABLE driver (
    driver_id     BIGINT NOT NULL COMMENT 'Driver''s unique identifier',
    license_no    VARCHAR(30) NOT NULL COMMENT 'Driver''s license number',
    driver_fname  VARCHAR(30) NOT NULL COMMENT 'Driver''s first name',
    driver_lname  VARCHAR(30) NOT NULL COMMENT 'Driver''s last name',
    driver_bdate  DATETIME NOT NULL COMMENT 'Driver''s birthdate'
);



ALTER TABLE driver ADD CONSTRAINT driver_pk PRIMARY KEY ( driver_id );

CREATE TABLE h_invoice (
    h_inv_id        INT NOT NULL COMMENT 'Home insurance''s invoice number',
    h_inv_date      DATETIME NOT NULL COMMENT 'Home insurance''s invoice date',
    h_inv_due_date  DATETIME NOT NULL COMMENT 'Home insurance''s payment due date',
    h_inv_amount    DECIMAL(7, 2) NOT NULL COMMENT 'Home insurance''s invoice amount',
    c_id            INT NOT NULL
);



ALTER TABLE h_invoice ADD CONSTRAINT h_invoice_pk PRIMARY KEY ( h_inv_id );

CREATE TABLE h_payment (
    h_payment_id  INT NOT NULL COMMENT 'Home insurance''s payment number',
    h_pay_date    DATETIME NOT NULL COMMENT 'Home insurance''s payment date',
    h_pay_method  VARCHAR(6) NOT NULL COMMENT 'Home insurace''s method of payment. The pamyment method shoud be one of the following:“PayPal”, “Credit”, “Debit”, “Check”.',
    h_pay_amount  DECIMAL(7, 2) NOT NULL COMMENT 'Home insurance''s payment amount',
    h_inv_id      INT NOT NULL
);



ALTER TABLE h_payment ADD CONSTRAINT h_payment_pk PRIMARY KEY ( h_payment_id );

CREATE TABLE home (
    home_id    INT NOT NULL COMMENT 'Home''s ID',
    pur_date   DATETIME NOT NULL COMMENT 'Home''s purchase date',
    pur_value  DECIMAL(10, 2) NOT NULL COMMENT 'Home''s purchase value',
    homearea   DECIMAL(8, 2) NOT NULL COMMENT 'Home area in sq.ft.',
    hometype   VARCHAR(1) NOT NULL COMMENT 'Type of home. S,M,C,T representing Single family, Multi Family, Condominium, Town house respectively',
    auto_fire  TINYINT NOT NULL COMMENT 'Indicate whether there is a Auto fire notification',
    sec_sys    TINYINT NOT NULL COMMENT 'Indicate whether there is a home security system',
    swim_pool  VARCHAR(1) COMMENT 'Swimming pool. "U", "O", "I", "M", null representing underground swimming pool, overground swimming pool, indoor swimming pool, multiple swimming pool and no swimming pool respectively',
    basement   TINYINT NOT NULL COMMENT 'Indicate whether there is a basement',
    c_id       INT NOT NULL
);



ALTER TABLE home ADD CONSTRAINT home_pk PRIMARY KEY ( home_id );

CREATE TABLE home_insurance (
    c_id          INT NOT NULL COMMENT 'Customer''s ID',
    h_start_date  DATETIME NOT NULL COMMENT 'Home insurance''s start date',
    h_end_date    DATETIME NOT NULL COMMENT 'Home insurance''s end date',
    h_premium     DECIMAL(10, 2) NOT NULL COMMENT 'Home insurance''s premium amount',
    h_status      VARCHAR(1) NOT NULL COMMENT 'Home policy insurance status. "C" for current and "P" for expired.'
);



ALTER TABLE home_insurance ADD CONSTRAINT home_insurance_pk PRIMARY KEY ( c_id );

CREATE TABLE vehicle (
    vehicle_id  BIGINT NOT NULL COMMENT 'The unique numerical identifier of the vehice',
    vin         VARCHAR(17) NOT NULL COMMENT 'Vehicle identification number.',
    make        VARCHAR(40) NOT NULL COMMENT 'Vehicle''s make',
    model       VARCHAR(40) NOT NULL COMMENT 'Vehicle''s model',
    year        SMALLINT NOT NULL COMMENT 'Vehicle''s year',
    v_status    VARCHAR(1) NOT NULL COMMENT 'Status of vehicle. “L”, “F”, or “O” representing “Leased”, Financed”, “and Owned’.',
    c_id        INT NOT NULL
);


ALTER TABLE vehicle ADD CONSTRAINT vehicle_pk PRIMARY KEY ( vehicle_id );

CREATE TABLE vehicle_driver (
    driver_id   BIGINT NOT NULL,
    vehicle_id  BIGINT NOT NULL
);

ALTER TABLE vehicle_driver ADD CONSTRAINT vehicle_driver_pk PRIMARY KEY ( driver_id,
                                                                          vehicle_id );

ALTER TABLE a_invoice
    ADD CONSTRAINT a_invoice_auto_insurance_fk FOREIGN KEY ( c_id )
        REFERENCES auto_insurance ( c_id )
        ON DELETE CASCADE;

ALTER TABLE a_payment
    ADD CONSTRAINT a_payment_a_invoice_fk FOREIGN KEY ( a_inv_id )
        REFERENCES a_invoice ( a_inv_id )
        ON DELETE CASCADE;

ALTER TABLE auto_insurance
    ADD CONSTRAINT auto_insurance_customer_fk FOREIGN KEY ( c_id )
        REFERENCES customer ( c_id )
        ON DELETE CASCADE;

ALTER TABLE h_invoice
    ADD CONSTRAINT h_invoice_home_insurance_fk FOREIGN KEY ( c_id )
        REFERENCES home_insurance ( c_id )
        ON DELETE CASCADE;

ALTER TABLE h_payment
    ADD CONSTRAINT h_payment_h_invoice_fk FOREIGN KEY ( h_inv_id )
        REFERENCES h_invoice ( h_inv_id )
        ON DELETE CASCADE;

ALTER TABLE home
    ADD CONSTRAINT home_home_insurance_fk FOREIGN KEY ( c_id )
        REFERENCES home_insurance ( c_id )
        ON DELETE CASCADE;

ALTER TABLE home_insurance
    ADD CONSTRAINT home_insurance_customer_fk FOREIGN KEY ( c_id )
        REFERENCES customer ( c_id )
        ON DELETE CASCADE;

ALTER TABLE vehicle
    ADD CONSTRAINT vehicle_auto_insurance_fk FOREIGN KEY ( c_id )
        REFERENCES auto_insurance ( c_id )
        ON DELETE CASCADE;

ALTER TABLE vehicle_driver
    ADD CONSTRAINT vehicle_driver_driver_fk FOREIGN KEY ( driver_id )
        REFERENCES driver ( driver_id )
        ON DELETE CASCADE;

ALTER TABLE vehicle_driver
    ADD CONSTRAINT vehicle_driver_vehicle_fk FOREIGN KEY ( vehicle_id )
        REFERENCES vehicle ( vehicle_id )
        ON DELETE CASCADE;


ALTER TABLE customer
    ADD CONSTRAINT ch_inh_customer CHECK ( c_type IN (
        'A',
        'H',
        'AH'
    ) );


delimiter //

DROP TRIGGER IF EXISTS home_insurance_customer_FK//
CREATE TRIGGER home_insurance_customer_FK BEFORE INSERT ON home_insurance
    FOR EACH ROW
BEGIN
    declare msg varchar(128);
    SELECT
        a.c_type
    INTO @cus_type
    FROM 
        customer a
    WHERE
        a.c_id = NEW.c_id;
        
    IF ( @cus_type IS NULL OR (@cus_type <> 'H' AND @cus_type <> 'AH') ) THEN
        set msg = 'FK HOME_INSURANCE_CUSTOMER_FK in Table home_insurance discriminator column C_TYPE does not have value H or AH';
        signal sqlstate '45000' set message_text = msg;
    END IF;
END;//
delimiter ;

delimiter //
DROP TRIGGER IF EXISTS auto_insurance_customer_FK//
CREATE TRIGGER auto_insurance_customer_FK BEFORE INSERT ON auto_insurance
    FOR EACH ROW
BEGIN
    declare msg varchar(128);
    SELECT
        a.c_type
    INTO @cus_type
    FROM 
        customer a
    WHERE
        a.c_id = NEW.c_id;
        
    IF ( @cus_type IS NULL OR (@cus_type <> 'A' AND @cus_type <> 'AH') ) THEN
        set msg = 'FK HOME_INSURANCE_CUSTOMER_FK in Table auto_insurance discriminator column C_TYPE does not have value A or AH';
        signal sqlstate '45000' set message_text = msg;
    END IF;
END;//
delimiter ;


