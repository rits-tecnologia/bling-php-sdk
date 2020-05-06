<?php

namespace Bling\Repositories;

use Spatie\ArrayToXml\ArrayToXml;

class OrderRepository extends BaseRepository
{
    public function all(array $filters = [], bool $historico = false): ?array
    {
        $options = [];

        if($historico) {
            $options['historico'] = 'true';
        }

        foreach ($filters as $k => $v) {
            $filters[$k] = $k.'['.$v.']';
        }

        if(count($filters)) {
            $options['filters'] = implode('; ', $filters);
        }

        return $this->client->get('pedidos/json/', $options);
    }

    public function find(int $numero, bool $historico = false): ?array
    {
        $options = [];

        if($historico) {
            $options['historico'] = 'true';
        }

        return $this->client->get("pedido/$numero/json/", $options);
    }

    public function create(array $params, bool $gerarnfe = false): ?array
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        if($gerarnfe) {
            $options['gerarnfe'] = 'true';
        }

        return $this->client->post('pedido/json/', $options);
    }

    public function update(int $numero, array $params): ?array
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->put("pedido/$numero/json/", $options);
    }
}