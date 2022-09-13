<x-ui::form :route="$route" :name="$formName" :breadcrumbs="$formBreadCrumbs" :files="true">
    {{-- <div class="show-info card">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#highlight-tab" class="nav-link active" data-toggle="tab">{{__('Main')}}</a></li>
            <li class="nav-item"><a href="#highlight-tab1" class="nav-link" data-toggle="tab1">{{__('Suggested Activity One')}}</a></li>
            <li class="nav-item"><a href="#highlight-tab2" class="nav-link" data-toggle="tab2">{{__('Suggested Activity Two')}}</a></li>
        </ul>
        <div class="tab-content card-body"> --}}
            @include('dashboard.assessment.activities.partials.main-tab')
            @include('dashboard.assessment.activities.partials.suggessted-activity-one-tab')
            @include('dashboard.assessment.activities.partials.suggessted-activity-two-tab')
        {{-- </div>
    </div> --}}
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