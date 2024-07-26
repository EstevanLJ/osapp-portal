<style>
  body {
      font-family: Arial, Helvetica, sans-serif;
      padding: 0;
      margin: 0;
  }    


  .pergunta {
      margin-bottom: 32px;
      width: 705px;
      word-wrap: break-word;
  }

  .informacao {
      margin-top: 0px;
      margin-bottom: 0px;
  }

  .titulo {
      text-align: center;
      margin-top: 0px;
      margin-bottom: 0px;
  }

  .sub-titulo {
      text-align: center;
      margin-top: 0px;
      margin-bottom: 16px;
  }

  .font-weight-bold {
    font-weight: bold;
  }

  div.page_break {
    page-break-before: always;
  }
</style>

<head>
    <title>APR</title>
</head>



    <h2 class="titulo">APR - ANÁLISE PRELIMINAR DE RISCO</h2>
  
    <br>
    <span class="font-weight-bold">Usuario:</span> {{ $form->usuario->name }}
    <br>
    <span class="font-weight-bold">ID do dispositivo:</span> {{ $form->device_id }}
    <br>
    <span class="font-weight-bold">Hora do envio:</span> {{ $form->envio_formatado }}

    <h4 class="text-center">Informações Gerais</h4>
    <hr>

    <br>
    <span class="font-weight-bold">Data da Atividade:</span> <span>{{ $form->dataAtividadeFormatada }}</span>
    <br>
    <span class="font-weight-bold">Horário de início:</span> <span>{{ $form->hora_inicio_formatada }}</span>
    <br>
    <span class="font-weight-bold">Horário de término:</span> <span>{{ $form->hora_fim_formatada }}</span>
    <br>
    <span class="font-weight-bold">Descrição da atividade:</span> <span>{{ $form->descricao_atividade }}</span>

    
    <h4 class="text-center">Avaliação dos Riscos</h4>
    <hr>

    {{-- @foreach (json_decode($form->avaliacao_riscos) as $index => $item)
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="ckb_{{$index}}" readonly {{ $item->checked ? 'checked' : '' }}> 
            <label class="custom-control-label" for="ckb7">{{ $item->text }}</label>
        </div>
    @endforeach --}}

    <h4 class="text-center">Medidas de Segurança</h4>
    <hr>
    @foreach (json_decode($form->medidas_controle) as $index => $item)
        <div class="custom-control custom-checkbox">
            <span>{{ $item->checked ? 'checked' : 'nao' }} </span>
            <img style="height: 30px" src="" />
            <label class="custom-control-label" for="ckb7">{{ $item->text }}</label>
        </div>
    @endforeach


<div class="page_break"></div>

<h4 class="text-center">Fotos</h4>

@foreach ($fotos as $index => $foto)


    <p>{{ $foto['descricao'] }}</p>



    {{-- <div>
        <img style="max-height: 700px" 
            src="data:image/png;base64,{{$foto['conteudo']}}" alt="foto">
    </div> --}}

    <br>
    <span class="font-weight-bold">Horário:</span> {{ $foto['horario'] }}
    <br>
    <span class="font-weight-bold">Latitude:</span> {{ $foto['location']->coords->latitude }}
    <br>
    <span class="font-weight-bold">Longitude:</span> {{ $foto['location']->coords->longitude }}
    <br>
    <span class="font-weight-bold">Altitude:</span> {{ number_format($foto['location']->coords->altitude, 2) . ' m' }}

    @if($index !== sizeof($fotos)-1)
        <div class="page_break"></div>
    @endif
    
@endforeach
