<?php

namespace App;

class Payment
{
    public static function payDebit(Order $order, $securityCode)
    {
        print_r('Processing debit payment type' . PHP_EOL);
        printf('Verifying security code: %s' . PHP_EOL, $securityCode);
        $order->status = 'paid';
    }

    public static function payBanklink(Order $order, $securityCode)
    {
        print_r('Processing banklink payment type' . PHP_EOL);
        printf('Verifying security code: %s' . PHP_EOL, $securityCode);
        $order->status = 'paid';
    }
}
