<?php

use Illuminate\Database\Seeder;

class HotelServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $titles = [
    	['title' => 'Restaurants', 'category' => 'FOOD-BEVERAGES'],
	    ['title' => 'Bars & Cafe', 'category' => 'FOOD-BEVERAGES'],
	    ['title' => 'Spa', 'category' => 'SPA-FITNESS'],
    ];

    public function run()
    {
	    foreach ($this->titles AS $key => $value){
		   \Hotel\Entities\HotelService::firstOrCreate(
		   	['title' => $value['title']], ['parent' => null, 'slug' => str_slug($value['title']), 'category' => $value['category']]);
	    }
    }
}
