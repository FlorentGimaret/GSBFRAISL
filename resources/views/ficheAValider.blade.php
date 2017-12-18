@extends('layouts.master')
@section('content')
<div class="container">
    <div class="col-md-8 col-sm-8">
        <div class="blanc">
            <h1>Fiche à valider</h1>
        </div>
        
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:20%">Visiteur</th> 
                    <th style="width:20%">Nom</th> 
                    <th style="width:20%">Prénom</th> 
                    <th style="width:20%">Mois</th>
                    <th style="width:20%">Nb justificatifs</th> 
                    <th style="width:20%">Montant</th> 
                    <th style="width:20%">Date de dernière modification</th> 
                </tr>
            </thead>
            <tr>   
                <td> {{ $laFiche->id }} </td>
                <td> {{ $laFiche->nom }} </td>
                <td> {{ $laFiche->prenom }} </td>
                <td> {{ $laFiche->mois }} </td>
                <td> {{ $laFiche->nbJustificatifs }} </td>
                <td> {{ $laFiche->montantValide }} </td>
                <td> {{ $laFiche->dateModif }} </td>
            </tr>
        </table>
        
        <h3>Liste des frais forfait</h3>
        <form>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th>id</th> 
                    <th>Quantité</th>  
                </tr>
            </thead>
            
            @foreach($lesFraisForfait as $unFF)
            <tr>   
                <td>{{ $unFF->idfrais }}</td>
                <td><input type="text" value="{{ $unFF->quantite }}" /></td>
            </tr>
            @endforeach
        </table>
            <button type="button" class="btn btn-default btn-primary" >Mettre à jour les frais forfait</button>
        </form>
        
        <h3>Liste des frais hors forfait</h3>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th>Libellé</th> 
                    <th>Date</th> 
                    <th>Montant</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            @foreach($lesFraisHorsForfait as $unFHF)
            <tr>   
                <td> {{ $unFHF->libelle }} </td> 
                <td> {{ $unFHF->date }} </td> 
                <td> {{ $unFHF->montant }} </td>  
                <td><center><span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="middle" title=""></span></center></td>
            </tr>
            @endforeach
            <tr>
                <td style="text-align: right"> Montant total :</td>
                <td>{{$montantTotal}}</td>
            </tr>
        </table>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <a href="{{ url('/validerFicheFrais')}}" ><button type="button" class="btn btn-default btn-primary" >Retour</button></a>
                <a href="{{ url('/listeFicheFrais')}}/{{ $laFiche->id}}/{{ $laFiche->mois }}/{{ $montantTotal }}" ><button type="button" class="btn btn-default btn-primary" >Valider</button></a>
            </div>           
        </div>

        @include('error')
    </div>
</div>
@stop

