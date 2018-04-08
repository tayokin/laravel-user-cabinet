<?php

declare(strict_types=1);

namespace App\Traits;

trait AccountKitTrait
{
    private $baseUri = 'https://www.accountkit.com/v1.0/basic/dialog/sms_login/?';

    public function getSmsUrl(string $token, string $phoneNumber): string
    {
        return $this->baseUri.
            'country_code=UA'.
            '&app_id='.config('accountKit.accountKitAppId').
            '&redirect='.config('accountKit.accountKitRedirectUrl').
            '&state='.$token.
            '&phone_number='.$phoneNumber;
    }
}
