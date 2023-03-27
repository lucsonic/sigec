<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\FornecedorModel;

class Fornecedores extends BaseController
{
    public function fornecedores()
    {
        $session = Session();
        $modelFornecedor = new FornecedorModel();
        $fornecedores = $modelFornecedor->getFornecedores();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'viewFornecedores', ['fornecedores' => $fornecedores]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_fornecedor');
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelFornecedor = new FornecedorModel();
        $fornecedor = $modelFornecedor->findFornecedor($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_fornecedor', ['fornecedor' => $fornecedor]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function visualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelFornecedor = new FornecedorModel();
        $fornecedor = $modelFornecedor->findFornecedor($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'visualizaFornecedor', ['fornecedor' => $fornecedor]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function reativar()
    {
        $session = Session();
        $modelFornecedor = new FornecedorModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'ativo' => 1,
            'idfornecedor' => $_GET['id']
        );

        $return = $modelFornecedor->atualizaFornecedor($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Reativou o fornecedor ' . $_GET['nome'] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('fornecedores');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function desativar()
    {
        $session = Session();
        $modelFornecedor = new FornecedorModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'ativo' => 0,
            'idfornecedor' => $_GET['id']
        );

        $return = $modelFornecedor->atualizaFornecedor($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Desativou o fornecedor ' . $_GET['nome'] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('fornecedores');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelFornecedor = new FornecedorModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'nomefantasia' => addslashes(mb_strtoupper($request->getVar('nomefantasia'))),
            'cnpj' => limpaMascaras($request->getVar('cnpj')),
            'razaosocial ' => $request->getVar('razaosocial'),
            'nomecontato' => $request->getVar('ncontato'),
            'endereco' => $request->getVar('endereco'),
            'bairro' => $request->getVar('bairro'),
            'cidade' => $request->getVar('cidade'),
            'uf' => $request->getVar('uf'),
            'telefones' => $request->getVar('telefones'),
            'cep' => limpaMascaras($request->getVar('cep')),
            'email' => $request->getVar('email'),
            'site' => $request->getVar('site'),
            'observacao' => $request->getVar('observacao'),
            'ativo' => 1,
            'datacadastro' => date('Y-m-d H:i:s')
        );

        if ($modelFornecedor->salvaFornecedor($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou o fornecedor ' . $request->getVar('nomefantasia') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('fornecedores');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelFornecedor = new FornecedorModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'nomefantasia' => addslashes(mb_strtoupper($request->getVar('nomefantasia'))),
            'cnpj' => limpaMascaras($request->getVar('cnpj')),
            'razaosocial ' => $request->getVar('razaosocial'),
            'nomecontato' => $request->getVar('ncontato'),
            'endereco' => $request->getVar('endereco'),
            'bairro' => $request->getVar('bairro'),
            'cidade' => $request->getVar('cidade'),
            'uf' => $request->getVar('uf'),
            'telefones' => $request->getVar('telefones'),
            'cep' => limpaMascaras($request->getVar('cep')),
            'email' => $request->getVar('email'),
            'site' => $request->getVar('site'),
            'observacao' => $request->getVar('observacao'),
            'ativo' => 1,
            'datacadastro' => date('Y-m-d H:i:s'),
            'idfornecedor' => $request->getVar('id')
        );

        $return = $modelFornecedor->atualizaFornecedor($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados do fornecedor ' . $request->getVar('nomefantasia') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('fornecedores');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
