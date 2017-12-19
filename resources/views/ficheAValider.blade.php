@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'majFicheFrais']) !!}  
<div class="container">
    <div class="col-md-8 col-sm-8">
        <div class="blanc">
            <h1>Fiche à valider</h1>
        </div>
        @if($success!=null)
        <div class="alert alert-success">La modification a bien été prise en compte.</div>
        @endif
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
                <input type="hidden" name="id" value="{{ $laFiche->id }}"/>
                <input type="hidden" name="mois" value="{{ $laFiche->mois }}"/>
                <td>{{ $unFF->idfrais }}</td>
                <td><input type="text" name="{{ $unFF->idfrais }}" value="{{ $unFF->quantite }}" /></td>
            </tr>
            @endforeach
        </table>
            <button type="submit" class="btn btn-default btn-primary" >Mettre à jour les frais forfait</button>
        </form>
        {!! Form::close() !!}

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
                <input type="hidden" name="id" value="{{ $laFiche->id }}"/>
                <input type="hidden" name="mois" value="{{ $laFiche->mois }}"/>
                <input type="hidden" name="lib" value="{{ $unFHF->libelle }}"/>
                <input type="hidden" name="date" value="{{ $unFHF->date }}"/>
                <input type="hidden" name="montant" value="{{ $unFHF->montant }}"/>
                <td> {{ $unFHF->libelle }} </td> 
                <td> {{ $unFHF->date }} </td> 
                <td> {{ $unFHF->montant }} </td>  
                <td><a href="{{ url('/supprimerFHF') }}/{{ $laFiche->id}}/{{ $laFiche->mois }}/{{ $unFHF->id }}/{{ $unFHF->date }}/{{ $unFHF->montant }}"><center><button type="button"><span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="middle" title=""></span></button></center></a></td>
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

