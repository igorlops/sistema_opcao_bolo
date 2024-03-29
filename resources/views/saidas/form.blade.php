<div class="form-group row {{ $errors->has('valor') ? 'has-error' : ''}}">
    <label for="valor" class="col-form-label col-sm-2 required">{{ 'Valor' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="valor" type="text" id="valor" value="{{ isset($saida->valor) ? $saida->valor : ''}}" required>
        {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('observacao') ? 'has-error' : ''}}">
    <label for="observacao" class="col-form-label col-sm-2 required">{{ 'Observacao' }}</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="5" name="observacao" type="textarea" id="observacao" required>{{ isset($saida->observacao) ? $saida->observacao : ''}}</textarea>
        {!! $errors->first('observacao', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-form-label col-sm-2 required">{{ 'User Id' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($saida->user_id) ? $saida->user_id : ''}}" required>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('id_descricao') ? 'has-error' : ''}}">
    <label for="id_descricao" class="col-form-label col-sm-2 required">{{ 'Id Descricao' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="id_descricao" type="number" id="id_descricao" value="{{ isset($saida->id_descricao) ? $saida->id_descricao : ''}}" required>
        {!! $errors->first('id_descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
