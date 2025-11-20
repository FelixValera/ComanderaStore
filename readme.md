# OrderFlow – Sistema de Gestión de Órdenes  

OrderFlow es una aplicación web desarrollada para optimizar el proceso de entrega de productos en el área de depósito y empaque de una empresa de venta de electrodomésticos. El sistema permite visualizar, tomar y gestionar las órdenes de entrega en tiempo real, agilizando la preparación de pedidos y mejorando la coordinación entre los equipos.

---

## 📦 Estructura del Proyecto

```bash
C:.
│   .gitignore
│   .htaccess
│   autoload.php
│   config.php
│   readme.md
│
├── App
│   ├── Controllers
│   │   ├── ApiController.php
│   │   └── PedidosController.php
│   │
│   ├── Http
│   │   ├── Request.php
│   │   ├── RequestPipeline.php
│   │   ├── Server.php
│   │   │
│   │   ├── Middlewares
│   │   │   ├── ClosureMiddleware.php
│   │   │   ├── Middleware.php
│   │   │   └── SessionStartMiddleware.php
│   │   │
│   │   └── Routing
│   │       ├── Router.php
│   │       └── RoutingMiddleware.php
│   │
│   └── views
│       ├── head.html
│       ├── nav.html
│       └── pedidos.php
│
├── Core
│   └── Database
│       ├── IdataSource.php
│       └── SqlServerDataSource.php
│
├── Domain
│   ├── Entities
│   │   ├── Item.php
│   │   ├── Oareti.php
│   │   ├── Odespa.php
│   │   └── Otomada.php
│   │
│   └── Repositories
│       ├── OaretiRepository.php
│       ├── OdespaRepository.php
│       └── OtomadasRepository.php
│
├── public
│   └── index.php
│
├── img
│   └── logo-small.png
│
└── js
    └── script.js
```
---

## ⚙️ Descripción General  

El proyecto fue diseñado para abordar un problema logístico común: la demora en el despacho de productos debido a la falta de coordinación entre las áreas de facturación, empaque y depósito.  

OrderFlow actúa como una **comandera digital**, mostrando en tiempo real las órdenes de entrega generadas por el sistema ERP de la empresa. Los operadores del depósito pueden visualizar las órdenes pendientes, tomar una orden para su preparación y marcarla como completada una vez entregada.

---

## 🧠 Arquitectura y Diseño  

El sistema fue desarrollado en **PHP 7.4.3**, **JavaScript** y **Tailwind CSS**, sin el uso de frameworks externos.  
Se implementó una **arquitectura por capas** con una estructura modular y clara separación de responsabilidades:

- **App/** → Contiene los controladores, vistas y lógica HTTP.  
- **Core/** → Maneja la conexión con la base de datos y la fuente de datos.  
- **Domain/** → Define las entidades de negocio y los repositorios de acceso a datos.  
- **public/** → Punto de entrada y recursos públicos (JS, imágenes, CSS).  

---

## 🧩 Principales Componentes  

### **Router**
Permite registrar y gestionar rutas de forma encadenada, aplicando el patrón **Fluent Interface**.  

### **Middlewares**
Definen procesos que la solicitud debe atravesar antes de llegar al controlador, como la validación de datos, el manejo de sesiones y otros mecanismos intermedios.

### **Request y RequestPipeline**
Gestionan las solicitudes HTTP y permiten aplicar una cadena de middlewares de forma dinámica antes de delegar la ejecución al controlador.  

### **Server**
Centraliza el flujo de la aplicación integrando `Router`, `Request` y `RequestPipeline`, siguiendo el patrón **Front Controller**.  

### **Database (Core)**
Contiene la lógica de conexión con SQL Server mediante **PDO**.  
Se implementó el patrón **Repository** para separar la lógica de acceso a datos de la representación de entidades y del controlador.  

- `IDataSource` define la interfaz que deben implementar las clases de conexión.  
- `SqlServerDataSource` implementa la conexión real a la base de datos y el patrón **Singleton** para garantizar una única instancia activa.  

---

## 🧱 Patrones de Diseño Implementados  

- **Singleton** → En `SqlServerDataSource`, garantiza una única conexión activa.  
- **Repository** → Separa la lógica de datos de la capa de negocio.  
- **Fluent Interface** → Facilita el registro de rutas en `Router`.  
- **Front Controller** → Centraliza las solicitudes en un único punto de acceso.  
- **MVC (inspirado)** → El flujo sigue la idea de controlador–repositorio–vista.  

---

## 💻 Descripción de la Interfaz  

La vista principal está estructurada en tres secciones:

- **Barra superior (navbar):**  
  Contiene el logotipo de la empresa, el nombre del sistema *OrderFlow*, un reloj digital centrado y el nombre del depósito a la derecha.  

- **Zona de órdenes pendientes:**  
  Muestra las órdenes del día clasificadas en:
  - **ODESPA** → Órdenes a retirar en el momento.  
  - **OARETI** → Órdenes programadas para retiro posterior.  

  Cada tarjeta muestra:
  - Número y hora de la orden.  
  - Cliente y factura asociada.  
  - Vendedor responsable.  
  - Tabla de productos con código, descripción y cantidad.  

  El color de la cabecera cambia según el tiempo de demora:
  - ⏱️ Menos de 10 min → Gris  
  - ⚠️ Entre 10 y 20 min → Amarillo  
  - 🔴 Más de 20 min → Rojo  

  Además, el sistema emite notificaciones visuales y sonoras cuando llegan nuevas órdenes.

- **Botón “Tomar Orden”:**  
  Permite marcar una orden como *en preparación*.  
  - El botón cambia su estado visual y se desactiva.  
  - Las órdenes tomadas se guardan en una tabla de control.  
  - El sistema identifica automáticamente cuáles están en preparación en cada actualización.  

---

## 🔁 Funcionamiento Dinámico  

- **Actualización automática:**  
  El sistema se refresca cada 30 segundos para mostrar cambios en tiempo real.  

- **Sin recargas innecesarias:**  
  Las acciones (como tomar una orden) se envían mediante **fetch()** (AJAX) para evitar recargar la página.  

- **Sincronización entre sucursales:**  
  Cada sucursal tiene su propia ruta para obtener únicamente las órdenes correspondientes a su depósito.  

- **Persistencia visual:**  
  Las órdenes tomadas mantienen su estado visual tras cada actualización, asegurando coherencia entre cliente y servidor.  

---

## 🧰 Tecnologías Utilizadas  

- **Backend:** PHP 7.4.3 (PDO – SQL Server)  
- **Frontend:** JavaScript (Fetch API)  
- **Estilos:** Tailwind CSS  
- **Arquitectura:** Por capas (inspirada en MVC)  
- **Diseño:** Minimalista, adaptable y centrado en la funcionalidad  

---

## 🚀 Características Destacadas  

- Interfaz ligera y responsiva.  
- Gestión eficiente de órdenes en tiempo real.  
- Identificación visual de órdenes demoradas.
- Notificación visual y sonora ante la llegada de nuevas órdenes.  
- Actualización automática sin sobrecargar el servidor.  
- Código estructurado, mantenible y extensible.  

---

## 👤 Autor

**Félix Germán Valera García**   
Desarrollador Backend – PHP | Laravel  

🔗 **LinkedIn:** [www.linkedin.com/in/felix-valera](https://www.linkedin.com/in/f%C3%A9lix-german-valera-garcia-470037243/)