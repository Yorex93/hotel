<?php

use Illuminate\Database\Seeder;

class PageItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public $pages = [
    	'Home' => [
    		'title' => 'Home',
		    'for' => 'home',
		    'items' => [
		    	['for' => 'home.welcome', 'heading' => 'About Us', 'content' => '<p class="about_desc__subtitle">About us</p><h3 class="about_desc__title">AN OASIS OF SERENITY</h3>
                            <p class="">
                                Hotel Valerie is a luxury and affordable boutique hotel located in Asaba, Delta State Nigeria that provides to its guests elegant, comfortable and modern rooms, delicious meals and other facilities.
                            </p>
                            <p class="about_desc__desc">
                                Our signature style of hospitality and value is unmatched. No matter where you go, you will be surrounded by our friendly smiles. And the considerate service of staff will make your experience in our hotel wonderful and memorable
                            </p>'],
			    ['for' => 'home.rooms', 'heading' => 'Our Rooms', 'content' => 'All our rooms are ensuite bathrooms and have dial-up & wi-fi internet access, mini bar, safe box, hair dryers, intercom and telephone facilities that will make you feel completely at home.'],
			    ['for' => 'home.gallery', 'heading' => 'Our Gallery', 'content' => 'A couple of views from our hotel in Asaba'],
			    ['for' => 'home.testimonials', 'heading' => 'Testimonials', 'content' => 'What our customers say about us']

		    ]
	    ]
    ];


    public function run()
    {
        foreach ($this->pages AS $key => $value){
        	$page = \Hotel\Entities\Page::firstOrCreate(['for' => $value['for'], 'title' => $value['title']]);

        	foreach ($value['items'] AS $key2 => $value2){
				$item = \Hotel\Entities\PageItem::firstOrCreate([
					'for' => $value2['for'],
					'page_id' => $page->id
				], [
					'content' => $value2['content'],
					'heading' => $value2['heading']
				]);
	        }
        }
    }
}
