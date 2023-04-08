<h1 class="mb-5">
    <?php echo $title ?>
</h1>


<?php
    $errors = validation_errors();
    if ($errors):
?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errors; ?>
        </div>
<?php endif; ?>


<?php echo form_open(docker_url() . '/users/create'); ?>

    <!-- First name -->
    <div class="mb-3">
        <label
            class="form-label"
            for="first_name"
        >
            Nombre (s)
        </label>
        <input
            class="form-control"
            name="first_name"
            placeholder="Juan"
        />
    </div>

    <!-- Last name -->
    <div class="mb-3">
        <label
            class="form-label"
            for="last_name"
        >
            Apellidos
        </label>
        <input
            class="form-control"
            name="last_name"
            placeholder="Pérez"
        />
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label
            class="form-label"
            for="email"
        >
            Correo electrónico
        </label>
        <input
            class="form-control"
            name="email"
            placeholder="email@empresa.com"
            type="email"
        />
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label
            class="form-label"
            for="password"
        >
            Contraseña
        </label>
        <input
            class="form-control"
            name="password"
            type="password"
        />
    </div>

    <button
        class="btn btn-primary"
        type="submit"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
        </svg>
        Guardar
    </button>
    
</form>