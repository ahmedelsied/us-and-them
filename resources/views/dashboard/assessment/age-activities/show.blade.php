<x-ui::layout>
    <x-slot name="header">
        <link rel="stylesheet" href='{{ asset('site/toaster/toaster.css') }}'>
    </x-slot>
    <h1>{{ __('Age Activity Details') }} - {{ $ageActivity->title }}</h1>
    <div class="container">
        <div class="row">
            <div class="col-12 my-5 text-right">
                
            <a class="btn btn-success" href="{{ route('dashboard.assessment.activities.create') }}?age_activity={{$ageActivity->id}}">
                {{ __('Add Activity') }} <i class="fa fa-plus"></i>
            </a>
    
            </div>
            <div class="col-12">
                <div id="activities-parent" class="row">
                    @foreach ($activities as $activity)
                        <div class="col-md-12 py-4 my-3 card" data-id="{{ $activity->id }}">
                            <h2 class="w-bold handle-width">{{ $activity->title }}</h2>
                            <p class="lead handle-width">{{ $activity->description }}</p>
                            <div class="actions">
                                <i class="text-danger fa fa-trash data-action" onclick="deleteRow(this);" data-href="{{ route('dashboard.assessment.age-activities.destroy',$activity->id) }}"></i>
                                <i data-bs-toggle="modal" data-id="{{ $activity->id }}" data-bs-target="#editAgeActivityModal" data-title-en="{{$activity->getTranslation('title', 'en')}}" data-title-ar="{{$activity->getTranslation('title', 'ar')}}" data-href="{{ route('dashboard.assessment.age-activities.destroy',$activity->id) }}" class="fa fa-edit text-primary data-action"></i>
                                <a href="{{ route('dashboard.assessment.age-activities.show',$activity->id) }}"><i class="fa fa-eye text-success data-action"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="{{ asset('site/toaster/toaster.min.js') }}"></script>

        <script>
            var activityParent = $('#activities-parent');

            function deleteRow(e){
                var cnfrm = confirm("Are you sure?");;
                if(!cnfrm) return;
                var el = $(e);
                $.ajax({
                    url:el.data('href'),
                    method:"DELETE",
                    success:function(){
                        el.parent().remove();
                        toastr.success("{{__('Age activity deleted successfully')}}");
                    }
                });
            }

            function reflectChanges(){
                activitiesIds =[];
                activityParent.children().each(function(index,el){
                    activitiesIds.push(el.dataset['id']);
                });
                saveChanges();
            }

            function saveChanges(){
                $.ajax({
                    url: "{{ route('dashboard.assessment.activities.save_sorting') }}",
                    method: "PUT",
                    data: {
                        activitiesIds: activitiesIds,
                    },
                    success: function(){
                        toastr.success("{{__('Changes saved successfully')}}");
                    },
                    error: function(){
                        toastr.error("{{__('Something is wrong')}}");
                    }
                })
            }

            activityParent.sortable({
                helper:'clone',
                forceHelperSize: true,
                toArray:true,
                stop: function( event, ui ) {
                    reflectChanges();
                }
            });
        </script>
    </x-slot>
</x-ui::layout>