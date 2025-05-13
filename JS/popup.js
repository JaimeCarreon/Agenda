function mostrar(msg, name, dire, tel, email, ope, clave) {
    // Crear overlay
    const overlay = document.createElement('div');
    overlay.className = 'popup-overlay';

    // Crear contenedor del popup
    const popup = document.createElement('div');
    popup.className = 'popup-box';

    // Mensaje principal
    const mensaje = document.createElement('p');
    mensaje.textContent = msg;
    mensaje.style.fontSize = '1.1em';
    mensaje.style.fontWeight = 'bold';

    // Datos del contacto
    const pNombre = document.createElement('p');
    pNombre.textContent = "Nombre: " + name;

    const pDireccion = document.createElement('p');
    pDireccion.textContent = "Dirección: " + dire;

    const pTelefono = document.createElement('p');
    pTelefono.textContent = "Teléfono: " + tel;

    const pCorreo = document.createElement('p');
    pCorreo.textContent = "Correo: " + email;

    const form = document.createElement('form');
    form.method = 'post';
    form.action = ope;

    const inputOpe = document.createElement('input');
    inputOpe.name = 'txtOpe';
    inputOpe.type = 'hidden';
    inputOpe.value = 'b';

    const inputClave = document.createElement('input');
    inputClave.name = 'txtClave';
    inputClave.type = 'hidden';
    inputClave.value = clave;

    form.appendChild(inputOpe);
    form.appendChild(inputClave);
    // Botones
    const contenedorBotones = document.createElement('div');
    contenedorBotones.className = 'popup-actions';

    const btnAceptar = document.createElement('button');
    btnAceptar.textContent = "Aceptar";
    btnAceptar.className = 'btn-aceptar';
    btnAceptar.onclick = function () {
        document.body.removeChild(overlay); // cerrar el popup
        document.body.appendChild(form);    // agregar el formulario al DOM
        form.submit(); 
    };

    const btnCancelar = document.createElement('button');
    btnCancelar.textContent = "Cancelar";
    btnCancelar.className = 'btn-cancelar';
    btnCancelar.onclick = function () {
        document.body.removeChild(overlay);
    };

    // Ensamblar botones y popup
    contenedorBotones.appendChild(btnAceptar);
    contenedorBotones.appendChild(btnCancelar);

    popup.appendChild(mensaje);
    popup.appendChild(pNombre);
    popup.appendChild(pDireccion);
    popup.appendChild(pTelefono);
    popup.appendChild(pCorreo);
    popup.appendChild(contenedorBotones);

    overlay.appendChild(popup);
    document.body.appendChild(overlay);
}
