<?php

namespace App\Models\Epi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SuspectCase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'epi_suspect_cases';
    protected $fillable = [
        'type',
        //datos chagas
        'research_group',
        'chagas_result_screening',
        'chagas_result_screening_at',
        'chagas_result_confirmation',
        'chagas_result_confirmation_at',
        'newborn_week',
        //fin datos chagas

        'age', 'gender', 'sample_at', 'epidemiological_week',
        'origin', 'run_medic', 'symptoms', 'symptoms_at',
        
        'result_ifd_at', 'result_ifd', 'subtype',
        'pcr_sars_cov_2_at', 'pcr_sars_cov_2', 'sample_type', 'validator_id',
        'sent_external_lab_at', 'external_laboratory', 'paho_flu', 'epivigila',
        'gestation', 'gestation_week', 'close_contact', 'functionary',
        'notification_at', 'notification_mechanism',
        'discharged_at',
        'observation', 'minsal_ws_id', 'case_type', 'positive_condition',
        'patient_id', 'laboratory_id', 'establishment_id', 'organization_id',
        'user_id', 'mother_id',
        'chagas_result_screening_file',
        'chagas_result_confirmation_file',


        //Datos Examen Directo o 
        'direct_exam_at',
        'direct_exam_result',
        'direct_exam_file',

        //datos primera PCR
        'pcr_first_at',
        'pcr_first_result',
        'pcr_first_file',

        //datos segunda PCR
        'pcr_second_at',
        'pcr_second_result',
        'pcr_second_file',


        //datos tercera PCR
        'pcr_third_at',
        'pcr_third_result',
        'pcr_third_file',

        //datos del solicitante
        'creator_id',
        'requester_id',
        'request_id',
        'request_at',


        //datos del tomador de muestra
        'sample_id',
        'sampler_id',
        'sample_at',

        //datos del receptor
        'reception_at', 
        'receptor_id',
    ];

    protected $dates = [
        'sample_at', 'symptoms_at', 'reception_at', 'result_ifd_at', 'pcr_sars_cov_2_at', 'sent_external_lab_at',
        'notification_at', 'discharged_at', 'deleted_at', 'chagas_result_confirmation_at', 'chagas_result_screening_at',
        'direct_exam_at',
        'pcr_first_at',
        'pcr_second_at',
        'pcr_third_at',
        'request_at',
    ];


    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    public function establishment()
    {
        return $this->belongsTo('App\Models\Organization', 'organization_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function receptor()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'requester_id', 'id');
    }

    public function requester()
    {
        return $this->belongsTo('App\Models\User', 'requester_id', 'id');
    }

    public function sampler()
    {
        return $this->belongsTo('App\Models\User', 'sampler_id', 'id');
    }


    public function mother()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tracings()
    {
        return $this->hasMany('App\Models\Epi\Tracing');
    }

    
}
