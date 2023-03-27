<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\MarcaModel;
use App\Models\ProdutoModel;

class Marcas extends BaseController
{
    public function marcas()
    {
        $session = Session();
        $modelMarca = new MarcaModel();
        $marcas = $modelMarca->getMarcas();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'viewMarcas', ['marcas' => $marcas]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'nova_marca');
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelMarca = new MarcaModel();
        $marca = $modelMarca->findMarca($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'nova_marca', ['marca' => $marca]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function excluir()
    {
        $session = Session();
        $id = $_GET['id'];
        $marca = $_GET['desc'];
        $modelMarca = new MarcaModel();
        $modelAcoes = new AcoesModel();
        $modelProduto = new ProdutoModel();

        $produtosMarca = $modelProduto->findProdutoMarca($id);

        if ($produtosMarca) {
            $session->setFlashdata('warning', 'Existem produtos cadastrados com esta marca!');
            return redirect()->to('marcas');
            die;
        } else {
            if (!$modelMarca->excluiMarca($id)) {
                if ($_SESSION['credenciais']["idlogado"] != 1) {
                    $acao = 'Excluiu a marca ' . $marca . '.';
                    $data = array(
                        'idusuario' => $_SESSION['credenciais']["idlogado"],
                        'data_acao' => date("Y-m-d H:i:s"),
                        'acao' => $acao
                    );

                    $modelAcoes->grava_acao($data);
                }
                $session->setFlashdata('success', 'Ação concluída com sucesso.');
                return redirect()->to('marcas');
            } else {
                $session->setFlashdata('error', 'Erro durante a excução da ação.');
                http_response_code(500);
            }
        }
    }

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelMarca = new MarcaModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'descricao ' => $request->getVar('descricao')
        );

        if ($modelMarca->salvaMarca($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou a marca ' . $request->getVar('descricao') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('marcas');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelMarca = new MarcaModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'descricao ' => $request->getVar('descricao'),
            'idmarca' => $request->getVar('id')
        );

        $return = $modelMarca->atualizaMarca($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados da marca ' . $request->getVar('descricao') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('marcas');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
