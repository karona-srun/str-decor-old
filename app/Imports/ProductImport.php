<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class ProductImport implements ToCollection, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure, WithChunkReading, ShouldQueue, WithEvents
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.product_code' => 'required',
            '*.product_name' => 'required',
            '*.scale' => 'required',
            '*.buying_price' => 'required',
            '*.salling_price' => 'required',
            '*.buying_date' => 'required',
            '*.store_stock' => 'required',
            '*.warehouse' => 'required',
            '*.sold_out' => 'required',
            '*.description' => 'required',
            '*.note' => 'required'
        ],[
            '*.product_code.required' => __('app.code') . __('app.required'),
            '*.product_name.required' => __('app.product') . __('app.required'),
            '*.scale.required' => __('app.label_scale') . __('app.required'),
            '*.buying_price.required' => __('app.label_buying_price') . __('app.required'),
            '*.salling_price.required' => __('app.label_salling_price') . __('app.required'),
            '*.buying_date.required' => __('app.label_buying_date') . __('app.required'),
            '*.store_stock.required' => __('app.label_store_stock') . __('app.required'),
            '*.warehouse.required' => __('app.label_warehouse') . __('app.required'),
            '*.sold_out.required' => __('app.label_sold_out') . __('app.required'),
            '*.description.required' => __('app.label_description') . __('app.required'),
            '*.note.required' => __('app.label_note') . __('app.required'),
        ])->validate();

       
        foreach ($rows as $i => $row) {
            Product::insert([
                'product_code' => $row['product_code'],
                'product_name' => $row['product_name'],
                'scale' => $row['scale'],
                'buying_price' => $row['buying_price'],
                'salling_price' => $row['salling_price'],
                'buying_date' => $row['buying_date'],
                'store_stock' => $row['store_stock'],
                'warehouse' => $row['warehouse'],
                'sold_out' => $row['sold_out'],
                'description' => $row['description'],
                'note' => $row['note'],
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
    }

    public function rules(): array
    {
        return [];
    }

    public function chunkSize(): int
    {
        return 10000;
    }

    public static function afterImport(AfterImport $event)
    {
    }

    public function onFailure(Failure ...$failure)
    {
    }
}
