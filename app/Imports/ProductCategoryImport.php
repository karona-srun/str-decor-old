<?php

namespace App\Imports;

use App\Models\ProductCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class ProductCategoryImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.code' => 'required',
            '*.name' => 'required',
            '*.note' => 'required',
        ])->validate();

        foreach ($rows as $i => $row) {
            ProductCategory::insert([
                'code'     => $row['code'],
                'name'    => $row['name'],
                'note' => $row['note'],
            ]);
        }
    }
}
