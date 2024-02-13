@extends('layout.sidebar')
@section('titre','Gestion des Sommaires')
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
<button class="ui black button" onclick="openModal()">Creer un sommaire</button>
<div class="ui modal" id="modalExample">
    <i class="close icon"></i>
    <div class="header">
        Creation D'un Sommaire
    </div>
    <form class="ui form" action="/admin/sommaire" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="ui form">
                <div class="ui segment">
                <div class="field">
                    <label>Titre</label>
                    <input type="text" name="libelle" placeholder="Saisir le libelle du niveau">
                    <div class="ui red">
                        @error('libelle')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label>Numero de Page</label>
                    <input type="number" name="page_num" placeholder="Saisir le numero de la page">
                    <div class="ui red">
                        @error('numeroPage')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="field">
                    <label for="cour">Cour</label>
                    <select class="ui dropdown" name="cour_id">
                        @foreach ($cours as $cour)
                        <option value="{{$cour->id}}">{{$cour->libelle}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            </div>
        </div>
        <div style="text-align:right;margin-bottom: 10px;">
            <button type="submit" class="ui inverted green button">Enregistrer</button>
        </div>
    </form>
</div>
<h3>La liste des sommaires</h3>
@if(!empty($sommaires))
     <table class="ui striped red table">
         <thead>
         <tr>
             <th>Numero</th>
             <th>Libelle</th>
             <th>Numero Page</th>
             <th colspan="2">Actions</th>
         </tr>
         </thead>
         <tbody>
             @foreach ($sommaires as $sommaire)
         <tr>
             <td class="positive">{{$sommaire->id}}</td>
             <td>{{$sommaire->libelle}}</td>
             <td>{{$sommaire->page_num}}</td>
             <td>
                 <a href="/admin/updateNiveau/{{$sommaire->id}}" style="color:black;">
                     <i class="blue edit icon"></i>
                  </a>
           </td>
             <td>
                 <a href="/admin/deleteNiveau/{{$sommaire->id}}" style="color:black;"><i class="red archive icon"></i></a>
             </td>
         </tr>
         @endforeach
         </tbody>
     </table>
@else
     <p>La Liste est vide !</p>
@endif
<script>
    function openModal() {
        $('#modalExample').modal('show');
    }
</script>
@endsection
