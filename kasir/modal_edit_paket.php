<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $paket['id']; ?>">
    Edit
</button>
<!-- Pembuka Modal -->
<div class="modal fade text-left" id="edit<?= $paket['id']; ?>" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Edit Paket</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="col-sm">
                        <h6>Masukkan Jenis Paket</h6>
                        <fieldset class="form-group">
                            <select class="form-select" id="basicSelect" name="jenis">
                                <option value="Kiloan">Kiloan</option>
                                <option value="Selimut">Selimut</option>
                                <option value="Bed Cover">Bed Cover</option>
                                <option value="Kaos">Kaos</option>
                                <option value="Lain">Lainnya</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" placeholder="Masukkan Nama Paket" name="nama" value="<?= $paket['nama_paket']; ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left">
                        <input type="number" class="form-control" placeholder="Masukkan Harga" name="harga" value="<?= $paket['harga']; ?>">
                        <div class="form-control-icon">
                            <i class="bi bi-key"></i>
                        </div>
                    </div>



                    <div class="modal-footer">
                        <input type="text" name="id" id="" class="visually-hidden" value="<?= $paket['id']; ?>">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" name="edit">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Penutup Modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Delete<?= $paket['id']; ?>">
    Delete
</button>
<!-- Pembuka Modal -->
<div class="modal fade text-left" id="Delete<?= $paket['id']; ?>" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Hapus Paket</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <h6>Apakah anda yakin ingin menghapus paket tersebut?</h6>
                    <div class="modal-footer">
                        <input type="text" name="id" id="" class="visually-hidden" value="<?= $paket['id']; ?>">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tidak</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" name="delete">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Ya</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Penutup Modal -->