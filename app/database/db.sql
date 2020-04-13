-- DROP TABLE IF EXISTS pradepois_user;
CREATE TABLE IF NOT EXISTS pradepois_user (
  id INT AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  provider BOOLEAN NOT NULL,
  status INT(2) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS pradepois_profile;
CREATE TABLE IF NOT EXISTS pradepois_profile (
  id INT AUTO_INCREMENT,
  id_user INT NOT NULL,
  category INT(3) NULL,
  avatar VARCHAR(40) NULL,
  name VARCHAR(255) NULL,
  username VARCHAR(255) NULL,
  company VARCHAR(255) NULL,
  phone VARCHAR(11) NULL,
  cpf VARCHAR(11) NULL,
  cnpj VARCHAR(14) NULL,
  zipcode INT(8) NOT NULL,
  address VARCHAR(255) NOT NULL,
  number VARCHAR(255) NOT NULL,
  complement VARCHAR(255) NULL,
  district VARCHAR(255) NOT NULL,
  state VARCHAR(255) NOT NULL,
  city VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY (id_user),
  UNIQUE KEY (username),
  FOREIGN KEY (id_user) REFERENCES pradepois_user(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS pradepois_service;
CREATE TABLE IF NOT EXISTS pradepois_service (
  id INT AUTO_INCREMENT,
  id_user INT NOT NULL,
  service VARCHAR(255) NOT NULL,
  description VARCHAR(255) NULL,
  value DECIMAL(9, 2) NOT NULL,
  discount DECIMAL(3, 2) NULL,
  status INT(2) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (id_user) REFERENCES pradepois_user(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- DROP TABLE IF EXISTS pradepois_pagseguro;
CREATE TABLE IF NOT EXISTS pradepois_pagseguro (
  id_user INT NOT NULL,
  email VARCHAR(255) NOT NULL,
  public_key VARCHAR(40) NOT NULL,
  authorization_code VARCHAR(40) NOT NULL,
  created_at TIMESTAMP NULL,
  canceled_at TIMESTAMP NULL,
  FOREIGN KEY (id_user) REFERENCES pradepois_user(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- DROP TABLE IF EXISTS pradepois_notification;
CREATE TABLE IF NOT EXISTS pradepois_notification (
  notificationCode VARCHAR(40) NOT NULL,
  notificationType VARCHAR(40) NOT NULL,
  reference VARCHAR(20) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



----------------
--    VIEW    --
----------------
-- DROP VIEW pradepois_vw_services;
CREATE VIEW pradepois_vw_services AS
SELECT pradepois_service.*, pradepois_profile.username
FROM pradepois_service
INNER JOIN pradepois_profile ON pradepois_service.id_user = pradepois_profile.id_user;









-- DROP TABLE IF EXISTS refrep_entity;
CREATE TABLE IF NOT EXISTS refrep_entity (
  entity_id varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  plan_id varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  token varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  entity_status varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  created_date timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (entity_id),
  UNIQUE KEY token (token)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE refrep_site;
CREATE TABLE IF NOT EXISTS refrep_site(
    site_id INT AUTO_INCREMENT,
    entity_id VARCHAR(40) BINARY NOT NULL,
    site_url VARCHAR(255) DEFAULT NULL,
    created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (site_id),
    UNIQUE KEY (site_url),
    FOREIGN KEY (entity_id) REFERENCES refrep_entity(entity_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE refrep_referer;
CREATE TABLE IF NOT EXISTS refrep_referer(
    referer_id INT AUTO_INCREMENT,
    referer_name VARCHAR(40) BINARY NOT NULL,
    referer_desc VARCHAR(255) DEFAULT NULL,
    entity_id VARCHAR(40) BINARY NOT NULL,
    referer_status VARCHAR(40) BINARY NOT NULL,
    type_id VARCHAR(40) BINARY NOT NULL,
    site_id VARCHAR(40) BINARY NOT NULL,
    site_path VARCHAR(255) DEFAULT NULL,
    created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (referer_id),
    FOREIGN KEY (entity_id) REFERENCES refrep_entity(entity_id),
    FOREIGN KEY (site_id) REFERENCES refrep_site(site_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- DROP TABLE refrep_tracking;
CREATE TABLE IF NOT EXISTS refrep_tracking(
    referer_id INT(8),
    token VARCHAR(40) BINARY NOT NULL,
    source_id VARCHAR(40) BINARY DEFAULT NULL,
    cookie_id VARCHAR(40) BINARY NOT NULL,
    referer_url VARCHAR(255) DEFAULT NULL,
    user_return INT(4) DEFAULT NULL,
    user_action INT(2) DEFAULT NULL,
    order_id VARCHAR(40) DEFAULT NULL,
    order_value DECIMAL(15,2) DEFAULT NULL,
    tracking_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (referer_id) REFERENCES refrep_vw_referer_url(referer_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- DROP TABLE refrep_status;
-- CREATE TABLE IF NOT EXISTS refrep_status(
--    status_id VARCHAR(40) BINARY NOT NULL,
--    status_name VARCHAR(255) DEFAULT NULL,
--    PRIMARY KEY (status_id)
--) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--INSERT INTO refrep_status (status_id,status_name) VALUES('c2c691e5791bfa57bb1968e63d53a4d4c648440b','ACTIVE'),
--('3f14ec93601dd7db03c71f90b44d9c7103955733','INACTIVE'),('7f2ef26f77be904b52713e6e27defee911381dd4','SUSPENDED'),
--('affc2f02bdbd2447bc202c87a0af38f5bfb4935b','CONFIRMATION'),('e6e27defee911381d4c2c691e5791bfa57bb1968','DELETED');

-- DROP TABLE refrep_integration;
--CREATE TABLE IF NOT EXISTS refrep_integration(
--    integration_id VARCHAR(40) BINARY NOT NULL,
--    integration_name VARCHAR(255) DEFAULT NULL,
--    PRIMARY KEY (integration_id)
--) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--INSERT INTO refrep_integration (integration_id,integration_name) VALUES ('a5a3d5612f07c79f9024031851ecbb05dbca0e6d','NOINTEGRATION'),
--('ccc73f3bdedeefe8917cd424aa6c67937ba2ab01','NUVEMSHOP'),
--('6af1150416947f53a23f0109380fec1b1be8331d','SHOPIFY');

-- DROP TABLE refrep_group;
--CREATE TABLE IF NOT EXISTS refrep_group(
--    group_id VARCHAR(40) BINARY NOT NULL,
--    group_name VARCHAR(255) DEFAULT NULL,
--    PRIMARY KEY (group_id)
--) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--INSERT INTO refrep_group (group_id,group_name) VALUES ('2a67f9d7fc9782c7b28bddcb2a51f81716bb6cc4','NOGROUP');

-- DROP TABLE refrep_media;
--CREATE TABLE IF NOT EXISTS refrep_media(
--    media_id VARCHAR(40) BINARY NOT NULL,
--    media_name VARCHAR(255) DEFAULT NULL,
--    PRIMARY KEY (media_id)
--) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--INSERT INTO refrep_media (media_id,media_name) VALUES 
--('bdf71f21a956e47849f6402ec92f8f671024b226','NOTDEFINED'),('73b8a956ff52ecdab5398a572f4d71c1dcf8215a','GOOGLEADWORDS'),
--('51eee2c4f5a12f2bd87d900f445e86c92060824a','INSTAGRAM'),('2d72408cda1860ae4c9e6f3fe94c8dd463f4ceec','FACEBOOK'),
--('1cc3bdc22b8c2c3b4abdeae02a45eb20f41d6607','WHATSAPP'),('720cbb061eac1644215c8985607f6543db104f45','TELEGRAM'),
--('68b5daa515a6aed19d224285bbdb440aaa7a9dc4','TWITTER'),('2516f40912e90fce9c8d7a14c018ceb7b64083d7','LINKEDIN'),
--('033488a4b2d2b4eb148da4b19a8fc9aadc9e7e9a','YOUTUBE'),('b685a32e8d52803272ed5311bdabc26d20816e82','WECHAT'),
--('b9bd2abf76c46d16ce5c7396dfafe62fec855edd','REDDIT'),('eebbe9fb83b349186171f93dfdad1d49ef34bf1a','SNAPCHAT'),
--('bfdf8531ab256dd37e047e421e74df6054e090b7','QRCODE'),('64c6f1599caea5d9c02237f83f6651aca5a93281','EMAIL');

-- DROP TABLE refrep_source;
--CREATE TABLE IF NOT EXISTS refrep_source(
--    source_id VARCHAR(40) BINARY NOT NULL,
--    source_name VARCHAR(255) DEFAULT NULL,
--    PRIMARY KEY (source_id)
--) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--INSERT INTO refrep_source (source_id,source_name) VALUES 
--('6ec979672a29d511671664d9c0904a2ede13633b','NOTIDENTIFIED'),
--('d354118f6e1a36ae91fd85389fb820d80966d794','WEB'),
--('e9cb9d10e3a2f69d3a4a10fe02b1e7754a49ef50','MOBILE'),
--('952d2d4bb2a2c6d0e684a1d58ab3de5af146b6f0','TABLET');

----------------
--    VIEW    --
----------------
-- DROP VIEW refrep_vw_login;
CREATE VIEW refrep_vw_login AS
SELECT refrep_user.user_id, refrep_user.email, refrep_user.password, refrep_user.user_status, refrep_user.user_type, refrep_entity.*
FROM refrep_user
INNER JOIN refrep_entity ON refrep_user.entity_id = refrep_entity.entity_id;

-- DROP VIEW refrep_vw_referer_entity;
CREATE VIEW refrep_vw_referer_entity AS
SELECT
    refrep_referer.*,
    refrep_entity.token
FROM
    refrep_referer
INNER JOIN refrep_entity ON refrep_referer.entity_id = refrep_entity.entity_id;

-- DROP VIEW refrep_vw_referer_url;
CREATE VIEW refrep_vw_referer_url AS SELECT
    refrep_referer.*,
    refrep_site.site_url,
    CONCAT(
        refrep_site.site_url,
        refrep_referer.site_path,
        '?ref=',
        refrep_referer.referer_name
    ) AS referer_link
FROM
    refrep_referer
INNER JOIN refrep_site ON refrep_referer.site_id = refrep_site.site_id

-- DROP VIEW refrep_vw_referer;
CREATE VIEW refrep_vw_referer AS
SELECT refrep_referer.*, SUM(CASE WHEN checkout='0' THEN 1 ELSE 0 END) AS visits, SUM(CASE WHEN checkout='1' THEN 1 ELSE 0 END) AS sales, SUM(CASE WHEN checkout='1' THEN 1 ELSE 0 END) / SUM(CASE WHEN checkout='0' THEN 1 ELSE 0 END) AS conversions 
FROM refrep_tracking
INNER JOIN refrep_referer ON refrep_tracking.referer_id = refrep_referer.referer_id
GROUP BY refrep_tracking.referer_id;



------------------------------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS refrep_redirect(
    referer_id INT AUTO_INCREMENT,
    referer_name VARCHAR(255) DEFAULT NULL,
    site VARCHAR(255) DEFAULT NULL,
    cookie VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (referer_id),
    UNIQUE (referer_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tracking(
    tracking_id INT AUTO_INCREMENT,
    referer_name VARCHAR(255) DEFAULT NULL,
    created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (tracking_id),
    FOREIGN KEY (referer_name) REFERENCES referer(referer_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP VIEW view_tracking;
CREATE VIEW view_tracking AS
SELECT tracking.referer_name, COUNT(tracking.referer_name), CONCAT("https://refrep.co/", tracking.referer_name) AS reflink,
referer.site, referer.cookie
FROM tracking
INNER JOIN referer ON tracking.referer_name = referer.referer_name
GROUP BY tracking.referer_name;
------------------------------------------------------------------------------------------------------------



-- DROP TABLE refrep_redirect;
CREATE TABLE IF NOT EXISTS refrep_redirect(
    redirect_id INT AUTO_INCREMENT,
    redirect_name VARCHAR(40) BINARY NOT NULL,
    redirect_desc VARCHAR(255) DEFAULT NULL,
    entity_id VARCHAR(40) BINARY NOT NULL,
    site VARCHAR(255) DEFAULT NULL,
    html TEXT DEFAULT NULL,
    redirect_status VARCHAR(40) BINARY NOT NULL,
    created_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (redirect_id),
    UNIQUE KEY (redirect_name),
    FOREIGN KEY (entity_id) REFERENCES refrep_entity(entity_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE refrep_tracking_redirect;
CREATE TABLE IF NOT EXISTS refrep_tracking_redirect(
    redirect_name VARCHAR(40) BINARY NOT NULL,
    source_id VARCHAR(40) BINARY DEFAULT NULL,
    referer_url VARCHAR(255) DEFAULT NULL,
    tracking_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (redirect_name) REFERENCES refrep_redirect(redirect_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP VIEW refrep_vw_tracking_redirect;
CREATE VIEW refrep_vw_tracking_redirect AS
SELECT refrep_tracking_redirect.*, refrep_redirect.entity_id, refrep_redirect.redirect_desc, refrep_redirect.site, refrep_redirect.redirect_status  
FROM refrep_tracking_redirect
INNER JOIN refrep_redirect ON refrep_tracking_redirect.redirect_name = refrep_redirect.redirect_name

-- DROP VIEW refrep_vw_tracking_overview;
CREATE VIEW refrep_vw_tracking_overview AS
SELECT redirect_name, redirect_desc,  entity_id, site, redirect_status, COUNT(redirect_name)-1 as visits 
FROM refrep_vw_tracking_redirect GROUP BY redirect_name ORDER BY site

SELECT site, COUNT(redirect_name) as visits FROM refrep_vw_tracking_redirect WHERE entity_id='22bdc70e52f3f8949486fa4fa54d274c39ccc319' GROUP BY site


CREATE TRIGGER refrep_trigger_redirect AFTER INSERT ON refrep_redirect FOR EACH ROW INSERT INTO refrep_tracking_redirect (redirect_name) VALUES (NEW.redirect_name)






