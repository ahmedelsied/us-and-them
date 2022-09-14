<div class="tab-pane" id="highlight-tab2">

    <x-ui::locale.input type="textarea" name="activity_two_description" :label="__('Activity Two Description')"/>
    <div class="col-12 my-3">
        <div class="row" style="align-items: flex-end;">
            <div class="col-md-5">
                <x-ui::form.input type="url" name="activity_two_video_url" :label="__('Activity Two Video Url')"/>
            </div>
            <div class="col-md-2 text-center">
                <p><b>{{__('OR')}}</b></p>
            </div>
            <div class="col-md-5">
                <x-ui::form.image name="activity_two_media" :value="$model?->getFirstMediaUrl('activity_two_media')" :label="__('Activity Two Image')"/>
            </div>
        </div>
    </div>
</div>