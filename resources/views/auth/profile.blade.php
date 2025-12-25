@extends('base')
@section('titre', 'Page Profile')

@section('contenu')


    <div class="max-w-2xl w-100 bg-white rounded shadow overflow-hidden mt-4">
        <!-- Profile Header -->
        <div class="p-4 bg-white d-flex align-items-center">

            <div class="ms-4">
                <ul class="list-unstyled mb-0">
                    <li>
                        <h2 class="fw-bold fs-3 mb-1">{{ Auth::user()->name }}</h2>
                    </li>
                    <li><span class="fw-semibold">Email</span>: {{ Auth::user()->email }}</li>
                </ul>
            </div>
        </div>
    </div>

@endsection
