
<!-- Add Age Activity Modal -->
<div class="modal fade" id="addAgeActivityModal" tabindex="-1" role="dialog" aria-labelledby="addAgeActivityLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="add-age-activity-form" action="{{ route('dashboard.assessment.age-activities.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAgeActivityLabel"><b>{{__('New Age Activity')}}</b></h5>
                    <button type="button" class="close text-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="book_id" value="{{ $field->id }}">
                    <x-ui::locale.input name="title" :label="__('Title')"/>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="add-activity-btn" class="btn btn-primary">{{__('Save')}}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
