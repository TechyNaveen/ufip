<?php

namespace App\Http\Controllers;

use App\Models\Csvfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class Upload extends Controller
{
    public function upload(Request $request)
    {

        $img = time() . '.' . $request->image->extension();

        $request->image->move(public_path('uploads'), $img);


        if (File::exists(public_path('uploads/' . $img))) {


            if (($handle = fopen(public_path('uploads/' . $img), 'r')) !== false) {
                fgetcsv($handle);
                while (($csv = fgetcsv($handle)) !== false) {
                    //  $data[] = $csv[0]; // Collect the first value of each row
                    DB::insert("insert into csvfiles (name) values(?)", [$csv[0]]);
                }
                fclose($handle); // Close the file after reading all rows
            }
        }



        return back()->with("names", "upload data successfully");
    }


    public function pagenat(){

        $page = Csvfile::paginate(10);
        return view('welcome', ['csvfiles' => $page]);
        

    }
}
