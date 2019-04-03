<div class="modal fade" tabindex="-1" role="dialog" id="delete-user">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus data user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('users.destroy', 'data') }}" method="post">
            @csrf
            @method('DELETE')
                <input type="hidden" name="id" id="id">
                <input type="text" name="name" class="form-control" disabled readonly placeholder="Nama user" id="name" value="">
                <p></p>

                <center>
                    <b><label>Apakah kamu yakin akan menghapus data diatas secara permanen?</label></b>
                    <p></p>
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i> Ya, Hapus Data</button>
                    <a class="btn btn-secondary" data-dismiss="modal" role="button"><i class="fas fa-arrow-left"></i> Tidak, Kembali</a>
                </center>
            </form>
        </div>
      </div>
    </div>
</div>
