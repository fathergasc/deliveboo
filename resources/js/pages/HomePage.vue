<template>
    <div>
        <main>
            <section id="main-section" class="container-md position-relative">

                <div id="search-container" class="position-relative">
                    <h3 class="pt-2">Categories</h3>

                    <div class="row justify-content-center my_special-bg-color">
                        <div v-if="isCuisineLoading" class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>

                        <div class="col-3 d-flex justify-content-center align-items-center position-relative py-2" v-for="(cuisine, index) in cuisines" :key="index">
                            <input type="checkbox" class="my_checkbox pointer" :name="cuisine.name" :id="cuisine.id" :value="cuisine.id" v-model="selectedCuisines" @change="getFilteredRestaurants()">
                            <label class="my_cuisine-label text-capitalize font-weight-bold text-center pointer position-absolute" :for="cuisine.id">{{cuisine.name}}</label>
                        </div>
                    </div>

                    <h3 class="pt-2">Restaurants</h3>
                    <div class="row justify-content-center my_special-bg-color">
                        <div v-if="isRestaurantLoading" class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>

                        <div class="col-3 d-flex justify-content-center align-items-center position-relative py-2" v-for="(restaurant, index) in restaurants" :key="index">
                            <router-link @click.native="checkRestaurantHasCart()" :event="restaurant.hasCartActive == false ? '' : 'click'" :to="{name: 'restaurant-menu', params: {slug: restaurant.slug}}"
                            class="my_restaurant">
                                <img class="img-fluid" :src=" restaurant.image == null ? '/assets/img/food-main-logo_edit.png' : 'storage/'+ restaurant.image" :alt="restaurant.name">
                                <div class="my_restaurant-label text-capitalize font-weight-bold text-center position-absolute">{{restaurant.name}}</div>
                            </router-link>
                        </div>
                    </div>
                </div>


                <div id="food-truck-container" class="position-absolute">
                    <img src="/assets/img/food-truck edit.png" alt="Food truck">

                    <div id="truck-door-container" class="position-absolute">
                        <div id="truck-door" class="position-relative">
                            <div id="truck-door-window" class="position-absolute"></div>
                            <img src="/assets/img/food-truck-door-handle.png" class="position-absolute">
                        </div>
                    </div>

                    <div id="main-cart" class="position-absolute pointer" @click="checkLiveCartEmpty()">
                        <img src="/assets/img/shopping-cart-edit.png">
                    </div>
                </div>

                <div class="park-floor position-absolute"></div>

                <div v-if="isLiveCartEmpty" class="cart-empty-label font-italic text-white position-absolute">Your cart is empty!</div>
                <div v-if="hasRestaurantCart" class="cart-empty-label font-italic text-white position-absolute">Delete your cart to change restaurant!</div>

                <div class="ferris-wheel-container">
                    <div class="circle">
                        <ul class="borders">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <div class="cab"></div>
                        <div class="cab"></div>
                        <div class="cab"></div>
                        <div class="cab"></div>
                        <div class="cab"></div>
                        <div class="cab"></div>
                        <div class="cab"></div>
                        <div class="cab"></div>
                        <div class="cab"></div>
                        <div class="cab"></div>
                        <div class="cab"></div>
                        <div class="cab"></div>
                    <div>
                </div>
                </div>
                <div class="std"></div>
                </div>
            </section>

            <section id="cart-section" class="container-md py-2" v-if="liveCart.length > 0">
                <div class="my-2 d-flex align-items-center">
                    <h2 class="mb-0">Cart</h2>
                    <router-link :to="{name: 'restaurant-menu', params: {slug: liveCartRestaurant.slug}}" class="btn btn-primary ml-4">Update order</router-link>
                    <h4 class="mb-0 ml-4">{{liveCartRestaurant.name}}</h4>
                    <button class="btn btn-danger ml-4" @click="deleteCart()">Delete cart</button>
                </div>

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

                    <button type="submit" class="btn btn-success">Order Now</button>
                </form>
            </section>

            <section class="container-md py-4">
                <div class="row">
                    <div class="col-12">
                        <img class="img-fluid" src="/assets/img/super-french-fries_edit.png" alt="DeliveBoo">
                    </div>
                    <div class="col-12">
                        <div class="slogan-container position-relative">
                            <img class="img-fluid" src="/assets/img/cloud-comic.png" alt="If you can eat it, we can deliver it!">
                            <div class="my_main-slogan text-center position-absolute">If you can eat it, we can deliver it!</div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="container-md py-4 text-center">
                <h2>Work with us!</h2>

                <div v-if="!isUserLogged" class="d-flex justify-content-center">
                    <a href="/admin" class="btn btn-light">Login</a>
                    <a href="/register" class="btn btn-dark ml-4">Register</a>
                </div>

                <div v-else class="d-flex justify-content-center">
                    <a href="/admin" class="btn btn-secondary">Dashboard</a>
                </div>
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
            isUserLogged: false,
            isCuisineLoading: true,
            isRestaurantLoading: true,
            cuisines: [],
            selectedCuisines: [],
            restaurants: [],
            liveCart: [],
            liveCartRestaurant: "",
            isLiveCartEmpty: false,
            hasRestaurantCart: false,
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
                    this.restaurants[i].hasCartActive = false;

                    if (this.liveCart.length == 0) {
                        return;
                    } else if (this.restaurants[i].id == this.liveCart[0].restaurant_id) {
                        this.restaurants[i].hasCartActive = true;
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
                this.restaurants[i].hasCartActive = true;
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
                liveCart: this.liveCart
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
    },
    created() {
        axios.get('/admin/checkAuth')
        .then((response) =>{
            this.isUserLogged = response.data.success;
        });
    }
}
</script>

<style scoped lang="scss">
    main {
        background-color: beige;
    }

    #main-section {
        height: calc(100vh - 70px);
        overflow-x: hidden;
    }

    #search-container {
        width: 100%;
        

        z-index: 200;

        div {
            max-height: 212px;
            overflow-y: auto;
        }
    }

    .my_special-bg-color {
        background-color: rgba(255, 255, 255, 0.4);
    }

    .my_checkbox {
        width: 100%;
        aspect-ratio: 1 / 1;
        max-width: 90px;
        max-height: 90px;
        appearance: none;
        background-image: url('/assets/img/hand-drawn-food-doodle_edit.png');
        background-size: 100%;
        background-repeat: no-repeat;
        filter: grayscale(100%);
    }

    .my_cuisine-label,
    .my_restaurant-label {
        margin-bottom: 0px;

        max-width: 90px;
        max-height: 90px;
        background-color: rgba(255, 255, 255, 0.8);
        color: black;
        padding: 3px 6px;
    }

    .my_checkbox:checked {
        outline: 5px solid #0367a6;
        outline-offset: 5px;
        filter: grayscale(0%);

        .ferris-wheel-container {
            filter: grayscale(100%);
        }
    }

    .my_restaurant {
        aspect-ratio: 1 / 1;
        max-width: 90px;
        max-height: 90px;
    }

    .my_restaurant-label {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
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

    /*** START FOOD TRUCK ***/

    #food-truck-container {
        bottom: 0px;
        left: -84px;

        z-index: 102;

        img {
            height: 280px;
        }
    }

    #truck-door-container {
        width: 43px;
        height: 96.5px;

        bottom: 51px;
        left: 250px;

        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    #truck-door {
        width: 100%;
        height: 100%;
        background-color: #cd181f;
        box-shadow: inset 0px 0px 0px 1px #000000;

        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;

        img {
            height: 6px;

            top: 60px;
            right: 3px;
        }
    }

    #truck-door-window {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #0ca49b;
        box-shadow: 0px 0px 0px 2px #000000;

        top: 16px;
        left: 50%;
        transform: translateX(-50%);
    }

    #truck-door-container:hover #truck-door {
        animation: open-door 1.5s ease forwards;
    }

    @keyframes open-door {
        0% {
            -webkit-transform: perspective(600) rotateY(0deg);
            transform-origin: 0% 50%;
        }
        100% {
            -webkit-transform: perspective(600) rotateY(-180deg);
            transform-origin: 0% 50%;
        }
    }

    #main-cart {
        bottom: 4px;
        left: 295px;

        img {
            height: 80px;
        }
    }

    /*** END FOOD TRUCK ***/

    /*** START SPECIAL ELEMENTS ***/

    .park-floor {
        bottom: 0;
        left: 0;
        width: 100%;
        height: 27px;
        background-color: rgb(70, 70, 70);
        z-index: 100;
    }

    .cart-empty-label {
        bottom: 2px;
        left: 83px;

        z-index: 105;
    }

    /*** END SPECIAL ELEMENTS ***/

    /*** START FERRIS WHEEL ***/

    .ferris-wheel-container {
        height: 500px;
        width: 500px;
        position: absolute;
        overflow: hidden;

        bottom: 20px;
        right: -156px;

        z-index: 101;
    }
    .ferris-wheel-container * {
        position: absolute;
        box-sizing: border-box;
    }
    *::before,
    *::after {
        content: '';
        position: absolute;
    }

    .circle,
    .borders::before {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .circle,
    .borders,
    .borders::before {
        border-radius: 50%;
    }

    .circle {
        top: 200px;
        height: 350px;
        width: 350px;
        
        animation: circle 60s linear infinite;
    }

    @keyframes circle {
        to {transform: translate(-50%, -50%) rotate(360deg);}
    }

    .borders {
        padding: 0;
        list-style: none;
        margin: 0;
        height: 100%;
        width: 100%;
        z-index: 5;
        border: 3px solid #1c8fab;
    }
    .borders::before {
        height: 50px;
        width: 50px;
        background-color: #7dc3dd;
        border: 10px solid #1c8fab;
        z-index: 555;
    }
    .borders li {
        top: 50%;
        transform: translateY(-50%);
        height: 2px;
        width: 100%;
        background-color: #7dc3dd;
    }
    .borders li:nth-of-type(2) {
        transform: rotate(30deg);
    }
    .borders li:nth-of-type(3) {
        transform: rotate(60deg);
    }
    .borders li:nth-of-type(4) {
        transform: rotate(90deg);
    }
    .borders li:nth-of-type(5) {
        transform: rotate(120deg);
    }
    .borders li:nth-of-type(6) {
        transform: rotate(150deg);
    }

    .cab {
        height: 40px;
        width: 40px;
        transform-origin: top center;
        background-image: url('/assets/img/food-main-logo_edit.png');
        background-size: 100%;
        background-repeat: no-repeat;
        
        animation: cab-one 60s linear infinite reverse;
    }
    .cab:nth-of-type(1) { top: 175px; left: -19px; }
    .cab:nth-of-type(2) { top: 91px; left: 4px; }
    .cab:nth-of-type(3) { top: 26px; left: 68px; }
    .cab:nth-of-type(4) { top: 1px; left: 155px; }
    .cab:nth-of-type(5) { top: 26px; left: 245px; }
    .cab:nth-of-type(6) { top: 90px; left: 307px; }
    .cab:nth-of-type(7) { top: 175px; left: 329px; }
    .cab:nth-of-type(8) { top: 263px; left: 306px; }
    .cab:nth-of-type(9) { top: 327px; left: 243px; }
    .cab:nth-of-type(10) { top: 349px; left: 156px; }
    .cab:nth-of-type(11) { top: 328px; left: 69px; }
    .cab:nth-of-type(12) { top: 265px; left: 4px; }
    @keyframes cab-one {
        100% {transform: rotate(360deg);}
    }

    .cab::before {
        height: 6px;
        width: 6px;
        top: -3px;
        left: 50%;
        background-color: black;
        transform: translateX(-50%);
        border-radius: 50%;
    }

    .std {
        height: 30px;
        width: 350px;
        border-radius: 30px 30px 0 0;
        background-color: #1d90ac;
        top: 470px;
        left: 50%;
        transform: translateX(-50%);
    }
    .std::before,
    .std::after {
        height: 290px;
        width: 12px;
        background-color: #1d90ac;
        bottom: 0;
        transform-origin: bottom center;
    }
    .std::before {
        left: 60px;
        transform: rotate(20deg);
    }
    .std::after {
        right: 60px;
        transform: rotate(-20deg);
    }

    /*** END FERRIS WHEEL ***/

    /*** START SLOGAN ***/

    .my_main-slogan {
        font-size: 28px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
