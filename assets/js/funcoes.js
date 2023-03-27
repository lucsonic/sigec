function valida_usuario()
{
    var nome = formLogin.usuario.value;
    var senha = formLogin.ssenha.value;
    
    
}

function validaHorario(id)
{
    element = document.getElementById(id);
    if (element == null)
        return false;

    hrs = (element.value.substring(0, 2));
    min = (element.value.substring(3, 5));

    if ((hrs < 00) || (hrs > 23) || (min < 00) || (min > 59))
    {
        element.value = '';
        alert('Horario inválido. Deve ser informado no formato HH:MM:');
        return false;
    }

    return true;
}

function carrocel(itens, item, n_itens)
{
    var options = {};
    var anterior = ((item - 1) % n_itens);
    if (anterior < 0)
        anterior += n_itens;

    $('#' + itens + '_' + anterior).hide('slide', {direction: "right"}, 500, function() {
        $('#' + itens + '_' + item).show('slide', options, 500, function() {
        });
    });

    if (n_itens != 1)
        setTimeout(function() {
            carrocel(itens, ((item + 1) % n_itens), n_itens)
        }, 3000);
}

function sede_efeito(i)
{
    if (document.getElementById('sede_' + i))
        $('#sede_' + i).show('slide', {direction: "right"}, 300, function() {
            sede_efeito(i + 1)
        });
}

function dimensao_efeito(i)
{
    if (document.getElementById('dimensao_' + i))
        $('#dimensao_' + i).show('clip', {}, 390, function() {
            dimensao_efeito(i + 1)
        });

}

function marcar_todos(id)
{
    var element;
    for (i = 0; element = document.getElementById(id + i); i++)
        element.checked = true;
}

