<?php /* Smarty version Smarty-3.1.18, created on 2014-10-04 14:23:02
         compiled from "libs\templates\inner-tpl\tables\table-rash.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21040542fe6a6e11d37-94637585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6eff0dcb3c27aedcf76302b47c253938d53100b2' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\tables\\table-rash.tpl',
      1 => 1412424628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21040542fe6a6e11d37-94637585',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_price' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_542fe6a6e168f7_92528941',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542fe6a6e168f7_92528941')) {function content_542fe6a6e168f7_92528941($_smarty_tpl) {?><table class="table table-bordered table-condensed tab_h">
<tr><th>Наименование товара</th><th>Ед.изм.</th><th>Цена (диллер. руб.)</th></tr>
<?php echo $_smarty_tpl->tpl_vars['content_price']->value;?>

</table>
<?php }} ?>
