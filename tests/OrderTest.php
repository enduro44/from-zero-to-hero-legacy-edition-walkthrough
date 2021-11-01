<?php

namespace Tests;


use App\Order;
use Codeception\Test\Unit;

class OrderTest extends Unit
{
    /**
     * @dataProvider totalPriceProvider
     */
    public function testTotalPrice(array $items, $expectedTotalPrice)
    {
        $order = new Order();
        foreach ($items as $item) {
            $order->addItem($item['name'], $item['quantity'], $item['price']);
        }
        $this->assertEquals($expectedTotalPrice, $order->totalPrice());
    }

    public function totalPriceProvider(): array
    {
        return [
            [[['name' => 'Keyboard', 'quantity' => 1, 'price' => 50]], 50],
            [[
                ['name' => 'Keyboard', 'quantity' => 10000, 'price' => 1],
                ['name' => 'Keyboard', 'quantity' => 2, 'price' => 1.5],
            ], 10003],
        ];
    }
}
