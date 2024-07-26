<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'form';
    
    protected $fillable = [
        'usuario_id', 'device_id',
        'data_atividade', 'hora_inicio', 'hora_fim', 'descricao_atividade', 'numero_os',
        'avaliacao_riscos', 'medidas_controle',
        'status', 'status_message'
    ];

    const STATUS = [
        'CREATED' => 'Criado',
        'PROCESSING' => 'Processando',
        'PROCESSED' => 'Processado',
        'ERROR' => 'Erro',
    ];

    public function getStatusDescricaoAttribute()
    {
        return self::STATUS[$this->status];
    }

    public function getEnvioFormatadoAttribute()
    {
        $data = Carbon::parse($this->created_at);
        return $data->format('d/m/Y H:i:s');
    }

    public function getDataAtividadeFormatadaAttribute()
    {
        $data = Carbon::parse($this->data_atividade);
        return $data->format('d/m/Y');
    }

    public function getHoraInicioFormatadaAttribute()
    {
        $data = Carbon::parse($this->hora_inicio);
        return $data->format('H:i');
    }

    public function getHoraFimFormatadaAttribute()
    {
        $data = Carbon::parse($this->hora_fim);
        return $data->format('H:i');
    }

    public function fotos()
    {
        return $this->hasMany('App\FormFoto', 'form_id', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'usuario_id', 'id');
    }

}
