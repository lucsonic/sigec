<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\LoginModel;
use App\Models\PermissaoModel;
use Bcrypt;

class Login extends BaseController
{
    public function index()
    {
        return $this->template->render('templates/template_login', 'login');
    }

    public function home()
    {
        return $this->template->render('templates/template_padrao', 'principal');
    }

    public function autentica()
    {
        $session = Session();

        if ($_POST['usuario'] == '' || $_POST['senha'] == '') {
            echo '<script>history.go(-1);</script>';
            $session->setFlashdata('error', 'Preencha os campos Usuário e Senha!');
            die;
        }

        $modelLogin = new LoginModel();
        $modelPermissoes = new PermissaoModel();

        $user = $_POST['usuario'];
        $password = $_POST['senha'];

        $data = [
            'usuario' => $modelLogin->getLogin($user)
        ];


        $senhabanco = $data['usuario']['senha'];
        $status = $data['usuario']['status'];
        $iduser = $data['usuario']['id'];

        $perm = [
            'permissoes' => $modelPermissoes->getPermissoes($iduser)
        ];

        if ($status === '1') {
            if (Bcrypt::check($password, $senhabanco)) {
                $session->set('user', $data);
                $permissoes = $perm;
                $_SESSION['permissoes'] = $permissoes;
                $_SESSION['credenciais']["idlogado"] = $data['usuario']['id'];
                $_SESSION['credenciais']["nome"] = $data['usuario']['nome'];
                $_SESSION['credenciais']["usuario"] = $data['usuario']['usuario'];
                $_SESSION['empresa']['nome'] = 'Magazine Nipêncio';
            } else {
                echo '<script>history.go(-1);</script>';
                $session->setFlashdata('error', 'Dados de autenticação não conferem!');
                die;
            }
        } else {
            echo '<script>history.go(-1);</script>';
            $session->setFlashdata('error', 'O usuário está desativado!');
            die;
        }
        return $this->template->render('templates/template_padrao', 'principal', ['data' => $data, 'permissoes' => $permissoes]);
    }

    public function logout()
    {
        $session = Session();
        $session->destroy();

        return $this->template->render('templates/template_login', 'login');
    }
}
