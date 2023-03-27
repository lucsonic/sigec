<?php

namespace App\Controllers;

use App\Models\AcoesModel;
use App\Models\ClienteModel;
use App\Models\FornecedorModel;
use App\Models\FuncionarioModel;

class Relatorios extends BaseController
{
    public function relclientes()
    {
        $formato = formatoRel('L');
        $mpdf = new \Mpdf\Mpdf(['orientation' => $formato['orientation']]);

        $modelCliente = new ClienteModel();
        $clientes = $modelCliente->getClientes();

        $rodape = $formato['estabelecimento'] . ' |Impresso em: ' . date('d/m/Y H:i:s') . ' |Página: {PAGENO}';
        $mpdf->SetFooter($rodape);

        $titulo = '<div style="width: 100%; text-align: right; padding-bottom: 0px; padding-top: 10px; 
        font-size: 16px; font-weight: bold;">Relatório de Clientes</div>';

        $mpdf->WriteHTML('<br><br>');

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

        if ($formato['orientation'] == 'P') {
            $mpdf->WriteHTML($titulo);
            $mpdf->WriteHTML('<div>');
        } else {
            $mpdf->WriteHTML($titulo);
            $mpdf->WriteHTML('<div style="padding-top: 7px;">');
        }

        $html = view('relatorioClientes', ['clientes' => $clientes]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit();
    }

    public function relfornecedores()
    {
        $formato = formatoRel('L');
        $mpdf = new \Mpdf\Mpdf(['orientation' => $formato['orientation']]);

        $modelFornecedores = new FornecedorModel();
        $fornecedores = $modelFornecedores->getFornecedores();

        $rodape = $formato['estabelecimento'] . ' |Impresso em: ' . date('d/m/Y H:i:s') . ' |Página: {PAGENO}';
        $mpdf->SetFooter($rodape);

        $titulo = '<div style="width: 100%; text-align: right; padding-bottom: 0px; padding-top: 10px; 
        font-size: 16px; font-weight: bold;">Relatório de Fornecedores</div>';

        $mpdf->WriteHTML('<br><br>');

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

        if ($formato['orientation'] == 'P') {
            $mpdf->WriteHTML($titulo);
            $mpdf->WriteHTML('<div>');
        } else {
            $mpdf->WriteHTML($titulo);
            $mpdf->WriteHTML('<div style="padding-top: 7px;">');
        }

        $html = view('relatorioFornecedores', ['fornecedores' => $fornecedores]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit();
    }

    public function relfuncionarios()
    {
        $formato = formatoRel('L');
        $mpdf = new \Mpdf\Mpdf(['orientation' => $formato['orientation']]);

        $modelFuncionario = new FuncionarioModel();
        $funcionarios = $modelFuncionario->getFuncionarios();

        $rodape = $formato['estabelecimento'] . ' |Impresso em: ' . date('d/m/Y H:i:s') . ' |Página: {PAGENO}';
        $mpdf->SetFooter($rodape);

        $titulo = '<div style="width: 100%; text-align: right; padding-bottom: 0px; padding-top: 10px; 
        font-size: 16px; font-weight: bold;">Relatório de Funcionários</div>';

        $mpdf->WriteHTML('<br><br>');

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

        if ($formato['orientation'] == 'P') {
            $mpdf->WriteHTML($titulo);
            $mpdf->WriteHTML('<div>');
        } else {
            $mpdf->WriteHTML($titulo);
            $mpdf->WriteHTML('<div style="padding-top: 7px;">');
        }

        $html = view('relatorioFuncionarios', ['funcionarios' => $funcionarios]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit();
    }

    public function rellog()
    {
        $session = Session();

        if ($session->get('user')) {
            return $this->template->render('templates/template_padrao', 'log_acoes');
        } else {
            return $this->template->render('templates/template_login', 'login');
        }
    }

    public function buscaLogs()
    {
        $session = Session();

        if (!validaData($_POST['dtini'], 'd/m/Y') || !validaData($_POST['dtfim'], 'd/m/Y')) {
            echo '<script>history.go(-1);</script>';
            $session->setFlashdata('error', 'Data(s) inválida(s).');
            die;
        }
        $dt1 = implode("-", array_reverse(explode("/", $_POST['dtini']))) . ' 00:00:00';
        $dt2 = implode("-", array_reverse(explode("/", $_POST['dtfim']))) . ' 23:59:59';

        if ($dt1 > $dt2) {
            $session->setFlashdata('info', 'A data inicial não pode ser maior que a data final.');
            echo '<script>history.go(-1);</script>';
            die;
        }
        $modelLog = new AcoesModel();
        $logs = $modelLog->getAcoes($dt1, $dt2);

        if (!$logs) {
            $session->setFlashdata('info', 'Não existem registro neste período.');
            echo '<script>history.go(-1);</script>';
            die;
        } else {
            $formato = formatoRel('P');
            $mpdf = new \Mpdf\Mpdf(['orientation' => $formato['orientation']]);

            $rodape = $formato['estabelecimento'] . ' |Impresso em: ' . date('d/m/Y H:i:s') . ' |Página: {PAGENO}';
            $mpdf->SetFooter($rodape);

            $titulo = '<div style="width: 100%; text-align: right; padding-bottom: 0px; padding-top: 10px; 
        font-size: 16px; font-weight: bold;">Histórico de Ações: Dê ' . $_POST['dtini'] . ' a ' . $_POST['dtfim'] . '</div>';

            $mpdf->WriteHTML('<br><br>');

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

            if ($formato['orientation'] == 'P') {
                $mpdf->WriteHTML($titulo);
                $mpdf->WriteHTML('<div>');
            } else {
                $mpdf->WriteHTML($titulo);
                $mpdf->WriteHTML('<div style="padding-top: 7px;">');
            }

            $html = view('relatorioLog', ['logs' => $logs]);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
            exit();
        }
    }
}
