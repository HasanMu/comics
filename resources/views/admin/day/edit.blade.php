    <div class="modal fade" tabindex="-1" role="dialog" id="edit-day">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit data day</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('days.update', 'data') }}" method="post">
                @csrf
                @method('PUT')
                    <input type="hidden" name="id" id="id">
                    <input type="text" name="name" class="form-control" required placeholder="Nama genre" id="name" value="">
                    <center>
                        <p></p>
                        <button class="btn btn-success" type="submit"><i class="fas fa-edit"></i> Edit Data</button>
                    </center>
                </form>
            </div>
          </div>
        </div>
    </div>
