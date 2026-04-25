<h1>💬 Chat de la Comunidad</h1>
<p>Habla con tus vecinos en tiempo real.</p>

<div class="chat-container card">
    <div class="chat-messages" id="chatBox">
        <?php foreach ($mensajes as $m): 
            $esMio = ($m['usuario_id'] == $_SESSION['usuario_id']); 
        ?>
            <div class="message <?= $esMio ? 'mine' : 'others' ?>">
                <div class="message-info">
                    <strong><?= htmlspecialchars($m['nombre']) ?></strong>
                    <span><?= date('H:i', strtotime($m['enviado_en'])) ?></span>
                </div>
                <div class="message-bubble">
                    <?= htmlspecialchars($m['mensaje']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <form action="home.php?action=enviar_mensaje" method="POST" class="chat-input-area">
        <input type="text" name="mensaje" placeholder="Escribe un mensaje..." required autocomplete="off">
        <button type="submit" class="btn-send">
            <span>Enviar</span>
        </button>
    </form>
</div>

<script>
    function bajarChat() {
        const chatBox = document.getElementById('chatBox');
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }

    // Ejecutar cuando el DOM esté listo
    document.addEventListener("DOMContentLoaded", bajarChat);

    // Por si acaso las imágenes o estilos tardan, ejecutar al cargar todo
    window.addEventListener("load", bajarChat);
</script>