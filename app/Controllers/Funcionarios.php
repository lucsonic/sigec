<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\FuncionarioModel;
use App\Models\FuncoesModel;

class Funcionarios extends BaseController
{
    public function funcionarios()
    {
        $session = Session();
        $modelFuncionario = new FuncionarioModel();
        $funcionarios = $modelFuncionario->getFuncionarios();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'viewFuncionarios', ['funcionarios' => $funcionarios]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();
        $modelFuncionario = new FuncionarioModel();
        $modelFuncoes = new FuncoesModel();
        $setores = $modelFuncionario->getSetores();
        $funcoes = $modelFuncoes->getFuncoes();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_funcionario', ['setores' => $setores, 'funcoes' => $funcoes]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelFuncionario = new FuncionarioModel();
        $modelFuncoes = new FuncoesModel();
        $funcionario = $modelFuncionario->findFuncionario($id);
        $setores = $modelFuncionario->getSetores();
        $funcoes = $modelFuncoes->getFuncoes();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_funcionario', ['funcionario' => $funcionario, 'setores' => $setores, 'funcoes' => $funcoes]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function reativar()
    {
        $session = Session();
        $modelFuncionario = new FuncionarioModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'ativo' => 1,
            'idfuncionario' => $_GET['id']
        );

        $return = $modelFuncionario->atualizaFuncionario($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Reativou o funcionário ' . $_GET['nome'] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('funcionarios');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function desativar()
    {
        $session = Session();
        $modelFuncionario = new FuncionarioModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'ativo' => 0,
            'idfuncionario' => $_GET['id']
        );

        $return = $modelFuncionario->atualizaFuncionario($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Desativou o funcionário ' . $_GET['nome'] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('funcionarios');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function novo_setor()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelFuncionario = new FuncionarioModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'nomesetor' => $request->getVar('nomesetor')
        );

        if ($modelFuncionario->salvaSetor($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou o setor ' . $request->getVar('nomesetor') . '.';
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

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelFuncionario = new FuncionarioModel();
        $modelAcoes = new AcoesModel();

        if ($request->getVar('tpessoa') == 'Física') {
            $data = array(
                'tipopessoa' => $request->getVar('tpessoa'),
                'nome' => addslashes(mb_strtoupper($request->getVar('nome'))),
                'cpf' => limpaMascaras($request->getVar('cpf')),
                'rg ' => $request->getVar('rg'),
                'orgaorg' => $request->getVar('orgao'),
                'datanascimento' => implode("-", array_reverse(explode("/", $request->getVar('dtnasc')))),
                'endereco' => $request->getVar('endereco'),
                'bairro' => $request->getVar('bairro'),
                'cidade' => $request->getVar('cidade'),
                'uf' => $request->getVar('uf'),
                'sexo' => $request->getVar('sexo'),
                'telefones' => $request->getVar('telefones'),
                'cep' => limpaMascaras($request->getVar('cep')),
                'email' => $request->getVar('email'),
                'idsetor' => $request->getVar('setor'),
                'estadocivil' => $request->getVar('estadocivil'),
                'formacao' => $request->getVar('formacao'),
                'idfuncao' => $request->getVar('funcao'),
                'entrada' => $request->getVar('entrada'),
                'saida' => $request->getVar('saida'),
                'observacao' => $request->getVar('observacao'),
                'ativo' => 1,
                'datacadastro' => date('Y-m-d H:i:s')
            );
            $nomefuncionario = $request->getVar('nome');
        } else {
            $data = array(
                'tipopessoa' => $request->getVar('tpessoa'),
                'nomefantasia' => addslashes(mb_strtoupper($request->getVar('nomefantasia'))),
                'cnpj' => limpaMascaras($request->getVar('cnpj')),
                'razaosocial ' => $request->getVar('razaosocial'),
                'nomecontato' => $request->getVar('ncontato'),
                'endereco' => $request->getVar('endereco'),
                'bairro' => $request->getVar('bairro'),
                'cidade' => $request->getVar('cidade'),
                'uf' => $request->getVar('uf'),
                'telefones' => $request->getVar('telefones'),
                'cep' => limpaMascaras($request->getVar('cep')),
                'email' => $request->getVar('email'),
                'ativo' => 1,
                'entrada' => $request->getVar('entrada'),
                'saida' => $request->getVar('saida'),
                'datacadastro' => date('Y-m-d H:i:s'),
                'observacao' => $request->getVar('observacao')
            );
            $nomefuncionario = $request->getVar('nomefantasia');
        }

        if ($modelFuncionario->salvaFuncionario($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou o funcionário ' . $nomefuncionario . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('funcionarios');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelFuncionario = new FuncionarioModel();
        $modelAcoes = new AcoesModel();

        if ($request->getVar('tpessoa') == 'Física') {
            $data = array(
                'tipopessoa' => $request->getVar('tpessoa'),
                'nome' => addslashes(mb_strtoupper($request->getVar('nome'))),
                'cpf' => limpaMascaras($request->getVar('cpf')),
                'rg ' => $request->getVar('rg'),
                'orgaorg' => $request->getVar('orgao'),
                'datanascimento' => implode("-", array_reverse(explode("/", $request->getVar('dtnasc')))),
                'endereco' => $request->getVar('endereco'),
                'bairro' => $request->getVar('bairro'),
                'cidade' => $request->getVar('cidade'),
                'uf' => $request->getVar('uf'),
                'sexo' => $request->getVar('sexo'),
                'telefones' => $request->getVar('telefones'),
                'cep' => limpaMascaras($request->getVar('cep')),
                'email' => $request->getVar('email'),
                'idsetor' => $request->getVar('setor'),
                'estadocivil' => $request->getVar('estadocivil'),
                'formacao' => $request->getVar('formacao'),
                'idfuncao' => $request->getVar('funcao'),
                'entrada' => $request->getVar('entrada'),
                'saida' => $request->getVar('saida'),
                'observacao' => $request->getVar('observacao'),
                'ativo' => 1,
                'datacadastro' => date('Y-m-d H:i:s'),
                'idfuncionario' => $request->getVar('id')
            );
            $nomefuncionario = $request->getVar('nome');
        } else {
            $data = array(
                'tipopessoa' => $request->getVar('tpessoa'),
                'nomefantasia' => addslashes(mb_strtoupper($request->getVar('nomefantasia'))),
                'cnpj' => limpaMascaras($request->getVar('cnpj')),
                'razaosocial ' => $request->getVar('razaosocial'),
                'nomecontato' => $request->getVar('ncontato'),
                'endereco' => $request->getVar('endereco'),
                'bairro' => $request->getVar('bairro'),
                'cidade' => $request->getVar('cidade'),
                'uf' => $request->getVar('uf'),
                'telefones' => $request->getVar('telefones'),
                'cep' => limpaMascaras($request->getVar('cep')),
                'email' => $request->getVar('email'),
                'ativo' => 1,
                'entrada' => $request->getVar('entrada'),
                'saida' => $request->getVar('saida'),
                'datacadastro' => date('Y-m-d H:i:s'),
                'observacao' => $request->getVar('observacao'),
                'idfuncionario' => $request->getVar('id')
            );
            $nomefuncionario = $request->getVar('nomefantasia');
        }

        if (!$modelFuncionario->atualizaFuncionario($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Atualizou dados do funcionário ' . $nomefuncionario . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('funcionarios');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function visualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelFuncionario = new FuncionarioModel();
        $funcionario = $modelFuncionario->findFuncionario($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'visualizaFuncionario', ['funcionario' => $funcionario]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function folhaponto()
    {
        $session = Session();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'geraFolha');
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function ponto()
    {
        $request = \Config\Services::request();
        $formato = formatoRel('P');
        $mpdf = new \Mpdf\Mpdf(['orientation' => $formato['orientation']]);

        $id = $request->getVar('id');
        $mes = $request->getVar('editMes');
        $ano = $request->getVar('ano');
        $modelFuncionario = new FuncionarioModel();
        $funcionario = $modelFuncionario->findFuncionario($id);

        $rodape = $formato['estabelecimento'];
        $mpdf->SetFooter($rodape);

        $mpdf->WriteHTML('<htmlpageheader name="firstpage" style="display:none">
            <table style="width: 100%;">
                <tr>
                    <td style="width:' . $formato['tdlogo'] . '; text-align: left;">
                        <img src="' . base_url() . '/assets/img/sigec.png" style="width:' . $formato['logo'] . '; text-align: center;">
                    </td>
                    <td style="width:' . $formato['tdtextos'] . '; text-align: left;">
                        <span style="font-weight: bold; font-size: 18px;">' . $formato['estabelecimento'] . '</span>
                        <br>
                        <span style="font-weight: normal; font-size: 14px;">' . $formato['endereco'] . '</span>
                        <br>
                        <span style="font-weight: normal; font-size: 14px;">' . $formato['contato'] . '</span>
                        <br>
                        <span style="font-weight: normal; font-size: 14px;">' . $formato['redes'] . '</span>
                    </td>
                </tr>
            </table>
        </htmlpageheader>

        <htmlpageheader name="otherpages" style="display:none">
            <div style="text-align:center"></div>
        </htmlpageheader>
        <sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
        <sethtmlpageheader name="otherpages" value="on" />');

        $html = view('folhaPonto', ['funcionario' => $funcionario, 'mes' => $mes, 'ano' => $ano]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit();
    }
}
