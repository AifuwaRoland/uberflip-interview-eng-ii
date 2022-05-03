<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\University;
use App\Models\Domain;
use App\Models\WebPage;
   
class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:api';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from external Universities API';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        echo "Consuming university api..."; 
        $url = 'http://universities.hipolabs.com/search'; // search api endpoint
        $requiredCountries = ["Canada", "United States"]; // array of countries to append to the apl endpoint url
        foreach ($requiredCountries as $country) { 
            $endpoint = $url . "?country=" . $country;
            $res = $client->get($endpoint);
            
            if ($res->getStatusCode()) {
                $entries = json_decode($res->getBody(), true);
                foreach ($entries as $entry){
                    //add the fetched data into the university table 
                    $university = University::create([ 
                        'alpha_two_code' => $entry['alpha_two_code'],
                        'country' => $entry['country'],
                        'name' => $entry['name'],
                        'state-province' => $entry['state-province']
                    ]);
                  //add the fetched data into the domains table 
                    $domains = $entry['domains'];
                    
                    foreach ($domains as $domain) {
                        $domain_result = Domain::create([
                            'university_id' => $university['id'],
                            'domain_name' => $domain
                        ]);
                    }
                     //add the  data into the web_pages table 
                    $webPages = $entry['web_pages'];
                    foreach ($webPages as $webPage) {
                        $webpage_result = WebPage::create([
                            'university_id' => $university['id'],
                            'url' => $webPage
                        ]);
                    }
                }
            } 
        }
        //if successfull, echo success:
        echo 'Data load from API successful!'; 
    }
}