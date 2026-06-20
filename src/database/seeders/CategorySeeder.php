<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'メンズ',
            'レディース',
            'キッズ',
            'インテリア・住まい・小物',
            '本・音楽・ゲーム',
            'おもちゃ・ホビー・グッズ',
            '家電・スマホ・カメラ',
            'スポーツ・レジャー',
            'ハンドメイド',
            'その他',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
