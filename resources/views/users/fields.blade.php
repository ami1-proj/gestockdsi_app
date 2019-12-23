<div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="name">Nom</label>
    <div class="col-sm-10">
        <input name="name" type="text" class="form-control" placeholder="Nom" value="{{ old('name', $user->name ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="email">Email</label>
    <div class="col-sm-10">
        <input name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email',  $user->email ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="password">Mot de Passe</label>
    <div class="col-sm-10">
        <input name="password" type="text" class="form-control" placeholder="Mot de Passe" value="{{ old('password') }}"/>
        <small class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="confirm_password">Confirmation Mot de Passe</label>
    <div class="col-sm-10">
        <input name="confirm_password" type="text" class="form-control" placeholder="Confirmation Mot de Passe " value="{{ old('confirm_password') }}"/>
        <small class="text-danger">{{ $errors->has('confirm_password') ? $errors->first('confirm_password') : '' }}</small>
    </div>
</div>

@csrf
