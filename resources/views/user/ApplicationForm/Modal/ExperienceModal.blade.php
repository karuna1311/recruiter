<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-modal-label">Edit Expreience</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="attachment-body-content">
                    <div class="card mb-0">
                     
                        <form role="form" id="updateexperienceform" method="PUT" action="{{ route('experience.update',[base64_encode($data->id)]) }}" enctype="multipart/form-data">
                            @csrf  
                            @method('PUT')
                            <div class="row">
                                
                            </div>
                            <div class="row">
                              
                            </div>
                            <div class="row">
                              
                            </div>
                            <div class="row">
                                
                            </div>
                            <div class="row">                            
                              
                                
                            </div>
                            <div class="row">                               
                               
                            </div>
                            <div class="row">                          
                             
                            </div>
                            <div class="row">
                              
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="editexperiencesubmit" class="btn btn-warning">Update Experience</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                           