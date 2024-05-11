<div class="form-group row {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="col-form-label col-sm-2 required">{{ 'Nome' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($produto->nome) ? $produto->nome : ''}}" required>
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('is_bolo_extra') ? 'has-error' : ''}}">
    <label for="is_bolo_extra" class="col-form-label col-sm-2 required">{{ 'É Bolo Extra?' }}</label>
    <div class="col-sm-10">
        <select name="is_bolo_extra" class="form-control" id="is_bolo_extra" required>
            @foreach (json_decode('{"s":"Sim","n":"Não"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($produto->is_bolo_extra) && $produto->is_bolo_extra == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('is_bolo_extra', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('type_product') ? 'has-error' : ''}}">
    <label for="type_product" class="col-form-label col-sm-2 required">{{ 'Qual o tipo de produto?' }}</label>
    <div class="col-sm-10">
        <select name="type_product" class="form-control" id="type_product" required>
            @foreach (json_decode('{"p":"Produção","e":"Estoque"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($produto->type_product) && $produto->type_product == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('type_product', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
