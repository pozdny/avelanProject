<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 09:49:47
         compiled from "libs\templates\inner-tpl\carousel\li-carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19085542e4ea55d2fc5-02004116%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f32082f0a0d589235a084cae39b4b66087646c7' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\carousel\\li-carousel.tpl',
      1 => 1413098657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19085542e4ea55d2fc5-02004116',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_542e4ea5604812_20693485',
  'variables' => 
  array (
    'eng_carousel' => 0,
    'title_carousel' => 0,
    'subli_carousel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542e4ea5604812_20693485')) {function content_542e4ea5604812_20693485($_smarty_tpl) {?><li>
    <div class="li-content <?php echo $_smarty_tpl->tpl_vars['eng_carousel']->value;?>
">
        <div class="carousel-title dinmedium"><?php echo $_smarty_tpl->tpl_vars['title_carousel']->value;?>
</div>
        <ul class="list-group">
            <?php echo $_smarty_tpl->tpl_vars['subli_carousel']->value;?>

        </ul>
    </div>
</li><?php }} ?>
