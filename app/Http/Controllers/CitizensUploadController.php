<?php namespace convercity\Http\Controllers;

use convercity\Helpers\Uploader;
use convercity\Http\Requests;
use convercity\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CitizensUploadController extends Controller {


    public function getIndex()
    {
        return view('app.citizen.upload');
    }

    /**
     *
     * @return number of citizens created
     *
     */
    public function postUserCsv()
    {
        $uploads = Uploader::csvToCitizens($_FILES['file']['tmp_name']);

        Session::flash('flash_success', $uploads . " new citizens uploaded or updated.");

        return redirect('/');

    }

}
