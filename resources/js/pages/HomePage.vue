<template>
    <div>
        <main>
            <section class="container-md position-relative">

                <h3>Categories</h3>

                <div class="row justify-content-center">
                    <div class="col-3 d-flex justify-content-center align-items-center" v-for="(cuisine, index) in cuisines" :key="index">
                        <input type="checkbox" class="my_checkbox" :name="cuisine.name" :id="cuisine.id" :value="cuisine.id" v-model="selectedCuisines" @change="getFilteredRestaurants()">
                        <label class="my_checkbox-label position-absolute" :for="cuisine.id">{{cuisine.name}}</label>
                    </div>
                </div>


                <h3>Restaurants</h3>
                <div v-for="(restaurant, indexB) in restaurants" :key="indexB">
                    <router-link :to="{name: 'restaurant-menu', params: {slug: restaurant.slug}}">{{restaurant.name}}</router-link>
                </div>



                <div id="food-truck-container" class="position-absolute">
                    <img src="/assets/img/food-truck edit.png" alt="Food truck">

                    <div id="truck-door-container" class="position-absolute">
                        <div id="truck-door" class="position-relative">
                            <div id="truck-door-window" class="position-absolute"></div>
                            <img src="/assets/img/food-truck-door-handle.png" class="position-absolute">
                        </div>
                    </div>
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

    .my_checkbox-label {
        margin-bottom: 0px;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 2px 4px;
    }

    .my_checkbox:checked {
        outline: 5px solid #0367a6;
        outline-offset: 5px;
        filter: grayscale(0%);
    }





    #food-truck-container {
        bottom: 0px;
        left: -84px;

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

        top: 15px;
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

</style>
