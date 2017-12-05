@extends('layouts.master')
@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="blanc">
            <h1>Suivre le paiment des fiches de frais des visiteurs</h1>
        </div>
        
        
        <p>Veuillez sélectionner un visiteur : </p>
        
        <select>
            @foreach($visiteurs as $visiteur)
            <option> {{ $visiteur->nom }} </option>
            @endforeach
        </select>
        <br><br>
        <button type="submit" class="btn btn-default btn-primary" >
                    <span class="glyphicon glyphicon-ok"></span> Valider </button>
    </div>
</div>
@stop