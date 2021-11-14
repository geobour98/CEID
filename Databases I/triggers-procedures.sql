#erwthma a
DELIMITER $
CREATE PROCEDURE stoixeia(IN ar_fyl INT(2), IN onom VARCHAR(255))
BEGIN
DECLARE spath VARCHAR(255);
DECLARE stitlos VARCHAR(64);
DECLARE sarxisynt_email VARCHAR(255);
DECLARE sselides_arthrou INT(2);
DECLARE finishedFlag INT;
DECLARE sCursor CURSOR FOR
SELECT path, titlos, arxisynt_email, selides_arthrou FROM arthro INNER JOIN fyllo ON onom=onoma_fyllou WHERE ar_fyl=arith_fyllou;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET finishedFlag=1;
OPEN sCursor;
SET finishedFlag=0;
FETCH sCursor INTO spath, stitlos, sarxisynt_email, sselides_arthrou;
WHILE (finishedFlag=0) DO
SELECT spath AS 'Stoixeia Path', stitlos AS 'Stoixeia Titlou', sarxisynt_email AS 'Stoixeia Arxisyntakth', sselides_arthrou AS 'Selides Arthrou';
FETCH sCursor INTO spath, stitlos, sarxisynt_email, sselides_arthrou;
END WHILE;
SELECT selides-SUM(selides_arthrou) AS 'Diathesimos xwros se selides' FROM arthro INNER JOIN fyllo ON arith_fyllou=ar_fyllou WHERE arith_fyllou=ar_fyl;
CLOSE sCursor;
END $
DELIMITER ;
CALL stoixeia(1, 'H Prasinh');


#erwthma b
DELIMITER $
CREATE PROCEDURE aykshsh_misthou(IN email VARCHAR(255))
BEGIN
IF email='antkouts007@protonmail.com' THEN UPDATE ergazomenos SET misthos=( (TIMESTAMPDIFF(MONTH, '2019-06-01', CURDATE())+53)*0.5 + misthos ) WHERE onoma_erg='Antonis';
ELSEIF email='eust10@gmail.com' THEN UPDATE ergazomenos SET misthos=( (TIMESTAMPDIFF(MONTH, '2018-03-01', CURDATE())+86)*0.5 + misthos ) WHERE onoma_erg='Katerina';
ELSE SELECT 'Dwse egkyro email dhmosiografou!!';
END IF;
END $
DELIMITER ;
CALL aykshsh_misthou('antkouts007@protonmail.com');
SELECT * FROM ergazomenos WHERE onoma_erg='Antonis';
CALL aykshsh_misthou('eust10@gmail.com');
SELECT * FROM ergazomenos WHERE onoma_erg='Katerina';


#erwthma c
DELIMITER $
CREATE TRIGGER arxikos_misthos
BEFORE INSERT ON ergazomenos 
FOR EACH ROW
BEGIN
SET NEW.misthos=650.00;
END $
DELIMITER ;
INSERT INTO ergazomenos VALUES('kostopoulos@gmail.com', 'Giannis', 'Kostopoulos', '2020-08-01', NULL, 'arseniko');
SELECT * FROM ergazomenos WHERE onoma_erg='Giannis';


#erwthma d
DELIMITER $
CREATE TRIGGER apodoxh_arthrou
BEFORE INSERT ON arthro
FOR EACH ROW
BEGIN
SET @em=(SELECT email_arxisyntakth FROM arxisyntakths);
IF NEW.arxisynt_email=@em
THEN SET NEW.katastash='Egkrish';
END IF;
END $
DELIMITER ;
INSERT INTO arthro VALUES('C:\\Users\\Articles\\Submitted\\Article5.doc', 'Ekloges 2020', 'Se auto to arthro analyontai ta pososta tou kathe kommatos gia tis boyleutikes ekloges tou 2020', 'Ekloges', 'maria_vlachou@hotmail.com', 'Apporipsh', 1, 4, 8);
SELECT * FROM arthro WHERE leksi_kleidi='Ekloges';



#erwthma e
DELIMITER $
CREATE TRIGGER epilogh_arthrou
BEFORE INSERT ON arthro
FOR EACH ROW
BEGIN
SET @sum=(SELECT SUM(selides_arthrou) FROM arthro INNER JOIN fyllo ON arthro.arith_fyllou=fyllo.ar_fyllou);
SET @sselides=(SELECT selides FROM fyllo INNER JOIN arthro ON fyllo.ar_fyllou=arthro.arith_fyllou LIMIT 0,1);
IF @sum>@sselides THEN 
SIGNAL SQLSTATE VALUE '45000'
SET MESSAGE_TEXT = 'Oi selides twn arthrwn einai perissoteres apo tis selides tou fyllou. Epanalabete me ligoteres selides arthrwn!';
END IF;
END $
DELIMITER ;
INSERT INTO arthro VALUES('C:\\Users\\Articles\\Submitted\\Article6.doc', 'Embolio covid-19', 'Se auto to arthro perigrafetai h ekseliksh ths dhmiourgias tou emboliou covid-19 mexri thn egkrish tou apo ton EOF', 'Embolio', 'maria_vlachou@hotmail.com', 'Egkrish', 3, 1, 20);
