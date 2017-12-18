@extends('layouts.master')
@section('content')
<div class="container">
    <div class="col-md-8 col-sm-8">
        <div class="blanc">
            <h1>Valider fiche frais</h1>
        </div>
        <br/>
        @if($FichesFraisClo==NULL)
        <div class="alert alert-danger">Il n'y a aucune fiche frais à valider.</div>
        @else
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:20%">Visiteur</th> 
                    <th style="width:20%">Nom</th> 
                    <th style="width:20%">Prénom</th> 
                    <th style="width:20%">Mois</th>
                    <th style="width:20%">Nb justificatifs</th> 
                    <th style="width:20%">Montant valide</th> 
                    <th style="width:20%">Détails</th>  
                </tr>
            </thead>
            @foreach($FichesFraisClo as $unFrais)
            <tr>   
                <td> {{ $unFrais->id }} </td>
                <td> {{ $unFrais->nom }} </td>
                <td> {{ $unFrais->prenom }} </td>
                <td> {{ $unFrais->mois }} </td>
                <td> {{ $unFrais->nbJustificatifs }} </td>
                <td> {{ $unFrais->montantValide }} </td>
                <td style="text-align:center;"><a href="{{ url('/voirDetailFrais') }}/{{ $unFrais->id}}/{{ $unFrais->mois }}">
                <span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title=""></span></a></td>
            </tr>
            @endforeach
        </table>
        
    </div>
</div>
@endif
@stop
