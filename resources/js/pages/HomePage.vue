<template>
    <div>
        <main>
            <section class="container-md position-relative">

                <div id="search-container" class="position-relative">
                    <h3 class="pt-2">Categories</h3>
                    <div class="row justify-content-center my_special-bg-color">
                        <div class="col-3 d-flex justify-content-center align-items-center position-relative py-2" v-for="(cuisine, index) in cuisines" :key="index">
                            <input type="checkbox" class="my_checkbox pointer" :name="cuisine.name" :id="cuisine.id" :value="cuisine.id" v-model="selectedCuisines" @change="getFilteredRestaurants()">
                            <label class="my_cuisine-label text-capitalize pointer position-absolute" :for="cuisine.id">{{cuisine.name}}</label>
                        </div>
                    </div>

                    <h3 class="pt-2">Restaurants</h3>
                    <div class="row justify-content-center my_special-bg-color">
                        <div class="col-3 py-2" v-for="(restaurant, index) in restaurants" :key="index">
                            <router-link :to="{name: 'restaurant-menu', params: {slug: restaurant.slug}}"
                            class="my_restaurant d-flex justify-content-center align-items-center position-relative">
                                <img class="img-fluid" :src=" restaurant.image == null ? '/assets/img/food-main-logo_edit.png' : 'storage/'+ restaurant.image" :alt="restaurant.name">
                                <div class="my_restaurant-label text-capitalize position-absolute">{{restaurant.name}}</div>
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

                    <a href="#" id="main-cart" class="position-absolute">
                        <img src="/assets/img/shopping-cart-edit.png">
                    </a>
                </div>


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
        </main>
    </div>
</template>

<script>
export default {
    name: 'MyMain',
    data() {
        return {
            cuisines: [],
            selectedCuisines: [],
            restaurants: []
        }
    },
    methods: {
        getCuisines() {
            axios.get('/api/cuisines')
            .then((response) =>{
                this.cuisines = response.data.results;
            })
        },
        getFilteredRestaurants() {
            axios.get('/api/restaurants', {
                params: {
                    cuisines: this.selectedCuisines
                }
            })
            .then((response) => {
                this.restaurants = response.data.results;
            })
        }
    },
    mounted() {
        this.getCuisines();
        this.getFilteredRestaurants();
    }
}
</script>

<style scoped lang="scss">
    main {
        height: calc(100vh - 70px);
        background-color: beige;
    }

    section {
        height: 100%;
        overflow-x: hidden;
    }

    #search-container {
        width: 100%;

        z-index: 103;
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

    .pointer {
        cursor: pointer;
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

        ////////////////////CARD FLIP HIDDEN HANDLE
        //transform-style: preserve-3d;
        //backface-visibility: hidden;

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
        left: 300px;

        img {
            height: 80px;
        }
    }

    /*** END FOOD TRUCK ***/

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
</style>
