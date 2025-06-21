# Respuestas al Take Home – PHP Developer Jr.

## ¿Para qué sirve el archivo `.env` en un proyecto Laravel?

El archivo `.env` se utiliza para configurar el entorno del proyecto Laravel. Aquí definimos variables de entorno que serán utilizadas por toda la aplicación, como la configuración de la base de datos, claves de API, el tipo de canal de logs, modo de ejecución (`APP_ENV`), entre otros.  
Personalmente, lo he usado para almacenar credenciales de APIs y datos sensibles que no deben estar en el código fuente.

---

## ¿Qué es un controlador y cómo se crea?

Un controlador es una clase en PHP que se encarga de manejar la lógica de interacción entre el modelo y la vista. Permite recibir las solicitudes del usuario, procesarlas (con ayuda de servicios o modelos) y devolver una respuesta adecuada.  
Aunque puede contener lógica de negocio, lo más recomendable es delegarla a servicios u otras capas.

Se puede crear fácilmente con el comando:

```bash
php artisan make:controller NombreDelControlador
```

También puede crearse manualmente como una clase PHP ubicada en el directorio `app/Http/Controllers`.

---

## ¿Cuál es la diferencia entre GET y POST en una ruta de Laravel?

- Una solicitud `GET` se usa para **obtener datos** desde el servidor. Generalmente no envía datos sensibles y no requiere protección CSRF.
- Una solicitud `POST` se usa para **enviar datos** al servidor, como formularios. Estas solicitudes **sí requieren protección CSRF** en Laravel, ya que modifican el estado del servidor y suelen incluir datos sensibles.

---

## ¿Qué es una migración y para qué se usa?

Una migración es una clase de PHP que nos permite definir y modificar la estructura de la base de datos de forma controlada y versionada.  
Es una **abstracción de la base de datos** que facilita la creación de tablas, columnas, llaves foráneas, índices, etc., sin necesidad de escribir SQL manualmente.  
Se usa para mantener el esquema sincronizado entre entornos de desarrollo y producción.

---

## ¿Qué es un modelo en Laravel?

Un modelo en Laravel representa una **tabla** en la base de datos, y cada instancia del modelo representa una **fila**.  
Usando Eloquent, el ORM de Laravel, podemos manipular registros de la base de datos directamente desde PHP, usando una sintaxis orientada a objetos.

---

## ¿Cómo defines una relación uno a muchos en Eloquent?

En el modelo principal (por ejemplo, `Automovil`), defines un método que retorna la relación.  
Si un automóvil tiene muchas llantas:

```php
public function llantas()
{
    return $this->hasMany(Llanta::class);
}
```

Esto indica que una instancia de `Automovil` puede tener múltiples registros relacionados en la tabla `llantas`.

---

## ¿Cómo defines una relación muchos a muchos en Eloquent?

En ambos modelos relacionados, defines un método que usa `belongsToMany`.  
Por ejemplo, si un estudiante puede pertenecer a muchos cursos y un curso puede tener muchos estudiantes:

```php
// En el modelo Estudiante
public function cursos()
{
    return $this->belongsToMany(Curso::class);
}

// En el modelo Curso
public function estudiantes()
{
    return $this->belongsToMany(Estudiante::class);
}
```

Laravel espera que exista una tabla pivote (por ejemplo, `curso_estudiante`) que contenga los IDs de ambas tablas.
