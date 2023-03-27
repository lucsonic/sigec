<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\ReceitaModel;

class Receitas extends BaseController
{
    public function receitas()
    {
        $session = Session();
        $modelReceita = new ReceitaModel();

        $receitas = $modelReceita->getReceitas();
        $tipos = $modelReceita->getTiposReceita();

        if ($session->get('user')) {
            return $this->template->render(
                'templates/template_padrao',
                'viewReceitas',
                ['receitas' => $receitas, 'tipos' => $tipos]
            );
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();
        $modelReceita = new ReceitaModel();
        $tipos = $modelReceita->getTiposReceita();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'nova_receita', ['tipos' => $tipos]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelReceita = new ReceitaModel();
        $receita = $modelReceita->findReceita($id);
        $tipos = $modelReceita->getTiposReceita();

        if ($session->get('user')) {
            return $this->template->render(
                'templates/template_padrao',
                'nova_receita',
                ['receita' => $receita, 'tipos' => $tipos]
            );
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function novo_tiporec()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelReceita = new ReceitaModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'desctiporeceita' => $request->getVar('desctiporeceita')
        );

        if ($modelReceita->salvaTipoRec($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou o tipo de receita ' . $request->getVar('desctiporeceita') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            echo '<script>history.go(-1);</script>';
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function excluir()
    {
        $session = Session();
        $id = $_GET['id'];
        $receita = $_GET['desc'];
        $modelReceita = new ReceitaModel();
        $modelAcoes = new AcoesModel();

        if (!$modelReceita->excluiReceita($id)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Excluiu a receita ' . $receita . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }
            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('receitas');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelReceita = new ReceitaModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'descricao_rec' => addslashes(mb_strtoupper($request->getVar('descricao_rec'))),
            'idtipo' => $request->getVar('tipo'),
            'data_rec ' => salvaData($request->getVar('data_rec')),
            'valor_rec' => salvaVlr($request->getVar('valor_rec'))
        );

        if ($modelReceita->salvaReceita($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou a receita ' . addslashes(mb_strtoupper($request->getVar('descricao_rec'))) . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('receitas');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelReceita = new ReceitaModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'descricao_rec' => addslashes(mb_strtoupper($request->getVar('descricao_rec'))),
            'idtipo' => $request->getVar('tipo'),
            'data_rec ' => salvaData($request->getVar('data_rec')),
            'valor_rec' => salvaVlr($request->getVar('valor_rec')),
            'idreceita' => $request->getVar('id')
        );

        $return = $modelReceita->atualizaReceita($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados da receita ' . addslashes(mb_strtoupper($request->getVar('descricao_rec'))) . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('receitas');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
