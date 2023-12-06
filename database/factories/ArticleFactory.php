<?php
namespace Database\Factories;
use Database\Factories\CustomFakerProvider;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    protected $imageUrls = [];

    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new CustomFakerProvider($faker));

        $categories = ['animals', 'business', 'cats', 'city', 'food', 'nature', 'people', 'sports', 'technics', 'transport'];
        $selectedCategory = $faker->randomElement($categories);

        // Générer une URL d'image liée à la catégorie (vérifier si elle a déjà été générée)
        if (!isset($this->imageUrls[$selectedCategory])) {
            $image = $faker->urlPicsumPhotos(400, 300, $selectedCategory);
            $this->imageUrls[$selectedCategory] = $image;
        } else {
            $image = $this->imageUrls[$selectedCategory];
        }

        return [
            'titre' => $faker->sentence,
            'contenu' => $faker->paragraph,
            'categorie' => $selectedCategory,
            'image' => $image,
            'user_id' => $faker->numberBetween(1, 50), // Assurez-vous que cette plage est valide par rapport à vos données utilisateur
            'is_published' => $faker->boolean,
        ];
    }
}