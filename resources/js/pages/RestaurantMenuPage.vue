<template>
    <div>
        <section id="order-section" class="position-relative">
            <div class="custom-shape-edit-top"></div>
            <div class="custom-shape-divider-top-1669183005">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                </svg>
            </div>


            <div class="container-md text-dark py-4 relative-index-bg">
                <div class="row">
                    <div class="col-12 col-md-4 d-flex flex-column align-items-center align-items-md-start">
                        <h2 class="text-center text-md-left">{{restaurant.name}}</h2>
                        <div class="my_restaurant-img mb-2">
                            <img class="rounded" :src="restaurant.image" :alt="restaurant.name">
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-between mb-2">
                            <h3 class="mt-2">Menu</h3>
                            <router-link :to="{name: 'home'}" class="btn btn-secondary ml-5">Go back</router-link>
                        </div>

                        <div v-if="isMenuLoading" class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>

                        <ul class="list-group mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize p-0"
                            v-for="(product, index) in filteredProduct" :key="index">
                                <div class="my_product-img-title d-flex align-items-center overflow-hidden p-3">
                                    <img class="d-none d-sm-block rounded" :src="product.image == null ? '/assets/img/hand-drawn-food-doodle_edit.png' : '/storage/' + product.image" :alt="product.name">
                                    <div class="mx-2">{{product.name}}</div>
                                </div>
                                <div class="d-flex align-items-center p-3">
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

                        <h3 v-if="isOrderProcessing == false" class="text-center text-md-left">Cart</h3>
                        <div v-if="isOrderProcessing" class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>

                        <div v-if="liveCart.length == 0 && isOrderConfirmed == false" class="font-italic text-center text-md-left">Nothing to see here, just add your food.</div>

                        <div v-if="isOrderConfirmed" class="d-flex justify-content-center">
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <div class="alert alert-success m-0">Order confirmed</div>
                                <button type="button" class="btn btn-primary px-4 ml-2" @click="confirmedHandle()"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        </div>

                        <ul v-if="isOrderProcessing == false" class="list-group mb-4" :class="liveCart.length > 0 ? 'mb-2' : ''">
                            <li class="list-group-item d-flex justify-content-between align-items-center text-capitalize"
                            v-for="(product, index) in liveCart" :key="index">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center px-2 border border-primary rounded">{{product.productCounter}}</div>
                                    <div class="ml-3">{{product.name}}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div>{{formatPrice(getPartialAmount(index))}}</div>
                                    <button type="button" class="btn btn-danger ml-3" @click="delProductFromCart(index), getTotalAmount()"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </li>
                        </ul>

                        <form @submit="orderHandle" v-if="isOrderProcessing == false && isOrderConfirmed == false">
                            <div>
                                <div class="mb-2 text-center text-md-left">Where to deliver?</div>
                                <div class="row">
                                    <div class="col-12 col-md-8">
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
                            </div>
                            <div class="text-center text-md-left">
                                <div class="mb-2">Total amount: {{formatPrice(totalAmount)}}</div>
                                <button type="submit" class="btn btn-success text-center w-25" :disabled="isCartEmpty">Order Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="custom-shape-divider-bottom-1669183688">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                </svg>
            </div>
            <div class="custom-shape-edit-bottom"></div>
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
            totalAmount: 0,
            isOrderProcessing: false,
            isOrderConfirmed: false
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
                this.getTotalAmount();
            });
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
                if (this.liveCart.length == 0) {
                    return;
                }
                if (this.restaurant.id == this.liveCart[0].restaurant_id) {
                    this.isCartEmpty = false;
                    return;
                } else {
                    this.liveCart = [];
                    this.isCartEmpty = true;
                }
            }
        },
        addProductToCart(index) {
            if (this.isCartEmpty == true) {
                this.isCartEmpty = false;
            }

            if (this.liveCart.length == 0) {
                this.restaurant.products[index].productCounter = this.liveProductCounter[index].productCounter;
                this.liveCart.push(this.restaurant.products[index]);
            } else {
                for (let i = 0; i < this.liveCart.length; i++) {
                    if (this.liveCart[i].id == this.restaurant.products[index].id) {
                        this.liveCart[i].productCounter = this.liveCart[i].productCounter + this.liveProductCounter[index].productCounter;

                        this.liveProductCounter[index].productCounter = 0;
                        localStorage.setItem('myLiveCart', JSON.stringify(this.liveCart));

                        return;
                    }
                }
            }

            if (!this.liveCart.includes(this.restaurant.products[index])) {
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

            this.isOrderProcessing = true;

            axios.post('/api/order', {
                name: this.userName,
                phone: this.userNumber,
                email: this.userEmail,
                shipping_address: this.userAddress,
                total_price: this.totalAmount,
                liveCart: this.liveCart,

                resUserId: this.restaurant.user_id,
                resName: this.restaurant.name
            })
            .then((response)=>{
                this.liveCart = [];
                localStorage.clear();

                if (response.data.success == true) {
                    this.isOrderConfirmed = true;
                    localStorage.setItem('orderConfirmed', JSON.stringify(this.isOrderConfirmed));
                }

                this.isOrderProcessing = false;

                window.location.reload();
            });
        },
        confirmedHandle() {
            localStorage.clear();

            this.isOrderConfirmed = false;
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

        if (JSON.parse(localStorage.getItem('orderConfirmed')) == null) {
            return;
        } else {
            this.isOrderConfirmed = JSON.parse(localStorage.getItem('orderConfirmed'));
        }
    }, computed: {
        filteredProduct: function () {
            return this.restaurant.products.filter(i => i.displayed == 1);
        }
    }
}
</script>

<style scoped lang="scss">
    #order-section {
        background-color: #ffffff;

        min-height: calc(100vh - (70px + 100px));
    }

    .my_restaurant-img {
        width: 80%;
        height: 250px;
        overflow: hidden;

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
    }

    .my_product-img-title {
        img {
            width: 15%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            object-position: center;
        }
    }

    .relative-index-bg {
        position: relative;
        z-index: 111;
    }



    .custom-shape-edit-top {
        width: 100%;
        height: 250px;
        background-color: rgba(0, 123, 255, 0.2);

        position: absolute;
        top: 0;
        left: 0;
    }
    .custom-shape-divider-top-1669183005 {
        position: absolute;
        top: 250px;
        left: 0;
        width: 150%;
        overflow: hidden;
        line-height: 0;
    }
    .custom-shape-divider-top-1669183005 svg {
        position: relative;
        display: block;
        width: calc(150% + 1.3px);
        height: 50px;
    }
    .custom-shape-divider-top-1669183005 .shape-fill {
        fill: rgba(0, 123, 255, 0.2);
    }

    .custom-shape-edit-bottom {
        width: 100%;
        height: 250px;
        background-color: #e4e7eb;

        position: absolute;
        bottom: 0;
        left: 0;
    }
    .custom-shape-divider-bottom-1669183688 {
        position: absolute;
        bottom: 250px;
        left: 0;
        width: 150%;
        overflow: hidden;
        line-height: 0;
        transform: rotate(180deg);
    }
    .custom-shape-divider-bottom-1669183688 svg {
        position: relative;
        display: block;
        width: calc(150% + 1.3px);
        height: 50px;
        transform: rotateY(180deg);
    }
    .custom-shape-divider-bottom-1669183688 .shape-fill {
        fill: #e4e7eb;
    }

    /////// MEDUA QUERY ///////

    @media all and (min-width: 768px) {
        .my_restaurant-img {
            width: 100%;
            height: 350px;
        }

        .custom-shape-divider-top-1669183005 {
            width: 100%;
        }
        .custom-shape-divider-top-1669183005 svg {
            width: calc(100% + 1.3px);
        }

        .custom-shape-divider-bottom-1669183688 {
            width: 100%;
        }
        .custom-shape-divider-bottom-1669183688 svg {
            width: calc(100% + 1.3px);
        }
    }
</style>
