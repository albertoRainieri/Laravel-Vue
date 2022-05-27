<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Welcome to the User Section {{$gate.user.name}}! </h3>

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

                                <tr v-for="product in items" :key="product.id">
                                    <!--                         <td>{{product.photo}}</td>-->
                                    <img :src="product.photo" width="250" height="170"/>
                                    <td>{{product.name}}</td>
                                    <td>{{product.description | truncate(30, '...')}}</td>
                                    <td>{{product.price}}</td>
                                    <!-- <td><img v-bind:src="'/' + product.photo" width="100" alt="product"></td> -->
                                    <td>
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
            items: [],
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


        getResults(page = 1) {

            this.$Progress.start();

            axios.get('api/product?page=' + page).then(({ data }) => (this.products = data));

            this.$Progress.finish();
        },
        loadProductsUser(){

            // if(this.$gate.isAdmin()){
            axios.get("api/cart/" + this.$gate.user.id).then(({ data }) =>
                (
                    this.items = data.products,
                        console.log(this.items)
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

        deleteProduct(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                console.log('result: ', result)

                // Send request to the server
                if (result.value) {
                    axios.delete('api/cart/'+id).then(()=>{
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        // Fire.$emit('AfterCreate');
                        this.loadProductsUser();
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

        this.loadProductsUser();
        this.loadCategories();
        this.loadTags();

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
