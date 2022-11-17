<template>
    <div>
        <header class="container-md">
            <nav class="navbar navbar-light d-flex align-items-center justify-content-between p-0">
                <router-link :to="{name: 'home'}" class="navbar-brand d-flex align-items-center">
                    <img src="/assets/img/super-french-fries_edit.png" alt="DeliveBoo">
                    <h1 class="mb-0 ml-2 text-white">DeliveBoo</h1>
                </router-link>

                <div class="text-white text-right">
                    Your kitchen is<br />
                    not a luna park
                </div>
            </nav>
        </header>
    </div>
</template>

<script>
export default {
    name: 'MyHeader'
}
</script>

<style scoped lang="scss">
    header {
        background-color: #0367a6;
        height: 70px;
    }

    nav {
        height: 100%;
    }

    img {
        height: 50px;
    }
</style>