<?php

use App\SmBookCategory;
use Illuminate\Database\Seeder;

class sm_book_categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        SmBookCategory::query()->truncate();
        $book_categories=['Action and adventure','Alternate history','Anthology','Chick lit','Kids','Comic book','Coming-of-age','Crime','Drama',
            'Fairytale','Fantasy','Graphic novel','Historical fiction','Horror', 'Mystery','Paranormal romance','Picture book','Poetry',
            'Political thriller','Romance','Satire','Science fiction','Short story', 'Suspense','Thriller','Young adult','Art','Autobiography',
            'Biography','Book review','Cookbook','Diary','Dictionary','Encyclopedia', 'Guide','Health','History','Journal','Math','Memoir',
            'Prayer','Religion, spirituality, and new age', 'Textbook','Review','Science','Self help','Travel','True crime'];
        foreach ($book_categories as $c) {
            DB::table('sm_book_categories')->insert([
                [
                    'category_name' => $c
                ]
            ]);
        } 
    }
}
