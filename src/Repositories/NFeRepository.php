<?php

namespace Bling\Repositories;

use Spatie\ArrayToXml\ArrayToXml;

class NFeRepository extends BaseRepository
{
    public function all(array $filters = []): ?array
    {
        $options = [];

        foreach ($filters as $k => $v) {
            $filters[$k] = $k.'['.$v.']';
        }

        if(count($filters)) {
            $options['filters'] = implode('; ', $filters);
        }

        return $this->client->get('notasfiscais/json/', $options);
    }

    public function find(int $numero, int $serie): ?array
    {
        return $this->client->get("notafiscal/$numero/$serie/json/");
    }

    public function create(array $params): ?array
    {
        $options = [];

        $rootElement = array_key_first($params);

        $xml = ArrayToXml::convert($params[$rootElement], $rootElement);

        $options['xml'] = $xml;

        return $this->client->post('notafiscal/json/', $options);
    }

    public function send(int $numero, int $serie, $sendEmail = false): ?array
    {
        $options = [];

        $options['number'] = $numero;
        $options['serie'] = $serie;

        if($sendEmail) {
            $options['sendEmail'] = 'true';
        }

        return $this->client->post("notafiscal/$numero/$serie/json/", $options);
    }
}