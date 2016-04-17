select c1.id ID, c1.name Name, c1.goal Goal, c1.isDefault 'Default', c1.FK_createdBy 'Created By', c2.name Parent, c1.income 'Is Income'
				from category c1, category c2
				where (c1.FK_parentID = c2.id and c1.FK_createdBy = c2.FK_createdBy
				union
				select c1.id ID, c1.name Name, c1.goal Goal, c1.isDefault 'Default', c1.FK_createdBy 'Created By', 'No Parent', c1.income 'Is Income'
				from category c1, category c2
				where c1.FK_parentID is null
				order by 'Created By', Name;
