<?php

namespace Bling;

use Bling\API\Client;
use Bling\Repositories\InvoiceRepository;
use Bling\Repositories\OrderRepository;
use Bling\Repositories\ProductRepository;

class Bling {

    /**
     * @var Client
     */
    protected $client;

    public function __construct(string $apiKey)
    {
        $this->client = new Client($apiKey);
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    public function orders(): OrderRepository
    {
        return new OrderRepository($this->client);
    }

    public function invoices(): InvoiceRepository
    {
        return new InvoiceRepository($this->client);
    }

    public function products(): ProductRepository
    {
        return new ProductRepository($this->client);
    }
}