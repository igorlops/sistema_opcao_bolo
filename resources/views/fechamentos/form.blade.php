<div class="inputs-fechamento d-flex flex-row">
    <div class="d-flex justify-content-center flex-column w-50">
        {{-- <div class="form-group row {{ $errors->has('vendas_extras') ? 'has-error' : ''}}">
            <label for="vendas_extras" class="col-form-label col-sm-3 required">{{ 'Vendas Extras/Embalagens (B)' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" onchange="vendasABC()" name="vendas_extras" disabled readonly type="text" id="vendas_extras"
                @if ($formMode === 'edit')
                    value="{{ isset($fechamento->vendas_extras) ? $fechamento->vendas_extras : ''}}"
                @else
                    value="{{isset($vendas_extras) ? numero_iso_para_br($vendas_extras) : '0'}}"
                @endif
                >
                {!! $errors->first('vendas_extras', '<p class="help-block">:message</p>') !!}
            </div>
        </div> --}}
        <div class="form-group row {{ $errors->has('desconto') ? 'has-error' : ''}}">
            <label for="desconto" class="col-form-label col-sm-3 required">{{ 'Desconto (C)' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" onchange="vendasABC()" name="desconto" type="text" id="desconto"
                @if ($formMode === 'edit')
                    value="{{ isset($fechamento->desconto) ? $fechamento->desconto : '0'}}"
                @else
                    value="{{isset($desconto) ? numero_iso_para_br($desconto) : '0'}}"
                @endif
                >
                {!! $errors->first('desconto', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group row {{ $errors->has('vendas_abc') ? 'has-error' : ''}}">
            <label for="vendas_abc" class="col-form-label col-sm-3 required">{{ 'Vendas ABC' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" name="vendas_abc" type="text" id="vendas_abc"
                @if ($formMode === 'edit')
                    value="{{ isset($fechamento->vendas_abc) ? $fechamento->vendas_abc : '0'}}"
                @else
                    value="{{isset($venda_total) ? numero_iso_para_br($venda_total) : '0'}}"
                @endif
                required>
                {!! $errors->first('vendas_abc', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group row {{ $errors->has('total_caixa') ? 'has-error' : ''}}">
            <label for="total_caixa" class="col-form-label col-sm-3 required">{{ 'Dinheiro:' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" name="total_caixa" type="text" id="total_caixa"
                @if ($formMode === 'edit')
                    value="{{ isset($fechamento->total_caixa) ? $fechamento->total_caixa : '0'}}"
                @else
                    value="{{isset($dinheiro) ? numero_iso_para_br($dinheiro) : '0'}}"
                @endif
                    required>
                {!! $errors->first('total_caixa', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group row {{ $errors->has('env') ? 'has-error' : ''}}">
            <label for="env" class="col-form-label col-sm-3 required">{{ 'Envelope:' }}</label>
            <div class="col-sm-8">
                <input class="form-control money" name="env" type="text" id="env" onchange="diferencaCaixa()" value="{{ isset($fechamento->env) ? $fechamento->env : ''}}">
                {!! $errors->first('env', '<p class="help-block">:message</p>') !!}
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
    <div class="d-flex justify-content-center flex-column w-50">
        <div class="form-group row {{ $errors->has('cartao_cred') ? 'has-error' : ''}}">
            <label for="cartao_cred" class="col-form-label col-sm-3 required">{{ 'Cartão Crédito' }}</label>
            <div class="col-sm-8">
                <input class="form-control money"
                    name="cartao_cred"
                    type="text"
                    id="cartao_cred"
                    @if ($formMode === 'edit')
                        value="{{isset($fechamento->cartao_cred) ? $fechamento->cartao_cred : '0'}}"
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
                        value="{{isset($fechamento->cartao_deb) ? $fechamento->cartao_deb : '0'}}"
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
    </div>
</div>
<div class="form-group {{ $errors->has('observacao') ? 'has-error' : ''}}">
    <label for="observacao" class="col-form-label col-sm-2 required">{{ 'Observação' }}</label>
    <div class="col-sm-12">
        <textarea class="form-control" rows="5" name="observacao" type="textarea" id="observacao">{{ isset($entrada->observacao) ? $entrada->observacao : ''}}</textarea>
        {!! $errors->first('observacao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input class="form-control" name="user_id" type="hidden" id="user_id" value="{{auth()->user()->id}}" >

@if ($formMode === 'create')
<input type="hidden" name="ativo" value="n">
<div class="file-fechamentos d-flex flex-row justify-content-around">
    <div class="col-6 input-group mb-3">
        <input type="file" name="file_cartao_cred" class="form-control" id="file_card_cred" accept="image/jpeg, image/png, image/gif">
        <label class="input-group-text" for="file_card_cred">Cartão crédito</label>
    </div>
    <div class="col-6 input-group mb-3">
        <input type="file" name="file_cartao_deb" class="form-control" id="file_card_deb" accept="image/jpeg, image/png, image/gif">
        <label class="input-group-text" for="file_card_deb">Cartão débito</label>
    </div>
</div>
@endif

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
