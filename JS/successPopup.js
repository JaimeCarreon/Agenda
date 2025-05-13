// Verificar parámetro success al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.get('success') === '1') {
        showSuccessMessage();
        // Limpiar la URL sin recargar
        history.replaceState({}, document.title, window.location.pathname);
    }
});

function showSuccessMessage() {
    // Crear elemento del mensaje
    const messageDiv = document.createElement('div');
    messageDiv.className = 'success-message-container';
    messageDiv.innerHTML = `
        <div class="success-title">Agenda Telefónica</div>
        <div class="success-content">¡Operación realizada con éxito!</div>
        <button class="success-button" onclick="closeSuccessMessage()">Aceptar</button>
    `;
    
    document.body.appendChild(messageDiv);
    
    // Cerrar automáticamente después de 3 segundos
    setTimeout(closeSuccessMessage, 3000);
}

function closeSuccessMessage() {
    const message = document.querySelector('.success-message-container');
    if (message) {
        message.remove();
    }
}

// Hacer la función accesible globalmente
window.closeSuccessMessage = closeSuccessMessage;