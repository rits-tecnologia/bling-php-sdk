<?php

namespace Bling\Tests\Feature;

use Bling\Tests\TestCase;
use Carbon\Carbon;

class ProductTest extends TestCase
{
    public function testCanCreateUpdateAndDeleteProduct()
    {
        $code = '123456-' . Carbon::now()->format('YmdHis');

        $response = $this->bling->products()->create([
            'produto' => [
                'codigo' => $code,
                'descricao' => 'Caneta 001',
                'situacao' => 'Ativo',
                'descricaoCurta' => 'Descrição curta da caneta',
                'descricaoComplementar' => 'Descrição complementar da caneta',
                'un' => 'Pc',
                'vlr_unit' => '1.68',
                'preco_custo' => '1.23',
                'peso_bruto' => '0.2',
                'peso_liq' => '0.18',
                'class_fiscal' => '1000.01.01',
                'marca' => 'Marca da Caneta',
                'origem' => '0',
                'estoque' => '10',
                /*
                'deposito' => [
                    'id' => '123456',
                    'estoque' => '200',
                ],*/
                'gtin' => '223435780',
                'gtinEmbalagem' => '54546',
                'largura' => '11',
                'altura' => '21',
                'profundidade' => '31',
                'estoqueMinimo' => '1.00',
                'estoqueMaximo' => '100.00',
                'cest' => '28.040.00',
                'idGrupoProduto' => '12345',
                'condicao' => 'Novo',
                'freteGratis' => 'N',
                'linkExterno' => 'https://minhaloja.com.br/meu-produto',
                'observacoes' => 'Observações do meu produtos',
                'producao' => 'P',
                'dataValidade' => '20/11/2019',
                'descricaoFornecedor' => 'Descrição do fornecedor',
                'idFabricante' => '0',
                'codigoFabricante' => '123',
                'unidadeMedida' => 'Centímetros',
                'garantia' => '4',
                'itensPorCaixa' => '2',
                'volumes' => '2',
                'urlVideo' => 'https://www.youtube.com/watch?v=zKKL-SgC5lY',
                'imagens' => [
                    'url' => 'https://bling.com.br/bling.jpg',
                ],
                /*
                'camposCustomizados' => [
                    'memoriaRam' => '16',
                    'eDualSim' => 'false',
                ],*/
                //'idCategoria' => '1234',
            ],
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('produtos', $response['retorno'] ?? []);

        $response = $this->bling->products()->update($code, [
            'produto' => [
                'codigo' => $code,
                'descricao' => 'Caneta 001 - Azul',
                'situacao' => 'Ativo',
                'descricaoCurta' => 'Descrição curta da caneta',
                'descricaoComplementar' => 'Descrição complementar da caneta',
                'un' => 'Pc',
                'vlr_unit' => '1.68',
                'preco_custo' => '1.23',
                'peso_bruto' => '0.2',
                'peso_liq' => '0.18',
                'class_fiscal' => '1000.01.01',
                'marca' => 'Marca da Caneta',
                'origem' => '0',
                'estoque' => '10',
                /*
                'deposito' => [
                    'id' => '123456',
                    'estoque' => '200',
                ],*/
                'gtin' => '223435780',
                'gtinEmbalagem' => '54546',
                'largura' => '11',
                'altura' => '21',
                'profundidade' => '31',
                'estoqueMinimo' => '1.00',
                'estoqueMaximo' => '100.00',
                'cest' => '28.040.00',
                'idGrupoProduto' => '12345',
                'condicao' => 'Novo',
                'freteGratis' => 'N',
                'linkExterno' => 'https://minhaloja.com.br/meu-produto',
                'observacoes' => 'Observações do meu produtos',
                'producao' => 'P',
                'dataValidade' => '20/11/2019',
                'descricaoFornecedor' => 'Descrição do fornecedor',
                'idFabricante' => '0',
                'codigoFabricante' => '123',
                'unidadeMedida' => 'Centímetros',
                'garantia' => '4',
                'itensPorCaixa' => '2',
                'volumes' => '2',
                'urlVideo' => 'https://www.youtube.com/watch?v=zKKL-SgC5lY',
                'imagens' => [
                    'url' => 'https://bling.com.br/bling.jpg',
                ],
                /*
                'camposCustomizados' => [
                    'memoriaRam' => '16',
                    'eDualSim' => 'false',
                ],*/
                //'idCategoria' => '1234',
            ],
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('produtos', $response['retorno'] ?? []);

        $response = $this->bling->products()->delete($code);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('produtos', $response['retorno'] ?? []);
    }

    public function testCanListProducts()
    {
        $response = $this->bling->products()
            ->all([
                'dataInclusao' => Carbon::now()
                        ->subYear()
                        ->format('d/m/Y').' TO '.Carbon::now()
                        ->format('d/m/Y'),
            ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('produtos', $response['retorno'] ?? []);
    }

    public function testCanFindProduct()
    {
        $response = $this->bling->products()->find('001');

        $this->assertIsArray($response);
        $this->assertArrayHasKey('retorno', $response);
        $this->assertArrayHasKey('produtos', $response['retorno'] ?? []);
    }
}