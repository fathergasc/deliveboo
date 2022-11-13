<template>
    <div class="container">
        <h2>Restaurant: {{restaurant.name}}</h2>
        <h3>Menu:</h3>
        <ul>
            <li v-for="(product, index) in restaurant.products" :key="index">{{product.name}}</li>
        </ul>
        <router-link :to="{name: 'home'}">Back</router-link>
    </div>

</template>

<script>
export default {
    name: 'RestaurantMenuPage',
    data() {
        return {
            restaurant: null,
        }
    },
    methods: {
        getRestaurantSlug() {
            const slug = this.$route.params.slug;
            axios.get('/api/restaurants/' + slug)
            .then((response)=>{
                this.restaurant = response.data.results;
            })
        }
    },
    mounted() {
        this.getRestaurantSlug();
    }
}
</script>

<style>

</style>
