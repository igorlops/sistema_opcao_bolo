<div class="form-group row {{ $errors->has('tipo_entrada') ? 'has-error' : ''}}">
    <label for="tipo_entrada" class="col-form-label col-sm-2 required">{{ 'Tipo de Entrada' }}</label>
    <div class="col-sm-10">
        <select name="tipo_entrada" class="form-control" id="tipo_entrada" required>
            @foreach (json_decode('{"venda":"Venda"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($entrada->tipo_entrada) && $entrada->tipo_entrada == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('tipo_entrada', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('observacao') ? 'has-error' : ''}}">
    <label for="observacao" class="col-form-label col-sm-2 required">{{ 'Observação' }}</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="5" name="observacao" type="textarea" id="observacao">{{ isset($entrada->observacao) ? $entrada->observacao : ''}}</textarea>
        {!! $errors->first('observacao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('id_tipo_pagamento') ? 'has-error' : ''}}">
    <label for="id_tipo_pagamento" class="col-form-label col-sm-2 required">{{ 'Tipo de Pagamento' }}</label>
    <div class="col-sm-10">
        <select class="form-select" name="id_tipo_pagamento" id="id_tipo_pagamento" required>
            @foreach ($tipo_pagamentos as $tipo_pagamento)
                <option value="{{$tipo_pagamento->id}}">{{$tipo_pagamento->nome}}</option>
            @endforeach
        </select>
        {!! $errors->first('id_tipo_pagamento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('valor') ? 'has-error' : ''}}">
    <label for="valor" class="col-form-label col-sm-2 required">{{ 'Valor' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="valor" type="text" id="valor" value="{{ isset($entrada->valor) ? $entrada->valor : ''}}" required>
        {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input class="form-control" name="user_id" type="hidden" id="user_id" value="{{ auth()->user()->id}}" required>
<div class="form-group row {{ $errors->has('id_produto') ? 'has-error' : ''}}">
    <label for="id_produto" class="col-form-label col-sm-2 required">{{ 'Produto' }}</label>
    <div class="col-sm-10">
        <select class="form-select" name="id_produto" id="id_produto" required>
            @foreach ($produtos as $produto)
                <option value="{{$produto->id}}">{{$produto->nome}}</option>
            @endforeach
        </select>
        {!! $errors->first('id_produto', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-check pb-5">
    <input class="form-check-input" type="checkbox" name="metade" id="metade" @if($entrada->metade) checked @endif>
    <label class="form-check-label" for="flexCheckChecked">
      É metade?
    </label>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
