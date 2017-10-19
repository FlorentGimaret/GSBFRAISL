@extends('layouts.master')
@section('content')
<div class="container">
    <div class="col-md-8 col-sm-8">
        <div class="blanc">
            <h1>{{$titreVue or ''}}</h1>
        </div>

        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th>Libellé</th> 
                    <th>Date</th> 
                    <th>Montant</th>  
                    <th style="width:80px">Modifier</th>  
                    <th style="width:80px">Supprimer</th>  
                </tr>
            </thead>
            @foreach($mesFraisHorsForfait as $unFHF)
            <tr>   
                <td> {{ $unFHF->libelle }} </td> 
                <td> {{ $unFHF->date }} </td> 
                <td> {{ $unFHF->montant }} </td>                 
                <td style="text-align:center;"><a href="{{ url('/modifierFraisHorsForfait') }}/{{ $unFHF->id }}">
                        <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
                <td style="text-align:center;">
                    <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                       onclick="javascript:if (confirm('Suppression confirmée ?'))
                           { window.location ='{{ url('/supprimerFraisHorsForfait') }}/{{ $unFHF->id }}'; }">
                    </a>
                </td>                    
            </tr>
            @endforeach
            <tr>
                <td style="text-align: right"> Montant total :</td>
                <td>{{$montantTotal}}</td>
            </tr>
        </table>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <a href="{{ url('/ajouterFraisHorsForfait')}}/{{$mois}}" ><button type="button" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter</button></a>
                &nbsp;
                <a href="{{ url('/saisirFraisForfait')}}" ><button type="button" class="btn btn-default btn-primary" ><span class="glyphicon glyphicon-remove"></span> Retour</button></a>                
            </div>           
        </div>  
        @include('error')
    </div>
</div>
@stop
