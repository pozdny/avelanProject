<form  action="{$action}" name="file_upload" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>{$legend}</legend>
        {$price}
        <div>{$notice}</div>
        <button type="submit" id="loadButton" data-loading-text="Загрузка..." class="btn btn-success">Загрузить</button>
    </fieldset>
</form>