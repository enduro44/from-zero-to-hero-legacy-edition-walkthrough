<?php

namespace Tests;


use App\Order;

class OrderTest extends \Codeception\Test\Unit
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

}
