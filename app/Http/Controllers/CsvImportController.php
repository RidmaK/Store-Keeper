<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CsvImportController extends Controller
{
    static function import_csv(Request $request,$colmns){

      if(isset($request->file)){

        $csvFileName = $request->db_file;
        $csvfile = $request->file;

        if($csvfile->getSize() > 0){

          $header = null;
          $data = array();
              if (($handle = fopen($csvfile, 'r')) !== false)
              {
                  while (($row = fgetcsv($handle, 1000,',')) !== false)
                  {
                      if (!$header)
                          $header = $row;
                      else
                          $data[] = array_combine($header, $row);
                  }
                  fclose($handle);
              }
              return $data;
            //   if(count(array_diff($header,$colmns)) == 0){
            //       return $data;
            //   }else{
            //       return false;
            //   }

          }else{

          }
        }else{

        }
    }

    // check headers

    public function check_headers($header){

    }


}
