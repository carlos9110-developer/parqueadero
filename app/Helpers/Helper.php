<?php
/*****
 * Archivo ayudante, que contiene funciones generales que se pueden utilizar en varios archivos(Controladores)
 */


// función que redirecciona donde queramos
function redireccionar($pagina)
{
    header('location:' .RUTA_URL.'/'. $pagina );
}

// función que itera los módulos de nuestra aplicación, devuelve en un array los nombres de los modulos o de los archivos controladores, según lo que se este buscando
function getModules($ruta)
{
    $folder = opendir($ruta);//Abrir directorio de módulos
    $i = 0;
    
    //Iteración dentro del directorio Módulos
    while($file = readdir($folder)){
        if($file != "." && $file != ".." && !is_dir($file) && $file != ".htaccess" && $file != "Login.php" && $file != "Api.php" ){
            $modulos[$i++] = str_replace($ruta, "", $file);
            // borra toda la ruta para retornar solo el nombre del archivo 
            // ejemplo; pasa de C:\xampp\htdocs\adminsoft\app\Controllers\Usuarios.php a Usuarios.php
        }
        if($i == 0){
            //No hay módulos
            $modulos = [];
        }
    }
    return $modulos;
}

//ofuscar html, para que se lea en una sola linea de codigo en nuestro navegador
function comprimir_html($html)
{
    $buscar = array('/>[^\S ]+/s', '/[^\S]+\</s', '/(\s)+/s');
    $remplazar = array('>', '<', '\\1');
    return preg_replace($buscar, $remplazar, $html);
}

// función para retornar los json
function responderJson($array)
{
    header('Content-Type: application/json');
    echo  json_encode($array);
}

