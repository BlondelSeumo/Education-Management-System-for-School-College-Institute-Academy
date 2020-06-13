<?php

use Illuminate\Database\Seeder;
use App\SmBook;

class sm_booksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            'Algorithms & Data Structures',
            'Cellular Automata',
            'Cloud Computing',
            'Competitive Programming',
            'Compiler Design',
            'Database',
            'Datamining',
            'Information Retrieval',
            'Licensing',
            'Machine Learning', 
            'Mathematics',  
        ];
        $i=1;
        foreach ($books as $book) { 
        $store = new SmBook();
        $store->book_category_id = $i;
        $store->book_title = $book;
        $store->book_number = 'B-'.$i;
        $store->isbn_no = 'ISBN-0'.$i; 
        $store->publisher_name = 'Infix';
        $store->author_name = 'Author Infix'; 
        $store->subject_id = 1+ $i%5;
        $store->rack_number = $i;
        $store->quantity =100+ $i;
        $store->book_price =300+ 20* $i; 
        $store->save();
        $i++;
    }
    }
}
