<x-ui::form :route="$route" :name="$formName" :breadcrumbs="$formBreadCrumbs" :files="true">
    <x-slot name="header">
        <style>
            .nav-link{
                color:#6c6c6c
            }
            .nav-link.active {
                color: black;
                background-color: #f9f9f9;
                font-weight: bold;
            }
            .image-input,.image-input.image-input-outline .image-input-wrapper{
                width: 100% !important;
                height: 200px !important;
            }
        </style>
    </x-slot>
    @if(!$errors->isEmpty())
        @dump($errors->all())
    @endif
    <div class="show-info card">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#highlight-tab" class="nav-link active" data-toggle="tab">{{__('Main')}}</a></li>
            <li class="nav-item"><a href="#highlight-tab1" class="nav-link" data-toggle="tab">{{__('Suggested Activity One')}}</a></li>
            <li class="nav-item"><a href="#highlight-tab2" class="nav-link" data-toggle="tab">{{__('Suggested Activity Two')}}</a></li>
        </ul>
        <div class="tab-content card-body">
            @include('dashboard.assessment.activities.partials.main-tab')
            @include('dashboard.assessment.activities.partials.suggessted-activity-one-tab')
            @include('dashboard.assessment.activities.partials.suggessted-activity-two-tab')
        </div>
    </div>
    <x-slot name="scripts">
        
        @if(is_null($model))
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
        @endif
        <script>
            $(function(){
                $('.show-info a.nav-link').on('click',function(e){
                    e.preventDefault();
                    var id = $(this).attr('href'),
                        clickedEl = $(this);
                    clickedEl.addClass('active');
                    clickedEl.parent().siblings().children().removeClass('active');
                    $(id).addClass('active');
                    $(id).siblings().removeClass('active');
                });
            })
        </script>
    </x-slot>
</x-ui::form>