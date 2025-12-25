@extends ('base' )
@section('titre', 'Creation d\'un article')

@section('contenu')
    @include('shop._form', ['valeurSubmit' => 'Créer'])
@endsection
