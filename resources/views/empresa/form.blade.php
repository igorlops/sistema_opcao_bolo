@csrf

<div class="form-group row">
    <label for="nome" class="col-form-label col-sm-2 required">Nome*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('nome',@$empresa->nome)}}" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" maxlength="255" required/>
        @error('nome') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div class="form-group row">
    <label for="razao_social" class="col-form-label col-sm-2 required">Razão Social*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('razao_social',@$empresa->razao_social)}}" name="razao_social" id="razao_social" class="form-control @error('razao_social') is-invalid @enderror" maxlength="255" />
        @error('razao_social') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div class="form-group row">
    <label for="documento" class="col-form-label col-sm-2 required">Documento*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('documento',@$empresa->documento)}}" name="documento" id="documento" data-mask="000.000.000-00" class="cpf_cnpj form-control @error('documento') is-invalid @enderror" maxlength="18" />
        @error('documento') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div class="form-group row">
    <label for="ie_rg" class="col-form-label col-sm-2 required">IE/RG*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('ie_rg',@$empresa->ie_rg)}}" name="ie_rg" id="ie_rg" class="form-control @error('ie_rg') is-invalid @enderror" maxlength="25" />
        @error('ie_rg') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div id="cliente">
    <div class="form-group row">
        <label for="nome_contato" class="col-form-label col-sm-2 required">Nome Contato*</label>
        <div class="col-sm-10">
            <input type="text" value="{{old('nome_contato',@$empresa->nome_contato)}}" name="nome_contato" id="nome_contato" class="form-control @error('nome_contato') is-invalid @enderror" maxlength="255" />
            @error('nome_contato') 
                <div class="alert alert-danger">
                    {{$message}}
                </div>
            @enderror
        </div>


    </div>
</div>
<div class="form-group row">
    <label for="celular" class="col-form-label col-sm-2 required">Celular*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('celular',@$empresa->celular)}}" name="celular" id="celular" data-mask="(00) 00000-0000" class="celular form-control @error('celular') is-invalid @enderror" maxlength="16" required/>
        @error('celular') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div class="form-group row">
    <label for="email" class="col-form-label col-sm-2 required">Email*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('email',@$empresa->email)}}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" maxlength="100" required/>
        @error('email') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div class="form-group row">
    <label for="telefone" class="col-form-label col-sm-2 required">Telefone</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('telefone',@$empresa->telefone)}}" name="telefone" id="telefone" data-mask="(00) 0000-0000" class="telefone form-control @error('telefone') is-invalid @enderror" maxlength="15"/>
        @error('telefone') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div class="form-group row">
    <label for="cep" class="col-form-label col-sm-2 required">Cep*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('cep',@$empresa->cep)}}" name="cep" id="cep"  data-mask="00000-000" class="cep form-control @error('cep') is-invalid @enderror" maxlength="9" required/>
        @error('cep') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div class="form-group row">
    <label for="logradouro" class="col-form-label col-sm-2 required">Logradouro*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('logradouro',@$empresa->logradouro)}}" name="logradouro" id="logradouro" class="form-control @error('logradouro') is-invalid @enderror" maxlength="150" required/>
        @error('logradouro') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div class="form-group row">
    <label for="bairro" class="col-form-label col-sm-2 required">Bairro*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('bairro',@$empresa->bairro)}}" name="bairro" id="bairro" class="form-control @error('bairro') is-invalid @enderror" maxlength="100" required/>
        @error('bairro') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror

    </div>

</div>
<div class="form-group row">
    <label for="cidade" class="col-form-label col-sm-2 required">Cidade*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('cidade',@$empresa->cidade)}}" name="cidade" id="cidade" class="form-control @error('cidade') is-invalid @enderror" maxlength="100" required/>
        @error('cidade') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div class="form-group row">
    <label for="estado" class="col-form-label col-sm-2 required">Estado*</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('estado',@$empresa->estado)}}" name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" maxlength="2" required/>
        @error('estado') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>
<div class="form-group row">
    <label for="observacao" class="col-form-label col-sm-2 required">Observação</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('observacao',@$empresa->observacao)}}" name="observacao" id="observacao" class="form-control @error('observacao') is-invalid @enderror" maxlength="500"/>
        @error('observacao') 
            <div class="alert alert-danger">
                {{$message}}
            </div>
        @enderror
    </div>


</div>


<button type="submit" class="btn btn-primary" name="submit">Salvar</button>