<?php

namespace App\Enums;

enum AppUserSecurityLevel: int
{
    case Basic = 1;
    case Moderator = 2;
    case Admin = 3;
    case SuperAdmin = 4;

    public function getSecurityLevelAbilities(int $securityLevel): array
    {
        if ($securityLevel == self::Basic) {
            return [AppUserAbility::CategoryGet, AppUserAbility::LocationGet, AppUserAbility::UnitOfMeasureGet, AppUserAbility::ItemGet];
        } else if ($securityLevel == self::Moderator) {
            return [
                AppUserAbility::CategoryGet, AppUserAbility::CategoryCreate,
                AppUserAbility::LocationGet,
                AppUserAbility::UnitOfMeasureGet, AppUserAbility::UnitOfMeasureCreate,
                AppUserAbility::ItemGet
            ];
        } else if ($securityLevel == self::Moderator) {
            return [
                AppUserAbility::CategoryGet, AppUserAbility::CategoryCreate,
                AppUserAbility::LocationGet, AppUserAbility::LocationCreate,
                AppUserAbility::UnitOfMeasureGet, AppUserAbility::UnitOfMeasureCreate,
                AppUserAbility::ItemGet
            ];
        } else {
            return [];
        }
    }
}
