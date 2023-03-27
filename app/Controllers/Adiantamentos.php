<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\AdiantamentoModel;
use App\Models\FuncionarioModel;

class Adiantamentos extends BaseController
{
    public function adiantamentos()
    {
        $session = Session();
        $modelAdiantamento = new AdiantamentoModel();
        $modelFuncionario = new FuncionarioModel();
        $adiantamentos = $modelAdiantamento->getAdiantamentos();
        $funcionarios = $modelFuncionario->getFuncionarios();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'viewAdiantamentos', ['adiantamentos' => $adiantamentos, 'funcionarios' => $funcionarios]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();
        $modelFuncionario = new FuncionarioModel();
        $funcionarios = $modelFuncionario->getFuncionarios();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_adiantamento', ['funcionarios' => $funcionarios]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelAdiantamento = new AdiantamentoModel();
        $modelFuncionario = new FuncionarioModel();
        $adiantamento = $modelAdiantamento->findAdiantamento($id);
        $funcionarios = $modelFuncionario->getFuncionarios();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_adiantamento', ['adiantamento' => $adiantamento, 'funcionarios' => $funcionarios]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function excluir()
    {
        $session = Session();
        $id = $_GET['id'];
        $func = $_GET['func'];
        $modelAdiantamento = new AdiantamentoModel();
        $modelAcoes = new AcoesModel();

        if (!$modelAdiantamento->excluiAdiantamento($id)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Excluiu um adiantamento do funcionário ' . $func . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }
            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('adiantamentos');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelAdiantamento = new AdiantamentoModel();
        $modelAcoes = new AcoesModel();
        $dadosFunc = explode(';', $request->getVar('funcionario'));

        if ($request->getVar('parcelas') == 1) {
            $data = array(
                'idfuncionario ' => $dadosFunc[0],
                'data_adt ' => salvaData($request->getVar('data_adt')),
                'nparcela ' => 1,
                'situacao ' => 'Em aberto',
                'data_pag ' => salvaData($request->getVar('data_pag')),
                'parcelas ' => $request->getVar('parcelas'),
                'valor' => salvaVlr($request->getVar('valor'))
            );

            if ($modelAdiantamento->salvaAdiantamento($data)) {
                if ($_SESSION['credenciais']["idlogado"] != 1) {
                    $acao = 'Salvou um adiantamento para o funcionario ' . $dadosFunc[1] . ' no valor de ' . salvaVlr($request->getVar('valor'));
                    $data = array(
                        'idusuario' => $_SESSION['credenciais']["idlogado"],
                        'data_acao' => date("Y-m-d H:i:s"),
                        'acao' => $acao
                    );

                    $modelAcoes->grava_acao($data);
                }

                $session->setFlashdata('success', 'Ação concluída com sucesso.');
                return redirect()->to('adiantamentos');
            } else {
                $session->setFlashdata('error', 'Erro durante a excução da ação.');
                http_response_code(500);
            }
        } else {
            $parcelas = $request->getVar('parcelas');
            for ($i = 1; $i <= $parcelas; $i++) {
                $dtpag = date('d/m/Y', strtotime('+' . addDias($i) . ' days', strtotime(salvaData($request->getVar('data_pag')))));
                $data = array(
                    'idfuncionario ' => $dadosFunc[0],
                    'data_adt ' => salvaData($request->getVar('data_adt')),
                    'nparcela ' => $i,
                    'situacao ' => 'Em aberto',
                    'data_pag ' => salvaData($dtpag),
                    'parcelas ' => $request->getVar('parcelas'),
                    'valor' => salvaVlr($request->getVar('valor')) / $parcelas
                );
                $modelAdiantamento->salvaAdiantamento($data);

                if ($_SESSION['credenciais']["idlogado"] != 1) {
                    $acao = 'Salvou um adiantamento para o funcionario ' . $dadosFunc[1] . '. Parcela nº ' . $i . ', no valor de ' . salvaVlr($request->getVar('valor')) / $parcelas;
                    $data = array(
                        'idusuario' => $_SESSION['credenciais']["idlogado"],
                        'data_acao' => date("Y-m-d H:i:s"),
                        'acao' => $acao
                    );

                    $modelAcoes->grava_acao($data);
                }
            }
            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('adiantamentos');
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelAdiantamento = new AdiantamentoModel();
        $modelAcoes = new AcoesModel();
        $dadosFunc = explode(';', $request->getVar('funcionario'));

        $data = array(
            'idfuncionario ' => $dadosFunc[0],
            'data_adt ' => salvaData($request->getVar('data_adt')),
            'nparcela ' => $request->getVar('nparcela'),
            'situacao ' => $request->getVar('situacao'),
            'data_pag ' => salvaData($request->getVar('data_pag')),
            'parcelas ' => $request->getVar('parcelas'),
            'valor' => salvaVlr($request->getVar('valor')),
            'idadiantamento' => $request->getVar('id')
        );

        $return = $modelAdiantamento->atualizaAdiantamento($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados do adiantamento do funcionário ' . $dadosFunc[1] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('adiantamentos');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
