<div class="form-group row {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-form-label col-sm-2 required">{{ 'Nome' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ isset($user->name) ? $user->name : ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group row {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-form-label col-sm-2 required">{{ 'Email' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ isset($user->email) ? $user->email : ''}}" required>
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('perc_cred') ? 'has-error' : ''}}">
    <label for="perc_cred" class="col-form-label col-sm-2 required">{{ 'Percentual crédito' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="perc_cred" type="text" id="perc_cred" value="{{ isset($user->perc_cred) ? $user->perc_cred : ''}}" required>
        {!! $errors->first('perc_cred', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('perc_deb') ? 'has-error' : ''}}">
    <label for="perc_deb" class="col-form-label col-sm-2 required">{{ 'Percentual débito' }}</label>
    <div class="col-sm-10">
        <input class="form-control" name="perc_deb" type="text" id="perc_deb" value="{{ isset($user->perc_deb) ? $user->perc_deb : ''}}" required>
        {!! $errors->first('perc_deb', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('type_user') ? 'has-error' : ''}}">
    <label for="type_user" class="col-form-label col-sm-2 required">{{ 'Tipo de usuário' }}</label>
    <div class="col-sm-10">
        <select class="form-select" name="type_user" id="type_user" value="{{ isset($user->type_user) ? $user->type_user : ''}}" required>
            <option value="1">Administrador</option>
            <option value="2">Vendedor</option>
        </select>
        {!! $errors->first('type_user', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="col-form-label col-sm-2 required">Senha</label>
    <div class="col-sm-10">
        <input class="form-control" name="password" type="password" id="password" value="" required>
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row mb-3">
    <label for="password-confirm" class="col-sm-2 col-form-label">Confirme a senha</label>

    <div class="col-sm-10">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Atualizar' : 'Criar' }}">
</div>
