<?php

namespace Bling\Tests\Feature;

use Bling\Tests\TestCase;
use Carbon\Carbon;

class OrderTest extends TestCase
{
    public function testCanCreateOrder()
    {
        $response = $this->bling->orders()->create([
            'pedido' => [
                'cliente' => [
                    'nome' => 'Organisys Software',
                    'tipoPessoa' => 'J',
                    'cpf_cnpj' => '00000000000000',
                    'ie_rg' => '3067663000',
                    'endereco' => 'Rua Visconde de São Gabriel',
                    'numero' => '392',
                    'complemento' => 'Sala 54',
                    'bairro' => 'Cidade Alta',
                    'cep' => '95.700-000',
                    'cidade' => 'Bento Gonçalves',
                    'uf' => 'RS',
                    'fone' => '54 8115-3376',
                    'email' => 'teste@teste.com.br',
                ],
                'transporte' => [
                    'transportadora' => 'Transportadora XYZ',
                    'tipo_frete' => 'R',
                    'servico_correios' => 'SEDEX',
                    'dados_etiqueta' => [
                        'nome' => 'Endereço de entrega',
                        'endereco' => 'Rua Visconde de São Gabriel',
                        'numero' => '392',
                        'complemento' => 'Sala 59',
                        'municipio' => 'Bento Gonçalves',
                        'uf' => 'RS',
                        'cep' => '95.700-000',
                        'bairro' => 'Cidade Alta',
                    ],
                    'volumes' => [
                        'volume' => [
                            [
                                'servico' => 'SEDEX - CONTRATO',
                                'codigoRastreamento' => '',
                            ],
                            [
                                'servico' => 'PAC - CONTRATO',
                                'codigoRastreamento' => '',
                            ],
                        ],
                    ],
                ],
                'itens' => [
                    'item' => [
                        [
                            'codigo' => '001',
                            'descricao' => 'Caneta 001',
                            'un' => 'Pç',
                            'qtde' => '10',
                            'vlr_unit' => '1.68',
                        ],
                        [
                            'codigo' => '002',
                            'descricao' => 'Caderno 002',
                            'un' => 'Un',
                            'qtde' => '3',
                            'vlr_unit' => '3.75',
                        ],
                        [
                            'codigo' => '003',
                            'descricao' => 'Teclado 003',
                            'un' => 'Cx',
                            'qtde' => '7',
                            'vlr_unit' => '18.65',
                        ],
                    ],
                ],
                'parcelas' => [
                    'parcela' => [
                        [
                            'data' => '01/09/2009',
                            'vlr' => '100',
                            'obs' => 'Teste obs 1',
                        ],
                        [
                            'data' => '06/09/2009',
                            'vlr' => '50',
                            'obs' => '',
                        ],
                        [
                            'data' => '11/09/2009',
                            'vlr' => '50',
                            'obs' => 'Teste obs 3',
                        ],
                    ],
                ],
                'vlr_frete' => '15',
                'vlr_desconto' => '10',
                'obs' => 'Testando o campo observações do pedido '.Carbon::now(),
                'obs_internas' => 'Testando o campo observações internas do pedido'
            ],
        ], true);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('pedidos', $response['retorno'] ?? []);
    }

    public function testCanUpdateOrder()
    {
        $response = $this->bling->orders()->update(1, [
            'pedido' => [
                'situacao' => 3
            ]
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('pedidos', $response['retorno'] ?? []);
    }

    public function testCanListOrders()
    {
        $response = $this->bling->orders()->all([
            'dataEmissao' => Carbon::now()->subYear()->format('d/m/Y') .' TO ' . Carbon::now()->format('d/m/Y')
        ], true);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('pedidos', $response['retorno'] ?? []);
    }

    public function testCanFindOrder()
    {
        $response = $this->bling->orders()->find(1, true);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('pedidos', $response['retorno'] ?? []);
    }
}