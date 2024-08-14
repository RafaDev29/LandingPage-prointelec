$('document').ready(function(){

    //funcion apra procesar la peticion del formulario
    $('#do_contact_form').on('submit', do_contact_form);
    function do_contact_form(e){
        e.preventDefault();

        var data = new FormData($('#do_contact_form').get(0));
        wrapper_msg= $('.wrapper_msg'),
        wrapper_contact_form = $('.wrapper_contact_form'),
        submit_button = $('.submit_button');
        submit_button_default = submit_button.html();

        $.ajax({
            url: 'enviar.php',
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            beforeSend: function() {
                submit_button.html('Enviando..')
            }
        }).done(function(res){
            if(res.status === 200){
                wrapper_msg.html(res.msg);
                wrapper_contact_form.html(res.data);

            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Complete todos los Campos ',
                    showConfirmButton: false,
                    timer: 1000
                 })
                wrapper_msg.html(res.msg);
                submit_button.html(submit_button_default);
            }

        }).always(function(){

        }).fail(function(err){
            
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Mensaje Enviado ',
                showConfirmButton: false,
                timer: 1000
            })
            submit_button.html(submit_button_default);
            wrapper_msg.html('Mensaje Enviado ');

        })
    }
});