<?php

namespace App\Enums;

enum AppUserAbility: string
{
    case UserGet = 'users.get';
    case UserUpdate = 'users.update';
    case UserDelete = 'users.delete';

    case CategoryGet = 'categories.get';
    case CategoryCreate = 'categories.create';
    case CategoryUpdate = 'categories.update';
    case CategoryDelete = 'categories.delete';

    case LocationGet = 'locations.get';
    case LocationCreate = 'locations.create';
    case LocationUpdate = 'locations.update';
    case LocationDelete = 'locations.delete';

    case UnitOfMeasureGet = 'unitofmeasures.get';
    case UnitOfMeasureCreate = 'unitofmeasures.create';
    case UnitOfMeasureUpdate = 'unitofmeasures.update';
    case UnitOfMeasureDelete = 'unitofmeasures.delete';

    case ItemGet = 'items.get';
    case ItemCreate = 'items.create';
    case ItemUpdate = 'items.update';
    case ItemDelete = 'items.delete';
}
