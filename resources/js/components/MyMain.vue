<template>
    <div @touchstart="$emit('linkedLiveEmptyCart', isLiveCartEmpty)">
        <router-view ></router-view>
    </div>
</template>

<script>
export default {
    name: 'MyMain',
    data() {
        return {
            isLiveCartEmpty: false
        }
    }
}
</script>

<style scoped lang="scss">
</style>