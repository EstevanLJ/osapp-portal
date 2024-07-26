@extends('layouts.template')

@section('content')

<div class="empty-state">
  <div class="empty-state-container">
    <h3 class="state-header">Erro interno!</h3>
    
    <p class="state-description lead text-muted"> 
      Desculpe, o servidor encontrou um erro inesperado.
    </p>
    
    <div class="state-action">
      <a href="/" class="btn btn-lg btn-light"><i class="fa fa-angle-right"></i>Voltar</a>
    </div>

  </div>
</div>

@endsection
