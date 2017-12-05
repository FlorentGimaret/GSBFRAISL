@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'modifInfosPerso']) !!}  
<div class="col-md-12 well well-md">
    <center><h1>création d'un nouvel utilisateur</h1></center>
    <br>
    <div class="form-horizontal">    
        <div class="form-group">
            <label class="col-md-3 control-label">Votre nouvelle adresse mail : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="mail" ng-model="mail" class="form-control" placeholder="adresse mail" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Votre nouveau numero de téléphone :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="mail" ng-model="mail" class="form-control" placeholder="numero de telephone" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
            </div>
        <div class="col-md-6 col-md-offset-3">
            @include('error')
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop

