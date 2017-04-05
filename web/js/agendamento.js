$(document).ready(function() {
    
    var navListItems = $('ul.setup-panel li a'),
        allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });

    $('#sel-servico').change(function()
    {
        $('#activate-step-2').prop('disabled', 'disabled');
        if ($(this).val() > 0)
        {
            $('#activate-step-2').removeAttr('disabled');
        }
        carregaBarbeiros($(this).val());
    });
    
    $('#profissionais').on('click','input[name=profSelecionado]', function()
    {
        $('#activate-step-3').prop('disabled', 'disabled');
        if ($(this).val() > 0)
        {
            $('#activate-step-3').removeAttr('disabled');
        }        
    });
    
    $('#sel-dia').change(function()
    {
        geraHorarios($(this).val());
    });
    
    $('ul.setup-panel li.active a').trigger('click');
    
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
    });    
    
    $('#activate-step-3').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
    });    
});

function carregaBarbeiros(idServico)
{
    $.getJSON('/profissionais?servico='+idServico, function(retorno){
        
        $('#profissionais').empty();
        
        retorno.forEach(function(el){
            var radio = '<div class="radio">'
                    + '<label>'
                    + '<input type="radio" name="profSelecionado" id="" value="'+el.id+'">'
                    + el.nome
                    + '</label>'
                    + '</div>';
            $('#profissionais').append(radio);
        });
    });
}

function geraHorarios(dia)
{
    $.getJSON('/horarios?dia='+dia, function(retorno){
        
        $('#horarios').empty();
        
        retorno.forEach(function(el){
            var radio = '<div class="radio">'
                      + '<label><input type="radio" name="horario" value="'+el.hora+'" />'+el.hora+'</label>'
                      + '</div>';
            $('#horarios').append(radio);
        });
    });
}