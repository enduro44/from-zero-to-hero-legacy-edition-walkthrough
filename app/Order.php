<?php

namespace App;


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
}
