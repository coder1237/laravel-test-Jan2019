<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Product
{


    protected $format = 'Y-m-d H:i:s';
    private $data_path = 'products.json';

    public $products = [];

    public function __construct()
    {
        $products = $this->getAll();

        if(empty($products)){
            $this->products = collect([]);
        }else{
            $this->products = $products;
        }
    }

    public function getAll()
    {
        try{
            $data = json_decode(Storage::disk('local')->get('products.json'),true);
            if(!empty($data)){
                return collect($data)->transform(function($item){
                       return (object)$item;
                });
            }
            return $data;

        }catch (\Exception $e){
            //session()->flash('error',$e->getMessage());
        }
        return collect([]);
    }

    public function save($input){
        $product = new \stdClass();
        $product->id = $this->generateID();
        $product->name = $input['name'];
        $product->price = $input['price'];
        $product->quantity = $input['quantity'];
        $product->created_at = $this->getTimestamp();
        $product->updated_at = null;
        $this->products->push($product);
        $this->updateDB();
        return $product;
    }

    private function updateDB(){
        $file = $this->products->toJson();
        Storage::disk('local')->put($this->data_path,$file);
    }

    private function generateID()
    {
        $max_id = $this->products->max('id');
        if($max_id){
            return $max_id+1;
        }
        else{
            return 1;
        }

    }

    public function delete($id){
        $before_items = $this->products->count();
        $this->products = $this->products->filter(function($product) use($id){
            return $product->id != $id;
        });

        $after_items = $this->products->count();

        $this->updateDB();
        return $before_items != $after_items;
    }

    public function update($id,$input){
        $this->products = $this->products->map(function ($product) use ($id,$input){
            if($product->id == $id){
                $product->name = $input['name'];
                $product->price = $input['price'];
                $product->quantity = $input['quantity'];
                $product->updated_at = $this->getTimestamp();
            }
            return $product;
        });
        $this->updateDB();
        return true;
    }

    public function getTimestamp(){
        return now()->format($this->format);
    }

    public function find($id){
        $product = $this->products->where('id',$id)->first();
        if(empty($product)){
            abort(404);
        }
        return $product;
    }



}