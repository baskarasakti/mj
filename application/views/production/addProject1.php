
<!-- Main container -->

<main>
  <header class="header bg-ui-general">
    <div class="header-action">
      <nav class="nav">
        <a class="nav-link" href="<?= base_url().'production/addProject' ?>">Nama</a>
        <a class="nav-link active" href="<?= base_url().'production/addProject1/'.$id ?>">Informasi</a>
      </nav>
    </div>
  </header>
  <div class="main-content">

    <div class="card">
      <h4 class="card-title"><strong>Project - Produksi</strong></h4>

      <form data-provide="validation" data-disable="false">
        <div class="card-body">

          <div class="card">
            <h4 class="card-title"><strong>A. Bahan Utama</strong></h4>

            <div class="card-body">

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Kategori Bahan</th>
                    <th>Nama Bahan</th>
                    <th>Qty Unit</th>
                    <th>Qty Tap</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tinta</td>
                    <td>PB935</td>
                    <td><input type="text" class="form-control" id="qtyUnit"></td>
                    <td><input type="text" class="form-control" id="qtyTap"></td>
                    <td>kg</td>
                    <td><input type="text" class="form-control" id="harga"></td>
                    <td><input type="text" class="form-control" id="jumlah"></td>
                  </tr>
                  <tr>
                    <td>Kertas</td>
                    <td>35GSM</td>
                    <td><input type="text" class="form-control" id="qtyUnit"></td>
                    <td><input type="text" class="form-control" id="qtyTap"></td>
                    <td>m</td>
                    <td><input type="text" class="form-control" id="harga"></td>
                    <td><input type="text" class="form-control" id="jumlah"></td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>

          <div class="card">
            <h4 class="card-title"><strong>B. BTKL</strong></h4>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Proses</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Printing</td>
                    <td><input type="text" class="form-control" id="qtyUnit"></td>
                    <td>Hari</td>
                    <td><input type="text" class="form-control" id="harga"></td>
                    <td><input type="text" class="form-control" id="jumlah"></td>
                  </tr>
                  <tr>
                    <td>Sliter</td>
                    <td><input type="text" class="form-control" id="qtyUnit"></td>
                    <td>Hari</td>
                    <td><input type="text" class="form-control" id="harga"></td>
                    <td><input type="text" class="form-control" id="jumlah"></td>
                  </tr>
                  <tr>
                    <td>Rewinder</td>
                    <td><input type="text" class="form-control" id="qtyUnit"></td>
                    <td>Hari</td>
                    <td><input type="text" class="form-control" id="harga"></td>
                    <td><input type="text" class="form-control" id="jumlah"></td>
                  </tr>
                  <tr>
                    <td>Perforasi</td>
                    <td><input type="text" class="form-control" id="qtyUnit"></td>            
                    <td>Hari</td>
                    <td><input type="text" class="form-control" id="harga"></td>
                    <td><input type="text" class="form-control" id="jumlah"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="card">
            <h4 class="card-title"><strong>C. BOP</strong></h4>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nama Biaya</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Biaya Penyusutan</td>
                    <th><input type="text" class="form-control" id="harga"></th>
                    <th><input type="text" class="form-control" id="jumlah"></th>
                  </tr>
                  <tr>
                    <td>Biaya Listrik</td>
                    <th><input type="text" class="form-control" id="harga"></th>
                    <th><input type="text" class="form-control" id="jumlah"></th>
                  </tr>
                  <tr>
                    <td>Biaya Pabrik Lain-lain</td>
                    <th><input type="text" class="form-control" id="harga"></th>
                    <th><input type="text" class="form-control" id="jumlah"></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>


        <footer class="card-footer text-right">
          <button class="btn btn-primary" type="submit">Submit</button>
        </footer>


      </form>
    </div>

      </div><!--/.main-content -->