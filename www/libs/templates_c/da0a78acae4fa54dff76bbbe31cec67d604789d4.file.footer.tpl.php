<?php /* Smarty version Smarty-3.1.18, created on 2014-11-14 09:11:38
         compiled from "libs\templates\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10242541ffcdf493e86-53269429%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da0a78acae4fa54dff76bbbe31cec67d604789d4' => 
    array (
      0 => 'libs\\templates\\footer.tpl',
      1 => 1415952602,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10242541ffcdf493e86-53269429',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_541ffcdf497246_04569819',
  'variables' => 
  array (
    'date' => 0,
    'name' => 0,
    'class_true' => 0,
    'schet_1' => 0,
    'schet_2' => 0,
    'schet_3' => 0,
    'snow_script' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541ffcdf497246_04569819')) {function content_541ffcdf497246_04569819($_smarty_tpl) {?><!--footer-->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <span class="sansbold">© <?php echo $_smarty_tpl->tpl_vars['date']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span>
                <br>
                <span class="sanslight">Все права защищены</span>.
            </div>
            <div class="col-xs-6 right-foot">
                <div id="schets" class="<?php echo $_smarty_tpl->tpl_vars['class_true']->value;?>
">
                    <div id="schet_1" class="schets"><?php echo $_smarty_tpl->tpl_vars['schet_1']->value;?>
</div>
                    <div id="schet_2" class="schets"><?php echo $_smarty_tpl->tpl_vars['schet_2']->value;?>
</div>
                    <div id="schet_3" class="schets"><?php echo $_smarty_tpl->tpl_vars['schet_3']->value;?>
</div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
<!--scrips after load-->
<script src="/js/bootstrap/bootstrap.js"></script>
<script src="/js/jquery/jquery.fancybox.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/t.scripts.js"></script>
<script src="/js/valPlagins.js"></script>
<script src="/js/valCalcPlagin.js"></script>
<script src="/js/jquery/jquery.validator-rm.js"></script>
<script src="/js/jquery/jquery.validate.js"></script>
<script src="/js/jquery/jquery.formstyler.min.js"></script>
<?php echo $_smarty_tpl->tpl_vars['snow_script']->value;?>

</body>
</html><?php }} ?>
