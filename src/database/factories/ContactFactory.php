<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {

        $faker = \Faker\Factory::create('ja_JP');//日本語の氏名や住所が作られるように設定

        $messages = [
            '商品の発送が遅れています。',
            '注文内容を変更したいです。',
            '商品に不具合があります。',
            'ショップへの問い合わせです。',
            'その他の質問です。',
        ];

        $gender = $faker->randomElement([1, 2, 3]);
        $fakerGender = match ($gender) {
            1 => 'male',
            2 => 'female',
            default => null,
        };

        return [
            'last_name' => $faker->lastName(),
            'first_name' => $faker->firstName($fakerGender),
            'gender' => $gender,
            'email' => $faker->unique()->safeEmail(),
            'tel' => preg_replace('/[^0-9]/', '', $faker->phoneNumber),
            'address' => $faker->address(),
            'building' => $faker->optional()->word(),
            'category_id' => $faker->numberBetween(1, 5),
            'detail' => $faker->randomElement($messages),
        ];
    }
}
