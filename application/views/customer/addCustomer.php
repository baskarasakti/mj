<!-- Main container -->
    <main>
      <div class="main-content">

        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Zero configuration
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->

        <div class="">
          <form class="card" action="<?= base_url()."customer/addCustomer" ?>" method="POST">
              <h4 class="card-title"><strong>Tambah Customer</strong></h4>

              <?php if (validation_errors()) : ?>
                <p><font color="red"><center><?= validation_errors() ?></center></font></p>
              <?php endif; ?>
              <?php if (isset($error)) : ?>
                <p><font color="red"><center><?= $error ?></center></font></p>
              <?php endif; ?>

              <div class="card-body">

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nama Perusahaan</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="nama" value="<?= set_value('nama') ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Alamat</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="alamat" value="<?= set_value('alamar') ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">No Telepon</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="notelp" value="<?= set_value('notelp') ?>">
                  </div>
                </div>

              </div>

              <footer class="card-footer text-right">
                <button class="btn btn-primary" type="submit">Tambah</button>
              </footer>
            </form>
        </div>

      </div>

      <!--/.main-content -->