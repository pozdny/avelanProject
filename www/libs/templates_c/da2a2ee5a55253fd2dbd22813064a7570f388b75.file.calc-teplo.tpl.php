<?php /* Smarty version Smarty-3.1.18, created on 2014-10-06 16:51:54
         compiled from "libs\templates\inner-tpl\calc\calc-teplo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22165432ac8a241fa9-02988661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da2a2ee5a55253fd2dbd22813064a7570f388b75' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\calc\\calc-teplo.tpl',
      1 => 1406279074,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22165432ac8a241fa9-02988661',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5432ac8a27f723_85208860',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5432ac8a27f723_85208860')) {function content_5432ac8a27f723_85208860($_smarty_tpl) {?><form id="form-pushki" class="form-horizontal calc-form" role="form">
<div class="col-sm-6 col-power calc-verticalline">
	<span class="help-block"><strong>Основные параметры:</strong></span>
    <div class="form-group">
    	<label for="square" class="col-sm-7 control-label">Площадь, м2</label>
    	<div class="col-sm-4 input-box">
      		<input type="text" class="form-control" name="square" id="square" placeholder="м2" title="Пожалуйста, заполните это поле"  maxlength="6"/>    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <div class="form-group">
    	<label for="topSize" class="col-sm-7 control-label">Высота потолков</label>
    	<div class="col-sm-4 input-box">
      		<input type="text" class="form-control" name="topSize" id="topSize" placeholder="м" title="Пожалуйста, заполните это поле" maxlength="6"/>
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <div class="form-group">
    	<label for="tempOut" class="col-sm-7 control-label">t уличного воздуха (фактическая)</label>
    	<div class="col-sm-4 input-box">
      		<input type="text" class="form-control" name="tempOut" id="tempOut" placeholder="C&deg;" title="Пожалуйста, заполните это поле" maxlength="6"/>
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <div class="form-group">
    	<label for="tempIn" class="col-sm-7 control-label">t внутри помещения (желаемая)</label>
    	<div class="col-sm-4 input-box">
      		<input type="text" class="form-control" name="tempIn" id="tempIn" placeholder="C&deg;" title="Пожалуйста, заполните это поле" maxlength="6"/>
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    
    <span class="help-block"><strong>Коэффициэнт рассеивания:</strong></span>
    <div class="col-radio">
    	<div class="radio">
    	<label>
      		<input type="radio" name="radio" value="3.3" checked>
         	Без теплоизоляции<br /><div class="text">Простые деревянные стены или стены из металлического гофролиста</div>
    	</label>
    	</div>
    	<div class="radio">
    	<label>
       		<input type="radio" name="radio" value="1.7">
         	Средняя теплоизоляция<br /><div class="text">Кирпичная кладка в два ряда, малое количество окон, стандартная кровля</div>
    	</label>
    	</div>
    	<div class="radio">
    	<label>
       		<input type="radio" name="radio" value="0.75">
         	Высокая теплоизоляция<br /><div class="text">Кирпичные стены с двойной теплоизоляцией, малое количество окон (стеклопакеты), утепленный пол и кровля.</div>
    	</label>
    	</div>
    	<div class="radio">
    	<label>
       		<input type="radio" name="radio" value="0">
         	Я не знаю какой пункт выбрать<br /><div class="text">За основу берется усредненное значение К рассеивания</div>
    	</label>
    	</div>
    </div>
    <div class="clearfix"></div>
    <input class="btn btn-primary" type="submit" value="Посчитать">
</div>
<div class="col-sm-6 col-power">
	<span class="help-block"><strong>Результат:</strong></span>
    <div class="form-group">
    	<label for="rezcalcSize" class="col-sm-7 control-label">Объем помещения, м3:</label>
    	<div class="col-sm-5">
      		<input type="text" class="form-control text-danger" id="rezcalcSize"  readonly="readonly" />
    	</div>
  	</div>
    <div class="form-group">
    	<label for="rezcalcPower" class="col-sm-7 control-label">Мощность тепловой пушки, кВт:</label>
    	<div class="col-sm-5">
      		<input type="text" class="form-control text-danger" id="rezcalcPower"  readonly="readonly" />
    	</div>
  	</div>
</div>
</form><?php }} ?>
