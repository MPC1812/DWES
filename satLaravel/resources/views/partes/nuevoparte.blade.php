@include('plantillas.navbar')
<h1 class="text-center">Nuevo Parte</h1>

<form action="/nuevoequipo" method="post">
  @csrf
  <div class="d-flex flex-row m-auto align-items-center bg-light">
  <img src="img/agenda.png" height="100" width="100" alt="Agenda" class="m-2">
  <label class="me-1" for="telefono">Telefono</label>
  <input class="me-3" type="tel" name="telefono" id="telefono">
  <label class="me-1" for="nombre">Nombre</label>
  <input class="me-3" type="text" name="nombre" id="nombre">
  <label class="me-1" for="email">Email</label>
  <input class="me-3" type="email" name="email" id="email">
  </div>
  <div class="d-flex flex-row m-auto align-items-center">
    <img src="img/equipo.png" height="100" width="100" alt="Equipo" class="m-2">
    <label class="me-1" for="nombre">Tipo</label>
    <input class="me-3" type="text" name="nombre" id="nombre">
    <label class="me-1" for="marca">Marca</label>
    <input class="me-3" type="text" name="marca" id="marca">
    <label class="me-1" for="modelo">Modelo</label>
    <input class="me-3" type="text" name="modelo" id="modelo">
    <label class="me-1" for="cargador">Cargador</label>
    <input class="me-3" type="text" name="cargador" id="cargador">
    <label class="me-1" for="bateria">Bateria</label>
    <input class="me-3" type="text" name="bateria" id="bateria">
    <label class="me-1" for="comentarios">Comentarios</label>
    <input class="me-3" type="text" name="comentarios" id="comentarios">
    </div>    
    <div class="d-flex flex-row m-auto align-items-center bg-light">
      <img src="img/averia.png" height="100" width="100" alt="Averia" class="m-2">
      <label class="ml-3 me-1" for="descripcion">Descripción</label>
      <textarea class="me-3" name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
      <input tipe="radio-group" name="clave" id="clave">
      <label class="me-1" for="claveSi">Clave</label>
      <input tipe="radio" name="claveSi" id="claveSi">
      <label class="me-1" for="claveNo">Clave</label>   
      <input tipe="radio" name="claveNo" id="claveNo">
      <input class="me-3" type="text" name="texclave" id="texclave">
      <label class="me-1" for="estado">Estado de la reparación</label>
      <input class="me-3" type="text" name="estado" id="estado">    
    </div>
    <div class="d-flex flex-row m-auto align-items-center justify-content-center">
      <input type="submit" value="Crear" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full">
    </div>
</form>
@include('plantillas.footer')
