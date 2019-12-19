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

    function AjaxParams(){
        this.accion='';
        this.metodo='POST';
        this.form='';
        //this.lista = $('.CuadroListas');
        this.dat='';
    }

    $('button[name$="-form"]').click(function(e){
        e.preventDefault();
        let params = new AjaxParams;

        params.accion = $(this).data('action');        
        params.form = $(this).parent('form');
        params.metodo= form.attr('method');
        
        let formdata = new FormData(params.form[0]);
        formdata.append('controller', params.accion.split("/")[0]);
        params.dat = formdata?formdata:params.form.serialize();

        
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
                EventAjax(params)
            } 
        });
    });

    $('button[name$="-list"]').click(function(e){
        e.preventDefault();
        let params = new AjaxParams;

        params.accion= $(this).data('action');        
        params.metodo= "POST";
        params.dat = {controller:params.accion.split("/")[0]};

        EventAjax(params);

    });


    function EventAjax(params){
        console.log("params "+JSON.stringify(params));
        // $.ajax({
        //     type: params.metodo,
        //     data: params.dat,
        //     url: params.accion,
        //     cache: false,
        //     contentType: false,
        //     processData: false,
        //     beforeSend: function () {
        //         //lista.html("<center><br><br><img src='../scvfacilito/statics/images/cargando/cargando2.gif'><center>");
        //     },
        //     success: function (response) {
        //         params.lista.html(response);
        //     },
        //     error: function (jqXHR, textStatus, errorThrown) {
        //         //debugger;
        //         //alert(textStatus, errorThrown, jqXHR);
        //     }
        // });
    }
    
    //////dashboard//////

    window.setInterval(function () {
        updateStats();
    }, 66000);

    function updateStats() {
        usuariosConectados();
        arqueosImpresos();
    }
    

    function usuariosConectados() {
        jQuery.get(
            './views/templates/usersConnected.php',
            function (data) {
                $('#connected_users').text(data);
            }
        );
    }

    function arqueosImpresos() {
        jQuery.get(
            './views/templates/arqueosPrinted.php',
            function (data) {
                $('#daily_revenue').text(data);
            }
        );
    }

    //Funciones Generales

    function dbg(a, b, c) {
        if (0 < (void 0 == c ? 1 : c) && a) {
            var d = null,
                d = [];
            c = "json";
            b = void 0 == b ? "debug_js" : b;
            if (a instanceof Array) d = a.toJSON();
            else if (a instanceof Object)
                if ("" == Object.values(a)) {
                    var f = a.length;
                    for (i = 0; i < f; i++) d[i] = a[i];
                    d = d.toJSON()
                } else d = Object.toJSON(a);
            else d = a.toString(), c = "string";

            var xhr=new XMLHttpRequest();
            xhr.open("POST", "core/debug.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("data=" + encodeURIComponent(d) + "&tipo=" + c + "&archivo=" + b);
        }
    }

});
