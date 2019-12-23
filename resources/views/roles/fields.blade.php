<div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="name">Nom</label>
    <div class="col-sm-10">
        <input name="name" type="text" class="form-control" placeholder="name" value="{{ old('name', $role->name ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="description">Description</label>
    <div class="col-sm-10">
        <input name="description" type="text" class="form-control" placeholder="description" value="{{ old('description',  $role->description ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</small>
    </div>
</div>

@csrf
