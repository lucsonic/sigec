<style>
    hr {
        color: black;
    }
</style>
<?php

use App\Models\FeriadoModel;

$modelFeriado = new FeriadoModel();

$meses = array(
    1 => "JANEIRO",
    2 => "FEVEREIRO",
    3 => "MARÇO",
    4 => "ABRIL",
    5 => "MAIO",
    6 => "JUNHO",
    7 => "JULHO",
    8 => "AGOSTO",
    9 => "SETEMBRO",
    10 => "OUTUBRO",
    11 => "NOVEMBRO",
    12 => "DEZEMBRO"
);

$numdias = cal_days_in_month(CAL_GREGORIAN, $mes, date('Y'));

if ($funcionario[0]['tipopessoa'] == 'Física') {
    $lbl = 'CPF';
    $cpfcnpj = mskCPF($funcionario[0]['cpf']);
} else {
    $lbl = 'CNPJ';
    $cpfcnpj = mskCNPJ($funcionario[0]['cnpj']);
}

echo '<br><br><br>';
echo '<table width="100%" style="border: 1px solid; border-bottom: none; text-align: center; border-collapse: collapse; font-size: 16px;">
   <tr>
      <td>
         <div style="text-align: center; font-weight: bold;">FOLHA DE PONTO DE ' . $meses[date($mes)] . '/' . $ano . '</div>
      </td>
   </tr>
</table>';
echo '<table width="100%" style="border: 1px solid; border-collapse: collapse; font-size: 12px;">
    <tr>
        <td><b>Nome: </b>' . $funcionario[0]['nome_funcionario'] . '</td>
        <td><b>Matrícula: </b>' . str_pad($funcionario[0]['idfuncionario'], 4, '0', STR_PAD_LEFT) . '</td>
        <td style="text-align: right;"><b>' . $lbl . ': </b>' . $cpfcnpj . '</td>
    </tr>
    <tr>
        <td><b>Setor: </b>' . $funcionario[0]['nomesetor'] . '</td>
        <td><b>Função: </b>' . $funcionario[0]['nomefuncao'] . '</td>
        <td style="text-align: right;"><b>Carga Horária: </b>' . $funcionario[0]['entrada'] . ' às ' . $funcionario[0]['saida'] . '</td>
    </tr>
</table>';
$tabela = '<table width="100%" style="border: 1px solid black; border-collapse: collapse; font-size: 13px;">
    <tr style="background-color: #f2f2f2;">
      <th style="border: 1px solid black; width: 20%; height: 40px;">Dia</th>
      <th style="border: 1px solid black; width: 10%;">Entrada</th>
      <th style="border: 1px solid black; width: 20%;" colspan="2">Intervalo/Almoço</th>
      <th style="border: 1px solid black; width: 10%;">Saída</th>
      <th style="border: 1px solid black; width: 40%;">Assinatura</th>
    </tr>';
for ($i = 1; $i <= $numdias; $i++) {
    $dia = $ano . '-' . str_pad($mes, 2, '0', STR_PAD_LEFT) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
    $feriado = $modelFeriado->getFeriadoFolha($ano, $mes, $i);

    if (nomedia($dia) == 'Sábado' || nomedia($dia) == 'Domingo') {
        $tabela .= '<tr style="background-color: #CDC9C9;">
            <td style="border: 1px solid black; width: 20%; padding-left: 5px; font-weight: bold;">' . str_pad($i, 2, '0', STR_PAD_LEFT) . ' - ' . nomedia($dia) . '</td>
            <td style="border: 1px solid black; width: 10%;"></td>
            <td style="border: 1px solid black; width: 10%;"></td>
            <td style="border: 1px solid black; width: 10%;"></td>
            <td style="border: 1px solid black; width: 10%;"></td>';
        if (isset($feriado[0]['dia'])) {
            $tabela .= '<td style="border: 1px solid black; width: 40%;">Feriado - ' . $feriado[0]['descricao'] . '</td>';
        } else {
            $tabela .= '<td style="border: 1px solid black; width: 40%;"></td>';
        }
        $tabela .= '</tr>';
    } else {
        if (isset($feriado[0]['dia'])) {
            $tabela .= '<tr style="background-color: #CDC9C9;">
            <td style="border: 1px solid black; width: 20%; padding-left: 5px; font-weight: bold;">' . str_pad($i, 2, '0', STR_PAD_LEFT) . ' - ' . nomedia($dia) . '</td>
            <td style="border: 1px solid black; width: 80%; text-align: center;" colspan="5">Feriado - ' . $feriado[0]['descricao'] . '</td>
          </tr>';
        } else {
            $tabela .= '<tr>
            <td style="border: 1px solid black; width: 20%; padding-left: 5px; font-weight: bold;">' . str_pad($i, 2, '0', STR_PAD_LEFT) . ' - ' . nomedia($dia) . '</td>
            <td style="border: 1px solid black; width: 10%;"></td>
            <td style="border: 1px solid black; width: 10%;"></td>
            <td style="border: 1px solid black; width: 10%;"></td>
            <td style="border: 1px solid black; width: 10%;"></td>
            <td style="border: 1px solid black; width: 40%;"></td>
          </tr>';
        }
    }
}

$tabela .= '</table>';
echo $tabela;

echo '<br><b>Observações:</b>';
echo '<hr><hr><hr><br><br>';

$assinaturas = '<table width="100%" style="border: 1px solid black; border-collapse: collapse; font-size: 13px;">
<tr>
<td style="height: 100px; vertical-align: middle; padding-left: 15px;">
Brasília, ____ de ________________ de ___________.
</td>
<td style="vertical-align: middle; text-align: center; padding-right: 15px;">_____________________________________________<br><b>Gestor / Gerente</b></td>
</tr>
</table>';

echo $assinaturas;
