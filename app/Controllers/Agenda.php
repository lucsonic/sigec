<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\AgendaModel;

class Agenda extends BaseController
{
    public function agenda()
    {
        $session = Session();
        $modelAgenda = new AgendaModel();
        $agendas = $modelAgenda->getAgendas();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'viewAgenda', ['agendas' => $agendas]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'nova_agenda');
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelAgenda = new AgendaModel();
        $agenda = $modelAgenda->findAgenda($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'nova_agenda', ['agenda' => $agenda]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function excluir()
    {
        $session = Session();
        $id = $_GET['id'];
        $agenda = $_GET['desc'];
        $modelAgenda = new AgendaModel();
        $modelAcoes = new AcoesModel();

        if (!$modelAgenda->excluiAgenda($id)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Excluiu o agendamento ' . $agenda . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }
            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('agenda');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelAgenda = new AgendaModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'data_comp ' => salvaData($request->getVar('data_comp')),
            'compromisso ' => $request->getVar('compromisso'),
            'horario ' => $request->getVar('horario'),
            'local ' => $request->getVar('local'),
            'nome_contato ' => $request->getVar('nome_contato'),
            'telefones ' => $request->getVar('telefones')
        );

        if ($modelAgenda->salvaAgenda($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou o agendamento ' . $request->getVar('compromisso') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('agenda');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelAgenda = new AgendaModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'data_comp ' => salvaData($request->getVar('data_comp')),
            'compromisso ' => $request->getVar('compromisso'),
            'horario ' => $request->getVar('horario'),
            'local ' => $request->getVar('local'),
            'nome_contato ' => $request->getVar('nome_contato'),
            'telefones ' => $request->getVar('telefones'),
            'idagenda' => $request->getVar('id')
        );

        $return = $modelAgenda->atualizaAgenda($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados do agendamento ' . $request->getVar('compromisso') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('agenda');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
