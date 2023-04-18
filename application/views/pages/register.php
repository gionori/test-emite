<div class="d-flex justify-content-center mb-3">
    <h2>Registro</h2>
</div>

<div class="d-flex justify-content-center">
    <form id="form">    
        <!-- First name -->
        <div class="mb-3">
            <label
                class="form-label"
                for="first_name"
            >
                Nombre (s)
            </label>
            <input
                autocomplete="off"
                class="form-control"
                id="first_name"
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
                autocomplete="off"
                class="form-control"
                id="last_name"
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
                autocomplete="off"
                class="form-control"
                id="email"
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
                autocomplete="off"
                class="form-control"
                id="password"
                name="password"
                type="password"
            />
        </div>

        <button
            class="btn btn-primary"
            id="btn"
            type="submit"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
            </svg>
            Guardar
        </button>
    </form>    
</div>

<div class="d-flex justify-content-center">
    <a href="<?php echo docker_url() . '/pages/login'; ?>">
        <small>
            Ya tengo una cuenta
        </small>
    </a>
</div>

<div id="message"></div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<script>
    (() => {  
        const host = 'localhost'      ;
        const url = `http://${host}/test-emite/index.php/api/users/register`;
        
        setTimeout(() => {
            setStatusForm(false);            
        }, 2000);

        $( "#form" ).submit(event => {
            save();
            event.preventDefault();
        });

        $('#btn').click(save);
        
        function save() {
            setStatusForm(true);
            showMessage();

            const data = {
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
            };

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: res => {
                    const { ok } = res;
                    setStatusForm(false);

                    if (ok) {
                        window.location = `http://${host}/test-emite/index.php/pages/login`;
                    } else {
                        alert(res);
                    }
                },
                error: err => {
                    const { responseJSON } = err;
                    const { message } = responseJSON;

                    setStatusForm(false);
                    showMessage(message);
                },
                dataType: 'json'
            });

        }

        function setStatusForm(isLoading = false) {
            if (isLoading) {
                $('#btn').attr('disabled', 'disabled');
                $('#btn').text('Registrando...');

                $('#first_name').attr('disabled', 'disabled');
                $('#last_name').attr('disabled', 'disabled');
                $('#email').attr('disabled', 'disabled');
                $('#password').attr('disabled', 'disabled');
            } else {
                $('#btn').removeAttr('disabled');
                $('#btn').text('Registrar');

                $('#first_name').removeAttr('disabled');
                $('#last_name').removeAttr('disabled');
                $('#email').removeAttr('disabled');
                $('#password').removeAttr('disabled');
            }
        }

        function showMessage(message) {
            if (message) {
                $('#message').html(`<div class="alert alert-danger">${message}</div>`);
            } else {
                $('#message').html(``);
            }   
        }

    })();
</script>