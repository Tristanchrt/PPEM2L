CREATE TRIGGER upd_log AFTER INSERT ON installer
       FOR EACH ROW
       BEGIN
            DECLARE countLog INT;
            SET countLog = (SELECT COUNT(*) FROM installer WHERE nLog = NEW.nLog);
            UPDATE logiciel SET nbInstall = 0 + countLog WHERE nLog = NEW.nLog;
       END$$

CREATE TRIGGER upd_log_delete AFTER DELETE ON installer
       FOR EACH ROW
       BEGIN
            DECLARE countLog INT;
            SET countLog = (SELECT COUNT(*) FROM installer WHERE nLog = OLD.nLog);
            UPDATE logiciel SET nbInstall = 0 + countLog WHERE nLog = OLD.nLog;
       END$$

CREATE TRIGGER upd_poste_insert AFTER INSERT ON installer
       FOR EACH ROW
       BEGIN
            DECLARE countLogInPoste INT;
            SET countLogInPoste = (SELECT COUNT(*) FROM installer WHERE nPoste = NEW.nPoste);
            UPDATE poste SET nbLog = 0 + countLogInPoste WHERE nPoste = NEW.nPoste;
       END$$
       
CREATE TRIGGER upd_poste_delete AFTER DELETE ON installer
       FOR EACH ROW
       BEGIN
            DECLARE countLogInPoste INT;
            SET countLogInPoste = (SELECT COUNT(*) FROM installer WHERE nPoste = OLD.nPoste);
            UPDATE poste SET nbLog = 0 + countLogInPoste WHERE nPoste = OLD.nPoste;
       END$$

CREATE TRIGGER upd_segmentSalle_insert AFTER INSERT ON salle
       FOR EACH ROW
       BEGIN
            DECLARE countSalleIndIP INT;
            SET countSalleIndIP = (SELECT COUNT(*) FROM salle WHERE indIP = NEW.indIP);
            UPDATE segment SET nbSalle = 0 + countSalleIndIP WHERE indIP = NEW.indIP;
       END$$

CREATE TRIGGER upd_segmentSalle_delete AFTER DELETE ON salle
       FOR EACH ROW
       BEGIN
            DECLARE countSalleIndIP INT;
            SET countSalleIndIP = (SELECT COUNT(*) FROM salle WHERE indIP = OLD.indIP);
            UPDATE segment SET nbSalle = 0 + countSalleIndIP WHERE indIP = OLD.indIP;
       END$$

CREATE TRIGGER upd_segmentNbPoste_insert AFTER INSERT ON poste
       FOR EACH ROW
       BEGIN
            DECLARE countNbPoste INT;
            SET countNbPoste = (SELECT COUNT(*) FROM poste WHERE indIP = NEW.indIP);
            UPDATE segment SET nbPoste = 0 + countNbPoste WHERE indIP = NEW.indIP;
       END$$

CREATE TRIGGER upd_segmentNbPoste_delete AFTER DELETE ON poste
       FOR EACH ROW
       BEGIN
            DECLARE countNbPoste INT;
            SET countNbPoste = (SELECT COUNT(*) FROM poste WHERE indIP = OLD.indIP);
            UPDATE segment SET nbPoste = 0 + countNbPoste WHERE indIP = OLD.indIP;
       END$$



