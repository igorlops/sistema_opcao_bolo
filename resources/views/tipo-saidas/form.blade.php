<div class="form-group row {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <label for="descricao" class="col-form-label col-sm-2 required">{{ 'Descrição' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="descricao" type="text" id="descricao" required/>{{ isset($tiposaida->descricao) ? $tiposaida->descricao : ''}}
        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('is_fixo') ? 'has-error' : ''}}">
    <label for="is_fixo" class="col-form-label col-sm-2 required">{{ 'É fixo?' }}</label>
    <div class="col-sm-10">
        <select name="is_fixo" class="form-control" id="is_fixo" required>
            @foreach (json_decode('{"s":"Sim","n":"Não"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($produto->is_fixo) && $produto->is_fixo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('is_fixo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
