
<!-- Main container -->

<main>
  <header class="header bg-ui-general">
    <div class="header-action">
      <nav class="nav">
        <a class="nav-link active" href="<?= base_url().'production/addProject' ?>">Nama</a>
        <a class="nav-link" href="<?= base_url().'production/addProject1' ?>">Informasi</a>
      </nav>
    </div>
  </header>
  <div class="main-content">

    <div class="card">
      <h4 class="card-title"><strong>Project - Produksi</strong></h4>

      <?php if (validation_errors()) : ?>
        <p><font color="red"><center><?= validation_errors() ?></center></font></p>
      <?php endif; ?>
      <?php if (isset($error)) : ?>
        <p><font color="red"><center><?= $error ?></center></font></p>
      <?php endif; ?>

      <form data-provide="validation" data-disable="false" action="<?= base_url()."production/addProject" ?>" method="POST">
        <div class="card-body">


          <div class="form-group row">
            <label class="col-4 col-lg-2 col-form-label require" for="input-1">Kode Produksi</label>
            <div class="col-8 col-lg-10">
              <input type="text" id="tags" name="kode" class="form-control" id="input-1" required>
              <div class="invalid-feedback"></div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-4 col-lg-2 col-form-label require" for="input-1">Nama Produksi</label>
            <div class="col-8 col-lg-10">
              <input type="text" class="form-control" name="nama" id="input-1" value="" required>
              <div class="invalid-feedback"></div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-4 col-lg-2 col-form-label require" for="input-1">Proses Produksi</label>
            <div class="col-8 col-lg-10">
              <input type="text" class="form-control" name="proses" id="input-1" value="Laminasi" required>
              <div class="invalid-feedback"></div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-4 col-lg-2 col-form-label require" for="input-1">Tanggal Produksi</label>
            <div class="col-8 col-lg-10">
              <input type="text" class="form-control" name="tanggal" id="input-1" value="09-01-2017" required>
              <div class="invalid-feedback"></div>
            </div>
          </div>

        </div>


        <footer class="card-footer text-right">
          <button class="btn btn-primary" type="submit">Selanjutnya</button>
        </footer>


      </form>
    </div>

      </div><!--/.main-content -->