<template>
    <div>
        <header @mouseleave="resetEmptyCartCheck()">
            <nav class="container-md text-light navbar navbar-light d-flex align-items-center justify-content-between">
                <router-link :to="{name: 'home'}" class="navbar-brand d-flex align-items-center">
                    <img class="d-none d-sm-block" src="/assets/img/super-french-fries_edit.png" alt="DeliveBoo">
                    <h1 class="mb-0 ml-2 text-white">DeliveBoo</h1>
                </router-link>

                <div class="d-flex align-items-center position-relative">
                    <div v-if="!isUserLogged" class="d-flex justify-content-center">
                        <a href="/admin" class="btn btn-light">Login</a>
                        <a href="/register" class="btn btn-dark ml-2">Signup</a>
                    </div>

                    <div v-else class="d-flex justify-content-center">
                        <a href="/admin" class="btn btn-secondary">My Dashboard</a>
                    </div>

                    <div class="ml-2">
                        <i @click="checkLiveCartEmpty(), $emit('linkPerEmptyLiveCart', linkPerEmptyLiveCart)" class="fa-solid fa-cart-shopping pointer"></i>
                    </div>

                    <div v-if="isLiveCartEmpty && linkPerEmptyLiveCart" class="position-absolute">
                        <div id="empty-cart-alert" class="alert alert-primary m-0" role="alert">
                            Your cart is empty.
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </div>
</template>

<script>
export default {
    name: 'MyHeader',
    props: {
        linkPerEmptyLiveCart: Boolean
    },
    data() {
        return {
            isUserLogged: false,
            isLiveCartEmpty: false
        }
    },
    methods: {
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
        resetEmptyCartCheck() {
            this.isLiveCartEmpty = false;
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

        h1 {
            font-size: 26px;
        }
        img {
            height: 50px;
        }
        i {
            font-size: 26px;
        }
    }

    #empty-cart-alert {
        right: -22px;
        bottom: -64px;

        z-index: 211;
    }

    .pointer {
        cursor: pointer;
    }

    /////// MEDUA QUERY ///////

    @media all and (min-width: 576px) {
        nav {
            h1 {
                font-size: 34px;
            }
        }
    }
</style>