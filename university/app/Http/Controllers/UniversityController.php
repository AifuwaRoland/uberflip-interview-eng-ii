<?php

namespace App\Http\Controllers;
use App\Models\University;
use App\Models\Domain;
use App\Models\WebPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function fetch()
    {
        // get data from external api:

     
        
        $client = new Client();
        $url = 'http://universities.hipolabs.com/search'; // search api endpoint
        $requiredCountries = ["Canada", "United States"];
        // echo $res->getStatusCode(); // 200
        // echo $res->getBody(); // { "type": "User", ....
        foreach ($requiredCountries as $country) { 
            $endpoint = $url . "?country=" . $country;
            $res = $client->get($endpoint);
            
            if ($res->getStatusCode()) {
                $entries = json_decode($res->getBody(), true);
                echo "value is ".gettype($entries);
                foreach ($entries as $entry){
                    echo "in the loop";
                    $university = University::create([
                        'alpha_two_code' => $entry['alpha_two_code'],
                        'country' => $entry['country'],
                        'name' => $entry['name'],
                        'state-province' => $entry['state-province']
                    ]);
                 
                    $domains = $entry['domains'];
                    
                    foreach ($domains as $domain) {
                        echo "domain is a ".gettype($domain);
                        $domain_result = Domain::create([
                            'university_id' => $university['id'],
                            'domain_name' => $domain
                        ]);
                    }
                    
                    $webPages = $entry['web_pages'];
                    foreach ($webPages as $webPage) {
                        $webpage_result = WebPage::create([
                            'university_id' => $university['id'],
                            'url' => $webPage
                        ]);
                    }

                    echo $university;
                }
            }

                
        }
        
        // $entries = $res->getBody();
        
            


    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
