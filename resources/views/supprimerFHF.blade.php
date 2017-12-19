@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'fhfSup']) !!}  
<div class="container">
    <div class="col-md-8 col-sm-8">
        <div class="blanc">
            <h1>Supprimer le frais hors forfait?</h1>
        </div>

        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th>Visiteur</th> 
                    <th>Mois</th> 
                    <th>Libellé</th> 
                    <th>Date</th> 
                    <th>Montant</th>
                </tr>
            </thead>
            <tr>
            @foreach($affFHF as $leFrais)
                <td> {{ $leFrais->idVisiteur }} </td> 
                <td> {{ $leFrais->mois }} </td> 
                <td> {{ $leFrais->libelle }} </td> 
                <td> {{ $leFrais->date }} </td> 
                <td> {{ $leFrais->montant }} </td>
                

                <input type="hidden" name="id" value="{{ $leFrais->id }}"/>
                <input type="hidden" name="mois" value="{{ $leFrais->mois }}"/>
                <input type="hidden" name="idV" value="{{ $leFrais->idVisiteur }}"/>
            </tr>
            @endforeach
        </table>
        <h3>Indiquez le motif :</h3>
​        <textarea name="txtArea" rows="5" cols="70" required></textarea>        
        <br/>
        <br/>
        <span>
            <button type="submit" class="btn btn-default btn-primary">Supprimer</button>
            <a href="{{ url('/voirDetailFrais')}}/{{ $laFiche->id }}/{{ $laFiche->mois }}"><button type="button" class="btn btn-default btn-primary">Annuler</button></a>
        </span>
    </div>
</div>

@stop

