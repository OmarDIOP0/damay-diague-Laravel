<div class="" style="display: flex; justify-content:center; margin-bottom:30px;">
    @if ($paginator->hasPages())
    <div class="ui pagination menu">
        @if ($paginator->onFirstPage())
            <a class="item disabled">Première</a>
        @else
            <a class="item" href="{{ $paginator->url(1) }}">Première</a>
        @endif

        {{-- Boutons de pages --}}
        @foreach ($elements as $element)
            {{-- "..." s'il y a trop de pages --}}
            @if (is_string($element))
                <a class="item disabled">{{ $element }}</a>
            @endif

            {{-- Afficher les numéros de page --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="item active" style="color: white;background-color:red;">{{ $page }}</a>
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Bouton "Dernière page" --}}
        @if ($paginator->hasMorePages())
            <a class="item" href="{{ $paginator->url($paginator->lastPage()) }}">Dernière</a>
        @else
            <a class="item disabled">Dernière</a>
        @endif
    </div>
@endif

</div>
