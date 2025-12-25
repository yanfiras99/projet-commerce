@extends('base')
@section('titre', 'Accueil')
@section('contenu')
    <h1>Liste des articles</h1>

    <div class="row">
        @foreach ($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->designation }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Référence: {{ $article->reference }}</h6>
                        <p class="card-text">{{ $article->description }}</p>
                        <p class="card-text">Prix HT: {{ $prixFormatter->formatNet($article->prix) }}</p>
                        <p class="card-text"><small class="text-muted">Prix TTC:
                                {{ $prixFormatter->formatAvecTVA($article->prix) }}</small></p>
                        <p class="card-text">Quantité en stock: {{ $article->qte_stock }}</p>
                        @if ($article->categorie)
                            <p class="card-text">Catégorie:<strong> {{ $article->categorie->name }}</strong></p>
                        @endif
                        @if ($article->packs->isNotEmpty())
                            <p class="card-text">Disponible dans les Packs:
                                @foreach ($article->packs as $pack)
                                    <span class="badge text-bg-secondary">{{ $pack->name }}</span>
                                @endforeach
                            </p>
                        @endif
                        <a href="{{ route('shop.show', [
                            'article' => $article->id,
                            'slug' => $article->slug,
                        ]) }}"
                            class="btn btn-primary">
                            Voir Détails
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- pour afficher les liens de pagination --}}
        {{ $articles->links() }}
    </div>
@endsection
