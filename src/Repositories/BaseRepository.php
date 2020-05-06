<?php

namespace Bling\Repositories;

use Bling\API\Client;

class BaseRepository
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}