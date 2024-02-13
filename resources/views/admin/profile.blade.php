@extends('layout.sidebar')
@section('titre', 'Profile')
@section('contenu')

    <div class="container" style="display: flex;align-items:center;justify-content:center;">
        <div class="ui card">
            <div class="image">
                <img class="ui medium circular image"
                    src="https://avatars.mds.yandex.net/i?id=07e6d2fd144c63f23e6b1b1b07f996fc55365889-9099210-images-thumbs&n=13">
            </div>
            <div class="content">
                @foreach ($infoAdmin as $admin)
                    <div class="ui middle aligned center aligned grid container">
                        <div class="column">
                            <div class="ui large form ui top">
                                @csrf
                                <div class="ui stacked segment">
                                    <div class="field">
                                        <label for="name">Name</label>
                                        <div class="ui left icon input">
                                            <i class="user icon"></i>
                                            <input type="email" name="name" value="{{ $admin->name }}">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="email">Email</label>
                                        <div class="ui left icon input">
                                            <i class="mail icon"></i>
                                            <input type="email" name="email" value="{{ $admin->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="extra content">
                <button class="ui fluid large orange submit button"><i class="icon edit"></i>Modifier</button>
            </div>
        </div>
    </div>
    @endforeach
@endsection
