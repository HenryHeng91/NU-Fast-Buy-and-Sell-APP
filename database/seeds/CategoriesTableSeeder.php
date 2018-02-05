<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 0;
        $data = [
            /////////////////////////Parent Categories:

            [
                'id' => 1,
                'category_name' => 'Phone & Tablets',
                'category_name_khmer' => 'ទូរស័ព្ទ និង Tablets',
                'category_parent' => null,
                'category_image' => null
            ],
            [
                'id' => 2,
                'category_name' => 'Computers & Accessories',
                'category_name_khmer' => 'កុំព្យូទ័រ និង គ្រឿងបន្លាស់',
                'category_parent' => null,
                'category_image' => null
            ],
            [
                'id' => 3,
                'category_name' => 'Electronics & Appliances',
                'category_name_khmer' => 'អេឡិចត្រូនិច និង គ្រឿងប្រើប្រាស់',
                'category_parent' => null,
                'category_image' => null
            ],
            [
                'id' => 4,
                'category_name' => 'Cars and Vehicles',
                'category_name_khmer' => 'រថយន្ត និង យានយន្ត',
                'category_parent' => null,
                'category_image' => null
            ],
            [
                'id' => 5,
                'category_name' => 'House & Lands',
                'category_name_khmer' => 'ផ្ទះ និង ដី',
                'category_parent' => null,
                'category_image' => null
            ],
            [
                'id' => 6,
                'category_name' => 'Fashion & Beauty',
                'category_name_khmer' => 'សម្លៀកបំពាក់',
                'category_parent' => null,
                'category_image' => null
            ],
            [
                'id' => 7,
                'category_name' => 'Books, Sports & Other',
                'category_name_khmer' => 'សៀវភៅ សំភារះកីឡា និង ផ្សេងៗ',
                'category_parent' => null,
                'category_image' => null
            ],
            [
                'id' => 8,
                'category_name' => 'Furniture & Decor',
                'category_name_khmer' => 'គ្រឿងសង្ហារឹម និង ដេគ័រ',
                'category_parent' => null,
                'category_image' => null
            ],


            /////////////////////////Child Categories:
            [
                'category_name' => 'Phones',
                'category_name_khmer' => 'ទូរស័ព្ទ',
                'category_parent' => 1,
                'category_image' => null
            ],
            [
                'category_name' => 'Tablets',
                'category_name_khmer' => 'Tablets',
                'category_parent' => 1,
                'category_image' => null
            ],
            [
                'category_name' => 'Phone Accessories',
                'category_name_khmer' => 'គ្រឿងបន្លាស់ទូរស័ព្ទ',
                'category_parent' => 1,
                'category_image' => null
            ],
            [
                'category_name' => 'Phone Numbers',
                'category_name_khmer' => 'លេខទូរស័ព្ទ',
                'category_parent' => 1,
                'category_image' => null
            ],
            [
                'category_name' => 'Computers',
                'category_name_khmer' => 'កុំព្យូទ័រ',
                'category_parent' => 2,
                'category_image' => null
            ],
            [
                'category_name' => 'Computer accessories',
                'category_name_khmer' => 'គ្រឿងកុំព្យូទ័រ',
                'category_parent' => 2,
                'category_image' => null
            ],
            [
                'category_name' => 'Softwares',
                'category_name_khmer' => 'កម្មវិធី',
                'category_parent' => 2,
                'category_image' => null
            ],
            [
                'category_name' => 'Furniture & Decor',
                'category_name_khmer' => 'គ្រឿងសង្ហារឹម និង ដេគ័រ',
                'category_parent' => 2,
                'category_image' => null
            ],
            [
                'category_name' => 'Consumer Electronics',
                'category_name_khmer' => 'ឧបករណ៍អេឡិចត្រូនិក',
                'category_parent' => 3,
                'category_image' => null
            ],
            [
                'category_name' => 'Security Camera',
                'category_name_khmer' => 'កាមេរ៉ាសុវត្ថិភាព',
                'category_parent' => 3,
                'category_image' => null
            ],
            [
                'category_name' => 'Cameras, camcorders',
                'category_name_khmer' => 'ម៉ាស៊ីនថត និង កាមេរ៉ា',
                'category_parent' => 3,
                'category_image' => null
            ],
            [
                'category_name' => 'TVs, Videos and Audios',
                'category_name_khmer' => 'ទូរទស្សន៍ គ្រឿងបំពងសំឡេង និង វីដេអូ',
                'category_parent' => 3,
                'category_image' => null
            ],
            [
                'category_name' => 'Home appliances ',
                'category_name_khmer' => 'ប្រដាប់ប្រើប្រាស់ក្នុងផ្ទះ',
                'category_parent' => 3,
                'category_image' => null
            ],
            [
                'category_name' => 'Video games, consoles, toys',
                'category_name_khmer' => 'ឧបគរណ៍ហ្គេម និង ឧបករណ៍ក្មេងលេង',
                'category_parent' => 3,
                'category_image' => null
            ],
            [
                'category_name' => 'Cars',
                'category_name_khmer' => 'រថយន្ត',
                'category_parent' => 4,
                'category_image' => null
            ],
            [
                'category_name' => 'Motorcycles',
                'category_name_khmer' => 'ម៉ូតូ',
                'category_parent' => 4,
                'category_image' => null
            ],
            [
                'category_name' => 'Car Parts & Accessories',
                'category_name_khmer' => 'គ្រឿងបន្លាស់ឡាន',
                'category_parent' => 4,
                'category_image' => null
            ],
            [
                'category_name' => 'Houses',
                'category_name_khmer' => 'ផ្ទះ',
                'category_parent' => 5,
                'category_image' => null
            ],
            [
                'category_name' => 'Lands',
                'category_name_khmer' => 'ដី',
                'category_parent' => 5,
                'category_image' => null
            ],
            [
                'category_name' => 'Jewelry & Watches',
                'category_name_khmer' => 'គ្រឿងអលង្ការ និង នាឡិកា',
                'category_parent' => 6,
                'category_image' => null
            ],
            [
                'category_name' => 'Clothing & Accessories',
                'category_name_khmer' => 'សម្លៀកបំពាក់ និង គ្រឿងលំអរ',
                'category_parent' => 6,
                'category_image' => null
            ],
            [
                'category_name' => 'Beauty & Healthcare',
                'category_name_khmer' => 'គ្រឿងសំអាង និង សុខភាព',
                'category_parent' => 6,
                'category_image' => null
            ],
            [
                'category_name' => 'Books',
                'category_name_khmer' => 'គ្រឿងសង្ហារឹម និង ដេគ័រ',
                'category_parent' => 7,
                'category_image' => null
            ],
            [
                'category_name' => 'Sports Equipment',
                'category_name_khmer' => 'ឧបករណ៍កីឡា',
                'category_parent' => 7,
                'category_image' => null
            ],
            [
                'category_name' => 'CDS, DVDS, VHS',
                'category_name_khmer' => 'CDS, DVDS, VHS',
                'category_parent' => 7,
                'category_image' => null
            ],
            [
                'category_name' => 'Household Items',
                'category_name_khmer' => 'សម្ភារៈក្នុងផ្ទះ',
                'category_parent' => 8,
                'category_image' => null
            ],
            [
                'category_name' => 'Office Furniture',
                'category_name_khmer' => 'សម្ភារៈក្នុងការិយាល័យ',
                'category_parent' => 8,
                'category_image' => null
            ],
            [
                'category_name' => 'Home Furniture',
                'category_name_khmer' => 'គ្រឿងសង្ហារឹមក្នុងផ្ទះ',
                'category_parent' => 8,
                'category_image' => null
            ],
            [
                'category_name' => 'Kitchenware',
                'category_name_khmer' => 'សម្ភារៈក្នុងផ្ទះបាយ',
                'category_parent' => 8,
                'category_image' => null
            ],
            [
                'category_name' => 'Handicrafts Paintings',
                'category_name_khmer' => 'សិប្បកម្ម និងគំនូរ',
                'category_parent' => 8,
                'category_image' => null
            ]
        ];
        DB::table('categories')->insert($data);
    }
}
