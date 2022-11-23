<template>
    <div>
        <header>
            <nav class="container-md text-light navbar navbar-light d-flex align-items-center justify-content-between">
                <router-link :to="{name: 'home'}" class="navbar-brand d-flex align-items-center">
                    <img src="/assets/img/super-french-fries_edit.png" alt="DeliveBoo">
                    <h1 class="mb-0 ml-2 text-white">DeliveBoo</h1>
                </router-link>

                <div v-if="!isUserLogged" class="d-flex justify-content-center">
                    <a href="/admin" class="btn btn-light">Login</a>
                    <a href="/register" class="btn btn-dark ml-2">Register</a>
                </div>

                <div v-else class="d-flex justify-content-center">
                    <a href="/admin" class="btn btn-secondary">My Dashboard</a>
                </div>
            </nav>
        </header>
    </div>
</template>

<script>
export default {
    name: 'MyHeader',
    data() {
        return {
            isUserLogged: false
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
    header {
        background-color: #007bff;
        height: 70px;
    }

    nav {
        height: 100%;
    }

    img {
        height: 50px;
    }
</style>