<?php /* Smarty version Smarty-3.1.18, created on 2014-10-15 09:21:58
         compiled from "admin_panel\libs\templates\inner-tpl\infoMessage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20728543e1d65433c26-21021826%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50b70da1e7adf848338cdd07c7daa029c3143fb9' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\infoMessage.tpl',
      1 => 1413357680,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20728543e1d65433c26-21021826',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543e1d655c2700_07612047',
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543e1d655c2700_07612047')) {function content_543e1d655c2700_07612047($_smarty_tpl) {?><div id="infoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Информация</h4>
            </div>
            <div class="modal-body">
                <p class="text-center"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><?php }} ?>
