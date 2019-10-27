<?php

use Illuminate\Database\Seeder;


class TypeTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i <= 7; $i++) {
            $type       = new \App\Models\Type();
            $type->name = 'Weblancer '. $i;
            $type->img_url = '';
            $type->lang = 'ru';
            $type->save();
        }
    }
}
