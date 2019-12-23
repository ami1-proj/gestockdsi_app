@extends('layouts.app')

@section('page')
  Affectations
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render($elem_arr['breadcrumb_create'],$elem_arr['breadcrumb_param']) }}
@endsection

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Nouvelle Affectation {{ $elem_arr['type'] }}</h4>
          <p class="text-muted m-b-30 font-14">Créer une nouvelle affectation pour <code class="highlighter-rouge">{{ $elem_arr['elem']->designation_complete }}</code>.</p>


          <form action="{{ route('affectations.elemstore', [$type_affectation->tags,$elem_arr['elem']->id]) }}" method="POST">

          <div class="row">

            <div class="col-lg-12">
              <div class="card m-b-30">
                <div class="card-body">

                  <div class="form-group row {{ $errors->has('objet') ? 'has-error' : '' }}">
                      <label class="col-sm-2 col-form-label" for="objet">Objet</label>
                      <div class="col-sm-10">
                          <input name="objet" type="text" class="form-control" placeholder="Objet" value="{{ old('objet', $affectation->objet ?? '') }}"/>
                          <small class="text-danger">{{ $errors->has('objet') ? $errors->first('objet') : '' }}</small>
                      </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card m-b-30">
                <div class="card-body">
                  <h6 class="card-title">Articles à Affecter</h6>
                  <!-- <p class="card-text"><small class="text-muted m-b-30 font-10">Sélectionnez au moins un article. Gardez la touche <code class="highlighter-rouge">Ctrl</code> enfoncé pour sélectionner plusieurs ou déselectionner.</small></p> -->

                  <p>
                    <div class="col-md-4">
                      <button name="action" value="remove-articles" class="btn btn-outline-secondary"><i class="ion-ios7-redo"></i></button>
                    </div>
                  </p>

                  <div class="form-group row {{ $errors->has('liste_articles') ? 'has-error' : '' }}">
                    <select class="select2 form-control" name="liste_articles[]" multiple="multiple" id="liste_articles">
                      @foreach($articles_disponibles as $id => $display)
                        <option value="{{ $id }}">{{ $display }}</option>
                      @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->has('liste_articles') ? $errors->first('liste_articles') : '' }}</small>
                  </div>

                </div>
              </div>
            </div>


            <div class="col-lg-6">
              <div class="card m-b-30">
                <div class="card-body">
                  <h6 class="card-title">Articles Disponibles</h6>
                  <!-- <p class="card-text"><small class="text-muted m-b-30 font-10">Sélectionnez au moins un article. Gardez la touche <code class="highlighter-rouge">Ctrl</code> enfoncé pour sélectionner plusieurs ou déselectionner.</small></p> -->


                  <p>
                    <div class="col-md-4">
                      <div class="input-group form-inline mb-3">

                        <span class="input-group-prepend">
                          <button name="action" value="add-articles" class="btn btn-outline-secondary"><i class="ion-ios7-undo"></i></button>
                        </span>

                        <input class="form-control form-control-sm" type="search" name="q" value="{{ $q }}">

                        <span class="input-group-append">
                          <button name="action" value="search-articles" class="btn btn-outline-secondary"><i class="ti-search"></i></button>
                        </span>
                      </div>
                  </div>
                  </p>

                  <div class="form-group row {{ $errors->has('liste_articles') ? 'has-error' : '' }}">
                    <select class="select2 form-control" name="liste_articles[]" multiple="multiple" id="liste_articles">
                      @foreach($articles_disponibles as $id => $display)
                        <option value="{{ $id }}">{{ $display }}</option>
                      @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->has('liste_articles') ? $errors->first('liste_articles') : '' }}</small>
                  </div>

                </div>
              </div>
            </div>


          </div>

          @csrf

            <div class="form-group row">
                <div class="col-sm-3">
                    <button name="action" value="valider-affectation" class="btn btn-primary">Valider</button>
                    <a href="{{ action($elem_arr['showController'], [$elem_arr['elem']->id]) }}" class="btn btn-secondary">Annuler</a>
                </div>
              </div>

          </form>


      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script type="text/javascript">

  function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text" || node.type=="search"))  {return false;}
  }

  document.onkeypress = stopRKey;

</script>
@endsection
