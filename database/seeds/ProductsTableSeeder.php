<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {

        $faker=Faker\Factory::create();//faker permet de generer aleatoirement des chaines de caracteres
        for ($i=0; $i < 30 ; $i++) {//boucle for pour creer des produits
       Product::create([

        'title'=>$faker->sentence(4),//je veux un titre a 15 mots
        'slug'=>$faker->slug,
        'subtitle'=>$faker->sentence(5),//une phrase de 10 mots
        'description'=>$faker->text,//la focntion text de faker
        'price'=>$faker->numberBetween(15, 300) * 100,//des prix entre 15 et 300 euros on stocke le prix en centimes
        'image'=> 'https://via.placeholder.com/200x250'



       ])->categories()->attach([  //on relie notre tables categories a nos produit
                rand(1, 4), //on aura 2 categories a chacun de nos produits
                rand(1, 4)

       ]);
       //je renseigne fon fichier databaseSeeder.php

       //ensuite php artisan db:seed pour enregistrer les informations dans ma base de donnée
        }
    }
}
