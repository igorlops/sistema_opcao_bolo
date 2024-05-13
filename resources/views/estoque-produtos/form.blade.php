<div class="form-group row {{ $errors->has('tipo_estoque') ? 'has-error' : ''}}">
    <label for="tipo_estoque" class="col-form-label col-sm-2 required">{{ 'Tipo Estoque' }}</label>
    <div class="col-sm-10">
        <select name="tipo_estoque" class="form-control" id="tipo_estoque" required>
            <option value="c" selected>Compra</option>
        </select>
        {!! $errors->first('tipo_estoque', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('quantidade') ? 'has-error' : ''}}">
    <label for="quantidade" class="col-form-label col-sm-2 required">{{ 'Quantidade' }}</label>
    <div class="col-sm-10">
        <input class="form-control money" name="quantidade" type="number" id="quantidade" value="{{ isset($estoque->quantidade) ? $estoque->quantidade : ''}}" required>
        {!! $errors->first('quantidade', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('id_produto') ? 'has-error' : ''}}">
    <label for="id_produto" class="col-form-label col-sm-2 required">{{ 'Produto' }}</label>
    <div class="col-sm-10">
        <select name="id_produto" class="form-control" id="id_produto" required>
            <option value="" selected>Selecione o produto</option>
            @foreach ($produtos as $produto)
                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('id_produto', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input class="form-control" name="user_id" type="hidden" id="user_id" value="{{auth()->user()->id}}" >

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
