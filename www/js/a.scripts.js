/**
 * Created by Valentina on 13.10.14.
 */
$(document).ready(function() {
    var loc = "http://" + location.hostname;
    error = 'ошибка';
    //ADD INPUTS...........................
    var total = 0;
    var total_img = 0;
    add_new_input();
    var button_add_input = $('#button_add_input');
    button_add_input.on("click", function()
    {
        return add_new_input();
    });
    function add_new_input()
    {
        total++;
        var table_add_img = $('#add_input');
        var div_big = $('<div>').attr('class','big_block').attr('id','big_block_'+total);
        div_big.appendTo(table_add_img);
        $('<div>').attr('class','row form-group')
            .append($('<div>').attr('class','col-xs-3')
                .append($('<strong>Назавание позиции*:</strong>'))
            )
            .append($('<div>').attr('class','col-xs-8')
                .append($('<input type="text" />').attr('class', 'form-control input-sm').attr({'name':'addinput[]', 'id':'addinput[]'}))
            )
            .append($('<div>').attr('class','col-xs-1')
                .append($('<div>').attr('class','del_div')
                    .append($('<span id="progress_'+total+'" class="padding5px"><a href="#" onclick="$(\'#big_block_'+total+'\').remove();" class="ico_delete"><img src="' + loc + '/img/icons/delete.png" alt="del"></a></span>'))

            ))
            .appendTo(div_big);

    }
    /*............add input for images...........................*/
    add_new_img();
    //ADD IMG...............................

    $("#button_add_img").on("click", function(){
        return add_new_img();
    });

    function add_new_img(){
        var table_add_img = $('#table_add_img');
        var class_tableImg = table_add_img.attr("class");
        var div_big = $('<div>').attr('class','big_block_img').attr('id','big_block_img_'+total_img);
        div_big.appendTo(table_add_img);
        $('<div>').attr('class','row form-group')
            .append($('<div>').attr('class','col-xs-2')
                .append($('<strong>Изображение*:</strong>'))
            )
            .append($('<div>').attr('class','col-xs-10')
                .append($('<input type="file" />').attr('id','img_'+total_img).attr('name','addimg[img_'+total_img+']'))
            )
            .appendTo(div_big);

        $('<div>').attr('class','row form-group')
            .append($('<div>').attr('class','col-xs-2')
                .append($('<strong>Alt*:</strong>'))
            )
            .append($('<div>').attr('class','col-xs-10')
                .append($('<input type="text" />').attr('class', 'form-control input-sm').attr('name','addimg[alt_'+total_img+']'))
            )
            .appendTo(div_big);

        $('<div>').attr('class','row form-group')
            .append($('<div>').attr('class','col-xs-2')
                .append($('<strong>Img_title*:</strong>'))
            )
            .append($('<div>').attr('class','col-xs-10')
                .append($('<input type="text" />').attr('class', 'form-control input-sm').attr('name','addimg[title_'+total_img+']'))
            )
            .appendTo(div_big);


        $('<div>').attr('class','del_div_big')
            .append($('<span id="progressimg_'+total_img+'" class="padding5px"><a href="#" onclick="$(\'#big_block_img_'+total_img+'\').remove();" class="ico_delete"><img src="http://stelsib.ru/img/icons/delete.png" alt="del" border="0"></a></span>'))

            .appendTo(div_big);
        if(table_add_img.hasClass('tabImgProd')){
            $('<div>').attr('class','row form-group')
                .append($('<div>').attr('class','col-xs-2')
                    .append($('<strong>Производитель:</strong>'))
                )
                .append($('<div>').attr('class','col-xs-10')
                    .append($('<select class="form-control">').attr('name','addimg[select_'+total_img+']')
                        .append($('<option value="0" >не выбран</option>'))
                        .append($('<option value="1">Roda</option>'))
                        .append($('<option value="2">Ballu</option>'))
                        .append($('<option value="3">Lessar</option>'))
                        .append($('<option value="4">Electrolux</option>'))
                        .append($('<option value="5">Panasonic</option>'))
                        .append($('<option value="6">Тропик</option>'))
                        .append($('<option value="7">Тепломаш</option>'))
                        .append($('<option value="8">NEOCLIMA</option>'))
                        .append($('<option value="9">Дизель</option>')))
                )
                .appendTo(div_big);
        }
        if(table_add_img.hasClass('tabImgJob')){
            $('<div>').attr('class','row form-group')
                .append($('<div>').attr('class','col-xs-2')
                    .append($('<strong>Описание:</strong>'))
                )
                .append($('<div>').attr('class','col-xs-10')
                    .append($('<textarea rows="3">').attr('class', 'form-control').attr('name','addimg[desc_'+total_img+']'))

                )
                .appendTo(div_big);
        }
        total_img++;
    }
    //DELETE ELEMENT
    var del_elem = $('#button_del');
    del_elem.on("click", function(){
        var form = $("#formElements");
        var arr = form.serializeArray();
        var tab = form.attr("class");
        var num = 4;
        // var arr = [];
        var id = '';
        var checkbox = form.find("input[name='del[]']:checked");
        // checkbox.each(function(){
        //     arr.push(this.value);

        // })
        if(checkbox.length){
            var text = 'Вы действительно хотите удалить отмеченные позиции?';
            if(confirm(text)){
                editForm(num, id, arr, tab);

            }
        }

    })
    //ADD ELEMENT
    var button_send_element = $('#button_add');
    button_send_element.on("click", function(){
        var form = $("#formAddElements");
        var arr = form.serializeArray();
        var id = $("#add_id").attr('value');
        var num = 5;
        var tab = form.attr("class");
        editForm(num, id, arr, tab);

    })
    //EDIT DATA
    var button_edit = $('#button_edit');
    button_edit.on("click", function(){
        var form = $("#editForm");
        var tab_class = form.attr('class');
        var arr_class = tab_class.match(/\w+|"[^"]+"/g);
        var tab = arr_class[0]; //alert(tab);
        var num = 6;
        var arr = form.serializeArray();
        var id = $("#edit_id").attr('value');
        editForm(num, id, arr, tab);

    })
    //DEL POSITION
    var del_button = $('.del_button');
    del_button.each(function(){
        $(this).click(function(){
            var arr = $("#dif_tab").attr("class");
            var num = 4;
            var id = $(this).attr('id');
            $(this).removeClass('del_button');

            var table = $(this).attr('class');
            var text;
            if(table=='catalog_menu_main')
            {
                text = 'При удалении категории будут также удалены все связанные с ней таблицы. Вы действительно хотите удалить позицию?';
            }
            else if(table=='catalog_submenu_main')
            {
                text = 'При удалении подкатегории будут также удалены все связанные с ней таблицы. Вы действительно хотите удалить позицию?';
            }
            else if(table=='catalog_all_main')
            {
                text = 'Вы действительно хотите удалить позицию?';
            }
            else
            {
                text = 'Вы действительно хотите удалить позицию?';
            }
            if(confirm(text))
            {
                editForm(num, id, arr, table);
            }
        })

    })
    //AJAX
    function editForm(num, id, arr, table){
        $.ajaxSetup({
            url: "/check_view",
            type: "POST",
            dataType:"json",
            cache:false,
            success: function(data)
            {
                if(data != ''){
                    if(data.error !=''){
                        alert(data.error);
                    }
                    else{
                        var link = data.link;
                        document.location = loc + link;
                    }

                }
                else{
                    alert(error);
                }
            },
            error: function(obj, err)
            {

            }
        });
        $.ajax({
            data:{
                num:num,
                id:id,
                value:arr,
                table:table
            }
        });
    }

    //MODAL INFOMESSAGE
    //........................................................
    $('#infoModal').modal({
        keyboard: false,
        backdrop: true,
        show: true
    });

    $('#loadButton').click(function () {
        var btn = $(this)
        btn.button('loading').always(function () {
            btn.button('reset')
        });
    });
});
