<div class="form-group row {{ $errors->has('valor') ? 'has-error' : ''}}">
    <label for="valor" class="col-form-label col-sm-2 required">{{ 'Valor' }}</label>
    <div class="col-sm-10">
        <input class="form-control money" name="valor" type="text" id="valor" value="{{ isset($saida->valor) ? numero_iso_para_br($saida->valor) : ''}}" required>
        {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('observacao') ? 'has-error' : ''}}">
    <label for="observacao" class="col-form-label col-sm-2 required">{{ 'Observação' }}</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="5" name="observacao" type="textarea" id="observacao">{{ isset($saida->observacao) ? $saida->observacao : ''}}</textarea>
        {!! $errors->first('observacao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input class="form-control" name="user_id" type="hidden" id="user_id" value="{{ auth()->user()->id}}" required>
<div class="form-group row {{ $errors->has('id_descricao') ? 'has-error' : ''}}">
    <label for="id_descricao" class="col-form-label col-sm-2 required">{{ 'Descrição' }}</label>
    <div class="col-sm-10">
        <select class="form-select" name="id_descricao" id="id_descricao" required>
            @foreach ($descricoes as $descricao)
                <option value="{{$descricao->id}}">{{$descricao->descricao}}</option>
            @endforeach
        </select>
        {!! $errors->first('id_descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input type="hidden" name="tipo" value="fixo">

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
