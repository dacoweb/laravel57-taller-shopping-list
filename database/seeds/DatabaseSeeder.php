<?php

use App\User;
use App\Product;
use App\ShoppingItem;
use App\ShoppingList;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        Product::truncate();
        ShoppingItem::truncate();
        ShoppingList::truncate();
        User::truncate();

        factory(User::class, 20)->create();
        factory(Product::class, 100)->create();
        factory(ShoppingList::class, 50)->create();
        factory(ShoppingItem::class, 100)->create()->each(function($item){
            $shopping_list_id = ShoppingList::all()->random()->id;
            $item->shopping_list()->associate($shopping_list_id );
        });        
    }
}
