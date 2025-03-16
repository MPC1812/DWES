@include ('plantillas.navbar')
<h1 class="text-center p-3 text-success">Bienvenido {{ Auth::user()->name}}</h1>
<h2 class="text-center text-danger">Dashboard sólo disponible para usuarios registrados y logueados</h2>
<h2 class="text-center text-info">Puedes registrar nuevos usuarios del sistema en /register </h2>
@include ('plantillas.footer')