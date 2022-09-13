<div class="tab-pane active" id="highlight-tab">
    <input type="hidden" name="age_activity_id" value="{{ request()->age_activity }}"/>
    <x-ui::locale.input name="title" :label="__('Title')"/>
    <x-ui::locale.input type="textarea" name="description" :label="__('Description')"/>
    @if(is_null($model))
        <x-ui::form.select :label="__('Age Activity')" name="" id="ageActivity" :options="$ageActivities"/>
        <x-ui::form.select :label="__('Field')" id="fields" name="field_id" :options="[]"/>
    @else
        <x-ui::form.select :label="__('Field')" name="field_id" :selected="$model->field_id" :options="$fields"/>
    @endif
    <x-ui::form.input type="url" name="video_url" :label="__('Video Url')"/>
    <br>
    <p><b>{{__('OR')}}</b></p>
    <x-ui::form.input type="file" name="media" :label="__('Image')"/>
</div>