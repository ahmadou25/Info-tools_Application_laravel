@extends('products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Détails du produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}">Retour</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <strong>Nom:</strong>
                {{ $product->name }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $product->description }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <strong>Prix:</strong>
                {{ $product->price }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <strong>Stock:</strong>
                {{ $product->stock }}
            </div>
        </div>
    </div>
@endsection
