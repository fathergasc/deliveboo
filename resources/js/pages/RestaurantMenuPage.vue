<template>
    <div>

        <section class="container-md text-center">
            <div class="row">
                <div class="col-4 offset-4">
                    <img class="img-fluid" :src=" restaurant.image == null ? '/assets/img/food-main-logo_edit.png' : 'storage/'+ restaurant.image" :alt="restaurant.name">
                </div>

                <div class="col-4 offset-4">
                    <h2>{{restaurant.name}}</h2>
                </div>

                <div class="col-12">
                    <h3>Menu</h3>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize"
                        v-for="(product, index) in restaurant.products" :key="index">
                            {{product.name}}
                        <div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" @click="productDecrement(index)" :disabled="product.productCounter<=0">-</button>
                                <div class="my_product-counter">{{liveProductCounter}}</div>
                                <button type="button" class="btn btn-primary" @click="productIncrement(index)">+</button>
                            </div>
                            <button class="btn btn-primary" @click="addProductToCart(index)">Add</button>
                        </div>
                        </li>
                    </ul>
                </div>

                <div class="col-12">
                    <h3>Cart</h3>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize"
                        v-for="(product, index) in liveCart" :key="index">
                            {{product.name}}
                        <div class="d-flex">
                            <div class="my_product-counter">{{product.productCounter}}</div>
                            <button type="button" class="btn btn-primary" @click="productIncrement(index)">Del</button>
                        </div>
                        </li>
                    </ul>
                    <button class="btn btn-primary">Pay</button>
                </div>
            </div>
        </section>


        <router-link :to="{name: 'home'}">Back</router-link>
    </div>

</template>

<script>
export default {
    name: 'RestaurantMenuPage',
    data() {
        return {
            restaurant: [],
            liveProductCounter: 0,
            liveCart: []
        }
    },
    methods: {
        getRestaurant() {
            const slug = this.$route.params.slug;
            axios.get('/api/restaurants/' + slug)
            .then((response)=>{
                this.restaurant = response.data.results;

                for (let i = 0; i < this.restaurant.products.length; i++) {
                    this.restaurant.products[i].productCounter = 0;
                }
                console.log(this.restaurant.products[0].productCounter)
            })
        },
        productIncrement(index) {
            this.restaurant.products[index].productCounter++;
            //this.restaurant.products[index].productCounter = productCounter;
            console.log(this.restaurant.products[index].productCounter)
        },
        productDecrement(index) {
            this.restaurant.products[index].productCounter--;
            console.log(this.restaurant.products[index].productCounter)
        },
        addProductToCart(index) {
            this.liveCart.push(this.restaurant.products[index]);
            console.log(this.liveCart)
        }
    },
    mounted() {
        this.getRestaurant();
    },
    computed: {
        showProductCounter() {

        }
    }
}
</script>

<style scoped lang="scss">
    .my_product-counter {
        background-color: pink;
    }
</style>
