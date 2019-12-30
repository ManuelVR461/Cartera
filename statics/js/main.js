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
        
        let btn = params.accion.split("/")[1];
        params.form = $(this).parents('form');

        params.metodo= params.form.attr('method');
        params.mensaje = $(this).siblings('#msg-'+$(this).text()).val();
        params.data = params.form.serialize();
        params.data = params.data+"&controller="+params.accion.split("/")[0];
        if(btn!=="Cancelar"){
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
                        $("button:contains('Modificar')").attr("data-action","Cuentas/crearCuenta").text("Guardar");
                    });

                } 
            });
        }else{
            $(".formAjax")[0].reset();
            $("button:contains('Modificar')").attr("data-action","Cuentas/crearCuenta").text("Guardar");
        }
    });

    $('button[name$="-list"]').click(function(e){
        e.preventDefault();
        let params = new AjaxParams;
        params.accion= $(this).data('action')+"/ajax";        
        params.metodo= "POST";
        params.data = {controller:params.accion.split("/")[0]};
        postAjax(params,function(response){
            $('.CuadroListas').html(response);
        });
    });

    $(document).on( "click", 'button[name$="-list-item"]',function(e) {
        e.preventDefault();
        let btn = $(this).text();
        let params = new AjaxParams;
        let id = $(this).data('id');
        params.accion= $(this).data('action')+"/ajax";        
        params.data = {controller:params.accion.split("/")[0],
                       id:id};
        getAjax(params,function(response){
            let resp = jQuery.parseJSON(response);
            if(btn==="C"){
                for (const campo in resp) {
                    if ( $("#"+campo).length ) {
                        $("#"+campo).val(resp[campo]);
                    }
                }
                $("button:contains('Guardar')").attr("data-action","Cuentas/modificarCuenta").text("Modificar");
            }
            if(btn==="X"){
                if(resp > 0){
                    $("tr#"+id).remove();
                }
            }
        });
    });

    function postAjax(p, success) {
        var params = typeof p.data == 'string' ? p.data : Object.keys(p.data).map(
                function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(p.data[k]) }
            ).join('&');
    
        var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
        xhr.open(p.metodo, p.accion);
        xhr.onreadystatechange = function() {
            if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
        };
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(params);
        return xhr;
    }

    function getAjax(p,success){
        jQuery.get(p.accion,p.data).done(function(data){
            success(data);
        })
    }

    function load(n,type="success",msg=undefined){
        if(msg===undefined){
            msg="<div style='text-align:center;'><h1 style='padding-top:10px;'>Espere por favor...</h1><br><img src='./statics/images/cargando/cargando3.gif' style='width:100px;padding-bottom:20px;' /></div>";
        }else{
            msg="<div style='text-align:center;'><h1 style='padding-top:10px;'>"+msg.substr(0,1).toUpperCase()+msg.substr(1)+"</h1><br><img src='./statics/images/cargando/cargando3.gif' style='width:100px;padding-bottom:20px;' /></div>";
        }

        let css = {background:"#28a745"};

        switch(type){
            case "success":
                css = {background:"#28a745","border-radius":"10px"};
            break;
            case "warning":
                css = {background:"#ffc107","border-radius":"10px"};
            break;
            case "info":
                css = {background:"#17a2b8","border-radius":"10px"};
            break;
            case "danger":
                css = {background:"#dc3545","border-radius":"10px"};
            break;
            case "primary":
                css = {background:"#007bff","border-radius":"10px"};
            break;
            case "secundary":
                css = {background:"#6c757d","border-radius":"10px"};
            break;
            default:
                css = {background:"#28a745","border-radius":"10px"};
            break;
        } 
        
        css.color = "#fff";

        if(n===1){
            $('div.wrapper').block({ 
                message: msg, 
                css: css
            });
        }
        if(n==0){
            $('div.wrapper').unblock(); 
        }
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
