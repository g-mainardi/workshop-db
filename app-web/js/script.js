$(document).ready(() => {
    $("input[type='tel']").change(function(e){
        e.preventDefault();
        $("input[name='aggiornaTelefono']").removeAttr("disabled");
        $("input[name='aggiornaTutto']").removeAttr("disabled");
    })

    $("input[type='email']").change(function(e){
        e.preventDefault();
        $("input[name='aggiornaMail']").removeAttr("disabled");
        $("input[name='aggiornaTutto']").removeAttr("disabled");
    })

    $("input[type='number']").change(function(e){
        e.preventDefault();
        $("input[name='aggiornaPaga']").removeAttr("disabled");
        $("input[name='aggiornaTutto']").removeAttr("disabled");
    })
});