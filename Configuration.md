# Introduction #

Add your content here.


# Details #

Add your content here.  Format your content with:
  * Text in **bold** or _proximamente_
  * Headings, paragraphs, and lists
  * Automatic links to other wiki pages


1) Instalar el wamp para el apache como servidor web: http://www.wampserver.com/en/download.php

> En la carpeta c:\wamp\www\ crear una carpeta FindResources.

2) Instalar Oracle 10g Express Edition :
http://www.oracle.com/technetwork/database/express-edition/downloads/102xewinsoft-090667.html

> En vez de registrarse pueden usar estos datos para bajarlo:USR: oracle.user@mytrashmail.com   PWD: oracle.user@mytrashmail.com
> Al instalarlo, el usuario default es SYSTEM y te pide una clave que le puse "manager" como me dijo JP.

3) Instalar el Tortoise como SVN :
http://downloads.sourceforge.net/tortoisesvn/TortoiseSVN-1.6.16.21511-win32-svn-1.6.17.msi?download

4) Armé un repositorio en Google Project con el framework CodeIgniter que es el que vamos usar para PHP.
> Configurar el Tortoise en la carpeta c:\wamp\www\FindResources\ y hacer un update para traer todos los archivos.
> La URL del repositorio es : https://findresources.googlecode.com/svn/trunk/
> Acá hay una explicación paso a paso para configurar esto : http://eldespachodelosjorges.blogspot.com/2008/05/tortoisesvn-y-google-code.html

5) Si le pusieron una clave diferente de "manager" deben configurar la conexión a Oracle del CodeIgniter en el archivo c\wamp\www\FindResources\application\config\database.php

6) Para una prueba simple se puede entrar a  : http://localhost/FindResources/index.php/Test

7) Hay que habilitar el modulo php\_oci8 de PHP para el soporte de Oracle en el wamp. Haciendo clic en el ícono del wamp--> PHP-->PHP extensions-->php\_oci8 .( Martín, no va a hacer falta la librería adodb que te había dicho para la conexión)

8) Hice un php de prueba para la conexión a la base Oracle: http://localhost/FindResources/index.php/Testdb
> Hace un SELECT a una tabla TESTS que tiene 2 campos ID y TEST . Fíjense si pueden probarlo, yo lo hice tanteando y funcionó porque no tengo mucha idea tampoco.

9) Para editar el PHP se pueden usar :
- Como opción más simple el notepad2 que es un notepad básico con resaltado de sintaxis y varias funcionalidades más.
- Un IDE gratuito, Eclipse PHP : Descargar para tener todas las funcionalidades que te da el eclipse. Configuré el workspace en la carpeta c:\wamp\www\ , después fui a New-->PHP Project, en Project Name le puse el mismo nombre que la carpeta (FindResources) y listo. :)

JP habrá posibilidad de usar la base Oracle de forma "centralizada" y todos conectarnos a la misma? Yo podría configurar mi PC y que quede siempre prendida pero como sos vos el que va a estar usándola, no creo que te sea muy rápido el manejo si no es de forma local... no?

Creo que no me faltó nada para empezar.

Saludos!