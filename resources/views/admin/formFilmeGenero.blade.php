@if(isset($filme))
<h1 style="font-family: 'Nexa'; margin-bottom: 40px;">{{ $filme->titulo }}</h1>
@elseif(isset($serie))
{{ $serie->titulo }}
@endif
<form action="/controle/store-filme-genero" method="POST" class="form-cadastro">
    @csrf
    <input type="hidden" name="filme" id="filme" value="{{ $id }}" required>
    <div class="form-control">
        <label for="genero">Gênero:</label>
        <select name="genero" id="genero" required>
            @foreach($generos as $genero)
            <option value="{{ $genero->id }}">{{ $genero->titulo }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-control">
        <input type="submit" class="btn-primary" value="Cadastrar">
    </div>
</form>