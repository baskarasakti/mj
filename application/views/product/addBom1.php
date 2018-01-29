
<!-- Main container -->

<main>
  <header class="header bg-ui-general">
    <div class="header-action">
      <nav class="nav">
        <a class="nav-link" href="<?= base_url().'product/addBom' ?>">Nama</a>
        <a class="nav-link active" href="<?= base_url().'product/addBom1/'.$id ?>">Bahan</a>
        <a class="nav-link" href="<?= base_url().'product/addBom2/'.$id ?>">BTKL</a>
        <a class="nav-link" href="<?= base_url().'product/addBom3/'.$id ?>">BOP</a>
      </nav>
    </div>
  </header>
  <div class="main-content">

    <div class="card">
      <h4 class="card-title"><strong>Bahan Utama</strong></h4>
        <div class="card-body">

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nama Bahan</th>
                <th style="width: 50px">Action</th>
              </tr>
            </thead>
            <tbody>
              <form action="<?= base_url()."product/addBom1/".$id ?>" method="POST">
              <tr>
                <input type="hidden" name="idproduk" value="<?= $id ?>">
                <td><input type="text" name="iditem" class="form-control" id="tags"></td>
                <td><button class="btn btn-primary btn-outline hover-white" type="submit"><i class="fa fa-plus"></i></button></td>
              </tr>
              </form>
              <?php foreach ($bom as $q) { ?>
              <tr>
                <?php if ($q->kategori_item == 1) { ?>
                  <td><?= $q->nama_kertas ?></td>
                <?php } else if ($q->kategori_item == 2) { ?>
                  <td><?= $q->nama_tinta ?></td>
                <?php } else if ($q->kategori_item == 3) { ?>
                  <td><?= $q->nama_silinder ?></td>
                <?php }  ?>
                <td>
                  <a class="table-action hover-primary"><i class="ti-pencil"></i></a>
                  <a class="table-action hover-danger"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <?php } ?>
          </table>

        </div>


        <footer class="card-footer text-right">
          <a href="<?= base_url().'product/addBom2'.$id ?>" class="btn btn-primary">Selanjutnya</a>
        </footer>
    </div>

      </div><!--/.main-content -->