<?php

$dados = '<table style="width: 100%; font-size: 12px; border: 0;">
    <tr style="background-color: gray;">
        <th width="30%" style="text-align: left; color: #fff;">NOME FORNECEDOR</th>
        <th width="15%" style="text-align: left; color: #fff;">EMAIL</th>
        <th width="15%" style="text-align: left; color: #fff;">CNPJ</th>
        <th width="25%" style="text-align: left; color: #fff;">ENDEREÇO</th>
        <th width="15%" style="text-align: left; color: #fff;">CONTATOS</th>
    </tr>';

$cont = 0;

foreach ($fornecedores as $row) {
    if ($cont % 2 == 0) {
        $cor = '#fff';
    } else {
        $cor = '#f0f0f0';
    }

    $dados .= '
    <tr style="background-color: ' . $cor . '">
        <td>' . $row['nomefantasia'] . '</td>
        <td style="text-align: left;">' . $row['email'] . '</td>
        <td>' . mskCNPJ($row['cnpj']) . '</td>
        <td>' . $row['endereco'] . ' ' . $row['bairro'] . ' - ' . $row['cidade'] . '/' . $row['uf'] . '</td>
        <td>' . $row['telefones'] . '</td>
    </tr>';

    $cont++;
}

$dados .= '
</table>';

echo $dados;
echo '</div><hr>';

echo '<div style="width: 100%; text-align: right; font-size: 12px;">Total de fornecedores: <b>' . count($fornecedores) . '</b></div>';
