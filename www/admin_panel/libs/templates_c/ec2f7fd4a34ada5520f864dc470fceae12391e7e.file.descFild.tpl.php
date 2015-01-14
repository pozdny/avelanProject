<?php /* Smarty version Smarty-3.1.18, created on 2014-10-27 16:43:51
         compiled from "admin_panel\libs\templates\inner-tpl\dif-tab\descFild.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27728544e67e8264d95-64079583%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec2f7fd4a34ada5520f864dc470fceae12391e7e' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\dif-tab\\descFild.tpl',
      1 => 1414424630,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27728544e67e8264d95-64079583',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544e67e83149b7_75895381',
  'variables' => 
  array (
    'desc_name' => 0,
    'desc_content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544e67e83149b7_75895381')) {function content_544e67e83149b7_75895381($_smarty_tpl) {?><div class="row form-group">
    <div class="col-xs-2">
        <strong>Описание:</strong>
    </div>
    <div class="col-xs-10">
        <textarea class="form-control" rows="3" name="<?php echo $_smarty_tpl->tpl_vars['desc_name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['desc_content']->value;?>
</textarea>
    </div>
</div><?php }} ?>
