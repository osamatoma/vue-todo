<template>
    <div v-if="response" class="alert alert-success"> {{response}} </div>
</template>
<script>
    export default {
        computed: {
            response() {
                return this.$store.getters.response;
            }
        }
    }
</script>