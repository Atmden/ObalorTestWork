<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class CustomersImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnFailure, SkipsOnError
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Log::debug($row);
        $fi = str_word_count($row['name'], 1);

        return new Customer([
            'name' => $fi[0],
            'surname' => $fi[1],
            'email' => $row['email'],
            'age' => $row['age'],
            'location' => $row['location'],
            'country_code' => $this->getCountryCode($row['location'])
        ]);
    }

    public function checkCountry($location)
    {
        $country = Country::where('name', $location)->first();
        if ($country == null) {
            return 'Unknown';
        } else {
            return $country->name;
        }
    }

    public function getCountryCode($location)
    {
        if ($location != 'Unknown') {
            $country = Country::where('name', $location)->first();
            if ($country != null) {
                $code = $country->code;
            } else {
                $code = null;
            }
        } else {
            $code = null;
        }

        return $code;

    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.age' => ['numeric', 'min:18', 'max:99'],
            '*.email' => ['required', 'unique:customers,email', 'email:rfc,dns'],
        ];
    }

    public function prepareForValidation($data, $index)
    {
        $data['location'] = $this->checkCountry($data['location']);

        return $data;
    }

    /**
     * @param Throwable $e
     */


    /**
     * @param Failure[] $failures
     */

}
