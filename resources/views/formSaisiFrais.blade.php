@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'saisirFraisForfait']) !!}  
<div class="col-md-12  col-sm-12 well well-md">
    <h1 style="center">Saisie des frais du mois {{$mois}}</h1>
    <div class="form-horizontal">  
        <input type="hidden" name="mois" value="{{$mois}}"/>
        @foreach($lesFrais as $unFrais)
        <div class="form-group">
            <label class="col-md-3 col-sm-3 control-label">{{$unFrais->libelle}} ({{$unFrais->idfrais}}): </label>
            <div class="col-md-2 col-sm-2">
                <input type="number" name="lesFrais[{{$unFrais->idfrais}}]" value="{{$unFrais->quantite}}" class="form-control" placeholder="quantite" required>
            </div>
        </div>
        @endforeach
         <div class="form-group">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <button type="submit" class="btn btn-default btn-primary">
                    <span class="glyphicon glyphicon-ok"></span> Valider
                </button>
                &nbsp;
                <button type="button" class="btn btn-default btn-primary" 
                        onclick="javascript: window.location = '{{ url('/saisirFraisForfait')}}';">
                    <span class="glyphicon glyphicon-remove"></span> Annuler</button>
            </div>           
        </div>
             
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <a href="{{ url('/getListeFraisHorsForfait')}}/{{$mois}}"><button type="button" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-list"></span> Frais hors forfait</button></a>
            </div>           
        </div> 
       @if (session('status'))
        <div class="alert alert-success">
         {{ session('status') }}
        </div>
       @endif
        <div class="col-md-6 col-md-offset-3  col-sm-6 col-sm-offset-3">
            @include('error')
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop