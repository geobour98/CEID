CREATE DATABASE patras_times;
USE patras_times;

CREATE TABLE efhmerida(
onoma VARCHAR(255) DEFAULT 'unknown' NOT NULL,
idiokthths VARCHAR(35) DEFAULT 'unknown' NOT NULL,
syxnothta_ekdoshs ENUM('hmerhsia', 'ebdomadiaia', 'mhniaia') NOT NULL,
PRIMARY KEY (onoma)
);

CREATE TABLE ergazomenos(
email VARCHAR(255) NOT NULL,
onoma_erg VARCHAR(255) DEFAULT 'unknown' NOT NULL,
epitheto VARCHAR(35) DEFAULT 'unknown' NOT NULL,
hmeromhnia_proslhpshs DATE NOT NULL,
misthos decimal(8, 2) DEFAULT NULL,
genos ENUM('arseniko', 'thylhko') NOT NULL,
PRIMARY KEY (email)
);

CREATE TABLE arxisyntakths(
email_arxisyntakth VARCHAR(255) NOT NULL,
PRIMARY KEY (email_arxisyntakth),
CONSTRAINT EMLARXS FOREIGN KEY (email_arxisyntakth)
REFERENCES ergazomenos(email)
ON DELETE CASCADE ON UPDATE CASCADE 
);

CREATE TABLE dhmosiografos(
email_dhmosiografou VARCHAR(255) NOT NULL,
proyphresia_kata_thn_eggrafh INT DEFAULT NULL,
syntomo_biografiko TEXT,
PRIMARY KEY (email_dhmosiografou),
CONSTRAINT EMLDMS FOREIGN KEY (email_dhmosiografou)
REFERENCES ergazomenos(email)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE dioikhtikos(
email_dioikhtikou VARCHAR(255) NOT NULL,
kathikonta ENUM('Secretary', 'Logistics') NOT NULL,
odos VARCHAR(35) DEFAULT 'unknown' NOT NULL,
arithmos INT UNSIGNED DEFAULT '0' NOT NULL,
polh VARCHAR(35) DEFAULT 'unknown' NOT NULL,
PRIMARY KEY (email_dioikhtikou),
CONSTRAINT EMLDKT FOREIGN KEY (email_dioikhtikou)
REFERENCES ergazomenos(email)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ekdoths(
email_ekdoth VARCHAR(255) NOT NULL,
PRIMARY KEY (email_ekdoth),
CONSTRAINT EMLEKD FOREIGN KEY (email_ekdoth)
REFERENCES ergazomenos(email)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE anhkei(
onoma_efhmeridas VARCHAR(35) DEFAULT 'unknown' NOT NULL,
ekd_email VARCHAR(255) NOT NULL,
PRIMARY KEY (onoma_efhmeridas, ekd_email),
CONSTRAINT EKDTEML FOREIGN KEY (ekd_email)
REFERENCES ekdoths(email_ekdoth)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT ONMEFM FOREIGN KEY (onoma_efhmeridas)
REFERENCES efhmerida(onoma)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ergazetai(
onoma_efhmeridas VARCHAR(35) DEFAULT 'unknown' NOT NULL,
email_ergazomenou VARCHAR(255) NOT NULL,
PRIMARY KEY (onoma_efhmeridas, email_ergazomenou),
CONSTRAINT EMLERGZ FOREIGN KEY (email_ergazomenou)
REFERENCES ergazomenos(email)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT ONMEFMR FOREIGN KEY (onoma_efhmeridas)
REFERENCES efhmerida(onoma)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE thlefwna(
thlefwno INT(10) NOT NULL,
dioikhtikoss VARCHAR(255) NOT NULL,
PRIMARY KEY (thlefwno, dioikhtikoss),
CONSTRAINT DKTKS FOREIGN KEY (dioikhtikoss)
REFERENCES dioikhtikos(email_dioikhtikou)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE kathgoria(
kwdikos INT(6) NOT NULL,
onoma_kat VARCHAR(35) DEFAULT 'unknown' NOT NULL,
perigrafh TEXT,
goneas INT(6) NOT NULL,
PRIMARY KEY (kwdikos),
CONSTRAINT KDKS FOREIGN KEY (goneas)
REFERENCES kathgoria(kwdikos)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE orizei(
ekdoths_email VARCHAR(255) NOT NULL,
arxisyntakths_email VARCHAR(255) NOT NULL,
PRIMARY KEY (ekdoths_email, arxisyntakths_email),
CONSTRAINT ARXSKEML FOREIGN KEY (arxisyntakths_email)
REFERENCES arxisyntakths(email_arxisyntakth)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT EKDEML FOREIGN KEY (ekdoths_email)
REFERENCES ekdoths(email_ekdoth)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE arthro(
path VARCHAR(255) DEFAULT 'unknown' NOT NULL,
titlos VARCHAR(64) DEFAULT 'unknown' NOT NULL,
perilhpsh TEXT,
leksi_kleidi VARCHAR(20) DEFAULT 'unknown' NOT NULL,
arxisynt_email VARCHAR(255) NOT NULL,
katastash ENUM('Egkrish', 'Anathewrhsh', 'Apporipsh') NOT NULL,
kwdikos_kathgorias INT(6) NOT NULL,
arith_fyllou INT(2) NOT NULL,
selides_arthrou INT(2) DEFAULT '0' NOT NULL, 
PRIMARY KEY (path),
CONSTRAINT ARTHFYL FOREIGN KEY (arith_fyllou)
REFERENCES fyllo(ar_fyllou)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT ARXSEML FOREIGN KEY (arxisynt_email)
REFERENCES arxisyntakths(email_arxisyntakth)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT KWKKTGR FOREIGN KEY (kwdikos_kathgorias)
REFERENCES kathgoria(kwdikos)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE lekseis_kleidia(
leksi_kleidi VARCHAR(20) DEFAULT 'unknown' NOT NULL,
p_arthrou VARCHAR(255) DEFAULT 'unknown' NOT NULL,
PRIMARY KEY(leksi_kleidi, p_arthrou),
CONSTRAINT PARTHR FOREIGN KEY (p_arthrou)
REFERENCES arthro(path)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ypoballei(
dhmosiografos_email VARCHAR(255) NOT NULL,
path_arthrou VARCHAR(255) DEFAULT 'unknown' NOT NULL,
hmeromhnia DATE NOT NULL,
selides_arthrou INT(2) DEFAULT '0' NOT NULL,
PRIMARY KEY (dhmosiografos_email, path_arthrou),
CONSTRAINT DMEML FOREIGN KEY (dhmosiografos_email)
REFERENCES dhmosiografos(email_dhmosiografou)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT PATART FOREIGN KEY (path_arthrou)
REFERENCES arthro(path)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE fyllo(
ar_fyllou INT(2) NOT NULL AUTO_INCREMENT,
hmeromhnia_kykloforias DATE NOT NULL,
onoma_fyllou VARCHAR(35) DEFAULT 'unknown' NOT NULL,
email_arxisynt VARCHAR(255) NOT NULL,
selides INT(2) DEFAULT '0' NOT NULL,
PRIMARY KEY (ar_fyllou, onoma_fyllou),
CONSTRAINT EMLARXSK FOREIGN KEY (email_arxisynt)
REFERENCES arxisyntakths(email_arxisyntakth)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT ONMFL FOREIGN KEY (onoma_fyllou)
REFERENCES efhmerida(onoma)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE antitypo(
arithmos INT(2) NOT NULL AUTO_INCREMENT,
kathorismos_arithmou VARCHAR(255) NOT NULL,
exei_arithmo_fyllou INT(2) NOT NULL, 
PRIMARY KEY (arithmos),
CONSTRAINT EXARFYL FOREIGN KEY (exei_arithmo_fyllou)
REFERENCES fyllo(ar_fyllou)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT KTHARTH FOREIGN KEY (kathorismos_arithmou)
REFERENCES ekdoths(email_ekdoth)
ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO efhmerida VALUES('H Prasinh', 'Nikolaou', 'mhniaia');
INSERT INTO efhmerida VALUES('Patras Times', 'Bourlakis', 'hmerhsia');
INSERT INTO efhmerida VALUES('Ta Nea', 'Kaskanis', 'ebdomadiaia');

INSERT INTO ergazomenos VALUES('antkouts007@protonmail.com', 'Antonis', 'Koutsopoulos', '2019-06-01', 2400.50, 'arseniko');
INSERT INTO ergazomenos VALUES('argyriou@gmail.com', 'Kwstas', 'Argyriou', '2019-08-01', 2100.0, 'arseniko');
INSERT INTO ergazomenos VALUES('eleutheria_par@hotmail.com', 'Eleutheria', 'Paraskeuopoulou', '2018-09-01', 2750.00, 'thylhko');
INSERT INTO ergazomenos VALUES('eust10@gmail.com', 'Katerina', 'Eustathiou', '2018-03-01', 3050.50, 'thylhko');
INSERT INTO ergazomenos VALUES('giorgoshatz@gmail.com', 'Giorgos', 'Hatzis', '2020-02-01', 2000.00, 'arseniko');
INSERT INTO ergazomenos VALUES('maria_vlachou@hotmail.com', 'Maria', 'Vlachou', '2017-12-01', 3500.00, 'thylhko');

INSERT INTO arxisyntakths VALUES('maria_vlachou@hotmail.com');

INSERT INTO dhmosiografos VALUES('antkouts007@protonmail.com', 53, 'Exw ergastei ws dhmosiografos sthn Kathimerinh gia 2 xronia apo arxes 2015 mexri telh 2016, kathws kai sthn Prasinh apo arxes 2017 mexri 2019 telh Maiou');
INSERT INTO dhmosiografos VALUES('eust10@gmail.com', 86, 'Exw ergastei ws dhmosiografos sthn efhmerida Ta Nea gia 4 xronia apo 2011 mexri telh 2014, kathws kai sthn Kathimerinh apo arxes 2015 mexri 2018 telh Febrouariou');


INSERT INTO dioikhtikos VALUES('argyriou@gmail.com', 'Secretary', 'Panepistimiou', 132, 'Patra');
INSERT INTO dioikhtikos VALUES('giorgoshatz@gmail.com', 'Logistics', 'Karolou', 25, 'Patra');

INSERT INTO thlefwna VALUES(261025354, 'argyriou@gmail.com');
INSERT INTO thlefwna VALUES(698224534, 'argyriou@gmail.com');
INSERT INTO thlefwna VALUES(261028316, 'giorgoshatz@gmail.com');
INSERT INTO thlefwna VALUES(694359012, 'giorgoshatz@gmail.com');

INSERT INTO ekdoths VALUES('eleutheria_par@hotmail.com');


INSERT INTO fyllo VALUES(1, '2020-08-05', 'H Prasinh', 'maria_vlachou@hotmail.com', 18);
INSERT INTO fyllo VALUES(2, '2020-08-01', 'Ta Nea', 'maria_vlachou@hotmail.com', 26);
INSERT INTO fyllo VALUES(3, '2020-07-20', 'Patras Times', 'maria_vlachou@hotmail.com', 22);
INSERT INTO fyllo VALUES(4, '2020-08-08', 'Ta Nea', 'maria_vlachou@hotmail.com', 20);

INSERT INTO antitypo VALUES(1, 'eleutheria_par@hotmail.com', 1);
INSERT INTO antitypo VALUES(2, 'eleutheria_par@hotmail.com', 1);
INSERT INTO antitypo VALUES(3, 'eleutheria_par@hotmail.com', 2);
INSERT INTO antitypo VALUES(4, 'eleutheria_par@hotmail.com', 2);
INSERT INTO antitypo VALUES(5, 'eleutheria_par@hotmail.com', 2);
INSERT INTO antitypo VALUES(6, 'eleutheria_par@hotmail.com', 3);
INSERT INTO antitypo VALUES(7, 'eleutheria_par@hotmail.com', 3);

INSERT INTO kathgoria VALUES(1, 'Politika', 'Amesh enhmerwsh gia thn politikh katastash ths xwras mas', 1);
INSERT INTO kathgoria VALUES(2, 'Athlitika', 'Ta panta gia ton athlitismo grhgora kai apotelesmatika', 2);
INSERT INTO kathgoria VALUES(3, 'Ygeia', 'Ola ta neotera sxetika me ton tomea ths ygeias', 3);
INSERT INTO kathgoria VALUES(4, 'Episthmh', 'Edw mathenete gia ta pio sygxrona texnologika epiteygmata pagkosmiws', 4);
INSERT INTO kathgoria VALUES(5, 'Koinwnika', 'Ola ta teleytaia koinwnika nea anaforika me thn xwra mas', 5);
INSERT INTO kathgoria VALUES(6, 'Eswterikh Politikh', 'Oles oi teleytaies ekselikseis sxetika me thn eswterikh mas politikh', 1);
INSERT INTO kathgoria VALUES(7, 'Ekswterikh Politikh', 'Oles oi teleytaies ekselikseis sxetika me thn ekswterikh mas politikh', 1);
INSERT INTO kathgoria VALUES(8, 'Ellhnotourkikes Sxeseis', 'Oles oi teleytaies ekselikseis metaksy Elladas kai Tourkias', 7);
INSERT INTO kathgoria VALUES(9, 'Panathinaikos', 'Ola ta nea sxetika me thn istorikoterh omada ths Elladas', 2);
INSERT INTO kathgoria VALUES(10, 'Olympiakos', 'Ola ta nea sxetika me thn kalyterh omada ths Elladas', 2);
INSERT INTO kathgoria VALUES(11, 'Oikonomia', 'Oles oi oikonomikes ekselikseis', 11);

INSERT INTO arthro VALUES('C:\\Users\\Articles\\Submitted\\Article1.doc', 'Oi oikonomikes zhmies sthn periodo tou koronoiou', 'Se auto to arthro o oikonomikos dieuthynths ths Eurobank perigrafei tis terasties zhmies sthn Oikonomia kai thn meiwsh toy tourismou eksaitias tou koronoiou', 'Koronoios', 'maria_vlachou@hotmail.com', 'Egkrish', 11, 1, 6);
INSERT INTO arthro VALUES('C:\\Users\\Articles\\Submitted\\Article2.doc', 'Oi authairesies tou Erntogan sto Aigaio pelagos', 'Se auto to arthro analyontai oles oi authairesies tou proedrou ths Tourkias sxetika me ta diethnws anagnwrismena Ellhnika ydata sto Aigaio pelagos', 'Aigaio pelagos', 'maria_vlachou@hotmail.com', 'Anathewrhsh', 8, 1, 9);
INSERT INTO arthro VALUES('C:\\Users\\Articles\\Submitted\\Article3.doc', 'H thleergasia sth neoterh epoxh', 'Se auto to arthro perigrafetai h strofh ta teleytaia xronia sthn thleergasia me thn ekseliksh ths texnologias kai thn eukolia xrhshs twn ypologistwn', 'Thleergasia', 'maria_vlachou@hotmail.com', 'Apporipsh', 4, 2, 7);
INSERT INTO arthro VALUES('C:\\Users\\Articles\\Submitted\\Article4.doc', 'Champions League 2020', 'Se auto to arthro analyetai o fetinos telikos Champions League metaksy Liverpool kai Barcelona kathws kai oi stoiximatikes provlepseis', 'Champions league', 'maria_vlachou@hotmail.com', 'Egkrish', 2, 3, 11);
