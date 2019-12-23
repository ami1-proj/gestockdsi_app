<div class="form-group row {{ $errors->has('libelle') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="libelle">Libelle</label>
    <div class="col-sm-10">
        <input name="libelle" type="text" class="form-control" placeholder="Libelle" value="{{ $typearticle->libelle ?? '' }}"/>
        <small class="text-danger">{{ $errors->has('libelle') ? $errors->first('libelle') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="description">Description</label>
    <div class="col-sm-10">
        <input name="description" type="text" class="form-control" placeholder="Description" value="{{ $typearticle->description ?? '' }}"/>
        <small class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
        <select name="statut_id" class="form-control" id="statut_id" required>
            @foreach($statuts as $id => $display)
                <option value="{{ $id }}" {{ (isset($typearticle->statut_id) && $id === $typearticle->statut_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('image') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="image">Image</label>
    <div class="col-sm-10">
        <input type="file" name="image" id="image" class="form-control border-input" value="{{ $typearticle->image ?? '' }}"/>
        <div id="thumb-output"></div>
        <small class="text-danger">{{ $errors->has('image') ? $errors->first('image') : '' }}</small>
    </div>
</div>

@csrf
