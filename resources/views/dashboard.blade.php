@extends("layout.app")
@section('content')
<div class="">
    <div class="ui middle aligned center aligned grid container">
        <div style="margin-top:20px">
            <h1 style="margin-top:20px">Dashboard</h1>
            @if(Session::has('success'))
            <div class="success">
                {{Session::get('success')}}
            </div>
            @endif
        </div>
        <table class="ui celled table">
            @if(auth()->user()->role)
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Adresse-Email</th>
                    <th>Date de Création</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach($user as $users)
            <tbody>
                <tr>
                    <td>{{$users->name}}</td>
                    <td>{{$users->email}}</td>
                    <td>{{$users->created_at}}</td>
                    <td><a class="ui blue button" href="/modifier/{{$users->id}}">modifier</a></td>

                </tr>

            </tbody>
            @endforeach
        </table>
        @endif

    </div>

</div>
@endsection