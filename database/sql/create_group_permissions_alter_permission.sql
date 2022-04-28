
-- http://pma.dev.1ly.co/
-- pma_hopnv/Jasj12iasdck123


use appotapay_cms;

CREATE TABLE group_permissions (
    id int NOT NULL AUTO_INCREMENT primary key,
    group_name varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci
);

ALTER TABLE permissions
ADD id_group_permission int,
ADD CONSTRAINT FK_permissions
FOREIGN KEY (id_group_permission) REFERENCES group_permissions(id) ON DELETE SET NULL;



CREATE TABLE am_partner_matching(
    id int NOT NULL AUTO_INCREMENT primary key,
    email varchar(255) NOT NULL UNIQUE,
    partner_code varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE users
ADD is_am ENUM('yes', 'no');
