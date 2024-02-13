@extends('layout.sidebar');
@section('titre', 'Tableau de Bord');
@section('contenu')
    <div class="ui cards" style="border-radius:50px; display:flex;align-items:center; justify-content:center;">
        <div class="card">
            <div class="content">
                <div class="header"><i class="orange book icon"></i>Nombre de Cours : </div>
                <div class="description"> <strong>{{ $cour }}</strong></div>
            </div>
            <div class="ui button" data-tooltip="Ajouter un cour au niveau de la plateforme" data-position="top left">
                <i class="red add icon"></i>
                <a href="/admin/cour" style="color:black">Ajouter un Cour</a>
            </div>
        </div>
        <div class="card">
            <div class="content">
                <div class="header"><i class="yellow user icon"></i>Nombre de Eleves :</div>
                <div class="description"><strong>{{ $user }}</strong></div>
            </div>
            <div class="ui button" data-tooltip="Ajouter un eleve au niveau de la plateforme" data-position="top left">
                <i class="yellow add icon"></i><a href="/admin/eleve" style="color:black">Ajouter un Eleve</a>
            </div>
        </div>
        <div class="card">
            <div class="content">
                <div class="header"><i class="green book icon"></i>Nombre de Matieres :</div>
                <div class="description"><strong>{{ $matiere }}</strong></div>
            </div>
            <div class="ui button" data-tooltip="Ajouter une matiere au niveau de la plateforme" data-position="top left">
                <i class="green add icon"></i><a href="/admin/matiere" style="color:black">Ajouter une Matiere</a>
            </div>
        </div>
    </div>
    <h3>Liste Des Derniers Eleves:</h3>

    <table class="ui single line red striped table">
        <thead>
            <tr>
                <th>Numero</th>
                <th>Prenom Nom</th>
                <th>Date Enregistrement</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-left:50%; margin-bottom:30px;">
        <button class="ui primary basic button"><a href="/admin/eleve">Voir plus</a></button>
    </div>
@endsection
