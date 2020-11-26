<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{


        public function index(){
             //si on a une categorie
         if (request()->categorie){
           $products= Product::with('categories')->whereHas('categories',function ($query){//une closure qui a en parametre la requete sur la relation
               $query->where('slug',request()->categorie);//sur les produit que je recupeere j'appele la relation ou le slug est egal a request category

             })->orderBy('created_at','desc')->paginate(6);



         }else{


          $products=Product::with('categories')->paginate(6);

         }
            return view ('products.index')->with('products',$products);
        }
        //Dans le fichier .env changer le cookie en file si on veux ajouter plusiers articles

        public function show($slug){

            $product=Product::where('slug', $slug)->first();



            return view ('products.show')->with('product',$product);
        }


        public function search(){

            request()->validate([

                'q'=>'required|min:3'
            ]);


    $q=request()->input('q');//on recupere l'input

   $products=Product::where('title','like',"%$q%")//on fait une recherche de non ayant la chaine de caractere tape dans l'input
    ->orWhere('description','like',"%$q%")
    ->paginate(6);
    return view('products.search')->with('products',$products);

        }




    }


