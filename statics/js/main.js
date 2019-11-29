'use strict'

$(document).ready(function(){

    $('.menu > ul > li > a').click(function(e) {        
        e.preventDefault();
        const element = $(this).next();

        $('.menu li').removeClass('activado');
        $(this).closest('li').addClass('activado');
        
        if((element.is('ul')) && (element.is(':visible'))) {
            $(this).closest('li').removeClass('activado');
            element.slideUp();
        }
        if((element.is('ul')) && (!element.is(':visible'))) {
            $('.menu ul ul:visible').slideUp();
            element.slideDown();
        }
    });

    $('.menu > ul > li > ul > li > a').click(function() {
        
        var element = $(this).next();
        $('.menu ul ul li').removeClass('activado');
        $(this).closest('ul ul li').addClass('activado');
        if((element.is('ul ul')) && (element.is(':visible'))) {
           $(this).closest('ul ul li').removeClass('activado');
           element.slideUp('normal');
        }
        if((element.is('ul ul')) && (!element.is(':visible'))) {
           $('.menu ul ul ul:visible').slideUp('normal');
           element.slideDown('normal');
        }
    });
	
    $('.menu li a').click(function(e){
        e.preventDefault();
        let press1 = $(this).closest('li').attr('class').split(' ');
        if(press1[0]!='parent' && press1[0]!='subparent'){
            window.location.href=$(this).attr('href');
        }
    });


     // Eventos Formulario General

     $(".formAjax").submit(function(e){
        e.preventDefault();
        const form = $(this);
        const accion= form.attr('action');
        const metodo= form.attr('method');
        //const respuesta = $('.RespuestaAjax');
        const lista = $('.CuadroListas');
        //const enctype = form.attr('enctype');
        const mensaje = $(".formAjax input[name=mensaje]")[0].value;
        const msjerror = "<script>Swal.fire({title:'Ocurrio un error inesperado',text:'Por Favor recargue la pagina',icon:'error',confirmButtonText: 'Ok'});</script>";
        const formdata=new FormData(this);
        

        swal.fire({
            title:"Estas Seguro",
            text:mensaje,
            icon:"question",
            showCancelButton:true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText:"Aceptar",
            cancelButtonText:"Cancelar"
        }).then((result)=>{

            if(result.value){

                $.ajax({
                    type: metodo,
                    data: formdata?formdata:form.serialize(),
                    url: accion,
                    cache: false,
                    contentType: false,
                    dataType: "json",
                    processData: false,
                    beforeSend: function () {
                        //lista.html("<center><br><br><img src='../scvfacilito/statics/images/cargando/cargando2.gif'><center>");
                    },
                    success: function (response) {
                        var res = response;
                        console.log(res.mensaje)
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //debugger;
                        //alert(textStatus, errorThrown, jqXHR);
                    }
                });
            }
            
        });
        return false;
    });

});
