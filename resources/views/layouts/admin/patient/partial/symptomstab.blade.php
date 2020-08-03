<div class="tab-pane" id="symptoms">
    <!-- Post -->
    <div class="post">
        <form action="{{route('admin.patient.new.symptoms')}}" role="form" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="col-md-12">
                <div class="form-group">
                    <label>Symptoms</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Information Here" name="symptoms"
                        required></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Comments</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                        name="comments"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="customFile">Upload Report-1</label>
                        <div class="custom-file">
                            <input id="uploadreport1" type="file"
                                class="custom-file-input  @error('uploadreport1') is-invalid @enderror" id="customFile1"
                                name="uploadreport1">
                            <label class="custom-file-label" for="customFile1">Choose file</label>
                            @error('uploadreport1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="customFile">Upload Report-2</label>
                        <div class="custom-file">
                            <input id="uploadreport2" type="file"
                                class="custom-file-input  @error('uploadreport2') is-invalid @enderror" id="customFile2"
                                name="uploadreport2">
                            <label class="custom-file-label" for="customFile2">Choose file</label>
                            @error('uploadreport2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="customFile">Upload Report-3</label>
                        <div class="custom-file">
                            <input id="uploadreport3" type="file"
                                class="custom-file-input  @error('uploadreport3') is-invalid @enderror" id="customFile3"
                                name="uploadreport3">
                            <label class="custom-file-label" for="customFile3">Choose file</label>
                            @error('uploadreport3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="customFile">Upload Report-4</label>
                        <div class="custom-file">
                            <input id="uploadreport4" type="file"
                                class="custom-file-input  @error('uploadreport4') is-invalid @enderror" id="customFile4"
                                name="uploadreport4">
                            <label class="custom-file-label" for="customFile4">Choose file</label>
                            @error('uploadreport4')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <button class="btn btn-block btn-primary send_btn">
        SAVE &nbsp;
    </button>
    <!-- /.post -->
    <div class="card-footer">

    </div>
    <!-- Post -->
    <div class="post clearfix">
    </div>
    <!-- /.post -->
</div>
<!-- /.tab-pane -->