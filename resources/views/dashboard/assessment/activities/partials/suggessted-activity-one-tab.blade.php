<div class="tab-pane" id="highlight-tab1">

    <x-ui::locale.input type="textarea" name="activity_one_description" :label="__('Activity One Description')"/>

    <div class="col-12 my-3">
        <div class="row" style="align-items: flex-end;">
            <div class="col-md-5">
                <x-ui::form.input type="url" name="activity_one_video_url" :label="__('Activity One Video Url')"/>
            </div>
            <div class="col-md-2 text-center">
                <p><b>{{__('OR')}}</b></p>
            </div>
            <div class="col-md-5">
                <x-ui::form.image name="activity_one_media" :value="$model?->getFirstMediaUrl('activity_one_media')" :label="__('Activity One Image')"/>
            </div>
        </div>
    </div>

</div>