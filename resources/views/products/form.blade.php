@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{!empty($product) ? 'Update product' :'Create product' }}
                        <a class="btn btn-dark btn-sm float-right" href="{{route('products.index')}}">Back to product</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ !empty($product) ? route('products.update',$product->id) : route('products.store')}}">
                            @csrf

                            @if(!empty($product))
                                @method('put')
                            @endif

                            <div class="col-md-8">
                                <div class="form-product">
                                    <label for="name">Product name</label>
                                    <input type="text" name="name" value="{{ !empty($product->name) ? $product->name : old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="Enter product name" >
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-product">
                                    <label for="quantity">Product quantity</label>
                                    <input type="text" name="quantity" value="{{ !empty($product->quantity) ? $product->quantity : old('quantity') }}" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" id="quantity" placeholder="Enter product quantity" >
                                    @if ($errors->has('quantity'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                               <div class="form-product">
                                    <label for="price">Product Price</label>
                                    <input type="text" name="price" value="{{ !empty($product->price) ? $product->price : old('price') }}" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" id="price" placeholder="Enter product price" >
                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">{{!empty($product) ? 'Update' : 'Create' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection