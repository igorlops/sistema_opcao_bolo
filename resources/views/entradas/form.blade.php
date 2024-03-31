<div class="form-group row {{ $errors->has('tipo_entrada') ? 'has-error' : ''}}">
    <label for="tipo_entrada" class="col-form-label col-sm-2 required">{{ 'Tipo Entrada' }}</label>
    <div class="col-sm-10">
        <select name="tipo_entrada" class="form-control" id="tipo_entrada" required>
    @foreach (json_decode('{"venda":"Venda"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($entrada->tipo_entrada) && $entrada->tipo_entrada == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('tipo_entrada', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('observacao') ? 'has-error' : ''}}">
    <label for="observacao" class="col-form-label col-sm-2 required">{{ 'Observacao' }}</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="5" name="observacao" type="textarea" id="observacao" required>{{ isset($entrada->observacao) ? $entrada->observacao : ''}}</textarea>
        {!! $errors->first('observacao', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('id_tipo_pagamento') ? 'has-error' : ''}}">
    <label for="id_tipo_pagamento" class="col-form-label col-sm-2 required">{{ 'Id Tipo Pagamento' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="id_tipo_pagamento" type="number" id="id_tipo_pagamento" value="{{ isset($entrada->id_tipo_pagamento) ? $entrada->id_tipo_pagamento : ''}}" required>
        {!! $errors->first('id_tipo_pagamento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('valor') ? 'has-error' : ''}}">
    <label for="valor" class="col-form-label col-sm-2 required">{{ 'Valor' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="valor" type="number" id="valor" value="{{ isset($entrada->valor) ? $entrada->valor : ''}}" required>
        {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-form-label col-sm-2 required">{{ 'User Id' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($entrada->user_id) ? $entrada->user_id : ''}}" required>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('id_produto') ? 'has-error' : ''}}">
    <label for="id_produto" class="col-form-label col-sm-2 required">{{ 'Id Produto' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="id_produto" type="number" id="id_produto" value="{{ isset($entrada->id_produto) ? $entrada->id_produto : ''}}" required>
        {!! $errors->first('id_produto', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
