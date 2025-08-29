<div id="tokenOverlay" class="token-overlay">
    <div class="form-token">
        <h3>Confirmação de E-mail</h3>
        <p>Enviamos um código de verificação para seu e-mail. Digite abaixo:</p>

        <form id="tokenForm">
            @csrf
            <input type="text" name="token" placeholder="Código de verificação" required maxlength="6">
            <hr>
            <button type="submit">Confirmar Conta</button>
        </form>

        <!-- Botão para reenviar -->
        <button type="button" id="reenviarBtn">Enviar Código</button>

        <div class="fechar" id="fecharToken">Cancelar</div>
    </div>
</div>
