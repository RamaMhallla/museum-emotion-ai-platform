<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Emotion;

class EmotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emotions = [
            ['id' => 1, 'name' => 'Angry',    'name_it' => 'Arrabbiato'],
            ['id' => 2, 'name' => 'Disgust',  'name_it' => 'Disgusto'],
            ['id' => 3, 'name' => 'Fear',     'name_it' => 'Paura'],
            ['id' => 4, 'name' => 'Happy',    'name_it' => 'Felice'],
            ['id' => 5, 'name' => 'Sad',      'name_it' => 'Triste'],
            ['id' => 6, 'name' => 'Surprise', 'name_it' => 'Sorpresa'],
            ['id' => 7, 'name' => 'Neutral',  'name_it' => 'Neutrale'],
        ];

        foreach ($emotions as $emotion) {
            Emotion::updateOrCreate(
                ['id' => $emotion['id']],
                $emotion
            );
        }
    }
}
