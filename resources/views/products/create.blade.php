@extends('products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajouter un produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}">Retour</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Il y a des soucis dans votre formulaire.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <strong>Nom:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Nom du produit">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description du produit"></textarea>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <strong>Prix:</strong>
                    <input type="number" name="price" class="form-control" placeholder="Prix du produit">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <strong>Stock:</strong>
                    <input type="number" name="stock" class="form-control" placeholder="Quantité en stock">
                </div>
            </div>

            <div class="col-md-4" style="margin-top:20px">
                <button type="submit" class="btn btn-success">Ajouter</button>
            </div>
        </div>
    </form>
@endsection
