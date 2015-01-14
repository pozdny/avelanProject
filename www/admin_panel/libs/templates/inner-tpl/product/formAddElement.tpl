<form id="formAddElements" class="{$table}" >
    <fieldset>
        <legend>Добавить {$position}</legend>
        <div class="row form-group">
            <div class="col-xs-8">
                <input id="title" class="form-control input-sm" type="text" name="title" placeholder="Введите {$title}">
            </div>
            <div class="col-xs-4">
                <button id="button_add" class="btn btn-default" type="button">Добавить</button>
            </div>
        </div>
        <input name="add_id" id="add_id" type="hidden" value="{$add_id}" >
        {$link}
    </fieldset>
</form>