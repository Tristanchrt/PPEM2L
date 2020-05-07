CREATE TABLE planningReserved (
    id INT NOT NULL AUTO_INCREMENT,
    dateSelected DATETIME NOT NULL,
    heureid INT(11) NOT NULL,
    userReserved INT(11) NOT NULL,
    CONSTRAINT fk_id PRIMARY  KEY (id),
    CONSTRAINT fk_heureid FOREIGN KEY (heureid) REFERENCES horraire(id) ON UPDATE cascade ,
    CONSTRAINT fk_userReserved FOREIGN KEY (userReserved) REFERENCES mrbs_users(id) ON UPDATE cascade 
) engine=innodb;