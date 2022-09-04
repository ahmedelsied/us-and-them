<x-ui::layout>
    <x-slot name="header">
        <link rel="stylesheet" href='{{ asset('site/toaster/toaster.css') }}'>
    </x-slot>
    <h1>{{ __('Field Details') }} - {{ $field->name }}</h1>
    <div class="container">
        <div class="row">
            <div class="col-12 my-5 text-right">
                
            <button class="btn btn-success" id="addAgeActivityBtn" data-bs-toggle="modal" data-bs-target="#addAgeActivityModal" type="button">
                {{ __('Add Age Activity') }} <i class="fa fa-plus"></i>
            </button>
    
            </div>
            <div class="col-12">
                <div id="age-activities-parent" class="row">
                    @foreach ($field->age_activities as $ageActivity)
                        <div class="col-md-12 py-4 my-3 card" data-id="{{ $ageActivity->id }}">
                            <p class="lead">{{ $ageActivity->title }}</p>
                            <i class="text-danger fa fa-trash data-action" onclick="deleteRow(this);" data-href="{{ route('dashboard.assessment.age-activities.destroy',$ageActivity->id) }}"></i>
                            <i data-bs-toggle="modal" data-id="{{ $ageActivity->id }}" data-bs-target="#editAgeActivityModal" data-title-en="{{$ageActivity->getTranslation('title', 'en')}}" data-title-ar="{{$ageActivity->getTranslation('title', 'ar')}}" data-href="{{ route('dashboard.assessment.age-activities.destroy',$ageActivity->id) }}" class="fa fa-edit text-primary data-action"></i>
                            <a href="{{ route('dashboard.assessment.age-activities.show',$ageActivity->id) }}"><i class="fa fa-eye text-success data-action"></i></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.assessment.fields.partials.add-age-activity-modal')
    @include('dashboard.assessment.fields.partials.edit-age-activity-modal')
    <x-slot name="scripts">
        @include('dashboard.assessment.fields.partials.script')
    </x-slot>
</x-ui::layout>