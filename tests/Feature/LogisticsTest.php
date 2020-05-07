<?php

namespace Bling\Tests\Feature;

use Bling\Tests\TestCase;
use Carbon\Carbon;

class LogisticsTest extends TestCase
{

    protected $id_logistica;
    protected $id_servico;

    public function setUp(): void
    {
        parent::setUp();

        $response = $this->bling->logistics()->allServices();

        $this->id_logistica = $response['retorno']['logisticas'][0][0]['logistica']['id_logistica'] ?? 0;
        $this->id_servico = $response['retorno']['logisticas'][0][0]['logistica']['servicos'][0]['servico']['id_servico'] ?? 0;
    }

    public function testCanCreateLogisticsService()
    {
        $response = $this->bling->logistics()->createService([
            'logistica' => [
                'descricao' => 'Teste',
                'servicos' => [
                    'servico' => [
                        [
                            'descricao' => 'criacao1',
                            'frete_item' => 5,
                            'est_entrega' => 10,
                        ],
                        [
                            'descricao' => 'criacao2',
                            'frete_item' => 54,
                            'est_entrega' => 104
                        ]
                    ]
                ]
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('logisticas', $response['retorno'] ?? []);
    }

    public function testCanUpdateLogisticsService()
    {
        $response = $this->bling->logistics()->updateService($this->id_logistica, [
            'logistica' => [
                'descricao' => 'Teste',
                'servicos' => [
                    'servico' => [
                        [
                            'descricao' => 'criacao1',
                            'frete_item' => 5,
                            'est_entrega' => 10,
                        ],
                        [
                            'descricao' => 'criacao2',
                            'frete_item' => 54,
                            'est_entrega' => 104
                        ]
                    ]
                ]
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('logisticas', $response['retorno'] ?? []);
    }

    public function testCanListLogisticsServices()
    {
        $response = $this->bling->logistics()->allServices();

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('logisticas', $response['retorno'] ?? []);
    }

    public function testeCanFindLogisticsService()
    {
        $response = $this->bling->logistics()->findService($this->id_logistica);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('logisticas', $response['retorno'] ?? []);
    }

    public function testCanUpdateOrderTracking()
    {
        $response = $this->bling->logistics()->updateOrderTracking(1, [
            'rastreamentos' => [
                'rastreamento' => [
                    [
                        'id_servico' => $this->id_servico,
                        'codigo' => 'ABC123456'
                    ]
                ]
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('logisticas', $response['retorno'] ?? []);
    }

    public function testCanUpdateNFeTracking()
    {
        $response = $this->bling->logistics()->updateNFeTracking(1, 1, [
            'rastreamentos' => [
                'rastreamento' => [
                    [
                        'id_servico' => $this->id_servico,
                        'codigo' => 'DEF123456'
                    ]
                ]
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('logisticas', $response['retorno'] ?? []);
    }


    public function testCanCreateTrackingEvent()
    {
        $response = $this->bling->logistics()->createTrackingEvent('ABC123456', [
            'evento' => [
                'id_servico' => $this->id_servico,
                'data_evento' => Carbon::now()->format('d/m/Y H:i:s'),
                'origem' => 'São Paulo',
                'destino' => 'Natal',
                'codigo_situacao' => 2,
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('logisticas', $response['retorno'] ?? []);
    }
}