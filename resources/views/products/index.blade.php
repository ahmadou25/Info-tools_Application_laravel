@extends('products.layout')
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="pull-left">
                <h2>Gestion des produits</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-40">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th width="255px">Actions 
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('products.create') }}">
                                <i class='fa fa-plus-circle'> </i> Ajouter un produit
                            </a>
                        </div>
                    </th>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Actions">
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Détails</a>
                                    <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Éditer</a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
