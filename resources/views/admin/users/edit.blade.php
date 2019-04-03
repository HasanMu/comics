    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
          <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data" action="{{ route('users.update', ['id'=>$user->id]) }}">
              @csrf
              @method('PATCH')
              <div class="card-header">
                  <h4>Edit Profile</h4>
              </div>
              <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name" required>
                        <div class="invalid-feedback">
                            Please fill in the first name
                        </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email" required>
                        <div class="invalid-feedback">
                            Please fill in the email
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-7 col-12">
                        <label>Jenis kelamin</label>
                        <select name="gender" class="form-control">
                            @foreach ($genders as $data)
                                <option value="{{ $data->gender }}">{{ $data->gender }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please fill in the gender
                        </div>
                        </div>
                        <div class="form-group col-md-5 col-12">
                        <label>Umur</label>
                        <input type="number" required name="age" class="form-control" value="{{ $user->age }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar" name="avatar" multiple>
                                <label class="custom-file-label" for="customFile">Pilih Foto Dan Lihat Ke Sebelah Umur</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                        <label>Alamat</label>
                        <textarea name="address" class="form-control">{{ $user->address }}</textarea>
                        </div>
                        <div class="form-group col-12">
                        <label>Bio</label>
                        <textarea name="bio" class="form-control summernote-simple">{{ $user->bio }}</textarea>
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
