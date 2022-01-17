<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php include_once 'application/views/admin/utils/start.php' ?>
</head>

<body data-background-color="bg3">
  <div class="wrapper">
    <?php include_once 'application/views/admin/utils/header.php' ?>
    <div class="main-panel">
      <div class="content">
        <div class="container-fluid">
          <div class="page-header god-header">
            <h4 class="page-title">Marcas</h4>
            <ul class="breadcrumbs">
              <li class="nav-home">
                <a href="<?= base_url('admin') ?>">home </a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/brands')?>">Marcas</a>
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <form action="<?= base_url('admin/brands/save') ?>" enctype="multipart/form-data" method="post">
                  <div class="card-body p-30px">
                    <input type="hidden" name="id" value="<?= isset($brand) ? $brand->id : ''?>">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="model">Nome</label>
                        <input type="text" required class="form-control" name="name" value="<?= isset($brand) ? $brand->name : '' ?>">
                        <label class="error-label"></label>
                      </div>
                    </div>
                  </div>
                  <div class="card-action">
                    <a href="<?= site_url('admin/brands') ?>">
                      <button type="button" class="btn btn-black btn-border">
                        Voltar
                      </button>
                    </a>
                    <button type="submit" class="submit-button d-flex align-items-center btn btn-black btn-save">
                      Salvar
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php include_once 'application/views/admin/utils/end.php' ?>

  <script>
    const settings = {
			baseURL: '<?= base_url() ?>'
		}

    window.addEventListener('load', onDocumentLoad)

    function onDocumentLoad () {
      onFormSubmit()
    }

    function onFormSubmit () {
      const form = document.querySelector('form')

      form.addEventListener('submit', event => {
        event.preventDefault()
        saveFormData(event.target)
      })

      async function saveFormData (form) {
        const url = form.getAttribute('action')
        const body = new FormData(form)

        const response = await fetch(url, {
          method: 'POST',
          body
        }).then(response => response.json())

        if (response.success === true) {
          window.location.href = `${settings.baseURL}admin/brands`
        } else {
          showNotify(response.error || 'Erro ao salvar', false)
        }
      }
    }
  </script>
</body>

</html>