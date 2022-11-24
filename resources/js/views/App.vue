<template>
    <div>
        <MyHeader :linkPerEmptyLiveCart="isLiveCartEmpty" @linkPerEmptyLiveCart="reSetLiveCartEmpty" />
        <MyMain @linkedLiveEmptyCart="setLiveCartEmpty" />
        <MyFooter />
    </div>
</template>

<script>
import MyHeader from '../components/MyHeader.vue';
import MyMain from '../components/MyMain.vue';
import MyFooter from '../components/MyFooter.vue';

export default {
    name: 'App',
    components: {
        MyHeader,
        MyMain,
        MyFooter
    },
    data() {
        return {
            isLiveCartEmpty: true
        }
    },
    methods: {
        setLiveCartEmpty(getLiveCartEmpty) {
            this.isLiveCartEmpty = getLiveCartEmpty;
        },
        reSetLiveCartEmpty(reGetLiveCartEmpty) {
            if (reGetLiveCartEmpty == false) {
                this.isLiveCartEmpty = true;
            }
        }
    }
}
</script>

<style scoped lang="scss">
    div {
        overflow-x: hidden;
    }
</style>
