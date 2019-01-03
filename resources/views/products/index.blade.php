@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Products
                        <a class="btn btn-outline-success btn-sm float-right" href="{{route('products.create')}}">Create new product</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product name</th>
                                <th scope="col">Product quantity</th>
                                <th scope="col">Product price($)</th>
                                <th scope="col">Product total($)</th>
                                <th scope="col">SubmittedOn</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $total_amount = 0;
                            @endphp
                            @forelse($products as $product)
                                @php
                                    $total_amount+= $product->price * $product->quantity;
                                @endphp
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->price * $product->quantity}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-xs " href="{{route('products.edit',$product->id)}}">Edit</a>
                                        <a class="btn btn-outline-danger btn-xs "
                                           onclick="event.preventDefault();
                                                     document.getElementById('product{{$product->id}}').submit();">Delete</a>

                                        <form id="product{{$product->id}}" action="{{route('products.destroy',$product->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        Products not available at the moment!
                                    </td>
                                    <td></td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="7">
                                    <h4 class="text-right">Total: {{$total_amount}}</h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection