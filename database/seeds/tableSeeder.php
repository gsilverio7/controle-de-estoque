<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class tableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::updateOrCreate([
            'name' => 'Administrador',
            'email' => 'admin@mail.com'
        ], [
            'name' => 'Administrador',
            'email' => 'admin@mail.com',
            'password' => Hash::make('147258'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $produtosSimples = [
            [
                'nome' => 'Arroz',
                'preco_custo' => 15.00,
                'preco_venda' => 20.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nome' => 'Feijão',
                'preco_custo' => 5.00,
                'preco_venda' => 8.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nome' => 'Café',
                'preco_custo' => 12.00,
                'preco_venda' => 16.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        foreach ($produtosSimples as $produtoSimples) {
            \App\Models\ProdutoSimples::updateOrCreate([
                'nome' => $produtoSimples['nome'],
            ], [
                'nome' => $produtoSimples['nome'],
                'preco_custo' => $produtoSimples['preco_custo'],
                'preco_venda' => $produtoSimples['preco_venda'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        \App\Models\ProdutoComposto::updateOrCreate([
            'nome' => 'Cesta Básica',
        ], [
            'nome' => 'Cesta Básica',
            'preco_venda' => 64.90,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $produtoCompostoComponentes = [
            [
                'id_produto_composto' => 1,
                'id_produto_simples' => 1,
                'quantidade' => 1
            ],
            [
                'id_produto_composto' => 1,
                'id_produto_simples' => 2,
                'quantidade' => 2
            ],
            [
                'id_produto_composto' => 1,
                'id_produto_simples' => 3,
                'quantidade' => 2
            ]
        ];

        foreach ($produtoCompostoComponentes as $produtoCompostoComponente) {
            \App\Models\ProdutoCompostoComponente::updateOrCreate([
                'id_produto_composto' => $produtoCompostoComponente['id_produto_composto'],
                'id_produto_simples' => $produtoCompostoComponente['id_produto_simples'],
            ], [
                'id_produto_composto' => $produtoCompostoComponente['id_produto_composto'],
                'id_produto_simples' => $produtoCompostoComponente['id_produto_simples'],
                'quantidade' => $produtoCompostoComponente['quantidade']
            ]);
        }

        \App\Models\Requisicao::updateOrCreate([
            'id' => 1,
        ], [
            'id' => 1,
            'id_user' => 1,
            'tipo' => 'c',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $movimentacoes = [
            [
                'id_produto_simples' => 1,
                'id_requisicao' => 1,
                'quantidade' => 10
            ],
            [
                'id_produto_simples' => 2,
                'id_requisicao' => 1,
                'quantidade' => 10
            ],            
            [
                'id_produto_simples' => 3,
                'id_requisicao' => 1,
                'quantidade' => 10
            ]
        ];

        foreach ($movimentacoes as $movimentacao) {
            \App\Models\Movimentacao::updateOrCreate([
                'id_produto_simples' => $movimentacao['id_produto_simples'],
                'id_requisicao' => $movimentacao['id_requisicao'],
            ], [
                'id_produto_simples' => $movimentacao['id_produto_simples'],
                'id_requisicao' => $movimentacao['id_requisicao'],
                'quantidade' => $movimentacao['quantidade']
            ]);
        }
    }
}
