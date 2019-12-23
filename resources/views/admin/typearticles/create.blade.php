@extends('admin.layouts.master')

@section('page')
    Ajouter Type Article
@endsection

@section('content')

<div class="row">
                    <div class="col-lg-10 col-md-10">

                        <div class="card">
                            <div class="header">
                                <h4 class="title">Ajouter Type Article</h4>
                            </div>
                            <div class="content">
                                
                                {!! Form::open(['url' => 'typearticles', 'files'=>'true']) !!}
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            @include('admin.typearticles._fields')

                                            <div class="form-group">
                                            	{{ Form::submit('Ajouter', ['class'=>'btn btn-info btn-fill btn-wd']) }}
                                    		</div>

                                        </div>

                                    </div>
                                    
                                 <div class="clearfix"></div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            

@endsection