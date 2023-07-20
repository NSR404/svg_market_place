<div id="create-update-user-group-modal" class="modal fade">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <form class="custom-form" action="" method="POST">
                <input type="hidden" name="_method">
                <div class="modal-header">
                    <h4 class="modal-title h6"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>

                <div class="modal-body text-center">
                    <div class="form-group">
                        <label class="form-label">{{ translate('Name') }}</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
