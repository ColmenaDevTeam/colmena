## Git ##
### Iniciar ###
* **Clonar el repositorio**
    ```
        git clone ...
    ```
* **Instalar dependencias**
    ```
        composer install
    ```
* **Cargar las clases**
    ```
        composer dump-autoload
    ```  

### Una vez iniciado ###
* **Agregar archivos nuevos, modificados o eliminados**  
```
git add ruta/al/archivo.ext
git add . (Para agregar todos)
git rm ruta/al/archivo.ext (uno por uno)
```
* **Hacer confirmación o commit**
```
git commit -a "Detalles de la confirmación"
o...
git commit -am "Detalles de la confirmacion"
```
* **Hacer push a una determinada rama en el repositorio**
    * Agregar los archivos cambiados o removidos con add o rm
    * Agregar los cambios realizando un commit
```
git push origin rama_a_actualizar (master o el nombre de la otra rama si es otra)
```
* **Hacer pull de una determinada rama en el repositorio**
```
git pull origin rama_de_la_cual_actualizar (master o el nombre de la otra rama si es otra)
```
* **Crear una nueva rama y cambiarse a ella**  
```
git checkout -b nueva_rama
```
* **Cambiarse a una rama existente**  
```
git checkout otra_rama
```
* **Fusionar otra rama con la rama actual**  
```
git merge otra_rama
```
* **Remover archivos sin seguimiento que están en el repositorio y no deben estar**  
```
git rm --cached la/carpeta/en-la-que-esta-todo/\*
```

-----
## Artisan ##
* **Ejecutar Seeder:**  
`php artisan db:seed --class=FakerUsersSeeder`
* **Ejecutar Tinker:**  
`php artisan tinker`

* **Rollback all migrations**  
`php artisan migrate:reset`

* **Rollback all migrations and run them all again**  
```
php artisan migrate:refresh
o
php artisan migrate:refresh --seed
```

-----
## Composer ##
* **Instalar y/o actualizar referencias del archivo composer**
```
composer install
composer update
```

-----
## Artisan Tinker ##
* **Generar contraseña encriptada:**  
  `\Hash::make('passwordToEncrypt')`

-----
## Queryes PostgreSQL ##
* **Borrar todas las tablas de una bd**  
  `drop schema public cascade;`  
  `create schema public;`

-----
