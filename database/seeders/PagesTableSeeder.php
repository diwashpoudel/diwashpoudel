<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = array(
            array(
                'title'=>'About Us',
                'slug'=>Str::slug('About Us'),
                'summary'=>'This Is about us Page Summary',
                'detail'=>'This is about us detail page'
                
            
            ),
            array(
                'title'=>'Terms And Condition',
                'slug'=>Str::slug('Terms and Condtion'),
                'summary'=>'This Is about us Page Terms and Condtion ',
                'detail'=>'This is about us detail page of Terms and Condition'
                
            
            ),
            array(
                'title'=>'Privacy Policy',
                'slug'=>Str::slug('privacy policy'),
                'summary'=>'This Is summary  Page of privacy policy ',
                'detail'=>'This is detail page of privacy policy'
                
            
            ),
            array(
                'title'=>'FAQ',
                'slug'=>Str::slug('faq'),
                'summary'=>'This Is summary of  faq page',
                'detail'=>'This is detail of faq page '
                
            
            )
        );

     foreach($list as $pages)
        {
            if(Page::where('slug', $pages['slug'])->count() <= 0)
            {
                Page::insert($pages);
            }
            
        }
    }
}
