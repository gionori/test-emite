<div class="d-flex justify-content-center mb-3">
    <h2>Acceso</h2>
</div>

<div class="d-flex justify-content-center">
    <?php echo form_open(docker_url() . '/pages/login'); ?>
        <div class="mb-3">
            <label
                class="form-label"
                for="email"
            >
                Correo electrónico
            </label>
            <input
                class="form-control"
                id="email"
                name="email"
                type="email"
            /> 
        </div>

        <div class="mb-3">
            <label
                for="password" 
                class="form-label"
            >
                Password
            </label>
            <input
                class="form-control"
                id="password"
                name="password"
                type="password"
            />
        </div>

        <?php
            $errors = validation_errors();
            if ($errors):
        ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errors; ?>
                </div>
        <?php endif; ?>

        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">
                Entrar
            </button>
        </div>
    </form>

</div>