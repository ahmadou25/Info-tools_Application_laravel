@extends('products.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier le produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}">Retour</a>
            </div>
        </div>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Il y a des erreurs dans le formulaire.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Nom :</strong>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Nom du produit">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Description :</strong>
                <textarea name="description" class="form-control" placeholder="Description">{{ $product->description }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Prix :</strong>
                <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="Prix">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <strong>Quantité en stock :</strong>
                <input type="text" name="stock" value="{{ $product->stock }}" class="form-control" placeholder="Quantité en stock">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-top:30px">
                <button type="submit" class="btn btn-success" style="margin-left:38px">Mettre à jour</button>
            </div>
        </div>
    </form>
@endsection
