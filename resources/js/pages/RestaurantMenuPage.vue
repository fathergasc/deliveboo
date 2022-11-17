<template>
    <div>
        <section class="container-md text-center py-3">
            <div class="row">
                <div class="col-4 offset-4">
                    <img class="img-fluid" :src=" restaurant.image == null ? '/assets/img/food-main-logo_edit.png' : 'storage/'+ restaurant.image" :alt="restaurant.name">
                </div>

                <div class="col-4 offset-4 pt-2">
                    <h2>{{restaurant.name}}</h2>
                    <div>{{restaurant.cuisine}}</div>
                </div>

                <div class="col-12">
                    <router-link :to="{name: 'home'}" class="btn btn-secondary">Back</router-link>

                    <h3 class="mt-2">Menu</h3>

                    <div v-if="isMenuLoading" class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize"
                        v-for="(product, index) in restaurant.products" :key="index">
                            {{product.name}}
                        <div class="d-flex align-items-center">
                            <div>{{formatPrice(product.price)}}</div>
                            <div class="btn-group ml-3" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" @click="productDecrement(index)" :disabled="liveProductCounter[index].productCounter <= 0">-</button>
                                <div class="d-flex align-items-center px-2 border border-primary">{{liveProductCounter[index].productCounter}}</div>
                                <button type="button" class="btn btn-primary" @click="productIncrement(index)">+</button>
                            </div>
                            <button class="btn btn-warning ml-3" @click="addProductToCart(index), getTotalAmount()" :disabled="liveProductCounter[index].productCounter <= 0">Add</button>
                        </div>
                        </li>
                    </ul>
                </div>

                <div class="col-12">
                    <h2 class="mt-2">Cart</h2>
                    <p v-if="liveCart.length == 0" class="font-italic mb-2">Nothing to see here, just add your food.</p>

                    <ul class="list-group" :class="liveCart.length > 0 ? 'mb-2' : ''">
                        <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize"
                        v-for="(product, index) in liveCart" :key="index">
                            {{product.name}}
                            <div class="d-flex align-items-center">
                                <div>{{formatPrice(getPartialAmount(index))}}</div>
                                <div class="d-flex align-items-center px-2 ml-3 border border-primary rounded">{{product.productCounter}}</div>
                                <button type="button" class="btn btn-danger ml-3" @click="delProductFromCart(index), getTotalAmount()">Del</button>
                            </div>
                        </li>
                    </ul>

                    <form @submit="orderHandle">
                        <div>
                            <p class="mb-2">Where to deliver?</p>
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" id="inputName" placeholder="Name"
                                v-model="userName" required minlength="3" maxlength="50">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" id="inputAddress" placeholder="Address"
                                v-model="userAddress" required minlength="3" maxlength="50">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" id="inputNumber" placeholder="Phone"
                                v-model="userNumber" required minlength="5" maxlength="25">
                            </div>
                            <div class="form-group mb-2">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email"
                                v-model="userEmail" required>
                            </div>
                        </div>

                        <div class="mb-2">Total amount: {{formatPrice(totalAmount)}}</div>

                        <button type="submit" class="btn btn-success" :disabled="isCartEmpty">Order Now</button>
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
            isMenuLoading: true,
            restaurant: [],
            liveProductCounter: [],
            liveCart: [],
            isCartEmpty: true,
            userName: "",
            userAddress: "",
            userNumber: "",
            userEmail: "",
            totalAmount: 0
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

                this.isMenuLoading = false;

                this.getLiveCart();

                console.log(this.liveCart)
            })
        },
        productIncrement(index) {
            this.liveProductCounter[index].productCounter++;
        },
        productDecrement(index) {
            this.liveProductCounter[index].productCounter--;
        },
        getLiveCart() {
            if (JSON.parse(localStorage.getItem('myLiveCart')) == null) {
                return;
            } else {
                this.liveCart = JSON.parse(localStorage.getItem('myLiveCart'));
            }

            this.getTotalAmount();
        },
        addProductToCart(index) {
            ////////////////////////////////////////////////////
            //TO DO: 

            // ADD CHECK CARRELLO ID PRODOTTO quando esiste local
            //check button order con carrello pieno da local

            if (this.isCartEmpty == true) {
                this.isCartEmpty = false;
            }

            /*for (let i = 0; i < this.restaurants.length; i++) {
                if (this.restaurants[i].id == this.liveCart[0].restaurant_id) {
                    this.liveCartRestaurant = this.restaurants[i];
                }
            }*/

            if (this.liveCart.includes(this.restaurant.products[index])) {
                this.restaurant.products[index].productCounter = this.restaurant.products[index].productCounter + this.liveProductCounter[index].productCounter;
            } else {
                this.restaurant.products[index].productCounter = this.liveProductCounter[index].productCounter;
                this.liveCart.push(this.restaurant.products[index]);
            }

            this.liveProductCounter[index].productCounter = 0;

            localStorage.setItem('myLiveCart', JSON.stringify(this.liveCart));
        },
        delProductFromCart(index) {
            if (this.liveCart.length == 1) {
                this.isCartEmpty = true;
            }

            this.liveCart.splice(index, 1);

            this.liveProductCounter[index].productCounter = 0;

            localStorage.setItem('myLiveCart', JSON.stringify(this.liveCart));
        },
        orderHandle(event) {
            event.preventDefault();

            axios.post('/api/order', {
                name: this.userName,
                phone: this.userNumber,
                email: this.userEmail,
                shipping_address: this.userAddress,
                total_price: this.totalAmount,
                liveCart: this.liveCart
            })
            .then((response)=>{
                console.log(response);

                window.location.reload();
            });
        },
        getPartialAmount(index) {
            let partialAmount = 0;

            partialAmount = this.liveCart[index].price * this.liveCart[index].productCounter;

            return partialAmount;
        },
        getTotalAmount() {
            this.totalAmount = 0;

            for (let i = 0; i < this.liveCart.length; i++) {
                this.totalAmount = this.totalAmount + (this.liveCart[i].price * this.liveCart[i].productCounter);
            }

            return this.totalAmount;
        },
        formatPrice(value) {
            const dollars = new Intl.NumberFormat(`en-US`, {
                currency: `USD`,
                style: 'currency',
            }).format(value);
            return dollars;
        }
    },
    mounted() {
        this.getRestaurant();
    }
}
</script>

<style scoped lang="scss">

</style>
