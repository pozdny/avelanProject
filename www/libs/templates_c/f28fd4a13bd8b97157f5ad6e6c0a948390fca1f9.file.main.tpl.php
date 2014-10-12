<?php /* Smarty version Smarty-3.1.18, created on 2014-09-22 12:16:12
         compiled from "D:\work\avelanProject\www\libs\templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18028541ff0310e2c88-34746792%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f28fd4a13bd8b97157f5ad6e6c0a948390fca1f9' => 
    array (
      0 => 'D:\\work\\avelanProject\\www\\libs\\templates\\main.tpl',
      1 => 1411380971,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18028541ff0310e2c88-34746792',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_541ff031118ed1_98344758',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541ff031118ed1_98344758')) {function content_541ff031118ed1_98344758($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!--wrap-->
<div id="wrap" >

    <div class="container">
        
        <?php echo $_smarty_tpl->getSubTemplate ('inner-tpl/main-page.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <div class="row">
            <div class="col-xs-12">
                <div class="jumbotron" id="jumbotron-three">
                    <span class="page-title">О нас</span>
                    <div class="page-content">
                        Компания «АВЕЛАН Сервис» современная, активно развивающаяся климатическая организация полного цикла.
                        Мы предоставляем услуги по поставке, монтажу и сервисной поддержке всего спектра поставляемого нашей организацией климатического оборудования.

                        Целевая аудитория нашей Компании — коммерческие организации, желающие улучшить климат в используемых помещениях, обеспечить комфортные условия для жизни и труда.
                        Линейка предлагаемого оборудования и услуг ориентирована на самых требовательных Заказчиков.
                        Мы предоставляем услуги по поставке, монтажу и сервисной поддержке всего спектра поставляемого нашей организацией климатического оборудования.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/wrap-->

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
