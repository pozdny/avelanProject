<?php /* Smarty version Smarty-3.1.18, created on 2014-10-19 17:28:36
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\tableRedact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:140915443d8a44e8321-16632844%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8b27b73f3db3bc08bdd8f85cb60b45c363de82a' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\tableRedact.tpl',
      1 => 1413732515,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '140915443d8a44e8321-16632844',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'i' => 0,
    'addbbcode20' => 0,
    'helpbox' => 0,
    'name_content' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5443d8a45a7143_33053274',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5443d8a45a7143_33053274')) {function content_5443d8a45a7143_33053274($_smarty_tpl) {?><table class="showTable table table-condensed">
    <tr align="center" valign="middle"><td align="left">
            <input type="button" accesskey="b" name="addbbcode0" value="b"
                   class="butt_reduct" style="font-weight:bold;" onClick="bbstyle(0, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('b', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button"  name="addbbcode28" value="strong "
                   class="butt_reduct1" style="font-weight:bold;;" onClick="bbstyle(28, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('str', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" accesskey="i" name="addbbcode2" value="i"
                   class="butt_reduct" style="font-style:italic;" onClick="bbstyle(2, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('i', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode4" value="u"
                   class="butt_reduct" style="text-decoration: underline;" onClick="bbstyle(4, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('u', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode22" value="h1"
                   class="butt_reduct"  onClick="bbstyle(22, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('h1', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode24" value="h2"
                   class="butt_reduct"  onClick="bbstyle(24, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('h2', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode26" value="h3"
                   class="butt_reduct"  onClick="bbstyle(26, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('h3', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode18" value="URL"
                   class="butt_reduct2"   onClick="bbstyle(18, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('w', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode12" value="ul"
                   class="butt_reduct"  onClick="bbstyle(12, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('l', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode14" value="ol"
                   class="butt_reduct"  onClick="bbstyle(14, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('o', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode30" value="txt10"
                   class="butt_reduct"  onClick="bbstyle(30, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('t10', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode32" value="txt13"
                   class="butt_reduct"  onClick="bbstyle(32, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('t13', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode34" value="txt14"
                   class="butt_reduct"  onClick="bbstyle(34, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('t14', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode36" value="txt15"
                   class="butt_reduct"  onClick="bbstyle(36, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('t15', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button" name="addbbcode38" value="bq"
                   class="butt_reduct"  onClick="bbstyle(38, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('bq', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />

            <input type="button"  value="[ / ]"
                   class="butt_reduct"  onClick="bbstyle(-1, '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')"
                   onMouseOver="helpline('a', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" onMouseOut="helpline('h', '<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
')" />
        </td></tr>
    <tr><td >Цвет шрифта:
            <?php echo $_smarty_tpl->tpl_vars['addbbcode20']->value;?>

            <option style="color:#000000;" value="default">По умолчанию</option>
            <option style="color:#ff3202;" value="orange" />Оранжевый</option>
            <option style="color:#5A8D2E;" value="green" />Зелёный</option>
            <option style="color:#2c52e3;" value="blue" />Синий</option>
            <option style="color:darkblue;" value="darkblue" />Темно-синий</option>
            </select>
        </td></tr>
    <tr><td colspan="10"><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['helpbox']->value;?>
" style="width:90%; font-size:11px" class="helpline" value="Подсказка: выделите нужное слово или предложение и нажмите на стиль: <b>, <i>, <u>" /></td></tr>
    <tr><td colspan="10"><textarea class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['name_content']->value;?>
"  id="<?php echo $_smarty_tpl->tpl_vars['name_content']->value;?>
" cols="75" rows="15" placeholder="Введите содержание страницы" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</textarea></td></tr>
</table>
<?php }} ?>
