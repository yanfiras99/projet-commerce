<?php

namespace App\Http\Controllers;

use App\Services\FormatagePrixService;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\FormArticleRequest;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Pack;

class ArticleController extends Controller
{
    // si le parametre est optionnel, on le precise avec le ?
    // public function index(Request $request, ?string $nom = 'anonyme')
    // {
    //     // si on utilise la route avec un parametre
    //     // dd($request->input('nom', 'anonyme'));

    //     // si on utilise la route avec un parametre dans l'URL dynamique
    //     dd("Bonjour $nom, bienvenue dans la boutique !");

    //     return 'Une première page avec Laravel';
    // }

    public function index(FormatagePrixService $prixFormatter)
    {
        // pour recuperer seulement certains champs des articles
        // $articles = Article::all(['id', 'designation', 'prix']);

        // pour recuperer les articles avec pagination
        // $articles = Article::paginate(2);

        // pour recuperer certains champs des articles avec pagination
        // $articles = Article::paginate(2, ['id', 'designation', 'prix']);

        // pour recuperer les articles dont le prix est superieur a 50
        // $articles = Article::where('prix', '>', 50)->get();


        // pour recuperer tous les articles en base de donnees
        // $articles = Article::all();
        // pour passer les articles a la vue shop.index.blade.php

        // avec les relations categorie et packs
        $articles = Article::with(['categorie', 'packs'])->paginate(3);

        return view('shop.index', [
            'articles' => $articles,
            'prixFormatter' => $prixFormatter
        ]);
    }

    public function show(string $slug, Article $article)
    {
        // pour recuperer un article par son id
        // $article = Article::find($id);
        // require $article;

        // Si aucun article ne correspond à l’id demandé, la fonction renvoie null. Pour 
        // renvoyer une exception dans ce cas, utiliser plutôt la méthode findOrFail(). 
        // $article = Article::findOrFail($id);

        //vérifier si le slug dans la B0 correspond au slug recu dans la requete:
        if ($article->slug !== $slug) {
            //redirection vers la page qui correpond au slug correct
            return redirect()->route("shop.show", ['slug' => $article->slug, 'article' => $article->id]);
        }
        // return de la vue shop.show.blade.php
        return view('shop.show', ['article' => $article]);

        // return "Slug: $slug <br> ID: $id";
    }

    public function create()
    {
        $article = new Article();
        return view('shop.create', [
            'article' => $article,
            'categories' => Categorie::all(['id', 'name']),
            'packs' => Pack::all(['id', 'name'])
        ]);
    }

    public function store(FormArticleRequest $request)
    {
        if ($request->user()->cannot('create', Article::class)) {
            abort(403, "Vous n'êtes pas autorisé à créer un article.");
        }
        // $article = Article::create($request->validated());
        // // pour attacher les packs selectionnés à l'article créé
        // $article->packs()->attach($request->validate('packs'));
        $data = $request->validated();

        $article = Article::create($data);

        // packs (many-to-many)
        if (isset($data['pack_ids'])) {
            $article->packs()->attach($data['pack_ids']);
        }
        return redirect()->route('shop.show', [
            'article' => $article->id,
            'slug' => $article->slug
        ])->with('success', 'Article créé avec succès !');
    }

    public function edit(Article $article)
    {
        return view('shop.edit', [
            'article' => $article,
            'categories' => Categorie::all(['id', 'name']),
            'packs' => Pack::all(['id', 'name'])
        ]);
    }

    public function update(FormArticleRequest $request, Article $article)
    {
        // $article->update($request->validated());

        // // pour synchroniser les packs selectionnés avec l'article modifié
        // $article->packs()->sync($request->validate('packs'));

        if ($request->user()->cannot('update', $article)) {
            abort(403, "Vous n'êtes pas autorisé à modifier cet article.");
        }
        $data = $request->validated();

        $article->update($data);

        // synchronisation des packs
        if (isset($data['pack_ids'])) {
            $article->packs()->sync($data['pack_ids']);
        } else {
            $article->packs()->detach();
        }
        return redirect()->route('shop.show', [
            'slug' => $article->slug,
            'article' => $article->id
        ])->with('success', "L'article est bien modifié");
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('shop.index')
            ->with('success', "L'article a bien été supprimé");
    }
}
