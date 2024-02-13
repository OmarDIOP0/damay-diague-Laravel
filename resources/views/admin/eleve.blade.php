@extends('layout.sidebar');
@section('titre','Gestion Eleve');
@section('contenu')
@if (Session::has('success'))
<div class="ui green visible message">
    {{ Session::get('success') }}
</div>
@endif

@if (Session::has('fail'))
<div class="ui red visible message">
    {{ Session::get('fail') }}
</div>
@endif
<button class="ui black button" onclick="openModal()">Ajouter un eleve</button>
<div class="ui modal" id="modalExample">
<i class="close icon"></i>
<div class="header">
    Creation Eleve
</div>
<form class="ui form" action="/admin/eleve" method="post">
    @csrf
    <div class="content">
        <div class="ui form">
            <div class="ui segment">
            <div class="field">
                <label>Name</label>
                <input type="text" name="name" placeholder="Saisir le prenom et nom">
                <div class="ui red">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" placeholder="Saisir l email">
                <div class="ui red">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="Saisir le mot de passe">
                <div class="ui red">
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        </div>
    </div>
    <div style="text-align:right;margin-bottom: 10px;">
        <button type="submit" class="ui inverted green button">Enregistrer</button>
    </div>
</form>

</div>
<h3>Liste Des Eleves:</h3>
<table class="ui single line red striped table">
    <thead>
      <tr>
        <th>Numero</th>
        <th>Prenom Nom</th>
        <th>Date Enregistrement</th>
        <th>E-mail</th>
        <th colspan="2">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->created_at }}</td>
        <td>{{ $user->email }}</td>
        <td><a href="/admin/updateEleve/{{$user->id}}"><i class="blue edit icon"></i></a></td>
        <td><a href="/admin/deleteEleve/{{$user->id}}"><i class="red archive icon"></i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
    {{-- <div class="ui pagination menu" style="width: 20px;"> --}}
        {{$users->links()}}
    {{-- </div> --}}
<script>
    function openModal() {
        $('#modalExample').modal('show');
    }
</script>
@endsection
