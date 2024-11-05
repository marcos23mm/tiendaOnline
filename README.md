# tiendaOnline
El trabajo se debe realizar por equipos formados por 2 personas.
 
Debéis implementar una aplicación web dinámica que contenga la siguiente funcionalidad:

    Gestión de la trastienda:
        Mostrar productos de la base de datos.
        Añadir productos de la base de datos.
        Modificar productos de la base de datos.
        Eliminar productos de la base de datos.
    Gestión carrito (CRUD temporal con sesiones)
        Añadir producto al carrito.
        Borrar producto del carrito
        Eliminar todos los productos del carrito.
    Registro, inicio y cierre de sesión del cliente.

Para poder gestionar correctamente las acciones anteriores, se deben utilizar formularios. Los formularios deben hacer las siguientes comprobaciones:

    Validaciones complejas haciendo uso de expresiones regulares:
    Nombres con solo caracteres alfanuméricos.
    Campos obligatorios.
    Correos electrónicos.
    Contraseñas con longitud mínima, uso de mayúsculas, minúsculas y números.
    Se deben rellenar todos los campos.
    El precio de los productos debe ser un valor positivo.
    No se pueden repetir los nombres de los productos.
    Los productos que tengan un importe inferior a 10€ deberán tener acompañado el literal "producto de oferta". Los que tengan un precio superior a 200€ "producto de calidad".


La página debe estar compuesta de como mínimo 7 ficheros php:

Página principal (landing page) + páginas adicionales:

    Página principal con diferentes productos de la tienda online.
    Página de subida de producto  (interfaz donde se muestran los datos del producto), debe incluir la opción de adjuntar ficheros multimedia.
    Página de edición de producto  (interfaz donde se muestran los datos del producto), debe incluir la opción de adjuntar ficheros multimedia.
    Pagina de listado/eliminación de productos.
    Página de visualización de detalle de producto (interfaz de solo lectura). En esta interfaz se deben mostrar todos los datos de un producto en concreto junto con su imagen descriptiva.
    Página de iniciar / cerrar sesión.
    Página de registro de cliente.

Para garantizar la consistencia de todas las interfaces, todas las páginas deben disponer como mínimo de:

    Encabezado.
    Pie de página.
    Barra de navegación.

Nota: Si se desea se puede utilizar una plantilla CSS para mejorar la estética de la página, la realización de la misma es totalmente libre.

Al finalizar la implementación de la página se deberá realizar una breve presentación del trabajo realizado (5 minutos de duración). No es necesario realizar un power point o similar, con mostrar la funcionalidad de la app al completo es suficiente. En caso de no realizar la presentación la calificación será de 0 puntos.

No se permite el uso de frameworks de ningún tipo(Laravel, Doctrine, Bootstrap, Tailwind, etc...), en caso de usarse la calificación será de 0 puntos.

Formato de entrega: Repositorio en Github.
