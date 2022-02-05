<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Imports\CustomersImport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Output\ConsoleOutput;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     *
     */
    public function importcsv()
    {
        $console = new ConsoleOutput();
        $console->writeln('Start importcsv function');
        $console->writeln('Import CSV file from '.public_path().'/random.csv');
        $import = new CustomersImport();
        $import->import(public_path().'/random.csv',null, \Maatwebsite\Excel\Excel::CSV);

        if ($import->failures()->count()) {
            $console->writeln('Saving errors');
            Excel::store(new CustomersExport($import->failures()), 'errors.xlsx','public');
            $console->writeln('Errors saved in "/storage/app/public/errors.xlsx"');
        }

        $console->writeln('Function complete');


    }
}
