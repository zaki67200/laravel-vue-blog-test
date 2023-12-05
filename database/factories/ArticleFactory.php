<?php
namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;


class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        $faker = \Faker\Factory::create('fr_FR'); // Utiliser Faker en français

        return [
            'titre' => $faker->sentence,
            'contenu' => $faker->paragraph,
            'categorie' => $faker->randomElement(['Technologie', 'Santé', 'Sport', 'Art', 'Science']), // Catégories prédéfinies
            'image' => $faker->imageUrl(640, 480, 'articles'),
            'user_id' => $faker->numberBetween(1, 50), // Assurez-vous que cette plage est valide par rapport à vos données utilisateur
            'is_published' => $faker->boolean
        ];
    }
}