<template>
    <ul className="about-company-list">
        <li v-for="item in items">
            <img src="/storage/logo.png" width="300" height="200">
            <div class="col-6">
                {{item.description}}
            </div>
        </li>
    </ul>
</template>

<script>
export default {
    name: "Product.vue",

    data() {
        return {
            items: [{ message: 'Foo', description: 'car1 car2 car3' }, { description: 'car4 car car6' }]
        }
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
