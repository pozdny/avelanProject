/**
 * Created by Valentina on 18.09.14.
 */
$(document).ready(function() {
    var loc         = "http://" + location.hostname;
    var loc_admin  = "http://" + location.hostname + "/admin";
    // TAB SLIDE
    intID = null;
    var tab_view = $(".tab-view");
    if(tab_view.hasClass("tab-view")){
        var arr_tab = tab_view.find("li");
        var child = null;
        var href = '';
        intervalSlide(3000, arr_tab);
        $.each(arr_tab, function(){
            var $this = $(this);
            $this.on("click", function(){
                child = $(this).find('a');
                href = child.attr('href').substr(1);
                child.tab('show');
                setTimeout(function(){
                    location.href = 'services/' + href;
                },100);
            })
        });
    }
    function intervalSlide(time, arr_tab){
        var num_ind = 0;
        var next_li = null;
        var arr_length = arr_tab.length;
        intID = setInterval(function(){
            $.each(arr_tab, function(ind){

                if($(this).hasClass("active")){
                    next_li = $(this).next("li");
                    num_ind = ind;
                }

            })
            if(num_ind == arr_length-1){
                next_li = $(arr_tab[0]);
            }
            next_li.find("a").tab('show');
        }, time)
    }


    //HEIGHT CONTENT-PAGE
    var block     = $("#content-page");
    var footer      = $("#footer");
    var footerOffset  = footer.offset();
    var footerHeight = footer.height();
    if(block.attr('id') !=null){
        var blockOffset = block.offset();
        var blockOffsetTop = blockOffset.top;
        var footerOffsetTop = footerOffset.top;
        var blockHeight = block.height();
        var sum = blockOffsetTop + blockHeight;
        var parent = block.closest(".container");
        if((Math.round(sum) < (footerOffsetTop - footerHeight)) && !parent.hasClass("two-columns")){
            var razn = footerOffsetTop - sum - footerHeight;
            block.height(blockHeight + razn);
        }
    }
    //ICON FOR PRIC E-PAGE
    var pathname = window.location.pathname;
    if(pathname == '/price'){
        var arr_price_title = $(".page-content").find(".price-title.excel");
        $.each(arr_price_title, function(){
            $(this).wrapInner('<div class="inner-block-excel"></div>');
        })

    }
    //CREATE ZOOM SERVICES
    $(".img_block, .img_block_one, .img_block_onecat").hover(
        function()
        {
            $(this).find(".lupa").addClass("fancyover");;
        },
        function()
        {
            $(this).find(".lupa").removeClass("fancyover");;

        }
    );
    $(".img_R").hover(
        function()
        {
            $(this).find(".lupa").addClass("fancyoverR");;
        },
        function()
        {
            $(this).find(".lupa").removeClass("fancyoverR");;

        }
    );
    //FANCYBOX
    $(".img_block a, .img_block_one a, .img_block_onecat a, .img_R a").fancybox({
        closeClick : true,
        closeEffect : 'elastic',
        openEffect : 'elastic',
        speedOut : 20000,
        speedIn : 20000,
        prevEffect : 'fade',
        nextEffect : 'fade',
        padding: 5,
        helpers : {
            title : {
                type : 'inside'
            },
            overlay : {
                css : {
                    'background' : 'rgba(0,0,0,0.6)'
                }
            }
        }

    });
    //PLACEHOLDER
    var inputFild = $("#inputFild");
    var txt = 'Мы поможем найти...';
    inputFild.addClass('placeholded').val(txt);
    inputFild.focus(function(){
        $(this).val('');
    }).blur(function(){
        if($(this).val() == '' || $(this).val() == txt){
            $(this).val(txt);
        }
    });
    $("#searchForm").submit(function(){
        if(inputFild.val() == txt) return false;

    });
    //VALIDATE CALCULATOR
    $("#form-pushki").validatorRM({
        requiredF: [
            'square',
            'topSize',
            'tempOut',
            'tempIn'
        ],
        immediately: false,
        formNameId: '#form-pushki',
        submitButtonDisabled: false,
        messages: {
            required: "Не заполнено обязательное поле!",
            iconStatusErrTitle: "Поле не может быть пустым!"
        }
    });
    $("#form-cond").validatorRM({
        requiredF: [
            'square',
            'topSize'
        ],
        immediately: false,
        formNameId: '#form-cond',
        submitButtonDisabled: false,
        messages: {
            required: "Не заполнено обязательное поле!",
            iconStatusErrTitle: "Поле не может быть пустым!"
        }
    });
    //BUTTONS CALCULATOR
    var calc = $('#calc-power');
    var response = $('#responseI');
    calc.hover(
        function()
        {
            $(this).css('margin-right', '0px');
        },
        function()
        {
            $(this).css('margin-right', '-2px');
        });
    response.hover(
        function()
        {
            $(this).css('margin-left', '-3px');
        },
        function()
        {
            $(this).css('margin-left', '-7px');
        });

    //LOGO LINK
    var logo = $(".logo-block");
    var link = '';
    if(logo.hasClass("block-true") || logo.hasClass("block-false")){
        if(logo.hasClass("block-true"))
        {
            link = loc_admin;
            logo.wrap("<a href='" + link + "'></a>");
        }
        else
        {
            link = loc;
            logo.wrap("<a href='" + link + "'></a>");
        }
    }

    //BACKCALL ..............................................
    var wrap = $('body');
    var title = "Заявка на звонок";
    var text  = '<br>Мы всегда рады предоставить развернутую консультацию. Если Вас интересует что-либо из нашей сферы деятельности – стоимость наших услуг, ассортимент и т.д. – заполните форму, расположенную ниже. Менеджеры свяжутся с Вами вскоре после получения запроса.';
    $('<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalBack" aria-hidden="true" >')
        .append($('<div>').attr("class", "modal-dialog")
            .append($('<div>').attr("class", "modal-content")
                .append($('<div>').attr("class", "modal-header")
                    .append($('<button data-dismiss="modal" aria-hidden="true">').attr({type:"button", class:"close"})
                        .append('&times;'))
                    .append($('<h3 class="modal-title" id="myModalLabel">')
                        .append(title)
                    )
                    .append(text)
                )
                .append($('<div>').attr("class", "modal-body")
                    .append($("<form>").attr({method:'post', id:'blankFormBack', class:'notsend', role:'form'})
                        .append($("<div>").attr("class", "row")
                            .append($("<div>").attr("class", "form-group col-xs-6" )

                                .append($("<label>").attr("for", "nameOrder")
                                    .append("Ваше имя")
                                )
                                .append($("<input name='nameOrder'>").attr({class:"form-control ignore",id:"nameOrder", maxlength:"70", type:"text", placeholder:"Имя"}))
                            )

                        )
                        .append($("<div>").attr("class", "row")
                            .append($("<div>").attr("class", "form-group col-xs-6" )

                                .append($("<label>").attr("for", "phoneOrder")
                                    .append("Контактный телефон<span class='redStar'>*</span>")
                                )
                                .append($("<input name='phoneOrder'>").attr({class:"form-control",id:"phoneOrder", maxlength:"70", type:"text", placeholder:"Телефон"}))
                            )

                        )
                        .append($("<div>").attr("class", "row")
                            .append($("<div>").attr("class", "form-group col-xs-12" )
                                .append($("<label>").attr("for", "caracterOrder")
                                    .append("Ваш вопрос")
                                )
                                .append($("<textarea rows='2' name='caracterOrder'>").attr({id: "caracterOrder", placeholder:"Вопрос", class:"form-control ignore", maxlength:"500"}).css("width", "100%"))
                            )
                        )
                        .append($("<div>").attr({id:"resultOrderBack"}))
                        .append($('<div>').attr({class:"row"})
                            .append($('<div>').attr({class:"col-xs-12"})
                                .append($("<button>").attr({id:"blankButtonBack",disabled:"disabled", class:"btn btn-primary", type:"submit", "data-loading-text":"Подождите..."})
                                    .append("Отправить"))
                                .append($('<button data-dismiss="modal">').attr({class:"btn btn-default"})
                                    .append("Закрыть"))
                            )
                        )

                    )

                )
            )
        )
        .appendTo(wrap);
    var form = $('#blankFormBack'),
        H = $("html"),
        button = $('#blankButtonBack'),
        result = $('#resultOrderBack'),
        order_backcall = $('#order_backcall'),
        calcImg = $('#calcImg'),
        topIndent = calcImg.offset().top + calcImg.height() + 30;
    if(H.height() < 600){
        order_backcall.offset({top:topIndent, left:order_backcall.offset().left});
    };
    //order_backcall.offset({top:topIndent});
    order_backcall.click(function(){
        if(form.hasClass('send')){
            var resultOrderInner = $('#resultOrderInner');
            form.removeClass('send').addClass('notsend').find(resultOrderInner).remove();
        };
    })
    var inputs = form.find('input[type=text],textarea');
    inputs.on("change",function(){
        if(form.hasClass('send')){
            var resultOrderInner = $('#resultOrderInner');
            form.removeClass('send').addClass('notsend').find(resultOrderInner).remove();
        };
    })
    function callBackFunc(data, thisForm, result){
        if(data != ''){
            thisForm.removeClass('notsend').addClass('send');
            thisForm.get(0).reset();
            var mess = '';
            if(data.rez == '1'){
                mess = 'Ваше сообщение отправлено!';
            }
            else{
                mess = 'При отправке сообщения возникли ошибки, поробуйте еще раз!';
            }
            inputs.each(function(){
                $(this).val('').removeClass('valid').siblings('span').remove();
            });
            result.append($("<div>").attr({id:"resultOrderInner"}).text(mess).slideDown(200));
        }
    }
    //............VALIDATOR BACKCALL............................................
    form.validate({
        ignore: ".ignore",
        rules: {
            phoneOrder: {
                digits: true,
                required:true
            }

        },
        messages: {
            phoneOrder: {
                required: "Обязательное поле",
                digits: "Пожалуйста, введите только цифры"
            }

        },
        errorElement: "span",
        success: function(label) {
            label.addClass('valid').append($("<i>").attr({class:"fa fa-check"}));
            button.attr({disabled:false});
            if(form.hasClass('send')){
                var resultOrderInner = $('#resultOrderInner');
                form.removeClass('send').addClass('notsend').find(resultOrderInner).remove();
            };
        },
        submitHandler: function() {
            var btn = $('#blankButtonBack');
            var arr = form.serializeArray();
            btn.button('loading');
            $.ajaxSetup({
                url: loc + "/admin_panel/ajaxFunc.php",
                type: "POST",
                dataType:"json",
                cache:false,
                success: function(data)
                {
                    callBackFunc(data,form,result);
                },
                error: function(obj, err)
                {

                }
            });
            $.ajax({
                data:{
                    num:1,
                    value:arr
                }
            }).always(function () {
                btn.text('Отправить').removeClass('disabled').attr({disabled:false});

            });
        }
    });

    //MODAL LOGIN
    //........................................................
    $('#loginModal').modal({
        keyboard: false,
        backdrop: true,
        show: true
    });
    var close = $(".close, .close-foot");
    close.on('click', function(){
        location.href = loc;
    })
    var login = $("#login-form");
    login.on('click', function(){
        loginForm();
    })
    function loginForm(){
        var arr = $("#loginForm").serializeArray();
        $.ajaxSetup({
            url:"/admin_panel/ajaxFunc.php",
            type: "POST",
            dataType:"json",
            cache:false,
            success: function(data){
                if(data)
                {
                    var password = $("#password");
                    var error_row = $("#error_row");
                    var text = '';
                    var text2 = '';
                    var rez = data.rez;
                    if(error_row) error_row.remove();

                    if(rez == 'ok'){
                        //location.href = 'admin';
                    }
                    else{console.log(data.rez);
                        password.after('<div class="col-lg-6 col-lg-offset-3" id="error_row"><div class=" style3" id="error_mess"></div></div>');
                        var error_mess = $("#error_mess");
                        error_mess.empty();
                        if(rez == 'no'){ console.log('no');
                            text = "неправильный логин или пароль";
                            error_mess.append(text);
                        }
                        else{
                            if(rez == 'empty_login'){
                                text = "не заполнено поле \"логин\"";
                                error_mess.append(text);
                            }
                            else if(rez == 'empty_password'){
                                text = "не заполнено поле \"пароль\"";
                                error_mess.append(text);
                            }
                            else{
                                text = "не заполнено поле \"логин\"" + "<br>";
                                text2 = "не заполнено поле \"пароль\"";
                                error_mess.append(text);
                                error_mess.append(text2);
                            }
                        }
                    }
                }
            },
            error: function(obj, err){

            }
        });
        $.ajax({
            data:{
                num:2,
                arr:arr
            }
        });
    }
    //.....................................................................................
});
$(document).on('click.bs.tab.data-api', '[data-toggle="tab"]', function (e) {
    e.preventDefault();
    clearInterval(intID);
})