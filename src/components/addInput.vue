<template>
    <input type="text" class="form-control" v-model="newTodo" placeholder="what you have todo today?" @keypress.enter="addTodo" /> </template>
<script>
    export default {
        data() {
            return {
                newTodo: ''
            }
        }, methods: {
            addTodo() {
                this.$store.dispatch("addTodo", this.newTodo);
                this.newTodo = '';
            }
        }
    }
</script>