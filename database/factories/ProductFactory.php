<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nameOptions = [
            $this->faker->colorName . ' ' . $this->faker->word,
            $this->faker->firstName . "'s " . $this->faker->randomElement(['Classic', 'Premium', 'Deluxe']) . ' ' . $this->faker->word,
            $this->faker->randomElement(['Organic', 'Natural', 'Handmade']) . ' ' . $this->faker->word,
            $this->faker->randomNumber(2) . ' ' . $this->faker->randomElement(['Pack', 'Set', 'Bundle']) . ' of ' . $this->faker->word,
        ];
    
        $name = $this->faker->randomElement($nameOptions);
        $name = substr($name, 0, 30); // Limit name to 30 characters
    
        return [
            'name' => $name,
            'image' => $this->faker->imageUrl(),
            'size' => $this->faker->regexify('[a-zA-Z0-9]{1,20}'),
            'price' => $this->faker->numberBetween(0, 9999),
            'stock' => $this->faker->numberBetween(10, 20),
            'brand_id' => function () {
                return Brand::inRandomOrder()->first()->id;
            },
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'enable' => $this->faker->boolean(90), // 90% chances of being enabled
        ];
    }
}
    