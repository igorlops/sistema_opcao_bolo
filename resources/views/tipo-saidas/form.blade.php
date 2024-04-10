<div class="form-group row {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <label for="descricao" class="col-form-label col-sm-2 required">{{ 'Descrição' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="descricao" type="text" id="descricao" required/>{{ isset($tiposaida->descricao) ? $tiposaida->descricao : ''}}
        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
