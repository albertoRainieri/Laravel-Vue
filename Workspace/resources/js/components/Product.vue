<template>
    <ul className="about-company-list">


        <li v-for="product in products.data">
            <div v-if="$gate.user.type === 'admin' || $gate.user.type === 'user'" type="button" @click="newModal(product.id)">
                <img :src="product.photo" width="300" height="200">
            </div>
            <div v-if="$gate.user.type === 'supplier'" >
                <img :src="product.photo" width="300" height="200">
            </div>
            <div class="col-6">
                Title: {{product.name}}
            </div>

            <div class="col-6">
                Description: {{product.description}}
            </div>

        </li>

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <h5 class="modal-title" > Hi {{$gate.user.name}}! Do you want to add this item to your cart?</h5>
                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-on:click="addToCart" type="submit" class="btn btn-primary">Add</button>
                    </div>


                </div>
            </div>
        </div>
    </ul>

</template>

<script>
export default {
    name: "Product.vue",

    data() {
        return {
            products: [],
            product_id: '',
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

        newModal(id){
            this.product_id = id
            console.log(this.product_id)
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
ul {
    /* using CSS Grid Layout: */
    display: grid;

    /* defining the number of columns and rows; here we use
       the repeat() function to create 2 columns, each column
       of one fractional unit ('fr') of the available space
       and six rows, each of one fractional unit of the available
       space: */
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(6, 1fr);

    /* forcing the grid to place items automatically into the rows
       rather than the columns: */
    grid-auto-flow: rows;
}

li {
    list-style-type: none;
    padding: 1.25em 0 1.25em 50px;
    font: 20px/24px "PT Root UI";
    color: #272727;
    mix-blend-mode: normal;
    opacity: 0.8;
    display: inline-block;
}
</style>
