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
            Daftar <strong>Vendor</strong> 
            <div class="pull-right">
              <a href="<?= base_url()."vendor/addVendor" ?>" class="btn btn-primary" style="color:#fff;">Tambah Vendor</a>
            </div>
          </h4>
          <div class="card-body">

            <table class="table table-striped table-bordered" cellspacing="0" data-provide="datatables">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Nama Vendor</th>
                  <th>No Telepon</th>
                  <th>Alamat</th>
                  <th style="width: 90px">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Colorpack</td>
                  <td>031 8111111</td>
                  <td>Jl. Test 02</td>
                  <td class="text-right table-actions">
                    <a class="table-action hover-info" href=""><i class="fs-20 ti-info"></i></a>
                    <a class="table-action hover-primary" href=""><i class="fs-20 ti-pencil"></i></a>
                    <a class="table-action hover-danger" href="#" data-href=""  data-toggle="modal" data-target="#confirm-delete"><i class="fs-20 fa fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Colorpack</td>
                  <td>031 8111111</td>
                  <td>Jl. Test 02</td>
                  <td class="text-right table-actions">
                    <a class="table-action hover-info" href=""><i class="fs-20 ti-info"></i></a>
                    <a class="table-action hover-primary" href=""><i class="fs-20 ti-pencil"></i></a>
                    <a class="table-action hover-danger" href="#" data-href=""  data-toggle="modal" data-target="#confirm-delete"><i class="fs-20 fa fa-trash"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
      <!--/.main-content -->