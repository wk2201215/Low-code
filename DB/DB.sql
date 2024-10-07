create table acount(
    acount_id VARCHAR(254) PRIMARY KEY NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    authority TINYINT NOT NULL,
    delete_flag BIT(1) DEFAULT 0 NOT NULL
    );