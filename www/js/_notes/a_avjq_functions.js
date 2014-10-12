// JavaScript Document
$(document).ready(function(){
var loc1 = 'http://www.localhost/avelan';
var loc_admin1 = "http://www.localhost/avelan/admin";
var loc = 'http://xn--80aafm4an.xn--p1ai';
var loc_admin = "http://xn--80aafm4an.xn--p1ai/admin";
var total = 0;
var total_img = 0;
//add input
add_new_input();
add_new_img();
//эфферк свертывания в админ.панели
/*.................
$("#a_main_page").bind("click", function(){
		animatedcollapse.toggle('a_wrap_main_p');
		animatedcollapse.hide('a_wrap_main_c');
		animatedcollapse.hide('a_wrap_main_t');
});
$("#a_main_page_c").bind("click", function(){
		animatedcollapse.toggle('a_wrap_main_c');
		animatedcollapse.hide('a_wrap_main_p');
		animatedcollapse.hide('a_wrap_main_t');
});
$("#a_main_page_t").bind("click", function(){
		animatedcollapse.toggle('a_wrap_main_t');
		animatedcollapse.hide('a_wrap_main_c');
		animatedcollapse.hide('a_wrap_main_p');
});
*/
//.......................................................
$("#infoDialog #dialog").dialog({
	width:350,
	modal: true
	});
$("#dialog table td").css("text-align", "left");
window.setTimeout('$("#infoDialog #dialog").dialog(\"close\")',3000);

// форма ЛОГИН
$("#loginDialog #dialog").dialog({
	width:450,
	title: "Введите логин и пароль",
	modal: true,
	closeOnEscape:false,
	draggable:false,
	buttons:
	{
		"Вход":function()
		{
			loginForm();
		},
		"Отмена":function()
		{
			document.location = loc;
		}
		
	}
	
	});
$(".ui-dialog-titlebar-close").hide();
$(".zebra_order tr:nth-child(2n+2)").addClass("alt");

//....................................................


$("#deleteForm").bind("click", function(){
		
		$.confirm({
			'title'		: 'Подтверждение удаления',
			'message'	: 'Вы решили удалить пункт. <br />После удаления его нельзя будет восстановить! Продолжаем?',
			'buttons'	: {
				'Да'	: {
					'class'	: 'blue',
					'action': function(){
						DelButton1();
					}
				},
				'Нет'	: {
					'class'	: 'gray',
					'action': function(){
						
						}	// В данном случае ничего не делаем. Данную опцию можно просто опустить.
				}
			}
		});
	
	});
//..................Добавление акции.....................
var color_line = $(".a_color_line");
if(color_line.text() == 'Товары')
{
var check_length = $(":checkbox").length;
var array      = [];
var id       = '';
var this_id  = '';
var a_length = 0;
var a        = false;

for(var j=1; j<=check_length; j++)
{ 
	if($("#check_" + j).attr("checked") == 'checked')
	{
		id = $("#check_" + j).attr("value");
		array.push(id);
	}
}

$(":checkbox").bind("click", function()
{
	this_id = $(this).attr("value");
	a_length = array.length;

	for(var i=0; i<a_length; i++)
	{
		if(this_id == array[i])
		{
			a = true;
			break;
		}
		else
		{
			
			a = false;
		}
	}
	if(a)
	{
		PutAction(this_id, '0', 'catalog_all');
	}
	else
	{
		PutAction(this_id, '1', 'catalog_all');
	}
	
});
}

/*..............shadule....................................*/
var shadule = $("#table_shadule input");
var shadule_id;
var arr = [];
for(var i=0, count=shadule.length; i<count; i++)
{
	shadule_id = shadule.eq(i).attr("id");
	arr.push(shadule_id);
}
$("#table_shadule input").change(function()
	{
		for(var i = 0; i<arr.length; i++)
		{
			if($(this).attr("id") == arr[i])
			{
				CompanyInfo($(this).attr("id"));
			}
		}
	});

/*.................изменение данных в счетчиках.................*/
$("#schet_1, #schet_2, #schet_3").change(function()
{
	var data = $(this).attr("id");
	CompanySchet(data);
}
);
/*..............select order....................................*/


$(".desc_select option").click(function()
{
	var select_elem = $(this).closest("select");
	var id_prod = select_elem.attr("id");
	var id_now = select_elem.attr("name");
	id_now = id_now.substr(2); 
	PersonInfo($(this).attr("value"), id_prod, id_now, 3);
	
});

 
/*..............person order....................................*/

	var order = $("#table_order");
	var person = $("#table_order input");
	var order_id = $("#order_id").attr("value");
	var person_id;
	var arr_person = [];
	for(var i=0, count=person.length; i<count; i++)
	{
		person_id = person.eq(i).attr("id");
		arr_person.push(person_id);
	}
	$("#table_order input").change(function()
	{
		
		for(var i = 0; i<arr_person.length; i++)
		{
			if($(this).attr("id") == arr_person[i])
			{
				PersonInfo($(this).attr("id"), order_id, '',  1);
			}
		}
	});
	$("#table_order textarea").change(function()
	{
		PersonInfo($(this).attr("id"), order_id, '',  1);
	});
	$("#select_fild option").click(function()
	{
		PersonInfo(this.value, order_id, '', 2);
	});
/*............добавление input...........................*/

$("#button_add_input").bind("click", function()
{
	return add_new_input();
});


function add_new_input()
{
	total++;
	$('<tr>').attr('id','trinput_'+total).css({lineHeight:'20px'})
	.append($('<td>').attr('id','tdinput_'+total).css({paddingRight:'5px',width:'60%'})
	.append($('<input type="text" />').css({width:'400px'}).attr('id','input_'+total).attr('name','addinput[input_'+total+']')))
	.append($('<td>').css({width:'60px'})
	.append($('<span id="progress_'+total+'" class="padding5px"><a href="#" onclick="$(\'#trinput_'+total+'\').remove();" class="ico_delete"><img src="'+loc+'/img/icon/delete.png" alt="del" border="0"></a></span>')))
	.appendTo('#add_input');                
}
/*............добавление поля для изображения...........................*/

$("#button_add_img").bind("click", function()
{
	return add_new_img();
});


function add_new_img()
{
	var block_img;
	var table_add_img = $('#table_add_img');
	var div_big;
	var class_tableImg = table_add_img.attr("class");
	var div_big = $('<div>').attr('class','big_block_img').attr('id','big_block_img_'+total_img);
	div_big.appendTo(table_add_img);
	block_img = $('<tr>').css({lineHeight:'20px'})
	   .append($('<td>').attr('id','tdimg_'+total_img).css({paddingRight:'5px'})
			.append($('<div class="div_name_img">Изображение*:</div><br />'))
			.append($('<input type="file" />').css({width:'460px'}).attr('id','img_'+total_img).attr('name','addimg[img_'+total_img+']').attr('size','60'))
			)												
	
	.append($('<td>')
	         .append($('<span id="progressimg_'+total_img+'" class="padding5px"><a href="#" onclick="$(\'#big_block_img_'+total_img+'\').remove();" class="ico_delete"><img src="'+loc+'/img/icon/delete.png" alt="del" border="0"></a></span>'))
		    )
	
	.appendTo(div_big); 
	
	block_img = $('<tr>').css({lineHeight:'20px'})
	   .append($('<td>').attr('id','td_alt_'+total_img).css({paddingRight:'5px',width:'100%'}).attr('colspan','2')
			.append($('<div class="div_name_img">alt*:</div><br />'))
			.append($('<input type="text" />').css({width:'460px'}).attr('name','addimg[alt_'+total_img+']').attr('size','60'))
			)												
	
	.appendTo(div_big); 
	
	block_img = $('<tr>').css({lineHeight:'20px'})
	        .append($('<td>').attr('id','td_title_'+total_img).css({paddingRight:'5px',width:'100%'}).attr('colspan','2')
			.append($('<div class="div_name_img">title*:</div><br />'))
			.append($('<input type="text" />').css({width:'460px'}).attr('name','addimg[title_'+total_img+']').attr('size','60'))
			)												
	
	.appendTo(div_big); 
	block_img = $('<tr>').css({lineHeight:'20px'})
	   .append($('<td>').attr('id','td_select_'+total_img).css({paddingRight:'5px',width:'100%'}).attr('colspan','2')
			.append($('<div class="div_name_img">Производитель*:</div><br />'))
			.append($('<select type="text">').attr('name','addimg[select_'+total_img+']')
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
	if(class_tableImg == 'tabImgJob')
	{
		block_img = $('<tr>').css({lineHeight:'20px'})
	   .append($('<td>').attr('id','td_desc_'+total_img).css({paddingRight:'5px',width:'100%'}).attr('colspan','2')
			.append($('<div class="div_name_img">Описание фото*:</div><br />'))
			.append($('<textarea />').css({width:'460px'}).attr('name','addimg[desc_'+total_img+']').attr('size','60'))
			)												
	
		.appendTo(div_big); 
	}
	total_img++;
	
	
	
	
}

/*...................................................*/
/*...............hover для меню.....................*/
$(".menu_lit").hover(
function(){$(this).addClass('menuhover');},
function(){$(this).removeClass('menuhover');
});
/*.................................................................*/
//скидка 5%
var discount = $("#discount_card");
if(discount)
{
	var text = $("td#busk_sum").find("span").eq(1).html();
	if(discount.attr("checked") == "checked")
	{		
		$("td#busk_sum").find("span").eq(1).html(text + ", <u>со скидкой 5%</u>");
	}
	else
	{
		text = " (без учета стоимости доставки)";
		$("td#busk_sum").find("span").eq(1).html(text);
	}
}
$("#discount_card").click(
function()
{	
	var text = $("td#busk_sum").find("span").eq(1).html();
	var id;
	if(this.checked)
	{
		id = this.value;
		PutAction(id, '1', 'orders');
		$("td#busk_sum").find("span").eq(1).html(text + ", <u>со скидкой 5%</u>");
		
	}
	else
	{
		id = this.value;
		PutAction(id, '0', 'orders');
		text = " (без учета стоимости доставки)";
		$("td#busk_sum").find("span").eq(1).html(text);
	}
			
}
);
/*..............order все поля делаем disabled....................................*/
var o_input = $("#formOrder input");
var o_select = $("#formOrder select");
for(var i=0, count=o_input.length; i<count; i++)
{
	o_input.eq(i).attr("disabled", "disabled");
}
for(var i=0, count=o_select.length; i<count; i++)
{
	o_select.eq(i).attr("disabled", "disabled");
}

/*..............shadule and info-site....................................*/
$("#company_name, #company_phone, #company_address, #company_mail").change(function()
{
	var data = $(this).attr("id"); 
	CompanyInfo(data);
}
);

var shadule = $("#table_shadule input");
var shadule_id;
var arr = [];
for(var i=0, count=shadule.length; i<count; i++)
{
	shadule_id = shadule.eq(i).attr("id");
	arr.push(shadule_id);
}
$("#table_shadule input").change(function()
	{
		for(var i = 0; i<arr.length; i++)
		{
			if($(this).attr("id") == arr[i])
			{
				CompanyInfo($(this).attr("id"));
			}
		}
	});
//подключение эффектов при нажатии на чекбокс
function effect_result(data)
{
	
}
var effect  = $('#girld, #effect');
effect.on("click", function()
{
	var id = $(this).attr('id');
	var checked = $(this).attr('checked'); 
	var zn = 'off';
	if(checked == 'checked')
	{
		zn = 'on';
	}
	$.ajaxSetup({
		   url:loc + "/admin_panel/admin_edit.php",
		   type: "POST",
		   dataType:"html",
		   success: function(html)
		   {
			   effect_result(html);
		   },
		   error: function(obj, err)
		   {
			   
		   }
		   });
	$.ajax({
			 data:{company:'company', 
			       id:id,
				   zn:zn
				   }
			});
	
});
//...................изменение статуса сообщений.............................//
var new_mess        = $('.new_mess');
var tr              = null;
var new_mess_id     = '';
var new_messSpan    = $('.new_messSpan');
var new_messSpanVal = '';
var img_src         = '';
function stat_change(data)
{
	var new_messSpan1 = new_messSpan.eq(0);
	new_messSpanVal = Number(new_messSpan1.html());
	if(new_messSpanVal !=0)
	{
		new_messSpanVal = String(new_messSpanVal-1);
		new_messSpan.each(function()
		{
			new_messSpan.html(new_messSpanVal);
		});
	}
}
new_mess.bind('click', function()
{
	tr = $(this).parents('tr');
	new_mess_id = $(this).attr('id');
	new_mess_id = new_mess_id.substr(5);
	tr.removeClass().addClass('submenu_td3');
	img_src = $(this).find('img').attr('src', '../img/icon/close_order.gif'); 
	$(this).removeClass();
	$.ajaxSetup({
		url:loc + "/check_view",
		type: "GET",
		dataType:"html",
	    cache:false,
		success: function(data)
		{
			stat_change(data);
		},
		error: function(obj, err)
		{
			alert(err);   
		}
	});
	$.ajax({
		data:
		{
			num:7,
			id:new_mess_id
		}
	});
	
});});
