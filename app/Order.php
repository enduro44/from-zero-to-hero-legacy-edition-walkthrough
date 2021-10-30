<?php

namespace App;

use Exception;

class Order
{
    public $items;
    public $quantities;
    public $prices;
    public $status;

    function addItem($name, $quantity, $price)
    {
        $this->items[] = $name;
        $this->quantities[] = $quantity;
        $this->prices[] = $price;
    }

    function totalPrice()
    {
        $total = 0;
        for ($i = 0; $i < count($this->prices); $i++)
            $total += $this->quantities[$i] * $this->prices[$i];
        return $total;
    }

    function pay($paymentType, $securityCode)
    {
        if ($paymentType == 'debit') {
            print_r('Processing debit payment type' . PHP_EOL);
            printf('Verifying security code: %s' . PHP_EOL, $securityCode);
            $this->status = 'paid';
        }
        if ($paymentType == 'banklink') {
            print_r('Processing banklink payment type' . PHP_EOL);
            printf('Verifying security code: %s' . PHP_EOL, $securityCode);
            $this->status = 'paid';
        } else {
            throw new Exception(sprintf('Unknown payment type: %s', $paymentType));
        }
    }
}
