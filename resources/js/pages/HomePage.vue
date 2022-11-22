<template>
    <div>
        <main>
            <section id="main-section" class="position-relative">
                <div id="search-container" class="position-relative">
                    <div class="container-md">
                        <h4 class="pt-2">Your kitchen is not a luna park.</h4>

                        <div class="row justify-content-center">
                            <div v-if="isCuisineLoading" class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>

                            <div class="col-3 col-md" v-for="(cuisine, index) in cuisines" :key="index">
                                <input type="checkbox" class="my_checkbox rounded pointer" :name="cuisine.name" :id="cuisine.id" :value="cuisine.id" v-model="selectedCuisines" @change="getFilteredRestaurants()"
                                :style="`background-image: url('/assets/img/cuisines/${cuisine.name}.jpg');`">
                                <div class="text-capitalize" :for="cuisine.id">{{cuisine.name}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="container-md">
                <h3 class="pt-2">Restaurants</h3>
                <div class="row justify-content-center">
                    <div v-if="isRestaurantLoading" class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3" v-for="(restaurant, index) in restaurants" :key="index">
                        <router-link @click.native="checkRestaurantHasCart()" :event="restaurant.cartActiveDetect == false ? 'click' : ''" :to="{name: 'restaurant-menu', params: {slug: restaurant.slug}}"
                        class="d-flex">
                            <img class="my_restaurant-img rounded" :src=" restaurant.image == null ? '/assets/img/food-main-logo_edit.png' : 'storage/'+ restaurant.image" :alt="restaurant.name">
                            <div>
                                <div class="text-capitalize">{{restaurant.name}}</div>
                                <div v-for="(cuisine, cuisineIndex) in restaurant.cuisines" :key="cuisineIndex">{{cuisine.name}}</div>
                                <div class="text-capitalize">{{restaurant.address}}</div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </section>

            <section id="cart-section" class="container-md py-2" v-if="liveCart.length > 0">
                <div class="my-2 d-flex align-items-center">
                    <h2 class="mb-0">Cart</h2>
                    <router-link :to="{name: 'restaurant-menu', params: {slug: liveCartRestaurant.slug}}" class="btn btn-primary ml-4">Update order</router-link>
                    <h4 class="mb-0 ml-4">{{liveCartRestaurant.name}}</h4>
                    <button class="btn btn-danger ml-4" @click="deleteCart()">Delete cart</button>
                </div>

                <form @submit="orderHandle">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <ul class="list-group mb-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize"
                                v-for="(product, index) in liveCart" :key="index">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center px-2 border border-primary rounded">{{product.productCounter}}</div>
                                        <div class="ml-3">{{product.name}}</div>
                                    </div>
                                    <div>{{formatPrice(getPartialAmount(index))}}</div>
                                </li>
                            </ul>
                        </div>

                        <div class="col-12 col-md-6">
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
                        </div>

                        <div class="col-12 d-flex justify-content-center">
                            <div class="mb-2">Total amount: {{formatPrice(totalAmount)}}</div>
                        </div>

                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Order Now</button>
                        </div>
                    </div>
                </form>
            </section>

            <section class="container-md py-4">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 d-flex justify-content-center">
                        <img class="img-fluid" src="/assets/img/super-french-fries_edit.png" alt="DeliveBoo">
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-center">
                        <div class="slogan-container position-relative">
                            <img class="img-fluid" src="/assets/img/cloud-comic.png" alt="If you can eat it, we can deliver it!">
                            <div class="my_main-slogan text-center position-absolute">
                                If you can eat it,</br> 
                                we can deliver it!
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="container-md py-4 text-center">
                <h2>Work with us!</h2>
            </section>


            <div v-if="isOrderConfirmed" id="order-confirmed" class="position-fixed d-flex flex-column justify-content-center align-items-center">
                <div class="alert alert-success">Order confirmed</div>
                <button type="button" class="btn btn-primary px-4" @click="confirmedHandle()">x</button>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    name: 'MyMain',
    data() {
        return {
            isCuisineLoading: true,
            isRestaurantLoading: true,
            cuisines: [],
            selectedCuisines: [],
            restaurants: [],
            liveCart: [],
            liveCartRestaurant: "",
            isLiveCartEmpty: false, ///////////////////check label advise
            hasRestaurantCart: false, ///////////////////check label advise
            userName: "",
            userAddress: "",
            userNumber: "",
            userEmail: "",
            totalAmount: 0,
            isOrderConfirmed: false
        }
    },
    methods: {
        getCuisines() {
            axios.get('/api/cuisines')
            .then((response) =>{
                this.cuisines = response.data.results;

                this.isCuisineLoading = false;
            });
        },
        getFilteredRestaurants() {
            axios.get('/api/restaurants', {
                params: {
                    cuisines: this.selectedCuisines
                }
            })
            .then((response) => {
                this.restaurants = response.data.results;

                this.isRestaurantLoading = false;

                this.getLiveCart();
                this.getTotalAmount();

                for (let i = 0; i < this.restaurants.length; i++) {
                    this.restaurants[i].cartActiveDetect = false;
                }

                if (this.liveCart.length == 0) {
                    return;
                }
                for (let i = 0; i < this.restaurants.length; i++) {
                    if (this.restaurants[i].id != this.liveCart[0].restaurant_id) {
                        this.restaurants[i].cartActiveDetect = true;
                    }
                }
            });
        },
        getLiveCart() {
            if (JSON.parse(localStorage.getItem('myLiveCart')) == null) {
                return;
            } else {
                this.liveCart = JSON.parse(localStorage.getItem('myLiveCart'));
            }

            for (let i = 0; i < this.restaurants.length; i++) {
                if (this.restaurants[i].id == this.liveCart[0].restaurant_id) {
                    this.liveCartRestaurant = this.restaurants[i];
                }
            }
        },
        deleteCart() {
            this.liveCart = [];

            for (let i = 0; i < this.restaurants.length; i++) {
                this.restaurants[i].cartActiveDetect = false;
            }
            this.hasRestaurantCart = false;

            localStorage.clear();
        },
        orderHandle(event) {
            event.preventDefault();

            axios.post('/api/order', {
                name: this.userName,
                phone: this.userNumber,
                email: this.userEmail,
                shipping_address: this.userAddress,
                total_price: this.totalAmount,
                liveCart: this.liveCart,

                resUserId: this.liveCartRestaurant.user_id,
                resName: this.liveCartRestaurant.name
            })
            .then((response)=>{
                this.liveCart = [];
                localStorage.clear();

                if (response.data.success == true) {
                    this.isOrderConfirmed = true;
                    localStorage.setItem('orderConfirmed', JSON.stringify(this.isOrderConfirmed));
                }

                window.location.reload();
            });
        },
        confirmedHandle() {
            localStorage.clear();

            this.isOrderConfirmed = false;
        },
        checkRestaurantHasCart() {
            this.hasRestaurantCart = true;
        },
        checkLiveCartEmpty() {
            if (JSON.parse(localStorage.getItem('myLiveCart')) == null) {
                this.isLiveCartEmpty = true;
            } else {
                window.scroll({
                    top: window.innerHeight,
                    behavior: 'smooth'
                });
            }
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
        this.getCuisines();
        this.getFilteredRestaurants();

        if (JSON.parse(localStorage.getItem('orderConfirmed')) == null) {
            return;
        } else {
            this.isOrderConfirmed = JSON.parse(localStorage.getItem('orderConfirmed'));
        }
    }
}
</script>

<style scoped lang="scss">
    main {
        background-color: #0367a6;
    }

    #main-section {
        height: 500px;
        overflow: hidden;
    }

    #search-container {
        background-color: rgba(255, 255, 255, 0.8);

        z-index: 200;
    }

    .my_checkbox {
        width: 100%;
        aspect-ratio: 1 / 1;
        max-width: 90px;
        max-height: 90px;
        appearance: none;
        background-size: 100%;
        background-repeat: no-repeat;
        filter: grayscale(100%);
    }

    .my_checkbox:checked {
        filter: grayscale(0%);
    }

    .my_restaurant-img {
        aspect-ratio: 1 / 1;
        max-width: 90px;
        max-height: 90px;
    }

    .pointer {
        cursor: pointer;
    }

    #order-confirmed {
        top: 0;
        left: 0;
        z-index: 999;
        width: 100%;
        height: 100vh;

        background-color: rgba(255, 255, 255, 0.6);
        font-size: 40px;

        button {
            font-size: 40px;
        }
    }

    /*** START SLOGAN ***/

    .my_main-slogan {
        font-size: 28px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }



    /////// MEDUA QUERY ///////

    @media all and (min-width: 768px) {
        
    }
    @media all and (min-width: 992px) {
        
    }
</style>
