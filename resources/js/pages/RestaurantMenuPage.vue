<template>
    <div>
        <section class="container-md text-center py-3">
            <div class="row">
                <div class="col-4 offset-4">
                    <img class="img-fluid" :src=" restaurant.image == null ? '/assets/img/food-main-logo_edit.png' : 'storage/'+ restaurant.image" :alt="restaurant.name">
                </div>

                <div class="col-4 offset-4">
                    <h2>{{restaurant.name}}</h2>
                </div>

                <div class="col-12">
                    <router-link :to="{name: 'home'}" class="btn btn-secondary">Back</router-link>

                    <h3 class="mt-2">Menu</h3>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize"
                        v-for="(product, index) in restaurant.products" :key="index">
                            {{product.name}}
                        <div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" @click="productDecrement(index)" :disabled="liveProductCounter[index].productCounter <= 0">-</button>
                                <div class="d-flex align-items-center px-2 border border-primary">{{liveProductCounter[index].productCounter}}</div>
                                <button type="button" class="btn btn-primary" @click="productIncrement(index)">+</button>
                            </div>
                            <button class="btn btn-primary ml-1" @click="addProductToCart(index)" :disabled="liveProductCounter[index].productCounter <= 0">Add</button>
                        </div>
                        </li>
                    </ul>
                </div>

                <div class="col-12">
                    <h2 class="mt-2">Cart</h2>
                    <ul class="list-group" :class="liveCart.length > 0 ? 'mb-3' : ''">
                        <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize"
                        v-for="(product, index) in liveCart" :key="index">
                            {{product.name}}
                            <div class="d-flex">
                                <div class="d-flex align-items-center px-2 border border-primary rounded">{{product.productCounter}}</div>
                                <button type="button" class="btn btn-danger ml-3" @click="delProductFromCart(index)">Del</button>
                            </div>
                        </li>
                    </ul>


                    <form>
                        <div v-if="showUserInfo">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputName" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputAdress" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" @click="userInfoHandle">Order Now</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: 'RestaurantMenuPage',
    data() {
        return {
            restaurant: [],
            liveProductCounter: [],
            liveCart: [],
            showUserInfo: false
        }
    },
    methods: {
        getRestaurant() {
            const slug = this.$route.params.slug;
            axios.get('/api/restaurants/' + slug)
            .then((response)=>{
                this.restaurant = response.data.results;

                for (let i = 0; i < this.restaurant.products.length; i++) {
                    let newProductCounter = {
                        productId: i,
                        productCounter: 0
                    };

                    this.liveProductCounter.push(newProductCounter);
                }
            })
        },
        productIncrement(index) {
            this.liveProductCounter[index].productCounter++;
        },
        productDecrement(index) {
            this.liveProductCounter[index].productCounter--;
        },
        addProductToCart(index) {
            if (this.liveCart.includes(this.restaurant.products[index])) {
                console.log('aooo è deoppio')

                this.restaurant.products[index].productCounter = this.restaurant.products[index].productCounter + this.liveProductCounter[index].productCounter;
            } else {
                this.restaurant.products[index].productCounter = this.liveProductCounter[index].productCounter;
                this.liveCart.push(this.restaurant.products[index]);
            }

            this.liveProductCounter[index].productCounter = 0;
        },
        delProductFromCart(index) {
            this.liveCart.splice(this.restaurant.products[index], 1);

            this.liveProductCounter[index].productCounter = 0;
        },
        userInfoHandle(event) {
            event.preventDefault();

            if (this.showUserInfo == false) {
                this.showUserInfo = true;
            } else {
                this.showUserInfo = false;
            }

            //ADD VALIDATE FRONT & BACK
            /*
            let emailCheck = /^((?!\.)[\w-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/gim;
            if (!emailCheck.test(this.email)) {
                return;
            }*/
        }
    },
    mounted() {
        this.getRestaurant();
    }
}
</script>

<style scoped lang="scss">

</style>
