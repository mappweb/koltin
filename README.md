# Prueba técnica PHP/Laravel

## Notas:

- Tiempo para resolver la prueba es de 2 días
- En caso de tener dudas escribir al correo <adrian.galicia@koltin.com.mx>

## Caso práctico

Necesitamos una prueba piloto de un blog. Lo queremos mantener separado, así que debemos empezar un nuevo proyecto.

Empezaremos con algo sencillo, solo queremos autores, posts, comentarios respecto a los autores y los posts, dichos comentarios serán almacenados en formato WYSIWYG (no vamos a gestionar categorías, multimedia ni nada de eso). Vamos a necesitar acceder al contenido del blog desde otras aplicaciones, lo que nos requiere exponer una API.

Por tanto, este proyecto debe tener lo siguiente:

- Design doc de la solución

- Blog público
    - Lista de posts
    - Página de post incluyendo comentarios, donde se mostrará una pequeña ficha del autor
    - Página de autor con sus incluyendo comentarios

- API
    - Endpoint GET para la obtención de posts, incluyendo autor y comentarios
    - Endpoint POST para la publicación de un post.
    - Endpoint POST para el registro de autor.
    - Endpoint GET para obtener los autores, incluyendo comentarios y posts relacionados

- Comando que exporte a google sheets los comentarios recibiendo un rango de fechas

**Bonus**

- Desplegar el proyecto.

El objetivo de la prueba es la demostración de :
 - Conocimientos en Laravel y PHP, por lo que se primará el cuidado de la estructura backend.
 - La correcta separación de servicios y responsabilidades
 - Introducción de interfaces, tolerancia ante fallos, etc. 

Para la parte front no requerimos una gran labor de maquetación. Puedes usar librerías adicionales a las del framework si lo necesitas. También en la parte de front, puedes usar Bootstrap, Bulma, Tailwind u otro framework CSS.

## Requisitos:

- PHP 8.0+
- Composer y estructura PSR-4 en el proyecto
- La última versión estable de Laravel
- Testing unitario
- La API debe devolver y consumir los datos en formato JSON
- Programar en el idioma inglés
- Uso de herramientas de análisis estático (por ejemplo PHPStan en modo máximo) y de estilo de código (por ejemplo PHP CS Fixer en modo @Symfony)
- Uso de SCSS y Webpack, ya sea usando Webpack directamente o mediante Symfony Encore / Laravel Mix o similar
- Ofrecer un Swagger/OpenAPI para la parte de la API

Para la entrega, puedes mandarnos un enlace a un repositorio público (GitHub, GitLab u otro sitio donde tengas cuenta).

Lo que sí nos gustaría que incluyeras es un README explicando la prueba y cualquier cosa de la que quieras dejar constancia, como las decisiones a la hora de organizar el código, las librerías extra que hayas añadido para facilitar el trabajo, problemas que te hayas encontrado, soluciones alternativas que te gustaría haber probado, etc.

Nos gusta que nos den este tipo de feedback ya que nos ayuda a valorar mejor y de forma objetiva la prueba técnica.