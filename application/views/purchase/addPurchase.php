<!-- Main container -->
    <main>
      <div class="main-content">

        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Zero configuration
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->

        <div class="">
          <form class="card" action="<?= base_url()."purchase/addPurchase" ?>" method="POST">
              <h4 class="card-title"><strong>Tambah Purchase</strong></h4>

              <?php if (validation_errors()) : ?>
                <p><font color="red"><center><?= validation_errors() ?></center></font></p>
              <?php endif; ?>
              <?php if (isset($error)) : ?>
                <p><font color="red"><center><?= $error ?></center></font></p>
              <?php endif; ?>

              <div class="card-body">            
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nomor PO</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="nomor" value="<?= set_value('nomor') ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tanggal</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="tanggal" value="<?= set_value('tanggal') ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Keterangan</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="keterangan" value="<?= set_value('keterangan') ?>"></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Vendor</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="vendor">
                      <option value="1">Colorpack</option>
                    </select>
                  </div>
                </div>

                <div id="jsgrid-start" data-provide="jsgrid"></div>

              </div>

              <footer class="card-footer text-right">
                <button class="btn btn-primary" type="submit">Tambah</button>
              </footer>
            </form>
        </div>

      </div>

      <!--/.main-content -->