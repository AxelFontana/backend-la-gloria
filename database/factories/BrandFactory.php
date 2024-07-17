<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        $name = $this->faker->unique()->word;
        $capitalizedName = ucfirst($name);
    
        return [
            'name' => $capitalizedName,
            'enable' => $this->faker->boolean(),
        ];
    }
    
}
