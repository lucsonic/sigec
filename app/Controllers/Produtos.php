<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\FornecedorModel;
use App\Models\GrupoModel;
use App\Models\MarcaModel;
use App\Models\ProdutoModel;

class Produtos extends BaseController
{
    public function produtos()
    {
        $session = Session();
        $modelProduto = new ProdutoModel();
        $modelMarca = new MarcaModel();
        $modelGrupo = new GrupoModel();
        $modelFornecedor = new FornecedorModel();

        $produtos = $modelProduto->getProdutos();
        $marcas = $modelMarca->getMarcas();
        $grupos = $modelGrupo->getGrupos();
        $fornecedores = $modelFornecedor->getFornecedores();

        if ($session->get('user')) {
            return $this->template->render(
                'templates/template_padrao',
                'viewProdutos',
                ['produtos' => $produtos, 'marcas' => $marcas, 'grupos' => $grupos, 'fornecedores' => $fornecedores]
            );
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();
        $modelMarca = new MarcaModel();
        $modelGrupo = new GrupoModel();
        $modelFornecedor = new FornecedorModel();

        $marcas = $modelMarca->getMarcas();
        $grupos = $modelGrupo->getGrupos();
        $fornecedores = $modelFornecedor->getFornecedores();

        if ($session->get('user')) {
            return $this->template->render(
                'templates/template_padrao',
                'novo_produto',
                ['marcas' => $marcas, 'grupos' => $grupos, 'fornecedores' => $fornecedores]
            );
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelProduto = new ProdutoModel();
        $modelMarca = new MarcaModel();
        $modelGrupo = new GrupoModel();
        $modelFornecedor = new FornecedorModel();

        $produto = $modelProduto->findProduto($id);
        $marcas = $modelMarca->getMarcas();
        $grupos = $modelGrupo->getGrupos();
        $fornecedores = $modelFornecedor->getFornecedores();

        if ($session->get('user')) {
            return $this->template->render(
                'templates/template_padrao',
                'novo_produto',
                ['produto' => $produto, 'marcas' => $marcas, 'grupos' => $grupos, 'fornecedores' => $fornecedores]
            );
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function visualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelProduto = new ProdutoModel();
        $produto = $modelProduto->findProduto($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'visualizaProduto', ['produto' => $produto]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function reativar()
    {
        $session = Session();
        $modelProduto = new ProdutoModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'ativo' => 1,
            'idproduto' => $_GET['id']
        );

        $return = $modelProduto->atualizaProduto($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Reativou o produto ' . $_GET['nome'] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('produtos');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function desativar()
    {
        $session = Session();
        $modelProduto = new ProdutoModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'ativo' => 0,
            'idproduto' => $_GET['id']
        );

        $return = $modelProduto->atualizaProduto($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Desativou o produto ' . $_GET['nome'] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('produtos');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelProduto = new ProdutoModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'dsc_produto' => addslashes(mb_strtoupper($request->getVar('descricao'))),
            'idgrupo' => $request->getVar('grupo'),
            'idmarca ' => $request->getVar('marca'),
            'modelo' => $request->getVar('modelo'),
            'qtd_atual' => $request->getVar('qtd_atual'),
            'qtd_minima' => $request->getVar('qtd_minima'),
            'qtd_critica' => $request->getVar('qtd_critica'),
            'idfornecedor' => $request->getVar('fornecedor'),
            'vlr_compra' => salvaVlr($request->getVar('vlr_compra')),
            'vlr_venda' => salvaVlr($request->getVar('vlr_venda')),
            'cbarras' => $request->getVar('cbarras'),
            'ativo' => 1
        );

        if ($modelProduto->salvaProduto($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou o produto ' . addslashes(mb_strtoupper($request->getVar('descricao'))) . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('produtos');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelProduto = new ProdutoModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'dsc_produto' => addslashes(mb_strtoupper($request->getVar('descricao'))),
            'idgrupo' => $request->getVar('grupo'),
            'idmarca ' => $request->getVar('marca'),
            'modelo' => $request->getVar('modelo'),
            'qtd_atual' => $request->getVar('qtd_atual'),
            'qtd_minima' => $request->getVar('qtd_minima'),
            'qtd_critica' => $request->getVar('qtd_critica'),
            'idfornecedor' => $request->getVar('fornecedor'),
            'vlr_compra' => salvaVlr($request->getVar('vlr_compra')),
            'vlr_venda' => salvaVlr($request->getVar('vlr_venda')),
            'cbarras' => $request->getVar('cbarras'),
            'ativo' => 1,
            'idproduto' => $request->getVar('id')
        );

        $return = $modelProduto->atualizaProduto($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados do produto ' . addslashes(mb_strtoupper($request->getVar('descricao'))) . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('produtos');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
