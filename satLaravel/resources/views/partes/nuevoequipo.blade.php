@include('plantillas.navbar')
<h1 class="text-center">Nuevo Parte</h1>

<form action="/nuevoparte" method="post">
  @csrf
  @if($cliente)
  <div class="d-flex flex-row m-auto align-items-center bg-light">
  <img src="img/agenda.png" height="100" width="100" alt="Agenda" class="m-2">
    <label class="me-1" for="id">ID</label>
  <input class="me-1" type="text" name="id" id="id" value="{{$cliente->id}}">
  <label class="me-1" for="telefono">Telefono</label>
  <input class="me-3" type="tel" name="telefono" id="telefono" value="{{$cliente->telefono}}">
  <label class="me-1" for="nombre">Nombre</label>
  <input class="me-3" type="text" name="nombre" id="nombre" value="{{$cliente->nombre}}">
  <label class="me-1" for="email">Email</label>
  <input class="me-3" type="email" name="email" id="email" value="{{$cliente->email}}">
  </div>
  @else
  <div class="d-flex flex-row m-auto align-items-center bg-light">
  <img src="img/agenda.png" height="100" width="100" alt="Agenda" class="m-2">
  <label class="me-1" for="telefono">Telefono</label>
  <input class="me-3" type="tel" name="telefono" id="telefono">
  <label class="me-1" for="nombre">Nombre</label>
  <input class="me-3" type="text" name="nombre" id="nombre">
  <label class="me-1" for="email">Email</label>
  <input class="me-3" type="email" name="email" id="email">
  </div>
  @endif
  <div class="d-flex flex-row m-auto align-items-center">
    <img src="img/equipo.png" height="100" width="100" alt="Equipo" class="m-2 img-fluid img-thumbnail">
    <label class="me-1" for="nombre">Tipo</label>
    <select name="tipo" id="tipo" class="p-2">
<optgroup label="Tipo">
<option selected="selected" value="pc">PC</option>
<option>Portátil</option>
<option>Tablet</option>
<option>Móvil</option>
<option>Otro</option>
</optgroup>
</select>
    <label class="me-1 p-2" for="marca">Marca</label>
    <input class="me-3" type="text" name="marca" id="marca">
    <label class="me-1" for="modelo">Modelo</label>
    <input class="me-3" type="text" name="modelo" id="modelo">
    <div class="d-flex flex-row align-items-center">
    <label class="me-1" for="cargador">Cargador</label>
    <spam class="d-flex flex-column">
    <input name="cargador" type="radio" value="si" />Si
    <input name="cargador" type="radio" value="no" />No
    </spam>
    <label class="me-1 p-2" for="bateria">Bateria</label>
    <spam class="d-flex flex-column ">
    <input class="ml-3"name="bateria" type="radio" value="si" />Si
    <input class="p-2" name="bateria" type="radio" value="no" />No
    </spam>
    </div>
    <label class="me-1 p-2" for="comentarios">Comentarios</label>    
    <textarea class="me-3" name="comentarios" id="comentarios"></textarea>
  </div>
  <div class="d-flex flex-row m-auto align-items-center justify-content-center">
    <input type="submit" value="Crear" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full">
  </div>
</form>