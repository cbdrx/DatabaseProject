insert into user 
values ('Tory', 'tory', 'Tory Hebert', 0),
('Chris', 'chris', 'Chris Boudreaux', 0),
('Phil', 'phil', 'Phil Huval', 0),
('Jereth', 'jereth', 'Jereth Champagne', 0);

insert into business
values ('Walmart'), ('Dennys'), ('Tsunami'),
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

insert into category(name, goal, isDefault, FK_createdBy, FK_parentName, FK_parentCLID, income)
values('Default', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Default', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Default', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Default', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0');

insert into category (name, goal, isDefault, FK_createdBy, FK_parentName, FK_parentCLID, income)
values ('Paycheck', '0.00', '1', 'Tory', 'Default', 'Tory', '1'),
('Miscellaneous Income', '0.00', '1', 'Tory', 'Default', 'Tory', '1'),
('Automobile', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Gasoline', '0.00', '1', 'Tory', 'Automobile', 'Tory', '0'),
('Maintenance', '0.00', '1', 'Tory', 'Automobile', 'Tory', '0'),
('Auto loan payment', '0.00', '1', 'Tory', 'Automobile', 'Tory', '0'),
('Charity', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Clothing', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Education', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Tuition', '0.00', '1', 'Tory', 'Education', 'Tory', '0'),
('Books', '0.00', '1', 'Tory', 'Education', 'Tory', '0'),
('Student Loan Payment', '0.00', '1', 'Tory', 'Education', 'Tory', '0'),
('Food', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Groceries', '0.00', '1', 'Tory', 'Food', 'Tory', '0'),
('Dining Out', '0.00', '1', 'Tory', 'Food', 'Tory', '0'),
('Healthcare', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Dental', '0.00', '1', 'Tory', 'Healthcare', 'Tory', '0'),
('Vision', '0.00', '1', 'Tory', 'Healthcare', 'Tory', '0'),
('Medical', '0.00', '1', 'Tory', 'Healthcare', 'Tory', '0'),
('Household', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Rent / Mortgage Payment', '0.00', '1', 'Tory', 'Household', 'Tory', '0'),
('Utilities', '0.00', '1', 'Tory', 'Household', 'Tory', '0'),
('Insurance', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Automobile', '0.00', '1', 'Tory', 'Insurance', 'Tory', '0'),
('Health', '0.00', '1', 'Tory', 'Insurance', 'Tory', '0'),
('Entertainment', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Reading Material', '0.00', '1', 'Tory', 'Entertainment', 'Tory', '0'),
('Movies', '0.00', '1', 'Tory', 'Entertainment', 'Tory', '0'),
('Sporting Events', '0.00', '1', 'Tory', 'Entertainment', 'Tory', '0'),
('Sporting Goods', '0.00', '1', 'Tory', 'Entertainment', 'Tory', '0'),
('Transfer to Savings', '0.00', '1', 'Tory', 'Default', 'Tory', '0'),
('Miscellaneous Expense', '0.00', '1', 'Tory', 'Default', 'Tory', '0');

insert into category (name, goal, isDefault, FK_createdBy, FK_parentName, FK_parentCLID, income)
values ('Paycheck', '0.00', '1', 'Chris', 'Default', 'Chris', '1'),
('Miscellaneous Income', '0.00', '1', 'Chris', 'Default', 'Chris', '1'),
('Automobile', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Gasoline', '0.00', '1', 'Chris', 'Automobile', 'Chris', '0'),
('Maintenance', '0.00', '1', 'Chris', 'Automobile', 'Chris', '0'),
('Auto loan payment', '0.00', '1', 'Chris', 'Automobile', 'Chris', '0'),
('Charity', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Clothing', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Education', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Tuition', '0.00', '1', 'Chris', 'Education', 'Chris', '0'),
('Books', '0.00', '1', 'Chris', 'Education', 'Chris', '0'),
('Student Loan Payment', '0.00', '1', 'Chris', 'Education', 'Chris', '0'),
('Food', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Groceries', '0.00', '1', 'Chris', 'Food', 'Chris', '0'),
('Dining Out', '0.00', '1', 'Chris', 'Food', 'Chris', '0'),
('Healthcare', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Dental', '0.00', '1', 'Chris', 'Healthcare', 'Chris', '0'),
('Vision', '0.00', '1', 'Chris', 'Healthcare', 'Chris', '0'),
('Medical', '0.00', '1', 'Chris', 'Healthcare', 'Chris', '0'),
('Household', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Rent / Mortgage Payment', '0.00', '1', 'Chris', 'Household', 'Chris', '0'),
('Utilities', '0.00', '1', 'Chris', 'Household', 'Chris', '0'),
('Insurance', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Automobile', '0.00', '1', 'Chris', 'Insurance', 'Chris', '0'),
('Health', '0.00', '1', 'Chris', 'Insurance', 'Chris', '0'),
('Entertainment', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Reading Material', '0.00', '1', 'Chris', 'Entertainment', 'Chris', '0'),
('Movies', '0.00', '1', 'Chris', 'Entertainment', 'Chris', '0'),
('Sporting Events', '0.00', '1', 'Chris', 'Entertainment', 'Chris', '0'),
('Sporting Goods', '0.00', '1', 'Chris', 'Entertainment', 'Chris', '0'),
('Transfer to Savings', '0.00', '1', 'Chris', 'Default', 'Chris', '0'),
('Miscellaneous Expense', '0.00', '1', 'Chris', 'Default', 'Chris', '0');

insert into category (name, goal, isDefault, FK_createdBy, FK_parentName, FK_parentCLID, income)
values ('Paycheck', '0.00', '1', 'Phil', 'Default', 'Phil', '1'),
('Miscellaneous Income', '0.00', '1', 'Phil', 'Default', 'Phil', '1'),
('Automobile', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Gasoline', '0.00', '1', 'Phil', 'Automobile', 'Phil', '0'),
('Maintenance', '0.00', '1', 'Phil', 'Automobile', 'Phil', '0'),
('Auto loan payment', '0.00', '1', 'Phil', 'Automobile', 'Phil', '0'),
('Charity', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Clothing', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Education', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Tuition', '0.00', '1', 'Phil', 'Education', 'Phil', '0'),
('Books', '0.00', '1', 'Phil', 'Education', 'Phil', '0'),
('Student Loan Payment', '0.00', '1', 'Phil', 'Education', 'Phil', '0'),
('Food', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Groceries', '0.00', '1', 'Phil', 'Food', 'Phil', '0'),
('Dining Out', '0.00', '1', 'Phil', 'Food', 'Phil', '0'),
('Healthcare', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Dental', '0.00', '1', 'Phil', 'Healthcare', 'Phil', '0'),
('Vision', '0.00', '1', 'Phil', 'Healthcare', 'Phil', '0'),
('Medical', '0.00', '1', 'Phil', 'Healthcare', 'Phil', '0'),
('Household', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Rent / Mortgage Payment', '0.00', '1', 'Phil', 'Household', 'Phil', '0'),
('Utilities', '0.00', '1', 'Phil', 'Household', 'Phil', '0'),
('Insurance', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Automobile', '0.00', '1', 'Phil', 'Insurance', 'Phil', '0'),
('Health', '0.00', '1', 'Phil', 'Insurance', 'Phil', '0'),
('Entertainment', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Reading Material', '0.00', '1', 'Phil', 'Entertainment', 'Phil', '0'),
('Movies', '0.00', '1', 'Phil', 'Entertainment', 'Phil', '0'),
('Sporting Events', '0.00', '1', 'Phil', 'Entertainment', 'Phil', '0'),
('Sporting Goods', '0.00', '1', 'Phil', 'Entertainment', 'Phil', '0'),
('Transfer to Savings', '0.00', '1', 'Phil', 'Default', 'Phil', '0'),
('Miscellaneous Expense', '0.00', '1', 'Phil', 'Default', 'Phil', '0');

insert into category (name, goal, isDefault, FK_createdBy, FK_parentName, FK_parentCLID, income)
values ('Paycheck', '0.00', '1', 'Jereth', 'Default', 'Jereth', '1'),
('Miscellaneous Income', '0.00', '1', 'Jereth', 'Default', 'Jereth', '1'),
('Automobile', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0'),
('Gasoline', '0.00', '1', 'Jereth', 'Automobile', 'Jereth', '0'),
('Maintenance', '0.00', '1', 'Jereth', 'Automobile', 'Jereth', '0'),
('Auto loan payment', '0.00', '1', 'Jereth', 'Automobile', 'Jereth', '0'),
('Charity', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0'),
('Clothing', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0'),
('Education', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0'),
('Tuition', '0.00', '1', 'Jereth', 'Education', 'Jereth', '0'),
('Books', '0.00', '1', 'Jereth', 'Education', 'Jereth', '0'),
('Student Loan Payment', '0.00', '1', 'Jereth', 'Education', 'Jereth', '0'),
('Food', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0'),
('Groceries', '0.00', '1', 'Jereth', 'Food', 'Jereth', '0'),
('Dining Out', '0.00', '1', 'Jereth', 'Food', 'Jereth', '0'),
('Healthcare', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0'),
('Dental', '0.00', '1', 'Jereth', 'Healthcare', 'Jereth', '0'),
('Vision', '0.00', '1', 'Jereth', 'Healthcare', 'Jereth', '0'),
('Medical', '0.00', '1', 'Jereth', 'Healthcare', 'Jereth', '0'),
('Household', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0'),
('Rent / Mortgage Payment', '0.00', '1', 'Jereth', 'Household', 'Jereth', '0'),
('Utilities', '0.00', '1', 'Jereth', 'Household', 'Jereth', '0'),
('Insurance', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0'),
('Automobile', '0.00', '1', 'Jereth', 'Insurance', 'Jereth', '0'),
('Health', '0.00', '1', 'Jereth', 'Insurance', 'Jereth', '0'),
('Entertainment', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0'),
('Reading Material', '0.00', '1', 'Jereth', 'Entertainment', 'Jereth', '0'),
('Movies', '0.00', '1', 'Jereth', 'Entertainment', 'Jereth', '0'),
('Sporting Events', '0.00', '1', 'Jereth', 'Entertainment', 'Jereth', '0'),
('Sporting Goods', '0.00', '1', 'Jereth', 'Entertainment', 'Jereth', '0'),
('Transfer to Savings', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0'),
('Miscellaneous Expense', '0.00', '1', 'Jereth', 'Default', 'Jereth', '0');

insert into incomeTransaction (FK_user, FK_category, amount, date) 
values ('Tory', 'Paycheck', '200.00', '01/01/2015'),
('Chris', 'Paycheck', '200.00', '01/01/2015'),
('Phil', 'Paycheck', '200.00', '01/01/2015'),
('Jereth', 'Paycheck', '200.00', '01/01/2015');

insert into expenseTransaction(checkNumber, amount, date, FK_accountNumber, FK_business, FK_user, FK_category)
values ('0000', '10.00', '01/01/2015', '0000', 'Walmart', 'Tory', 'Health'),
('0000', '10.00', '01/01/2015', '0001', 'Walmart', 'Chris', 'Health'),
('0000', '10.00', '01/01/2015', '0002', 'Walmart', 'Phil', 'Health'),
('0000', '10.00', '01/01/2015', '0003', 'Walmart', 'Jereth', 'Health');

insert into userBusinessCategory(FK_user, FK_business, FK_category)
values('Tory', 'Walmart', 'Groceries'),
('Chris', 'Walmart', 'Groceries'),
('Phil', 'Walmart', 'Groceries'),
('Jereth', 'Walmart', 'Groceries');

