<?php

namespace Tests;


use App\Order;
use Codeception\Test\Unit;

class OrderTest extends Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testPaymentByBanklink()
    {
        $order = new Order();
        $securityCode = '12';
        $order->pay('banklink', $securityCode);
        $this->expectOutputRegex('/Processing banklink payment type/');
        $this->expectOutputRegex(sprintf('/Verifying security code: %s/', $securityCode));
        $this->assertEquals('paid', $order->status);
    }

    public function testExceptionInThrownForUnknownPaymentType()
    {
        $order = new Order();
        $paymentType = 'unknown';
        $this->expectExceptionMessage(sprintf('Unknown payment type: %s', $paymentType));
        $order->pay($paymentType, '');
    }

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
