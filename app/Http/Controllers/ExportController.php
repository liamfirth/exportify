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
            if(!Cache::has($row[0])) {
                Cache::forever($row[0], json_encode($row));
            }
            
            $this->callSearchApi($row[2], $row[1]); 

            print_r(Cache::get($row[0]));

            return true;
        });

    }

    protected function callSearchApi($artist, $trackName)
    {
        //Create service container and inject into controller rather than call directly

        $artist = urlencode($artist);
        $trackName = urlencode($trackName);
        $client = new Client([
            'base_url' => 'https://itunes.apple.com/search?entity=song'
            ]);
        $request = $client->get('&term' . $artist . '+' . $trackName, ['verify' => false]);
        $response = $request->send();


        if(!$response->getStatusCode() == 200) {
            //HTTP exception
            echo "HTTP exception";
        }

        if(empty($response["results"])) {
            //No results
            echo "No results for" . $artist . " and " . $trackName;
        }

        Log::info($response["results"]["artistId"]);
        Log::info($response["results"]["trackId"]);


    }
}
