<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\UsuarioModel;
use Bcrypt;

class Usuarios extends BaseController
{
    public function usuarios()
    {
        $session = Session();
        $modelUsuario = new UsuarioModel();
        $data = $modelUsuario->getUsuarios();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'viewUsuarios', ['usuarios' => $data]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_usuario');
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelUsuario = new UsuarioModel();
        $usuario = $modelUsuario->findUsuario($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_usuario', ['usuario' => $usuario]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelUsuario = new UsuarioModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'nome' => $request->getVar('nome'),
            'email' => $request->getVar('email'),
            'usuario ' => $request->getVar('usuario'),
            'status' => $request->getVar('status'),
            'id' => $request->getVar('id')
        );

        $return = $modelUsuario->atualizaUsuario($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados do usuário ' . $request->getVar('nome') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('usuarios');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function listarPermissoes()
    {
        $modelUsuario = new UsuarioModel();

        $id = $_GET['id'];

        $permissoes = $modelUsuario->permissoesUsuario($id);
        return $this->template->render('templates/template_padrao', 'permissoes', ['permissoes' => $permissoes]);
    }

    public function salvarPermissoes()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelUsuario = new UsuarioModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'usuarios' => $request->getVar('usuarios') ? 1 : 0,
            'clientes' => $request->getVar('clientes') ? 1 : 0,
            'funcionarios' => $request->getVar('funcionarios') ? 1 : 0,
            'fornecedores' => $request->getVar('fornecedores') ? 1 : 0,
            'balancetes' => $request->getVar('balancetes') ? 1 : 0,
            'produtos' => $request->getVar('produtos') ? 1 : 0,
            'agenda' => $request->getVar('agenda') ? 1 : 0,
            'vendas' => $request->getVar('vendas') ? 1 : 0,
            'receitas' => $request->getVar('receitas') ? 1 : 0,
            'despesas' => $request->getVar('despesas') ? 1 : 0,
            'relatorios_adm' => $request->getVar('relatorios_adm') ? 1 : 0,
            'relatorios_fin' => $request->getVar('relatorios_fin') ? 1 : 0,
            'log_acoes' => $request->getVar('log_acoes') ? 1 : 0,
            'idPermissao' => $request->getVar('idPermissao')
        );

        if (!$modelUsuario->atualizaPermissoes($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou as permissões do usuário ' . $request->getVar('nome') . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('usuarios');
        } else {
            $session->setFlashdata('error', 'Erro durante a atualização das permissões.');
            http_response_code(500);
        }
    }

    public function reativar()
    {
        $session = Session();
        $modelUsuario = new UsuarioModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'status' => '1',
            'id' => $_GET['id']
        );

        $return = $modelUsuario->atualizaUsuario($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Reativou o usuário ' . $_GET['usuario'] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('usuarios');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function desativar()
    {
        $session = Session();
        $modelUsuario = new UsuarioModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'status' => '0',
            'id' => $_GET['id']
        );

        $return = $modelUsuario->atualizaUsuario($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Desativou o usuário ' . $_GET['usuario'] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('usuarios');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelUsuario = new UsuarioModel();
        $modelAcoes = new AcoesModel();

        if (!validaSenha($request->getVar('senha'))) {
            echo '<script>history.go(-1);</script>';
            $session->setFlashdata('warning', 'Senha inválida.');
        } else {
            $data = array(
                'nome' => $request->getVar('nome'),
                'email' => $request->getVar('email'),
                'usuario ' => $request->getVar('usuario'),
                'senha' => Bcrypt::hash($request->getVar('senha')),
                'status' => $request->getVar('status')
            );

            if ($modelUsuario->salvaUsuario($data)) {

                $idUltimo = $modelUsuario->findIdUltimoCadastrado();
                $idusuario = $idUltimo[0]['idUsuario'];

                $data = array(
                    'idUsuario' => $idusuario,
                    'usuarios' => 0,
                    'clientes' => 0,
                    'funcionarios' => 0,
                    'fornecedores' => 0,
                    'balancetes' => 0,
                    'produtos' => 0,
                    'agenda' => 0,
                    'vendas' => 0,
                    'receitas' => 0,
                    'despesas' => 0,
                    'relatorios_adm' => 0,
                    'relatorios_fin' => 0,
                    'log_acoes' => 0
                );

                $modelUsuario->salvaPermissoes($data);

                if ($_SESSION['credenciais']["idlogado"] != 1) {
                    $acao = 'Salvou o usuário ' . $request->getVar('nome') . '.';
                    $data = array(
                        'idusuario' => $_SESSION['credenciais']["idlogado"],
                        'data_acao' => date("Y-m-d H:i:s"),
                        'acao' => $acao
                    );

                    $modelAcoes->grava_acao($data);
                }

                $session->setFlashdata('success', 'Ação concluída com sucesso.');
                return redirect()->to('usuarios');
            } else {
                $session->setFlashdata('error', 'Erro durante a excução da ação.');
                http_response_code(500);
            }
        }
    }
}
