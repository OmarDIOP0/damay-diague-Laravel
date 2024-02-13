@extends('layout.sidebar')
@section('titre', 'Gestion Niveau')
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
    <button class="ui black button" onclick="openModal()">Creer un Niveau</button>
    <div class="ui modal" id="modalExample">
        <i class="close icon"></i>
        <div class="header">
            Creation Niveau
        </div>
        <form class="ui form" action="/admin/niveau" method="post">
            @csrf
            <div class="content">
                <div class="ui form">
                    <div class="field" style="margin-bottom: 10px;">
                        <label style="margin:10px 10px;">Libelle</label>
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
   <h3>La liste des niveaux</h3>
   @if(!empty($niveaux))
        <table class="ui striped red table">
            <thead>
            <tr>
                <th>Numero</th>
                <th>Libelle</th>
                <th colspan="2">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($niveaux as $niveau)
            <tr>
                <td class="positive">{{$niveau->id}}</td>
                <td>{{$niveau->libelle}}</td>
                <td>
                    <a href="/admin/updateNiveau/{{$niveau->id}}" style="color:black;">
                        <i class="blue edit icon"></i>
                     </a>
              </td>
                <td>
                    <button class="ui negative basic button" style="background-color: white;" onclick="return confirm('Voulez vous le supprimé')" >
                    <a href="/admin/deleteNiveau/{{$niveau->id}}"><i class="red archive icon"></i></a>
                </button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
  @else
        <p>La Liste est vide !</p>
  @endif
  {{$niveaux->links()}}
    <script>
        function openModal() {
            $('#modalExample').modal('show');
        }
    </script>
@endsection
