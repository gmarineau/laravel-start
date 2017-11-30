<div class="form-group">
  {!! Form::label($type, $label, ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">

    <div id="{{ $type }}-dropzone">
      <div id="{{ $type }}-actions" class="row">

        <div class="col-sm-12">
          <!-- The fileinput-button span is used to style the file input field as button -->
          <span class="btn btn-success {{ $type }}-fileinput-button dz-clickable">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add Files</span>
          </span>
          <button class="btn btn-primary start" type="submit" style="visibility:hidden;">
            <i class="glyphicon glyphicon-upload"></i>
            <span>Upload</span>
          </button>
          <button class="btn btn-warning cancel" type="reset" style="visibility:hidden;">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span>Cancel upload</span>
          </button>
        </div>

        <div class="col-sm-12">
          <!-- The global file processing state -->
          <span class="fileupload-process">
            <div aria-valuenow="0" aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress progress-striped total-progress active hidden" id="{{ $type }}-total-progress">
              <div data-dz-uploadprogress="" style="width:0%;" class="progress-bar progress-bar-success"></div>
            </div>
          </span>
        </div>

      </div>

      <div class="table previews {{ $type }}-previews todo-list" class="files">
        @foreach($files as $file)
          <div id="media_id_{{ $file->id }}" class="col-xs-12 file-row dz-image-preview dz-processing dz-success" data-id="{{ $file->id }}">
            <div class="row">
              <span>
                {{ $file->title }}
              </span>
              <span class="pull-right buttons">
                <a href="{!! route('file.delete', [$model_name, $model->id, $file->id]) !!}" data-dz-remove class="btn btn-danger btn-sm delete" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>&nbsp;&nbsp;&nbsp;&nbsp; Delete">
                  <i class="glyphicon glyphicon-trash"></i>&nbsp;
                  <span>Delete</span>
                </a>
              </span>
            </div>
          </div>
        @endforeach
      </div>

      <div class="row">
        <div class="table table-striped" class="files" id="previews-dropzone">

          <div id="{{ $type }}-template" class="col-xs-12 file-row">
            <!-- This is used as the file preview template -->
            <div class="row">

              <div class="col-xs-12 nopadding">
                <span data-dz-name></span>
                <strong class="error text-danger" data-dz-errormessage></strong>
                <span class="pull-right buttons">
                  <button class="btn btn-primary btn-sm start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Upload</span>
                  </button>
                  <button data-dz-remove class="btn btn-warning btn-sm cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                  </button>
                  <a href="" class="btn btn-danger btn-sm delete" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>&nbsp;&nbsp;&nbsp;&nbsp; Delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                  </a>
                </span>
              </div>

              <div class="col-xs-12 nopadding progress-container">
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</div>

@section('js')

  @parent

  <script>
   (function () {
     var scope = "{{ $type }}";

     // Get the template HTML and remove it from the document template HTML and remove it from the document
     var previewNode = document.querySelector("#"+ scope +"-template");
     previewNode.id = "";
     var previewTemplate = previewNode.parentNode.innerHTML;
     previewNode.parentNode.removeChild(previewNode);

     var weight = 0;
     var dropzone = [];
     dropzone[scope] = new Dropzone("#"+ scope +"-dropzone", {
       url: "/file/upload/{{ $model_name }}/{{ $model->id }}/"+ scope,
       thumbnailWidth: 80,
       thumbnailHeight: 80,
       parallelUploads: 1,
       previewTemplate: previewTemplate,
       // Make sure the files aren't queued until manually added
       autoQueue: true,
       // Define the container to display the previews
       previewsContainer: "."+ scope +"-previews",
       // Define the element that should be used as click trigger to select files.
       clickable: "."+ scope +"-fileinput-button",
       success: function (file, response) {
         file.previewElement.querySelector(".delete").href = "/file/delete/{{ $model_name }}/{{ $model->id }}/"+ response.id;
         file.previewElement.setAttribute('id', 'media_id_' + response.id);
         file.previewElement.setAttribute('data-id', response.id);
         file.previewElement.classList.add("dz-success");
         file.previewElement.querySelector(".delete").addEventListener("click", function (e) {
           e.preventDefault();
           e.stopPropagation();

           var url = this.href;

           var button = $(e.target)
           button.button('loading')

           return $.ajax({
             method: 'POST',
             url: url,
             headers: {
               'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
             },
             success: function (data, status) {
               if (file !== null) {
                 dropzone[scope].removeFile(file);
               }
             }
           });
         });
       },
     });

     dropzone[scope].on("addedfile", function(file) {
       // Hookup the start button
       file.previewElement.querySelector(".start").onclick = function() { dropzone[scope].enqueueFile(file); };
     });

     // Update the total progress bar
     dropzone[scope].on("totaluploadprogress", function(progress) {
       document.querySelector("#"+ scope +"-total-progress .progress-bar").style.width = progress + "%";
     });

     dropzone[scope].on("sending", function(file, xhr) {
       xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
       // Show the total progress bar when upload starts
       document.querySelector("#"+ scope +"-total-progress").style.opacity = "1";
       // And disable the start button
       file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
     });

     // Hide the total progress bar when nothing's uploading anymore
     dropzone[scope].on("queuecomplete", function(progress) {
       document.querySelector("#"+ scope +"-total-progress").style.opacity = "0";
     });

     // Setup the buttons for all transfers
     // The "add files" button doesn't need to be setup because the config
     // `clickable` has already been specified.
     document.querySelector("#"+ scope +"-actions .start").onclick = function() {
       dropzone[scope].enqueueFiles(dropzone[scope].getFilesWithStatus(Dropzone.ADDED));
     };
     document.querySelector("#"+ scope +"-actions .cancel").onclick = function() {
       dropzone[scope].removeAllFiles(true);
     };

     $(".{{ $type }}-previews .delete").each(function(index) {
       $(this).on("click", function(e) {
         e.preventDefault();

         var url = $(this).attr('href');
         var file = $(this).closest('.file-row');

         var button = $(e.target)
         button.button('loading')

         $.ajax({
           method: 'POST',
           url: url,
           headers: {
             'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
           },
           success: function (data, status) {
             file.remove();
           }
         });
       });
     });

     function throttle(f, delay){
       var timer = null;
       return function(){
         var context = this, args = arguments;
         clearTimeout(timer);
         timer = window.setTimeout(function(){
           f.apply(context, args);
         },
                                   delay || 500);
       };
     }

     $(document).ready(function() {

       $(document).on('blur', "#"+ scope +"-dropzone .alt, #"+ scope +"-dropzone .title", function() {
         var text = $(this).val();
         var id = $(this).closest('.file-row').data('id');
         var type = $(this).data('type');

         $.ajax({
           method: 'POST',
           url: "/admin/ajax/dropzone-update-meta/{{ $model_name }}/{{ $model->id }}/"+ scope,
           data: {
             text: text,
             id: id,
             type: type,
           },
           headers: {
             'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
           },
         });
       });


       $('.todo-list').mousedown(function(){
         document.activeElement.blur();
       });

     }); // END DOCUMENT READY

   })();

  </script>

@stop
