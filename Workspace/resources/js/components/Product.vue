<template>
    <div>
        <div class="row row-cols-1 row-cols-md-2 g-4" >
            <div v-for="product in products.data">
                <div class="card">
                    <div v-if="$gate.user.type === 'admin' || $gate.user.type === 'user'" type="button" @click="newModal(product.id, product.photo)">
                        <div class="center">
                            <img :src="product.photo" class="card-img-top" style="float: left; width:  200px; height: 200px; object-fit: cover;">
                        </div>
                    </div>
                    <div v-if="$gate.user.type === 'supplier'" >
                        <img :src="product.photo" class="card-img-top" style="float: left; width:  200px; height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h1> {{product.name}} <span class="badge bg-secondary">{{ product.price }} &euro;</span></h1>
                        </div>
                        <p class="card-text">{{product.description}}</p>
                    </div>
                    <div class="card-footer" v-if="$gate.user.type === 'admin' || $gate.user.type === 'user'">
                        <a href="#" class="btn btn-primary" v-on:click="addToCart">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div>
                        <div class="card-header">
                            <h5 class="modal-title" > Hi {{$gate.user.name}}!</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="card-body">
                            <div>
                                <img :src="photo" class="card-img-top">
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <h5 class="modal-title" > Do you want to add this item to your cart?</h5>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-on:click="addToCart" type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!--    <ul className="about-company-list">-->


<!--        <li v-for="product in products.data">-->
<!--            <div class="card" style="width: 18rem;">-->
<!--                <div v-if="$gate.user.type === 'admin' || $gate.user.type === 'user'" type="button" @click="newModal(product.id)">-->
<!--                    <img :src="product.photo" class="card-img-top" alt="...">-->
<!--                </div>-->
<!--                <div v-if="$gate.user.type === 'supplier'" >-->
<!--                    <img :src="product.photo" class="card-img-top" alt="...">-->
<!--                </div>                <div class="card-body">-->
<!--                    <h5 class="card-title">{{product.name}}</h5>-->
<!--                    <p class="card-text">{{product.description}}</p>-->
<!--                    <a href="#" class="btn btn-primary" @click="newModal(product.id)">Add to Cart</a>-->
<!--                </div>-->
<!--            </div>-->

<!--        </li>-->

<!--    </ul>-->

</template>

<script>
export default {
    name: "Product.vue",

    data() {
        return {
            products: [],
            product_id: '',
            photo: '',
        }
    },

    methods: {
        loadAllProducts()
        {
            axios.get("api/product").then(({ data }) =>
                (
                    this.products = data.data
                        //console.log(this.products)
                )
            );
        },

        addToCart()
        {
            this.$Progress.start();
            axios.post("api/cart", {'user_id': this.$gate.user.id, 'product_id': this.product_id}).then(
                response => {
                    console.log('repsonse', response.data.ack)
                    if (response.data.ack === 1)
                    {
                        $('#addNew').modal('hide');

                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        });
                    }
                    else
                    {
                        Toast.fire({
                            icon: 'error',
                            title: response.data.message
                        });

                    }
                }
            );
        },

        newModal(id, photo){
            this.product_id = id
            this.photo = photo
            this.editmode = false;
            //this.form.reset();
            $('#addNew').modal('show');
        },
    },

    created() {
        this.loadAllProducts()
    }
}

</script>

<style scoped>
.center {
    margin: auto;
    width: 50%;
    padding: 10px;
}
</style>
