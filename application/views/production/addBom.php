      
    <!-- Main container -->

    <main>
      <div class="main-content">

        <div class="card">
          <h4 class="card-title"><strong>Samples</strong></h4>

          <form data-provide="validation" data-disable="false">
            <div class="card-body">

              <div class="form-group row">
                <label class="col-4 col-lg-2 col-form-label require" for="input-1">Kode Produksi</label>
                <div class="col-8 col-lg-10">
                  <input type="text" class="form-control" id="input-1" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-4 col-lg-2 col-form-label require" for="input-1">Jenis Produksi</label>
                <div class="col-8 col-lg-10">
                  <input type="text" class="form-control" id="input-1" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="card">
                <h4 class="card-title"><strong>Bahan Utama</strong></h4>

                <div class="card-body">

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Jenis Bahan</th>
                        <th>Nama Bahan</th>
                        <th>Satuan</th>
                        <th>ggjgj</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>                  
                        <div class="btn-toolbar">
                          <div class="btn-group btn-group">
                            <button class="add-row" value="Add Row" title="Add new" data-provide="tooltip"><i class="ion-plus-round"></i></button>
                          </div>
                        </div>
                      </td>
                      <td><input type="text" class="form-control" id="namaBahan"></td>
                    </tr>
                      <tr>
                        <td><input type='checkbox' name='record'></td>
                        <td>namaBahan</td>
                      </tr>
                      <tr>
                        <td><input type='checkbox' name='record'></td>
                        <td>namaBahan</td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div>
              <button type="button" class="delete-row">Delete Row</button>

            </div>


            <footer class="card-footer text-right">
              <button class="btn btn-primary" type="submit">Submit</button>
            </footer>


          </form>
        </div>

      </div>
      <!--/.main-content -->

      <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
          $(".add-row").click(function(){
            var namaBahan = $("#namaBahan").val();

            var markup = "<tr></td><td>"+namaBahan+"</td></tr>";
            $("table tbody").append(markup);
          });

        // Find and remove selected table rows
        $(".delete-row").click(function(){
          $("table tbody").find('input[name="record"]').each(function(){
            if($(this).is(":checked")){
              $(this).parents("tr").remove();
            }
          });
        });
      });    
    </script> 
