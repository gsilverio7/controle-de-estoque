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
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@mail.com',
            'password' => Hash::make('147258'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('produtos_simples')->insert([
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
        ]);

        DB::table('produtos_compostos')->insert([
            'nome' => 'Cesta Básica',
            'preco_venda' => 64.90,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('produtos_compostos_componentes')->insert([
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
        ]);

        DB::table('requisicoes')->insert([
            'id_user' => 1,
            'tipo' => 'c',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('movimentacoes')->insert([
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
        ]);
    }
}
