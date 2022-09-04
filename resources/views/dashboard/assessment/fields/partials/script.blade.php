
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="{{ asset('site/toaster/toaster.min.js') }}"></script>
        <script>
            var ageActivities = $('#age-activities-parent'),
                addAgeActivityModal = $('#addAgeActivityModal'),
                ageActivitiesIds = [];


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

            $('#add-age-activity-form').on('submit',function(e){
                e.preventDefault();

                var url = $(this).attr('action'),
                    titleEn = $(this).find('input[name="title[en]"]'),
                    titleAr = $(this).find('input[name="title[ar]"]'),
                    submitBtn = $(this).find('#add-activity-btn');
                    
                submitBtn.attr('disabled',true);

                $.ajax({
                    url:url,
                    method:"POST",
                    data : {
                        title:{
                            en: titleEn.val(),
                            ar: titleAr.val()
                        },
                        field_id: "{{ $field->id }}"
                    },
                    success: function(response){
                        data = response.data;
                        toastr.success("{{__('Age activity added successfully')}}");
                        submitBtn.attr('disabled',false);
                        titleEn.val('');
                        titleAr.val('');
                        var html = '<div class="col-md-12 py-4 my-3 card" data-id="'+data['id']+'">';
                            html += '<p class="lead">'+data['title']['{{ app()->getLocale() }}']+'</p>';
                            html += '<i class="text-danger fa fa-trash data-action" onclick="deleteRow(this);" data-href="'+ data['deleteUrl'] +'"></i>';
                            html += '<i data-bs-toggle="modal" data-id="'+data['id']+'" data-bs-target="#editAgeActivityModal" data-title-en="'+data['title']['en']+'" data-title-ar="'+data['title']['ar']+'" data-href="'+data['editUrl']+'" class="fa fa-edit text-primary data-action"></i>';
                            
                            html += '<a href="'+data['showUrl']+'"><i class="fa fa-eye text-success data-action"></i></a></div>'
                        $('#age-activities-parent').append(html);
                        addAgeActivityModal.modal('hide');
                    },
                    error:function(){
                        toastr.error("{{__('Something is wrong')}}");
                        submitBtn.attr('disabled',false);
                    }
                })
            });

            

            function reflectChanges(){
                ageActivitiesIds =[];
                ageActivities.children().each(function(index,el){
                    ageActivitiesIds.push(el.dataset['id']);
                });

                saveChanges();
            }

            ageActivities.sortable({
                helper:'clone',
                forceHelperSize: true,
                toArray:true,
                stop: function( event, ui ) {
                    reflectChanges();
                }
            });

            function saveChanges(){
                $.ajax({
                    url: "{{ route('dashboard.assessment.age-activities.save_sorting') }}",
                    method: "PUT",
                    data: {
                        ageActivitiesIds: ageActivitiesIds,
                        field_id: "{{$field->id}}"
                    },
                    success: function(){
                        toastr.success("{{__('Changes saved successfully')}}");
                    },
                    error: function(){
                        toastr.error("{{__('Something is wrong')}}");
                    }
                })
            }

            $('#edit-age-activity-form').on('submit',function(e){
                e.preventDefault();

                var url = $(this).attr('action'),
                    titleEn = $(this).find('input[name="title[en]"]'),
                    titleAr = $(this).find('input[name="title[ar]"]'),
                    submitBtn = $(this).find('#edit-activity-btn');
                    
                submitBtn.attr('disabled',true);

                $.ajax({
                    url:url,
                    method:"PUT",
                    data : {
                        title:{
                            en: titleEn.val(),
                            ar: titleAr.val()
                        },
                        field_id: "{{ $field->id }}"
                    },
                    success: function(response){
                        var data = response.data;
                        toastr.success("{{__('Changes saved successfully')}}");
                        submitBtn.attr('disabled',false);
                        var itemParent = $('div[data-id="'+data.id+'"]');
                        itemParent.find('p').text(data.title['{{ app()->getLocale() }}'])
                        itemParent.find('.text-primary').attr('data-title-en',data.title.en).attr('data-title-ar',data.title.ar);
                        $('#editAgeActivityModal').modal('hide');
                    },
                    error:function(){
                        toastr.error("{{__('Something is wrong')}}");
                        submitBtn.attr('disabled',false);
                    }
                })
            });
        
            $('#editAgeActivityModal').on('show.bs.modal', function(e) {

                $(this).find('#edit-age-activity-form').attr('action',$(e.relatedTarget).data('href'));
                $(this).find('input[name="title[en]"]').val($(e.relatedTarget).attr('data-title-en'));
                $(this).find('input[name="title[ar]"]').val($(e.relatedTarget).attr('data-title-ar'));

            });
        </script>