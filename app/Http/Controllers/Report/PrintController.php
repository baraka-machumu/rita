<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jaspersoft\Client\Client;

class PrintController extends Controller
{

    public function __construct()
{
    $this->middleware('auth');
}

    public  function  certificate($entryNo,$type){

//        dd($entryNo);
        $URL_TO_PRINT = "/new/birth";
        if ($type==2){

            $URL_TO_PRINT = "/reports/replace-certificate/print";

        }

        else if($type==3){

            $URL_TO_PRINT = "/reports/duplicate-certificate/print";

        }


        else if($type ==4){

            // type 4 == new death certificate

            $URL_TO_PRINT =  "/reports/new-death-certificate/print";

        }


        else if($type ==5){

            // type 4 == new death certificate

            $URL_TO_PRINT =  "/reports/new-death-certificate/print";

        }


        else if($type ==6){

            // type 6== error coreecton death certificate

            $URL_TO_PRINT =  "/reports/new-death-certificate/print";


        }



        return view('reports.view_new_certificate_to_print',compact('URL_TO_PRINT','entryNo'));

    }

    public  function  print($entryNo){


//        dd($entryNo);
        $url  =  "http://localhost:8080/jasperserver";
        $user  =  "jasperadmin";
        $password  =  "jasperadmin";

        $server  =  new Client($url,$user,$password);

        $report_url =  "/reports/rita/birth_certificate";

        $inputControls   = [

            'EntryNo'=>$entryNo
        ];

        $getReport  =  $server->reportService()->runReport($report_url,'pdf',null,null,$inputControls);
        header('Content-Type: application/pdf');
        echo   $getReport;

    }



    public  function  deathPrint($entryNo){

        $url  =  "http://localhost:8080/jasperserver";
        $user  =  "jasperadmin";
        $password  =  "jasperadmin";

        $server  =  new Client($url,$user,$password);

        $report_url =  "/reports/rita/death_certificate";

        $inputControls   = [

            'EntryNo'=>$entryNo
        ];

        $getReport  =  $server->reportService()->runReport($report_url,'pdf',null,null,$inputControls);
        header('Content-Type: application/pdf');
        echo   $getReport;

    }


}
