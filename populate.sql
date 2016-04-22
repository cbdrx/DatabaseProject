insert into user 
values ('Tory', 'tory', 'Tory Hebert', 0),
('Chris', 'chris', 'Chris Boudreaux', 0),
('Phil', 'phil', 'Phil Huval', 0),
('Jereth', 'jereth', 'Jereth Champagne', 0);

insert into business
values ('Walmart'), ('Dennys'), ('Tsunami'), ('Checking To Savings'),
('Taco Stand'), ('Pizza Stand'), ('Frog Stand'),
('TV Stand'), ('Milk Stand'), ('News Stand'), 
('Gas Stand'), ('Gun Stand'), ('Fire Truck Stand');

insert into checkingAccount
values (0000, '29.97', 'Tory'),
(0001, '32.34', 'Chris'),
(0002, '269.87', 'Phil'),
(0003, '60.82', 'Jereth');

insert into savingsAccount
values (0010, '29.97', 'Tory'),
(0011, '32.34', 'Chris'),
(0013, '60.82', 'Jereth');

insert into category (id, name, isDefault, FK_createdBy, FK_parentID, income)
values('4','Paycheck',  '1', 'Tory', null,  '1'),
('5','Miscellaneous Income',  '1', 'Tory', null,  '1'),
('6','Automobile', '1', 'Tory', null, '0'),
('10','Charity',  '1', 'Tory', null,  '0'),
('11','Clothing',  '1', 'Tory', null,  '0'),
('12','Education', '1', 'Tory', null, '0'),
('16','Food', '1', 'Tory', null, '0'),
('19','Healthcare',  '1', 'Tory', null,  '0'),
('23','Household','1', 'Tory', null,  '0'),
('26','Insurance', '1', 'Tory',null,'0'),
('29','Entertainment',  '1', 'Tory', null, '0'),
('34','Transfer to Savings', '1', 'Tory', null, '0'),
('35','Miscellaneous Expense', '1', 'Tory', null, '0');

insert into category (id, name, isDefault, FK_createdBy, FK_parentID, income)
values('7','Gasoline', '1', 'Tory', '6', '0'),
('8','Maintenance', '1', 'Tory', '6', '0'),
('9','Auto loan payment', '1', 'Tory', '6',  '0'),
('13','Tuition',  '1', 'Tory', '12', '0'),
('14','Books', '1', 'Tory', '12', '0'),
('15','Student Loan Payment',  '1', 'Tory', '12',  '0'),
('17','Groceries', '1', 'Tory', '16', '0'),
('18','Dining Out',  '1', 'Tory', '16', '0'),
('20','Dental',  '1', 'Tory', '20', '0'),
('21','Vision', '1', 'Tory', '20', '0'),
('22','Medical', '1', 'Tory', '20',  '0'),
('24','Rent / Mortgage Payment','1', 'Tory', '23',  '0'),
('25','Utilities', '1', 'Tory', '23', '0'),
('27','Automobile', '1', 'Tory', '26',  '0'),
('28','Health', '1', 'Tory', '26',  '0'),
('30','Reading Material', '1', 'Tory', '29', '0'),
('31','Movies', '1', 'Tory', '29',  '0'),
('32','Sporting Events',  '1', 'Tory', '29',  '0'),
('33','Sporting Goods', '1', 'Tory', '29',  '0');

insert into category (id, name, isDefault, FK_createdBy, FK_parentID, income)
values ('36','Paycheck',  '1', 'Chris', null,  '1'),
('37','Miscellaneous Income',  '1', 'Chris', null,  '1'),
('38','Automobile', '1', 'Chris', null, '0'),
('42','Charity',  '1', 'Chris', null,  '0'),
('43','Clothing',  '1', 'Chris',null,  '0'),
('44','Education', '1', 'Chris', null, '0'),
('48','Food',  '1', 'Chris', null, '0'),
('51','Healthcare',  '1', 'Chris', null,  '0'),
('55','Household','1', 'Chris', null,  '0'),
('58','Insurance', '1', 'Chris', null,'0'),
('61','Entertainment',  '1', 'Chris', null, '0'),
('66','Transfer to Savings', '1', 'Chris', null, '0'),
('67','Miscellaneous Expense', '1', 'Chris', null, '0');

insert into category (id, name, isDefault, FK_createdBy, FK_parentID, income)
values 
('39','Gasoline', '1', 'Chris', '38', '0'),
('40','Maintenance', '1', 'Chris', '38', '0'),
('41','Auto loan payment', '1', 'Chris', '38',  '0'),
('45','Tuition',  '1', 'Chris', '44', '0'),
('46','Books', '1', 'Chris', '44', '0'),
('47','Student Loan Payment',  '1', 'Chris', '44',  '0'),
('49','Groceries', '1', 'Chris', '48', '0'),
('50','Dining Out',  '1', 'Chris', '48', '0'),
('52','Dental',  '1', 'Chris', '51', '0'),
('53','Vision', '1', 'Chris', '51', '0'),
('54','Medical', '1', 'Chris', '51',  '0'),
('56','Rent / Mortgage Payment','1', 'Chris', '55',  '0'),
('57','Utilities', '1', 'Chris', '55', '0'),
('59','Automobile', '1', 'Chris', '58',  '0'),
('60','Health', '1', 'Chris', '58',  '0'),
('62','Reading Material', '1', 'Chris', '61', '0'),
('63','Movies', '1', 'Chris', '61',  '0'),
('64','Sporting Events',  '1', 'Chris', '61',  '0'),
('65','Sporting Goods', '1', 'Chris', '61',  '0');

insert into category (id, name, isDefault, FK_createdBy, FK_parentID, income)
values ('68','Paycheck',  '1', 'Phil', null,  '1'),
('69','Miscellaneous Income',  '1', 'Phil', null,  '1'),
('70','Automobile', '1', 'Phil', null, '0'),
('74','Charity',  '1', 'Phil', null,  '0'),
('75','Clothing',  '1', 'Phil', null,  '0'),
('76','Education', '1', 'Phil', null, '0'),
('80','Food',  '1', 'Phil', null, '0'),
('83','Healthcare',  '1', 'Phil', null,  '0'),
('87','Household','1', 'Phil', null,  '0'),
('90','Insurance', '1', 'Phil', null,'0'),
('93','Entertainment',  '1', 'Phil', null, '0'),
('98','Transfer to Savings', '1', 'Phil', null, '0'),
('99','Miscellaneous Expense', '1', 'Phil', null, '0');

insert into category (id, name, isDefault, FK_createdBy, FK_parentID, income)
values('71','Gasoline', '1', 'Phil', '70', '0'),
('72','Maintenance', '1', 'Phil', '70', '0'),
('73','Auto loan payment', '1', 'Phil', '70',  '0'),
('77','Tuition',  '1', 'Phil', '76', '0'),
('78','Books', '1', 'Phil', '76', '0'),
('79','Student Loan Payment',  '1', 'Phil', '76',  '0'),
('81','Groceries', '1', 'Phil', '80', '0'),
('82','Dining Out',  '1', 'Phil', '80', '0'),
('84','Dental',  '1', 'Phil', '83', '0'),
('85','Vision', '1', 'Phil', '83', '0'),
('86','Medical', '1', 'Phil', '83',  '0'),
('88','Rent / Mortgage Payment','1', 'Phil', '87',  '0'),
('89','Utilities', '1', 'Phil', '87', '0'),
('91','Automobile', '1', 'Phil', '90',  '0'),
('92','Health', '1', 'Phil', '90',  '0'),
('94','Reading Material', '1', 'Phil', '93', '0'),
('95','Movies', '1', 'Phil', '93',  '0'),
('96','Sporting Events',  '1', 'Phil', '93',  '0'),
('97','Sporting Goods', '1', 'Phil', '93',  '0');

insert into category (id, name, isDefault, FK_createdBy, FK_parentID, income)
values ('100','Paycheck',  '1', 'Jereth', null,  '1'),
('101','Miscellaneous Income',  '1', 'Jereth', null,  '1'),
('102','Automobile', '1', 'Jereth', null, '0'),
('106','Charity',  '1', 'Jereth', null,  '0'),
('107','Clothing',  '1', 'Jereth', null,  '0'),
('108','Education', '1', 'Jereth', null, '0'),
('112','Food',  '1', 'Jereth', null, '0'),
('115','Healthcare',  '1', 'Jereth', null,  '0'),
('119','Household','1', 'Jereth', null,  '0'),
('122','Insurance', '1', 'Jereth', null,'0'),
('125','Entertainment',  '1', 'Jereth', null, '0'),
('130','Transfer to Savings', '1', 'Jereth', null, '0'),
('131','Miscellaneous Expense', '1', 'Jereth', null, '0');

insert into category (id, name, isDefault, FK_createdBy, FK_parentID, income)
values ('103','Gasoline', '1', 'Jereth', '102', '0'),
('104','Maintenance', '1', 'Jereth', '102', '0'),
('105','Auto loan payment', '1', 'Jereth', '102',  '0'),
('109','Tuition',  '1', 'Jereth', '108', '0'),
('110','Books', '1', 'Jereth', '108', '0'),
('111','Student Loan Payment',  '1', 'Jereth', '108',  '0'),
('113','Groceries', '1', 'Jereth', '112', '0'),
('114','Dining Out',  '1', 'Jereth', '112', '0'),
('116','Dental',  '1', 'Jereth', '115', '0'),
('117','Vision', '1', 'Jereth', '115', '0'),
('118','Medical', '1', 'Jereth', '115',  '0'),
('120','Rent / Mortgage Payment','1', 'Jereth', '119',  '0'),
('121','Utilities', '1', 'Jereth', '119', '0'),
('123','Automobile', '1', 'Jereth', '122',  '0'),
('124','Health', '1', 'Jereth', '122',  '0'),
('126','Reading Material', '1', 'Jereth', '125', '0'),
('127','Movies', '1', 'Jereth', '125',  '0'),
('128','Sporting Events',  '1', 'Jereth', '125',  '0'),
('129','Sporting Goods', '1', 'Jereth', '125',  '0');

insert into incomeTransaction (FK_user, FK_category, amount, date) 
values ('Tory', '4', '200.00', '2015-01-01'),
('Chris', '36', '200.00', '2015-01-01'),
('Phil', '68', '200.00', '2015-01-01'),
('Jereth', '100', '200.00', '2015-01-01');

insert into expenseTransaction(checkNumber, amount, date, FK_accountNumber, FK_business, FK_user, FK_category)
values ('0000', '10.00', '2015-01-01', '0000', 'Walmart', 'Tory', '28'),
('0000', '10.00', '2015-01-01', '0001', 'Walmart', 'Chris', '60'),
('0000', '10.00', '2015-01-01', '0002', 'Walmart', 'Phil', '92'),
('0000', '10.00', '2015-01-01', '0003', 'Walmart', 'Jereth', '124');

insert into userBusinessCategory(FK_user, FK_business, FK_category)
values('Tory', 'Walmart', '17'),
('Chris', 'Walmart', '49'),
('Phil', 'Walmart', '81'),
('Jereth', 'Walmart', '113');

