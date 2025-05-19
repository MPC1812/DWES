<?php
require_once __DIR__ . '/conf/conf.php';
require_once __DIR__ . '/comun.php';

use Jaxon\Jaxon;
use Jaxon\Response\Response;
use GuzzleHttp\Client;

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
    $response->clear('log');
    $response->assign('otros_libros_autor', 'style.display', 'none');
    $isbn = trim($isbn);
    $isbn = filter_var($isbn, FILTER_VALIDATE_INT, ["options" => ["min_range" > 0]]);
    if ($isbn == 0) {
        //$response->assign('otros_libros_autor', 'style.display', 'none');
        $response->clear('log');
        $response->assign('log', 'innerHTML', "El ISBN introducido no es correcto");
        $response->assign('log', 'style.display', 'block');
        $response->assign('log', 'style.border', '2px dotted red');
        $response->assign('log', 'style.padding', '10px');
        return $response;
    }
    try {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM libros WHERE isbn = :isbn";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':isbn' => $isbn]);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultados as $fila) {
            $autor = $fila['autor'];
        }
        if (empty($autor)) {
            //$response->assign('otros_libros_autor', 'style.display', 'none');
            $response->clear('log');
            $response->assign('log', 'innerHTML', "ISBN no existe en la base de datos");
            $response->assign('log', 'style.display', 'block');
            $response->assign('log', 'style.border', '2px dotted red');
            $response->assign('log', 'style.padding', '10px');
            return $response;
        }
        //Hacemos la conexión con la API con Guzzle
        $client = new Client();
        $respuesta = $client->request('GET', 'https://openlibrary.org/search.json?author=' . $autor . '&sort=new');
        $code = $respuesta->getStatusCode(); //Obtener el código de respuesta HTTP
        $body = $respuesta->getBody()->getContents(); //Obtener el contenido cuerpo del mensaje
        $body = json_decode($body, true);
        $html = "<table><thead><tr>";
        $html .= "<th>Título</th>";
        $html .= "<th>Autor</th>";
        $html .= "</tr></thead><tbody>";
        $autorname = "";
        if ($code == 200 && $body['numFound'] > 0) {
            foreach ($body['docs'] as $libro) {
                $html .= "<tr>";
                foreach ($libro['author_name'] as $autor) {
                    $autorname .= $autor . " ";
                }
                $html .= "<td>" . $libro['title'] . "</td>";
                $html .= "<td>" . $autorname . "</td>";
                $html .= "</tr>";
                $autorname = "";
            }
            $html .= "</tbody></table>";
            $response->assign('otros_libros_autor', 'innerHTML', $html);
            $response->assign('otros_libros_autor', 'style.display', 'block');
            $response->assign('otros_libros_autor', 'style.border', '2px dotted blue');
            $response->assign('otros_libros_autor', 'style.padding', '10px');
            return $response;
        } else {
            //$response->assign('otros_libros_autor', 'style.display', 'none');
            $response->clear('log');
            $response->assign('log', 'innerHTML', "No se han encontrado libros de " . $autor);
            $response->assign('log', 'style.display', 'block');
            $response->assign('log', 'style.border', '2px dotted red');
            $response->assign('log', 'style.padding', '10px');
            return $response;
        }
    } catch (PDOException $e) {
        //$response->assign('otros_libros_autor', 'style.display', 'none');
        $response->assign('log', 'innerHTML', "Error: " . $e->getMessage());
        $response->assign('log', 'style.display', 'block');
        $response->assign('log', 'style.border', '2px dotted red');
        $response->assign('log', 'style.padding', '10px');
        return $response;
    }
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
    if (empty($titulo) || strlen($titulo) > 255) {
        $arraylog[] = 'El título introducido no es correcto';
        $contador++;
    }
    if (empty($isbn) || strlen($isbn) > 13 || !is_numeric($isbn)) //Aquí pondría !is_int($isbn) para que sean sólo números enteros ya que la comprobación permite decimales
    {
        $arraylog[] = 'El ISBN introducido no es correcto';
        $contador++;
    }
    if (empty($autor) || strlen($autor) > 255) {
        $arraylog[] = 'El autor introducido no es correcto';
        $contador++;
    }
    if (empty($anio) || $anio >= $anioactual || !is_int($anio) || $anio <= 0) { //Según la tarea no se pide que el año no esté vacío aunque lo he dejado por lógica
        $arraylog[] = 'El año introducido no es correcto';
        $contador++;
    }
    if (empty($paginas) || !is_int($paginas) || $paginas <= 0) {
        $arraylog[] = 'El número de páginas introducido no es correcto';
        $contador++;
    }
    if (empty($ejemplares) || !is_int($ejemplares) || $ejemplares < 0) {
        $arraylog[] = 'El número de ejemplares introducido no es correcto';
        $contador++;
    }
    if ($contador == 0) {
        try {
            $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO libros (titulo, isbn, autor, anio_publicacion, paginas, ejemplares_disponibles) VALUES (:titulo, :isbn, :autor, :anio_publicacion, :paginas, :ejemplares_disponibles)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titulo' => $titulo,
                ':isbn' => $isbn,
                ':autor' => $autor,
                ':anio_publicacion' => $anio,
                ':paginas' => $paginas,
                ':ejemplares_disponibles' => $ejemplares
            ]);
            $id = $pdo->lastInsertId();
            $response->assign('log', 'innerHTML', '<div>Se ha registrado el libro ' . $id . ' por Mario Puerma Cortés');
            return $response;
        } catch (PDOException $e) {
            $response->assign('log', 'innerHTML', '<div>Error: ' . $e->getMessage() . '</div>');
            return $response;
        }
    }
    $response->assign('log', 'innerHTML', '<div>Los datos introducidos no son correctos</div><br><div>' . implode('<br>', $arraylog) . '</div>');
    return $response;
}

$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'funcion1');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'funcion2');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'listarLibrosAutor');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'listarLibrosMPC');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'registrarLibro');
