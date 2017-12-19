@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'modifInfosPerso']) !!}  
<div class="col-md-12 well well-md">
    <center><h1>Modification de vos informations personnelles</h1></center>
    <br>
    <div class="form-horizontal">   
        <div class="form-group">
            <label class="col-md-3 control-label">Votre nouvelle adresse : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="adr" ng-model="adr" class="form-control" placeholder="adresse" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Votre nouvelle adresse cp : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="cp" ng-model="cp" class="form-control" placeholder="cp" required pattern="[0-9]{5}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Votre nouvelle ville : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="ville" ng-model="ville" class="form-control" placeholder="ville" pattern="(?=.*[a-z]).{2,}"title="Votre ville ne doit pas comporter de chiffre et doit contenir au minimum 2 caractères " required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Votre nouvelle adresse mail : </label>
            <div class="col-md-6 col-md-3">
                <input type="email" name="mail" ng-model="mail" class="form-control" placeholder="adresse mail" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Votre nouveau numero de téléphone :  </label>
            <div class="col-md-6 col-md-3">
                <input type="number" name="ntel" ng-model="ntel" class="form-control" placeholder="numero de telephone" required pattern="(?=.*[0-9]).{10}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" ><span class="glyphicon glyphicon-log-in"></span> Valider</button>
            </div>
            
        <div class="col-md-6 col-md-offset-3">
            @include('error')
        </div>
    </div>
        
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="reset" ><span class="glyphicon glyphicon-log-in"></span> Annuler</button>
            </div>
</div>
{!! Form::close() !!}
@stop

