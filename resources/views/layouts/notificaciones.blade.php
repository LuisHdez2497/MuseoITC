<div id="notificaciones">
    @if (session('message'))
        <div class="alert alert-success message-edit">
            {{ session('message') }}
            <button type="button" class="close" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger message-error">
            {{ session('error') }}
            <button type="button" class="close" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
