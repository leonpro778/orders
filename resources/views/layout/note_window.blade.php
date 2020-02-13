<div class="modal fade" tabindex="-1" role="dialog" id="noteWindow">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('note_window.window_title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-10">
                        <input type="text" class="form-control" id="noteText" name="noteText" />
                        <input type="hidden" id="idOrder" value="0" />
                    </div>
                    <div class="col-2"><button class="btn btn-primary" onclick="addNote()"><i class="fas fa-plus"></i> {{ __('note_window.window_add_note_button') }}</button></div>
                </div>

                <hr />

                <div id="note_container">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('note_window.window_close') }}</button>
            </div>
        </div>
      </div>
</div>
