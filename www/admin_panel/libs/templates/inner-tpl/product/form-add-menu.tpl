<form class="form_add_menu" action="{$action}" method="POST">
    <fieldset>
        <legend>Добавить {$position}</legend>
        <input type="text" name="title" size="70" maxlength="70" value="" placeholder="Введите {$title}"/>
        <input type="submit" value="Добавить" />
        <input type="hidden" name="table" value="{$table}" />
    </fieldset>
</form>