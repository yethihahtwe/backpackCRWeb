<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MalariaCase extends Model
{
    use HasFactory;

    protected $table = 'TBL_MALARIA';

    protected $primaryKey = 'DB_ID';

    protected $fillable = [
        'rx_month',
        'rx_year',
        'test_date',
        'name',
        'age',
        'address',
        'sex',
        'pregnancy',
        'rdt_bool',
        'rdt_pos_result',
        'symptom',
        'act24',
        'act24_amount',
        'act18',
        'act18_amount',
        'act12',
        'act12_amount',
        'act6',
        'act6_amount',
        'chloroquine',
        'chloroquine_amount',
        'primaquine',
        'primaquine_amount',
        'refer',
        'death',
        'receive_rx',
        'travel',
        'job',
        'other_job',
        'remark',
        'vol_name',
        'state',
        'tsp_mimu',
        'tsp_eho',
        'area',
        'vil',
        'usr_name',
        'usr_id',
    ];
}
