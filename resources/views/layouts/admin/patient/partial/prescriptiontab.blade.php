<div class="active tab-pane" id="prescriptions">
    <!-- Post -->
    <div class="post">
        @foreach($prescriptions as $prescription)
        <button class="btn btn-primary tag_cnt float-left" style="margin:1px"
            onclick="showModal('{{ json_encode($prescription) }}')" type="button"
            value="1">{{$prescription->doctorName}} - {{ $prescription->created_at->format('d-m-Y') }}</button>

        @endforeach
    </div>
    <!-- /.post -->
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-image:url('{{asset('images/prescriptionSlip.jpeg')}}'); 
    min-height: 705px;
    
    background-size: contain;
    background-repeat: repeat-y;">
            <div class=" modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9"></div>

                    <div class="col-md-3" id="doctorData" style="text-align:right; text-transform: uppercase;"></div>

                </div>
                <br><br><br><br><br>
                <div class="row">
                    <b>
                        <div class="col-md-9" id="prescription" style="text-transform: uppercase;"> </div>
                    </b>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3 text-right"><img id="sign" src="" width="100" height="75"
                            style="margin-bottom:100px;"></div>
                </div>

            </div>
        </div>
    </div>
</div>




<script>
function showModal(data) {
    console.log(data);
    var data = JSON.parse(data = data.replace(/\n/g, "<br>").replace(/\r/g, "\\r").replace(/\t/g, "\\t"));
    $("#myModal #doctorData").html(data.doctorName + '<br>' + '[' + data.doctorSpecialization + ']');
    (data.prescription != null) ? $("#myModal #prescription").html(data.prescription): '';
    $(
            "#myModal #sign")
        .attr('src', "{{ asset('storage/doctor/profile/')}}" + '/' + data.doctorSignature);
    $("#myModal").modal();
}
</script>