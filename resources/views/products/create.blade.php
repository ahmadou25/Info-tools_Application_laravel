@extends('products.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajout d'un produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}">Retour</a>
            </div>
        </div>
    </div>

    <form method="post" action="{{url('products')}}" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Il y a des erreurs dans votre formulaire.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="form-group col-md-4">
                <strong>Nom du produit :</strong>
                <input type="text" name="name" class="form-control" placeholder="Nom du produit">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <strong>Description :</strong>
                <textarea name="description" class="form-control" placeholder="Description du produit"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <strong>Prix :</strong>
                <input type="text" name="price" class="form-control" placeholder="Prix du produit">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <strong>Quantité en stock :</strong>
                <input type="text" name="stock" class="form-control" placeholder="Quantité en stock">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4" style="margin-top:20px">
                <button type="submit" class="btn btn-success">Ajouter</button>
            </div>
        </div>
    </form>
@endsection
