<?php

namespace Bling\Tests\Feature;

use Bling\Tests\TestCase;
use Carbon\Carbon;

class NFSeTest extends TestCase
{
    public function testCanCreateNFSe()
    {
        $response = $this->bling->nfses()->create([
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
                'servicos' => [
                    'servico' => [
                        [
                            'codigo' => '1.03.01',
                            'descricao' => 'Desenvolvimento de site',
                            'valor' => '1678,14'
                        ]
                    ]
                ],
                'parcelas' => [
                    'parcela' => [
                        [
                            'dias' => '30',
                            'vlr' => '1678,14',
                            'obs' => 'Parcela 1',
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('notasservico', $response['retorno'] ?? []);
    }

    public function testCanListNFSes()
    {
        $response = $this->bling->nfses()->all([
            'dataEmissao' => Carbon::now()->subYear()->format('d/m/Y H:i:s') .' TO ' . Carbon::now()->format('d/m/Y H:i:s')
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('notasservico', $response['retorno'] ?? []);
    }

    public function testCanFindNFSes()
    {
        $response = $this->bling->nfses()->find(1);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('notasservico', $response['retorno'] ?? []);
    }

    public function testCanSendNFSes()
    {
        $response = $this->bling->nfses()->send(1, 1);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
    }
}