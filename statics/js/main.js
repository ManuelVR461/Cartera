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
        this.mensaje='';
        this.data='';
    }

    $('button[name$="-form"]').click(function(e){
        e.preventDefault();
        let params = new AjaxParams;
        params.accion = $(this).data('action')+"/ajax";        
        params.form = $(this).parent('form');
        params.metodo= params.form.attr('method');
        params.mensaje = $(this).siblings('#msg-'+$(this).text()).val();
        let formdata = new FormData(params.form[0]);
        formdata.append('controller', params.accion.split("/")[0]);
        params.data = params.form.serialize();
        
        swal.fire({
            title:"Estas Seguro",
            text:params.mensaje,
            icon:"question",
            showCancelButton:true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText:"Aceptar",
            cancelButtonText:"Cancelar"
        }).then((result)=>{
            if(result.value){
                postAjax(params,function(response){
                    var resp = JSON.stringify(response);
                    $('.CuadroListas').html(response);
                });

            } 
        });
    });

    $('button[name$="-list"]').click(function(e){
        e.preventDefault();
        let params = new AjaxParams;
        params.accion= $(this).data('action')+"/ajax";        
        params.metodo= "POST";
        params.data = {controller:params.accion.split("/")[0]};
        postAjax(params,function(response){
            var resp = JSON.stringify(response);
            $('.CuadroListas').html(response);
        });
        

    });
   
    function postAjax(p, success) {
        var params = typeof p.data == 'string' ? p.data : Object.keys(p.data).map(
                function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(p.data[k]) }
            ).join('&');
    
        var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
        xhr.open('POST', p.accion);
        xhr.onreadystatechange = function() {
            if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
        };
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(params);
        return xhr;
    }

    //////dashboard//////

    //window.setInterval(function () {
        //updateStats();
    //}, 66000);

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
