@extends('layouts.template')

@section('content')

<div class="empty-state">
  <div class="empty-state-container">
    <h3 class="state-header">Sem permissão!</h3>
    
    <p class="state-description lead text-muted"> 
      Desculpe, você não tem acesso a esse módulo.
    </p>
    
    <div class="state-action">
      <a href="/" class="btn btn-lg btn-light"><i class="fa fa-angle-right"></i>Voltar</a>
    </div>

  </div>
</div>

@endsection
