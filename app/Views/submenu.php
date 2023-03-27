<style>
    div.box {
        width: 15%;
        display: inline-block;
        padding-bottom: 30px;
        text-align: center;
        vertical-align: top;
    }

    .icons {
        width: 60%;
        height: 60%;
    }

    .grow img {
        transition: 1s ease;
    }

    .grow img:hover {
        -webkit-transform: scale(1.2);
        -ms-transform: scale(1.2);
        transform: scale(1.2);
        transition: 1s ease;
    }
</style>

<?php
$url = explode('/', $_SERVER['REQUEST_URI']);

$cadastros = [
    'clientes' => 'Clientes', 'funcionarios' => 'Funcionários', 'usuarios' => 'Usuários',
    'fornecedores' => 'Fornecedores', 'marcas' => 'Marcas', 'produtos' => 'Produtos',
    'grupos' => 'Grupos', 'funcoes' => 'Funções', 'feriados' => 'Feriados', 'agenda' => 'Agenda'
];

$financeiro = [
    'receitas' => 'Receitas', 'despesas' => 'Despesas', 'orcamentos' => 'Orçamentos', 'vendas' => 'Vendas',
    'adiantamentos' => 'Adiantamentos'
];

$relatorios = [
    'relClientes' => 'relClientes', 'relFornecedores' => 'relFornecedores',
    'relFuncionarios' => 'relFuncionários', 'relBalancete' => 'relBalancete',
    'relVendas' => 'relVendas', 'relGrafico' => 'relGrafico', 'relLog' => 'relLog'
];

if (end($url) == 'submenu?op=cadastros') {
?>
    <div style="padding-bottom: 10px;">
        <label class="titulos">Módulo de Cadastros</label>
        <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
    </div>
    <?php
    foreach ($cadastros as $cadastro) {
    ?>
        <a href="<?= base_url(); ?>/<?= removerAcentos(str_replace('ç', 'c', $cadastro)) . '/' . strtolower(removerAcentos(str_replace('ç', 'c', $cadastro))); ?>">
            <div class="box grow">
                <img class="icons" src="<?= base_url(); ?>/assets/img/menu/<?= strtolower(removerAcentos(str_replace('ç', 'c', $cadastro))); ?>.png" /><br>
                <span><?= $cadastro; ?></span>
            </div>
        </a>
    <?php
    }
} elseif (end($url) == 'submenu?op=financeiro') {
    ?>
    <div style="padding-bottom: 10px;">
        <label class="titulos">Módulo Financeiro</label>
        <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
    </div>
    <?php
    foreach ($financeiro as $fin) {
    ?>
        <a href="<?= base_url(); ?>/<?= removerAcentos(str_replace('ç', 'c', $fin)) . '/' . strtolower(removerAcentos(str_replace('ç', 'c', $fin))); ?>">
            <div class="box grow">
                <img class="icons" src="<?= base_url(); ?>/assets/img/menu/<?= strtolower(removerAcentos(str_replace('ç', 'c', $fin))); ?>.png" /><br>
                <span><?= $fin; ?></span>
            </div>
        </a>
    <?php
    }
} elseif (end($url) == 'submenu?op=relatorios') {
    ?>
    <div style="padding-bottom: 10px;">
        <label class="titulos">Módulo de Relatórios</label>
        <img src="<?= base_url(); ?>/assets/img/linhah.png" width="100%">
    </div>
    <?php
    foreach ($relatorios as $rel) {
        if ($rel == 'relClientes' || $rel == 'relFornecedores' || $rel == 'relFuncionários') {
            $trg = 'new';
        } else {
            $trg = '';
        }
    ?>
        <a href="<?= base_url(); ?>/Relatorios/<?= strtolower(removerAcentos(str_replace('ç', 'c', $rel))); ?>" target="<?= $trg; ?>">
            <div class="box grow">
                <img class="icons" src="<?= base_url(); ?>/assets/img/menu/<?= strtolower(removerAcentos(str_replace('ç', 'c', $rel))); ?>.png" /><br>
                <?php
                if ($rel == 'relGrafico') {
                    echo '<span>Gráfico de Vendas</span>';
                } elseif ($rel == 'relBalancete') {
                    echo '<span>Balancete Financeiro</span>';
                } elseif ($rel == 'relLog') {
                    echo '<span>Log de Ações</span>';
                } else {
                ?>
                    <span><?= 'Relatório de ' . str_replace('rel', '', $rel); ?></span>
                <?php } ?>
            </div>
        </a>
<?php
    }
} else {
    echo '';
}

?>