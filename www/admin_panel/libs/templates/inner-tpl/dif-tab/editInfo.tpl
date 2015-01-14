<form id="editForm" class="{$table}">
    <fieldset>
        <legend>{$legend}</legend>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label for="name">Название организации:</label>
                    <input class="form-control input-sm" type="text" name="name" id="name" placeholder="Введите название организации" value="{$name}" />
                </div>
                <div class="col-xs-6">
                    <label for="email">E-mail:</label>
                    <input class="form-control input-sm" type="text" name="email" id="email" placeholder="email" value="{$email}" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label for="phone">Телефон организации:</label>
                    <input class="form-control input-sm" type="text" name="phone" id="phone" placeholder="Введите телефон организации" value="{$phone}" />
                </div>
                <div class="col-xs-6">
                    <label for="phone_service">Телефон сервиса:</label>
                    <input class="form-control input-sm" type="text" name="phone_service" id="phone_service" placeholder="Введите телефон сервисного отдела" value="{$phone_service}" />
                </div>
            </div>

        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label for="shadule">Время работы:</label>
                    <input class="form-control input-sm" type="text" name="shadule" id="shadule" placeholder="Время работы" value="{$shadule}" />
                </div>
                <div class="col-xs-6">
                    <label for="shadule1">Выходные:</label>
                    <input class="form-control input-sm" type="text" name="shadule1" id="shadule1" placeholder="Время работы" value="{$shadule1}" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-12">
                    <label for="address">Адрес:</label>
                    <input class="form-control input-sm" type="text" name="address" id="address" placeholder="Время работы" value="{$address}" />
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="gerld" {$checked_gerld}> Включение/выключение гирлянды
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="effect" {$checked_effect}> Включение/выключение скрипта снега
            </label>
        </div>
        <button type="button" name="Submit" class="btn btn-primary" id="button_edit">Изменить</button>
    </fieldset>
    <input name="link" type="hidden" value="{$link}">
</form>