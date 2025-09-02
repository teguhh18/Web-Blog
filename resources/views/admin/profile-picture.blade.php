<div class="modal fade" id="modal_show" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.profile.image.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Ganti Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="image-upload" class="form-label">Pilih Foto</label>
                        <input class="form-control" type="file" name="foto" id="image-upload"
                            accept="image/*">
                    </div>
                    <div class="text-center">
                        @if ($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" class="img-fluid mb-3"
                                style="max-width: 100%; height: auto;">
                        @else
                            <img src="https://placehold.co/300x150?text=No+Image" alt="Foto Profil"
                                class="img-fluid mb-3" style="max-width: 100%; height: auto;">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-dismiss="modal"><i
                            class="fa fa-times me-1"></i>Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i
                            class="fa fa-upload me-1"></i>Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
