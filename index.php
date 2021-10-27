<?php
require_once 'vendor/autoload.php';

use App\Order;

$order = new Order();
$order->addItem('Keyboard', 1, 50);
$order->addItem('CPU', 1, 150);
$order->addItem('USB cabal', 2, 5);
print_r($order->totalPrice() . PHP_EOL);
$order->pay('banklink', '12');
print_r($order->status);

