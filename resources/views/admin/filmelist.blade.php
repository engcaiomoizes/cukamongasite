@foreach($filmes as $filme)
    <tr>
        <td>{{ $filme->titulo }}</td>
        <td>{{ $filme->lancamento }}</td>
        <td>{{ $filme->idioma }}</td>
        <td>{{ $filme->duracao }}</td>
        <td>
            <button class="open-modal" id="open-modal"><i class="fa-solid fa-eye"></i></button>
            <a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
            <button class="open-modal" id="open-links"><i class="fa-solid fa-link"></i></button>
            <a href="#"><i class="fa-solid fa-trash"></i></a>
        </td>
    </tr>
@endforeach