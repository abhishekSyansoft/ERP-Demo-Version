<?php
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportClass implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Category([
            'parent_id' => $row['parent_id'],
            'category_name' => $row['category_name'],
            'created_at' => Carbon::now()
            // Add more fields as needed
        ]);
    }
}