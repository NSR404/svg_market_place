<div id="create-update-user-email-modal" class="modal fade">
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
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ translate('Email') }}</label>
                        <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ translate('Group') }}</label>
                        <select name="group_id" class="form-control">
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
