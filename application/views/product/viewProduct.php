<!-- Main container -->
    <main>
      <div class="main-content">

        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Zero configuration
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <div class="card">
            <p><font color="green"><center></center></font></p>
          <h4 class="card-title">
            Daftar <strong>Produk</strong> 
            <div class="pull-right">
              <a href="<?= base_url().'product/addBom' ?>" class="btn btn-primary" style="color:#fff;">Tambah Produk</a>
            </div>
          </h4>
          <div class="card-body">

            <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>Qty</th>
                  <th>uOm</th>
                  <th style="width: 90px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; foreach ($produk as $q) { ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $q->kode_produk ?></td>
                  <td><?= $q->nama_produk ?></td>
                  <td><?= $q->qty_produk ?></td>
                  <td>m</td>
                  <td class="text-right table-actions">
                    <a class="table-action hover-info" href=""><i class="fs-20 ti-info"></i></a>
                    <a class="table-action hover-primary" href=""><i class="fs-20 ti-pencil"></i></a>
                    <a class="table-action hover-danger" href="#" data-href=""  data-toggle="modal" data-target="#confirm-delete"><i class="fs-20 fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php $i++; } ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
      <!--/.main-content -->