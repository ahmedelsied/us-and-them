
<!-- edit Age Activity Modal -->
<div class="modal fade" id="editAgeActivityModal" tabindex="-1" role="dialog" aria-labelledby="editAgeActivityLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="edit-age-activity-form" action="">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editAgeActivityLabel"><b>{{__('Edit Age Activity')}}</b></h5>
                    <button type="button" class="close text-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-ui::locale.input name="title" :label="__('Title')"/>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="edit-activity-btn" class="btn btn-primary">{{__('Save')}}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
