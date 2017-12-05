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
                <input type="text" name="id" ng-model="id" class="form-control" placeholder="id" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Nom :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="nom" ng-model="nom" class="form-control" placeholder="nom" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Prénom :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="pre" ng-model="pre" class="form-control" placeholder="prenom" required>
            </div>
        </div>
   
         <div class="form-group">
            <label class="col-md-3 control-label">mdp :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="mdp" ng-model="mdp" class="form-control" placeholder="mdp" required>
            </div>
        </div>
    

        <div class="form-group">
            <label class="col-md-3 control-label">adresse :  </label>
            <div class="col-md-6 col-md-3">
                    <input type="text" name="ad" ng-model="ad" class="form-control" placeholder="adresse" required>
            </div>
        </div>
            <div class="form-group">
            <label class="col-md-3 control-label">code postal :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="cp" ng-model="cp" class="form-control" placeholder="cp" required>
            </div>
        </div>
            <div class="form-group">
            <label class="col-md-3 control-label">ville :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="ville" ng-model="ville" class="form-control" placeholder="ville" required>
            </div>
        </div>
            <div class="form-group">
            <label class="col-md-3 control-label">date embauche :  </label>
            <div class="col-md-6 col-md-3">
                <input type="date" name="de" ng-model="de" class="form-control" placeholder="date" required>
            </div>
        </div>
         <div class="form-group">
            <label class="col-md-3 control-label">statut :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="st" ng-model="st" class="form-control" placeholder="prenom" required>
            </div>
        </div>
            <div class="form-group">
            <label class="col-md-3 control-label">mail :  </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="mail" ng-model="mail" class="form-control" placeholder="mail" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">numero téléphone : </label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="tel" ng-model="tel" class="form-control" placeholder="telephone" required>
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

