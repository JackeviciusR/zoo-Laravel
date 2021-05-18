## Zoo

<img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
<img src="https://img.shields.io/badge/Gluten-Free-green.svg" alt="Gluten"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src=https://img.shields.io/badge/structure-Laravel-red alt="Structure"></a>


This project is for educational porpuses only.

#### MySQL structure:

animals      | managers     | species      | users
------------ | -------------| -------------| -------------
id: int(11) | id: int(11) | id: int(11) | id: int(11)
name: varchar(255) | name varchar(64) | name: varchar(64) | name varchar(64)
specie_id: int(11) unsigned | surname varchar(64) | | email email(64) pass
birth_year: tinyint(4) unsigned | specie_id int(11) unsigned | | password(128
animal_book: text | 
manager_id : int(11) |


#### Relations:
```
animals.manager_id ------> managers.id
animals.spiece_id  ------> species.id
managers.specie_id ------> species.id
```

#### Functions:
- Registration, Log In/Out;
- Animals, managers and species can be created, updated and deleted (CRUD);
- Animals are recorded with a select box where you can choose one of the species and another select box with a list of managers;
- The managers corresponded to the species of animal, manager can have one specie. An error is displayed if you select the wrong manager of specie;.
