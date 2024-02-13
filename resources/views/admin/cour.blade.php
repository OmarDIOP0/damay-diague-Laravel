@extends('layout.sidebar')
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
    <div class="header" style="display: flex;justify-content:space-between;">
        <div class="ui dividing header">
            <h3>Nos Cours</h3>
        </div>
        <form action="/admin/cour" method="GET">
            @csrf
            <div class="seven wide field">
                <label for="filter">Filtrer par :</label>
                <select class="ui dropdown" name="filter_matiere">
                    @foreach ($matieres as $matiere)
                        <option value="{{ $matiere->id }}">{{ $matiere->libelle }}</option>
                    @endforeach
                </select>
                <button class="btn-consulter" style="width: 70px;">Valider</button>
            </div>
        </form>
    </div>
    <button class="ui black button" onclick="openModal()">Creer un cours</button>
    <div class="ui modal" id="modalExample">
        <i class="close icon"></i>
        <div class="header">
            Creation D'un Nouveau Cours
        </div>
        <form class="ui form" action="/admin/cour" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="ui form">
                    <div class="ui segment">
                        <div class="fields"style="display: flex; justify-content:space-between">
                            <div class="six wide field">
                                <label>Titre</label>
                                <input type="text" name="libelle" placeholder="Saisir le libelle du niveau">
                                <div class="ui red">
                                    @error('libelle')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="nine wide field" style="border: none; margin-top:12px">
                                <input type="file" name="file" id="">
                                <div class="ui red">
                                    @error('nomFichier')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label>Description</label>
                            <textarea name="description" cols="30" rows="2"></textarea>
                            <div class="ui red">
                                @error('description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="fields">
                            <label for="published">Publié : </label>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="published" value="vrai">
                                    <label for="vrai">Oui</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="published" value="faux">
                                    <label for="non">Non</label>
                                </div>
                            </div>
                        </div>
                        <div class="fields" style="display: flex; justify-content:space-between">
                            <div class="seven wide field">
                                <label for="matiere">Matiere</label>
                                <select class="ui dropdown" name="matiere_id">
                                    @foreach ($matieres as $matiere)
                                        <option value="{{ $matiere->id }}">{{ $matiere->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="seven wide field">
                                <label for="level">Niveau</label>
                                <select class="ui dropdown" name="level_id">
                                    @foreach ($niveaux as $niveau)
                                        <option value="{{ $niveau->id }}">{{ $niveau->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col">
                        <table class="ui table table-bordered align-items-center table-sm sommaire-table">
                            <thead class="ui thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Libellé du Sommaire</th>
                                    <th>Nombre de Pages</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="sommaires-container">
                            </tbody>
                        </table>

                        <div class="field">
                            <button type="button" class="ui inverted blue button" id="ajouter-sommaire"><i
                                    class="add icon"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align:right;margin-bottom: 10px;">
                <button type="submit" class="ui inverted green button">Enregistrer</button>
            </div>
        </form>

    </div>

    <div class="ui container" style="margin-top:5%; margin-bottom:30px;">
        <div class="ui grid container">
            <div class="row ui cards four column stackable">
                @if ($cours_filter->count() > 0)
                    @foreach ($cours_filter as $cour)
                        <div class="card">
                            <div class="image">
                                <img src="/images/math.png" alt="" style="height: 150px">
                            </div>
                            <div class="content">
                                <div class="header">{{ $cour->libelle }}</div>
                            </div>
                            <div class="extra content" style="display: flex; justify-content:space-between;">
                                <a class="btn-consulter" href="/admin/viewCour/{{ $cour->slug }}"
                                    style="color: white">Consulter</a>
                                <a href="/admin/updateCour/{{ $cour->id }}" style="margin-top:7px;"><i
                                        class="blue edit icon"></i></a>
                                <a href="/admin/deleteCour/{{ $cour->id }}"style="margin-top:7px;"><i
                                        class="red archive icon"></i></a>
                            </div>
                        </div>
                    @endforeach
            </div>
        @else
            <div class="">
                <h5>Aucun cours trouvé pour la matiere</h5>
            </div>
            @endif
        </div>
    </div>

    <script>
        function openModal() {
            $('#modalExample').modal('show');
        }
    </script>
    <script src="{{ URL::asset('js/src/modules/sommaire-module.js') }}"></script>
@endsection
