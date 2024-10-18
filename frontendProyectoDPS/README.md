# Aplicación web/móvil para una e-commerce en tecnología

## Universidad Don Bosco
### Facultad de Ingeniería
### Escuela de Ingeniería en Ciencias de la Computación
### Diseño y Programación de Software Multiplataforma DPS104 Grupo Teórico 01T

### Proyecto de cátedra
### Entrega final

## Integrantes:
- Cristian Alexander Alfaro Hernández - AH211671
- Cruz Enrique Moreno Lozano - ML210800
- Benjamín Enrique Rivas Hidalgo - RH190164
- Francisco Alfonso Sandoval Barrera - SB200814
- Francisco Javier Zaldaña Álvarez - ZA210751

## Enlaces a:
- Trello: https://trello.com/b/CRX20Vn2/kanban-task-board
- Figma (Diseño web): https://www.figma.com/design/Jcl0zMDv7p44bJdPKPJeSs/Web-Mock-up?node-id=0-1&t=QTQv6zZptFrP8x2y-1
- Figma (Diseño móvil): https://www.figma.com/design/uRyx2PBWSlmmxFLrRNaaAL/Movil-Mock-ups?t=QTQv6zZptFrP8x2y-1
- Manual de usuarios: https://github.com/CruzM-224/frontendProyectoDPS/blob/main/MANUALES/MANUAL%20USUARIO%20UDB%20TECH-SHOP.pdf
- Manual técnico: https://github.com/CruzM-224/frontendProyectoDPS/blob/main/MANUALES/MANUAL%20TECNICO%20UDB%20TECH-SHOP.pdf

## Licencias Creative Commons
<p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/"><a property="dct:title" rel="cc:attributionURL" href="https://github.com/Franckalv/e-commerce-project">DPS e-commerce project</a> by <span property="cc:attributionName">Cristian Alfaro, Francisco Sandoval, Benjamín Rivas, Cruz Moreno, Francisco Zaldaña </span> is licensed under <a href="https://creativecommons.org/licenses/by-nc-nd/4.0/?ref=chooser-v1" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International <br> <img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1" alt=""></a></p>


## Descripción
Este proyecto consiste en el desarrollo de una plataforma de comercio electrónico para la venta de artículos informáticos, tales como ordenadores, componentes, periféricos, software, y otros accesorios tecnológicos. La plataforma ha sido diseñada para ofrecer una experiencia de compra sencilla, eficiente y segura tanto para los usuarios finales como para los administradores del sistema.

Tecnologías Utilizadas:

- Backend: El servidor y la lógica de negocio se han desarrollado utilizando Laravel, que proporciona una estructura clara y un ecosistema de herramientas que permiten la creación de una API eficiente y escalable. Laravel maneja la autenticación, la gestión de usuarios, la lógica de compras, así como la integración con bases de datos.

- Frontend: La interfaz de usuario ha sido desarrollada con React Native, una tecnología de desarrollo móvil que permite crear aplicaciones nativas tanto para dispositivos Android como iOS. Con React Native, los usuarios disfrutan de una experiencia de navegación rápida y fluida, con un diseño adaptativo y una interacción amigable para dispositivos móviles.

## Guía de instalación
Inicialmente, es necesario clonar ambos repositorios en nuestro dispositivo.

- Enlace para clonar el repositorio de Frontend: https://github.com/CruzM-224/frontendProyectoDPS.git
- Enlace para clonar el repositorio de Backend: https://github.com/CruzM-224/backendProyectoDPS.git

#### Preparación del frontend
Seguidamente, vamos a dirigirnos, desde la terminal, hasta la carpeta que almacena nuestra aplicación, en este caso: /proyectoDPS, para instalar las dependencias de nuestro proyecto.

Para desplazarnos entre las carpetas utilizamos cd ruta-específica. Para descargar todas las dependencias se utiliza el comando: npm install.

Una vez descargadas las dependencias, es necesario realizar un cambio en el archivo proyectoDPS/app/(tabs)/home/index.tsx, en el cual agregaremos la IP de nuestro dispositivo para que se logre conectar a la API.

En la línea 32, generar el siguiente cambio:
const API_URL = 'http://IP-DEL-DISPOSITIVO:8000/api/productos/get';

Para conocer cuál es la IP del dispositivo, se puede encontrar desde la terminal con el comando: ipconfig.

#### Preparación del backend

Inicialmente, desde una terminal, vamos a desplazarnos hacia la ruta en la cual se encuentra nuestra carpeta que almacena el backend, la cual termina en /backendProyectoDPS.

Seguidamente, realizaremos el comando docker-compose up para levantar los servicios del backend dentro de un contenedor.

De esta forma, hemos generado la preparación necesaria para que la aplicación funcione correctamente.
