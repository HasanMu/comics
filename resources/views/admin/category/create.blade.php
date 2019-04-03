    <div class="modal fade" tabindex="-1" role="dialog" id="create-category">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah data category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="post">
                @csrf
                    <input type="text" name="name" class="form-control" required placeholder="Nama category" aria-label="">
                    <center>
                        <p></p>
                        <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i> Tambah Data</button>
                    </center>
                </form>
            </div>
          </div>
        </div>
    </div>
