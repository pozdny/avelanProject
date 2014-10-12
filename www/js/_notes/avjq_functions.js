// JavaScript Document
$(document).ready(function(){
var loc1= "http://www.localhost/avelan";
var loc_admin1= "http://www.localhost/avelan/admin";
var loc  = "http://xn--80aafm4an.xn--p1ai";
var loc_admin  = "http://xn--80aafm4an.xn--p1ai/admin";
var i = 0;
var fancyW   = 600;
var fancyH   = 400;
var speedIn  = 500;
var speedOut = 500;
var flagModal = false;
// создание всплывающего сабменю
var span = $('span');
var menutitle       = $(".menutitle, .menuActiv");
var SubsubmenuActiv = $('.SubsubmenuActiv, .Subsubmenu');
var divPass = $('.divPass, .divActiv');
var block_katalog = $("#block_katalog");
var fixed_div     = $('#fixed-div');
var fixed_div_pos = null;
var fixed_div_ptop = 0;
var h = 0;
var nameclass = '';
$(".menu_lit").hover(
function(){$(this).addClass('menuhover');},
function(){$(this).removeClass('menuhover');
});
span.each(function()
{
	nameclass = $(this).attr('class'); 
	if(nameclass == 'submenuActiv' || nameclass == 'submenu')
	{
		var li = $('.submenuActiv li, .submenu li');
		var elem;
		li.each(function(i)
		{
			
			var get_offset;
			var get_top;
			var get_left;
			var hoverelem = $(this);
			$(this).hover(
			function()
			{
				
				var get_position = null;
				var get_offset   = null;
				var get_offtop   = 0;
				var get_postop   = 0;
				var get_posleft  = 0;
				var vipad_elem   = null;
				var this_h       = 0;
				var sum_h        = 0;
				var zazor        = 0;
				
				fixed_div_pos = fixed_div.offset();
				fixed_div_ptop = fixed_div_pos.top + 1;  
				h = fixed_div_ptop;
				
				get_position = $(this).position();
				get_offset = $(this).offset();
				get_offtop = get_offset.top;
				get_postop = get_position.top; 
				get_posleft = get_position.left;
				
				elem = $(this).attr('class'); 
				get_postop-=5;
				get_postop+='px';
				
				if(elem == 'li' || elem == 'liActiv')
				{
					vipad_elem = $(this).parent().next('span'); 
					SubsubmenuActiv.each(function()
				    {
						$(this).css('display', 'none');
					});
					vipad_elem.removeClass('Subsubmenu').addClass('SubsubmenuActiv');
					this_h = vipad_elem.height();
					sum_h = get_offtop + this_h;
					zazor = h - sum_h; 
					if(zazor < 0)
					{
						zazor = Math.abs(zazor);
						get_postop = get_position.top;
						get_postop = get_postop - 5 - zazor;
						get_postop+='px';
					}
					vipad_elem.css('display', 'block')
					.css('left','270px')
					.css('top', get_postop);					
					
				}
			
			},
			function()
			{
				elem = $('.menu_litin'); 
				elem.hover(
				function()
				{
					hoverelem.parent().parent().find('span').attr('class', 'Subsubmenu').css('display', 'none');
						
				},
				function()
				{
				});
				
			});
		});
	}
});

SubsubmenuActiv.hover(
function(){},
function()
{
	$(this).css('display', 'none');
});

block_katalog.hover(
function(){},
function()
{
	SubsubmenuActiv.css('display', 'none').removeClass('SubsubmenuActiv').addClass('Subsubmenu');
});
menutitle.bind("mouseover",function()
{
	SubsubmenuActiv.css('display', 'none').removeClass('SubsubmenuActiv').addClass('Subsubmenu');
});
divPass.hover(
function()
{
	$(this).css('background', '#e5e6e7');
},
function()
{
	var SubsubmenuActiv = $('.SubsubmenuActiv, .Subsubmenu');
	var prev;
	SubsubmenuActiv.hover(
	function()
	{
		prev = $(this).prev().css('background', '#e5e6e7');
	},
	function()
	{
		prev = $(this).prev().css('background', '#F6F5F5');
	});
	$(this).css('background', '#F6F5F5');
});

/*.............создание лупы при наведении на картинку........*/
$(".img_block, .img_block_serv, .img_block_cat, .img_block_rash").hover(
function()
{
	var num = $(this).attr("id");
	num = num.substr(4);
	$("#lupa2_" + num).addClass("fancyover");
	
},
function()
{
	num = $(this).attr("id");
	num = num.substr(4);
	$("#lupa2_" + num).removeClass("fancyover");
	
}
);
$(".img_R").hover(
function()
{
    var lupa = $(this).find(".lupa");
    lupa.addClass("fancyoverR");
    /*var num = $(this).parent().attr("id");
	num = num.substr(4);
	$("#lupa2_" + num).addClass("fancyoverR");*/
	
},
function()
{
    var lupa = $(this).find(".lupa");
    lupa.removeClass("fancyoverR");
    /*num = $(this).parent().attr("id");
	num = num.substr(4);
	$("#lupa2_" + num).removeClass("fancyoverR");*/
	
}
);

//Activate FancyBox
$('#respImg').bind('click', function()
{
	fancyW   = 670;
	fancyH   = 410;
	speedIn  = false;
	speedOut = false;
	flagModal = true;
	//Activate FancyBox
	$("a#responseI").fancybox({
		"zoomSpeedIn":		speedIn,
		"zoomSpeedOut":		speedOut,
		"frameWidth":		fancyW,
		"frameHeight":		fancyH,
		"overlayShow":		true,
		"overlayOpacity":   0.4,
		"centerOnScroll":   true,
		"flagModal":        flagModal
      });
});
$(".img_block a, .img_block_serv a, .img_block_cat a, .img_R a").fancybox(
{
		"overlayShow":		true,
		"overlayOpacity":   0.4,
		"centerOnScroll":   true,
		'hideOnContentClick': true,
		"flagModal":        false
});

$("a.fancyover").fancybox(
{
		"overlayShow":		true,
		"overlayOpacity":   0.4,
		"centerOnScroll":   true,
		'hideOnContentClick': true,
		"flagModal":        false
});
$(document).pngFix();
//......создание ссылок вокруг блоков с картинками на главной
/*
var block_img;
var elem_in;
var link_str;
var block_img_id;
var action;
for(i=1; i<6; i++)
{
	block_img = $(".getBlock_big_" + i);
	block_img_id = block_img.attr('id');
	if(block_img_id)
	{
		block_img_id = block_img_id.substr(3);
		if(block_img_id == 'services')
		{
			action = 'services';
			link_str = action;
		}
		else
		{
			action = 'catalog';
			link_str = action + '/' + block_img_id;
		}
	
		elem_in = '<a href="' + loc + '/' + link_str + '" ></a>';
		block_img.wrap(elem_in);
	}
}
*/
//создание ссылки и логотипа
var logo = $("#logo");
var logo_class = $("#logo").attr("class");
var link_a;
if(logo_class == "block_true")
{
	link_a = loc_admin;
	logo.wrap("<a href='" + link_a + "'></a>");
}
else
{
	
	link_a = loc;
	logo.wrap("<a href='" + link_a + "'></a>");
}

//создание полос в таблице
$(".table_price tr:odd").addClass("alt");

//замена placeholder
var search_tovar = $("#search_tovar");
var txt = 'поиск...';
search_tovar.addClass('placeholded').val(txt);
search_tovar.focus(function()
{
	$(this).val('');
}).blur(function()
{
});
///////////////////////////////////////////////////////////////////////////////////////////////
//левое меню
var menu_lit        = $(".menutitle .menu_lit");
var submenuActiv_li = $(".submenu .divPass, .submenuActiv .divPass, .submenuActiv .divActiv");
var submenuActiv_subli = $(".submenu .Subsubmenu ul li, .submenuActiv .SubsubmenuActiv ul li, .submenuActiv .Subsubmenu ul li");
var menu_id      = '';
var adress       = '';
var kat          = '';
menutitle.each(function()
{
	$(this).click(function()
	{
		menu_id = $(this).attr('id');
		adress = '';
		kat = menu_id.substr(1, 1); 
		menu_id = menu_id.substring(3);
		if(kat == 0)
		{
			adress = 'catalog';
            return false;
		}
		else if(kat == 1)
		{
			adress = 'services';
		}
		else
		{
			adress = 'nashi_raboty';
		}
		location.href = loc + '/' + adress + '/' + menu_id;
	});		
});
submenuActiv_li.click(function()
{
		var menu_id = $(this).parent().parent().prev().attr("id");
		menu_id = menu_id.substring(3);
		var submenu_id = $(this).attr("id");
		var id_pos = submenu_id.indexOf('_');
		var submenu_id = submenu_id.substring(id_pos+1); 
		var str = loc + '/catalog/' + menu_id + '/' + submenu_id; 
		location.href = str;
});
submenuActiv_subli.click(function()
{
	    var submenu_idB = $(this).parent().parent().parent().prev();
		var submenu_id = submenu_idB.attr('id');
		var pos = submenu_id.indexOf('_');
		submenu_id = submenu_id.substring(pos+1);
		var menu_id = submenu_idB.parent().parent().prev().attr('id');
		pos = menu_id.indexOf('_');
		menu_id = menu_id.substring(pos+1); 
		var subsubmenu_id = $(this).attr("id");
		pos  = subsubmenu_id.indexOf('_');		
		var subsubmenu_id = subsubmenu_id.substring(pos+1); 
		var str = loc + '/catalog/' + menu_id + '/' + submenu_id + '/' + subsubmenu_id; 
		location.href = str;
	
});
//кнопка калькулятора
var calc = $('#calc-power');
var response = $('#responseI');
calc.hover(
function()
{
	$(this).css('margin-right', '-3px');
},
function()
{
	$(this).css('margin-right', '-5px');
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
//..................................................................calc-plagin
$('#form-pushki').mySimplePlugin({calcName:'pushki'});
$('#form-cond').mySimplePlugin({calcName:'cond'});
//..................................................................валидация формы
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
}); 
