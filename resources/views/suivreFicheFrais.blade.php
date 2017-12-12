@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'suiviFicheFrais']) !!}  
<div class="container">
    <div class="col-md-12">
        <div class="blanc">
            <h1>Suivre le paiment des fiches de frais des visiteurs</h1>
        </div>
        
        
        <p>Veuillez sélectionner un visiteur : </p>
        
        
        <select name = 'idVisiteur'>
            @foreach($visiteurs as $visiteur)
            <option value = '{{ $visiteur->id }}'>{{ $visiteur->id }} </option>
            
            @endforeach
        </select>
        
        <br><br>
        
        <p>Veuillez sélectionner un mois : </p>
        
        <select name = 'mois'>
            @foreach($mois as $unMois)
            <option value = '{{ $unMois->mois }}'> {{ $unMois->mois }} </option>
            
            @endforeach
        </select>
        
        <br><br>
        
           
        
       <button type="submit" class="btn btn-default btn-primary" >
                    <span class="glyphicon glyphicon-ok"></span>  Valider </button></a>
    </div>
    
    
    
</div>

{!! Form::close() !!}
@stop



