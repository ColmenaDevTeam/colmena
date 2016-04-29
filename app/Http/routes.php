<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => ['web']], function () {
    //
    //Ruta de about
    Route::get('/acerca-de', function(){
        //Leer el contenido del archivo de cambios
        $contenido = file_get_contents(__DIR__."/../../changelog.json");
        //Decodificar el json y transformarlo a array asociativo
        $json = json_decode($contenido, true);
        return view('acerca-de')->with('json', $json);
    });
    //Ruta de login
    /*
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController'
    ]);*/

        //Ruta de error acceso negado
    Route::get('/errores/acceso-negado', function () {
        return view('errores/acceso-negado');
    });
    /**
    INICIO METODO PARA DEBUGEAR
    */
    Route::get('/deb', function(){
        /*
            Si se requiere hacer pruebas en el routes, no modificarlo, en cambio usar el METODO
            execute de la clase Prueba del siguiente archivo
            Eliminar esta ruta antes de mezclar en master
        */
        require_once('debuging.php');
        Prueba::execute();

    });
    /**
Eliminar esta ruta antes de mezclar en master
    */
});
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    //Ruta de inicio o acceso al salpicadero
    Route::get('/', "CcarteleraController@getIndex");
    Route::get('/home', 'CcarteleraController@getIndex');
    Route::get('/inicio', 'CcarteleraController@getIndex');
    Route::controller('/cartelera', "CcarteleraController");
    //Modulo de roles
    Route::controller("/roles", "CrolesController");
    //Modulo de administración de usuarios
    Route::controller("/usuarios", "UsuariosController");
    //Modulo de tareas
    Route::controller("/tareas", "CtareasController");
    //Modulo de permisos y reposos
    Route::controller("/permisos-y-reposos", "PermisosRepososController");
    Route::get('formulario', 'StorageController@index');
    //Modulo de Calendario
    Route::controller("/calendario","CcalendarioController");
    //Modulo de recurrente
    Route::controller('/actividades-recurrentes', 'CactividadesRecurrentesController');
});
