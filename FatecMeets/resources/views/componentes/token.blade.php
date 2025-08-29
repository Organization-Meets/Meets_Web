    <div id="parte3" class="section hidden">
        <form id="tokenForm">
            @csrf
            <h3>Confirmação de E-mail</h3>
            <p>Enviamos um código de verificação para seu e-mail. Digite abaixo:</p>
            <input type="text" name="token" placeholder="Código de verificação" required maxlength="6">

            <hr>
            <button type="submit">Confirmar Conta</button>
        </form>

        <!-- Botão para reenviar -->
        <button type="button" id="reenviarBtn">Enviar Código</button>
    </div>