<div class="form-group row {{ $errors->has('producao') ? 'has-error' : ''}}">
    <label for="producao" class="col-form-label col-sm-2 required">{{ 'Producao' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="producao" type="text" id="producao" value="{{ isset($produtosfechamento->producao) ? $produtosfechamento->producao : ''}}" required>
        {!! $errors->first('producao', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('desperdicio') ? 'has-error' : ''}}">
    <label for="desperdicio" class="col-form-label col-sm-2 required">{{ 'Desperdicio' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="desperdicio" type="number" id="desperdicio" value="{{ isset($produtosfechamento->desperdicio) ? $produtosfechamento->desperdicio : ''}}" >
        {!! $errors->first('desperdicio', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('sobra') ? 'has-error' : ''}}">
    <label for="sobra" class="col-form-label col-sm-2 required">{{ 'Sobra' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="sobra" type="number" id="sobra" value="{{ isset($produtosfechamento->sobra) ? $produtosfechamento->sobra : ''}}" >
        {!! $errors->first('sobra', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('bolos_vendidos') ? 'has-error' : ''}}">
    <label for="bolos_vendidos" class="col-form-label col-sm-2 required">{{ 'Bolos Vendidos' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="bolos_vendidos" type="number" id="bolos_vendidos" value="{{ isset($produtosfechamento->bolos_vendidos) ? $produtosfechamento->bolos_vendidos : ''}}" required>
        {!! $errors->first('bolos_vendidos', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('total_bolos_vendidos') ? 'has-error' : ''}}">
    <label for="total_bolos_vendidos" class="col-form-label col-sm-2 required">{{ 'Total Bolos Vendidos' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="total_bolos_vendidos" type="number" id="total_bolos_vendidos" value="{{ isset($produtosfechamento->total_bolos_vendidos) ? $produtosfechamento->total_bolos_vendidos : ''}}" required>
        {!! $errors->first('total_bolos_vendidos', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('id_produto') ? 'has-error' : ''}}">
    <label for="id_produto" class="col-form-label col-sm-2 required">{{ 'Id Produto' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="id_produto" type="number" id="id_produto" value="{{ isset($produtosfechamento->id_produto) ? $produtosfechamento->id_produto : ''}}" required>
        {!! $errors->first('id_produto', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('id_fechamento') ? 'has-error' : ''}}">
    <label for="id_fechamento" class="col-form-label col-sm-2 required">{{ 'Id Fechamento' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="id_fechamento" type="number" id="id_fechamento" value="{{ isset($produtosfechamento->id_fechamento) ? $produtosfechamento->id_fechamento : ''}}" required>
        {!! $errors->first('id_fechamento', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
