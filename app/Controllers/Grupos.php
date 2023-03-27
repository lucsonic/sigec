<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\GrupoModel;
use App\Models\ProdutoModel;

class Grupos extends BaseController
{
    public function grupos()
    {
        $session = Session();
        $modelGrupo = new GrupoModel();
        $grupos = $modelGrupo->getGrupos();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'viewGrupos', ['grupos' => $grupos]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_grupo');
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelGrupo = new GrupoModel();
        $grupo = $modelGrupo->findGrupo($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_grupo', ['grupo' => $grupo]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function excluir()
    {
        $session = Session();
        $id = $_GET['id'];
        $grupo = $_GET['desc'];
        $modelGrupo = new GrupoModel();
        $modelAcoes = new AcoesModel();
        $modelProduto = new ProdutoModel();

        $produtosGrupo = $modelProduto->findProdutoGrupo($id);

        if ($produtosGrupo) {
            $session->setFlashdata('warning', 'Existem produtos cadastrados com este grupo!');
            return redirect()->to('grupos');
            die;
        } else {
            if (!$modelGrupo->excluiGrupo($id)) {
                if ($_SESSION['credenciais']["idlogado"] != 1) {
                    $acao = 'Excluiu o grupo ' . $grupo . '.';
                    $data = array(
                        'idusuario' => $_SESSION['credenciais']["idlogado"],
                        'data_acao' => date("Y-m-d H:i:s"),
                        'acao' => $acao
                    );

                    $modelAcoes->grava_acao($data);
                }
                $session->setFlashdata('success', 'Ação concluída com sucesso.');
                return redirect()->to('grupos');
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
        $modelGrupo = new GrupoModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'descricao ' => $request->getVar('descricao')
        );

        if ($modelGrupo->salvaGrupo($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou o gupo ' . $request->getVar('descricao') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('grupos');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelGrupo = new GrupoModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'descricao ' => $request->getVar('descricao'),
            'idgrupo' => $request->getVar('id')
        );

        $return = $modelGrupo->atualizaGrupo($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados do grupo ' . $request->getVar('descricao') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('grupos');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
