<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FormFoto extends Model
{
    protected $table = 'form_foto';
    
    protected $fillable = [
        'form_id', 'descricao', 
        'caminho_foto', 'geolocalizacao', 'exif', 'carimbo_tempo'
    ];

    public function getLocationAttribute()
    {
        return json_decode($this->geolocalizacao);
    }

    public function getHorarioAttribute()
    {
        $location = json_decode($this->geolocalizacao);
        $data = Carbon::parse(intval(substr($location->timestamp, 0, 10)), 'UTC');
        $data->tz = config('app.timezone');

        return $data->format('d/m/Y H:i:s');
    }

    public function form()
    {
        return $this->belongsTo('App\Form', 'id', 'form_id');
    }
}
