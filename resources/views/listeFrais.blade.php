@extends('layouts.master')
@section('content')
<div class="container">
    <div class="col-md-5">
        <div class="blanc">
            <h1>Liste des frais</h1>
        </div>
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:20%">Période</th> 
                    <th style="width:20%">Nb justificatifs</th> 
                    <th style="width:20%">Montant valide</th> 
                    <th style="width:20%">Etat</th> 
                    <th style="width:20%">Détails</th>  
                </tr>
            </thead>
            @foreach($mesFrais as $unFrais)
            <tr>   
                <td> {{ $unFrais->mois }} </td> 
                <td> {{ $unFrais->nbJustificatifs }} </td> 
                <td> {{ $unFrais->montantValide }} </td> 
                <td> {{ $unFrais->idEtat }} </td> 
                <td style="text-align:center;"><a href="{{ url('/voirDetailFrais') }}/{{ $unFrais->mois }}">
                        <span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Voir"></span></a></td>
            </tr>
            @endforeach
        </table>
        @include('error')
    </div>
</div>
@stop
