<div class="form-group row {{ $errors->has('total_vendas') ? 'has-error' : ''}}">
    <label for="total_vendas" class="col-form-label col-sm-2 required">{{ 'Total Vendas' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="total_vendas" type="text" id="total_vendas" value="{{ isset($fechamento->total_vendas) ? $fechamento->total_vendas : ''}}" required>
        {!! $errors->first('total_vendas', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('total_pagamentos') ? 'has-error' : ''}}">
    <label for="total_pagamentos" class="col-form-label col-sm-2 required">{{ 'Total Pagamentos' }}</label>
    <div class="col-sm-10">
        <textarea class="form-control" rows="5" name="total_pagamentos" type="textarea" id="total_pagamentos" required>{{ isset($fechamento->total_pagamentos) ? $fechamento->total_pagamentos : ''}}</textarea>
        {!! $errors->first('total_pagamentos', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('saldo_ini') ? 'has-error' : ''}}">
    <label for="saldo_ini" class="col-form-label col-sm-2 required">{{ 'Saldo Inicial' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="saldo_ini" type="number" id="saldo_ini" value="{{ isset($fechamento->saldo_ini) ? $fechamento->saldo_ini : ''}}" required>
        {!! $errors->first('saldo_ini', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('saldo_fin') ? 'has-error' : ''}}">
    <label for="saldo_fin" class="col-form-label col-sm-2 required">{{ 'Saldo Final' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="saldo_fin" type="number" id="saldo_fin" value="{{ isset($fechamento->saldo_fin) ? $fechamento->saldo_fin : ''}}" required>
        {!! $errors->first('saldo_fin', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('diferenca_caixa') ? 'has-error' : ''}}">
    <label for="diferenca_caixa" class="col-form-label col-sm-2 required">{{ 'Diferença de caixa' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="diferenca_caixa" type="number" id="diferenca_caixa" value="{{ isset($fechamento->diferenca_caixa) ? $fechamento->diferenca_caixa : ''}}" required>
        {!! $errors->first('diferenca_caixa', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('observacao') ? 'has-error' : ''}}">
    <label for="observacao" class="col-form-label col-sm-2 required">{{ 'Observação' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="observacao" type="number" id="observacao" value="{{ isset($fechamento->observacao) ? $fechamento->observacao : ''}}" required>
        {!! $errors->first('observacao', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('id_imagem') ? 'has-error' : ''}}">
    <label for="id_imagem" class="col-form-label col-sm-2 required">{{ 'Imagem' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="id_imagem" type="text" id="id_imagem" value="{{ isset($fechamento->id_imagem) ? $fechamento->id_imagem : ''}}" required>
        {!! $errors->first('id_imagem', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input class="form-control" name="user_id" type="hidden" id="user_id" value="{{ auth()->user->id}}" required>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
