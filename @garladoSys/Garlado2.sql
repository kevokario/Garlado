
CREATE TABLE majorCategory(
	majorId int(255) AUTO_INCREMENT PRIMARY KEY,
	majorName varchar(70),
	status int(1)
);

CREATE TABLE category (
	catId int(255) primary KEY AUTO_INCREMENT,
	majorId int(255),
	catName varchar(70),
	status int(1)
);

CREATE TABLE minorCategory(
	minorId int(255) AUTO_INCREMENT PRIMARY KEY,
	catId int(255),
	minorName varchar(70),
	status int(1)
);

CREATE TABLE items(
	itemId int(255) AUTO_INCREMENT PRIMARY KEY,
	catId int(255),
	minorId int(255),
	itemName varchar(70),
	itemPic varchar(100),
	newPrice varchar(100),
	oldPrice varchar(100),
	itemBrand varchar(100),
	itemQuantity varchar(100),
	itemRating varchar(100),
	status int(1)
);

CREATE TABLE itemFeatures(
	featureId int(255) PRIMARY KEY AUTO_INCREMENT,
	itemId int(255),
	keyFeatures varchar(2000)
);

CREATE TABLE featuresComps(
	featureId int(255) PRIMARY KEY AUTO_INCREMENT,
	itemId int(255),
	ram varchar(10),
	rom varchar(20),
	displaySize varchar(20),
	operatingSystem varchar(20),
	processor varchar(14)
);

ALTER TABLE category ADD FOREIGN KEY (majorId) references majorCategory(majorId) on UPDATE CASCADE on DELETE RESTRICT;
ALTER TABLE minorCategory ADD FOREIGN KEY (catId) references category(catId) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE items ADD FOREIGN KEY (minorId) references minorCategory(minorId) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE items ADD FOREIGN KEY (catId) references category(catId) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE itemFeatures ADD FOREIGN KEY (itemId) references items(itemId) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE featuresComps ADD FOREIGN KEY (itemId) references items(itemId) ON UPDATE CASCADE ON DELETE RESTRICT;


CREATE TABLE Clients(
	clientId int(255) PRIMARY KEY AUTO_INCREMENT,
	fName varchar(60),
	lName varchar(60),
	phone varchar(15),
	email varchar(100),
	password varchar(100)
);

CREATE TABLE Records(
	recordId int(255) AUTO_INCREMENT PRIMARY KEY,
	itemId int(255),
	clientId int(255),
	time varchar(25),
	date varchar(25),
	day varchar(25),
	month varchar(3),
	year varchar(5),
	itemQuantity varchar(255),
	price varchar(200),
	modeOfPurchase varchar(200),
	transactionCode varchar(200)
);

ALTER TABLE Records ADD FOREIGN KEY (clientId) references Clients(clientId) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE Records ADD FOREIGN KEY (itemId) references items(itemId) ON UPDATE CASCADE ON DELETE RESTRICT;

CREATE TABLE admins(
	adminId int(255) PRIMARY KEY AUTO_INCREMENT,
	name varchar(60),
	email varchar(100),
	phone varchar(15),
	password varchar(200),
	level varchar(35),
	image varchar(40),
        status int(4)
);

CREATE TABLE adminLog(
	logId int(255) PRIMARY KEY AUTO_INCREMENT,
	adminId int(255),
	time varchar(25),
	date varchar(25),
	day varchar(25),
	month varchar(3),
	year varchar(5),
	action varchar(2000)
);

ALTER TABLE adminLog ADD FOREIGN KEY (adminId) references admins(adminId) ON UPDATE CASCADE ON DELETE RESTRICT;

