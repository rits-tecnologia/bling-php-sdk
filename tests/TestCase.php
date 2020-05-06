<?php

namespace Bling\Tests;

use Bling\Bling;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Symfony\Component\Dotenv\Dotenv;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var Bling
     */
    protected $bling;

    public function setUp(): void
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../.env');

        $this->bling = new Bling($_ENV['BLING_API_KEY']);
    }
}
