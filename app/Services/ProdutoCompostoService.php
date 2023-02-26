<?php

namespace App\Services;

use App\Repositories\ProdutoCompostoRepository;
use App\Repositories\ProdutoCompostoComponenteRepository;
use Illuminate\Http\Request;

class ProdutoCompostoService
{
    public function __construct(ProdutoCompostoRepository $repository)
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

            $dados['preco_venda'] = $this->formataPreco($dados['preco_venda']);
            if (! $this->repository->atualizar($id, $dados)) {
                throw new \Exception('erro ao atualizar produto composto');
            }

            $componenteRepository = app(ProdutoCompostoComponenteRepository::class);

            foreach ($dados['id_componente'] as $key => $idComponente) {
                if (isset($dados['id_produto_simples'][$key])) {
                    //atualizando componentes
                    if (! $componenteRepository->atualizar($idComponente, [
                        'id_produto_composto' => $id,
                        'id_produto_simples' => $dados['id_produto_simples'][$key],
                        'quantidade' => $dados['quantidade'][$key],
                    ])) {
                        throw new \Exception('erro ao atualizar componente');
                    }
                } else {
                    //excluindo componentes
                    if (! $componenteRepository->apagar($idComponente)) {
                        throw new \Exception('erro ao apagar componente');
                    }
                }

            }

            //criando componentes
            foreach ($dados['id_produto_simples'] as $key => $idProdutoSimples) {
                if ($key >= count($dados['id_componente'])) {
                    if (! $componenteRepository->criar([
                        'id_produto_composto' => $id,
                        'id_produto_simples' => $dados['id_produto_simples'][$key],
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
        return $this->repository->buscar($id, ['componentes.produtoSimples']);
    }

    public function criar(array $dados)
    {
        try {
            \DB::beginTransaction();
            $dados['preco_venda'] = $this->formataPreco($dados['preco_venda']);
            $id = $this->repository->criarRetornaId($dados);
            if ($id != 0) {
                $componenteRepository = app(ProdutoCompostoComponenteRepository::class);
                foreach ($dados['id_produto_simples'] as $key => $componente) {
                    if(! $componenteRepository->criar([
                        'id_produto_composto' => $id,
                        'id_produto_simples' => $componente,
                        'quantidade' => $dados['quantidade'][$key]
                    ])) {
                        throw new \Exception('erro ao criar componente');
                    };
                }
            } else {
                throw new \Exception('erro ao criar produto composto');
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
        return $this->repository->grid();
    }

    public function select2(Request $request)
    {
        return $this->repository->select2($request->all());
    }

    private function formataPreco($preco)
    {
        $preco = str_replace('.', '', $preco);
        return str_replace(',', '.', $preco);
    }
}
