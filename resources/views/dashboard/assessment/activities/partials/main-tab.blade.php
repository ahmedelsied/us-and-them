<div class="tab-pane active" id="highlight-tab">
    <input type="hidden" name="age_activity_id" value="{{ request()->age_activity }}"/>
    <x-ui::locale.input name="title" :label="__('Title')"/>
    @if(is_null($model))
        <x-ui::form.select :label="__('Age Activity')" name="" id="ageActivity" :options="$ageActivities"/>
        <x-ui::form.select :label="__('Field')" id="fields" name="field_id" :options="[]"/>
    @else
        <x-ui::form.select :label="__('Field')" name="field_id" :selected="$model->field_id" :options="$fields"/>
    @endif
</div>