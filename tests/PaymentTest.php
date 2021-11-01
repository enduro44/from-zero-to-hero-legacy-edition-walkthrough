<?php

namespace Tests;


use App\Order;
use App\Payment;
use Codeception\Test\Unit;

class PaymentTest extends Unit
{
    public function testPaymentByDebit()
    {
        $order = new Order();
        $securityCode = '12';
        $payment = new Payment();
        $payment::payDebit($order, $securityCode);
        $this->expectOutputRegex('/Processing debit payment type/');
        $this->expectOutputRegex(sprintf('/Verifying security code: %s/', $securityCode));
        $this->assertEquals('paid', $order->status);
    }

    public function testPaymentByBanklink()
    {
        $order = new Order();
        $securityCode = '12';
        $payment = new Payment();
        $payment::payBanklink($order, $securityCode);
        $this->expectOutputRegex('/Processing banklink payment type/');
        $this->expectOutputRegex(sprintf('/Verifying security code: %s/', $securityCode));
        $this->assertEquals('paid', $order->status);
    }
}
