<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\ClienteModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Clientes extends BaseController
{
    public function exportExcel()
    {
        $modelCliente = new ClienteModel();
        $clientes = $modelCliente->getClientes();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nome');
        $sheet->setCellValue('B1', 'Endereço');
        $sheet->setCellValue('C1', 'Telefones');
        $rows = 2;

        foreach ($clientes as $cliente) {
            $sheet->setCellValue('A' . $rows, $cliente['nome_cliente']);
            $sheet->setCellValue('B' . $rows, $cliente['endereco']);
            $sheet->setCellValue('C' . $rows, $cliente['telefones']);
            $rows++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('clientes.xlsx');
        return $this->response->download('clientes.xlsx', null)->setFileName('Clientes.xlsx');
    }

    public function clientes()
    {
        $session = Session();
        $modelCliente = new ClienteModel();
        $clientes = $modelCliente->getClientes();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'viewClientes', ['clientes' => $clientes]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function criar()
    {
        $session = Session();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_cliente');
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function editar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelCliente = new ClienteModel();
        $cliente = $modelCliente->findCliente($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'novo_cliente', ['cliente' => $cliente]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function visualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $modelCliente = new ClienteModel();
        $cliente = $modelCliente->visualizaCliente($id);

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'visualizaCliente', ['cliente' => $cliente]);
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function reativar()
    {
        $session = Session();
        $modelCliente = new ClienteModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'ativo' => 1,
            'idcliente' => $_GET['id']
        );

        $return = $modelCliente->atualizaCliente($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Reativou o cliente ' . $_GET['nome'] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('clientes');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function desativar()
    {
        $session = Session();
        $modelCliente = new ClienteModel();
        $modelAcoes = new AcoesModel();

        $data = array(
            'ativo' => 0,
            'idcliente' => $_GET['id']
        );

        $return = $modelCliente->atualizaCliente($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Desativou o cliente ' . $_GET['nome'] . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('clientes');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function salvar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelCliente = new ClienteModel();
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
                'indicacao' => $request->getVar('indicacao'),
                'ativo' => 1,
                'datacadastro' => date('Y-m-d H:i:s'),
                'idcliente' => $request->getVar('id')
            );
            $nomecliente = $request->getVar('nome');
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
                'indicacao' => $request->getVar('indicacao'),
                'ativo' => 1,
                'datacadastro' => date('Y-m-d H:i:s'),
                'idcliente' => $request->getVar('id')
            );
            $nomecliente = $request->getVar('nomefantasia');
        }

        if ($modelCliente->salvaCliente($data)) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Salvou o cliente ' . $nomecliente . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('clientes');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }

    public function atualizar()
    {
        $session = Session();
        $request = \Config\Services::request();
        $modelCliente = new ClienteModel();
        $modelAcoes = new AcoesModel();

        if ($request->getVar('tipoc') == 'Física') {
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
                'indicacao' => $request->getVar('indicacao'),
                'idcliente' => $request->getVar('id')
            );
            $nomecliente = $request->getVar('nome');
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
                'indicacao' => $request->getVar('indicacao'),
                'idcliente' => $request->getVar('id')
            );
            $nomecliente = $request->getVar('nomefantasia');
        }

        $return = $modelCliente->atualizaCliente($data);

        if (!$return) {
            if ($_SESSION['credenciais']["idlogado"] != 1) {
                $acao = 'Alterou dados do cliente ' . $nomecliente . '.';
                $data = array(
                    'idusuario' => $_SESSION['credenciais']["idlogado"],
                    'data_acao' => date("Y-m-d H:i:s"),
                    'acao' => $acao
                );

                $modelAcoes->grava_acao($data);
            }

            $session->setFlashdata('success', 'Ação concluída com sucesso.');
            return redirect()->to('clientes');
        } else {
            $session->setFlashdata('error', 'Erro durante a excução da ação.');
            http_response_code(500);
        }
    }
}
