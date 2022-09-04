<x-ui::form :route="$route" :name="$formName" :breadcrumbs="$formBreadCrumbs" :files="true">
    <input type="hidden" name="age_activity_id" value="{{ request()->age_activity }}"/>
    <x-ui::locale.input name="title" :label="__('Title')"/>
    <x-ui::locale.input type="textarea" name="description" :label="__('Description')"/>
    @if(is_null($model))
        <x-ui::form.select :label="__('Age Activity')" name="" id="ageActivity" :options="$ageActivities"/>
        <x-ui::form.select :label="__('Field')" id="fields" name="field_id" :options="[]"/>
    @else
        <x-ui::form.select :label="__('Field')" name="field_id" :selected="$model->field_id" :options="$fields"/>
    @endif
    <x-ui::form.input type="file" name="media" :label="__('Image Or Video (Optional)')"/>
    @if(is_null($model))
    <x-slot name="scripts">
        <script>
            $('#ageActivity').on('change',function(){
                $.ajax({
                    url: "{{ route('dashboard.assessment.activities.get_fields') }}?age-activity-id="+$(this).val(),
                    method:"GET",
                    success:function(response){
                        var html = '<option value="" disabled selected>Select Field</option>';
                        response.forEach(element => {
                            html += '<option value="'+element.id+'">'+element.name.en+'</option>'
                        });
                        $('#fields').html(html);
                    }
                });
            })
        </script>
    </x-slot>
    @endif
</x-ui::form>