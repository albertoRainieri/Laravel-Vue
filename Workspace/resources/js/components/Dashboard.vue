<template>
    <section class="content">
        <div class="container-fluid">
            <div class="card-header">
                <h1 class="card-title">Hi {{$gate.user.name}}! Find your Best Item</h1>

                <div class="card-tools">

                    <h1 v-if="$gate.user.type === 'admin' || $gate.user.type === 'supplier'" href="PersonalArea">
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus-square"></i>
                            Your Personal Area (Supplier)
                        </button>
                    </h1>

                    <h1 v-if="$gate.user.type === 'admin' || $gate.user.type === 'user'" href="PersonalArea">
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus-square"></i>
                            Your Personal Area (User)
                        </button>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row col-12">

                <button class="tablink col-4" v-on:click="changeSection('Office')">Office</button>
                <button class="tablink col-4" v-on:click="changeSection('Home')">Home</button>
                <button class="tablink col-4" v-on:click="changeSection('Other')">Other</button>

            </div>

            <product></product>


        </div><!--/. container-fluid -->
    </section>
</template>

<script>
    export default {
        mounted() {
            //console.log(this.$store.state.section)
            //console.log('GATE', this.$gate.user.id)
        },

        watch: {
            'Section': {
                handler (newData, oldData) {
                    this.$store.state.section = newData

                }
            }
        },

        computed: {
            Section: {
                get: function () {
                    return this.$store.state.section
                },
                // setter
                set: function (newValue) {
                    this.$store.state.section = newValue
                }
            },




        },

        methods: {
            changeSection(input)
            {
                console.log('change Section')
                this.$store.state.section = input
            }
        }


    }
</script>

<style>
.tablink {
    background-color: dodgerblue;
    color: white;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 17px;
    width: 25%;
}
</style>
