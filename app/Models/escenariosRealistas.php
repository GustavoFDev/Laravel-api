<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use MongoDb\Laravel\Eloquent\Model;

class escenariosRealistas extends Model
{
    //
    protected $fillable = [
        'applicant_id',
        'er_1',
        'er_2',
        'er_3',
        'er_4',
        'er_5',
        'er_6',
        'er_7',
        'er_8',
        'er_9',
        'er_10',
        'er_11',
        'er_12',
        'er_13',
        'er_14',
        'er_15',
        'er_16',
        'er_17',
        'er_18',
        'er_19',
        'er_20',
        'er_21',
        'er_22',
        'er_23',
        'er_24',
        'er_25',
        'er_26',
        'er_27',
        'er_28',
        'er_29',
        'er_30',
        'er_31',
        'er_32',
        'er_33',
        'er_34',
        'er_35',
        'er_36',
        'er_37',
        'er_38',
        'er_39',
        'er_40',
        'er_41',
        'er_42',
        'er_43',
        'er_44',
        'er_45',
        'er_46',
        'er_47',
        'er_48',
        'er_49',
        'er_50',
        'er_51',
        'er_52',
        'er_53',
        'er_54',
        'er_55',
        'er_56',
        'er_57',
        'er_58',
        'er_59',
        'er_60',
        'er_61',
        'er_62',
        'er_63',
        'er_64',
        'er_65',
        'er_66',
        'er_67',
        'er_68',
        'er_69',
        'er_70',
        'er_71',
        'er_72',
        'er_73',
        'er_74',
        'er_75',
        'er_76',
        'er_77',
        'er_78',
        'er_79',
        'er_80',
        'current_step',
        'remaining_time',
        'status'
    ];
    

    public function applicant() 
    { 
        return $this->belongsTo(Applicant::class, 'applicant_id'); 
    }
}
