<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cache;
use Log;
use League\Csv\Reader;
use GuzzleHttp\Client;

class ExportController extends Controller
{

    public function export(Request $request)
    {

        $csv = $request->input('csv');

        if (!$csv)
        {
            return Redirect::back()->withErrors(['error', 'No export data found.']);
        }

        if (is_array($csv)) {
    
        }

        $reader = Reader::createFromString($csv);
        $reader->setOffset(1);
        $items = $reader->fetchAll(function($row) {
            // Cache::get('spotify:key:here') 
            
            $this->callSearchApi($row[2], $row[1]); 

            return true;
        });

    }

    protected function callSearchApi($artist, $trackName)
    {
        //Create service container and inject into controller rather than call directly

        $artist = urlencode($artist);
        $trackName = urlencode($trackName);
        $client = new Client(['verify' => false]);
        $request = $client->get('https://itunes.apple.com/search?entity=song&term=' . $artist . '+' . $trackName);

        if(!$request->getStatusCode() == 200) {
            //HTTP exception
            Log::info("HTTP exception");
        }

        $response = $request->getBody();

        $result = json_decode($response, true);

        Log::info($result);

    }
}
