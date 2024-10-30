<h1 align="left" width="100%"> :blue_book: BLOG </h1>

<br><img align="left" src="https://skillicons.dev/icons?i=vscode,laravel,php,bootstrap,html,css,mysql,github,git" height="37" alt="Tecnologias"><br><br>

## :pen: Acerca de este proyecto

Este proyecto es la simulación de un blog de usuarios donde se pueden compartir artículos, otros usuarios pueden verlos y realizar comentarios acerca del artículo en cuestión. En este caso, por medio del uso de permisos de usuario, cada uno puede recibir una asignación, dependiendo del permiso puede o no realizar acciones especificas en la plataforma. Para cada usuario existe un panel de administración en el que puede administrar sus artículos, comentarios recibidos/realizados, etc. Para este desarrollo he usado Laravel (PHP), Bootstrap, MySQL y AdminLTE.

### :pencil: ¿Que es AdminLTE?

Este es un framework que proporciona plantillas para la administración de paneles de control para aplicaciones, además, permite realizar los cambios que queramos en los estilos de las interfaces para que sea personalizado a nuestro gusto.

## :hammer: Estructura del proyecto

Por defecto Laravel funciona con el patrón de arquitectura MVC (Modelo-Vista-Controlador), seguir esta arquitectura ayuda a construir aplicaciones escalables y facilita el mantenimiento de la misma. Como se puede ver, el framework crea por defecto varias carpetas y archivos que son importantes para el funcionamiento de la aplicacion, sin embargo, las carpetas que almacenan los archivos del blog son:

> app/*

> config/*

> database/*

> resources/*

> routes/*

En cada una de estas se almacenan controladores, vistas, configuraciones entre otros archivos de vital importancia para el funcionamiento del proyecto.

## :package: Resultados

Al acceder al blog se muestra una pantalla donde el usuario debe iniciar sesión, en caso de que no tenga una cuenta, puede crearse una.

<p align="center">
    <img src="https://raw.githubusercontent.com/samoel-andres/blog/master/public/evidence/login.JPG" alt="Login del sitio">
</p>

<p align="center">
    <img src="https://raw.githubusercontent.com/samoel-andres/blog/master/public/evidence/create_account.JPG" alt="Crear cuenta">
</p>

Una vez que el usuario accede, la primer impresión que tiene es el inicio/home, en el cual se muestran todos los articulos divididos en secciones.

<p align="center">
    <img src="https://raw.githubusercontent.com/samoel-andres/blog/master/public/evidence/home_page.JPG" alt="Pagina de inicio/home">
</p>

Cuando el usuario pulsa sobre algún artículo se le redirige a la página de detalles del mismo en el cual puede leer más detalles, ver o hacer comentarios.

<p align="center">
    <img src="https://raw.githubusercontent.com/samoel-andres/blog/master/public/evidence/article_part_1.JPG" alt="Detalles del articulo parte 1">
</p>

<p align="center">
    <img src="https://raw.githubusercontent.com/samoel-andres/blog/master/public/evidence/article_part_2.JPG" alt="Detalles del articulo parte 2">
</p>

De manera breve, el usuario tiene un perfil que puede personalizar y agregar algunos detalles sobre él.

<p align="center">
    <img src="https://raw.githubusercontent.com/samoel-andres/blog/master/public/evidence/profile_details.JPG" alt="Detalles de perfil de usuario">
</p>

<p align="center">
    <img src="https://raw.githubusercontent.com/samoel-andres/blog/master/public/evidence/edit_profile.JPG" alt="Editar detalles del perfil de usuario">
</p>

Para finalizar, a cada usuario se le proporciona un panel de control o dashboard desde el cual puede gestionar sus artículos publicados, comentarios realizados/recibidos, entre otras actividades.

<p align="center">
    <img src="https://raw.githubusercontent.com/samoel-andres/blog/master/public/evidence/dashboard.JPG" alt="Crear cuenta">
</p>

## :pen: Conclusión

Cada día sigo aprendiendo cosas nuevas, durante este proyecto he podido comprender aún mas la importancia de los permisos de usuario dentro de un sistema. Este es un proyecto que he realizado por mi cuenta para la obtención de un certificado de desarrollo web con Laravel, <a href="https://www.linkedin.com/in/samoel-andres-vidal/overlay/1728024054553/single-media-viewer/?profileId=ACoAAEB6RccBZJrb2iwM_ORM271ejna68_HRC_M">ver certificado</a> en mi LinkedIn
