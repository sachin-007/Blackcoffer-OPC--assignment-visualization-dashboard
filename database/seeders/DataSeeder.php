<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Data; // Assuming your model is named Data

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use League\Csv\Reader;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path to the CSV file
        $filePath = storage_path('app/data.csv'); 
        
        // Read the CSV file
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // Set header row to be the first row
        
        // Get all records from the CSV
        $records = $csv->getRecords();

        // Iterate through the CSV rows and insert data into the database
        foreach ($records as $record) {
            try {
                // Insert data using Data model
                Data::create([
                    'end_year' => $this->convertToInteger($record['end_year']),
                    'citylng' => $this->convertToFloat($record['citylng']),
                    'citylat' => $this->convertToFloat($record['citylat']),
                    'intensity' => $this->convertToInteger($record['intensity']),
                    'sector' => $record['sector'],
                    'topic' => $record['topic'],
                    'insight' => $record['insight'],
                    'swot' => $record['swot'],
                    'url' => $record['url'],
                    'region' => $record['region'],
                    'impact' => $this->convertToInteger($record['impact']),
                    'added' => $this->convertToDate($record['added']),
                    'published' => $this->convertToDate($record['published']),
                    'start_year' => $this->convertToInteger($record['start_year']),
                    'city' => $record['city'],
                    'country' => $record['country'],
                    'relevance' => $this->convertToInteger($record['relevance']),
                    'pestle' => $record['pestle'],
                    'source' => $record['source'],
                    'title' => $record['title'],
                    'likelihood' => $this->convertToInteger($record['likelihood']),
                ]);
            } catch (\Exception $e) {
                // Log the error and continue processing
                Log::error('Error inserting data: ' . $e->getMessage());
            }
        }
    }

    /**
     * Convert the value to integer.
     * Return null if the value is empty or not a valid integer.
     */
    private function convertToInteger($value)
    {
        return is_numeric($value) ? (int)$value : null;
    }

    /**
     * Convert the value to float.
     * Return null if the value is empty or not a valid float.
     */
    private function convertToFloat($value)
    {
        return is_numeric($value) ? (float)$value : null;
    }

    /**
     * Convert the date value to a format that Carbon can handle.
     * Return null if the value is empty or invalid.
     */
    private function convertToDate($value)
    {
        // If the value is empty, return null
        if (empty($value)) {
            return null;
        }

        // Remove commas from the date string (like "June, 26 2018")
        $formattedValue = str_replace(',', '', $value);

        // Define date formats that we want to try
        $formats = [
            'F d Y H:i:s',  // June 26 2018 07:28:39
            'Y-m-d H:i:s',  // 2018-06-26 07:28:39
            'm/d/Y H:i:s',  // 06/26/2018 07:28:39
        ];

        // Try each format to parse the date
        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, $formattedValue)->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                // Continue to the next format
                continue;
            }
        }

        // As a last resort, try the general date parsing
        try {
            return Carbon::parse($formattedValue)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            // Log the error and return null if parsing fails
            Log::error('Date parsing failed: ' . $e->getMessage());
            return null;
        }
    }
}
