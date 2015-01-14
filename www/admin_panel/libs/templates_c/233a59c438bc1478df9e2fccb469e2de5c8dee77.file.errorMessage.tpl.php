<?php /* Smarty version Smarty-3.1.18, created on 2014-10-20 12:21:59
         compiled from "admin_panel\libs\templates\inner-tpl\errorMessage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:283285444e18a6f8127-44486158%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '233a59c438bc1478df9e2fccb469e2de5c8dee77' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\errorMessage.tpl',
      1 => 1413800516,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '283285444e18a6f8127-44486158',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5444e18a7343b5_86069598',
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5444e18a7343b5_86069598')) {function content_5444e18a7343b5_86069598($_smarty_tpl) {?><div id="infoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ошибка</h4>
            </div>
            <div class="modal-body">
                <p class="text-center"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><?php }} ?>
