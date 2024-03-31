<div class="form-group row {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <label for="descricao" class="col-form-label col-sm-2 required">{{ 'Descrição' }}</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="5" name="descricao" type="textarea" id="descricao" required>{{ isset($tiposaida->descricao) ? $tiposaida->descricao : ''}}</textarea>
        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
