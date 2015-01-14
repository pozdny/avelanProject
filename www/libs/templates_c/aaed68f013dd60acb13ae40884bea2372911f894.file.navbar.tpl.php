<?php /* Smarty version Smarty-3.1.18, created on 2014-10-16 09:42:18
         compiled from "libs\templates\navbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11492541ffcdf3b9054-92913134%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aaed68f013dd60acb13ae40884bea2372911f894' => 
    array (
      0 => 'libs\\templates\\navbar.tpl',
      1 => 1413445335,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11492541ffcdf3b9054-92913134',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_541ffcdf3bdb23_74809557',
  'variables' => 
  array (
    'navli_content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541ffcdf3bdb23_74809557')) {function content_541ffcdf3bdb23_74809557($_smarty_tpl) {?><nav class="row main-navbar-block">
    <div class="col-xs-offset-2 col-xs-10 col-sm-offset-1 col-sm-11 col-md-offset-2 col-md-10 col-lg-offset-4 col-lg-8 adapt-nav">
        <div class="navbar-block">
            <div class="navbar navbar-default" role="navigation">
                <div class="nav-border-fon"></div>
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button class="navbar-toggle collapsed" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/"><i class="fa round-icons-nav"></i></a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <?php echo $_smarty_tpl->tpl_vars['navli_content']->value;?>

                        </ul>
                        <div class="nav-fon"></div>
                        <ul class="nav navbar-nav navbar-right"></ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</nav><?php }} ?>
