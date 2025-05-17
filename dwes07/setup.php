<?php
require_once __DIR__ . '/conf/conf.php';
require_once __DIR__ . '/comun.php';

use Faker\Calculator\Isbn;
use Jaxon\Jaxon;
use Jaxon\Response\Response;
use GuzzleHttp\Client;

use function Laravel\Prompts\alert;

$jaxon = jaxon();
$jaxon->setOption("js.lib.uri", BASE_URL . "jaxon-dist");
$jaxon->setOption('core.request.uri', BASE_URL . 'backend.php');

function consultarLibros()
{
    try {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM libros";
        $stmt = $pdo->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $html = "<table><thead><tr>";
        foreach (array_keys($resultados[0] ?? []) as $columna) {
            $html .= "<th>" . $columna . "</th>";
        }
        $html .= "</tr></thead><tbody>";
        foreach ($resultados as $fila) {
            $html .= "<tr>";
            foreach ($fila as $valor) {
                $html .= "<td>" . $valor . "</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</tbody></table>";
        return $html;
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

function logMessage(Response $r, mixed $dato)
{
    $r->append('log', 'innerHTML', '<div>' . print_r($dato, true) . '</div>');
}

function funcion1($fechaYhora)
{
    $response = new Response();
    logMessage($response, "La fecha y la hora es: $fechaYhora");
    return $response;
}

function funcion2($nombre)
{
    $response = new Response();
    logMessage($response, "El nombre del autor o autora es $nombre");
    return $response;
}

function listarLibrosAutor($isbn)
{
    $response = new Response();
    $response->clear('otros_libros_autor');
    $response->assign('otros_libros_autor', 'innerHTML', "Aquí mostrar libros del autor del libro con ISBN $isbn");
    $response->assign('otros_libros_autor', 'style.display', 'block');
    $response->assign('otros_libros_autor', 'style.border', '2px dotted blue');
    $response->assign('otros_libros_autor', 'style.padding', '10px');
    return $response;
}

function listarLibrosMPC()
{
    $response = new Response();
    $response->clear('listaLibros');
    $response->assign('listaLibros', 'innerHTML', consultarLibros());
    return $response;
}

function registrarLibro($isbn, $titulo, $autor, $anio, $paginas, $ejemplares, $anioactual)
{
    $response = new Response();
    $response->clear('log');
    $contador = 0;
    $arraylog = [];
    $isbn = trim($isbn);
    $titulo = trim($titulo);
    $autor = trim($autor);
    $anio = trim($anio);
    $paginas = trim($paginas);
    $ejemplares = trim($ejemplares);
    $anio = filter_var($anio, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
    $paginas = filter_var($paginas, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
    $ejemplares = filter_var($ejemplares, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
    if (empty($isbn || strlen($isbn) > 13)) {
        $arraylog[] = 'El ISBN introducido no es correcto';
        $contador++;
    }
    if (empty($titulo) || strlen($titulo) >255) {
        $arraylog[] = 'El título introducido no es correcto';
        $contador++;
    }
    if (empty($autor) || strlen($autor) >255) {
        $arraylog[] = 'El autor introducido no es correcto';
        $contador++;
    }
    if (empty($anio) || $anio > $anioactual) {
        $arraylog[] = 'El año introducido no es correcto';
        $contador++;
    }
    if (empty($paginas) || strlen($paginas) >255) {
        $arraylog[] = 'El número de páginas introducido no es correcto';
        $contador++;
    }
    if (empty($ejemplares) || strlen($ejemplares) >255) {
        $arraylog[] = 'El número de ejemplares introducido no es correcto';
        $contador++;
    }
    if ($contador == 0) {
        try {
            $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO libros (titulo, isbn, autor, anio, paginas, ejemplares) VALUES (:titulo, :isbn, :autor, :anio, :paginas, :ejemplares)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titulo' => $titulo,
                ':isbn' => $isbn,
                ':autor' => $autor,
                ':anio' => $anio,
                ':paginas' => $paginas,
                ':ejemplares' => $ejemplares
            ]);
            $response->assign('log', 'innerHTML', '<div>Se ha registrado el libro ' . $titulo . ' con ISBN ' . $isbn . '</div>');
            return $response;
        } catch (PDOException $e) {
            $response->assign('log', 'innerHTML', '<div>Error: ' . $e->getMessage() . '</div>');
            return $response;
        }
    }
    $response->assign('log', 'innerHTML', '<div>Los datos introducidos no son correctos</div><br><div>' . implode('<br>', $arraylog) . '</div>');
    return $response;
}
    //Insertar el libro en la base de datos

$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'funcion1');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'funcion2');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'listarLibrosAutor');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'listarLibrosMPC');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'registrarLibro');
