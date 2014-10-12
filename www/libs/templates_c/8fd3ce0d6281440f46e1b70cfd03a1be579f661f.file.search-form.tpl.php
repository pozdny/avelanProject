<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 09:31:11
         compiled from "libs\templates\search-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21825543249605e1947-57773793%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8fd3ce0d6281440f46e1b70cfd03a1be579f661f' => 
    array (
      0 => 'libs\\templates\\search-form.tpl',
      1 => 1413098657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21825543249605e1947-57773793',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54324960952440_38975411',
  'variables' => 
  array (
    'action' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54324960952440_38975411')) {function content_54324960952440_38975411($_smarty_tpl) {?><div class="search-form">
    <form name="searchForm" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post" role="form" id="searchForm">
        <div class="input-append">
            <div class="search-inner">
                <input type="text" name="search_word" maxlength="60" class="form-control sansbold" id="inputFild" >
                <input type="image" alt="Поиск" name="submit" id="inputIcon" src="/img/icons/dif-icons.png" />
            </div>
        </div>
    </form>
</div><?php }} ?>
