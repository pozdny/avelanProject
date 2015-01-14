<form id="editForm" class="{$table}" {$action} {$method} enctype="multipart/form-data">
    <div>
        <fieldset>
            <legend>{$legend}</legend>
            <div>
                <div class="form-group">
                    <label for="rus">Название пункта по-русски:</label>
                    <input type='text' class='form-control input-sm' name='rus' id='rus' placeholder='Название пункта по-русски' value='{$rus}' {$disabled}/>
                </div>
                {$eng_block}
                {$h1_block}
                {$table_redact}
                {$table_redact2}
                {$main_img}
                <button {$type_button} class="btn btn-primary" id="button_edit">Изменить</button>
            </div>
        </fieldset>
    </div>
    <input name="edit_id" id="edit_id" type="hidden" value="{$edit_id}">
    {$link}
    {$mm_edit}
    {$menu_eng}
</form>
{$img_list}