@extends ('base' )
{{-- titre dynamique --}}
@section('titre', $article->designation)

@section('contenu')
    <h2>{{ $article->designation }}</h2>
    <ul>
        <li>{{ $article->prix }}TND</li>
        <li>{{ $article->description }}</li>
        <li>Quantité disponible: {{ $article->qte_stock }}</li>
    </ul>
    <div class="d-flex gap-2">
        {{-- lien pour modifier --}}
        <a href="{{ route('shop.edit', $article) }}" class="btn btn-warning">Modifier</a>

        {{-- lien pour supprimer --}}
        <form action="{{ route('shop.destroy', $article) }}" method="POST"
            onsubmit="return confirm('etes-vous sur de vouloir supprimer cet article ?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Supprimer</button>
        </form>

    </div>
@endsection
