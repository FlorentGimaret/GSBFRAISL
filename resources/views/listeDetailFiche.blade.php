@extends('layouts.master')
@section('content')
<div class="container">
    <div class="col-md-8 col-sm-8">
        <div class="blanc">
            <h1>{{$titreVue or ''}}</h1>
        </div>
        <h3>Liste des frais forfait</h3>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th>id</th> 
                    <th>Quantité</th>  
                </tr>
            </thead>
            @foreach($lesFraisForfait as $unFF)
            <tr>   
                <td> {{ $unFF->idfrais }} </td> 
                <td> {{ $unFF->quantite }} </td> 
            </tr>
            @endforeach
        </table>
        <h3>Liste des frais hors forfait</h3>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th>Libellé</th> 
                    <th>Date</th> 
                    <th>Montant</th>  
                </tr>
            </thead>
            @foreach($lesFraisHorsForfait as $unFHF)
            <tr>   
                <td> {{ $unFHF->libelle }} </td> 
                <td> {{ $unFHF->date }} </td> 
                <td> {{ $unFHF->montant }} </td>                 
            </tr>
            @endforeach
            <tr>
                <td style="text-align: right"> Montant total :</td>
                <td>{{$montantTotal}}</td>
            </tr>
        </table>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <a href="{{ url('/getListeFrais')}}" ><button type="button" class="btn btn-default btn-primary" >Retour</button></a>                
            </div>           
        </div>  
        @include('error')
    </div>
</div>
@stop
