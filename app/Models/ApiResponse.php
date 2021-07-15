<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiResponse extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'api_response';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'response_id';
    
    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date_time', 'http_response'];

    protected $casts = [        
        'date_time' => 'datetime',
        'http_response' => 'array'
    ];
}
