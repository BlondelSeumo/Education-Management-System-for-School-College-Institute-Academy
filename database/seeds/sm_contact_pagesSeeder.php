<?php

use App\SmContactPage;
use Illuminate\Database\Seeder;

class sm_contact_pagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SmContactPage::query()->truncate();
        // DB::table('sm_contact_pages')->insert([
        //     [
        //         'title' => 'Contact Us',
        //         'description' => 'Have any questions? We’d love to hear from you! Here’s how to get in touch with us.',
        //         'image' => 'public/uploads/contactPage/contact.jpg',
        //         'button_text' => 'Learn More About Us',
        //         'button_url' => 'about',
        //         'address' => '56/8 Panthapath, Dhanmondi,Dhaka',
        //         'address_text' => 'Santa monica bullevard',
        //         'phone' => '0184113625',
        //         'phone_text' => 'Mon to Fri 9am to 6 pm',
        //         'email' => 'admin@infixedu.com',
        //         'email_text' => 'Send us your query anytime!',
        //         'latitude' => '23.707310',
        //         'longitude' => '90.415480',
        //         'google_map_address' => 'Panthapath, Dhaka',
        //         'school_id' => 1,
        //     ],
        // ]);
    }
}
