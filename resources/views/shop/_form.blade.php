<form action="{{ $article->id ? route('shop.update', $article) : route('shop.store') }}" method="post"
    class="vstack gap-2">

    @csrf

    @if ($article->id)
        @method('PATCH')
    @endif

    <div class="form-group">
        <label>Designation</label>
        <input type="text" class="form-control" name="designation"
            value="{{ old('designation', $article->designation) }}">
        @error('designation')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Reference</label>
        <input type="text" class="form-control" name="reference" @error('reference') is-invalid @enderror
            value="{{ old('reference', $article->reference) }}">
        @error('reference')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" name="description">{{ old('description', $article->description) }}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Prix</label>
        <input type="number" class="form-control" step="0.001" name="prix"
            value="{{ old('prix', $article->prix) }}">
        @error('prix')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Quantité</label>
        <input type="number" class="form-control" name="qte_stock" value="{{ old('qte_stock', $article->qte_stock) }}">
        @error('qte_stock')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="categorie">Categorie</label>
        <select id="categorie" class="form-control
@error('categorie_id') is-invalid @enderror" name="categorie_id">
            <option value="">choisir une categorie</option>
            @foreach ($categories as $categorie)
                {{-- La directive @selected() a été utilisée pour présélectionner la catégorie choisie par 
l                           ’utilisateur en cas d’échec de la validation du formulaire.   --}}
                <option @selected(old('categorie_id', $article->categorie_id) == $categorie->id) value="{{ $categorie->id }}"> {{ $categorie->name }}</option>
            @endforeach
        </select>
        @error('categorie_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    @php
        $packsIds = $article->packs->pluck('id')->toArray();
    @endphp

    <div class="form-group mb-3">
        <label for="pack">Packs</label>
        <select id="pack" class="form-control @error('pack_ids') is-invalid @enderror" name="pack_ids[]" multiple>

            @foreach ($packs as $pack)
                <option value="{{ $pack->id }}" @selected(in_array($pack->id, old('pack_ids', $packsIds)))>
                    {{ $pack->name }}
                </option>
            @endforeach
        </select>

        @error('pack_ids')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-primary" type="submit">
        {{ $valeurSubmit }}
    </button>
</form>
