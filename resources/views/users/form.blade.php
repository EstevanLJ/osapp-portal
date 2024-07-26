@extends('layouts.template')

@section('content')

<div class="page-section">
  <div class="card card-fluid">

    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link show active" data-toggle="tab" href="#info">Informações Gerais</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#certificates">Certificados</a>
        </li>
       
      </ul>
    </div>

    <div class="card-body">


      <a href="{{ route('users.index') }}"class="btn btn-secondary float-right"><i class="fa fa-arrow-left"></i> Voltar</a>
      <h5>{{ $title }}</h5>
      <hr>

      <form action="{{ $user->id ? route('users.update', $user->id) : route('users.store') }}" 
        method="POST" autocomplete="off">

        @csrf
        @method($user->id ? 'PUT' : 'POST')

        @if($user->id)
          <input type="hidden" name="id" value="{{ $user->id }}">
        @endif


        <div id="tabs" class="tab-content">
          <div class="tab-pane fade active show" id="info">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="tf1">Nome</label> 
                  <input value="{{ old('name', $user->name) }}"
                    type="text" name="name" class="form-control" placeholder="Nome da pessoa" required> 
                </div>
              </div>
            </div>
    
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="tf1">Endereço de e-mail</label> 
                  <input value="{{ old('email', $user->email) }}"
                    type="email" name="email" class="form-control" placeholder="ex. usuario@servidor.com" autocomplete="off" required> 
                </div>
              </div>
            </div>
    
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="sel1">Tipo</label> 
                  <select class="custom-select" name="type" required>
                    <option value="">Selecione</option>
                    @foreach ($types as $type => $text)
                      <option value="{{ $type }}" {{ old('type', $user->type) === $type ? 'selected' : '' }}>{{ $text }}</option>
                    @endforeach
                  </select>
                  <small id="tf1Help" class="form-text text-muted">Tipo do usuário. 
                    <ul>
                      <li><b>Reporter:</b> gera os formulários</li>
                      <li><b>Visualizador:</b> somente consulta</li>
                      <li><b>Padrão:</b> gera e consulta formulários</li>
                      <li><b>Administrador:</b> gerencia todo o sistema</li>
                    </ul>
                  </small>
                </div>
              </div>
            </div>
    
            <div class="row">
              <div class="col">
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="enabled" class="custom-control-input" id="ckb_enabled" readonly {{ old('enabled', $user->enabled) ? 'checked' : '' }}> 
                        <label class="custom-control-label" for="ckb_enabled">Habilitado?</label>
                    </div>
                    <small class="form-text text-muted">Usuários desabilitados não podem fazer login no sistema nem enviar formulários.</small>
                </div>
              </div>
            </div>
    
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="tf1">Senha</label> 
                  <input type="password" class="form-control" name="password" placeholder="Senha" autocomplete="off"> 
                </div>
              </div>
            </div>
    
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="tf1">Confirme a Senha</label> 
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Confirme a Senha" autocomplete="off"> 
                </div>
              </div>
            </div>

          </div>
          <div class="tab-pane fade" id="certificates">
            
            
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="tf1">Chave Privada</label> 
                  <textarea name="private_key" class="form-control" autocomplete="off" rows="10">{{ old('private_key', $user->private_key) }}</textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="tf1">Senha da chave privada</label> 
                  <input type="password" class="form-control" name="private_key_password" value="{{ $user->private_key_password }}" placeholder="Senha" autocomplete="off"> 
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="tf1">Certificado</label> 
                  <textarea name="certificate" class="form-control" autocomplete="off" rows="10">{{ old('certificate', $user->certificate) }}</textarea>
                </div>
              </div>
            </div>



          </div>
        </div>

        <button class="btn btn-primary float-right" type="submit">Salvar</button>

      </form>

    </div>
  </div>
</div>



@endsection