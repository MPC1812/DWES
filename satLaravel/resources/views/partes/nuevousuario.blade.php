@include('plantillas.navbar')
<h1 class="text-center">Nuevo Parte</h1>

<form action="/nuevousuario" method="post">
  @csrf
  <div class="d-flex flex-row m-auto align-items-center bg-light">
  <img src="img/agenda.png" height="100" width="100" alt="Agenda" class="m-2">
  <label class="me-1" for="telefono">Telefono</label>
  <input class="me-3" type="tel" name="telefono" id="telefono">

  </div>
      <div class="d-flex flex-row m-auto align-items-center justify-content-center">
      <input type="submit" value="Crear" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full">
    </div>
</form>
@include('plantillas.footer')