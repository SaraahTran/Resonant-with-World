CREATE TABLE `Category` (
                            `Category_ID` int(11) auto_increment NOT NULL,
                            `Category_Name` varchar(64) NOT NULL,
                            PRIMARY KEY (`Category_ID`)
);

CREATE TABLE `Product` (
                           `Product_ID` int(11) auto_increment NOT NULL,
                           `Product_Name` varchar(64) NOT NULL,
                           `Product_UPC` int(11) NOT NULL,
                           `Product_Price` decimal(6,2) NOT NULL,
                           `Product_Category` varchar(64) NOT NULL,
                           PRIMARY KEY (`Product_ID`)
);

CREATE TABLE `Client` (
                          `Client_ID` int(11) auto_increment NOT NULL,
                          `Client_FirstName` varchar(64) NOT NULL,
                          `Client_Surname` varchar(64) NOT NULL,
                          `Client_Address` varchar(64) NOT NULL,
                          `Client_Phone` varchar(64) NOT NULL,
                          `Client_Email` varchar(64) NOT NULL,
                          `Client_Subscribed` boolean NULL,
                          `Client_Other_Information` varchar(256) NULL,
                          PRIMARY KEY(`Client_ID`)
);

CREATE TABLE `Photo_Shoot` (
                               `Photo_Shoot_ID` int(11) auto_increment NOT NULL,
                               `Client_ID` int(11),
                               `Photo_Shoot_Name` varchar(64) NOT NULL,
                               `Photo_Shoot_Description` varchar(256) NOT NULL,
                               `Photo_Shoot_DateTime` datetime NOT NULL,
                               `Photo_Shoot_Quote` decimal(6,2) NOT NULL,
                               `Photo_Shoot_Other_Information` varchar(256) NULL,
                               PRIMARY KEY (`Photo_Shoot_ID`)
);

ALTER TABLE `Photo_Shoot` ADD CONSTRAINT `fk_Client_ID` FOREIGN KEY (`Client_ID`) REFERENCES `Client` (`Client_ID`);

CREATE TABLE `Product_Image` (
                                 `Product_Image_ID` int(11) auto_increment NOT NULL,
                                 `Product_ID` int(11) NOT NULL,
                                 `Product_Image_File_name` varchar(64) NOT NULL,
                                 PRIMARY KEY (`Product_Image_ID`)
);

CREATE TABLE `User` (
                        `User_ID` int(11) NOT NULL auto_increment,
                        `Username` varchar(64) NOT NULL,
                        `Email` varchar(64) NOT NULL UNIQUE KEY,
                        `Password` varchar(64) NOT NULL,
                        PRIMARY KEY (`User_ID`)
);

ALTER TABLE `Product_Image` ADD CONSTRAINT `fk_Product_Image` FOREIGN KEY (`Product_ID`) REFERENCES `Product` (`Product_ID`);

INSERT INTO `User` (`User_ID`, `Username`,  `Email`, `Password`) VALUES
    (1, 'Anna', 'anna.sola@example.com', SHA2('$ol@nn@', 256));

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (1, 'Nilson', 'Reyson', '714 Farragut Alley', '0419248192', 'nreyson0@hotmail.com', 1, 'Nilson has been a loyal customer since we have started our business');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (2, 'Tarah', 'Petruszka', '2190 Manufacturers Terrace', '0419238492', 'tpetruszka1@hotmail.com', 1, 'Recently joined and loves our work');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (3, 'Bevvy', 'Housin', '03 Carberry Park', '0494819234', 'bhousin2@hotmail.com', 0, 'Just joined and signed up to Resonant with World');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (4, 'Hinda', 'Landrick', '1282 Bluejay Drive', '0419999182', 'hlandrick3@hotmail.com', 0, 'Recommended many other customers');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (5, 'Dean', 'Clarson', '009 Roth Way', '0491029241', 'dclarson4@hotmail.com', 0, 'Business promoter and helps expands our business');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (6, 'Matthus', 'Kleuer', '47270 Wayridge Place', '0433991123', 'mkleuer5@hotmail.com', 1, 'Loyal customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (7, 'Chrystel', 'Shales', '21325 Wayridge Pass', '0435147980', 'cshales6@hotmail.com', 1, 'Loyal customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (8, 'Hilary', 'Evenett', '996 Meadow Vale Terrace', '0453945042', 'hevenett7@gmail.com', 0, 'Loyal customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (9, 'Auguste', 'Loader', '7960 Old Gate Avenue', '0435173966', 'aloader8@gmail.com', 0, 'Customer that has had the most service with us');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (10, 'Mattheus', 'Vicar', '10037 Saint Paul Road', '0445557669', 'mvicar9@gmail.com', 0, 'Been working with Resonant with World for years');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (11, 'Cthrine', 'Francis', '7 Brentwood Lane', '0451536625', 'cfrancisa@gmail.com', 1, 'Customer is always satisfied');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (12, 'Alexandro', 'Lyes', '566 Tony Trail', '0465534587', 'alyesb@gmail.com', 1, 'Feedback has been amazing');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (13, 'Angel', 'Adger', '81 Division Center', '0450534989', 'aadgerc@gmail.com', 1, 'Client that is very easy to work with');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (14, 'Myrah', 'Turmel', '12264 Bashford Parkway', '0489870449', 'mturmeld@gmail.com', 1, 'Client that has multiple services with us');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (15, 'Gearalt', 'Simonitto', '6133 Troy Plaza', '0465916296', 'gsimonittoe@gmail.com', 0, 'Wishes to partake in our services');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (16, 'Urbanus', 'Patington', '86 Hoepker Center', '0414372001', 'upatingtonf@gmail.com', 0, 'Purchases the most products from our store');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (17, 'Sher', 'Janota', '68 Randy Alley', '0457324624', 'sjanotag@gmail.com', 1, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (18, 'Melina', 'Paiton', '98800 Monica Park', '0403484576', 'mpaitonh@gmail.com', 1, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (19, 'Lois', 'Jerzak', '08 Blue Bill Park Circle', '0439234746', 'ljerzaki@gmail.com', 1, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (20, 'Jacobo', 'Grunson', '57737 Erie Alley', '0403813761', 'jgrunsonj@gmail.com', 1, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (21, 'Stepha', 'Riggs', '013 Susan Circle', '0460649218', 'sriggsk@gmail.com', 1, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (22, 'Beauregard', 'Brownrigg', '2 Merrick Point', '0478321009', 'bbrownriggl@hotmail.com', 0, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (23, 'Odo', 'Haythorn', '95 Sloan Hill', '0434380392', 'ohaythornm@hotmail.com', 1, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (24, 'Hector', 'Penner', '7 7th Way', '0415458667', 'hpennern@hotmail.com', 1, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (25, 'Raven', 'Winchcum', '71633 Leroy Plaza', '0454643887', 'rwinchcumo@hotmail.com', 1, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (26, 'Franzen', 'Kimble', '4748 Mccormick Place', '0425595314', 'fkimblep@hotmail.com', 1, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (27, 'Abbott', 'Salla', '4 Stuart Hill', '0423191214', 'asallaq@hotmail.com', 0, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (28, 'Sigismondo', 'Rumbold', '221 Sunnyside Center', '0489372638', 'srumboldr@hotmail.com', 0, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (29, 'Dugald', 'Alti', '3243 Summerview Alley', '0402817180', 'daltis@hotmail.com', 1, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (30, 'Joscelin', 'Liddell', '845 Westend Center', '0440316900', 'jliddellt@yahoo.com', 0, 'Brand new customer');

INSERT into `Client` (`Client_ID`, `Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES (31, 'Gannon', 'Attewill', '149 Mallard Point', '0411148641', 'gattewillu@yahoo.com', 0, 'Brand new customer');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (1, 1, 'Wedding Shoot', 'Married couples who needs a professional photoshoot for their wedding', '2021-03-07', '309.61', 'Tight schedule and needs to be on time');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (2, 2, 'Wedding Shoot', 'Photoshoot for a wedding ceremony at night', '2021-09-29', '262.60', 'Photoshoot requires photograph and videograph');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (3, 3, 'Restaurant Shoot', 'Photoshoot for a restaurants new menu', '2021-05-28', '311.10', 'Bring our own light set up to make food look more appealing');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (4, 4, 'Location Shoot', 'Photoshoot for a Restaurants new location', '2021-04-12', '344.51', 'Location is in the CBD of Melbourne');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES (5, 5, 'Scenery Shoot', 'Photoshoot for Blairgowrie', '2021-04-22', '282.15', 'Aesthetic location and needs some ring lights');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (6, 6, 'Business Shoot', 'Photoshoot for a new business', '2021-08-08', '194.72', 'Corporate business attire');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (7, 7, 'Wedding Shoot', 'Photoshoot for wedding ceremony', '2021-08-20', '246.13', 'Location in CBD of Melbourne');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (8, 8, 'Car Shoot', 'Photoshoot for Subarus new car', '2021-12-14', '240.55', 'Car driving scenes required');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (9, 9, 'Linkedin Profile Photo', 'Professional headshot for a profile picture for Linkedin', '2021-05-05', '198.42', 'Headshot and full body shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (10, 10, 'Linkedin Profile Photo', 'Professional headshot for a profile picture for Linkedin', '2021-06-08', '118.55', 'Headshot and full body shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (11, 11, 'Linkedin Profile Photo', 'Professional headshot for a profile picture for Linkedin', '2021-11-25', '199.27', 'Headshot and full body shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (12, 12, 'Linkedin Profile Photo', 'Professional headshot for a profile picture for Linkedin', '2021-11-17', '162.47', 'Headshot and full body shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (13, 13, 'Linkedin Profile Photo', 'Professional headshot for a profile picture for Linkedin', '2021-07-21', '243.77', 'Headshot and full body shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (14, 14, 'Linkedin Profile Photo', 'Professional headshot for a profile picture for Linkedin', '2021-06-18', '305.55', 'Headshot and full body shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (15, 15, 'Linkedin Profile Photo', 'Professional headshot for a profile picture for Linkedin', '2021-06-05', '180.43', 'Headshot and full body shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (16, 16, 'Linkedin Profile Photo', 'Professional headshot for a profile picture for Linkedin', '2021-11-08', '240.32', 'Headshot and full body shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (17, 17, 'Linkedin Profile Photo', 'Professional headshot for a profile picture for Linkedin', '2021-01-07', '197.21', 'Headshot and full body shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (18, 18, 'Linkedin Profile Photo', 'Professional headshot for a profile picture for Linkedin', '2021-04-23', '271.75', 'Headshot and full body shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (19, 19, 'Modeling Shoot', 'Modeling for Louis Vuttion walkway show', '2021-11-01', '154.22', 'LV attire required');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (20, 20, 'Modeling Shoot', 'Modeling for Gucci show', '2021-05-03', '212.89', 'Gucci attire required');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (21, 21, 'Clothing Brand Shoot', 'Photshoot for Ralph Lauren', '2021-11-13', '113.48', 'Ralph Lauren attire required');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (22, 22, 'Modeling Shoot', 'Photoshoot for new business', '2021-05-28', '144.64', 'Corporate business that needs lighting');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (23, 23, 'Modeling Shoot', 'Photoshoot for Bodybuilding', '2021-08-22', '118.08', 'Zyzz');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (24, 24, 'Modeling Shoot', 'Photoshoot for Mr Olympia 2021', '2021-04-07', '161.41', 'Back double bi shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (25, 25, 'Modeling Shoot', 'Modeling for Mr Olympia 2021', '2021-09-14', '126.84', 'Lat spread shot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (26, 26, 'Gym Shoot', 'Photoshoot for gym athletes', '2021-03-10', '342.14', 'Trenbolone sandwiches');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (27, 27, 'Supplement Shoot', 'Photoshoot for supplement brand', '2021-02-14', '170.48', 'Gorilla Mode');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (28, 28, 'Bodybuilder Shoot', 'Photoshoot for Bodybuilders', '2021-04-23', '295.02', 'Cbum photoshoot');

INSERT INTO `Photo_Shoot` (`Photo_Shoot_ID`, `Client_ID`, `Photo_Shoot_Name`, `Photo_Shoot_Description`, `Photo_Shoot_DateTime`, `Photo_Shoot_Quote`, `Photo_Shoot_Other_Information`) VALUES  (29, 29, 'Clothing Brand Shoot', 'Modeling for new clothing brand', '2021-10-17', '101.90', 'Piles of clothes to be shot');

INSERT into `Category` (`Category_ID`, `Category_Name`) VALUES (1, 'Souvenirs');
INSERT into `Category` (`Category_ID`, `Category_Name`) VALUES (2, 'Consumables');
INSERT into `Category` (`Category_ID`, `Category_Name`) VALUES (3, 'Services');
INSERT into `Category` (`Category_ID`, `Category_Name`) VALUES (4, 'Equipments');

INSERT INTO `Product` (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (1, 'Fujifilm', '2075531463', '97.70', 'Equipments');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (2, 'DSLR', '1911313215', '2164.01', 'Equipments');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (3, 'GoPro', '1023220166', '148.90', 'Equipments');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (4, 'Rode VideoMic', '1571572887', '299.84', 'Equipments');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (5, 'DSLR Lense', '1034091196', '708.62', 'Equipments');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (6, 'Fujifilm Films', '1893448456', '24.76', 'Equipments');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (7, 'Mugs', '1170614496', '26.50', 'Souvenirs');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (8, 'Keychain', '1869891482', '12.39', 'Souvenirs');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (9, 'T-Shirts', '1808709545', '25.59', 'Souvenirs');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (10, 'Hoodies', '1217330568', '57.31', 'Souvenirs');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (11, 'Rings', '1584423793', '39.17', 'Souvenirs');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (12, 'Lanyards', '1008353663', '20.93', 'Souvenirs');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (13, 'Posters', '1242448251', '32.32', 'Souvenirs');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (14, 'Stickers', '1573450598', '9.39', 'Souvenirs');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (15, 'Camera Cloth', '1557632565', '11.72', 'Consumables');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (16, 'Lense Spray', '1109847440', '15.08', 'Consumables');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (17, 'Lense Brush', '1643718599', '16.95', 'Consumables');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (18, 'AA Batteries', '1485208819', '8.10', 'Consumables');

INSERT INTO `Product` (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES ('19', 'Lense Cover', '1123315247', '20.94', 'Consumables');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (20, 'Camera Charger', '1893992679', '49.36', 'Consumables');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (21, 'Film Paper', '1026817458', '42.69', 'Consumables');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (22, 'AAA Batteries', '1156141942', '12.68', 'Consumables');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (23, 'Camera Straps', '1716542307', '34.30', 'Consumables');

INSERT into Product (`Product_ID`, `Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) VALUES (24, 'Camera Bag', '1217480331', '75.05', 'Equipments');


INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('1', '1', 'fujifilm.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('2', '1', 'fujifilm2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('3', '2', 'dslr.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('4', '2', 'dslr2.jpeg');


INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('5', '3', 'gopro.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('6', '3', 'gopro2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('7', '4', 'rode.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('8', '4', 'rode2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('9', '5', 'dslrlense.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('10', '5', 'dslrlense2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('11', '6', 'fujifilm film.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('12', '6', 'fujifilm film2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('13', '7', 'mug.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('14', '7', 'mug2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('15', '8', 'keychain.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('16', '8', 'keychain2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('17', '9', 'tshirt.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('18', '9', 'tshirt2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('19', '10', 'hoodie.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('20', '10', 'hoodie2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('21', '11', 'ring.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('22', '11', 'ring2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('23', '12', 'lanyard.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('24', '12', 'lanyard2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('25', '13', 'poster.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('26', '13', 'poster2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('27', '14', 'stickers.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('28', '14', 'stickers2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('29', '15', 'cameracloth.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('30', '15', 'cameracloth2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('31', '16', 'lense spray.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('32', '16', 'lense spray2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('33', '17', 'lense brush.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('34', '17', 'lense brush2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('35', '18', 'aa.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('36', '18', 'aa2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('37', '19', 'lense cover.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('38', '19', 'lense cover2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('39', '20', 'camera charger.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('40', '20', 'camera charger2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('41', '21', 'filmpaper.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('42', '21', 'filmpaper2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('43', '22', 'aaa.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('44', '22', 'aaa2.png');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('45', '23', 'camerastrap.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('46', '23', 'camerastrap2.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('47', '24', 'camerabag.jpeg');

INSERT INTO `Product_Image` (`Product_Image_ID`, `Product_ID`, `Product_Image_File_name`) VALUES ('48', '24', 'camerabag2.jpeg');

