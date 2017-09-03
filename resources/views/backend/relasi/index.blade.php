@extends('layouts.backendrelasi')

@section('pageTitle')
Foto Relasi "{{$foto->nama}}"
@endsection
@section('xtitle')
<a data-toggle="modal" href="#modal-edit" onclick="prepareAdd()"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add Data</button></a>
<div id="loadingTable" class="text-center">
    <img src="{{ asset('assets/image/loading.gif') }}">
</div>
@endsection
@section('content')
<div class="table-responsive displayNone">       
    <table class="table table-striped table-bordered" id="data-table" style="width:100%">
        <thead>
            <tr>
            	<th>ID</th>
                <th>Nama Child</th>
                <th>Derajat</th>
                <th>Foto</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
            	<th>ID</th>
                <th>Nama Child</th>
                <th>Derajat</th>
                <th>Foto</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">FORM DATA</h4>
            </div>
            <div class="modal-body">
            <div class="row">
                <form action="" method="POST" class="form-horizontal" role="form" id="form-data" enctype="multipart/form-data">
                <input type='hidden' id='id' name="id">
                <input type='hidden' id='nama_child' name="nama_child">
                <input type='hidden' id='id_child' name="id_child">
                <input type='hidden' id='_method' value="POST" name="_method">
                <input type='hidden' id='_token' value="{{csrf_token()}}" name="_token">
                    <!-- <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">
                            Nama
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" placeholder="Nama" class="form-control" name="nama" id="nama" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">
                            Foto
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="file" placeholder="Foto" class="form-control" name="path" id="path" value="">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">
                            Child
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select type="file" placeholder="parent" class="form-control" name="fotochild" id="fotochild" value="" onchange="showDiv(this)">
                                <!-- <option value="--">--</option> -->
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="" id="divDerajat">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">
                            Derajat Kemiringan
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" placeholder="Derajat Kemiringan" class="form-control" name="derajat" id="derajat" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <input type="reset" value="Reset" class="btn btn-default hidden" id="reset">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Close</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="modal-footer hidden">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
<script type="text/javascript">

	function prepareAdd(){
		$('#reset').click();
        document.getElementById("id").value='';
        // document.getElementById("relasi_id").value='';
        document.getElementById("nama_child").value='';
        document.getElementById("id_child").value='';
        $('#fotochild').empty();
        $('#fotochild').append('<option value="--">--</option>');
        $.ajax({
            type: "GET",
            url: "{{ url('backend/kategori-informasi/informasi/child') }}/"+{{$idFoto}}+"/all",
            dataType: "json",
            success: function (data) {
                $('#fotochild').empty();
                $('#fotochild').append('<option value="--">--</option>');
                var obj = data;
                for(loop = 0; loop < obj.data.length; loop++){
                    var a = obj.data[loop];
                    $('#fotochild').append('<option value="'+a.id+'">'+a.nama+'</option>');   
                }
            }
        });
    }
</script>
<script type="text/javascript">
    function showDiv(elem){
       if(elem.value == "--"){
            document.getElementById('derajat').value = "";
            document.getElementById("nama_child").value='';
       }
       else{
            var e = document.getElementById("fotochild");
            var nama_child = e.options[e.selectedIndex].text;
            document.getElementById("nama_child").value = nama_child;
            //console.log(nama_parent);
       }
    }
</script>
<script type="text/javascript">
    $.fn.modal.Constructor.prototype.enforceFocus = function () {};
</script>
@endsection

@section('id')
'id'
@endsection

@section('orderbycustom')
order: [
    [ 0, "desc" ]
],
@endsection

@section('redirect')
"{{ url('#') }}"
@endsection

@section('storeurl')
"{{ url('backend/kategori-informasi/informasi') }}/"+{{$id1}}+"/foto/"+"{{$id2}}"+"/relasi/"+{{$idFoto}}+"/create"
@endsection

@section('updateurl')
"{{ url('backend/kategori-informasi/informasi') }}/"+{{$id1}}+"/foto/"+"{{$id2}}"+"/relasi/"+{{$idFoto}}+"/detail/"+id
@endsection

@section('deleteurl')
"{{ url('backend/kategori-informasi/informasi') }}/"+{{$id1}}+"/foto/"+"{{$id2}}"+"/relasi/"+{{$idFoto}}+"/delete/"+id
@endsection

@section('dataurl')
{
   "url": "{{ url('backend/kategori-informasi/informasi') }}/"+{{$id1}}+"/foto/"+"{{$id2}}"+"/relasi/"+{{$idFoto}}+"/data",
   "type": "POST",
   "data":{
         "_token": "{{ csrf_token() }}"
    },
}
@endsection

@section('serverside')
true
@endsection

@section('prepareediturl')
"{{ url('backend/kategori-informasi/informasi') }}/"+{{$id1}}+"/foto/"+"{{$id2}}"+"/relasi/"+{{$idFoto}}+"/detail/"+id
@endsection

@section('leftcolumsfeeze')
1	
@endsection

@section('searchable')
{ searchable: false, targets: [0] }
@endsection