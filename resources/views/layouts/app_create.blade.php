@extends('layouts.app')

@section('page')
  @include('layouts._button_index', ['canlist' => $canlist, 'index_route' => $index_route, 'model' => $model, 'title' => $title])
@endsection

@section('buttons')

@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render($breadcrumb_title,$breadcrumb_param) }}
@endsection

@section('css')
    @yield('more_css')
@endsection

@section('content')

<div class="row">
  @include('layouts.message')
</div>

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Nouveau</h4>
          <p class="text-muted m-b-30 font-14">Ajout <code class="highlighter-rouge">{{ ucfirst($title) }}</code> dans le Système.</p>

          <form action="{{ action($store_route) }}" method="POST" enctype="multipart/form-data">

            @include($model_fields)
            @foreach($morecontrols as $control)
              @include($control)
            @endforeach

            <div class="form-group row">
              <div>
                @can($cancreate)
                <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
                @endcan
                <a href="{{ action($index_route) }}" class="btn btn-secondary waves-effect m-l-5">Annuler</a>
              </div>
            </div>

          </form>

        </div>
    </div>
  </div>
</div>

@endsection
@section('js')
    @yield('more_js')
@endsection
