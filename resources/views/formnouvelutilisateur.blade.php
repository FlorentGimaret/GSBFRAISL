@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'creeNouveauVisiteur']) !!}  
<div class="col-md-12 well well-md">
    <center><h1>création d'un nouvel utilisateur</h1></center>
    <br>
    <div class="form-horizontal">  
        <div class="form-group">
            <label class="col-md-3 control-label">id :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text"  name="id" ng-model="id" value="{{$id}}" class="form-control" placeholder="id" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Nom :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="nom" ng-model="nom" value="{{$nom}}" class="form-control" placeholder="nom" pattern="(?=.*[a-z]).{2,}" title="Votre nom ne doit pas comporter de chiffre et doit contenir au minimum 2 caractères "required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Prénom :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="pre" ng-model="pre" value="{{$prenom}}" class="form-control" placeholder="prenom"  pattern="(?=.*[a-z]).{2,}"title="Votre prénom ne doit pas comporter de chiffre et doit contenir au minimum 2 caractères " required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">adresse :  </label>
            <div class="col-md-6 col-md-3">
                    <input type="text" name="ad" ng-model="ad" value="{{$adresse}}" class="form-control" placeholder="adresse" required>
            </div>
        </div>
            <div class="form-group">
            <label class="col-md-3 control-label">code postal :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="cp" ng-model="cp" value="{{$cp}}" class="form-control" placeholder="cp" required pattern="[0-9]{5}" title="Votre code postal doit contenir 5 chiffres"/>
            </div>
        </div>
            <div class="form-group">
            <label class="col-md-3 control-label">ville :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="ville" ng-model="ville" value="{{$ville}}" class="form-control" placeholder="ville" pattern="(?=.*[a-z]).{2,}"title="Votre ville ne doit pas comporter de chiffre et doit contenir au minimum 2 caractères " required>
            </div>
        </div>
            <div class="form-group">
            <label class="col-md-3 control-label">date embauche :  </label>
            <div class="col-md-6 col-md-3">
                <input type="date" name="de" ng-model="de" value="{{$dateEmbauche}}" class="form-control" placeholder="date" required>
            </div>
        </div>
         
            <div class="form-group">
            <label class="col-md-3 control-label">mail :  </label>
            <div class="col-md-6 col-md-3">
                <input type="email" name="mail" ng-model="mail" value="{{$mail}}" class="form-control" placeholder="mail" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">numero téléphone : </label>
            <div class="col-md-6 col-md-3">
                <input type="number" name="ntel" ng-model="ntel" value="{{$ntel}}" class="form-control" placeholder="telephone" required pattern="(?=.*[0-9]).{10}">
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

