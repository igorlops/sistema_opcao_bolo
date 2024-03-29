<div class="form-group row {{ $errors->has('nome') ? 'has-error' : ''}}">
    <label for="nome" class="col-form-label col-sm-2 required">{{ 'Nome' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($tipopagamento->nome) ? $tipopagamento->nome : ''}}" required>
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
