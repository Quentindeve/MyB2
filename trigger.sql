DELIMITER //
CREATE TRIGGER insInscrit
	BEFORE INSERT ON inscrit FOR EACH ROW
BEGIN
	DECLARE nb INTEGER;
	SELECT COUNT(*) INTO nb FROM demande 
	WHERE n_personne = NEW.n_personne
	AND n_stage = NEW.n_stage;
	IF (nb = 0) THEN
		SIGNAL SQLSTATE "45000"
    	SET MESSAGE_TEXT = "Opération non permise";
	END IF;
END //
DELIMITER ;