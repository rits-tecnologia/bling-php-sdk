<?php

namespace Bling\Tests\Feature;

use Bling\Tests\TestCase;
use Carbon\Carbon;

class NFeTest extends TestCase
{
    public function testCanCreateNFe()
    {
        $response = $this->bling->nfes()->create([
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
                    'cpf_cnpj' => '11122233345',
                    'ie_rg' => '1122334455',
                    'endereco' => 'Rua Silvio Orlandini, 435',
                    'cidade' => 'Roca Sales',
                    'uf' => 'RS',
                    'placa' => 'ILM-1020',
                    'uf_veiculo' => 'RS',
                    'tipo_frete' => 'R',
                    'qtde_volumes' => '10',
                    'especie' => 'Volumes',
                    'numero' => '425',
                    'peso_bruto' => '157',
                    'peso_liquido' => '142',
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
                            'tipo' => 'P',
                            'peso_bruto' => '0.2',
                            'peso_liq' => '0.18',
                            'class_fiscal' => '1000.00.10',
                            'origem' => '0',
                        ],
                        [
                            'codigo' => '002',
                            'descricao' => 'Caderno 002',
                            'un' => 'Un',
                            'qtde' => '3',
                            'vlr_unit' => '3.75',
                            'tipo' => 'P',
                            'peso_bruto' => '0.75',
                            'peso_liq' => '0.7',
                            'class_fiscal' => '1000.00.10',
                            'origem' => '0',
                        ],
                        [
                            'codigo' => '003',
                            'descricao' => 'Teclado 003',
                            'un' => 'Cx',
                            'qtde' => '7',
                            'vlr_unit' => '18.65',
                            'tipo' => 'P',
                            'peso_bruto' => '0.65',
                            'peso_liq' => '0.52',
                            'class_fiscal' => '1000.00.10',
                            'origem' => '0',
                        ],
                    ],
                ],
                'parcelas' => [
                    'parcela' => [
                        [
                            'dias' => '10',
                            'data' => '01/09/2009',
                            'vlr' => '100',
                            'obs' => 'Teste obs 1',
                        ],
                        [
                            'dias' => '15',
                            'data' => '06/09/2009',
                            'vlr' => '50',
                            'obs' => '',
                        ],
                        [
                            'dias' => '20',
                            'data' => '11/09/2009',
                            'vlr' => '50',
                            'obs' => 'Teste obs 3',
                        ],
                    ],
                ],
                'nf_produtor_rural_referenciada' => [
                    'numero' => '001020',
                    'serie' => '0',
                    'ano_mes_emissao' => '1202',
                ],
                'vlr_frete' => '15',
                'vlr_seguro' => '7',
                'vlr_despesas' => '2.5',
                'vlr_desconto' => '10',
                'obs' => 'Testando o campo observações do pedido ' . Carbon::now(),
            ],
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('notasfiscais', $response['retorno'] ?? []);
    }

    public function testCanListNFes()
    {
        $response = $this->bling->nfes()->all([
            'dataEmissao' => Carbon::now()->subYear()->format('d/m/Y H:i:s') .' TO ' . Carbon::now()->format('d/m/Y H:i:s')
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('notasfiscais', $response['retorno'] ?? []);
    }

    public function testCanFindNFe()
    {
        $response = $this->bling->nfes()->find(1, 1);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('notasfiscais', $response['retorno'] ?? []);
    }

    public function testCanSendNFe()
    {
        $response = $this->bling->nfes()->send(1, 1);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
    }
}