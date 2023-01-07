<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '256M');
        $collectionToInsert = collect([]);

        $numberOfEntries = 50000;
        $maxInsertCount  = 1000000;
        $insertedCount   = 0;
        $chunkSize       = 1000;
        $insertFields = implode(',', (new ProductFactory())->insertFields());

        while ($insertedCount < $maxInsertCount) {
            for ($i = 1; $i <= $numberOfEntries; $i++) {
                $collectionToInsert->push((new ProductFactory())->definition());
            }

            foreach ($collectionToInsert->chunk($chunkSize) as $chunk) {
                $insertValues = '';
                foreach ($chunk as $chunkItem) {
                    $insertValues .=
                        '("'.$chunkItem['field_name_value'].'",'
                        .'"'.$chunkItem['field_okdp_value'].'",'
                        .$chunkItem['field_price_value'].',"'
                        .$chunkItem['field_alias_value'].'",'
                        .$chunkItem['visibility'].',"'
                        .$chunkItem['created_at'].'","'
                        .$chunkItem['updated_at']. '"),';
                }
                $insertValues = substr($insertValues,0,-1);
                DB::statement('insert into content_type_products ('.$insertFields.') values '.$insertValues);
            }

            $collectionToInsert = collect([]);
            $insertedCount += $numberOfEntries;
        }
    }
}
