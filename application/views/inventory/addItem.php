<!-- Main container -->
    <main>
      <div class="main-content">

        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Zero configuration
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->

        <div class="">
          <form class="card" action="<?= base_url()."inventory/addItem" ?>" method="POST">
              <h4 class="card-title"><strong>Tambah Item</strong></h4>

              <?php if (validation_errors()) : ?>
                <p><font color="red"><center><?= validation_errors() ?></center></font></p>
              <?php endif; ?>
              <?php if (isset($error)) : ?>
                <p><font color="red"><center><?= $error ?></center></font></p>
              <?php endif; ?>

              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nama Item</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="nama" value="<?= set_value('nama') ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Kategori</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="select" name="kategori">
                      <option selected="selected" disabled="disabled">&nbsp;</option>
                      <?php foreach ($kategori as $q) { ?>
                      <option value="<?= $q->id_kategori_item ?>"><?= $q->nama_kategori ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Kapasitas</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="kapasitas" value="<?= set_value('kapasitas') ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Kuantitas</label>
                  <div class="col-sm-8">
                    <input class="form-control" type="text" name="qty" value="<?= set_value('qty') ?>">
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