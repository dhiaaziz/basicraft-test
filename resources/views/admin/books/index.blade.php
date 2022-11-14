@extends('admin.layouts.master')
@section('dashboard_title', 'Books')

@section('content')
<div class="card">
  <div class="card-header">
    <div class="d-flex justify-content-between">
      <h3 class="card-title">Data Books</h3>
      <div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#m-tambah">Input New Books</button>
      </div>
    </div>

  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="datatable" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>No</th>
        <th>Title</th>
        <th>Author</th>
        <th>ISBN</th>
        <th>Published</th>
        <th>Is Active</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(item, index) in data">
        <td scope="row">@{{ index+1 }}</td>
        <td>@{{item.title}}</td>
        <td>@{{item.author}}</td>
        <td>@{{item.isbn}}</td>
        <td>@{{item.published}}</td>
        <td>@{{item.is_active}}</td>
        {{-- <td>
          @{{item.id_book}}
        </td> --}}
        <td>
          <a href="#" class="btn btn-primary btn-xs">Edit</a>
          <a @click="deleteData(item)" class="btn btn-danger btn-xs">Delete</a>
      </tr>
      </tbody>
      {{-- <tfoot>
      <tr>
        <th>Rendering engine</th>
        <th>Browser</th>
        <th>Platform(s)</th>
        <th>Engine version</th>
        <th>CSS grade</th>
      </tr>
      </tfoot> --}}
    </table>
  </div>
  <!-- /.card-body -->

  <div class="modal fade" id="m-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
            {{-- <p>@{{form_tambah}}</p> --}}
              <h5 class="modal-title" id="exampleModalCenterTitle">Input Books</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body row">
              <div class="form-group col-sm-12">
                  <label class="col-sm-4 col-form-label">Title</label>
                  <input v-model="form_tambah.title" type="text" class="form-control" required>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-4 col-form-label">Author</label>
                <input v-model="form_tambah.author" type="text" class="form-control" required>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-4 col-form-label">ISBN</label>
                <input v-model="form_tambah.isbn" type="text" class="form-control" required>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-4 col-form-label">Published</label>
                <input v-model="form_tambah.published" disabled  type="number" class="form-control" required>
              </div>
              <div class="form-group col-sm-12">
                {{-- <label class="col-sm-4 col-form-label">Is Active</label> --}}
                <input type="radio" id="html" name="is_active" v-model="form_tambah.is_active" value="active">
                <label for="html">active</label><br>
                <input type="radio" id="html" name="is_active" v-model="form_tambah.is_active" value="inactive">
                <label for="html">inactive</label><br>
              </div>
           
              
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" data-dismiss="modal" @click="submitAdd">Save Kategori</button>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  var vue = new Vue({
    el: '#app',
    data() {
      return {
          data:{},
          form_tambah:{
            published: 1
          },
          form_edit:{},
      };
    },
    mounted() {
      this.loadDataTable();
    },
    methods: {
      async getData(){
        
        // this.loadDataTable();
      },
      async loadDataTable(){
        $('#datatable').DataTable().destroy();
        let response = await axios.get('/books/fetch')
        this.data = response.data.data;
        setTimeout(function(){
          $('#datatable').DataTable({
          // "paging": true,
          // "lengthChange": false,
          // "searching": false,
          // "ordering": true,
          // "info": true,
          // "autoWidth": false,
          // "responsive": true,
          "order": [[ 0, "asc" ]]
        });
        }, 1000);
      },
      async deleteData(item){
        const confirmation = window.confirm('Are you sure you want to delete this item?');
        if(confirmation){
          let response = await axios.delete('/books/'+item.id_book+'/destroy')
          this.loadDataTable();
        }
     
      },
      submitAdd(){
        if(this.form_tambah.title && this.form_tambah.author && this.form_tambah.isbn && this.form_tambah.published && this.form_tambah.is_active){

            let formData = new FormData();
            formData.append('title', this.form_tambah.title);
            formData.append('author', this.form_tambah.author);
            formData.append('isbn', this.form_tambah.isbn);
            formData.append('published', this.form_tambah.published);
            formData.append('is_active', this.form_tambah.is_active);

            // SlickLoader.enable();
            axios.post('/books/store', formData)
            .then(r => {
                toastr.success("Success");
                this.loadDataTable();
            });
        }else{
            toastr.error('Salah satu tidak boleh kosong!');
        }
      },
      // tambahData(){
      //   axios.post('/api/', this.form_tambah).then((response) => {
      //     this.getData();
      //     this.form_tambah = {};
      //   });
      // },
      // editData(id){
      //   axios.get('/api/'+id).then((response) => {
      //     this.form_edit = response.data;
      //   });
      // },
      // updateData(id){
      //   axios.put('/api/'+id, this.form_edit).then((response) => {
      //     this.getData();
      //     this.form_edit = {};
      //   });
      // },
      // hapusData(id){
      //   axios.delete('/api/'+id).then((response) => {
      //     this.getData();
      //   });
      // },
    }
  });
  $(document).ready(function() {

  });
 
</script>
@endsection