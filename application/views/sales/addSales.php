<!-- Main container -->
    <main>
      <div class="main-content">

        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Zero configuration
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->

        <div class="">
          <form class="card" action="<?= base_url()."sales/addSales" ?>" method="POST">
              <h4 class="card-title"><strong>Tambah Sales</strong></h4>

              <?php if (validation_errors()) : ?>
                <p><font color="red"><center><?= validation_errors() ?></center></font></p>
              <?php endif; ?>
              <?php if (isset($error)) : ?>
                <p><font color="red"><center><?= $error ?></center></font></p>
              <?php endif; ?>

              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Kode Item</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="kode">
                      <option>BC 896 G</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nama Item</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="nama" value="<?= set_value('nama') ?>" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Kuantitas</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="qty" value="<?= set_value('qty') ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Total</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="total" value="<?= set_value('total') ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Customer</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="vendor">
                      <option>Sampoerna</option>
                    </select>
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