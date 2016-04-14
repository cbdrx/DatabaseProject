CREATE TABLE `user` (
  `CLID` varchar(7) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `superUser` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CLID`)
);

CREATE TABLE `business` (
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
);

CREATE TABLE `category` (
  `name` varchar(255) NOT NULL,
  `goal` float(16,2) NOT NULL DEFAULT '0.00',
  `isDefault` tinyint(1) NOT NULL DEFAULT '0',
  `FK_createdBy` varchar(7) NOT NULL,
  `FK_parentName` varchar(255) NOT NULL,
  `FK_parentCLID` varchar(7) NOT NULL DEFAULT '',
  `income` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`name`,`FK_createdBy`,`FK_parentName`,`FK_parentCLID`),
  KEY `FK_createdBy` (`FK_createdBy`),
  KEY `FK_parentName` (`FK_parentName`),
  KEY `FK_parentCLID` (`FK_parentCLID`),
  CONSTRAINT `category_ibfk_1` FOREIGN KEY (`FK_createdBy`) REFERENCES `user` (`CLID`) ON DELETE CASCADE,
  CONSTRAINT `category_ibfk_2` FOREIGN KEY (`FK_parentName`) REFERENCES `category` (`name`) ON DELETE CASCADE,
  CONSTRAINT `category_ibfk_3` FOREIGN KEY (`FK_parentCLID`) REFERENCES `user` (`CLID`) ON DELETE CASCADE
);

CREATE TABLE `checkingAccount` (
  `accountNumber` bigint(16) NOT NULL,
  `balance` float(16,2) NOT NULL DEFAULT '0.00',
  `FK_user` varchar(7) NOT NULL,
  PRIMARY KEY (`accountNumber`),
  KEY `FK_user` (`FK_user`),
  CONSTRAINT `checkingAccount_ibfk_1` FOREIGN KEY (`FK_user`) REFERENCES `user` (`CLID`) ON DELETE CASCADE
); 

CREATE TABLE `savingsAccount` (
  `accountNumber` bigint(16) NOT NULL,
  `balance` float(16,2) NOT NULL DEFAULT '0.00',
  `FK_user` varchar(7) NOT NULL,
  PRIMARY KEY (`accountNumber`),
  KEY `FK_user` (`FK_user`),
  CONSTRAINT `savingsAccount_ibfk_1` FOREIGN KEY (`FK_user`) REFERENCES `user` (`CLID`) ON DELETE CASCADE
);

CREATE TABLE `incomeTransaction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `amount` float(16,2) NOT NULL,
  `date` date NOT NULL,
  `FK_user` varchar(7) NOT NULL,
  `FK_category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`FK_user`,`FK_category`),
  KEY `FK_user` (`FK_user`),
  KEY `FK_category` (`FK_category`),
  CONSTRAINT `incomeTransaction_ibfk_1` FOREIGN KEY (`FK_user`) REFERENCES `user` (`CLID`) ON DELETE CASCADE,
  CONSTRAINT `incomeTransaction_ibfk_2` FOREIGN KEY (`FK_category`) REFERENCES `category` (`name`) ON DELETE CASCADE
);

CREATE TABLE `expenseTransaction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `amount` float(16,2) NOT NULL,
  `date` date NOT NULL,
  `FK_user` varchar(7) NOT NULL,
  `FK_category` varchar(255) NOT NULL,
  `FK_business` varchar(255) NOT NULL,
  `FK_accountNumber` bigint(16) NOT NULL,
  `checkNumber` bigint(16) DEFAULT NULL,
  PRIMARY KEY (`id`,`FK_accountNumber`,`FK_business`,`FK_category`),
  KEY `FK_user` (`FK_user`),
  KEY `FK_category` (`FK_category`),
  KEY `FK_business` (`FK_business`),
  KEY `FK_accountNumber` (`FK_accountNumber`),
  CONSTRAINT `expenseTransaction_ibfk_1` FOREIGN KEY (`FK_user`) REFERENCES `user` (`CLID`) ON DELETE CASCADE,
  CONSTRAINT `expenseTransaction_ibfk_2` FOREIGN KEY (`FK_category`) REFERENCES `category` (`name`) ON DELETE CASCADE,
  CONSTRAINT `expenseTransaction_ibfk_3` FOREIGN KEY (`FK_business`) REFERENCES `business` (`name`) ON DELETE CASCADE,
  CONSTRAINT `expenseTransaction_ibfk_4` FOREIGN KEY (`FK_accountNumber`) REFERENCES `checkingAccount` (`accountNumber`) ON DELETE CASCADE
);

CREATE TABLE `userBusinessCategory` (
  `FK_business` varchar(255) NOT NULL,
  `FK_user` varchar(7) NOT NULL,
  `FK_category` varchar(255) NOT NULL,
  PRIMARY KEY (`FK_business`,`FK_user`,`FK_category`),
  KEY `FK_user` (`FK_user`),
  KEY `FK_category` (`FK_category`),
  CONSTRAINT `userBusinessCategory_ibfk_1` FOREIGN KEY (`FK_business`) REFERENCES `business` (`name`) ON DELETE CASCADE,
  CONSTRAINT `userBusinessCategory_ibfk_2` FOREIGN KEY (`FK_user`) REFERENCES `user` (`CLID`) ON DELETE CASCADE,
  CONSTRAINT `userBusinessCategory_ibfk_3` FOREIGN KEY (`FK_category`) REFERENCES `category` (`name`) ON DELETE CASCADE
);  
