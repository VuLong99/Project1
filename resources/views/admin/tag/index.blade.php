@extends('layouts.admin')
@section('content')
<section class="charts">
  <section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Keyword</h1>
          </header>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header" style="display:flex;">

                  {{-- Form delete --}}
                  <form id="delete-tag" action="{{ route('admin.tag.delete') }}" method="POST" style=" display: inline;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="list_id" id="list_id" value="">
                    <button disabled type="submit" class="btn btn-danger btn-delete">Remove keyword</button>
                  </form>

                  {{-- Form search desktop --}}
                  <div class="card-body card-form" style="padding:0;">
                    <form class="form-inline" style="float: right;" method="GET" action="{{route('admin.tag.index')}}">
                      <div class="form-group">
                        <label for="inlineFormInputGroup" class="sr-only">Search</label>
                        <input id="inlineFormInputGroup" value="{{Request::get('search')}}" name="search" type="text" placeholder="Search" class="mr-3 form-control form-control">
                      </div>
                      <div class="form-group">
                        <input type="submit" value="Tìm kiếm" class="mr-3 btn btn-primary">
                      </div>
                    </form>
                  </div>
                  {{-- Form search desktop --}}
                  <button class="btn btn-primary btn-create">Create keyword</button>
                </div>

                {{-- Form search Mobile --}}
                <div class="card-body card-form-mob" >
                  <form class="form-inline" style="float: right;" method="GET" action="{{route('admin.tag.index')}}">
                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Name</label>
                      <input id="inlineFormInputGroup" value="{{Request::get('search')}}" name="search" type="text" placeholder="Name" class="mr-3 form-control form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Tìm kiếm" class="mr-3 btn btn-primary">
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
                          <th>Key</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($rows as $row)
                        <tr>
                          <td><input type="checkbox" name="check" class="check cursor" data-id="{{ $row->id }}"></td>
                          <td>{{ $row->name }}</td>
                          <td>
                            <span class="edit cursor" data-id="{{ $row->id }}"  data-name="{{ $row->name }}"><i class="fa fa-edit"></i></span>
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
    <div id="modal-tag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Create Keyword</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form id="form-tag" action="{{route('admin.tag.store')}}" method="POST">
              @csrf
              <input type="hidden" name="id_tag" id="id_tag" value="">
              <div class="form-group">
                <label>Key</label>
                <input type="text" placeholder="key" name="name_tag" id="name_tag" class="form-control">
                <div class="error error-tag">Enter keyword</div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            <button type="button" class="btn btn-primary" id="save">Save</button>
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
      let name = $(this).data('name');
      $('.modal-title').html('Update keywords');
      $('#id_tag').val(id);
      $('#name_tag').val(name);
      $('#modal-tag').modal('show');
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
      $('#delete-tag').submit();
    })
    //click create
    $('.btn-create').click(function(){
      let url = $(this).data('url');
      $('#form-tag').attr('action',url);
      $('.modal-title').html('Create keyword');
      $('#modal-tag').modal('show');
    });
    $('#save').click(function(){
      if($('#name_tag').val() == '')
      {
        $('.error-tag').css('display','block');
        return;
      }
      $('#modal-tag button').prop('disabled', true);
      // $('#modal-tag').modal({backdrop: 'static', keyboard: false}) ;
      $('#form-tag').submit();
    })
    $('#modal-tag').on('hidden.bs.modal', function (e) {
      $('.error-tag').css('display','none');
    })
    $('#name_tag').keypress(function(e){
    var ew = event.which;
    if(e.which == 32)
    {
      e.preventDefault();
    }
    if(48 <= ew && ew <= 57)
        return true;
    if(65 <= ew && ew <= 90)
        return true;
    if(97 <= ew && ew <= 122)
        return true;
    event.preventDefault();
    return;
  });

  </script> 
@endsection