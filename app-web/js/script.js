$(document).ready(() => {
    $("input[type='tel']").change(function(e){
        e.preventDefault();
        const id = $(this).attr('id'); 
        $("input[name='aggiornaTelefono'][id='"+ id +"']").removeAttr("disabled");
        $("input[name='aggiornaTutto'][id='"+ id +"']").removeAttr("disabled");
    })

    $("input[type='email']").change(function(e){
        e.preventDefault();
        const id = $(this).attr('id'); 
        $("input[name='aggiornaMail'][id='"+ id +"']").removeAttr("disabled");
        $("input[name='aggiornaTutto'][id='"+ id +"']").removeAttr("disabled");
    })

    $("input[type='number']").change(function(e){
        e.preventDefault();
        const id = $(this).attr('id'); 
        $("input[name='aggiornaPaga'][id='"+ id +"']").removeAttr("disabled");
        $("input[name='aggiornaTutto'][id='"+ id +"']").removeAttr("disabled");
    })
});