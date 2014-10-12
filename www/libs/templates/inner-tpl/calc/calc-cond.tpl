<form id="form-cond" class="form-horizontal calc-form" role="form">
<div class="col-sm-6 col-power calc-verticalline">
	<span class="help-block"><strong>Характеристики помещения:</strong></span>
    <div class="form-group">
    	<label for="square" class="col-sm-7 control-label">Площадь, м2</label>
    	<div class="col-sm-4">
      		<input type="text" class="form-control" name="square" id="square" placeholder="м2" title="Пожалуйста, заполните это поле"  maxlength="6"/>
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <div class="form-group">
    	<label for="topSize" class="col-sm-7 control-label">Высота потолков</label>
    	<div class="col-sm-4">
      		<input type="text" class="form-control" name="topSize" id="topSize" placeholder="м" title="Пожалуйста, заполните это поле"  maxlength="6" />
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <span class="help-block"><strong>Внутренние теплопритоки:</strong></span>
    <div class="form-group">
    	<label for="mens" class="col-sm-7 control-label">Количество людей в помещении</label>
    	<div class="col-sm-4">
      		<input type="text" class="form-control" name="mens" id="mens" placeholder="-" title="Пожалуйста, заполните это поле"  maxlength="6" />
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <div class="form-group">
    	<label for="comp" class="col-sm-7 control-label">Количество компьютеров</label>
    	<div class="col-sm-4">
      		<input type="text" class="form-control" name="comp" id="comp" placeholder="-" title="Пожалуйста, заполните это поле"  maxlength="6" />
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <div class="form-group">
    	<label for="other" class="col-sm-7 control-label">Другие приборы с тепловыделением</label>
    	<div class="col-sm-4">
      		<input type="text" class="form-control" name="other" id="other" placeholder="-" title="Пожалуйста, заполните это поле"  maxlength="6" />
    	</div>
        <div class="col-sm-1 error-box"><i title=""></i></div>
  	</div>
    <input class="btn btn-primary" type="submit" value="Посчитать">
</div>
<div class="col-sm-6 col-power">
	<span class="help-block"><strong>Результат:</strong></span>
    <div class="form-group">
    	<label for="rezcalcSize" class="col-sm-7 control-label">Объем помещения, м3:</label>
    	<div class="col-sm-5">
      		<input type="text" class="form-control text-danger" id="rezcalcSize"  readonly="readonly" />
    	</div>
  	</div>
    <div class="form-group">
    	<label for="rezcalcPower" class="col-sm-7 control-label">Мощность кондиционера, кВт:</label>
    	<div class="col-sm-5">
      		<input type="text" class="form-control text-danger" id="rezcalcPower"  readonly="readonly" />
    	</div>
  	</div>
</div>
</form>