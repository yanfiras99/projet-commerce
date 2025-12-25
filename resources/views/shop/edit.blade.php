@extends('base')

@section('titre', 'Modification de l\'article ' . $article->designation)

@section('contenu')
    @include('shop._form', ['valeurSubmit' => 'Modifier'])
@endsection
