<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\FeriadoModel;

class Feriados extends BaseController
{
    public function feriados()
    {
        $session = Session();
        $modelFeriado = new FeriadoModel();
        $feriados = $modelFeriado->getFeriados();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'viewFeriados', ['feriados' => $feriados]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_feriado');
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelFeriado = new FeriadoModel();
        $feriado = $modelFeriado->findFeriado($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_feriado', ['feriado' => $feriado]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function excluir()
    {
        $session = Session();
        $id = $_GET['id'];
        $feriado = $_GET['desc'];
        $modelFeriado = new FeriadoModel();
        $modelAcoes = new AcoesModel();

        if (!$modelFeriado->excluiFeriado($id)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Excluiu o feriado ' . $feriado . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }
            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('feriados');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelFeriado = new FeriadoModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'dia' => $request->getVar('dia'),
            'descricao ' => $request->getVar('descricao'),
            'mes' => $request->getVar('mes'),
            'ano' => $request->getVar('ano')
        );

        if ($modelFeriado->salvaFeriado($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou o feriado ' . $request->getVar('descricao') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('feriados');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelFeriado = new FeriadoModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'dia' => $request->getVar('dia'),
            'descricao ' => $request->getVar('descricao'),
            'mes' => $request->getVar('mes'),
            'ano' => $request->getVar('ano'),
            'idferiado' => $request->getVar('id')
        );

        $return = $modelFeriado->atualizaFeriado($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados do feriado ' . $request->getVar('descricao') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('feriados');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
