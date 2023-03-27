<?php

$dados = '<table style="width: 100%; font-size: 12px; border: 0;">
    <tr style="background-color: gray;">
        <th width="10%" style="text-align: center; color: #fff;">DATA</th>
        <th width="10%" style="text-align: center; color: #fff;">USUÁRIO</th>
        <th width="80%" style="text-align: left; color: #fff;">AÇÃO</th>
    </tr>';

$cont = 0;

foreach ($logs as $row) {
    if ($cont % 2 == 0) {
        $cor = '#fff';
    } else {
        $cor = '#f0f0f0';
    }

    $dados .= '
    <tr style="background-color: ' . $cor . '">
        <td style="text-align: center;">' . date("d/m/Y", strtotime($row['data_acao'])) . '</td>
        <td style="text-align: center;">' . $row['usuario'] . '</td>
        <td style="text-align: left;">' . $row['acao'] . '</td>
    </tr>';

    $cont++;
}

$dados .= '
</table>';

echo $dados;
echo '</div><hr>';
echo '<div style="width: 100%; text-align: right; font-size: 12px;">Total de ações: <b>' . count($logs) . '</b></div>';
