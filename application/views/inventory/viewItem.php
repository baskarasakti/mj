<!-- Main container -->
    <main>
      <div class="main-content">

        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Zero configuration
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <div class="card">
          <?php if (null!==$this->session->flashdata('success')) : ?>
            <p><font color="green"><center><?= $this->session->flashdata('success'); ?></center></font></p>
          <?php endif; ?>
          <h4 class="card-title">
            Daftar <strong>Item</strong> 
            <div class="pull-right">
              <a href="<?= base_url().'inventory/addItem' ?>" class="btn btn-primary" style="color:#fff;">Tambah Item</a>
            </div>
          </h4>
          <div class="card-body">

            <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Nama Item</th>
                  <th>Kategori</th>
                  <th>Qty</th>
                  <th>UoM</th>
                  <th style="width: 20px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($item as $q) { 
                if ($q->kategori_item == 1) { ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $q->nama_kertas ?></td>
                  <td><?= $q->nama_kategori ?></td>
                  <td><?= $q->qty_kertas ?></td>
                  <td><?= $q->nama_uom ?></td>
                  <td class="text-right table-actions">
                    <a class="table-action hover-primary" href="<?= base_url()."inventory/editItem/".$q->id_item_k ?>"><i class="ti-pencil"></i></a>
                    <a class="table-action hover-danger" href="#" data-href="<?= base_url()."inventory/deleteItem/".$q->id_item_k ?>"  data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php } else if ($q->kategori_item == 2) { ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $q->nama_tinta ?></td>
                  <td><?= $q->nama_kategori ?></td>
                  <td><?= $q->qty_tinta ?></td>
                  <td><?= $q->nama_uom ?></td>
                  <td class="text-right table-actions">
                    <a class="table-action hover-primary" href="<?= base_url()."inventory/editItem/".$q->id_item_t ?>"><i class="ti-pencil"></i></a>
                    <a class="table-action hover-danger" href="#" data-href="<?= base_url()."inventory/deleteItem/".$q->id_item_t ?>"  data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php } else if ($q->kategori_item == 3) { ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $q->nama_silinder ?></td>
                  <td><?= $q->nama_kategori ?></td>
                  <td><?= $q->qty_silinder ?></td>
                  <td><?= $q->nama_uom ?></td>
                  <td class="text-right table-actions">
                    <a class="table-action hover-primary" href="<?= base_url()."inventory/editItem/".$q->id_item_s ?>"><i class="ti-pencil"></i></a>
                    <a class="table-action hover-danger" href="#" data-href="<?= base_url()."inventory/deleteItem/".$q->id_item_s ?>"  data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php } $i++; } ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
      <!--/.main-content -->