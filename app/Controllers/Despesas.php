<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\DespesaModel;

class Despesas extends BaseController
{
    public function despesas()
    {
        $session = Session();
        $modelDespesa = new DespesaModel();

        $despesas = $modelDespesa->getDespesas();
        $tipos = $modelDespesa->getTiposDespesa();

        if ($session->get('user')) {
            return $this->template->render(
                'templates/template_padrao',
                'viewDespesas',
                ['despesas' => $despesas, 'tipos' => $tipos]
            );
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();
        $modelDespesa = new DespesaModel();
        $tipos = $modelDespesa->getTiposDespesa();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'nova_despesa', ['tipos' => $tipos]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelDespesa = new DespesaModel();
        $despesa = $modelDespesa->findDespesa($id);
        $tipos = $modelDespesa->getTiposDespesa();

        if ($session->get('user')) {
            return $this->template->render(
                'templates/template_padrao',
                'nova_despesa',
                ['despesa' => $despesa, 'tipos' => $tipos]
            );
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function novo_tipodesp()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelDespesa = new DespesaModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'desctipodespesa' => $request->getVar('desctipodespesa')
        );

        if ($modelDespesa->salvaTipoDesp($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou o tipo de despesa ' . $request->getVar('desctipodespesa') . '.';
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
        $despesa = $_GET['desc'];
        $modelDespesa = new DespesaModel();
        $modelAcoes = new AcoesModel();

        if (!$modelDespesa->excluiDespesa($id)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Excluiu a despesa ' . $despesa . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }
            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('despesas');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelDespesa = new DespesaModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'descricao_desp' => addslashes(mb_strtoupper($request->getVar('descricao_desp'))),
            'idtipo' => $request->getVar('tipo'),
            'data_desp ' => salvaData($request->getVar('data_desp')),
            'valor_desp' => salvaVlr($request->getVar('valor_desp'))
        );

        if ($modelDespesa->salvaDespesa($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou a despesa ' . addslashes(mb_strtoupper($request->getVar('descricao_desp'))) . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('despesas');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelDespesa = new DespesaModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'descricao_desp' => addslashes(mb_strtoupper($request->getVar('descricao_desp'))),
            'idtipo' => $request->getVar('tipo'),
            'data_desp ' => salvaData($request->getVar('data_desp')),
            'valor_desp' => salvaVlr($request->getVar('valor_desp')),
            'iddespesa' => $request->getVar('id')
        );

        $return = $modelDespesa->atualizaDespesa($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados da despesa ' . addslashes(mb_strtoupper($request->getVar('descricao_desp'))) . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('despesas');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
