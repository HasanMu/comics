    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name" required>
                        <div class="invalid-feedback">
                            Please fill in the first name
                        </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="email" required>
                        <div class="invalid-feedback">
                            Please fill in the email
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <div class="form-group col-12">
                                <div class="text-left">
                                    <button class="btn btn-success" href="{{ route('users.index') }}" role="button">Simpan perubahan</button>

                                    <a class="btn btn-secondary" href="{{ route('users.index') }}" role="button">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
