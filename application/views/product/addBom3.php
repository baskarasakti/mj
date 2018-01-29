
<!-- Main container -->

<main>
  <header class="header bg-ui-general">
    <div class="header-action">
      <nav class="nav">
        <a class="nav-link" href="<?= base_url().'product/addBom' ?>">Nama</a>
        <a class="nav-link active" href="<?= base_url().'product/addBom1' ?>">Bahan</a>
        <a class="nav-link" href="<?= base_url().'product/addBom2' ?>">BTKL</a>
        <a class="nav-link" href="<?= base_url().'product/addBom3' ?>">BOP</a>
      </nav>
    </div>
  </header>
  <div class="main-content">

    <div class="card">
      <h4 class="card-title"><strong>BTKL</strong></h4>

      <form data-provide="validation" data-disable="false">
        <div class="card-body">

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nama Biaya</th>
                <th style="width: 50px">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="text" class="form-control"></td>
                <td><a class="btn btn-primary btn-outline hover-white"><i class="fa fa-plus"></i></a></td>
              </tr>
              <tr>
                <td>Biaya Penyusutan</td>
                <td>
                  <a class="table-action hover-primary"><i class="ti-pencil"></i></a>
                  <a class="table-action hover-danger"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td>Biaya Listrik</td>
                <td>
                  <a class="table-action hover-primary"><i class="ti-pencil"></i></a>
                  <a class="table-action hover-danger"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            </tbody>
          </table>

        </div>


        <footer class="card-footer text-right">
          <button class="btn btn-primary" type="submit">Submit</button>
        </footer>


      </form>
    </div>

      </div><!--/.main-content -->