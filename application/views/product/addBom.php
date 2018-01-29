
<!-- Main container -->

<main>
  <header class="header bg-ui-general">
    <div class="header-action">
      <nav class="nav">
        <a class="nav-link active" href="<?= base_url().'product/addBom' ?>">Nama</a>
        <a class="nav-link" href="<?= base_url().'product/addBom1' ?>">Bahan</a>
        <a class="nav-link" href="<?= base_url().'product/addBom2' ?>">BTKL</a>
        <a class="nav-link" href="<?= base_url().'product/addBom3' ?>">BOP</a>
      </nav>
    </div>
  </header>
  <div class="main-content">

    <div class="card">
      <h4 class="card-title"><strong>Project - Produksi</strong></h4>

      <form data-provide="validation" action="<?= base_url()."product/addBom" ?>" method="POST" data-disable="false">
        <div class="card-body">

          <?php if (validation_errors()) : ?>
            <p><font color="red"><center><?= validation_errors() ?></center></font></p>
          <?php endif; ?>
          <?php if (isset($error)) : ?>
            <p><font color="red"><center><?= $error ?></center></font></p>
          <?php endif; ?>

          <div class="form-group row">
            <label class="col-4 col-lg-2 col-form-label require" for="input-1">Kode Produk</label>
            <div class="col-8 col-lg-10">
              <input type="text" name="kode" class="form-control" id="input-1" value="<?= set_value('kode') ?>" required>
              <div class="invalid-feedback"></div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-4 col-lg-2 col-form-label require" for="input-1">Nama Produk</label>
            <div class="col-8 col-lg-10">
              <input type="text" name="nama" class="form-control" id="input-1" value="<?= set_value('nama') ?>" required>
              <div class="invalid-feedback"></div>
            </div>
          </div>

        </div>


        <footer class="card-footer text-right">
          <button class="btn btn-primary" type="submit">Selanjunya</button>
        </footer>


      </form>
    </div>

      </div><!--/.main-content -->