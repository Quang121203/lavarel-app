<div class="modal fade" id="crud-modal-size-small" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-header" class="modal-title">CHỈNH SỬA</h5>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;" id="form_add_edit" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control form-control-sm" id='id' name="id">
                                <label>Name</label>
                                <input type="text" class="form-control form-control-sm" id='name' name="name"
                                    placeholder="Name" maxlength="255" autocomplete="false">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Singer</label>
                                <input type="text" class="form-control form-control-sm" id='singer' name="singer"
                                    placeholder="Singer" maxlength="255" autocomplete="false">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Image</label>
                                <input id="image" name="image" type="file" accept="image/*"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Music</label>
                                <input id="music" name="music" type="file" accept="audio/*"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn_save" class="btn btn-success" onclick="save()">
                    <i class="fa fa-save"></i>
                    Lưu
                </button>
            </div>
        </div>
    </div>
</div>