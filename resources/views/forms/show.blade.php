@extends('layouts.template')

@section('content')

<div class="page-section">

    <div class="card card-fluid">
        <div class="card-body">

            <a href="{{ route('forms.index') }}"class="btn btn-secondary float-right"><i class="fa fa-arrow-left"></i> Voltar</a>
            <h5>Informações do envio</h5>
            <hr>

            <div class="row">
                <div class="col-2">
                    <p class="font-weight-bold">Usuario:</p>
                </div>
                <div class="col">
                    <p>{{ $form->usuario->name }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <p class="font-weight-bold">ID do dispositivo:</p>
                </div>
                <div class="col">
                    <p>{{ $form->device_id }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <p class="font-weight-bold">Hora do envio:</p>
                </div>
                <div class="col">
                    <p>{{ $form->envio_formatado }}</p>
                </div>
            </div>

            <hr>

            <h5 class="text-center">Informações Gerais</h5>
            <div class="row mb-3">
                <div class="col">
                    <span class="font-weight-bold">Data da Atividade:</span> <span>{{ $form->dataAtividadeFormatada }}</span>
                </div>
                <div class="col">
                    <span class="font-weight-bold">Horário de início:</span> <span>{{ $form->hora_inicio_formatada }}</span>
                </div>
                <div class="col">
                    <span class="font-weight-bold">Horário de término:</span> <span>{{ $form->hora_fim_formatada }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="font-weight-bold">Descrição da atividade:</span> <span>{{ $form->descricao_atividade }}</span>
                </div>
            </div>

    
            <hr>

            <div class="row">
                <div class="col">
                    <h5 class="text-center">Avaliação dos Riscos</h5>
                    @foreach (json_decode($form->avaliacao_riscos) as $index => $item)
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="ckb_{{$index}}" readonly {{ $item->checked ? 'checked' : '' }}> 
                                <label class="custom-control-label" for="ckb7">{{ $item->text }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col">
                    <h5 class="text-center">Medidas de Segurança</h5>
                    @foreach (json_decode($form->medidas_controle) as $index => $item)
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="ckb_{{$index}}" readonly {{ $item->checked ? 'checked' : '' }}> 
                                <label class="custom-control-label" for="ckb7">{{ $item->text }}</label>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <hr>
            <h5 class="text-center">Fotos</h5>
            
            <div class="row">
                @foreach ($form->fotos as $foto)
                    <div class="col-6">
                        <p class="font-weight-bold">{{ $foto->descricao }}:</p>
                        <img style="height: 300px;" src="{{ route('forms.foto', $foto->id) }}" alt="foto">
                        <br>
                        <span><span class="font-weight-bold">Horário:</span> {{ $foto->horario }}</span>
                        <br>
                        <span><span class="font-weight-bold">Latitude:</span> {{ $foto->location->coords->latitude }}</span>
                        <br>
                        <span><span class="font-weight-bold">Longitude:</span> {{ $foto->location->coords->longitude }}</span>
                        <br>
                        <span><span class="font-weight-bold">Altitude:</span> {{ number_format($foto->location->coords->altitude, 2) . ' m' }}</span>
                        <br>
                        <span>
                            <span class="font-weight-bold">Carimbo:</span>
                            <button class="btn btn-sm btn-outline-primary" onclick="abrirModal('{{$foto->carimbo_tempo}}')"><i class="fa fa-eye"></i></button>
                        </span>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>
</div>


<div id="modalStamp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carimbo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script>

        function abrirModal(stamp) {
            $('#modalStamp .modal-body').html('<p style="word-break: break-word;">' + stamp + '</p>');
            $('#modalStamp').modal('show');
        }

    </script>
@endpush