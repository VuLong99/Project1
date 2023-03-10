@extends('layouts.admin')
@section('content')
<section class="charts">
    <section>
        <div class="container-fluid">
            <!-- Page Header-->
            <header> 
                <h1 class="h3 display">Post category</h1>
            </header>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div  class="card-header" style="display:flex;">
                            {{-- Form delete --}}
                            <form id="delete-postcate" action="{{ route('admin.post_cate.delete') }}" method="POST" style=" display: inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="list_id" id="list_id" value="">
                                <button disabled type="submit" class="btn btn-danger btn-delete">Delete category</button>
                            </form>

                            {{-- Form search desktop --}}
                            <div class="card-body card-form" style="padding:0;">
                                <form class="form-inline" style="float: right;" method="GET" action="{{route('admin.post_cate.index')}}">
                                <div class="form-group">
                                    <label for="inlineFormInputGroup" class="sr-only">Name</label>
                                    <input id="inlineFormInputGroup" value="{{Request::get('search')}}" name="search" type="text" placeholder="Category name" class="mr-3 form-control form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Search" class="mr-3 btn btn-primary">
                                </div>
                                </form>
                            </div>

                            {{-- Button create --}}
                            <button class="btn btn-primary btn-create">Create category</button>
                        </div>

                        {{-- Form search Mobile --}}
                        <div class="card-body card-form-mob" style="padding:0;">
                            <form class="form-inline" style="float: right;" method="GET" action="{{route('admin.post_cate.index')}}">
                                <div class="form-group">
                                <label for="inlineFormInputGroup" class="sr-only">Name</label>
                                <input id="inlineFormInputGroup" value="{{Request::get('search')}}" name="search" type="text" placeholder="Category name" class="mr-3 form-control form-control">
                                </div>
                                <div class="form-group">
                                <input type="submit" value="Search" class="mr-3 btn btn-primary">
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                        <th>
                                            <input type="checkbox" name="check_all" class="check_all cursor">
                                        </th>
                                        <th>Category name</th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rows as $row)
                                        <tr>
                                        <td><input type="checkbox" name="check" class="check cursor" data-id="{{ $row->id }}"></td>
                                        <td>{{ $row->post_name}}</td>
                                        <td>
                                            <span class="edit cursor" data-id="{{ $row->id }}"  data-name="{{ $row->post_name }}" data-post_path="{{ $row->post_path }}"><i class="fa fa-edit"></i></span>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3" style="display: flex;justify-content: center;"><center>{{ $rows->withQueryString()->links() }}</center></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-postcate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">Create category</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">??</span></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-postcate" action="{{route('admin.post_cate.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id_postcate" id="id_postcate" value="">
                            <div class="form-group">
                                <label class="label">Name</label>
                                <input type="text" placeholder="Category name" name="name_postcate" id="name_postcate" class="form-control" onkeyup="ChangeToSlug();">
                                <div class="error error-postcate">Enter a category name</div>
                                <label class="label">Path</label>
                                <input type="text" placeholder="???????ng d???n" name="path_postcate" id="path_postcate" class="form-control" readonly onkeyup="ChangeToSlug();">
                                <div class="error error-postcate">Enter the category name to get the path</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-disabled btn-secondary">Close</button>
                        <button type="button" class="btn btn-disabled btn-primary" id="save">Save</button>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.part.modal-confirm')
    </section>
</section>
@endsection
@section('script')
  <script >
    //Click edit
    $('.edit').click(function(){
      let id = $(this).data('id');
      let post_name = $(this).data('name');
      let post_path = $(this).data('post_path');
      $('.modal-title').html('Update category');
      $('#id_postcate').val(id);
      $('#name_postcate').val(post_name);
      $('#path_postcate').val(post_path);
      $('#modal-postcate').modal('show');
    });
    
    //click delete
    $('.btn-delete').click(function(e){
      e.preventDefault();
      $('#modal-confirm').modal('show');
    });
    // Click confirm
    $('#confirm').click(function(){
      let list = $('input[name=check]');
      $('#confirm').prop('disabled', true);
      $('.btn-secondary').prop('disabled', true);
      $('#modal-confirm .close').prop('disabled', true);
      let list_id = [];
      $.each( list, function( key, value ) {
         if(value.checked == true)
         {
            list_id.push($(value).data('id'));
         }
      });
      $('#list_id').val(JSON.stringify(list_id));
      $('#delete-postcate').submit();
    })
    //click create
    $('.btn-create').click(function(){
      let url = $(this).data('url');
      $('#form-postcate').attr('action',url);
      $('.modal-title').html('Create category');
      $('#name_postcate').val('');
      $('#path_postcate').val('');
      $('#modal-postcate').modal('show');
    });
    $('#save').click(function(){
      if($('#name_postcate').val() == '')
      {
        $('.error-postcate').css('display','block');
        return;
      }
      $('.btn-disabled').prop('disabled', true);
      $('#form-postcate').submit();
    })
    $('#modal-postcate').on('hidden.bs.modal', function (e) {
      $('.error-postcate').css('display','none');
    })
  </script> 
  <script type="text/javascript">
		function ChangeToSlug(){
			var name_postcate;
			//L???y text t??? th??? input title
			name_postcate = document.getElementById("name_postcate").value;
			name_postcate = name_postcate.toLowerCase();
			//?????i k?? t??? c?? d???u th??nh kh??ng d???u
			name_postcate = name_postcate.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
			name_postcate = name_postcate.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
			name_postcate = name_postcate.replace(/??|??|???|??|???/gi, 'i');
			name_postcate = name_postcate.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
			name_postcate = name_postcate.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
			name_postcate = name_postcate.replace(/??|???|???|???|???/gi, 'y');
			name_postcate = name_postcate.replace(/??/gi, 'd');
			//X??a c??c k?? t??? ?????c bi???t
			name_postcate = name_postcate.replace(/\`|\~|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|\???|\???|\???|\???|\???|\???|_/gi, '');
			//?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
			name_postcate = name_postcate.replace(/ /gi, "-");
			//?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
			//Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
			name_postcate = name_postcate.replace(/\-\-\-\-\-/gi, '-');
			name_postcate = name_postcate.replace(/\-\-\-\-/gi, '-');
			name_postcate = name_postcate.replace(/\-\-\-/gi, '-');
			name_postcate = name_postcate.replace(/\-\-/gi, '-');
			//X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
			name_postcate = '@' + name_postcate + '@';
			name_postcate = name_postcate.replace(/\@-|\-@|\@/gi, '');
			document.getElementById('path_postcate').value = name_postcate;
		}
    </script>
@endsection