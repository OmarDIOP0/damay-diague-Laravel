@extends('layout.sidebar')
@section('titre','Gestion Matiere')
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
    <button class="ui black button" onclick="openModal()">Creer une Matiere</button>
    <div class="ui modal" id="modalExample">
        <i class="close icon"></i>
        <div class="header">
            Creation Matiere
        </div>
        <form class="ui form" action="/admin/matiere" method="post">
            @csrf
            <div class="content">
                <div class="ui form">
                    <div class="field" style="margin-bottom: 10px;">
                        <label style="margin:10px 10px">Libelle</label>
                        <input type="text" name="libelle" placeholder="Saisir le libelle du niveau">
                        <div class="ui red">
                            @error('libelle')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align:right;margin-bottom: 10px;">
                <button type="submit" class="ui inverted green button">Enregistrer</button>
            </div>
        </form>

    </div>
    <h3>La liste des matieres</h3>
    @if(!empty($matieres))
    <table class="ui striped red table">
        <thead>
        <tr>
            <th>Numero</th>
            <th>Libelle</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($matieres as $matiere)
        <tr>
            <td class="positive">{{$matiere->id}}</td>
            <td>{{$matiere->libelle}}</td>
            <td>
                <a href="/admin/updateMatiere/{{$matiere->id}}" style="color:black;"><i class="blue edit icon"></i></a></button>
            </td>
            <td>
                <button class="ui button" onclick="confirmSuppression()" style="background-color: white;" type="button">
                    <i class="red archive icon" ></i>
                </button>
                <div class="ui basic modal" id="confirmation-modal">
                    <div class="ui icon header">
                      <i class="exclamation triangle icon"></i>
                      Confirmation de suppression
                    </div>
                    <div class="content">
                      <p>Etes-vous sûr de vouloir supprimer cet élément ?</p>
                    </div>
                    <div class="">
                      <div class="ui rec basic cancel inverted button">
                          <i class="remove icon"></i>
                          Non
                      </div>
                      <div class="ui green inverted button">
                          <i class="checkmark icon"></i>
                          <a href="/admin/deleteMatiere/{{$matiere->id}}">Oui</a>
                      </div>
                    </div>
                  </div>
            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
    @else
     <p>La liste des matieres est vide !</p>
    @endif
    {{$matieres->links()}}
    <script>
        function openModal() {
            $('#modalExample').modal('show');
        }
        function confirmSuppression(){
                $('#confirmation-modal').modal({
                }).modal('show');
        }
    </script>
@endsection
