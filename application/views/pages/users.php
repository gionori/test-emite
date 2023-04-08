<h1 class="mb-5">Usuarios</h1>

<?php echo form_open(docker_url() . '/users/view/' . $result['page_size'] . '/' . $result['page_number']); ?>
  <input
    autocomplete="off"
    autofocus
    class="form-control form-control-lg"
    name="keywords"
    placeholder="Palabras clave"
    value="<?php echo $keywords ?>"
  />
</form>

<div class="mb-3 mt-3 text-end">
  <a
    class="btn btn-outline-primary"
    href="<?php echo docker_url() ?>/users/create"
  >
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
      <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
      <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
    </svg>
    Agregar usuario
  </a>
</div>

<?php if (count($result['data']) == 0): ?>

  <div class="alert alert-info">
    No hay resultados para esta búsqueda de usuarios.
  </div>

<?php else: ?>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nombre (s)</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Correo electrónico</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result['data'] as $user): ?>
          <tr>
            <td><?php echo $user->first_name; ?></td>
            <td><?php echo $user->last_name; ?></td>
            <td><?php echo $user->email; ?></td>
            <td>
              <a
                href="<?php echo docker_url() . '/users/xml/' . $user->id ?>"
                target="_blank"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-xml" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM3.527 11.85h-.893l-.823 1.439h-.036L.943 11.85H.012l1.227 1.983L0 15.85h.861l.853-1.415h.035l.85 1.415h.908l-1.254-1.992 1.274-2.007Zm.954 3.999v-2.66h.038l.952 2.159h.516l.946-2.16h.038v2.661h.715V11.85h-.8l-1.14 2.596h-.025L4.58 11.85h-.806v3.999h.706Zm4.71-.674h1.696v.674H8.4V11.85h.791v3.325Z"/>
                </svg>
              </a>
            </td>
          </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php endif; ?>
