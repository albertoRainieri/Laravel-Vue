<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Your Product List ({{$gate.user.name}})</h3>

                <div class="card-tools">

                  <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                      <i class="fa fa-plus-square"></i>
                      Add New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
<!--                  <img v-for="product in products.data" :src="product.photo" width="300" height="200"/>-->

                  <tr v-for="product in products.data" :key="product.id">
<!--                         <td>{{product.photo}}</td>-->
                      <img :src="product.photo" width="300" height="200"/>
                      <td>{{product.name}}</td>
                      <td>{{product.description | truncate(30, '...')}}</td>
                      <td>{{product.price}}</td>
                      <!-- <td><img v-bind:src="'/' + product.photo" width="100" alt="product"></td> -->
                      <td>

                        <a href="#" @click="editModal(product)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteProduct(product.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Create New Product</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateProduct() : createProduct()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="name" type="text" name="name"
                                class="form-control">
<!--                            :class="{ 'is-invalid': form.errors.has('name') }">-->
<!--                            <has-error :form="form" field="name"></has-error>-->
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input v-model="description" type="text" name="description"
                                class="form-control">
<!--                            :class="{ 'is-invalid': form.errors.has('description') }">-->
<!--                            <has-error :form="form" field="description"></has-error>-->
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input v-model="price" type="number" name="price"
                                class="form-control" >
<!--                                   :class="{ 'is-invalid': form.errors.has('price') }"-->
<!--                            <has-error :form="form" field="price"></has-error>-->
                        </div>

                        <div class="form-group">
                            <label>Picture</label>
                            <input type="file" name="photo" multiple accept="image/png, image/jpeg" @change="onFileSelected"
                                   class="form-control" >
<!--                            :class="{ 'is-invalid': form.errors.has('photo') }">-->
<!--                            <has-error :form="form" field="photo"></has-error>-->
                        </div>
                        <div class="form-group">

                            <label>Category</label>
                            <select class="form-control" v-model="category_id">
                                <option
                                    v-for="(cat,index) in categories" :key="index"
                                    :value="index"
                                    :selected="index == category_id">{{ cat }}</option>
                            </select>
<!--                            <has-error :form="form" field="category_id"></has-error>-->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </section>
</template>

<script>
    import VueTagsInput from '@johmun/vue-tags-input';

    export default {
      components: {
          VueTagsInput,
        },
        data () {
            return {
                categories: [],
                editmode: false,
                products : {},
                photo: '',
                name: '',
                description: '',
                price: '',
                category_id: '',
                formEdit: new Form({
                    photo: '',
                    name: '',
                    description: '',
                    price: '',
                    category_id: '',
                }),

                form: new FormData(),

                autocompleteItems: [],
            }
        },
        methods: {

            onFileSelected(event)
            {
                this.photo = event.target.files[0]
                //console.log(this.photo)
            },

          getResults(page = 1) {

              this.$Progress.start();

              axios.get('api/product?page=' + page).then(({ data }) => (this.products = data.data));

              this.$Progress.finish();
          },
          loadProductsSupplier(){

            // if(this.$gate.isAdmin()){
              axios.get("api/product/" + this.$gate.user.id).then(({ data }) =>
                  (
                      this.products = data,
                          console.log(this.products)
                  )
              );
            // }
          },
          loadCategories(){
              axios.get("/api/category/list").then(({ data }) =>
                  (this.categories = data.data));
          },
          loadTags(){
              axios.get("/api/tag/list").then(response => {
                  this.autocompleteItems = response.data.data.map(a => {
                      return { text: a.name, id: a.id };
                  });
              }).catch(() => console.warn('Oh. Something went wrong'));
          },
          editModal(product){
              this.editmode = true;
              //this.form.reset();
              $('#addNew').modal('show');
              this.formEdit.fill(product);
          },
          newModal(){
              this.editmode = false;
              //this.form.reset();
              $('#addNew').modal('show');
          },
          createProduct(){
              this.$Progress.start();
              // new formData
              this.form = new FormData();

              // APPend new keys
              this.form.append('image', this.photo)
              this.form.append('name', this.name)
              this.form.append('description', this.description)
              this.form.append('price', this.price)
              this.form.append('category_id', this.category_id)
              this.form.append('user_id', this.$gate.user.id)


              axios.post('api/product', this.form)
              .then((data)=>{
                if(data.data.success){
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  this.loadProductsSupplier();

                } else {
                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });

                  this.$Progress.failed();
                }
              })
              .catch(()=>{

                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
              })
          },
          updateProduct(){
              this.$Progress.start();
              this.form.put('api/product/'+this.form.id)
              .then((response) => {
                  // success
                  $('#addNew').modal('hide');
                  Toast.fire({
                    icon: 'success',
                    title: response.data.message
                  });
                  this.$Progress.finish();
                      //  Fire.$emit('AfterCreate');

                  this.loadProductsSupplier();
              })
              .catch(() => {
                  this.$Progress.fail();
              });

          },
          deleteProduct(id){
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {

                      // Send request to the server
                        if (result.value) {
                              this.delete('api/product/'+id, this.form).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadProductsSupplier();
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                        }
                  })
          },

        },
        mounted() {
        },
        created() {
            this.$Progress.start();

            this.loadProductsSupplier();
            this.loadCategories();
            this.loadTags();
            //console.log(this.products)

            this.$Progress.finish();
        },
        filters: {
            truncate: function (text, length, suffix) {
                return text.substring(0, length) + suffix;
            },
        },
        computed: {
          filteredItems() {
            return this.autocompleteItems.filter(i => {
              return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
            });
          },
        },
    }
</script>
