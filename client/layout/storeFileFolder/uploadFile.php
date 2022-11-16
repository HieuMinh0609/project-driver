

<?php 
		include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/db.php");
		include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/controls.php");
		include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/auth.php");
        include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/service/store_file_folder_service.php");
        include_once ($_SERVER["DOCUMENT_ROOT"] ."/project-driver/lib/upload.php");

?>

<?php 
   
   
    if(isset($_FILES['files'])) {
        session_start();
        $user_id = $_SESSION["id"];
     
        $parent_id= null;

        if(isset($_GET['parent_id'])) {
            $parent_id = $_GET['parent_id'];
        }

    return json_encode(uploadFiles($_FILES['files'], $parent_id, $user_id));
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../template/upload_file.css"></link>
</head>

<style>

    #drag_drop {
        background-color : #f9f9f9;
        border : #ccc 4px dashed;
        line-height : 250px;
        padding : 12px;
        font-size : 24px;
        text-align : center;
    }

</style>

<body>
 


    <div class="pt-5">
        <div class="container" >
            <div class="center">

                <!-- Modal -->
                <div class="modal fade " id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="uploadFile " aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="container">
 
                            <div class="card">
                                <div class="card-header">Tải file</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">&nbsp;</div>
                                        <div class="col-md-6">
                                            <div id="drag_drop">Kéo và thả file ở đây</div>
                                        </div>
                                        <div class="col-md-3">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="progress" id="progress_bar" style="display:none; height:50px;">
                            <div class="progress-bar bg-success" id="progress_bar_process" role="progressbar" style="width:0%; height:50px;">0%

                                </div>
                            </div>
                            <div id="uploaded_image" class="row mt-5"></div>
                    </div>
                
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
 
                    </div>
                    </div>
                </div>
                </div>
                
            </div>      
        </div>
         
    </div>
 

<script type="text/javascript">
    function _(element) {
    return document.getElementById(element);
}

_('drag_drop').ondragover = function(event) {
    this.style.borderColor = '#333';
    return false;
}

_('drag_drop').ondragleave = function(event) {
    this.style.borderColor = '#ccc';
    return false;
}


_('drag_drop').ondrop = function(event) {
    event.preventDefault();

    var form_data  = new FormData();

    var image_number = 1;

    var error = '';

    var drop_files = event.dataTransfer.files;

    for(var count = 0; count < drop_files.length; count++) {

        form_data.append("files[]", drop_files[count]);
        image_number++;
    }

    if(error != '') {
        _('uploaded_image').innerHTML = error;
        _('drag_drop').style.borderColor = '#ccc';
    }
    else {



        _('progress_bar').style.display = 'block';

        var ajax_request = new XMLHttpRequest();

        let id = getUrlParameter("id");

        ajax_request.open("post", "storeFileFolder/upload_file.php?parent_id="+id);

        ajax_request.upload.addEventListener('progress', function(event){

            var percent_completed = Math.round((event.loaded / event.total) * 100);

            _('progress_bar_process').style.width = percent_completed + '%';

            _('progress_bar_process').innerHTML = percent_completed + '% completed';

        });

        ajax_request.onreadystatechange = function() {
            if (ajax_request.readyState == XMLHttpRequest.DONE) {
                _('uploaded_image').innerHTML = '<div class="alert alert-info" style=" width: 100%; ">'+this.responseText.trim()+'</div>';
            } else {
                _('uploaded_image').innerHTML = '<div class="alert alert-danger" style=" width: 100%; ">File upload thất bại </div>';
                _('drag_drop').style.borderColor = '#ccc';
            }
        }

   
      
        form_data.append("id", 123);
        console.log(form_data);
        ajax_request.send(form_data);
    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return "";
    }
}
</script>

</body>
</html>