<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CustomersExport implements FromView
{
    private $errors;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return View
     */
    public function view(): View
    {

        return view('errors', [
            'errors' => $this->errors
        ]);
    }
}
