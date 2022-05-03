<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'universities';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    
    protected $fillable = [
        'alpha_two_code',
        'country',
        'state-province',
        'name',
    ];

    public $alpha_two_code;
    public $country;
    public $state_province;
    public $name;


     /**
     * The relationships that are eager loaded by default
     *
     * @var string[]
     */
    protected $with = [
        'domains',
        'webpages',
    ];

    /**
     * Define that a university can have many domains
     *
     */
    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    /**
     * Define that a university can have many web pages
     *
     */
    public function webPages()
    {
        return $this->hasMany(WebPage::class);
    }
}
