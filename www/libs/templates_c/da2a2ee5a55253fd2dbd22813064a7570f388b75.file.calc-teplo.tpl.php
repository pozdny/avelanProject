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
	<span class="help-block"><strong>�������� ���������:</strong></span>
    <div class="form-group">
    	<label for="square" class="col-sm-7 control-label">�������, �2</label>
    	<div class="col-sm-4 input-box">
      		<input type="text" class="form-control" name="square" id="square" placeholder="�2" title="����������, ��������� ��� ����"  maxlength="6"/>    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <div class="form-group">
    	<label for="topSize" class="col-sm-7 control-label">������ ��������</label>
    	<div class="col-sm-4 input-box">
      		<input type="text" class="form-control" name="topSize" id="topSize" placeholder="�" title="����������, ��������� ��� ����" maxlength="6"/>
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <div class="form-group">
    	<label for="tempOut" class="col-sm-7 control-label">t �������� ������� (�����������)</label>
    	<div class="col-sm-4 input-box">
      		<input type="text" class="form-control" name="tempOut" id="tempOut" placeholder="C&deg;" title="����������, ��������� ��� ����" maxlength="6"/>
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <div class="form-group">
    	<label for="tempIn" class="col-sm-7 control-label">t ������ ��������� (��������)</label>
    	<div class="col-sm-4 input-box">
      		<input type="text" class="form-control" name="tempIn" id="tempIn" placeholder="C&deg;" title="����������, ��������� ��� ����" maxlength="6"/>
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    
    <span class="help-block"><strong>����������� �����������:</strong></span>
    <div class="col-radio">
    	<div class="radio">
    	<label>
      		<input type="radio" name="radio" value="3.3" checked>
         	��� �������������<br /><div class="text">������� ���������� ����� ��� ����� �� �������������� ����������</div>
    	</label>
    	</div>
    	<div class="radio">
    	<label>
       		<input type="radio" name="radio" value="1.7">
         	������� �������������<br /><div class="text">��������� ������ � ��� ����, ����� ���������� ����, ����������� ������</div>
    	</label>
    	</div>
    	<div class="radio">
    	<label>
       		<input type="radio" name="radio" value="0.75">
         	������� �������������<br /><div class="text">��������� ����� � ������� ��������������, ����� ���������� ���� (������������), ���������� ��� � ������.</div>
    	</label>
    	</div>
    	<div class="radio">
    	<label>
       		<input type="radio" name="radio" value="0">
         	� �� ���� ����� ����� �������<br /><div class="text">�� ������ ������� ����������� �������� � �����������</div>
    	</label>
    	</div>
    </div>
    <div class="clearfix"></div>
    <input class="btn btn-primary" type="submit" value="���������">
</div>
<div class="col-sm-6 col-power">
	<span class="help-block"><strong>���������:</strong></span>
    <div class="form-group">
    	<label for="rezcalcSize" class="col-sm-7 control-label">����� ���������, �3:</label>
    	<div class="col-sm-5">
      		<input type="text" class="form-control text-danger" id="rezcalcSize"  readonly="readonly" />
    	</div>
  	</div>
    <div class="form-group">
    	<label for="rezcalcPower" class="col-sm-7 control-label">�������� �������� �����, ���:</label>
    	<div class="col-sm-5">
      		<input type="text" class="form-control text-danger" id="rezcalcPower"  readonly="readonly" />
    	</div>
  	</div>
</div>
</form><?php }} ?>
