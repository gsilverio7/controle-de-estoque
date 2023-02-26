<?php

namespace App\Services;

use App\Repositories\RequisicaoRepository;
use App\Repositories\MovimentacaoRepository;
use Illuminate\Http\Request;

class RequisicaoService
{
    public function __construct(RequisicaoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function apagar($id)
    {
        return $this->repository->apagar($id);
    }

    public function atualizar(int $id, array $dados)
    {
        try {
            \DB::beginTransaction();

            $movimentacaoRepository = app(MovimentacaoRepository::class);

            foreach ($dados['id_movimentacao'] as $key => $idMovimentacao) {
                if (isset($dados['tipo_produto'][$key])) {
                    //atualizando componentes
                    if (! $movimentacaoRepository->atualizar($idMovimentacao, [
                        'id_produto_composto' => $dados['tipo_produto'][$key] == 'c' ? $dados['id_produto'][$key] : null,
                        'id_produto_simples' => $dados['tipo_produto'][$key] == 's' ? $dados['id_produto'][$key] : null,
                        'quantidade' => $dados['quantidade'][$key],
                    ])) {
                        throw new \Exception('erro ao atualizar componente');
                    }
                } else {
                    //excluindo componentes
                    if (! $movimentacaoRepository->apagar($idMovimentacao)) {
                        throw new \Exception('erro ao apagar componente');
                    }
                }
            }

            //criando componentes
            foreach ($dados['tipo_produto'] as $key => $tipoProduto) {
                if ($key >= count($dados['id_movimentacao'])) {

                    if (! $movimentacaoRepository->criar([
                        'id_produto_composto' => $tipoProduto == 'c' ? $dados['id_produto'][$key] : null,
                        'id_produto_simples' => $tipoProduto == 's' ? $dados['id_produto'][$key] : null,
                        'id_requisicao' => $id,
                        'quantidade' => $dados['quantidade'][$key],
                    ])) {
                        throw new \Exception('erro ao criar componente');
                    }
                }
            }
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }

    public function buscar(int $id)
    {
        return $this->repository->buscar($id, ['movimentacoes.produtoSimples', 'movimentacoes.produtoComposto', 'usuario']);
    }

    public function criar(array $dados)
    {
        try {
            \DB::beginTransaction();
            $id = $this->repository->criarRetornaId($dados);
            if ($id != 0) {
                $movimentacaoRepository = app(MovimentacaoRepository::class);
                foreach ($dados['id_produto'] as $key => $componente) {
                    if(! $movimentacaoRepository->criar([
                        'id_requisicao' => $id,
                        'id_produto_composto' => $dados['tipo_produto'][$key] == 'c' ? $componente : null,
                        'id_produto_simples' => $dados['tipo_produto'][$key] == 's' ? $componente : null,
                        'quantidade' => $dados['quantidade'][$key]
                    ])) {
                        throw new \Exception('erro ao criar movimentacao');
                    };
                }
            } else {
                throw new \Exception('erro ao criar requisicao');
            }
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }

    public function grid(Request $request)
    {
        return $this->repository->grid(['usuario']);
    }

    public function select2(Request $request)
    {
        return $this->repository->select2($request->all());
    }
}
