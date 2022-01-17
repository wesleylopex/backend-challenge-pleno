<script>
  const base_url = '<?= base_url() ?>'
</script>

<script src="<?= base_url('assets/admin/js/core/jquery.3.2.1.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/core/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/core/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/plugin/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/plugin/datepicker/bootstrap-datetimepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/plugin/select2/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/ready.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/plugin/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/setting-demo2.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') ?>"></script>

<script src="<?= base_url('assets/admin/js/forms/validate-form.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/feather-icons/feather.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

<script>
  feather.replace()

  $('.date').datetimepicker({
    format: 'DD/MM/YYYY'
  })

  $('.select2').select2({
    theme: 'bootstrap',
    minimumResultsForSearch: 10
  })

  function showNotify (message, success = true) {
    const alert = { icon: success === true ? 'la la-check' : 'la la-times', message }
    const options = {
      type: 'primary',
      placement: { from: 'bottom', align: 'right' },
      time: 1000
    }
    $.notify(alert, options)
  }

  function initDatataTable () {
    $('.datatable').dataTable({
      language: {
        url: '<?= base_url('assets/admin/js/datatables/portuguese-brazil.json') ?>'
      }
    })
  }

  initDatataTable()

  function closeAlert () {
    const alert = document.querySelector('.alert')
    if (!alert) return null
    const close = alert.querySelector('.close')
    close.addEventListener('click', () => {
      alert.remove()
    })
  }

  closeAlert()
</script>