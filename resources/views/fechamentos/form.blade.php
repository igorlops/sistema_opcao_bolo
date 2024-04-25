<div class="d-flex flex-row">
    <div class="d-flex justify-content-center flex-column w-50">

        <div class="form-group row {{ $errors->has('vendas_extras') ? 'has-error' : ''}}">
            <label for="vendas_extras" class="col-form-label col-sm-3 required">{{ 'Vendas Extras/Embalagens (B)' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" name="vendas_extras" type="text" id="vendas_extras" value="{{ isset($fechamento->vendas_extras) ? $fechamento->vendas_extras : ''}}" >
                {!! $errors->first('vendas_extras', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group row {{ $errors->has('desconto') ? 'has-error' : ''}}">
            <label for="desconto" class="col-form-label col-sm-3 required">{{ 'Desconto (C)' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" name="desconto" type="text" id="desconto" value="{{ isset($fechamento->desconto) ? $fechamento->desconto : ''}}" >
                {!! $errors->first('desconto', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group row {{ $errors->has('vendas_abc') ? 'has-error' : ''}}">
            <label for="vendas_abc" class="col-form-label col-sm-3 required">{{ 'Vendas ABC' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" name="vendas_abc" type="text" id="vendas_abc" value="{{ isset($fechamento->vendas_abc) ? $fechamento->vendas_abc : ''}}" required>
                {!! $errors->first('vendas_abc', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group row {{ $errors->has('total_caixa') ? 'has-error' : ''}}">
            <label for="total_caixa" class="col-form-label col-sm-3 required">{{ 'Total Caixa:' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" name="total_caixa" type="text" id="total_caixa"
                @if ($formMode === 'edit')
                    value="{{ isset($fechamento->total_caixa) ? $fechamento->total_caixa : ''}}"
                @else
                    value="{{isset($dinheiro) ? $dinheiro : '0'}}"
                @endif
                    required>
                {!! $errors->first('total_caixa', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center flex-column w-50">

        <div class="form-group row {{ $errors->has('env') ? 'has-error' : ''}}">
            <label for="env" class="col-form-label col-sm-3 required">{{ 'Envelope:' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" name="env" type="text" id="env" onchange="diferencaCaixa()" value="{{ isset($fechamento->env) ? $fechamento->env : ''}}">
                {!! $errors->first('env', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group row {{ $errors->has('cartao_cred') ? 'has-error' : ''}}">
            <label for="cartao_cred" class="col-form-label col-sm-3 required">{{ 'Cartão Crédito' }}</label>
            <div class="col-sm-8">
                <input class="form-control"
                    name="cartao_cred"
                    type="text"
                    id="cartao_cred"
                    @if ($formMode === 'edit')
                        value="{{isset($fechamento->cartao_cred) ? $fechamento->cartao_cred : ''}}"
                    @else
                        value="{{isset($cartaoCredito) ? $cartaoCredito : '0'}}"
                    @endif
                    required>

                {!! $errors->first('cartao_cred', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group row {{ $errors->has('cartao_deb') ? 'has-error' : ''}}">
            <label for="cartao_deb" class="col-form-label col-sm-3 required">{{ 'Cartão Débito' }}</label>
            <div class="col-sm-8">
                <input class="form-control money"
                    name="cartao_deb"
                    type="text"
                    id="cartao_deb"
                    @if ($formMode === 'edit')
                        value="{{isset($fechamento->cartao_deb) ? $fechamento->cartao_deb : ''}}"
                    @else
                        value="{{isset($cartaoDebito) ? $cartaoDebito : '0'}}"
                    @endif
                    required>

                {!! $errors->first('cartao_deb', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group row {{ $errors->has('pix') ? 'has-error' : ''}}">
            <label for="pix" class="col-form-label col-sm-3 required">{{ 'Pix' }}</label>
            <div class="col-sm-8 ">
                <input class="form-control money"
                    name="pix"
                    type="text"
                    id="pix"
                    @if ($formMode === 'edit')
                        value="{{isset($fechamento->pix) ? $fechamento->pix : ''}}"
                    @else
                        value="{{isset($pix) ? $pix : '0'}}"
                    @endif
                    required>

                {!! $errors->first('pix', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group row {{ $errors->has('diferenca') ? 'has-error' : ''}}">
            <label for="diferenca" class="col-form-label col-sm-3 required">{{ 'Diferença de caixa' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" name="diferenca" type="text" id="diferenca" value="{{ isset($fechamento->diferenca) ? $fechamento->diferenca : ''}}" >
                {!! $errors->first('diferenca', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
