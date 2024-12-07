<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
ob_start();

// Constantes datos de encabezado
const NOMBRE_EMPRESA = "LPTRES 2024";
const DIRECCION_EMPRESA = "CAAGUAZU (colectora sur) Km 180";
const TELEFONO_EMPRESA = "0522 44444";
const EMAIL_EMPRESA = "lptres@gmail.com";

// Variables por REQUEST
$fecha = $_REQUEST['fecha'];
$fecha = date("Y-d-m", strtotime($fecha));
$idUsuario = $_SESSION['idUsuario'];

// Base de datos - tabla USUARIOS
include_once($_SERVER['DOCUMENT_ROOT'].'/semana5/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH.'usuarioController.php');
$usuarioController = new usuarioController();

// Obtener datos del usuario actual
$usuario = $usuarioController->getUsuarioById($idUsuario);

if (!$usuario) {
    echo "<script>alert('Usuario no encontrado.')</script>";
    echo "<script>window.close();</script>";
    exit();
}

// Variables del usuario
$nombreUsuario = $usuario['nombre'];
$emailUsuario = $usuario['email'];
$rolUsuario = $usuario['rol_id']; // Puedes usar un método para obtener el nombre del rol si es necesario

// Library HTML2PDF
require_once ROOT_PATH . 'vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

try {
    // Get the HTML/PHP
    include('doc/factura_html.php');
    $content = ob_get_clean();

    // Initialize HTML2PDF
    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // Display the full page
    $html2pdf->pdf->SetDisplayMode('real');
    // Convert
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    // Send the PDF
    $html2pdf->Output('factura_' . $nombreUsuario . '_' . $_COOKIE["PHPSESSID"] . '.pdf');
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}
?>
