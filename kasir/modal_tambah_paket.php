<button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#default">
    Tambah Paket
</button>
<!-- Pembuka Modal -->
<div class="modal fade text-left" id="default" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Tambah Paket</h5>
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
                        <input type="text" class="form-control" placeholder="Masukkan Nama Paket" name="nama">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left">
                        <input type="number" class="form-control" placeholder="Masukkan Harga" name="harga">
                        <div class="form-control-icon">
                            <i class="bi bi-key"></i>
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal" name="tambah">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tambah</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Penutup Modal -->