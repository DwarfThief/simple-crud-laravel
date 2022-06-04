$(document).ready(function () {
    if($('.cnpj')){
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    }
    if ($('.cpf')) {
        $('.cpf').mask('000.000.000-00', {reverse: true});
    }
});
