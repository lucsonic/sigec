<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\FuncionarioModel;
use App\Models\FuncoesModel;

class Funcoes extends BaseController
{
    public function funcoes()
    {
        $session = Session();
        $modelFuncao = new FuncoesModel();
        $funcoes = $modelFuncao->getFuncoes();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'viewFuncoes', ['funcoes' => $funcoes]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'nova_funcao');
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelFuncao = new FuncoesModel();
        $funcao = $modelFuncao->findFuncao($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'nova_funcao', ['funcao' => $funcao]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function excluir()
    {
        $session = Session();
        $id = $_GET['id'];
        $funcao = $_GET['desc'];
        $modelFuncao = new FuncoesModel();
        $modelAcoes = new AcoesModel();
        $modelFuncionario = new FuncionarioModel();

        $funcionariosFuncao = $modelFuncionario->findFuncionarioFuncao($id);

        if ($funcionariosFuncao) {
            $session->setFlashdata('warning', 'Existem funcionários cadastrados com esta função!');
            return redirect()->to('funcoes');
            die;
        } else {;
            if (!$modelFuncao->excluiFuncao($id)) {
                if ($_SESSION['credenciais']["idlogado"] != 1) {
                    $acao = 'Excluiu a função ' . $funcao . '.';
                    $data = array(
                        'idusuario' => $_SESSION['credenciais']["idlogado"],
                        'data_acao' => date("Y-m-d H:i:s"),
                        'acao' => $acao
                    );

                    $modelAcoes->grava_acao($data);
                }
                $session->setFlashdata('success', 'Ação concluída com sucesso.');
                return redirect()->to('funcoes');
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
        $modelFuncao = new FuncoesModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'nomefuncao ' => $request->getVar('nomefuncao')
        );

        if ($modelFuncao->salvaFuncao($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou a função ' . $request->getVar('nomefuncao') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('funcoes');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelFuncao = new FuncoesModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'nomefuncao ' => $request->getVar('nomefuncao'),
            'idfuncao' => $request->getVar('id')
        );

        $return = $modelFuncao->atualizaFuncao($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados da função ' . $request->getVar('nomefuncao') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('funcoes');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
