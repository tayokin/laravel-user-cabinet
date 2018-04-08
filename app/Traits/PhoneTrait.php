<?php

declare(strict_types=1);

namespace App\Traits;

/**
 * Trait PhoneTrait.
 */
trait PhoneTrait
{
    /**
     * @param string $phoneCode
     * @param string $phoneNumber
     *
     * @return string
     */
    public function getPhoneFromCodeAndNumber(string $phoneCode, string $phoneNumber): string
    {
        $phoneCode   = preg_replace('/[\D]/', '', $phoneCode);
        $phoneNumber = preg_replace('/[\D]/', '', $phoneNumber);

        return  '+'.$phoneCode.$phoneNumber;
    }
}
