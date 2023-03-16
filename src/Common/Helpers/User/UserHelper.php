<?php

declare(strict_types=1);

namespace App\Common\Helpers\User;

final class UserHelper
{
    public static function getPrefixFromTaxNumber(string $taxNumber): string
    {
        return substr($taxNumber, 0, 2);
    }
}
